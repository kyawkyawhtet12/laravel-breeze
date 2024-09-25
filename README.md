## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Project Setup](#project-setup)
  - [Clone the Repository](#clone-the-repository)
  - [Install Dependencies](#install-dependencies)
  - [Environment Configuration](#environment-configuration)
  - [Run Migrations and Seeders](#run-migrations-and-seeders)
  - [Create Storage Link](#create-storage-link)
- [Running the Project](#running-the-project)
  - [Serve the Project Locally](#serve-the-project-locally)
  - [Running Tests](#running-tests)
- [API Endpoints](#api-endpoints)
  - [Available API Routes](#available-api-routes)
---
## Requirements

- PHP 8.x
- Composer
- MySQL or another database supported by Laravel
- Node.js & npm
- Laravel 9.x or 10.x

---

## Installation

### Clone the Repository

```bash
git clone https://github.com/your-username/company-employee-management.git
cd company-employee-management
Install Dependencies
Install PHP dependencies using Composer:

composer install
Install Node.js dependencies for the frontend:

npm install
Environment Configuration

Copy .env.example to .env:
cp .env.example .env

Update your .env file with your local database configuration:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

Generate the application key:
php artisan key:generate

Run Migrations and Seeders
Run database migrations and seed the database:
php artisan migrate --seed

Create Storage Link
php artisan storage:link


Running the Project
Serve the Project Locally
php artisan serve

npm run dev

Running Tests
php artisan test


API Endpoints

Available API Routes
Companies
Get All Companies

Method: GET
URL: /api/companies
Description: Retrieves a list of all companies.
Create a New Company

Method: POST
URL: /api/companies
Description: Creates a new company.
Get a Single Company

Method: GET
URL: /api/companies/{id}
Description: Retrieves details of a specific company by ID.
Update a Company

Method: POST
URL: /api/companies/{id}
Description: Updates an existing company.
Delete a Company

Method: DELETE
URL: /api/companies/{id}
Description: Deletes a company by ID.
Employees
Get All Employees

Method: GET
URL: /api/employees
Description: Retrieves a list of all employees.
Create a New Employee

Method: POST
URL: /api/employees
Description: Creates a new employee.
Get a Single Employee

Method: GET
URL: /api/employees/{id}
Description: Retrieves details of a specific employee by ID.
Update an Employee

Method: POST
URL: /api/employees/{id}
Description: Updates an existing employee.
Delete an Employee

Method: DELETE
URL: /api/employees/{id}
Description: Deletes an employee by ID.

URL: /api/companies
Method: POST
Description: Add a new company by providing name, email, and website.
```
