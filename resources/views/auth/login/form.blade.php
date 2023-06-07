<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>

<div class="container">
  <div class="row mt-5">
    <div class="col-md-4 offset-md-4">
      <div class="card">
        <div class="card-header">
          Login
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" id="show-password-btn">
                    <i class="fa fa-eye"></i>
                  </button>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <div class="mt-3">
              <a href="{{ route('password.request') }}">Forgot your password?</a>
            </div>
            <div class="mt-3">
              <a href="{{ route('register.form') }}">Create an account</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
  var passwordInput = document.getElementById('password');
  var showPasswordBtn = document.getElementById('show-password-btn');
  
  showPasswordBtn.addEventListener('click', function() {
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      showPasswordBtn.innerHTML = '<i class="fa fa-eye-slash"></i>';
    } else {
      passwordInput.type = 'password';
      showPasswordBtn.innerHTML = '<i class="fa fa-eye"></i>';
    }
  });
</script>
</body>
</html>