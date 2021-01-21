@extends('admin.layouts.app')
@section('admin')

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Subjects</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                    <li>Subjects</li>
				</ul>
			</div>
			<!-- Card END -->
			<div class="row">
				<div class="col-lg-6 m-b30">
					<div class="widget-box">
						<div class="wc-title">
                            <h4>All Subjects</h4>
						</div>
						<div class="widget-inner">
							<div class="new-user-list">
                                <div class="widget-inner">
                                    <div class="orders-list">
                                        <ul>
                                            @foreach ($subjects as $subject)
                                                <li>
                                                    <span class="orders-title">
                                                        <a href="#" class="orders-title-name"><b>{{$sn++}}. {{ $subject->name }}</b></a>
                                                        <span class="orders-info">Created On: {{ date('D, M j, Y \a\t g:ia', strtotime($subject->created_at))}}</span>
                                                    </span>
                                                    <span class="orders-btn">
                                                        <a href="{{ url('admin/edit-subject', $subject->id) }}" class="btn button-sm green">Edit</a>
                                                        <a href="{{ url('admin/delete-subject', $subject->id) }}" class="btn button-sm red">Delete</a>
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
                @if ($mode == 'create')                    
                    <div class="col-lg-6 m-b30">
                        <div class="widget-box">
                            <div class="wc-title">
                                <h4>Create New Subject</h4>
                            </div>
                            <div class="widget-inner">
                                <form class="edit-profile m-b30" method="POST" action="{{ route('admin_create_subject') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="" placeholder="Subject Name">
                                                @error('name')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                </div>
                                                <div class="col-sm-7">
                                                    <button type="submit" class="btn green">Create</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @elseif ($mode == 'edit')                  
                    <div class="col-lg-6 m-b30">
                        <div class="widget-box">
                            <div class="wc-title">
                                <h4>Edit {{$subject->name}}</h4>
                            </div>
                            <div class="widget-inner">
                                <form class="edit-profile m-b30" method="POST" action="{{ route('admin_create_subject') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Edit Name</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" name="id" value="{{$subject->id}}">
                                                <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{$subject->name}}" placeholder="Subject Name">
                                                @error('name')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                </div>
                                                <div class="col-sm-7">
                                                    <button type="submit" class="btn green">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
			</div>
		</div>
	</main>
@endsection