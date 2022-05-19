@extends('admin.include.layout')
<!-- Project List -->

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <script src="{{URL::asset('public/assets/css/graphcss/piechart.css')}}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

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
						
						 <div class="col-md-12" style="padding-top: 10px; padding-left: 10px">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"><b>Start Date</b></label>
                                            <input type="text" id="startdate" name="startdate" class="form-control" placeholder="please enter date" autocomplete="off">


                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label"><b>End Date</b></label>
                                            <input type="text" id="enddate" name="enddate" class="form-control" placeholder="please enter date" autocomplete="off">


                                        </div>
                                        <div class="col-md-2" style="padding-top: 40px;">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            {{--<button type="submit"  id="reset" class="btn btn-primary btn-sm m-0" style="background-color: black">Reset</button>--}}
                                            <button type="submit" onclick="datefilter()" class="btn btn-primary btn-sm m-0" style="background-color: black">FILTER</button>
                                        </div>

                                        <div class="col-md-4">
                                            <div align="left">
                                                <form action="{{url('admin/labourJobActivity-download')}}" method="post">

                                                    <input type="hidden" name="startdate" id="stdate" value="">
                                                    <input type="hidden" name="enddate" id="endate" value="">
                                                   

                                                    @csrf <!-- {{ csrf_field() }} -->


                                                    <button class="btn" style="border: 1px dotted gray;"><i class="fa fa-download"> &nbsp;</i>Download All Data In Excel</button>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                              
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">Labour Job Activity List</h3>
                        </div>
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Select Section For Graph</label>
                                        <select name="section" id="section" class="form-control"  required>
                                            @php
                                                $segment=App\Helpers\UserHelper:: departmentname();
                                            @endphp


                                            @foreach($segment as $loc)

                                                <option value="{{$loc->id}}">{{$loc->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <button type="submit" onclick="miningGraph()" class="btn btn-primary " style="background-color: blue;margin-top: 30px;">View Labour Job Graph</button>
                                    </div>
									<div class="col-4">
                                        <button type="submit" onclick="techGraph()" class="btn btn-primary " style="background-color: blue;margin-top: 30px;">View Technician Graph</button>
                                    </div>
                                </div>
                                <input type="hidden" id="miningvalue" class="btn btn-primary btn-sm m-0" style="background-color: black">
                                <figure class="highcharts-figure">
                                    <div id="container"></div>
                                    {{--<p class="highcharts-description">--}}
                                    {{--Pie charts are very popular for showing a compact overview of a--}}
                                    {{--composition or comparison. While they can be harder to read than--}}
                                    {{--column charts, they remain a popular choice for small datasets.--}}
                                    {{--</p>--}}
                                </figure>
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
                                    <th scope="col" class="sort" data-sort="name">CREATED AT</th>

                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
<div class="modal-content" style="background-color: rgb(253, 185, 22);">
  <div class="modal-header" style="background-color: #00000052;">
    <h3 id="myModalLabel">Update Hours</h3>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

  </div>
  <div class="modal-body" style="text-align: center;">
    <span class="msg" style="color: green;"></span>
    <p><input type="hidden" name="id" class="timeid" value=""></p>
    <p><input type="text" name="time" class="timeclass" value="" style="width: 100%;background: #fdb916;
    border-radius: 5px; padding: 3px 11px;"></p>
  </div>
  <div class="modal-footer timeupdate">
    <button style="background-color: #00000052; border-color: #00000052; border-radius: 5px; padding: 4px;">Update</button>
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
                paging:true,
                //pageLength: 57,

                searching: true,
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
                     {data: 'createdatformat', name: 'createdatformat'},
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
                    {data: 'createdatformat', name: 'createdatformat'},
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

            $('#stdate').val(startdate);
            $('#endate').val(enddate);

            //var reset = $("#reset").val();
            console.log(startdate);
            console.log(enddate);
            console.log(location);
            $('#tabe1').DataTable({
                dom: 'lBfrtip',
                //buttons: ['excel']
                buttons: [ { extend: 'excel', text: 'Download in Excel Format' } ],
                destroy: true,
                paging:true,
                //pageLength: 57,

                searching: true,
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
                    {data: 'createdatformat', name: 'createdatformat'},
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });
        }




    </script>
    <script type="text/javascript">

        function miningGraph() {

            //alert('hi');
            var startdate = $("#startdate").val();
            var enddate = $("#enddate").val();
            var location = $("#location_id").val();
            var section = $("#section").val();

            console.log(startdate);
            console.log(enddate);
            console.log(location);

            if (startdate == null ) {
                alert('Please choose date range!!');
            }
            else{
                // alert('hii')
                $.ajax({

                    url: '{{ url("/admin/labour-graph") }}',

                    type: 'GET',

                    data: {
                        startdate: startdate,
                        enddate: enddate,
                        location: location,
                        section: section,

                        '_token': '{{csrf_token()}}'
                    },

                })

                    .done(function (response) {

                        if (response == 'failure') {
                            alert('Data not found!!');

                            return true;
                        } else {
                            var val = response;
                            //var chartData = JSON.parse(response);
                            //var x = chartData.toString();
                            // var val1 = x.split(",")
                            // var val2 = x.split("-")[1]
                            // var val3 = x.split("-")[2]
                            // var val4 = x.split("-")[3]
                            // var val5 = x.split("-")[4]
                            // var val6 = x.split("-")[5]
                            // console.log(val1);
                            // console.log(val2);
                            // console.log(val3);
                            // console.log(val4);
                            // console.log(val5);
                            // console.log(val6);

                           // var result = [];
                          var x = val.toString();
                           var val1 = new Array();
                             var val1 = x.split("-")[1]
                            var jsonde = JSON.parse(val1)
                            var val21 = x.split("-")[0]
                            var jsonwork = JSON.parse(val21)
                            //console.log(jsonde);



                            Highcharts.chart('container', {
                                chart: {
                                    type: 'bar'
                                },
                                title: {
                                    text: 'Labour Job'
                                },
                                subtitle: {
                                    text: ''
                                },
                                // xAxis: {
                                //     type: 'category',
                                //     labels: {
                                //         rotation: -45,
                                //         style: {
                                //             fontSize: '13px',
                                //             fontFamily: 'Verdana, sans-serif'
                                //         }
                                //     }
                                // },
                                xAxis: {
                                    categories: jsonwork,
                                    title: {
                                        text: 'WorkOrder'
                                    }
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'Hours'
                                    }
                                },
                                legend: {
                                    enabled: false
                                },
                                tooltip: {
                                    pointFormat: '{point.y} '
                                },
                                //series:data1
                                series: [{
                                   // name: 'YTD Budget Utilization',
                                    data: jsonde
                                    // dataLabels: {
                                    //     enabled: true,
                                    //     rotation: -90,
                                    //     color: '#FFFFFF',
                                    //     align: 'right',
                                    //     format: '',//'{point.y:.1f}', // one decimal
                                    //     y: 10, // 10 pixels down from the top
                                    //     style: {
                                    //         fontSize: '13px',
                                    //         fontFamily: 'Verdana, sans-serif'
                                    //     }
                                    // }
                                }]
                            });

                            /*Highcharts.chart('container', {
                                chart: {
                                    type: 'bar'
                                },
                                title: {
                                    text: 'Labour Job'
                                },
                                subtitle: {

                                },
                                xAxis: {
                                    categories: ['Engine', 'Transmission', 'Mor', 'Undercarrige'],
                                    title: {
                                        text: 'Departments'
                                    }
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'Hours',
                                        align: 'high'
                                    },
                                    labels: {
                                        overflow: 'justify'
                                    }
                                },
                                tooltip: {
                                    // valueSuffix: ' millions'
                                },
                                plotOptions: {
                                    bar: {
                                        dataLabels: {
                                            enabled: true
                                        }
                                    }
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'right',
                                    verticalAlign: 'top',
                                    x: -40,
                                    y: 80,
                                    floating: true,
                                    borderWidth: 1,
                                    backgroundColor:
                                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                                    shadow: true
                                },
                                credits: {
                                    enabled: false
                                },

                                series: [
                                    //for(i=0;i<val ;i++){
                                    { name: processed_json, data: processed_json},
                                    // { name: '234567', data: [1, 5, 9, 26]},
                                    // { name: '345678', data: [8, 4, 7, 7]},

                                    //}
                                ]
                            });*/
                        }

                    })

                    .fail(function () {

                        console.log("error");

                    })

                    .always(function () {

                        console.log("complete");

                    });
            }
        }
    </script>
 <script type="text/javascript">

     function techGraph() {

         //alert('hi');
         var startdate = $("#startdate").val();
         var enddate = $("#enddate").val();
         var location = $("#location_id").val();
         var section = $("#section").val();

         console.log(startdate);
         console.log(enddate);
         console.log(location);

         if (startdate == null ) {
             alert('Please choose date range!!');
         }
         else{
             // alert('hii')
             $.ajax({

                 url: '{{ url("/admin/labour-technician-graph") }}',

                 type: 'GET',

                 data: {
                     startdate: startdate,
                     enddate: enddate,
                     location: location,
                     section: section,

                     '_token': '{{csrf_token()}}'
                 },

             })

                 .done(function (response) {

                     if (response == 'failure') {
                         alert('Data not found!!');

                         return true;
                     } else {
                         var val = response;
                         //var chartData = JSON.parse(response);
                         //var x = chartData.toString();
                         // var val1 = x.split(",")
                         // var val2 = x.split("-")[1]
                         // var val3 = x.split("-")[2]
                         // var val4 = x.split("-")[3]
                         // var val5 = x.split("-")[4]
                         // var val6 = x.split("-")[5]
                         // console.log(val1);
                         // console.log(val2);
                         // console.log(val3);
                         // console.log(val4);
                         // console.log(val5);
                         // console.log(val6);

                         // var result = [];
                         var x = val.toString();
                         var val1 = new Array();
                         var val1 = x.split("-")[1]
                         var jsonde = JSON.parse(val1)
                         var val21 = x.split("-")[0]
                         var jsonwork = JSON.parse(val21)
                         console.log(jsonde);



                         Highcharts.chart('container', {
                             chart: {
                                 type: 'bar'
                             },
                             title: {
                                 text: 'Labour Job'
                             },
                             subtitle: {
                                 text: ''
                             },
                             // xAxis: {
                             //     type: 'category',
                             //     labels: {
                             //         rotation: -45,
                             //         style: {
                             //             fontSize: '13px',
                             //             fontFamily: 'Verdana, sans-serif'
                             //         }
                             //     }
                             // },
                             xAxis: {
                                 categories: jsonwork,
                                 title: {
                                     text: 'Technician'
                                 }
                             },
                             yAxis: {
                                 min: 0,
                                 title: {
                                     text: 'Hours'
                                 }
                             },
                             legend: {
                                 enabled: false
                             },
                             tooltip: {
                                 pointFormat: '{point.y} '
                             },
                             //series:data1
                             series: [{
                                 // name: 'YTD Budget Utilization',
                                 data: jsonde
                                 // dataLabels: {
                                 //     enabled: true,
                                 //     rotation: -90,
                                 //     color: '#FFFFFF',
                                 //     align: 'right',
                                 //     format: '',//'{point.y:.1f}', // one decimal
                                 //     y: 10, // 10 pixels down from the top
                                 //     style: {
                                 //         fontSize: '13px',
                                 //         fontFamily: 'Verdana, sans-serif'
                                 //     }
                                 // }
                             }]
                         });


                     }

                 })

                 .fail(function () {

                     console.log("error");

                 })

                 .always(function () {

                     console.log("complete");

                 });
         }
     }

    $( document ).ready(function() {
        $('tbody').on('click', 'tr td:nth-child(13)', function() {
            $('.timeid').val('');
            $('.timeclass').val('');  
            $('.msg').text('');
            var id = $(this).closest('tr').children('td:first').text();
            var value = $(this).text();
            $(this).addClass( "time"+id );

            $('.timeid').val(id);
            $('.timeclass').val(value);

            $('#myModal').modal('show');

        });


        $(document).on('click', '.timeupdate', function() {

            var id = $('.timeid').val();
            var value = $('.timeclass').val();
            $('.msg').text('');

            if (value == '' ) {
                alert('Please insert time');
            }else{
             // alert('hii')
                $.ajax({

                     url: '{{ url("/admin/labour-time-utdate") }}',

                     type: 'GET',

                     data: {
                         id: id,
                         value: value,
                         
                         '_token': '{{csrf_token()}}'
                     },

                })

                .done(function (response) {

                    $('.msg').text('Hours Updated Successfully');
                    $("tbody").find("tr").each(function() {
                      var ratingTd = $(this).find('td.time'+id);
                      ratingTd.text(response);
                    });

                    
                })
            }

            

        })

    });
 </script>
 <style type="text/css">
     /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 9999; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 30%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
.modal-body {
    padding: 0 1.5rem !important;

}
tr>td:nth-child(13) {
    color: #00a1ffd6;
    cursor: pointer;
}

 </style>
@endsection
