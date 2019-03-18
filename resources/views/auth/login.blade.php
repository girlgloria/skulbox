@extends('layouts.main')
@section('content')
    <section id="login-register">
        <div class="container">
            <div class="login-register-wrapper">
                <div class="section-title">
                    <h2 class="title">Sign in Your Account</h2>
                </div>
                <div class="login-form-inner">
                    <form action="{{ route('login') }}" method="POST" class="login-form">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="col-form-label ">{{ __('E-Mail Address') }}
                                    <span style="color: red">{{ $errors->has('email') ? 'Error:'.$errors->first('email') : '' }}</span>
                                </label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password" class="col-form-label">{{ __('Password') }}
                                    <span style="color: red">{{ $errors->has('password') ? 'Error:'.$errors->first('password') : '' }}</span>
                                </label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <input type="submit" class="submit-btn" value="Login">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>

                    <span class="separator">Or Register Account</span>

                    {{--<ul class="social-login">--}}
                    {{--<li><a href="login-register.html#"><i class="fa fa-facebook"></i></a></li>--}}
                    {{--<li><a href="login-register.html#"><i class="fa fa-twitter"></i></a></li>--}}
                    {{--<li><a href="login-register.html#"><i class="fa fa-google-plus"></i></a></li>--}}
                    {{--</ul>--}}

                    <p>Don’t have an account? <a href="{{ url('/register') }}">Sign up Here.</a></p>

                </div>
            </div>
        </div>
    </section>
@stop