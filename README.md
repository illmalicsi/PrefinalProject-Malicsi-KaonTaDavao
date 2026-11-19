
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
  GET|HEAD        / ...................................................................................... home › HomeController
  GET|HEAD        districts ......................................................... districts.index › DistrictController@index
  GET|HEAD        districts/{district} ................................................ districts.show › DistrictController@show
  GET|HEAD        eateries ............................................................. eateries.index › EateryController@index
  POST            eateries ............................................................. eateries.store › EateryController@store
  GET|HEAD        eateries/create .................................................... eateries.create › EateryController@create
  GET|HEAD        eateries/{eatery} ...................................................... eateries.show › EateryController@show
  PUT|PATCH       eateries/{eatery} .................................................. eateries.update › EateryController@update
  DELETE          eateries/{eatery} ................................................ eateries.destroy › EateryController@destroy
  GET|HEAD        eateries/{eatery}/edit ................................................. eateries.edit › EateryController@edit
  POST            eateries/{eatery}/reviews .................................... eateries.reviews.store › ReviewController@store
  GET|HEAD        reviewers/{user} .................................................... reviewers.show › ReviewerController@show
  DELETE          reviews/{review} .................................................. reviews.destroy › ReviewController@destroy
```

## Screenshots

Add screenshots of the following pages:

1. Eatery directory
<img width="1499" height="930" alt="image" src="https://github.com/user-attachments/assets/f2eb7bee-822a-4de5-bd45-44f4b23ca2e1" />

2. Eatery detail page with reviews
<img width="2558" height="1434" alt="image" src="https://github.com/user-attachments/assets/447c0c7a-bf4d-4834-b7a6-e8a6e467acc4" />
<img width="2548" height="1370" alt="image" src="https://github.com/user-attachments/assets/cca8ed19-eae5-4a19-99c9-dde8d30ed216" />


3. Create eatery form showing validation errors
<img width="2558" height="1378" alt="image" src="https://github.com/user-attachments/assets/b60a6dfd-ba36-46e8-a35b-575350043936" />
