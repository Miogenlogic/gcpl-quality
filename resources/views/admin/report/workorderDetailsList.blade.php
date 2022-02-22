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
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Work Order Details</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/service-engineer-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">TAT Report</li>
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
                            <div class="col-md-10" style="padding-top: 10px; padding-left: 10px" >
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
                            <h3 class="mb-0">TAT Report </h3>
                        </div>
                            <div class="col-10">
                                <div class="row">
                                <div class="col-6">
                                    <label>Select Segment For Graph</label>
                                <select name="segment" id="segment" class="form-control"  required>
                                    @php
                                        $segment=App\Helpers\UserHelper:: segment();
                                    @endphp


                                    @foreach($segment as $loc)

                                        <option value="{{$loc->name}}">{{$loc->name}}</option>

                                    @endforeach
                                </select>
                                </div>
                                <div class="col-4">
                                <button type="submit" onclick="miningGraph()" class="btn btn-primary " style="background-color: blue;margin-top: 30px;">View Graph</button>
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
                            {{--<a href="{{url('admin/download-workorder')}}"><button class="btn"><i class="fa fa-download"></i>Download</button>--}}
                            {{--</a>--}}
                        {{--</div>--}}

                        <div class="table-responsive">
                            <div class="card-header">
                             <h4>CRC Cycle Time = "Disassembly  Starts To Disassembly Completion + Disassembly Completion  to Offer Send + Assembly Starts To Assembly Completion + Assembly Completion to Testing"</h4>
                                <h4>Total Cycle Time = "Disassembly  Starts To Dis Completion + Disassembly Completion  to Offer Send + Offer Submitted To Parts Received + Assembly Starts To Assembly Completion + Assembly Completion to Testing + Testing To Dispatch "</h4>
                            </div>
                            <table class="table align-items-center table-flush" id="tabe1">
                                <thead class="thead-light">
                                <tr>
                                    {{--<th scope="col" class="sort" data-sort="number">#</th>--}}
                                    {{--<th scope="col" class="sort" data-sort="number">SR NO </th>--}}
                                    <th scope="col" class="sort" data-sort="number">WO NO </th>
                                    <th scope="col" class="sort" data-sort="number">WO DESCRIPTION </th>
                                    <th scope="col" class="sort" data-sort="number">SEGMENT </th>
                                    <th scope="col" class="sort" data-sort="name">Section</th>
                                    <th scope="col" class="sort" data-sort="name">Project</th>
                                    <th scope="col" class="sort" data-sort="name">Equipment Model</th>
                                    <th scope="col" class="sort" data-sort="name">Component Model</th>
                                    <th scope="col" class="sort" data-sort="name">Estimated Start Date</th>
                                    <th scope="col" class="sort" data-sort="name">Estimated End Date</th>
                                    <th scope="col" class="sort" data-sort="name">PO</th>

                                    <th scope="col" class="sort" data-sort="name">Dismentle Start Date</th>
                                   <th scope="col" class="sort" data-sort="name">Dismentle End Date</th>
                                    <th scope="col" class="sort" data-sort="name">Dismentle  Starts To Dis Complition</th>
                                    <th scope="col" class="sort" data-sort="name">Quotation</th>
                                    <th scope="col" class="sort" data-sort="name">Dismentle Complition to Offer Send</th>
                                    <th scope="col" class="sort" data-sort="name">Store End Date</th>
                                    <th scope="col" class="sort" data-sort="name">Offer Submitted To Parts Received </th>
                                   <th scope="col" class="sort" data-sort="name">Assembly Start Date</th>
                                   <th scope="col" class="sort" data-sort="name">Assembly End Date</th>
                                   <th scope="col" class="sort" data-sort="name">Assembly Starts To Assembly Complition </th>
                                   <th scope="col" class="sort" data-sort="name">Testing Start Date</th>
                                   <th scope="col" class="sort" data-sort="name">Testing End Date</th>
                                   <th scope="col" class="sort" data-sort="name">Testing Starts To Testing Complition </th>
                                   <th scope="col" class="sort" data-sort="name">Assembly Complition to Testing</th>
                                   <th scope="col" class="sort" data-sort="name">Testing To Dispatch</th>
                                   <th scope="col" class="sort" data-sort="name">TAT</th>
                                   <th scope="col" class="sort" data-sort="name">CRC Cycle Time </th>
                                   <th scope="col" class="sort" data-sort="name">Total Cycle Time</th>


                                    {{--<th scope="col" class="sort" data-sort="name">END DATE</th>--}}


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

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>--}}
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
                paging:false,
                //pageLength: 57,
                destroy: true,
                searching: true,
                processing: true,
                serverSide: true,
             //dissstrtdate:   Carbon::parse('DissStartDate'),
                ajax:{
                    url: '{{ url("admin/workorder-get-table") }}',
                },
                columns: [
                    //{data: 'id', name: 'id',orderable: false, searchable: false},
                    //{data: 'service_request_no', name: 'service_request_no'},
                   {data: 'workorder', name: 'workorder'},
                   {data: 'description', name: 'description'},
                   {data: 'segment', name: 'segment'},
                    {data: 'dept', name: 'dept'} ,
                   {data: 'project_id', name: 'project_id'} ,
                   {data: 'model_no', name: 'model_no'} ,
                    {data: 'comp_model_no', name: 'comp_model_no'} ,
                    {data: 'estistart_date', name: 'estistart_date'} ,
                    {data: 'estiend_date', name: 'estiend_date'} ,
                   {data: 'podate', name: 'podate'} ,

                    {data: 'dissstartdate', name: 'dissstartdate'},
                   {data: 'dissenddate', name: 'dissenddate'},
                    {data: 'tat', name: 'tat'},
                    {data: 'quotationdate', name: 'quotationdate'},
                    {data: 'disstoquotation_tat', name: 'disstoquotation_tat'},
                    {data: 'storeenddate', name: 'storeenddate'},
                    {data: 'quotationtostore_tat', name: 'quotationtostore_tat'},
                   {data: 'assystartdate', name: 'assystartdate'},
                   {data: 'assyenddate', name: 'assyenddate'},
                   {data: 'assy_tat', name: 'assy_tat'},
                   {data: 'testingstartdate', name: 'testingstartdate'},
                   {data: 'testingenddate', name: 'testingenddate'},
                   {data: 'testing_tat', name: 'testing_tat'},
                   {data: 'assytotesting_tat', name: 'assytotesting_tat'},
                   {data: 'testingtodispatch_tat', name: 'testingtodispatch_tat'},
                   {data: 'estm_days', name: 'estm_days'},
                   {data: 'crc_cycle', name: 'crc_cycle'},
                   {data: 'total_cycle', name: 'total_cycle'},


                    //{data: 'estm_start_date', name: 'estm_start_date'},
                   // {data: 'estm_end_date', name: 'estm_end_date'},


                   // {data: 'action', name: 'action', orderable: false, searchable: false} ,
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

                searching: true,
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/workorder-filter") }}',
                    type: 'GET',

                    data: {location: location, '_token': '{{csrf_token()}}'},
                },
                columns: [
                    {data: 'workorder', name: 'workorder'},
                    {data: 'description', name: 'description'},
                    {data: 'segment', name: 'segment'},
                    {data: 'dept', name: 'dept'} ,
                    {data: 'project_id', name: 'project_id'} ,
                    {data: 'model_no', name: 'model_no'} ,
                    {data: 'comp_model_no', name: 'comp_model_no'} ,
                    {data: 'estistart_date', name: 'estistart_date'} ,
                    {data: 'estiend_date', name: 'estiend_date'} ,
                    {data: 'podate', name: 'podate'} ,

                    {data: 'dissstartdate', name: 'dissstartdate'},
                    {data: 'dissenddate', name: 'dissenddate'},
                    {data: 'tat', name: 'tat'},
                    {data: 'quotationdate', name: 'quotationdate'},
                    {data: 'disstoquotation_tat', name: 'disstoquotation_tat'},
                    {data: 'storeenddate', name: 'storeenddate'},
                    {data: 'quotationtostore_tat', name: 'quotationtostore_tat'},
                    {data: 'assystartdate', name: 'assystartdate'},
                    {data: 'assyenddate', name: 'assyenddate'},
                    {data: 'assy_tat', name: 'assy_tat'},
                    {data: 'testingstartdate', name: 'testingstartdate'},
                    {data: 'testingenddate', name: 'testingenddate'},
                    {data: 'testing_tat', name: 'testing_tat'},
                    {data: 'assytotesting_tat', name: 'assytotesting_tat'},
                    {data: 'testingtodispatch_tat', name: 'testingtodispatch_tat'},
                    {data: 'estm_days', name: 'estm_days'},
                    {data: 'crc_cycle', name: 'crc_cycle'},
                    {data: 'total_cycle', name: 'total_cycle'},
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

                searching: true,
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/workorder-datefilter") }}',
                    type: 'GET',

                    data: {startdate: startdate,enddate: enddate,location: location,'_token': '{{csrf_token()}}'},
                },
                columns: [
                    {data: 'workorder', name: 'workorder'},
                    {data: 'description', name: 'description'},
                    {data: 'segment', name: 'segment'},
                    {data: 'dept', name: 'dept'} ,
                    {data: 'project_id', name: 'project_id'} ,
                    {data: 'model_no', name: 'model_no'} ,
                    {data: 'comp_model_no', name: 'comp_model_no'} ,
                    {data: 'estistart_date', name: 'estistart_date'} ,
                    {data: 'estiend_date', name: 'estiend_date'} ,
                    {data: 'podate', name: 'podate'} ,

                    {data: 'dissstartdate', name: 'dissstartdate'},
                    {data: 'dissenddate', name: 'dissenddate'},
                    {data: 'tat', name: 'tat'},
                    {data: 'quotationdate', name: 'quotationdate'},
                    {data: 'disstoquotation_tat', name: 'disstoquotation_tat'},
                    {data: 'storeenddate', name: 'storeenddate'},
                    {data: 'quotationtostore_tat', name: 'quotationtostore_tat'},
                    {data: 'assystartdate', name: 'assystartdate'},
                    {data: 'assyenddate', name: 'assyenddate'},
                    {data: 'assy_tat', name: 'assy_tat'},
                    {data: 'testingstartdate', name: 'testingstartdate'},
                    {data: 'testingenddate', name: 'testingenddate'},
                    {data: 'testing_tat', name: 'testing_tat'},
                    {data: 'assytotesting_tat', name: 'assytotesting_tat'},
                    {data: 'testingtodispatch_tat', name: 'testingtodispatch_tat'},
                    {data: 'estm_days', name: 'estm_days'},
                    {data: 'crc_cycle', name: 'crc_cycle'},
                    {data: 'total_cycle', name: 'total_cycle'},
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });
        }

        //$(document).ready(function(){
        function miningGraph() {
            $("#startdate").attr("required", "true");
            $("#enddate").attr("required", "true");
            //alert('hi');
            var startdate = $("#startdate").val();
            var enddate = $("#enddate").val();
            var location = $("#location_id").val();
            var segment = $("#segment").val();
            console.log(startdate);
            console.log(enddate);
            console.log(location);

            if (startdate == null ) {
                alert('Please choose date range!!');
            }
            else{
               // alert('hii')
            $.ajax({

                url: '{{ url("/admin/workorder-graph") }}',

                type: 'GET',

                data: {
                    startdate: startdate,
                    enddate: enddate,
                    location: location,
                    segment: segment,
                    '_token': '{{csrf_token()}}'
                },

            })

                .done(function (response) {

                    if (response == 'failure') {
                        alert('Data not found!!');

                        return true;
                    } else {
                        var val = response;


                        $('#miningvalue').val(response);
                        var x = val.toString();
                        var val1 = x.split("-")[0]
                        var val2 = x.split("-")[1]
                        var val3 = x.split("-")[2]
                        var val4 = x.split("-")[3]
                        var val5 = x.split("-")[4]
                        var val6 = x.split("-")[5]
                        console.log(val1);
                        console.log(val2);
                        console.log(val3);
                        console.log(val4);
                        console.log(val5);
                        console.log(val6);



                        console.log("success");
                        Highcharts.chart('container', {
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                type: 'pie'
                            },
                            title: {
                                text: 'TAT'
                            },
                            tooltip: {
                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            accessibility: {
                                point: {
                                    valueSuffix: '%'
                                }
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                    }
                                }
                            },
                            series: [{
                                name: 'Brands',
                                colorByPoint: true,
                                data: [

                                     {name: "Component Receive To Job Creation ", y: Number(val1)},
                                    {name: "Disassembly Starts To Disassembly Completion", y: Number(val2)},
                                    {name: "Disassembly Completion To Offer Send", y: Number(val3)},
                                    {name: "Offer Submitted To Parts Received", y: Number(val4)},
                                    {name: "Assembly Starts To Assembly Completion", y: Number(val5)},
                                    {name: "Testing To Dispatch", y: Number(val6)}
                                ]
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
        // });

    </script>

    <script type="text/javascript">

        function highchartcall() {

            console.log('rim')
            //console.log(val)
            // var x = val.toString();
            // var val1 = x.split("-")[0]
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


        }
    </script>

@endsection