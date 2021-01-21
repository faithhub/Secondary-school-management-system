@extends('admin.layouts.app')
@section('admin')

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Classes</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                    <li>Classes</li>
				</ul>
			</div>
			<!-- Card END -->
			<div class="row">
				<div class="col-lg-12 m-b30">
					<div class="">
						<div class="wc-title">
                            <h4>{{$class->name}} Class Details</h4>
                        </div>
                        <div class="row">                        
                            <div class="col-lg-6 m-b30">
                                <div class="widget-box">
                                    <div class="wc-title">
                                        <h4>{{$class->name}} Students</h4>
                                    </div>
                                    <div class="widget-inner">
                                        <div class="new-user-list">
                                            @if (isset($students) && count($students) > 0)                                                
                                                <ul>
                                                    @foreach ($students as $student)                                                    
                                                        <li>
                                                            @if ($student->avatar != null)
                                                                <span class="new-users-pic">
                                                                    <img src="{{ asset('uploads/student_avatar/'.$student->avatar) }}" alt="">
                                                                </span>
                                                            @else
                                                                <span class="new-users-pic">
                                                                    <img src="{{ asset('uploads/avatar_pics.jpg') }}" alt="">
                                                                </span>
                                                            @endif
                                                            <span class="new-users-text">
                                                                <a href="#" class="new-users-name">{{$student->surname}} {{$student->last_name}} </a>
                                                                <span class="new-users-info">{{$student->email}}</span>
                                                            </span>
                                                            {{-- <span class="new-users-btn">
                                                                <a href="#" class="btn button-sm outline">Follow</a>
                                                            </span> --}}
                                                        </li>
                                                    @endforeach    
                                                </ul>                                  
                                            @else 
                                                <h3>No Student for {{$class->name}} yet</h3>                                               
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                            <div class="col-lg-6 m-b30">
                                <div class="widget-box">
                                    <div class="wc-title">
                                        <h4>{{$class->name}} Subjects </h4>
                                    </div>
                                    <div class="widget-inner">
                                        <div class="orders-list">
                                            <ul>
                                                @foreach ($subjects as $subject)
                                                    <li>
                                                        <span class="orders-title">
                                                            <a href="#" class="orders-title-name"><b>{{$sn++}}. {{ $subject->name }}</b></a>
                                                            <span class="orders-info">Teacher: <b>{{$subject->teacher->surname ?? ''}}  {{$subject->teacher->last_name ?? ''}}</b></span><br>
                                                            <span class="orders-info">Created On: {{ date('D, M j, Y \a\t g:ia', strtotime($subject->created_at))}}</span>
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
				</div>
			</div>
		</div>
	</main>
@endsection