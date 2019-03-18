@extends('layouts.main')
@section('content')
    <section id="login-register">
        <div class="container">
            <div class="login-register-wrapper">
                <div class="section-title">
                    <h2 class="title">Register Account</h2>
                </div>
                <div class="login-form-inner">
                    <form action="{{ route('register') }}" method="POST" class="login-form">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="col-form-label">{{ __('Name') }}</label>
                                <span style="color: red">{{ $errors->has('name') ? 'Error:'.$errors->first('name') : '' }}</span>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>
                        @if(isset($userType))
                        <input type="hidden" name="user_type" value="{{ $userType }}">
                        @endif
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                                <span style="color: red">{{ $errors->has('email') ? 'Error:'.$errors->first('email') : '' }}</span>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="phone_no" class="col-form-label">{{ __('Phone Number') }}</label>
                                <span style="color: red">{{ $errors->has('phone_no') ? 'Error:'.$errors->first('phone_no') : '' }}</span>
                                <input id="phone_no" type="phone_number" class="form-control{{ $errors->has('phone_no') ? ' is-invalid' : '' }}" name="phone_no" value="{{ old('phone_no') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <span style="color: red">{{ $errors->has('password') ? 'Error:'.$errors->first('password') : '' }}</span>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <input type="submit" class="submit-btn" value="Register">
                    </form>

                    <span class="separator">Or Login</span>

                    {{--<ul class="social-login">--}}
                    {{--<li><a href="login-register.html#"><i class="fa fa-facebook"></i></a></li>--}}
                    {{--<li><a href="login-register.html#"><i class="fa fa-twitter"></i></a></li>--}}
                    {{--<li><a href="login-register.html#"><i class="fa fa-google-plus"></i></a></li>--}}
                    {{--</ul>--}}

                    <p>Already have an account? <a href="{{ route('login') }}">Login.</a></p>

                </div>
            </div>
        </div>
    </section>
@stop