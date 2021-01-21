@extends('teacher.layouts.app')
@section('teacher')

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Students</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Students</li>
				</ul>
			</div>	
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h2>All {{$class->name}} Students</h2>
                        </div>
                        <div class="widget-inner">
							<div class="new-user-list">
                                <table class="table responsive-table">
                                    <thead class="text-center">
                                        <tr>
                                            <td width="20%">Student</td>
                                            @foreach ($subjects as $subject)
                                                @if ($cla && in_array($subject->id, $cla))                                                                                                    
                                                    <td>{{$subject->name}}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>   
                                            @foreach ($students as $student) 
                                            <tr>                                        
                                                <td>
                                                    <ul>
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
                                                                <span class="new-users-info">{{$student->email}} </span>
                                                            </span>
                                                        </li>
                                                    <ul>
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
						</div>
                        <div class="text-right m-3">
                            <a href="" class="btn green">Upload Result</a>
                        </div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
			</div>
		</div>
	</main>
@endsection