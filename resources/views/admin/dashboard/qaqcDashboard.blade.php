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
                <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">qa-qc Dashboard</h6>
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
                 $cg1=App\Helpers\UserHelper::totalcg1count();
                  $leftcg1=App\Helpers\UserHelper::leftcg1count();
                
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
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
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
                                <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/servicedashboard-checkgateone')}}">Total checkgate filled</a></h5>
                                <span class="h2 font-weight-bold mb-0">{{$cg1}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                    <i class="ni ni-delivery-fast"></i>
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
                                <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/servicedashboard-checkgateone')}}">Awaiting to be filled</a></h5>
                                <span class="h2 font-weight-bold mb-0">{{$leftcg1}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                    <i class="ni ni-bullet-list-67"></i>
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
                            <h3 class="mb-0">Latest 3 received service requests from branch office</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabe1">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="number">#</th>
                                    <th scope="col" class="sort" data-sort="name">Service Request No</th>
                                    <th scope="col" class="sort" data-sort="name">Customer</th>
                                    <th scope="col" class="sort" data-sort="name">Branch</th>
                                    <th scope="col" class="sort" data-sort="name">Component Name</th>
                                    <!--<th scope="col" class="sort" data-sort="name">Status</th>-->

                                    <!--<th scope="col" class="sort" data-sort="name">Action</th>-->
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
                ajax:{
                    url: '{{ url("admin/receiving-dashboard-list-get-table") }}',
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'service_request_no', name: 'service_request_no'},
                    {data: 'customer', name: 'customer'},
                    {data: 'branch_name', name: 'branch_name'},
                    {data: 'component_name', name: 'component_name'},
                    // {data: 'cg1_status', name: 'cg1_status'},
                    //{data: 'created_at', name: 'created_at'},
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


@endsection
