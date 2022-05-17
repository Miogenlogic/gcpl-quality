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
            <h3 class="mb-0">PDI CHECKSHEET</h3>
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
	


    <form method="post" action="{{url('admin/pdi-edit-save')}}" enctype="multipart/form-data">
        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-4">
                    <h3>Engine</h3>
                    <h3>VISUAL INSPECTION</h3>
                </div>

            </div>
        </li>
        @php
            $pdienginevisual=App\Helpers\UserHelper::pdichecksheet();

        @endphp

        @php
		     $r=0;
			 //print_r($pdienginevisual);
			 //exit();
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->engine_visual_description))
                @php

                   $chk=array_search($comm->engine_visual_area ,$pdichecksheetlist->engvisarea);
                @endphp
			
                <li class="list-group-item px-0">
                <div class="row align-items-center">
                    <div class="col-2"><h4 class="mb-0" >{{$comm->engine_visual_area}}</h4>

                   
                        <input type="hidden" name="engvisarea[{{$r}}]"  value="{{$comm->engine_visual_area}}">
						
						</div>
						
                        <div class="col-5"><h4 class="mb-0">{{$comm->engine_visual_description}}</h4>

                            <input type="hidden" name="engvisdes[{{$r}}]"  value="{{$comm->engine_visual_description}}">
                        </div>
                    <div class="custom-control custom-control-inline custom-radio" >
					
                        <input name="engvisanswer[{{$r}}]" class="custom-control-input" id="yes1{{$comm->id}}" type="radio" value="yes" {{$pdichecksheetlist->engvisanswer[$chk]=='yes'?'checked':''}}>
					    <label class="custom-control-label" for="yes1{{$comm->id}}">Yes</label>
                    </div>

                     <div class="custom-control custom-control-inline custom-radio" >
                            <input name="engvisanswer[{{$r}}]" class="custom-control-input" id="no1{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->engvisanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no1{{$comm->id}}" >No</label>
                     </div>
					 
                    <div class="col-3" >
                        <input type="text" name="engvisremark[{{$r}}]" class="form-control" id="engvisremark{{$comm->id}}" placeholder="Remarks" value="{{ $pdichecksheetlist->engvisremark[$chk]}}">
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
                <div class="col-4">
                    <h3>FLUID LEVELS</h3>

                </div>
            </div>
        </li>
        @php
            $f=0;
        @endphp


        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->engine_fluid_description))
                @php

                    //print_r($comm->engine_fluid_area);

                        $chk=array_search($comm->engine_fluid_area	, $pdichecksheetlist->engfluarea);

                @endphp

                 <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <h4 class="mb-0">{{$comm->engine_fluid_area}}</h4>
                        </div>
                        <div class="col-5"><h4 class="mb-0">{{$comm->engine_fluid_description}}</h4></div>

                        <div class="col-2">
                            <input type="hidden" name="engfluarea[{{$f}}]" value="{{$comm->engine_fluid_area}}">
                            <input type="hidden" name="engfludes[{{$f}}]" value="{{$comm->engine_fluid_description}}">
                            <div class="custom-control custom-control-inline custom-radio">
                                <input name="engfluanswer[{{$f}}]" class="custom-control-input" id="engfluyes{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->engfluanswer[$f]=='yes'?'checked':''}}>
                                <label class="custom-control-label" for="engfluyes{{$comm->id}}">Yes</label>
                            </div>
                            <div class="custom-control custom-control-inline custom-radio">
                                <input name="engfluanswer[{{$f}}]" class="custom-control-input" id="engfluno{{$comm->id}}" type="radio" value="no" {{ $pdichecksheetlist->engfluanswer[$f]=='no'?'checked':''}}>
                                <label class="custom-control-label" for="engfluno{{$comm->id}}">No</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="text" name="engfluremark[{{$f}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->engfluremark[$f]}}">
                        </div>
                    </div>
                </li>



                @php

                    $f++;
                @endphp
           @endif
        @endforeach


        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-4">
                    <h3>DURING OPERATION</h3>
                </div>
            </div>
        </li>

        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->engine_during_description))
                @php

                    $chk=array_search($comm->engine_during_area	, $pdichecksheetlist->engdurarea);

                @endphp

                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <h4 class="mb-0">{{$comm->engine_during_area}}</h4>
                        </div>
                        <div class="col-5"><h4 class="mb-0">{{$comm->engine_during_description}}</h4></div>

                        <div class="col-2">
                            <input type="hidden" name="engdurarea[{{$i}}]" value="{{$comm->engine_during_area}}">
                            <input type="hidden" name="engdurdes[{{$i}}]" value="{{$comm->engine_during_description}}">
                            <div class="custom-control custom-control-inline custom-radio">
                                <input name="engduranswer[{{$i}}]" class="custom-control-input" id="engduryes{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->engduranswer[$i]=='yes'?'checked':''}}>
                                <label class="custom-control-label" for="engduryes{{$comm->id}}">Yes</label>
                            </div>
                            <div class="custom-control custom-control-inline custom-radio">
                                <input name="engduranswer[{{$i}}]" class="custom-control-input" id="engdurno{{$comm->id}}" type="radio" value="no" {{ $pdichecksheetlist->engduranswer[$i]=='no'?'checked':''}}>
                                <label class="custom-control-label" for="engdurno{{$comm->id}}">No</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="text" name="engdurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->engdurremark[$i]}}">
                        </div>
                    </div>
                </li>



                @php

                    $i++;
                @endphp
            @endif

        @endforeach

        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-4">
                    <h3>AFTER OPERATION</h3>
                </div>

            </div>
        </li>
        @php
            $i=0;
        @endphp

        @foreach($pdienginevisual as $comm)
            @if(!empty($comm->engine_after_description))
                @php
                    $chk=array_search($comm->engine_after_area, $pdichecksheetlist->engaftarea);
                 @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <h4 class="mb-0">{{$comm->engine_after_area}}</h4>
                        </div>
                        <div class="col-5"><h4 class="mb-0">{{$comm->engine_after_description}}</h4></div>

                        <div class="col-2">
                            <input type="hidden" name="engaftarea[{{$i}}]" value="{{$comm->engine_after_area}}">
                            <input type="hidden" name="engaftdes[{{$i}}]" value="{{$comm->engine_after_description}}">
                            <div class="custom-control custom-control-inline custom-radio">
                                <input name="engaftanswer[{{$i}}]" class="custom-control-input" id="engaftyes{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->engaftanswer[$i]=='yes'?'checked':''}}>
                                <label class="custom-control-label" for="engaftyes{{$comm->id}}">Yes</label>
                            </div>
                            <div class="custom-control custom-control-inline custom-radio">
                                <input name="engaftanswer[{{$i}}]" class="custom-control-input" id="engaftno{{$comm->id}}" type="radio" value="no" {{ $pdichecksheetlist->engaftanswer[$i]=='no'?'checked':''}}>
                                <label class="custom-control-label" for="engaftno{{$comm->id}}">No</label>
                            </div>
                        </div>

                        <div class="col-3">
                            <input type="text" name="engaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->engaftremark[$i]}}">
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
                    <h3>POWER TRAIN</h3>
                    <h3>VISUAL INSPECTION</h3>

                </div>
        @php
            $i=0;
        @endphp


        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->powertrain_visual_description))

                @php

                    $chk=array_search($comm->powertrain_visual_area	, $pdichecksheetlist->powvisarea);

                @endphp

                <li class="list-group-item px-0">
                    <div class="row align-items-center">


                        <div class="col-2"><h4 class="mb-0" >{{$comm->powertrain_visual_area}}</h4></div>


                        <input type="hidden" name="powvisarea[{{$i}}]"  value="{{$comm->engine_visual_area}}">
                        <div class="col-5"><h4 class="mb-0">{{$comm->powertrain_visual_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->powertrain_visual_description}}">

                        <div class="col-2">
                            <div class="custom-control custom-control-inline custom-radio" >
                                <input name="powvisanswer[{{$i}}]" class="custom-control-input" id="yes2{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->powvisanswer[$i]=='yes'?'checked':''}}>
                                <label class="custom-control-label" for="yes2{{$comm->id}}">Yes</label>
                            </div>
                            <div class="custom-control custom-control-inline custom-radio" >
                                <input name="powvisanswer[{{$i}}]" class="custom-control-input" id="no2{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->powvisanswer[$i]=='no'?'checked':''}}>
                                <label class="custom-control-label" for="no2{{$comm->id}}">No</label>
                            </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="powvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->powvisremark[$i]}}">
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
                    <h3>FLUID LEVELS</h3>
                </div>

        @php
            $g=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->powertrain_fluid_description))
                @php
                    //  $powfluarea = (array) $pdichecksheetlist->powfluarea;
                      //  $chk=array_search($comm->powertrain_fluid_area, $powfluarea);
                   $chk=array_search($comm->powertrain_fluid_area	, $pdichecksheetlist->powfluarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->powertrain_fluid_area}}</h4></div>

                        <input type="hidden" name="powfluarea[{{$g}}]"  value="{{$comm->powertrain_fluid_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->powertrain_fluid_description}}</h4></div>
                        <input type="hidden" name="powdurdis[{{$g}}]"  value="{{$comm->powertrain_fluid_description}}">

                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="powfluanswer[{{$g}}]" class="custom-control-input" id="yes3{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->powvisanswer[$g]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes3{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="powfluanswer[{{$g}}]" class="custom-control-input" id="no3{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->powvisanswer[$g]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no3{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="powfluremark[{{$g}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->powfluremark[$g]}}">
                        </div>
                    </div>

                </li>
            @endif
            @php
                $g++;
            @endphp
        @endforeach


        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-4">
                    <h3>DURING OPERATION</h3>
                </div>
            </div>
        </li>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->powertrain_during_description))
                @php
                    $chk=array_search($comm->powertrain_during_area	, $pdichecksheetlist->powdurarea);
                      // $powdurarea = (array) $pdichecksheetlist->powdurarea;
                       //$chk=array_search($comm->powertrain_during_area, $powdurarea);

                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->powertrain_during_area}}</h4></div>

                        <input type="hidden" name="powdurarea[{{$i}}]"  value="{{$comm->powertrain_during_area}}">

                        <div class="col-5"><h4 class="mb-0" >{{$comm->powertrain_during_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->powertrain_during_description}}">


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
                    <h3>AFTER OPERATION</h3>
                </div>
            </div>
        </li>
        @php
            $i=0;
        @endphp

        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->powertrain_after_description))

                @php
                    // $powaftarea = (array) $pdichecksheetlist->powaftarea;
                     $chk=array_search($comm->powertrain_after_area, $pdichecksheetlist->powaftarea);



                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->powertrain_after_area}}</h4></div>

                        <input type="hidden" name="powaftarea[{{$i}}]"  value="{{$comm->powertrain_after_area}}">

                        <div class="col-5"><h4 class="mb-0" >{{$comm->powertrain_after_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->powertrain_after_description}}">

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

        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-4">
                    <h3>STEERING </h3>
                    <h3>VISUAL INSPECTION</h3>
                </div>
            </div>

        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->steering_visual_description))
                @php

                    // $stevisarea = (array) $pdichecksheetlist->stevisarea;
                      $chk=array_search($comm->steering_visual_area, $pdichecksheetlist->stevisarea);


                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->steering_visual_area}}</h4></div>
                        <input type="hidden" name="stevisarea[{{$i}}]"  value="{{$comm->steering_visual_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->steering_visual_description}}</h4></div>
                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->steering_visual_description}}">




                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="stevisanswer[{{$i}}]" class="custom-control-input" id="yes6{{$comm->id}}" type="radio" value="yes"{{ $pdichecksheetlist->stevisanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes6{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="stevisanswer[{{$i}}]" class="custom-control-input" id="no6{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->stevisanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no6{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="stevisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{  $pdichecksheetlist->stevisremark[$chk]}}">
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
                    <h3>FLUID LEVELS </h3>

                </div>
            </div>
        </li>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->steering_fluid_description))
                @php

                    // $stefluarea = (array) $pdichecksheetlist->stefluarea;
                     $chk=array_search($comm->steering_fluid_area, $pdichecksheetlist->stefluarea);


                    // $chk=array_search($comm->steering_fluid_area ,$pdichecksheetlist->stefluarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->steering_fluid_area}}</h4></div>
                        <input type="hidden" name="stefluarea[{{$i}}]"  value="{{$comm->steering_fluid_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->steering_fluid_description}}</h4></div>
                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->steering_fluid_description}}">

                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="stefluanswer[{{$i}}]" class="custom-control-input" id="yes7{{$comm->id}}" type="radio" value="yes" {{  $pdichecksheetlist->stefluanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes7{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="stefluanswer[{{$i}}]" class="custom-control-input" id="no7{{$comm->id}}" type="radio" value="no"  {{  $pdichecksheetlist->stefluanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no7{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="stefluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->stefluremark[$chk]}}">
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
                    <h3>DURING OPERATION </h3>

                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->steering_during_description))

                @php

                    // $stedurarea = (array) $pdichecksheetlist->stedurarea;
 $chk=array_search($comm->steering_during_area,$pdichecksheetlist->stedurarea);


                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">

                        <div class="col-2"><h4 class="mb-0" >{{$comm->steering_during_area}}</h4></div>

                        <input type="hidden" name="stedurarea[{{$i}}]"  value="{{$comm->steering_during_area}}">

                        <div class="col-5"><h4 class="mb-0" >{{$comm->steering_during_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->steering_during_description}}">

                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="steduranswer[{{$i}}]" class="custom-control-input" id="yes8{{$comm->id}}" type="radio" value="yes" {{   $pdichecksheetlist->steduranswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes8{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="steduranswer[{{$i}}]" class="custom-control-input" id="no8{{$comm->id}}" type="radio" value="no"  {{  $pdichecksheetlist->steduranswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no8{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="stedurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{$pdichecksheetlist->stedurremark[$chk]}}">
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
                    <h3>AFTER OPERATION </h3>

                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->steering_after_description))
                @php

                    // $steaftarea = (array) $pdichecksheetlist->steaftarea;
                     $chk=array_search($comm->steering_after_area, $pdichecksheetlist->steaftarea);


                    // $chk=array_search($comm->steering_after_area ,$pdichecksheetlist->steaftarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->steering_after_area}}</h4></div>
                        <input type="hidden" name="steaftarea[{{$i}}]"  value="{{$comm->steering_after_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->steering_after_description}}</h4></div>
                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->steering_after_description}}">


                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="steaftanswer[{{$i}}]" class="custom-control-input" id="yes9{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->steaftanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes9{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="steaftanswer[{{$i}}]" class="custom-control-input" id="no9{{$comm->id}}" type="radio" value="no"  {{  $pdichecksheetlist->steaftanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no9{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="steaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->steaftremark[$chk]}}">
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
                    <h3>CHASIS & UNDERCARRIAGE</h3>
                      <h3>VISUAL INSPECTION</h3>

                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->chasisundercrg_visual_description))
                @php

                    //$chasvisarea = (array) $pdichecksheetlist->chasvisarea;
                  //  $chk=array_search($comm->chasisundercrg_visual_area, $chasvisarea);

                    $chk=array_search($comm->chasisundercrg_visual_area ,$pdichecksheetlist->chasvisarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->chasisundercrg_visual_area}}</h4></div>
                        <input type="hidden" name="chasvisarea[{{$i}}]"  value="{{$comm->chasisundercrg_visual_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->chasisundercrg_visual_description}}</h4></div>

                        <div class="col-2">
                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->chasisundercrg_visual_description}}">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="chasvisanswer[{{$i}}]" class="custom-control-input" id="yes10{{$comm->id}}" type="radio" value="yes"  {{ $pdichecksheetlist->chasvisanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes10{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="chasvisanswer[{{$i}}]" class="custom-control-input" id="no10{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->chasvisanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no10{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="chasvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->chasvisremark[$chk]}}">
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
                    <h3>FLUID LEVELS</h3>

                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->chasisundercrg_fluid_description))

                @php

                    //$chasfluarea = (array) $pdichecksheetlist->chasfluarea;
                  //  $chk=array_search($comm->steering_fluid_area,  $chasfluarea);


                    $chk=array_search($comm->chasisundercrg_fluid_area ,$pdichecksheetlist->chasfluarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->steering_fluid_area}}</h4></div>

                        <input type="hidden" name="chasfluarea[{{$i}}]"  value="{{$comm->chasisundercrg_fluid_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->chasisundercrg_fluid_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->chasisundercrg_fluid_description}}">

                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="chasfluanswer[{{$i}}]" class="custom-control-input" id="yes11{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->chasfluanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes11{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="chasfluanswer[{{$i}}]" class="custom-control-input" id="no11{{$comm->id}}" type="radio" value="no"  {{$pdichecksheetlist->chasfluanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no11{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="chasfluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->chasfluremark[$chk]}}">
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
                    <h3>DURING OPERATION</h3>

                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->chasisundercrg_fluid_description))
                @php

                    //$chasdurarea = (array) $pdichecksheetlist->chasdurarea;
                   // $chk=array_search($comm->chasisundercrg_during_area,  $chasdurarea);


                   $chk=array_search($comm->chasisundercrg_during_area ,$pdichecksheetlist->chasdurarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->chasisundercrg_during_area}}</h4></div>

                        <input type="hidden" name="chasdurarea[{{$i}}]"  value="{{$comm->chasisundercrg_during_area}}">

                        <div class="col-5"><h4 class="mb-0" >{{$comm->chasisundercrg_during_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->chasisundercrg_during_description}}">


                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="chasduranswer[{{$i}}]" class="custom-control-input" id="yes12{{$comm->id}}" type="radio" value="yes" {{  $pdichecksheetlist->chasduranswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes12{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="chasduranswer[{{$i}}]" class="custom-control-input" id="no12{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->chasduranswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no12{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="chasdurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->chasdurremark[$chk]}}">
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
                    <h3>AFTER OPERATION</h3>

                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->chasisundercrg_after_description))
                @php

                    // $chasdurarea = (array) $pdichecksheetlist->chasdurarea;
                    // $chk=array_search($comm->chasisundercrg_after_area,  $chasdurarea);

                      $chk=array_search($comm->chasisundercrg_after_area ,$pdichecksheetlist->chasdurarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->chasisundercrg_after_area}}</h4></div>
                        <input type="hidden" name="chasaftarea[{{$i}}]"  value="{{$comm->chasisundercrg_after_area}}">

                        <div class="col-5"><h4 class="mb-0" >{{$comm->chasisundercrg_after_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->chasisundercrg_after_description}}">








                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="chasaftanswer[{{$i}}]" class="custom-control-input" id="yes13{{$comm->id}}" type="radio" value="yes" {{  $pdichecksheetlist->chasaftanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes13{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="chasaftanswer[{{$i}}]" class="custom-control-input" id="no13{{$comm->id}}" type="radio" value="no" {{ $pdichecksheetlist->chasaftanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no13{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="chasaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->chasaftremark[$chk]}}">
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
                    <h3>HYDRAULIC</h3>
                    <h3>VISUAL INSPECTION</h3>

                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->hydraulic_visual_description))

                @php
                    //$hydvisarea = (array) $pdichecksheetlist->hydvisarea;
                    //$chk=array_search($comm->hydraulic_visual_area,  $hydvisarea);

                   $chk=array_search($comm->hydraulic_visual_area ,$pdichecksheetlist->hydvisarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->hydraulic_visual_area}}</h4></div>

                        <input type="hidden" name="hydvisarea[{{$i}}]"  value="{{$comm->hydraulic_visual_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->hydraulic_visual_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->hydraulic_visual_description}}">

                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="hydvisanswer[{{$i}}]" class="custom-control-input" id="yes14{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->hydvisanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes14{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="hydvisanswer[{{$i}}]" class="custom-control-input" id="no14{{$comm->id}}" type="radio" value="no"  {{  $pdichecksheetlist->hydvisanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no14{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="hydvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->hydvisremark[$chk]}}">
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
                    <h3>FLUID LEVELS</h3>


                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->hydraulic_fluid_description))
                @php

                    //  $hydfluarea = (array) $pdichecksheetlist->hydfluarea;
                      //    $chk=array_search($comm->hydraulic_fluid_area,  $hydfluarea);

                          $chk=array_search($comm->hydraulic_fluid_area ,$pdichecksheetlist->hydfluarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->hydraulic_fluid_area}}</h4></div>

                        <input type="hidden" name="hydfluarea[{{$i}}]"  value="{{$comm->hydraulic_fluid_area}}">

                        <div class="col-5"><h4 class="mb-0" >{{$comm->hydraulic_fluid_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->hydraulic_fluid_description}}">




                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="hydfluanswer[{{$i}}]" class="custom-control-input" id="yes15{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->hydfluanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes15{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="hydfluanswer[{{$i}}]" class="custom-control-input" id="no15{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->hydfluanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no15{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="hydfluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{  $pdichecksheetlist->hydfluremark[$chk]}}">
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
                    <h3>DURING OPERATION</h3>
                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->hydraulic_during_description))
                @php
                    // $hyddurarea = (array) $pdichecksheetlist->hyddurarea;
                     $chk=array_search($comm->hydraulic_during_area,  $pdichecksheetlist->hyddurarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->hydraulic_during_area}}</h4></div>

                        <input type="hidden" name="hyddurarea[{{$i}}]"  value="{{$comm->hydraulic_during_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->hydraulic_during_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->hydraulic_during_description}}">

                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="hydduranswer[{{$i}}]" class="custom-control-input" id="yes16{{$comm->id}}" type="radio" value="yes" {{  $pdichecksheetlist->hydduranswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes16{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="hydduranswer[{{$i}}]" class="custom-control-input" id="no16{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->hydduranswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no16{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="hyddurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{  $pdichecksheetlist->hyddurremark[$chk]}}">
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
                    <h3>AFTER OPERATION</h3>


                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->hydraulic_after_description))
                @php
                    //$hydaftarea = (array) $pdichecksheetlist->hydaftarea;
                   // $chk=array_search($comm->hydraulic_after_area,  $hydaftarea);

                   $chk=array_search($comm->hydraulic_after_area ,$pdichecksheetlist->hydaftarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->hydraulic_after_area}}</h4></div>
                        <input type="hidden" name="hydaftarea[{{$i}}]"  value="{{$comm->hydraulic_during_area}}">

                        <div class="col-5"><h4 class="mb-0" >{{$comm->hydraulic_after_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->hydraulic_after_description}}">





                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="hydaftanswer[{{$i}}]" class="custom-control-input" id="yes17{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->hydaftanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes17{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="hydaftanswer[{{$i}}]" class="custom-control-input" id="no17{{$comm->id}}" type="radio" value="no"   {{ $pdichecksheetlist->hydaftanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no17{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="hydaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->hydaftremark[$chk]}}">
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
                    <h3>CAB OR CANOPY</h3>
                    <h3>VISUAL INSPECTION</h3>


                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->cab_visual_description))
                @php
                    //  $cabvisarea = (array) $pdichecksheetlist->cabvisarea;
                      $chk=array_search($comm->cab_visual_area,  $pdichecksheetlist->cabvisarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->cab_visual_area}}</h4></div>
                        <input type="hidden" name="cabvisarea[{{$i}}]"  value="{{$comm->cab_visual_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->cab_visual_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->cab_visual_description}}">


                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="cabvisanswer[{{$i}}]" class="custom-control-input" id="yes18{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->cabvisanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes18{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="cabvisanswer[{{$i}}]" class="custom-control-input" id="no18{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->cabvisanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no18{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="cabvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->cabvisremark[$chk]}}">
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
                    <h3>FLUID LEVELS</h3>
                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->cab_fluid_description))
                @php
                    // $cabfluarea = (array) $pdichecksheetlist->cabfluarea;
                     //$chk=array_search($comm->cab_fluid_area,  $cabfluarea);

                    $chk=array_search($comm->cab_fluid_area ,$pdichecksheetlist->cabfluarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->cab_fluid_area}}</h4></div>

                        <input type="hidden" name="cabfluarea[{{$i}}]"  value="{{$comm->cab_fluid_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->cab_fluid_description}}</h4></div>

                        <div class="col-2">
                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->cab_fluid_description}}">

                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="cabfluanswer[{{$i}}]" class="custom-control-input" id="yes19{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->cabfluanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes19{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="cabfluanswer[{{$i}}]" class="custom-control-input" id="no19{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->cabfluanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no19{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="cabfluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->cabfluremark[$chk]}}">
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
                    <h3>DURING OPERATION</h3>



                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->cab_during_description))
                @php
                    //$cabdurarea = (array) $pdichecksheetlist->cabdurarea;
                   // $chk=array_search($comm->cab_during_area,  $cabdurarea);
                   $chk=array_search($comm->cab_during_area ,$pdichecksheetlist->cabdurarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->cab_during_area}}</h4></div>

                        <input type="hidden" name="cabdurarea[{{$i}}]"  value="{{$comm->cab_during_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->cab_during_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->cab_during_description}}">

                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="cabduranswer[{{$i}}]" class="custom-control-input" id="yes20{{$comm->id}}" type="radio" value="yes" {{  $pdichecksheetlist->cabduranswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes20{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="cabduranswer[{{$i}}]" class="custom-control-input" id="no20{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->cabduranswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no20{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="cabdurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->cabdurremark[$chk]}}">
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
                    <h3>AFTER OPERATION</h3>



                </div>
        @php
            $m=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->cab_after_description))
                @php
                    //   $cabaftarea = (array) $pdichecksheetlist->cabaftarea;
                      // $chk=array_search($comm->cab_after_area,  $cabaftarea);

                       $chk=array_search($comm->cab_after_area ,$pdichecksheetlist->cabfluarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->cab_after_area}}</h4></div>

                        <input type="hidden" name="cabaftarea[{{$m}}]"  value="{{$comm->cab_after_area}}">


                        <div class="col-5"><h4 class="mb-0" >{{$comm->cab_after_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$m}}]"  value="{{$comm->cab_after_description}}">

                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="cabaftanswer[{{$m}}]" class="custom-control-input" id="yes21{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->cabaftanswer[$m]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes21{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="cabaftanswer[{{$m}}]" class="custom-control-input" id="no21{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->cabaftanswer[$m]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no21{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="cabaftremark[{{$m}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->cabaftremark[$m]}}">
                        </div>
                    </div>


                </li>
            @endif
            @php
                $m++;
            @endphp
        @endforeach


        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-4">
                    <h3>MISC. & ATTACHMENTS</h3>
                    <h3>VISUAL INSPECTION</h3>



                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->miscattach_visual_description))
                @php
                    //  $misvisarea = (array) $pdichecksheetlist->misvisarea;
                      //$chk=array_search($comm->miscattach_visual_area,  $misvisarea);
                     $chk=array_search($comm->miscattach_visual_area ,$pdichecksheetlist->misvisarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->miscattach_visual_area}}</h4></div>

                        <input type="hidden" name="misvisarea[{{$i}}]"  value="{{$comm->miscattach_visual_area}}">

                        <div class="col-5"><h4 class="mb-0" >{{$comm->miscattach_visual_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->miscattach_visual_description}}">

                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="misvisanswer[{{$i}}]" class="custom-control-input" id="yes22{{$comm->id}}" type="radio" value="yes"{{ $pdichecksheetlist->misvisanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes22{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="misvisanswer[{{$i}}]" class="custom-control-input" id="no22{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->misvisanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no22{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="misvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->misvisremark[$chk]}}">
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
                    <h3>FLUID LEVELS</h3>



                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->miscattach_fluid_description))
                @php
                    //$misfluarea = (array) $pdichecksheetlist->misfluarea;
                    //$chk=array_search($comm->miscattach_fluid_area,  $misfluarea);
                   $chk=array_search($comm->miscattach_fluid_area ,$pdichecksheetlist->misfluarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->miscattach_fluid_area}}</h4></div>

                        <input type="hidden" name="misfluarea[{{$i}}]"  value="{{$comm->miscattach_fluid_area}}">

                        <div class="col-5"><h4 class="mb-0" >{{$comm->miscattach_fluid_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->miscattach_fluid_description}}">


                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="misfluanswer[{{$i}}]" class="custom-control-input" id="yes23{{$comm->id}}" type="radio" value="yes" {{  $pdichecksheetlist->misfluanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes23{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="misfluanswer[{{$i}}]" class="custom-control-input" id="no23{{$comm->id}}" type="radio" value="no" {{ $pdichecksheetlist->misfluanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no23{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="misfluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->misfluremark[$chk]}}">
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
                    <h3>AFTER OPERATION</h3>



                </div>
        @php
            $n=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->miscattach_after_description))
                @php
                    // $misaftarea = (array) $pdichecksheetlist->misaftarea;
                     //$chk=array_search($comm->miscattach_after_area,  $misaftarea);
                    $chk=array_search($comm->miscattach_after_area ,$pdichecksheetlist->misaftarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->miscattach_after_area}}</h4></div>

                        <input type="hidden" name="misaftarea[{{$n}}]"  value="{{$comm->miscattach_fluid_area}}">

                        <div class="col-5"><h4 class="mb-0" >{{$comm->miscattach_after_description}}</h4></div>
                        <input type="hidden" name="misaftarea[{{$n}}]"  value="{{$comm->miscattach_after_description}}">
                        <input type="hidden" name="engfludes[{{$n}}]"  value="{{$comm->miscattach_after_description}}">
                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="misaftanswer[{{$n}}]" class="custom-control-input" id="yes24{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->misaftanswer[$n]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes24{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="misaftanswer[{{$n}}]" class="custom-control-input" id="no24{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->misaftanswer[$n]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no24{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="misaftremark[{{$n}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->misaftremark[$n]}}">
                        </div>
                    </div>



                </li>
            @endif
            @php
                $n++;
            @endphp
        @endforeach


        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-4">
                    <h3>IMPLEMENTS</h3>
                    <h3>VISUAL INSPECTION</h3>



                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->implement_visual_description))
                @php
                    //$impvisarea = (array) $pdichecksheetlist->impvisarea;
                   // $chk=array_search($comm->implement_visual_area,  $impvisarea);
                    $chk=array_search($comm->implement_visual_area ,$pdichecksheetlist->impvisarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->implement_visual_area}}</h4></div>

                        <input type="hidden" name="impvisarea[{{$i}}]"  value="{{$comm->implement_visual_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->implement_visual_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->implement_visual_description}}">
                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="impvisanswer[{{$i}}]" class="custom-control-input" id="yes25{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->impvisanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes25{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="impvisanswer[{{$i}}]" class="custom-control-input" id="no25{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->impvisanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no25{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="impvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{  $pdichecksheetlist->impvisremark[$chk]}}">
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
                    <h3>FLUID LEVELS</h3>



                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->implement_fluid_description))
                @php
                    // $impfluarea = (array) $pdichecksheetlist->impfluarea;
                     //$chk=array_search($comm->implement_fluid_area,  $impfluarea);
                    $chk=array_search($comm->implement_fluid_area ,$pdichecksheetlist->impfluarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->implement_fluid_area}}</h4></div>

                        <input type="hidden" name="impfluarea[{{$i}}]"  value="{{$comm->implement_visual_area}}">

                        <div class="col-5"><h4 class="mb-0" >{{$comm->implement_fluid_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->implement_fluid_description}}">




                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="impfluanswer[{{$i}}]" class="custom-control-input" id="yes26{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->impfluanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes26{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="impfluanswer[{{$i}}]" class="custom-control-input" id="no26{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->impfluanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no26{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="impfluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->impfluremark[$chk]}}">
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
                    <h3>DURING OPERATION</h3>



                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->implement_during_description))
                @php
                    //$impdurarea = (array) $pdichecksheetlist->impdurarea;
                   // $chk=array_search($comm->implement_during_area,  $impdurarea);
                    $chk=array_search($comm->implement_during_area ,$pdichecksheetlist->impdurarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->implement_during_area}}</h4></div>

                        <input type="hidden" name="impdurarea[{{$i}}]"  value="{{$comm->implement_during_area}}">

                        <div class="col-5"><h4 class="mb-0" >{{$comm->implement_during_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->implement_during_description}}">
                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="impduranswer[{{$i}}]" class="custom-control-input" id="yes27{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->impduranswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes27{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="impduranswer[{{$i}}]" class="custom-control-input" id="no27{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->impduranswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no27{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="impdurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->impdurremark[$chk]}}">
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
                    <h3>AFTER OPERATION</h3>



                </div>
        @php
            $i=0;
        @endphp
        @foreach( $pdienginevisual as $comm)
            @if(!empty($comm->implement_after_description))
                @php
                    //$impaftarea = (array) $pdichecksheetlist->impaftarea;
                    //$chk=array_search($comm->implement_after_area,  $impaftarea);
                   $chk=array_search($comm->implement_after_area ,$pdichecksheetlist->impaftarea);
                @endphp
                <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-2"><h4 class="mb-0" >{{$comm->implement_after_area}}</h4></div>

                        <input type="hidden" name="impaftarea[{{$i}}]"  value="{{$comm->implement_after_area}}">
                        <div class="col-5"><h4 class="mb-0" >{{$comm->implement_after_description}}</h4></div>

                        <input type="hidden" name="engfludes[{{$i}}]"  value="{{$comm->implement_after_description}}">



                        <div class="col-2">
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="impaftanswer[{{$i}}]" class="custom-control-input" id="yes28{{$comm->id}}" type="radio" value="yes" {{ $pdichecksheetlist->impaftanswer[$chk]=='yes'?'checked':''}}>
                            <label class="custom-control-label" for="yes28{{$comm->id}}">Yes</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio" >
                            <input name="impaftanswer[{{$i}}]" class="custom-control-input" id="no28{{$comm->id}}" type="radio" value="no"  {{ $pdichecksheetlist->impaftanswer[$chk]=='no'?'checked':''}}>
                            <label class="custom-control-label" for="no28{{$comm->id}}">No</label>
                        </div>
                        </div>

                        <div class="col-3" >
                            <input type="text" name="impaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $pdichecksheetlist->impaftremark[$chk]}}">
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
                        <label for="question">Actual Start Date</label>

                        <input type="text" class="form-control" id="" placeholder="" name="pdi_actual_start_date" value="{{date('d/m/Y', strtotime($pdichecksheet->pdi_actual_start_date))}}" disabled>

                    </div>
          </div>
		  <div class="col-md-6">
            <div class="form-group">
                <label for="question">Actual End Date</label>

                <input type="text" class="form-control" id="actualdate2" placeholder="" name="pdi_actual_end_date" value="{{date('d/m/Y', strtotime($pdichecksheet->pdi_actual_end_date))}}" required>

            </div>
        </div>
		</div>

        @if (request()->session()->get('user')['section_id'] == '22')
           
            @if($pdichecksheet->pdi_status != 'Approved')
                <input type="hidden" name="id" value="{{$pdichecksheet->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit" id="finalsubmit">Submit</button>
                
            @endif
            
        @endif

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





