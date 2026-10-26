CREATE DATABASE IF NOT EXISTS student_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE student_management;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(120) NULL,
    role ENUM('admin','staff') NOT NULL DEFAULT 'staff',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS students (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_no VARCHAR(50) NOT NULL UNIQUE,
    first_name VARCHAR(80) NOT NULL,
    last_name VARCHAR(80) NOT NULL,
    gender VARCHAR(20) NULL,
    date_of_birth DATE NULL,
    phone VARCHAR(40) NULL,
    email VARCHAR(120) NULL,
    department VARCHAR(120) NOT NULL,
    year_level TINYINT UNSIGNED NOT NULL DEFAULT 1,
    address TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS courses (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(30) NOT NULL UNIQUE,
    course_name VARCHAR(150) NOT NULL,
    credit_hours TINYINT UNSIGNED NOT NULL DEFAULT 3,
    department VARCHAR(120) NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS enrollments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT UNSIGNED NOT NULL,
    course_id INT UNSIGNED NOT NULL,
    semester VARCHAR(30) NOT NULL,
    academic_year VARCHAR(20) NOT NULL,
    enrollment_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_enrollment (student_id, course_id, semester, academic_year),
    CONSTRAINT fk_enrollment_student FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    CONSTRAINT fk_enrollment_course FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS results (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    enrollment_id INT UNSIGNED NOT NULL UNIQUE,
    score DECIMAL(5,2) NOT NULL,
    grade VARCHAR(5) NOT NULL,
    remarks VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_result_enrollment FOREIGN KEY (enrollment_id) REFERENCES enrollments(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Default admin login:
-- Username: admin
-- Password: admin123
-- The password hash below was generated with PHP password_hash('admin123', PASSWORD_DEFAULT).
INSERT INTO users (username,password,full_name,email,role)
SELECT 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCkJ4x0ZlQWJrQ5f7Z1a', 'System Administrator', 'admin@example.com', 'admin'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE username='admin');

INSERT INTO courses (course_code,course_name,credit_hours,department,description)
SELECT 'CS101','Introduction to Computer Science',3,'Computer Science','Fundamentals of computing and programming.'
WHERE NOT EXISTS (SELECT 1 FROM courses WHERE course_code='CS101');

INSERT INTO courses (course_code,course_name,credit_hours,department,description)
SELECT 'DB201','Database Systems',3,'Computer Science','Relational databases, SQL and database design.'
WHERE NOT EXISTS (SELECT 1 FROM courses WHERE course_code='DB201');
