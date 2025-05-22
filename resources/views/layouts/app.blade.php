<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musical Instrument Collection</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Basic CSS Reset and Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header {
            background-color: #2563eb;
            color: white;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .nav {
            display: flex;
            gap: 1rem;
        }

        .nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .nav a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .main-content {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn:hover {
            background-color: #1d4ed8;
        }

        .btn-secondary {
            background-color: #6b7280;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        .btn-danger {
            background-color: #dc2626;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #f9fafb;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #6b7280;
        }

        .success-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            border: 1px solid #a7f3d0;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .search-form {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .search-form input {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        h1, h2, h3 {
            font-weight: 600;
            line-height: 1.2;
        }

        h2 {
            font-size: 1.25rem;
            color: #1f2937;
        }

        .text-center {
            text-align: center;
        }

        .py-8 {
            padding: 2rem 0;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .actions a, .actions button {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }

        .actions form {
            display: inline;
        }
    </style>



</head>



<body>
<header class="header">
    <div class="container">
        <h1>Musical Instrument Collection</h1>
        <nav class="nav">
            <a href="{{ route('instruments.index') }}">My Instruments</a>
            <a href="{{ route('categories.index') }}">My Categories</a>
            <a href="{{ route('instruments.create') }}">Add Instrument</a>
        </nav>
    </div>
</header>

<main>
    <div class="container">
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="main-content">
            @yield('content')
        </div>
    </div>
</main>
</body>
</html>
