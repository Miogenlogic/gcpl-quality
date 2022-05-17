@extends('admin.include.layout')
@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0"> Edit service request</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">New service request</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body')

@php
//echo '<pre>';print_r($customer);exit;
@endphp

    <!-- Project List -->
    <div class="card mb-4">
        <!-- Card header -->
        @if(!empty($reject_msg))
            @if (request()->session()->get('user')['section_id'] == '1')
                @if(request()->session()->get('user')['role_id'] == '1')
                    <div class="col-14">
                        
                    @if($reject_msg[0]['service_request_status']=='Rejected')
                    <label class="form-control-label" for="customer" style="padding-top: 20px">Rejected Service Request</label>
                    <textarea type="text" name="comment_for_approve" class="form-control " id="commentrgt" disabled>{{$reject_msg[0]['service_request_comment']	}}</textarea>
                    @endif
                    </div>
                @endif
            @endif
        @endif    
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{ url('/admin/update-servicerequest')}}" enctype="multipart/form-data">
                <div class="row">

                    <!--<div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Service Request Number</label>
                            <input type="text" name="service_request_no" class="form-control" id="service" value="{{old('service_request_no')?old('service_request_no'):$servicerequest->service_request_no}}" readonly>
                            @if($errors->has('service_request_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('service_request_no')}}</div>
                            @endif
                        </div>
                    </div>-->
					<div class="col-sm-6 col-md-11">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Service Description</label>
                           <input type="text" name="description" class="form-control" id="service" value="{{old('description')?old('description'):$servicerequest->description}}">
							
                            @if($errors->has('description'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('description')}}</div>
                            @endif
							
                        </div>
                    </div>
					<div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Employee Responsible</label>
                            <select name="empres" id="empres" class="form-control">
							@foreach( $employee as  $emp)
                                <!--<option selected="selected" value="{{old('empres')?old('empres'):$servicerequest->empres}}">{{$emp->name}}</option>-->
                                <option value="{{$emp->name}}" {{old('empres')==$emp->id?'Selected':$servicerequest->empres == $emp->id?'Selected':''}}>{{$emp->name}}</option>
										

                                    
                        
                            @endforeach
                          </select>
                                
                        </div>
                    </div>
					<!--<div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Status</label>
                            <select name="cc_status" id="cc_status" class="form-control">
							@foreach(  $status as  $stat)
                                <option selected="selected" value="{{old('cc_status')?old('cc_status'):$servicerequest->cc_status}}">

                                    
                                    {{$stat->status}}
										</option>
                                    @endforeach
                          </select>
                                
                        </div>
                    </div>-->
					<div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Impact/Urgency</label>
                            <input type="text" name="impact" class="form-control" id="service" value="{{old('impact')?old('impact'):$servicerequest->impact}}" >
                            @if($errors->has('impact'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('impact')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Customer Name <span style="color:red">*</span></label>
							 @php

                                    $custom=App\Helpers\UserHelper::customer();
                                    //echo '<pre>';print_r($customer);exit;
                                @endphp
                           <select name="customer" class="form-control">
                                     
                               @foreach($custom as $cust)
                                 @php
                                    $select ='';
                                    if($cust->id == $customer[0]['id']){
                                        $select = 'selected';
                                    }
                                @endphp
                               
                                    <option value="{{$cust->id}}" {{$select}} >{{$cust->name}}</option>
                                @endforeach
                                <!-- <option value="{{$customer[0]['id']}}" readonly >{{$customer[0]['name']}}</option> -->
                            </select>
                             @if($errors->has('customer'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('customer')}}</div>
                            @endif
                           </div>
                    </div>


                    

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Ar Number</label>
                            <input type="text" name="ar_no" class="form-control" id="service" value="{{old('ar_no')?old('ar_no'):$servicerequest->ar_no}}" >
                            @if($errors->has('ar_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('ar_no')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label  machmodel" for="model">Equipment Model</label>
							 
                           <!--  <select name="machine_modelno" id="machmodel" class="form-control">

                                @php
                                    $mchmodel=App\Helpers\UserHelper::machinemodelno();
									
                                @endphp

                              @foreach($mchmodel as $cmodel)
                                 @php
                                    $select ='';
                                    if($cmodel->id == $machinemodel[0]['id']){
                                        $select = 'selected';
                                    }
                                @endphp
                               
                                    <option value="{{$cmodel->id}}" {{$select}}>{{$cmodel->model_no}}</option>
									 
                                @endforeach
							<option value="{{$machinemodel[0]['id']}}" readonly>{{$machinemodel[0]['model_no']}}</option>
                            </select> -->

                            <input type="text"  class="form-control" id="machmodel_val" value="{{$machinemodel[0]['model_no']}}" >
                            <select name="machine_modelno" id="machmodel" class="form-control machmodel" >

                            <option value="{{$machinemodel[0]['id']}}" {{$select}}>{{$machinemodel[0]['model_no']}}</option>


                            </select>
                            <input type="text" name="machmodel_notmain" placeholder="Enter Equipment Model"  class="form-control" id="machmodel_val_rand" value="" style="display: none;" disabled>


                            @if($errors->has('model_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('model_no')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label macserial" for="machine_serialno">Equipment Serial Number</label>

                            <input type="text"  class="form-control" id="machserial_val" value="{{$machserial[0]['serial_no']}}" >

                            <select name="machine_serialno" id="machserial" class="form-control machserial">
                             
                             <option value="{{$machserial[0]['id']}}" {{$select}}>{{$machserial[0]['serial_no']}}</option>

                            </select>
                            <input type="text" name="machserial_notmain" placeholder="Enter Equipment Serial"  class="form-control" id="machserial_val_rand" value="" style="display: none;" disabled>


                            <!-- <select name="machine_serialno" id="macserial" class="form-control">
                             
                                
							

                                @php
                                    $mchserial=App\Helpers\UserHelper::mastermachineserialno();
                                @endphp

                                 
								//new
								
								@foreach($mchserial as $macserial)
                                 @php
                                    $select ='';
                                    if($macserial->id == $machserial[0]['id']){
                                        $select = 'selected';
                                    }
                                @endphp
                               
                                    <option value="{{$macserial->id}}" {{$select}}>{{$macserial->serial_no}}</option>
									 
                                @endforeach
								<option value="{{$machserial[0]['id']}}" readonly >{{$machserial[0]['serial_no']}}</option>

                            </select> -->
							
                            @if($errors->has('serial_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('serial_no')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label  commodel" for="model">Component Model</label>
                            <input type="text"  class="form-control" id="compmodel_val" value="{{$compmodelno[0]['comp_model_no']}}" >

                            <select name="comp_model_no" id="compmodel" class="form-control compmodel">

                            <option value="{{$compmodelno[0]['id']}}" readonly >{{$compmodelno[0]['comp_model_no']}}</option>

                            </select>
                            <input type="text" name="compmodel_notmain" placeholder="Enter Component Model"  class="form-control" id="compmodel_val_rand" value="" style="display: none;" disabled>

                            <!-- <select name="comp_model_no" id="commodel" class="form-control">
                                
                                @php
                                     $compmodel=App\Helpers\UserHelper::componentmodelno();
                                @endphp

                              @foreach($compmodel as $comodel)
                                 @php
                                    $select ='';
                                    if($comodel->id == $compmodelno[0]['id']){
                                        $select = 'selected';
                                    }
                                @endphp
                                @if($comodel->comp_model_no !='')
                                    <option value="{{$comodel->id}}" {{$select}}>{{$comodel->comp_model_no}}</option>
                                @endif    
									 
                                @endforeach
								<option value="{{$compmodelno[0]['id']}}" readonly >{{$compmodelno[0]['comp_model_no']}}</option>
                            </select> -->


                            @if($errors->has('model_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('model_no')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label  coserial" for="model">Component Serial number</label>

                            <input type="text"  class="form-control" id="compserial_val" value="{{$compserialno[0]['comp_serial_no']}}" >


                            <select name="component_serial_no" id="compserial" class="form-control compserial">

                                <option value="{{$compserialno[0]['id']}}" readonly >{{$compserialno[0]['comp_serial_no']}}</option>

                            </select>
                            <input type="text" name="compserial_notmain" placeholder="Enter Component Serial"  class="form-control" id="compserial_val_rand" value="" style="display: none;" disabled>

                            <!-- <select name="component_serial_no" id="coserial" class="form-control">
                                
                                @php
                                   $compserial =App\Helpers\UserHelper::componentserialno();
                                @endphp

                                @foreach($compserial as $comserial)
                                 @php
                                    $select ='';
                                    if($comserial->id == $compserialno[0]['id']){
                                        $select = 'selected';
                                    }
                                @endphp
                                
                                @if($comserial->comp_serial_no !='')
                                    <option value="{{$comserial->id}}" {{$select}}>{{$comserial->comp_serial_no}}</option>
								@endif	 
                                @endforeach
								<option value="{{$compserialno[0]['id']}}" readonly >{{$compserialno[0]['comp_serial_no']}}</option>
                            </select> -->




                            @if($errors->has('serial_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('serial_no')}}</div>
                            @endif
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Component Name <span style="color:red">*</span></label>
                            <select name="component_name" id="compname" class="form-control"  >
                                <option selected="selected" id="service" >
                                    {{old('component_name')?old('component_name'):$servicerequest->component_name}}
                                    </option>
                            @if($errors->has('component_name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('component_name')}}</div>
                            @endif
                            @php
                                $comptype=App\Helpers\UserHelper::componenttype();
                            @endphp

                            @foreach($comptype as $ctype)

                                <option value="{{$ctype->type}}">{{$ctype->type}}</option>

                            @endforeach
                            </select>
                        </div>
                    </div>


                     <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Machine SMU <span style="color:red">*</span></label>
                            <input type="text" name="machine_smu" class="form-control" id="service" value="{{old('machine_smu')?old('machine_smu'):$servicerequest->machine_smu}}" >
                            @if($errors->has('branch_location'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('branch_location')}}</div>
                            @endif
                        </div>
                    </div>
                     
                     <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Component SMU <span style="color:red">*</span></label>
                            <input type="text" name="component_smu" class="form-control" id="service" value="{{old('component_smu')?old('component_smu'):$servicerequest->component_smu}}" >
                            @if($errors->has('branch_location'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('branch_location')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Branch Name <span style="color:red">*</span></label>
                            <select name="branch_name" id="branch_name" class="form-control"  >
                                <option>
                             {{old('branch_name')?old('branch_name'):$servicerequest->branch_name}}
                                    </option>
                                @if($errors->has('branch_name'))
                                    <div class="invalid-feedback" style="display:block;">{{$errors->first('branch_name')}}</div>
                                @endif

                                @php
                                    $branch=App\Helpers\UserHelper:: branchname();
                                @endphp


                                @foreach($branch as $bran)

                                    <option value="{{$bran->sales_ofc}}">{{$bran->sales_ofc}}</option>

                                @endforeach
                                </select>

                        </div>
                    </div>



                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Segment</label>
                            <select name="segment" id="segment" class="form-control"  >
                                <option selected="selected" id="service" >
                             {{old('segment')?old('segment'):$servicerequest->segment}}
                                 </option>
                            @if($errors->has('segment'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('segment')}}</div>
                            @endif

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
                            <label class="form-control-label" for="service">Job Type</label>
                            <select name="job_type" id="job_type" class="form-control"  >
                                <option selected="selected" id="service" >
                             {{old('job_type')?old('job_type'):$servicerequest->job_type}}
                                 </option>
                           

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
                            <label class="form-control-label" for="service">Branch location</label>
                            <input type="text" name="branch_location" class="form-control" id="service" value="{{old('branch_location')?old('branch_location'):$servicerequest->branch_location}}" >
                            @if($errors->has('branch_location'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('branch_location')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">Work order no</label>
                            <input type="text" name="work_orderno" class="form-control" id="service" value="{{old('work_orderno')?old('work_orderno'):$servicerequest->work_orderno}}" >

                        </div>
                    </div>
					 <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Service Request Date <span style="color:red">*</span></label>
                            <input type="text" name="date" class="form-control" id="service" value="{{date('d/m/Y',strtotime($servicerequest->date))}}" readonly>
                            @if($errors->has('date'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('date')}}</div>
                            @endif
                        </div>
                    </div>
              <div class="col-sm-6 col-md-11">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Recomendation</label>
                            <input type="text" name="recom" class="form-control" id="recom" value="{{old('recom')?old('recom'):$servicerequest->recom}}">
                            @if($errors->has('recom'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('recom')}}</div>
                            @endif
							
                        </div>
                    </div>

                   

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Upload pre-history</label>
                            <div class="custom-file">
                                <input type="file" name="import_file" class="form-control" id="customFileLang" lang="en" value="{{old('pre_history')?old('pre_history'):$servicerequest->pre_history}}">
                                
                                @if(!empty($servicerequest->pre_history))
                                <a href="/gcpl-quality/public/assets/uploads/serviceprehistory/{{$servicerequest->pre_history}}">Pre History</a>
                                @endif
                               
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Upload ET Report</label>
                            <div class="custom-file">
                                <input type="file" name="et_report" class="form-control" id="customFileLang" lang="en" value="{{old('et_report')?old('et_report'):$servicerequest->et_report}}">
                                 @if(!empty($servicerequest->et_report))
                                <a href="/gcpl-quality/public/assets/uploads/serviveETReport/{{$servicerequest->et_report}}">ET Report</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Upload Pre-Invoice Check sheet</label>
                            <div class="custom-file">
                                <input type="file" name="pre_invoice_chksht" class="form-control" id="customFileLang" lang="en" value="{{old('pre_invoice_chksht')?old('pre_invoice_chksht'):$servicerequest->pre_invoice_chksht}}">
                                 @if(!empty($servicerequest->pre_invoice_chksht))
                                <a href="/gcpl-quality/public/assets/uploads/servicePreInvoiceChecksheet/{{$servicerequest->pre_invoice_chksht}}">Pre Invoice</a>
                                @endif
                            </div>
                        </div>
                    </div>


                    <!--<div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Upload PO</label>
                            <div class="custom-file">
                                <input type="file" name="po_upload" class="custom-file-input" id="customFileLang" lang="en">
                                <label class="custom-file-label" for="customFileLang">Select file</label>
                            </div>
                            <h6>upload pdf file</h6>
                        </div>
                    </div>-->

            </div><!-- /row -->
                
				@if($servicerequest->receiving_status == 'Rejected' || empty($servicerequest->receiving_status))
                <input type="hidden" name="id" value="{{$servicerequest->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" onclick="return confirm('Are you sure that all the details you have submitted in the form is correct?')" type="submit">Submit</button>
				@endif
				
                <button type="reset" class="btn btn-warning" onclick='location.href ="{{url('admin/service-request-list')}}"'>Cancel</button>
             </form>
            <div class="mt-2">Download Prehistory Sample Excel<a class="badge badge-primary" href="{{URL::asset('public/assets/download/sampleexcelnew.xlsx')}}">Sample excel File</a></div>
        </div>
    </div>

    @if (request()->session()->get('user')['section_id'] == '3')
        @if(request()->session()->get('user')['role_id'] == '2')
            <div class="" style="padding-right: 70px">
                <form method="post" action="{{url('admin/head-approve-service-request-save')}}" enctype="multipart/form-data">
                    <div class="custom-control custom-control-inline custom-radio">
                        <input name="status" class="custom-control-input approved" id="approved" type="radio" value="Approved">
                        <label class="custom-control-label" for="approved">Approve</label>
                        {{--<textarea style="padding-left: 10px" name="comment"  placeholder="comments"></textarea>--}}
                    </div>
                    <!--<div class="text-right mb-1 col-md-12 commentapr"  style="display:none" >
                        <textarea type="text" name="comment" class="form-control" id="commentapr" value="" ></textarea>
                    </div>-->

                    <div class="custom-control custom-control-inline custom-radio">
                        <input name="status" class="custom-control-input rejected" id="rejected" type="radio" value="Rejected">
                        <label class="custom-control-label" for="rejected">Reject   </label>
                        {{--<textarea  name="comment"  placeholder="comments"></textarea>--}}
                    </div>
                    <!--<div class="text-right mb-1 col-md-12 commentrgt"  style="display:none">
                        <textarea type="text" name="comment" class="form-control " id="commentrgt1" value=""></textarea>
                    </div>-->

                    <input type="hidden" name="service_id" value="{{$servicerequest->id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input class="btn btn-primary" type="submit" value="submit">
                </form>
            </div>
        @endif
    @endif

@endsection
@section('after_script')

    <!-- Optional JS -->
    {{--<script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>--}}
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

   <!--  <script type="text/javascript">
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
    </script> -->

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

    </script>

@endsection

