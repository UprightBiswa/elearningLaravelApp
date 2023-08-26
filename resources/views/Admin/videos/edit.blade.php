@extends('layouts.admin')

@section('css')
<!-- Pick date -->
<link rel="stylesheet" href="{{ asset('admin/vendor/pickadate/themes/default.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendor/pickadate/themes/default.date.css') }}">
@endsection

@section('content')
   <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit video</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('admin/adminDashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('admin/videos') }}">videos</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Edit video</a></li>
                        </ol>
                    </div>
                </div>

				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">video Details</h4>
							</div>
							<div class="card-body">
                                <form action="{{ url('admin/videos/'.$video->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label class="form-label">video Subject</label>
												<input type="text" name="video_subject" class="form-control" value="{{ $video->video_subject }}" required>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
                                                <label for="class_id">Class</label>
                                                <select class="form-control" id="class_id" name="class_id" required>
                                                    <option value="">Select a class</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}" {{ $class->id == $video->class_id ? 'selected' : '' }}>
                                                            {{ $class->class_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">File</label>
                                                <input class="form-control-file" type="file" name="video_file">
                                                @if ($video->video_file)
                                                <br>
                                                <p>Current File: <a href="{{ asset('storage/' . $video->video_file) }}" target="_blank">{{ $video->video_file }}</a></p>
                                                @endif
                                            </div>
                                        </div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label class="form-label">Date</label>
                                                <input name="video_date" class="datepicker-default form-control" id="video_date" placeholder="d-m-y" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $video->video_date)->format('d F, Y') }}" required>
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12">
											<button type="submit" class="btn btn-primary">Update</button>
											<button type="reset" class="btn btn-light">Cancel</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection

@section('js')
 <!-- pickdate -->
 <script src="{{ asset('admin/vendor/pickadate/picker.js') }}"></script>
 <script src="{{ asset('admin/vendor/pickadate/picker.time.js') }}"></script>
 <script src="{{ asset('admin/vendor/pickadate/picker.date.js') }}"></script>

 <!-- Pickdate -->
 <script src="{{ asset('admin/js/plugins-init/pickadate-init.js') }}"></script>
@endsection
