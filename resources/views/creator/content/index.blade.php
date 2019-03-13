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
                                                @if(\Illuminate\Support\Facades\Auth::user()->user_type == config('studentbox.user_type.admin'))
                                                    <th>Uploaded By</th>
                                                @endif
                                                <th>Title</th>
                                                <th>Resource Type</th>
                                                <th>Resource</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Created On</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == config('studentbox.user_type.admin'))
                                                        <td>{{ ucwords($item->user->name) }}</td>
                                                    @endif
                                                    <td>{{ ucfirst($item->title) }}</td>
                                                    <td>{{ ucfirst($item->content_type) }}</td>
                                                    <td><a href="{{ storage_path().'app/'.$item->content_path }}" target="_parent">Download</a></td>
                                                    <td>{{ mb_strimwidth(ucfirst($item->description), 0, 18, '...') }}</td>
                                                    <td>{{ number_format($item->cost,2) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-M-y') }}</td>
                                                    <td class="text-right">
                                                        <form action="{{ route('resource.delete', $item) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <a href="{{ route('resource.edit', $item) }}" class="btn btn-xs btn-info">Edit</a>
                                                            <a href="{{ route('resource.show', $item) }}" class="btn btn-xs btn-success">view</a>
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
