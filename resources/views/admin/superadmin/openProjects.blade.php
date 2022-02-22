@extends('admin.include.layout')

<!-- Project List -->





@section('head')



    <div class="container-fluid">

        <div class="header-body">

            <div class="row align-items-center py-4">

                <div class="col-lg-6 col-7">

                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Open projects</h6>

                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">

                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">

                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>

                            <li class="breadcrumb-item active" aria-current="page">Project listing</li>

                        </ol>

                    </nav>

                </div>

            </div>

@php
          
        $highdev=App\Helpers\UserHelper::highdevi();
          $totaldev=App\Helpers\UserHelper::totaldevi();

           $low = $totaldev - $highdev;
        @endphp
		
		<div class="row">

                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500">Total Task</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$totaldev}}</span>
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
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500">High Deviation</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$highdev}}</span>
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
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500">Low Deviation</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$low}}</span>
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
                        @if(request()->session()->get('user')['location_id'] == '3')

                            <div class="row no-gutters">
                                <div class="col-sm-2">
                                    {{--<h6><b>From Date - To Date: </b></h6>--}}
                                    <label class="form-label"><b>Location</b></label>
                                </div>
                                <div class="col-md-4" style="padding-top: 10px">
                                    <div class="row">
                                        <div class="col-md-9">
                                            {{--<input type="text" id="pickdate" name="pickdate" class="form-control date-filter mydatepicker" placeholder="please enter date" autocomplete="off">--}}
                                            <select name="location_id" id="location_id" class="form-control"  required>
                                                @php
                                                    $location=App\Helpers\UserHelper:: location();
                                                @endphp


                                                @foreach($location as $loc)

                                                    <option value="{{$loc->id}}">{{$loc->description}}</option>

                                                @endforeach
                                            </select>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" onclick="locationfilter()" class="btn btn-primary btn-sm m-0" style="background-color: black">FILTER</button>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        @endif
                            <div class="col-md-10" style="padding-top: 10px; padding-left: 10px">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label"><b>Start Date</b></label>
                                        <input type="text" id="startdate" name="startdate" class="form-control" placeholder="please enter date" autocomplete="off">


                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label"><b>End Date</b></label>
                                        <input type="text" id="enddate" name="enddate" class="form-control" placeholder="please enter date" autocomplete="off">


                                    </div>
                                    <div class="col-md-2" style="padding-top: 40px;">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        {{--<button type="submit"  id="reset" class="btn btn-primary btn-sm m-0" style="background-color: black">Reset</button>--}}
                                        <button type="submit" onclick="datefilter()" class="btn btn-primary btn-sm m-0" style="background-color: black">FILTER</button>
                                    </div>
                                </div>

                            </div>

                        <!-- Card header -->

                        <div class="card-header border-0">

                            <h3 class="mb-0"></h3>

                        </div>

                        <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="mb-0">Open projects</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <div align="left">
                                            <form action="{{url('admin/projects-open-list-table-download')}}" method="post">

                                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                                <button class="btn" style="border: 1px dotted gray;"><i class="fa fa-download"> &nbsp;</i>Download All Data In Excel</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="table-responsive" style="overflow-x: hidden;">

                            <table class="table align-items-center table-flush" id="tabe1">

                                <thead class="thead-light">

                                <tr>

                                    <th scope="col">Project Id</th>
                                    <th scope="col">WO No</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Assigned to</th>
                                    <th scope="col" class="sort" data-sort="startend-date">Estm. start & end date</th>
                                    <!--<th scope="col" class="sort" data-sort="assigned-date">Assigned date</th>-->
                                    <!--<th scope="col">Customer</th>-->
                                    <th scope="col" class="sort" data-sort="status">Status</th>
                                    <th scope="col" class='notexport'></th>

                                </tr>

                                </thead>

                               <!--  <tbody class="list">

                                <tr>
                                    <td>Transmission comp. Assy.</td>
                                    <td>Transmission comp. Assy.</td>
                                    <td class="font-weight-500">Engg. Assy.</td>
                                    <td>11/16/2019-12/20/2019</td>
                                    <td>11/16/2019</td>
                                    <td>TATA STEEL LTD</td>
                                    <td><span class="badge badge-success">on track</span></td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{url('admin/project-details')}}">Project details</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>



                                </tbody> -->

                            </table>

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
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

    <script type="text/javascript">

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


        $(document).ready(function(){
            $('#tabe1').DataTable({
                dom: 'lBfrtip',
                //buttons: ['excel']
                buttons: [ { extend: 'excel', text: 'Download in Excel Format' ,
                    exportOptions: {
                        columns: ':not(.notexport)'
                    }}, ],
                destroy: true,
                //paging:false,
                processing: true,
                searching: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/projects-open-list-table") }}',
                },

                columns: [
                    {data: 'project_id', name: 'project_id',orderable: false, searchable: false},
                    {data: 'work_orderno', name: 'work_orderno'},
                    {data: 'description', name: 'description'},
                    {data: 'dept_name', name: 'dept_name'},
                    {data: 'date_duration', name: 'date_duration'},
                    //{data: 'estm_start_date', name: 'estm_start_date'},
                   // {data: 'customer_id', name: 'customer_id'},
                    {data: 'status', name: 'status'},
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

        function locationfilter(){

            var location = $("#location_id").val();
            //alert(location);
            $('#tabe1').DataTable({
                dom: 'lBfrtip',
                //buttons: ['excel']
                buttons: [ { extend: 'excel', text: 'Download in Excel Format' ,
                    exportOptions: {
                        columns: ':not(.notexport)'
                    }}, ],
                destroy: true,
               // paging:false,
                processing: true,
                searching: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/projects-filter-list-table") }}',
                    type: 'GET',

                    data: {location: location, '_token': '{{csrf_token()}}'},
                },
                columns: [
                    {data: 'project_id', name: 'project_id',orderable: false, searchable: false},
                    {data: 'work_orderno', name: 'work_orderno'},
                    {data: 'description', name: 'description'},
                    {data: 'dept_name', name: 'dept_name'},
                    {data: 'date_duration', name: 'date_duration'},
                    //{data: 'estm_start_date', name: 'estm_start_date'},
                   // {data: 'customer_id', name: 'customer_id'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });
        }

        function datefilter(){
            //alert('hi');
            var startdate = $("#startdate").val();
            var enddate = $("#enddate").val();
            var location = $("#location_id").val();
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
                //paging:false,
                //pageLength: 57,

                searching: true,
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/projects-datefilter-list-table") }}',
                    type: 'GET',

                    data: {startdate: startdate,enddate: enddate,location: location,'_token': '{{csrf_token()}}'},
                },
                columns: [
                    {data: 'project_id', name: 'project_id',orderable: false, searchable: false},
                    {data: 'work_orderno', name: 'work_orderno'},
                    {data: 'description', name: 'description'},
                    {data: 'dept_name', name: 'dept_name'},
                    {data: 'date_duration', name: 'date_duration'},
                    //{data: 'estm_start_date', name: 'estm_start_date'},
                    // {data: 'customer_id', name: 'customer_id'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });
        }
    </script>

    <script src="{{URL::asset('public/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>

    <script src="{{URL::asset('public/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>

@endsection