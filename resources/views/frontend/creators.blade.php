@extends('layouts.main')
@section('content')
    <section id="jobs">
        <div class="container">
            <div class="section-title" style="margin-top: 35px;">
                <h2 class="title">Awesome Creators</h2>
                <p>
                    Do What You Love Share And Get Paid For IT
                </p>
                {{--<div class="col-md-12 text-center">--}}
                    {{--<a href="{{ route('creator.register') }}" class="btn btn-success">Become A Creator</a>--}}
                {{--</div>--}}
            </div>
            <div class="row">
                @foreach($creators as $creator)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-cube"></i>
                                    <h4>{{ ucwords($creator->name) }}</h4>
                                    <table class="table table">
                                        <tbody>
                                        <tr>
                                            <td>Total Download</td>
                                            <td>{{ $creator->contents()->sum('number_of_download')  }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Sales</td>
                                            {{--<td>{{ $creator->contents()->sum('number_of_sales')  }}</td>--}}
                                        </tr>
                                        </tbody>
                                    </table>
                                    <h4><a href="{{ route('explore.index',['creator' => $creator->id]) }}" class="btn btn-block btn-outline-primary">View Resources</a></h4>
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