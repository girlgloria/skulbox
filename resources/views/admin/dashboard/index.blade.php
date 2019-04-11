@extends('layouts.backend')
@section('content')
	<div class="wrapper">
		@include('partial.admin.nav-header')
		@include('partial.admin.sidebar')

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
							</div>
							<div class="ml-md-auto py-2 py-md-0">
								{{--<a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>--}}
								{{--<a href="#" class="btn btn-secondary btn-round">Add Customer</a>--}}
							</div>
						</div>
					</div>
				</div>
				@if(auth()->user()->user_type == config('studentbox.user_type.admin'))
					<div class="page-inner mt--5">
						<div class="row mt--2">
							<div class="col-md-6">
								<div class="card full-height">
									<div class="card-body">
										<div class="card-title">Overall statistics</div>
										<div class="card-category">System data</div>
										<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
											<div class="px-2 pb-2 pb-md-0 text-center">
												<div id="circles-1"></div>
												<h6 class="fw-bold mt-3 mb-0">Users</h6>
												<h6 class="fw-bold mt-3 mb-0">{{ count(\App\User::all()) }}</h6>
											</div>
											<div class="px-2 pb-2 pb-md-0 text-center">
												<div id="circles-2"></div>
												<h6 class="fw-bold mt-3 mb-0">Agents</h6>
												<h6 class="fw-bold mt-3 mb-0">{{ count(\App\User::where('user_type', config('studentbox.user_type.agent'))->get()) }}</h6>
											</div>
											<div class="px-2 pb-2 pb-md-0 text-center">
												<div id="circles-3"></div>
												<h6 class="fw-bold mt-3 mb-0">Resources</h6>
												<h6 class="fw-bold mt-3 mb-0">{{ count(\App\Content::all()) }}</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card full-height">
									<div class="card-body">
										<div class="card-title">Total Transactions</div>
										<div class="row py-3">
											<div class="col-md-4 d-flex flex-column justify-content-around">
												<div>
													<h6 class="fw-bold text-uppercase text-success op-8">Total Transactions</h6>
													<h3 class="fw-bold">KES : {{ \App\Transaction::all()->sum('amount') }}</h3>
												</div>
												<div>
													<h6 class="fw-bold text-uppercase text-success op-8">Resource Valuation</h6>
													<h3 class="fw-bold">KES : {{ \App\Content::all()->sum('cost') }}</h3>
												</div>
											</div>
											<div class="col-md-8">
												<div id="chart-container">
													<canvas id="totalIncomeChart"></canvas>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@else
					<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Overall statistics</div>
									<div class="card-category">System data</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-1"></div>
											<h6 class="fw-bold mt-3 mb-0">Categories</h6>
											<h6 class="fw-bold mt-3 mb-0">{{ count(auth()->user()->categories) }}</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-2"></div>
											<h6 class="fw-bold mt-3 mb-0">Bids</h6>
											<h6 class="fw-bold mt-3 mb-0">{{ count(\App\RequestOffer::where('user_id', auth()->user()->id)->get()) }}</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-3"></div>
											<h6 class="fw-bold mt-3 mb-0">Resources</h6>
											<h6 class="fw-bold mt-3 mb-0">{{ count(\App\Content::where('user_id', auth()->user()->id)->get()) }}</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Total Transactions</div>
									<div class="row py-3">
										<div class="col-md-4 d-flex flex-column justify-content-around">
											<div>
												<h6 class="fw-bold text-uppercase text-success op-8">Total Bids Amount</h6>
												<h3 class="fw-bold">KES : {{ \App\RequestOffer::where('user_id', auth()->user()->id)->get()->sum('offer') }}</h3>
											</div>
											{{--<div>--}}
												{{--<h6 class="fw-bold text-uppercase text-success op-8">Total Balance Amount</h6>--}}
												{{--<h3 class="fw-bold">KES : {{ \App\Transaction::where('paid_to', auth()->user()->id)->sum('amount') }}</h3>--}}
											{{--</div>--}}
										</div>
										<div class="col-md-8">
											<div id="chart-container">
												<canvas id="totalIncomeChart"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif
            </div>
            @include('partial.admin.footer')
		</div>
	</div>
@endsection
	