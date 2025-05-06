# Web - Based Executive Informtion System for New Ground Generation Church, Taguig City

## Overview

The **New Ground Generation Church Executive Information System (EIS)** is a web-based platform designed to enhance church administration and community engagement. Built using Laravel, the system provides centralized member data management, event scheduling, ministry assignment, financial tracking, email notifications for announcement, and resources management.

## Features

-   **User Authentication:** Secure login and access control using role-based permissions.
-   **Member Management:** Centralized database for storing and managing member details.
-   **Ministry Assignment:** Efficient assignment of members to ministries.
-   **Event Scheduling:** Streamlined event creation, management, and notifications.
-   **Financial Tracking:** Secure handling of donations, tithes, and reports.
-   **Email Announcements:** Automated notifications for church events and updates.
-   **Church Resource Management:** File handling and distribution to members via the church website.
-   **Public-Facing Website Integration:** Ensures seamless communication between the church and its members.

## Technology Stack

-   **Framework:** Laravel
-   **Backend:** PHP
-   **Database:** MySQL
-   **Frontend:** Bootstrap 5, HTML5
-   **Authentication:** Laravel's built-in authentication with JWT.

## Installation

### Prerequisites

Ensure that the following are installed on your system:

-   PHP `^8.0`
-   Composer
-   MySQL
-   Node.js (for frontend assets)
-   Laravel `^10.x`

### Step-by-Step Setup

1. **Clone the Repository**
    ```bash
    cd new-ground-generation-church-eis
    ```
2. **Install Dependencies**
   Open Terminal or Bash and run the following command
    ```bash
    composer install
    npm install
    ```

3.**Create a copy of .env file**
`bash
    cp .env.example .env
    `
This will create a copy of the .env.example file and name the copy simply .env.

4.**Configure the .env file and look for database connection in .env**
modify the DB_DATABASE according to your database name
example.
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=your_database_password

5. **Generate Key**
   Generate an app encryption key
   `bash
 php artisan key:generate
 `
   This will generate a random key for your application.

6.**Create Empty Database**
Create an empty database with the name you specified in the .env file
After successfully creating a database import the databasebchurcheis.sql file

7. **Migrate Database**
   Run the following command to create the necessary tables in your database
   `bash
 php artisan migrate
 `

8. **Run the Application**
   Run the following command to run the application
   `bash
 php artisan serve
 `
   Open a browser and navigate to: http://127.0.0.1:8000 or http://127.0.0.1:8000/admin

**for the administrator full access**
username: superadmin@gmail.com
password: P@ssword123

**for the user access**
username: user@gmail.com
password: P@ssword123
**Note:** The above credentials are for the default admin and user accounts. You can change them as
needed
