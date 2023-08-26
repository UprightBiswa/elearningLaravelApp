    <!--**********************************
            Sidebar start
        ***********************************-->
    <div class="dlabnav">
        <div class="dlabnav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label first">Main Menu</li>
                <li><a class="ai-icon" href="{{ url('admin/adminDashboard') }}" aria-expanded="false">
                        <i class="la la-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>


                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-users"></i>
                        <span class="nav-text">Students</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('admin/students') }}">All Students</a></li>
                        <li><a href="{{ url('admin/students/create') }}">Add Students</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-graduation-cap"></i>
                        <span class="nav-text">Courses</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('admin/courses') }}">All Courses</a></li>
                        <li><a href="{{ url('admin/courses/create') }}">Add Courses</a></li>

                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-graduation-cap"></i>
                        <span class="nav-text">Classes</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('admin/classes') }}">All Classes</a></li>
                        <li><a href="{{ url('admin/classes/create') }}">Add Classes</a></li>

                    </ul>
                </li>

                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-users"></i>
                        <span class="nav-text">Staff</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('admin/staffs') }}">All Staff</a></li>
                        <li><a href="{{ url('admin/staffs/create') }}">Add Staff</a></li>

                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-gift"></i>
                        <span class="nav-text">Notes</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('admin/notes') }}">All Notes</a></li>
                        <li><a href="{{ url('admin/notes/create') }}">Add Notes</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-book"></i>
                        <span class="nav-text">Exams</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('admin/exams') }}">All Exams</a></li>
                        <li><a href="{{ url('admin/exams/create') }}">Add Exams</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-gift"></i>
                        <span class="nav-text">Videos</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('admin/videos') }}">All Videos</a></li>
                        <li><a href="{{ url('admin/videos/create') }}">Add Videos</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-gift"></i>
                    <span class="nav-text">Qustions</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('admin/questions') }}">All questions</a></li>
                    <li><a href="{{ url('admin/questions/create') }}">Add questions</a></li>
                </ul>
            </li>
            </ul>
        </div>
    </div>
    <!--**********************************
            Sidebar end
        ***********************************-->
