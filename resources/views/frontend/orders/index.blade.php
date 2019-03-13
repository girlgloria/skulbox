@extends('layouts.main')
@section('content')
    <section id="jobs">
        <div class="container">
            <div class="section-title" style="margin-top: 35px;">
                <h2 class="title">My Orders</h2>
                <div class="col-md-12 text-center">
                    <div class="text-center">
                        {{--<div class="btn-group" role="group" aria-label="" >--}}
                            <a style="margin-top: 4px" href="{{ route('order.content') }}" class="btn btn-success">
                                <b style="color: white">New Order</b></a>
                            <a style="margin-top: 4px" href="{{ route('orders.my',['status' => 'accepted']) }}"  class="btn btn-primary"><b style="color: white">Active</b></a>
                            <a style="margin-top: 4px" href="{{ route('orders.my',['status' => 'bid']) }}"  class="btn btn-success"><b style="color: white">Bids</b></a>
                            <a style="margin-top: 4px" href="{{ route('orders.my',['status' => 'paid']) }}"  class="btn btn-warning"><b style="color: white">Pending</b></a>
                            <a style="margin-top: 4px" href="{{ route('orders.my',['status' => 'pending-payment']) }}"  class="btn btn-danger"><b style="color: white">Pending Payment</b></a>
                            <a style="margin-top: 4px" href="{{ route('orders.my',['status' => 'completed']) }}"  class="btn btn-success"><b style="color: white">Completed</b></a>
                            <a style="margin-top: 4px" href="{{ route('orders.my',['status' => 'cancelled']) }}"  class="btn btn-primary"><b style="color: white">Cancelled</b></a>
                        {{--</div>--}}
                    </div>
                </div>
            </div>
            <div class="col-md-12 table-responsive">
                @if(count($items->where('status', config('studentbox.request-status.requested-pending-payment'))) > 0)
                    <h3>Orders Pending Payment</h3>
                    <table class="table table-condensed table-stripped">
                        @include('frontend.orders.partials.table-header')
                        <tbody>
                        @foreach($items->where('status', config('studentbox.request-status.requested-pending-payment')) as $item)
                            @include('frontend.orders.partials.table')
                        @endforeach
                        </tbody>
                    </table>
                @elseif(count($items->where('status', config('studentbox.request-status.bid'))) > 0)
                    <h3>Bid Orders</h3>
                    <table class="table table-condensed table-stripped">
                        @include('frontend.orders.partials.table-header')
                        <tbody>
                        @foreach($items as $item)
                            @include('frontend.orders.partials.table')
                        @endforeach
                        </tbody>
                    </table>
                @elseif(count($items->where('status', config('studentbox.request-status.accepted'))) > 0)
                    <h3>Active Orders</h3>
                    <table class="table table-condensed table-stripped">
                        @include('frontend.orders.partials.table-header')
                        <tbody>
                        @foreach($items->where('status', config('studentbox.request-status.requested-paid')) as $item)
                            @include('frontend.orders.partials.table')
                        @endforeach
                        </tbody>
                    </table>
                @else
                    @if($title != null)
                        <h3>{{ ucwords(str_replace('-',' ', $title)) }} Orders</h3>
                        <table class="table table-condensed table-stripped">
                            @include('frontend.orders.partials.table-header')
                            <tbody>
                            @foreach($items as $item)
                                @include('frontend.orders.partials.table')
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                @endif
            </div>
        </div>
    </section>
    @include('partial.frontend.footer')
@stop