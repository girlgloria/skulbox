@extends('layouts.main')
@section('content')
    <section id="login-register">
        <div class="container">
            <div class="login-register-wrapper">
                <div class="section-title">
                    <h2 class="title">Choose Categories </h2>
                </div>
                <div class="login-form-inner">
                    <form action="{{ route('creator.choices.store') }}" method="POST" class="login-form">
                        @csrf
                        <p><b>Which resource categories do you create for?</b></p>
                        <div class="selectgroup selectgroup-pills">
                            @foreach($cats as $cat)
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="categories[]" value="{{ $cat->id }}" class="selectgroup-input">
                                    <span class="selectgroup-button">{{ ucwords($cat->name) }}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="col-md-6 offset-3" style="margin-top: 18px;">
                            <input type="submit" class="btn btn-outline-primary btn-block" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop