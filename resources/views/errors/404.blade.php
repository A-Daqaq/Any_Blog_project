<!-- resources/views/errors/404.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .error-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="display-1">404</h1>
        <p class="lead">Page Not Found</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
    </div>
</body>
</html>
