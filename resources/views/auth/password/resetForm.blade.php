@extends('layouts.app')

@section('main_content')
<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-sm-12 my-auto">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="" id="request-email-form">
                        @csrf
                        <div class="alert d-none" id="message"></div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary" id="send-email-btn">{{ __('Send Mail') }}</button>
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
    $(document).ready(function() {
        $('#request-email-form').submit(function(event) {
            event.preventDefault()
            let form_data = $(this).serialize()

            $.ajax({
                url: "{{ route('password.reset.mail') }}",
                type: "POST",
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
@endsection