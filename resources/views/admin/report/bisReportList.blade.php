@extends('admin.include.layout')
<!-- Project List -->

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <script src="{{URL::asset('public/assets/css/graphcss/piechart.css')}}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    {{--<script src="https://code.highcharts.com/modules/accessibility.js"></script>--}}
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

@endsection

@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Bis Report</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bis Report</li>
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
<!--                            {{--<form method="post" action="{{url('admin/componentstatusfacility-get-table')}}" style="">--}}-->
                            <div class="row no-gutters">
                                <div class="col-sm-2">
                                    <!--<h6><b>From Date - To Date: </b></h6>-->
                                    <label class="form-label"><b>Location</b></label>
                                </div>
                                <div class="col-md-4" style="padding-top: 10px">
                                    <div class="row">
                                        <div class="col-md-9">
<!--                                            {{--<input type="text" id="pickdate" name="pickdate" class="form-control date-filter mydatepicker" placeholder="please enter date" autocomplete="off">--}}-->
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

<!--                            {{--</form>--}}-->
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
                            <h3 class="mb-0">Bis Report</h3>
                        </div>



                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabe1">
                                <thead class="thead-light">
                                <tr>

                                    <th scope="col" class="sort" data-sort="number">#</th>
                                    <th scope="col" class="sort" data-sort="name">WORK ORDER NUMBER</th>
                                    <th scope="col" class="sort" data-sort="name">ACTUAL START DATE</th>

                                    <th scope="col" class="sort" data-sort="name">ACTUAL END DATE</th>
                                    <th scope="col" class="sort" data-sort="name">TECHNICIAN</th>
                                    <th scope="col" class="sort" data-sort="name">CUSTOMER</th>
                                    <th scope="col" class="sort" data-sort="name">TEST SMU</th>
                                    <th scope="col" class="sort" data-sort="name">ENGINE ENTER DATE</th>
                                    <th scope="col" class="sort" data-sort="name">MONTH</th>
                                    <th scope="col" class="sort" data-sort="name">PROBLEM DURING TESTING</th>
                                    <th scope="col" class="sort" data-sort="name">ROOT CAUSE ANALYSIS</th>
                                    <th scope="col" class="sort" data-sort="name">WHY</th>
                                    <th scope="col" class="sort" data-sort="name">SOLUTION</th>
                                    <th scope="col" class="sort" data-sort="name">IMPACT</th>
                                    <th scope="col" class="sort" data-sort="name">TYPE OF PROBLEM</th>
                                    <th scope="col" class="sort" data-sort="name">AREA OF PROBLEM</th>
                                    <th scope="col" class="sort" data-sort="name">PORTION OF PROBLEM</th>
                                    <th scope="col" class="sort" data-sort="name">FURTHER ACTION</th>


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
                    url: '{{ url("admin/bisreport-listing-get-table") }}',
                },


                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'workorder', name: 'workorder'},
                    {data: 'actualstartdate', name: 'actualstartdate'},
                    {data: 'actualenddate', name: 'actualenddate'},
                   {data: 'technician', name: 'technician'},
                   {data: 'cust', name: 'cust'},
                    {data: 'test_smu', name: 'test_smu'},
                    {data: 'dateformat', name: 'dateformat'},
                    {data: 'month', name: 'month'},
                    {data: 'problem_during_testing', name: 'problem_during_testing'},
                    {data: 'root_cause_analysis', name: 'root_cause_analysis'},
                    {data: 'why', name: 'why'},
                    {data: 'solution', name: 'solution'},
                   {data: 'impact', name: 'impact'},
                    {data: 'type_of_problem', name: 'type_of_problem'},
                    {data: 'area_of_problem', name: 'area_of_problem'},
                    {data: 'portion_of_problem', name: 'portion_of_problem'},
                     {data: 'further_action', name: 'further_action'},


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
                    url: '{{ url("admin/bisreport-listing-filter") }}',
                    type: 'GET',

                    data: {location: location, '_token': '{{csrf_token()}}'},
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'workorder', name: 'workorder'},
                    {data: 'actualstartdate', name: 'actualstartdate'},
                    {data: 'actualenddate', name: 'actualenddate'},
                    {data: 'technician', name: 'technician'},
                    {data: 'cust', name: 'cust'},
                    {data: 'test_smu', name: 'test_smu'},
                    {data: 'dateformat', name: 'dateformat'},
                    {data: 'month', name: 'month'},
                    {data: 'problem_during_testing', name: 'problem_during_testing'},
                    {data: 'root_cause_analysis', name: 'root_cause_analysis'},
                    {data: 'why', name: 'why'},
                    {data: 'solution', name: 'solution'},
                    {data: 'impact', name: 'impact'},
                    {data: 'type_of_problem', name: 'type_of_problem'},
                    {data: 'area_of_problem', name: 'area_of_problem'},
                    {data: 'portion_of_problem', name: 'portion_of_problem'},
                    {data: 'further_action', name: 'further_action'},
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
                    url: '{{ url("admin/bisreport-listing-datefilter") }}',
                    type: 'GET',

                    data: {startdate: startdate,enddate: enddate,location: location,'_token': '{{csrf_token()}}'},
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'workorder', name: 'workorder'},
                    {data: 'actualstartdate', name: 'actualstartdate'},
                    {data: 'actualenddate', name: 'actualenddate'},
                    {data: 'technician', name: 'technician'},
                    {data: 'cust', name: 'cust'},
                    {data: 'test_smu', name: 'test_smu'},
                    {data: 'dateformat', name: 'dateformat'},
                    {data: 'month', name: 'month'},
                    {data: 'problem_during_testing', name: 'problem_during_testing'},
                    {data: 'root_cause_analysis', name: 'root_cause_analysis'},
                    {data: 'why', name: 'why'},
                    {data: 'solution', name: 'solution'},
                    {data: 'impact', name: 'impact'},
                    {data: 'type_of_problem', name: 'type_of_problem'},
                    {data: 'area_of_problem', name: 'area_of_problem'},
                    {data: 'portion_of_problem', name: 'portion_of_problem'},
                    {data: 'further_action', name: 'further_action'},
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });
        }




    </script>


@endsection
