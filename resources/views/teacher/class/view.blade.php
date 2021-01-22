@extends('teacher.layouts.app')
@section('teacher')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">{{$class->name}} Class</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>{{$class->name}} Class</li>
				</ul>
			</div>	
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h2>All Student taking {{$subject->name}} in {{$class->name}} Class</h2>
						</div>
						
						<div class="widget-inner">
							<div class="orders-list">
                                <table class="table" id="myTable" width="100%">
                                    <thead style="font-weight:bolder">
                                        <tr>                                            
                                            <td>S/N</td>
                                            <td>Student</td>
                                            <td>First Test</td>
                                            <td>Second Test</td>
                                            <td>Exam</td>
                                            <td>Total</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $student)                                            
                                            <tr>        
                                                <td>{{$sn++}}</td>                                    
                                                <td><b>{{$student->surname}} {{$student->last_name}}</b></td>
                                                <td>{{$student->first_test ?? '0'}}</td>
                                                <td>{{$student->second_test ?? '0'}}</td>
                                                <td>{{$student->exam ?? '0'}}</td>
                                                <td>{{$student->first_test + $student->second_test + $student->exam ?? '0'}}</td>
                                                <td>
                                                    <span class="btn button-sm green" data-bs-toggle="modal" data-bs-target="#editStudent{{$student->id}}">Edit</span>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editStudent{{$student->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit {{$student->surname}} {{$student->last_name}} result</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('edit-result') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">                     
                                                                <input type="hidden" name="student_id" value="{{$student->student_id}}">
                                                                <input type="hidden" name="class_id" value="{{$student->class_id}}">
                                                                <input type="hidden" name="subject_id" value="{{$student->subject_id}}">                                       
                                                                <div class="form-group">
                                                                    <label>First Test</label>
                                                                    <input type="number" name="first_test" class="form-control" value="{{$student->first_test ?? '0'}}">
                                                                </div>                                                        
                                                                <div class="form-group">
                                                                    <label>Second Test</label>
                                                                    <input type="number" name="second_test" class="form-control" value="{{$student->second_test ?? '0'}}">
                                                                </div>                                                        
                                                                <div class="form-group">
                                                                    <label>Exam Score</label>
                                                                    <input type="number" name="exam" class="form-control" value="{{$student->exam ?? '0'}}">
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-right mt-2">
                                    <a href="{{ url('teacher/download-result-pdf', $class->class_id) }}" class="btn btn-small btn-success mr-2">Download Result PDF</a>
                                    <button class="btn green" data-bs-toggle="modal" data-bs-target="#uploadStudentResultInBulk">Upload Result in Bulk</button>
                                </div>
                                    
                                <div class="modal fade" id="uploadStudentResultInBulk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload Students Result In Bulk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('student-upload-result') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">                                                    
                                                <div class="form-group">
                                                    <input type="hidden" name="class_id" value="{{$class->class_id}}">
                                                    <label>Upload File</label>
                                                    <input type="file" name="students_result" class="form-control" accept=".xlsx">
                                                </div>
                                                <p>
                                                    Note: Download the Excel Result Format below, update the datas and upload. <a href="{{ url('teacher/export-data', $class->class_id) }}" class="btn btn-small btn-primary">Download</a>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
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