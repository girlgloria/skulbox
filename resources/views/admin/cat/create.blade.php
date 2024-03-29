@extends('layouts.backend')
@section('content')
    <div class="wrapper">
        @include('partial.admin.nav-header')
        @include('partial.admin.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Categories</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-8 offset-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Category</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        {{--<div class="col-md-12">--}}
                                            {{--@include('partial.errors')--}}
                                        {{--</div>--}}
                                        <form action="{{ route('category.store') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                                        <label for="name">Category</label>
                                                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="Category">
                                                        @if($errors->has('name'))
                                                            <span class="form-text text-muted">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                                        <label for="description">Description</label>
                                                        <input type="text" name="description" value="{{ old('description') }}" class="form-control" id="description" placeholder="Description">
                                                        @if($errors->has('name'))
                                                            <span class="form-text text-muted">{{ $errors->first('description') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="btn btn-primary pull-right">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partial.admin.footer')
        </div>
    </div>
@endsection
