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
    //print_r($checkgate);exit;
        $checkjob=App\Helpers\UserHelper::checkgatejobtype();
        $checkthreequestion=App\Helpers\UserHelper::checkgatequestionthree();
    @endphp

    <div class="card mb-4">
        {{--@if (request()->session()->get('user')['section_id'] == '4')--}}
            {{--@if(request()->session()->get('user')['role_id'] == '1')--}}
                {{--<div class="col">--}}
                    {{--@if($reject_message->status==2)--}}
                        {{--<label class="form-control-label" for="reject" style="padding-top: 20px ">Rejected CheckSheet</label>--}}
                        {{--<textarea type="text" name="comment_for_approve" class="form-control " id="commentrgt" disabled>{{$reject_message->comment}}</textarea>--}}
                    {{--@endif--}}
                {{--</div>--}}
        {{--@endif--}}
    {{--@endif--}}
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
                            <li>WorkOrder number: <span>{{$checkgate->work_orderno}}</span></li>
                            <li>Branch name: <span>{{$checkgate->branch_name}}</span></li>
                            <li>Component Serial number: <span>@if(!empty($serial[0]['comp_serial_no'])) {{$serial[0]['comp_serial_no']}} @endif</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="prepopulated-data">
                        <ul>
                            <li>AR number: <span>{{$checkgate->ar_no}}</span></li>
                            <li>Model number: <span>@if(!empty($model[0]['model_no'])) {{$model[0]['model_no']}} @endif</span></li>
                            <li>Components name: <span>{{$checkgate->component_name}}</span></li>
                            <li>Components receiving date: <span>{{$checkgate->date}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Pre-populated informations -->

            <hr>
            <h3 class="font-weight-500">Select file type</h3>
            <form method="post" action="{{url('admin/check-gate-form-three-add-save')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-2">
                        <div class="very-own-radio">
                            <input type="radio" id="control_01" name="serviceType" value="MARC" {{$checkgate->job_type=='MARC'?'checked':''}}>
                            <label class="marc" for="control_01">
                                <h2>MARC</h2>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="very-own-radio">
                            <input type="radio" id="control_02" name="serviceType" value="Revenue" {{$checkgate->job_type=='Revenue'?'checked':''}}>
                            <label class="warrenty" for="control_02">
                                <h2>Revenue</h2>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="very-own-radio">
                            <input type="radio" id="control_03" name="serviceType" value="ID Warranty" {{$checkgate->job_type=='ID Warranty'?'checked':''}}>
                            <label class="revenue" for="control_03">
                                <h2>ID Warranty</h2>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="very-own-radio">
                            <input type="radio" id="control_04" name="serviceType" value="ID Float" {{$checkgate->job_type=='ID Float'?'checked':''}}>
                            <label class="float-none" for="control_04">
                                <h2>ID Float</h2>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="very-own-radio">
                            <input type="radio" id="control_05" name="serviceType" value="ID (Branch)" {{$checkgate->job_type=='ID (Branch)'?'checked':''}}>
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
                    @foreach($checkthreequestion as $qes)
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
                                            <input name="answer[{{$i}}]" class="custom-control-input nochkgte3" id="no{{$qes->id}}" onclick="checkthree({{$qes->id}})" type="radio" value="no" >
                                            <label class="custom-control-label" for="no{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="remark[{{$i}}]" class="form-control testchkgt3" id="chkthreeemarks{{$qes->id}}" placeholder="Remarks">
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
                            <input class="form-control" id="" placeholder="" name="cg3_overall_remarks" value="">

                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="question">Actual Start Date <span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="actualdate2" placeholder="" name="checkgate3_actual_start_date" value="" required>

                        </div>
                    </div>
					<div class="col-md-4">
                        <div class="form-group">
                            <label for="question">Actual End Date <span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="actualdate3" placeholder="" name="checkgate3_actual_end_date" value="" required>

                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{$checkgate->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Submit</button>
                
           

            </form>
        </div>
    </div>

    

@endsection

@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

     <script type="text/javascript">
        $('#actualdate2').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            orientation: "down",
            endDate: "today"

        });
		$('#actualdate3').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            orientation: "down",
            endDate: "today"

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
