@extends('layouts.main')
@section('content')
    <section id="jobs">
        <div class="container">
            <div class="section-title" style="margin-top: 35px;">
                <h2 class="title">My Groups</h2>
                <div class="col-md-12 text-center">
                    {{--<a href="{{ route('group.create') }}" class="btn btn-success">Create Group</a>--}}
                </div>
            </div>
            <div class="row">
                @foreach($groups as $group)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <h3>{{ count($group->users) }}</h3>
                                    <h4>{{ ucwords($group->name) }}</h4>
                                    <h4><a href="{{ route('group.group', $group->name) }}">View Group</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('partial.frontend.footer')
@stop