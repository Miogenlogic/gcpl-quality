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
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500"><a href="{{url('admin/support-quotation-list')}}">Total quotation received</a></h5>
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
                            <li>WorkOrder No: <span>{{$pdiadd->work_orderno}}</span></li>
                           
                            <li>Branch name: <span>{{$pdiadd->branch_name}}</span></li>
                            <li>Component Serial number: <span>@if(!empty($serial)) {{$serial[0]['comp_serial_no']}} @endif</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="prepopulated-data">
                        <ul>
                            <li>AR number: <span>{{$pdiadd->ar_no}}</span></li>
                            <li>Model number: <span>@if(!empty($model)) {{$model[0]['model_no']}} @endif</span></li>
                            <li>Components name: <span>{{$pdiadd->component_name}}</span></li>
                            <li>Customer: <span>@if(!empty($customer)) {{$customer[0]['name']}} @endif</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Pre-populated informations -->

            <hr>

            <form method="post" action="{{url('admin/pdi-add-save')}}" enctype="multipart/form-data">



                <!-- List group -->
               <ul class="list-group list-group-flush list mb-3 hard-to-choose">
                    @php
                        $i=0;
                    @endphp
                   <!-- engine -->
                   <li class="list-group-item px-0">
                       <div class="row align-items-center">
                           <div class="col-4">
                               <h3>Engine</h3>
                               <h3>VISUAL INSPECTION</h3>
                           </div>

                       </div>
                   </li>

                      @foreach($pdienginevisual as $qes)
                        @if(!empty($qes->engine_visual_description))
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            <h4 class="mb-0">{{$qes->engine_visual_area}}</h4>
                                        </div>
                                        <div class="col-5"><h4 class="mb-0">{{$qes->engine_visual_description}}</h4></div>

                                        <div class="col-2">
                                           <input type="hidden" name="engvisarea[{{$i}}]" value="{{$qes->engine_visual_area}}">
                                            <input type="hidden" name="engvisdes[{{$i}}]" value="{{$qes->engine_visual_description}}">
                                            <div class="custom-control custom-control-inline custom-radio">
                                                <input name="engvisanswer[{{$i}}]" class="custom-control-input" id="engvisyes{{$qes->id}}" type="radio" value="yes">
                                                <label class="custom-control-label" for="engvisyes{{$qes->id}}">Yes</label>
                                            </div>
                                            <div class="custom-control custom-control-inline custom-radio">
                                                <input name="engvisanswer[{{$i}}]" class="custom-control-input" id="engvisno{{$qes->id}}" type="radio" value="no" checked>
                                                <label class="custom-control-label" for="engvisno{{$qes->id}}">No</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" name="engvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                        </div>
                                    </div>
                                </li>
                                @php
                                    $i++;
                                @endphp
                         @endif
                    @endforeach

                        @php
                            $i=0;
                        @endphp
                   <li class="list-group-item px-0">
                       <div class="row align-items-center">
                           <div class="col-4">

                               <h3>FLUID LEVELS</h3>
                           </div>

                       </div>
                   </li>
                   @foreach($pdienginevisual as $qes)
                      @if(!empty($qes->engine_fluid_description))
                        <li class="list-group-item px-0">
                           <div class="row align-items-center">
                               <div class="col-2">
                                   <h4 class="mb-0">{{$qes->engine_fluid_area}}</h4>
                               </div>
                               <div class="col-5"><h4 class="mb-0">{{$qes->engine_fluid_description}}</h4></div>

                               <div class="col-2">
                                   <input type="hidden" name="engfluarea[{{$i}}]" value="{{$qes->engine_fluid_area}}">
                                   <input type="hidden" name="engfludes[{{$i}}]" value="{{$qes->engine_fluid_description}}">
                                   <div class="custom-control custom-control-inline custom-radio">
                                       <input name="engfluanswer[{{$i}}]" class="custom-control-input" id="engfluyes{{$qes->id}}" type="radio" value="yes">
                                       <label class="custom-control-label" for="engfluyes{{$qes->id}}">Yes</label>
                                   </div>
                                   <div class="custom-control custom-control-inline custom-radio">
                                       <input name="engfluanswer[{{$i}}]" class="custom-control-input" id="engfluno{{$qes->id}}" type="radio" value="no" checked>
                                       <label class="custom-control-label" for="engfluno{{$qes->id}}">No</label>
                                   </div>
                               </div>
                               <div class="col-3">
                                   <input type="text" name="engfluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                               </div>
                           </div>
                       </li>
                       @php
                           $i++;
                       @endphp
                       @endif
                   @endforeach
                        @php
                            $i=0;
                        @endphp
                   <li class="list-group-item px-0">
                       <div class="row align-items-center">
                           <div class="col-4">

                               <h3>DURING OPERATION</h3>
                           </div>

                       </div>
                   </li>
                   @foreach($pdienginevisual as $qes)
                       @if(!empty($qes->engine_during_description))
                           <li class="list-group-item px-0">
                           <div class="row align-items-center">
                               <div class="col-2">
                                   <h4 class="mb-0">{{$qes->engine_during_area}}</h4>
                               </div>
                               <div class="col-5"><h4 class="mb-0">{{$qes->engine_during_description}}</h4></div>

                               <div class="col-2">
                                   <input type="hidden" name="engdurarea[{{$i}}]" value="{{$qes->engine_during_area}}">
                                   <input type="hidden" name="engdurdes[{{$i}}]" value="{{$qes->engine_during_description}}">
                                   <div class="custom-control custom-control-inline custom-radio">
                                       <input name="engduranswer[{{$i}}]" class="custom-control-input" id="engduryes{{$qes->id}}" type="radio" value="yes">
                                       <label class="custom-control-label" for="engduryes{{$qes->id}}">Yes</label>
                                   </div>
                                   <div class="custom-control custom-control-inline custom-radio">
                                       <input name="engduranswer[{{$i}}]" class="custom-control-input" id="engdurno{{$qes->id}}" type="radio" value="no" checked>
                                       <label class="custom-control-label" for="engdurno{{$qes->id}}">No</label>
                                   </div>
                               </div>
                               <div class="col-3">
                                   <input type="text" name="engdurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                               </div>
                           </div>
                       </li>
                       @php
                           $i++;
                       @endphp
                       @endif
                   @endforeach
                        @php
                            $i=0;
                        @endphp
                   <li class="list-group-item px-0">
                       <div class="row align-items-center">
                           <div class="col-4">

                               <h3>AFTER OPERATION</h3>
                           </div>

                       </div>
                   </li>
                   @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->engine_after_description))
                       <li class="list-group-item px-0">
                           <div class="row align-items-center">
                               <div class="col-2">
                                   <h4 class="mb-0">{{$qes->engine_after_area}}</h4>
                               </div>
                               <div class="col-5"><h4 class="mb-0">{{$qes->engine_after_description}}</h4></div>

                               <div class="col-2">
                                   <input type="hidden" name="engaftarea[{{$i}}]" value="{{$qes->engine_after_area}}">
                                   <input type="hidden" name="engaftdes[{{$i}}]" value="{{$qes->engine_after_description}}">
                                   <div class="custom-control custom-control-inline custom-radio">
                                       <input name="engaftanswer[{{$i}}]" class="custom-control-input" id="engaftyes{{$qes->id}}" type="radio" value="yes">
                                       <label class="custom-control-label" for="engaftyes{{$qes->id}}">Yes</label>
                                   </div>
                                   <div class="custom-control custom-control-inline custom-radio">
                                       <input name="engaftanswer[{{$i}}]" class="custom-control-input" id="engaftno{{$qes->id}}" type="radio" value="no" checked>
                                       <label class="custom-control-label" for="engaftno{{$qes->id}}">No</label>
                                   </div>
                               </div>

                               <div class="col-3">
                                   <input type="text" name="engaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                               </div>

                           </div>
                       </li>
                            @endif
                       @php
                           $i++;
                       @endphp
                   @endforeach
                    <!--power train -->

                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <h3>POWER TRAIN</h3>
                                    <h3>VISUAL INSPECTION</h3>
                                </div>

                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->powertrain_visual_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->powertrain_visual_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->powertrain_visual_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="powvisarea[{{$i}}]" value="{{$qes->powertrain_visual_area}}">
                                        <input type="hidden" name="powvisdis[{{$i}}]" value="{{$qes->powertrain_visual_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="powvisanswer[{{$i}}]" class="custom-control-input" id="powvisyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="powvisyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="powvisanswer[{{$i}}]" class="custom-control-input" id="powvisno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="powvisno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="powvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>FLUID LEVELS</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->powertrain_fluid_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->powertrain_fluid_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->powertrain_fluid_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="powfluarea[{{$i}}]" value="{{$qes->powertrain_fluid_area}}">
                                        <input type="hidden" name="powfludis[{{$i}}]" value="{{$qes->powertrain_fluid_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="powfluanswer[{{$i}}]" class="custom-control-input" id="powfluyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="powfluyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="powfluanswer[{{$i}}]" class="custom-control-input" id="powfluno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="powfluno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="powfluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>DURING OPERATION</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->powertrain_during_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->powertrain_during_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->powertrain_during_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="powdurarea[{{$i}}]" value="{{$qes->powertrain_during_area}}">
                                        <input type="hidden" name="powdurdis[{{$i}}]" value="{{$qes->powertrain_during_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="powduranswer[{{$i}}]" class="custom-control-input" id="powduryes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="powduryes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="powduranswer[{{$i}}]" class="custom-control-input" id="powdurno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="powdurno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="powdurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>AFTER OPERATION</h3>
                                </div>

                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->powertrain_after_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->powertrain_after_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->powertrain_after_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="powaftarea[{{$i}}]" value="{{$qes->powertrain_after_area}}">
                                        <input type="hidden" name="powaftdis[{{$i}}]" value="{{$qes->powertrain_after_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="powaftanswer[{{$i}}]" class="custom-control-input" id="powaftyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="powaftyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="powaftanswer[{{$i}}]" class="custom-control-input" id="powaftno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="powaftno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="powaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                    <!--STEERING/BRAKES -->
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <h3>STEERING/BRAKES</h3>
                                    <h3>VISUAL INSPECTION</h3>
                                </div>

                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->steering_visual_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->steering_visual_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->steering_visual_description	}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="stevisarea[{{$i}}]" value="{{$qes->steering_visual_area}}">
                                        <input type="hidden" name="stevisdes[{{$i}}]" value="{{$qes->steering_visual_description	}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="stevisanswer[{{$i}}]" class="custom-control-input" id="stevisyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="stevisyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="stevisanswer[{{$i}}]" class="custom-control-input" id="stevisno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="stevisno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="stevisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>FLUID LEVELS</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->steering_fluid_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->steering_fluid_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->steering_fluid_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="stefluarea[{{$i}}]" value="{{$qes->steering_fluid_area}}">
                                        <input type="hidden" name="stefludes[{{$i}}]" value="{{$qes->steering_fluid_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="stefluanswer[{{$i}}]" class="custom-control-input" id="stefluyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="stefluyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="stefluanswer[{{$i}}]" class="custom-control-input" id="stefluno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="stefluno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="stefluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>DURING OPERATION</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->steering_during_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->steering_during_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->steering_during_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="stedurarea[{{$i}}]" value="{{$qes->steering_during_area}}">
                                        <input type="hidden" name="stedurdes[{{$i}}]" value="{{$qes->steering_during_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="steduranswer[{{$i}}]" class="custom-control-input" id="steduryes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="steduryes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="steduranswer[{{$i}}]" class="custom-control-input" id="stedurno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="stedurno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="stedurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>AFTER OPERATION</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->steering_after_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->steering_after_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->steering_after_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="steaftarea[{{$i}}]" value="{{$qes->steering_after_area}}">
                                        <input type="hidden" name="steaftdes[{{$i}}]" value="{{$qes->steering_after_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="steaftanswer[{{$i}}]" class="custom-control-input" id="steaftyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="steaftyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="steaftanswer[{{$i}}]" class="custom-control-input" id="steaftno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="steaftno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="steaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                    <!--CHASIS & UNDERCARRIAGE -->
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <h3>CHASIS & UNDERCARRIAGE</h3>
                                    <h3>VISUAL INSPECTION</h3>
                                </div>

                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->chasisundercrg_visual_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->chasisundercrg_visual_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->chasisundercrg_visual_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="chasvisarea[{{$i}}]" value="{{$qes->chasisundercrg_visual_area}}">
                                        <input type="hidden" name="chasvisdes[{{$i}}]" value="{{$qes->chasisundercrg_visual_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="chasvisanswer[{{$i}}]" class="custom-control-input" id="chasvisyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="chasvisyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="chasvisanswer[{{$i}}]" class="custom-control-input" id="chasvisno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="chasvisno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="chasvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>FLUID LEVELS</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->chasisundercrg_fluid_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->chasisundercrg_fluid_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->chasisundercrg_fluid_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="chasfluarea[{{$i}}]" value="{{$qes->chasisundercrg_fluid_area}}">
                                        <input type="hidden" name="chasfludes[{{$i}}]" value="{{$qes->chasisundercrg_fluid_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="chasfluanswer[{{$i}}]" class="custom-control-input" id="chasfluyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="chasfluyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="chasfluanswer[{{$i}}]" class="custom-control-input" id="chasfluno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="chasfluno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="chasfluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>DURING OPERATION</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->chasisundercrg_during_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->chasisundercrg_during_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->chasisundercrg_during_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="chasdurarea[{{$i}}]" value="{{$qes->chasisundercrg_during_area}}">
                                        <input type="hidden" name="chasdurdes[{{$i}}]" value="{{$qes->chasisundercrg_during_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="chasduranswer[{{$i}}]" class="custom-control-input" id="chasduryes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="chasduryes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="chasduranswer[{{$i}}]" class="custom-control-input" id="chasdurno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="chasdurno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="chasdurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>AFTER OPERATION</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->chasisundercrg_after_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->chasisundercrg_after_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->chasisundercrg_after_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="chasaftarea[{{$i}}]" value="{{$qes->chasisundercrg_after_area}}">
                                        <input type="hidden" name="chasaftdes[{{$i}}]" value="{{$qes->chasisundercrg_after_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="chasaftanswer[{{$i}}]" class="custom-control-input" id="chasaftyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="chasaftyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="chasaftanswer[{{$i}}]" class="custom-control-input" id="chasaftno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="chasaftno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="chasaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                    <!--HYDRAULIC -->
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <h3>HYDRAULIC</h3>
                                    <h3>VISUAL INSPECTION</h3>
                                </div>

                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->hydraulic_visual_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->hydraulic_visual_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->hydraulic_visual_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="hydvisarea[{{$i}}]" value="{{$qes->hydraulic_visual_area}}">
                                        <input type="hidden" name="hydvisdes[{{$i}}]" value="{{$qes->hydraulic_visual_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="hydvisanswer[{{$i}}]" class="custom-control-input" id="hydvisyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="hydvisyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="hydvisanswer[{{$i}}]" class="custom-control-input" id="hydvisno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="hydvisno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="hydvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>FLUID LEVELS</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->hydraulic_fluid_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->hydraulic_fluid_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->hydraulic_fluid_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="hydfluarea[{{$i}}]" value="{{$qes->hydraulic_fluid_area}}">
                                        <input type="hidden" name="hydfludes[{{$i}}]" value="{{$qes->hydraulic_fluid_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="hydfluanswer[{{$i}}]" class="custom-control-input" id="hydfluyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="hydfluyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="hydfluanswer[{{$i}}]" class="custom-control-input" id="hydfluno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="hydfluno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="hydfluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>DURING OPERATION</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->hydraulic_during_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->hydraulic_during_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->hydraulic_during_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="hyddurarea[{{$i}}]" value="{{$qes->hydraulic_during_area}}">
                                        <input type="hidden" name="hyddurdes[{{$i}}]" value="{{$qes->hydraulic_during_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="hydduranswer[{{$i}}]" class="custom-control-input" id="hydduryes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="hydduryes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="hydduranswer[{{$i}}]" class="custom-control-input" id="hyddurno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="hyddurno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="hyddurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>AFTER OPERATION</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->hydraulic_after_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->hydraulic_after_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->hydraulic_after_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="hydaftarea[{{$i}}]" value="{{$qes->hydraulic_after_area}}">
                                        <input type="hidden" name="hydaftdes[{{$i}}]" value="{{$qes->hydraulic_after_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="hydaftanswer[{{$i}}]" class="custom-control-input" id="hydaftyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="hydaftyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="hydaftanswer[{{$i}}]" class="custom-control-input" id="hydaftno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="hydaftno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="hydaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                    <!--CAB OR CANOPY -->
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <h3>CAB OR CANOPY</h3>
                                    <h3>VISUAL INSPECTION</h3>
                                </div>

                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->cab_visual_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->cab_visual_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->cab_visual_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="cabvisarea[{{$i}}]" value="{{$qes->cab_visual_area}}">
                                        <input type="hidden" name="cabvisdes[{{$i}}]" value="{{$qes->cab_visual_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="cabvisanswer[{{$i}}]" class="custom-control-input" id="cabvisyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="cabvisyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="cabvisanswer[{{$i}}]" class="custom-control-input" id="cabvisno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="cabvisno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="cabvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>FLUID LEVELS</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->cab_fluid_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->cab_fluid_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->cab_fluid_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="cabfluarea[{{$i}}]" value="{{$qes->cab_fluid_area}}">
                                        <input type="hidden" name="cabfludes[{{$i}}]" value="{{$qes->cab_fluid_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="cabfluanswer[{{$i}}]" class="custom-control-input" id="cabfluyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="cabfluyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="cabfluanswer[{{$i}}]" class="custom-control-input" id="cabfluno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="cabfluno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="cabfluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>

                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>DURING OPERATION</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->cab_during_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->cab_during_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->cab_during_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="cabdurarea[{{$i}}]" value="{{$qes->cab_during_area}}">
                                        <input type="hidden" name="cabdurdes[{{$i}}]" value="{{$qes->cab_during_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="cabduranswer[{{$i}}]" class="custom-control-input" id="cabduryes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="cabduryes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="cabduranswer[{{$i}}]" class="custom-control-input" id="cabdurno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="cabdurno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="cabdurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach

                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>AFTER OPERATION</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->cab_after_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->cab_after_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->cab_after_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="cabaftarea[{{$i}}]" value="{{$qes->cab_after_area}}">
                                        <input type="hidden" name="cabaftdes[{{$i}}]" value="{{$qes->cab_after_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="cabaftanswer[{{$i}}]" class="custom-control-input" id="cabaftyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="cabaftyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="cabaftanswer[{{$i}}]" class="custom-control-input" id="cabaftno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="cabaftno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="cabaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                    <!--MISC. & ATTACHMENTS -->
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <h3>MISC. & ATTACHMENTS</h3>
                                    <h3>VISUAL INSPECTION</h3>
                                </div>

                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->miscattach_visual_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->miscattach_visual_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->miscattach_visual_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="misvisarea[{{$i}}]" value="{{$qes->miscattach_visual_area}}">
                                        <input type="hidden" name="misvisdes[{{$i}}]" value="{{$qes->miscattach_visual_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="misvisanswer[{{$i}}]" class="custom-control-input" id="misvisyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="misvisyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="misvisanswer[{{$i}}]" class="custom-control-input" id="misvisno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="misvisno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="misvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>FLUID LEVELS</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->miscattach_fluid_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->miscattach_fluid_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->miscattach_fluid_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="misfluarea[{{$i}}]" value="{{$qes->miscattach_fluid_area}}">
                                        <input type="hidden" name="misfludes[{{$i}}]" value="{{$qes->miscattach_fluid_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="misfluanswer[{{$i}}]" class="custom-control-input" id="misfluyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="misfluyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="misfluanswer[{{$i}}]" class="custom-control-input" id="misfluno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="misfluno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="misfluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach


                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>AFTER OPERATION</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->miscattach_after_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->miscattach_after_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->miscattach_after_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="misaftarea[{{$i}}]" value="{{$qes->miscattach_after_area}}">
                                        <input type="hidden" name="misaftdes[{{$i}}]" value="{{$qes->miscattach_after_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="misaftanswer[{{$i}}]" class="custom-control-input" id="misaftyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="misaftyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="misaftanswer[{{$i}}]" class="custom-control-input" id="misaftno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="misaftno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="misaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                    <!--IMPLEMENTS -->
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <h3>IMPLEMENTS</h3>
                                    <h3>VISUAL INSPECTION</h3>
                                </div>

                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->implement_visual_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->implement_visual_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->implement_visual_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="impvisarea[{{$i}}]" value="{{$qes->implement_visual_area}}">
                                        <input type="hidden" name="impvisdes[{{$i}}]" value="{{$qes->implement_visual_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="impvisanswer[{{$i}}]" class="custom-control-input" id="impvisyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="impvisyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="impvisanswer[{{$i}}]" class="custom-control-input" id="impvisno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="impvisno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="impvisremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>FLUID LEVELS</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->implement_fluid_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->implement_fluid_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->implement_fluid_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="impfluarea[{{$i}}]" value="{{$qes->implement_fluid_area}}">
                                        <input type="hidden" name="impfludes[{{$i}}]" value="{{$qes->implement_fluid_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="impfluanswer[{{$i}}]" class="custom-control-input" id="impfluyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="impfluyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="impfluanswer[{{$i}}]" class="custom-control-input" id="impfluno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="impfluno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="impfluremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">

                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>DURING OPERATION</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->implement_during_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->implement_during_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->implement_during_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="impdurarea[{{$i}}]" value="{{$qes->implement_during_area}}">
                                        <input type="hidden" name="impdurdes[{{$i}}]" value="{{$qes->implement_during_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="impduranswer[{{$i}}]" class="custom-control-input" id="impduryes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="impduryes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="impduranswer[{{$i}}]" class="custom-control-input" id="impdurno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="impdurno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="impdurremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
                                    </div>
                                </div>
                            </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @php
                            $i=0;
                        @endphp
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-4">

                                    <h3>AFTER OPERATION</h3>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </li>
                        @foreach($pdienginevisual as $qes)
                            @if(!empty($qes->implement_after_description))
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h4 class="mb-0">{{$qes->implement_after_area}}</h4>
                                    </div>
                                    <div class="col-5"><h4 class="mb-0">{{$qes->implement_after_description}}</h4></div>

                                    <div class="col-2">
                                        <input type="hidden" name="impaftarea[{{$i}}]" value="{{$qes->implement_after_area}}">
                                        <input type="hidden" name="impaftdes[{{$i}}]" value="{{$qes->implement_after_description}}">
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="impaftanswer[{{$i}}]" class="custom-control-input" id="impaftyes{{$qes->id}}" type="radio" value="yes">
                                            <label class="custom-control-label" for="impaftyes{{$qes->id}}">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="impaftanswer[{{$i}}]" class="custom-control-input" id="impaftno{{$qes->id}}" type="radio" value="no" checked>
                                            <label class="custom-control-label" for="impaftno{{$qes->id}}">No</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="impaftremark[{{$i}}]" class="form-control" id="" placeholder="Remarks">
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
                            <label for="question">Actual Start Date <span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="actualdate1" placeholder="" name="pdi_actual_start_date" value=""  required>

                        </div>
                    </div>
					<div class="col-md-6">
                            <div class="form-group">
                                <label for="question">Actual End Date <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="actualdate2" placeholder="" name="pdi_actual_end_date" value=""  required>

                            </div>
                        </div>
					</div>


               </ul>


                <input type="hidden" name="id" value="{{$pdiadd->id}}">
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
