
```
# SportInHouse

SportInHouse is an online platform designed to facilitate the booking of indoor sports courts. The platform allows users to explore various indoor courts for sports like futsal and football, check their availability, and make bookings seamlessly. The site is aimed at making sports more accessible to everyone by offering a hassle-free way to reserve court time.

## Project Overview

- **Name**: SportInHouse
- **Category**: Indoor Sports Booking Platform
- **Technologies**: Laravel, Blade, Bootstrap, JavaScript, PHP, MySQL
- **Target Audience**: Sports enthusiasts, teams, event organizers, and individuals looking to book indoor sports courts.

## Features

- Search and filter options to easily find courts.
- Transparent pricing and availability for each court.
- Real-time booking system.
- User-friendly interface with responsive design for all devices.
- Court categories such as Futsal and Full-Field football.
- Option to book courts by selecting date and time.

## Setup Instructions

Follow the steps below to set up the **SportInHouse** project on your local machine:

### Prerequisites

- **PHP** (7.4 or higher)
- **Composer** (for managing PHP dependencies)
- **MySQL** or **MariaDB** (for the database)
- **XAMPP/WAMP** or similar for local development

### 1. Clone the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/yourusername/SportInHouse.git
```

### 2. Navigate to the Project Directory

```bash
cd SportInHouse
```

### 3. Install Dependencies

Run the following command to install all required dependencies using Composer:

```bash
composer install
```

### 4. Set Up the Environment File

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

### 5. Configure Your Database

Make sure your database details are set in the `.env` file:

```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sportinhouse
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Generate the Application Key

Run the following command to generate the application key:

```bash
php artisan key:generate
```

### 7. Run Migrations and Seed the Database

To set up your database tables, run the migrations:

```bash
php artisan migrate
```

You can also run the seeder to add sample data:

```bash
php artisan db:seed
```

### 8. Start the Development Server

To start the application locally, use the built-in Laravel server:

```bash
php artisan serve
```

Now you can access the project at `http://localhost:8000`.

## Usage Guide

Once the project is set up and running, follow these steps to use **SportInHouse**:

### Searching for Courts
- Use the **Search Bar** at the top of the page to search for courts by name.
- You can also filter the courts by category (Futsal, Full-Field Football).

### Booking a Court
- Browse available courts.
- Click on the **Book Now** button next to the court you wish to reserve.
- Select a date and time for your booking, and fill out your contact information.
- Confirm the booking and receive confirmation for your reservation.

## Contributing

We welcome contributions to improve the **SportInHouse** project! If you'd like to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-name`).
3. Make your changes and commit them (`git commit -am 'Add new feature'`).
4. Push to your branch (`git push origin feature-name`).
5. Create a new Pull Request.

## License

This project is open-source and available under the [MIT License](LICENSE).

## Contact

For questions or suggestions, please reach out via [your email address] or open an issue in the GitHub repository.

---

*Thank you for using SportInHouse!*
```