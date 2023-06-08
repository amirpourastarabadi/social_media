<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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

                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="" action="{{ route('password.update') }}" id="update-password-form">
                            @csrf
                            <div class="alert d-none"></div>
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="input-group ">

                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="show-password-btn">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                <div class="input-group">
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="show-password-btn">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary" id="send-email-btn">{{ __('Update Password') }}</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#update-password-form').submit(function(event) {
                event.preventDefault()
                let form_data = $(this).serialize()

                $.ajax({
                    url: "{{ route('password.update') }}",
                    type: "PUT",
                    data: form_data,
                    success: function(response) {
                        $('#message').html(response.message).removeClass('d-none alert-danger').addClass('alert-info');
                    },
                    error: function(xhr) {
                        $('#message').html(xhr.responseJSON.message).removeClass('d-none alert-info').addClass('alert-danger');
                    }
                });
            });
        });
    </script>

</body>

</html>