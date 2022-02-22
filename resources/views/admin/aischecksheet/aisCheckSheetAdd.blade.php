@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Create AisCheckSheet</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">New AisCheckSheet</li>
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
            <form method="post" action="{{url('admin/ais-add-save')}}" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">SL number</label>
                            <input type="text" name="sl_no" class="form-control" id="service" value="" >

                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Job Number</label>
                            <input type="text" name="job_no" class="form-control" id="customer" value="{{old('job_no')?old('job_no'):$masterjobno->job_no}}" readonly>
                            @if($errors->has('job_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('job_no')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Customer</label>
                            <input type="text" name="customer" class="form-control" id="customer" value="{{old('customer')?old('customer'):$masterais->customer}}" readonly>
                            @if($errors->has('customer'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('customer')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="model">branch</label>
                            <input type="text" name="branch" class="form-control" id="branch" value="" >
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="component_sl_no">component</label>
                            <input type="text" name="component" class="form-control" id="" placeholder="component" value="">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">smu(hours)</label>
                            <input type="text" name="smu_hours" class="form-control" id="" placeholder="smu_hours" value="">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label machserial" for="test_smu">model</label>
                            <textarea rows="2" cols="25"class="form-control" name="model" value="">
                            </textarea>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label compmodel" for="model">serial_no</label>
                            <input type="text" name="serial_no" class="form-control" id="" placeholder="serial_no" value="">

                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label compserial" for="serial">dispatch_date</label>
                            <input type="date" name="dispatch_date" class="form-control" id="" placeholder="dispatch_date" value="">

                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label compname" for="Component">job_done_by</label>
                            <textarea rows="2" cols="20"class="" name="job_done_by" value="job_done_by">
                            </textarea>
                        </div>
                    </div>



                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="root_cause_analysis">business_segment</label>
                            <input type="date" name="business_segment" class="form-control" id="" placeholder="business_segment" value="">

                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="why">complain_receive_date</label>
                            <input type="date" name="complain_receive_date" class="form-control" id="" placeholder="complain_receive_date" value="">


                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="solution">month</label>
                            <input type="date" name="month" class="form-control" id="" placeholder="month" value="">


                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="solution">customer_complain</label>
                            <input type="text" name="customer_complain" class="form-control" id="" placeholder="customer_complain" value="">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="impact">response_date</label>
                            <input type="text" name="response_date" class="form-control" id="" placeholder="response_date" value="">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="solution">attainded_by</label>
                            <input type="text" name="attainded_by" class="form-control" id="" placeholder="attainded_by" value="">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="solution">completion_date</label>
                            <input type="text" name="completion_date" class="form-control" id="" placeholder="completion_date" value="">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="solution">root_cause</label>
                            <input type="text" name="root_cause" class="form-control" id="" placeholder="root_cause" value="">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="solution">why_y1</label>
                            <input type="text" name="why_y1" class="form-control" id="" placeholder="why_y1" value="">
                        </div>
                    </div>

                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-control-label" for="solution">why_y2</label>
                        <input type="text" name="why_y2" class="form-control" id="" placeholder="why_y2" value="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-control-label" for="solution">resolution</label>
                        <input type="text" name="resolution" class="form-control" id="" placeholder="resolution" value="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-control-label" for="solution">type_of_problem</label>
                        <input type="text" name="type_of_problem" class="form-control" id="" placeholder="type_of_problem" value="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-control-label" for="solution">condition_details</label>
                        <input type="text" name="condition_details" class="form-control" id="" placeholder="condition_details" value="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-control-label" for="solution">status</label>
                        <input type="text" name="status" class="form-control" id="" placeholder="status" value="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-control-label" for="solution">actual_resolution_date</label>
                        <input type="date" name="actual_resolution_date" class="form-control" id="" placeholder="actual_resolution_date" value="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-control-label" for="solution">area_of_problem</label>
                        <input type="date" name="area_of_problem" class="form-control" id="" placeholder="area_of_problem" value="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-control-label" for="solution">system</label>
                        <input type="text" name="system" class="form-control" id="" placeholder="system" value="">
                    </div>
                </div>
        </div>



                <!-- /row -->
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Save</button>

                <button type="reset" class="btn btn-warning" onclick='location.href ="{{url('admin/service-request-list')}}"'>Cancel</button>
            </form>

        </div>

    </div>
    <!-- Project List -->




@endsection

