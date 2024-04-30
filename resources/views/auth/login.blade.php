<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gym System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include your backend CSS -->
    @include('backend.layouts.css')
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">

                        <div class="login-userheading">
                            <h3>Welcome To Gym Management System</h3>
                        </div>
                        <!-- Your form content -->
                        <div class="card">

                            <div class="card-body">
                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="form-group form-check">
                                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                        <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                                    </div>
                                    <div class="mt-3 text-center">
                                        @if (Route::has('password.request'))
                                        <a class="text-sm text-gray-600" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                        @endif
                                    </div>


                                    <div class="form-login">
                                        <button type="submit" class="btn btn-login">{{ __('Log in') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End form content -->
                    </div>
                </div>
                <div class="login-img">
                    <img src="backend/assets/img/gallery-3.jpg" alt="img">
                </div>
            </div>
        </div>
    </div>

    <!-- Include your backend footer -->
    @include('backend.layouts.footer')

</body>

</html>
