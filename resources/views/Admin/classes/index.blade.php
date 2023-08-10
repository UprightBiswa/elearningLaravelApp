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
                    <h4>All Classes</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('http://127.0.0.1:8000/admin/adminDashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Classes</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">All Classes</a></li>
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
                                <h4 class="card-title">All Classes</h4>
                                <a href="{{ url('admin/classes/create') }}" class="btn btn-primary">+ Add new</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Class Name</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Course</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($classes as $class)
                                            <tr>
                                                <td><img class="rounded-circle" width="35" src="images/profile/small/pic1.jpg" alt=""></td>
                                                <td>{{ $class->class_name }}</td>
                                                <td>{{ $class->class_date }}</td>
                                                <td>{{ $class->class_time }}</td>
                                                <td>{{ $class->course->course_name }}</td>
                                                <td>
                                                    <a href="{{ url('admin/classes/' . $class->id) }}" class="btn btn-sm btn-info"><i class="la la-eye"></i></a>
                                                    <a href="{{ url('admin/classes', $class->id . '/edit') }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this staff member?')) { document.getElementById('delete-form').submit(); }">
                                                        <i class="la la-trash-o"></i>
                                                    </a>
                                                    <form id="delete-form" action="{{ url('admin/classes/' . $class->id) }}" method="POST" style="display: none;">
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
                            @foreach ($classes as $class)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-profile">
                                    <div class="card-header justify-content-end pb-0">
                                        <div class="dropdown">
                                            <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                <span class="dropdown-dots fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right border py-0">
                                                <div class="py-2">
                                                    <a class="dropdown-item" href="{{ url('admin/classes', $class->id) }}/edit">Edit</a>
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
                                            <h3 class="my-4">{{ $class->Class_name }}</h3>
                                            <ul class="list-group mb-3 list-group-flush">
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Description:</span>
                                                    <strong>{{ $class->Class_description }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Code:</span>
                                                    <strong>{{ $class->Class_code }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Price:</span>
                                                    <strong>{{ $class->Class_price }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Duration:</span>
                                                    <strong>{{ $class->Class_duration }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Start Date:</span>
                                                    <strong>{{ $class->start_from }}</strong>
                                                </li>
                                            </ul>
                                            <a class="btn btn-outline-primary btn-rounded mt-3 px-4" href="{{ url('admin/classes', $class->id) }}">Read More</a>
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
