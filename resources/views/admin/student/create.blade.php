@extends('admin.layouts.app')
@section('admin')

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
            @if ($mode != null && $mode == 'edit')
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Edit Student</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                    <li>Edit Student</li>
				</ul>
			</div>                
            @else
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Add Student</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                    <li>Add Student</li>
				</ul>
			</div>                
            @endif
			<!-- Card END -->
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-6 m-b30">
					@if ($mode != null && $mode == 'create')						
						<div class="widget-box">
							<div class="wc-title">
								<h4>Add a single Student</h4>
							</div>
							<div class="widget-inner">
								<form class="edit-profile m-b30" method="POST" action="{{ route('admin_create_student') }}">
									@csrf
									<div class="">
										<div class="form-group row">
											<div class="col-sm-10  ml-auto">
												<h4>Student Details</h4>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Surname Name</label>
											<div class="col-sm-10">
												<input class="form-control @error('surname') is-invalid @enderror" type="text" name="surname" value="{{ old('surname') }}">
												@error('surname')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Last Name</label>
											<div class="col-sm-10">
												<input class="form-control @error('last_name') is-invalid @enderror" name="last_name" type="text" value="{{ old('last_name') }}">
												@error('last_name')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Select Class</label>
											<div class="col-sm-10">
												<select class="form-control @error('class') is-invalid @enderror" name="class">
													<option value="">Select Class</option>
													@foreach ($classes as $class)
														<option value="{{$class[0]['class_id']}}">{{$class[0]['name']}}</option>													
													@endforeach
												</select>
												@error('class')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-10  ml-auto">
												<h6>Note: Surname is password by default in lowercase</h6>
											</div>
										</div>								
										<div class="seperator"></div>
									</div>
									
									<div class="">
										<div class="">
											<div class="row">
												<div class="col-sm-2">
												</div>
												<div class="col-sm-7">
													<button type="submit" class="btn">Create Student</button>
													<input type="reset" class="btn-secondry" value="Cancel">
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					@elseif($mode != null && $mode == 'edit')						
						<div class="widget-box">
							<div class="wc-title">
								<h4>Edit <b>{{$student->surname}}  {{$student->last_name}}</b></h4>
							</div>
							<div class="widget-inner">
								<form class="edit-profile m-b30" method="POST" action="{{ route('admin_create_student') }}">
									@csrf
									<div class="">
										<div class="form-group row">
											<div class="col-sm-12 ml-auto text-center">
												@if ($student->avatar != null)
												<span class="new-users-pic">
													<img src="{{ asset('uploads/teacher_avatar/'.$student->avatar) }}" alt="" width="150px" height="150px"/>
												</span>												
												@else
												<span class="new-users-pic">
													<img src="{{ asset('uploads/avatar_pics.jpg') }}" alt="" width="150px" height="150px"/>
												</span>												
												@endif
												<h4><b>{{$student->surname}}  {{$student->last_name}}</b></h4>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Student ID</label>
											<div class="col-sm-10">
												<input type="hidden" name="id" value="{{$student->id}}">
												<input class="form-control" type="text" readonly value="{{$student->email}}">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Surname Name</label>
											<div class="col-sm-10">
												<input class="form-control @error('surname') is-invalid @enderror" type="text" name="surname" value="{{$student->surname}}">
												@error('surname')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Last Name</label>
											<div class="col-sm-10">
												<input class="form-control @error('last_name') is-invalid @enderror" name="last_name" type="text" value="{{ $student->last_name }}">
												@error('last_name')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Select Class</label>
											<div class="col-sm-10">
												<select class="form-control @error('class') is-invalid @enderror" name="class">
													<option disabled="disabled" value="">Select Class</option>
													@foreach ($classes as $class)
														<option disabled="disabled" value="{{$class[0]['class_id']}}"  {{$student->class_id == $class[0]['class_id'] ? 'selected' : ''}}>{{$class[0]['name']}}</option>													
													@endforeach
												</select>
												@error('class')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-10  ml-auto">
												<h6>Note: Surname is password by default in lowercase</h6>
											</div>
										</div>								
										<div class="seperator"></div>
									</div>
									
									<div class="">
										<div class="">
											<div class="row">
												<div class="col-sm-2">
												</div>
												<div class="col-sm-7">
													<button type="submit" class="btn">Update</button>
													<input type="reset" class="btn-secondry" value="Cancel">
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					@endif
				</div>
				<div class="col-lg-6 m-b30">
                    @if ($mode != null && $mode == 'create')
                        					
						<div class="widget-box">
							<div class="wc-title">
								<h4>Add New in Bulk Student</h4>
							</div>
							<div class="widget-inner">
								<form class="edit-profile m-b30" method="POST" action="{{ route('admin_create_bulk_student') }}" enctype="multipart/form-data">
									@csrf
									<div class="">
										<div class="form-group row">
											<div class="col-sm-10  ml-auto">
												<h4>Student in Bulk (Excel Format only)</h4>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Student in Bulk</label>
											<div class="col-sm-8">
												<input class="form-control @error('bulk_student') is-invalid @enderror" name="bulk_student" type="file" value="{{ old('bulk_student') }}">
												@error('bulk_student')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Select Class for Students</label>
											<div class="col-sm-8">
												<select class="form-control @error('bulk_class') is-invalid @enderror" name="bulk_class">
													<option value="">Select Class</option>
													@foreach ($classes as $class)
													<option value="{{$class[0]['class_id']}}">{{$class[0]['name']}}</option>													 --}}
													@endforeach
												</select>
												@error('bulk_class')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-10  ml-auto">
                                                <h6>Note: Surname is password by default in lowercase<br>
                                                    Note: The Excel Sheet format must match below sample<br>
                                                    <img src="{{ asset('uploads/excel.png') }}">
                                                </h6>
											</div>
										</div>								
										<div class="seperator"></div>
									</div>
									
									<div class="">
										<div class="">
											<div class="row">
												<div class="col-sm-2">
												</div>
												<div class="col-sm-7">
													<button type="submit" class="btn">Upload Student</button>
													<input type="reset" class="btn-secondry" value="Cancel">
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
                    @endif
				</div>
				<!-- Your Profile Views Chart END-->
			</div>
		</div>
	</main>
@endsection