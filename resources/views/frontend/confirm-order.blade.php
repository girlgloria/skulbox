@extends('layouts.main')
@section('content')
    <section id="jobs">
        <div class="container">
            <div class="section-title" style="margin-top: 35px;">
                <h2 class="title">Confirm Order</h2>
            </div>
            <div class="col-md-10 offset-2">
                <div class="row">
                    <div class="col-md-7">
                        <div class="checkout-total">
                            <h3 class="title">Order Details</h3>

                            <p><b>Title:</b> {{ ucwords($data['title']) }}</p>
                            <p><b>Type:</b> {{ ucwords($data['type']) }}</p>
                            <p><b>Start Date:</b> {{ $data['start_date'] }}</p>
                            <p><b>Due Date:</b> {{ $data['due_date'] }}</p>
                            <p><b>Description:</b> {{ ucfirst($data['description']) }}</p>
                        </div>
                        <!-- /.checkout-total -->
                    </div>
                    <!-- /.col-md-6 -->

                    <div class="col-md-5">
                        <div class="payment-type">
                            <h3 class="title">Payment</h3>
                            <h4><b>Price:</b> KES {{ number_format($data['cost']) }}</h4>
                            <h4><b>Payment Method:</b>Mpesa</h4>
                            <h4><b>Mpesa Number:</b>{{ \Illuminate\Support\Facades\Auth::user()->phone_no }}</h4>
                            <hr>
                            <div class="col-md-12">
                                <form action="{{ route('order.payment') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="new_number" class="color-black">Change the Mpesa Phone Number</label>
                                        <input type="text" class="form-control" name="new_number" value="{{ \Illuminate\Support\Facades\Auth::user()->phone_no }}" id="new_number">
                                    </div>
                                    <input type="hidden" value="{{ json_encode($data) }}" name="data">
                                    <a href="{{ url('/') }}" class="btn btn-danger">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Confirm Payment</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partial.frontend.footer')
@stop