@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Create new service request</h6>
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

    <!-- Project List -->
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{url('admin/service-request-add-save')}}" enctype="multipart/form-data">
                <div class="row">

                    <!--<div class="col-sm-6 col-md-3">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="form-control-label" for="service">Service Request Number</label>-->
                    <!--        <input type="text" name="service_request_no" class="form-control" id="service" value="" readonly>-->
                    <!--        @if($errors->has('service_request_no'))-->
                    <!--            <div class="invalid-feedback" style="display:block;">{{$errors->first('service_request_no')}}</div>-->
                    <!--        @endif-->
                    <!--    </div>-->
                    <!--</div>-->
					
					
					
					<div class="col-sm-6 col-md-11">
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">Description</label>
							<textarea name="description" class="form-control" id="service" value="">{{old("description")}}</textarea>
                     </div>
                    </div>
					
					
					
					 <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">Employee Responsibly</label>
                            <select name="empres" id="empres" class="form-control" required>
                                
                               <option value="">Select Employee</option>
							  
                                  @foreach( $employee as  $emp)
									<option value="{{$emp->id}}">
                                        {{$emp->name}}
										</option>
                                   @endforeach
                            </select>
                        </div>
                    </div>
					 <div class="col-sm-6 col-md-3" hidden>
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">Status</label>
                           <select name="cc_status" id="cc_status" class="form-control">
                                <option selected="selected">
                               
                                    @foreach( $status as  $stat)
									<option selected="" value="{{$stat->id}}">
                                        {{ $stat->status}}
										</option>
                                    @endforeach

                                </option>
                          </select>

                        </div>
                    </div>
					 <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">Impact/Urgency</label>
                            <input type="text" name="impact" class="form-control" id="service" value="{{old("impact")}}" >

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="customer">Customer Name <span style="color:red">*</span></label>
                            <input type="text"  class="form-control customer1" id="customer_val" value="" >
                            <select name="customer" id="customer" class="form-control customer" style="display: none;" >


                            </select>
							<!--<select name="customer" class="form-control" required>
                                <option value="">Select customer</option>
                                @php
                                    $customer=App\Helpers\UserHelper::customer();
                                @endphp

                                @foreach($customer as $cus)

                                    <option value="{{$cus->id}}">{{$cus->name}}</option>

                                @endforeach
                            </select>-->
                            @if($errors->has('customer'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('customer')}}</div>
                            @endif
                        </div>
                    </div>

                    <!--<div class="col-sm-6 col-md-3">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="form-control-label" for="job">Job number</label>-->
                    <!--        <input type="text" name="job_no" class="form-control" id="" placeholder="">-->
                            
                    <!--    </div>-->
                    <!--</div>-->

                    
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">AR number</label>
                            <input type="text" name="ar_no" class="form-control" id="" placeholder="AR number" value="{{old("ar_no")}}">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label  machmodel" for="model">Equipment Model<span style="color:red">*</span></label>
                            <input type="text"  class="form-control" id="machmodel_val" value="" >
                            <select name="machine_modelno" id="machmodel" class="form-control machmodel" style="display: none;" >


                            </select>
							<input type="text" name="machmodel_notmain" placeholder="Enter Equipment Model"  class="form-control" id="machmodel_val_rand" value="" style="display: none;" disabled>
							<!--<select name="machine_modelno" id="machmodel" class="form-control" required>
                                <option value="">Select model number</option>

                                @php
                                    $mchmodel=App\Helpers\UserHelper::machinemodelno();
                                @endphp

                                @foreach($mchmodel as $cmodel)

                                    <option value="{{$cmodel->id}}">{{$cmodel->model_no}}</option>

                                @endforeach


                            </select>-->
                           
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label machserial" for="model">Equipment Serial Number</label>
							<input type="text"  class="form-control" id="machserial_val" value="" >

                            <select name="machine_serialno" id="machserial" class="form-control machserial" style="display: none;">


                            </select>
							<input type="text" name="machserial_notmain" placeholder="Enter Equipment Serial"  class="form-control" id="machserial_val_rand" value="" style="display: none;" disabled>
							
                            <!--<select name="machine_serialno" id="machserial" class="form-control">


                            </select>-->

                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label compmodel" for="model">Component Model number</label>
                            <input type="text"  class="form-control" id="compmodel_val" value="" >

                            <select name="comp_model_no" id="compmodel" class="form-control compmodel" style="display: none;">


                            </select>
							<input type="text" name="compmodel_notmain" placeholder="Enter Component Model"  class="form-control" id="compmodel_val_rand" value="" style="display: none;" disabled>
							<!--<select name="comp_model_no" id="compmodel" class="form-control">


                            </select>-->

                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">Component Serial Number</label>
                            <input type="text"  class="form-control" id="compserial_val" value="" >


                            <select name="component_serial_no" id="compserial" class="form-control compserial" style="display: none;">

                            </select>
							<input type="text" name="compserial_notmain" placeholder="Enter Component Serial"  class="form-control" id="compserial_val_rand" value="" style="display: none;" disabled>
							<!--<select name="component_serial_no" id="compserial" class="form-control">

                            </select>-->

                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label compname" for="Component">Component name <span style="color:red">*</span></label>
                            <select name="component_name" id="compname" class="form-control" required>
                                <option value="">Select component</option>
                                @php
                                    $comptype=App\Helpers\UserHelper::componenttype();
                                @endphp

                                @foreach($comptype as $ctype)

                                    <option value="{{$ctype->type}}">{{$ctype->type}}</option>

                                @endforeach
                            </select>
                            @if($errors->has('component_name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('component_name')}}</div>
                            @endif
                        </div>
                    </div>

                   <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber"> Machine SMU <span style="color:red">*(Integer)</span></label>
                            <input type="text" name="machine_smu" class="form-control" id="" placeholder="smu" value="{{old("machine_smu")}}" required>
                            @if($errors->has('machine_smu'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('machine_smu')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">  Component SMU <span style="color:red">*(Integer)</span></label>
                            <input type="text" name="component_smu" class="form-control" id="" placeholder="smu" value="{{old("component_smu")}}" required>
                            @if($errors->has('component_smu'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('component_smu')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Branch Name <span style="color:red">*</span></label>
                            <select name="branch_name" class="form-control" required>
                                <option value="">Select Branch name</option>

                                @php
                                    $branchnme=App\Helpers\UserHelper::branchname();
                                @endphp

                                @foreach($branchnme as $bname)

                                    <option value="{{$bname->sales_ofc}}">{{$bname->sales_ofc}}</option>

                                @endforeach
                            </select>
                            @if($errors->has('branch_name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('branch_name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Segment</label>
                            <select name="segment" class="form-control" required>
                                <option value="">Select Segment</option>

                                @php
                                    $segment=App\Helpers\UserHelper::segment();
                                @endphp

                                @foreach($segment as $seg)

                                    <option value="{{$seg->name}}">{{$seg->name}}</option>

                                @endforeach


                            </select>
                            
                        </div>
                    </div>


                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="arnumber">Job Type</label>
                                <select name="job_type" class="form-control">
                                    <option selected="selected" disabled="disabled">--Select Job Type--</option>
    
                                    @php
                                        $checkjob=App\Helpers\UserHelper::checkgatejobtype();
                                    @endphp
    
                                    @foreach($checkjob as $type)
    
                                        <option value="{{$type->job_type}}">{{$type->job_type}}</option>
    
                                    @endforeach
    
    
                                </select>
                                
                            </div>
                        </div>
                    
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Branch Location</label>
                            <input type="text" name="branch_location" class="form-control" id="" placeholder="Branch Location" value="{{old("branch_location")}}">
                            @if($errors->has('branch_location'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('branch_location')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">Work order no</label>
                            <input type="text" name="work_orderno" class="form-control" id="service" value="{{old("work_orderno")}}" >

                        </div>
                    </div>
					<div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="servicedate" class="form-control-label">Service Request Date <span style="color:red">*</span></label>

                            <input class="form-control" name="date" type="text" value="{{old("date")}}" id="servicedate" required>
                        </div>
                         @if($errors->has('date'))
                             <div class="invalid-feedback" style="display:block;">{{$errors->first('date')}}</div>
                         @endif
                    </div>
                  <div class="col-sm-6 col-md-11">
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">Recomendation</label>
							<textarea name="recom" class="form-control" id="service" value="">{{old("recom")}}</textarea>
                         

                        </div>
                    </div>
                    

                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="form-control-label" for="arnumber">Upload pre-history</label>-->
                    <!--        <div class="custom-file">-->
                    <!--            <input type="file" name="import_file" class="custom-file-input" id="customFileLang" lang="en">-->
                    <!--            <label class="custom-file-label" for="customFileLang">Select file</label>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Upload pre-history <span style="color:red">*</span>  </label>
                            <div class="custom-file">
                                <input type="file" name="import_file" class="form-control" id="customFileLang" lang="en" required>
                                <!--<label class="" for="customFileLang">Select file</label>-->
                            </div>
                           @if($errors->has('import_file'))
                            <div class="invalid-feedback" style="display:block;">{{$errors->first('import_file')}}</div>
                         @endif
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Upload ET Report</label>
                            <div class="custom-file">
                                <input type="file" name="et_report" class="form-control" id="customFileLang" lang="en">
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Upload Pre-Invoice Check sheet</label>
                            <div class="custom-file">
                                <input type="file" name="pre_invoice_chksht" class="form-control" id="customFileLang" lang="en">
                                
                            </div>
                        </div>
                    </div>



                </div><!-- /row -->
                
              <!--  @if(request()->session()->get('user')['role_id'] == '2')-->
               
              <!--  <input type="hidden" name="_token" value="{{csrf_token()}}">-->
              <!--  <button class="btn btn-primary" type="submit" disabled>Submit</button>-->
              <!--  <button class="btn btn-warning" type="reset" disabled>Cancel</button>-->
              <!--@else-->
                
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Submit</button>
                <button class="btn btn-warning" type="reset">Cancel</button>
              <!--@endif-->
                
                

                <!--<button type="reset" class="btn btn-warning" onclick='location.href ="{{url('admin/service-request-list')}}"'>Cancel</button>-->
            </form>
            <div class="mt-2">Download Prehistory Sample Excel<a class="badge badge-primary" href="{{URL::asset('public/assets/download/sampleexcelnew.xlsx')}}">Sample excel File</a></div>
        </div>

    </div>
    <!-- Project List -->

@if(request()->session()->get('user')['role_id'] == '2')
            <div class="" style="padding-right: 70px">
                <form method="post" action="{{url('admin/head-approve-checkgate-one-save')}}" enctype="multipart/form-data">
                    <div class="custom-control custom-control-inline custom-radio">
                        <input name="status" class="custom-control-input approved" id="approved" type="radio" value="1">
                        <label class="custom-control-label" for="approved">Approve</label>
                        {{--<textarea style="padding-left: 10px" name="comment"  placeholder="comments"></textarea>--}}
                    </div>
                    <div class="text-right mb-1 col-md-12 commentapr"  style="display:none" >
                        <textarea type="text" name="comment" class="form-control" id="commentapr" value="" ></textarea>
                    </div>

                    <div class="custom-control custom-control-inline custom-radio">
                        <input name="status" class="custom-control-input rejected" id="rejected" type="radio" value="2">
                        <label class="custom-control-label" for="rejected">Reject   </label>
                        {{--<textarea  name="comment"  placeholder="comments"></textarea>--}}
                    </div>
                    <div class="text-right mb-1 col-md-12 commentrgt"  style="display:none">
                        <textarea type="text" name="comment" class="form-control " id="commentrgt1" value=""></textarea>
                    </div>

                   
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input class="btn btn-primary" type="submit" value="submit">
@endif

                </form>


            </div>


@endsection
@section('after_script')

    <!-- Optional JS -->
    {{--<script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>--}}
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>


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

    /* equipment model */
    $('#machmodel_val').keyup(function(event) {
        var machmodel = $(this).val();
        //alert(commodel);
       // console.log(customer);

        if(machmodel.length >= 2) {
            $.ajax({

                url: '{{ url("/admin/machinemodeldropdown-filter") }}',

                type: 'POST',

                data: {machmodel: machmodel, '_token': '{{csrf_token()}}'},

            })

                .done(function (response) {
                    //console.log(response);


                    $('.machmodel').show();

                    $('#machmodel').html(response);
                    $('#machmodel').attr('required',true);

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

    /* equipment serial */
    $('#machserial_val').keyup(function(event) {
        var machserial = $(this).val();
        //alert(commodel);
        // console.log(customer);

        if(machserial.length >= 2) {
            $.ajax({

                url: '{{ url("/admin/machineserialdropdown-filter") }}',

                type: 'POST',

                data: {machserial: machserial, '_token': '{{csrf_token()}}'},

            })

                .done(function (response) {
                    //console.log(response);


                    $('.machserial').show();

                    $('#machserial').html(response);
                    $('#machserial').attr('required',true);

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

    /* comp model */
    $('#compmodel_val').keyup(function(event) {
        var compmodel = $(this).val();
        //alert(commodel);
        // console.log(customer);

        if(compmodel.length >= 2) {
            $.ajax({

                url: '{{ url("/admin/compmodeldropdown-filter") }}',

                type: 'POST',

                data: {compmodel: compmodel, '_token': '{{csrf_token()}}'},

            })

                .done(function (response) {
                    //console.log(response);


                    $('.compmodel').show();

                    $('#compmodel').html(response);
                    $('#compmodel').attr('required',true);

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

    /* comp serial */
    $('#compserial_val').keyup(function(event) {
        var compserial = $(this).val();
        //alert(commodel);
        // console.log(customer);

        if(compserial.length >= 2) {
            $.ajax({

                url: '{{ url("/admin/compserialdropdown-filter") }}',

                type: 'POST',

                data: {compserial: compserial, '_token': '{{csrf_token()}}'},

            })

                .done(function (response) {
                    //console.log(response);


                    $('.compserial').show();

                    $('#compserial').html(response);
                    $('#compserial').attr('required',true);

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


  /* equ model rand*/
        $('#machmodel').change(function(event){

            var val1 = $(this).val();

            if(val1 == 0){
                $('.machmodel').hide();
                //$('#machserial').prop('disabled',true);

                $('#machmodel_val_rand').show();
                $('#machmodel_val_rand').prop('disabled',false);
                $('#machmodel_val_rand').prop('required',true);
            }else{
                $('.machmodel').show();
                //$('#machserial').prop('disabled',true);

                $('#machmodel_val_rand').hide();
                $('#machmodel_val_rand').val("");
                $('#machmodel_val_rand').prop('disabled',true);
                $('#machmodel_val_rand').prop('required',false);
            }
       });

    /* equ serial rand*/
    $('#machserial').change(function(event){

        var val1 = $(this).val();

        if(val1 == 0){
            $('.machserial').hide();
            //$('#machserial').prop('disabled',true);

            $('#machserial_val_rand').show();
            $('#machserial_val_rand').prop('disabled',false);
            $('#machserial_val_rand').prop('required',true);
        }else{
            $('.machserial').show();
            //$('#machserial').prop('disabled',true);

            $('#machserial_val_rand').hide();
            $('#machserial_val_rand').val("");
            $('#machserial_val_rand').prop('disabled',true);
            $('#machserial_val_rand').prop('required',false);
        }
    });

    /* comp model rand*/
    $('#compmodel').change(function(event){

        var val1 = $(this).val();

        if(val1 == 0){
            $('.compmodel').hide();
            //$('#machserial').prop('disabled',true);

            $('#compmodel_val_rand').show();
            $('#compmodel_val_rand').prop('disabled',false);
            $('#compmodel_val_rand').prop('required',true);
        }else{
            $('.compmodel').show();
            //$('#machserial').prop('disabled',true);

            $('#compmodel_val_rand').hide();
            $('#compmodel_val_rand').val("");
            $('#compmodel_val_rand').prop('disabled',true);
            $('#compmodel_val_rand').prop('required',false);
        }
    });

    /* comp serial rand*/
    $('#compserial').change(function(event){

        var val1 = $(this).val();

        if(val1 == 0){
            $('.compserial').hide();
            //$('#machserial').prop('disabled',true);

            $('#compserial_val_rand').show();
            $('#compserial_val_rand').prop('disabled',false);
            $('#compserial_val_rand').prop('required',true);
        }else{
            $('.compmodel').show();
            //$('#machserial').prop('disabled',true);

            $('#compserial_val_rand').hide();
            $('#compserial_val_rand').val("");
            $('#compserial_val_rand').prop('disabled',true);
            $('#compserial_val_rand').prop('required',false);
        }
    });

    </script>


    <script type="text/javascript">
	
	
	
        /*Model serial no*/
        $('#machmodel_off').change(function(event) {
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
        $('#machmodel_off').change(function(event) {
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
        $('#machmodel_off').change(function(event) {
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
<script>

            $('#servicedate').datepicker({


        format: "dd/mm/yyyy",
            autoclose: true,
        //startDate: new Date('2019-12-5'),
         endDate: "today",
         });



        </script>


@endsection