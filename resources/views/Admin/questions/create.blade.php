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
                                <!-- Add questions and options -->
                                <hr>
                                <h4>Add Questions and Options</h4>
                                <div id="questions-container">
                                    @foreach ($questions as $key => $question)
                                        <div class="question">
                                            <div class="question-header">
                                                <span class="question-number">Question {{ $key + 1 }}</span>
                                                <button type="button" class="btn btn-danger btn-sm delete-question">Delete
                                                    Question</button>
                                            </div>
                                            <div class="question-body">
                                                <label>Question:</label>
                                                <input type="text" name="questions[]" class="form-control" required
                                                    value="{{ old('questions.' . $key, $question['question_text']) }}">
                                                <div class="options-container">
                                                    @foreach ($question['options'] as $index => $option)
                                                        <div class="option">
                                                            <input type="text"
                                                                name="options[{{ $key }}][{{ $index }}][text]"
                                                                class="form-control option-input" required
                                                                placeholder="Option {{ chr(65 + $index) }}"
                                                                value="{{ old('options.' . $key . '.' . $index . '.text', $option['option_text']) }}">
                                                            <label class="radio-label">
                                                                <input type="radio"
                                                                    name="correct_answers[{{ $key }}]"
                                                                    value="{{ chr(65 + $index) }}"
                                                                    {{ old('correct_answers.' . $key) == chr(65 + $index) ? 'checked' : '' }}>
                                                                {{ chr(65 + $index) }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" class="btn btn-primary" id="add-question">Add Another
                                    Question</button>
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
    <!-- Content body end -->
@endsection

@section('js')
    <!-- pickdate -->
    <script src="{{ asset('admin/vendor/pickadate/picker.js') }}"></script>
    <script src="{{ asset('admin/vendor/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('admin/vendor/pickadate/picker.date.js') }}"></script>

    <!-- Pickdate -->
    <script src="{{ asset('admin/js/plugins-init/pickadate-init.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Function to create HTML for a new question
            function createQuestionHTML() {
                return `
                <div class="question">
                    <div class="question-header">
                        <span class="question-number">Question ${$(".question").length + 1}</span>
                        <button type="button" class="btn btn-danger btn-sm delete-question">Delete Question</button>
                    </div>
                    <div class="question-body">
                        <label>Question:</label>
                        <input type="text" name="questions[]" class="form-control" required>
                        <div class="options-container">
                            <div class="option">
                                <input type="text" name="options[][text]" class="form-control" required placeholder="Option A">
                                <label class="radio-label">
                                    <input type="radio" name="correct_answers[${$(".question").length}]" value="A">
                                    A
                                </label>
                            </div>
                            <div class="option">
                                <input type="text" name="options[][text]" class="form-control" required placeholder="Option B">
                                <label class="radio-label">
                                    <input type="radio" name="correct_answers[${$(".question").length}]" value="B">
                                    B
                                </label>
                            </div>
                            <div class="option">
                                <input type="text" name="options[][text]" class="form-control" required placeholder="Option C">
                                <label class="radio-label">
                                    <input type="radio" name="correct_answers[${$(".question").length}]" value="C">
                                    C
                                </label>
                            </div>
                            <div class="option">
                                <input type="text" name="options[][text]" class="form-control" required placeholder="Option D">
                                <label class="radio-label">
                                    <input type="radio" name="correct_answers[${$(".question").length}]" value="D">
                                    D
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>`;
            }

            // Add another question
            $("#add-question").click(function() {
                var questionHTML = createQuestionHTML();
                $("#questions-container").append(questionHTML);
            });

            // Delete a question
            $("#questions-container").on("click", ".delete-question", function() {
                $(this).closest(".question").remove();
                // Update question numbers
                $(".question-number").each(function(index) {
                    $(this).text(`Question ${index + 1}`);
                });
            });
        });
    </script>
@endsection
