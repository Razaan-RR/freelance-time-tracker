# Freelance Time Tracker

A simple Laravel 10+ web application that allows freelancers to manage their own clients and projects.

### ✨ Features
- User registration & login
- Client management (name, email, contact)
- Project management (title, description, deadline, status)
- Assign projects to specific clients
- Update project status (active/completed)

---

## 🛠️ Setup Instructions

Follow the steps below to get the app running on your machine:

### 1. Clone the Repository

```bash
git clone https://github.com/Razaan-RR/freelance-time-tracker.git
cd freelance-time-tracker
````

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Create `.env` File

```bash
cp .env.example .env
```

### 4. Set Up Database

Open `.env` in a text editor and update the following lines with your DB info:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=freelance_tracker
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

Then run:

```bash
php artisan migrate
```

### 5. Generate App Key

```bash
php artisan key:generate
```

### 6. Start the Laravel Server

```bash
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000) in your browser.

---

## 📁 Project Structure

* `routes/web.php`: All routes
* `app/Http/Controllers`: Handles user auth, client, and project logic
* `resources/views`: Blade views (`dashboard.blade.php`, etc.)
* `app/Models`: Eloquent models (User, Client, Project)
* `database/migrations`: Database schema

---

## ✅ Default Pages

* `/registrationPage`: User sign-up
* `/loginPage`: User login
* `/dashboard`: After login, view profile, add clients, and manage projects

---

## 🔐 Authentication

A custom session-based middleware is used to restrict access to `/dashboard`, `/clients`, and `/projects` routes.

---
## API Testing with Postman

You can test the API using the included Postman collection:

- Import the file `postman/freelance-time-tracker.postman_collection.json` into your Postman app.
- The collection includes all API endpoints with example requests.

This helps you quickly test and explore the API without manual setup.


