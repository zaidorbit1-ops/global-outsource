# Website backend setup

The public informational pages remain available without MySQL configured. The admin dashboard, published job listings, and database-backed submissions become available after the following one-time setup.

## 1. Create the MySQL database

In phpMyAdmin, create your database, select it, then import [`database/schema.sql`](./database/schema.sql). The schema creates the tables for administrators, jobs, job applications, contact messages, and submission throttling inside the selected database.

If this database was set up before admin Settings and Users were added, select it in phpMyAdmin and run [`database/upgrade-admin-users.sql`](./database/upgrade-admin-users.sql) once. This adds the active/deactivated status used by the user-management page.

## 2. Set the database name (only if needed)

For this XAMPP installation, the site connects to `127.0.0.1:3307` as `root` with an empty password and uses the database name `global_outsource`. If that is your database name, **no connection configuration is needed**.

If your database has a different name, copy `config/database.local.php.example` to `config/database.local.php` and change its single `db_name` value. This file is excluded by `.gitignore`; the application automatically generates and keeps its own private security key.

For production, set MySQL credentials through environment variables and use a dedicated database user; do not use the MySQL root account.

## 3. Create the first administrator

You can either run the CLI tool from the project root:

```powershell
C:\xampp\php\php.exe tools\create-admin.php
```

Enter the admin email and a strong password when prompted. Or, after selecting your database in phpMyAdmin, insert an admin using the SQL `INSERT` statement with a PHP-generated `password_hash()` value.

## 4. Sign in

Open `http://localhost/Global%20Outsource/admin/login`. Any active administrator created by the CLI tool or in the dashboard's Users page can sign in. The dashboard is not linked as a public menu item.

## Dashboard features

- Create, edit, publish, or close job postings.
- Published jobs appear on the public Careers page.
- Review applicants, update application status, and securely download their CVs.
- Review contact form submissions and update message status.
- Update your admin sign-in email and password in Settings.
- Add, deactivate, reactivate, or delete admin accounts in Users. At least one active admin must remain.

Application CVs are stored under `storage/private/`, which Apache denies direct web access to. Downloads are streamed through an authenticated dashboard route.

## Deployment notes

- Clean URLs such as `/about` and `/admin/login` are handled by the root `.htaccess` file. Apache must have `mod_rewrite` enabled and allow `.htaccess` rewrite rules; upload this file with the website.
- Use HTTPS in production so the admin session cookie is always secure.
- Configure MySQL backups and restrict access to `config/database.local.php`, `config/app.key`, and `storage/private/`.
- PHP must have PDO MySQL, Fileinfo, and upload support enabled. Set PHP's `upload_max_filesize` and `post_max_size` to at least 6 MB for CV uploads.
- The contact form stores messages in this database; it does not send email automatically. The admin dashboard is the source of truth for received enquiries.
