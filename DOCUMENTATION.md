# IELTS English Tips Website Documentation

## Project Overview
This project is a comprehensive training website for a private institute focusing on IELTS preparation, Headway English, and ICDL. It is built using a custom PHP OOP MVC framework.

## Architecture
- **MVC Pattern**: Separates logic (Controllers), Data (Models), and UI (Views).
- **Core Engine**:
  - `App.php`: Main router handling URL mapping (`/controller/method/params`).
  - `Controller.php`: Base class for all controllers.
  - `Database.php`: PDO wrapper for secure database interactions.
  - `Model.php`: Base model support.
  - `Session.php`: Custom session and flash message management.

## Database Schema
The system uses MySQL with the following key tables:
- `users`: Stores account information and roles.
- `profiles`: Extended user data including social links and teacher subjects.
- `courses`: Course details, categories, and pricing.
- `sections` & `lessons`: Hierarchical content structure.
- `exams`, `questions`, `options`: Online testing system.
- `enrollments` & `payments`: Subscription and financial tracking.
- `results`: Student exam scores.
- `logs`: System-wide audit trail for ERP.

## Features
1. **Authentication**: Secure registration with simulated email verification.
2. **Profile Management**: Role-specific profile completion (Student, Teacher, Admin).
3. **Course hierarchy**: Courses -> Sections -> Lessons (Video, PDF, Audio support).
4. **Online Exams**: Auto-evaluated MCQ and True/False tests.
5. **Digital Payments**: Integrated simulation for PayPal, Mastercard, and Bank of Khartoum.
6. **ERP System**:
   - **Owner Dashboard**: Financial summaries, traffic charts, and revenue tracking.
   - **Teacher Dashboard**: Course management and student performance reports.
   - **Student Dashboard**: Enrollment tracking and personal results.
7. **AJAX Integration**: Course listings and dynamic data fetching.
8. **Multilingual Support**: Foundation for English and Arabic switching.

## Installation
1. Import `database.sql` into your MySQL server.
2. Update `app/config/config.php` with your database credentials.
3. Ensure Apache `mod_rewrite` is enabled.
4. Point your virtual host to the root directory or access via `http://localhost/ieltsenglishtips/`.

## Developed By
**Marthad Musa**
[LinkedIn Profile](https://www.linkedin.com/in/marthad-musa-78389039/)

---
*2026 © IELTS English TIPS. All Rights Reserved.*
