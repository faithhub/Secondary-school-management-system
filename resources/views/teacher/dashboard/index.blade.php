@extends('teacher.layouts.app')
@section('teacher')

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Dashboard</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Dashboard</li>
				</ul>
			</div>	
			<!-- Card -->
			<div class="row">
				<div class="col-md-12 col-lg-6 col-xl-6 col-sm-12 col-12">
					<div class="widget-card widget-bg1">					 
						<div class="wc-item">
							<h4 class="wc-title">
								{{$subject->name}}
							</h4>
							<span class="wc-des">
								Subject
							</span>
							{{-- <span class="wc-stats">
								<span class="counter">18</span>
							</span> --}}
						</div>				      
					</div>
				</div>
				<div class="col-md-12 col-lg-6 col-xl-6 col-sm-12 col-12">
					<div class="widget-card widget-bg4">					 
						<div class="wc-item">
							<h4 class="wc-title">
								Students
							</h4>
							<span class="wc-des">
								Total Number of Student taking {{$subject->name}}
							</span>
							<span class="wc-stats counter">
								{{$number_of_student}}
							</span>
						</div>				      
					</div>
				</div>
			</div>
			<!-- Card END -->
			<div class="row">
				<div class="col-lg-6 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h4>Last Five Students</h4>
						</div>
						<div class="widget-inner">
							<div class="new-user-list">
								<ul>
									@foreach ($users as $user)
										<li>
											@if ($user->avatar != null)
												<span class="new-users-pic">
													<img src="{{ asset('uploads/student_avatar/'.$user->avatar) }}" alt="{{$user->surname}} {{$user->last_name}}"/>
												</span>												
											@else
												<span class="new-users-pic">
													<img src="{{ asset('uploads/avatar_pics.jpg') }}" alt=""/>
												</span>												
											@endif
											<span class="new-users-text">
												<a href="#" class="new-users-name">{{$user->surname}} {{$user->last_name}}</a>
												<span class="new-users-info">ID: {{$user->email}}</span>
											</span>
											<span class="new-users-btn">
												{{-- <a href="#" class="btn button-sm outline">Follow</a> --}}
											</span>
										</li>										
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-6 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h4>Welcome {{Auth::user()->surname}} {{Auth::user()->last_name}}</h4>
						</div>
						<div class="widget-inner">
							<div class="card-courses-list bookmarks-bx">
								<div class="card-courses-media">
									@if (Auth::user()->avatar == null)										
										<img src="{{ asset('uploads/avatar_pics.jpg') }}" alt="">
									@else		
										<img src="{{ asset('uploads/teacher_avatar/'.Auth::user()->avatar) }}" alt="{{Auth::user()->surname}} {{Auth::user()->last_name}}">										
									@endif
								</div>
								<div class="card-courses-full-dec">
									<div class="card-courses-title">
										<h4 class="m-b5">{{Auth::user()->surname}} {{Auth::user()->last_name}}</h4>
									</div>
									<div class="card-courses-list-bx">
										<ul class="card-courses-view">
											<li class="card-courses-categories">
												<h5>Subject</h5>
												<h4>{{$subject->name}}</h4>
											</li>
											<li class="card-courses-categories">
												<h5>Teacher ID</h5>
												<h4>{{Auth::user()->email}}</h4>
											</li>
										</ul>
									</div>
									<div class="row card-courses-dec">
										{{-- <div class="col-md-12">
											<p>
												@foreach ($subjects as $subject)
													{{$subject->name}}
												@endforeach
											</p>	
										</div> --}}
										<div class="col-md-12">
											<a href="{{ url('teacher/profile') }}" class="btn radius-xl">Edit Profile</a>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection