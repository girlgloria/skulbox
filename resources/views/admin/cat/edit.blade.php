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
                                    <h4 class="card-title">Edit <small></small></h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <form action="{{ route('category.update', $item->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="name">Category</label>
                                                        <input type="text" value="{{ $item->name }}" class="form-control" name="name" id="name" placeholder="Category">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <input type="text" value="{{ $item->description }}" name="description" class="form-control" id="description" placeholder="Description">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="btn btn-primary pull-right">Update</button>
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
