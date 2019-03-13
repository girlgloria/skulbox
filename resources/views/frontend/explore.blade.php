@extends('layouts.main')
@section('content')
    <section id="products">
        <div class="container">
            <div class="section-title" style="margin-top: 35px;">
                <h2 class="title">
                    {{ isset($user) ? 'My' : '' }} Resources</h2>
                @if(isset($user))
                    <div class="text-center">
                        {{--<div class="btn-group" role="group" aria-label="" >--}}

                        <a style="margin-top: 4px" href="{{ route('resources.my',['type' => 'public']) }}" class="btn btn-success"><b style="color: white">Public</b></a>
                        <a style="margin-top: 4px" href="{{ route('resources.my',['type' => 'private']) }}" class="btn btn-primary"><b style="color: white">Private</b></a>
                        {{--</div>--}}
                    </div>
                    @endif
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @foreach($contents as $content)
                            <div class="col-lg-3 col-sm-6 width-half">
                                <div class="product">
                                    <div class="product-image" style="padding: 4px">
                                        <a href="{{ route('content.show', $content) }}">
                                            @if($content->background_path != null)
                                            <img style="width: 270px; height: 290px" src="{{ asset('images/thumbnail/'.$content->background_path) }}" alt="{{ $content->title }}">
                                            @else
                                                <img style="width: 270px; height: 290px" src="https://via.placeholder.com/150" alt="{{ $content->title }}">
                                                @endif
                                        </a>
                                        <div class="product-name text-left">
                                            <h3 class="title"><a href="">{{ ucwords(mb_strimwidth($content->title,0,19,"...")) }}</a></h3>
                                            <p>{{ ucwords(mb_strimwidth($content->description,0,19,'...')) }}</p>
                                            @if($content->cost != null && $content->cost > 0)
                                                <span class="price">KES {{ number_format($content->cost, 2) }}</span>
                                            @else
                                                <span class="price">FREE</span>
                                            @endif
                                            <a href="{{ route('content.show', $content) }}" class="btn btn-block btn-outline-primary">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- /.row -->

                    {{--<ul class="pagination">--}}
                    {{--<!-- <li class="prev"><a href="#"><i class="ti-angle-double-left"></i>Prev</a></li> -->--}}
                    {{--<li><a href="product-category.html#" class="active">1</a></li>--}}
                    {{--<li><a href="product-category.html#">2</a></li>--}}
                    {{--<li class="next"><a href="product-category.html#">Next <i class="ti-angle-double-right"></i></a></li>--}}
                    {{--</ul>--}}
                </div>
                <!-- /.col-lg-8 -->

            {{--<div class="col-lg-3">--}}
            {{--<div class="sidebar">--}}
            {{--<div id="categories" class="widget widget_categories">--}}
            {{--<h2 class="widget-title">Categories</h2>--}}

            {{--<ul class="gp_custom_menu">--}}
            {{--<li>--}}
            {{--<a href="product-category.html#">--}}
            {{--<span class="content">Clothing</span>--}}
            {{--<span class="sp-border"></span>--}}
            {{--<span class="count">15</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}

            {{--<a href="product-category.html#">--}}
            {{--<span class="content">T-shirt</span>--}}
            {{--<span class="sp-border"></span>--}}
            {{--<span class="count">10</span>--}}
            {{--</a>--}}

            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="product-category.html#">--}}
            {{--<span class="content">Electronics</span>--}}
            {{--<span class="sp-border"></span>--}}
            {{--<span class="count">11</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="product-category.html#">--}}
            {{--<span class="content">Baby Items</span>--}}
            {{--<span class="sp-border"></span>--}}
            {{--<span class="count">20</span>--}}
            {{--</a>--}}

            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="product-category.html#">--}}
            {{--<span class="content">Kids Toy</span>--}}
            {{--<span class="sp-border"></span>--}}
            {{--<span class="count">15</span>--}}
            {{--</a>--}}

            {{--</li>--}}
            {{--</ul>--}}

            {{--</div>--}}
            {{--<div id="about-widget" class="widget widget_price">--}}
            {{--<h2 class="widget-title">Filter By Price</h2>--}}

            {{--<div id="range-slider">--}}

            {{--<div id="slider-range"></div>--}}
            {{--<p>--}}
            {{--<input type="text" id="amount" readonly style="border:0;">--}}
            {{--</p>--}}
            {{--</div>--}}
            {{--<!-- close range-slider div -->--}}
            {{--</div>--}}
            {{--<div id="color" class="widget widget_color">--}}
            {{--<h2 class="widget-title">Filter by Color</h2>--}}

            {{--<ul class="gp_custom_menu">--}}
            {{--<li>--}}
            {{--<a href="product-category.html#">--}}
            {{--<span class="content">Red</span>--}}
            {{--<span class="sp-border"></span>--}}
            {{--<span class="count">15</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}

            {{--<a href="product-category.html#">--}}
            {{--<span class="content">Blue</span>--}}
            {{--<span class="sp-border"></span>--}}
            {{--<span class="count">10</span>--}}
            {{--</a>--}}

            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="product-category.html#">--}}
            {{--<span class="content">Black</span>--}}
            {{--<span class="sp-border"></span>--}}
            {{--<span class="count">11</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="product-category.html#">--}}
            {{--<span class="content">Orange</span>--}}
            {{--<span class="sp-border"></span>--}}
            {{--<span class="count">20</span>--}}
            {{--</a>--}}

            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="product-category.html#">--}}
            {{--<span class="content">Pink</span>--}}
            {{--<span class="sp-border"></span>--}}
            {{--<span class="count">15</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="product-category.html#">--}}
            {{--<span class="content">Violet</span>--}}
            {{--<span class="sp-border"></span>--}}
            {{--<span class="count">15</span>--}}
            {{--</a>--}}
            {{--</li>--}}

            {{--</ul>--}}
            {{--</div>--}}
            {{--<aside id="tags" class="widget widget_tag">--}}
            {{--<h3 class="widget-title">Popular Tags</h3>--}}
            {{--<div class="tagcloud">--}}
            {{--<a href="product-category.html#">blog</a>--}}
            {{--<a href="product-category.html#">personal</a>--}}
            {{--<a href="product-category.html#">funny</a>--}}
            {{--<a href="product-category.html#">project</a>--}}
            {{--<a href="product-category.html#">dribbble</a>--}}
            {{--<a href="product-category.html#">color</a>--}}
            {{--<a href="product-category.html#">photo</a>--}}
            {{--<a href="product-category.html#">behance</a>--}}
            {{--</div>--}}
            {{--</aside>--}}
            {{--<!-- /.widget -->--}}
            {{--</div>--}}
            {{--<!-- /.sidebar -->--}}
            {{--</div>--}}
            <!-- /.col-lg-3 -->
            </div>
            <!-- /.row -->

        {{--<div class="featured-products">--}}
        {{--<div class="row">--}}
        {{--<div class="col-lg-4 col-xl-3 col-md-6 ">--}}
        {{--<div class="feature-product-items">--}}
        {{--<h3>Best Sellers</h3>--}}
        {{--<div class="product-feature">--}}
        {{--<div class="product-thumb">--}}
        {{--<a href="product-category.html#"><img src="media/product/s1.jpg" alt="prod"></a>--}}
        {{--</div>--}}

        {{--<div class="content">--}}
        {{--<h4 class="product-name"><a href="product-category.html#">Latest Golf Bag</a></h4>--}}
        {{--<span class="price">$22.50</span>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.product-feature -->--}}

        {{--<div class="product-feature">--}}
        {{--<div class="product-thumb">--}}
        {{--<a href="product-category.html#"><img src="media/product/s2.jpg" alt="prod"></a>--}}
        {{--</div>--}}

        {{--<div class="content">--}}
        {{--<h4 class="product-name"><a href="product-category.html#">Latest Golf Bag</a></h4>--}}
        {{--<span class="price">$22.50</span>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.product-feature -->--}}

        {{--<div class="product-feature">--}}
        {{--<div class="product-thumb">--}}
        {{--<a href="product-category.html#"><img src="media/product/s3.jpg" alt="prod"></a>--}}
        {{--</div>--}}

        {{--<div class="content">--}}
        {{--<h4 class="product-name"><a href="product-category.html#">Beautiful lamp</a></h4>--}}
        {{--<span class="price">$22.50</span>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.product-feature -->--}}
        {{--</div>--}}
        {{--<!-- /.feature-product-items -->--}}
        {{--</div>--}}
        {{--<!-- /.col-lg-4 col-xl-3 col-md-6  -->--}}

        {{--<div class="col-lg-4 col-xl-3 col-md-6 ">--}}
        {{--<div class="feature-product-items">--}}
        {{--<h3>Upcomming</h3>--}}
        {{--<div class="product-feature">--}}
        {{--<div class="product-thumb">--}}
        {{--<a href="product-category.html#"><img src="media/product/s4.jpg" alt="prod"></a>--}}
        {{--</div>--}}

        {{--<div class="content">--}}
        {{--<h4 class="product-name"><a href="product-category.html#">Excellent Lamp</a></h4>--}}
        {{--<span class="price">$20.00</span>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.product-feature -->--}}

        {{--<div class="product-feature">--}}
        {{--<div class="product-thumb">--}}
        {{--<a href="product-category.html#"><img src="media/product/s5.jpg" alt="prod"></a>--}}
        {{--</div>--}}

        {{--<div class="content">--}}
        {{--<h4 class="product-name"><a href="product-category.html#">Blutooth Speaker</a></h4>--}}
        {{--<span class="price">$25.50</span>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.product-feature -->--}}

        {{--<div class="product-feature">--}}
        {{--<div class="product-thumb">--}}
        {{--<a href="product-category.html#"><img src="media/product/s6.jpg" alt="prod"></a>--}}
        {{--</div>--}}

        {{--<div class="content">--}}
        {{--<h4 class="product-name"><a href="product-category.html#">Beautiful lamp</a></h4>--}}
        {{--<span class="price">$30.50</span>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.product-feature -->--}}
        {{--</div>--}}
        {{--<!-- /.feature-product-items -->--}}
        {{--</div>--}}
        {{--<!-- /.col-lg-4 col-xl-3 col-md-6  -->--}}

        {{--<div class="col-lg-4 col-xl-3 col-md-6 ">--}}
        {{--<div class="feature-product-items">--}}
        {{--<h3>Featured</h3>--}}
        {{--<div class="product-feature">--}}
        {{--<div class="product-thumb">--}}
        {{--<a href="product-category.html#"><img src="media/product/s7.jpg" alt="prod"></a>--}}
        {{--</div>--}}

        {{--<div class="content">--}}
        {{--<h4 class="product-name"><a href="product-category.html#">Wireless Speaker</a></h4>--}}
        {{--<span class="price">$30.50</span>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.product-feature -->--}}

        {{--<div class="product-feature">--}}
        {{--<div class="product-thumb">--}}
        {{--<a href="product-category.html#"><img src="media/product/s8.jpg" alt="prod"></a>--}}
        {{--</div>--}}

        {{--<div class="content">--}}
        {{--<h4 class="product-name"><a href="product-category.html#">Blutooth Speaker</a></h4>--}}
        {{--<span class="price">$25.50</span>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.product-feature -->--}}

        {{--<div class="product-feature">--}}
        {{--<div class="product-thumb">--}}
        {{--<a href="product-category.html#"><img src="media/product/s9.jpg" alt="prod"></a>--}}
        {{--</div>--}}

        {{--<div class="content">--}}
        {{--<h4 class="product-name"><a href="product-category.html#">Wireless Speaker</a></h4>--}}
        {{--<span class="price">$22.50</span>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.product-feature -->--}}
        {{--</div>--}}
        {{--<!-- /.feature-product-items -->--}}
        {{--</div>--}}
        {{--<!-- /.col-lg-4 col-xl-3 col-md-6  -->--}}

        {{--<div class="col-lg-4 col-xl-3 col-md-6 ">--}}
        {{--<div class="feature-product-items">--}}
        {{--<h3>On Sale</h3>--}}
        {{--<div class="product-feature">--}}
        {{--<div class="product-thumb">--}}
        {{--<a href="product-category.html#"><img src="media/product/s10.jpg" alt="prod"></a>--}}
        {{--</div>--}}

        {{--<div class="content">--}}
        {{--<h4 class="product-name"><a href="product-category.html#">Multimedia Selfie</a></h4>--}}
        {{--<span class="price">$22.50</span>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.product-feature -->--}}

        {{--<div class="product-feature">--}}
        {{--<div class="product-thumb">--}}
        {{--<a href="product-category.html#"><img src="media/product/s11.jpg" alt="prod"></a>--}}
        {{--</div>--}}

        {{--<div class="content">--}}
        {{--<h4 class="product-name"><a href="product-category.html#">Wifi Router</a></h4>--}}
        {{--<span class="price">$26.50</span>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.product-feature -->--}}

        {{--<div class="product-feature">--}}
        {{--<div class="product-thumb">--}}
        {{--<a href="product-category.html#"><img src="media/product/s12.jpg" alt="prod"></a>--}}
        {{--</div>--}}

        {{--<div class="content">--}}
        {{--<h4 class="product-name"><a href="product-category.html#">Nice Headphone</a></h4>--}}
        {{--<span class="price">$12.50</span>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.product-feature -->--}}
        {{--</div>--}}
        {{--<!-- /.feature-product-items -->--}}
        {{--</div>--}}
        {{--<!-- /.col-lg-3 -->--}}
        {{--</div>--}}
        {{--<!-- /.row -->--}}
        {{--</div>--}}
        <!-- /.featured-products -->
        </div>
        <!-- /.container -->
    </section>
    @include('partial.frontend.footer')
@stop