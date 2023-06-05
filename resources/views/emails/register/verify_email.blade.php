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
            <div class="col-md-12 d-flex justify-content-center">
                <h1 class="text-center">Welcome to {{config('app.name')}}!</h1>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-12 d-flex justify-content-center">
                <h4>
                    Dear '{{$user->name}}' Thanks for registering on our website. We're excited to have you onboard!
                </h4>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <h5>Please click the button below to verify your email address</h5>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-12 text-center">
                <a href="{{$user->email_verification_link}}" class="btn btn-primary btn-lg disabled" role="button" aria-disabled="true">
                    Verify Email Address
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