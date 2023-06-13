<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social Media Website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

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
            /* margin-top: 20px; */
        }

        img {
            max-width: 200px;
        }
    </style>
</head>

<body>
    @yield('main_content')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function toggle_password_input(aPasswordInput) {
            if (aPasswordInput.type === 'password') {
                aPasswordInput.type = 'text';
                aPasswordInput.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                aPasswordInput.type = 'password';
                aPasswordInput.innerHTML = '<i class="fa fa-eye"></i>';
            }
        }
    </script>
    @yield('customize_js')
</body>

</html>