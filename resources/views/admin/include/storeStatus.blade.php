@extends('admin.include.layout')
<!-- Project List -->

@section('head')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Store</h6>
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
        $deptnme=App\Helpers\UserHelper::departmentname();
    @endphp

    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Store Status</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">

            <!-- Pre-populated information -->
            <div class="row">
                <div class="col-md-6">
                    <div class="prepopulated-data">
                        <ul>
                            <li>WorkOrder No: <span>@if(!empty($pdiadd->work_orderno)) {{$pdiadd->work_orderno}} @endif</span></li>
                            
                            <li>Branch name: <span>@if(!empty($pdiadd->branch_name)){{$pdiadd->branch_name}}@endif</span></li>
                            <li>Component Serial number: <span>@if(!empty($serial[0]['comp_serial_no'])) {{$serial[0]['comp_serial_no']}} @endif</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="prepopulated-data">
                        <ul>
                            <li>AR number: <span>@if(!empty($pdiadd->ar_no)){{$pdiadd->ar_no}}@endif</span></li>
                            <li>Model number: <span>@if(!empty($model[0]['model_no'])) {{$model[0]['model_no']}} @endif</span></li>
                            <li>Components name: <span>@if(!empty($pdiadd->component_name)){{$pdiadd->component_name}}@endif</span></li>
                            <li>Customer: <span>@if(!empty($customer[0]['name'])) {{$customer[0]['name']}} @endif</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Pre-populated informations -->

            <hr>

            <form method="post" id="assigntomor" action="{{url('admin/store-status-save')}}" enctype="multipart/form-data">


                {{--<div class="col-auto">--}}
                    {{--<a href="javascript:void(0);" class="btn btn-default add_button">+</a>--}}
                {{--</div>--}}


                            <div class="morassign">
                                @php
                                    //echo '<pre>';print_r($subwork);exit;
                                @endphp




                                    <!--<div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Depatment </label>
                                                @foreach($missingpart as $key=> $onepart)
                                                    <select name="dept_id[]" class="form-control select2" readonly>
                                                        <option value=''>--Select Status--</option>
                                                        @php
                                                            $deptid=App\Helpers\UserHelper::departmentname();
                                                        @endphp

                                                        @foreach($deptid as $dept)


                                                            <option value="{{$dept->id}}" {{old('dept_id')==$dept->id?'Selected':$onepart['dept_id'] == $dept->id?'Selected':''}} >{{$dept->name}}</option>
                                                            {{--<option value="{{$desig->id}}">{{$desig->name}}</option>--}}

                                                        @endforeach

                                                    </select>
                                                @endforeach

                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Part No </label>
                                                @foreach($missingpart as $key=> $onepart)
												<select name="part_no[]" class="form-control select2" readonly>
                                                        <option value=''>--Select Status--</option>
                                                        @php
                                                            $partno=App\Helpers\UserHelper::dropdownpartnumber();
                                                        @endphp

                                                        @foreach($partno as $dept)


                                                            <option value="{{$dept->id}}" {{old('part_no')==$dept->id?'Selected':$onepart['part_no'] == $dept->id?'Selected':''}} >{{$dept->comp_serial_no}}</option>
                                                            {{--<option value="{{$desig->id}}">{{$desig->name}}</option>--}}

                                                        @endforeach

                                                    </select>

												
                                                
                                                 @endforeach
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">QTY </label>
                                                @foreach($missingpart as $key=> $onepart)
                                                    <input type="text" name="qty[]" class="form-control" placeholder="QTY"  id="subwork" value="{{$onepart['qty']}}" readonly>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Status </label>
                                                @foreach($missingpart as $key=> $onepart)
                                                <select name="status[]" class="form-control select2" required>
                                                    <option value=''>--Select Status--</option>
                                                    @php
                                                        $deptid=App\Helpers\UserHelper::storeStatus();
                                                    @endphp

                                                    @foreach($deptid as $desig)


                                                        <option value="{{$desig->name}}" {{old('status')==$desig->name?'Selected':$onepart['status'] == $desig->name?'Selected':''}} >{{$desig->name}}</option>
                                                        {{--<option value="{{$desig->id}}">{{$desig->name}}</option>--}}

                                                    @endforeach

                                                </select>
                                                @endforeach

                                            </div>
                                        </div>


                                    </div>-->
                                   <div class="row">
                                       <div class="col-md-4">
                                           <div class="form-group">
                                               <label for="" class="form-control-label">Overall Status </label>

                                               <select name="store_status" class="form-control" required>
                                                   <option value=''>--Select Status--</option>
                                                   @php
                                                       $deptid=App\Helpers\UserHelper::storeStatus();
                                                   @endphp

                                                   @foreach($deptid as $desig)


                                                       <option value="{{$desig->name}}" {{old('store_status')==$desig->name?'Selected':$pdiadd->store_status == $desig->name?'Selected':''}} >{{$desig->name}}</option>
                                                       {{--<option value="{{$desig->id}}">{{$desig->name}}</option>--}}

                                                   @endforeach
                                               </select>

                                           </div>
                                       </div>
                                       <div class="col-md-4">
                                           <div class="form-group">
                                               <label class="form-control-label" for="date-of-dispatch">Comment</label>
                                               @if(isset($pdiadd->store_comment))
                                                   <input type="text" name="store_comment" class="form-control" id="date-of-dispatch" placeholder="" value="{{$pdiadd->store_comment}}" >
                                               @else
                                                   <input type="text" name="store_comment" class="form-control" id="date-of-dispatch" placeholder="" value="">
                                               @endif

                                           </div>
                                       </div>
                                       <div class="col-md-4">
                                           <div class="form-group">
                                               <label class="form-control-label" for="date-of-dispatch">Actual Start Date</label>
                                               @if(isset($pdiadd->store_actual_start_date))
                                                   <input type="text" name="store_actual_start_date" class=" form-control" id="date-of-dispatch" placeholder="Date" value="{{date('d/m/Y',strtotime($pdiadd->store_actual_start_date))}}" readonly>
                                               @else
                                                   <input type="text" name="store_actual_start_date" class=" form-control" id="store" placeholder="Date" value="" required>
                                               @endif

                                           </div>
                                       </div>
									   <div class="col-md-4">
                                           <div class="form-group">
                                               <label class="form-control-label" for="date-of-dispatch">Actual End Date</label>
                                               @if(isset($pdiadd->store_actual_end_date))
                                                   <input type="text" name="store_actual_end_date" class=" form-control" id="store1" placeholder="Date" value="{{date('d/m/Y',strtotime($pdiadd->store_actual_end_date))}}" required>
                                               @else
                                                   <input type="text" name="store_actual_end_date" class=" form-control" id="store1" placeholder="Date" value="" required>
                                               @endif

                                           </div>
                                       </div>
                                   </div>
                             </div>

                <input type="hidden" name="work_order" value="{{$pdiadd->work_orderno}}">
                <input type="hidden" name="service_id" value="{{$pdiadd->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                @if (request()->session()->get('user')['section_id'] == '9')
                    @if (request()->session()->get('user')['role_id'] == '1')
                      <button class="btn btn-primary"  type="submit">Submit</button>
                     @endif
                @endif


            </form>
        </div>
    </div>



@endsection

@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>


<script>

            $('#store').datepicker({


        format: "dd/mm/yyyy",
            autoclose: true,
        //startDate: new Date('2019-12-5'),
         endDate: "today",
         });
        $('#store1').datepicker({


                format: "dd/mm/yyyy",
                autoclose: true,
                //startDate: new Date('2019-12-5'),
                endDate: "today",
            });


        </script>


@endsection
