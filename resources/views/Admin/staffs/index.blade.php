@extends('layouts.admin')
@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
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
                                    <a href="add-staff.html" class="btn btn-primary">+ Add new</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example5" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Designation</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Joining Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><img class="rounded-circle" width="35"
                                                            src="images/profile/small/pic1.jpg" alt=""></td>
                                                    <td>Tiger Nixon</td>
                                                    <td>Clerk</td>
                                                    <td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
                                                    <td><a href="javascript:void(0);"><strong>info@example.com</strong></a>
                                                    </td>
                                                    <td>#8901 Demo Road </td>
                                                    <td>2011/04/25</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i
                                                                class="la la-pencil"></i></a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i
                                                                class="la la-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="rounded-circle" width="35"
                                                            src="images/profile/small/pic2.jpg" alt=""></td>
                                                    <td>Garrett Winters</td>
                                                    <td>Accountant</td>
                                                    <td><a href="javascript:void(0);"><strong>987 654 3210</strong></a></td>
                                                    <td><a href="javascript:void(0);"><strong>info@example.com</strong></a>
                                                    </td>
                                                    <td>#8901 Demo Road </td>
                                                    <td>2011/07/25</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i
                                                                class="la la-pencil"></i></a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i
                                                                class="la la-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="rounded-circle" width="35"
                                                            src="images/profile/small/pic3.jpg" alt=""></td>
                                                    <td>Ashton Cox</td>
                                                    <td>Junior Technical</td>
                                                    <td><a href="javascript:void(0);"><strong>(123) 4567 890</strong></a>
                                                    </td>
                                                    <td><a href="javascript:void(0);"><strong>info@example.com</strong></a>
                                                    </td>
                                                    <td>#8901 Demo Road </td>
                                                    <td>2009/01/12</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i
                                                                class="la la-pencil"></i></a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i
                                                                class="la la-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="rounded-circle" width="35"
                                                            src="images/profile/small/pic4.jpg" alt=""></td>
                                                    <td>Cedric Kelly</td>
                                                    <td>Developer</td>
                                                    <td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
                                                    <td><a href="javascript:void(0);"><strong>info@example.com</strong></a>
                                                    </td>
                                                    <td>#8901 Demo Road </td>
                                                    <td>2012/03/29</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i
                                                                class="la la-pencil"></i></a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i
                                                                class="la la-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="rounded-circle" width="35"
                                                            src="images/profile/small/pic5.jpg" alt=""></td>
                                                    <td>Airi Satou</td>
                                                    <td>Accountant</td>
                                                    <td><a href="javascript:void(0);"><strong>987 654 3210</strong></a></td>
                                                    <td><a href="javascript:void(0);"><strong>info@example.com</strong></a>
                                                    </td>
                                                    <td>#8901 Demo Road </td>
                                                    <td>2008/11/28</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i
                                                                class="la la-pencil"></i></a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i
                                                                class="la la-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="rounded-circle" width="35"
                                                            src="images/profile/small/pic6.jpg" alt=""></td>
                                                    <td>Brielle Williamson</td>
                                                    <td>Specialist</td>
                                                    <td><a href="javascript:void(0);"><strong>123 456 7890</strong></a>
                                                    </td>
                                                    <td><a href="javascript:void(0);"><strong>info@example.com</strong></a>
                                                    </td>
                                                    <td>#8901 Demo Road </td>
                                                    <td>2012/12/02</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i
                                                                class="la la-pencil"></i></a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i
                                                                class="la la-trash-o"></i></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><img class="rounded-circle" width="35"
                                                            src="images/profile/small/pic2.jpg" alt=""></td>
                                                    <td>Quinn Flynn</td>
                                                    <td>Support Lead</td>
                                                    <td><a href="javascript:void(0);"><strong>(123) 4567 890</strong></a>
                                                    </td>
                                                    <td><a href="javascript:void(0);"><strong>info@example.com</strong></a>
                                                    </td>
                                                    <td>#8901 Demo Road </td>
                                                    <td>2013/03/03</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i
                                                                class="la la-pencil"></i></a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i
                                                                class="la la-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="grid-view" class="tab-pane fade col-lg-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="card card-profile">
                                        <div class="card-header justify-content-end pb-0">
                                            <div class="dropdown">
                                                <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                    <span class="dropdown-dots fs--1"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0">
                                                    <div class="py-2">
                                                        <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                        <a class="dropdown-item text-danger"
                                                            href="javascript:void(0);">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>





                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="card card-profile">
                                        <div class="card-header justify-content-end pb-0">
                                            <div class="dropdown">
                                                <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                    <span class="dropdown-dots fs--1"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0">
                                                    <div class="py-2">
                                                        <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                        <a class="dropdown-item text-danger"
                                                            href="javascript:void(0);">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-2">
                                            <div class="text-center">
                                                <div class="profile-photo">
                                                    <img src="images/profile/small/pic10.jpg" width="100"
                                                        class="img-fluid rounded-circle" alt="">
                                                </div>
                                                <h3 class="my-4">Jackson</h3>
                                                <ul class="list-group mb-3 list-group-flush">
                                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                                        <span class="mb-0">Designation :</span><strong>Clerk</strong>
                                                    </li>
                                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                                        <span class="mb-0">Phone No. :</span><strong>+01 123 456
                                                            7890</strong>
                                                    </li>
                                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                                        <span class="mb-0">Email:</span><strong>info@example.com</strong>
                                                    </li>
                                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                                        <span class="mb-0">Address:</span><strong>#8901 Marmora
                                                            Road</strong>
                                                    </li>
                                                </ul>
                                                <a class="btn btn-outline-primary btn-rounded mt-3 px-4"
                                                    href="staff-profile.html">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
