@extends('admin.include.layout')
<!-- Project List -->

@section('head')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Receiving statistics</h6>
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
                 $cg1=App\Helpers\UserHelper::totalcg1count();
                  $leftcg1=App\Helpers\UserHelper::leftcg1count();
                
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
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
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
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/servicedashboard-checkgateone')}}">Total checkgate filled</a></h5>
                                    <span class="h2 font-weight-bold mb-0">{{$cg1}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-delivery-fast"></i>
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
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/servicedashboard-checkgateone')}}">Awaiting to be filled</a></h5>
                                    <span class="h2 font-weight-bold mb-0">{{$leftcg1}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-bullet-list-67"></i>
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
        $checkjob=App\Helpers\UserHelper::checkgatejobtype();
        $question=App\Helpers\UserHelper::checkgatequestion();
        //echo '<pre>';print_r($customer);exit;
    @endphp

    <div class="card mb-4">
        <!-- Card header -->
        
        <div class="card-header">
            <h3 class="mb-0">Inspection After Receiving at CRC</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">

            <!-- Pre-populated information -->
            <div class="row">
                <div class="col-md-6">
                    <div class="prepopulated-data">
                        <ul>
                            <li>Customer: <span>@if(!empty($customer[0]['name'])) {{$customer[0]['name']}} @endif</span></li>
                            <li>WorkOrder number: <span>{{$checkgateone->work_orderno}}</span></li>
                            <li>Branch name: <span>{{$checkgateone->branch_name}}</span></li>
                            <li>Component Serial number: <span>@if(!empty($serial[0]['comp_serial_no'])) {{$serial[0]['comp_serial_no']}} @endif</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="prepopulated-data">
                        <ul>
                            <li>AR number: <span>{{$checkgateone->ar_no}}</span></li>
                            <li>Model number: <span>@if(!empty($model[0]['model_no'])) {{$model[0]['model_no']}} @endif</span></li>
                            <li>Components name: <span>{{$checkgateone->component_name}}</span></li>
                            <li>Components receiving date: <span>{{$checkgateone->date}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Pre-populated informations -->

            <hr>

            <h3 class="font-weight-500">File Type</h3>
            <form method="post" action="{{url('admin/check-gate-form-one-add-save')}}" enctype="multipart/form-data">
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
                            <input type="radio" id="control_03" name="serviceType" value="ID Warranty" {{$checkgateone->job_type=='ID Warranty'?'checked':''}}>
                            <label class="revenue" for="control_03">
                                <h2>ID Warranty</h2>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="very-own-radio">
                            <input type="radio" id="control_04" name="serviceType" value="ID Float" {{$checkgateone->job_type=='ID Float'?'checked':''}}>
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
                <!-- List group -->
                <ul class="list-group list-group-flush list mb-3 hard-to-choose">
                    @php
                        $i=0;
                    @endphp
                    @foreach($question as $qes)
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                    <div class="col-7"><h4 class="mb-0">{{$qes->inspection_criteria}}</h4></div>
                                    <div class="col-2">
                                        <input type="hidden" name="question[{{$i}}]" value="{{$qes->inspection_criteria}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="answer[{{$i}}]" class="custom-control-input" id="yes{{$qes->id}}" type="radio" value="yes" checked>
                                            <label class="custom-control-label" for="yes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="answer[{{$i}}]" class="custom-control-input nochkgte1" id="no{{$qes->id}}" onclick="checkone({{$qes->id}})" type="radio" value="no" >
                                            <label class="custom-control-label" for="no{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="remark[{{$i}}]" class="form-control testchkgt1" id="chkoneemarks{{$qes->id}}" placeholder="Remarks">
                                    </div>
                                </div>
                        </li>
                        @php
                            $i++;
                        @endphp
                    @endforeach

                </ul>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="question">Overall Remarks</label>
                            <input class="form-control" id="" placeholder="" name="cg1_overall_remarks" value="">

                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="question">Actual Start Date <span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="actualdate1" placeholder="" name="checkgate1_actual_start_date" value=""  required>

                        </div>
                    </div>
					<div class="col-md-4">
                        <div class="form-group">
                            <label for="question">Actual End Date <span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="actualdate2" placeholder="" name="checkgate1_actual_end_date" value=""  required>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="question">Assign To Department</label>
                            <select name="chkonedept" class="form-control" required>
                          <option value="">--Select Department--</option>
                            @php
                                $deptid=App\Helpers\UserHelper::departmentname();
                            @endphp

                            @foreach($deptid as $desig)



                                <option value="{{$desig->id}}">{{$desig->name}}</option>

                            @endforeach
                        </select>

                        </div>
                    </div>
                </div>
                
                <div class="row">
                        <div class="col-md-4">
                            <label for="question">E Way Bill Number </label>
                            <input type="text" class="form-control" id="" placeholder="" name="e_way_bill" value="">

                        </div>
                        <div class="col-md-4">
                            <label for="question">Upload E Way Bill</label>
                            <input type="file" class="form-control" id="" placeholder="" name="e_way_image" value="">

                        </div>
                    </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="question">Image Upload</label>
                            <input type="file" class="form-control" id="" placeholder="" name="checkgate1_image[]" multiple>
                            @if($checkgateone['checkgate1_image']!='')
                                <?php
                                $images = json_decode($checkgateone['checkgate1_image']);
                                // $images = explode(',',$checkgateone['checkgate1_image']);
                                // echo '<pre>';print_r($img);exit;
                                foreach($images as $image){
                                ?>
                                <img src="{{asset('public/assets/uploads/checkgate1Image').'/'.$image}}"  style="width:100px;height:100px;margin-top: 10px;">
                                <input type="checkbox" value="{{$image}}" name="img_rem[]"> Remove Image
                                <?php } ?>
                            @endif
                            <div class="mt-2 badge badge-primary" >Maximum 5 Images You Can Upload At A Time</div>
                        </div>
                    </div>
                </div>
                <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="question">Transporter Copy</label>
                    <input type="file" class="form-control" id="" placeholder="" name="transporter_Copy">

                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="question">Challan</label>
                    <input type="file" class="form-control" id="" placeholder="" name="challan">

                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="question">Gate Pass</label>
                    <input type="file" class="form-control" id="" placeholder="" name="gate_Pass">

                </div>
            </div>
        </div>
            <!--    @if(request()->session()->get('user')['role_id'] == '2')-->
            <!--    <input type="hidden" name="id" value="{{$checkgateone->id}}">-->
            <!--    <input type="hidden" name="_token" value="{{csrf_token()}}">-->
            <!--    <button class="btn btn-primary" type="submit" disabled>Submit</button>-->
            <!--    <button class="btn btn-warning" type="reset" disabled>Reset form</button>-->
            <!--@else-->
                <input type="hidden" name="id" value="{{$checkgateone->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Submit</button>
                
            <!--@endif-->
            </form>
        </div>

        {{--@if(isset($agrregate->id) && isset($prehist->id) && isset($allvalcommercialLog->id) && isset($allvalexterwash->id) && isset($allvalpartcln->id) && isset($allvalcylinderblock->id) && isset($allvalothercom->id) && isset($allvalconrod->id) && isset($allvalcranksft->id) && isset($allvalcamsft->id) && isset($allvalcylinderheadoil->id) && isset($showmissing[0]->id) && isset($showsalvage[0]->id) && isset($showloosepat[0]->id) && isset($showfailed[0]->id) && isset($allvalfandrive[0]->id) && isset($allvalwaterpump[0]->id) && isset($allvaloilpump[0]->id) && isset($allvalaircomp[0]->id) && isset($allvalconrodbush[0]->id) && ($agrregate->work_done ==0))--}}
            {{--<form method="post" action="{{url('admin/check-sheet-total-form-save')}}" enctype="multipart/form-data">--}}
                {{--<input type="hidden" name="service_id" value="{{$service->id}}">--}}
                {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}
                {{--<input class="btn btn-primary" type="submit" value="submit">--}}

            {{--</form>--}}
        {{--@else--}}
            {{--<input class="btn btn-primary" type="submit" value="submit" disabled>--}}

        {{--@endif--}}
    </div>


   


@endsection

@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>

     <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

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
    <script type="text/javascript">
    $('#actualdate1').datepicker({
    format: "dd/mm/yyyy",
    autoclose: true,
    orientation: "down",
    endDate: "today"

    });
	$('#actualdate2').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        orientation: "down",
        endDate: "today"

    });
    </script>

@endsection
