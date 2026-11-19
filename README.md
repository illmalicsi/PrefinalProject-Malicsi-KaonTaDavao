
# Kaon Ta! Davao: Carinderia & Eatery Guide

**Developer:** Ivan Louie Malicsi  
**Framework:** Laravel 12  
**Database:** SQLite  
**Frontend:** Tailwind CSS and Vite

## Project Description

Kaon Ta! Davao is a public directory of carinderias and local eateries in Davao City. It allows visitors to discover eateries, explore districts, view menus and business permits, and read or submit reviews.

## Features

- Homepage with statistics and top-rated eateries
- Eatery directory with search and filters
- Eatery creation, editing, and deletion
- District directory and district details
- Eatery dishes and bestseller labels
- Business permit information and expiration status
- Reviewer profiles and review history
- Review submission and deletion
- Responsive interface using Tailwind CSS

## Installation

Clone the repository:

```bash
git clone YOUR_GITHUB_REPOSITORY_URL
cd PrefinalProject-Malicsi-KaonTadavao
```

Install PHP dependencies:

```bash
composer install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Create the SQLite database:

```bash
touch database/database.sqlite
```

Run migrations and seeders:

```bash
php artisan migrate:fresh --seed
```

Install frontend dependencies:

```bash
npm install
npm run build
```

Start the application:

```bash
php artisan serve
```

Visit http://127.0.0.1:8000.

## Seeded Data

- Districts: Poblacion, Talomo, Agdao, Buhangin, Toril, and Calinan
- Features: Suki ni Malicsi, Budget Meal, Halal, Open 24 Hours, Aircon, and Pet Friendly
- Seeded reviewers: Ivan Louie Malicsi and Tita Malicsi
- Sample eatery: Carinderia ni Malicsi
- Sample permit: Add the actual seeded permit number here.

## Database Relationships

Add a table explaining each model relationship, its type, and why it is appropriate for the application.

## Routes

Paste the output of:

```bash
php artisan route:list --except-vendor
```

## Screenshots

Add screenshots of the following pages:

1. Eatery directory
2. Eatery detail page with reviews
3. Create eatery form showing validation errors
