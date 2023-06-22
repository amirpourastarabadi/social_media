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
                <h1 class="text-center">You have a new connection in {{config('app.name')}}!</h1>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-12 d-flex justify-content-center">
                <h4>
                    There is a new connection from '{{$follower->name}}'
                </h4>
                <h4>
                    you can visit its profile
                    <a href="{{$follower->page_url}}" class="btn btn-primary btn-lg disabled" role="button" aria-disabled="true">
                        here
                    </a>
                </h4>
            </div>
        </div>
    </div>
</body>

</html>