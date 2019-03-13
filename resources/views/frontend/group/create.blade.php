@extends('layouts.main')
@section('content')
    <section id="login-register">
        <div class="container">
            <div class="login-register-wrapper">
                <div class="section-title">
                    <h2 class="title">Create Group</h2>
                </div>
                <div class="login-form-inner">
                    <form action="{{ route('group.store') }}" method="POST" class="login-form">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="col-form-label text-md-right color-black">{{ __('Group Name') }}</label>
                                <span style="color: red">{{ $errors->has('name') ? 'Error:'.$errors->first('Group Name') : '' }}</span>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                       required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="description" class="col-form-label text-md-right color-black">{{ __('Description') }}</label>
                                <span style="color: red">{{ $errors->has('description') ? 'Error:'.$errors->first('Description') : '' }}</span>
                                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}"
                                       required autofocus>
                            </div>
                        </div>
                        <input type="submit" class="submit-btn" value="Create">
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
