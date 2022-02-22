@extends('admin.include.layout')
<!-- Project List -->
@section('head')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Receiving statistics</h6>
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
                                            <h3 class="mb-0">Check Gate 1 List</h3>
                                        </div>
                                        

                                        <div class="col-md-12" style="padding-top: 10px; padding-left: 10px;padding-bottom: 10px">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label"><b>Start Date</b></label>
                                                <input type="text" id="startdate" name="startdate" class="form-control" placeholder="please enter date" autocomplete="off">


                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label"><b>End Date</b></label>
                                                <input type="text" id="enddate" name="enddate" class="form-control" placeholder="please enter date" autocomplete="off">


                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label"><b>Segment</b></label>
                                                <input type="text" id="segment" name="segment" class="form-control" placeholder="Segment" autocomplete="off">


                                            </div>
                                             <div class="col-md-3">
                                                <label class="form-label"><b>Component</b></label>
                                                <input type="text" id="component" name="component" class="form-control" placeholder="Component Name" autocomplete="off">


                                            </div>
                                            <div class="col-md-2" style="padding-top: 40px; float: right;">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                {{--<button type="submit"  id="reset" class="btn btn-primary btn-sm m-0" style="background-color: black">Reset</button>--}}
                                                <button type="submit" onclick="datefilter()" class="btn btn-primary btn-sm m-0" style="background-color: black">FILTER</button>
                                            </div>
                                        </div>

                                         </div>


                                         <div class="col-md-12" >
                                            <div class="row">
                                                <div class="col-md-8">
                                                </div>
                                                <div class="col-md-4">
                                                    <div align="left">
                                                        <form action="{{url('admin/download-checkgetfacility')}}" method="post">

                                                            <input type="hidden" name="startdate" id="stdate" value="">
                                                            <input type="hidden" name="enddate" id="endate" value="">
                                                            <input type="hidden" name="segment" id="seg" value="">
                                                            <input type="hidden" name="component" id="com" value="">

                                                            @csrf <!-- {{ csrf_field() }} -->


                                                            <button class="btn" style="border: 1px dotted gray;"><i class="fa fa-download"> &nbsp;</i>Download All Data In Excel</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="table-responsive" style="overflow-x: hidden">

                                            <div class="table-responsive" style="overflow-x: hidden">
                                                <table class="table align-items-center table-flush" id="tabe1">
                                                    <thead class="thead-light">
                                                    <tr>

                                                       <!-- <th scope="col" class="sort" data-sort="name">Service_request_no</th>
                                                        <th scope="col" class="sort" data-sort="name">Customer</th>-->
                                                        <!-- <th scope="col" class="sort" data-sort="name">customer code</th>-->
                                                      <!--  <th scope="col" class="sort" data-sort="name">job_no</th>
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
                                                        <th scope="col" class="sort" data-sort="name">status</th>-->
                                                        <!--<th scope="col" class="sort" data-sort="name">Service Request No</th>-->
                                                        <!--<th scope="col" class="sort" data-sort="name">Status</th>-->
                                                        <!--<th scope="col" class="sort" data-sort="name">created at</th>-->

                                                        <!--    <th scope="col" class="sort" data-sort="name">Action</th>-->

                                                        <!-- <th scope="col" class="sort" data-sort="name">Action</th>-->
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('after_script')
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){

             $('#startdate').datepicker({


            format: "dd/mm/yyyy",
            autoclose: true,
            //startDate: new Date('2019-12-5'),
            //endDate: "today",
            });
            $('#enddate').datepicker({


                format: "dd/mm/yyyy",
                autoclose: true,
                //startDate: new Date('2019-12-5'),
                //endDate: "today",
            });

            $('#tabe1').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/fetchservicheckgateone-get-table") }}',
                },
                columns: [
                    /*{data: 'service_request_no', name: 'service_request_no'},
                    {data: 'customer', name: 'customer'},
                    {data: 'job_no', name: 'job_no'},
                    {data: 'ar_no', name: 'ar_no'},
                    {data: 'branch_name', name: 'branch_name'},
                    {data: 'segment', name: 'segment'},
                    {data: 'work_orderno', name: 'work_orderno'},
                   // {data: 'branch_location', name: 'branch_location'},
                    {data: 'status', name: 'status'},*/
                    
                //     {data: 'id', name: 'id',orderable: false, searchable: false},
                //     {data: 'service_request_no', name: 'service_request_no'},
                //     {data: 'customer', name: 'customer'},
                //   // {data: 'branch_name', name: 'branch_name'},
                //     {data: 'component_name', name: 'component_name'},
                //     {data: 'cg1_status', name: 'cg1_status'},
                //     //{data: 'created_at', name: 'created_at'},
                //     {data: 'action', name: 'action', orderable: false, searchable: false} ,
                    
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'service_request_no', name: 'service_request_no'},
                    {data: 'work_orderno', name: 'work_orderno'},
                    {data: 'segment', name: 'segment'},
                     {data: 'job_type', name: 'job_type'},
                    {data: 'component_name', name: 'component_name'},
                    {data: 'cg1_status', name: 'cg1_status'},
                    //{data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],
                "language": {
                    "paginate": {
                      "previous": "Prev"
                    }
                  }
            });


        });

        function datefilter(){
            //alert('hi');
            var startdate = $("#startdate").val();
            var enddate = $("#enddate").val();
            var location = $("#location_id").val();
            var segment = $("#segment").val();
            var component = $("#component").val();

            $("#stdate").val(startdate);
            $("#endate").val(enddate);
            $("#seg").val(segment);
            $("#com").val(component);

            $("#startdate").css('border','1px solid #ded8d8');
            $("#enddate").css('border','1px solid #ded8d8');
            //var reset = $("#reset").val();
            console.log(startdate);
            console.log(enddate);
            console.log(location);
          
                $('#tabe1').DataTable({
                    dom: 'lBfrtip',
                    //buttons: ['excel']
                    buttons: [ { extend: 'excel', text: 'Download in Excel Format' ,
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }}, ],
                    destroy: true,
                    paging:true,
                    //pageLength: 57,

                    searching: true,
                    processing: true,
                    serverSide: true,
                    ajax:{
                        url: '{{ url("admin/fetchservicheckgateone-get-table-datefilter") }}',
                        type: 'GET',

                        data: {startdate: startdate,enddate: enddate,segment:segment,component:component,location: location,'_token': '{{csrf_token()}}'},
                    },
                    columns: [
                       
                        
                        {data: 'id', name: 'id',orderable: false, searchable: false},
                        {data: 'service_request_no', name: 'service_request_no'},
                        {data: 'work_orderno', name: 'work_orderno'},
                        {data: 'segment', name: 'segment'},
                         {data: 'job_type', name: 'job_type'},
                        {data: 'component_name', name: 'component_name'},
                        {data: 'cg1_status', name: 'cg1_status'},
                        //{data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false} ,
                    ],
                    // pageLength: 25,
                    // order: [[ 2, "asc" ]]
                });
            
        }




    </script>
    @endsection
