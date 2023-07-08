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
                    <h4>All Courses</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Courses</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">All Courses</a></li>
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
                                <h4 class="card-title">All Courses</h4>
                                <a href="{{ url('admin/courses/create') }}" class="btn btn-primary">+ Add new</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Course Name</th>
                                                <th>Description</th>
                                                <th>Code</th>
                                                <th>Price</th>
                                                <th>Duration</th>
                                                <th>Start Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($courses as $course)
                                            <tr>
                                                <td><img class="rounded-circle" width="35" src="images/profile/small/pic1.jpg" alt=""></td>
                                                <td>{{ $course->course_name }}</td>
                                                <td>{{ $course->course_description }}</td>
                                                <td>{{ $course->course_code }}</td>
                                                <td>{{ $course->course_price }}</td>
                                                <td>{{ $course->course_duration }}</td>
                                                <td>{{ $course->start_from }}</td>
                                                <td>
                                                    <a href="{{ url('admin/courses/' . $course->id) }}" class="btn btn-sm btn-info"><i class="la la-eye"></i></a>
                                                    <a href="{{ url('admin/courses', $course->id . '/edit') }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this staff member?')) { document.getElementById('delete-form').submit(); }">
                                                        <i class="la la-trash-o"></i>
                                                    </a>
                                                    <form id="delete-form" action="{{ url('admin/courses/' . $course->id) }}" method="POST" style="display: none;">
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
                            @foreach ($courses as $course)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-profile">
                                    <div class="card-header justify-content-end pb-0">
                                        <div class="dropdown">
                                            <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                <span class="dropdown-dots fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right border py-0">
                                                <div class="py-2">
                                                    <a class="dropdown-item" href="{{ url('admin/courses', $course->id) }}/edit">Edit</a>
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
                                            <h3 class="my-4">{{ $course->course_name }}</h3>
                                            <ul class="list-group mb-3 list-group-flush">
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Description:</span>
                                                    <strong>{{ $course->course_description }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Code:</span>
                                                    <strong>{{ $course->course_code }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Price:</span>
                                                    <strong>{{ $course->course_price }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Duration:</span>
                                                    <strong>{{ $course->course_duration }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Start Date:</span>
                                                    <strong>{{ $course->start_from }}</strong>
                                                </li>
                                            </ul>
                                            <a class="btn btn-outline-primary btn-rounded mt-3 px-4" href="{{ url('admin/courses', $course->id) }}">Read More</a>
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
