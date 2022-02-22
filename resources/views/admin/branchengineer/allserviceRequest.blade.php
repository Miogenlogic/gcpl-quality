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
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">All service requests</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">All service requests</li>
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
                        <!-- Card header -->
                         <p id="msg" style="display: none;"></p>
                        <p id="msg1" style="display: none;"></p>
                        <p id="msg2" style="display: none;"></p>
                        <p id="msg3" style="display: none;"></p>
                        <p id="msg4" style="display: none;"></p>
                        <?php if(isset($msg)){?>
                        <center><span>{{$msg}}</span></center> 
                        <?php } ?>
                        <div class="card-header border-0">
                            <h3 class="mb-0">Service Request List</h3>
                        </div>
						@if (request()->session()->get('user')['section_id'] == '1')
                         <div class="row" style="padding-left: 50px;margin-bottom: 33px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Customer Name <span style="color:red">*</span></label>
                                    <input type="text"  class="form-control customer1" id="customer_val" value="" >
                                    <select name="customer" id="customer" class="form-control customer" style="display: none;" >


                                    </select>
									<!--<select name="customer_id" id="customerid" class="form-control select2">
                                        <option selected="selected" disabled="disabled">--Select customer--</option>
                                        @php
                                            $customer=App\Helpers\UserHelper::customer();
                                        @endphp

                                        @foreach($customer as $cus)

                                            <option value="{{$cus->customer_code}}">{{$cus->name}}-{{$cus->customer_code}}</option>

                                        @endforeach
                                    </select>-->
                                    @if($errors->has('customer'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('customer')}}</div>
                                    @endif
                                </div>
                                
                            </div>
                                <div class="col-md-3">
								<label class="form-control-label" for="customer">Service Request No<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="workorder_no" id="servicenumber" value="" placeholder="Give Service Request No.">
                                </div>      
                                
                                <div class="col-md-6" style="padding-top: 30px">  
                                        <button type="submit" id="syncworkorder" class="btn btn-info"><i class="fa fa-refresh"></i> Sync with Workorder</button>
                                    
                                     
                                        <button type="submit" id="syncserviceno" class="btn btn-info"><i class="fa fa-refresh"></i> Sync with Service Request No. </button>
                                    
                                </div>
                            
                        </div>
						@endif

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

						
                        @if (request()->session()->get('user')['section_id'] == '1')

                         @if (request()->session()->get('user')['role_id'] == '1')
    						<div>
    						<a href="{{url('admin/service-request-add')}}" class="btn btn-info" style="    float: right;margin-right: 25px;margin-bottom: 12px;">Create</a>
    						</div>
    					 @endif
                        @endif	
						
                        <div class="table-responsive" style="overflow-x: hidden;">
                            <table class="table align-items-center table-flush" id="tabe1">
                                <thead class="thead-light">
                                <tr>
                                    <!-- <th scope="col" class="sort" data-sort="number">#</th>-->
                                    <!-- <th scope="col" class="sort" data-sort="name">Service Request No</th>-->
								    <!--<th scope="col" class="sort" data-sort="name">Description</th>-->
								    <!-- <th scope="col" class="sort" data-sort="name">Employee Respnsible</th>-->
								    <!-- <th scope="col" class="sort" data-sort="name">Impact</th>-->
				                    <!--<th scope="col" class="sort" data-sort="name">Status</th>-->
                                    <!-- <th scope="col" class="sort" data-sort="name">Customer</th>-->
                                    <!-- <th scope="col" class="sort" data-sort="name">Branch</th>-->
                                    <!-- <th scope="col" class="sort" data-sort="name">Component Name</th>-->
                                    <!-- <th scope="col" class="sort" data-sort="name">Segment</th>-->
                                    <!-- <th scope="col" class="sort" data-sort="name">Recomendation</th>-->
                                    <!-- <th scope="col" class="sort" data-sort="name">Action</th>-->
                                <th scope="col" class="sort" data-sort="number">#</th>
                                <th scope="col" class="sort" data-sort="name">SR No</th>
                                <th scope="col" class="sort" data-sort="name">WO No</th>
                                <!--<th scope="col" class="sort" data-sort="name">Customer</th>-->
                                <th scope="col" class="sort" data-sort="name">Segment</th>
                                <th scope="col" class="sort" data-sort="name">Job Type</th>
                                <th scope="col" class="sort" data-sort="name">Component</th>
                                <th scope="col" class="sort" data-sort="name">Status</th>

                                <th scope="col" class='notexport' data-sort="name">Action</th>
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
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
/* customer */

        $('#customer_val').keyup(function(event) {
            var customer = $(this).val();
            //alert(commodel);
            console.log(customer);

            if(customer.length >= 4) {
                $.ajax({

                    url: '{{ url("/admin/customerdropdown-filter") }}',

                    type: 'POST',

                    data: {customer: customer, '_token': '{{csrf_token()}}'},

                })

                    .done(function (response) {
                        //console.log(response);


                        $('.customer').show();

                        $('#customer').html(response);
                        $('#customer').attr('required',true);

                        //$('.compserial').show();

                        // $('#compserial').html(response);requ

                        //mctype= jQuery.parseJSON(response);

                        console.log("success");

                    })

                    .fail(function () {

                        console.log("error");

                    })

                    .always(function () {

                        console.log("complete");

                    });

            }

        });
</script>



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
                    }},
                ],
                destroy: true,
                //paging:false,
                //pageLength: 57,

                searching: true,
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/service-request-get-table") }}',
                },
                columns: [
                        // {data: 'id', name: 'id',orderable: false, searchable: false},
                        // {data: 'service_request_no', name: 'service_request_no'},
				        // {data: 'description', name: 'description'},
				        // {data: 'empres', name: 'empres'},
					   
                        // {data: 'impact', name: 'impact'},
				        // {data: 'cc_status', name: 'cc_status'},
				        // {data: 'customer', name: 'customer'},
                        // {data: 'branch_name', name: 'branch_name'},
                        // {data: 'component_name', name: 'component_name'},
                        // {data: 'segment', name: 'segment'},
			            // {data: 'recom', name: 'recom'},
                        // {data: 'created_at', name: 'created_at'},
                        // {data: 'action', name: 'action', orderable: false, searchable: false} ,
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'service_request_no', name: 'service_request_no'},
                     {data: 'work_orderno', name: 'work_orderno'},
                    //{data: 'customer', name: 'customer'},
                    {data: 'segment', name: 'segment'},
                     {data: 'job_type', name: 'job_type'},
                    {data: 'component_name', name: 'component_name'},
                    {data: 'status', name: 'status'},
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

        function locationfilter(){

            var location = $("#location_id").val();
            //alert(location);
            $('#tabe1').DataTable({
                dom: 'lBfrtip',
                //buttons: ['excel']
                buttons: [ { extend: 'excel', text: 'Download in Excel Format',
                    exportOptions: {
                        columns: ':not(.notexport)'
                    }},
                ],
                destroy: true,
                //paging:false,
                //pageLength: 57,

                searching: false,
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/service-requestfilter-get-table") }}',
                    type: 'GET',

                    data: {location: location, '_token': '{{csrf_token()}}'},
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'service_request_no', name: 'service_request_no'},
                    {data: 'work_orderno', name: 'work_orderno'},
                    //{data: 'customer', name: 'customer'},
                    {data: 'segment', name: 'segment'},
                    {data: 'job_type', name: 'job_type'},
                    {data: 'component_name', name: 'component_name'},
                    {data: 'status', name: 'status'},
                    //{data: 'created_at', name: 'created_at'},
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
               // paging:false,
                //pageLength: 57,

                searching: false,
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/service-requestdatefilter-get-table") }}',
                    type: 'GET',

                    data: {startdate: startdate,enddate: enddate,location: location,'_token': '{{csrf_token()}}'},
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'service_request_no', name: 'service_request_no'},
                    {data: 'work_orderno', name: 'work_orderno'},
                    //{data: 'customer', name: 'customer'},
                    {data: 'segment', name: 'segment'},
                    {data: 'job_type', name: 'job_type'},
                    {data: 'component_name', name: 'component_name'},
                    {data: 'status', name: 'status'},
                    //{data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });
        }



    </script>
	 <script>
        $('.select2').select2();

    </script>
 <script type="text/javascript">
        /*component serial no*/
        $('#syncworkorder').click(function(event) {

            var coserial = $('#servicenumber').val();
           var customerid = $('#customer').val();
           alert(customerid);
         console.log(coserial);

            $.ajax({

                //url: '{{-- url("/admin/sync-with-workorder"--}}',
                url: '{{ url("/admin/sapresponse") }}',

                type: 'GET',

                data: {coserial:coserial,customerid:customerid,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {

                    //alert('Work Order Number Generated');

                    console.log("success");
                    console.log( response.split(","))
                    var res1=response.split(",");
                    console.log(res1)
                    $("#msg").show();
                    $("#msg").text(res1[0]);
                    $("#msg1").show();
                    $("#msg1").text(res1[1]);
                    $("#msg2").show();
                    $("#msg2").text(res1[2]);
                    $("#msg3").show();
                    $("#msg3").text(res1[3]);
                    $("#msg4").show();
                    $("#msg4").text(res1[4]);



                })

                .fail(function() {

                    console.log("error");

                })

                .always(function() {

                    console.log("complete");

                });



        });
    </script>

    <script type="text/javascript">
        /*component serial no*/
        $('#syncserviceno').click(function(event) {
            //var coserial = $(this).val();
            var servno = $('#servicenumber').val();
			   var customerid = $('#customer').val();
            //alert(coserial);
             console.log(servno);

            $.ajax({

                url: '{{ url("/admin/sapresponse") }}',

                type: 'GET',

                data: {servno:servno,customerid:customerid,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {
                    //console.log(response);
                    // $('.compserial').show();

                    //$('#compserial').html(response);

                    //mctype= jQuery.parseJSON(response);
                    //alert('Service Order Number Generated');
                    console.log("success");
                    console.log( response.split(","))
                    var res=response.split(",");
                    console.log(res)
                    $("#msg").show();
                    $("#msg").text(res[0]);
                    $("#msg1").show();
                    $("#msg1").text(res[1]);
                    $("#msg2").show();
                    $("#msg2").text(res[2]);
                    $("#msg3").show();
                    $("#msg3").text(res[3]);
                    $("#msg4").show();
                    $("#msg4").text(res[4]);


                })

                .fail(function() {

                    console.log("error");

                })

                .always(function() {

                    console.log("complete");

                });



        });
    </script>

@endsection


