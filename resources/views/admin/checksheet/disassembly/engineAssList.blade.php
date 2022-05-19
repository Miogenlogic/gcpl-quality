@extends('admin.include.layout')
<!-- Project List -->

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Engine Assembly</h6>
                    <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="../branch-office/index.html"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Default</li>
                      </ol>
                    </nav> -->
                </div>
            </div>
@php
              $appo=App\Helpers\UserHelper::totalservicecount();
               $serquotation=App\Helpers\UserHelper::totalquotationcount();
                $onservice=App\Helpers\UserHelper::ongoingservice();
            @endphp

            <!-- Card stats -->
            <div class="row">

                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/service-request-list')}}">Total service requests</a></h5>
                                    <span class="h2 font-weight-bold mb-0">{{$appo}}</span>
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

                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/support-quotation-list')}}">Total quotation given</a></h5>
                                    <span class="h2 font-weight-bold mb-0">{{$serquotation}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="ni ni-chart-pie-35"></i>
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

                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/service-request-list')}}">Ongoing service requests</a></h5>
                                    <span class="h2 font-weight-bold mb-0">{{$onservice}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-settings-gear-65"></i>
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
                            <h3 class="mb-0"></h3>
                        </div>

                        <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="mb-0">Latest created service requests</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <div align="left">
                                            <form action="{{url('admin/engine-ass-list-download')}}" method="post">

                                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                                <button class="btn" style="border: 1px dotted gray;"><i class="fa fa-download"> &nbsp;</i>Download All Data In Excel</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabe1">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="number">#</th>
                                <th scope="col" class="sort" data-sort="name">SR No</th>
                                <th scope="col" class="sort" data-sort="name">WO No</th>
                                <th scope="col" class="sort" data-sort="name">Segment</th>
                                <th scope="col" class="sort" data-sort="name">Job</th>
                                <th scope="col" class="sort" data-sort="name">Component</th>
                                <th scope="col" class="sort" data-sort="name">Status</th>
                                <th scope="col" class="sort" data-sort="name">Action</th>
                                </tr>
                                </thead>

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
                    url: '{{ url("admin/engine-ass-list-get-table") }}',
                },
                columns: [
                    // {data: 'id', name: 'id',orderable: false, searchable: false},
                    // {data: 'service_request_no', name: 'service_request_no'},
                    // {data: 'customer', name: 'customer'},
                    // {data: 'branch_name', name: 'branch_name'},
                    // {data: 'component_name', name: 'component_name'},
                    // {data: 'asc_status', name: 'asc_status'},
                    // //{data: 'created_at', name: 'created_at'},
                    // {data: 'action', name: 'action', orderable: false, searchable: false} ,
                    
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'service_request_no', name: 'service_request_no'},
                    {data: 'work_orderno', name: 'work_orderno'},
                    {data: 'segment', name: 'segment'},
                     {data: 'job_type', name: 'job_type'},
                    {data: 'component_name', name: 'component_name'},
                    {data: 'assembly_status', name: 'assembly_status'},
                    //{data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false} ,
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


@endsection