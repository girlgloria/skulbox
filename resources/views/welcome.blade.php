@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center white-color padding-top">
                {{ env('APP_NAME') }} is a perfect decentralized way to share LEARNING resources.
            </h2>
        </div>
        <div class="col-md-6">
            <div class="card" style="margin-top: 26px">
                <div class="card-header text-center"><b>Explore</b></div>
                <div class="card-body">
                    <ul>
                        <li>Find unlimited learning resources</li>
                        <li>Manage your content</li>
                        <li>Share content</li>
                        <li>Request resources</li>
                        <li>Upload files</li>
                        <li>Create learning group</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="" class="btn btn-primary">Explore</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="margin-top: 26px">
                <div class="card-header text-center"><b>Share And Earn</b></div>
                <div class="card-body">
                    <ul>
                        
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="" class="btn btn-primary">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
