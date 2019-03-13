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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <table class="table table-stripped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Created On</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucwords($item->name) }}</td>
                                                    <td>{{ ucfirst($item->description) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-M-y') }}</td>
                                                    <td class="text-right">
                                                        <form action="{{ route('category.delete', $item) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <a href="{{ route('category.edit', $item) }}" class="btn btn-xs btn-info">Edit</a>
                                                            <button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete(this)">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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
