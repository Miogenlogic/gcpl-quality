@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Enter Time Sheet</h6>
                    {{--<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">--}}
                        {{--<ol class="breadcrumb breadcrumb-links breadcrumb-dark">--}}
                            {{--<li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>--}}
                            {{--<li class="breadcrumb-item active" aria-current="page">New service requeust</li>--}}
                        {{--</ol>--}}
                    {{--</nav>--}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body')

    <!-- Project List -->
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{url('admin/time-sheet-edit-save')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">Employee Id</label>
							<input class="form-control" name="emp_id" placeholder="{{$emp_id}}" value="" disabled>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">Employee Name</label>
                            <input class="form-control" placeholder="" value="{{$emp_name[0]['name']}}" readonly>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="" class="form-control-label">Section</label>
                            <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>

                                <select name="task" class="form-control select2">
                                    <option selected="selected" disabled="disabled">--Select--</option>
                                    @php
                                        $dept=App\Helpers\UserHelper::departmentname();
                                    @endphp

                                    @foreach($dept as $task)

                                        <option value="{{$task->id}}" {{($timesheet[0]['task']==$task->id)? 'selected=selected':''}}>{{$task->name}}</option>

                                        {{--<option value="{{$task->id}}">{{$task->name}}</option>--}}

                                    @endforeach
                                </select>

                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="servicedate" class="form-control-label">Job Summery</label>

                            <input class="form-control" name="job_summery" value="{{old('job_summery')?old('job_summery'):$timesheet[0]['job_summery']}}" id="servicedate">
                        </div>
                    </div>

                    <div class="card-body">


                            <div class="loose-part-repeat">
							
                                    <div class="row no-gutters">

                                        {{--<div class="col-md-2">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label for="" class="form-control-label">Service Request NO</label>--}}
                                                {{--<span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>--}}
                                                {{--@foreach($timesheet as $key=> $onepart)--}}
                                                    {{--<select name="service_req[]" class="form-control select2">--}}
                                                        {{--<option disabled="disabled" value="">--Select--</option>--}}
                                                        {{--@php--}}
                                                            {{--$serviceRequestNo=App\Helpers\UserHelper::serviceRequestNo();--}}
                                                        {{--@endphp--}}

                                                        {{--@foreach($serviceRequestNo as $requestNo)--}}
                                                            {{--<option value="{{$requestNo->service_request_no}}" {{($onepart['service_req']==$requestNo->service_request_no)? 'selected=selected':''}}>{{$requestNo->service_request_no}}</option>--}}

                                                        {{--@endforeach--}}
                                                    {{--</select>--}}
                                                {{--@endforeach--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Work Order NO</label>
                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                @foreach($timesheet as $key=> $onepart)
                                                    <input class="form-control" name="work_order[]" type="text" value="{{old('work_order')?old('work_order'):$onepart['work_order']}}" id="workorder" readonly>
                                                {{--<select name="work_order[]" id="workorder"  class="form-control">--}}
                                                    {{--<option selected="selected" disabled="disabled">--Select--</option>--}}
                                                    @php
                                                        $workOrderNo=App\Helpers\UserHelper::workOrderNo();
                                                    @endphp

                                                    {{--@foreach($workOrderNo as $orderNo)--}}
                                                        {{--<option value="{{$orderNo->work_orderno}}" {{($onepart['work_order']==$orderNo->work_orderno)? 'selected=selected':''}}>{{$orderNo->work_orderno}}</option>--}}

                                                    {{--@endforeach--}}
                                                {{--</select>--}}

                                                @endforeach
                                            </div>
                                        </div>

                                        {{--<div class="col-md-2">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label for="" class="form-control-label">Project</label>--}}
                                                {{--<span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>--}}
                                                {{--<select name="project[]" class="form-control select2">--}}
                                                    {{--<option selected="selected" disabled="disabled">--Select--</option>--}}
                                                    {{--@php--}}
                                                        {{--$projects=App\Helpers\UserHelper::projects();--}}
                                                    {{--@endphp--}}

                                                    {{--@foreach($projects as $project)--}}
                                                        {{--<option value="{{$project->project_id}}" {{($timesheet->project==$project->project_id)? 'selected=selected':''}}>{{$project->project_id}}</option>--}}

                                                    {{--@endforeach--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="" class="form-control-label custname">Customer</label>
												<select name="cust_name[]" id="empres" class="form-control">
												   <!--@php
														$customer=App\Helpers\UserHelper::customer();
													@endphp
													@foreach( $customer as $key=> $cus)
														
														<option value="{{$cus->id}}" {{(old('cust_name')==$cus->id?'Selected':$timesheet[0]['cust_name'] == $cus->id)?'Selected':''}}>{{$cus->name}}</option>
																

															
												
													@endforeach-->
													<option value="{{$customer1[0]['id']}}" readonly >{{$customer1[0]['name']}}</option>
												  </select>
												
												
                                                
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="servicedate" class="form-control-label">Date</label>
                                                @foreach($timesheet as $key=> $onepart)
                                                <input class="form-control" name="dated[]" type="text" value="{{date('d/m/Y', strtotime($onepart['dated']))}}" id="servicedate" readonly>
                                                @endforeach
                                            </div>
                                        </div>
                                        {{--<div class="col-md-2">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label for="" class="form-control-label">Day</label>--}}
                                                {{--<span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>--}}
                                                {{--@foreach($timesheet as $key=> $onepart)--}}
                                                    {{--<select name="day[]" class="form-control select2">--}}
                                                        {{--<option value="{{old('day')?old('day'):$onepart['day']}}" selected="selected">{{$onepart['day']}}</option>--}}
                                                        {{--<option value="Monday">Monday</option>--}}
                                                        {{--<option value="Tuesday">Tuesday</option>--}}
                                                        {{--<option value="Wednesday">Wednesday</option>--}}
                                                        {{--<option value="Thursday">Thursday</option>--}}
                                                        {{--<option value="Friday">Friday</option>--}}
                                                        {{--<option value="Saturday">Saturday</option>--}}
                                                    {{--</select>--}}
                                                {{--@endforeach--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label compserial" for="serial">Shift</label>
                                                @foreach($timesheet as $key=> $onepart)
                                                <select name="shift[]" class="form-control select2">

                                                    <option selected="selected">--Select--</option>
                                                    <option value="{{old('shift')?old('shift'):$onepart['shift']}}" selected="selected">{{$onepart['shift']}}</option>
                                                    <option value="GEN">GEN</option>
                                                    <option value="1ST" >1ST</option>
                                                    <option value="2ND" >2ND</option>
                                                    <option value="3RD">3RD</option>


                                                </select>
                                                @endforeach

                                                {{--<input class="form-control" name="shift" value="{{old('shift')?old('shift'):$timesheet[0]['shift']}}">--}}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="servicedate" class="form-control-label">Start Time</label>
                                                {{--<i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>--}}
                                                @foreach($timesheet as $key=> $onepart)
                                                <input class="form-control" name="start_time[]" type="time" value="{{old('start_time')?old('start_time'):$onepart['start_time']}}"  id="starttime{{$key}}" readonly>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="servicedate" class="form-control-label">End Time</label>
                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                @foreach($timesheet as $key=> $onepart)
                                                <input class="form-control" name="end_time[]" onclick="timecount({{$key}});" type="time" value="{{old('end_time')?old('end_time'):$onepart['end_time']}}" id="endtime{{$key}}">
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="" class="form-control-label totaltime">Hours</label>
                                                {{--//<span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>--}}
                                                @foreach($timesheet as $key=> $onepart)
                                                <input type="text" name="hours[]" id="totaltime{{$key}}"  class="form-control" placeholder="" value="@if (!empty($onepart['hours'])){{$onepart['hours']}} @endif" readonly>
                                                @endforeach
                                            </div>
                                        </div>



                                    </div>

                            </div>

                    </div>

                    <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            <label for="servicedate" class="form-control-label">remarks</label>

                            <input class="form-control" name="remarks" type="text" value="{{old('remarks')?old('remarks'):$timesheet[0]['remarks']}}" required>
                        </div>
                    </div>

                    @php $data= Session::get('user'); @endphp
                    @if($data['designation_id']==5)
                        <div class="col-sm-6 col-md-12 ">
                            <div class="form-group">
                                <label for="servicedate" class="form-control-label">Status</label>
                                <select class="form-control form-group" name="status">
                                    <option value="Submitted" @php echo $timesheet[0]['status']=='Submitted'?'selected':''; @endphp>Submitted</option>
                                    <option value="Approved" @php echo $timesheet[0]['status']=='Approved'?'selected':''; @endphp>Approved</option>
                                </status>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 ">
                        </div>
                    @endif

                </div><!-- /row -->
                  <input type="hidden" name="id" value="{{$timesheet[0]['id']}}">
               
                <input type="hidden" name="emp_code" value="{{$emp_id}}">

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Save</button>


            </form>
        </div>
    <!-- Project List -->



@endsection
@section('after_script')

    <!-- Optional JS -->
    {{--<script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>--}}
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

        <script type="text/javascript">

           // $('#custname').tooltip('show');
            $('#actualdate1').datepicker({
                format: "dd/mm/yyyy",
                autoclose: true,
                orientation: "down",
                //startDate: "today",
                //endDate: "today"

            });
            function actualplusdate(id) {
                $('#actualdateplus' + id).datepicker({
                    format: "dd/mm/yyyy",
                    autoclose: true,
                    orientation: "down",
                    startDate: "today",
                    endDate: "today"

                });
            }
        </script>
        <script type="text/javascript">
            function timecount(id) {

           //$("#endtime"+id).bind('click change',function(){
			   //alert("#endtime"+id);
                var strttime = $("#starttime"+id).val();

                var endtime = $("#endtime"+id).val();
                // mins = parseInt(endtime - strttime) ;
                //var diff =  new Date(endtime) - new Date( strttime);
                //alert(strttime)
                s = strttime.split(':');
                e = endtime.split(':');
                min = (e[1]-s[1]);
                hour_carry = 0;
                if(min < 0){
                    min += 60;
                    hour_carry += 1;
                }
                hour = e[0]-s[0]-hour_carry;
                // min = ((min/60) ).toString()
                if (min<10){
                    diff = hour + ":" + "0" +min;
                }
                else{
                    diff = hour + ":" + min ;
                }

                //diff = hour + ":" + min.substring(0,2);
              //alert(diff)


                $(".totaltime").show();
                //$("#totaltime").html(diff);
                $("#totaltime"+id).val(diff);
            }
			//});
            function timecountplus(id) {


                var strttime = $("#starttimeplus"+id).val();

                var endtime = $("#endtimeplus"+id).val();
                // mins = parseInt(endtime - strttime) ;
                //var diff =  new Date(endtime) - new Date( strttime);
                //alert(strttime)
                s = strttime.split(':');
                e = endtime.split(':');
                min = (e[1]-s[1]);
                hour_carry = 0;
                if(min < 0){
                    min += 60;
                    hour_carry += 1;
                }
                hour = e[0]-s[0]-hour_carry;
                // min = ((min/60) ).toString()
                if (min<10){
                    diff = hour + ":" + "0" +min;
                }
                else{
                    diff = hour + ":" + min ;
                }

                //diff = hour + ":" + min.substring(0,2);
                //alert(diff)


                $(".totaltime").show();
                //$("#totaltime").html(diff);
                $("#totaltimeplus"+id).val(diff);
            }
        </script>

        <script type="text/javascript">
            /*Model serial no*/
            $('#workorder').change(function(event) {
                var workorder = $(this).val();
                //
                //alert(workorder);
                //console.log(model);

                $.ajax({

                    url: '{{ url("/admin/customer-list-show") }}',

                    type: 'POST',

                    data: {workorder:workorder,'_token':'{{csrf_token()}}'},

                })

                    .done(function(response) {
                        //console.log(response);



                        // $('.custname').show();
                        $('.custname').show();

                        $('#custname').html(response);
                        //$('#custname1').html(response);




                        //mctype= jQuery.parseJSON(response);

                        console.log("success");

                    })

                    .fail(function() {

                        console.log("error");

                    })

                    .always(function() {

                        console.log("complete");

                    });



            });
            function workorderfrcust(id) {
                var workorder = $("#workorderplus"+ id).val();
                //
                //alert(workorder);
                //console.log(model);

                $.ajax({

                    url: '{{ url("/admin/customer-list-show") }}',

                    type: 'POST',

                    data: {workorder: workorder, '_token': '{{csrf_token()}}'},

                })

                    .done(function (response) {
                        //console.log(response);


                        // $('.custname').show();
                        $('.custname').show();

                        $('#custnameplus' + id).html(response);
                        //$('#custname1').html(response);


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
        </script>

        <script type="text/javascript">

            $(document).ready(function(){
                var maxField = 4; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.loose-part-repeat'); //Input field wrapper
                //New input field html
                var FieldCount=0

                //New input field html //newrow add by click

                var x = 1;
                //Once add button is clicked
                $(addButton).click(function(){


                    if(x <= maxField) //max input box allowed
                    {
                        FieldCount++; //text box added increment
                        //add input box
                        $(wrapper).append('<div class="row no-gutters">'+



                            '<div class="col-md-2">'+
                            '<div class="form-group">'+


                            '<select name="work_order[]" onclick="workorderfrcust('+ FieldCount +')" id="workorderplus'+ FieldCount +'" class="form-control select2" required>'+
                            '<option value="">--Select--</option>'+
                            " @foreach($workOrderNo as $orderNo) " +
                            '<option value="{{$orderNo->work_orderno}}">{{$orderNo->work_orderno}}</option>'+
                            " @endforeach " +

                            '</select>'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-md-2">'+
                            '<div class="form-group">'+
                            // '<label for="" class="form-control-label custname">Customer</label>'+

                            '<textarea class="form-control" name="cust_name[]" id="custnameplus'+ FieldCount +'"></textarea>'+

                            '</div>'+
                            '</div>'+

                                {{--'<div class="col-md-2">'+--}}
                                {{--'<div class="form-group">'+--}}
                                {{--'<select name="project[]" class="form-control select2">'+--}}
                                {{--' <option selected disabled>--Select--</option>'+--}}
                                {{--" @foreach($projects as $project) " +--}}
                                {{--'<option value="{{$project->project_id}}">{{$project->project_id}}</option>'+--}}
                                {{--" @endforeach " +--}}
                                {{--'</select>'+--}}
                                {{--'</div>'+--}}
                                {{--'</div>'+--}}

                            //  '<div class="col-md-2">'+
                            // '<div class="form-group">'+
                            // '<select name="day[]" class="form-control select2">'+
                            // '<option selected="selected">--Select--</option>'+
                            // '<option value="Monday">Monday</option>'+
                            // '<option value="Tuesday">Tuesday</option>'+
                            // '<option value="Tuesday">Tuesday</option>'+
                            // '<option value="Thursday">Thursday</option>'+
                            // '<option value="Friday">Friday</option>'+
                            // '<option value="Saturday">Saturday</option>'+
                            // '</select>'+
                            // '</div>'+
                            // '</div>'+

                            '<div class="col-md-2">'+
                            '<div class="form-group">'+
                            '<input type="text" class="form-control" onclick="actualplusdate('+ FieldCount +')" id="actualdateplus'+ FieldCount +'" placeholder="" name="dated[]" value="" required>'+
                            '</div>'+
                            '</div>'+

                            '<div class="col-md-1">'+
                            '<div class="form-group">'+
                            // '<label class="form-control-label compserial" for="serial">Shift</label>'+
                            '<select name="shift[]" class="form-control select2" required>'+
                            '<option value="">--Select--</option>'+
                            '<option value="GEN">GEN</option>'+
                            '<option value="1ST">1ST</option>'+
                            '<option value="2ND">2ND</option>'+

                            '</select>'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-md-2">'+
                            '<div class="form-group">'+
                            // '<label for="servicedate" class="form-control-label">start Time</label>'+

                            '<input class="form-control" name="start_time[]" type="time" value="" id="starttimeplus'+ FieldCount +'" required>'+
                            '</div>'+
                            '</div>'+

                            '<div class="col-md-2">'+
                            '<div class="form-group">'+
                            // '<label for="servicedate" class="form-control-label">End Time</label>'+

                            '<input class="form-control" name="end_time[]" type="time" value="" onclick="timecountplus('+ FieldCount +')" id="endtimeplus'+ FieldCount +'">'+
                            '</div>'+
                            '</div>'+
                                {{----}}
                                        {{--'<div class="col-md-3">'+--}}
                                        {{--'<div class="form-group">'+--}}
                                        {{--'<select name="task[]" class="form-control select2">'+--}}
                                        {{--' <option selected disabled>--Select--</option>'+--}}
                                        {{--" @foreach($dept as $task) " +--}}
                                        {{--'<option value="{{$task->id}}">{{$task->name}}</option>'+--}}
                                        {{--" @endforeach " +--}}
                                        {{--'</select>'+--}}
                                        {{--'</div>'+--}}
                                        {{--'</div>'+--}}



                                    '<div class="col-md-1">'+
                            '<div class="form-group">'+
                            '<input type="text" name="hours[]" type="time" id="totaltimeplus'+ FieldCount +'"  class="form-control" placeholder="" readonly>'+
                            '</div>'+
                            '</div>'+

                            '<div class="col-auto">'+
                            '<a href="javascript:void(0);" class="btn btn-danger remove_button" id="remove_button">-</a>'+
                            '</div>'+
                            '</div>');

                        x++; //text box increment
                    }
                    return false;




                });
                //$('.select2').select2();
                //Once remove button is clicked
                $(wrapper).on('click', '#remove_button', function(e){
                    e.preventDefault();
                    $(this).parent().parent().remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });


        </script>



@endsection
