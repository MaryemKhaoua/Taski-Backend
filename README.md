# Laravel Task Management API

This is a Laravel-based RESTful API for a task management system with authentication, user roles, and task CRUD operations.

---

## 🚀 Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone <https://github.com/MaryemKhaoua/Taski-Backend>
   cd <Taski-Backend>
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Set Up Environment File**
   ```bash
   cp .env.example .env
   ```

4. **Configure `.env`**
   Update the following lines in your `.env` file to match your local database configuration:
   ```
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the Database**
   ```bash
   php artisan db:seed
   ```

8. **Run the Development Server**
   ```bash
   php artisan serve
   ```

---

## 🌱 Database Seeding

To populate your database with sample data and default values (e.g. roles, users), run:

```bash
php artisan db:seed
```

Make sure appropriate seeders are defined in `DatabaseSeeder.php`.

---


## 👥 Test Accounts
The following test accounts are created automatically when you run php artisan db:seed:

| Role   | Username        | Password            |
|--------|-----------------|---------------------|
| Admin  | admin           | Password@123        |
| User   | user            | Password@123        |


## 📡 API Endpoints

### 🔐 Auth Routes

| Method | Endpoint        | Description             | Access        |
|--------|-----------------|-------------------------|---------------|
| POST   | `/api/register` | Register a user         | Public        |
| POST   | `/api/login`    | Login and get token     | Public        |
| POST   | `/api/logout`   | Logout                  | Authenticated |
| GET    | `/api/me`       | Get current user info   | Authenticated |

---

### 👤 User Routes

| Method | Endpoint     | Description     | Access  |
|--------|--------------|-----------------|---------|
| GET    | `/api/users` | List all users  | Admin   |

---

### 📋 Task Routes

| Method | Endpoint            | Description         | Access        |
|--------|---------------------|---------------------|---------------|
| GET    | `/api/tasks`        | List all tasks      | Authenticated |
| GET    | `/api/tasks/{id}`   | View specific task  | Authenticated |
| PUT    | `/api/tasks/{id}`   | Update a task       | Authenticated |
| POST   | `/api/tasks`        | Create new task     | Admin         |
| DELETE | `/api/tasks/{id}`   | Delete a task       | Admin         |

---

## 🔐 Authentication

This API uses Laravel Sanctum for token-based authentication. For routes that require authentication, include the following HTTP header:

```
Authorization: Bearer <your_token>
```

Replace `<your_token>` with the token received after a successful login.

---