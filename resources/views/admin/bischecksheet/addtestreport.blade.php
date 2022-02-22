@extends('admin.include.layout')
@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Test Report</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add BIS Test Report</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

<style type="text/css">
    td.tab {
    padding: 9px;
    font-weight: bold;
}
th.mtable {
    font-size: 10px;
    text-align: center;
}
.result{ text-align: center; }
.form-control-label {
    font-size: 13px !important;
    font-weight: 500 !important;
    color: #000000 !important;
}
.block-section{ border: 1px solid #aeb5ae; padding: 8px;border-radius: 13px; margin-top: 12px;}
.remove {margin-top: 27px;
    float: right !important;
    margin-left: 186px;}
</style>

@section('body')

    @php
     //echo'<pre>'; print_r($serviceid['work_orderno']);die;
      
	 // $bischeck=App\Helpers\UserHelper::bis();
    @endphp

    <!-- Project List -->
    <div class="card mb-4">

        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div>
            <div style="float: right">
                <form action="{{url('admin/bis-test-report-save-download/'.$serviceid['id'])}}" method="post">

                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <button class="btn" style="border: 1px dotted gray;"><i class="fa fa-download"> &nbsp;</i>Download Test Report In Excel</button>
                </form>

            </div>
        </div>

        <form method="post" action="{{url('admin/bis-test-report-save')}}" enctype="multipart/form-data" style="margin-top: -70px;">

        <div class="card-body">
            <!-- Form groups used in grid -->

            <div class="row">
                <div class="col-md-7">
                    <div style="margin-bottom: 10px; font-weight: bold; font-family: initial; font-size: 17px;">
                        <div class="row">    
                            <div class="col-md-3">Doc. No. – </div><div class="col-md-8"><input type="text" name="docNo" class="form-control" value="@if(!empty($serviceid['doc_no'])) {{$serviceid['doc_no']}} @endif"> </div>  </br> 
                        </div>
                        <div class="row">   
                             <div class="col-md-3">Issued On – </div><div class="col-md-8"><input type="text" name="issuedOn" class="form-control" value="@if(!empty($serviceid['issued_on'])) {{$serviceid['issued_on']}} @endif"> </div>             
                        </div>    
                    </div>
                </div>
            </div>    

            <table border = "1" width="100%">
             
             <tr>
                <td style="width: 195px;" class="tab">Job No :-</td>
                <td style="width: 195px;" class="result">@if(!empty($serviceid['work_orderno'])) {{$serviceid['work_orderno']}} @endif</td>
                <td rowspan = "4" style="width: 150px;"></td>
                <td style="width: 195px;" class="tab">Engine Model :- </td>
                <td class="result"></td>

             </tr>
              <tr>
                <td class="tab">Customer Code:-</td>
                <td class="result">@if(!empty($customer[0]['customer_code'])) {{$customer[0]['customer_code']}} @endif</td>
                <td class="tab">Engine Serial NO:-</td>
                <td class="result"></td>
             </tr>
              <tr>
                <td class="tab">Customer Name:-</td>
                <td class="result">@if(!empty($customer[0]['name'])) {{$customer[0]['name']}} @endif</td>
                <td class="tab">Machine Model  :- </td>
                <td class="result">@if(!empty($modelno[0]->model_no)) {{$modelno[0]->model_no}} @endif</td>
             </tr>
              <tr>
                <td class="tab">Test Date  :-</td>
                <td class="result"></td>
                <td class="tab">Machine Serial No :- </td>
                <td class="result"> @if(!empty($compsl[0]['comp_serial_no'])) {{$compsl[0]['comp_serial_no'] }} @endif</td>
             </tr>
            
          </table>

        <!-- <table border = "1" style="margin-top: 40px">
             <tr>
                <th class="mtable">SPEED RPM.</th>
                <th class="mtable">TORQUE ( ft-lbs )</th>
                <th class="mtable">Power (HP )</th>
                <th class="mtable">LOAD IN %</th>
                <th class="mtable">OIL PR.  (PSI )</th>
                <th class="mtable">FUEL PRESSURE(PSI)</th>
                <th class="mtable">FUEL RAIL PR. (PSI)  OR ACTUATION PR.(PSI)</th>
                <th class="mtable">BOOST PR. (PSI)</th>
                <th class="mtable">OIL TEMP.DEG. (F)</th>
                <th class="mtable">OUT LET WATER TEMP. DEG. (F)</th>
                <th class="mtable">INLET AIR TEMP. DEG.(F)</th>
                <th class="mtable">EXAHSUT TEMP. DEG. (F) LEFT BANK</th>
                <th class="mtable">EXAHSUT TEMP. DEG. (F) RIGHT BANK</th>
                <th class="mtable">BLOW BY RATE IN CU.FT/HR</th>
             </tr>
             <tr>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>
                <td><input type="text" name="" class="form-control" placeholder=""></td>

             </tr>
             
        </table> -->

        @if(count($reportdata)==0)
        <div class="row">
            <div class="col-md-12">

                    <div class="col-auto" style="float: right; margin-top: 10px;">
                    <a href="javascript:void(0);" class="btn btn-default add-report">ADD MORE+</a>
                   </div>

            </div>
        </div>
        @endif

       

            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="service_id" value="{{$checkgate->id}}">
            <input type="hidden" name="job_no" value="{{$serviceid['work_orderno']}}">
            <input type="hidden" name="customer_code" value="{{$customer[0]['customer_code']}}">
            <input type="hidden" name="customer_name" value="{{$customer[0]['name']}}">


            <div class="report-block">

                @if($reportdata!=null && count($reportdata)!=0)
                @foreach($reportdata as $report)

                <div class="row no-gutters block-section">

                    

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">SPEED RPM.</label>
                            <input type="text" name="speed[]" class="form-control" placeholder="SPEED RPM." value="{{$report['speed_rpm']}}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">TORQUE ( ft-lbs )</label>
                            <input type="text" name="torque[]" class="form-control" placeholder="TORQUE ( ft-lbs )"  value="{{$report['torque']}}" required>
                            
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">Power (HP )</label>
                            <input type="text" name="power[]" class="form-control" placeholder="Power (HP )" value="{{$report['power']}}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">LOAD IN %</label>
                            <input type="text" name="loadin[]" class="form-control" placeholder="LOAD IN %" value="{{$report['load_in']}}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">OIL PR.  (PSI )</label>
                            <input type="text" name="oilpr[]" class="form-control" placeholder="OIL PR.  (PSI )" value="{{$report['oil_pr']}}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">FUEL PRESSURE(PSI)</label>
                            <input type="text" name="fuelpresure[]" class="form-control" placeholder="FUEL PRESSURE(PSI)" value="{{$report['fuel_pressure']}}" required>
                            
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">FUEL RAIL PR. (PSI)</label>
                            <input type="text" name="fuelrail[]" class="form-control" placeholder="FUEL RAIL PR. (PSI)  OR ACTUATION PR.(PSI)" value="{{$report['fuel_rail_pr']}}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">BOOST PR. (PSI)</label>
                            <input type="text" name="boost[]" class="form-control" placeholder="BOOST PR. (PSI)" value="{{$report['boost_pr']}}" required>
                        </div>
                    </div>




                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">OIL TEMP.DEG. (F)</label>
                            <input type="text" name="oiltemp[]" class="form-control" placeholder="OIL TEMP.DEG. (F)"  value="{{$report['oil_temp_deg']}}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">OUT LET WATER TEMP. DEG. (F)</label>
                            <input type="text" name="outletwater[]" class="form-control" placeholder="OUT LET WATER TEMP. DEG. (F)"  value="{{$report['out_let_water']}}" required>
                            
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">INLET AIR TEMP. DEG.(F)</label>
                            <input type="text" name="inletairtemp[]" class="form-control" placeholder="INLET AIR TEMP. DEG.(F)" value="{{$report['in_let_air_temp']}}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">EXAHSUT TEMP. DEG. (F) LEFT BANK</label>
                            <input type="text" name="exahsuttempleft[]" class="form-control" placeholder="EXAHSUT TEMP. DEG. (F) LEFT BANK" value="{{$report['exahsut_temp_left_bank']}}" required>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">EXAHSUT TEMP. DEG. (F) RIGHT BANK</label>
                            <input type="text" name="exahsuttempright[]" class="form-control" placeholder="EXAHSUT TEMP. DEG. (F) RIGHT BANK" value="{{$report['exahsut_temp_right_bank']}}"  required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">BLOW BY RATE IN CU.FT/HR</label>
                            <input type="text" name="blowbyrate[]" class="form-control" placeholder="BLOW BY RATE IN CU.FT/HR" value="{{$report['blow_by_rate']}}"  required>
                        </div>
                    </div>
           
                </div>

                @endforeach
                @else

                <div class="row no-gutters block-section">

                    

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">SPEED RPM.</label>
                            <input type="text" name="speed[]" class="form-control" placeholder="SPEED RPM." required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">TORQUE ( ft-lbs )</label>
                            <input type="text" name="torque[]" class="form-control" placeholder="TORQUE ( ft-lbs )" required>
                            
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">Power (HP )</label>
                            <input type="text" name="power[]" class="form-control" placeholder="Power (HP )" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">LOAD IN %</label>
                            <input type="text" name="loadin[]" class="form-control" placeholder="LOAD IN %" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">OIL PR.  (PSI )</label>
                            <input type="text" name="oilpr[]" class="form-control" placeholder="OIL PR.  (PSI )" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">FUEL PRESSURE(PSI)</label>
                            <input type="text" name="fuelpresure[]" class="form-control" placeholder="FUEL PRESSURE(PSI)" required>
                            
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">FUEL RAIL PR. (PSI)</label>
                            <input type="text" name="fuelrail[]" class="form-control" placeholder="FUEL RAIL PR. (PSI)  OR ACTUATION PR.(PSI)" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">BOOST PR. (PSI)</label>
                            <input type="text" name="boost[]" class="form-control" placeholder="BOOST PR. (PSI)" required>
                        </div>
                    </div>




                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">OIL TEMP.DEG. (F)</label>
                            <input type="text" name="oiltemp[]" class="form-control" placeholder="OIL TEMP.DEG. (F)" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">OUT LET WATER TEMP. DEG. (F)</label>
                            <input type="text" name="outletwater[]" class="form-control" placeholder="OUT LET WATER TEMP. DEG. (F)" required>
                            
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">INLET AIR TEMP. DEG.(F)</label>
                            <input type="text" name="inletairtemp[]" class="form-control" placeholder="INLET AIR TEMP. DEG.(F)" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">EXAHSUT TEMP. DEG. (F) LEFT BANK</label>
                            <input type="text" name="exahsuttempleft[]" class="form-control" placeholder="EXAHSUT TEMP. DEG. (F) LEFT BANK" required>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">EXAHSUT TEMP. DEG. (F) RIGHT BANK</label>
                            <input type="text" name="exahsuttempright[]" class="form-control" placeholder="EXAHSUT TEMP. DEG. (F) RIGHT BANK" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-control-label">BLOW BY RATE IN CU.FT/HR</label>
                            <input type="text" name="blowbyrate[]" class="form-control" placeholder="BLOW BY RATE IN CU.FT/HR" required>
                        </div>
                    </div>
           
                </div>
                @endif

            </div>
            <div class="row">
                 <div class="col-md-5" style="margin-top: 10px">
                    <label>Remarks if Any : </label>
                    <input type="text" class="form-control" name="remarks" value="@if(!empty($reportdata[0]['remarks'])) {{$reportdata[0]['remarks'] }} @endif">
                 </div>
                 <div class="col-md-2" ></div>

                  <div class="col-md-5" style="margin-top: 10px">
                    <label>Authorized Signature : </label>
                    <input type="text" class="form-control" name="authorize_signature" value="@if(!empty($reportdata[0]['authorized_signature'])) {{$reportdata[0]['authorized_signature'] }} @endif" required>
                 </div>
             </div>
             <div class="row">
                
                  <div class="col-md-5" style="margin-top: 10px">
                    <label>Signature of Test Engineer : </label>
                    <input type="text" class="form-control" name="signature" value="@if(!empty($reportdata[0]['signature_test_engineer'])) {{$reportdata[0]['signature_test_engineer'] }} @endif" required>
                 </div>
             </div>
      
            <button class="btn btn-primary" type="submit" style="margin-top: 10px">Save</button>

        </form>    

           
    </div>




@endsection
@section('after_script')

    <!-- Optional JS -->
    {{--<script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>--}}
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

    <script type="text/javascript">
                $(document).ready(function(){
                    var maxField = 5; //Input fields increment limitation
                    var addButton = $('.add-report'); //Add button selector
                    var wrapper = $('.report-block'); //Input field wrapper

                    //alert(countafterfield);
                    //New input field html
                    var x = 0;
                    var FieldCount=0;
                    var countidlrclear =$('#countbushinspmea').val();

                    if(countidlrclear !== null){
                        x = countidlrclear -1;
                        FieldCount =countidlrclear -1;
                    }
                    if(isNaN (countidlrclear) ){
                        x = 0;
                        FieldCount=0;
                    }
                    console.log(x)
                    //Once add button is clicked
                    $(addButton).click(function(){

                        if(x <= maxField) //max input box allowed
                        {
                            FieldCount++; //text box added increment
                            //add input box
                            $(wrapper).append('<div class="row no-gutters block-section">'+

                

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">SPEED RPM.</label>'+
                        '<input type="text" name="speed[]" class="form-control" placeholder="SPEED RPM." required>'+
                    '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">TORQUE ( ft-lbs )</label>'+
                        '<input type="text" name="torque[]" class="form-control" placeholder="TORQUE ( ft-lbs )" required>'+
                        
                    '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">Power (HP )</label>'+
                        '<input type="text" name="power[]" class="form-control" placeholder="Power (HP )">'+
                    '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">LOAD IN %</label>'+
                        '<input type="text" name="loadin[]" class="form-control" placeholder="LOAD IN" required> '+
                    '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">OIL PR.  (PSI )</label>'+
                        '<input type="text" name="oilpr[]" class="form-control" placeholder="OIL PR.  (PSI )" required>'+
                    '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">FUEL PRESSURE(PSI)</label>'+
                        '<input type="text" name="fuelpresure[]" class="form-control" placeholder="FUEL PRESSURE(PSI)" required>'+
                        
                    '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                       '<label for="" class="form-control-label">FUEL RAIL PR. (PSI)</label>'+
                        '<input type="text" name="fuelrail[]" class="form-control" placeholder="FUEL RAIL PR. (PSI)  OR ACTUATION PR.(PSI)" required>'+
                    '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">BOOST PR. (PSI)</label>'+
                        '<input type="text" name="boost[]" class="form-control" placeholder="BOOST PR. (PSI)" required>'+
                    '</div>'+
                '</div>'+




                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">OIL TEMP.DEG. (F)</label>'+
                        '<input type="text" name="oiltemp[]" class="form-control" placeholder="OIL TEMP.DEG. (F)" required>'+
                    '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">OUT LET WATER TEMP. DEG. (F)</label>'+
                        '<input type="text" name="outletwater[]" class="form-control" placeholder="OUT LET WATER TEMP. DEG. (F)" required>'+
                        
                    '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">INLET AIR TEMP. DEG.(F)</label>'+
                        '<input type="text" name="inletairtemp[]" class="form-control" placeholder="INLET AIR TEMP. DEG.(F)" required>'+
                    '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">EXAHSUT TEMP. DEG. (F) LEFT BANK</label>'+
                        '<input type="text" name="exahsuttempleft[]" class="form-control" placeholder="EXAHSUT TEMP. DEG. (F) LEFT BANK" required>'+
                    '</div>'+
                '</div>'+


                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">EXAHSUT TEMP. DEG. (F) RIGHT BANK</label>'+
                        '<input type="text" name="exahsuttempright[]" class="form-control" placeholder="EXAHSUT TEMP. DEG. (F) RIGHT BANK" required>'+
                    '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                       '<label for="" class="form-control-label">BLOW BY RATE IN CU.FT/HR</label>'+
                        '<input type="text" name="blowbyrate[]" class="form-control" placeholder="BLOW BY RATE IN CU.FT/HR" required>'+
                    '</div>'+
                '</div>'+

                
                    '<div class="col-auto remove">'+
                    '<a href="javascript:void(0);" class="btn btn-danger remove_button">Remove Block -</a>'+
                    '</div>'+

                
       
            '</div>');

                            x++; //text box increment
                        }
                        return false;

                        $(wrapper).on("click",".remove_button", function(e){ //user click on remove text
                            console.log(x);
                            if( x > 1 ) {
                                console.log(x);
                                $(this).parent('div').remove(); //remove text box
                                x--; //decrement textbox
                            }
                            return false;
                        })


                    });
                    //$('.select2').select2();
                    //Once remove button is clicked
                    $(wrapper).on('click', '.remove_button', function(e){
                        e.preventDefault();
                        $(this).parent().parent().remove(); //Remove field html
                        x--; //Decrement field counter
                    });
                });


            </script>


@endsection

