@extends('layouts.main')
@section('content')
    <section class="product-details section-padding" style="margin-top: 16px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="">
                        <div class="slide-image" style="padding: 12px">
                            @if($content->background_path != null)
                            <img style="width: 590px; height: 600px" src="{{ asset('images/'.$content->background_path) }}" alt="" class="image">
                            @else
                                <img style="width: 590px; height: 600px" src="https://via.placeholder.com/150" alt="{{ $content->title }}">
                            @endif
                            {{--<div class="text-center">--}}
                            {{--<div class="btn-group" role="group" aria-label="Basic example">--}}
                            {{--<button type="button" class="btn btn-secondary"><b>Share</b></button>--}}
                            {{--<button type="button" class="btn btn-secondary">Fb</button>--}}
                            {{--<button type="button" class="btn btn-secondary">Twitter</button>--}}
                            {{--<button type="button" class="btn btn-secondary">Whatsapp</button>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-details-content">
                        <h2 class="prod-name">{{ ucwords($content->title) }}</h2>
                        <span class="price">
						@if($content->cost != null && $content->cost > 0)
                                <ins><h2>KES {{ number_format($content->cost,2) }}</h2></ins>
                            @else
                                <ins><h2>FREE</h2></ins>
                            @endif
					</span>
                        <div class="product-cat">
                            <span>Categories:</span>
                            @foreach($content->categories as $category)
                                <a href="">{{ ucwords($category->name) }},</a>
                            @endforeach
                        </div>
                        <h5>Description</h5>

                        <p class="description">
                            {{ ucfirst($content->description) }}
                        </p>
                        <div class="cart-inner">
                            <div class="col-md-6">
                                @if(($content->cost != null && $content->cost > 0) && !$canDownload)
                                    <button id="btn-payment" onclick="payment()" class="btn btn-outline-primary btn-block">Buy</button>
                                
                                    <div class="col-md-12" id="payment" hidden>
                                        <form action="{{ route('content.purchase', $content->id) }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group" style="width: 100%">
                                                    <label for="new_number"><small class="color-black">You can change the Mpesa Number</small></label>
                                                    <input type="text" class="form-control" name="new_number" value="{{ \Illuminate\Support\Facades\Auth::user()->phone_no }}" id="new_number">
                                                </div>
                                                {{--<input type="hidden" value="{{ json_encode($data) }}" name="data">--}}
                                                <button class="btn btn-primary text-right" type="submit">Confirm Payment</button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <a href="{{ route('content.download', $content)  }}" class="btn btn-outline-primary btn-block">Download</a>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="specification">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <i class="fas fa-user fa-3x"></i>
                                                <hr>
                                                <h4>{{ ucwords($content->user->name) }}</h4>
                                                <h4><a href="{{ route('explore.index',['creator' => $content->user->id]) }}" class="btn-outline-primary btn-block btn btn-sm">Resources</a></h4>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="specification">
                                        <ul>
                                            @if($content->cost != null && $content->cost > 1)
                                                <li> <b>Sales : </b> {{ $content->number_of_sales }} </li>
                                            @endif
                                            <li> <b>Downloads: </b> {{ $content->number_of_download }} </li>
                                            <li> <b>Last Updated : </b> {{ \Carbon\Carbon::parse($content->updated_at)->format('d-M-y') }} </li>
                                            <li> <b>Created : </b> {{ \Carbon\Carbon::parse($content->created_at)->format('d-M-y') }} </li>
                                        </ul>
                                    </div>
                                    <div class="cart-inner">
                                        <button class="btn btn-block btn-outline-danger" onclick="report()">Report</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="report" hidden>
                            <form action="{{ route('report.content') }}" method="post">
                                @csrf
                                <input type="hidden" name="content_id" value="{{ $content->id }}" id="content_id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="report">What's the problem</label>
                                        <textarea name="report" id="report" class="form-control" required cols="30" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-danger">Report</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partial.frontend.footer')
@endsection
@section('scripts')
    <script>
        function report() {
            console.log(document.getElementById('report').hidden);
            if (document.getElementById('report').hidden == true){

                document.getElementById('report').hidden = false;
            }
            else {
                document.getElementById('report').hidden = true;
            }
        }

        function payment() {
            if (document.getElementById('payment').hidden == true){

                document.getElementById('payment').hidden = false;
                $('#btn-payment').html('Cancel');
                $('#btn-payment').addClass('btn-outline-danger','btn-block');
                $('#btn-payment').removeClass('btn-outline-success','btn-block');

            }
            else {
                document.getElementById('payment').hidden = true;
                $('#btn-payment').removeClass('btn-outline-danger','btn-block');
                $('#btn-payment').addClass('btn-outline-success','btn-block');
                $('#btn-payment').html('Buy');

            }
        }
    </script>
@endsection