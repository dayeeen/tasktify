
# Tasktify

![graphic](https://github.com/user-attachments/assets/2b64e74a-89ba-4900-ab39-2de1415d79ab)

## Description

Tasktify is a Laravel-based task management web application designed to help students increase productivity. With features like progress tracking, deadline reminders, and daily motivational quotes, Tasktify makes it easier to manage assignments, projects, and study schedules—keeping students organized and focused.
## Key Features

✅ Create and manage tasks easily

✅ Task categorization (Pending, In Progress, Completed)

✅ Interactive task progress charts

✅ Deadline setting and automatic reminders

✅ Daily motivational quotes

✅ Productivity reports and analytics
## Tech Stack

- Laravel 10
- Bootstrap 5
- MySQL
- Blade Template Engine
- Chart.js (for progress charts)

## Installation

Clone my repo

```bash
  git clone https://github.com/dayeeen/tasktify.git
  cd tasktify
```
    
Install dependencies
```bash
composer install
npm install
npm run dev
```

Configure the .env file
```bash
cp .env.example .env
php artisan key:generate
```
Setup the database
- Create a new database in MySQL
- Update your .env with database credentials
```bash
php artisan migrate
php artisan db:seed (if seeder available)
```
Run it on your local server
```bash
php artisan serve
```
