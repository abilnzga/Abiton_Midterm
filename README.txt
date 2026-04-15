CodeIgniter 4 CRUD Practical Exam Submission

Project Name:
CI4-StarterPanel-master (adapted for the practical exam requirements)

Database Name:
ci4

Database Credentials:
Host: localhost
Port: 3306
Username: root
Password: Hanjo1@@

Default Login:
Email: developer@mail.io
Password: 123456

Implemented Features:
- User registration with server-side validation and unique email checking
- User login with password verification and session-based authentication
- Protected CRUD routes using CI4 filters
- Full student CRUD module: create, list, show, edit, update, delete
- Bootstrap 5 layout with navigation, flash messages, dashboard, and detail page
- Validation error display and confirmation prompt for delete

Relevant Routes:
- /login
- /register
- /dashboard
- /students
- /students/new
- /students/{id}
- /students/{id}/edit

Setup Steps:
1. Ensure MySQL is running and the database `ci4` exists.
2. Import the SQL export file in builds/CI4Exam_Database.sql.
3. If you prefer to rebuild from code instead of importing SQL, run:
   - php spark migrate
   - php spark db:seed Users
   - php spark db:seed StudentsMenuSeeder
   - php spark db:seed StudentSeeder
4. Start the app:
   - php spark serve --host localhost --port 8080
5. Open:
   - http://localhost:8080

Notes:
- The footer uses a placeholder name (`Your Name`) that can be personalized before submission.
- The SQL export includes the current working data used for verification.
