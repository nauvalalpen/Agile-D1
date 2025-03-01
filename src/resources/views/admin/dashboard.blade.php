<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="navbar-nav ms-auto">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
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
                <h5>Admin Dashboard Content</h5>
                <p>This is your admin control panel. You can manage your site from here.</p>
                <p>ADMIN ADMIN ADMIND</p>
            </div>
        </div>
    </div>
</body>
</html>
