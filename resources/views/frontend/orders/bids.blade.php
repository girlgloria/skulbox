@extends('layouts.main')
@section('content')
    <section id="jobs">
        <div class="container">
            <div class="section-title" style="margin-top: 35px;">
                <h4 class="title">{{ $order->content->title }} Bids</h4>
                <div class="col-md-6 offset-3">
                    <hr>
                </div>
            </div>
            <div class="col-md-8 offset-2">
                <div class="row">
                    @foreach($bids->where('status', config('studentbox.request-offer-status.pending')) as $item)
                        <div class="col-md-12" style="margin-top: 16px">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Name: {{ ucwords($item->user->name) }}</h4>
                                </div>
                                <div class="card-body">
                                    <h5>Bid Amount: <button class="btn btn-outline-primary" disabled>KES {{ $item->offer }}</button></h5>
                                    <hr>
                                    <h5>Reason</h5>
                                    <p>{{ ucfirst($item->reason) }}</p>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="{{ route('bids.accept', $item->id) }}" class="btn btn-primary">Accept</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @include('partial.frontend.footer')
@stop