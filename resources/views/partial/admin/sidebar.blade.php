		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{ asset('img/user.png') }}" alt="user" class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ ucwords(auth()->user()->name) }}
									<span class="user-level">{{ ucwords(auth()->user()->user_type) }}</span>
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Menu</h4>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="{{ url('/admin') }}" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						@if(auth()->user()->user_type ==  config('studentbox.user_type.admin'))
						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-cubes"></i>
								<p>Content Categories</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ route('category.create') }}">
											<span class="sub-item">Add New Category</span>
										</a>
									</li>
									<li>
										<a href="{{ route('category.index') }}">
											<span class="sub-item">Categories</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						@endif
						@if(auth()->user()->user_type == config('studentbox.user_type.admin'))
							<li class="nav-item">
								<a data-toggle="collapse" href="#res">
									<i class="fa fa-toolbox"></i>
									<p>Resources</p>
									<span class="caret"></span>
								</a>
								<div class="collapse" id="res">
									<ul class="nav nav-collapse">
										{{--<li>--}}
											{{--<a href="{{ route('resource.create') }}">--}}
												{{--<span class="sub-item">Upload New</span>--}}
											{{--</a>--}}
										{{--</li>--}}
										<li>
											<a href="{{ route('admin.resource.index') }}">
												<span class="sub-item">Resources</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item">
							<a data-toggle="collapse" href="#requests">
								<i class="fa fa-envelope"></i>
								<p>Requests</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="requests">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ route('creator.requests') }}">
											<span class="sub-item">Requests</span>
										</a>
									</li>
									<li>
										<a href="{{ route('creator.requests',['status' => config('studentbox.request-status.doing')]) }}">
											<span class="sub-item">Active requests</span>
										</a>
									</li>
									<li>
										<a href="{{ route('creator.requests', ['status' => config('studentbox.request-status.completed')]) }}">
											<span class="sub-item">Completed requests</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						@endif
						@if(auth()->user()->user_type == config('studentbox.user_type.agent'))
							<li class="nav-item">
								<a data-toggle="collapse" href="#res">
									<i class="fa fa-toolbox"></i>
									<p>Resources</p>
									<span class="caret"></span>
								</a>
								<div class="collapse" id="res">
									<ul class="nav nav-collapse">
										<li>
											<a href="{{ route('resource.create') }}">
												<span class="sub-item">Upload New</span>
											</a>
										</li>
										<li>
											<a href="{{ route('resource.index') }}">
												<span class="sub-item">Resources</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
						
						<li class="nav-item">
							<a data-toggle="collapse" href="#requests">
								<i class="fa fa-envelope"></i>
								<p>Requests</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="requests">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ route('creator.requests') }}">
											<span class="sub-item">Requests</span>
										</a>
									</li>
									<li>
										<a href="{{ route('creator.requests',['status' => config('studentbox.request-status.doing')]) }}">
											<span class="sub-item">Active requests</span>
										</a>
									</li>
									<li>
										<a href="{{ route('creator.requests', ['status' => config('studentbox.request-status.completed')]) }}">
											<span class="sub-item">Completed requests</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#bids">
								<i class="fa fa-money-check"></i>
								<p>Bids</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="bids">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ route('bids.index',['status' =>  config('studentbox.request-offer-status.pending')]) }}">
											<span class="sub-item">Active Bids</span>
										</a>
									</li>
									<li>
										<a href="{{ route('bids.index',['status' =>  config('studentbox.request-offer-status.accepted')]) }}">
											<span class="sub-item">Accepted Bids</span>
										</a>
									</li>
									<li>
										<a href="{{ route('bids.index',['status' =>  config('studentbox.request-offer-status.confirmed')]) }}">
											<span class="sub-item">Confirm Bids</span>
										</a>
									</li>
									<li>
										<a href="{{ route('bids.index',['status' =>  config('studentbox.request-offer-status.declined')]) }}">
											<span class="sub-item">Declined Bids</span>
										</a>
									</li>
									<li>
										<a href="{{ route('bids.index') }}">
											<span class="sub-item">All Bids</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						@endif
						@if(auth()->user()->user_type == config('studentbox.user_type.admin'))
							<li class="nav-item">
								<a href="{{ route('admin.reports') }}" >
									<i class="fas fa-exclamation"></i>
									<p>Reports</p>
								</a>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</div>
