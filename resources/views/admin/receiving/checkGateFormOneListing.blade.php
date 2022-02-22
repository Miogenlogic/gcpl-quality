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
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Service request statistics</h6>
                    <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="../branch-office/index.html"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Default</li>
                      </ol>
                    </nav> -->
                </div>
            </div>
            @php
              $appo=App\Helpers\UserHelper::totalservicecount();
               $serquotation=App\Helpers\UserHelper::totalquotationcount();
                $onservice=App\Helpers\UserHelper::ongoingservice();
            @endphp

            <!-- Card stats -->
            <div class="row">

                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/service-request-list')}}">Total service requests</a></h5>
                                    <span class="h2 font-weight-bold mb-0">{{$appo}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-default text-white rounded-circle shadow">
                                        <i class="ni ni-briefcase-24"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/support-quotation-list')}}">Total quotation given</a></h5>
                                    <span class="h2 font-weight-bold mb-0">{{$serquotation}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="ni ni-chart-pie-35"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 1.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/service-request-list')}}">Ongoing service requests</a></h5>
                                    <span class="h2 font-weight-bold mb-0">{{$onservice}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-settings-gear-65"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('body')
    @php
        //echo '<pre>';print_r($rejectmsg);exit;
        $question=App\Helpers\UserHelper::checkgatequestion();
    @endphp

    @php
        $i=0;
    @endphp
    <div class="col">
        
    </div>
    
    <hr>
    
    <h3 class="font-weight-500" style="padding-top: 20px">File Type</h3>
    <form method="post" action="{{url('admin/check-gate-form-one-edit-save')}}" enctype="multipart/form-data">
         <div class="row">
                    <div class="col-md-2">
                        <div class="very-own-radio">
                            <input type="radio" id="control_01" name="serviceType" value="MARC" {{$checkgateone->job_type=='MARC'?'checked':''}}>
                            <label class="marc" for="control_01">
                                <h2>MARC</h2>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="very-own-radio">
                            <input type="radio" id="control_02" name="serviceType" value="Revenue" {{$checkgateone->job_type=='Revenue'?'checked':''}}>
                            <label class="warrenty" for="control_02">
                                <h2>Revenue</h2>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="very-own-radio">
                            <input type="radio" id="control_03" name="serviceType" value="ID Warranty" {{$checkgateone->job_type=='ID-Warranty'?'checked':''}}>
                            <label class="revenue" for="control_03">
                                <h2>ID Warranty</h2>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="very-own-radio">
                            <input type="radio" id="control_04" name="serviceType" value="ID Float" {{$checkgateone->job_type=='ID-Float'?'checked':''}}>
                            <label class="float-none" for="control_04">
                                <h2>ID Float</h2>
                            </label>
                        </div>
                    </div>
            <div class="col-md-2">
                <div class="very-own-radio">
                    <input type="radio" id="control_05" name="serviceType" value="ID (Branch)" {{$checkgateone->job_type=='ID (Branch)'?'checked':''}}>
                    <label class="branch" for="control_05">
                        <h2>ID Branch</h2>
                    </label>
                </div>
            </div>
                </div>
		@foreach( $question as $comm)

            @php
                $check=array_search($comm->inspection_criteria,$checkgateonelist->question);
            @endphp

            <li class="list-group-item px-0">
                <div class="row align-items-center">
                    <div class="col-7"><h4 class="mb-0">{{$comm->inspection_criteria}}</h4></div>
                    <div class="col-2">
                        <input type="hidden" name="question[{{$i}}]" value="{{$comm->inspection_criteria}}">
                        <div class="custom-control custom-control-inline custom-radio">
                            <input name="answer[{{$i}}]" class="custom-control-input" id="yes{{$comm->id}}" type="radio" value="yes" {{$checkgateonelist->answer[$check]=='yes'?'checked':''}} >
                            <label class="custom-control-label" for="yes{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio">
                            <input name="answer[{{$i}}]" class="custom-control-input nochkgte1" id="no{{$comm->id}}" onclick="checkone({{$comm->id}})" type="radio" value="no" {{$checkgateonelist->answer[$check]=='no'?'checked':''}} >
                            <label class="custom-control-label" for="no{{$comm->id}}">No</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <input type="text" name="remark[{{$i}}]" class="form-control testchkgt1" id="chkoneemarks{{$comm->id}}" placeholder="Remarks" value="{{$checkgateonelist->remark[$check]}}">
                    </div>
                </div>
            </li>

            @php
                $i++;
                $images=[];
            @endphp
        @endforeach
        
              <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="question">Overall Remarks</label>
                            <input class="form-control" id="" placeholder="" name="cg1_overall_remarks" value="{{old('cg1_overall_remarks')?old('cg1_overall_remarks'):$checkgateone->cg1_overall_remarks}}" >

                        </div>
                    </div>
                </div>
        
           <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="question">Actual Start Date</label>

                        <input type="text" class="form-control" id="" placeholder="" name="checkgate1_actual_start_date" value="{{ date('d/m/Y', strtotime($checkgateone->checkgate1_actual_start_date))}}" readonly>

                    </div>
                </div>
				<div class="col-md-4">
                   <div class="form-group">
                       <label for="question">Actual End Date</label>
                      @if(!empty($checkgateone->checkgate1_actual_end_date))
                       <input type="text" class="form-control" id="actualdate2" placeholder="" name="checkgate1_actual_end_date" value="{{ date('d/m/Y', strtotime($checkgateone->checkgate1_actual_end_date))}}" required>
                       @else
                           <input type="text" class="form-control" id="actualdate2" placeholder="" name="checkgate1_actual_end_date" value="" required>
                       @endif

                   </div>
               </div>
                <div class="col-md-4">
                        <div class="form-group">
                            <label for="question">Assign To Department</label>
                            <select name="chkonedept" class="form-control select2">

                            @php
                                $deptid=App\Helpers\UserHelper::departmentname();
                            @endphp
                         <option value=''>--Select Department--</option>
                            @foreach($deptid as $desig)



                               <option value="{{$desig->id}}" {{old('chkonedept')==$desig->id?'Selected':$checkgateone->chkonedept == $desig->id?'Selected':''}}>{{$desig->name}}</option>

                            @endforeach
                            
                            
                            
                        </select>

                        </div>
                    </div>
               </div>
               
               <div class="row">
                        <div class="col-md-4">
                            <label for="question">E Way Bill Number </label>
                            <input type="text" class="form-control" id="" placeholder="" name="e_way_bill" value="{{old('e_way_bill')?old('e_way_bill'):$checkgateone->e_way_bill}}">

                        </div>
                        <div class="col-md-4">
                            <label for="question">Upload E Way Bill</label>
                            <input type="file" class="form-control" id="" placeholder="" name="e_way_image">
                                @if(!empty($checkgateone->e_way_image))
                                <a href="/gcpl-quality/public/assets/uploads/receivingUploads/{{$checkgateone->e_way_image}}">E Way Bill</a>
                                @endif
                        </div>
                    </div>
               
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="question">Image Upload</label>
                    <input type="file" class="form-control" id="" placeholder="" name="checkgate1_image[]" multiple>
                     
                    @if($checkgateone['checkgate1_image']!='')
                    
                        @php
                        $images = $checkgateone->checkgate1_image;
                        $space=str_replace('"', '', $images);
                       
                        
                        $chkimag = explode(',',$space);
                       
                        
                        @endphp
                        
                
        
                        
                         
                    @endif
                    <div class="mt-2 badge badge-primary" >Maximum 5 Images You Can Upload At A Time</div>

                </div>
            </div>
        </div>
        
            <div class="row">
                @if(!empty($chkimag))
                         @foreach($chkimag as $image)
                         <div class="col-md-3">
                       
                       <div>
                       <img src="{{URL::asset('public/assets/uploads/checkgate1Image').'/'.$image}}"  style="width:100%;height:100px;margin-top: 10px;">
                       
                       
                        <input type="checkbox" value="{{$image}}" name="img_rem[]" &nbsp;> Remove Image
                       </div>
            
                        
                       
                        </div>
                         @endforeach
                @endif         
             </div>
        
        
                  
                  

        <div class="row" style="margin-top:80px;">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="question">Transporter Copy</label>
                    <input type="file" class="form-control" id="" placeholder="" name="transporter_Copy" value="{{old('transporter_Copy')?old('transporter_Copy'):''}}">
                               @if(!empty($checkgateone->transporter_Copy))
                                <a href="/gcpl-quality/public/assets/uploads/receivingUploads/{{$checkgateone->transporter_Copy}}">Transporter Copy</a>
                                @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="question">Challan</label>
                    <input type="file" class="form-control" id="" placeholder="" name="challan" value="{{old('challan')?old('challan'):''}}">
                           @if(!empty($checkgateone->challan))
                                <a href="/gcpl-quality/public/assets/uploads/receivingUploads/{{$checkgateone->challan}}">Challan</a>
                                @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="question">Gate Pass</label>
                    <input type="file" class="form-control" id="" placeholder="" name="gate_Pass" value="{{old('gate_Pass')?old('gate_Pass'):''}}">
                   @if(!empty($checkgateone->gate_Pass))
                                <a href="/gcpl-quality/public/assets/uploads/receivingUploads/{{$checkgateone->gate_Pass}}">Gate Pass</a>
                    @endif
                </div>
            </div>
        </div>
            @if (request()->session()->get('user')['section_id'] == '3')
             @if($checkgateone->cg1_status != 'Approved')
               
                <input type="hidden" name="id" value="{{$checkgateone->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Submit</button>
                
              @endif
            @endif
    </form>

    @if (request()->session()->get('user')['section_id'] == '3')
        @if(request()->session()->get('user')['role_id'] == '2')
          @if($checkgateone->cg1_status != 'Approved')
            <div class="" style="padding-right: 70px">
                <form method="post" action="{{url('admin/head-approve-checkgate-one-save')}}" enctype="multipart/form-data">
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

                    <input type="hidden" name="service_id" value="{{$checkgateone->id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input class="btn btn-primary" type="submit" value="submit">

                </form>


            </div>
            @endif

        {{--@else--}}
            {{--<form method="post" action="{{url('admin/check-sheet-total-form-save')}}" enctype="multipart/form-data">--}}
                {{--<input type="hidden" name="service_id" value="{{$checkgateone->id}}">--}}
                {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}
                {{--<input class="btn btn-primary" type="submit" value="submit">--}}

            {{--</form>--}}
        {{--@endif--}}
            @endif
    @endif

    @if (request()->session()->get('user')['section_id'] == '3')
                @if(request()->session()->get('user')['role_id'] == '1')
                    <div class="col-14">
                        @if(!empty($rejectmsg))
                            @if($rejectmsg[0]['cg1_status']=='Rejected')
                                <label class="form-control-label" for="customer" style="padding-top: 20px">CheckSheet Rejected  at   {{$rejectmsg[0]['created_at']}}</label>
                                <textarea type="text" name="comment_for_approve" class="form-control " id="commentrgt" disabled>{{$rejectmsg[0]['cg1_comment']}}</textarea>
                            @endif
                        @endif    
                    </div>
                @endif
            @endif

@endsection

@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>
 <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript">



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
