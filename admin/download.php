<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/backend.php';
backend_require_admin();
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

if ($id === false) {
    http_response_code(404);
    exit('CV not found.');
}

$statement = app_database()->prepare('SELECT cv_storage_name, cv_original_name, cv_mime_type FROM job_applications WHERE id = :id LIMIT 1');
$statement->execute(['id' => $id]);
$application = $statement->fetch();

if (!is_array($application) || !preg_match('/\A[a-f0-9]{48}\.(pdf|doc|docx)\z/', $application['cv_storage_name'])) {
    http_response_code(404);
    exit('CV not found.');
}

$filePath = __DIR__ . '/../storage/private/' . $application['cv_storage_name'];

if (!is_file($filePath) || !is_readable($filePath)) {
    http_response_code(404);
    exit('The CV file is no longer available.');
}

$mimeTypes = [
    'application/pdf' => 'application/pdf',
    'application/msword' => 'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
];
$mimeType = $mimeTypes[$application['cv_mime_type']] ?? 'application/octet-stream';
$downloadName = preg_replace('/[\r\n"\\\\]/', '_', basename($application['cv_original_name']));
$downloadName = is_string($downloadName) && $downloadName !== '' ? $downloadName : 'candidate-cv';

header('Content-Type: ' . $mimeType);
header('Content-Length: ' . (string) filesize($filePath));
header('Content-Disposition: attachment; filename="candidate-cv"; filename*=UTF-8\'\'' . rawurlencode($downloadName));
header('Cache-Control: private, no-store, max-age=0');
header('X-Content-Type-Options: nosniff');
readfile($filePath);
