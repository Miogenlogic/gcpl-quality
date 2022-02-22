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
                <form action="{{url('admin/bis-test-report-save-trans-download/'.$serviceid['id'])}}" method="post">

                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <button class="btn" style="border: 1px dotted gray;"><i class="fa fa-download"> &nbsp;</i>Download Test Report In Excel</button>
                </form>

            </div>
        </div>

        <form method="post" action="{{url('admin/bis-test-report-save_trans')}}" enctype="multipart/form-data" style="margin-top: -70px;">

        <div class="card-body">
            <!-- Form groups used in grid  IMS/GCPL/CRC/ENG/ETR/15   10.05.2016  Engine Test Certificate -->
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
                <td style="width: 195px;" class="tab">Transmission Model :- </td>
                <td class="result"></td>

             </tr>
              <tr>
                <td class="tab">Customer Code:-</td>
                <td class="result">@if(!empty($customer[0]['customer_code'])) {{$customer[0]['customer_code']}} @endif</td>
                <td class="tab">Transmission Serial NO:-</td>
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

                    

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-control-label">RECORD & VERIFY PRESSURE</label>
                            <select name="recore[]" class="form-control" placeholder="RECORD & VERIFY PRESSURE" required>
                                
                                <option value="">Select</option>
                                <option value="TORQUE CONVERTOR  PRESSURE  INLET (P3)" {{ ($report['record'] == 'TORQUE CONVERTOR  PRESSURE  INLET (P3)' ? "selected":"") }}> TORQUE CONVERTOR  PRESSURE  INLET (P3)</option>
                                <option value="TORQUE CONVERTOR PRESSURE OUTLET" {{ ($report['record'] == 'TORQUE CONVERTOR PRESSURE OUTLET' ? "selected":"") }}> TORQUE CONVERTOR PRESSURE OUTLET</option>
                                <option value="TRANSMISSION LUBE PRESSURE(LI)" {{ ($report['record'] == 'TRANSMISSION LUBE PRESSURE(LI)' ? "selected":"") }}>TRANSMISSION LUBE PRESSURE(LI)</option>
                                <option value="TRANSMISSION LUBE PRESSURE(HI)" {{ ($report['record'] == 'TRANSMISSION LUBE PRESSURE(HI)' ? "selected":"") }}>TRANSMISSION LUBE PRESSURE(HI)</option>
                                <option value="TRANSMISSION OIL PUMP PRESSURE" {{ ($report['record'] == 'TRANSMISSION OIL PUMP PRESSURE' ? "selected":"") }}>TRANSMISSION OIL PUMP PRESSURE</option>
                                <option value="TRANSMISSION CLUTCH PRESSURE" {{ ($report['record'] == 'TRANSMISSION CLUTCH PRESSURE' ? "selected":"") }}>TRANSMISSION CLUTCH PRESSURE</option>
                                <option value="PARKING BRAKE AIR PRESSURE" {{ ($report['record'] == 'PARKING BRAKE AIR PRESSURE' ? "selected":"") }}>PARKING BRAKE AIR PRESSURE</option>
                                <option value="TRANSMISSION PILOT PRESSURE" {{ ($report['record'] == 'TRANSMISSION PILOT PRESSURE' ? "selected":"") }}>TRANSMISSION PILOT PRESSURE</option>
                                
                            </select>
                            
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-control-label">DATA TYPE</label>
                            <select name="datatype[]" class="form-control" placeholder="DATA TYPE<" required>
                                
                                <option value="">Select</option>
                                <option value="REFER SIS" {{ ($report['datatype'] == 'REFER SIS' ? "selected":"") }} >REFER SIS</option>
                                <option value="AT LOW IDLE" {{ ($report['datatype'] == 'AT LOW IDLE' ? "selected":"") }}>AT LOW IDLE</option>
                                <option value="AT HIGH IDLE" {{ ($report['datatype'] == 'AT HIGH IDLE' ? "selected":"") }}>AT HIGH IDLE</option>
                                <option value="REFCHECK ( REFER SIS)" {{ ($report['datatype'] == 'REFCHECK ( REFER SIS)' ? "selected":"") }}>CHECK ( REFER SIS)</option>
                                <option value="CLUTCH 1 (A)" {{ ($report['datatype'] == 'CLUTCH 1 (A)' ? "selected":"") }}>CLUTCH 1 (A)</option>
                                <option value="CLUTCH 2(B)" {{ ($report['datatype'] == 'CLUTCH 2(B)' ? "selected":"") }}>CLUTCH 2(B)</option>
                                <option value="CLUTCH 3 (C)" {{ ($report['datatype'] == 'CLUTCH 3 (C)' ? "selected":"") }}>CLUTCH 3 (C)</option>
                                <option value="CLUTCH 4 (D)" {{ ($report['datatype'] == 'CLUTCH 4 (D)S' ? "selected":"") }}>CLUTCH 4 (D)</option>
                                <option value="CLUTCH 5 (E)" {{ ($report['datatype'] == 'CLUTCH 5 (E)' ? "selected":"") }}>CLUTCH 5 (E)</option>
                                <option value="CLUTCH 6 (F)" {{ ($report['datatype'] == 'CLUTCH 6 (F)' ? "selected":"") }}>CLUTCH 6 (F)</option>
                                <option value="CLUTCH 7 (G)" {{ ($report['datatype'] == 'CLUTCH 7 (G)' ? "selected":"") }}>CLUTCH 7 (G)</option>
                                <option value="CLUTCH 8(H)" {{ ($report['datatype'] == 'CLUTCH 8(H)' ? "selected":"") }}>CLUTCH 8(H)</option>                                
                            </select>
                            
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-control-label">STANDARD VALUE</label>
                            <input type="text" name="standard[]" class="form-control" placeholder="STANDARD VALUE" value="{{$report['standard']}}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-control-label">ACTUAL</label>
                            <input type="text" name="actual[]" class="form-control" placeholder="ACTUAL" value="{{$report['actual']}}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-control-label">REMARKS</label>
                            <input type="text" name="remarks[]" class="form-control" placeholder="REMARKS" value="{{$report['remarks']}}" required>
                        </div>
                    </div>

                    
           
                </div>

                @endforeach
                @else

                <div class="row no-gutters block-section">

                    

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-control-label">RECORD & VERIFY PRESSURE</label>
                            <select name="recore[]" class="form-control" placeholder="RECORD & VERIFY PRESSURE" required>
                                
                                <option value="">Select</option>
                                <option value="TORQUE CONVERTOR  PRESSURE  INLET (P3)"> TORQUE CONVERTOR  PRESSURE  INLET (P3)</option>
                                <option value="TORQUE CONVERTOR PRESSURE OUTLET"> TORQUE CONVERTOR PRESSURE OUTLET</option>
                                <option value="TRANSMISSION LUBE PRESSURE(LI)">TRANSMISSION LUBE PRESSURE(LI)</option>
                                <option value="TRANSMISSION LUBE PRESSURE(HI)">TRANSMISSION LUBE PRESSURE(HI)</option>
                                <option value="TRANSMISSION OIL PUMP PRESSURE">TRANSMISSION OIL PUMP PRESSURE</option>
                                <option value="TRANSMISSION CLUTCH PRESSURE">TRANSMISSION CLUTCH PRESSURE</option>
                                <option value="PARKING BRAKE AIR PRESSURE">PARKING BRAKE AIR PRESSURE</option>
                                <option value="TRANSMISSION PILOT PRESSURE">TRANSMISSION PILOT PRESSURE</option>
                                
                            </select>
                            
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-control-label">DATA TYPE</label>
                            <select name="datatype[]" class="form-control" placeholder="DATA TYPE<" required>
                                
                                <option value="">Select</option>
                                <option value="REFER SIS">REFER SIS</option>
                                <option value="AT LOW IDLE">AT LOW IDLE</option>
                                <option value="AT HIGH IDLE">AT HIGH IDLE</option>
                                <option value="REFCHECK ( REFER SIS)">CHECK ( REFER SIS)</option>
                                <option value="CLUTCH 1 (A)">CLUTCH 1 (A)</option>
                                <option value="CLUTCH 2(B)">CLUTCH 2(B)</option>
                                <option value="CLUTCH 3 (C)">CLUTCH 3 (C)</option>
                                <option value="CLUTCH 4 (D)">CLUTCH 4 (D)</option>
                                <option value="CLUTCH 5 (E)">CLUTCH 5 (E)</option>
                                <option value="CLUTCH 6 (F)">CLUTCH 6 (F)</option>
                                <option value="CLUTCH 7 (G)">CLUTCH 7 (G)</option>
                                <option value="CLUTCH 8(H)">CLUTCH 8(H)</option>                                
                            </select>
                            
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-control-label">STANDARD VALUE</label>
                            <input type="text" name="standard[]" class="form-control" placeholder="STANDARD VALUE" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-control-label">ACTUAL</label>
                            <input type="text" name="actual[]" class="form-control" placeholder="ACTUAL" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-control-label">REMARKS</label>
                            <input type="text" name="remarks[]" class="form-control" placeholder="REMARKS" required>
                        </div>
                    </div>

           
                </div>
                @endif

            </div>
            <div class="row">

                 <div class="col-md-5" style="margin-top: 10px">
                    <label>Signature of Test Engineer : </label>
                    <input type="text" class="form-control" name="signature" value="@if(!empty($reportdata[0]['signature_test_engineer'])) {{$reportdata[0]['signature_test_engineer'] }} @endif" required>
                 </div>
                 
                 <div class="col-md-2" ></div>

                  <div class="col-md-5" style="margin-top: 10px">
                    <label>Authorized Signature : </label>
                    <input type="text" class="form-control" name="authorize_signature" value="@if(!empty($reportdata[0]['authorized_signature'])) {{$reportdata[0]['authorized_signature'] }} @endif" required>
                 </div>
             </div>
             <div class="row">
                
                 <div class="col-md-5" style="margin-top: 10px">
                    <label>Start Date : </label>
                    <input type="text" class="form-control" name="start_date" id="actualdate11"  value="@if(!empty($reportdata[0]['start_date'])) {{$reportdata[0]['start_date'] }} @endif" required>
                 </div>

                  <div class="col-md-2" ></div>

                  <div class="col-md-5" style="margin-top: 10px">
                    <label>End Date : </label>
                    <input type="text" class="form-control" name="end_date" id="actualdate22"  value="@if(!empty($reportdata[0]['end_date'])) {{$reportdata[0]['end_date'] }} @endif" required>
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
    $('#actualdate11').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    orientation: "down",
    endDate: "today"

    });

    $('#actualdate22').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        orientation: "down",
        endDate: "today"

    });
    </script>


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

                

                '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="" class="form-control-label">RECORD & VERIFY PRESSURE</label>'+
                            '<select name="recore[]" class="form-control" placeholder="RECORD & VERIFY PRESSURE" required>'+
                                
                                '<option value="">Select</option>'+
                                '<option value="TORQUE CONVERTOR  PRESSURE  INLET (P3)"> TORQUE CONVERTOR  PRESSURE  INLET (P3)</option>'+
                                '<option value="TORQUE CONVERTOR PRESSURE OUTLET"> TORQUE CONVERTOR PRESSURE OUTLET</option>'+
                                '<option value="TRANSMISSION LUBE PRESSURE(LI)">TRANSMISSION LUBE PRESSURE(LI)</option>'+
                                '<option value="TRANSMISSION LUBE PRESSURE(HI)">TRANSMISSION LUBE PRESSURE(HI)</option>'+
                                '<option value="TRANSMISSION OIL PUMP PRESSURE">TRANSMISSION OIL PUMP PRESSURE</option>'+
                                '<option value="TRANSMISSION CLUTCH PRESSURE">TRANSMISSION CLUTCH PRESSURE</option>'+
                                '<option value="PARKING BRAKE AIR PRESSURE">PARKING BRAKE AIR PRESSURE</option>'+
                                '<option value="TRANSMISSION PILOT PRESSURE">TRANSMISSION PILOT PRESSURE</option>'+
                                
                            '</select>'+
                        '</div>'+
                '</div>'+

                '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="" class="form-control-label">DATA TYPE</label>'+
                            '<select name="datatype[]" class="form-control" placeholder="DATA TYPE<" required>'+
                                '<option value="">Select</option>'+
                                '<option value="REFER SIS">REFER SIS</option>'+
                                '<option value="AT LOW IDLE">AT LOW IDLE</option>'+
                                '<option value="AT HIGH IDLE">AT HIGH IDLE</option>'+
                                '<option value="REFCHECK ( REFER SIS)">CHECK ( REFER SIS)</option>'+
                                '<option value="CLUTCH 1 (A)">CLUTCH 1 (A)</option>'+
                                '<option value="CLUTCH 2(B)">CLUTCH 2(B)</option>'+
                                '<option value="CLUTCH 3 (C)">CLUTCH 3 (C)</option>'+
                                '<option value="CLUTCH 4 (D)">CLUTCH 4 (D)</option>'+
                                '<option value="CLUTCH 5 (E)">CLUTCH 5 (E)</option>'+
                                '<option value="CLUTCH 6 (F)">CLUTCH 6 (F)</option>'+
                                '<option value="CLUTCH 7 (G)">CLUTCH 7 (G)</option>'+
                                '<option value="CLUTCH 8(H)">CLUTCH 8(H)</option>'+                                
                            '</select>'+
                            
                        '</div>'+
                '</div>'+

                '<div class="col-md-4">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">STANDARD VALUE</label>'+
                        '<input type="text" name="standard[]" class="form-control" placeholder="STANDARD VALUE" required>'+
                    '</div>'+
                '</div>'+

                '<div class="col-md-4">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">ACTUAL</label>'+
                        '<input type="text" name="actual[]" class="form-control" placeholder="ACTUAL" required>'+
                    '</div>'+
                '</div>'+

                '<div class="col-md-4">'+
                    '<div class="form-group">'+
                        '<label for="" class="form-control-label">REMARKS</label>'+
                        '<input type="text" name="remarks[]" class="form-control" placeholder="REMARKS" required>'+
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

