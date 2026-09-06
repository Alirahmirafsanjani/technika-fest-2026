# Technika Fest 2026

A web-based event management system developed to support participant registration, feedback, and e-certificate management for Technika Fest 2026.

## Overview

Technika Fest 2026 was developed to simplify several administrative processes involved in managing an event.

The system brings participant registration, feedback collection, and e-certificate management into a single web-based platform.

The project focuses on:

- Participant registration
- Event data management
- Feedback collection
- E-certificate management
- Centralized participant data

## Key Features

### 📝 Participant Registration

Provides a digital registration flow for event participants and stores registration data in a centralized system.

### 💬 Feedback System

Allows participants to submit feedback after participating in the event.

### 🎓 E-Certificate

Supports the management and distribution of participant certificates digitally.

### 🗂️ Event Data Management

Provides a centralized system for managing event-related data.

## My Contribution

I contributed to the development of the web application and its technical implementation.

My responsibilities included:

- Developing web application features
- Implementing application logic using Laravel
- Working with database-related functionality
- Supporting the registration and feedback workflows
- Contributing to the implementation of the e-certificate system

## Tech Stack

| Technology | Purpose |
|---|---|
| Laravel | Web application framework |
| PHP | Backend development |
| Blade | Frontend templating |
| JavaScript | Client-side functionality |
| MySQL | Database |
| Git & GitHub | Version control |

## System Flow

```text
Participant
     │
     ▼
Registration
     │
     ▼
Event Participation
     │
     ▼
Feedback
     │
     ▼
Certificate
```

## Project Structure

```text
technika-fest-2026/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── artisan
├── composer.json
├── package.json
└── README.md
```

## Getting Started

### Requirements

Make sure you have the following installed:

- PHP
- Composer
- MySQL
- Node.js
- npm

### Installation

Clone the repository:

```bash
git clone https://github.com/Alirahmirafsanjani/technika-fest-2026.git
```

Move into the project directory:

```bash
cd technika-fest-2026
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure the database credentials in the `.env` file.

Run the database migration:

```bash
php artisan migrate
```

Start the development server:

```bash
php artisan serve
```

## Project Status

✅ Completed project for Technika Fest 2026.

## License

This project was developed for Technika Fest 2026 and is intended for educational and event-management purposes.
