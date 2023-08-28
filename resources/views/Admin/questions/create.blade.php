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
                            <h4>Add Question</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Question</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Question</a></li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Question Details</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('admin/questions') }}" method="POST">
                                    @csrf

                                    <!-- Exam Name -->
                                    <div class="form-group">
                                        <label for="exam_id">Select Exam:</label>
                                        <select class="form-control" name="exam_id" id="exam_id" required>
                                            <option value="" disabled selected>Select an exam</option>
                                            @foreach ($exams as $exam)
                                                <option value="{{ $exam->id }}">{{ $exam->exam_subject }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Add questions and options -->
                                    <hr>
                                    <h4>Add Questions and Options</h4>
                                    <div id="questions-container">
                                        <div class="question">
                                            <label>Question:</label>
                                            <input type="text" name="questions[]" class="form-control" required>
                                            <label>Options:</label>
                                            <input type="text" name="options[][text]" class="form-control" required placeholder="Option A">
                                            <input type="text" name="options[][text]" class="form-control" required placeholder="Option B">
                                            <input type="text" name="options[][text]" class="form-control" required placeholder="Option C">
                                            <input type="text" name="options[][text]" class="form-control" required placeholder="Option D">
                                            <label>Correct Answer (A, B, C, D):</label>
                                            <input type="text" name="correct_answers[]" class="form-control" required>
                                            <button type="button" class="btn btn-danger btn-sm mt-2 delete-question">Delete Question</button>
                                            <hr>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="add-question">Add Another Question</button>
                                    <hr>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-light">Cancel</button>
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

 <script>
    $(document).ready(function () {
        // Add another question
        $("#add-question").click(function () {
            var questionHTML = `
            <div class="question">
                <label>Question:</label>
                <input type="text" name="questions[]" class="form-control" required>
                <label>Options:</label>
                <input type="text" name="options[][text]" class="form-control" required placeholder="Option A">
                <input type="text" name="options[][text]" class="form-control" required placeholder="Option B">
                <input type="text" name="options[][text]" class="form-control" required placeholder="Option C">
                <input type="text" name="options[][text]" class="form-control" required placeholder="Option D">
                <label>Correct Answer (A, B, C, D):</label>
                <input type="text" name="correct_answers[]" class="form-control" required>
                <button type="button" class="btn btn-danger btn-sm mt-2 delete-question">Delete Question</button>
                <hr>
            </div>
            `;
            $("#questions-container").append(questionHTML);
        });

        // Delete a question
        $("#questions-container").on("click", ".delete-question", function () {
            $(this).closest(".question").remove();
        });
    });
 </script>
@endsection
