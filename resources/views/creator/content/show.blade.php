@extends('layouts.backend')
@section('content')
    <div class="wrapper">
        @include('partial.admin.nav-header')
        @include('partial.admin.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Resources</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-10 offset-1">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">View</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h2>{{ ucwords($item->title) }}</h2>
                                                <hr>
                                                <h2>Categories</h2>
                                                <div class="form-group">
                                                    <div class="selectgroup selectgroup-pills">
                                                        @foreach($item->categories as $cat)
                                                            <label class="selectgroup-item">
                                                                <input type="checkbox" name="categories[]" value="{{ $cat->id }}" class="selectgroup-input">
                                                                <span class="selectgroup-button">{{ ucwords($cat->name) }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <h3><b>Description</b></h3>
                                                <p>{{ ucfirst($item->description) }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <h2><b>Content Type</b>: {{ ucwords($item->content_type) }}</h2>
                                                <h2><b>Price</b>: {{ number_format($item->cost,2) }}</h2>
                                                <h2><b>Link</b>: <a href="{{ storage_path().'/app/'.$item->content_path }}">Resource Link</a></h2>
                                                <h2><b>Created On</b>: {{ \Carbon\Carbon::parse($item->created_at)->format('d-M-y') }}</h2>
                                                <h2><b>Updated On</b>: {{ \Carbon\Carbon::parse($item->updated_at)->format('d-M-y') }}</h2>
                                                <hr>
                                                <form action="{{ route('resource.delete', $item->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <a href="{{ route('resource.edit', $item->id) }}" class="btn btn-xs btn-info">Edit</a>
                                                    <button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete(this)">Delete</button>
                                                </form>
                                            </div>
                                        </div>
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
