<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 12 CRUD - Techsolutionstuff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <nav id="header" class="navbar">
            <div class="d-flex w-100">
                <a class="nav-link" href="{{ route('students.index') }}">Students</a>
                <a class="nav-link px-5" href="{{ route('courses.index') }}">Courses</a>
            </div>
        </nav>
        @yield('content')  
    </div>
</body>
</html>