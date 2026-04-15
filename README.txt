CodeIgniter 4 CRUD Practical Exam + Profile Activity Submission

Project Name:
CI4-StarterPanel-master

Database Name:
ci4

Database Credentials:
Host: localhost
Port: 3306
Username: root
Password: Hanjo1@@

Default Login Credentials for Testing:
Email: developer@mail.io
Password: 123456

Implemented Modules:
- Authentication: register, login, logout, session protection
- Student Records CRUD: create, list, show, edit, update, delete
- Student Profile Page: view profile, edit details, upload/change profile image

Relevant Routes:
- /login
- /register
- /dashboard
- /students
- /students/new
- /students/{id}
- /students/{id}/edit
- /profile
- /profile/edit
- /profile/update

Setup Steps:
1. Ensure MySQL is running and the database ci4 exists.
2. Import database from submission/CI4Exam_Database.sql.
3. If you are rebuilding from project files, run these commands:
   - php spark migrate
   - php spark db:seed Users
   - php spark db:seed StudentsMenuSeeder
   - php spark db:seed StudentSeeder
4. For profile fields, run the SQL file:
   - mysql -u root -p ci4 < profile_migration.sql
5. Start the app:
   - php spark serve --host localhost --port 8080
6. Open in browser:
   - http://localhost:8080

Profile Image Upload Path:
- public/uploads/profiles/

Notes:
- The database stores only the profile image filename in users.profile_image.
- The SQL export in submission/CI4Exam_Database.sql is already updated with profile columns.
