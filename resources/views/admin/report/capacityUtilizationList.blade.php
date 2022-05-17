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
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Capacity Utilization List</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Capacity Utilization List</li>
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
                            {{--<form method="post" action="{{url('admin/capacityUtilization-listing')}}" style="">--}}
                            <div class="row no-gutters">
                                <div class="col-sm-2">
                                    {{--<h6><b>From Date - To Date: </b></h6>--}}
                                    <label class="form-label"><b>Location</b></label>
                                </div>
                                <!--<div class="col-md-4" style="padding-top: 10px">
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

                                </div>-->
                            </div>

                            {{--</form>--}}
                        @endif
						
						 <!--<div class="col-md-10" style="padding-top: 10px; padding-left: 10px">
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

                                </div>-->
                               
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">Capacity Utilization List</h3>
                        </div>
                         <form method="post" action="{{url('admin/capacityUtilization-listing')}}" id="yearFilter" style="">
                             <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Select Year</label>
                                        <select name="year" id="year" class="form-control"  required>
                                                <option value="2021" 
                                                {{ $year==2021 ? 'selected' : '' }}
                                                >2021</option>
                                                <option value="2020" {{ $year==2020 ? 'selected' : '' }}>2020</option>
                                                <option value="2019" {{ $year==2019 ? 'selected' : '' }}>2019</option>
                                        </select>
                                    </div>
                                    <!-- <div class="col-4">
                                        <button type="submit" onclick="miningGraph()" class="btn btn-primary " style="background-color: blue;margin-top: 30px;">View Labour Job Graph</button>
                                    </div>
									<div class="col-4">
                                        <button type="submit" onclick="techGraph()" class="btn btn-primary " style="background-color: blue;margin-top: 30px;">View Technician Graph</button>
                                    </div> -->
                                    <div class="col-4">
                                        <button id="submit-button" type="submit" class="btn btn-primary " style="background-color: blue;margin-top: 30px;">Filter</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                                <input type="hidden" id="miningvalue" class="btn btn-primary btn-sm m-0" style="background-color: black">
                                <figure class="highcharts-figure">
                                    <div id="container"></div>
                                    {{--<p class="highcharts-description">--}}
                                    {{--Pie charts are very popular for showing a compact overview of a--}}
                                    {{--composition or comparison. While they can be harder to read than--}}
                                    {{--column charts, they remain a popular choice for small datasets.--}}
                                    {{--</p>--}}
                                </figure>
                            
                        {{--<div align="left">--}}
                            {{--<a href="{{url('admin/download-labourJobActivity')}}"><button class="btn"><i class="fa fa-download"></i>Download</button>--}}
                            {{--</a>--}}
                        {{--</div>--}}

                        <div class="table-responsive" style="background-color: white">
                            <table class="table table-striped" id="capacityTable">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Model</th>
                                    <th scope="col" class="sort" data-sort="name">{{$year}} Actual</th>
                                    <th scope="col" class="sort" data-sort="name">% Actual Uti</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $dt)
                                <tr>
                                    <td>{{$dt['model']}}</td>
                                    <td>{{$dt['actual']}}</td>
                                    <td>{{$dt['actual_uti']}}</td>
                                </tr>
                                @endforeach
                                
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
            $('#capacityTable').DataTable( {
                dom: 'Bfrtip',
                buttons: [ 'excel' ],
                buttons: [ { extend: 'excel', text: 'Download in Excel Format' } ],
                destroy: false,
                paging:true,
                searching: false,
                processing: true,
                serverSide: false,
            } ); 

                 /* $('#submit-button').click(function() {
                     $.ajax({
                           type:"post",
                           url:{{ url("admin/labourJobActivity-filter") }},
                           data:  $("#yearFilter").serialize(),
                           success: function(response){
                               $(".table-responsive").html(response);
                           }
                     });
                  });*/
           /* $('#tabe1').DataTable({
                dom: 'lBfrtip',
                buttons: ['excel']
                //buttons: [ { extend: 'excel', text: 'Download in Excel Format' } ],
                destroy: false,
                paging:true,
                //pageLength: 57,

                searching: false,
                processing: true,
                serverSide: false,
                // ajax:{
                //     url: '{{ url("admin/capacityUtilization-get-table") }}',
                // },



                // columns: [
                    
                //     {data: 'actual', name: 'actual'},
                   
                    
                // ],
                
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });*/

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
 </script>
@endsection
