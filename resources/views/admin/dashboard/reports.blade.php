@extends('layouts.backend')
@section('content')
    <div class="wrapper">
        @include('partial.admin.nav-header')
        @include('partial.admin.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Reports</h4>
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
                                                <th>Reported By</th>
                                                <th>Content</th>
                                                <th>Report</th>
                                                <th>Created On</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucwords($item->user->name) }}</td>
                                                    <td><a href="{{ route('content.show', $item->content->id) }}" class="">{{ ucwords($item->content->title) }}</a></td>
                                                    <td>{{ ucfirst($item->report) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-M-y') }}</td>
                                                    <td class="text-right">
                                                        <form action="{{ route('resource.delete', $item) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete(this)">Delete Content</button>
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
