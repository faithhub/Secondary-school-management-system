@extends('admin.layouts.app')
@section('admin')

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
				<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
					<div class="widget-card widget-bg1">					 
						<div class="wc-item">
							<h4 class="wc-title mb-2">
								Teachers
							</h4>
							<span class="wc-stats">
								<span class="counter">
									{{$teachers_count}}
								</span>
							</span>							
						</div>				      
					</div>
				</div>
				<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
					<div class="widget-card widget-bg2">					 
						<div class="wc-item">
							<h4 class="wc-title mb-2">
									Students
							</h4>
							<span class="wc-stats counter">
								{{$students_count}} 
							</span>
						</div>				      
					</div>
				</div>
				<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
					<div class="widget-card widget-bg3">					 
						<div class="wc-item">
							<h4 class="wc-title mb-2">
								Classes 
							</h4>
							<span class="wc-stats counter">
								{{$classes_count}} 
							</span>
						</div>				      
					</div>
				</div>
				<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
					<div class="widget-card widget-bg4">					 
						<div class="wc-item">
							<h4 class="wc-title mb-2">
								Subjects 
							</h4>
							<span class="wc-stats counter">
								{{$subjects_count}} 
							</span>
						</div>				      
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 m-b30">
					<div class="widget-box">
						<div class="widget-inner">							
							<div class="new-user-list">
								<div class="wc-title">
									<h4>Last Five Teachers</h4>
								</div>
								<ul>									
									@foreach ($teachers as $teacher)
										<li>
											@if ($teacher->avatar != null)
												<span class="new-users-pic">
													<img src="{{ asset('uploads/teacher_avatar/'.$teacher->avatar)}}" alt="{{$teacher->surname}} {{$teacher->last_name}}"/>
												</span>												
											@else
												<span class="new-users-pic">
													<img src="uploads/avatar_pics.jpg" alt=""/>
												</span>												
											@endif
											<span class="new-users-text">
												<a href="#" class="new-users-name">{{$teacher->surname}} {{$teacher->last_name}}</a>
												<span class="new-users-info">ID: {{$teacher->email}}</span><br>
												<span class="new-users-info">Registered: {{ date('D, M j, Y \a\t g:ia', strtotime($teacher->created_at))}}</span>
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
												<h6>Role</h6>
												<h5>{{Auth::user()->role}}</h5>
											</li>
											<!-- <li class="card-courses-categories">
												<h6>Teacher ID</h6>
												<h5>{{Auth::user()->email}}</h5>
											</li> -->
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
			
			<div class="row">
				<div class="col-lg-6 m-b30">
					<div class="widget-box">
						<div class="widget-inner">
							<div class="orders-list">								
								<div class="wc-title">
									<h4>Last Five Classes</h4>
								</div>
								<ul>
									@foreach ($classes as $class)<li>
										<span class="orders-title">
											<a href="#" class="orders-title-name">
												{{$sn++}}. {{$class[0]['name']}}
											</a>
											<span class="orders-info">Created At | 
												{{ date('D, M j, Y \a\t g:ia', strtotime($class[0]['created_at']))}}</span>
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
						<div class="widget-inner">
							<div class="orders-list">								
								<div class="wc-title">
									<h4>Last Five Subjects</h4>
								</div>
								<ul>
									@foreach ($subjects as $subject)<li>
										<span class="orders-title">
											<a href="#" class="orders-title-name">
												{{$sn++}}. {{$subject->name}}
											</a>
											<span class="orders-info">Created At | 
												{{ date('D, M j, Y \a\t g:ia', strtotime($subject->created_at))}}</span>
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
						<div class="widget-inner">							
							<div class="new-user-list">
								<div class="wc-title">
									<h4>Last Five Students</h4>
								</div>
								<ul>									
									@foreach ($students as $student)
										<li>
											@if ($student->avatar != null)
												<span class="new-users-pic">
													<img src="{{ asset('uploads/student_avatar/'.$student->avatar)}}" alt="{{$student->surname}} {{$student->last_name}}"/>
												</span>												
											@else
												<span class="new-users-pic">
													<img src="uploads/avatar_pics.jpg" alt=""/>
												</span>												
											@endif
											<span class="new-users-text">
												<a href="#" class="new-users-name">{{$student->surname}} {{$student->last_name}}</a>
												<span class="new-users-info">ID: {{$student->email}}</span><br>
												<span class="new-users-info">Registered: {{ date('D, M j, Y \a\t g:ia', strtotime($student->created_at))}}</span>
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
			</div>
		</div>
	</main>
@endsection