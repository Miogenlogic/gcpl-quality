@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Create BisCheckSheet</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">New service requeust</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body')

@php
//echo '<pre>';print_r($modelno['model_no']);exit;
@endphp
    <!-- Project List -->
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
		
		
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{url('admin/bis-add-save')}}" enctype="multipart/form-data">
                <div class="row">
                  <!--<div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="technician">Department</label>
                             <input type="text" name="technician" class="form-control" id="service" value="" >
                        </div>
                    </div>-->

                  
					
    					<div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="service">Workorder no</label>
                                <input type="text" name="job_no" class="form-control" id="job_no" value="{{old('work_orderno')?old('work_orderno'):$servicereq[0]['work_orderno']}}" readonly>
                                @if($errors->has('job_no'))
                                    <div class="invalid-feedback" style="display:block;">{{$errors->first('job_no')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label mod" for="model">Model</label>
                                
                             <input name="model" id="mod" class="form-control" value="@if(!empty($modelno[0]['model_no'])) {{$modelno[0]['model_no']}} @endif" readonly>
                                     
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label component_sl" for="component_sl_no">COMPONENT SL NO.</label>
                                    
                                 <input name="component_sl_no" id="component_sl" class="form-control" value="@if(!empty($servicereq[0]['comp_serial_no'])) {{$servicereq[0]['comp_serial_no']}} @endif" readonly>
                                         
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="service">Customer</label>
                                <input type="text" name="customer" class="form-control" id="customer" value=" @if(!empty($customer[0]['name'])) {{$customer[0]['name']}} @endif" readonly>
                                @if($errors->has('customer'))
                                    <div class="invalid-feedback" style="display:block;">{{$errors->first('customer')}}</div>
                                @endif
                            </div>
                        </div>

                    <div class="col-md-12" style="border: 1px solid gray; margin-bottom: 31px;"></div>

                </div>

                <div class="row">
                    <div class="col-md-12">

                            <div class="col-auto" style="float: right; margin-top: 10px;">
                            <a href="javascript:void(0);" class="btn btn-default add-bis">ADD MORE+</a>
                           </div>

                    </div>
                </div>

                <div class="report-block">

                <div class="row " style="margin-top: 9px; border: 1px solid; border-radius: 11px; margin-bottom: 24px;">



                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="technician" style="margin-top: 26px;">TECHNICIAN</label>
                            <input type="text" name="technician[]" class="form-control" id="service" value="" >
                        </div>
                    </div>
					
					

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label  machmodel" for="model" style="margin-top: 26px;">Test Smu</label>
                            <input type="text" name="test_smu[]" class="form-control" id="service" value="" >
                             @if($errors->has('solution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('test_smu')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label  machmodel" for="model" style="margin-top: 5px;">Engine Enter Date Time In The Test Bench</label>
                            <input type="text" name="engine_enter_date_time_in_the_test_bench[]" class="form-control enginedate" id="enginedate"  value="" required>
							 @if($errors->has('solution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('engine_enter_date_time_in_the_test_bench')}}</div>
                            @endif
                           
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service" style="margin-top: 26px;">Month</label>
                            <input type="text" name="month[]" class="form-control" id="service" value="" >
                           @if($errors->has('solution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('month')}}</div>
                            @endif
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Problem During Testing</label>
                            <input type="text" name="problem_during_testing[]" class="form-control" id="service" value="" >
                          
                           @if($errors->has('solution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('problem_during_testing')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label roanalysis" for="service">Root Cause Analysis</label>
							
							 
                            <input type="text" name="root_cause_analysis[]" class="form-control" id="service" value="" >
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label why" for="service">Why</label>
                            <input type="text" name="why[]" class="form-control" id="why" value="" >
                          @if($errors->has('solution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('why')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">Solution</label>
                            <input type="text" name="solution[]" class="form-control" id="service" value="" >
                            @if($errors->has('solution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('solution')}}</div>
                            @endif

                        </div>
                    </div>


                    <!--<div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Date</label>
                            <input type="date" name="engine_out_date_time" class="form-control" id="service" value="" >
                            
                        </div>
                    </div>-->

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Impact</label>
                            <input type="text" name="impact[]" class="form-control" id="service" value="" >
                           
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label  typprblm" for="arnumber">Type of Problem</label>
                            
                                <input type="text" name="type_of_problem[]" class="form-control" id="service" value="" >

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label areaproblem" for="arnumber">Area Of Problem</label>
                            
                            <input type="text" name="area_of_problem[]" class="form-control" id="service" value="" >
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label portionprb" for="arnumber">Portion of Problem</label>
                            
                           <input type="text" name="portion_of_problem[]" class="form-control" id="service" value="" >
                           
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Further Action</label>
                            <input type="text" name="further_action[]" class="form-control" id="service" value="" >
                            @if($errors->has('engine_out_date_time'))
                                <div class="invalid-feedback" style="display:block;">{{$engineoutdate->first('further_action')}}</div>
                            @endif
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Actual Start Date <span style="color:red">*</span></label>
                            <input type="text" class="form-control actualdate1" id="actualdate1" placeholder="" name="actual_start_date[]" value=""  required>

                        </div>
                    </div>

					<div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Actual End Date <span style="color:red">*</span></label>
                            <input type="text" class="form-control actualdate2" id="actualdate2" placeholder="" name="actual_end_date[]" value=""  required>

                        </div>
                    </div>


                </div>

                </div>



              <!-- /row -->
                <input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="service_request_id" value="{{$servicereq[0]['id']}}">
                <button class="btn btn-primary" type="submit">Save</button>

                <button type="reset" class="btn btn-warning" onclick='location.href ="{{url('admin/service-request-list')}}"'>Cancel</button>
            </form>

        </div>

    </div>
    <!-- Project List -->




@endsection

@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>

     <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
     
      <script type="text/javascript">
    $('.actualdate1').datepicker({
    format: "dd/mm/yyyy",
    autoclose: true,
    orientation: "down",
    endDate: "today"

    });
	 $('.enginedate').datepicker({
    format: "dd/mm/yyyy",
    autoclose: true,
    orientation: "down",
    endDate: "today"

    });
	$('.actualdate2').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        orientation: "down",
        endDate: "today"

    });
    </script>

    <script type="text/javascript">
                $(document).ready(function(){
                    var maxField = 5; //Input fields increment limitation
                    var addButton = $('.add-bis'); //Add button selector
                    var wrapper = $('.report-block'); //Input field wrapper

                    //alert(countafterfield);
                    //New input field html
                    var x = 0;
                    var FieldCount=0;
                    var countidlrclear =$('#countbushinspmea').val();

                    if(countidlrclear !== null){
                        x = countidlrclear -1;
                        FieldCount =countidlrclear -1;
                    }
                    if(isNaN (countidlrclear) ){
                        x = 0;
                        FieldCount=0;
                    }
                    console.log(x)
                    //Once add button is clicked
                    $(addButton).click(function(){




                        if(x <= maxField) //max input box allowed
                        {
                            FieldCount++; //text box added increment
                            //add input box
                            $(wrapper).append('<div class="row" style="margin-top: 9px; border: 1px solid; border-radius: 11px; margin-bottom: 24px;">'+



                    '<div class="col-sm-6 col-md-3">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label" for="technician" style="margin-top: 26px;">TECHNICIAN</label>'+
                            '<input type="text" name="technician[]" class="form-control" id="service" value="" >'+
                        '</div>'+
                    '</div>'+
                    
                    

                    '<div class="col-sm-6 col-md-3">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label  machmodel" for="model" style="margin-top: 26px;">Test Smu</label>'+
                            '<input type="text" name="test_smu[]" class="form-control" id="service" value="" >'+
                             
                        '</div>'+
                    '</div>'+

                    '<div class="col-sm-6 col-md-3">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label  machmodel" for="model" style="margin-top: 5px;">Engine Enter Date Time In The Test Bench</label>'+
                            '<input type="text" name="engine_enter_date_time_in_the_test_bench[]" class="form-control enginedate" id="enginedate"  value="" required>'+
                        '</div>'+
                    '</div>'+


                    '<div class="col-sm-6 col-md-3">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label" for="service" style="margin-top: 26px;">Month</label>'+
                            '<input type="text" name="month[]" class="form-control" id="service" value="" >'+
                        '</div>'+
                   ' </div>'+


                    '<div class="col-sm-6 col-md-3">'+
                       ' <div class="form-group">'+
                            '<label class="form-control-label" for="service">Problem During Testing</label>'+
                           '<input type="text" name="problem_during_testing[]" class="form-control" id="service" value="" >'+
                       '</div>'+
                    '</div>'+

                    '<div class="col-sm-6 col-md-3">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label roanalysis" for="service">Root Cause Analysis</label>'+
                            '<input type="text" name="root_cause_analysis[]" class="form-control" id="service" value="" >'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-3">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label why" for="service">Why</label>'+
                           ' <input type="text" name="why[]" class="form-control" id="why" value="" >'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-3">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label compserial" for="serial">Solution</label>'+
                            '<input type="text" name="solution[]" class="form-control" id="service" value="" >'+
                        '</div>'+
                    '</div>'+

                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label" for="arnumber">Impact</label>'+
                            '<input type="text" name="impact[]" class="form-control" id="service" value="" >'+
                        '</div>'+
                    '</div>'+

                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label  typprblm" for="arnumber">Type of Problem</label>'+
                                '<input type="text" name="type_of_problem[]" class="form-control" id="service" value="" >'+
                        '</div>'+
                    '</div>'+

                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label areaproblem" for="arnumber">Area Of Problem</label>'+
                            
                            '<input type="text" name="area_of_problem[]" class="form-control" id="service" value="" >'+
                        '</div>'+
                    '</div>'+


                    '<div class="col-md-6">'+
                       ' <div class="form-group">'+
                            '<label class="form-control-label portionprb" for="arnumber">Portion of Problem</label>'+
                            
                           '<input type="text" name="portion_of_problem[]" class="form-control" id="service" value="" >'+
                           
                        '</div>'+
                    '</div>'+



                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label" for="arnumber">Further Action</label>'+
                            '<input type="text" name="further_action[]" class="form-control" id="service" value="" >'+
                        '</div>'+
                    '</div>'+
                
                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                        '<label for="question">Actual Start Date <span style="color:red">*</span></label>'+
                            '<input type="text" class="form-control actualdate1" id="actualdate1" placeholder="" name="actual_start_date[]" value=""  required>'+

                        '</div>'+
                    '</div>'+

                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                           ' <label for="question">Actual End Date <span style="color:red">*</span></label>'+
                            '<input type="text" class="form-control actualdate2" id="actualdate2" placeholder="" name="actual_end_date[]" value=""  required>'+

                        '</div>'+
                    '</div>'+

                    '<div class="col-auto remove">'+
                    '<a href="javascript:void(0);" class="btn btn-danger remove_button">Remove Block -</a>'+
                    '</div>'+


                '</div>');

                            x++; //text box increment
                        }
                        return false;

                        $(wrapper).on("click",".remove_button", function(e){ //user click on remove text
                            console.log(x);
                            if( x > 1 ) {
                                console.log(x);
                                $(this).parent('div').remove(); //remove text box
                                x--; //decrement textbox
                            }
                            return false;
                        })


                    });
                    //$('.select2').select2();
                    //Once remove button is clicked
                    $(wrapper).on('click', '.remove_button', function(e){
                        e.preventDefault();
                        $(this).parent().parent().remove(); //Remove field html
                        x--; //Decrement field counter
                    });


                });

                $('body').on('focus',".enginedate", function(){
                    $(this).datepicker({
                        format: "dd/mm/yyyy",
                        autoclose: true,
                        orientation: "down",
                        endDate: "today"

                        });
                });




                $('body').on('focus',".actualdate2", function(){
                    $(this).datepicker({
                        format: "dd/mm/yyyy",
                        autoclose: true,
                        orientation: "down",
                        endDate: "today"

                        });
                });


                 $('body').on('focus',".actualdate1", function(){
                    $(this).datepicker({
                        format: "dd/mm/yyyy",
                        autoclose: true,
                        orientation: "down",
                        endDate: "today"

                        });
                });



            </script>

@endsection




