

@php
    $setting = App\Models\Setting::first();
@endphp

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
   
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/storage/'.$setting->favicon)}}">
    <title>{{$setting->name }}</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="index-2.html" class="logo">
					<img class="rounded-circle" src="{{asset('public/storage/'.$setting->logo)}}" width="35"  alt=""> <span>{{$setting->name}} </span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
               
                
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            @if (auth()->user()->image != '')
							<img class="rounded-circle" src="{{asset('public/storage/'.auth()->user()->image)}}" width="24" alt="Admin">
							<span class="status online"></span>
                                
                            @else
                            <img class="rounded-circle" src="{{asset('assets/img/user.jpg')}}" width="24" alt="Admin">
							<span class="status online"></span>
                            @endif
						
						</span>
						<span>{{auth()->user()->f_name}}</span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="{{route('myprofile',auth()->user()->id)}}">My Profile</a>
						{{-- <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a> --}}
                        <form action="{{route('logout')}}" method="post">
                            @csrf
						    <button type="submit" class="dropdown-item" >Logout</button>
                        </form>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{route('myprofile',auth()->user()->id)}}">My Profile</a>
                   
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item" >Logout</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="">
                            <a href="{{route('home')}}"><i class="fa fa-dashboard"></i> <span>Dashboards</span></a>
                        </li>
						<!-- <li>
                            <a href="doctors.php"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                        </li> -->
                        <li class="submenu">
							<a href="#"><i class="fa fa-flag-o"></i> <span> Patients </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="{{route('patients.create')}}"> Add Patient </a></li>
								<li><a href="{{route('patients.index')}}"> Patient Lists </a></li>
							</ul>
						</li>
                      
                        @if (auth()->user()->role != 2)
                        <li>
                            <a href="{{route('departments.index')}}"><i class="fa fa-hospital-o"></i> <span>Departments</span></a>
                        </li>
                        
                        
						<li class="submenu">
							<a href="#"><i class="fa fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
                            <li><a href="{{route('employees.create')}}">Add Employee</a></li>
								<li><a href="{{route('employees.index')}}">Employees List</a></li>
								
									</ul>
						</li>
                        <li class="submenu">
							<a href="#"><i class="fa fa-id-badge"></i> <span> Roles </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
                            <li><a href="{{route('roles.create')}}">Add Role</a></li>
								<li><a href="{{route('roles.index')}}">Role List</a></li>
								
								
							</ul>
						</li>
                        <li class="submenu">
							<a href="#"><i class="fa fa-user"></i> <span> Users </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
                            <li><a href="{{route('users.create')}}">Add User</a></li>
								<li><a href="{{route('users.index')}}">Users List</a></li>
								
								</ul>
						</li>
                        @endif
					
                          @if (auth()->user()->role != 2)
						<li class="submenu">
							<a href="#"><i class="fa fa-flag-o"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="{{route('report-patient.index')}}"> Patients Report </a></li>
								<li><a href="{{route('daily.report')}}"> Daily Reports </a></li>
								<li><a href="{{route('dailydepartsummary.report')}}">  Department Summary </a></li>
							</ul>
						</li>
                        @endif
                        @if (auth()->user()->role != 2 )
                            
                        
                        <li>
                            <a href="{{route('settings.index')}}"><i class="fa fa-cog"></i> <span>Settings</span></a>
                        </li>
                        @endif
                        
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @yield('content')
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>

	<script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
	<script src="{{asset('assets/js/moment.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{asset('assets/js/app.js')}}"></script>
   
</body>