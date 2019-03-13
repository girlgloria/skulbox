@extends('layouts.backend')
@section('content')
    <div class="wrapper">
        @include('partial.admin.nav-header')
        @include('partial.admin.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Request</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">View Request</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h2>{{ ucwords($item->content->title) }}</h2>
                                                    </div>
                                                    <div class="card-body">
                                                        <h2>Categories</h2>
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
                                                        <h3><b>Instruction</b></h3>
                                                        <p>{{ ucfirst($item->content->description) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h1><b>Offer</b>: <button type="button" class="btn  btn-outline-primary">KES {{ number_format($item->content->cost,2) }}</button></h1>
                                                    </div>
                                                    <div class="card-body">
                                                        <h2><b>Content Type</b>: {{ ucwords($item->content->type) }}</h2>
                                                        @if($item->doc_link != null)
                                                            <h2><b>Project Doc</b>: <a href="{{ route('content.download.request', $item->id) }}" class="btn btn-sm btn-primary">Download Now</a></h2>
                                                        @endif
                                                        <h2><b>Start On</b>: {{ \Carbon\Carbon::parse($item->start_date)->format('d-M-y') }}</h2>
                                                        <h2><b>Due On</b>: {{ \Carbon\Carbon::parse($item->due_date)->format('d-M-y') }}</h2>
                                                        @if($item->accepted_at != null)
                                                            <h2><b>Accepted On</b>: {{ \Carbon\Carbon::parse($item->accepted_at)->format('d-M-y') }}</h2>
                                                        @endif
                                                        @if($item->completed_at != null)
                                                            <h2><b>Completed On</b>: {{ \Carbon\Carbon::parse($item->completed_at)->format('d-M-y') }}</h2>
                                                        @endif
                                                        {{--@if($item->cancelled_at != null)--}}
                                                        {{--<h2><b>Cancelled On</b>: {{ \Carbon\Carbon::parse($item->cancelled_at)->format('d-M-y') }}</h2>--}}
                                                        {{--@endif--}}
                                                        <hr>
                                                        <div class="col-sm-6 offset-3">
                                                            <button id="bid-btn" class="btn btn-outline-success btn-block" onclick="report()">Place Bid</button>
                                                        </div>
                                                        <div class="col-md-12" id="report" hidden>
                                                            <form action="{{ route('creator.requests.bid', $item->id) }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="request_id" value="{{ $item->id }}" id="content_id">
                                                                <div class="form-group">
                                                                    <label for="amount">Quote Your Amount <br> <small class="pull-right">{Client Amount KES {{ number_format($item->content->cost,2) }}}</small></label>
                                                                    <input type="number" min="150" name="amount" id="amount" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="reason">Why do you quote the above amount</label>
                                                                    <textarea name="reason" id="reason" class="form-control" required cols="30" rows="4"></textarea>
                                                                </div>
                                                                <div class="col-md-12 text-right">
                                                                        <button class="btn btn-success">Submit Bid</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
@section('scripts')
    <script>
        function report() {
            console.log(document.getElementById('report').hidden);
            if (document.getElementById('report').hidden == true){

                document.getElementById('report').hidden = false;
                $('#bid-btn').html('Cancel Bid');
                $('#bid-btn').removeClass('btn-outline-success','btn-block');
                $('#bid-btn').addClass('btn-outline-danger','btn-block');

            }
            else {
                document.getElementById('report').hidden = true;
                $('#bid-btn').html('Place Bid');
                $('#bid-btn').removeClass('btn-outline-danger','btn-block');
                $('#bid-btn').addClass('btn-outline-success','btn-block');
            }
        }
    </script>
@endsection
