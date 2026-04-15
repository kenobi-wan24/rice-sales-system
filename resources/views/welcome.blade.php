<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rice Sales System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 48px 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }

        .icon {
            font-size: 2.5rem;
            color: #2d7a27;
            margin-bottom: 16px;
        }

        h1 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #212529;
            margin-bottom: 8px;
        }

        p {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 32px;
        }

        .btn-primary-custom {
            display: block;
            width: 100%;
            background: #2d7a27;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 11px;
            font-size: 0.95rem;
            text-decoration: none;
            margin-bottom: 10px;
            transition: background 0.2s;
        }

        .btn-primary-custom:hover {
            background: #236020;
            color: #fff;
        }

        .btn-outline-custom {
            display: block;
            width: 100%;
            background: transparent;
            color: #2d7a27;
            border: 1.5px solid #2d7a27;
            border-radius: 8px;
            padding: 11px;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-outline-custom:hover {
            background: #2d7a27;
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="icon">
            <i class="bi bi-basket2-fill"></i>
        </div>
        <h1>Rice Sales System</h1>
        <p>Manage inventory, orders, and payments in one place.</p>

        <a href="{{ route('login') }}" class="btn-primary-custom">
            <i class="bi bi-box-arrow-in-right"></i> Log In
        </a>
        <a href="{{ route('register') }}" class="btn-outline-custom">
            <i class="bi bi-person-plus"></i> Register
        </a>
    </div>

</body>
</html>
