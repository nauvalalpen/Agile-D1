<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">User Dashboard</a>
            <div class="navbar-nav ms-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Welcome, {{ Auth::user()->name }}</h4>
            </div>
            <div class="card-body">
                <h5>User Dashboard Content</h5>
                <p>Welcome to your personal dashboard. Here you can manage your account and view your activities.</p>
                
            </div>
        </div>
    </div>
</body>
</html>
