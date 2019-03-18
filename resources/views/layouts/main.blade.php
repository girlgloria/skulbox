<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', env('APP_NAME'))</title>

    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon.png">
    <link rel="stylesheet" href="{{ asset('dependencies/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/swiper/css/swiper.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/slick-carousel/css/slick.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/magnific-popup/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/jquery-ui/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" type="text/css">
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700%7CRaleway:300,400,500,600,700,800,900" rel="stylesheet">
</head>

<body id="home-version-1" class="home-version-1" data-style="default">

<a href="{{ \Illuminate\Support\Facades\Request::path() }}#main_content" data-type="section-switch" class="return-to-top">
    <i class="fa fa-chevron-up"></i>
</a>

{{--<div class="page-loader">--}}
{{--<div class="loader animation-1">--}}
{{--<div class="shape shape1"></div>--}}
{{--<div class="shape shape2"></div>--}}
{{--<div class="shape shape3"></div>--}}
{{--<div class="shape shape4"></div>--}}
{{--</div>--}}
{{--</div>--}}
<div id="main_content">
    <header class="site-header gp-header-sticky" id="top">
        <div class="container">
            <div class="heder-inner">
                <div class="site-logo">
                    <a href="{{ route('index') }}" class="logo">
                        <img src="{{ asset('img/logo-big.png') }}" alt="site logo" class="logo-main">
                        <img src="{{ asset('img/logo-big.png') }}" alt="site logo" class="logo-sticky">
                    </a>
                </div>
                <nav class="site-nav nav-three">
                    <div id="nav-toggle" class="nav-toggle hidden-md">
                        <div class="toggle-inner">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <ul class="site-main-menu" >
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="{{ route('explore.index') }}">Resources</a></li>
                        <li><a href="{{ route('explore.creators') }}">Creators</a></li>
                        @guest
                            <li><a href="{{ url('/') }}#about">About</a></li>
                            <li><a href="{{ route('creator.register') }}" class="btn btn-success" style="color: white;">Become A Creator</a></li>
                        @else
                            @if(auth()->user()->user_type == config('studentbox.user_type.normal'))
                                <li><a href="{{ route('order.content') }}" class="btn btn-primary" style="color: white;">Order Content</a></li>
                                <li><a href="{{ route('upload.content') }}" class="btn btn-success" style="color: white;">Upload Content</a></li>
                            @endif
                        @endguest
                        @guest
                            <li><a href="{{ route('login') }}" class="btn btn-outline-primary" style="margin-right: 2px; margin-left: 2px;">Login</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary" style="margin-right: 2px; margin-left: 2px;">Register</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user"></i> {{ ucwords(mb_strimwidth(Auth::user()->name, 0,8,"..")) }} <i class="fa fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right background-color-pri" aria-labelledby="navbarDropdown">
                                    @if(auth()->user()->user_type == config('studentbox.user_type.admin') || auth()->user()->user_type == config('studentbox.user_type.agent'))
                                        <a href="{{ url('/') }}" class="dropdown-item">Dashboard</a>
                                    @else
                                        @if(count(\Illuminate\Support\Facades\Auth::user()->groups) > 0)
                                            <a href="{{ route('group.my') }}" class="dropdown-item">My Groups</a>
                                        @else
                                            <a href="{{ route('group.create') }}" class="dropdown-item">Create Group</a>
                                        @endif
                                        <a href="{{ route('orders.my') }}" class="dropdown-item">My Orders</a>
                                        <a href="{{ route('resources.my') }}" class="dropdown-item">My Resources</a>
                                        {{--<a href="{{ route('orders.my') }}" class="dropdown-item">My Statement</a>--}}
                                        <a class="dropdown-item white-color" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @endif
                                </div>
                            </li>
                        @endguest
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    @yield('content')
</div>
<script src="{{ asset('dependencies/popper.js/popper.min.js') }}"></script>
<script src="{{ asset('dependencies/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dependencies/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('dependencies/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dependencies/swiper/js/swiper.jquery.min.js') }}"></script>
<script src="{{ asset('dependencies/swiperRunner/js/swiperRunner.min.js') }}"></script>
<script src="{{ asset('dependencies/jquery.appear/jquery.appear.js') }}"></script>
<script src="{{ asset('dependencies/wow/js/wow.min.js') }}"></script>
<script src="{{ asset('dependencies/slick-carousel/js/slick.min.js') }}"></script>
<script src="{{ asset('dependencies/tilt.js/js/tilt.jquery.js') }}"></script>
<script src="{{ asset('dependencies/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('dependencies/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('dependencies/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('dependencies/datepair.js/js/datepair.js') }}"></script>
<script src="{{ asset('dependencies/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('js/iziToast.js') }}"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
@include('vendor.lara-izitoast.toast')
<script src="{{ asset('assets/js/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('assets/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('assets/js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
<script>
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        startDate: '-0d',
        autoclose: true
    });
</script>
<script>
    var $ = window.$; // use the global jQuery instance

    var $uploadList = $("#file-upload-list");
    var $fileUpload = $('#fileupload');
    var url = $fileUpload.attr('data-url');
    if ($uploadList.length > 0 && $fileUpload.length > 0) {

        var idSequence = 0;

        // A quick way setup - url is taken from the html tag
        $fileUpload.fileupload({
            maxChunkSize: 1000000,
            method: "POST",
            // Not supported
            sequentialUploads: false,
            formData: function (form) {
                // Append token to the request - required for web routes
                return [{name: '_token', value: $('input[name=_token]').val()}];
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $("#" + data.theId).text('Uploading ' + progress + '%');
                $('#fileupload').attr('disabled',true);
            },
            add: function (e, data) {
                data._progress.theId = 'id_' + idSequence;
                idSequence++;
                $uploadList.empty().append($('<li id="' + data.theId + '"></li>').text('Uploading'));

                data.submit();
            },
            done: function (e, data) {
                console.log('hello');
                $('#file').val(data.result.path+data.result.name);
                $('#type').val(data.result.type);
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@yield('scripts')
</body>
</html>