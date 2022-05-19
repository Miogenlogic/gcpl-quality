@extends('admin.include.layout')
<!-- Project List -->

@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Store Dashboard</h6>
                    <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="../branch-office/index.html"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Default</li>
                      </ol>
                    </nav> -->
                </div>
            </div>

            <!-- Card stats -->
            <div class="row">

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/projects-open-list')}}"> Total<br> number</a></h5>
                                    <span class="h2 font-weight-bold mb-0">350,897</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-default text-white rounded-circle shadow">
                                        <i class="ni ni-briefcase-24"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/projects-open-list')}}">With small deviation</a></h5>
                                    <span class="h2 font-weight-bold mb-0">2,356</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="ni ni-briefcase-24"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 1.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/projects-open-list')}}">With high deviation</a></h5>
                                    <span class="h2 font-weight-bold mb-0">924</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-briefcase-24"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/projects-open-list')}}">Without deviation</a></h5>
                                    <span class="h2 font-weight-bold mb-0">5,000</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-briefcase-24"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
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
                            <h3 class="mb-0">Projects with high deviation</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabe1" style="overflow-x: hidden;">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Project Id</th>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Assigned to</th>
                                    <th scope="col" class="sort" data-sort="startend-date">Estm. start & end date</th>
                                    <!--<th scope="col" class="sort" data-sort="assigned-date">Assigned date</th>-->
                                    <th scope="col">Customer</th>
                                    <th scope="col" class="sort" data-sort="status">Status</th>
                                    <!--<th scope="col"></th>-->
                                </tr>
                                </thead>
                                <!--<tbody class="list">
                                <tr>
                                    <td>Transmission comp. Assy.</td>
                                    <td class="font-weight-500">Engg. Assy.</td>
                                    <td>11/16/2019-12/20/2019</td>
                                    <td>11/16/2019</td>
                                    <td>TATA STEEL LTD</td>
                                    <td><span class="badge badge-danger">critical</span></td>

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
                                </tbody>-->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('after_script')

<script src="{{URL::asset('public/assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>

    <script src="{{URL::asset('public/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>


    <script type="text/javascript">

        $(document).ready(function(){
            $('#tabe1').DataTable({
                processing: true,
                serverSide: true,
                aLengthMenu: [[10, 25, 50, 100,200,250,300,400,450,500], [10, 25, 50, 100,200,250,300,400,450,500]],
                iDisplayLength:10,
                ajax:{
                    url: '{{ url("admin/projects-open-list-table") }}',
                },

                columns: [
                    {data: 'project_id', name: 'project_id',orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'dept_name', name: 'dept_name'},
                    {data: 'date_duration', name: 'date_duration'},
                    //{data: 'estm_start_date', name: 'estm_start_date'},
                    {data: 'customer_id', name: 'customer_id'},
                    {data: 'status', name: 'status'},
                    // {data: 'action', name: 'action', orderable: false, searchable: false} ,

                ],
                "language": {
                    "paginate": {
                      "previous": "Prev"
                    }
                  }

                // pageLength: 25,

                // order: [[ 2, "asc" ]]

            });



        });

    </script>

    <script src="{{URL::asset('public/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>

    <script src="{{URL::asset('public/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>

@endsection