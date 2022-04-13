@extends('admin.include.layout')
<!-- Project List -->



@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Create New Section </h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Section</li>
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
            <form method="post" action="{{url('admin/section -add-store')}}" enctype="multipart/form-data">



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id">Section Name</label>
                            <input type="text" class="form-control" id="" placeholder="" name="name">
                            @if($errors->has('name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Parent Section</label>
                            <select name="dept_id" class="form-control">
                                    
                                    
                                <option value="1" >Select Parent Section</option>
                            </select>
                            @if($errors->has('customer_code'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('customer_code')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Department</label>
                            <select name="dept_id" class="form-control">
                                    
                                    
                                        <option value="1" >Branch Office</option>

                                    
                                        <option value="2" >Support</option>

                                    
                                        <option value="3" >Receiving</option>

                                    
                                        <option value="4" selected=selected>Engine Disassembly</option>

                                    
                                        <option value="5" >Transmisssion Disassembly</option>

                                    
                                        <option value="6" >Mor Disassembly</option>

                                    
                                        <option value="7" >Undercarrige Disassembly</option>

                                    
                                        <option value="8" >SPC</option>

                                    
                                        <option value="9" >Store</option>

                                    
                                        <option value="10" >Engine Assembly and testing</option>

                                    
                                        <option value="11" >Transmisssion Assembly and testing</option>

                                    
                                        <option value="12" >Hydraulic Component Assembly and testing</option>

                                    
                                        <option value="13" >Hydraulic Component Disassembly </option>

                                    
                                        <option value="14" >MOR Assembly</option>

                                    
                                        <option value="15" >Undercarrige Assembly</option>

                                    
                                        <option value="20" >Admin</option>

                                    
                                        <option value="21" >QAQC</option>

                                    
                                        <option value="22" >Dispatch</option>

                                    
                                        <option value="23" >Testing</option>

                                    
                                        <option value="24" >SuperAdmin</option>

                                    
                                        <option value="25" >Used Parts Disassembly</option>

                                    
                                        <option value="26" >Used Parts Assembly</option>

                                    
                                </select>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Model No</label>
                            <select name="model_id" class="form-control">
                                    
                                    
                                        <option value="1" >950GC</option>

                                    
                                        <option value="2" >D9R</option>

                                    
                                        <option value="3" >777D</option>

                                    
                                        <option value="4" >C32</option>

                                    
                                        <option value="5" >973C</option>

                                    
                                        <option value="6" >125 KVA</option>

                                    
                                        <option value="8" >82.5 KVA</option>

                                    
                                        <option value="9" >773E_TRAN_008</option>

                                    
                                        <option value="10" >3412</option>

                                    
                                        <option value="11" >C7.1</option>

                                    
                                        <option value="12" >C27</option>

                                    
                                        <option value="14" >3508</option>

                                    
                                        <option value="15" >2021</option>

                                    
                                        <option value="16" >950H</option>

                                    
                                        <option value="17" >NON CAT</option>

                                    
                                        <option value="18" >988H</option>

                                    
                                        <option value="19" >NA</option>

                                    
                                        <option value="21" >CLBT754</option>

                                    
                                        <option value="22" >320D2</option>

                                    
                                        <option value="23" >120K2</option>

                                    
                                        <option value="24" >600KVA</option>

                                    
                                        <option value="25" >777E</option>

                                    
                                        <option value="26" >1010KVA</option>

                                    
                                        <option value="27" >120K</option>

                                    
                                        <option value="28" >349D2</option>

                                    
                                        <option value="29" >773D</option>

                                    
                                        <option value="30" >773B</option>

                                    
                                        <option value="32" >D10R</option>

                                    
                                        <option value="33" >MARC</option>

                                    
                                        <option value="34" >2021D</option>

                                    
                                        <option value="35" >120H</option>

                                    
                                        <option value="36" >C11</option>

                                    
                                        <option value="37" >773E</option>

                                    
                                        <option value="38" >770G</option>

                                    
                                        <option value="40" >D6G</option>

                                    
                                        <option value="41" >D6R</option>

                                    
                                        <option value="42" >980H</option>

                                    
                                        <option value="44" >973D</option>

                                    
                                        <option value="45" >D8R</option>

                                    
                                        <option value="46" >66617676</option>

                                    
                                        <option value="47" >RD142</option>

                                    
                                        <option value="48" >631K</option>

                                    
                                        <option value="49" >3126</option>

                                    
                                        <option value="50" >2021Z</option>

                                    
                                        <option value="51" >CL210</option>

                                    
                                        <option value="52" >950L</option>

                                    
                                        <option value="53" >140K</option>

                                    
                                        <option value="55" >500 KVA</option>

                                    
                                        <option value="57" >320 D</option>

                                    
                                        <option value="58" >320 CL</option>

                                    
                                        <option value="59" >320 DL</option>

                                    
                                        <option value="60" >320 D2L</option>

                                    
                                        <option value="61" >3406</option>

                                    
                                        <option value="63" >1010 KVA</option>

                                    
                                        <option value="64" >180 KVA</option>

                                    
                                        <option value="65" >25 KVA</option>

                                    
                                        <option value="66" >2021 D</option>

                                    
                                        <option value="67" >323 D3</option>

                                    
                                        <option value="68" >D6R2</option>

                                    
                                        <option value="71" >C9</option>

                                    
                                        <option value="72" >C7</option>

                                    
                                        <option value="73" >365KVA</option>

                                    
                                        <option value="74" >RAM CAR</option>

                                    
                                        <option value="75" >SEM919</option>

                                    
                                        <option value="76" >C4.4</option>

                                    
                                        <option value="77" >232 D3</option>

                                    
                                        <option value="78" >950H Loader</option>

                                    
                                        <option value="79" >C18</option>

                                    
                                        <option value="80" >SZS00820</option>

                                    
                                        <option value="81" >R1300G- LHD</option>

                                    
                                        <option value="82" >320 D2</option>

                                    
                                        <option value="83" >725 KVA</option>

                                    
                                        <option value="85" >966H</option>

                                    
                                        <option value="86" >C13</option>

                                    
                                        <option value="87" >D9R Dozer</option>

                                    
                                        <option value="88" >3306</option>

                                    
                                        <option value="89" >CL215-01</option>

                                    
                                        <option value="90" >C6.6</option>

                                    
                                        <option value="95" selected=selected>424</option>

                                    
                                        <option value="96" >BA200567</option>

                                    
                                        <option value="97" >C15</option>

                                    
                                        <option value="98" >3408</option>

                                    
                                        <option value="100" >424B</option>

                                    
                                        <option value="103" >C6.4</option>

                                    
                                        <option value="104" >380 KVA</option>

                                    
                                        <option value="105" >320 KVA</option>

                                    
                                        <option value="106" >3013</option>

                                    
                                        <option value="107" >3046</option>

                                    
                                        <option value="108" >3054</option>

                                    
                                        <option value="109" >3066</option>

                                    
                                        <option value="110" >3116</option>

                                    
                                        <option value="111" >3126B</option>

                                    
                                        <option value="112" >3196</option>

                                    
                                        <option value="113" >3456</option>

                                    
                                        <option value="114" >3512</option>

                                    
                                        <option value="115" >3516</option>

                                    
                                        <option value="116" >C12</option>

                                    
                                        <option value="117" >KT1150C</option>

                                    
                                        <option value="118" >FG WILSON</option>

                                    
                                        <option value="119" >140H</option>

                                    
                                        <option value="120" >140K2</option>

                                    
                                        <option value="121" >773D TC</option>

                                    
                                        <option value="122" >777D TC</option>

                                    
                                        <option value="123" >950G</option>

                                    
                                        <option value="124" >D6G TC</option>

                                    
                                        <option value="125" >D6R TC</option>

                                    
                                        <option value="126" >D7G</option>

                                    
                                        <option value="127" >D9R TC</option>

                                    
                                        <option value="128" >TT2221</option>

                                    
                                        <option value="129" >D10N</option>

                                    
                                        <option value="130" >D10T</option>

                                    
                                        <option value="131" >D9N</option>

                                    
                                        <option value="132" >D9T</option>

                                    
                                        <option value="133" >773B_S</option>

                                    
                                        <option value="134" >120K2Q</option>

                                    
                                        <option value="135" >D9R_S</option>

                                    
                                        <option value="136" >D8N</option>

                                    
                                        <option value="137" >C18_S</option>

                                    
                                        <option value="138" >REC_REAR SUS_773D</option>

                                    
                                        <option value="139" >16H-00</option>

                                    
                                        <option value="140" >REC_STEERING CYL_7</option>

                                    
                                        <option value="143" >REC_HOIST CYL_773D</option>

                                    
                                        <option value="144" >3412 HEUI_S</option>

                                    
                                        <option value="145" >1160</option>

                                    
                                        <option value="146" >1035</option>

                                    
                                        <option value="147" >RH40E</option>

                                    
                                        <option value="148" >REC_FIP_3408</option>

                                    
                                        <option value="149" >988HQ</option>

                                    
                                        <option value="150" >773D_S</option>

                                    
                                        <option value="151" >988G_S</option>

                                    
                                        <option value="152" >3412 DITA_S</option>

                                    
                                        <option value="153" >REC_FRONT SUS_773D</option>

                                    
                                        <option value="154" >3408_S</option>

                                    
                                        <option value="155" >REC_FIP_3412</option>

                                    
                                        <option value="156" >988H_S</option>

                                    
                                        <option value="157" >16H_S</option>

                                    
                                        <option value="159" >773EQ</option>

                                    
                                        <option value="160" >966E</option>

                                    
                                        <option value="161" >C-18</option>

                                    
                                        <option value="162" >322C</option>

                                    
                                        <option value="163" >980H_S</option>

                                    
                                        <option value="164" >772GQ</option>

                                    
                                        <option value="165" >980C</option>

                                    
                                        <option value="166" >C6.6_S</option>

                                    
                                        <option value="167" >770GQ</option>

                                    
                                        <option value="168" >D6G2</option>

                                    
                                        <option value="169" >120H_S</option>

                                    
                                        <option value="170" >3306_S</option>

                                    
                                        <option value="171" >120H STD</option>

                                    
                                        <option value="172" >3516B</option>

                                    
                                        <option value="173" >3516_2000_CIPL</option>

                                    
                                        <option value="174" >2071_S</option>

                                    
                                        <option value="175" >C13 INDM</option>

                                    
                                        <option value="176" >C9 INDM</option>

                                    
                                        <option value="177" >2021Z_VAR19</option>

                                    
                                        <option value="178" >D8R_S</option>

                                    
                                        <option value="179" >120K_S</option>

                                    
                                        <option value="180" >3406_S</option>

                                    
                                        <option value="181" >C7_S</option>

                                    
                                        <option value="182" >140K2-SZ</option>

                                    
                                        <option value="183" >140K_S</option>

                                    
                                        <option value="184" >349D2-XZ</option>

                                    
                                        <option value="185" >424B_ID</option>

                                    
                                        <option value="186" >320D2_VAR2</option>

                                    
                                        <option value="187" >320D_S</option>

                                    
                                        <option value="188" >2021_S</option>

                                    
                                        <option value="189" >424B_HD</option>

                                    
                                        <option value="190" >323D3</option>

                                    
                                        <option value="191" >3516_S</option>

                                    
                                        <option value="192" >424B_HD1</option>

                                    
                                        <option value="193" >424B_EXH</option>

                                    
                                        <option value="194" >320D2GC</option>

                                    
                                        <option value="195" >834G_S</option>

                                    
                                        <option value="196" >D10R_S</option>

                                    
                                        <option value="197" >773E_S</option>

                                    
                                        <option value="198" >773EQ_VAR2</option>

                                    
                                        <option value="199" >424B_S</option>

                                    
                                        <option value="200" >320D3</option>

                                    
                                        <option value="201" >2021D3.1CBNC</option>

                                    
                                        <option value="202" >216B3_VAR2</option>

                                    
                                        <option value="203" >320D3GD100</option>

                                    
                                        <option value="204" >2021D1.7RKNC</option>

                                    
                                        <option value="205" >216B3_VAR1</option>

                                    
                                        <option value="206" >HAMMER-ATTCH</option>

                                    
                                        <option value="207" >120K2Q_VAR1</option>

                                    
                                        <option value="208" >120K2Q_VAR2</option>

                                    
                                        <option value="209" >424B2HDSTD27MRF</option>

                                    
                                        <option value="210" >120KQ</option>

                                    
                                        <option value="211" >320D2_VCB1.00</option>

                                    
                                        <option value="212" >950HQ SZ</option>

                                    
                                        <option value="213" >950H_S</option>

                                    
                                        <option value="214" >C13 PETM</option>

                                    
                                        <option value="215" >BUCKET-950H</option>

                                    
                                        <option value="216" >C9_S</option>

                                    
                                        <option value="217" >C6.4_S</option>

                                    
                                        <option value="218" >FB160-2_FG_CIPL</option>

                                    
                                        <option value="219" >2021D1.7GPNC</option>

                                    
                                        <option value="220" >323D3SD120</option>

                                    
                                        <option value="221" >COMPACTOR 5250</option>

                                    
                                        <option value="222" >320D2_VAR4</option>

                                    
                                        <option value="223" >2021Z_VAR11</option>

                                    
                                        <option value="224" >3306_250_TL</option>

                                    
                                        <option value="225" >2021Z_VAR17</option>

                                    
                                        <option value="226" >320D</option>

                                    
                                        <option value="227" >320DQ</option>

                                    
                                        <option value="228" >SEM658B_S</option>

                                    
                                        <option value="229" >120KQ SZ</option>

                                    
                                        <option value="230" >D5K2LRC</option>

                                    
                                        <option value="231" >C32_1010_CIPL</option>

                                    
                                        <option value="232" >424B_VAR2</option>

                                    
                                        <option value="233" >320D2_VAR1</option>

                                    
                                        <option value="234" >3066_S</option>

                                    
                                        <option value="235" >C15_500_CIPL</option>

                                    
                                        <option value="236" >C18_600_CIPL</option>

                                    
                                        <option value="237" >D6G_S</option>

                                    
                                        <option value="238" >C7.1_S</option>

                                    
                                        <option value="239" >XL1700</option>

                                    
                                        <option value="240" >320D2_VAR3</option>

                                    
                                        <option value="241" >D5K</option>

                                    
                                        <option value="242" >2021D2.0GPNC</option>

                                    
                                        <option value="243" >C13_400_CIPL</option>

                                    
                                        <option value="244" >313D2 LGP</option>

                                    
                                        <option value="245" >424B HD</option>

                                    
                                        <option value="246" >3406_320_WCP</option>

                                    
                                        <option value="247" >320D2L_VAR4</option>

                                    
                                        <option value="248" >336D2</option>

                                    
                                        <option value="249" >950 GC</option>

                                    
                                        <option value="250" >E01-81561648</option>

                                    
                                        <option value="251" >120K2STDCONT</option>

                                    
                                        <option value="252" >D6R_S</option>

                                    
                                        <option value="253" >973_S</option>

                                    
                                        <option value="254" >1025</option>

                                    
                                        <option value="255" >973</option>

                                    
                                        <option value="256" >REC-XMSN-CLBT754</option>

                                    
                                        <option value="257" >977L</option>

                                    
                                        <option value="258" >973-C</option>

                                    
                                        <option value="259" >973 C</option>

                                    
                                        <option value="260" >973C_S</option>

                                    
                                        <option value="261" >CLBT754_S</option>

                                    
                                        <option value="262" >3116_S</option>

                                    
                                        <option value="263" >440FM_S</option>

                                    
                                        <option value="264" >140K2Q</option>

                                    
                                        <option value="265" >REC_XMSN_D6G</option>

                                    
                                        <option value="266" >TT2221_S</option>

                                    
                                        <option value="267" >C27 PETG</option>

                                    
                                        <option value="268" >REC_XMSN_950L</option>

                                    
                                        <option value="269" >D8T-BR</option>

                                    
                                        <option value="270" >D8R-RY</option>

                                    
                                        <option value="271" >REC_ENG_C9</option>

                                    
                                        <option value="272" >3054C</option>

                                    
                                        <option value="273" >C4.4_S</option>

                                    
                                        <option value="274" >374D</option>

                                    
                                        <option value="275" >1035_S</option>

                                    
                                        <option value="276" >320D PH2</option>

                                    
                                        <option value="277" >REC_ENG_C7</option>

                                    
                                        <option value="278" >232323</option>

                                    
                                        <option value="279" >656D</option>

                                    
                                        <option value="280" >AD60Q</option>

                                    
                                        <option value="281" >3013C</option>

                                    
                                        <option value="282" >500KVA DGSET</option>

                                    
                                        <option value="283" >C2.2</option>

                                    
                                        <option value="284" >3304</option>

                                    
                                        <option value="285" >SEM656D</option>

                                    
                                        <option value="286" >R2900GQ</option>

                                    
                                        <option value="287" >C27_S</option>

                                    
                                        <option value="288" >R3000HQ</option>

                                    
                                        <option value="289" >C15_S</option>

                                    
                                        <option value="290" >3512B</option>

                                    
                                        <option value="291" >3512_S</option>

                                    
                                        <option value="292" >323D_S</option>

                                    
                                        <option value="293" >C2.2_S</option>

                                    
                                        <option value="294" >R1300GQ</option>

                                    
                                        <option value="295" >RAPTOR-442R</option>

                                    
                                        <option value="296" >AD22</option>

                                    
                                        <option value="297" >UG20K</option>

                                    
                                        <option value="298" >R1600H</option>

                                    
                                        <option value="299" >R1300G</option>

                                    
                                        <option value="300" >3412E</option>

                                    
                                        <option value="301" >ALU400_S</option>

                                    
                                        <option value="302" >966E_S</option>

                                    
                                        <option value="303" >930H</option>

                                    
                                        <option value="304" >REC_XMSN_TT2221</option>

                                    
                                        <option value="305" >216B3PT62GPBKT</option>

                                    
                                        <option value="306" >OTT-216B3</option>

                                    
                                        <option value="307" >950GC_S</option>

                                    
                                        <option value="308" >AD60</option>

                                    
                                        <option value="309" >426F2</option>

                                    
                                        <option value="310" >FH125</option>

                                    
                                        <option value="311" >FB110</option>

                                    
                                        <option value="312" >180KVA</option>

                                    
                                </select>
                            @if($errors->has('branch'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('branch')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Data Row</label>
                            <input type="text" class="form-control" id="" placeholder="" name="company_code">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Date Column</label>
                            <input type="text" class="form-control" id="" placeholder="" name="contact_details">
                            
                        </div>
                    </div>
                </div>




                <!-- /row -->
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Submit</button>
                
            </form>
        </div>
    </div>



@endsection
@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        $('#role').select2();
    </script>
@endsection
