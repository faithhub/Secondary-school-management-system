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
				<div class="col-lg-6 m-b30">
					<div class="widget-box">
						<div class="wc-title">
                            <h4>All Classes</h4>
						</div>
						<div class="widget-inner">
							<div class="orders-list">
								<ul>
                                    @foreach ($classes as $class)
                                        <li>
                                            <span class="orders-title">
                                                <a href="{{ url('admin/view-class', $class[0]['class_id']) }}" class="orders-title-name"><b>{{$sn++}}. {{ $class[0]['name'] }}</b></a>
                                                {{-- <span class="orders-info">Student:</span><br>
                                                <span class="orders-info">Teacher:</span><br> --}}
                                                <span class="orders-info">Created On: {{ date('D, M j, Y \a\t g:ia', strtotime($class[0]['created_at']))}}</span>
                                            </span>
                                            <span class="orders-btn">
                                                <a href="{{ url('admin/view-class', $class[0]['class_id']) }}" class="btn button-sm green">View</a>
                                                <a href="{{ url('admin/edit-class', $class[0]['class_id']) }}" class="btn button-sm green">Edit</a>
                                                <a href="{{ url('admin/delete-class', $class[0]['class_id']) }}" class="btn button-sm red">Delete</a>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
							</div>
                        </div>
                        <div class="text-right mr-2 mb-3">                            
                            {{-- {{$classes->links()}} --}}
                        </div>
					</div>
				</div>
				<div class="col-lg-6 m-b30">
                    @if ($mode == 'create')                        
                        <div class="widget-box">
                            <div class="wc-title">
                                <h4>Create New class</h4>
                            </div>
                            <div class="widget-inner">
                                <form class="edit-profile m-b30" method="POST" action="{{ route('admin_create_class') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Name:</label>
                                            <div class="col-sm-10">
                                                <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name') }}" placeholder="Class Name">
                                                @error('name')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Choose Subject:</label>
                                            <div class="col-sm-10"><!-- Default checkbox -->
                                                @foreach ($subjects as $subject)                                                    
                                                    <div class="form-check">
                                                        <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value="{{$subject->id}}"
                                                        name="subject[]"
                                                        id="flexCheckDefault"
                                                        />
                                                        <label class="form-check-label" for="">
                                                            {{$subject->name}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                                @error('subject')
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
                    @elseif ($mode == 'edit')                       
                        <div class="widget-box">
                            <div class="wc-title">
                                <h4>Edit {{$class_me[$class_id][0]['name']}}</h4>
                            </div>
                            <div class="widget-inner">
                                <form class="edit-profile m-b30" method="POST" action="{{ route('admin_create_class') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" value="{{ $class_me[$class_id][0]['id']}}" name="id">
                                                <input type="hidden" value="{{ $class_me[$class_id][0]['class_id']}}" name="class_id">
                                                <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{ $class_me[$class_id][0]['name'] }}" placeholder="Class Name">
                                                @error('name')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Choose Subject:</label>
                                            <div class="col-sm-10"><!-- Default checkbox -->
                                                @foreach ($subjects as $subject)
                                                    <div class="form-check">
                                                        <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value="{{$subject->id}}"
                                                        name="subject[]"
                                                        id="flexCheckDefault"
                                                        @if (in_array($subject->id, $subs)))
                                                        checked
                                                        @endif
                                                        />
                                                        <label class="form-check-label" for="">
                                                            {{$subject->name}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                                @error('subject')
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
                    @endif
				</div>
			</div>
		</div>
	</main>
@endsection