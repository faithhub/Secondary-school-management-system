@extends('student.layouts.app')
@section('student')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">My Subjeects</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>My Subjeects</li>
				</ul>
			</div>	
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h2>All Subjects For {{$class->name}} Class</h2>
						</div>
						
						<div class="widget-inner">
							<div class="orders-list">
                                <table class="table" id="myTable" width="100%">
                                    <thead style="font-weight:bolder">
                                        <tr>                                            
                                            <td>S/N</td>
                                            <td>Subject</td>
                                            <td>First Test</td>
                                            <td>Second Test</td>
                                            <td>Exam</td>
                                            <td>Total</td>
                                            {{-- <td>Action</td> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjects as $subject)                                            
                                            <tr>        
                                                <td>{{$sn++}}</td>                                    
                                                <td><b>{{$subject->name}}</b></td>
                                                <td>{{$subject->first_test ?? '0'}}</td>
                                                <td>{{$subject->second_test ?? '0'}}</td>
                                                <td>{{$subject->exam ?? '0'}}</td>
                                                <td>{{$subject->first_test + $subject->second_test + $subject->exam ?? '0'}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-right mt-2">
                                    <a href="{{ url('student/download-result') }}" class="btn btn-small btn-success mr-2">Download Result</a>
                                    {{-- <button class="btn green" data-bs-toggle="modal" data-bs-target="#uploadStudentResultInBulk">Upload Result in Bulk</button> --}}
                                </div>                                    
							</div>
						</div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
			</div>
		</div>
	</main>
@endsection