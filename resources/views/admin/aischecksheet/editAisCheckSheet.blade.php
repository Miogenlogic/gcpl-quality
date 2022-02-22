@extends('admin.include.layout')
@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Edit AIS Checksheet</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit AIS Checksheet</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body')

    @php
        //print_r($servicerequest);
        //die;
    @endphp

    <!-- Project List -->
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{ url('/admin/save-ais')}}" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Sl_no</label>
                            <input type="text" name="sl_no" class="form-control" id="service" value="{{old('sl_no')?old('sl_no'):$servicerequest->sl_no}}" readonly>
                            @if($errors->has('sl_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('sl_no')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Job No</label>

                            <input type="text" name="customer" class="form-control" id="service" value="{{old('job_no')?old('job_no'):$servicerequest->job_no}}">
                            @if($errors->has('job_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('job_no')}}</div>
                            @endif



                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">customer</label>
                            <input type="text" name="customer" class="form-control" id="service" value="{{old('customer')?old('customer'):$servicerequest->customer}}" >
                            @if($errors->has('customer'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('customer')}}</div>
                            @endif
                        </div>
                    </div>



                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">branch</label>
                            <input type="text" name="branch" class="form-control" id="service" value="{{old('branch')?old('branch'):$servicerequest->branch}}" >
                            @if($errors->has('branch'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('branch')}}</div>
                            @endif
                        </div>
                    </div>




                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Component</label>
                            <input type="text" name="component" class="form-control" id="service" value="{{old('component')?old('component'):$servicerequest->component}}" >
                            @if($errors->has('component'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('component')}}</div>
                            @endif
                        </div>
                    </div>



                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Smu Hours</label>
                            <input type="text" name="smu_hours" class="form-control" id="service" value="{{old('smu_hours')?old('smu_hours'):$servicerequest->smu_hours}}" >
                            @if($errors->has('smu_hours'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('smu_hours')}}</div>
                            @endif
                        </div>
                    </div>




                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Model</label>
                            <input type="text" name="model" class="form-control" id="service" value="{{old('model')?old('model'):$servicerequest->model}}" >
                            @if($errors->has('model'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('model')}}</div>
                            @endif
                        </div>
                    </div>




                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Serial no</label>
                            <input type="text" name="serial_no" class="form-control" id="service" value="{{old('serial_no')?old('serial_no'):$servicerequest->serial_no}}" >
                            @if($errors->has('serial_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('serial_no')}}</div>
                            @endif
                        </div>
                    </div>




                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Dispatch date</label>
                            <input type="text" name="dispatch_date" class="form-control" id="service" value="{{old('dispatch_date')?old('dispatch_date'):$servicerequest->dispatch_date}}" >
                            @if($errors->has('dispatch_date'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('dispatch_date')}}</div>
                            @endif
                        </div>
                    </div>







                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Job done by</label>
                            <input type="text" name="job_done_by" class="form-control" id="service" value="{{old('job_done_by')?old('job_done_by'):$servicerequest->job_done_by}}" >
                            @if($errors->has('job_done_by'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('job_done_by')}}</div>
                            @endif
                        </div>
                    </div>




                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">business segment</label>
                            <input type="text" name="business_segment" class="form-control" id="service" value="{{old('	business_segment')?old('business_segment'):$servicerequest->business_segment}}" >
                            @if($errors->has('business_segment'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('business_segment')}}</div>
                            @endif
                        </div>
                    </div>



                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">complain_receive_date</label>
                            <input type="text" name="complain_receive_date" class="form-control" id="service" value="{{old('complain_receive_date')?old('complain_receive_date'):$servicerequest->complain_receive_date}}" >
                            @if($errors->has('complain_receive_date'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('complain_receive_date')}}</div>
                            @endif
                        </div>
                    </div>



                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">month</label>
                            <input type="text" name="month" class="form-control" id="service" value="{{old('month')?old('month'):$servicerequest->month}}" >
                            @if($errors->has('month'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('month')}}</div>
                            @endif
                        </div>
                    </div>




                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">customer complain</label>
                            <input type="text" name="customer_complain" class="form-control" id="service" value="{{old('customer_complain')?old('customer_complain'):$servicerequest->customer_complain}}" >
                            @if($errors->has('customer_complain'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('customer_complain')}}</div>
                            @endif
                        </div>
                    </div>



                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Response date</label>
                            <input type="text" name="response_date" class="form-control" id="service" value="{{old('response_date')?old('response_date'):$servicerequest->response_date}}" >
                            @if($errors->has('response_date'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('response_date')}}</div>
                            @endif
                        </div>
                    </div>



                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Attainded by</label>
                            <input type="text" name="attainded_by" class="form-control" id="service" value="{{old('attainded_by')?old('attainded_by'):$servicerequest->attainded_by}}" >
                            @if($errors->has('attainded_by'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('attainded_by')}}</div>
                            @endif
                        </div>
                    </div>




                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Completion Date</label>
                            <input type="text" name="completion_date" class="form-control" id="service" value="{{old('completion_date')?old('completion_date'):$servicerequest->completion_date}}" >
                            @if($errors->has('completion_date'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('completion_date')}}</div>
                            @endif
                        </div>
                    </div>



                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Root Cause</label>
                            <input type="text" name="root_cause" class="form-control" id="service" value="{{old('root_cause')?old('root_cause'):$servicerequest->root_cause}}" >
                            @if($errors->has('root_cause'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('root_cause')}}</div>
                            @endif
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Why(1)</label>
                            <input type="text" name="why_y1" class="form-control" id="service" value="{{old('why_y1')?old('why_y1'):$servicerequest->why_y1}}" >
                            @if($errors->has('why_y1'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('why_y1')}}</div>
                            @endif
                        </div>
                    </div>




                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Why(2)</label>
                            <input type="text" name="why_y2" class="form-control" id="service" value="{{old('why_y2')?old('why_y2'):$servicerequest->why_y2}}" >
                            @if($errors->has('why_y2'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('why_y2')}}</div>
                            @endif
                        </div>
                    </div>




                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Resolution</label>
                            <input type="text" name="resolution" class="form-control" id="service" value="{{old('resolution')?old('resolution'):$servicerequest->resolution}}" >
                            @if($errors->has('resolution'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('resolution')}}</div>
                            @endif
                        </div>
                    </div>




                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">type of problem</label>
                            <input type="text" name="type_of_problem" class="form-control" id="service" value="{{old('type_of_problem')?old('type_of_problem'):$servicerequest->type_of_problem}}" >
                            @if($errors->has('type_of_problem'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('type_of_problem')}}</div>
                            @endif
                        </div>
                    </div>






                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">condition details</label>
                            <input type="text" name="condition_details" class="form-control" id="service" value="{{old('condition_details')?old('condition_details'):$servicerequest->condition_details}}" >
                            @if($errors->has('condition_details'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('condition_details')}}</div>
                            @endif
                        </div>
                    </div>



                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Status</label>
                            <input type="text" name="status" class="form-control" id="service" value="{{old('status')?old('status'):$servicerequest->status}}" >
                            @if($errors->has('status'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('status')}}</div>
                            @endif
                        </div>
                    </div>






                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">Actual Resolution date</label>
                            <input type="text" name="actual_resolution_date" class="form-control" id="service" value="{{old('actual_resolution_date')?old('actual_resolution_date'):$servicerequest->actual_resolution_date}}" >
                            @if($errors->has('actual_resolution_date'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('actual_resolution_date')}}</div>
                            @endif
                        </div>
                    </div>





                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">area of problem</label>
                            <input type="text" name="area_of_problem" class="form-control" id="service" value="{{old('area_of_problem')?old('area_of_problem'):$servicerequest->area_of_problem}}" >
                            @if($errors->has('area_of_problem'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('area_of_problem')}}</div>
                            @endif
                        </div>
                    </div>



                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">

                            <label class="form-control-label" for="service">system</label>
                            <input type="text" name="system" class="form-control" id="service" value="{{old('system')?old('system'):$servicerequest->system}}" >
                            @if($errors->has('system'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('system')}}</div>
                            @endif
                        </div>
                    </div>
                </div>
                    <input type="hidden" name="id" value="{{$servicerequest->id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button class="btn btn-primary" type="submit">Edit</button>

                    <button type="reset" class="btn btn-warning" onclick='location.href ="{{url('admin/service-request-list')}}"'>Cancel</button>
            </form>

        </div>
    </div>




    </div>



@endsection
@section('after_script')

    <!-- Optional JS -->
    {{--<script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>--}}
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

    <script type="text/javascript">
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
    </script>


    <script type="text/javascript">
        /*component model no*/
        $('#machmodel').change(function(event) {
            var commodel = $(this).val();
            //alert(commodel);
            //console.log(model);

            $.ajax({

                url: '{{ url("/admin/component-model-list-show") }}',

                type: 'POST',

                data: {commodel:commodel,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {
                    //console.log(response);





                    $('.compmodel').show();

                    $('#compmodel').html(response);

                    $('.compserial').show();

                    $('#compserial').html(response);

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
    </script>


    <script type="text/javascript">
        /*component serial no*/
        $('#machmodel').change(function(event) {
            var coserial = $(this).val();
            //alert(coserial);
            //console.log(model);

            $.ajax({

                url: '{{ url("/admin/component-serial-list-show") }}',

                type: 'POST',

                data: {coserial:coserial,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {
                    //console.log(response);







                    $('.compserial').show();

                    $('#compserial').html(response);

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

    </script>



@endsection

