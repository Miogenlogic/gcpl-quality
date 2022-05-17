

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
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Labour Job Activity List</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Labour Job Activity List</li>
                        </ol>
                    </nav>
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
                        @if(request()->session()->get('user')['location_id'] == '3')
                            {{--<form method="post" action="{{url('admin/componentstatusfacility-get-table')}}" style="">--}}
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

                            {{--</form>--}}
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
                            <h3 class="mb-0">Labour Job Activity List</h3>
                        </div>
                        {{--<div align="left">--}}
                            {{--<a href="{{url('admin/download-labourJobActivity')}}"><button class="btn"><i class="fa fa-download"></i>Download</button>--}}
                            {{--</a>--}}
                        {{--</div>--}}

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabe1">
                                <thead class="thead-light">
                                <tr>

                                    <th scope="col" class="sort" data-sort="number">#</th>
                                    <th scope="col" class="sort" data-sort="name">SHIFT</th>
                                    <th scope="col" class="sort" data-sort="name">DATE</th>
                                    <th scope="col" class="sort" data-sort="name">SECTION</th>
                                    <th scope="col" class="sort" data-sort="name">WORK ORDER NUMBER</th>
									<th scope="col" class="sort" data-sort="name">WORK ORDER Description</th>
                                    <th scope="col" class="sort" data-sort="name">CUSTOMER NAME</th>
                                    {{--<th scope="col" class="sort" data-sort="name">Project</th>--}}
                                    <th scope="col" class="sort" data-sort="name">TECHNICIAN</th>
                                    <th scope="col" class="sort" data-sort="name">EMP CODE</th>
                                    <th scope="col" class="sort" data-sort="name">JOB DETAILS</th>
                                    <th scope="col" class="sort" data-sort="name">START TIME</th>
                                    <th scope="col" class="sort" data-sort="name">END TIME</th>
                                    <th scope="col" class="sort" data-sort="name">TOTAL HOUR</th>
                                    <th scope="col" class="sort" data-sort="name">JOB Status</th>
                                    {{----}}
                                    <th scope="col" class="sort" data-sort="name">Remarks</th>

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
                buttons: [ { extend: 'excel', text: 'Download in Excel Format' } ],
                destroy: true,
                paging:false,
                //pageLength: 57,

                searching: false,
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/labourJobActivity-get-table") }}',
                },


                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'shift', name: 'shift'},
                   {data: 'dateformat', name: 'dateformat'},
                   {data: 'dept', name: 'dept'},
                    {data: 'work_order', name: 'work_order'},
					 {data: 'description', name: 'description'},
                    {data: 'cust', name: 'cust'},
                    {data: 'emp_name', name: 'emp_name'},
                    //{data: 'project_id', name: 'project_id'},
                    {data: 'emp_id', name: 'emp_id'},
                    //{data: 'emp_code', name: 'emp_code'},
                   {data: 'job_summery', name: 'job_summery'},
                    {data: 'start_time', name: 'start_time'},
                   {data: 'end_time', name: 'end_time'},
                    {data: 'hours', name: 'hours'},
                    {data: 'job_status', name: 'job_status'},
                   // {data: 'dept', name: 'dept'},
                     {data: 'remarks', name: 'remarks'},

                    //{data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],
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
                buttons: [ { extend: 'excel', text: 'Download in Excel Format' } ],
                destroy: true,
                paging:false,
                //pageLength: 57,

                searching: false,
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/labourJobActivity-filter") }}',
                    type: 'GET',

                    data: {location: location, '_token': '{{csrf_token()}}'},
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'shift', name: 'shift'},
                    {data: 'dated', name: 'dated'},
                    {data: 'dept', name: 'dept'},
                    {data: 'work_order', name: 'work_order'},
					 {data: 'description', name: 'description'},
                    {data: 'cust', name: 'cust'},
                    {data: 'emp_name', name: 'emp_name'},
                    //{data: 'project_id', name: 'project_id'},
                    {data: 'emp_id', name: 'emp_id'},
                    //{data: 'emp_code', name: 'emp_code'},
                    {data: 'job_summery', name: 'job_summery'},
                    {data: 'start_time', name: 'start_time'},
                    {data: 'end_time', name: 'end_time'},
                    {data: 'hours', name: 'hours'},
                    {data: 'job_status', name: 'job_status'},
                    // {data: 'dept', name: 'dept'},
                    {data: 'remarks', name: 'remarks'},
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
                buttons: [ { extend: 'excel', text: 'Download in Excel Format' } ],
                destroy: true,
                paging:false,
                //pageLength: 57,

                searching: false,
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/labourJobActivity-datefilter") }}',
                    type: 'GET',

                    data: {startdate: startdate,enddate: enddate,location: location,'_token': '{{csrf_token()}}'},
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'shift', name: 'shift'},
                    {data: 'dateformat', name: 'dateformat'},
                    {data: 'dept', name: 'dept'},
                    {data: 'work_order', name: 'work_order'},
					 {data: 'description', name: 'description'},
                    {data: 'cust', name: 'cust'},
                    {data: 'emp_name', name: 'emp_name'},
                    //{data: 'project_id', name: 'project_id'},
                    {data: 'emp_id', name: 'emp_id'},
                    //{data: 'emp_code', name: 'emp_code'},
                    {data: 'job_summery', name: 'job_summery'},
                    {data: 'start_time', name: 'start_time'},
                    {data: 'end_time', name: 'end_time'},
                    {data: 'hours', name: 'hours'},
                    {data: 'job_status', name: 'job_status'},
                    // {data: 'dept', name: 'dept'},
                    {data: 'remarks', name: 'remarks'},
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });
        }
    </script>


@endsection
