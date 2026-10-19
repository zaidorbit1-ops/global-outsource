<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/backend.php';
$admin = backend_require_admin();
$database = app_database();
$section = (string) ($_GET['section'] ?? 'overview');
$allowedSections = ['overview', 'jobs', 'applications', 'messages', 'settings', 'users'];

if (!in_array($section, $allowedSections, true)) {
    $section = 'overview';
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    backend_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');

    try {
        if ($action === 'save_job') {
            $id = filter_var($_POST['job_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            $title = trim((string) ($_POST['title'] ?? ''));
            $department = trim((string) ($_POST['department'] ?? ''));
            $location = trim((string) ($_POST['location'] ?? ''));
            $employmentType = trim((string) ($_POST['employment_type'] ?? ''));
            $summary = trim((string) ($_POST['summary'] ?? ''));
            $description = trim((string) ($_POST['description'] ?? ''));
            $requirements = trim((string) ($_POST['requirements'] ?? ''));
            $status = (string) ($_POST['status'] ?? 'draft');

            if ($title === '' || backend_length($title) > 160 || backend_length($department) > 120 || backend_length($location) > 120 || backend_length($employmentType) > 50 || $summary === '' || backend_length($summary) > 300 || $description === '' || backend_length($description) > 20000 || backend_length($requirements) > 12000 || !in_array($status, ['draft', 'open', 'closed'], true)) {
                throw new RuntimeException('Complete the required job fields and keep each field within its displayed limit.');
            }

            if ($id === false) {
                $statement = $database->prepare("INSERT INTO jobs (title, department, location, employment_type, summary, description, requirements, status, created_by, published_at) VALUES (:title, :department, :location, :employment_type, :summary, :description, :requirements, :status, :created_by, CASE WHEN :published_status = 'open' THEN UTC_TIMESTAMP() ELSE NULL END)");
                $statement->execute([
                    'title' => $title,
                    'department' => $department,
                    'location' => $location,
                    'employment_type' => $employmentType,
                    'summary' => $summary,
                    'description' => $description,
                    'requirements' => $requirements,
                    'status' => $status,
                    'created_by' => $admin['id'],
                    'published_status' => $status,
                ]);
            } else {
                $statement = $database->prepare("UPDATE jobs SET title = :title, department = :department, location = :location, employment_type = :employment_type, summary = :summary, description = :description, requirements = :requirements, status = :status, published_at = CASE WHEN :published_status = 'open' THEN COALESCE(published_at, UTC_TIMESTAMP()) ELSE published_at END WHERE id = :id");
                $statement->execute([
                    'title' => $title,
                    'department' => $department,
                    'location' => $location,
                    'employment_type' => $employmentType,
                    'summary' => $summary,
                    'description' => $description,
                    'requirements' => $requirements,
                    'status' => $status,
                    'published_status' => $status,
                    'id' => $id,
                ]);

                if ($statement->rowCount() === 0) {
                    $check = $database->prepare('SELECT id FROM jobs WHERE id = :id');
                    $check->execute(['id' => $id]);
                    if (!$check->fetchColumn()) {
                        throw new RuntimeException('That job posting could not be found.');
                    }
                }
            }

            backend_flash('success', $id === false ? 'Job posting created.' : 'Job posting updated.');
            backend_redirect('index?section=jobs');
        }

        if ($action === 'change_job_status') {
            $id = filter_var($_POST['job_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            $status = (string) ($_POST['status'] ?? '');

            if ($id === false || !in_array($status, ['draft', 'open', 'closed'], true)) {
                throw new RuntimeException('Invalid job status update.');
            }

            $statement = $database->prepare("UPDATE jobs SET status = :status, published_at = CASE WHEN :published_status = 'open' THEN COALESCE(published_at, UTC_TIMESTAMP()) ELSE published_at END WHERE id = :id");
            $statement->execute(['status' => $status, 'published_status' => $status, 'id' => $id]);
            backend_flash('success', 'Job status updated.');
            backend_redirect('index?section=jobs');
        }

        if ($action === 'change_application_status') {
            $id = filter_var($_POST['application_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            $status = (string) ($_POST['status'] ?? '');

            if ($id === false || !in_array($status, ['new', 'reviewing', 'shortlisted', 'declined', 'hired'], true)) {
                throw new RuntimeException('Invalid application status update.');
            }

            $statement = $database->prepare('UPDATE job_applications SET status = :status WHERE id = :id');
            $statement->execute(['status' => $status, 'id' => $id]);
            backend_flash('success', 'Application status updated.');
            backend_redirect('index?section=applications');
        }

        if ($action === 'change_message_status') {
            $id = filter_var($_POST['message_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            $status = (string) ($_POST['status'] ?? '');

            if ($id === false || !in_array($status, ['new', 'read', 'replied', 'archived'], true)) {
                throw new RuntimeException('Invalid contact message status update.');
            }

            $statement = $database->prepare('UPDATE contact_messages SET status = :status WHERE id = :id');
            $statement->execute(['status' => $status, 'id' => $id]);
            backend_flash('success', 'Contact message status updated.');
            backend_redirect('index?section=messages');
        }

        if ($action === 'delete_application') {
            $id = filter_var($_POST['application_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

            if ($id === false) {
                throw new RuntimeException('Invalid application selected for deletion.');
            }

            $statement = $database->prepare('SELECT cv_storage_name FROM job_applications WHERE id = :id');
            $statement->execute(['id' => $id]);
            $cvStorageName = $statement->fetchColumn();

            if (!is_string($cvStorageName)) {
                throw new RuntimeException('That application could not be found.');
            }

            $statement = $database->prepare('DELETE FROM job_applications WHERE id = :id');
            $statement->execute(['id' => $id]);

            if ($statement->rowCount() !== 1) {
                throw new RuntimeException('That application could not be found.');
            }

            if (preg_match('/\A[a-f0-9]{48}\.(?:pdf|doc|docx)\z/', $cvStorageName) !== 1) {
                error_log('Deleted application had an invalid private CV storage name.');
                backend_flash('error', 'Application deleted, but its CV file could not be identified for cleanup.');
            } else {
                $cvPath = __DIR__ . '/../storage/private/' . $cvStorageName;
                if (is_file($cvPath) && !unlink($cvPath)) {
                    error_log('Unable to remove private CV file after deleting application ' . $id . '.');
                    backend_flash('error', 'Application deleted, but its private CV file could not be removed.');
                } else {
                    backend_flash('success', 'Application deleted.');
                }
            }

            backend_redirect('index?section=applications');
        }

        if ($action === 'delete_message') {
            $id = filter_var($_POST['message_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

            if ($id === false) {
                throw new RuntimeException('Invalid contact message selected for deletion.');
            }

            $statement = $database->prepare('DELETE FROM contact_messages WHERE id = :id');
            $statement->execute(['id' => $id]);

            if ($statement->rowCount() !== 1) {
                throw new RuntimeException('That contact message could not be found.');
            }

            backend_flash('success', 'Contact message deleted.');
            backend_redirect('index?section=messages');
        }

        if ($action === 'update_admin_email') {
            $email = strtolower(trim((string) ($_POST['email'] ?? '')));
            $currentPassword = (string) ($_POST['current_password'] ?? '');

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false || strlen($email) > 254 || strlen($currentPassword) > 200) {
                throw new RuntimeException('Enter a valid email address and your current password.');
            }

            $statement = $database->prepare('SELECT password_hash FROM admins WHERE id = :id AND is_active = 1');
            $statement->execute(['id' => $admin['id']]);
            $passwordHash = $statement->fetchColumn();

            if (!is_string($passwordHash) || !password_verify($currentPassword, $passwordHash)) {
                throw new RuntimeException('Your current password is incorrect.');
            }

            try {
                $statement = $database->prepare('UPDATE admins SET email = :email WHERE id = :id');
                $statement->execute(['email' => $email, 'id' => $admin['id']]);
            } catch (PDOException $exception) {
                if ($exception->getCode() === '23000') {
                    throw new RuntimeException('That email address is already in use by another admin.');
                }
                throw $exception;
            }

            session_regenerate_id(true);
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            backend_flash('success', 'Your admin email has been updated.');
            backend_redirect('index?section=settings');
        }

        if ($action === 'update_admin_password') {
            $currentPassword = (string) ($_POST['current_password'] ?? '');
            $newPassword = (string) ($_POST['new_password'] ?? '');
            $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

            if (strlen($currentPassword) > 200 || $newPassword === '' || strlen($newPassword) > 200) {
                throw new RuntimeException('Enter a new password of 1 to 200 characters.');
            }
            if ($newPassword !== $confirmPassword) {
                throw new RuntimeException('The new password and confirmation do not match.');
            }

            $statement = $database->prepare('SELECT password_hash FROM admins WHERE id = :id AND is_active = 1');
            $statement->execute(['id' => $admin['id']]);
            $passwordHash = $statement->fetchColumn();

            if (!is_string($passwordHash) || !password_verify($currentPassword, $passwordHash)) {
                throw new RuntimeException('Your current password is incorrect.');
            }
            if (password_verify($newPassword, $passwordHash)) {
                throw new RuntimeException('Choose a password different from your current password.');
            }

            $statement = $database->prepare('UPDATE admins SET password_hash = :password_hash WHERE id = :id');
            $statement->execute(['password_hash' => password_hash($newPassword, PASSWORD_DEFAULT), 'id' => $admin['id']]);
            session_regenerate_id(true);
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            backend_flash('success', 'Your admin password has been updated.');
            backend_redirect('index?section=settings');
        }

        if ($action === 'create_admin') {
            $email = strtolower(trim((string) ($_POST['email'] ?? '')));
            $password = (string) ($_POST['password'] ?? '');
            $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false || strlen($email) > 254) {
                throw new RuntimeException('Enter a valid admin email address.');
            }
            if ($password === '' || strlen($password) > 200) {
                throw new RuntimeException('Enter an admin password of 1 to 200 characters.');
            }
            if ($password !== $confirmPassword) {
                throw new RuntimeException('The password and confirmation do not match.');
            }

            try {
                $statement = $database->prepare('INSERT INTO admins (email, password_hash, is_active) VALUES (:email, :password_hash, 1)');
                $statement->execute(['email' => $email, 'password_hash' => password_hash($password, PASSWORD_DEFAULT)]);
            } catch (PDOException $exception) {
                if ($exception->getCode() === '23000') {
                    throw new RuntimeException('An admin with that email address already exists.');
                }
                throw $exception;
            }

            backend_flash('success', 'Admin user added.');
            backend_redirect('index?section=users');
        }

        if ($action === 'change_admin_status') {
            $id = filter_var($_POST['admin_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            $isActive = filter_var($_POST['is_active'] ?? null, FILTER_VALIDATE_INT);

            if ($id === false || !in_array($isActive, [0, 1], true)) {
                throw new RuntimeException('Invalid admin status update.');
            }
            if ((int) $id === (int) $admin['id']) {
                throw new RuntimeException('You cannot deactivate your own admin account.');
            }

            $database->beginTransaction();
            try {
                $admins = $database->query('SELECT id, is_active FROM admins FOR UPDATE')->fetchAll();
                $target = null;
                $activeCount = 0;
                foreach ($admins as $account) {
                    if ((int) $account['is_active'] === 1) {
                        $activeCount++;
                    }
                    if ((int) $account['id'] === (int) $id) {
                        $target = $account;
                    }
                }

                if (!is_array($target)) {
                    throw new RuntimeException('That admin account could not be found.');
                }
                if ($isActive === 0 && (int) $target['is_active'] === 1 && $activeCount <= 1) {
                    throw new RuntimeException('At least one active admin account must remain.');
                }

                $statement = $database->prepare('UPDATE admins SET is_active = :is_active WHERE id = :id');
                $statement->execute(['is_active' => $isActive, 'id' => $id]);
                $database->commit();
            } catch (Throwable $exception) {
                if ($database->inTransaction()) {
                    $database->rollBack();
                }
                throw $exception;
            }

            backend_flash('success', $isActive === 1 ? 'Admin account activated.' : 'Admin account deactivated.');
            backend_redirect('index?section=users');
        }

        if ($action === 'delete_admin') {
            $id = filter_var($_POST['admin_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

            if ($id === false) {
                throw new RuntimeException('Invalid admin account selected for deletion.');
            }
            if ((int) $id === (int) $admin['id']) {
                throw new RuntimeException('You cannot delete your own admin account.');
            }

            $database->beginTransaction();
            try {
                $admins = $database->query('SELECT id, is_active FROM admins FOR UPDATE')->fetchAll();
                $target = null;
                $activeCount = 0;
                foreach ($admins as $account) {
                    if ((int) $account['is_active'] === 1) {
                        $activeCount++;
                    }
                    if ((int) $account['id'] === (int) $id) {
                        $target = $account;
                    }
                }

                if (!is_array($target)) {
                    throw new RuntimeException('That admin account could not be found.');
                }
                if ((int) $target['is_active'] === 1 && $activeCount <= 1) {
                    throw new RuntimeException('The last active admin cannot be deleted.');
                }

                $statement = $database->prepare('DELETE FROM admins WHERE id = :id');
                $statement->execute(['id' => $id]);
                $database->commit();
            } catch (Throwable $exception) {
                if ($database->inTransaction()) {
                    $database->rollBack();
                }
                throw $exception;
            }

            backend_flash('success', 'Admin user deleted.');
            backend_redirect('index?section=users');
        }

        throw new RuntimeException('Unknown dashboard action.');
    } catch (RuntimeException $exception) {
        $error = $exception->getMessage();
    } catch (Throwable $exception) {
        if ($database->inTransaction()) {
            $database->rollBack();
        }
        error_log('Admin dashboard action failed: ' . $exception->getMessage());
        $error = 'The change could not be saved. Please check the database connection and try again.';
    }
}

$flash = backend_take_flash();
$editId = filter_var($_GET['edit'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$editingJob = null;

if ($section === 'jobs' && $editId !== false && $editId !== null) {
    $statement = $database->prepare('SELECT * FROM jobs WHERE id = :id LIMIT 1');
    $statement->execute(['id' => $editId]);
    $editingJob = $statement->fetch();

    if (!is_array($editingJob)) {
        $error = 'The selected job posting was not found.';
    }
}

backend_layout_start(
    match ($section) {
        'jobs' => 'Job postings',
        'applications' => 'Applications',
        'messages' => 'Contact messages',
        'settings' => 'Settings',
        'users' => 'Users',
        default => 'Dashboard',
    },
    $admin,
    $section
);
?>
    <?php if ($flash !== null): ?>
        <div class="admin-alert <?= $flash['type'] === 'success' ? 'admin-alert-success' : 'admin-alert-error' ?>" role="status"><?= backend_escape($flash['message'] ?? '') ?></div>
    <?php endif; ?>
    <?php if ($error !== ''): ?>
        <div class="admin-alert admin-alert-error" role="alert"><?= backend_escape($error) ?></div>
    <?php endif; ?>

    <?php if ($section === 'jobs'): ?>
        <?php
        $jobs = $database->query('SELECT j.*, (SELECT COUNT(*) FROM job_applications a WHERE a.job_id = j.id) AS application_count FROM jobs j ORDER BY FIELD(j.status, "open", "draft", "closed"), j.created_at DESC')->fetchAll();
        $job = is_array($editingJob) ? $editingJob : [
            'id' => '',
            'title' => '',
            'department' => '',
            'location' => 'Karachi, Pakistan',
            'employment_type' => 'Full-time',
            'summary' => '',
            'description' => '',
            'requirements' => '',
            'status' => 'draft',
        ];
        ?>
        <div class="admin-page-heading">
            <div><p class="admin-eyebrow">Recruitment</p><h1>Job postings</h1><p>Create roles, publish them on Careers, and keep listings up to date.</p></div>
            <a class="admin-button admin-button-primary" href="index?section=jobs&new=1">+ New job</a>
        </div>
        <?php if (isset($_GET['new']) || is_array($editingJob)): ?>
            <section class="admin-panel admin-job-editor" aria-labelledby="job-editor-title">
                <div class="admin-panel-heading"><div><p class="admin-eyebrow"><?= $job['id'] !== '' ? 'Edit listing' : 'Create listing' ?></p><h2 id="job-editor-title"><?= $job['id'] !== '' ? 'Update job details' : 'Add a new opportunity' ?></h2></div><a class="admin-text-link" href="index?section=jobs">Cancel</a></div>
                <form method="post" action="index?section=jobs" class="admin-job-form">
                    <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>">
                    <input type="hidden" name="action" value="save_job">
                    <input type="hidden" name="job_id" value="<?= backend_escape($job['id']) ?>">
                    <label><span>Job title <i>*</i></span><input name="title" maxlength="160" value="<?= backend_escape($job['title']) ?>" required></label>
                    <label><span>Department</span><input name="department" maxlength="120" value="<?= backend_escape($job['department']) ?>"></label>
                    <label><span>Location</span><input name="location" maxlength="120" value="<?= backend_escape($job['location']) ?>" required></label>
                    <label><span>Employment type</span><input name="employment_type" maxlength="50" value="<?= backend_escape($job['employment_type']) ?>" required></label>
                    <label class="admin-job-form-wide"><span>Short summary <i>*</i></span><input name="summary" maxlength="300" value="<?= backend_escape($job['summary']) ?>" required><small>Shown in the public Careers listing.</small></label>
                    <label class="admin-job-form-wide"><span>Role description <i>*</i></span><textarea name="description" rows="5" maxlength="20000" required><?= backend_escape($job['description']) ?></textarea></label>
                    <label class="admin-job-form-wide"><span>Requirements</span><textarea name="requirements" rows="5" maxlength="12000"><?= backend_escape($job['requirements']) ?></textarea><small>Enter one requirement per line.</small></label>
                    <label><span>Publishing status</span><select name="status"><option value="draft"<?= $job['status'] === 'draft' ? ' selected' : '' ?>>Draft — not public</option><option value="open"<?= $job['status'] === 'open' ? ' selected' : '' ?>>Open — publish on Careers</option><option value="closed"<?= $job['status'] === 'closed' ? ' selected' : '' ?>>Closed — hide from Careers</option></select></label>
                    <div class="admin-job-form-actions"><button class="admin-button admin-button-primary" type="submit"><?= $job['id'] !== '' ? 'Save changes' : 'Create job posting' ?> <span aria-hidden="true">→</span></button></div>
                </form>
            </section>
        <?php endif; ?>
        <section class="admin-panel">
            <div class="admin-panel-heading"><div><p class="admin-eyebrow">All listings</p><h2>Manage opportunities <span class="admin-count"><?= count($jobs) ?></span></h2></div></div>
            <?php if ($jobs === []): ?>
                <div class="admin-empty"><span>▤</span><b>No job postings yet</b><p>Create your first listing. Published roles will appear on the Careers page.</p><a class="admin-button admin-button-primary" href="index?section=jobs&new=1">Create a job posting</a></div>
            <?php else: ?>
                <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Role</th><th>Type / Location</th><th>Applicants</th><th>Status</th><th>Actions</th></tr></thead><tbody>
                    <?php foreach ($jobs as $listing): ?>
                        <tr>
                            <td><b><?= backend_escape($listing['title']) ?></b><small><?= backend_escape($listing['department']) ?></small></td>
                            <td><?= backend_escape($listing['employment_type']) ?><small><?= backend_escape($listing['location']) ?></small></td>
                            <td><a class="admin-table-link" href="index?section=applications&job_id=<?= (int) $listing['id'] ?>"><?= (int) $listing['application_count'] ?> applicants</a></td>
                            <td><span class="admin-status admin-status-<?= backend_escape($listing['status']) ?>"><?= backend_escape(ucfirst($listing['status'])) ?></span></td>
                            <td><div class="admin-row-actions"><a class="admin-text-link" href="index?section=jobs&edit=<?= (int) $listing['id'] ?>">Edit</a><form method="post" action="index?section=jobs"><input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>"><input type="hidden" name="action" value="change_job_status"><input type="hidden" name="job_id" value="<?= (int) $listing['id'] ?>"><input type="hidden" name="status" value="<?= $listing['status'] === 'open' ? 'closed' : 'open' ?>"><button class="admin-text-button" type="submit"><?= $listing['status'] === 'open' ? 'Close' : 'Publish' ?></button></form></div></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody></table></div>
            <?php endif; ?>
        </section>

    <?php elseif ($section === 'applications'): ?>
        <?php
        $jobFilter = filter_var($_GET['job_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($jobFilter !== false && $jobFilter !== null) {
            $statement = $database->prepare('SELECT a.*, j.title AS job_title FROM job_applications a INNER JOIN jobs j ON j.id = a.job_id WHERE a.job_id = :job_id ORDER BY a.submitted_at DESC');
            $statement->execute(['job_id' => $jobFilter]);
            $applications = $statement->fetchAll();
        } else {
            $applications = $database->query('SELECT a.*, j.title AS job_title FROM job_applications a INNER JOIN jobs j ON j.id = a.job_id ORDER BY a.submitted_at DESC')->fetchAll();
        }
        ?>
        <div class="admin-page-heading"><div><p class="admin-eyebrow">Recruitment inbox</p><h1>Applications</h1><p>Review candidate details, download CVs and track progress.</p></div><span class="admin-heading-count"><?= count($applications) ?> total</span></div>
        <section class="admin-panel admin-inbox-panel" data-inbox-filter>
            <div class="admin-panel-heading"><div><p class="admin-eyebrow">Candidate submissions</p><h2><?= $jobFilter !== false && $jobFilter !== null ? 'Applications for selected role' : 'All applications' ?></h2><p class="admin-inbox-panel-description">Review candidate details and update progress in one place.</p></div><span class="admin-inbox-panel-icon" aria-hidden="true">♙</span></div>
            <?php if ($applications === []): ?>
                <div class="admin-empty"><span>♙</span><b>No applications received yet</b><p>Applications submitted from the Careers page will appear here.</p></div>
            <?php else: ?>
                <div class="admin-inbox-toolbar">
                    <label class="admin-inbox-search"><span class="admin-inbox-search-icon" aria-hidden="true">⌕</span><span class="admin-visually-hidden">Search candidates</span><input type="search" data-inbox-search placeholder="Search candidate, email or position..." autocomplete="off"></label>
                    <label class="admin-inbox-filter-select"><span>Status</span><select data-inbox-status><option value="">All statuses</option><?php foreach (['new', 'reviewing', 'shortlisted', 'declined', 'hired'] as $status): ?><option value="<?= $status ?>"><?= backend_escape(ucfirst($status)) ?></option><?php endforeach; ?></select></label>
                    <span class="admin-inbox-results" data-inbox-count><?= count($applications) ?> candidates</span>
                </div>
                <div class="admin-inbox-table-wrap">
                    <table class="admin-inbox-table">
                        <thead><tr><th>Candidate</th><th>Position &amp; submitted</th><th>Introduction</th><th>CV</th><th>Application status</th></tr></thead>
                        <tbody>
                            <?php foreach ($applications as $application): ?>
                                <tr data-inbox-row data-status="<?= backend_escape($application['status']) ?>">
                                    <td data-label="Candidate"><span class="admin-inbox-person"><span class="admin-inbox-person-avatar"><?= backend_escape(strtoupper(substr($application['name'], 0, 1))) ?></span><span><b><?= backend_escape($application['name']) ?></b><a href="mailto:<?= backend_escape($application['email']) ?>"><?= backend_escape($application['email']) ?></a><small><?= backend_escape($application['phone'] ?: 'No phone provided') ?></small></span></span></td>
                                    <td data-label="Position & submitted"><b><?= backend_escape($application['job_title']) ?></b><small class="admin-inbox-date"><?= backend_escape($application['submitted_at']) ?></small></td>
                                    <td data-label="Introduction"><?php if ($application['cover_letter'] !== ''): ?><details class="admin-inbox-details"><summary>Read introduction <span aria-hidden="true">+</span></summary><p><?= nl2br(backend_escape($application['cover_letter'])) ?></p></details><?php else: ?><span class="admin-inbox-muted">Not provided</span><?php endif; ?></td>
                                    <td data-label="CV"><a class="admin-button admin-button-secondary admin-download-button" href="download?id=<?= (int) $application['id'] ?>">Download CV <span aria-hidden="true">↓</span></a></td>
                                    <td data-label="Application status">
                                        <div class="admin-inbox-actions">
                                            <form class="admin-inbox-status-form" method="post" action="index?section=applications">
                                                <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>"><input type="hidden" name="action" value="change_application_status"><input type="hidden" name="application_id" value="<?= (int) $application['id'] ?>">
                                                <select name="status" aria-label="Status for <?= backend_escape($application['name']) ?>"><?php foreach (['new', 'reviewing', 'shortlisted', 'declined', 'hired'] as $status): ?><option value="<?= $status ?>"<?= $application['status'] === $status ? ' selected' : '' ?>><?= backend_escape(ucfirst($status)) ?></option><?php endforeach; ?></select>
                                                <button class="admin-button admin-button-small" type="submit">Save</button>
                                            </form>
                                            <form method="post" action="index?section=applications" data-confirm="Delete this application and its stored CV? This cannot be undone.">
                                                <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>"><input type="hidden" name="action" value="delete_application"><input type="hidden" name="application_id" value="<?= (int) $application['id'] ?>">
                                                <button class="admin-button admin-button-danger admin-button-small" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="admin-inbox-no-results" data-inbox-empty hidden><td colspan="5">No applications match your search. Try another name, email or status.</td></tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>

    <?php elseif ($section === 'messages'): ?>
        <?php $messages = $database->query('SELECT * FROM contact_messages ORDER BY submitted_at DESC')->fetchAll(); ?>
        <div class="admin-page-heading"><div><p class="admin-eyebrow">Website inbox</p><h1>Contact messages</h1><p>Review enquiries received through the Contact page.</p></div><span class="admin-heading-count"><?= count($messages) ?> total</span></div>
        <section class="admin-panel admin-inbox-panel" data-inbox-filter>
            <div class="admin-panel-heading"><div><p class="admin-eyebrow">Incoming enquiries</p><h2>All messages</h2><p class="admin-inbox-panel-description">Keep every enquiry organised and follow up with confidence.</p></div><span class="admin-inbox-panel-icon" aria-hidden="true">✉</span></div>
            <?php if ($messages === []): ?>
                <div class="admin-empty"><span>✉</span><b>Your inbox is clear</b><p>New contact form submissions will appear here.</p></div>
            <?php else: ?>
                <div class="admin-inbox-toolbar">
                    <label class="admin-inbox-search"><span class="admin-inbox-search-icon" aria-hidden="true">⌕</span><span class="admin-visually-hidden">Search contact messages</span><input type="search" data-inbox-search placeholder="Search name, email or service..." autocomplete="off"></label>
                    <label class="admin-inbox-filter-select"><span>Status</span><select data-inbox-status><option value="">All statuses</option><?php foreach (['new', 'read', 'replied', 'archived'] as $status): ?><option value="<?= $status ?>"><?= backend_escape(ucfirst($status)) ?></option><?php endforeach; ?></select></label>
                    <span class="admin-inbox-results" data-inbox-count><?= count($messages) ?> messages</span>
                </div>
                <div class="admin-inbox-table-wrap">
                    <table class="admin-inbox-table admin-message-table">
                        <thead><tr><th>Contact</th><th>Service</th><th>Enquiry</th><th>Received</th><th>Message status</th></tr></thead>
                        <tbody>
                            <?php foreach ($messages as $message): ?>
                                <tr data-inbox-row data-status="<?= backend_escape($message['status']) ?>">
                                    <td data-label="Contact"><span class="admin-inbox-person"><span class="admin-inbox-person-avatar admin-inbox-mail-avatar" aria-hidden="true">✉</span><span><b><?= backend_escape($message['name']) ?></b><a href="mailto:<?= backend_escape($message['email']) ?>"><?= backend_escape($message['email']) ?></a><small><?= backend_escape($message['phone'] ?: 'No phone provided') ?></small></span></span></td>
                                    <td data-label="Service"><span class="admin-inbox-service"><?= backend_escape($message['service'] ?: 'General enquiry') ?></span></td>
                                    <td data-label="Enquiry"><details class="admin-inbox-details"><summary>Read message <span aria-hidden="true">+</span></summary><p><?= nl2br(backend_escape($message['message'])) ?></p></details></td>
                                    <td data-label="Received"><span class="admin-inbox-date"><?= backend_escape($message['submitted_at']) ?></span></td>
                                    <td data-label="Message status">
                                        <div class="admin-inbox-actions">
                                            <form class="admin-inbox-status-form" method="post" action="index?section=messages">
                                                <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>"><input type="hidden" name="action" value="change_message_status"><input type="hidden" name="message_id" value="<?= (int) $message['id'] ?>">
                                                <select name="status" aria-label="Status for <?= backend_escape($message['name']) ?>"><?php foreach (['new', 'read', 'replied', 'archived'] as $status): ?><option value="<?= $status ?>"<?= $message['status'] === $status ? ' selected' : '' ?>><?= backend_escape(ucfirst($status)) ?></option><?php endforeach; ?></select>
                                                <button class="admin-button admin-button-small" type="submit">Save</button>
                                            </form>
                                            <form method="post" action="index?section=messages" data-confirm="Delete this contact message? This cannot be undone.">
                                                <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>"><input type="hidden" name="action" value="delete_message"><input type="hidden" name="message_id" value="<?= (int) $message['id'] ?>">
                                                <button class="admin-button admin-button-danger admin-button-small" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="admin-inbox-no-results" data-inbox-empty hidden><td colspan="5">No messages match your search. Try another name, email or status.</td></tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>

    <?php elseif ($section === 'settings'): ?>
        <div class="admin-page-heading"><div><p class="admin-eyebrow">Account security</p><h1>Settings</h1><p>Update your admin sign-in email and password.</p></div></div>
        <div class="admin-settings-grid">
            <section class="admin-panel" aria-labelledby="admin-email-title">
                <div class="admin-panel-heading"><div><p class="admin-eyebrow">Sign-in details</p><h2 id="admin-email-title">Change email</h2></div></div>
                <form method="post" action="index?section=settings" class="admin-account-form">
                    <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>">
                    <input type="hidden" name="action" value="update_admin_email">
                    <label><span>Admin email</span><input type="email" name="email" value="<?= backend_escape($admin['email']) ?>" maxlength="254" autocomplete="username" required></label>
                    <label><span>Current password</span><input type="password" name="current_password" maxlength="200" autocomplete="current-password" required></label>
                    <button class="admin-button admin-button-primary" type="submit">Update email <span aria-hidden="true">→</span></button>
                </form>
            </section>
            <section class="admin-panel" aria-labelledby="admin-password-title">
                <div class="admin-panel-heading"><div><p class="admin-eyebrow">Keep your account secure</p><h2 id="admin-password-title">Change password</h2></div></div>
                <form method="post" action="index?section=settings" class="admin-account-form">
                    <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>">
                    <input type="hidden" name="action" value="update_admin_password">
                    <label><span>Current password</span><input type="password" name="current_password" maxlength="200" autocomplete="current-password" required></label>
                    <label><span>New password <i>*</i></span><input type="password" name="new_password" maxlength="200" autocomplete="new-password" required><small>Choose any password you prefer (maximum 200 characters).</small></label>
                    <label><span>Confirm new password <i>*</i></span><input type="password" name="confirm_password" maxlength="200" autocomplete="new-password" required></label>
                    <button class="admin-button admin-button-primary" type="submit">Update password <span aria-hidden="true">→</span></button>
                </form>
            </section>
        </div>
    <?php elseif ($section === 'users'): ?>
        <?php $adminUsers = $database->query('SELECT id, email, is_active, created_at FROM admins ORDER BY created_at ASC, id ASC')->fetchAll(); ?>
        <div class="admin-page-heading"><div><p class="admin-eyebrow">Access management</p><h1>Admin users</h1><p>Add administrators, manage access, and remove accounts that are no longer needed.</p></div><span class="admin-heading-count"><?= count($adminUsers) ?> users</span></div>
        <section class="admin-panel admin-user-create">
            <div class="admin-panel-heading"><div><p class="admin-eyebrow">Grant dashboard access</p><h2>Add an admin user</h2></div></div>
            <form method="post" action="index?section=users" class="admin-account-form admin-user-create-form">
                <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>">
                <input type="hidden" name="action" value="create_admin">
                <label><span>Email address <i>*</i></span><input type="email" name="email" maxlength="254" autocomplete="off" required></label>
                <label><span>Password <i>*</i></span><input type="password" name="password" maxlength="200" autocomplete="new-password" required><small>Choose any password you prefer (maximum 200 characters).</small></label>
                <label><span>Confirm password <i>*</i></span><input type="password" name="confirm_password" maxlength="200" autocomplete="new-password" required></label>
                <div class="admin-user-create-submit"><button class="admin-button admin-button-primary" type="submit">Add admin <span aria-hidden="true">→</span></button></div>
            </form>
        </section>
        <section class="admin-panel">
            <div class="admin-panel-heading"><div><p class="admin-eyebrow">Dashboard access</p><h2>Manage users <span class="admin-count"><?= count($adminUsers) ?></span></h2></div></div>
            <div class="admin-table-wrap">
                <table class="admin-table admin-users-table">
                    <thead><tr><th>Admin</th><th>Added</th><th>Access</th><th>Actions</th></tr></thead>
                    <tbody>
                        <?php foreach ($adminUsers as $account): ?>
                            <tr>
                                <td><b><?= backend_escape($account['email']) ?></b><?php if ((int) $account['id'] === (int) $admin['id']): ?><small>Your account</small><?php endif; ?></td>
                                <td><?= backend_escape($account['created_at']) ?></td>
                                <td><span class="admin-status <?= (int) $account['is_active'] === 1 ? 'admin-status-open' : 'admin-status-closed' ?>"><?= (int) $account['is_active'] === 1 ? 'Active' : 'Deactivated' ?></span></td>
                                <td>
                                    <?php if ((int) $account['id'] === (int) $admin['id']): ?>
                                        <span class="admin-inbox-muted">Current admin</span>
                                    <?php else: ?>
                                        <div class="admin-row-actions">
                                            <form method="post" action="index?section=users">
                                                <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>"><input type="hidden" name="action" value="change_admin_status"><input type="hidden" name="admin_id" value="<?= (int) $account['id'] ?>"><input type="hidden" name="is_active" value="<?= (int) $account['is_active'] === 1 ? '0' : '1' ?>">
                                                <button class="admin-text-button" type="submit"><?= (int) $account['is_active'] === 1 ? 'Deactivate' : 'Activate' ?></button>
                                            </form>
                                            <form method="post" action="index?section=users" data-confirm="Permanently delete this admin account? This cannot be undone.">
                                                <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>"><input type="hidden" name="action" value="delete_admin"><input type="hidden" name="admin_id" value="<?= (int) $account['id'] ?>">
                                                <button class="admin-text-button admin-text-button-danger" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <p class="admin-users-note">At least one active admin account must remain. You cannot deactivate or delete your own account.</p>
        </section>
    <?php else: ?>
        <?php
        $counts = [
            'open_jobs' => (int) $database->query("SELECT COUNT(*) FROM jobs WHERE status = 'open'")->fetchColumn(),
            'applications' => (int) $database->query("SELECT COUNT(*) FROM job_applications")->fetchColumn(),
            'new_applications' => (int) $database->query("SELECT COUNT(*) FROM job_applications WHERE status = 'new'")->fetchColumn(),
            'new_messages' => (int) $database->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'new'")->fetchColumn(),
        ];
        $recentApplications = $database->query('SELECT a.id, a.name, a.email, a.status, a.submitted_at, j.title AS job_title FROM job_applications a INNER JOIN jobs j ON j.id = a.job_id ORDER BY a.submitted_at DESC LIMIT 5')->fetchAll();
        $recentMessages = $database->query('SELECT id, name, email, service, status, submitted_at FROM contact_messages ORDER BY submitted_at DESC LIMIT 5')->fetchAll();
        ?>
        <div class="admin-page-heading"><div><p class="admin-eyebrow">Your workspace</p><h1>Dashboard</h1><p>Manage your recruitment and keep up with new enquiries.</p></div><span class="admin-dashboard-date"><?= backend_escape(gmdate('D, d M Y')) ?></span></div>
        <div class="admin-stat-grid">
            <a class="admin-stat-card" href="index?section=jobs"><span class="admin-stat-icon">▤</span><small>Published jobs</small><b><?= $counts['open_jobs'] ?></b><span class="admin-stat-link">Manage postings <i>↗</i></span></a>
            <a class="admin-stat-card" href="index?section=applications"><span class="admin-stat-icon">♙</span><small>Total applicants</small><b><?= $counts['applications'] ?></b><span class="admin-stat-link"><?= $counts['new_applications'] ?> new <i>↗</i></span></a>
            <a class="admin-stat-card" href="index?section=messages"><span class="admin-stat-icon">✉</span><small>New messages</small><b><?= $counts['new_messages'] ?></b><span class="admin-stat-link">Open inbox <i>↗</i></span></a>
        </div>
        <div class="admin-dashboard-columns">
            <section class="admin-panel">
                <div class="admin-panel-heading"><div><p class="admin-eyebrow">Latest candidates</p><h2>Recent applications</h2></div><a class="admin-text-link" href="index?section=applications">View all <span aria-hidden="true">→</span></a></div>
                <?php if ($recentApplications === []): ?><div class="admin-compact-empty">Applications will appear here when candidates apply for a published role.</div><?php else: ?><div class="admin-recent-list"><?php foreach ($recentApplications as $application): ?><a href="index?section=applications"><span class="admin-recent-avatar"><?= backend_escape(strtoupper(substr($application['name'], 0, 1))) ?></span><span><b><?= backend_escape($application['name']) ?></b><small><?= backend_escape($application['job_title']) ?></small></span><span class="admin-status admin-status-<?= backend_escape($application['status']) ?>"><?= backend_escape(ucfirst($application['status'])) ?></span></a><?php endforeach; ?></div><?php endif; ?>
            </section>
            <section class="admin-panel">
                <div class="admin-panel-heading"><div><p class="admin-eyebrow">Inbox</p><h2>Recent messages</h2></div><a class="admin-text-link" href="index?section=messages">View all <span aria-hidden="true">→</span></a></div>
                <?php if ($recentMessages === []): ?><div class="admin-compact-empty">Contact enquiries will appear here as soon as someone sends a message.</div><?php else: ?><div class="admin-recent-list"><?php foreach ($recentMessages as $message): ?><a href="index?section=messages"><span class="admin-recent-avatar admin-message-avatar">✉</span><span><b><?= backend_escape($message['name']) ?></b><small><?= backend_escape($message['service'] ?: 'General enquiry') ?></small></span><span class="admin-status admin-status-<?= backend_escape($message['status']) ?>"><?= backend_escape(ucfirst($message['status'])) ?></span></a><?php endforeach; ?></div><?php endif; ?>
            </section>
        </div>
        <section class="admin-dashboard-callout"><span>▤</span><div><b>Hiring for a new role?</b><small>Create and publish a job listing. It will appear automatically on the Careers page.</small></div><a class="admin-button admin-button-primary" href="index?section=jobs&new=1">Create job posting <span aria-hidden="true">→</span></a></section>
    <?php endif; ?>
<?php backend_layout_end(); ?>
