@extends('admin.include.layout')
@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Edit BIS Checksheet</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit BIS Checksheet</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body')

    @php
     //echo'<pre>'; print_r($serviceid['work_orderno']);die;
      
	 // $bischeck=App\Helpers\UserHelper::bis();
    @endphp

    <!-- Project List -->
    <div class="card mb-4">
	@if (request()->session()->get('user')['section_id'] == '23')
       <div class="text-right mb-1" style="padding-right: 70px">


            <form method="post" action="{{url('admin/bis-excel-download')}}" enctype="multipart/form-data">
                <input type="hidden" name="service_id" value="{{$servicerequestdata[0]['service_request_id']}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <input class="btn btn-primary" type="submit" value="Excel Download">
            </form>




        </div>
		@endif
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{ url('/admin/save-bis')}}" enctype="multipart/form-data">
                <div class="row">
						<!--<input type ="hidden" name="bisid" value="{{Request::segment(3)}}">-->
					<div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Workorder no</label>
                            <input type="text" name="job_no" class="form-control" id="job_no" value="@if(!empty($serviceid['work_orderno'])) {{$serviceid['work_orderno']}} @endif" readonly>
                            @if($errors->has('job_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('job_no')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Model</label>
                            <input type="text" name="model" class="form-control" id="model" value="@if(!empty($modelno[0]->model_no)) {{$modelno[0]->model_no}} @endif" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label component_sl" for="component_sl_no">COMPONENT SL NO.</label>
                              <input name="component_sl_no" id="component_sl" class="form-control" value="@if(!empty($compsl[0]['comp_serial_no'])) {{$compsl[0]['comp_serial_no'] }} @endif" readonly>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Customer</label>
                            <input type="text" name="customer" class="form-control" id="service" value="@if(!empty($customer[0]['name'])) {{$customer[0]['name']}} @endif" readonly>
                           
                        </div>
                    </div>


                    <div class="col-md-12" style="border: 1px solid gray; margin-bottom: 31px;"></div>

                </div>

                @if($servicerequestdata!=null && count($servicerequestdata)!=0)
                @foreach($servicerequestdata as $servicerequest)

                <div class="row" style="margin-top: 9px; border: 1px solid; border-radius: 11px; margin-bottom: 24px;">

                   <div class="col-sm-6 col-md-3">
                       <div class="form-group">
    						<label class="form-control-label" for="service" style="margin-top: 26px;">Technician</lable>
                            <input type="text" class="form-control" id="service"  name="technician[]" value=
    						"{{old('technician')?old('technician'):$servicerequest['technician']}}">
    						 @if($errors->has('solution'))
                                    <div class="invalid-feedback" style="display:block;">{{$errors->first('technician')}}</div>
                                @endif
    					</div>
					</div>
					
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label  machmodel" for="model" style="margin-top: 26px;">Test Smu</label>
                            <input type="text" name="test_smu[]" class="form-control" id="service" value="{{old('test_smu')?old('test_smu'): $servicerequest['test_smu']}}" >
                             @if($errors->has('solution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('test_smu')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label  machmodel" for="model" style="margin-top: 6px;">Engine Enter Date Time In The Test Bench</label>
                            <input type="text" name="engine_enter_date_time_in_the_test_bench[]" class="form-control" id="service" value="{{date('d/m/Y', strtotime($servicerequest['engine_enter_date_time_in_the_test_bench']))}}" readonly>
							 @if($errors->has('solution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('engine_enter_date_time_in_the_test_bench')}}</div>
                            @endif
                           
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service" style="margin-top: 26px;">Month</label>
                            <input type="text" name="month[]" class="form-control" id="service" value="{{old('	month')?old('month'):$servicerequest['month']}}" >
                           @if($errors->has('solution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('month')}}</div>
                            @endif
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Problem During Testing</label>
                            <input type="text" name="problem_during_testing[]" class="form-control" id="service" value="{{old('problem_during_testing')?old('problem_during_testing'):$servicerequest['problem_during_testing']}}" >
                          
                           @if($errors->has('solution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('problem_during_testing')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label roanalysis" for="service">Root Cause Analysis</label>
							
							 
                            <input type="text" name="root_cause_analysis[]" class="form-control" id="service" value="{{old('root_cause_analysis')?old('root_cause_analysis'):$servicerequest['root_cause_analysis']}}" >
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label why" for="service">Why</label>
                            <input type="text" name="why[]" class="form-control" id="why" value="{{old('why')?old('why'):$servicerequest['why']}}" >
                          @if($errors->has('solution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('why')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">Solution</label>
                            <input type="text" name="solution[]" class="form-control" id="service" value="{{old('solution')?old('solution'):$servicerequest['solution']}}" >
                            @if($errors->has('solution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('solution')}}</div>
                            @endif

                        </div>
                    </div>


                    <!--<div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Date</label>
                            <input type="date" name="engine_out_date_time" class="form-control" id="service" value="{{old('engine_out_date_time')?old('engine_out_date_time'):$servicerequest['engine_out_date_time']}}" >
                            
                        </div>
                    </div>-->

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Impact</label>
                            <input type="text" name="impact[]" class="form-control" id="service" value="{{old('impact')?old('impact'):$servicerequest['impact']}}" >
                           
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label  typprblm" for="arnumber">Type of Problem</label>
                            
                                <input type="text" name="type_of_problem[]" class="form-control" id="service" value="{{old('type_of_problem')?old('type_of_problem'):$servicerequest['type_of_problem']}}" >

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label areaproblem" for="arnumber">Area Of Problem</label>
                            
                            <input type="text" name="area_of_problem[]" class="form-control" id="service" value="{{old('area_of_problem')?old('area_of_problem'):$servicerequest['area_of_problem']}}" >
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label portionprb" for="arnumber">Portion of Problem</label>
                            
                           <input type="text" name="portion_of_problem[]" class="form-control" id="service" value="{{old('portion_of_problem')?old('portion_of_problem'):$servicerequest['portion_of_problem']}}" >
                           
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Further Action</label>
                            <input type="text" name="further_action[]" class="form-control" id="service" value="{{old('further_action')?old('further_action'):$servicerequest['further_action']}}" >
                            @if($errors->has('engine_out_date_time'))
                                <div class="invalid-feedback" style="display:block;">{{$engineoutdate->first('further_action')}}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Actual Start Date</label>

                            <input type="text" class="form-control" id="" placeholder="" name="actual_start_date[]" value="{{date('d/m/Y', strtotime($servicerequest['actual_start_date']))}}" disabled>

                        </div>
                    </div>

				    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Actual End Date</label>

                            <input type="text" class="form-control" id="actualdate2" placeholder="" name="actual_end_date[]" value="{{date('d/m/Y', strtotime($servicerequest['actual_end_date']))}}" required>

                        </div>
                    </div>
				
                    <input type="hidden" name="id[]" value="{{$servicerequest['id']}}">
               

                </div>

                @endforeach
                @endif
				
               <!-- <input type="hidden" name="id" value="{{$errors->id}}">-->
               @if($checkgate->bis_status != 'Approved')
                <input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="service_request_id" value="{{ $servicerequestdata[0]['service_request_id']}}">
                <button class="btn btn-primary" type="submit">save</button>
                <button type="reset" class="btn btn-warning" onclick='location.href ="{{url('admin/service-request-list')}}"'>Cancel</button>
                @endif
            </form>
            
            
           <!-- <div class="mt-2">Download Prehistory Sample Excel<a class="badge badge-primary" href="{{URL::asset('public/assets/download/sampleexcel.xlsx')}}">Sample excel File</a></div>
        </div>-->
    </div>
@if (request()->session()->get('user')['section_id'] == '23')
                @if(request()->session()->get('user')['role_id'] == '2')
                    @if($checkgate->bis_status != 'Approved')
                        <div class="" style="padding-right: 70px">
                            <form method="post" action="{{url('admin/head-approve-bis-save')}}" enctype="multipart/form-data">
                                <div class="custom-control custom-control-inline custom-radio">
                                    <input name="status" class="custom-control-input approved" id="approved" type="radio" value="Approved">
                                    <label class="custom-control-label" for="approved">Approve</label>
                                    {{--<textarea style="padding-left: 10px" name="comment"  placeholder="comments"></textarea>--}}
                                </div>
                                <div class="text-right mb-1 col-md-12 commentapr"  style="display:none" >
                                    <textarea type="text" name="comment" class="form-control" id="commentapr" value="" ></textarea>
                                </div>

                                <div class="custom-control custom-control-inline custom-radio">
                                    <input name="status" class="custom-control-input rejected" id="rejected" type="radio" value="Rejected">
                                    <label class="custom-control-label" for="rejected">Reject   </label>
                                    {{--<textarea  name="comment"  placeholder="comments"></textarea>--}}
                                </div>
                                <div class="text-right mb-1 col-md-12 commentrgt"  style="display:none">
                                    <textarea type="text" name="comment" class="form-control " id="commentrgt1" value=""></textarea>
                                </div>

                                <input type="hidden" name="service_id" value="{{$checkgate->id}}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input class="btn btn-primary" type="submit" value="submit">

                            </form>


                        </div>
                @endif
                 @endif
        @endif

@if (request()->session()->get('user')['section_id'] == '23')
                    @if(request()->session()->get('user')['role_id'] == '1')
                        <div class="col-14">
                            @if(!empty($rejectmsg))
                                @if($rejectmsg[0]['bis_status']=='Rejected')
                                    <label class="form-control-label" for="customer" style="padding-top: 20px">CheckSheet Rejected  at   {{$rejectmsg[0]['created_at']}}</label>
                                    <textarea type="text" name="comment_for_approve" class="form-control " id="commentrgt" disabled>{{$rejectmsg[0]['bis_comment']}}</textarea>
                                @endif
                            @endif    
                        </div>
                    @endif
                @endif

@endsection
@section('after_script')

    <!-- Optional JS -->
    {{--<script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>--}}
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

    <script type="text/javascript">
        /*Model serial no*/
        $('#machmodel').change(function(event) {
            var model = $(this).val();
            //alert(model);
            //console.log(model);

            $.ajax({

                url: '{{ url("/admin/machine-serial-list-show") }}',

                type: 'POST',

                data: {model:model,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {
                    //console.log(response);



                    $('.machserial').show();

                    $('#machserial').html(response);




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
    </script>


    <script type="text/javascript">
        /*component model no*/
        $('#machmodel').change(function(event) {
            var commodel = $(this).val();
            //alert(commodel);
            //console.log(model);

            $.ajax({

                url: '{{ url("/admin/component-model-list-show") }}',

                type: 'POST',

                data: {commodel:commodel,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {
                    //console.log(response);





                    $('.compmodel').show();

                    $('#compmodel').html(response);

                    $('.compserial').show();

                    $('#compserial').html(response);

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
    </script>


    <script type="text/javascript">
        /*component serial no*/
        $('#machmodel').change(function(event) {
            var coserial = $(this).val();
            //alert(coserial);
            //console.log(model);

            $.ajax({

                url: '{{ url("/admin/component-serial-list-show") }}',

                type: 'POST',

                data: {coserial:coserial,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {
                    //console.log(response);







                    $('.compserial').show();

                    $('#compserial').html(response);

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

    </script>

<script type="text/javascript">
        /*Model serial no*/
        $('#approved').change(function() {
            //alert(1);
            $(".commentapr").show();
            $(".commentrgt").hide();

            //console.log(model);

        });
        $('#rejected').change(function() {
            // alert(1);
            $(".commentapr").hide();
            $(".commentrgt").show();
            $(".commentrgt").prop("disabled".false);


            //console.log(model);

        });
		 $('#actualdate2').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            orientation: "down",
            endDate: "today"

        });

    </script>

@endsection

