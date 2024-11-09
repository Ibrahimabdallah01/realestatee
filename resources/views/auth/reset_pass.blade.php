<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }} - Set New Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 5%;
        }
        .card {
            border: none;
            border-radius: 12px;
        }
        .card-header, .btn-primary {
            background-color: #007bff;
            color: #fff;
        }
        .btn-primary {
            font-weight: bold;
            padding: 10px 0;
            font-size: 1.1rem;
            border-radius: 8px;
        }
        h2.card-title {
            font-weight: bold;
            color: #333;
        }
        .form-label {
            font-weight: 600;
        }
        footer {
            margin-top: 3rem;
            text-align: center;
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <h1>{{ config('app.name', 'Laravel') }}</h1>
                    <p class="text-muted">Secure Your Account with a New Password</p>
                </div>
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h2 class="card-title">Set Your New Password</h2>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('save_new_password', ['token' => $user->remember_token]) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Set Password</button>
                        </form>
                    </div>
                </div>
                <footer class="mt-4">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka1Ww5Q4J5F8ZV8QIH7oAcFgVfQzT1XlZt63RtkQ3pZ5t6rfiwvOd3C8Fr3KZJPS" crossorigin="anonymous"></script>
</body>
</html>
