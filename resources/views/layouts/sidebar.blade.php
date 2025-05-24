<!-- resources/views/layouts/sidebar.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #343a40;
            color: #fff;
            padding-top: 1rem;
        }
        .sidebar a {
            color: #adb5bd;
            padding: 10px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .content {
            margin-left: 250px;
            padding: 2rem;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="text-center text-light">MyApp</h4>
    <a href="">Dashboard</a>
    <a href="">Users</a>
    <a href="">Products</a>
    <a href="">Settings</a>
    <a href="">Logout</a>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
