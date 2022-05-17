@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Completed projects</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Project listing</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body')

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">Completed projects</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Project</th>
                                    <th scope="col">Assigned to</th>
                                    <th scope="col" class="sort" data-sort="startend-date">Estm. start & end date</th>
                                    <th scope="col" class="sort" data-sort="assigned-date">Assigned date</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col" class="sort" data-sort="status">Status</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <tr>
                                    <td>Transmission comp. Assy.</td>
                                    <td class="font-weight-500">Engg. Assy.</td>
                                    <td>11/16/2019-12/20/2019</td>
                                    <td>11/16/2019</td>
                                    <td>TATA STEEL LTD</td>
                                    <td><span class="badge badge-success">completed</span></td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{url('admin/project-details')}}">Project details</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hyd. comp. Assy.</td>
                                    <td class="font-weight-500">Engg. Assy.</td>
                                    <td>11/16/2019-12/20/2019</td>
                                    <td>11/16/2019</td>
                                    <td>TATA STEEL LTD</td>
                                    <td><span class="badge badge-success">completed</span></td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{url('admin/sproject-details')}}">Project details</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Engine. comp. Assy.</td>
                                    <td class="font-weight-500">Engg. Assy.</td>
                                    <td>11/16/2019-12/20/2019</td>
                                    <td>11/16/2019</td>
                                    <td>TATA STEEL LTD</td>
                                    <td><span class="badge badge-success">completed</span></td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{url('admin/project-details')}}">Project details</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Something more</td>
                                    <td class="font-weight-500">some dept.</td>
                                    <td>11/16/2019-12/20/2019</td>
                                    <td>11/16/2019</td>
                                    <td>TATA STEEL LTD</td>
                                    <td><span class="badge badge-success">completed</span></td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{url('admin/project-details')}}">View project</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Transmission comp. Assy.</td>
                                    <td class="font-weight-500">Engg. Assy.</td>
                                    <td>11/16/2019-12/20/2019</td>
                                    <td>11/16/2019</td>
                                    <td>TATA STEEL LTD</td>
                                    <td><span class="badge badge-success">completed</span></td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{url('admin/project-details')}}">Project details</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hyd. comp. Assy.</td>
                                    <td class="font-weight-500">Engg. Assy.</td>
                                    <td>11/16/2019-12/20/2019</td>
                                    <td>11/16/2019</td>
                                    <td>TATA STEEL LTD</td>
                                    <td><span class="badge badge-success">completed</span></td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{url('admin/project-details')}}">Project details</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Engine. comp. Assy.</td>
                                    <td class="font-weight-500">Engg. Assy.</td>
                                    <td>11/16/2019-12/20/2019</td>
                                    <td>11/16/2019</td>
                                    <td>TATA STEEL LTD</td>
                                    <td><span class="badge badge-success">completed</span></td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{url('admin/project-details')}}">Project details</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Something more</td>
                                    <td class="font-weight-500">some dept.</td>
                                    <td>11/16/2019-12/20/2019</td>
                                    <td>11/16/2019</td>
                                    <td>TATA STEEL LTD</td>
                                    <td><span class="badge badge-success">completed</span></td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{url('admin/project-details')}}">View project</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
@section('after_script')
    <script src="{{URL::asset('public/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
@endsection