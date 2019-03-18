@extends('layouts.main')
@section('content')
    <section id="login-register">
        <div class="container">
            <div class="login-register-wrapper">
                <div class="section-title">
                    <h2 class="title">Password Reset</h2>
                </div>
                <div class="login-form-inner">
                    @if (session('status'))
                        <div class="alert alert-success text-left" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('password.email') }}" method="POST" class="login-form">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="col-form-label">{{ __('E-Mail Address') }}
                                    <span style="color: red">{{ $errors->has('email') ? 'Error:'.$errors->first('email') : '' }}</span>
                                </label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>
                        <input type="submit" class="submit-btn" value="Send Password Reset Link">
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop