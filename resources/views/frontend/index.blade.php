@extends('layouts.main')
@section('content')
	<section class="banner-travel">
		<div class="container pr">
			<div class="banner-content">
				<h2 class="banner-title">Let Learning Begin</h2>
				<h4 class="sub-title">Powering education</h4>

				<div class="travel-banner-image text-center">
					{{--<img style="width: 415px; height: 362px;" src="{{ asset('svg/banner.svg') }}" alt="">--}}
				</div>
			</div>
			<form action="{{ route('resources.search') }}">
				<div class="booking-wrapper">
					<div class="col-md-12">
						<h2>Search For Resources</h2>
					</div>
					<div class="col-md-3">
						<div class="sofin-select">
							<div class="form-group">
								<label for="category" style="color: black">Choose Categories</label>
								<select name="category" id="category" class="form-control">
									<option value="">Choose Category</option>
									@foreach(\App\Category::where('is_deleted', false)->get() as $cat)
										<option value="{{ $cat->id }}">{{ ucwords($cat->name) }}</option>
										@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="sofin-select">
							<div class="form-group">
								<label for="price" style="color: black">Price</label>
								<select name="price" id="price" class="form-control">
									<option value="">Price</option>
									<option value="free">Free</option>
									<option value="paid">Paid</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="sofin-select">
							<div class="form-group" style="color: black">
								<label for="keyword">Keyword</label>
								<input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search Keywords">
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for=""></label>
							<input type="submit" style="color: white" class="btn btn-primary btn-block" value="Search">
						</div>
					</div>
				</div>
			</form>

		</div>
	</section>
	<section id="call-to-action">
		<div class="container">
			<div class="call-to-action-wrapper wow fadeInUp">
				<div class="left-content">
					<h2>Share Resources</h2>
					
				</div>
				<div class="right-content">
					<a href="{{ route('order.content') }}" class="sofin-btn btn-light">Order Content</a>
				</div>
			</div>
		</div>
	</section>
	<section id="about-softwere">
		<div class="container">
			<div class="row no-gutters">
				<div class="col-md-5">
					<div class="about-soft-content wow fadeInUp">
						<h2 class="title" id="about">About SkulBox</h2>
						<p>
							A platform to share learning resources by making requests, paying for them and downloading.
						</p>
					</div>
				</div>
				<div class="col-md-7">
					<div class="about-feature-image wow fadeInUp" data-wow-delay="0.3s">
						<img src="{{ asset('media/mockup/ab1.png') }}" alt="">
					</div>
				</div>
			</div>
		</div>
	</section>
	{{--<section id="contact" class="section-padding">--}}
		{{--<div class="container">--}}
			{{--<div class="row">--}}
				{{--<div class="col-md-4">--}}
					{{--<div class="contact-infos">--}}
						{{--<div class="contact-info wow fadeIn">--}}
							{{--<div class="icon">--}}
								{{--<i class="flaticon-call"></i>--}}
							{{--</div>--}}

							{{--<div class="content">--}}
								{{--<p>+1- 888 - 391 -2605</p>--}}
								{{--<p>+1- 888 - 625 -2607</p>--}}
							{{--</div>--}}
							{{--<!-- /.content -->--}}
						{{--</div>--}}
						{{--<!-- /.contact-info -->--}}

						{{--<div class="contact-info wow fadeIn" data-wow-delay="0.3s">--}}
							{{--<div class="icon">--}}
								{{--<i class="flaticon-placeholder"></i>--}}
							{{--</div>--}}

							{{--<div class="content">--}}
								{{--<p>--}}
									{{--32 Eden Park, Buffalo<br> New York, USA--}}
								{{--</p>--}}
							{{--</div>--}}
							{{--<!-- /.content -->--}}
						{{--</div>--}}
						{{--<!-- /.contact-info -->--}}


						{{--<div class="contact-info wow fadeIn" data-wow-delay="0.5s">--}}
							{{--<div class="icon">--}}
								{{--<i class="flaticon-unlink"></i>--}}
							{{--</div>--}}

							{{--<div class="content">--}}
								{{--<p>www.codetheme.com</p>--}}
								{{--<p>www.codetheme.com</p>--}}
							{{--</div>--}}
							{{--<!-- /.content -->--}}
						{{--</div>--}}
						{{--<!-- /.contact-info -->--}}

					{{--</div>--}}
					{{--<!-- /.contact-infos -->--}}
				{{--</div>--}}
				{{--<!-- /.col-md-4 -->--}}

				{{--<div class="col-md-8">--}}
					{{--<div class="contact-form-inner wow fadeIn" data-wow-delay="0.5s">--}}
						{{--<form action="http://codepixar.com/html/sofin/sofin/php/mailer.php" class="contact-form" data-sofinform="contact">--}}
							{{--<div class="row">--}}
								{{--<div class="col-md-6">--}}
									{{--<input type="text" name="fname" placeholder="First Name" required onfocus="this.placeholder=''" onblur="this.placeholder='First Name'">--}}
								{{--</div>--}}
								{{--<!-- /.col-md-6 -->--}}

								{{--<div class="col-md-6">--}}
									{{--<input type="text" name="lname" placeholder="Last Name" required onfocus="this.placeholder=''" onblur="this.placeholder='Last Name'">--}}
								{{--</div>--}}
								{{--<!-- /.col-md-6 -->--}}
							{{--</div>--}}
							{{--<!-- /.row -->--}}

							{{--<input type="text" name="email" placeholder="Last Name" required onfocus="this.placeholder=''" onblur="this.placeholder='Last Name'">--}}

							{{--<textarea placeholder="Your Comment Heare....." name="content" required onfocus="this.placeholder=''" onblur="this.placeholder='Your Comment Heare.....'"></textarea>--}}

							{{--<button type="submit" class="submit-btn sofin-btn">Submit Now</button>--}}

							{{--<div class="form-result alert">--}}
								{{--<div class="content"></div>--}}
							{{--</div>--}}
							{{--<!-- /.form-result-->--}}

						{{--</form>--}}
						{{--<!-- /.contact-form -->--}}
					{{--</div>--}}
					{{--<!-- /.contact-form-inner -->--}}
				{{--</div>--}}
				{{--<!-- /.col-md-8 -->--}}
			{{--</div>--}}
			{{--<!-- /.row -->--}}
		{{--</div>--}}
		{{--<!-- /.container -->--}}
	{{--</section>--}}
	{{--TODO:Add why use school box--}}
	@include('partial.frontend.footer')
@stop