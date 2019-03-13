@extends('layouts.main')
@section('content')
    <section class="product-details section-padding" style="margin-top: 16px;">
        <div class="container">
            <div class="section-title" style="margin-top: 35px;">
                <h2 class="title">{{ ucwords($group->name) }} Group</h2>
                <p>{{ ucfirst($group->description) }}</p>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Share Resource</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('group.share') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="resource">Choose 1 or more resources {Only resource uploaded by you}</label>
                                            <select class="form-control select2" multiple name="resource[]" id="resource" required>
                                                @foreach($resources as $resource)
                                                    @if($resource->content_path && !in_array($resource->id, $ids))
                                                        <option value="{{ $resource->id }}">{{ ucwords($resource->title) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" id="group_id" name="group_id" value="{{ $group->id }}">
                                        <button class="btn btn-primary pull-right">Share</button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <h4>Group Resources</h4>
                            <hr>
                            <table class="table table-stripped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Resource</th>
                                    <th>Created By</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($groupResources as $res)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucwords($res->title) }}</td>
                                        <td>{{ ucwords($res->user->name) }}</td>
                                        <td class="text-right">
                                            @if($res->content_path)
                                                <a href="{{ route('content.download', $res->id) }}">Download</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h4>Members</h4>
                            <hr>
                            <table class="table table-stripped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($group->users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucwords($user->name) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partial.frontend.footer')
@endsection