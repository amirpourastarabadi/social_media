<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social Media Website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
			position: relative;
            background-image: url('{{asset("storage/generals/background.jpg")}}');
			background-size: cover;
			background-position: center;
		}
		
		body::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
            background-image: url('{{asset("storage/generals/background.jpg")}}');
			filter: blur(50%);
			z-index: -1;
		}
        .card {
            max-width: 500px;
            margin: 0 auto;
            margin-top: 100px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 30px;
        }
        .card-header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }
        .btn {
            width: 100%;
            margin-top: 20px;
        }
        img {
            max-width: 200px;
        }
    </style>
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-sm-12 my-auto">
                <div class="card">
                    <div class="card-header">{{ __('Welcome to Social Media Website') }}</div>

                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src='{{asset("storage/generals/logo.jpg")}}' class="rounded-circle shadow-4-strong" alt="Logo" width="250" height="260">
                        </div>
                        <div class="text-center mb-3">
                            <a href="{{ route('login.form') }}" class="btn btn-primary">{{ __('Login') }}</a>
                            <a href="{{ route('register.form') }}" class="btn btn-secondary">{{ __('Register') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>