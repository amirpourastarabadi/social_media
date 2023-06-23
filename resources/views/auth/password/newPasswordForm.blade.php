@extends('layouts.app')


@section('main_content')
<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-sm-12 my-auto">
            <div class="card">

                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="" action="{{ route('api.password.update') }}" id="update-password-form">
                        @csrf
                        <div id="message" class="alert d-none"></div>
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
                                    <button class="btn btn-outline-secondary" type="button" id="show-password-confirmation-btn">
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

@endsection

@section('customize_js')
<script>
    var showPasswordBtn = document.getElementById('show-password-btn');
    var showPasswordConfirmBtn = document.getElementById('show-password-confirmation-btn');

    showPasswordBtn.addEventListener('click', function() {
        var passwordInput = document.getElementById('password');
        toggle_password_input(passwordInput)
    });
    showPasswordConfirmBtn.addEventListener('click', function() {
        var passwordConfirmInput = document.getElementById('password_confirmation');
        toggle_password_input(passwordConfirmInput)
    });
</script>
<script>
    $(document).ready(function() {
        $('#update-password-form').submit(function(event) {
            event.preventDefault()
            let form_data = $(this).serialize()

            $.ajax({
                url: "{{ route('api.password.update') }}",
                type: "PUT",
                data: form_data,
                success: function(response) {
                    console.log(response.message)
                    $('#message').html(response.message).removeClass('d-none alert-danger').addClass('alert-info');
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON)
                    $('#message').html(xhr.responseJSON.message).removeClass('d-none alert-info').addClass('alert-danger');
                }
            });
        });
    });
</script>
@endsection