
# HR Management System (HRMS)


## Table of Contents
1. [Introduction](#introduction)
2. [Key Features](#key-features)
3. [Prerequisites](#prerequisites)
4. [Installation Guide](#installation-guide)
   - [Step 1: Clone the Repository](#step-1-clone-the-repository)
   - [Step 2: Set Up the Oracle Database](#step-2-set-up-the-oracle-database)
   - [Step 3: Configure Database Connection](#step-3-configure-database-connection)
   - [Step 4: Deploy the Project Using XAMPP](#step-4-deploy-the-project-using-xampp)
5. [Running the Application](#running-the-application)
6. [Contributing](#contributing)
7. [License](#license)
8. [Author](#author)

## Introduction
The **HR Management System (HRMS)** is a web application designed to help organizations manage their Human Resource (HR) tasks effectively. This system handles employee management, payroll processing, attendance tracking, and performance evaluation. The application is built using **PHP** for the backend and **Oracle** for the database.

## Key Features
- **Employee Management**: Easily manage employee records, including personal details, job roles, and employment history.
- **Payroll Processing**: Automate payroll calculations and generate payslips.
- **Attendance Tracking**: Track employee attendance and manage leave requests efficiently.
- **Performance Evaluation**: Assess employee performance using predefined metrics.

## Prerequisites
Before you begin, ensure you have the following installed on your system:
- **XAMPP**: A popular PHP development environment. Download it from [Apache Friends](https://www.apachefriends.org/index.html).
- **Oracle Database**: Install Oracle Database Express Edition (XE) or any other version. Download it from the [Oracle website](https://www.oracle.com/database/technologies/appdev/xe.html).

## Installation Guide

### Step 1: Clone the Repository
1. Open your terminal or command prompt.
2. Run the following commands to clone the repository:
   ```bash
   git clone https://github.com/ZakiDhiblawe/HR_Using_Oracle_and_PHP
   cd hrms
   ```

### Step 2: Set Up the Oracle Database
1. Open **Oracle SQL Developer** or any other Oracle client tool.
2. Create a new user (schema) for the HRMS application.
3. Execute the SQL scripts found in `hr_database.txt` to create the necessary database tables and insert sample data.

### Step 3: Configure Database Connection
1. Open the `connection.php` file in the project directory.
2. Replace the placeholders with your Oracle database details:
   ```php
   $username = 'your_oracle_username';
   $password = 'your_oracle_password';
   $host = 'localhost';
   $port = '1521';
   $service_name = 'xe';
   ```

### Step 4: Deploy the Project Using XAMPP
1. Move the project folder to the `htdocs` directory inside your XAMPP installation directory (usually `C:/xampp/htdocs`).
2. Open the XAMPP Control Panel and start the **Apache** service.
3. In your web browser, go to `http://localhost/hrms/` to access the HRMS application.

## Running the Application
- Navigate through the different sections like **Employee Management**, **Payroll**, **Attendance**, and **Performance Evaluation** using the top menu bar.
- Ensure the Oracle database is running and properly connected before using the application.

## Contributing
If you’re interested in improving this project, feel free to fork the repository and submit a pull request.

## License
This project is licensed under the **MIT**.

## Author
**Zakaria Dahir Salad**  
Fullstack Devoloper
Oracle Course Project  
[LinkedIn Profile](https://www.linkedin.com/in/zakaria-dahir-salad/)
