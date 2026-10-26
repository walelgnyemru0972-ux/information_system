# Students Information Management System

A PHP + MySQL Student Information Management System with authentication, student management, courses, enrollment, results, reports and administration.

## Requirements

- PHP 8.0+
- MySQL 5.7+/MariaDB 10+
- Apache (XAMPP/WAMP/LAMP recommended)
- PDO MySQL extension enabled

## Installation

1. Copy the `Students-Information-Management-System` folder into your web server directory:
   - XAMPP: `htdocs/`
   - WAMP: `www/`
2. Start Apache and MySQL.
3. Open phpMyAdmin.
4. Import `database/student_management.sql`.
5. Check `config/database.php` and update:
   - database name
   - MySQL username
   - MySQL password
6. Open:
   `http://localhost/Students-Information-Management-System/`

## Default Login

- Username: `admin`
- Password: `admin123`

Change the default password after installation.

## Main Modules

- Login/logout and session authentication
- Dashboard statistics
- Admin user management
- Student CRUD
- Course CRUD
- Student enrollment
- Result entry/edit/delete
- Student, result and course reports
- Print-friendly reports
- Responsive CSS interface

## Grade Scale

The default result calculation is:

| Score | Grade |
|---:|:---|
| 90–100 | A+ |
| 85–89 | A |
| 80–84 | B+ |
| 75–79 | B |
| 70–74 | C+ |
| 60–69 | C |
| 50–59 | D |
| 0–49 | F |

Edit `calculateGrade()` in `results/add_result.php` and `results/edit_result.php` if your institution uses a different scale.

## Security Notes

This sample uses PDO prepared statements, password hashing, session regeneration and output escaping. For production deployment, additionally add CSRF protection to state-changing forms, role-specific authorization for every module, HTTPS, stronger password policies, audit logging and secure environment-based database credentials.

## Project Structure

```text
Students-Information-Management-System/
├── index.php
├── login.php
├── logout.php
├── dashboard.php
├── config/
├── includes/
├── admin/
├── students/
├── courses/
├── enrollment/
├── results/
├── reports/
├── assets/
├── database/
└── README.md
```
