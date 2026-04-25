# Task Manager MVC Application

## Project Description
This project is a Task Management Web Application developed in pure PHP using the MVC (Model-View-Controller) architecture.

Users can register, login, manage their tasks, and organize daily work efficiently.

## Features

- User Registration
- User Login / Logout
- Session Management
- Create Tasks
- View Tasks
- Edit Tasks
- Delete Tasks
- Search Tasks
- Filter Tasks by Status
- Responsive Clean UI

## Technologies Used

- PHP
- MySQL
- HTML
- CSS
- XAMPP
- MVC Architecture
- PDO Database Connection

## Database Tables

### users
- id
- name
- email
- password

### tasks
- id
- user_id
- title
- description
- status
- priority
- due_date
- created_at

## How to Run

1. Start Apache and MySQL in XAMPP
2. Import database in phpMyAdmin
3. Move project folder into htdocs
4. Open browser:

```text
http://localhost/task_manager/index.php?url=auth/login