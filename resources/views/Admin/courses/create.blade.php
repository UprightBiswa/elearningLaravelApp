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

                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Course</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Course</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Course</a></li>
                        </ol>
                    </div>
                </div>

				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Courses Details</h4>
							</div>
							<div class="card-body">
                                <form action="{{ url('admin/courses') }}" method="POST">
                                    @csrf
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label class="form-label">Course Name</label>
												<input type="text" name="course_name" class="form-control" required>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label class="form-label">Course Code</label>
												<input type="text" class="form-control" name="course_code" required>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<label class="form-label">Course Details</label>
												<textarea class="form-control" rows="1" name="course_description" required></textarea>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label class="form-label">Start From</label>
                                                <input name="start_from" class="datepicker-default form-control" id="datepicker" placeholder="d-m-y" required>

											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label class="form-label">Course Duration</label>
												<input type="text" class="form-control" name="course_duration" required>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label class="form-label">Course Price</label>
												<input type="text" class="form-control" name="course_price" required>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12">
											<button type="submit" class="btn btn-primary">Submit</button>
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
