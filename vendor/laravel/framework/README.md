# Music Gear Collection Manager

A web app for musicians to track and organize their instrument collection.

## About This Project

I built this app to help musicians keep track of all their gear in one place. It's a simple but effective tool where you can add details about each instrument, including what type it is, when you got it, how much it cost, and what condition it's in.

## Features

### Core Features
- **Full Database Support**: Built with Laravel and MySQL
- **Well-Designed Database**: Single normalized table for storing gear info
- **Easy Setup**: Includes migrations and seeders to populate with sample data
- **Complete Management**: Add, view, edit, and delete instruments
- **Laravel Framework**: Uses routes, controllers, models, views, and other Laravel features
- **Custom Styling**: Hand-coded CSS (no frameworks) for desktop users
- **User-Friendly**: Simple navigation and intuitive interface

### Extra Features# Musical Instrument Collection Manager

A web application for musicians to catalog and manage their instrument collection, built with the Laravel framework.

## Project Overview

The Musical Instrument Collection Manager is a web application that allows musicians to catalog and track their musical instruments. Musicians can store details about each instrument, including its name, type, brand, year acquired, purchase price, condition, and description. The application provides a clean, user-friendly interface for adding, viewing, editing, and deleting instruments in their collection.

## Functionality

The application implements the following features:

### Core Requirements

- **Database-Driven Application**: Uses Laravel with MySQL as the database.
- **Single Table Design**: Uses a well-designed `instruments` table that follows first normal form.
- **Migrations and Seeders**: Includes database migrations for easy table creation and seeders to populate the table with sample data.
- **CRUD Operations**: Implements Create, Read, Update, and Delete operations for musical instruments.
- **Laravel Framework Components**: Effectively uses routes, controllers, models, views, blade directives, and Eloquent ORM.
- **Custom CSS Styling**: Styled using custom CSS for desktop users (1366x768 resolution).
- **User-Friendly Navigation**: Features clear navigation and a clean, intuitive interface.

### Additional Features

- **Search Functionality**: Users can search for instruments by name, type, brand, or description.
- **Pagination**: Results are paginated when there are more than 5 instruments.
- **Input Validation**: Server-side validation ensures all inputs are valid before saving to the database.
- **Advanced CSS Usage**: Features a responsive layout, card designs, form styling, and visual feedback.
- **Deep Laravel Implementation**:
    - Uses Blade templating
    - Implements Eloquent relationships
    - Utilizes route resources for clean URL structure
    - Employs advanced Blade directives

## Technical Implementation

### Database Structure

The `instruments` table includes the following fields:

- `id`: Primary key (auto-increment)
- `name`: Instrument name
- `type`: Type of instrument (e.g., Electric Guitar, Piano)
- `brand`: Manufacturer/brand
- `year_acquired`: Year the instrument was acquired
- `purchase_price`: Purchase price (nullable)
- `description`: Detailed description (nullable)
- `condition`: Condition of the instrument
- `is_favorite`: Boolean to mark favorite instruments
- `created_at` and `updated_at`: Timestamps

### Laravel Components Used

- **Models**: Eloquent model with defined fillable attributes and helper methods
- **Controllers**: Resource controller with methods for all CRUD operations
- **Views**: Blade templates with layout inheritance
- **Validation**: Server-side validation in the controller
- **Routes**: Resourceful routing for clean URL structure
- **Migrations**: Database schema definition
- **Seeders**: Sample data population

### Good Practices Implemented

- **Clean Code Structure**: Well-organized files and code
- **Input Validation**: All user inputs are validated
- **Error Handling**: Proper error messages displayed to users
- **Visual Feedback**: Success messages after operations
- **Responsive Design**: Works well on different screen sizes
- **Semantic HTML**: Proper use of HTML elements
- **CSS Best Practices**: Organized styles with consistent naming
- **Form Security**: CSRF protection and proper form methods

This project demonstrates a solid understanding of web application development using the Laravel framework, focusing on fundamental CRUD operations and best practices in modern web development.
