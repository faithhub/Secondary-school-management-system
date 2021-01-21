@extends('teacher.layouts.app')
@section('teacher')

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Class</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Class</li>
				</ul>
			</div>	
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h2>All Classes taking {{$subject->name}}</h2>
						</div>
						
						<div class="widget-inner">
							<div class="orders-list">
								<ul>
                                    @foreach ($classes as $class)
										<li>
											<span class="orders-title mr-5">
												<a href="{{ url('teacher/view-class', $class[0]['class_id']) }}" class="orders-title-name"><b>{{$sn++}}. {{$class[0]['name']}}</b></a>
												<span class="orders-info">Student: <b></b></span><br>
												<span class="orders-info">Created On: {{ date('D, M j, Y \a\t g:ia', strtotime($class[0]['created_at']))}}</span>
											</span>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
			</div>
		</div>
	</main>
@endsection