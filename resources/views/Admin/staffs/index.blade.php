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
                        <h4>All Staff</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Staff</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">All Staff</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab"
                                class="nav-link btn-primary mr-1 show active">List View</a></li>
                        <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid
                                View</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Staff </h4>
                                    <a href="{{ url('admin/staffs/create') }}" class="btn btn-primary">+ Add new</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example5" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($staffMembers as $staff)
                                                    <tr>
                                                        <td><img class="rounded-circle" width="35"
                                                                src="{{ asset('admin/images/profile/small/pic1.jpg') }}"
                                                                alt=""></td>
                                                        <td>{{ $staff->name }}</td>
                                                        <td>{{ $staff->phone_number }}</td>
                                                        <td><a
                                                                href="mailto:{{ $staff->email }}"><strong>{{ $staff->email }}</strong></a>
                                                        </td>
                                                        <td>{{ $staff->address }}</td>
                                                        <td>{{ $staff->role->name }}</td>
                                                        <td>{{ $staff->status ? 'Active' : 'Not Active' }}</td>
                                                        <td>
                                                        <a href="{{ url('admin/staffs/' . $staff->id . '/edit') }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                        <a href="{{ url('admin/staffs', $staff->id) }}" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                        <a href="{{ url('admin/staffs', $staff) }}" class="btn btn-sm btn-info"><i class="la la-eye"></i></a>
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
                                @foreach ($staffMembers as $staff)
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-profile">
                                            <div class="card-header justify-content-end pb-0">
                                                <div class="dropdown">
                                                    <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                        <span class="dropdown-dots fs--1"></span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right border py-0">
                                                        <div class="py-2">
                                                            <a class="dropdown-item"
                                                                href="{{ url('admin/staffs/edit', $staff->id) }}">Edit</a>
                                                            <a class="dropdown-item text-danger"
                                                                href="{{ url('admin/staffs/destroy', $staff->id) }}">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body pt-2">
                                                <div class="text-center">
                                                    <div class="profile-photo">
                                                        <img src="{{ asset('admin/images/profile/small/pic2.jpg') }}"
                                                            width="100" class="img-fluid rounded-circle" alt="">
                                                    </div>
                                                    <h3 class="my-4">{{ $staff->name }}</h3>
                                                    <ul class="list-group mb-3 list-group-flush">
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Designation:</span>
                                                            <strong>{{ $staff->role->name }}</strong>
                                                        </li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Phone No.:</span>
                                                            <strong>{{ $staff->phone_number }}</strong>
                                                        </li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Email:</span>
                                                            <strong>{{ $staff->email }}</strong>
                                                        </li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Address:</span>
                                                            <strong>{{ $staff->address }}</strong>
                                                        </li>
                                                    </ul>
                                                    <a class="btn btn-outline-primary btn-rounded mt-3 px-4"
                                                        href="{{ url('admin/staffs/show', $staff->id) }}">Read More</a>
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
