<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User Profile</title>
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
          <div class="card-header">{{ __('Login') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('login') }}" id='login-form'>
              @csrf
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group ">
                  <input type="password" class="form-control" id="password" name="password" required>
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="show-password-btn">
                      <i class="fa fa-eye"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="alert text-danger" id='alert-message'></div>
              <button type="submit" class="btn btn-primary my-3" id="login-button">Login</button>
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

  <script>
    const submitButton = document.querySelector('#login-button');
    const form = document.querySelector('#login-form');
    const loginUrl = "{{route('login')}}"
    // Add an event listener to the form submit event
    form.addEventListener('submit', event => {
      // Prevent the default form submission behavior
      event.preventDefault();
      fetch(loginUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            email: form.querySelector('#email').value,
            password: form.querySelector('#password').value
          })
        })
        .then(response => response.json())
        .then(data => {
          // Store the JWT token in local storage
          localStorage.setItem('jwt_token', data.token);
        })
        .catch(error => {
          document.querySelector('#alert-message').innerText = 'amir'
          console.error('Error authenticating user:', error);
        });
    })
  </script>
</body>

</html>