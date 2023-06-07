<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>
    <div class="container my-5">
        <div class="row my-5">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <h1 class="text-center">{{config('app.name')}} </h1>
                <h3 class="text-danger ml-3"> {{trans('Password Reset')}}</h3>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <h1 class="text-center"></h1>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12 d-flex justify-content-center">
                <h4>
                    we received a request from you to reset your password.
                </h4>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-12 d-flex justify-content-center">
                <h5>Please click the button below to reset your password</h5>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-12 text-center">
                <a href="{{$user->reset_password_link}}" class="btn btn-primary btn-lg disabled" role="button" aria-disabled="true">
                    Reset Password
                </a>
            </div>

            <div class="col-md-12 text-center text-danger my-5">
                <p>
                    If this email is not from you, simply ignore it.
                </p>
            </div>
        </div>
    </div>
</body>

</html>