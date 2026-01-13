User & Task Management System
A robust Laravel 12 application designed to manage users and their associated tasks. This project demonstrates CRUD operations, data validation, Eloquent relationships, and RESTful API integration.

🚀 Key Features
User Management:

Full CRUD functionality for Users.

Custom validation for mobile numbers (exactly 10 digits).

Real-time task tracking (displays Total and Completed task counts per user).

Task Management:

Assign tasks to users with specific due dates.

Overdue Logic: Pending tasks past their due date are automatically highlighted in Red with a clear "OVERDUE" badge.

Smart Filtering: Filter the task list by status (Pending or Completed).

Validation: Prevents the creation of tasks with past due dates.

REST API:

Dedicated endpoint to fetch tasks for a specific user.

🛠️ Technical Stack
Backend: Laravel 12 (PHP 8.2+)

Database: SQLite

Frontend: Blade Templates & Bootstrap 5

API: RESTful JSON responses

💻 Installation & Local Setup
Clone the project: git clone https://github.com/devkomal23/user-task-manager.git

Install dependencies: composer install

Configure Environment: cp .env.example .env php artisan key:generate

Database Setup:

Create the SQLite file: touch database/database.sqlite

Run migrations: php artisan migrate

Start the server: php artisan serve Visit the app at: http://localhost:8000/users

📡 API Documentation
Get Tasks by User
Retrieves all tasks assigned to a specific user.

Endpoint: GET /api/users/{id}/tasks

Method: GET

Success Response (200 OK): [ { "id": 1, "user_id": 10, "title": "Submit Final Project", "due_date": "2024-05-25", "status": "pending" } ]

📋 Assignment Requirements Checklist
[x] User CRUD (Name, Email, 10-digit Mobile).

[x] Task CRUD (Title, User ID, Due Date, Status).

[x] Task Status Filter.

[x] Overdue task highlighting (Red background).

[x] Eloquent Relationship (User hasMany Tasks).

[x] REST API implementation.

[x] 100% "Without Vendor" submission compliant.
