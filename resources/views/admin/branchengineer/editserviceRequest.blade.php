@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Edit All Service Request</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit service requeust</li>
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
            <form method="post" action="{{url('admin/service-request-edit-save')}}" enctype="multipart/form-data">
                <div class="row">

                  <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Service Request Number</label>
                            <input type="text" name="service_request_no" class="form-control" id="service" value="{{old('service_request_no')?old('service_request_no'):$service->service_request_no}}" readonly>
                            @if($errors->has('service_request_no'))
                                <div class="invalid-feedback" style="display:block;">{/{$errors->first('service_request_no')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="customer">Select customer</label>
                            <select name="customer" class="form-control">
                                <option selected="selected" disabled="disabled">--Select customer--</option>
                                @php
                                    $customer=App\Helpers\UserHelper::customer();
                                @endphp

                                @foreach($customer as $cus)

                                    {{--<option value="{{$cus->name}}">{{$cus->name}}</option>--}}
                                    <option value="{{$cus->name}}" {{(old('customer')!=$service->customer)?($cus->name==$service->customer)?'selected=selected':'': 'selected=selected'}}>{{$cus->name}}</option>
                                    {{--<option value="{{$cus->name}}" {{old('customer')==$cus->name?'Selected':$service->customer == $cus->name?'Selected':''}}>{{$cus->name}}</option>--}}
                                @endforeach
                            </select>
                            @if($errors->has('customer'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('customer')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="job">Job number</label>
                            <input type="text" name="job_no" class="form-control" id="" placeholder="" value="{{old('job_no')?old('job_no'):$service->job_no}}">
                            @if($errors->has('job_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('job_no')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="serial">Component Serial Number</label>
                            <select name="component_serial_no" class="form-control">
                                <option selected="selected" disabled="disabled">--Select Serial No--</option>
                                @php
                                    $compserial=App\Helpers\UserHelper::componentserialno();
                                @endphp

                                @foreach($compserial as $serial)

                                   {{--<option value="{{$serial->serial_no}}">{{$serial->serial_no}}</option>--}}
                                    <option value="{{$serial->serial_no}}" {{(old('component_serial_no')!=$service->component_serial_no)?($serial->serial_no==$service->component_serial_no)?'selected=selected':'': 'selected=selected'}}>{{$serial->serial_no}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('component_serial_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('component_serial_no')}}</div>
                            @endif
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Component">Component name</label>
                            <select name="component_name" class="form-control">
                                <option selected="selected" disabled="disabled">--Select component--</option>
                                @php
                                    $comptype=App\Helpers\UserHelper::componenttype();
                                @endphp

                                @foreach($comptype as $ctype)

                                    {{--<option value="{{$ctype->type}}">{{$ctype->type}}</option>--}}
                                    <option value="{{$ctype->type}}" {{(old('component_name')!=$service->component_name)?($ctype->type==$service->component_name)?'selected=selected':'': 'selected=selected'}}>{{$ctype->type}}</option>

                                @endforeach
                            </select>
                            @if($errors->has('component_name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('component_name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="model">Component Model number</label>
                            <select name="model_no" class="form-control">
                                <option selected="selected" disabled="disabled">--Select model number--</option>

                                @php
                                    $compmodel=App\Helpers\UserHelper::componentmodelno();
                                @endphp

                                @foreach($compmodel as $cmodel)

                                   {{--<option value="{{$cmodel->model_no}}">{{$cmodel->model_no}}</option>--}}
                                    <option value="{{$cmodel->model_no}}" {{(old('model_no')!=$service->model_no)?($cmodel->model_no==$service->model_no)?'selected=selected':'': 'selected=selected'}}>{{$cmodel->model_no}}</option>

                                @endforeach


                            </select>
                            @if($errors->has('model_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('model_no')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="model">Machine Model number</label>
                            <select name="machine_modelno" class="form-control">
                                <option selected="selected" disabled="disabled">--Select model number--</option>

                                @php
                                    $mchmodel=App\Helpers\UserHelper::machinemodelno();
                                @endphp

                                @foreach($mchmodel as $mchdel)

                                    {{-- <option value="{{$cmodel->model_no}}">{{$cmodel->model_no}}</option>
                                    <option value="{{$mchdel->model_no}}" {{(old('machine_modelno')!=$service->machine_modelno)?($mchdel->model_no==$service->machine_modelno)?'selected=selected':'': 'selected=selected'}}>{{$mchdel->model_no}}</option>--}}
                                    <option value="{{$mchdel->model_no}}" {{old('machine_modelno')==$mchdel->model_no?'Selected':$service->machine_modelno == $mchdel->model_no?'Selected':''}}>{{$mchdel->model_no}}</option>

                                @endforeach


                            </select>
                            @if($errors->has('machine_modelno'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('machine_modelno')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">AR number</label>
                            <input type="text" name="ar_no" class="form-control" id="" placeholder="AR number" value="{{old('ar_no')?old('ar_no'):$service->ar_no}}">
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Branch Name</label>
                            <select name="branch_name" class="form-control">
                                <option selected="selected" disabled="disabled">--Select Branch name--</option>

                                @php
                                    $branchnme=App\Helpers\UserHelper::branchname();
                                @endphp

                                @foreach($branchnme as $bname)

                                    {{--<option value="{{$bname->name}}">{{$bname->name}}</option>--}}
                                    <option value="{{$bname->name}}" {{(old('branch_name')!=$service->branch_name)?($bname->name==$service->branch_name)?'selected=selected':'': 'selected=selected'}}>{{$bname->name}}</option>
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
                            <select name="segment" class="form-control">
                                <option selected="selected" disabled="disabled">--Select Segment--</option>

                                @php
                                    $segment=App\Helpers\UserHelper::segment();
                                @endphp

                                @foreach($segment as $seg)

                                    {{--<option value="{{$seg->name}}">{{$seg->name}}</option>--}}
                                    <option value="{{$seg->name}}" {{(old('segment')!=$service->segment)?($seg->name==$service->segment)?'selected=selected':'': 'selected=selected'}}>{{$seg->name}}</option>
                                @endforeach


                            </select>
                            @if($errors->has('segment'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('segment')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Branch Location</label>
                            <input type="text" name="branch_location" class="form-control" id="" placeholder="Branch Location" value="{{old('branch_location')?old('branch_location'):$service->branch_location}}">
                            @if($errors->has('branch_location'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('branch_location')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="servicedate" class="form-control-label">Service Request Date</label>

                            <input class="form-control" name="date" type="date" value="{{old('date')?old('date'):$service->date}}" id="servicedate">
                        </div>
                        @if($errors->has('date'))
                            <div class="invalid-feedback" style="display:block;">{{$errors->first('date')}}</div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="arnumber">Upload pre-history</label>
                            <div class="custom-file">
                                <input type="file" name="pre_history" class="custom-file-input" id="customFileLang" lang="en">
                                <label class="custom-file-label" for="customFileLang">Select file</label>
                               {{-- @if($service['pre_history']!='')

                                    <img src="{{asset('public/assets/uploads/serviceprehistory').'/'.$service->pre_history}}"  style="width:20px;height:20px;margin-top: 10px;">
                                    <input type="checkbox" value="remove" name="pre_history"> Remove File
                                @endif
                                <a href="{{asset('public/assets/uploads/serviceprehistory').'/'.$service->pre_history}}" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>--}}
                            </div>
                        </div>
                    </div>

                </div><!-- /row -->
                <input type="hidden" name="id" value="{{$service->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Create service request</button>
                <button type="reset" class="btn btn-warning" onclick='location.href ="{{url('admin/service-request-list')}}"'>Cancel</button>
            </form>
        </div>
    </div>



@endsection
@section('after_script')

    <!-- Optional JS -->
    {{--<script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>--}}
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>





@endsection