<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Registration</title>
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
                    <div class="card-header">{{ __('Registration Form') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('login.form') }}">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>