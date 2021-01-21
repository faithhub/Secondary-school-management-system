@extends('admin.layouts.app')
@section('admin')

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Teachers</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                    <li>Teachers</li>
				</ul>
			</div>
			<!-- Card END -->
			<div class="row">
				<div class="col-lg-6 m-b30">
					<div class="widget-box">
						<div class="wc-title">
                            <h4>Teachers</h4>
						</div>
						<div class="widget-inner">
							<div class="new-user-list">
								<ul>
									@foreach ($teachers as $teacher)
                                        <li>
											@if ($teacher->avatar != null)
                                            <span class="new-users-pic">
                                                <img src="{{ asset('uploads/teacher_avatar/'.$teacher->avatar) }}" alt=""/>
                                            </span>												
											@else
                                            <span class="new-users-pic">
                                                <img src="{{ asset('uploads/avatar_pics.jpg') }}" alt=""/>
                                            </span>												
											@endif
                                            <span class="new-users-text">
												<a href="{{ url('admin/view-class') }}" class="new-users-name"><b>{{$sn++}}. {{$teacher->surname}} {{$teacher->last_name}}</b></a>  
												@if ($teacher->status == 'Active')
                                                <span class="new-users-info"><span class="btn button-sm green radius-xl">{{$teacher->status}}</span></span><br>   													
												@else
                                                <span class="new-users-info"><span class="btn button-sm red radius-xl">{{$teacher->status}}</span></span><br>   													
												@endif                                           
                                                <span class="new-users-info"><b>ID: {{$teacher->email ?? ''}}</b></span><br>   
                                                <span class="new-users-info"><b>{{$teacher->subjects['name'] ?? ''}}</b></span><br>             
                                                <span class="new-users-info">Created On: {{ date('D, M j, Y \a\t g:ia', strtotime($teacher->created_at))}} </span>
                                            </span>
                                            <span class="new-users-btn">
												@if ($teacher->status == 'Active')
                                                <a href="{{ url('admin/block-teacher', $teacher->id) }}" class="btn button-sm red">Block</a>													
												@else
                                                <a href="{{ url('admin/unblock-teacher', $teacher->id) }}" class="btn button-sm green">Unblock</a>													
												@endif
                                                <a href="{{ url('admin/edit-teacher', $teacher->id) }}" class="btn button-sm green">Edit</a>
                                                <a href="{{ url('admin/delete-teacher', $teacher->id) }}" class="btn button-sm red">Delete</a>
                                            </span>
                                            <span class="orders-btn">
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                                {{$teachers->links()}}
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 m-b30">
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
											<label class="col-sm-2 col-form-label">Select Subject</label>
											<div class="col-sm-10">
												<select class="form-control @error('subject_id') is-invalid @enderror" name="subject_id">
													<option value="">Select Subject</option>
													@foreach ($subjects as $subject)
														<option value="{{$subject->id}}">{{$subject->name}}</option>													
													@endforeach
												</select>
												@error('subject_id')
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
								<h4>Edit <b>{{$teacher_one->surname}}  {{$teacher_one->last_name}}</b></h4>
							</div>
							<div class="widget-inner">
								<form class="edit-profile m-b30" method="POST" action="{{ route('admin_create_teacher') }}">
									@csrf
									<div class="">
										<div class="form-group row">
											<div class="col-sm-12 ml-auto text-center">
												@if ($teacher_one->avatar != null)
												<span class="new-users-pic">
													<img src="{{ asset('uploads/teacher_avatar/'.$teacher_one->avatar) }}" alt="" width="150px" height="150px"/>
												</span>												
												@else
												<span class="new-users-pic">
													<img src="{{ asset('uploads/avatar_pics.jpg') }}" alt="" width="150px" height="150px"/>
												</span>												
												@endif
												<h4><b>{{$teacher_one->surname}}  {{$teacher_one->last_name}}</b></h4>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Teacher ID</label>
											<div class="col-sm-10">
												<input type="hidden" name="id" value="{{$teacher_one->id}}">
												<input class="form-control" type="text" readonly value="{{$teacher_one->email}}">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Surname Name</label>
											<div class="col-sm-10">
												<input class="form-control @error('surname') is-invalid @enderror" type="text" name="surname" value="{{$teacher_one->surname}}">
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
												<input class="form-control @error('last_name') is-invalid @enderror" name="last_name" type="text" value="{{ $teacher_one->last_name }}">
												@error('last_name')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Select Class{{$teacher_one->subjects['id']}}</label>
											<div class="col-sm-10">
												<select class="form-control @error('subject_id') is-invalid @enderror" name="subject_id">
													<option value="">Select Class</option>
													@foreach ($subjects as $subject)
														<option value="{{$subject->id}}"  {{$teacher_one->subjects['id'] == $subject->id ? 'selected' : ''}}>{{$subject->name}}</option>													
													@endforeach
												</select>
												@error('subject_id')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										{{-- <div class="form-group row">
											<div class="col-sm-10  ml-auto">
												<h6>Note: Surname is password by default in lowercase</h6>
											</div>
										</div>								 --}}
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
			</div>
		</div>
	</main>
@endsection