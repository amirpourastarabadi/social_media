@extends('layouts.app')

@section('main_content')
<div class="container-fluid h-100">
  <div class="row h-100">
    <div class="col-sm-12 my-auto">
      <div class="card">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('api.login') }}" id='login-form'>
            @csrf

            <div class="d-none" id="message"></div>
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
              <a href="{{ route('web.password.reset.request') }}">Forgot your password?</a>
            </div>
            <div class="mt-3">
              <a href="{{ route('web.register.form') }}">Create an account</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('customize_js')
<script>
  var showPasswordBtn = document.getElementById('show-password-btn');

  showPasswordBtn.addEventListener('click', function() {
    var passwordInput = document.getElementById('password');
    toggle_password_input(passwordInput)
  });
</script>

<script>
  $(document).ready(function() {
    $('#login-form').submit(function(event) {
      event.preventDefault()
      let form_data = $(this).serialize()
      console.log(form_data)
      $.ajax({
        url: "{{ route('api.login') }}",
        type: "POST",
        data: form_data,
        success: function(response) {
          window.location.href = "{{route('web.profile')}}"
        },
        error: function(xhr) {
          console.log('amir')
          $('#message').html(xhr.responseJSON.message).removeClass('d-none alert-info').addClass('alert-danger');
        }
      });
    });
  });
</script>@endsection