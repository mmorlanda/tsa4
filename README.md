# Tasks for Today Management System

This source package implements the TSA4 Laravel activity: full task CRUD, authentication, soft archiving through `is_archived`, and a completion email sent when a task changes from a non-completed status to `done`.

## Included activity requirements

- Task create, update, show, and archive actions use `TaskController` and validation.
- The public task list, Welcome, Profile, and About pages remain accessible without login.
- Task management routes are grouped behind `middleware('auth')`.
- `TaskCompleted` is a queued Mailable with a Blade email view.
- The update action sends the email only when the task transitions to `done`; editing an already-done task does not resend it.
- Migrations and a seeder provide the `users` and `tasks` tables.

## Setup

1. Install PHP 8.2+, Composer, Node.js, and SQLite.
2. Run `composer install`.
3. Copy `.env.example` to `.env` and run `php artisan key:generate`.
4. Create an empty `database/database.sqlite` file.
5. Run `php artisan migrate --seed`.
6. Run `npm install` and `npm run build`.
7. Start the application with `php artisan serve`.

The seeded login is `manager@example.com` with password `password`. Change it before using the application beyond testing. By default, email uses Laravel's `log` mail driver, so the generated message is written to the application log. Set `TASK_NOTIFICATION_RECIPIENT` and the SMTP variables in your local `.env` if you use a test SMTP service.

## Access-control test

Open `/tasks/create` in a private browser window while logged out. Laravel should redirect to `/login`. After signing in, create a task, edit it from `pending` to `done`, and check `storage/logs/laravel.log` when using the log mail driver. Edit the already-done task again and confirm no second completion message is generated. Test `/tasks`, `/about`, and `/profile` while logged out to confirm they remain public.

## Deliberately excluded

This package does not include `vendor/`, `node_modules/`, or `.env`. Those files are machine-specific or contain environment secrets and should be created locally during setup.
