@extends('layouts.admin')

@section('css')
<!-- Datatable -->
<link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
         @endif
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>All exams</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">exams</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">All exams</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab" class="nav-link btn-primary mr-1 show active">List View</a></li>
                    <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid View</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All exams</h4>
                                <a href="{{ url('admin/exams/create') }}" class="btn btn-primary">+ Add new</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>exam Subject</th>
                                                <th>Exam Date</th>
                                                <th>Exam duration</th>
                                                <th>Class</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($exams as $exam)
                                            <tr>
                                                <td><img class="rounded-circle" width="35" src="images/profile/small/pic1.jpg" alt=""></td>
                                                <td>{{ $exam->exam_subject }}</td>
                                                <td>{{ $exam->exam_date }}</td>
                                                <td>{{ $exam->exam_duration }}</td>
                                                <td>{{ $exam->Classes->class_name }}</td>
                                                <td>
                                                    <a href="{{ url('admin/exams/' . $exam->id) }}" class="btn btn-sm btn-info"><i class="la la-eye"></i></a>
                                                    <a href="{{ url('admin/exams', $exam->id . '/edit') }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this staff member?')) { document.getElementById('delete-form').submit(); }">
                                                        <i class="la la-trash-o"></i>
                                                    </a>
                                                    <form id="delete-form" action="{{ url('admin/exams/' . $exam->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="grid-view" class="tab-pane fade col-lg-12">
                        <div class="row">
                            @foreach ($exams as $exam)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-profile">
                                    <div class="card-header justify-content-end pb-0">
                                        <div class="dropdown">
                                            <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                <span class="dropdown-dots fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right border py-0">
                                                <div class="py-2">
                                                    <a class="dropdown-item" href="{{ url('admin/exams', $exam->id) }}/edit">Edit</a>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="text-center">
                                            <div class="profile-photo">
                                                <img src ="{{ asset('admin/images/profile/small/pic2.jpg') }}" width="100" class="img-fluid rounded-circle" alt="">
                                            </div>
                                            <h3 class="my-4">{{ $exam->exam_name }}</h3>
                                            <ul class="list-group mb-3 list-group-flush">
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Description:</span>
                                                    <strong>{{ $exam->exam_description }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Code:</span>
                                                    <strong>{{ $exam->exam_code }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Price:</span>
                                                    <strong>{{ $exam->exam_price }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Duration:</span>
                                                    <strong>{{ $exam->exam_duration }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Start Date:</span>
                                                    <strong>{{ $exam->start_from }}</strong>
                                                </li>
                                            </ul>
                                            <a class="btn btn-outline-primary btn-rounded mt-3 px-4" href="{{ url('admin/exams', $exam->id) }}">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- Datatable -->
<script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins-init/datatables.init.js') }}"></script>
@endsection
