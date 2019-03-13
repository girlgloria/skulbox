@extends('layouts.backend')
@section('content')
    <div class="wrapper">
        @include('partial.admin.nav-header')
        @include('partial.admin.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Requests</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Requests</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <table class="table table-stripped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Content Type</th>
                                                <th>Offer</th>
                                                <th>Start Date</th>
                                                <th>Due Date</th>
                                                <th>Days Remaining</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucwords($item->content->title) }}</td>
                                                    <td>{{ ucwords($item->content->type) }}</td>
                                                    <td><b>KES {{ number_format($item->content->cost,2) }}</b></td>
                                                    <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d-M-y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->due_date)->format('d-M-y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->due_date)->diffForHumans() }}</td>
                                                    <td class="text-right">
                                                        <a href="{{ route('creator.requests.show', $item->id) }}" class="btn btn-sm btn-primary">View</a>
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