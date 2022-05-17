@extends('admin.include.layout')
<!-- Project List -->

@section('head')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">MOR</h6>
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
            <h3 class="mb-0">MOR</h3>
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

            <form method="post" id="assigntomor" action="{{url('admin/mor-assign-save')}}" enctype="multipart/form-data">


                            <div class="morassign">
                                @php
                                    //echo '<pre>';print_r($subwork);exit;
                                @endphp
                                @if($subwork!=null && count($subwork)!=0 )
                                    @php

                                        $row = 2;
                                    @endphp
                                    @foreach($subwork as $subworkshow)

                                    <div class="row">


                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Sub WorkOrder No </label>
                                                <input type="text" name="subwork[]" class="form-control" placeholder="QTY"  id="subwork{{$row}}" value="{{$subworkshow->subworkorder}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label class="form-control-label">Assign To Department</label>
                                                <select class="form-control"  name="department[]" id="dept">
                                                    <option selected="selected">Select </option>
                                                     @if(!empty($deptnme)){
                                                        @foreach($deptnme as $pred){


                                                        {{--<option value="{{$pred['id']}}">{{$pred['name']}}</option>--}}
                                                        <option value="{{$pred['id']}}" {{(old('department')!=$subworkshow->department)?($pred['id']==$subworkshow->department)?'selected=selected':'': 'selected=selected'}}>{{$pred['name']}}</option>
                                                        @endforeach
                                                      @endif
                                                </select>
                                            </div>
                                        </div>

                                            @if($row <=2 )
                                                <div class="col-auto">
                                                    <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                </div>
                                            @else
                                                <div class="col-auto">
                                                    <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                </div>
                                            @endif


                                    </div>

                                        @php
                                            $row++;
                                        @endphp
                                    @endforeach

                               @else
                                    <div class="row">


                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Sub WorkOrder No </label>
                                                <input type="text" name="subwork[]" class="form-control" placeholder="QTY"  id="subwork" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label class="form-control-label">Assign To Department</label>
                                                <select class="form-control"  name="department[]" id="dept">
                                                    <option selected="selected">Select </option>
                                                    <?php if(!empty($deptnme)){
                                                    foreach($deptnme as $pred){
                                                    ?>
                                                    <option value="<?php echo $pred['id']; ?>"><?php echo $pred['name']; ?></option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-auto">
                                            <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                        </div>
                                    </div>


                                 @endif



                            </div>
							<div class="col-md-3">
                    <div class="form-group">
                        <label class="form-control-label" for="date-of-dispatch">Mor Start Date</label>
                        @if(isset($pdiadd->mor_date))
                            @if(DateTime::createFromFormat('Y-m-d', $pdiadd->mor_date) !== FALSE)
                                <input type="text" name="mor_date" class="form-control" id="" placeholder="Date" value=" {{ date('d/m/Y', strtotime($pdiadd->mor_date))}}" readonly>
                            @else
                                <input type="text" name="mor_date" class="form-control" id="date-of-dispatch" placeholder="Date" value="{{$pdiadd->mor_date}}" readonly>
                            @endif
                        @else
                            <input type="text" name="mor_date" class=" form-control" id="mordate" placeholder="Date" value="" required>
                        @endif

                    </div>
                </div>

                <input type="hidden" name="work_order" value="{{$pdiadd->work_orderno}}">
                <input type="hidden" name="service_id" value="{{$pdiadd->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <button class="btn btn-primary" onclick="morassignclick();" id="morassignsubmit" type="submit">Submit</button>



            </form>
        </div>
    </div>



@endsection

@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>
<script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.morassign'); //Input field wrapper
            //New input field html
            var x = 1;
            var FieldCount=1;
            var text = "";
            var possible = "0123456789";
            var r=2;
            //Once add button is clicked
           $(addButton).click(function(){


                if(x <= maxField) //max input box allowed
                {
                    FieldCount++; //text box added increment
                    //add input box
                    $(wrapper).append('<div class="row">'+
                        '<div class="col">'+
                    '<div class="form-group">'+
                    '<label for="" class="form-control-label">Sub WorkOrder No </label>'+
                    '<input type="text" name="subwork[]" id="subwork1'+ FieldCount +'" class="form-control" placeholder="QTY" readonly>'+
                    '</div>'+
                    '</div>'+
                        '<div class="col-md-6 ">'+

                     '<div class="form-group">'+
                    '<label for="question">Assign To Department</label>'+
                  '<select class="form-control" name="department[]" id="dept">'+
                    '<option selected="selected">Select </option>'+

                    ' @if(!empty($deptnme))'+
                    ' @foreach($deptnme as $pred)'+

                    '<option value="{{$pred['id']}}">{{$pred['name']}}</option>'+
                      ' @endforeach ' +
                        ' @endif ' +

                    '</select>'+
                    '</div>'+
                            '</div>'+

                        '<div class="col-auto">'+
                        '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                        '</div>'+
                        '</div>');

                    x++; //text box increment
                    console.log(x)
                    text="";

                    for (var i = 0; i < 4; i++)
                        text += possible.charAt(Math.floor(Math.random() * possible.length));
                    $("#subwork1"+r).val({{$pdiadd->work_orderno}}+'-' + (text));
                    r++;
                    console.log(r)
                    return text;


                }
                return false;



                // $(wrapper).on("click",".remove_button", function(e){ //user click on remove text
                //     console.log(x);
                //     if( x > 1 ) {
                //         console.log(x);
                //         $(this).parent().parent().remove(); //remove text box
                //         x--; //decrement textbox
                //     }
                //     return false;
                // })


            });
          
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });

            console.log("rim")
            console.log(x)
                //alert("hii");
                
            
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

                // function generateRandomString(length) {
                var text = "";
                var possible = "0123456789";

                for (var i = 0; i < 4; i++)
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                $("#subwork").val({{$pdiadd->work_orderno}}+'-'+(text));
                return text;
                console.log(text)

        });
		
		 $('#mordate').datepicker({


            format: "dd/mm/yyyy",
            autoclose: true,
            //startDate: new Date('2019-12-5'),
            endDate: "today",
        });
       

    </script>


@endsection
