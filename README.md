# XCHANGE - Exchange Platform

XCHANGE is a Laravel-based web application that helps individuals exchange items through:
- Announcements (post an item and its details)
- Direct messaging (contact other users)
- A user dashboard (stats, latest announcements, and latest messages)
- An admin area (category management and admin dashboard)

## Screens
You can preview the UI in your app locally after setup.

## Features
- Authentication (login, register, logout)
- Announcements CRUD:
  - Create and publish announcements with photos, price, description, category, and publication date
  - Edit/delete access restricted to the announcement creator (or admin)
- Messaging:
  - Send messages between users (expediteur -> destinataire)
  - Edit/delete access restricted to the message sender (or admin)
- Categories:
  - Admin can manage categories
- Dashboards:
  - User dashboard for personal stats and recent activity
  - Admin dashboard for overall stats

## Tech Stack
- PHP 8.2+
- Laravel 12
- Blade + Bootstrap
- Vite for frontend assets
- MariaDB/MySQL

## Getting Started (Local)
1. Clone the repository
2. Install PHP dependencies:
   - `composer install`
3. Copy environment file:
   - `cp .env.example .env`
4. Configure your database credentials in `.env`
5. Generate the application key:
   - `php artisan key:generate`
6. Run migrations (and seed demo data if configured):
   - `php artisan migrate --seed`
7. Link storage for uploaded files:
   - `php artisan storage:link`
8. Install frontend dependencies and run Vite:
   - `npm install`
   - `npm run dev`
9. Start the Laravel dev server:
   - `php artisan serve`

Then open the application in your browser (usually `/`).

## Notes on Roles / Authorization
- Admin-only routes are protected by `AdminMiddleware`.
- Message edit/delete is enforced server-side in `MessageController` (not only on the UI).

## License
MIT
