{{--@extends('admin.include.layout')--}}
<!-- Project List -->


{{--@section('head')--}}



{{--@endsection--}}

{{--@section('body')--}}
    <html>
    <head>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
        <script type="text/javascript">

            $(document).ready(function() {

                $("#gpdf").click(function() {
                    let doc = new jsPDF('p', 'pt', 'a4');
                    doc.addHTML(document.body, function() {
                        doc.save('newhtml.pdf');
                    });
                });
            });
        </script>
    </head>
    <body style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;width: auto;height: 100%;font-size: 14px;">
    <div>
        <!-- Company meta details -->
        <div style="alignment: right">
            <button id="gpdf">Download PDF</button>
        </div>
        <div style="">
            <div >
                <div style="display: inline-block;top: -54px;position: relative;">
                    <img src="{{URL::asset('public/assets/img/brand/edm_05.jpg')}}" style="height: 45px;max-width: 100%" alt="Logo">
                    {{--<img style="height: 45px;max-width: 100%" src="logo.jpg">--}}
                </div>

                <div style="display: inline-block;;">
                    <p style="margin: 0px;font-weight: 800;font-size: 18px;color: blue;">
                        Gainwell Commosales Private Limited
                    </p>
                    <p style="margin: 0px;">NH – 2, Bypass Road,</p>
                    <p style="margin: 0px;">Asansol – 713305</p>
                    <p style="margin: 0px;">Phone    : 0341-6605000</p>
                    <p style="margin: 0px;">Fax        : 0341-2253160 </p>
                    <p style="margin: 0px;">Website:  www.gainwellindia.com</p>
                    <p style="margin: 0px;">GST No:   19AAFCG8736M1ZW</p>
                </div>
            </div>

            <!-- Right metas -->

        </div>

        <div><strong style="margin: 0px;">Doc No.: IMS/GCPL/CRC/E/TESTCER/01</strong></div>
        @php
            $date=Carbon\Carbon::now();
			//dd($serial_no);
        @endphp
        <div><strong style="margin: 0px;">Issued On:{{$date->toDateString()}}</strong></div>
        <div style="text-align: end;"><strong style="margin: 0px;">Revise On: 000</strong></div>
        <div style="text-align: end;"><strong style="margin: 0px;">Revised No: 000</strong></div>
        <!-- Shipping address -->

        <div>
            <p>This is to certify that the transmission</p>
            <div>
                <p><b>Serial No: </b>{{$serial_no[0]['serial_no']}}</p>
            </div>
            <div>
                <p><b>Model: </b>{{$model[0]['model_no']}}</p>
            </div>
            <div>
                <p><b>WO NO: </b>
                    {{$certificate->work_orderno}}</p>
            </div>
        </div>

        <!-- Reference -->
        {{--<div>--}}
            {{--<table border="1" style="width:100%;margin-top: 10px;margin-bottom: 10px;border-spacing: 0;">--}}
                {{--<tbody>--}}
                {{--<tr>--}}
                    {{--<th style="border:1px solid black">--}}
                        {{--<h3 style="margin:0px">--}}
                            {{--Engine Test certificate--}}
                        {{--</h3>--}}
                    {{--</th>--}}
                {{--</tr>--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}

        <!-- Products bills -->
        {{--<div style="">--}}
            {{--<div>--}}
                {{--<table border="1" style="border-spacing: 0; width: 100%">--}}
                    {{--<tbody><tr>--}}
                        {{--<th>Serila.No.</th>--}}
                        {{--<th >Model</th>--}}
                        {{--<th>SBU</th>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>sl -001</td>--}}
                        {{--<td>model-001</td>--}}
                        {{--<td>lorium</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>sl -001</td>--}}
                        {{--<td>model-001</td>--}}
                        {{--<td>lorium</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>sl -001</td>--}}
                        {{--<td>model-001</td>--}}
                        {{--<td>lorium</td>--}}
                    {{--</tr>--}}
                {{--</tbody></table>--}}
            {{--</div>--}}
        {{--</div>--}}
        <!-- Total and all the stuffs -->
        <div style="margin-top: 5px;">
            <div>
                <div style="display: grid;grid-template-columns: 30% 70%;grid-gap: 7px;">
                    <div>

                        <p style="margin: 0px;">  All parameters are mentioned in attached test report.</p>
                        <p style="margin: 0px;">  For CRC Asansol.</p>
                        <p style="margin: 0px;">  Date:</p>
						<p style="margin: 0px;">As this is System generated certificate so not required any signature.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
{{--@endsection--}}
{{--@section('after_script')--}}

    {{--<!-- Optional JS -->--}}
    {{--<script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>--}}

{{--@endsection--}}
