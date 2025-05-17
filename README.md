# Musical Instrument Collection Manager

This is a simple web app built with Laravel to help musicians keep track of their musical instruments. You can store and manage information like the brand, type, year bought, condition, and more.

## Why I Built This

As a musician with a growing number of instruments, I wanted a clean and easy way to keep everything organized. This app helps me view all my instruments, search through them quickly, and sort them however I like.

## What It Can Do

### Main Features

- View all instruments in a clean, responsive layout
- Click on an instrument to see more details
- Add new instruments using a simple form
- Edit existing instruments using pre-filled forms
- Delete instruments with a confirmation step to avoid mistakes

The database uses one main table to store all the instrument details. I used Laravel migrations to set up the table, and seeders to add sample data for testing.

### Extra Features

#### 1. Search
You can search for instruments by name, type, brand, or description. This is handled using Laravel’s query builder.

```php
if ($request->has('search')) {
    $searchTerm = $request->search;
    $query->where(function($q) use ($searchTerm) {
        $q->where('name', 'LIKE', "%{$searchTerm}%")
          ->orWhere('type', 'LIKE', "%{$searchTerm}%")
          ->orWhere('brand', 'LIKE', "%{$searchTerm}%")
          ->orWhere('description', 'LIKE', "%{$searchTerm}%");
    });
}
```

#### 2. Pagination
If your collection gets big, instruments are split into pages so the site loads faster and stays clean.

```php
$instruments = $query->paginate(5);
```

#### 3. Form Validation
The app checks that the data you enter is valid. For example:

- Name, type, and brand are required
- Year must be realistic
- Price must be a positive number

```php
$validated = $request->validate([
    'name' => 'required|max:255',
    'type' => 'required|max:255',
    'brand' => 'required|max:255',
    'year_acquired' => 'required|integer|min:1900|max:' . date('Y'),
    'purchase_price' => 'nullable|numeric|min:0',
    'description' => 'nullable|string',
    'condition' => 'required|max:255',
    'is_favorite' => 'boolean',
]);
```

#### 4. Custom CSS Design
The app uses a custom CSS file for a modern look:

- A grid layout that works on all screen sizes
- Clear fonts and color scheme
- Hover effects and visual feedback for search and sort actions

#### 5. Laravel Layouts
The app uses Laravel's layout feature for a consistent look across all pages. Each page shares a common layout and adds its own content.

```blade
@extends('layouts.app')

@section('title', 'All Instruments')

@section('content')
    <!-- Page specific content here -->
@endsection
```

## What Makes This Project Unique

- It uses different types of data like text, numbers, checkboxes, and more
- You can mark certain instruments as favorites
- Instruments can be sorted by name, brand, year, etc.
- It uses a modern grid layout instead of a table
- Search filters stay active while paginating or sorting

## Screenshots

[Add screenshots of your app here if you’d like]

## How to Install

1. Clone this repository:
   ```bash
   git clone https://github.com/your-username/instrument-collection.git
   ```
2. Navigate into the project folder:
   ```bash
   cd instrument-collection
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Copy the environment file:
   ```bash
   cp .env.example .env
   ```
5. Set up your database in the `.env` file
6. Generate the app key:
   ```bash
   php artisan key:generate
   ```
7. Run the database migrations and seed the data:
   ```bash
   php artisan migrate --seed
   ```
8. Start the server:
   ```bash
   php artisan serve
   ```

Then open your browser and go to:  
[http://localhost:8000](http://localhost:8000)

You're ready to go!
