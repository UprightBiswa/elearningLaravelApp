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
                            <h4>Add Note</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Note</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Note</a></li>
                        </ol>
                    </div>
                </div>

				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Notes Details</h4>
							</div>
							<div class="card-body">
                                <form action="{{ url('admin/notes') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label class="form-label">Note Subject</label>
												<input type="text" name="note_subject" class="form-control" required>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
                                                <label for="class_id">Class</label>
                                                <select class="form-control" id="class_id" name="class_id" required>
                                                    <option value="">Select a class</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<label class="form-label">File</label>
												<input class="form-control-file" type="file" name="note_file" required>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label class="form-label">Date</label>
                                                <input name="note_date" class="datepicker-default form-control" id="note_date" placeholder="d-m-y" required>

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
