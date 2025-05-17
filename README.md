# Musical Instrument Collection Manager

A simple web app built with Laravel that helps musicians keep track of their instruments. Users can create their own collections, organize instruments into categories, and store details about each item.

![Musical Instrument Collection Manager](https://via.placeholder.com/800x400)

## Table of Contents
- [Features](#features)
- [Installation](#installation)
- [Advanced Features](#advanced-features)
  - [User Login System](#user-login-system)
  - [Categories System](#categories-system)
  - [Tailwind CSS Design](#tailwind-css-design)
- [How to Use](#how-to-use)
- [License](#license)

## Features

- **Manage Instruments**: Add, view, update, and delete instruments
- **User Accounts**: Create an account and manage your personal collection
- **Categories**: Sort instruments into custom categories
- **Search**: Find instruments by name, type, brand, or description
- **Mobile-Friendly**: Works on phones, tablets, and computers
- **Favorites**: Mark your favorite instruments with a star

## Installation

Follow these steps to set up the project:

1. **Clone the repository**:
   ```
   git clone https://github.com/yourusername/musical-instrument-collection.git
   cd musical-instrument-collection
   ```

2. **Install dependencies**:
   ```
   composer install
   npm install
   ```

3. **Set up environment file**:
   ```
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set up database**:
   Edit the `.env` file for your database:
   
   For SQLite:
   ```
   DB_CONNECTION=sqlite
   ```
   
   For MySQL:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations and add sample data**:
   ```
   php artisan migrate --seed
   ```

6. **Build assets**:
   ```
   npm run dev
   ```

7. **Start the server**:
   ```
   php artisan serve
   ```

8. **Use the app**:
   Open your browser and go to `http://localhost:8000`

## Advanced Features

### User Login System

#### What I did
I added user accounts using Laravel Breeze. This allows each person to have their own private collection of instruments.

The system includes:
- Sign up and login pages
- Password reset option
- Email verification
- Personal instrument collections
- Security checks so users can only see their own instruments

#### How it works
I updated the database to link each instrument to a specific user with a `user_id` field. I also added security rules to make sure users can only view, edit, and delete their own instruments.

```php
// Example of security check in controller
public function show(Instrument $instrument)
{
    $this->authorize('view', $instrument);
    
    return view('instruments.show', compact('instrument'));
}
```

This means if someone tries to access another user's instrument by changing the URL, they'll get a "not allowed" message.

#### Why it's useful
The login system adds privacy and security to the app. Without it, all instruments would be visible to everyone, which wouldn't work for musicians who want to keep their collection private.

It also makes the app more personal since users only see their own instruments.

### Categories System

#### What I did
I created a system that lets users organize instruments into custom categories. An instrument can belong to multiple categories at once, making organization flexible.

The system includes:
- User-specific categories
- Many-to-many relationship between instruments and categories
- Add, edit, view, and delete categories
- Filter instruments by category

#### How it works
I made a new `Category` model and set up relationships between instruments and categories:

```php
// In the Category model
public function instruments()
{
    return $this->belongsToMany(Instrument::class);
}

// In the Instrument model
public function categories()
{
    return $this->belongsToMany(Category::class);
}
```

This creates a link where each instrument can belong to multiple categories, and each category can have multiple instruments.

The categories belong to specific users, so everyone can create their own organization system.

#### Why it's useful
This feature makes organizing large collections much easier. Real musicians often need to group instruments in different ways (by type, by project, by location, etc.).

With this system, users can put a guitar in both "String Instruments" and "Electric Instruments" categories at the same time.

One limitation: if a user creates too many categories, the selection interface might get crowded. In the future, we could add search or filtering for the category selection.

### Tailwind CSS Design

#### What I did
I redesigned the entire app using Tailwind CSS to make it look modern and work well on all device sizes.

The design includes:
- Clean, modern interface with Tailwind's utility classes
- Reusable component styles
- Mobile-friendly responsive design
- Improved visual organization
- Better-looking forms and buttons

#### How it works
I integrated Tailwind CSS with Laravel's build system and customized the colors to match a music theme:

```javascript
// Example from config file
module.exports = {
  theme: {
    extend: {
      colors: {
        primary: {
          500: '#0ea5e9',
          600: '#0284c7',
          700: '#0369a1',
        },
      },
    },
  },
}
```

I created reusable components to keep the design consistent, and built the layout to adapt to different screen sizes:

```html
<!-- Example of responsive design -->
<div class="flex flex-col md:flex-row md:items-center">
    <!-- Content changes from stacked to side-by-side on larger screens -->
</div>
```



## How to Use

After logging in, you can:

1. **View your instruments**: The home page shows all your instruments
2. **Add new instruments**: Click "Add New Instrument" to create a new entry
3. **Create categories**: Make custom categories and assign them to your instruments
4. **Search**: Use the search box to find instruments by name, type, brand, or description
5. **Manage instruments**: View details, edit, or delete any instrument in your collection

