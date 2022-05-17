	 @extends('admin.include.layout')
<!-- Project List -->

@section('head')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">PDI CheckList</h6>
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
       // $checkjob=App\Helpers\UserHelper::checkgatejobtypetwo();
        $pdienginevisual=App\Helpers\UserHelper::pdichecksheet();
    @endphp



<div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">PDI CHECKSHEET TRANSMISSION</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">

            <!-- Pre-populated information -->
            <div class="row">
                <div class="col-md-6">
                    <div class="prepopulated-data">
                        <ul>
                            <li>WorkOrder No: <span>{{$pdichecksheet->work_orderno}}</span></li>
                            
                            <li>Branch name: <span>{{$pdichecksheet->branch_name}}</span></li>
                            <li>Component Serial number: <span>@if(!empty($serial)) {{$serial[0]['comp_serial_no']}} @endif</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="prepopulated-data">
                        <ul>
                            <li>AR number: <span>{{$pdichecksheet->ar_no}}</span></li>
                            <li>Model number: <span>@if(!empty($model)) {{$model[0]['model_no']}} @endif</span></li>
                            <li>Components name: <span>{{$pdichecksheet->component_name}}</span></li>
                            <li>Customer: <span>@if(!empty($customer)) {{$customer[0]['name']}} @endif</span></li>
                        </ul>
                    </div>
                </div>
            </div>

 <ul class="list-group list-group-flush list mb-3 hard-to-choose">
	


    <form method="post" action="{{url('admin/transmission-pdi-edit-save')}}" enctype="multipart/form-data">
        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3>Sectian A</h3>
                    <h3>General Check Points</h3>
                </div>

            </div>
        </li>
        @php
            $pdienginevisual=App\Helpers\UserHelper::pdichecksheettransmissionassy();

            $r=0;
        @endphp

        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->general_check_points))
                @php

                   $chk=array_search(trim($comm->general_check_points) ,$pdichecksheetlist->gencpdes);
                @endphp
			
                <li class="list-group-item px-0">
                    <div class="row align-items-center">

    						
                        <div class="col-7"><h4 class="mb-0">{{$comm->general_check_points}}</h4>

                                <input type="hidden" name="gencpdes[{{$r}}]"  value="{{$comm->general_check_points}}">
                        </div>

                        <div class="custom-control custom-control-inline custom-radio" >
    					
                            <input name="gencpanswer[{{$r}}]" class="custom-control-input" id="yes1{{$comm->id}}" type="radio" value="yes" {{$pdichecksheetlist->gencpanswer[$chk]=='yes'?'checked':''}}>
    					    <label class="custom-control-label" for="yes1{{$comm->id}}">Yes</label>
                        </div>

                        <div class="custom-control custom-control-inline custom-radio" >
                                <input name="gencpanswer[{{$r}}]" class="custom-control-input" id="no1{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->gencpanswer[$chk]=='no'?'checked':''}}>
                                <label class="custom-control-label" for="no1{{$comm->id}}" >No</label>
                        </div>
    					 
                        <div class="col-3" >
                            <input type="text" name="gencpremark[{{$r}}]" class="form-control" id="gencpremark{{$comm->id}}" placeholder="Remarks" value="{{ $pdichecksheetlist->gencpremark[$chk]}}">
                        </div>
                    </div>
    			
                </li>
                @php

                //echo '<pre>';print_r(engvisanswer);exit;
                    $r++;

                @endphp
             @endif
        @endforeach

        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-5">
                    <h3>Section B </h3>
                </div>
            </div>

        </li>
        


        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-4">
                    <h3>A. Painting & Dispatch </h3>
                </div>
            </div>
        </li>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->painting_dispatch))
                @php
                    $chk=array_search(trim($comm->painting_dispatch), $pdichecksheetlist->powdurdes);
                    

                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        

                        <div class="col-7"><h4 class="mb-0" >{{$comm->painting_dispatch}}</h4></div>

                        <input type="hidden" name="powdurdes[{{$i}}]"  value="{{$comm->painting_dispatch}}">


                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="powduranswer[{{$i}}]" class="custom-control-input" id="yes4{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->powduranswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes4{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="powduranswer[{{$i}}]" class="custom-control-input" id="no4{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->powduranswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no4{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="powdurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{$pdichecksheetlist->powdurremark[$chk]}}">
                        </div>
                    </div>



                </li>
            @endif
            @php
                $i++;
            @endphp
        @endforeach


        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-4">
                    <h3>B. Documentation</h3>
                </div>
            </div>
        </li>
        @php
            $i=0;
        @endphp

        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->documentation))

                @php
                    $chk=array_search(trim($comm->documentation), $pdichecksheetlist->powaftdes);



                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        

                        <div class="col-7"><h4 class="mb-0" >{{$comm->documentation}}</h4></div>

                        <input type="hidden" name="powaftdes[{{$i}}]"  value="{{$comm->documentation}}">

                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="powaftanswer[{{$i}}]" class="custom-control-input" id="yes5{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->powaftanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes5{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="powaftanswer[{{$i}}]" class="custom-control-input" id="no5{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->powaftanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no5{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="powaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->powaftremark[$chk]}}">
                        </div>
                    </div>



                </li>
            @endif
            @php
                $i++;
            @endphp
        @endforeach

        
        <div class="row">
        <div class="col-md-6">
                    <div class="form-group">
                        <label for="question">Actual Start Date{{$pdichecksheet-> pdi_engine_start_date}}</label>

                        <input type="text" class="form-control" id="" placeholder="" name="pdi_actual_start_date" value="{{date('d/m/Y', strtotime($pdichecksheet-> pdi_engine_start_date))}}" disabled>

                    </div>
          </div>
		  <div class="col-md-6">
            <div class="form-group">
                <label for="question">Actual End Date</label>

                <input type="text" class="form-control" id="actualdate2" placeholder="" name="pdi_actual_end_date" value="{{date('d/m/Y', strtotime($pdichecksheet->pdi_engine_end_date))}}" required>

            </div>
        </div>
		</div>

       
                <input type="hidden" name="id" value="{{$pdichecksheet->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit" id="finalsubmit">Submit</button>
                
          

    </form>
 
     @if (request()->session()->get('user')['section_id'] == '22')
         @if(request()->session()->get('user')['role_id'] == '2')
             @if($pdichecksheet->pdi_status != 'Approved')
                 <div class="" style="padding-right: 70px">
                     <form method="post" action="{{url('admin/head-approve-pdi-save')}}" enctype="multipart/form-data">
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

                         <input type="hidden" name="service_id" value="{{$pdichecksheet->id}}">
                         <input type="hidden" name="_token" value="{{csrf_token()}}">
                         <input class="btn btn-primary" type="submit" value="submit">

                     </form>


                 </div>
             @endif


         @endif
     @endif

     @if (request()->session()->get('user')['section_id'] == '22')
         @if(request()->session()->get('user')['role_id'] == '1')
             <div class="col-14">
                 @if(!empty($rejectmsg))
                     @if($rejectmsg[0]['pdi_status']=='Rejected')
                         <label class="form-control-label" for="customer" style="padding-top: 20px">PDI CheckSheet Rejected  at   {{$rejectmsg[0]['created_at']}}</label>
                         <textarea type="text" name="comment_for_approve" class="form-control " id="commentrgt" disabled>{{$rejectmsg[0]['pdi_comment']}}</textarea>
                     @endif
                 @endif
             </div>
         @endif
     @endif


</ul>

@endsection
@section('after_script')
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
					$('#actualdate2').datepicker({
                        format: "dd/mm/yyyy",
                        autoclose: true,
                        orientation: "down",
                        endDate: "today"

                    });

                </script>

@endsection





