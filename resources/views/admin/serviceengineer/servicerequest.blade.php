@extends('admin.include.layout')
<!-- Project List -->
@section('head')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Project Dashboard</h6>

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
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500">Total<br> number</h5>
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
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500">With small deviation</h5>
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
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500">With high deviation</h5>
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
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500">Without deviation</h5>
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




    <!-- Project List -->
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <!-- Card header -->
                                        <div class="card-header border-0">
                                            <h3 class="mb-0">All Users Details</h3>
                                        </div>
                                        <div class="text-right mb-1" style="padding-right: 70px">
                                            <a class="btn btn-info text-white" href="{{url('admin/service-request-add')}}">Add</a>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="table-responsive">
                                                <table class="table align-items-center table-flush" id="tabe1">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col" class="sort" data-sort="name">ID</th>
                                                        <th scope="col" class="sort" data-sort="name">Service_request_no</th>
                                                        <th scope="col" class="sort" data-sort="name">status</th>
                                                        <th scope="col" class="sort" data-sort="name">Action</th>
                                                       <!-- <th scope="col" class="sort" data-sort="name">Customer</th>
                                                         <th scope="col" class="sort" data-sort="name">customer code</th>
                                                        <th scope="col" class="sort" data-sort="name">job_no</th>
                                                         <th scope="col" class="sort" data-sort="name">component_serial_no</th>
                                                         <th scope="col" class="sort" data-sort="name">component_name</th>
                                                         <th scope="col" class="sort" data-sort="name">Component_model_no</th>
                                                         <th scope="col" class="sort" data-sort="name">machine_modelno</th>
                                                        <th scope="col" class="sort" data-sort="name">ar_no</th>
                                                        <th scope="col" class="sort" data-sort="name">branch_name</th>
                                                        <th scope="col" class="sort" data-sort="name">segment</th>
                                                        <th scope="col" class="sort" data-sort="name">work_orderno</th>
                                                        <th scope="col" class="sort" data-sort="name">Branch location
                                                        </th>
                                                        <th scope="col" class="sort" data-sort="name">status</th>
                                                        <th scope="col" class="sort" data-sort="name">Checkgate2</th>
                                                        <th scope="col" class="sort" data-sort="name">created at</th>
                                                        <th scope="col" class="sort" data-sort="name">Action</th>
                                                           <th scope="col" class="sort" data-sort="name">Action</th>

                                                         <th scope="col" class="sort" data-sort="name">Action</th>-->
                                                    </tr>
                                                    </thead>

                                                </table>
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

@section('after_script')

    <script src="{{URL::asset('public/assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#tabe1').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/servirequest-listing") }}',
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'service_request_no', name: 'service_request_no'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                  /*  {data: 'customer', name: 'customer'},
                    {data: 'job_no', name: 'job_no'},
                    {data: 'component_serial_no', name: 'component_serial_no'},
                    {data: 'component_name', name: 'component_name'},
                    {data: 'component_name', name: 'job_no'},
                    {data: 'job_no', name: 'job_no'},
                    {data: 'ar_no', name: 'ar_no'},
                    {data: 'branch_name', name: 'branch_name'},
                    {data: 'segment', name: 'segment'},
                    {data: 'work_orderno', name: 'work_orderno'},
                    {data: 'branch_location', name: 'branch_location'},
                    {data: 'status', name: 'status'},
                    {data: 'checkgate2', name:'checkgate2'},
                    {data: 'created_at', name:'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},*/
                ],
            });


        });
    </script>
@endsection
