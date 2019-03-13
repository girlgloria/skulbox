@extends('layouts.backend')
@section('content')
    <div class="wrapper">
        @include('partial.admin.nav-header')
        @include('partial.admin.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Bids</h4>
                    </div>
                    <div class="col-md-10 offset-1">
                        @foreach($items as $item)
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Client: {{ ucwords($item->request->user->name) }} <b class="pull-right">Offer Amount: <button class="btn btn-outline-primary" disabled>KES {{ number_format($item->request->content->cost, 2) }}</button> Bid Amount: <button class="btn btn-outline-primary" disabled>KES {{ number_format($item->offer, 2) }}</button></b></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body">
                                            <h5><b>Project Title</b>: {{ ucwords($item->request->content->title) }}</h5>
                                            <h5><b>Project Description</b></h5>
                                            <p>{{ ucfirst($item->request->content->description) }}</p>
                                            <hr>
                                            <h5><b>Bid Reason</b></h5>
                                            <p>{{ ucfirst($item->reason) }}</p>
                                        </div>
                                    </div>
                                    @if($item->satus == config('studentbox.request-offer-status.accepted'))
                                        <div class="card-footer text-right">
                                            <a href="{{ route('bids.action',['offer_id' => $item->id, 'status' => config('studentbox.request-offer-status.declined')]) }}" class="btn btn-danger btn-sm">Decline</a>
                                            <a href="{{ route('bids.action', ['offer_id' => $item->id, 'status' => config('studentbox.request-offer-status.confirmed')]) }}" class="btn btn-primary btn-sm">Confirm</a>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @include('partial.admin.footer')
        </div>
    </div>
@endsection