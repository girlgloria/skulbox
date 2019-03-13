@extends('layouts.main')
@section('content')
    <section id="jobs">
        <div class="container">
            <div class="section-title" style="margin-top: 35px;">
                <h2 class="title">Order Detail</h2>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h2>{{ ucwords($item->content->title) }}</h2>
                            </div>
                            <div class="card-body">
                                <div class="checkout-total">
                                    <h3 class="title">Category</h3>
                                    <div class="form-group">
                                        <div class="selectgroup selectgroup-pills">
                                            @foreach($item->content->categories as $cat)
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="categories[]" value="{{ $cat->id }}" checked disabled class="selectgroup-input">
                                                    <span class="selectgroup-button">{{ ucwords($cat->name) }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                    <h3 class="title">Instruction</h3>
                                    <p>{{ ucfirst($item->content->description) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="payment-type">
                            <div class="card">
                                <div class="card-header">
                                    <h2>Offer: KES {{ number_format($item->content->cost,2) }}</h2>
                                </div>
                                <div class="card-body">
                                    <p><b>Content Type:</b> {{ ucwords($item->content->type) }}</p>
                                    <p><b>Project Doc: </b><a href="{{ route('content.download.request', $item->id) }}" class="btn btn-primary btn-sm">Download here</a></p>
                                    <p><b>Start On:</b> {{ \Carbon\Carbon::parse($item->start_date)->format('d-M-y') }}</p>
                                    <p><b>Due On:</b> {{ \Carbon\Carbon::parse($item->due_date)->format('d-M-y') }}</p>
                                    @if($item->accepted_at != null)
                                    <p><b>Accepted On:</b> {{ \Carbon\Carbon::parse($item->accepted_at)->format('d-M-y') }}</p>
                                    @endif
                                    @if($item->completed_at != null)
                                    <p><b>Completed On:</b> {{ \Carbon\Carbon::parse($item->completed_at)->format('d-M-y') }}</p>
                                    @endif
                                    @if($item->cancelled_at != null)
                                    <p><b>Cancelled On:</b> {{ \Carbon\Carbon::parse($item->cancelled_at)->format('d-M-y') }}</p>
                                    @endif
                                        <hr>
                                    <div class="col-md-12 text-right">
                                            @csrf
                                            <input type="hidden" name="data">
                                            <a href="{{ url('/') }}" class="btn btn-warning">Edit</a>
                                            <a href="{{ url('/') }}" class="btn btn-danger">Cancel</a>
                                            <a href="{{ route('orders.bids', $item->id) }}" class="btn btn-primary">View Bids</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partial.frontend.footer')
@stop