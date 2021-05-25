@extends('admin.layouts.app')
@section('admin')

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Student</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                    <li>Student</li>
				</ul>
			</div>
			<!-- Card END -->
			<div class="row">
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
                            <h4>Student</h4>
                            <div class="text-right">
                                <a href="{{ url('admin/create-student') }}" class="btn green">Add Student</a>
                            </div>
						</div>
						<div class="widget-inner">
							<div class="new-user-list">
								<ul>
									@foreach ($students as $student)
                                        <li>
											@if ($student->avatar != null)
                                            <span class="new-users-pic">
                                                <img src="{{ asset('uploads/student_avatar/'.$student->avatar) }}" alt=""/>
                                            </span>												
											@else
                                            <span class="new-users-pic">
                                                <img src="{{ asset('uploads/avatar_pics.jpg') }}" alt=""/>
                                            </span>												
											@endif
                                            <span class="new-users-text">
												<a href="{{ url('admin/view-class') }}" class="new-users-name"><b>{{$sn++}}. {{$student->surname}} {{$student->last_name}}</b></a>  
												@if ($student->status == 'Active')
                                                <span class="new-users-info"><span class="btn button-sm green radius-xl">{{$student->status}}</span></span><br>   													
												@else
                                                <span class="new-users-info"><span class="btn button-sm red radius-xl">{{$student->status}}</span></span><br>   													
												@endif                                           
                                                <span class="new-users-info"><b>ID: {{$student->email ?? ''}}</b></span><br>   
                                                {{-- <span class="new-users-info"><b>{{$student->classes['name'] ?? ''}}</b></span><br>              --}}
                                                <span class="new-users-info">Created On: {{ date('D, M j, Y \a\t g:ia', strtotime($student->created_at))}} </span>
                                            </span>
                                            <span class="new-users-btn">
												@if ($student->status == 'Active')
                                                <a href="{{ url('admin/block-student', $student->id) }}" class="btn button-sm red">Block</a>													
												@else
                                                <a href="{{ url('admin/unblock-student', $student->id) }}" class="btn button-sm green">Unblock</a>													
												@endif
                                                <a href="{{ url('admin/edit-student', $student->id) }}" class="btn button-sm green">Edit</a>
                                                <a href="{{ url('admin/delete-student', $student->id) }}" class="btn button-sm red">Delete</a>
                                            </span>
                                            <span class="orders-btn">
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                                {{$students->links()}}
							</div>
						</div>
					</div>
				</div>
				{{-- <div class="col-lg-6 m-b30">
					@if ($mode != null && $mode == 'create')						
						<div class="widget-box">
							<div class="wc-title">
								<h4>Add New Teacher</h4>
							</div>
							<div class="widget-inner">
								<form class="edit-profile m-b30" method="POST" action="{{ route('admin_create_teacher') }}">
									@csrf
									<div class="">
										<div class="form-group row">
											<div class="col-sm-10  ml-auto">
												<h4>Teacher Details</h4>
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
														<option value="{{$class->id}}">{{$class->name}}</option>													
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
													<button type="submit" class="btn">Create Teacher</button>
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
								<h4>Edit <b>{{$student->surname}}  {{$teacher->last_name}}</b></h4>
							</div>
							<div class="widget-inner">
								<form class="edit-profile m-b30" method="POST" action="{{ route('admin_create_teacher') }}">
									@csrf
									<div class="">
										<div class="form-group row">
											<div class="col-sm-12 ml-auto text-center">
												@if ($teacher->avatar != null)
												<span class="new-users-pic">
													<img src="{{ asset('uploads/teacher_avatar/'.$teacher->avatar) }}" alt="" width="150px" height="150px"/>
												</span>												
												@else
												<span class="new-users-pic">
													<img src="{{ asset('uploads/avatar_pics.jpg') }}" alt="" width="150px" height="150px"/>
												</span>												
												@endif
												<h4><b>{{$teacher->surname}}  {{$teacher->last_name}}</b></h4>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Teacher ID</label>
											<div class="col-sm-10">
												<input type="hidden" name="id" value="{{$teacher->id}}">
												<input class="form-control" type="text" readonly value="{{$teacher->email}}">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Surname Name</label>
											<div class="col-sm-10">
												<input class="form-control @error('surname') is-invalid @enderror" type="text" name="surname" value="{{$teacher->surname}}">
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
												<input class="form-control @error('last_name') is-invalid @enderror" name="last_name" type="text" value="{{ $teacher->last_name }}">
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
														<option value="{{$class->id}}"  {{$teacher->classes['id'] == $class->id ? 'selected' : ''}}>{{$class->name}}</option>													
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
				</div> --}}
			</div>
		</div>
	</main>
@endsection