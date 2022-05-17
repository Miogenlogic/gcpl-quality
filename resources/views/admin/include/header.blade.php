@php
    $user_session=Session::get('user');
//print_r($user_session);die;
@endphp

<nav class="navbar navbar-top navbar-expand navbar-dark border-bottom" style="background-color: #040a09">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <h3 style="    color: white;
    text-align: center;
    margin-left: 359px;
    font-size: 18px;
    /* margin: 0px;">Quality Management System</h3>
            <!-- Search form -->
            <!--<form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Search" type="text">
                    </div>
                </div>
                <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </form>-->

            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                         data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                        <i class="ni ni-zoom-split-in"></i>
                    </a>
                </li>

                <!-- Notifications -->
                <!--<li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="ni ni-bell-55"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                        
                        <div class="px-3 py-3">
                            <h6 class="text-sm text-muted m-0 font-weight-500">You have <strong class="text-primary">13</strong>
                                notifications.</h6>
                        </div>
                        
                        <div class="list-group list-group-flush">
                            <a href="#!" class="list-group-item list-group-item-action">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        
                                        <img alt="Image placeholder" src="{{URL::asset('public/assets/img/theme/team-1.jpg')}}"
                                             class="avatar rounded-circle">
                                    </div>
                                    <div class="col ml--2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 class="mb-0 text-sm">QMS support</h4>
                                            </div>
                                            <div class="text-right text-muted">
                                                <small>2 hrs ago</small>
                                            </div>
                                        </div>
                                        <p class="text-sm mb-0">Service req #S231450 is processing.</p>
                                    </div>
                                </div>
                            </a>

                            <a href="quotation.html" class="list-group-item list-group-item-action">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        
                                        <img alt="Image placeholder" src="{{URL::asset('public/assets/img/theme/team-2.jpg')}}"
                                             class="avatar rounded-circle">
                                    </div>
                                    <div class="col ml--2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 class="mb-0 text-sm">QMS Support</h4>
                                            </div>
                                            <div class="text-right text-muted">
                                                <small>3 hrs ago</small>
                                            </div>
                                        </div>
                                        <p class="text-sm mb-0">Quotation for req #S231450 is ready to be downloaded.</p>
                                    </div>
                                </div>
                            </a>

                            <a href="#!" class="list-group-item list-group-item-action">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                       
                                        <img alt="Image placeholder" src="{{URL::asset('public/assets/img/theme/team-3.jpg')}}"
                                             class="avatar rounded-circle">
                                    </div>
                                    <div class="col ml--2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 class="mb-0 text-sm">Branch office</h4>
                                            </div>
                                            <div class="text-right text-muted">
                                                <small>5 hrs ago</small>
                                            </div>
                                        </div>
                                        <p class="text-sm mb-0">Service req #1234560 has been created.</p>
                                    </div>
                                </div>
                            </a>

                            <a href="#!" class="list-group-item list-group-item-action">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        
                                        <img alt="Image placeholder" src="{{URL::asset('public/assets/img/theme/team-5.jpg')}}"
                                             class="avatar rounded-circle">
                                    </div>
                                    <div class="col ml--2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 class="mb-0 text-sm">QMS support</h4>
                                            </div>
                                            <div class="text-right text-muted">
                                                <small>3 hrs ago</small>
                                            </div>
                                        </div>
                                        <p class="text-sm mb-0">Service req #S56470 has been approved.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <a href="#" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                    </div>
                </li>-->

                <!-- Quick App -->
                <!--<li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="ni ni-box-2" data-toggle="tooltip" data-placement="left" title="Shortcut links"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right">
                        <div class="row shortcuts px-4">
                            <a href="{/{url('admin/service-request-add')}}" class="col-6 shortcut-item">
                      <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                        <i class="ni ni-briefcase-24"></i>
                      </span>
                                <small>New service req.</small>
                            </a>
                            <a href="{/{url('admin/quotation-list')}}" class="col-6 shortcut-item">
                      <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                        <i class="ni ni-archive-2"></i>
                      </span>
                                <small>All Quotation</small>
                            </a>
                        </div>
                    </div>
                </li>-->
            </ul>

            <!-- Username -->
            <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                      
                      <i class="far fa-user"></i>
                    </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-500">{{$user_session['username']}}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">{{$user_session['email']}}</h6>
                        </div>

                        <div class="dropdown-divider"></div>
						<a href="{{url('admin/change-password')}}" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Change Password</span>
                        </a>
                        <a href="{{url('/logout')}}" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Header -->

<!-- Header -->

