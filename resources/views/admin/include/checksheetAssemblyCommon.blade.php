@extends('admin.include.layout')
<!-- Project List -->
@php
    $i=0;
    //$v=0;

@endphp

<style type="text/css">
    .round{    padding: 5px 5px 5px 12px;
    border-radius: 12px;}
</style>
@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Check sheet entry</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/service-engineer-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Check sheet</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @php
        //echo 'rimpi';die;
    @endphp

@endsection

@section('body')
    @php
        //$i=0;
        $v=0;
     $deptid='';

    @endphp

    @if (request()->session()->get('user')['section_id'] == '10')
        @php
            $deptid = '10';
        @endphp
    @endif
    @if (request()->session()->get('user')['section_id'] == '11')
        @php
            $deptid = '11';
        @endphp
    @endif
    @if (request()->session()->get('user')['section_id'] == '12')
        @php
            $deptid = '12';
        @endphp
    @endif
    @if (request()->session()->get('user')['section_id'] == '14')
        @php
            $deptid = '14';
        @endphp
    @endif
    @if (request()->session()->get('user')['section_id'] == '15')
        @php
            $deptid = '15';
        @endphp
    @endif

    @php


        // echo '<pre>';print_r($mcSerial[0]['serial_no']);die;
        $exterwash=App\Helpers\UserHelper::ccinspexternalwash();
        $commercial=App\Helpers\UserHelper::commertciallogistic();
        $ccpartclean=App\Helpers\UserHelper::ccpartclean();
        
        $lubri=App\Helpers\UserHelper::partothercomplubrication();
        $cooler=App\Helpers\UserHelper::partothercompcooler();
        $fuel=App\Helpers\UserHelper::partothercompfuel();
        $cylinderhead=App\Helpers\UserHelper::partinspectioncylinderhead();
        $conrod=App\Helpers\UserHelper::partconnectingrod();
        $cylinhed=App\Helpers\UserHelper::partcylinderhead();
        $camshaft=App\Helpers\UserHelper::partcrankshaft();
        $cmsftdetails=App\Helpers\UserHelper::partcamshaftdetails();
         $beforestart=App\Helpers\UserHelper::beforestartassembly();
        
        $fandri=App\Helpers\UserHelper::partsfandrive();
        $oilpump=App\Helpers\UserHelper::partsoilpump();
        $aircompressor=App\Helpers\UserHelper::partaircompressor();
        $waterpump=App\Helpers\UserHelper::partwaterpump();
        $conrodbush=App\Helpers\UserHelper::conrodbushreplacemnt();
        

       // $columnsection=App\Helpers\UserHelper::columndynamic(2);
       $exterwash=App\Helpers\UserHelper::ccinspexternalwash();

        $commercial=App\Helpers\UserHelper::commertciallogistic();

        $ccpartclean=App\Helpers\UserHelper::ccpartclean();

        $basicengine=App\Helpers\UserHelper::partothercompbasicengine($deptid,$service->machine_modelno);
        $lubri=App\Helpers\UserHelper::partothercomplubrication();
        $cooler=App\Helpers\UserHelper::partothercompcooler();
        $fuel=App\Helpers\UserHelper::partothercompfuel();
        $cylinderhead=App\Helpers\UserHelper::partinspectioncylinderhead();
        $conrod=App\Helpers\UserHelper::partconnectingrod();
        $cylinhed=App\Helpers\UserHelper::partcylinderhead();
        $camshaft=App\Helpers\UserHelper::partcrankshaft();
        $cmsftdetails=App\Helpers\UserHelper::partcamshaftdetails();
         $beforestart=App\Helpers\UserHelper::beforestartassembly();
         $cominspreport=App\Helpers\UserHelper::ComponentInspectionReport($deptid,$service->machine_modelno);
        $fandri=App\Helpers\UserHelper::partsfandrive();
        $oilpump=App\Helpers\UserHelper::partsoilpump();
        $aircompressor=App\Helpers\UserHelper::partaircompressor();
        $waterpump=App\Helpers\UserHelper::partwaterpump();
        $conrodbush=App\Helpers\UserHelper::conrodbushreplacemnt();
        $engineassembly=App\Helpers\UserHelper::assemblychecksheet($deptid,$service->machine_modelno);
        $roolermea=App\Helpers\UserHelper::RoolerMeasued();
        $bushbore=App\Helpers\UserHelper::partcamshaftbushbore();
        $cylindertop=App\Helpers\UserHelper::partcylinderTop();
        $cylinderthred=App\Helpers\UserHelper::partcylinderThread();
        $cylindercapclr=App\Helpers\UserHelper::partcylinderCapClear();

        $cooler=App\Helpers\UserHelper::coolerinsp();
        $transmiss=App\Helpers\UserHelper::TransmissionComponent($deptid,$service->machine_modelno);
        $compdet=App\Helpers\UserHelper::dynamicchkshtdemo($deptid,$service->machine_modelno);

        $childsec=App\Helpers\UserHelper::dynamicchildsec($deptid,$service->machine_modelno);
        $subchildsec=App\Helpers\UserHelper::subchilddynamicsec($deptid,$service->machine_modelno);


        //$sec=App\Helpers\UserHelper::sectionname();
    @endphp

    @php
        $i=0;
        $v=0;
        $r=0;
        $t=0;
        $s=0;
        $b=0;
        $c=0;


    @endphp

    <div class="accordion" id="checkSheet">

        <div class="text-right mb-1" style="padding-right: 70px">


                <form method="post" action="{{url('admin/assy-excel-download')}}" enctype="multipart/form-data">
                    <input type="hidden" name="service_id" value="{{$service->id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                <!--  <a href="{{url('admin/excel-download')}}">Excel Download </a>-->
                    <input class="btn btn-primary" type="submit" value="Excel Download">
                </form>




        </div>

    @php
        $dynamic=0;

    @endphp


    <!-- Section hidden/show -->

    @php
        $li = 0;
    @endphp
    @if(!empty($compdet))
        @foreach($compdet as $hideSection)
            @php
                $sectionname[$li] = $hideSection['section_name'];
                                $li++;
            @endphp
        @endforeach

        @php

            $sec_aggre = in_array('Aggregation Information',$sectionname);
                        $sec_pre = in_array('Pre History',$sectionname);
                        $sec_com = in_array('Commercial & Logistics Report',$sectionname);
                        $sec_loose = in_array('Loose part report',$sectionname);
                        $sec_extwash = in_array('CC Inspection Check sheet after external washing',$sectionname);
                        $sec_prtclean = in_array('CC Inspection Check sheet after Parts Cleaning',$sectionname);
                        $sec_mising = in_array('Missing/Damaged Parts Report',$sectionname);
                        $sec_prtinsp = in_array('Parts Inspection Report',$sectionname);
                        $sec_list = in_array('List of Salvage components',$sectionname);
                        $sec_status = in_array('Status Of Revision',$sectionname);
                        $sec_conrodbus = in_array('Connecting Rod Inspection After Bush Replacement',$sectionname);
                        $sec_comins = in_array('Component Inspection Report',$sectionname);
                        $sec_des = in_array('Disassembly, Cleaning & Inspection Check sheet',$sectionname);
                        $sec_befstrasm = in_array('CC Inspection Check sheet before starting assembly',$sectionname);
                        $sec_trans = in_array('TRANSMISSION & TC Component Inspection Report',$sectionname);
                        $sec_failed = in_array('Failed Parts List',$sectionname);
                     $sec_engassem = in_array('Assembly Checksheet',$sectionname);


        @endphp
      @else
            <div class="card-header"><h3>CheckSheet Not Available.</h3></div>
    @endif

    <!--Sub Child Section hidden/show -->

    @php
        $si = 0;
    @endphp
    @if(!empty($subchildsec))
        @foreach($subchildsec as $subchildSe)
            @php
                $subchildsecname[$si] = $subchildSe['subchild_section'];
                                $si++;
            @endphp
        @endforeach

        @php

            $sec_main = in_array('Main bearing bore',$subchildsecname);
                                $sec_lin = in_array('LINER SLEEVE bore',$subchildsecname);
                                $sec_cytddeck = in_array('CYLINDERS BLOCK TOP DECK HEIGHT MEASUREMENT',$subchildsecname);
                                $sec_cythed = in_array('CYLINDER BLOCK THREAD INSPECTION',$subchildsecname);
                                $sec_cybush = in_array('CYLINDER BLOCK BUSHING BORE MEASUREMENT TABLE',$subchildsecname);
                                $sec_maicap = in_array('MAIN BERING CAP WIDTH & CLEARANCE CHECK TABLE',$subchildsecname);
                                $sec_cambush = in_array('CAM BUSH BORE MEASUEMENT TABLE',$subchildsecname);
                                $sec_cycambore = in_array('CYLINDER BLOCK CAM BORE MEASUREMENT TABLE',$subchildsecname);
                                $sec_camlh = in_array('Camshaft Inspection-LH',$subchildsecname);
                                $sec_camrh = in_array('Camshaft Inspection-RH',$subchildsecname);

        @endphp

    @endif



    <!-- Aggregate information -->

        @if(!empty($sec_aggre))
            @php
                $aggregahiddden = '';

            @endphp
        @else
            @php
                $aggregahiddden = 'hidden';

            @endphp
        @endif

        <div class="card" {{$aggregahiddden}}>


            <div class="card-header" id="aggregate-inforamtion">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseAggregate"
                            aria-expanded="true" aria-controls="collapseAggregate">
                        {{--Aggregate information--}}

                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==1)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach

                        {{--@endif--}}
                    </button>
                </h2>
            </div>

            <div id="collapseAggregate" class="collapse show" aria-labelledby="aggregate-inforamtion"
                 data-parent="#checkSheet" >
                <div class="card-body">

                    <form method="post" action="{{url('admin/check-gate-aggregate-save')}}" enctype="multipart/form-data">
                        <div class="row">
                            @if(isset($agrregate->id))
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer">Service Request No</label>
                                        <input type="text" name="service_request_id" class="form-control" id="" value="{{$service->service_request_no}}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer">Aggregate type</label>
                                        <input type="text" name="aggr_type" class="form-control" id="" value="@if($agrregate!=Null){{$agrregate->aggr_type}}@endif" >
                                        @if($errors->has('aggr_type'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('aggr_type')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer">Model No.</label>
                                        <input type="text" class="form-control" id="" name="machine_modelno" value="{{$mcModel['model_no']}}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer">Serial No.</label>
                                        <input type="text" class="form-control" name="machine_serialno" id="" value="{{$mcSerial[0]['serial_no']}}" readonly>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer">Arrangement No.</label>
                                        <input type="text" class="form-control" id="" name="arrangement_no" value="@if($agrregate!=Null){{$agrregate->arrangement_no}}@endif">
                                        @if($errors->has('arrangement_no'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('arrangement_no')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer">Customer</label>
                                        <input type="text" class="form-control" name="customer" id="" value="@if($service!=Null){{$agrregate->customer}}@endif" readonly>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer-contact">Customer contact</label>
                                        <input type="text" class="form-control" name="customer_contact" id="customer-contact" value="@if($service!=Null){{$agrregate->customer_contact}}@endif" >
                                        @if($errors->has('customer_contact'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('customer_contact')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="servicing-branch">Servicing branch</label>
                                        <input type="text" class="form-control" name="servicing_branch" id="servicing-branch" value="@if($agrregate!=Null){{$agrregate->servicing_branch}}@endif" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="branch-contact">Branch contact</label>
                                        <input type="text" class="form-control" name="branch_contact" id="branch-contact" value="@if($agrregate!=Null){{$agrregate->branch_contact}}@endif">
                                        @if($errors->has('branch_contact'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('branch_contact')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="crc-supervisor">CRC supervisor</label>
                                        <input type="text" class="form-control" name="crc_supervisor" id="crc-supervisor" value="@if($agrregate!=Null){{$agrregate->crc_supervisor}}@endif">
                                        @if($errors->has('crc_supervisor'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('crc_supervisor')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="crc-job-number">CRC job number</label>
                                        <input type="text" class="form-control" name="crc_job_no" id="crc-job-number" placeholder="CRC job number" value="@if($agrregate!=Null){{$agrregate->crc_job_no}}@endif">
                                        @if($errors->has('crc_job_no'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('crc_job_no')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="Branch-job-number">Branch job number <span class="text-muted">(if any)</span></label>
                                        <input type="text" class="form-control" name="branch_job_no" id="Branch-job-number" placeholder="Branch job number" value="@if($agrregate!=Null){{$agrregate->branch_job_no}}@endif">
                                        @if($errors->has('branch_job_no'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('branch_job_no')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="date-of-arrival">Date of arrival</label>
                                        <input type="date" name="date_arrival" class="datepicker form-control" id="date-of-arrival" placeholder="Date of arrival" value="@if($agrregate!=Null){{$agrregate->date_arrival}}@endif">
                                        @if($errors->has('date_arrival'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('date_arrival')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="date-of-dispatch">Date of dispatch</label>
                                        <input type="date" name="date_dispatch" class="datepicker form-control" id="date-of-dispatch" placeholder="Date of dispatch" value="@if($agrregate!=Null){{$agrregate->date_dispatch}}@endif">
                                        @if($errors->has('date_dispatch'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('date_dispatch')}}</div>
                                        @endif
                                    </div>
                                </div>

                            @else
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer">Service Request No</label>
                                        <input type="text" name="service_request_id" class="form-control" id="" value="{{$service->service_request_no}}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer">Aggregate type</label>
                                        <input type="text" name="aggr_type" class="form-control" id="" value="" >
                                        @if($errors->has('aggr_type'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('aggr_type')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer">Model No.</label>
                                        <input type="text" class="form-control" id="" name="machine_modelno" value="{{$mcModel['model_no']}}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer">Serial No.</label>
                                        <input type="text" class="form-control" name="machine_serialno" id="" value="{{$mcSerial[0]['serial_no']}}" readonly>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer">Arrangement No.</label>
                                        <input type="text" class="form-control" id="" name="arrangement_no" value="">
                                        @if($errors->has('arrangement_no'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('arrangement_no')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer">Customer</label>
                                        <input type="text" class="form-control" name="customer" id="" value="{{$service['customer']}}" readonly>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="customer-contact">Customer contact</label>
                                        <input type="text" class="form-control" name="customer_contact" id="customer-contact" value="" >
                                        @if($errors->has('customer_contact'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('customer_contact')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="servicing-branch">Servicing branch</label>
                                        <input type="text" class="form-control" name="servicing_branch" id="servicing-branch" value="{{$service['branch_name']}}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="branch-contact">Branch contact</label>
                                        <input type="text" class="form-control" name="branch_contact" id="branch-contact" value="">
                                        @if($errors->has('branch_contact'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('branch_contact')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="crc-supervisor">CRC supervisor</label>
                                        <input type="text" class="form-control" name="crc_supervisor" id="crc-supervisor" value="">
                                        @if($errors->has('crc_supervisor'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('crc_supervisor')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="crc-job-number">CRC job number</label>
                                        <input type="text" class="form-control" name="crc_job_no" id="crc-job-number" placeholder="CRC job number" value="">
                                        @if($errors->has('crc_job_no'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('crc_job_no')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="Branch-job-number">Branch job number <span class="text-muted">(if any)</span></label>
                                        <input type="text" class="form-control" name="branch_job_no" id="Branch-job-number" placeholder="Branch job number" value="">
                                        @if($errors->has('branch_job_no'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('branch_job_no')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="date-of-arrival">Date of arrival</label>
                                        <input type="date" name="date_arrival" class="datepicker form-control" id="date-of-arrival" placeholder="Date of arrival" value="">
                                        @if($errors->has('date_arrival'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('date_arrival')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="date-of-dispatch">Date of dispatch</label>
                                        <input type="date" name="date_dispatch" class="datepicker form-control" id="date-of-dispatch" placeholder="Date of dispatch" value="">
                                        @if($errors->has('date_dispatch'))
                                            <div class="invalid-feedback" style="display:block;">{{$errors->first('date_dispatch')}}</div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        </div><!-- /row -->
                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole

                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @if((isset($agrregate->id)&& $agrregate->work_done==0)||!isset($agrregate->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif

                    </form>

                </div>
            </div>
            {{--</div>--}}
        </div>

        <!-- Pre-history -->

        @if(!empty($sec_pre))
            @php

                $prehisthiddden = '';

            @endphp
        @else
            @php
                $prehisthiddden = 'hidden';

            @endphp
        @endif
        <div class="card "{{$prehisthiddden}}>
            <div class="card-header" id="pre-history">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsePreHistory"
                            aria-expanded="false" aria-controls="collapsePreHistory">

                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==2)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach
                    </button>
                </h2>
            </div>
            <div id="collapsePreHistory" class="collapse" aria-labelledby="pre-history" data-parent="#checkSheet">
                <div class="card-body">

                    <!-- Pre-history form -->
                    <form method="post" action="{{url('admin/check-gate-prehis-dis-save')}}" enctype="multipart/form-data">

                        <!-- repair mode -->
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="form-control-label">Repair mode</label>
                            </div>
                            <div class="col-md-3">
                                <div class="very-own-radio">
                                    <input type="radio" id="control_01" name="repair_mode" value="Planned" @if($prehist!=Null){{$prehist->repair_mode}}@endif>
                                    <label class="" for="control_01">
                                        <h2>Planned</h2>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="very-own-radio">
                                    <input type="radio" id="control_02" name="repair_mode" value="Accident/damage" @if($prehist!=Null){{$prehist->repair_mode}}@endif>
                                    <label class="" for="control_02">
                                        <h2>Accident/damage</h2>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="very-own-radio">
                                    <input type="radio" id="control_03" name="repair_mode" value="Failure" @if($prehist!=Null){{$prehist->repair_mode}}@endif>
                                    <label class="" for="control_03">
                                        <h2>Failure</h2>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="very-own-radio">
                                    <input type="radio" id="control_04" name="repair_mode" value="Warrenty/re-do" @if($prehist!=Null){{$prehist->repair_mode}}@endif>
                                    <label class="" for="control_04">
                                        <h2>Warrenty/re-do</h2>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="engine-serial-number">Engine serial no.</label>
                                    <input type="text" name="engine_serial_no" class="form-control" id="engine-serial-number" placeholder="Engine serial no." value="{{$componentSerial['comp_serial_no']}}" readonly>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="engine-arrange-number">Engine arrange no.</label>
                                    <input type="text" name="engine_arrange_no" class="form-control" id="engine-arrange-number" placeholder="Engine arrange no." value="@if($prehist!=Null){{$prehist->engine_arrange_no}}@endif">
                                    @if($errors->has('engine_arrange_no'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('engine_arrange_no')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="machine-type">Machine type</label>
                                    <input type="text" class="form-control" id="" name="machine_type" placeholder="Machine type" value="{{$service['component_name']}}" readonly>
                                    @if($errors->has('machine_type'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('machine_type')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="machine-serial-no">Machine serial no.</label>
                                    <input type="text" name="machine_serial_no" class="form-control" id="machine-serial-no" placeholder="Machine serial no." value="{{$mcSerial[0]['serial_no']}}" readonly>
                                    @if($errors->has('machine_serial_no'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('machine_serial_no')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="component-life">Total component life(SMU)</label>
                                    <input type="text" name="smu" class="form-control" id="component-life" placeholder="Total component life(SMU)" value="@if($prehist!=Null){{$prehist->smu}}@endif">
                                    @if($errors->has('smu'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('smu')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">No of Overhauls Done</label>
                                    <input type="text" name="no_of_overhauls_done" class="form-control" id="overhaultsdone" placeholder="" value="@if($prehist!=Null){{$prehist->no_of_overhauls_done}}@endif">
                                    @if($errors->has('no_of_overhauls_done'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('no_of_overhauls_done')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Last Overhaul SMU</label>
                                    <input type="text" name="last_overhaul_smu" class="form-control" id="lastoverhaulsmu" placeholder="" value="@if($prehist!=Null){{$prehist->last_overhaul_smu}}@endif">
                                    @if($errors->has('last_overhaul_smu'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('last_overhaul_smu')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="faliure-details">Failure Details & nature of failure</label>
                                    <textarea type="text" name="failure_details" class="form-control" id="faliure-details" rows="2">@if($prehist!=Null){{$prehist->failure_details}}@endif</textarea>
                                    @if($errors->has('failure_details'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('failure_details')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <h4 class="border-bottom">Major Component Details (If the components were changed in the Field & SMU)</h4>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="cyllinder-head">Cylinder head</label>
                                    <textarea type="text" name="major_cylinder_head" class="form-control" id="cyllinder-head" rows="1">@if($prehist!=Null){{$prehist->major_cylinder_head}}@endif</textarea>
                                    @if($errors->has('major_cylinder_head'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('major_cylinder_head')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="injector">Injector</label>
                                    <textarea type="text" name="major_injector" class="form-control" id="injector" rows="1">@if($prehist!=Null){{$prehist->major_injector}}@endif</textarea>
                                    @if($errors->has('major_injector'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('major_injector')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="oil-pump">Oil pump</label>
                                    <textarea type="text" name="major_oil_pump" class="form-control" id="oil-pump" rows="1">@if($prehist!=Null){{$prehist->major_oil_pump}}@endif</textarea>
                                    @if($errors->has('major_oil_pump'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('major_oil_pump')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="fuel-injection">Fuel injection pump</label>
                                    <textarea type="text" name="major_fuel_injection_pump" class="form-control" id="fuel-injection" rows="1">@if($prehist!=Null){{$prehist->major_fuel_injection_pump}}@endif</textarea>
                                    @if($errors->has('major_fuel_injection_pump'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('major_fuel_injection_pump')}}</div>
                                    @endif
                                </div>
                            </div>

                        </div><!-- /row -->
                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole

                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @if((isset($prehist->id)&& $prehist->work_done==0)||!isset($prehist->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif
                    </form>
                    <!-- pre-history form end -->
                </div>
            </div>
        </div>



        <!-- Commercial & Logistics Report -->

        @if(!empty($sec_com))
            @php
                $commercihiddden = '';

            @endphp
        @else
            @php
                $commercihiddden = 'hidden';

            @endphp
        @endif

        <div class="card"{{$commercihiddden}}>
            <div class="card-header" id="commercial-logistic-report">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseLogisticReport" aria-expanded="false" aria-controls="collapseLogisticReport">


                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==3)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach



                    </button>
                </h2>
            </div>
            <div id="collapseLogisticReport" class="collapse" aria-labelledby="commercial-logistic-report" data-parent="#checkSheet">
                <div class="card-body">
                    <form method="post" action="{{url('admin/check-gate-commerciallogistic-dis-save')}}" enctype="multipart/form-data">
                        <!-- List group -->
                        <ul class="list-group list-group-flush list mb-3 hard-to-choose">


                            @php
                                $i=0;

                            @endphp

                            @foreach($commercial as $comm)
                                @if($commercialLogistic!=Null)
                                    @php
                                        $chk=array_search($comm->documents_receipt_status,$commercialLogistic->question);
                                    @endphp




                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-7">

                                                <h4 class="mb-0">{{$comm->documents_receipt_status}}</h4></div>
                                            <div class="col-2">

                                                <input type="hidden" name="question[{{$i}}]" value="{{$comm->documents_receipt_status}}">

                                                <div class="custom-control custom-control-inline custom-radio">

                                                    <input name="answer[{{$i}}]" class="custom-control-input" id="yes{{$comm->id}}" type="radio" value="yes" {{$commercialLogistic->answer[$chk]=='yes'?'checked':''}}>
                                                    <label class="custom-control-label" for="yes{{$comm->id}}">Yes</label>
                                                </div>
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="answer[{{$i}}]" class="custom-control-input" id="no{{$comm->id}}" type="radio" value="no" {{$commercialLogistic->answer[$chk]=='no'?'checked':''}}>
                                                    <label class="custom-control-label" for="no{{$comm->id}}">No</label>
                                                </div>
                                            </div>
                                            <div class="col-3">

                                                <input type="text" name="remark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{$commercialLogistic->remark[$chk]}}">
                                            </div>
                                        </div>
                                    </li>




                                    @php
                                        $i++;

                                    @endphp
                                @else

                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-7"><h4 class="mb-0">{{$comm->documents_receipt_status}}</h4></div>
                                            <div class="col-2">
                                                <input type="hidden" name="question[{{$i}}]" value="{{$comm->documents_receipt_status}}">
                                                <div class="custom-control custom-control-inline custom-radio">

                                                    <input name="answer[{{$i}}]" class="custom-control-input" id="yes{{$comm->id}}" type="radio" value="yes" >
                                                    <label class="custom-control-label" for="yes{{$comm->id}}">Yes</label>
                                                </div>
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="answer[{{$i}}]" class="custom-control-input" id="no{{$comm->id}}" type="radio" value="no" >
                                                    <label class="custom-control-label" for="no{{$comm->id}}">No</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" name="remark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="">
                                            </div>
                                        </div>
                                    </li>

                                    @php
                                        $i++;
                                    @endphp
                                @endif
                            @endforeach

                        </ul>
                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @php
                            // print_r($allvalcommercialLog->work_done);exit;
                        @endphp


                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @if((isset($allvalcommercialLog->id)&& $allvalcommercialLog->work_done==0)||!isset($allvalcommercialLog->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Loose part Report  -->


        @if(!empty($sec_loose))
            @php
                $looseprthiddden = '';

            @endphp
        @else
            @php
                $looseprthiddden = 'hidden';

            @endphp
        @endif

        <div class="card"{{$looseprthiddden}}>
            <div class="card-header" id="loosePartreport">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseloosePart" aria-expanded="false" aria-controls="collapseloosePart">

                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==4)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach



                    </button>
                </h2>
            </div>
            <div id="collapseloosePart" class="collapse" aria-labelledby="loosePartreport" data-parent="#checkSheet">
                <div class="card-body">

                    <form method="post" action="{{url('admin/check-gate-looseparts-dis-save')}}" enctype="multipart/form-data">
                        <!-- dynamic repeater wrapper -->
                        <div class="loose-part-repeat">

                            @if($showloosepat!=null && count($showloosepat)!=0)
                                @php
                                    $row = 0;
                                @endphp


                                @foreach($showloosepat as $loose)

                                    <div class="row">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Part NO</label>
                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>

                                                <select name="part_no[]" class="form-control select2">

                                                    @php
                                                        $partno=App\Helpers\UserHelper::dropdownpartnumber();
                                                    @endphp

                                                    @foreach($partno as $desig)



                                                        <option value="{{$desig->id}}" {{(old('part_no')!=$loose->part_no)?($desig->id==$loose->part_no)?'selected=selected':'': 'selected=selected'}}>{{$desig->comp_serial_no}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Part description</label>
                                                <textarea type="text" name="part_description[]" class="form-control" placeholder="Part description" rows="1">{{$loose->part_description}}</textarea>

                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">QTY</label>
                                                <input type="text" name="qty[]" class="form-control" placeholder="QTY" value="{{$loose->qty}}">
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Part Condition</label>
                                                <textarea type="text" name="part_condition[]" class="form-control" placeholder="Part condition" rows="1">{{$loose->part_condition}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Photograph</label>
                                                <div class="custom-file">

                                                    <input type="file" name="photograph[]" class="custom-file-input" id="customFileLang" lang="en" value="{{$loose->photograph}}">
                                                    <label class="custom-file-label" for="customFileLang">Photograph taken</label>
                                                </div>
                                            </div>
                                        </div>
                                        @if($row == 0)
                                            <div class="col-auto">
                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                            </div>
                                        @else
                                            <div class="col-auto">
                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                            </div>
                                    @endif
                                    <!--<div class="col-auto">
                                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                </div>-->
                                    </div>
                                    @php
                                        $row++;
                                    @endphp
                                @endforeach


                            @else
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Part NO</label>
                                            <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                            <select name="part_no[]" class="form-control select2">
                                                <option selected="selected" disabled="disabled">--Select--</option>
                                                @php
                                                    $partno=App\Helpers\UserHelper::dropdownpartnumber();
                                                @endphp

                                                @foreach($partno as $desig)

                                                    <option value="{{$desig->id}}">{{$desig->comp_serial_no}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Part description</label>
                                            <textarea type="text" name="part_description[]" class="form-control" placeholder="Part description" rows="1"></textarea>

                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">QTY</label>
                                            <input type="text" name="qty[]" class="form-control" placeholder="QTY">
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Part condition</label>
                                            <textarea type="text" name="part_condition[]" class="form-control" placeholder="Part condition" rows="1"></textarea>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Photograph</label>
                                            <div class="custom-file">
                                                <input type="file" name="photograph[]" class="custom-file-input" id="customFileLang" lang="en">
                                                <label class="custom-file-label" for="customFileLang">Photograph taken</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole


                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @php
                            //dd($showloosepat[0]->work_done);exit;
                        @endphp
                        @if((isset($showloosepat[0]->id)&& $showloosepat[0]->work_done==0)||!isset($showloosepat[0]->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif
                    </form>
                    <!-- pre-history form end -->

                </div>
            </div>
        </div>



        <!-- CC Inspection Check sheet after external washing  -->
        @if(!empty($sec_extwash))
            @php
                $exterhiddden = '';

            @endphp
        @else
            @php

                $exterhiddden = 'hidden';

            @endphp
        @endif


        <div class="card"{{$exterhiddden}}>
            <div class="card-header" id="ccInspectionAfterWashing">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseAfterWashing" aria-expanded="false" aria-controls="collapseAfterWashing">
                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==5)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach
                    </button>
                </h2>
            </div>
            <div id="collapseAfterWashing" class="collapse" aria-labelledby="ccInspectionAfterWashing" data-parent="#checkSheet">
                <div class="card-body">
                    <form method="post" action="{{url('admin/check-gate-ccexternalwash-dis-save')}}" enctype="multipart/form-data">
                        <ul class="list-group list-group-flush list mb-3 hard-to-choose">

                            @php
                                $i=0;
                            @endphp
                            @foreach($exterwash as $qes)
                                @if($externalWash!=Null)
                                    @php
                                        $extwash=array_search($qes->check_points,$externalWash->checkquestion);
                                    @endphp

                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-7"><h4 class="mb-0">{{$qes->check_points}}</h4></div>
                                            <div class="col-2">
                                                <input type="hidden" name="checkquestion[{{$i}}]" value="{{$qes->check_points}}">
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="checkanswer[{{$i}}]" class="custom-control-input" id="checkyes{{$qes->id}}" type="radio" value="yes" {{$externalWash->checkanswer[$extwash]=='yes'?'checked':''}}>
                                                    <label class="custom-control-label" for="checkyes{{$qes->id}}">Yes</label>
                                                </div>
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="checkanswer[{{$i}}]" class="custom-control-input" id="checkno{{$qes->id}}" type="radio" value="no" {{$externalWash->checkanswer[$extwash]=='no'?'checked':''}}>
                                                    <label class="custom-control-label" for="checkno{{$qes->id}}">No</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" name="remarks[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{$externalWash->remarks[$extwash]}}">
                                            </div>
                                        </div>
                                    </li>

                                    @php
                                        $i++;
                                    @endphp
                                @else
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-7"><h4 class="mb-0">{{$qes->check_points}}</h4></div>
                                            <div class="col-2">
                                                <input type="hidden" name="checkquestion[{{$i}}]" value="{{$qes->check_points}}">
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="checkanswer[{{$i}}]" class="custom-control-input" id="checkyes{{$qes->id}}" type="radio" value="yes" >
                                                    <label class="custom-control-label" for="checkyes{{$qes->id}}">Yes</label>
                                                </div>
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="checkanswer[{{$i}}]" class="custom-control-input" id="checkno{{$qes->id}}" type="radio" value="no" >
                                                    <label class="custom-control-label" for="checkno{{$qes->id}}">No</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" name="remarks[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="">
                                            </div>
                                        </div>
                                    </li>
                                    @php
                                        $i++;
                                    @endphp
                                @endif
                            @endforeach


                        </ul>
                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole



                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @php
                            //dd($allvalexterwash->id);exit;
                        @endphp

                        @if((isset($allvalexterwash->id)&& $allvalexterwash->work_done==0)||!isset($allvalexterwash->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>


        <!-- CC Inspection Check sheet after Parts Cleaning  -->

        @if(!empty($sec_prtclean))
            @php
                $prtcleanhiddden = '';

            @endphp
        @else
            @php
                $prtcleanhiddden = 'hidden';

            @endphp
        @endif

        <div class="card"{{$prtcleanhiddden}}>
            <div class="card-header" id="ccInspectionAfterPartCleaning">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseAfterPartCleaning" aria-expanded="false" aria-controls="collapseAfterPartCleaning">
                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==6)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach
                    </button>
                </h2>
            </div>
            <div id="collapseAfterPartCleaning" class="collapse" aria-labelledby="ccInspectionAfterPartCleaning" data-parent="#checkSheet">
                <div class="card-body">
                    <form method="post" action="{{url('admin/check-gate-ccpartclean-dis-save')}}" enctype="multipart/form-data">
                        <ul class="list-group list-group-flush list mb-3 hard-to-choose">

                            @php
                                $i=0;
                            @endphp
                            @foreach($ccpartclean as $partclean)
                                @if($partsClean!=Null)
                                    @php
                                        $partcln=array_search($partclean->check_points,$partsClean->partquestion);
                                    @endphp
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-7"><h4 class="mb-0">{{$partclean->check_points}}</h4></div>
                                            <div class="col-2">
                                                <input type="hidden" name="partquestion[{{$i}}]" value="{{$partclean->check_points}}">
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="partanswer[{{$i}}]" class="custom-control-input" id="partyes{{$partclean->id}}" type="radio" value="yes" {{$partsClean->partanswer[$partcln]=='yes'?'checked':''}}>
                                                    <label class="custom-control-label" for="partyes{{$partclean->id}}">Yes</label>
                                                </div>
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="partanswer[{{$i}}]" class="custom-control-input" id="partno{{$partclean->id}}" type="radio" value="no" {{$partsClean->partanswer[$partcln]=='no'?'checked':''}}>
                                                    <label class="custom-control-label" for="partno{{$partclean->id}}">No</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" name="partremarks[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{$partsClean->partremarks[$partcln]}}">
                                            </div>
                                        </div>
                                    </li>
                                    @php
                                        $i++;
                                    @endphp

                                @else
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-7"><h4 class="mb-0">{{$partclean->check_points}}</h4></div>
                                            <div class="col-2">
                                                <input type="hidden" name="partquestion[{{$i}}]" value="{{$partclean->check_points}}">
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="partanswer[{{$i}}]" class="custom-control-input" id="partyes{{$partclean->id}}" type="radio" value="yes" >
                                                    <label class="custom-control-label" for="partyes{{$partclean->id}}">Yes</label>
                                                </div>
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="partanswer[{{$i}}]" class="custom-control-input" id="partno{{$partclean->id}}" type="radio" value="no" >
                                                    <label class="custom-control-label" for="partno{{$partclean->id}}">No</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" name="partremarks[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="">
                                            </div>
                                        </div>
                                    </li>
                                    @php
                                        $i++;
                                    @endphp

                                @endif
                            @endforeach
                        </ul>
                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole



                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        @if((isset($allvalpartcln->id)&& $allvalpartcln->work_done==0)||!isset($allvalpartcln->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>


        <!-- Missing/Damaged Parts Report -->
        @if(!empty($sec_mising))
            @php
                $misinghiddden = '';

            @endphp
        @else
            @php
                $misinghiddden = 'hidden';

            @endphp
        @endif

        <div class="card"{{$misinghiddden}}>
            <div class="card-header" id="missingDamagedParts">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapsemissingDamagedPart" aria-expanded="false" aria-controls="collapsemissingDamagedPart">
                        @foreach($compdet as $dynamicsectionname)
                        
                            @if($dynamicsectionname['section_id']==7)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach
                    </button>
                </h2>
            </div>
            <div id="collapsemissingDamagedPart" class="collapse" aria-labelledby="missingDamagedParts" data-parent="#checkSheet">
                <div class="card-body">

                    <form method="post" action="{{url('admin/check-gate-missingdamagepart-dis-save')}}" enctype="multipart/form-data">
                    @php
                        $i=0;
                    @endphp
                    <!-- dynamic repeater wrapper -->
                        <div class="missing-damaged-part-repeat">
                        @php
                            $columnsection_2=App\Helpers\UserHelper::columndynamic1(2,7);

                                            $cl = 0;
                        @endphp
                        @foreach($columnsection_2 as $colmissing)
                            @php

                                $colmissingnew[$cl] = $colmissing['column_name'];
                                                $cl++;

                            @endphp
                        @endforeach


                        @php
                            $val_arr = in_array('Part Description',$colmissingnew);
                                        $val_qty = in_array('QTY',$colmissingnew);
                                        $val_misdamg = in_array('Missing/damaged',$colmissingnew);
                                        $val_photo = in_array('Photo taken?',$colmissingnew);
                                        $val_damage = in_array('Damage details',$colmissingnew);
                                        $val_acti = in_array('Action taken',$colmissingnew);

                        @endphp
                        <!-- Part Description-->
                        @if(!empty($val_arr))
                            @php
                                $val = 'Part Description';

                            @endphp
                        @else
                            @php
                                $val = '';

                            @endphp
                        @endif
                        @if(!empty($val_arr))
                            @php
                                $prtdeshiddden = '';

                            @endphp
                        @else
                            @php
                                $prtdeshiddden = 'hidden';

                            @endphp
                        @endif
                        <!-- QTY-->
                        @if(!empty($val_qty))
                            @php
                                $valqty = 'QTY';

                            @endphp
                        @else
                            @php
                                $valqty = '';

                            @endphp
                        @endif
                        @if(!empty($val_qty))
                            @php
                                $qqtyhiddden = '';

                            @endphp
                        @else
                            @php
                                $qqtyhiddden = 'hidden';

                            @endphp
                        @endif

                        <!-- Mising/damage-->
                        @if(!empty($val_misdamg))
                            @php
                                $valmis = 'Missing/damaged';

                            @endphp
                        @else
                            @php
                                $valmis = '';

                            @endphp
                        @endif
                        @if(!empty($val_misdamg))
                            @php
                                $mishiddden = '';

                            @endphp
                        @else
                            @php
                                $mishiddden = 'hidden';

                            @endphp
                        @endif
                        <!-- Photo-->
                        @if(!empty($val_photo))
                            @php
                                $valphoto = 'Photo taken?';

                            @endphp
                        @else
                            @php
                                $valphoto = '';

                            @endphp
                        @endif
                        @if(!empty($val_photo))
                            @php
                                $phohiddden = '';

                            @endphp
                        @else
                            @php
                                $phohiddden = 'hidden';

                            @endphp
                        @endif

                        <!-- Damage details-->
                        @if(!empty($val_damage))
                            @php
                                $valdam = 'Damage details';

                            @endphp
                        @else
                            @php
                                $valdam = '';

                            @endphp
                        @endif
                        @if(!empty($val_damage))
                            @php
                                $damhiddden = '';

                            @endphp
                        @else
                            @php
                                $damhiddden = 'hidden';

                            @endphp
                        @endif
                        <!-- Action taken-->
                            @if(!empty($val_acti))
                                @php
                                    $valact = 'Action taken';

                                @endphp
                            @else
                                @php
                                    $valact = '';

                                @endphp
                            @endif
                            @if(!empty($val_acti))
                                @php
                                    $acthiddden = '';

                                @endphp
                            @else
                                @php
                                    $acthiddden = 'hidden';

                                @endphp
                            @endif

                            @if($showmissing!=null && count($showmissing)!=0 )

                                @php

                                    $row = 0;

                                @endphp


                                @foreach($showmissing as $shmis)




                                    <div class="row" >

                                        <div class="col-2"{{$prtdeshiddden}}>

                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$val}}</label>

                                                <textarea type="text" name="description[]" class="form-control" placeholder="Part Description" rows="1">{{$shmis->description}}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-md-1" {{$qqtyhiddden}}>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$valqty}}</label>
                                                <input type="text" name="qty[]" class="form-control" placeholder="QTY" value="{{$shmis->qty}}">
                                            </div>
                                        </div>

                                        <div class="col" {{$mishiddden}}>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$valmis}}</label>
                                                <textarea type="text" name="missing_damage[]" class="form-control" placeholder="Missing/ Damaged" rows="1">{{$shmis->missing_damage}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-2" {{$phohiddden}}>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$valphoto}}</label>
                                                <div class="custom-control custom-control custom-radio">
                                                    <input name="photo[{{$row}}]" class="custom-control-input" id="photoy1[{{$row}}]" type="radio" value="yes" {{$shmis->photo=='yes'?'checked':''}}>
                                                    <label class="custom-control-label" for="photoy1[{{$row}}]">Yes</label>
                                                </div>
                                                <div class="custom-control custom-control custom-radio">
                                                    <input name="photo[{{$row}}]" class="custom-control-input" id="photon1[{{$row}}]" type="radio" value="no" {{$shmis->photo=='no'?'checked':''}}>
                                                    <label class="custom-control-label" for="photon1[{{$row}}]">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col" {{$damhiddden}}>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$valdam}}</label>
                                                <textarea type="text" name="damage_details[]" class="form-control" placeholder="Damage Details" rows="1">{{$shmis->damage_details}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col" {{$acthiddden}}>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$valact}}</label>
                                                <textarea type="text" name="action_taken[]" class="form-control" placeholder="Action taken" rows="1">{{$shmis->action_taken}}</textarea>
                                            </div>
                                        </div>

                                        @if($row == 0)
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


                                @php
                                    $row++;
                                @endphp

                            @else
                                <div class="row">
                                    <div class="col-2"{{$prtdeshiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$val}}</label>
                                            <textarea type="text" name="description[]" class="form-control" placeholder="Part Description" rows="1"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-1" {{$qqtyhiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$valqty}}</label>
                                            <input type="text" name="qty[]" class="form-control" placeholder="QTY">
                                        </div>
                                    </div>

                                    <div class="col"{{$mishiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$valmis}}</label>
                                            <textarea type="text" name="missing_damage[]" class="form-control" placeholder="Missing/ Damaged" rows="1"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-2"{{$phohiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$valphoto}}</label>
                                            <div class="custom-control custom-control custom-radio">
                                                <input name="photo[{{$i}}]" class="custom-control-input" id="photoy1[{{$i}}]" type="radio" value="yes">
                                                <label class="custom-control-label" for="photoy1[{{$i}}]">Yes</label>
                                            </div>
                                            <div class="custom-control custom-control custom-radio">
                                                <input name="photo[{{$i}}]" class="custom-control-input" id="photon1[{{$i}}]" type="radio" value="no">
                                                <label class="custom-control-label" for="photon1[{{$i}}]">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col"{{$damhiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$valdam}}</label>
                                            <textarea type="text" name="damage_details[]" class="form-control" placeholder="Damage Details" rows="1"></textarea>
                                        </div>
                                    </div>

                                    <div class="col"{{$acthiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$valact}}</label>
                                            <textarea type="text" name="action_taken[]" class="form-control" placeholder="Action taken" rows="1"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                    </div>
                                </div>
                            @endif

                        </div>
                        @php
                            $i++;
                        @endphp

                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole


                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">


                        @if((isset($showmissing[0]->id)&& $showmissing[0]->work_done==0)||!isset($showmissing[0]->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif
                    </form>
                    <!-- pre-history form end -->

                </div>
            </div>
        </div>

        <!-- Parts Inspection Report (S440 Engine)  -->
        @if(!empty($sec_prtinsp))
            @php
                $prtinsphiddden = '';

            @endphp
        @else
            @php
                $prtinsphiddden = 'hidden';

            @endphp
        @endif


        <div class="card"{{$prtinsphiddden}}>
            <div class="card-header" id="partsinceptionreport">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#partsinception" aria-expanded="false" aria-controls="partsinception">
                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==8)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach
                    </button>
                </h2>
            </div>
            <div id="partsinception" class="collapse" aria-labelledby="partsinceptionreport" data-parent="#checkSheet">
                <div class="card-body">


                    <div id="cylinder-collape">
                    @php

                        $schld = 0;
                    @endphp
                    @if(!empty($childsec))
                        @foreach($childsec as $newchild)
                            @php

                                $sectionchild[$schld] = $newchild['child_section'];
                                                    $schld++;

                            @endphp
                        @endforeach


                        @php
                            //echo "<pre>";print_r($sectionchild);exit;
                                            $val_cylblok = in_array('Cylinder Block Inspection',$sectionchild);
                                            $val_crank = in_array('Crankshaft Inspection',$sectionchild);
                                            $val_camshf = in_array('Camshaft Inspection',$sectionchild);
                                            $val_conrd = in_array('Connecting Rod Inspection',$sectionchild);
                                            $val_cylihed = in_array('Cylinder Head & Oil Cooler Inspection',$sectionchild);
                                            $val_othcom = in_array('Other Component Inspection',$sectionchild);
                                            $val_water = in_array('Water Pump Inspection',$sectionchild);
                                            $val_fandr = in_array('Fan Drive',$sectionchild);
                                            $val_oil = in_array('Oil Pump',$sectionchild);
                                            $val_air = in_array('Air Compressor',$sectionchild);
                                            $val_cool = in_array('Coolers Inspection',$sectionchild);
                                            $val_clpak = in_array('Clutch pack thickness inspection table',$sectionchild);
                                            $val_clplat = in_array('Clutch plate thickness inspection',$sectionchild);
                                            $val_clplatflt = in_array('Clutch plate flatness inspection',$sectionchild);
                                            $val_torq = in_array('Torque converter inside clearance inspection table',$sectionchild);
                                            $val_roll = in_array('Roller Inspection',$sectionchild);
                                            $val_idlr = in_array('Idler Inspection',$sectionchild);


                        @endphp
                    @endif

                    <!-- 1.	Cylinder Block Inspection  -->
                        @if(!empty($val_cylblok))
                            @php
                                $cyblockhiddden = '';

                            @endphp
                        @else
                            @php
                                $cyblockhiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card"{{$cyblockhiddden}}>
                            <div class="card-header" id="cylinderinspectionreport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#cylinderInspection" aria-expanded="false" aria-controls="cylinderInspection">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==1)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="cylinderInspection" class="collapse" aria-labelledby="cylinderinspectionreport" data-parent="#cylinder-collape">
                                @if(!empty($sec_main))
                                    @php
                                        $mainbehiddden = '';

                                    @endphp
                                @else
                                    @php
                                        $mainbehiddden = 'hidden';

                                    @endphp
                                @endif

                                <div class="card-body" {{$mainbehiddden}}>
                                    <h2>Main Bearing Table</h2>
                                    <form method="post" action="{{url('admin/check-gate-partinspection-cylinderblock-dis-save')}}" enctype="multipart/form-data">
                                        <h4 class="border-bottom">Front Position</h4>
                                        <div class="table-resaponsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="thead-light">
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp


                                                @foreach($cylinhed as $cyhd)
                                                    @if($showcylinderblock!=Null)
                                                        @php
                                                            $partcylinder=array_search($cyhd->front,$showcylinderblock->checkquestion);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="checkquestion[{{$i}}]" value="{{$cyhd->front}}">
                                                                    <input type="text" placeholder="AA" name="frontA1[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->frontA1[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA2[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->frontA2[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA3[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->frontA3[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA4[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->frontA4[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA5[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->frontA5[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" rows="1" name="frontAremarks[{{$i}}]" id="comment">@if($showcylinderblock!=Null){{$showcylinderblock->frontAremarks[$partcylinder]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="checkquestion[{{$i}}]" value="{{$cyhd->front}}">
                                                                    <input type="text" placeholder="AA" name="frontA1[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA2[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA3[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA4[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA5[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" rows="1" name="frontAremarks[{{$i}}]" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <ul class="list-group list-group-flush list mb-3 hard-to-choose">

                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center">
                                                    <div class="col-3"><h4 class="mb-0">Center line of the bore checked</h4></div>
                                                    <div class="col-2">
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylinderblock!=Null)
                                                                <input name="frontcenter[3]" class="custom-control-input" id="frcenyes{{$i}}" type="radio" value="yes"  {{$myArray[3]=='yes'?'checked':''}}>
                                                            @else
                                                                <input name="frontcenter[3]" class="custom-control-input" id="frcenyes{{$i}}" type="radio" value="yes">
                                                            @endif
                                                            <label class="custom-control-label" for="frcenyes{{$i}}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylinderblock!=Null)
                                                                <input name="frontcenter[{{$i}}]" class="custom-control-input" id="frcenno{{$i}}" type="radio" value="no" {{$myArray[3]=='no'?'checked':''}}>
                                                            @else
                                                                <input name="frontcenter[{{$i}}]" class="custom-control-input" id="frcenno{{$i}}" type="radio" value="no">
                                                            @endif
                                                            <label class="custom-control-label" for="frcenno{{$i}}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-1"><h4 class="mb-0">Results</h4></div>
                                                    <div class="col-2">
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylinderblock!=Null)
                                                                <input name="frontresult[{{$i}}]" class="custom-control-input" id="ryes{{$i}}" type="radio" value="yes" {{$frntreslt[3]=='yes'?'checked':''}}>
                                                            @else
                                                                <input name="frontresult[{{$i}}]" class="custom-control-input" id="ryes{{$i}}" type="radio" value="yes" >
                                                            @endif
                                                            <label class="custom-control-label" for="ryes{{$i}}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylinderblock!=Null)
                                                                <input name="frontresult[{{$i}}]" class="custom-control-input" id="rno{{$i}}" type="radio" value="no" {{$frntreslt[3]=='no'?'checked':''}}>
                                                            @else
                                                                <input name="frontresult[{{$i}}]" class="custom-control-input" id="rno{{$i}}" type="radio" value="no">
                                                            @endif
                                                            <label class="custom-control-label" for="rno{{$i}}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group mb-0">
                                                            @if($showcylinderblock == Null)
                                                            <textarea placeholder="Remarks" name="mainfrontremarks[{{$i}}]" class="form-control" rows="1" id="Remarks"></textarea>
                                                            @else
                                                            <textarea placeholder="Remarks" name="mainfrontremarks[{{$i}}]" class="form-control" rows="1" id="Remarks">{{$frtmainrst[3]}}</textarea>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                            </li>

                                        </ul>

                                        <!-- scnd table start -->
                                        <h4 class="border-bottom">Rear Position</h4>
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="table-dark">
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp


                                                @foreach($cylinhed as $cyhd)
                                                    @if($showcylinderblock!=Null)
                                                        @php
                                                            $partcylindernew=array_search($cyhd->rear,$showcylinderblock->rearquestion);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="rearquestion[{{$i}}]" value="{{$cyhd->rear}}">
                                                                    <input type="text" placeholder="AA" name="rearA1[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->rearA1[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">


                                                                    <input type="text" placeholder="AA" name="rearA2[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->rearA2[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA3[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->rearA3[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA4[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->rearA4[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA5[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->rearA5[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" name="rearAremarks[{{$i}}]" rows="1" id="comment">@if($showcylinderblock!=Null){{$showcylinderblock->rearAremarks[$partcylindernew]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="rearquestion[{{$i}}]" value="{{$cyhd->rear}}">
                                                                    <input type="text" placeholder="AA" name="rearA1[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->rearA1[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">


                                                                    <input type="text" placeholder="AA" name="rearA2[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->rearA2[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA3[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->rearA3[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA4[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->rearA4[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA5[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->rearA5[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" name="rearAremarks[{{$i}}]" rows="1" id="comment">@if($showcylinderblock!=Null){{$showcylinderblock->rearAremarks[$partcylindernew]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <ul class="list-group list-group-flush list mb-3 hard-to-choose">
                                            <li class="list-group-item px-0">

                                                <div class="row align-items-center">
                                                    <div class="col-3"><h4 class="mb-0">Center line of the bore checked</h4></div>
                                                    <div class="col-2">
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylinderblock!=Null)
                                                                <input name="centerresult[{{$i}}]" class="custom-control-input" id="rearyes{{$i}}" type="radio" value="yes" {{$rearcenteryes[3]=='yes'?'checked':''}}>
                                                            @else
                                                                <input name="centerresult[{{$i}}]" class="custom-control-input" id="rearyes{{$i}}" type="radio" value="yes">
                                                            @endif
                                                            <label class="custom-control-label" for="rearyes{{$i}}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylinderblock!=Null)
                                                                <input name="centerresult[{{$i}}]" class="custom-control-input" id="rearno{{$i}}" type="radio" value="no" {{$rearcenteryes[3]=='no'?'checked':''}}>
                                                            @else
                                                                <input name="centerresult[{{$i}}]" class="custom-control-input" id="rearno{{$i}}" type="radio" value="no">
                                                            @endif
                                                            <label class="custom-control-label" for="rearno{{$i}}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-1"><h4 class="mb-0">Results</h4></div>
                                                    <div class="col-2">
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylinderblock!=Null)
                                                                <input name="rearresults[{{$i}}]" class="custom-control-input" id="reresul{{$i}}" type="radio" value="yes" {{$rearresyes[3]=='yes'?'checked':''}}>
                                                            @else
                                                                <input name="rearresults[{{$i}}]" class="custom-control-input" id="reresul{{$i}}" type="radio" value="yes" >
                                                            @endif
                                                            <label class="custom-control-label" for="reresul{{$i}}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylinderblock!=Null)
                                                                <input name="rearresults[{{$i}}]" class="custom-control-input" id="reresulno{{$i}}" type="radio" value="no" {{$rearresyes[3]=='no'?'checked':''}}>
                                                            @else
                                                                <input name="rearresults[{{$i}}]" class="custom-control-input" id="reresulno{{$i}}" type="radio" value="no" >
                                                            @endif
                                                            <label class="custom-control-label" for="reresulno{{$i}}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group mb-0">
                                                            @if($showcylinderblock == Null)
                                                            <textarea placeholder="Remarks" name="mainfrontremarks[{{$i}}]" class="form-control" rows="1" id="Remarks"></textarea>
                                                            @else
                                                            <textarea placeholder="Remarks" name="mainfrontremarks[{{$i}}]" class="form-control" rows="1" id="Remarks">{{$rearremaryes[3]}}</textarea>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                            </li>
                                        </ul>

                                        @php
                                            $i++;
                                        @endphp
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalcylinderblock->id)&& $allvalcylinderblock->work_done==0)||!isset($allvalcylinderblock->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif

                                    </form>
                                </div>
                                @if(!empty($sec_lin))
                                    @php
                                        $linbehiddden = '';

                                    @endphp
                                @else
                                    @php
                                        $linbehiddden = 'hidden';

                                    @endphp
                                @endif
                                <div class="card-body" {{$linbehiddden}}>
                                    <h2>Linear Bearing Table</h2>
                                    <form method="post" action="{{url('admin/check-gate-partinspection-cylinderblock-linear-save')}}" enctype="multipart/form-data">
                                        <h4 class="border-bottom">Front Position</h4>
                                        <div class="table-resaponsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="thead-light">
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp


                                                @foreach($cylinhed as $cyhd)
                                                    @if($showcylblklinear!=Null)
                                                        @php
                                                            $partcylinder=array_search($cyhd->front,$showcylblklinear->checkquestion);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="checkquestion[{{$i}}]" value="{{$cyhd->front}}">
                                                                    <input type="text" placeholder="AA" name="frontA1[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->frontA1[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA2[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->frontA2[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA3[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->frontA3[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA4[{{$i}}]" class="form-control" id="usr" value="@if($showcylinderblock!=Null){{$showcylinderblock->frontA4[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA5[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->frontA5[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" rows="1" name="frontAremarks[{{$i}}]" id="comment">@if($showcylblklinear!=Null){{$showcylblklinear->frontAremarks[$partcylinder]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="checkquestion[{{$i}}]" value="{{$cyhd->front}}">
                                                                    <input type="text" placeholder="AA" name="frontA1[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA2[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA3[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA4[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA5[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" rows="1" name="frontAremarks[{{$i}}]" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <ul class="list-group list-group-flush list mb-3 hard-to-choose">

                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center">
                                                    <div class="col-3"><h4 class="mb-0">Center line of the bore checked</h4></div>
                                                    <div class="col-2">
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblklinear!=Null)
                                                                <input name="linearfrontcenter[3]" class="custom-control-input" id="linfrcenyes{{$i}}" type="radio" value="yes"  {{$linArray[3]=='yes'?'checked':''}}>
                                                            @else
                                                                <input name="linearfrontcenter[3]" class="custom-control-input" id="linfrcenyes{{$i}}" type="radio" value="yes">
                                                            @endif
                                                            <label class="custom-control-label" for="linfrcenyes{{$i}}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblklinear!=Null)
                                                                <input name="linearfrontcenter[{{$i}}]" class="custom-control-input" id="linfrcenno{{$i}}" type="radio" value="no" {{$linArray[3]=='no'?'checked':''}}>
                                                            @else
                                                                <input name="linearfrontcenter[{{$i}}]" class="custom-control-input" id="linfrcenno{{$i}}" type="radio" value="no">
                                                            @endif
                                                            <label class="custom-control-label" for="linfrcenno{{$i}}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-1"><h4 class="mb-0">Results</h4></div>
                                                    <div class="col-2">
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblklinear!=Null)
                                                                <input name="linfrontresult[{{$i}}]" class="custom-control-input" id="linryes{{$i}}" type="radio" value="yes" {{$linfrntreslt[3]=='yes'?'checked':''}}>
                                                            @else
                                                                <input name="linfrontresult[{{$i}}]" class="custom-control-input" id="linryes{{$i}}" type="radio" value="yes" >
                                                            @endif
                                                            <label class="custom-control-label" for="linryes{{$i}}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblklinear!=Null)
                                                                <input name="linfrontresult[{{$i}}]" class="custom-control-input" id="linrno{{$i}}" type="radio" value="no" {{$linfrntreslt[3]=='no'?'checked':''}}>
                                                            @else
                                                                <input name="linfrontresult[{{$i}}]" class="custom-control-input" id="linrno{{$i}}" type="radio" value="no">
                                                            @endif
                                                            <label class="custom-control-label" for="linrno{{$i}}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group mb-0">

                                                            @if($showcylinderblock == Null)
                                                            <textarea placeholder="Remarks" name="mainfrontremarks[{{$i}}]" class="form-control" rows="1" id="Remarks"></textarea>
                                                            @else
                                                            <textarea placeholder="Remarks" name="mainfrontremarks[{{$i}}]" class="form-control" rows="1" id="Remarks">{{$linfrtmainrst[3]}}</textarea>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                            </li>

                                        </ul>

                                        <!-- scnd table start -->
                                        <h4 class="border-bottom">Rear Position</h4>
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="table-dark">
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp


                                                @foreach($cylinhed as $cyhd)
                                                    @if($showcylblklinear!=Null)
                                                        @php
                                                            $partcylindernew=array_search($cyhd->rear,$showcylblklinear->rearquestion);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="rearquestion[{{$i}}]" value="{{$cyhd->rear}}">
                                                                    <input type="text" placeholder="AA" name="rearA1[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->rearA1[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">


                                                                    <input type="text" placeholder="AA" name="rearA2[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->rearA2[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA3[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->rearA3[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA4[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->rearA4[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA5[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->rearA5[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" name="rearAremarks[{{$i}}]" rows="1" id="comment">@if($showcylblklinear!=Null){{$showcylblklinear->rearAremarks[$partcylindernew]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="rearquestion[{{$i}}]" value="{{$cyhd->rear}}">
                                                                    <input type="text" placeholder="AA" name="rearA1[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->rearA1[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">


                                                                    <input type="text" placeholder="AA" name="rearA2[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->rearA2[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA3[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->rearA3[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA4[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->rearA4[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA5[{{$i}}]" class="form-control" id="usr" value="@if($showcylblklinear!=Null){{$showcylblklinear->rearA5[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" name="rearAremarks[{{$i}}]" rows="1" id="comment">@if($showcylblklinear!=Null){{$showcylblklinear->rearAremarks[$partcylindernew]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <ul class="list-group list-group-flush list mb-3 hard-to-choose">
                                            <li class="list-group-item px-0">

                                                <div class="row align-items-center">
                                                    <div class="col-3"><h4 class="mb-0">Center line of the bore checked</h4></div>
                                                    <div class="col-2">
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblklinear!=Null)
                                                                <input name="lincenterresult[{{$i}}]" class="custom-control-input" id="linrearyes{{$i}}" type="radio" value="yes" {{$linrearcenteryes[3]=='yes'?'checked':''}}>
                                                            @else
                                                                <input name="lincenterresult[{{$i}}]" class="custom-control-input" id="linrearyes{{$i}}" type="radio" value="yes">
                                                            @endif
                                                            <label class="custom-control-label" for="linrearyes{{$i}}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblklinear!=Null)
                                                                <input name="lincenterresult[{{$i}}]" class="custom-control-input" id="linrearno{{$i}}" type="radio" value="no" {{$linrearcenteryes[3]=='no'?'checked':''}}>
                                                            @else
                                                                <input name="lincenterresult[{{$i}}]" class="custom-control-input" id="linrearno{{$i}}" type="radio" value="no">
                                                            @endif
                                                            <label class="custom-control-label" for="linrearno{{$i}}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-1"><h4 class="mb-0">Results</h4></div>
                                                    <div class="col-2">
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblklinear!=Null)
                                                                <input name="linrearresults[{{$i}}]" class="custom-control-input" id="linreresul{{$i}}" type="radio" value="yes" {{$linrearresyes[3]=='yes'?'checked':''}}>
                                                            @else
                                                                <input name="linrearresults[{{$i}}]" class="custom-control-input" id="linreresul{{$i}}" type="radio" value="yes" >
                                                            @endif
                                                            <label class="custom-control-label" for="linreresul{{$i}}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblklinear!=Null)
                                                                <input name="linrearresults[{{$i}}]" class="custom-control-input" id="linreresulno{{$i}}" type="radio" value="no" {{$linrearresyes[3]=='no'?'checked':''}}>
                                                            @else
                                                                <input name="linrearresults[{{$i}}]" class="custom-control-input" id="linreresulno{{$i}}" type="radio" value="no" >
                                                            @endif
                                                            <label class="custom-control-label" for="linreresulno{{$i}}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group mb-0">

                                                            @if($showcylblklinear == Null)
                                                            <textarea placeholder="Remarks" name="mainfrontremarks[{{$i}}]" class="form-control" rows="1" id="Remarks"></textarea>
                                                            @else
                                                            <textarea placeholder="Remarks" name="mainfrontremarks[{{$i}}]" class="form-control" rows="1" id="Remarks">{{$linrearremaryes[3]}}</textarea>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                            </li>
                                        </ul>

                                        @php
                                            $i++;
                                        @endphp
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalcylblkliner->id)&& $allvalcylblkliner->work_done==0)||!isset($allvalcylblkliner->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif

                                    </form>
                                </div>
                                @if(!empty($sec_cycambore))
                                    @php
                                        $cycamhiddden = '';

                                    @endphp
                                @else
                                    @php
                                        $cycamhiddden = 'hidden';

                                    @endphp
                                @endif
                                <div class="card-body" {{$cycamhiddden}}>
                                    <h2>Cam Bore Measurement Table</h2>
                                    <form method="post" action="{{url('admin/check-gate-partinspection-cylinderblock-cambore-save')}}" enctype="multipart/form-data">
                                        <h4 class="border-bottom">Front Position</h4>
                                        <div class="table-resaponsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="thead-light">
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp


                                                @foreach($cylinhed as $cyhd)
                                                    @if($showcylblkcam!=Null)
                                                        @php
                                                            $partcylinder=array_search($cyhd->front,$showcylblkcam->checkquestion);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="checkquestion[{{$i}}]" value="{{$cyhd->front}}">
                                                                    <input type="text" placeholder="AA" name="frontA1[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->frontA1[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA2[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->frontA2[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA3[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->frontA3[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA4[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->frontA4[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA5[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->frontA5[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" rows="1" name="frontAremarks[{{$i}}]" id="comment">@if($showcylblkcam!=Null){{$showcylblkcam->frontAremarks[$partcylinder]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="checkquestion[{{$i}}]" value="{{$cyhd->front}}">
                                                                    <input type="text" placeholder="AA" name="frontA1[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA2[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA3[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA4[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA5[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" rows="1" name="frontAremarks[{{$i}}]" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <ul class="list-group list-group-flush list mb-3 hard-to-choose">

                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center">
                                                    <div class="col-3"><h4 class="mb-0">Center line of the bore checked</h4></div>
                                                    <div class="col-2">
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblkcam!=Null)
                                                                <input name="camfrontcenter[3]" class="custom-control-input" id="camfrcenyes{{$i}}" type="radio" value="yes"  {{$camArray[3]=='yes'?'checked':''}}>
                                                            @else
                                                                <input name="camfrontcenter[3]" class="custom-control-input" id="camfrcenyes{{$i}}" type="radio" value="yes">
                                                            @endif
                                                            <label class="custom-control-label" for="camfrcenyes{{$i}}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblkcam!=Null)
                                                                <input name="camfrontcenter[{{$i}}]" class="custom-control-input" id="camfrcenno{{$i}}" type="radio" value="no" {{$camArray[3]=='no'?'checked':''}}>
                                                            @else
                                                                <input name="camfrontcenter[{{$i}}]" class="custom-control-input" id="camfrcenno{{$i}}" type="radio" value="no">
                                                            @endif
                                                            <label class="custom-control-label" for="camfrcenno{{$i}}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-1"><h4 class="mb-0">Results</h4></div>
                                                    <div class="col-2">
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblkcam!=Null)
                                                                <input name="camfrontresult[{{$i}}]" class="custom-control-input" id="camryes{{$i}}" type="radio" value="yes" {{$camfrntreslt[3]=='yes'?'checked':''}}>
                                                            @else
                                                                <input name="camfrontresult[{{$i}}]" class="custom-control-input" id="camryes{{$i}}" type="radio" value="yes" >
                                                            @endif
                                                            <label class="custom-control-label" for="camryes{{$i}}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblkcam!=Null)
                                                                <input name="camfrontresult[{{$i}}]" class="custom-control-input" id="camrno{{$i}}" type="radio" value="no" {{$camfrntreslt[3]=='no'?'checked':''}}>
                                                            @else
                                                                <input name="camfrontresult[{{$i}}]" class="custom-control-input" id="camrno{{$i}}" type="radio" value="no">
                                                            @endif
                                                            <label class="custom-control-label" for="camrno{{$i}}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group mb-0">

                                                            @if($showcylblkcam == Null)
                                                            <textarea placeholder="Remarks" name="mainfrontremarks[{{$i}}]" class="form-control" rows="1" id="Remarks"></textarea>
                                                            @else
                                                            <textarea placeholder="Remarks" name="mainfrontremarks[{{$i}}]" class="form-control" rows="1" id="Remarks">{{$camfrtmainrst[3]}}</textarea>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                            </li>

                                        </ul>

                                        <!-- scnd table start -->
                                        <h4 class="border-bottom">Rear Position</h4>
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="table-dark">
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp


                                                @foreach($cylinhed as $cyhd)
                                                    @if($showcylblkcam!=Null)
                                                        @php
                                                            $partcylindernew=array_search($cyhd->rear,$showcylblkcam->rearquestion);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="rearquestion[{{$i}}]" value="{{$cyhd->rear}}">
                                                                    <input type="text" placeholder="AA" name="rearA1[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->rearA1[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">


                                                                    <input type="text" placeholder="AA" name="rearA2[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->rearA2[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA3[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->rearA3[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA4[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->rearA4[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA5[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->rearA5[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" name="rearAremarks[{{$i}}]" rows="1" id="comment">@if($showcylblkcam!=Null){{$showcylblkcam->rearAremarks[$partcylindernew]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="rearquestion[{{$i}}]" value="{{$cyhd->rear}}">
                                                                    <input type="text" placeholder="AA" name="rearA1[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->rearA1[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">


                                                                    <input type="text" placeholder="AA" name="rearA2[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->rearA2[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA3[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->rearA3[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA4[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->rearA4[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA5[{{$i}}]" class="form-control" id="usr" value="@if($showcylblkcam!=Null){{$showcylblkcam->rearA5[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" name="rearAremarks[{{$i}}]" rows="1" id="comment">@if($showcylblkcam!=Null){{$showcylblkcam->rearAremarks[$partcylindernew]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <ul class="list-group list-group-flush list mb-3 hard-to-choose">
                                            <li class="list-group-item px-0">

                                                <div class="row align-items-center">
                                                    <div class="col-3"><h4 class="mb-0">Center line of the bore checked</h4></div>
                                                    <div class="col-2">
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblkcam!=Null)
                                                                <input name="camcenterresult[{{$i}}]" class="custom-control-input" id="camrearyes{{$i}}" type="radio" value="yes" {{$camrearcenteryes[3]=='yes'?'checked':''}}>
                                                            @else
                                                                <input name="camcenterresult[{{$i}}]" class="custom-control-input" id="camrearyes{{$i}}" type="radio" value="yes">
                                                            @endif
                                                            <label class="custom-control-label" for="camrearyes{{$i}}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblkcam!=Null)
                                                                <input name="camcenterresult[{{$i}}]" class="custom-control-input" id="camrearno{{$i}}" type="radio" value="no" {{$camrearcenteryes[3]=='no'?'checked':''}}>
                                                            @else
                                                                <input name="camcenterresult[{{$i}}]" class="custom-control-input" id="camrearno{{$i}}" type="radio" value="no">
                                                            @endif
                                                            <label class="custom-control-label" for="camrearno{{$i}}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-1"><h4 class="mb-0">Results</h4></div>
                                                    <div class="col-2">
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblkcam!=Null)
                                                                <input name="camrearresults[{{$i}}]" class="custom-control-input" id="camreresul{{$i}}" type="radio" value="yes" {{$camrearresyes[3]=='yes'?'checked':''}}>
                                                            @else
                                                                <input name="camrearresults[{{$i}}]" class="custom-control-input" id="camreresul{{$i}}" type="radio" value="yes" >
                                                            @endif
                                                            <label class="custom-control-label" for="camreresul{{$i}}">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showcylblkcam!=Null)
                                                                <input name="camrearresults[{{$i}}]" class="custom-control-input" id="camreresulno{{$i}}" type="radio" value="no" {{$camrearresyes[3]=='no'?'checked':''}}>
                                                            @else
                                                                <input name="camrearresults[{{$i}}]" class="custom-control-input" id="camreresulno{{$i}}" type="radio" value="no" >
                                                            @endif
                                                            <label class="custom-control-label" for="camreresulno{{$i}}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group mb-0">
                                                            @if($showcylblkcam == Null)
                                                            <textarea placeholder="Remarks" name="mainfrontremarks[{{$i}}]" class="form-control" rows="1" id="Remarks"></textarea>
                                                            @else
                                                            <textarea placeholder="Remarks" name="mainfrontremarks[{{$i}}]" class="form-control" rows="1" id="Remarks">{{$camrearremaryes[3]}}</textarea>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>


                                                </div>
                                            </li>
                                        </ul>

                                        @php
                                            $i++;
                                        @endphp
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalcylblkcam->id)&& $allvalcylblkcam->work_done==0)||!isset($allvalcylblkcam->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif

                                    </form>
                                </div>
                                @if(!empty($sec_cytddeck))
                                    @php
                                        $cytophiddden = '';

                                    @endphp
                                @else
                                    @php
                                        $cytophiddden = 'hidden';

                                    @endphp
                                @endif
                                <div class="card-body" {{$cytophiddden}}>
                                    <h2>Top Deck Measurement Table</h2>
                                    <form method="post" action="{{url('admin/check-gate-partinspection-cylinderblock-topdeck-save')}}" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                            @php
                                                $i=0;
                                            @endphp
                                            <!-- dynamic repeater wrapper -->
                                                <div class="missing-damaged-part-repeat">


                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Parameter</th>
                                                        <th>Values</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                    </thead>
                                                    @php
                                                        $i=0;
                                                    @endphp
                                                    @foreach($cylindertop as $topdeck)
                                                        @if($showcytopdk!=Null)
                                                            @php
                                                                $cylintop=array_search($topdeck->parameter,$showcytopdk->parameter);
                                                            @endphp
                                                            <tbody>
                                                            <tr>
                                                                <td>{{$topdeck->parameter}}</td>
                                                                <td >
                                                                    <input type="hidden" name="parameter[{{$s}}]" value="{{$topdeck->parameter}}">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="results[{{$s}}]" value="{{$showcytopdk->results[$s]}}">
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="Remarks" rows="1" name="cylinderremarks[{{$s}}]" id="comment">{{$showcytopdk->cylinderremarks[$s]}}</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                            @php
                                                                $s++;
                                                            @endphp

                                                        @else

                                                            <tbody>
                                                            <tr>
                                                                <td>{{$topdeck->parameter}}</td>
                                                                <td>
                                                                    <input type="hidden" name="parameter[{{$i}}]" value="{{$topdeck->parameter}}">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="results[{{$i}}]" value="">
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="Remarks" rows="1" name="cylinderremarks[{{$i}}]" id="comment"></textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                @php
                                                    $i++;
                                                @endphp
                                                @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalcytopdk->id)&& $allvalcytopdk->work_done==0)||!isset($allvalcytopdk->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>
                                @if(!empty($sec_cythed))
                                    @php
                                        $cythredhiddden = '';

                                    @endphp
                                @else
                                    @php
                                        $cythredhiddden = 'hidden';

                                    @endphp
                                @endif
                                <div class="card-body" {{$cythredhiddden}}>
                                    <h2>Cylinder Block Thread Inspection</h2>
                                    <form method="post" action="{{url('admin/check-gate-partinspection-cylinderblock-thread-save')}}" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                            @php
                                                $i=0;
                                            @endphp
                                            <!-- dynamic repeater wrapper -->
                                                <div class="missing-damaged-part-repeat">


                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Parameter</th>
                                                        <th>Ok</th>
                                                        <th>Damage</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                    </thead>
                                                    @php
                                                        $i=0;
                                                    @endphp
                                                    @foreach($cylinderthred as $thread)
                                                        @if($showcythread!=Null)
                                                            @php
                                                                $cylintop=array_search($thread->parameter,$showcythread->parameter);
                                                            @endphp
                                                            <tbody>
                                                            <tr>
                                                                <td>{{$thread->parameter}}</td>
                                                                <td >
                                                                    <input type="hidden" name="parameter[{{$b}}]" value="{{$thread->parameter}}">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="ok[{{$b}}]" value="{{$showcythread->ok[$b]}}">
                                                                    </div>
                                                                </td>
                                                                <td >
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="dam[{{$b}}]" value="{{$showcythread->dam[$b]}}">
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="Remarks" rows="1" name="cylinderremarks[{{$b}}]" id="comment">{{$showcythread->cylinderremarks[$b]}}</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                            @php
                                                                $b++;
                                                            @endphp

                                                        @else

                                                            <tbody>
                                                            <tr>
                                                                <td>{{$thread->parameter}}</td>
                                                                <td>
                                                                    <input type="hidden" name="parameter[{{$i}}]" value="{{$thread->parameter}}">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="ok[{{$i}}]" value="">
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="dam[{{$i}}]" value="">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="Remarks" rows="1" name="cylinderremarks[{{$i}}]" id="comment"></textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                @php
                                                    $i++;
                                                @endphp
                                                @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalcytopdk->id)&& $allvalcytopdk->work_done==0)||!isset($allvalcytopdk->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>
                                @if(!empty($sec_cybush))
                                    @php
                                        $cybushhiddden = '';

                                    @endphp
                                @else
                                    @php
                                        $cybushhiddden = 'hidden';

                                    @endphp
                                @endif
                                <div class="card-body" {{$cybushhiddden}}>
                                    <h2>Bushing Bore Measurement Table</h2>
                                    <form method="post" action="{{url('admin/check-gate-partinspection-cylinderblock-bushbore-save')}}" enctype="multipart/form-data">
                                        <h4 class="border-bottom">Front Position</h4>
                                        <div class="table-resaponsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="thead-light">
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp


                                                @foreach($cylinhed as $cyhd)
                                                    @if($showcybush!=Null)
                                                        @php
                                                            $partcylinder=array_search($cyhd->front,$showcybush->checkquestion);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="checkquestion[{{$i}}]" value="{{$cyhd->front}}">
                                                                    <input type="text" placeholder="AA" name="frontA1[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->frontA1[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA2[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->frontA2[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA3[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->frontA3[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA4[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->frontA4[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA5[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->frontA5[$partcylinder]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" rows="1" name="frontAremarks[{{$i}}]" id="comment">@if($showcybush!=Null){{$showcybush->frontAremarks[$partcylinder]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="checkquestion[{{$i}}]" value="{{$cyhd->front}}">
                                                                    <input type="text" placeholder="AA" name="frontA1[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA2[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA3[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA4[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="frontA5[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" rows="1" name="frontAremarks[{{$i}}]" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>



                                        <!-- scnd table start -->
                                        <h4 class="border-bottom">Rear Position</h4>
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="table-dark">
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp


                                                @foreach($cylinhed as $cyhd)
                                                    @if($showcybush!=Null)
                                                        @php
                                                            $partcylindernew=array_search($cyhd->rear,$showcybush->rearquestion);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="rearquestion[{{$i}}]" value="{{$cyhd->rear}}">
                                                                    <input type="text" placeholder="AA" name="rearA1[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->rearA1[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">


                                                                    <input type="text" placeholder="AA" name="rearA2[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->rearA2[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA3[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->rearA3[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA4[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->rearA4[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA5[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->rearA5[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" name="rearAremarks[{{$i}}]" rows="1" id="comment">@if($showcybush!=Null){{$showcybush->rearAremarks[$partcylindernew]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="hidden" name="rearquestion[{{$i}}]" value="{{$cyhd->rear}}">
                                                                    <input type="text" placeholder="AA" name="rearA1[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->rearA1[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">


                                                                    <input type="text" placeholder="AA" name="rearA2[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->rearA2[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA3[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->rearA3[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA4[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->rearA4[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <input type="text" placeholder="AA" name="rearA5[{{$i}}]" class="form-control" id="usr" value="@if($showcybush!=Null){{$showcybush->rearA5[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">

                                                                    <textarea class="form-control" name="rearAremarks[{{$i}}]" rows="1" id="comment">@if($showcybush!=Null){{$showcybush->rearAremarks[$partcylindernew]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>



                                        @php
                                            $i++;
                                        @endphp
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalcybush->id)&& $allvalcybush->work_done==0)||!isset($allvalcybush->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif

                                    </form>
                                </div>
                                @if(!empty($sec_maicap))
                                    @php
                                        $capwihiddden = '';

                                    @endphp
                                @else
                                    @php
                                        $capwihiddden = 'hidden';

                                    @endphp
                                @endif
                                <div class="card-body" {{$capwihiddden}}>
                                    <h2>Cap Width Measurement Table</h2>
                                    <form method="post" action="{{url('admin/check-gate-partinspection-cylinderblock-capno-save')}}" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                            @php
                                                $i=0;
                                            @endphp
                                            <!-- dynamic repeater wrapper -->
                                                <div class="missing-damaged-part-repeat">


                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Parameter</th>
                                                        <th>1</th>
                                                        <th>2</th>
                                                        <th>3</th>
                                                        <th>4</th>
                                                        <th>5</th>
                                                        <th>6</th>
                                                        <th>7</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                    </thead>
                                                    @php
                                                        $i=0;
                                                    @endphp
                                                    @foreach($cylindercapclr as $cpclr)
                                                        @if($showcycap!=Null)
                                                            @php
                                                                $cylintop=array_search($cpclr->parameter,$showcycap->parameter);
                                                            @endphp
                                                            <tbody>
                                                            <tr>
                                                                <td>{{$cpclr->parameter}}</td>
                                                                <td >
                                                                    <input type="hidden" name="parameter[{{$c}}]" value="{{$cpclr->parameter}}">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val1[{{$c}}]" value="{{$showcycap->val1[$c]}}">
                                                                    </div>
                                                                </td>
                                                                <td >

                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val2[{{$c}}]" value="{{$showcycap->val2[$c]}}">
                                                                    </div>
                                                                </td>
                                                                <td >

                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val3[{{$c}}]" value="{{$showcycap->val3[$c]}}">
                                                                    </div>
                                                                </td>
                                                                <td >

                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val4[{{$c}}]" value="{{$showcycap->val4[$c]}}">
                                                                    </div>
                                                                </td>
                                                                <td >

                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val5[{{$c}}]" value="{{$showcycap->val5[$c]}}">
                                                                    </div>
                                                                </td>
                                                                <td >

                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val6[{{$c}}]" value="{{$showcycap->val6[$c]}}">
                                                                    </div>
                                                                </td>
                                                                <td >

                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val7[{{$c}}]" value="{{$showcycap->val7[$c]}}">
                                                                    </div>
                                                                </td>



                                                                <td>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="Remarks" rows="1" name="cylinderremarks[{{$c}}]" id="comment">{{$showcycap->cylinderremarks[$c]}}</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                            @php
                                                                $c++;
                                                            @endphp

                                                        @else

                                                            <tbody>
                                                            <tr>
                                                                <td>{{$cpclr->parameter}}</td>
                                                                <td >
                                                                    <input type="hidden" name="parameter[{{$i}}]" value="{{$cpclr->parameter}}">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val1[{{$i}}]" value="">
                                                                    </div>
                                                                </td>
                                                                <td >

                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val2[{{$i}}]" value="">
                                                                    </div>
                                                                </td>
                                                                <td >

                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val3[{{$i}}]" value="">
                                                                    </div>
                                                                </td>
                                                                <td >

                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val4[{{$i}}]" value="">
                                                                    </div>
                                                                </td>
                                                                <td >

                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val5[{{$i}}]" value="">
                                                                    </div>
                                                                </td>
                                                                <td >

                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val6[{{$i}}]" value="">
                                                                    </div>
                                                                </td>
                                                                <td >

                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="val7[{{$i}}]" value="">
                                                                    </div>
                                                                </td>



                                                                <td>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="Remarks" rows="1" name="cylinderremarks[{{$i}}]" id="comment"></textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                @php
                                                    $i++;
                                                @endphp
                                                @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalcytopdk->id)&& $allvalcytopdk->work_done==0)||!isset($allvalcytopdk->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>

                            </div>
                        </div>

                        <!-- 2.	Crankshaft Inspection  -->

                        @if(!empty($val_crank))
                            @php
                                $crnkhiddden = '';

                            @endphp
                        @else
                            @php
                                $crnkhiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card"{{$crnkhiddden}}>
                            <div class="card-header" id="crankShaftReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#crankShaftInspection" aria-expanded="false" aria-controls="crankShaftInspection">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==2)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="crankShaftInspection" class="collapse" aria-labelledby="crankShaftReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/check-gate-partinspection-crankshaft-dis-save')}}" enctype="multipart/form-data">
                                        <h4 class="border-bottom">Main Journal</h4>
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Position</th>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp


                                                @foreach($camshaft as $cyhd)
                                                    @if($showcrankshaft!=Null)
                                                        @php
                                                            $crankshaftmainjor=array_search($cyhd->main_journal,$showcrankshaft->mainjornal);
                                                        @endphp
                                                        <tr>
                                                            <td>{{$cyhd->main_journal}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="mainjornal[{{$i}}]" value="{{$cyhd->main_journal}}">
                                                                    <input type="text" placeholder="" name="mainvalue1[{{$i}}]" class="form-control" id="usr" value="@if($showcrankshaft!=Null){{$showcrankshaft->mainvalue1[$crankshaftmainjor]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="mainvalue2[{{$i}}]" class="form-control" id="usr" value="@if($showcrankshaft!=Null){{$showcrankshaft->mainvalue2[$crankshaftmainjor]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="AA" name="mainvalue3[{{$i}}]" class="form-control" id="usr" value="@if($showcrankshaft!=Null){{$showcrankshaft->mainvalue3[$crankshaftmainjor]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="mainvalue4[{{$i}}]" class="form-control" id="usr" value="@if($showcrankshaft!=Null){{$showcrankshaft->mainvalue4[$crankshaftmainjor]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="mainvalue5[{{$i}}]" class="form-control" id="usr" value="@if($showcrankshaft!=Null){{$showcrankshaft->mainvalue5[$crankshaftmainjor]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" name="mainremarks[{{$i}}]" rows="1" id="comment">@if($showcrankshaft!=Null){{$showcrankshaft->mainremarks[$crankshaftmainjor]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @else
                                                        <tr>
                                                            <td>{{$cyhd->main_journal}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="mainjornal[{{$i}}]" value="{{$cyhd->main_journal}}">
                                                                    <input type="text" placeholder="" name="mainvalue1[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="mainvalue2[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="AA" name="mainvalue3[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="mainvalue4[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="mainvalue5[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" name="mainremarks[{{$i}}]" rows="1" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                                        <h4 class="border-bottom">Con Journal</h4>
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Position</th>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp


                                                @foreach($camshaft as $chconjrnl)
                                                    @if($showcrankshaft!=Null)
                                                        @php
                                                            $partcylindernew=array_search($chconjrnl->con_journal,$showcrankshaft->conjornal);
                                                        @endphp
                                                        <tr>
                                                            <td>{{$chconjrnl->con_journal}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="conjornal[{{$i}}]" value="{{$chconjrnl->con_journal}}">
                                                                    <input type="text" placeholder=""  name="convalue1[{{$i}}]" class="form-control" id="usr" value="@if($showcrankshaft!=Null){{$showcrankshaft->convalue1[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="convalue2[{{$i}}]" class="form-control" id="usr" value="@if($showcrankshaft!=Null){{$showcrankshaft->convalue2[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="AA" name="convalue3[{{$i}}]" class="form-control" id="usr" value="@if($showcrankshaft!=Null){{$showcrankshaft->convalue3[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="convalue4[{{$i}}]" class="form-control" id="usr" value="@if($showcrankshaft!=Null){{$showcrankshaft->convalue4[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="convalue5[{{$i}}]" class="form-control" id="usr" value="@if($showcrankshaft!=Null){{$showcrankshaft->convalue5[$partcylindernew]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" name="conremarks[{{$i}}]" rows="1" id="comment">@if($showcrankshaft!=Null){{$showcrankshaft->conremarks[$partcylindernew]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @else
                                                        <tr>
                                                            <td>{{$chconjrnl->con_journal}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="conjornal[{{$i}}]" value="{{$chconjrnl->con_journal}}">
                                                                    <input type="text" placeholder=""  name="convalue1[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="convalue2[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="AA" name="convalue3[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="convalue4[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="convalue5[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" name="conremarks[{{$i}}]" rows="1" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        @php
                                            $i=0;
                                        @endphp
                                        <ul class="list-group list-group-flush list mb-3 hard-to-choose">
                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center">
                                                    <div class="col-8"><h4 class="mb-0">Crack test report</h4></div>

                                                    <div class="col-4">
                                                        <div class="form-group mb-0">
                                                            <textarea placeholder="Remarks" name="othervalue[{{$i}}]" class="form-control" rows="1" id="Test report">@if($showcrankshaft!=Null){{$showcrankshaft->othervalue[$i]}}@endif</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        @php
                                            $i++;
                                        @endphp




                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalcranksft->id)&& $allvalcranksft->work_done==0)||!isset($allvalcranksft->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- 3.	Camshaft Inspection  -->
                        @if(!empty($val_camshf))
                            @php
                                $camshfhiddden = '';

                            @endphp
                        @else
                            @php
                                $camshfhiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card"{{$camshfhiddden}}>
                            <div class="card-header" id="camShaftReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#caShaftInspection" aria-expanded="false" aria-controls="caShaftInspection">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==3)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="caShaftInspection" class="collapse" aria-labelledby="camShaftReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/check-gate-partinspection-camshaft-dis-save')}}" enctype="multipart/form-data">
                                        <h4 class="border-bottom">CAMSHAFT MEASUREMENT TABLE</h4>
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Parameter</th>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach($cmsftdetails as $cmft)
                                                    @if($showcamshaft!=Null)
                                                        @php
                                                            $partcamsft=array_search($cmft->parameter,$showcamshaft->camshaft);
                                                        @endphp
                                                        <tr>
                                                            <td>{{$cmft->parameter}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="camshaft[{{$i}}]" value="{{$cmft->parameter}}">
                                                                    <input type="text" placeholder="" name="cam1[{{$i}}]" class="form-control" id="usr" value="@if($showcamshaft!=Null){{$showcamshaft->cam1[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam2[{{$i}}]" class="form-control" id="usr" value="@if($showcamshaft!=Null){{$showcamshaft->cam2[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam3[{{$i}}]" class="form-control" id="usr" value="@if($showcamshaft!=Null){{$showcamshaft->cam3[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam4[{{$i}}]" class="form-control" id="usr" value="@if($showcamshaft!=Null){{$showcamshaft->cam4[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" name="camremarks[{{$i}}]" rows="1" id="comment">@if($showcamshaft!=Null){{$showcamshaft->camremarks[$partcamsft]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @else
                                                        <tr>
                                                            <td>{{$cmft->parameter}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="camshaft[{{$i}}]" value="{{$cmft->parameter}}">
                                                                    <input type="text" placeholder="" name="cam1[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam2[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam3[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam4[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" name="camremarks[{{$i}}]" rows="1" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole


                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalcamsft->id)&& $allvalcamsft->work_done==0)||!isset($allvalcamsft->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>

                                @if(!empty($sec_camlh))
                                    @php
                                        $camlhhiddden = '';

                                    @endphp
                                @else
                                    @php
                                        $camlhhiddden = 'hidden';

                                    @endphp
                                @endif
                                <div class="card-body" {{$camlhhiddden}}>
                                    <form method="post" action="{{url('admin/check-gate-partinspection-lh-camshaft-dis-save')}}" enctype="multipart/form-data">
                                        <h4 class="border-bottom">LH CAMSHAFT MEASUREMENT TABLE</h4>
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Parameter</th>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>6</th>
                                                    <th>7</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach($cmsftdetails as $cmft)
                                                    @if($showlhcamshaft!=Null)
                                                        @php
                                                            $partcamsft=array_search($cmft->parameter,$showlhcamshaft->camshaft);
                                                        @endphp
                                                        <tr>
                                                            <td>{{$cmft->parameter}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="camshaft[{{$i}}]" value="{{$cmft->parameter}}">
                                                                    <input type="text" placeholder="" name="cam1[{{$i}}]" class="form-control" id="usr" value="@if($showlhcamshaft!=Null){{$showlhcamshaft->cam1[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam2[{{$i}}]" class="form-control" id="usr" value="@if($showlhcamshaft!=Null){{$showlhcamshaft->cam2[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam3[{{$i}}]" class="form-control" id="usr" value="@if($showlhcamshaft!=Null){{$showlhcamshaft->cam3[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam4[{{$i}}]" class="form-control" id="usr" value="@if($showlhcamshaft!=Null){{$showlhcamshaft->cam4[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam5[{{$i}}]" class="form-control" id="usr" value="@if($showlhcamshaft!=Null){{$showlhcamshaft->cam5[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam6[{{$i}}]" class="form-control" id="usr" value="@if($showlhcamshaft!=Null){{$showlhcamshaft->cam6[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam7[{{$i}}]" class="form-control" id="usr" value="@if($showlhcamshaft!=Null){{$showlhcamshaft->cam7[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" name="camremarks[{{$i}}]" rows="1" id="comment">@if($showlhcamshaft!=Null){{$showlhcamshaft->camremarks[$partcamsft]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @else
                                                        <tr>
                                                            <td>{{$cmft->parameter}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="camshaft[{{$i}}]" value="{{$cmft->parameter}}">
                                                                    <input type="text" placeholder="" name="cam1[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam2[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam3[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam4[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam5[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam6[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam7[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" name="camremarks[{{$i}}]" rows="1" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($showlhcamshaft->id)&& $showlhcamshaft->work_done==0)||!isset($showlhcamshaft->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>
                                @if(!empty($sec_camrh))
                                    @php
                                        $camrhhiddden = '';

                                    @endphp
                                @else
                                    @php
                                        $camrhhiddden = 'hidden';

                                    @endphp
                                @endif

                                <div class="card-body" {{$camrhhiddden}}>
                                    <form method="post" action="{{url('admin/check-gate-partinspection-rh-camshaft-dis-save')}}" enctype="multipart/form-data">
                                        <h4 class="border-bottom">RH CAMSHAFT MEASUREMENT TABLE</h4>
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Parameter</th>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>6</th>
                                                    <th>7</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach($cmsftdetails as $cmft)
                                                    @if($showrhcamshaft !=Null)
                                                        @php
                                                            $partcamsft=array_search($cmft->parameter,$showrhcamshaft ->camshaft);
                                                        @endphp
                                                        <tr>
                                                            <td>{{$cmft->parameter}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="camshaft[{{$i}}]" value="{{$cmft->parameter}}">
                                                                    <input type="text" placeholder="" name="cam1[{{$i}}]" class="form-control" id="usr" value="@if($showcamshaft!=Null){{$showrhcamshaft ->cam1[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam2[{{$i}}]" class="form-control" id="usr" value="@if($showrhcamshaft!=Null){{$showrhcamshaft ->cam2[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam3[{{$i}}]" class="form-control" id="usr" value="@if($showrhcamshaft!=Null){{$showrhcamshaft ->cam3[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam4[{{$i}}]" class="form-control" id="usr" value="@if($showrhcamshaft!=Null){{$showrhcamshaft ->cam4[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam5[{{$i}}]" class="form-control" id="usr" value="@if($showrhcamshaft!=Null){{$showrhcamshaft ->cam5[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam6[{{$i}}]" class="form-control" id="usr" value="@if($showrhcamshaft!=Null){{$showrhcamshaft ->cam6[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam7[{{$i}}]" class="form-control" id="usr" value="@if($showrhcamshaft!=Null){{$showrhcamshaft ->cam7[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" name="camremarks[{{$i}}]" rows="1" id="comment">@if($showrhcamshaft !=Null){{$showrhcamshaft ->camremarks[$partcamsft]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @else
                                                        <tr>
                                                            <td>{{$cmft->parameter}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="camshaft[{{$i}}]" value="{{$cmft->parameter}}">
                                                                    <input type="text" placeholder="" name="cam1[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam2[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam3[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam4[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam5[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam6[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam7[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" name="camremarks[{{$i}}]" rows="1" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($showlhcamshaft->id)&& $showlhcamshaft->work_done==0)||!isset($showlhcamshaft->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>
                                @if(!empty($sec_cambush))
                                    @php
                                        $cambubrhiddden = '';

                                    @endphp
                                @else
                                    @php
                                        $cambubrhiddden = 'hidden';

                                    @endphp
                                @endif

                                <div class="card-body" {{$cambubrhiddden}}>
                                    <form method="post" action="{{url('admin/check-gate-partinspection-camshaft-bushbore-dis-save')}}" enctype="multipart/form-data">
                                        <h4 class="border-bottom">CAM BUSH BORE MEASUEMENT TABLE</h4>
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Parameter</th>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>6</th>
                                                    <th>7</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach($bushbore as $cmft)
                                                    @if($showrhcambush !=Null)
                                                        @php
                                                            $partcamsft=array_search($cmft->parameter,$showrhcambush ->camshaft);
                                                        @endphp
                                                        <tr>
                                                            <td>{{$cmft->parameter}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="camshaft[{{$i}}]" value="{{$cmft->parameter}}">
                                                                    <input type="text" placeholder="" name="cam1[{{$i}}]" class="form-control" id="usr" value="@if($showrhcambush!=Null){{$showrhcambush ->cam1[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam2[{{$i}}]" class="form-control" id="usr" value="@if($showrhcambush!=Null){{$showrhcambush ->cam2[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam3[{{$i}}]" class="form-control" id="usr" value="@if($showrhcambush!=Null){{$showrhcambush ->cam3[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam4[{{$i}}]" class="form-control" id="usr" value="@if($showrhcambush!=Null){{$showrhcambush ->cam4[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam5[{{$i}}]" class="form-control" id="usr" value="@if($showrhcambush!=Null){{$showrhcambush ->cam5[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam6[{{$i}}]" class="form-control" id="usr" value="@if($showrhcambush!=Null){{$showrhcambush ->cam6[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam7[{{$i}}]" class="form-control" id="usr" value="@if($showrhcambush!=Null){{$showrhcambush ->cam7[$partcamsft]}}@endif">
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" name="camremarks[{{$i}}]" rows="1" id="comment">@if($showrhcambush!=Null){{$showrhcambush ->camremarks[$partcamsft]}}@endif</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @else
                                                        <tr>
                                                            <td>{{$cmft->parameter}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="camshaft[{{$i}}]" value="{{$cmft->parameter}}">
                                                                    <input type="text" placeholder="" name="cam1[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam2[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam3[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam4[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam5[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam6[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="cam7[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" name="camremarks[{{$i}}]" rows="1" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($showlhcamshaft->id)&& $showlhcamshaft->work_done==0)||!isset($showlhcamshaft->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>

                            </div>
                        </div>

                        <!-- 4.	Connecting Rod Inspection  -->
                        @if(!empty($val_conrd))
                            @php
                                $conrdhiddden = '';

                            @endphp
                        @else
                            @php
                                $conrdhiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card"{{$conrdhiddden}}>
                            <div class="card-header" id="connectionRodReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#connectionRodInspection" aria-expanded="false" aria-controls="connectionRodInspection">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==4)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            
                            <div id="connectionRodInspection" class="collapse" aria-labelledby="connectionRodReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/check-gate-partinspection-connectingrod-dis-save')}}" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Parameter</th>
                                                    <th>Specification</th>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach($conrod as $connecting)
                                                    @if($showconrod!=Null)
                                                        @php
                                                            $partconrod=array_search($connecting->parameter,$showconrod->connectparameter );
                                                        @endphp
                                                        <tr>
                                                            <td>{{$connecting->parameter}}</td>
                                                            <td>{{$connecting->specification}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="connectparameter[{{$i}}]" value="{{$connecting->parameter}}">
                                                                    <input type="hidden" name="connectspecification[{{$i}}]" value="{{$connecting->specification}}">
                                                                    <input type="text" placeholder="" name="view1[{{$i}}]" class="form-control" id="usr" value="{{$showconrod->view1[$partconrod]}}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="view2[{{$i}}]" class="form-control" id="usr" value="{{$showconrod->view2[$partconrod]}}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="view3[{{$i}}]" class="form-control" id="usr" value="{{$showconrod->view3[$partconrod]}}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="view4[{{$i}}]" class="form-control" id="usr" value="{{$showconrod->view4[$partconrod]}}">
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" name="viewremarks[{{$i}}]" placeholder="Remarks" rows="1" id="comment">{{$showconrod->viewremarks[$partconrod]}}</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @else
                                                        <tr>
                                                            <td>{{$connecting->parameter}}</td>
                                                            <td>{{$connecting->specification}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="connectparameter[{{$i}}]" value="">
                                                                    <input type="hidden" name="connectspecification[{{$i}}]" value="">
                                                                    <input type="text" placeholder="" name="view1[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="view2[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="view3[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" name="view4[{{$i}}]" class="form-control" id="usr" value="">
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" name="viewremarks[{{$i}}]" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalconrod->id)&& $allvalconrod->work_done==0)||!isset($allvalconrod->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- 5.	Cylinder Head & Oil Cooler Inspection  -->
                        @if(!empty($val_cylihed))
                            @php
                                $cylihedhiddden = '';

                            @endphp
                        @else
                            @php
                                $cylihedhiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card"{{$cylihedhiddden}}>
                            <div class="card-header" id="cylinderHeadReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#cylinderHead" aria-expanded="false" aria-controls="cylinderHead">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==5)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="cylinderHead" class="collapse" aria-labelledby="cylinderHeadReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/check-gate-partinspection-cylinderhead-dis-save')}}" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                            @php
                                                $i=0;
                                            @endphp
                                            <!-- dynamic repeater wrapper -->
                                                <div class="missing-damaged-part-repeat">
                                                @php
                                                    $columnsection_4=App\Helpers\UserHelper::columndynamic1(2,8);
                                                                                                                                                $cl = 0;
                                                @endphp
                                                @foreach($columnsection_4 as $colmissing)
                                                    @php

                                                        $colmissingnew[$cl] = $colmissing['column_name'];
                                                                            $cl++;

                                                    @endphp
                                                @endforeach
                                                @php
                                                    //echo "<pre>"; print_r($colmissingnew);exit;
                                                                        $val_per = in_array('Parameter',$colmissingnew);
                                                                    $val_res = in_array('Result',$colmissingnew);
                                                                    $val_rem = in_array('Remarks',$colmissingnew);
                                                @endphp
                                                <!-- Parameter-->
                                                @if(!empty($val_per))
                                                    @php
                                                        $valper = 'Parameter';

                                                    @endphp
                                                @else
                                                    @php
                                                        $valper = '';

                                                    @endphp
                                                @endif
                                                @if(!empty($val_per))
                                                    @php
                                                        $perhiddden = '';

                                                    @endphp
                                                @else
                                                    @php
                                                        $perhiddden = 'hidden';

                                                    @endphp
                                                @endif
                                                <!-- Result-->
                                                @if(!empty($val_res))
                                                    @php
                                                        $valres = 'Result';

                                                    @endphp
                                                @else
                                                    @php
                                                        $valres = '';

                                                    @endphp
                                                @endif
                                                @if(!empty($val_res))
                                                    @php
                                                        $reshiddden = '';

                                                    @endphp
                                                @else
                                                    @php
                                                        $reshiddden = 'hidden';

                                                    @endphp
                                                @endif

                                                <!--Remarks-->
                                                    @if(!empty($val_rem))
                                                        @php
                                                            $valrem = 'Remarks';

                                                        @endphp
                                                    @else
                                                        @php
                                                            $valrem = '';

                                                        @endphp
                                                    @endif
                                                    @if(!empty($val_rem))
                                                        @php
                                                            $remhiddden = '';

                                                        @endphp
                                                    @else
                                                        @php
                                                            $remhiddden = 'hidden';

                                                        @endphp
                                                    @endif

                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th{{$perhiddden}}>{{$valper}}</th>
                                                        <th{{$reshiddden}}>{{$valres}}</th>
                                                        <th{{$remhiddden}}>{{$valrem}}</th>
                                                    </tr>
                                                    </thead>
                                                    @php
                                                        $i=0;
                                                    @endphp
                                                    @foreach($cylinderhead as $partscylinder)
                                                        @if($cylinder!=Null)
                                                            @php
                                                                $cylinhead=array_search($partscylinder->description,$cylinder->parameter);
                                                            @endphp
                                                            <tbody>
                                                            <tr>
                                                                <td{{$perhiddden}}>{{$partscylinder->description}}</td>
                                                                <td {{$reshiddden}}>
                                                                    <input type="hidden" name="parameter[{{$i}}]" value="{{$partscylinder->description}}">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="results[{{$i}}]" value="{{$cylinder->results[$cylinhead]}}">
                                                                    </div>
                                                                </td>

                                                                <td{{$remhiddden}}>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="Remarks" rows="1" name="cylinderremarks[{{$i}}]" id="comment">{{$cylinder->cylinderremarks[$cylinhead]}}</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                            @php
                                                                $i++;
                                                            @endphp

                                                        @else

                                                            <tbody>
                                                            <tr>
                                                                <td{{$perhiddden}}>{{$partscylinder->description}}</td>
                                                                <td {{$reshiddden}}>
                                                                    <input type="hidden" name="parameter[{{$i}}]" value="{{$partscylinder->description}}">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="results[{{$i}}]" value="">
                                                                    </div>
                                                                </td>

                                                                <td {{$remhiddden}}>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="Remarks" rows="1" name="cylinderremarks[{{$i}}]" id="comment"></textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                @php
                                                    $i++;
                                                @endphp
                                                @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalcylinderheadoil->id)&& $allvalcylinderheadoil->work_done==0)||!isset($allvalcylinderheadoil->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- 6.	Other Component Inspection  -->
                        @if(!empty($val_othcom))
                            @php
                                $othcomhiddden = '';

                            @endphp
                        @else
                            @php
                                $othcomhiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card"{{$othcomhiddden}}>
                            <div class="card-header" id="OtherInspectionReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#OtherInspection" aria-expanded="false" aria-controls="OtherInspection">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==6)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="OtherInspection" class="collapse" aria-labelledby="OtherInspectionReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/check-gate-partinspection-othercomponent-dis-save')}}" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">


                                                <tr>
                                                    <th>Description</th>
                                                    <th>Part no.</th>
                                                    <th>QTY</th>
                                                    <th>Condition</th>
                                                    <th>Reused</th>
                                                    <th>Rejected</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <tr><td class="tbl-title" colspan="6">Basic engine</td></tr>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach($basicengine as $bassic)
                                                    @if($showothercomp!=Null)
                                                        @php

                                                            $otherbasic=array_search($bassic->basic_engine,$showothercomp->basicdescription);

                                                        @endphp

                                                        <tr>
                                                            <td>{{$bassic->basic_engine}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="basicdescription[{{$i}}]" value="{{$bassic->basic_engine}}">

                                                                    <select name="basicpart[{{$i}}]" class="form-control select2">

                                                                        @php
                                                                            $partno=App\Helpers\UserHelper::dropdownpartnumber();
                                                                        @endphp

                                                                        @foreach($partno as $desig)



                                                                            <option value="{{$desig->id}}" {{(old('basicpart')!=$showothercomp->basicpart[$otherbasic])?($desig->id==$showothercomp->basicpart[$otherbasic])?'selected=selected':'': 'selected=selected'}}>{{$desig->comp_serial_no}}</option>

                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="basicqty[{{$i}}]" value="@if($showothercomp!=Null){{$showothercomp->basicqty[$otherbasic]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="basiccondition[{{$i}}]" value="@if($showothercomp!=Null){{$showothercomp->basiccondition[$otherbasic]}}@endif">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="custom-control custom-control custom-radio">
                                                                    @if($showothercomp!=Null)
                                                                        <input name="basicreuse[{{$i}}]" class="custom-control-input" id="basreused{{$bassic->id}}" type="radio" value="Reused"{{$showothercomp->basicreuse[$otherbasic]=='Reused'?'checked':''}}>
                                                                    @else
                                                                        <input name="basicreuse[{{$i}}]" class="custom-control-input" id="basreused{{$bassic->id}}" type="radio" value="Reused">
                                                                    @endif
                                                                    <label class="custom-control-label" for="basreused{{$bassic->id}}">Reused</label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="custom-control custom-control custom-radio">
                                                                    @if($showothercomp!=Null)
                                                                        <input name="basicreuse[{{$i}}]" class="custom-control-input" id="basrejected{{$bassic->id}}" type="radio" value="Rejected" {{$showothercomp->basicreuse[$otherbasic]=='Rejected'?'checked':''}}>
                                                                    @else
                                                                        <input name="basicreuse[{{$i}}]" class="custom-control-input" id="basrejected{{$bassic->id}}" type="radio" value="Rejected" >
                                                                    @endif
                                                                    <label class="custom-control-label" for="basrejected{{$bassic->id}}">Rejected</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @else
                                                        <tr>
                                                            <td>{{$bassic->basic_engine}}</td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="hidden" name="basicdescription[{{$i}}]" value="{{$bassic->basic_engine}}">
                                                                    <input type="text" placeholder="" name="basicpart[{{$i}}]" class="form-control" id="usr" value="" >

                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="basicqty[{{$i}}]" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="basiccondition[{{$i}}]" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="custom-control custom-control custom-radio">
                                                                    @if($showothercomp!=Null)
                                                                        <input name="basicreuse[{{$i}}]" class="custom-control-input" id="basreused{{$bassic->id}}" type="radio" value="Reused"}>
                                                                    @else
                                                                        <input name="basicreuse[{{$i}}]" class="custom-control-input" id="basreused{{$bassic->id}}" type="radio" value="Reused">
                                                                    @endif
                                                                    <label class="custom-control-label" for="basreused{{$bassic->id}}">Reused</label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="custom-control custom-control custom-radio">
                                                                    @if($showothercomp!=Null)
                                                                        <input name="basicreuse[{{$i}}]" class="custom-control-input" id="basrejected{{$bassic->id}}" type="radio" value="Rejected" >
                                                                    @else
                                                                        <input name="basicreuse[{{$i}}]" class="custom-control-input" id="basrejected{{$bassic->id}}" type="radio" value="Rejected" >
                                                                    @endif
                                                                    <label class="custom-control-label" for="basrejected{{$bassic->id}}">Rejected</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif
                                                @endforeach


                                                <tr><td class="tbl-title" colspan="6">Lubrication system</td></tr>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach($lubri as $lub)
                                                    @if($showothercomp!=Null)
                                                        @php
                                                            $otherlubri=array_search($lub->description,$showothercomp->lubridescription);
                                                        @endphp
                                                    @endif
                                                    <tr>
                                                        <td>{{$lub->description}}</td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="hidden" name="lubridescription[{{$i}}]" value="{{$lub->description}}">
                                                                <input type="text" placeholder="" class="form-control" id="usr" name="lubripart[{{$i}}]" value="@if($showothercomp!=Null){{$showothercomp->lubripart[$otherlubri]}}@endif">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text" placeholder="" class="form-control" id="usr" name="lubriqty[{{$i}}]" value="@if($showothercomp!=Null){{$showothercomp->lubriqty[$otherlubri]}}@endif">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text"  placeholder="" name="lubricondition[{{$i}}]" class="form-control" id="usr" value="@if($showothercomp!=Null){{$showothercomp->lubricondition[$otherlubri]}} @endif">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-control custom-radio">
                                                                @if($showothercomp!=Null)
                                                                    <input name="lubrireuse[{{$i}}]" class="custom-control-input" id="lubrireused{{$lub->id}}" type="radio" value="Reused" {{$showothercomp->lubrireuse[$otherlubri]=='Reused'?'checked':''}}>
                                                                @else
                                                                    <input name="lubrireuse[{{$i}}]" class="custom-control-input" id="lubrireused{{$lub->id}}" type="radio" value="Reused" >
                                                                @endif
                                                                <label class="custom-control-label" for="lubrireused{{$lub->id}}">Reused</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-control custom-radio">
                                                                @if($showothercomp!=Null)
                                                                    <input name="lubrireuse[{{$i}}]" class="custom-control-input" id="lubrirejected{{$lub->id}}" type="radio" value="Rejected" {{$showothercomp->lubrireuse[$otherlubri]=='Rejected'?'checked':''}}>
                                                                @else
                                                                    <input name="lubrireuse[{{$i}}]" class="custom-control-input" id="lubrirejected{{$lub->id}}" type="radio" value="Rejected">

                                                                @endif
                                                                <label class="custom-control-label" for="lubrirejected{{$lub->id}}">Rejected</label>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach



                                                <tr><td class="tbl-title" colspan="6">Cooling system</td></tr>

                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach($cooler as $col)
                                                    @if($showothercomp!=Null)
                                                        @php
                                                            $othercool=array_search($col->description,$showothercomp->cooldescription);
                                                        @endphp
                                                    @endif
                                                    <tr>
                                                        <td>{{$col->description}}</td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="hidden" name="cooldescription[{{$i}}]" value="{{$col->description}}">
                                                                <input type="text" placeholder="" name="coolpart[{{$i}}]" class="form-control" id="usr" value="@if($showothercomp!=Null){{$showothercomp->coolpart[$othercool]}}@endif">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text" placeholder="" name="coolqty[{{$i}}]" class="form-control" id="usr" value="@if($showothercomp!=Null){{$showothercomp->coolqty[$othercool]}}@endif">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text" placeholder="" name="coolcondition[{{$i}}]" class="form-control" id="usr" value="@if($showothercomp!=Null){{$showothercomp->coolcondition[$othercool]}}@endif">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-control custom-radio">
                                                                @if($showothercomp!=Null)
                                                                    <input name="coolreuse[{{$i}}]" class="custom-control-input" id="coolreused{{$col->id}}" type="radio" value="Reused" {{$showothercomp->coolreuse[$othercool]=='Reused'?'checked':''}}>
                                                                @else
                                                                    <input name="coolreuse[{{$i}}]" class="custom-control-input" id="coolreused{{$col->id}}" type="radio" value="Reused">
                                                                @endif
                                                                <label class="custom-control-label" for="coolreused{{$col->id}}">Reused</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-control custom-radio">
                                                                @if($showothercomp!=Null)
                                                                    <input name="coolreuse[{{$i}}]" class="custom-control-input" id="coolrejected{{$col->id}}" type="radio" value="Rejected" {{$showothercomp->coolreuse[$othercool]=='Rejected'?'checked':''}}>
                                                                @else
                                                                    <input name="coolreuse[{{$i}}]" class="custom-control-input" id="coolrejected{{$col->id}}" type="radio" value="Rejected" >
                                                                @endif
                                                                <label class="custom-control-label" for="coolrejected{{$col->id}}">Rejected</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach


                                                <tr><td class="tbl-title" colspan="6">Fuel system</td></tr>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach($fuel as $fue)
                                                    @if($showothercomp!=Null)
                                                        @php
                                                            $otherfuel=array_search($fue->description,$showothercomp->fueldescription);
                                                        @endphp
                                                    @endif
                                                    <tr>
                                                        <td>{{$fue->description}}</td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="hidden" name="fueldescription[{{$i}}]" value="{{$fue->description}}">
                                                                <input type="text" placeholder="" name="fuelpart[{{$i}}]" class="form-control" id="usr" value="@if($showothercomp!=Null){{$showothercomp->fuelpart[$otherfuel]}}@endif">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text" placeholder="" name="fuelqty[{{$i}}]" class="form-control" id="usr" value="@if($showothercomp!=Null){{$showothercomp->fuelqty[$otherfuel]}}@endif">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text" placeholder="" name="fuelcondition[{{$i}}]" class="form-control" id="usr" value="@if($showothercomp!=Null){{$showothercomp->fuelcondition[$otherfuel]}}@endif">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-control custom-radio">
                                                                @if($showothercomp!=Null)
                                                                    <input name="fuelreuse[{{$i}}]" class="custom-control-input" id="fuelreused{{$fue->id}}" type="radio" value="Reused" {{$showothercomp->fuelreuse[$otherfuel]=='Reused'?'checked':''}}>
                                                                @else
                                                                    <input name="fuelreuse[{{$i}}]" class="custom-control-input" id="fuelreused{{$fue->id}}" type="radio" value="Reused" >
                                                                @endif
                                                                <label class="custom-control-label" for="fuelreused{{$fue->id}}">Reused</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-control custom-radio">
                                                                @if($showothercomp!=Null)
                                                                    <input name="fuelreuse[{{$i}}]" class="custom-control-input" id="fuelrejected{{$fue->id}}" type="radio" value="Rejected" {{$showothercomp->fuelreuse[$otherfuel]=='Rejected'?'checked':''}}>
                                                                @else
                                                                    <input name="fuelreuse[{{$i}}]" class="custom-control-input" id="fuelrejected{{$fue->id}}" type="radio" value="Rejected">
                                                                @endif
                                                                <label class="custom-control-label" for="fuelrejected{{$fue->id}}">Rejected</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach

                                                @php
                                                    $i=0;
                                                @endphp
                                                <tr><td class="tbl-title" colspan="6">Any additional note</td></tr>

                                                <tr>
                                                    <td>
                                                        <div class="form-group mb-0">
                                                            <input type="text" placeholder="" name="addidescription[{{$i}}]" class="form-control" id="usr" value="@if($showothercomp!=Null){{$showothercomp->addidescription[$i]}}@endif">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group mb-0">
                                                            <input type="text" placeholder="" name="addipart[{{$i}}]" class="form-control" id="usr" value="@if($showothercomp!=Null){{$showothercomp->addipart[$i]}}@endif">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group mb-0">
                                                            <input type="text" placeholder="" name="addiqty[{{$i}}]" class="form-control" id="usr" value="@if($showothercomp!=Null){{$showothercomp->addiqty[$i]}}@endif">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group mb-0">
                                                            <input type="text" placeholder="" name="addicondition[{{$i}}]" class="form-control" id="usr" value="@if($showothercomp!=Null){{$showothercomp->addicondition[$i]}}@endif">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showothercomp!=Null)
                                                                <input name="addireuse[{{$i}}]" class="custom-control-input" id="addireused{{$col->id}}" type="radio" value="Reused" {{$showothercomp->addireuse[$i]=='Reused'?'checked':''}}>
                                                            @else
                                                                <input name="addireuse[{{$i}}]" class="custom-control-input" id="addireused{{$col->id}}" type="radio" value="Reused">
                                                            @endif
                                                            <label class="custom-control-label" for="addireused{{$col->id}}">Reused</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-control custom-radio">
                                                            @if($showothercomp!=Null)
                                                                <input name="addireuse[{{$i}}]" class="custom-control-input" id="addirejected{{$col->id}}" type="radio" value="Rejected" {{$showothercomp->addireuse[$i]=='Rejected'?'checked':''}}>
                                                            @else
                                                                <input name="addireuse[{{$i}}]" class="custom-control-input" id="addirejected{{$col->id}}" type="radio" value="Rejected" >
                                                            @endif
                                                            <label class="custom-control-label" for="addirejected{{$col->id}}">Rejected</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp


                                                </tbody>
                                            </table>
                                        </div>

                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalothercom->id)&& $allvalothercom->work_done==0)||!isset($allvalothercom->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>

                            </div>
                        </div>

                        <!-- 7 Fan Drive -->
                        @if(!empty($val_fandr))
                            @php
                                $fandhiddden = '';

                            @endphp
                        @else
                            @php
                                $fandhiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card"{{$fandhiddden}}>
                            <div class="card-header" id="fanDriveReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#fanDrive" aria-expanded="false" aria-controls="fanDrive">
                                        Fan Drive
                                    </button>
                                </h2>
                            </div>
                            <div id="fanDrive" class="collapse" aria-labelledby="fanDriveReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/check-gate-partinspection-fandrive-dis-save')}}" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Component</th>
                                                    <th>Condition</th>
                                                    <th>Reused</th>
                                                    <th>Reject</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                @php

                                                    $i=0;
                                                @endphp
                                                @foreach($fandri as $fandetails)
                                                    @if($showfandrive!=Null)
                                                        @php
                                                            $fetchfan=array_search($fandetails->component,$showfandrive->fancomponent);
                                                        @endphp
                                                        <tbody>
                                                        <tr>
                                                            <td>{{$fandetails->component}}</td>
                                                            <td>
                                                                <input type="hidden" name="fancomponent[{{$i}}]" value="{{$fandetails->component}}">
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="fancondition[{{$i}}]" value="{{$showfandrive->fancondition[$fetchfan]}}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="answer[{{$i}}]" class="custom-control-input" id="reused{{$fandetails->id}}" type="radio" value="Reused" {{$showfandrive->answer[$fetchfan]=='Reused'?'checked':''}}>
                                                                    <label class="custom-control-label" for="reused{{$fandetails->id}}">Reused</label>
                                                                </div>
                                                            </td>

                                                            <td><div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="answer[{{$i}}]" class="custom-control-input" id="reject{{$fandetails->id}}" type="radio" value="Reject" {{$showfandrive->answer[$fetchfan]=='Reject'?'checked':''}}>
                                                                    <label class="custom-control-label" for="reject{{$fandetails->id}}">Reject</label>
                                                                </div></td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" rows="1" name="fanremarks[{{$i}}]" id="comment">{{$showfandrive->fanremarks[$fetchfan]}}</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @else
                                                        <tbody>
                                                        <tr>
                                                            <td>{{$fandetails->component}}</td>
                                                            <td>
                                                                <input type="hidden" name="fancomponent[{{$i}}]" value="{{$fandetails->component}}">
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="fancondition[{{$i}}]" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="answer[{{$i}}]" class="custom-control-input" id="reused{{$fandetails->id}}" type="radio" value="Reused" >
                                                                    <label class="custom-control-label" for="reused{{$fandetails->id}}">Reused</label>
                                                                </div>
                                                            </td>

                                                            <td><div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="answer[{{$i}}]" class="custom-control-input" id="reject{{$fandetails->id}}" type="radio" value="Reject" >
                                                                    <label class="custom-control-label" for="reject{{$fandetails->id}}">Reject</label>
                                                                </div></td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" rows="1" name="fanremarks[{{$i}}]" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvfanaldrive->id)&& $allvfanaldrive->work_done==0)||!isset($allvfanaldrive->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- 8 Oil Pump -->
                        @if(!empty($val_oil))
                            @php
                                $oilhiddden = '';

                            @endphp
                        @else
                            @php
                                $oilhiddden = 'hidden';

                            @endphp
                        @endif

                        <div class="card"{{$oilhiddden}}>
                            <div class="card-header" id="oilPumpReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#oilPump" aria-expanded="false" aria-controls="oilPump">
                                        Oil Pump
                                    </button>
                                </h2>
                            </div>
                            <div id="oilPump" class="collapse" aria-labelledby="oilPumpReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/check-gate-partinspection-oilpump-dis-save')}}" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Component</th>
                                                    <th>Condition</th>
                                                    <th>Reused</th>
                                                    <th>Reject</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                @php

                                                    $i=0;
                                                @endphp
                                                @foreach($oilpump as $oildetails)
                                                    @if($showoilpump!=Null)
                                                        @php
                                                            $fetchoil=array_search($oildetails->component,$showoilpump->oilcomponent);
                                                        @endphp
                                                        <tbody>
                                                        <tr>
                                                            <td>{{$oildetails->component}}</td>
                                                            <td>
                                                                <input type="hidden" name="oilcomponent[{{$i}}]" value="{{$oildetails->component}}">
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="oilcondition[{{$i}}]" value="{{$showoilpump->oilcondition[$fetchoil]}}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="oilanswer[{{$i}}]" class="custom-control-input" id="oilreused{{$oildetails->id}}" type="radio" value="Reused" {{$showoilpump->oilanswer[$fetchoil]=='Reused'?'checked':''}}>
                                                                    <label class="custom-control-label" for="oilreused{{$oildetails->id}}">Reused</label>
                                                                </div>
                                                            </td>

                                                            <td><div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="oilanswer[{{$i}}]" class="custom-control-input" id="oilreject{{$oildetails->id}}" type="radio" value="Reject" {{$showoilpump->oilanswer[$fetchoil]=='Reject'?'checked':''}}>
                                                                    <label class="custom-control-label" for="oilreject{{$oildetails->id}}">Reject</label>
                                                                </div></td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" rows="1" name="oilremarks[{{$i}}]" id="comment">{{$showoilpump->oilremarks[$fetchoil]}}</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @else
                                                        <tbody>
                                                        <tr>
                                                            <td>{{$oildetails->component}}</td>
                                                            <td>
                                                                <input type="hidden" name="oilcomponent[{{$i}}]" value="{{$oildetails->component}}">
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="oilcondition[{{$i}}]" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="oilanswer[{{$i}}]" class="custom-control-input" id="oilreused{{$oildetails->id}}" type="radio" value="Reused" >
                                                                    <label class="custom-control-label" for="oilreused{{$oildetails->id}}">Reused</label>
                                                                </div>
                                                            </td>

                                                            <td><div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="oilanswer[{{$i}}]" class="custom-control-input" id="oilreject{{$oildetails->id}}" type="radio" value="Reject" >
                                                                    <label class="custom-control-label" for="oilreject{{$oildetails->id}}">Reject</label>
                                                                </div></td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" rows="1" name="oilremarks[{{$i}}]" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvaloilpump->id)&& $allvaloilpump->work_done==0)||!isset($allvaloilpump->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- 9 Air Compressor -->
                        @if(!empty($val_air))
                            @php
                                $airhiddden = '';

                            @endphp
                        @else
                            @php
                                $airhiddden = 'hidden';

                            @endphp
                        @endif

                        <div class="card"{{$airhiddden}}>
                            <div class="card-header" id="oilCompReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#oilComp" aria-expanded="false" aria-controls="oilComp">
                                        Air Compressor
                                    </button>
                                </h2>
                            </div>
                            <div id="oilComp" class="collapse" aria-labelledby="oilCompReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/check-gate-partinspection-aircompressor-dis-save')}}" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Component</th>
                                                    <th>Condition</th>
                                                    <th>Reused</th>
                                                    <th>Reject</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                @php

                                                    $i=0;
                                                @endphp
                                                @foreach($aircompressor as $airdetails)
                                                    @if($showaircomp!=Null)
                                                        @php
                                                            $fetchair=array_search($airdetails->component,$showaircomp->aircomponent);
                                                        @endphp
                                                        <tbody>
                                                        <tr>
                                                            <td>{{$oildetails->component}}</td>
                                                            <td>
                                                                <input type="hidden" name="aircomponent[{{$i}}]" value="{{$airdetails->component}}">
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="aircondition[{{$i}}]" value="{{$showaircomp->aircondition[$fetchair]}}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="airanswer[{{$i}}]" class="custom-control-input" id="airreused{{$airdetails->id}}" type="radio" value="Reused" {{$showaircomp->airanswer[$fetchair]=='Reused'?'checked':''}}>
                                                                    <label class="custom-control-label" for="airreused{{$airdetails->id}}">Reused</label>
                                                                </div>
                                                            </td>

                                                            <td><div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="airanswer[{{$i}}]" class="custom-control-input" id="airreject{{$airdetails->id}}" type="radio" value="Reject" {{$showaircomp->airanswer[$fetchair]=='Reject'?'checked':''}}>
                                                                    <label class="custom-control-label" for="airreject{{$airdetails->id}}">Reject</label>
                                                                </div></td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" rows="1" name="airremarks[{{$i}}]" id="comment">{{$showaircomp->airremarks[$fetchair]}}</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @else
                                                        <tbody>
                                                        <tr>
                                                            <td>{{$airdetails->component}}</td>
                                                            <td>
                                                                <input type="hidden" name="aircomponent[{{$i}}]" value="{{$airdetails->component}}">
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="aircondition[{{$i}}]" value="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="airanswer[{{$i}}]" class="custom-control-input" id="airreused{{$airdetails->id}}" type="radio" value="Reused" >
                                                                    <label class="custom-control-label" for="airreused{{$airdetails->id}}">Reused</label>
                                                                </div>
                                                            </td>

                                                            <td><div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="airanswer[{{$i}}]" class="custom-control-input" id="airreject{{$airdetails->id}}" type="radio" value="Reject" >
                                                                    <label class="custom-control-label" for="airreject{{$airdetails->id}}">Reject</label>
                                                                </div></td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" rows="1" name="airremarks[{{$i}}]" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalaircomp->id)&& $allvalaircomp->work_done==0)||!isset($allvalaircomp->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- 10 Water Pump -->
                        @if(!empty($val_water))
                            @php
                                $waterhiddden = '';

                            @endphp
                        @else
                            @php
                                $waterhiddden = 'hidden';

                            @endphp
                        @endif

                        <div class="card"{{$waterhiddden}}>
                            <div class="card-header" id="waterPumpReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#waterPump" aria-expanded="false" aria-controls="waterPump">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==7)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="waterPump" class="collapse" aria-labelledby="waterPumpReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/check-gate-partinspection-waterpump-dis-save')}}" enctype="multipart/form-data">
                                        <div class="table-responsive">

                                        @php
                                            $columnsection_3=App\Helpers\UserHelper::columndynamic1(2,8);
                                                                                                                               $cl = 0;
                                        @endphp
                                        @foreach($columnsection_3 as $colwater)
                                            @php

                                                $colwaternew[$cl] = $colwater['column_name'];
                                                                    $cl++;

                                            @endphp
                                        @endforeach
                                        @php
                                            //echo "<pre>"; print_r($colwaternew);exit;
                                                            $val_com = in_array('Component',$colwaternew);

                                                            $val_condi = in_array('Condition',$colwaternew);
                                                            $val_maincondi = in_array('Main WP Condition',$colwaternew);
                                                            $val_auxcondi = in_array('Aux.WP Condition',$colwaternew);
                                                            $val_reuse = in_array('Reused',$colwaternew);
                                                            $val_reject = in_array('Rejected',$colwaternew);
                                                            $val_rema = in_array('Remarks',$colwaternew);
                                        @endphp
                                        <!-- component-->
                                        @if(!empty($val_com))
                                            @php
                                                $valcom = 'Component';

                                            @endphp
                                        @else
                                            @php
                                                $valcom = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_com))
                                            @php
                                                $comphiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $comphiddden = 'hidden';

                                            @endphp
                                        @endif
                                        <!--condition-->
                                        @if(!empty($val_condi))
                                            @php
                                                $valcondi = 'Condition';

                                            @endphp
                                        @else
                                            @php
                                                $valcondi = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_condi))
                                            @php
                                                $condiphiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $condiphiddden = 'hidden';

                                            @endphp
                                        @endif

                                        <!--main condi-->
                                        @if(!empty($val_maincondi))
                                            @php
                                                $valmaincondi = 'Main WP Condition';

                                            @endphp
                                        @else
                                            @php
                                                $valmaincondi = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_maincondi))
                                            @php
                                                $maincondiphiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $maincondiphiddden = 'hidden';

                                            @endphp
                                        @endif
                                        <!--aux main-->
                                        @if(!empty($val_auxcondi))
                                            @php
                                                $valauxcondi = 'Aux.WP Condition';

                                            @endphp
                                        @else
                                            @php
                                                $valauxcondi = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_auxcondi))
                                            @php
                                                $auxcondiphiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $auxcondiphiddden = 'hidden';

                                            @endphp
                                        @endif
                                        <!--Reuse-->
                                        @if(!empty($val_reuse))
                                            @php
                                                $valreuse = 'Reused';

                                            @endphp
                                        @else
                                            @php
                                                $valreuse = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_reuse))
                                            @php
                                                $reusehiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $reusehiddden = 'hidden';

                                            @endphp
                                        @endif
                                        <!--Reject-->
                                        @if(!empty($val_reject))
                                            @php
                                                $valreject = 'Rejected';

                                            @endphp
                                        @else
                                            @php
                                                $valreject = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_reject))
                                            @php
                                                $rejecthiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $rejecthiddden = 'hidden';

                                            @endphp
                                        @endif
                                        <!--Remarks-->
                                            @if(!empty($val_rema))
                                                @php
                                                    $valremark = 'Remarks';

                                                @endphp
                                            @else
                                                @php
                                                    $valremark = '';

                                                @endphp
                                            @endif
                                            @if(!empty($val_rema))
                                                @php
                                                    $remrkhiddden = '';

                                                @endphp
                                            @else
                                                @php
                                                    $remrkhiddden = 'hidden';

                                                @endphp
                                            @endif

                                            <table class="table align-items-center table-flush">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th {{$comphiddden}}>{{$valcom}}</th>
                                                    <th{{$condiphiddden}}>{{$valcondi}}</th>
                                                    <th{{$maincondiphiddden}}>{{$valmaincondi}}</th>
                                                    <th{{$auxcondiphiddden}}>{{$valauxcondi}}</th>
                                                    <th {{$reusehiddden}}>{{$valreuse}}</th>
                                                    <th {{$rejecthiddden}}>{{$valreject}}</th>
                                                    <th {{$remrkhiddden}}>{{$valremark}}</th>
                                                </tr>
                                                </thead>
                                                @php

                                                    $i=0;
                                                @endphp
                                                @foreach($waterpump as $waterdetails)
                                                    @if($showwaterpump!=Null)
                                                        @php
                                                            $fetchwater=array_search($waterdetails->component,$showwaterpump->watercomponent);
                                                        @endphp
                                                        <tbody>
                                                        <tr>
                                                            <td {{$comphiddden}}>{{$waterdetails->component}}</td>
                                                            <td  {{$condiphiddden}}>
                                                                <input type="hidden" name="watercomponent[{{$i}}]" value="{{$waterdetails->component}}">
                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="watercondition[{{$i}}]" value="{{$showwaterpump->watercondition[$fetchwater]}}">
                                                                </div>
                                                            </td>
                                                            <td  {{$maincondiphiddden}}>

                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="watermaincondition[{{$i}}]" value="{{$showwaterpump->watermaincondition[$fetchwater]}}">
                                                                </div>
                                                            </td>
                                                            <td  {{$auxcondiphiddden}}>

                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="waterauxcondition[{{$i}}]" value="{{$showwaterpump->waterauxcondition[$fetchwater]}}">
                                                                </div>
                                                            </td>
                                                            <td {{$reusehiddden}}>
                                                                <div class="custom-control custom-control-inline custom-radio">
                                                                    <input name="wateranswer[{{$i}}]" class="custom-control-input" id="waterreused{{$waterdetails->id}}" type="radio" value="Reused" {{$showwaterpump->wateranswer[$fetchwater]=='Reused'?'checked':''}}>
                                                                    <label class="custom-control-label" for="waterreused{{$waterdetails->id}}">{{$valreuse}}</label>
                                                                </div>
                                                            </td>

                                                            <td  {{$rejecthiddden}}><div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="wateranswer[{{$i}}]" class="custom-control-input" id="waterreject{{$waterdetails->id}}" type="radio" value="Reject" {{$showwaterpump->wateranswer[$fetchwater]=='Reject'?'checked':''}}>
                                                                    <label class="custom-control-label" for="waterreject{{$waterdetails->id}}">{{$valreject}}</label>
                                                                </div></td>
                                                            <td {{$remrkhiddden}}>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" rows="1" name="waterremarks[{{$i}}]" id="comment">{{$showwaterpump->waterremarks[$fetchwater]}}</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                        @php
                                                            $i++;
                                                        @endphp

                                                    @else
                                                        <tbody>
                                                        <tr>
                                                            <td {{$comphiddden}}>{{$waterdetails->component}}</td>
                                                            <td  {{$condiphiddden}}>
                                                                <input type="hidden" name="watercomponent[{{$i}}]" value="{{$waterdetails->component}}">
                                                                <div class="form-group mb-0" >
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="watercondition[{{$i}}]" value="">
                                                                </div>
                                                            </td>
                                                            <td  {{$maincondiphiddden}}>

                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="watermaincondition[{{$i}}]" value="">
                                                                </div>
                                                            </td>
                                                            <td  {{$auxcondiphiddden}}>

                                                                <div class="form-group mb-0">
                                                                    <input type="text" placeholder="" class="form-control" id="usr" name="waterauxcondition[{{$i}}]" value="">
                                                                </div>
                                                            </td>
                                                            <td {{$reusehiddden}}>
                                                                <div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="wateranswer[{{$i}}]" class="custom-control-input" id="waterreused{{$waterdetails->id}}" type="radio" value="Reused" >
                                                                    <label class="custom-control-label" for="waterreused{{$waterdetails->id}}">{{$valreuse}}</label>
                                                                </div>
                                                            </td>

                                                            <td  {{$rejecthiddden}}><div class="custom-control custom-control-inline custom-radio">

                                                                    <input name="wateranswer[{{$i}}]" class="custom-control-input" id="waterreject{{$waterdetails->id}}" type="radio" value="Reject" >
                                                                    <label class="custom-control-label" for="waterreject{{$waterdetails->id}}">{{$valreject}}</label>
                                                                </div></td>
                                                            <td {{$remrkhiddden}}>
                                                                <div class="form-group mb-0">
                                                                    <textarea class="form-control" placeholder="Remarks" rows="1" name="waterremarks[{{$i}}]" id="comment"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalwaterpump->id)&& $allvalwaterpump->work_done==0)||!isset($allvalwaterpump->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- 11 Cooler Inspection-->

                        @if(!empty($val_cool))
                            @php
                                $coolhiddden = '';

                            @endphp
                        @else
                            @php
                                $coolhiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card" {{$coolhiddden}}>
                            <div class="card-header" id="coolerInspReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#coolerInsp" aria-expanded="false" aria-controls="coolerInsp">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==12)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="coolerInsp" class="collapse" aria-labelledby="coolerInspReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/partinspection-cooler-insp-save')}}" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                            @php
                                                $i=0;
                                            @endphp
                                            <!-- dynamic repeater wrapper -->
                                                <div class="missing-damaged-part-repeat">
                                                @php
                                                    $columnsection_5=App\Helpers\UserHelper::columndynamic1(2,8);
                                                                                                                                                                           $cl = 0;
                                                @endphp
                                                @foreach($columnsection_5 as $colcooler)
                                                    @php

                                                        $colcoolernew[$cl] = $colcooler['column_name'];
                                                                            $cl++;

                                                    @endphp
                                                @endforeach
                                                @php
                                                    //echo "<pre>"; print_r($colmissingnew);exit;
                                                                        $val_compo = in_array('Component',$colcoolernew);
                                                                        $val_pre = in_array('Pressure Test Result',$colcoolernew);
                                                                        $val_exte = in_array('Any External Damage',$colcoolernew);
                                                                        $val_seal = in_array('Seal Area',$colcoolernew);
                                                                        $val_temp = in_array('Test Temp',$colcoolernew);
                                                                        $val_tepre = in_array('Test Pressure',$colcoolernew);
                                                                        $val_remark = in_array('Remarks',$colcoolernew);
                                                @endphp
                                                <!-- Component -->
                                                @if(!empty($val_compo))
                                                    @php
                                                        $valcompo = 'Component';

                                                    @endphp
                                                @else
                                                    @php
                                                        $valcompo = '';

                                                    @endphp
                                                @endif
                                                @if(!empty($val_compo))
                                                    @php
                                                        $comphiddden = '';

                                                    @endphp
                                                @else
                                                    @php
                                                        $comphiddden = 'hidden';

                                                    @endphp
                                                @endif
                                                <!-- Pressure -->
                                                @if(!empty($val_pre))
                                                    @php
                                                        $valpre = 'Pressure Test Result';

                                                    @endphp
                                                @else
                                                    @php
                                                        $valpre = '';

                                                    @endphp
                                                @endif
                                                @if(!empty($val_pre))
                                                    @php
                                                        $prehiddden = '';

                                                    @endphp
                                                @else
                                                    @php
                                                        $prehiddden = 'hidden';

                                                    @endphp
                                                @endif

                                                <!--Extern-->
                                                @if(!empty($val_exte))
                                                    @php
                                                        $valexte = 'Any External Damage';

                                                    @endphp
                                                @else
                                                    @php
                                                        $valexte = '';

                                                    @endphp
                                                @endif
                                                @if(!empty($val_exte))
                                                    @php
                                                        $exthiddden = '';

                                                    @endphp
                                                @else
                                                    @php
                                                        $exthiddden = 'hidden';

                                                    @endphp
                                                @endif
                                                <!--Seal Area-->
                                                @if(!empty($val_seal))
                                                    @php
                                                        $valseal = 'Seal Area';

                                                    @endphp
                                                @else
                                                    @php
                                                        $valseal = '';

                                                    @endphp
                                                @endif
                                                @if(!empty($val_seal))
                                                    @php
                                                        $sealhiddden = '';

                                                    @endphp
                                                @else
                                                    @php
                                                        $sealhiddden = 'hidden';

                                                    @endphp
                                                @endif
                                                <!--Test Temp-->
                                                @if(!empty($val_temp))
                                                    @php
                                                        $valtemp = 'Test Temp';

                                                    @endphp
                                                @else
                                                    @php
                                                        $valtemp = '';

                                                    @endphp
                                                @endif
                                                @if(!empty($val_temp))
                                                    @php
                                                        $temphiddden = '';

                                                    @endphp
                                                @else
                                                    @php
                                                        $temphiddden = 'hidden';

                                                    @endphp
                                                @endif
                                                <!--Test Pressure-->
                                                @if(!empty($val_tepre))
                                                    @php
                                                        $valtempre = 'Test Pressure';

                                                    @endphp
                                                @else
                                                    @php
                                                        $valtempre = '';

                                                    @endphp
                                                @endif
                                                @if(!empty($val_tepre))
                                                    @php
                                                        $temprehiddden = '';

                                                    @endphp
                                                @else
                                                    @php
                                                        $temprehiddden = 'hidden';

                                                    @endphp
                                                @endif
                                                <!--Remarks-->
                                                    @if(!empty($val_remark))
                                                        @php
                                                            $valremrk = 'Remarks';

                                                        @endphp
                                                    @else
                                                        @php
                                                            $valremrk = '';

                                                        @endphp
                                                    @endif
                                                    @if(!empty($val_remark))
                                                        @php
                                                            $remrkhiddden = '';

                                                        @endphp
                                                    @else
                                                        @php
                                                            $remrkhiddden = 'hidden';

                                                        @endphp
                                                    @endif


                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th {{$comphiddden}}>{{$valcompo}}</th>
                                                        <th {{$prehiddden}}>{{$valpre}}</th>
                                                        <th {{$exthiddden}}>{{$valexte}}</th>
                                                        <th {{$sealhiddden}}>{{$valseal}}</th>
                                                        <th {{$temphiddden}}>{{$valtemp}}</th>
                                                        <th {{$temprehiddden}}>{{$valtempre}}</th>
                                                        <th {{$remrkhiddden}}>{{$valremrk}}</th>
                                                    </tr>
                                                    </thead>
                                                    @php
                                                        $i=0;
                                                                        $r=0;
                                                    @endphp
                                                    @foreach($cooler as $partscooler)
                                                        @if($showcooler!=Null)
                                                            @php
                                                                $coolerpart=array_search($partscooler->component,$showcooler->parameter);
                                                            @endphp
                                                            <tbody>
                                                            <tr>
                                                                <td {{$comphiddden}}>{{$partscooler->component}}</td>
                                                                <td {{$prehiddden}}>
                                                                    <input type="hidden" name="parameter[{{$r}}]" value="{{$partscooler->component}}">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="pressure[{{$r}}]" value="{{$showcooler->pressure[$r]}}">
                                                                    </div>
                                                                </td>
                                                                <td {{$exthiddden}}>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="" rows="1" name="external[{{$r}}]" id="comment">{{$showcooler->external[$r]}}</textarea>
                                                                    </div>
                                                                </td>
                                                                <td {{$sealhiddden}}>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="" rows="1" name="sealarea[{{$r}}]" id="comment">{{$showcooler->sealarea[$r]}}</textarea>
                                                                    </div>
                                                                </td>
                                                                <td {{$temphiddden}}>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="" rows="1" name="testtemp[{{$r}}]" id="comment">{{$showcooler->testtemp[$r]}}</textarea>
                                                                    </div>
                                                                </td>
                                                                <td {{$temprehiddden}}>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="" rows="1" name="testpressure[{{$r}}]" id="comment">{{$showcooler->testpressure[$r]}}</textarea>
                                                                    </div>
                                                                </td>


                                                                <td {{$remrkhiddden}}>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="Remarks" rows="1" name="coolerremarks[{{$r}}]" id="comment">{{$showcooler->coolerremarks[$r]}}</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                            @php

                                                                $r++;


                                                            @endphp

                                                        @else

                                                            <tbody>
                                                            <tr>
                                                                <td {{$comphiddden}}>{{$partscooler->component}}</td>
                                                                <td {{$prehiddden}}>
                                                                    <input type="hidden" name="parameter[{{$i}}]" value="{{$partscooler->component}}">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="pressure[{{$i}}]" value="">
                                                                    </div>
                                                                </td>
                                                                <td {{$exthiddden}}>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="" rows="1" name="external[{{$i}}]" id="comment"></textarea>
                                                                    </div>
                                                                </td>
                                                                <td {{$sealhiddden}}>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="" rows="1" name="sealarea[{{$i}}]" id="comment"></textarea>
                                                                    </div>
                                                                </td>
                                                                <td {{$temphiddden}}>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="" rows="1" name="testtemp[{{$i}}]" id="comment"></textarea>
                                                                    </div>
                                                                </td>
                                                                <td {{$temprehiddden}}>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="" rows="1" name="testpressure[{{$i}}]" id="comment"></textarea>
                                                                    </div>
                                                                </td>


                                                                <td {{$remrkhiddden}}>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="Remarks" rows="1" name="coolerremarks[{{$i}}]" id="comment"></textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                @php
                                                    $i++;
                                                @endphp
                                                @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalcooler->id)&& $allvalcooler->work_done==0)||!isset($allvalcooler->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- 12 Clutch pack thickness inspection -->
                        @if(!empty($val_clpak))
                            @php
                                $clpakhiddden = '';

                            @endphp
                        @else
                            @php
                                $clpakhiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card" {{$clpakhiddden}}>
                            <div class="card-header" id="clutchpackThicknessReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#clutchpackThickness" aria-expanded="false" aria-controls="clutchpackThickness">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==15)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="clutchpackThickness" class="collapse" aria-labelledby="clutchpackThicknessReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/partinspection-clutchpack-thickness-save')}}" enctype="multipart/form-data">
                                        <div class="clutch-pack-thickness">



                                            @if($showcluthick!=null && count($showcluthick)!=0)
                                                @php

                                                    $row = 0;
                                                @endphp
                                                @foreach($showcluthick as $failprt)

                                                    <div class="row">

                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Part No</label>
                                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>

                                                                <select name="part_no[]" class="form-control select2">

                                                                    @php
                                                                        $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();

                                                                    @endphp

                                                                    @foreach($partno_1 as $desig)



                                                                        <option value="{{$desig->id}}" {{(old('part_no')!=$failprt->part_no)?($desig->id==$failprt->part_no)?'selected=selected':'': 'selected=selected'}}>{{$desig->comp_serial_no}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Description</label>
                                                                <textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1">{{$failprt->description}}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Qty</label>
                                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                                <input type="text" name="qty[]" class="form-control" placeholder="QTY" value="{{$failprt->qty}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Section</label>
                                                                <input type="text" name="section[]" class="form-control" placeholder="" value="{{$failprt->section}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Actual Value</label>
                                                                <input type="text" name="actual_val[]" class="form-control" placeholder="" value="{{$failprt->actual_val}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Measured Value</label>
                                                                <input type="text" name="measured_val[]" class="form-control" placeholder="" value="{{$failprt->measured_val}}">
                                                            </div>
                                                        </div>




                                                        @if($row == 0)
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                            </div>
                                                        @else
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                            </div>

                                                    @endif

                                                    <!--<div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                            </div>-->
                                                    </div>
                                                    @php
                                                        $row++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <div class="row">

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Part No</label>
                                                            <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                            <select name="part_no[]" class="form-control select2">
                                                                <option selected="selected" disabled="disabled">--Select--</option>
                                                                @php
                                                                    $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();
                                                                @endphp

                                                                @foreach($partno_1 as $design)

                                                                    <option value="{{$design->id}}">{{$design->comp_serial_no}}</option>

                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Description</label>
                                                            <textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">QTY</label>
                                                            <input type="text" name="qty[]" class="form-control" placeholder="QTY">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Section</label>
                                                            <input type="text" name="section[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Actual Value</label>
                                                            <input type="text" name="actual_val[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Measured Value</label>
                                                            <input type="text" name="measured_val[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>




                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole


                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($showcluthick->id)&& $showcluthick->work_done==0)||!isset($showcluthick->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>

                            </div>
                        </div>

                        <!-- 13 Clutch plate thickness inspection -->
                        @if(!empty($val_clplat))
                            @php
                                $clplathiddden = '';

                            @endphp
                        @else
                            @php
                                $clplathiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card" {{$clplathiddden}}>
                            <div class="card-header" id="clutchplateThicknessReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#clutchplateThickness" aria-expanded="false" aria-controls="clutchplateThickness">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==16)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="clutchplateThickness" class="collapse" aria-labelledby="clutchplateThicknessReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/partinspection-clutchplate-thickness-save')}}" enctype="multipart/form-data">
                                        <div class="clutch-plate-thickness">



                                            @if($showcluplatethi!=null && count($showcluplatethi)!=0)
                                                @php

                                                    $row = 0;
                                                @endphp
                                                @foreach($showcluplatethi as $cluplate)

                                                    <div class="row">

                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Part No</label>
                                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>

                                                                <select name="part_no[]" class="form-control select2">

                                                                    @php
                                                                        $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();

                                                                    @endphp

                                                                    @foreach($partno_1 as $desig)



                                                                        <option value="{{$desig->id}}" {{(old('part_no')!=$cluplate->part_no)?($desig->id==$cluplate->part_no)?'selected=selected':'': 'selected=selected'}}>{{$desig->comp_serial_no}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Description</label>
                                                                <textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1">{{$cluplate->description}}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Qty</label>
                                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                                <input type="text" name="qty[]" class="form-control" placeholder="QTY" value="{{$cluplate->qty}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Section</label>
                                                                <input type="text" name="section[]" class="form-control" placeholder="" value="{{$cluplate->section}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Actual Value</label>
                                                                <input type="text" name="actual_val[]" class="form-control" placeholder="" value="{{$cluplate->actual_val}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Measured Value</label>
                                                                <input type="text" name="measured_val[]" class="form-control" placeholder="" value="{{$cluplate->measured_val}}">
                                                            </div>
                                                        </div>




                                                        @if($row == 0)
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                            </div>
                                                        @else
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                            </div>

                                                    @endif

                                                    <!--<div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                            </div>-->
                                                    </div>
                                                    @php
                                                        $row++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <div class="row">

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Part No</label>
                                                            <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                            <select name="part_no[]" class="form-control select2">
                                                                <option selected="selected" disabled="disabled">--Select--</option>
                                                                @php
                                                                    $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();
                                                                @endphp

                                                                @foreach($partno_1 as $design)

                                                                    <option value="{{$design->id}}">{{$design->comp_serial_no}}</option>

                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Description</label>
                                                            <textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">QTY</label>
                                                            <input type="text" name="qty[]" class="form-control" placeholder="QTY">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Section</label>
                                                            <input type="text" name="section[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Actual Value</label>
                                                            <input type="text" name="actual_val[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Measured Value</label>
                                                            <input type="text" name="measured_val[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>




                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($showcluplatethi->id)&& $showcluplatethi->work_done==0)||!isset($showcluplatethi->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>

                            </div>
                        </div>

                        <!-- 14 Clutch plate flatness inspection -->
                        @if(!empty($val_clplatflt))
                            @php
                                $clplatflthiddden = '';

                            @endphp
                        @else
                            @php
                                $clplatflthiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card" {{$clplatflthiddden}}>
                            <div class="card-header" id="clutchplateFlatnessReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#clutchplateFlatness" aria-expanded="false" aria-controls="clutchplateFlatness">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==17)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="clutchplateFlatness" class="collapse" aria-labelledby="clutchplateFlatnessReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/partinspection-clutchplate-flatness-save')}}" enctype="multipart/form-data">
                                        <div class="clutch-plate-flatness">



                                            @if($showcluplateflt!=null && count($showcluplateflt)!=0)
                                                @php

                                                    $row = 0;
                                                @endphp
                                                @foreach($showcluplateflt as $cluplateflt)

                                                    <div class="row">

                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Part No</label>
                                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>

                                                                <select name="part_no[]" class="form-control select2">

                                                                    @php
                                                                        $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();

                                                                    @endphp

                                                                    @foreach($partno_1 as $desig)



                                                                        <option value="{{$desig->id}}" {{(old('part_no')!=$cluplateflt->part_no)?($desig->id==$cluplateflt->part_no)?'selected=selected':'': 'selected=selected'}}>{{$desig->comp_serial_no}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Description</label>
                                                                <textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1">{{$cluplateflt->description}}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Qty</label>
                                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                                <input type="text" name="qty[]" class="form-control" placeholder="QTY" value="{{$cluplateflt->qty}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Section</label>
                                                                <input type="text" name="section[]" class="form-control" placeholder="" value="{{$cluplateflt->section}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Actual Value</label>
                                                                <input type="text" name="actual_val[]" class="form-control" placeholder="" value="{{$cluplateflt->actual_val}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Measured Value</label>
                                                                <input type="text" name="measured_val[]" class="form-control" placeholder="" value="{{$cluplateflt->measured_val}}">
                                                            </div>
                                                        </div>




                                                        @if($row == 0)
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                            </div>
                                                        @else
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                            </div>

                                                    @endif

                                                    <!--<div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                            </div>-->
                                                    </div>
                                                    @php
                                                        $row++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <div class="row">

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Part No</label>
                                                            <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                            <select name="part_no[]" class="form-control select2">
                                                                <option selected="selected" disabled="disabled">--Select--</option>
                                                                @php
                                                                    $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();
                                                                @endphp

                                                                @foreach($partno_1 as $design)

                                                                    <option value="{{$design->id}}">{{$design->comp_serial_no}}</option>

                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Description</label>
                                                            <textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">QTY</label>
                                                            <input type="text" name="qty[]" class="form-control" placeholder="QTY">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Section</label>
                                                            <input type="text" name="section[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Actual Value</label>
                                                            <input type="text" name="actual_val[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Measured Value</label>
                                                            <input type="text" name="measured_val[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>




                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($showcluplateflt->id)&& $showcluplateflt->work_done==0)||!isset($showcluplateflt->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>

                            </div>
                        </div>


                        <!-- 15 Torque Converter -->
                        @if(!empty($val_torq))
                            @php
                                $torqhiddden = '';

                            @endphp
                        @else
                            @php
                                $torqhiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card" {{$torqhiddden}}>
                            <div class="card-header" id="torqueConverterReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#torqueConverter" aria-expanded="false" aria-controls="torqueConverter">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==18)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="torqueConverter" class="collapse" aria-labelledby="torqueConverterReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <form method="post" action="{{url('admin/partinspection-torque-converter-save')}}" enctype="multipart/form-data">
                                        <div class="torque-converter">



                                            @if($showtorque!=null && count($showtorque)!=0)
                                                @php

                                                    $row = 0;
                                                @endphp
                                                @foreach($showtorque as $torcon)

                                                    <div class="row">



                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">CLEARANCE BETWEEN COMPONENTS</label>
                                                                <textarea type="text" name="clearance_component[]" class="form-control" placeholder="Description of rework" rows="1">{{$torcon->clearance_component}}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">TURBINE INSIDE DIAMETER(mm)</label>
                                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                                <input type="text" name="turbine_diameter[]" class="form-control" placeholder="" value="{{$torcon->turbine_diameter}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">STATOR OUTSIDE DIAMETER(mm)</label>
                                                                <input type="text" name="stator_diameter[]" class="form-control" placeholder="" value="{{$torcon->stator_diameter}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">MAX WORN CLEARANCE ACROSS THE DIAMETER(mm)</label>
                                                                <input type="text" name="max_worn[]" class="form-control" placeholder="" value="{{$torcon->max_worn}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Measured Value</label>
                                                                <input type="text" name="measured_val[]" class="form-control" placeholder="" value="{{$torcon->measured_val}}">
                                                            </div>
                                                        </div>




                                                        @if($row == 0)
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                            </div>
                                                        @else
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                            </div>

                                                    @endif

                                                    <!--<div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                            </div>-->
                                                    </div>
                                                    @php
                                                        $row++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <div class="row">



                                                    <div class="col" >
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">CLEARANCE BETWEEN COMPONENTS</label>
                                                            <textarea type="text" name="clearance_component[]" class="form-control" placeholder="Description of rework" rows="1"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">TURBINE INSIDE DIAMETER(mm)</label>
                                                            <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                            <input type="text" name="turbine_diameter[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">STATOR OUTSIDE DIAMETER(mm)</label>
                                                            <input type="text" name="stator_diameter[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">MAX WORN CLEARANCE ACROSS THE DIAMETER(mm)</label>
                                                            <input type="text" name="max_worn[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Measured Value</label>
                                                            <input type="text" name="measured_val[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>




                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($showcluplateflt->id)&& $showcluplateflt->work_done==0)||!isset($showcluplateflt->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>

                            </div>
                        </div>

                        <!-- 16 Roller -->
                        @if(!empty($val_roll))
                            @php
                                $rollhiddden = '';

                            @endphp
                        @else
                            @php
                                $rollhiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card" {{$rollhiddden}}>
                            <div class="card-header" id="rollerInspReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#rollerInsp" aria-expanded="false" aria-controls="rollerInsp">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==19)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="rollerInsp" class="collapse" aria-labelledby="rollerInspReport" data-parent="#cylinder-collape">
                                <!--<h4>(A) Outside Spread<br>
                                                        (B) Tread Width<br>
                                                        (C) Inside Flange Diameter<br>
                                                        (D) Shell Bore Diameter<br>
                                                        (E) Tread Diameter<br>
                                                        (F) Outside Flange Diameter<br>
                                                        (G) Total Spread<br>
                                                        (J) Tread Diameter at 100% wear</h4><br>-->
                                <div class="card-body">
                                    <h4>Specification</h4>

                                    <form method="post" action="{{url('admin/roller-specification-save')}}" enctype="multipart/form-data">
                                        <!-- dynamic repeater wrapper -->
                                        <div class="roller-spec-insp">
                                        @php
                                            $rollerspe_1=App\Helpers\UserHelper::columndynamic1(2,8);

                                                                   $cl = 0;
                                        @endphp
                                        @foreach($rollerspe_1 as $colrolspe)
                                            @php


                                                $colrolspenew[$cl] = $colrolspe['column_name'];
                                                                    $cl++;

                                            @endphp
                                        @endforeach


                                        @php

                                            $val_out = in_array('Outside Spread',$colrolspenew);
                                                                $val_trd = in_array('Tread Width',$colrolspenew);
                                                                $val_ins = in_array('Inside Flange Diameter',$colrolspenew);
                                                                $val_shell = in_array('Shell Bore Diameter',$colrolspenew);
                                                                $val_trddia = in_array('Tread Diameter',$colrolspenew);
                                                                $val_outtrd = in_array('Outside Flange Diameter',$colrolspenew);
                                                                $val_tosprd = in_array('Total Spread',$colrolspenew);
                                                                $val_tdhund = in_array('Tread Diameter at 100% wear',$colrolspenew);

                                        @endphp
                                        <!-- Component Name -->
                                        @if(!empty($val_out))
                                            @php
                                                $valout = 'Outside Spread';

                                            @endphp
                                        @else
                                            @php
                                                $valout = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_out))
                                            @php
                                                $outhiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $outhiddden = 'hidden';

                                            @endphp
                                        @endif
                                        <!-- Component Name -->
                                        @if(!empty($val_trd))
                                            @php
                                                $valtrdd = 'Tread Width';

                                            @endphp
                                        @else
                                            @php
                                                $valtrdd = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_trd))
                                            @php
                                                $trddhiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $trddhiddden = 'hidden';

                                            @endphp
                                        @endif
                                        <!-- QTY-->
                                        @if(!empty($val_ins))
                                            @php
                                                $valqty = 'Inside Flange Diameter';

                                            @endphp
                                        @else
                                            @php
                                                $valqty = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_ins))
                                            @php
                                                $qqtyhiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $qqtyhiddden = 'hidden';

                                            @endphp
                                        @endif

                                        <!-- Description-->
                                        @if(!empty($val_shell))
                                            @php
                                                $valdes = 'Shell Bore Diameter';

                                            @endphp
                                        @else
                                            @php
                                                $valdes = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_shell))
                                            @php
                                                $deschiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $deschiddden = 'hidden';

                                            @endphp
                                        @endif
                                        <!-- OUT Date -->
                                        @if(!empty($val_trddia))
                                            @php
                                                $valotdate = 'Tread Diameter';

                                            @endphp
                                        @else
                                            @php
                                                $valotdate = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_trddia))
                                            @php
                                                $otdtehiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $otdtehiddden = 'hidden';

                                            @endphp
                                        @endif

                                        <!-- IN Date-->
                                        @if(!empty($val_outtrd))
                                            @php
                                                $valindte = 'Outside Flange Diameter';

                                            @endphp
                                        @else
                                            @php
                                                $valindte = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_outtrd))
                                            @php
                                                $indtehiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $indtehiddden = 'hidden';

                                            @endphp
                                        @endif
                                        <!-- Vendor-->
                                        @if(!empty($val_tosprd))
                                            @php
                                                $valven = 'Total Spread';

                                            @endphp
                                        @else
                                            @php
                                                $valven = '';

                                            @endphp
                                        @endif
                                        @if(!empty($val_tosprd))
                                            @php
                                                $venhiddden = '';

                                            @endphp
                                        @else
                                            @php
                                                $venhiddden = 'hidden';

                                            @endphp
                                        @endif
                                        <!-- Inspected By-->
                                            @if(!empty($val_tdhund))
                                                @php
                                                    $valins = 'Tread Diameter at 100% wear';

                                                @endphp
                                            @else
                                                @php
                                                    $valins = '';

                                                @endphp
                                            @endif
                                            @if(!empty($val_tdhund))
                                                @php
                                                    $inshiddden = '';

                                                @endphp
                                            @else
                                                @php
                                                    $inshiddden = 'hidden';

                                                @endphp
                                            @endif

                                            @if($showrolspec!=null && count($showrolspec)!=0)
                                                @php
                                                    $row = 0;
                                                @endphp
                                                @foreach($showrolspec as $rolspe)

                                                    <div class="row">
                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Part No</label>
                                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>

                                                                <select name="part_no[]" class="form-control select2">

                                                                    @php
                                                                        $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();

                                                                    @endphp

                                                                    @foreach($partno_1 as $desig)



                                                                        <option value="{{$desig->id}}" {{(old('part_no')!=$rolspe->part_no)?($desig->id==$rolspe->part_no)?'selected=selected':'': 'selected=selected'}}>{{$desig->comp_serial_no}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col" {{$outhiddden}}>
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">{{$valout}}</label>
                                                                <input type="text" name="out_spd[]" class="form-control" placeholder="" value="{{$rolspe->out_spd}}">
                                                            </div>
                                                        </div>

                                                        <div class="col"{{$trddhiddden}}>
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">{{$valtrdd}}</label>
                                                                <textarea type="text" name="tread[]" class="form-control" placeholder="" rows="1">{{$rolspe->tread}}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col"{{$qqtyhiddden}}>
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">{{$valqty}}</label>
                                                                <input type="text" name="inside_flade[]" class="form-control" placeholder="" value="{{$rolspe->inside_flade}}">
                                                            </div>
                                                        </div>

                                                        <div class="col"{{$deschiddden}}>
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">{{$valdes}}</label>
                                                                <input type="text" name="shell_bore[]" class="form-control" placeholder="" value="{{$rolspe->shell_bore}}">
                                                            </div>
                                                        </div>

                                                        <div class="col"{{$otdtehiddden}}>
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">{{$valotdate}}</label>
                                                                <input type="text" name="tread_diameter[]" class="form-control" placeholder="" value="{{$rolspe->tread_diameter}}">
                                                            </div>
                                                        </div>

                                                        <div class="col"{{$indtehiddden}}>
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">{{$valindte}}</label>
                                                                <input type="text" name="outside_flg[]" class="form-control" placeholder="" value="{{$rolspe->outside_flg}}">
                                                            </div>
                                                        </div>

                                                        <div class="col"{{$venhiddden}}>
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">{{$valven}}</label>
                                                                <input type="text" name="total_flage[]" class="form-control" placeholder="" value="{{$rolspe->total_flage}}">
                                                            </div>
                                                        </div>

                                                        <div class="col"{{$inshiddden}}>
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">{{$valins}}</label>
                                                                <input type="text" name="tread_diahund[]" class="form-control" placeholder="" value="{{$rolspe->tread_diahund}}">
                                                            </div>
                                                        </div>
                                                        @if($row == 0)
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                            </div>
                                                        @else
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                            </div>

                                                    @endif

                                                    <!--<div class="col-auto">
                                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                </div>-->
                                                    </div>
                                                    @php
                                                        $row++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Part No</label>
                                                            <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                            <select name="part_no[]" class="form-control select2">
                                                                <option selected="selected" disabled="disabled">--Select--</option>
                                                                @php
                                                                    $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();
                                                                @endphp

                                                                @foreach($partno_1 as $design)

                                                                    <option value="{{$design->id}}">{{$design->comp_serial_no}}</option>

                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col" {{$outhiddden}}>
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">{{$valout}}</label>
                                                            <input type="text" name="out_spd[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col" {{$trddhiddden}}>
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">{{$valtrdd}}</label>
                                                            <textarea type="text" name="tread[]" class="form-control" placeholder="" rows="1"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col" {{$qqtyhiddden}}>
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">{{$valqty}}</label>
                                                            <input type="text" name="inside_flade[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col" {{$deschiddden}}>
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">{{$valdes}}</label>
                                                            <input type="text" name="shell_bore[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col" {{$otdtehiddden}}>
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">{{$valotdate}}</label>
                                                            <input type="text" name="tread_diameter[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col" {{$indtehiddden}}>
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">{{$valindte}}</label>
                                                            <input type="text" name="outside_flg[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col" {{$venhiddden}}>
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">{{$valven}}</label>
                                                            <input type="text" name="total_flage[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col" {{$inshiddden}}>
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">{{$valins}}</label>
                                                            <input type="text" name="tread_diahund[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>


                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        @if((isset($showrolspec[0]->id)&& $showrolspec[0]->work_done==0)||!isset($showrolspec[0]->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>


                                    <!-- pre-history form end -->

                                </div>

                                <div class="card-body">
                                    <h4>MEASUREMENT TABLE</h4>
                                    <form method="post" action="{{url('admin/roller-measured-save')}}" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">

                                            @php
                                                $i=0;
                                            @endphp
                                            <!-- dynamic repeater wrapper -->
                                                <div class="missing-damaged-part-repeat">


                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Measured</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                    </thead>
                                                    @php
                                                        $i=0;
                                                    @endphp
                                                    @foreach($roolermea as $rolspeci)
                                                        @if($showrolmea!=Null)
                                                            @php
                                                                $rolspmea=array_search($rolspeci->description,$showrolmea->parameter);
                                                            @endphp
                                                            <tbody>
                                                            <tr>
                                                                <td>{{$rolspeci->description}}</td>
                                                                <td>
                                                                    <input type="hidden" name="parameter[{{$t}}]" value="{{$rolspeci->description}}">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="measured[{{$t}}]" value="{{$showrolmea->measured[$t]}}">
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="Remarks" rows="1" name="roolmearemarks[{{$t}}]" id="comment">{{$showrolmea->roolmearemarks[$t]}}</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                            @php
                                                                $t++;
                                                            @endphp

                                                        @else

                                                            <tbody>
                                                            <tr>
                                                                <td>{{$rolspeci->description}}</td>
                                                                <td>
                                                                    <input type="hidden" name="parameter[{{$i}}]" value="{{$rolspeci->description}}">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" placeholder="" class="form-control" id="usr" name="measured[{{$i}}]" value="">
                                                                    </div>
                                                                </td>

                                                                <td >
                                                                    <div class="form-group mb-0">
                                                                        <textarea class="form-control" placeholder="Remarks" rows="1" name="roolmearemarks[{{$i}}]" id="comment"></textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                @php
                                                    $i++;
                                                @endphp
                                                @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        @if((isset($allvalrolmea->id)&& $allvalrolmea->work_done==0)||!isset($allvalrolmea->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                </div>

                                <div class="card-body">
                                    <h4>Specifications of End Collar & Roller Shaft</h4>
                                    <form method="post" action="{{url('admin/roller-spcendcool-save')}}" enctype="multipart/form-data">
                                        <!-- dynamic repeater wrapper -->
                                        <div class="rooler-spe-endcol">



                                            @if($showrolspcend!=null && count($showrolspcend)!=0)
                                                @php

                                                    $row = 0;
                                                @endphp
                                                @foreach($showrolspcend as $rolendcol)

                                                    <div class="row">

                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Part No</label>
                                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>

                                                                <select name="part_no[]" class="form-control select2">

                                                                    @php
                                                                        $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();

                                                                    @endphp

                                                                    @foreach($partno_1 as $desig)



                                                                        <option value="{{$desig->id}}" {{(old('part_no')!=$rolendcol->part_no)?($desig->id==$rolendcol->part_no)?'selected=selected':'': 'selected=selected'}}>{{$desig->comp_serial_no}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Description</label>
                                                                <textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1">{{$rolendcol->description}}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Specification</label>
                                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                                <input type="text" name="specification[]" class="form-control" placeholder="" value="{{$rolendcol->specification}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Measured Value</label>

                                                                <input type="text" name="measured[]" class="form-control" placeholder="" value="{{$rolendcol->measured}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Remarks</label>

                                                                <input type="text" name="remarks[]" class="form-control" placeholder="" value="{{$rolendcol->remarks}}">
                                                            </div>
                                                        </div>




                                                        @if($row == 0)
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                            </div>
                                                        @else
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                            </div>

                                                    @endif

                                                    <!--<div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                            </div>-->
                                                    </div>
                                                    @php
                                                        $row++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <div class="row">

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Part No</label>
                                                            <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                            <select name="part_no[]" class="form-control select2">
                                                                <option selected="selected" disabled="disabled">--Select--</option>
                                                                @php
                                                                    $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();
                                                                @endphp

                                                                @foreach($partno_1 as $design)

                                                                    <option value="{{$design->id}}">{{$design->comp_serial_no}}</option>

                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Description</label>
                                                            <textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Specification</label>
                                                            <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                            <input type="text" name="specification[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Measured Value</label>

                                                            <input type="text" name="measured[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Remarks</label>

                                                            <input type="text" name="remarks[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>




                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        @if((isset($showrolspcend[0]->id)&& $showrolspcend[0]->work_done==0)||!isset($showrolspcend[0]->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>
                                    <!-- pre-history form end -->

                                </div>

                                <div class="card-body">

                                    <h3>Clearance Between the Shaft and the Bearing</h3>



                                    <form method="post" action="{{url('admin/roller-clear-btwshft-save')}}" enctype="multipart/form-data">
                                        <!-- dynamic repeater wrapper -->
                                        <div class="roller-clear-shaft">



                                            @if($showrollclr!=null && count($showrollclr)!=0)
                                                @php
                                                    $row = 0;
                                                @endphp
                                                @foreach($showrollclr as $rollerclr)

                                                    <div class="row">



                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Description</label>
                                                                <input type="text" name="description[]" class="form-control" placeholder="" value="{{$rollerclr->description}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Specification</label>
                                                                <textarea type="text" name="specification[]" class="form-control" placeholder="" rows="1">{{$rollerclr->specification}}</textarea>
                                                            </div>
                                                        </div>



                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Measured</label>
                                                                <input type="text" name="measured[]" class="form-control" placeholder="" value="{{$rollerclr->measured}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Remarks</label>
                                                                <input type="text" name="remarks[]" class="form-control" placeholder="" value="{{$rollerclr->remarks}}">
                                                            </div>
                                                        </div>




                                                        @if($row == 0)
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                            </div>
                                                        @else
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                            </div>

                                                    @endif

                                                    <!--<div class="col-auto">
                                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                </div>-->
                                                    </div>
                                                    @php
                                                        $row++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <div class="row">

                                                    <div class="col" >
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Description</label>
                                                            <input type="text" name="description[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Specification</label>
                                                            <textarea type="text" name="specification[]" class="form-control" placeholder="" rows="1"></textarea>
                                                        </div>
                                                    </div>



                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Measured</label>
                                                            <input type="text" name="measured[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Remarks</label>
                                                            <input type="text" name="remarks[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>


                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        @if((isset($showidlermesbef[0]->id)&& $showidlermesbef[0]->work_done==0)||!isset($showidlermesbef[0]->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>


                                    <!-- pre-history form end -->

                                </div>

                            </div>
                        </div>

                        <!-- Idler -->
                        @if(!empty($val_idlr))
                            @php
                                $idlrhiddden = '';

                            @endphp
                        @else
                            @php
                                $idlrhiddden = 'hidden';

                            @endphp
                        @endif
                        <div class="card" {{$idlrhiddden}}>
                            <div class="card-header" id="idlrInspReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#idlrInsp" aria-expanded="false" aria-controls="idlrInsp">
                                        @foreach($childsec as $dynamicchildname)

                                            @if($dynamicchildname['child_id']==20)
                                                {{$dynamicchildname['child_section']}}
                                            @endif
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="idlrInsp" class="collapse" aria-labelledby="idlrInspReport" data-parent="#cylinder-collape">
                                <h4>(A) Width of Center Flange from Center Line of Idler<br>
                                    (B) Tread Width from Center Line of Idler<br>
                                    (C) Hub Face width<br>
                                    (D) Diameter of Center Bore in Idler<br>
                                    (E) Diameter of Tread<br>
                                    (F) Height of Center Flange<br>
                                    (G) Diameter of Tread at 100% wear<br>
                                    (H) Radius at Base of Center Flange<br>
                                    (M) Installed Bearing Diameter</h4><br>
                                <div class="card-body">
                                    <h2>Specification</h2>

                                    <form method="post" action="{{url('admin/idler-specification-save')}}" enctype="multipart/form-data">
                                        <!-- dynamic repeater wrapper -->
                                        <div class="idler-spec-insp">



                                            @if($showidlerpec!=null && count($showidlerpec)!=0)
                                                @php
                                                    $row = 0;
                                                @endphp
                                                @foreach($showidlerpec as $idlerspec)

                                                    <div class="row">


                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">A</label>
                                                                <input type="text" name="width1[]" class="form-control" placeholder="" value="{{$idlerspec->width1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">B</label>
                                                                <textarea type="text" name="width2[]" class="form-control" placeholder="" rows="1">{{$idlerspec->width2}}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">C</label>
                                                                <input type="text" name="hub1[]" class="form-control" placeholder="" value="{{$idlerspec->hub1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">D</label>
                                                                <input type="text" name="diameter1[]" class="form-control" placeholder="" value="{{$idlerspec->diameter1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">E</label>
                                                                <input type="text" name="diameter2[]" class="form-control" placeholder="" value="{{$idlerspec->diameter2}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">F</label>
                                                                <input type="text" name="height1[]" class="form-control" placeholder="" value="{{$idlerspec->height1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">G</label>
                                                                <input type="text" name="diameter3[]" class="form-control" placeholder="" value="{{$idlerspec->diameter3}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">H</label>
                                                                <input type="text" name="radious1[]" class="form-control" placeholder="" value="{{$idlerspec->radious1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">M</label>
                                                                <input type="text" name="install1[]" class="form-control" placeholder="" value="{{$idlerspec->install1}}">
                                                            </div>
                                                        </div>
                                                        @if($row == 0)
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                            </div>
                                                        @else
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                            </div>

                                                    @endif

                                                    <!--<div class="col-auto">
                                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                </div>-->
                                                    </div>
                                                    @php
                                                        $row++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <div class="row">


                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">A</label>
                                                            <input type="text" name="width1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">B</label>
                                                            <textarea type="text" name="width2[]" class="form-control" placeholder="" rows="1"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">C</label>
                                                            <input type="text" name="hub1[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">D</label>
                                                            <input type="text" name="diameter1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">E</label>
                                                            <input type="text" name="diameter2[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">F</label>
                                                            <input type="text" name="height1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">G</label>
                                                            <input type="text" name="diameter3[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">H</label>
                                                            <input type="text" name="radious1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">M</label>
                                                            <input type="text" name="install1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>


                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        @if((isset($showidlerpec[0]->id)&& $showidlerpec[0]->work_done==0)||!isset($showidlerpec[0]->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>


                                    <!-- pre-history form end -->

                                </div>
                                <h2>Measurement Table</h2>
                                <div class="card-body">

                                    <h3>Before Salvage</h3>



                                    <form method="post" action="{{url('admin/idler-measured-before-save')}}" enctype="multipart/form-data">
                                        <!-- dynamic repeater wrapper -->
                                        <div class="idler-meas-before">



                                            @if($showidlermesbef!=null && count($showidlermesbef)!=0)
                                                @php
                                                    $row = 0;
                                                @endphp
                                                @foreach($showidlermesbef as $idlerbefore)

                                                    <div class="row">

                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Idler No</label>
                                                                <input type="text" name="idler_no[]" class="form-control" placeholder="" value="{{$idlerbefore->idler_no}}">
                                                            </div>
                                                        </div>
                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">A</label>
                                                                <input type="text" name="width1[]" class="form-control" placeholder="" value="{{$idlerbefore->width1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">B</label>
                                                                <textarea type="text" name="width2[]" class="form-control" placeholder="" rows="1">{{$idlerbefore->width2}}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">C</label>
                                                                <input type="text" name="hub1[]" class="form-control" placeholder="" value="{{$idlerbefore->hub1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">D</label>
                                                                <input type="text" name="diameter1[]" class="form-control" placeholder="" value="{{$idlerbefore->diameter1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">E</label>
                                                                <input type="text" name="diameter2[]" class="form-control" placeholder="" value="{{$idlerbefore->diameter2}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">F</label>
                                                                <input type="text" name="height1[]" class="form-control" placeholder="" value="{{$idlerbefore->height1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">G</label>
                                                                <input type="text" name="diameter3[]" class="form-control" placeholder="" value="{{$idlerbefore->diameter3}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">H</label>
                                                                <input type="text" name="radious1[]" class="form-control" placeholder="" value="{{$idlerbefore->radious1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">M</label>
                                                                <input type="text" name="install1[]" class="form-control" placeholder="" value="{{$idlerbefore->install1}}">
                                                            </div>
                                                        </div>
                                                        @if($row == 0)
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                            </div>
                                                        @else
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                            </div>

                                                    @endif

                                                    <!--<div class="col-auto">
                                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                </div>-->
                                                    </div>
                                                    @php
                                                        $row++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <div class="row">
                                                    <div class="col" >
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Idler No</label>
                                                            <input type="text" name="idler_no[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">A</label>
                                                            <input type="text" name="width1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">B</label>
                                                            <textarea type="text" name="width2[]" class="form-control" placeholder="" rows="1"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">C</label>
                                                            <input type="text" name="hub1[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">D</label>
                                                            <input type="text" name="diameter1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">E</label>
                                                            <input type="text" name="diameter2[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">F</label>
                                                            <input type="text" name="height1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">G</label>
                                                            <input type="text" name="diameter3[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">H</label>
                                                            <input type="text" name="radious1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">M</label>
                                                            <input type="text" name="install1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>


                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        @if((isset($showidlermesbef[0]->id)&& $showidlermesbef[0]->work_done==0)||!isset($showidlermesbef[0]->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>


                                    <!-- pre-history form end -->

                                </div>
                                <div class="card-body">

                                    <h3>After Salvage</h3>



                                    <form method="post" action="{{url('admin/idler-measured-after-save')}}" enctype="multipart/form-data">
                                        <!-- dynamic repeater wrapper -->
                                        <div class="idler-meas-after">



                                            @if($showidlermesaft!=null && count($showidlermesaft)!=0)
                                                @php
                                                    $row = 0;
                                                @endphp
                                                @foreach($showidlermesaft as $idlerafter)

                                                    <div class="row">

                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Idler No</label>
                                                                <input type="text" name="idler_no[]" class="form-control" placeholder="" value="{{$idlerafter->idler_no}}">
                                                            </div>
                                                        </div>
                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">A</label>
                                                                <input type="text" name="width1[]" class="form-control" placeholder="" value="{{$idlerafter->width1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">B</label>
                                                                <textarea type="text" name="width2[]" class="form-control" placeholder="" rows="1">{{$idlerafter->width2}}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">C</label>
                                                                <input type="text" name="hub1[]" class="form-control" placeholder="" value="{{$idlerafter->hub1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">D</label>
                                                                <input type="text" name="diameter1[]" class="form-control" placeholder="" value="{{$idlerafter->diameter1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">E</label>
                                                                <input type="text" name="diameter2[]" class="form-control" placeholder="" value="{{$idlerafter->diameter2}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">F</label>
                                                                <input type="text" name="height1[]" class="form-control" placeholder="" value="{{$idlerafter->height1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">G</label>
                                                                <input type="text" name="diameter3[]" class="form-control" placeholder="" value="{{$idlerafter->diameter3}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">H</label>
                                                                <input type="text" name="radious1[]" class="form-control" placeholder="" value="{{$idlerafter->radious1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">M</label>
                                                                <input type="text" name="install1[]" class="form-control" placeholder="" value="{{$idlerafter->install1}}">
                                                            </div>
                                                        </div>
                                                        @if($row == 0)
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                            </div>
                                                        @else
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                            </div>

                                                    @endif

                                                    <!--<div class="col-auto">
                                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                </div>-->
                                                    </div>
                                                    @php
                                                        $row++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <div class="row">
                                                    <div class="col" >
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Idler No</label>
                                                            <input type="text" name="idler_no[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">A</label>
                                                            <input type="text" name="width1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">B</label>
                                                            <textarea type="text" name="width2[]" class="form-control" placeholder="" rows="1"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">C</label>
                                                            <input type="text" name="hub1[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">D</label>
                                                            <input type="text" name="diameter1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">E</label>
                                                            <input type="text" name="diameter2[]" class="form-control" placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">F</label>
                                                            <input type="text" name="height1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">G</label>
                                                            <input type="text" name="diameter3[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">H</label>
                                                            <input type="text" name="radious1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">M</label>
                                                            <input type="text" name="install1[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>


                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        @if((isset($showidlermesbef[0]->id)&& $showidlermesbef[0]->work_done==0)||!isset($showidlermesbef[0]->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>


                                    <!-- pre-history form end -->

                                </div>
                                <div class="card-body">

                                    <h3>Specifications of End Collar & Idler Shaf</h3>



                                    <form method="post" action="{{url('admin/idler-spec-endcooler-save')}}" enctype="multipart/form-data">
                                        <!-- dynamic repeater wrapper -->
                                        <div class="idler-spec-endcol">



                                            @if($showidlerspend!=null && count($showidlerspend)!=0)
                                                @php
                                                    $row = 0;
                                                @endphp
                                                @foreach($showidlerspend as $idlerspccol)

                                                    <div class="row">

                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Part No</label>
                                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>

                                                                <select name="part_no[]" class="form-control select2">

                                                                    @php
                                                                        $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();

                                                                    @endphp

                                                                    @foreach($partno_1 as $desig)



                                                                        <option value="{{$desig->id}}" {{(old('part_no')!=$idlerspccol->part_no)?($desig->id==$idlerspccol->part_no)?'selected=selected':'': 'selected=selected'}}>{{$desig->comp_serial_no}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Description</label>
                                                                <input type="text" name="description[]" class="form-control" placeholder="" value="{{$idlerspccol->description}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Specification</label>
                                                                <textarea type="text" name="specification[]" class="form-control" placeholder="" rows="1">{{$idlerspccol->specification}}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Idler1</label>
                                                                <input type="text" name="idler1[]" class="form-control" placeholder="" value="{{$idlerspccol->idler1}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Idler2</label>
                                                                <input type="text" name="idler2[]" class="form-control" placeholder="" value="{{$idlerspccol->idler2}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Idler3</label>
                                                                <input type="text" name="idler3[]" class="form-control" placeholder="" value="{{$idlerspccol->idler3}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Idler4</label>
                                                                <input type="text" name="idler4[]" class="form-control" placeholder="" value="{{$idlerspccol->idler4}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Idler5</label>
                                                                <input type="text" name="idler5[]" class="form-control" placeholder="" value="{{$idlerspccol->idler5}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Idler6</label>
                                                                <input type="text" name="idler6[]" class="form-control" placeholder="" value="{{$idlerspccol->idler6}}">
                                                            </div>
                                                        </div>


                                                        @if($row == 0)
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                            </div>
                                                        @else
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                            </div>

                                                    @endif

                                                    <!--<div class="col-auto">
                                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                </div>-->
                                                    </div>
                                                    @php
                                                        $row++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <div class="row">
                                                    <div class="col" >
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Part No</label>
                                                            <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>

                                                            <select name="part_no[]" class="form-control select2">

                                                                @php
                                                                    $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();

                                                                @endphp

                                                                @foreach($partno_1 as $desig)



                                                                    <option value="{{$desig->id}}">{{$desig->comp_serial_no}}</option>

                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col" >
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Description</label>
                                                            <input type="text" name="description[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Specification</label>
                                                            <textarea type="text" name="specification[]" class="form-control" placeholder="" rows="1"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Idler1</label>
                                                            <input type="text" name="idler1[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Idler2</label>
                                                            <input type="text" name="idler2[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Idler3</label>
                                                            <input type="text" name="idler3[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Idler4</label>
                                                            <input type="text" name="idler4[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Idler5</label>
                                                            <input type="text" name="idler5[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Idler6</label>
                                                            <input type="text" name="idler6[]" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>


                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        @if((isset($showidlermesbef[0]->id)&& $showidlermesbef[0]->work_done==0)||!isset($showidlermesbef[0]->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>


                                    <!-- pre-history form end -->

                                </div>
                                <div class="card-body">

                                    <h3>Clearance Between the Shaft and the Bearing</h3>



                                    <form method="post" action="{{url('admin/idler-clear-btwshft-save')}}" enctype="multipart/form-data">
                                        <!-- dynamic repeater wrapper -->
                                        <div class="idler-clear-shaft">



                                            @if($showidleclr!=null && count($showidleclr)!=0)
                                                @php
                                                    $row = 0;
                                                @endphp
                                                @foreach($showidleclr as $idlerclr)

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Idler No</label>
                                                                <input type="text" name="idler_no[]" class="form-control" placeholder="" value="{{$idlerclr->idler_no}}">
                                                            </div>
                                                        </div>


                                                        <div class="col" >
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Description</label>
                                                                <input type="text" name="description[]" class="form-control" placeholder="" value="{{$idlerclr->description}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Specification</label>
                                                                <textarea type="text" name="specification[]" class="form-control" placeholder="" rows="1">{{$idlerclr->specification}}</textarea>
                                                            </div>
                                                        </div>



                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Measured</label>
                                                                <input type="text" name="measured[]" class="form-control" placeholder="" value="{{$idlerclr->measured}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="" class="form-control-label">Remarks</label>
                                                                <input type="text" name="remarks[]" class="form-control" placeholder="" value="{{$idlerclr->remarks}}">
                                                            </div>
                                                        </div>




                                                        @if($row == 0)
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                                            </div>
                                                        @else
                                                            <div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                                            </div>

                                                    @endif

                                                    <!--<div class="col-auto">
                                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                </div>-->
                                                    </div>
                                                    @php
                                                        $row++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Idler No</label>
                                                            <input type="text" name="idler_no[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>


                                                    <div class="col" >
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Description</label>
                                                            <input type="text" name="description[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Specification</label>
                                                            <textarea type="text" name="specification[]" class="form-control" placeholder="" rows="1"></textarea>
                                                        </div>
                                                    </div>



                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Measured</label>
                                                            <input type="text" name="measured[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-control-label">Remarks</label>
                                                            <input type="text" name="remarks[]" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>


                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        @hasrole('dept_eng_disassembly')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole
                                        @hasrole('dept_eng')
                                        <input type="hidden" name="dept_id" value="1">
                                        @endhasrole

                                        <input type="hidden" name="assembly_status" value="1">
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        @if((isset($showidlermesbef[0]->id)&& $showidlermesbef[0]->work_done==0)||!isset($showidlermesbef[0]->id))
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-warning" type="reset">Reset form</button>
                                        @else
                                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                                        @endif
                                    </form>


                                    <!-- pre-history form end -->

                                </div>


                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>

        <!-- LIST OF SALVAGE COMPONENT -->
        @if(!empty($sec_list))
            @php
                $listphiddden = '';

            @endphp
        @else
            @php
                $listphiddden = 'hidden';

            @endphp
        @endif

        <div class="card"{{$listphiddden}}>
            <div class="card-header" id="salvageCompList">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#salvageComponents" aria-expanded="false" aria-controls="salvageComponents">
                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==9)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach
                    </button>
                </h2>
            </div>
            <div id="salvageComponents" class="collapse" aria-labelledby="salvageCompList" data-parent="#checkSheet">
                <div class="card-body">

                    <form method="post" action="{{url('admin/check-gate-listofsalvage-dis-save')}}" enctype="multipart/form-data">
                        <!-- dynamic repeater wrapper -->
                        <div class="salvage-part-repeat">
                        @php
                            $columnsection_1=App\Helpers\UserHelper::columndynamic1(2,9);

                                               $cl = 0;
                        @endphp
                        @foreach($columnsection_1 as $collist)
                            @php


                                $collistnew[$cl] = $collist['column_name'];
                                                $cl++;

                            @endphp
                        @endforeach


                        @php
                            //echo"<pre>"; print_r($columnsection);exit;
                                                $val_arrc = in_array('Component',$collistnew);
                                            $val_qtyy = in_array('QTY',$collistnew);
                                            $val_des = in_array('Description',$collistnew);
                                            $val_otdate = in_array('OUT Date',$collistnew);
                                            $val_indate = in_array('IN Date',$collistnew);
                                            $val_ven = in_array('Vendor',$collistnew);
                                            $val_ins = in_array('Inspected',$collistnew);

                        @endphp

                        <!-- Component Name-->
                        @if(!empty($val_arrc))
                            @php
                                $valcom = 'Component';

                            @endphp
                        @else
                            @php
                                $valcom = '';

                            @endphp
                        @endif
                        @if(!empty($val_arrc))
                            @php
                                $comnmehiddden = '';

                            @endphp
                        @else
                            @php
                                $comnmehiddden = 'hidden';

                            @endphp
                        @endif
                        <!-- QTY-->
                        @if(!empty($val_qtyy))
                            @php
                                $valqty = 'QTY';

                            @endphp
                        @else
                            @php
                                $valqty = '';

                            @endphp
                        @endif
                        @if(!empty($val_qtyy))
                            @php
                                $qqtyhiddden = '';

                            @endphp
                        @else
                            @php
                                $qqtyhiddden = 'hidden';

                            @endphp
                        @endif

                        <!-- Description-->
                        @if(!empty($val_des))
                            @php
                                $valdes = 'Description';

                            @endphp
                        @else
                            @php
                                $valdes = '';

                            @endphp
                        @endif
                        @if(!empty($val_des))
                            @php
                                $deschiddden = '';

                            @endphp
                        @else
                            @php
                                $deschiddden = 'hidden';

                            @endphp
                        @endif
                        <!-- OUT Date -->
                        @if(!empty($val_otdate))
                            @php
                                $valotdate = 'OUT Date';

                            @endphp
                        @else
                            @php
                                $valotdate = '';

                            @endphp
                        @endif
                        @if(!empty($val_otdate))
                            @php
                                $otdtehiddden = '';

                            @endphp
                        @else
                            @php
                                $otdtehiddden = 'hidden';

                            @endphp
                        @endif

                        <!-- IN Date-->
                        @if(!empty($val_indate))
                            @php
                                $valindte = 'IN Date';

                            @endphp
                        @else
                            @php
                                $valindte = '';

                            @endphp
                        @endif
                        @if(!empty($val_indate))
                            @php
                                $indtehiddden = '';

                            @endphp
                        @else
                            @php
                                $indtehiddden = 'hidden';

                            @endphp
                        @endif
                        <!-- Vendor-->
                        @if(!empty($val_ven))
                            @php
                                $valven = 'Vendor';

                            @endphp
                        @else
                            @php
                                $valven = '';

                            @endphp
                        @endif
                        @if(!empty($val_ven))
                            @php
                                $venhiddden = '';

                            @endphp
                        @else
                            @php
                                $venhiddden = 'hidden';

                            @endphp
                        @endif
                        <!-- Inspected By-->
                            @if(!empty($val_ins))
                                @php
                                    $valins = 'Inspected';

                                @endphp
                            @else
                                @php
                                    $valins = '';

                                @endphp
                            @endif
                            @if(!empty($val_ins))
                                @php
                                    $inshiddden = '';

                                @endphp
                            @else
                                @php
                                    $inshiddden = 'hidden';

                                @endphp
                            @endif

                            @if($showsalvage!=null && count($showsalvage)!=0)
                                @php
                                    $row = 0;
                                @endphp
                                @foreach($showsalvage as $salvg)

                                    <div class="row">

                                        <div class="col-1" {{$comnmehiddden}}>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$valcom}}</label>
                                                <input type="text" name="component_name[]" class="form-control" placeholder="Component name" value="{{$salvg->component_name}}">
                                            </div>
                                        </div>

                                        <div class="col" {{$deschiddden}}>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$valdes}}</label>
                                                <textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1">{{$salvg->description}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-1"{{$qqtyhiddden}}>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$valqty}}</label>
                                                <input type="text" name="qty[]" class="form-control" placeholder="QTY" value="{{$salvg->qty}}">
                                            </div>
                                        </div>

                                        <div class="col"{{$otdtehiddden}}>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$valotdate}}</label>
                                                <input type="date" name="out_date[]" class="datepicker form-control" placeholder="Out date" value="{{$salvg->out_date}}">
                                            </div>
                                        </div>

                                        <div class="col"{{$indtehiddden}}>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$valindte}}</label>
                                                <input type="date" name="in_date[]" class="datepicker form-control" placeholder="In date" value="{{$salvg->in_date}}">
                                            </div>
                                        </div>

                                        <div class="col"{{$venhiddden}}>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$valven}}</label>
                                                <input type="text" name="vendor_name[]" class="form-control" placeholder="Vendor name" value="{{$salvg->vendor_name}}">
                                            </div>
                                        </div>

                                        <div class="col"{{$inshiddden}}>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">{{$valins}}</label>
                                                <input type="text" name="inspected_by[]" class="form-control" placeholder="Inspected by" value="{{$salvg->inspected_by}}">
                                            </div>
                                        </div>
                                        @if($row == 0)
                                            <div class="col-auto">
                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                            </div>
                                        @else
                                            <div class="col-auto">
                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                            </div>

                                    @endif

                                    <!--<div class="col-auto">
                                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                </div>-->
                                    </div>
                                    @php
                                        $row++;
                                    @endphp
                                @endforeach
                            @else
                                <div class="row">

                                    <div class="col-1"{{$comnmehiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$valcom}}</label>
                                            <input type="text" name="component_name[]" class="form-control" placeholder="Component name">
                                        </div>
                                    </div>

                                    <div class="col"{{$deschiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$valdes}}</label>
                                            <textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-1"{{$qqtyhiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$valqty}}</label>
                                            <input type="text" name="qty[]" class="form-control" placeholder="QTY">
                                        </div>
                                    </div>

                                    <div class="col"{{$otdtehiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$valotdate}}</label>
                                            <input type="date" name="out_date[]" class="datepicker form-control" placeholder="Out date">
                                        </div>
                                    </div>

                                    <div class="col"{{$indtehiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$valindte}}</label>
                                            <input type="date" name="in_date[]" class="datepicker form-control" placeholder="In date">
                                        </div>
                                    </div>

                                    <div class="col"{{$venhiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$valven}}</label>
                                            <input type="text" name="vendor_name[]" class="form-control" placeholder="Vendor name">
                                        </div>
                                    </div>

                                    <div class="col"{{$inshiddden}}>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{$valins}}</label>
                                            <input type="text" name="inspected_by[]" class="form-control" placeholder="Inspected by">
                                        </div>
                                    </div>


                                    <div class="col-auto">
                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                    </div>
                                </div>
                            @endif

                        </div>
                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole

                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @if((isset($showsalvage[0]->id)&& $showsalvage[0]->work_done==0)||!isset($showsalvage[0]->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif
                    </form>


                    <!-- pre-history form end -->

                </div>
                <!--<div class="card-body">

                                </div>-->

            </div>
        </div>

        <!-- Status of Revision -->


        <!-- CC Inspection Check sheet before starting assembly  -->
        @if(!empty($sec_befstrasm))
            @php
                $befstrasmhiddden = '';

            @endphp
        @else
            @php
                $befstrasmhiddden = 'hidden';

            @endphp
        @endif
        <div class="card" {{$befstrasmhiddden}}>
            <div class="card-header" id="ccInspectionbeforeStartingAssembly">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseCcInspectionbeforeStartingAssembly" aria-expanded="false" aria-controls="collapseCcInspectionbeforeStartingAssembly">
                        CC Inspection Check sheet before starting assembly
                    </button>
                </h2>
            </div>
            <div id="collapseCcInspectionbeforeStartingAssembly" class="collapse" aria-labelledby="ccInspectionbeforeStartingAssembly" data-parent="#checkSheet">
                <div class="card-body">
                    <form method="post" action="{{url('admin/check-gate-ccinspec-dis-save')}}" enctype="multipart/form-data">
                        <ul class="list-group list-group-flush list mb-3 hard-to-choose">
                            @php
                                $i=0;

                            @endphp

                            @foreach($beforestart as $qes)

                                @if($beforestartccassembly!=Null)
                                    @php
                                        $extbeforestart=array_search($qes->check_points, $beforestartccassembly->checkquestion);
                                    @endphp

                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-7"><h4 class="mb-0">{{$qes->check_points}}</h4></div>
                                            <div class="col-2">
                                                <input type="hidden" name="checkquestion[{{$i}}]" value="{{$qes->check_points}}">
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="checkans[{{$i}}]" class="custom-control-input" id="checky{{$qes->id}}" type="radio" value="yes" {{ $beforestartccassembly->checkans[$extbeforestart]=='yes'?'checked':''}}>
                                                    <label class="custom-control-label" for="checky{{$qes->id}}">Yes</label>
                                                </div>
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="checkans[{{$i}}]" class="custom-control-input" id="checkn{{$qes->id}}" type="radio" value="no" {{ $beforestartccassembly->checkans[$extbeforestart]=='no'?'checked':''}}>
                                                    <label class="custom-control-label" for="checkn{{$qes->id}}">No</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" name="rem[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="{{ $beforestartccassembly->rem[$extbeforestart]}}">
                                            </div>
                                        </div>
                                    </li>

                                    @php
                                        $i++;
                                    @endphp
                                @else
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-7"><h4 class="mb-0">{{$qes->check_points}}</h4></div>
                                            <div class="col-2">
                                                <input type="hidden" name="checkquestion[{{$i}}]" value="{{$qes->check_points}}">
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="checkans[{{$i}}]" class="custom-control-input" id="checky{{$qes->id}}" type="radio" value="yes" >
                                                    <label class="custom-control-label" for="checky{{$qes->id}}">Yes</label>
                                                </div>
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input name="checkans[{{$i}}]" class="custom-control-input" id="checkn{{$qes->id}}" type="radio" value="no" >
                                                    <label class="custom-control-label" for="checkn{{$qes->id}}">No</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" name="rem[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="">
                                            </div>
                                        </div>
                                    </li>
                                    @php
                                        $i++;
                                    @endphp
                                @endif
                            @endforeach


                        </ul>
                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole


                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @php
                            //dd($allvalexterwash->id);exit;
                        @endphp

                        @if((isset( $ccbeforestartassembly->id)&& $ccbeforestartassembly->work_done==0)||!isset( $ccbeforestartassembly->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Connecting Rod After Bush Replacement -->
        @if(!empty($sec_conrodbus))
            @php
                $conrodbushiddden = '';

            @endphp
        @else
            @php
                $conrodbushiddden = 'hidden';

            @endphp
        @endif

        <div class="card" {{$conrodbushiddden}}>
            <div class="card-header" id="conrod-bush-replace">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseconrodbush" aria-expanded="false" aria-controls="collapseconrodbush">


                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==10)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach



                    </button>
                </h2>
            </div>
            <div id="collapseconrodbush" class="collapse" aria-labelledby="conrod-bush-replace" data-parent="#checkSheet">
                <div class="card-body">
                    <form method="post" action="{{url('admin/check-gate-conrod-bush-replacement-dis-save')}}" enctype="multipart/form-data">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">

                            @php
                                $i=0;
                            @endphp
                            <!-- dynamic repeater wrapper -->
                                <div class="missing-damaged-part-repeat">


                                    <thead class="thead-light">
                                    <tr>
                                        <th>Parameter</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>Remarks</th>
                                    </tr>
                                    </thead>
                                    @php
                                        $i=0;
                                                    //$v=0;

                                    @endphp

                                    @foreach($conrodbush as $conrobushe)
                                        @if($showconrodbush!=Null)
                                            @php
                                                $chbushrp=array_search($conrobushe->parameter,$showconrodbush->parameter);
             //echo "<pre>"; print_r($conrobushe->parameter);
             //echo "<pre>"; print_r($showconrodbush->val1[$v]);
                                            @endphp
                                            <tbody>
                                            <tr>
                                                <td>{{$conrobushe->parameter}}</td>
                                                <td >
                                                    <input type="hidden" name="parameter[{{$v}}]" value="{{$conrobushe->parameter}}">
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="val1[{{$v}}]" class="form-control" id="" placeholder="" value="{{$showconrodbush->val1[$v]}}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="val2[{{$v}}]" class="form-control" id="" placeholder="" value="{{$showconrodbush->val2[$v]}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="val3[{{$v}}]" class="form-control" id="" placeholder="" value="{{$showconrodbush->val3[$v]}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="remark[{{$v}}]" class="form-control" id="" placeholder="Remarks" value="{{$showconrodbush->remark[$v]}}">
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                            @php
                                                $v++;

                                            @endphp

                                        @else
                                            <tbody>
                                            <tr>
                                                <td>{{$conrobushe->parameter}}</td>
                                                <td>
                                                    <input type="hidden" name="parameter[{{$i}}]" value="{{$conrobushe->parameter}}">
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="val1[{{$i}}]" class="form-control" id="" placeholder="" value="">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="val2[{{$i}}]" class="form-control" id="" placeholder="" value="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="val3[{{$i}}]" class="form-control" id="" placeholder="" value="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="remark[{{$i}}]" class="form-control" id="" placeholder="Remarks" value="">
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                @php
                                    $i++;
                                @endphp
                                @endif
                                @endforeach
                                @php
                                    //exit;
                                @endphp

                            </table>
                        </div>
                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole


                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        @if((isset($allvalconrodbush->id)&& $allvalconrodbush->work_done==0)||!isset($allvalconrodbush->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!--Failed Parts List  -->

        @if(!empty($sec_failed))
            @php
                $failedhiddden = '';

            @endphp
        @else
            @php
                $failedhiddden = 'hidden';

            @endphp
        @endif

        <div class="card" {{$failedhiddden}}>
            <div class="card-header" id="failedPartsList">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#failedParts" aria-expanded="false" aria-controls="failedParts">
                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==16)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach
                    </button>
                </h2>
            </div>
            <div id="failedParts" class="collapse" aria-labelledby="failedPartsList" data-parent="#checkSheet">
                <div class="card-body">

                    <form method="post" action="{{url('admin/check-gate-failed-parts-dis-save')}}" enctype="multipart/form-data">
                        <!-- dynamic repeater wrapper -->
                        <div class="failed-part-list">



                            @if($showfailed!=null && count($showfailed)!=0)
                                @php

                                    $row = 0;
                                @endphp
                                @foreach($showfailed as $failprt)

                                    <div class="row">

                                        <div class="col" >
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Part No</label>
                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>

                                                <select name="part_no[]" class="form-control select2">

                                                    @php
                                                        $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();

                                                    @endphp

                                                    @foreach($partno_1 as $desig)



                                                        <option value="{{$desig->id}}" {{(old('part_no')!=$failprt->part_no)?($desig->id==$failprt->part_no)?'selected=selected':'': 'selected=selected'}}>{{$desig->comp_serial_no}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col" >
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Description</label>
                                                <textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1">{{$failprt->description}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Qty</label>
                                                <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                                <input type="text" name="qty[]" class="form-control" placeholder="QTY" value="{{$failprt->qty}}">
                                            </div>
                                        </div>




                                        @if($row == 0)
                                            <div class="col-auto">
                                                <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                            </div>
                                        @else
                                            <div class="col-auto">
                                                <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>
                                            </div>

                                    @endif

                                    <!--<div class="col-auto">
                                                                <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                                            </div>-->
                                    </div>
                                    @php
                                        $row++;
                                    @endphp
                                @endforeach
                            @else
                                <div class="row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Part No</label>
                                            <span style="position: relative;top: -4px;"><i style="color: red;font-size: 5px;" class="fas fa-star"></i></span>
                                            <select name="part_no[]" class="form-control select2">
                                                <option selected="selected" disabled="disabled">--Select--</option>
                                                @php
                                                    $partno_1=App\Helpers\UserHelper::dropdownpartnumber_1();
                                                @endphp

                                                @foreach($partno_1 as $design)

                                                    <option value="{{$design->id}}">{{$design->comp_serial_no}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Description</label>
                                            <textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1"></textarea>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">QTY</label>
                                            <input type="text" name="qty[]" class="form-control" placeholder="QTY">
                                        </div>
                                    </div>




                                    <div class="col-auto">
                                        <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                    </div>
                                </div>
                            @endif

                        </div>
                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole

                        <input type="hidden" name="assembly_status" value="1">

                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @if((isset($showfailed[0]->id)&& $showfailed[0]->work_done==0)||!isset($showfailed[0]->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif
                    </form>
                    <!-- pre-history form end -->

                </div>
            </div>
        </div>

        <!-- Component Inspection Report -->
        @if(!empty($sec_comins))
            @php
                $cominshiddden = '';

            @endphp
        @else
            @php
                $cominshiddden = 'hidden';

            @endphp
        @endif


        <div class="card" {{$cominshiddden}}>
            <div class="card-header" id="componentInspectionReport">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapsecomponentInspectionReport" aria-expanded="false" aria-controls="collapsecomponentInspectionReport">
                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==11)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach
                    </button>
                </h2>
            </div>
            <div id="collapsecomponentInspectionReport" class="collapse" aria-labelledby="componentInspectionReport" data-parent="#checkSheet">
                <div class="card-body">
                    <form method="post" action="{{url('admin/comp-inspec-report-save')}}" enctype="multipart/form-data">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">


                                <tr>
                                    <th>Description</th>
                                    <th>Part no.</th>
                                    <th>QTY</th>
                                    <th>Condition</th>
                                    <th>Reused</th>
                                    <th>Rejected</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr><td class="tbl-title" colspan="6">TRANSMISSION HYDRAULIC CONTROL GP</td></tr>
                                @php

                                    $i=0;

                                @endphp
                                @foreach($cominspreport as $qes)
                                    @if(!empty($qes->transmission_hyd_control_gp))
                                        @if($showcompinsp!=Null)
                                            @php

                                                $otherbasic=array_search($qes->transmission_hyd_control_gp,$showcompinsp->transmissionhyd);

                                            @endphp

                                            <tr>
                                                <td>{{$qes->transmission_hyd_control_gp}}</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="hidden" name="transmissionhyd[{{$i}}]" value="{{$qes->transmission_hyd_control_gp}}">
                                                        <input type="text" name="hydpartno[{{$i}}]" class="form-control" id="" placeholder="part no" value="@if($showcompinsp!=Null){{ $showcompinsp->hydpartno[$otherbasic]}}@endif">

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="hydqty[{{$i}}]" class="form-control" id="" placeholder="qty" value="@if($showcompinsp!=Null){{$showcompinsp->hydqty[$otherbasic]}}@endif">

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="hydcond[{{$i}}]" class="form-control" id="" placeholder="condition" value="@if($showcompinsp!=Null){{$showcompinsp->hydcond[$otherbasic]}}@endif">

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        @if($showcompinsp!=Null)
                                                            <input name="hyd[{{$i}}]" class="custom-control-input" id="hydreused{{$qes->id}}" type="radio" value="Reused"{{$showcompinsp->hyd[$otherbasic]=='Reused'?'checked':''}}>
                                                        @else
                                                            <input name="hyd[{{$i}}]" class="custom-control-input" id="hydreused{{$qes->id}}" type="radio" value="Reused">
                                                        @endif
                                                        <label class="custom-control-label" for="hydreused{{$qes->id}}">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        @if($showcompinsp!=Null)
                                                            <input name="hyd[{{$i}}]" class="custom-control-input" id="hydreject{{$qes->id}}" type="radio" value="Rejected" {{$showcompinsp->hyd[$otherbasic]=='Rejected'?'checked':''}}>


                                                        @else
                                                            <input name="hyd[{{$i}}]" class="custom-control-input" id="hydreject{{$qes->id}}" type="radio" value="Rejected" >
                                                        @endif
                                                        <label class="custom-control-label" for="hydreject{{$qes->id}}">Reject</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @else
                                            <tr>
                                                <td>{{$qes->transmission_hyd_control_gp}}</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="hidden" name="transmissionhyd[{{$i}}]" value="{{$qes->transmission_hyd_control_gp}}">
                                                        <input type="text" name="hydpartno[{{$i}}]" class="form-control" id="" placeholder="part no">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="hydqty[{{$i}}]" class="form-control" id="" placeholder="qty">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="hydcond[{{$i}}]" class="form-control" id="" placeholder="condition">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        @if($showcompinsp!=Null)
                                                            <input name="hyd[{{$i}}]" class="custom-control-input" id="hydreused{{$qes->id}}" type="radio" value="Reused">

                                                        @else
                                                            <input name="hyd[{{$i}}]" class="custom-control-input" id="hydreused{{$qes->id}}" type="radio" value="Reused">
                                                        @endif
                                                        <label class="custom-control-label" for="hydreused{{$qes->id}}">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        @if($showcompinsp!=Null)
                                                            <input name="hyd[{{$i}}]" class="custom-control-input" id="hydreject{{$qes->id}}" type="radio" value="Rejected">

                                                        @else
                                                            <input name="hyd[{{$i}}]" class="custom-control-input" id="hydreject{{$qes->id}}" type="radio" value="Rejected">
                                                        @endif
                                                        <label class="custom-control-label" for="hydreject{{$qes->id}}">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach


                                <tr><td class="tbl-title" colspan="6">MOUNTNIG GP TRANSMISSION</td></tr>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($cominspreport as $lub)
                                    @if(!empty($lub->mounting_gp_transmission))
                                        @if($showcompinsp!=Null)
                                            @php
                                                $otherlubri=array_search($lub->mounting_gp_transmission,$showcompinsp->mountinggp);
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{$lub->mounting_gp_transmission}}</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="hidden" name="mountinggp[{{$i}}]" value="{{$lub->mounting_gp_transmission}}">

                                                    <input type="text" placeholder="" class="form-control" id="usr" name="mountpartno[{{$i}}]" value="@if($showcompinsp!=Null){{$showcompinsp->mountpartno[$otherlubri]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" class="form-control" id="usr" name="mountqty[{{$i}}]" value="@if($showcompinsp!=Null){{$showcompinsp->mountqty[$otherlubri]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text"  placeholder="" name="mountcond[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->mountcond[$otherlubri]}} @endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="mount[{{$i}}]" class="custom-control-input" id="mountreused{{$lub->id}}" type="radio" value="Reused" {{$showcompinsp->mount[$otherlubri]=='Reused'?'checked':''}}>
                                                    @else
                                                        <input name="mount[{{$i}}]" class="custom-control-input" id="mountreused{{$lub->id}}" type="radio" value="Reused" >
                                                    @endif
                                                    <label class="custom-control-label" for="mountreused{{$lub->id}}">Reused</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="mount[{{$i}}]" class="custom-control-input" id="mountreject{{$lub->id}}" type="radio" value="Rejected" {{$showcompinsp->mount[$otherlubri]=='Rejected'?'checked':''}}>
                                                    @else
                                                        <input name="mount[{{$i}}]" class="custom-control-input" id="mountreject{{$lub->id}}" type="radio" value="Rejected">

                                                    @endif
                                                    <label class="custom-control-label" for="mountreject{{$lub->id}}">Rejected</label>
                                                </div>
                                            </td>

                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endforeach



                                <tr><td class="tbl-title" colspan="6">PUMP GP-TRANSMISSION</td></tr>

                                @php
                                    $i=0;
                                @endphp
                                @foreach($cominspreport as $col)
                                    @if(!empty($col->pump_gp_transmission))
                                        @if($showcompinsp!=Null)
                                            @php
                                                $othercool=array_search($col->pump_gp_transmission,$showcompinsp->pumpgp);
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{$col->pump_gp_transmission}}</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="hidden" name="pumpgp[{{$i}}]" value="{{$col->pump_gp_transmission}}">

                                                    <input type="text" placeholder="" name="pumppartno[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->pumppartno[$othercool]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="pumpqty[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->pumpqty[$othercool]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="pumpcond[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->pumpcond[$othercool]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="pump[{{$i}}]" class="custom-control-input" id="pumpreused{{$col->id}}" type="radio" value="Reused" {{$showcompinsp->pump[$othercool]=='Reused'?'checked':''}}>
                                                    @else
                                                        <input name="pump[{{$i}}]" class="custom-control-input" id="pumpreused{{$col->id}}" type="radio" value="Reused">
                                                    @endif
                                                    <label class="custom-control-label" for="pumpreused{{$col->id}}">Reused</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="pump[{{$i}}]" class="custom-control-input" id="pumpreject{{$col->id}}" type="radio" value="Rejected" {{$showcompinsp->pump[$othercool]=='Rejected'?'checked':''}}>
                                                    @else
                                                        <input name="pump[{{$i}}]" class="custom-control-input" id="pumpreject{{$col->id}}" type="radio" value="Rejected" >
                                                    @endif
                                                    <label class="custom-control-label" for="pumpreject{{$col->id}}">Rejected</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endforeach


                                <tr><td class="tbl-title" colspan="6">SHAFT GP COUNTER</td></tr>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($cominspreport as $fue)
                                    @if(!empty($fue->shaft_gp_counter))
                                        @if($showcompinsp!=Null)
                                            @php
                                                $otherfuel=array_search($fue->shaft_gp_counter,$showcompinsp->shaftgp);
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{$fue->shaft_gp_counter}}</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="hidden" name="shaftgp[{{$i}}]" value="{{$fue->shaft_gp_counter}}">
                                                    <input type="text" placeholder="" name="shaftpartno[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shaftpartno[$otherfuel]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="shaftqty[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shaftqty[$otherfuel]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="shaftcond[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shaftcond[$otherfuel]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="shaft[{{$i}}]" class="custom-control-input" id="shaftreused{{$fue->id}}" type="radio" value="Reused" {{$showcompinsp->shaft[$otherfuel]=='Reused'?'checked':''}}>
                                                    @else
                                                        <input name="shaft[{{$i}}]" class="custom-control-input" id="shaftreused{{$fue->id}}" type="radio" value="Reused" >
                                                    @endif
                                                    <label class="custom-control-label" for="shaftreused{{$fue->id}}">Reused</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="shaft[{{$i}}]" class="custom-control-input" id="shaftreject{{$fue->id}}" type="radio" value="Rejected" {{$showcompinsp->shaft[$otherfuel]=='Rejected'?'checked':''}}>
                                                    @else
                                                        <input name="shaft[{{$i}}]" class="custom-control-input" id="shaftreject{{$fue->id}}" type="radio" value="Rejected">
                                                    @endif
                                                    <label class="custom-control-label" for="shaftreject{{$fue->id}}">Rejected</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endforeach


                                <tr><td class="tbl-title" colspan="6">SHAFT GP IDLER</td></tr>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($cominspreport as $goidlr)
                                    @if(!empty($goidlr->shaft_gp_idler))
                                        @if($showcompinsp!=Null)
                                            @php
                                                $sftgpidl=array_search($goidlr->shaft_gp_idler,$showcompinsp->shaftgpidler);
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{$goidlr->shaft_gp_idler}}</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="hidden" name="shaftgpidler[{{$i}}]" value="{{$goidlr->shaft_gp_idler}}">
                                                    <input type="text" placeholder="" name="shaftgppartno[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shaftgppartno[$sftgpidl]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="shaftgpqty[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shaftgpqty[$sftgpidl]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="shaftgpcond[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shaftgpcond[$sftgpidl]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="shaftgp[{{$i}}]" class="custom-control-input" id="shaftgpreused{{$goidlr->id}}" type="radio" value="Reused" {{$showcompinsp->shaftgp[$sftgpidl]=='Reused'?'checked':''}}>
                                                    @else
                                                        <input name="shaftgp[{{$i}}]" class="custom-control-input" id="shaftgpreused{{$goidlr->id}}" type="radio" value="Reused" >
                                                    @endif
                                                    <label class="custom-control-label" for="shaftgpreused{{$goidlr->id}}">Reused</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="shaftgp[{{$i}}]" class="custom-control-input" id="shaftgpreject{{$goidlr->id}}" type="radio" value="Rejected" {{$showcompinsp->shaftgp[$sftgpidl]=='Rejected'?'checked':''}}>
                                                    @else
                                                        <input name="shaftgp[{{$i}}]" class="custom-control-input" id="shaftgpreject{{$goidlr->id}}" type="radio" value="Rejected">
                                                    @endif
                                                    <label class="custom-control-label" for="shaftgpreject{{$goidlr->id}}">Rejected</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endforeach

                                <tr><td class="tbl-title" colspan="6">SHAFT GP INPUT</td></tr>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($cominspreport as $sftin)
                                    @if(!empty($sftin->shaft_gp_input))
                                        @if($showcompinsp!=Null)
                                            @php
                                                $sftgpin=array_search($sftin->shaft_gp_input,$showcompinsp->shaftgpinp);
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{$sftin->shaft_gp_input}}</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="hidden" name="shaftgpinp[{{$i}}]" value="{{$sftin->shaft_gp_input}}">
                                                    <input type="text" placeholder="" name="shaftinppartno[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shaftinppartno[$sftgpin]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="shaftinpqty[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shaftinpqty[$sftgpin]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="shaftinpcond[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shaftinpcond[$sftgpin]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="shaftinp[{{$i}}]" class="custom-control-input" id="shaftinpreused{{$sftin->id}}" type="radio" value="Reused" {{$showcompinsp->shaftinp[$sftgpin]=='Reused'?'checked':''}}>
                                                    @else
                                                        <input name="shaftinp[{{$i}}]" class="custom-control-input" id="shaftinpreused{{$sftin->id}}" type="radio" value="Reused" >
                                                    @endif
                                                    <label class="custom-control-label" for="shaftinpreused{{$sftin->id}}">Reused</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="shaftinp[{{$i}}]" class="custom-control-input" id="shaftinpreject{{$sftin->id}}" type="radio" value="Rejected" {{$showcompinsp->shaftinp[$sftgpin]=='Rejected'?'checked':''}}>
                                                    @else
                                                        <input name="shaftinp[{{$i}}]" class="custom-control-input" id="shaftinpreject{{$sftin->id}}" type="radio" value="Rejected">
                                                    @endif
                                                    <label class="custom-control-label" for="shaftinpreject{{$sftin->id}}">Rejected</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endforeach

                                <tr><td class="tbl-title" colspan="6">SHAFT OUTPUT</td></tr>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($cominspreport as $sftout)
                                    @if(!empty($sftout->shaft_output))
                                        @if($showcompinsp!=Null)
                                            @php
                                                $shaftout=array_search($sftout->shaft_output,$showcompinsp->shaftoutput);
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{$sftout->shaft_output}}</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="hidden" name="shaftoutput[{{$i}}]" value="{{$sftout->shaft_output}}">
                                                    <input type="text" placeholder="" name="shaftoutppartno[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shaftoutppartno[$shaftout]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="shaftoutpqty[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shaftoutpqty[$shaftout]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="shaftoutcond[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shaftoutcond[$shaftout]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="shaftout[{{$i}}]" class="custom-control-input" id="shaftoutreused{{$sftout->id}}" type="radio" value="Reused" {{$showcompinsp->shaftout[$shaftout]=='Reused'?'checked':''}}>
                                                    @else
                                                        <input name="shaftout[{{$i}}]" class="custom-control-input" id="shaftoutreused{{$sftout->id}}" type="radio" value="Reused" >
                                                    @endif
                                                    <label class="custom-control-label" for="shaftoutreused{{$sftout->id}}">Reused</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="shaftout[{{$i}}]" class="custom-control-input" id="shaftoutreject{{$sftout->id}}" type="radio" value="Rejected" {{$showcompinsp->shaftout[$shaftout]=='Rejected'?'checked':''}}>
                                                    @else
                                                        <input name="shaftout[{{$i}}]" class="custom-control-input" id="shaftoutreject{{$sftout->id}}" type="radio" value="Rejected">
                                                    @endif
                                                    <label class="custom-control-label" for="shaftoutreject{{$sftout->id}}">Rejected</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endforeach

                                <tr><td class="tbl-title" colspan="6">YOKE GP</td></tr>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($cominspreport as $yogp)
                                    @if(!empty($yogp->yoke_gp))
                                        @if($showcompinsp!=Null)
                                            @php
                                                $yokegp=array_search($yogp->yoke_gp,$showcompinsp->yoke);
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{$yogp->yoke_gp}}</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="hidden" name="yoke[{{$i}}]" value="{{$yogp->yoke_gp}}">
                                                    <input type="text" placeholder="" name="yokepartno[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->yokepartno[$yokegp]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="yokeqty[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->yokeqty[$yokegp]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="yokecond[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->yokecond[$yokegp]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="yoke[{{$i}}]" class="custom-control-input" id="yokereused{{$yogp->id}}" type="radio" value="Reused" {{$showcompinsp->yoke[$yokegp]=='Reused'?'checked':''}}>
                                                    @else
                                                        <input name="yoke[{{$i}}]" class="custom-control-input" id="yokereused{{$yogp->id}}" type="radio" value="Reused" >
                                                    @endif
                                                    <label class="custom-control-label" for="yokereused{{$yogp->id}}">Reused</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="yoke[{{$i}}]" class="custom-control-input" id="yokereject{{$yogp->id}}" type="radio" value="Rejected" {{$showcompinsp->yoke[$yokegp]=='Rejected'?'checked':''}}>
                                                    @else
                                                        <input name="yoke[{{$i}}]" class="custom-control-input" id="yokereject{{$yogp->id}}" type="radio" value="Rejected">
                                                    @endif
                                                    <label class="custom-control-label" for="yokereject{{$yogp->id}}">Rejected</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endforeach

                                <tr><td class="tbl-title" colspan="6">MOUNTING GP SENSOR</td></tr>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($cominspreport as $mogpsen)
                                    @if(!empty($mogpsen->mounting_gp_sensor))
                                        @if($showcompinsp!=Null)
                                            @php
                                                $montgp=array_search($mogpsen->mounting_gp_sensor,$showcompinsp->mountinggp);
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{$mogpsen->mounting_gp_sensor}}</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="hidden" name="mountinggp[{{$i}}]" value="{{$mogpsen->mounting_gp_sensor}}">
                                                    <input type="text" placeholder="" name="mountgppartno[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->mountgppartno[$montgp]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="mountgpqty[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->mountgpqty[$montgp]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="mountgpcond[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->mountgpcond[$montgp]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="mountgp[{{$i}}]" class="custom-control-input" id="mountgpreused{{$mogpsen->id}}" type="radio" value="Reused" {{$showcompinsp->mountgp[$montgp]=='Reused'?'checked':''}}>
                                                    @else
                                                        <input name="mountgp[{{$i}}]" class="custom-control-input" id="mountgpreused{{$mogpsen->id}}" type="radio" value="Reused" >
                                                    @endif
                                                    <label class="custom-control-label" for="mountgpreused{{$mogpsen->id}}">Reused</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="mountgp[{{$i}}]" class="custom-control-input" id="mountgpreject{{$mogpsen->id}}" type="radio" value="Rejected" {{$showcompinsp->mountgp[$montgp]=='Rejected'?'checked':''}}>
                                                    @else
                                                        <input name="mountgp[{{$i}}]" class="custom-control-input" id="mountgpreject{{$mogpsen->id}}" type="radio" value="Rejected">
                                                    @endif
                                                    <label class="custom-control-label" for="mountgpreject{{$mogpsen->id}}">Rejected</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endforeach

                                <tr><td class="tbl-title" colspan="6">CASE GP TRANSMISSION</td></tr>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($cominspreport as $cagptran)
                                    @if(!empty($cagptran->case_gp_transmission))
                                        @if($showcompinsp!=Null)
                                            @php
                                                $casegptr=array_search($cagptran->case_gp_transmission,$showcompinsp->casegp);
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{$cagptran->case_gp_transmission}}</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="hidden" name="casegp[{{$i}}]" value="{{$cagptran->case_gp_transmission}}">
                                                    <input type="text" placeholder="" name="casegppartno[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->casegppartno[$casegptr]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="casegpqty[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->casegpqty[$casegptr]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="casegpcond[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->casegpcond[$casegptr]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="casegp[{{$i}}]" class="custom-control-input" id="casegpreused{{$cagptran->id}}" type="radio" value="Reused" {{$showcompinsp->casegp[$casegptr]=='Reused'?'checked':''}}>
                                                    @else
                                                        <input name="casegp[{{$i}}]" class="custom-control-input" id="casegpreused{{$cagptran->id}}" type="radio" value="Reused" >
                                                    @endif
                                                    <label class="custom-control-label" for="casegpreused{{$cagptran->id}}">Reused</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="casegp[{{$i}}]" class="custom-control-input" id="casegpreject{{$cagptran->id}}" type="radio" value="Rejected" {{$showcompinsp->casegp[$casegptr]=='Rejected'?'checked':''}}>
                                                    @else
                                                        <input name="casegp[{{$i}}]" class="custom-control-input" id="casegpreject{{$cagptran->id}}" type="radio" value="Rejected">
                                                    @endif
                                                    <label class="custom-control-label" for="casegpreject{{$cagptran->id}}">Rejected</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endforeach

                                <tr><td class="tbl-title" colspan="6">SHIFT GP GEAR</td></tr>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($cominspreport as $sftgpger)
                                    @if(!empty($sftgpger->shift_gp_gear))
                                        @if($showcompinsp!=Null)
                                            @php
                                                $shiftgpgr=array_search($sftgpger->shift_gp_gear,$showcompinsp->shiftgp);
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{$sftgpger->shift_gp_gear}}</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="hidden" name="shiftgp[{{$i}}]" value="{{$sftgpger->shift_gp_gear}}">
                                                    <input type="text" placeholder="" name="shiftgppartno[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shiftgppartno[$shiftgpgr]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="shiftgpqty[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shiftgpqty[$shiftgpgr]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="text" placeholder="" name="shiftgpcond[{{$i}}]" class="form-control" id="usr" value="@if($showcompinsp!=Null){{$showcompinsp->shiftgpcond[$shiftgpgr]}}@endif">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="shiftgp[{{$i}}]" class="custom-control-input" id="shiftgpreused{{$sftgpger->id}}" type="radio" value="Reused" {{$showcompinsp->shiftgp[$shiftgpgr]=='Reused'?'checked':''}}>
                                                    @else
                                                        <input name="shiftgp[{{$i}}]" class="custom-control-input" id="shiftgpreused{{$sftgpger->id}}" type="radio" value="Reused" >
                                                    @endif
                                                    <label class="custom-control-label" for="shiftgpreused{{$sftgpger->id}}">Reused</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control custom-radio">
                                                    @if($showcompinsp!=Null)
                                                        <input name="shiftgp[{{$i}}]" class="custom-control-input" id="shiftgpreject{{$sftgpger->id}}" type="radio" value="Rejected" {{$showcompinsp->shiftgp[$shiftgpgr]=='Rejected'?'checked':''}}>
                                                    @else
                                                        <input name="shiftgp[{{$i}}]" class="custom-control-input" id="shiftgpreject{{$sftgpger->id}}" type="radio" value="Rejected">
                                                    @endif
                                                    <label class="custom-control-label" for="shiftgpreject{{$sftgpger->id}}">Rejected</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endforeach







                                </tbody>
                            </table>
                        </div>

                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole


                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        @if((isset($allvalinsprpt->id)&& $allvalinsprpt->work_done==0)||!isset($allvalinsprpt->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif
                    </form>
                </div>

            </div>
        </div>

        <!-- TRANSMISSION & TC Component Inspection Report -->
        @if(!empty($sec_trans))
            @php
                $transhiddden = '';

            @endphp
        @else
            @php
                $transhiddden = 'hidden';

            @endphp
        @endif

        <div class="card" {{$transhiddden}}>
            <div class="card-header" id="transCompReport">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapsetransComp" aria-expanded="false" aria-controls="collapsetransComp">
                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==15)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach
                    </button>
                </h2>
            </div>
            <div id="collapsetransComp" class="collapse" aria-labelledby="transCompReport" data-parent="#checkSheet">
                <div class="card-body">
                    <form method="post" action="{{url('admin/transmission-component-save')}}" enctype="multipart/form-data">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">


                                <tr>
                                    <th>Description</th>
                                    <th>Part no.</th>
                                    <th>QTY</th>
                                    <th>Condition</th>
                                    <th>Reused</th>
                                    <th>Rejected</th>
                                </tr>
                                </thead>
                                <tbody>


                                @php

                                    $i=0;

                                @endphp
                                @foreach($transmiss as $tccomp)
                                    @if(!empty($tccomp->case_parts))
                                        @if($showtransmission!=Null)
                                            @php

                                                $tccomponent=array_search($tccomp->case_parts,$showtransmission->casepart);

                                            @endphp

                                            <tr>
                                                <td>{{$tccomp->case_parts}}</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="hidden" name="casepart[{{$i}}]" value="{{$tccomp->case_parts}}">
                                                        <input type="text" name="casepartno[{{$i}}]" class="form-control" id="" placeholder="part no" value="@if($showcompinsp!=Null){{ $showtransmission->casepartno[$tccomponent]}}@endif">

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="caseqty[{{$i}}]" class="form-control" id="" placeholder="qty" value="@if($showcompinsp!=Null){{$showtransmission->caseqty[$tccomponent]}}@endif">

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="casecond[{{$i}}]" class="form-control" id="" placeholder="condition" value="@if($showtransmission!=Null){{$showtransmission->casecond[$tccomponent]}}@endif">

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        @if($showtransmission!=Null)
                                                            <input name="caseradio[{{$i}}]" class="custom-control-input" id="casereused{{$tccomp->id}}" type="radio" value="Reused"{{$showtransmission->caseradio[$tccomponent]=='Reused'?'checked':''}}>
                                                        @else
                                                            <input name="caseradio[{{$i}}]" class="custom-control-input" id="casereused{{$tccomp->id}}" type="radio" value="Reused">
                                                        @endif
                                                        <label class="custom-control-label" for="casereused{{$tccomp->id}}">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        @if($showtransmission!=Null)
                                                            <input name="caseradio[{{$i}}]" class="custom-control-input" id=casereject{{$tccomp->id}}" type="radio" value="Rejected" {{$showtransmission->caseradio[$tccomponent]=='Rejected'?'checked':''}}>


                                                        @else
                                                            <input name="caseradio[{{$i}}]" class="custom-control-input" id="casereject{{$tccomp->id}}" type="radio" value="Rejected" >
                                                        @endif
                                                        <label class="custom-control-label" for="casereject{{$tccomp->id}}">Reject</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @else
                                            <tr>
                                                <td>{{$tccomp->case_parts}}</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="hidden" name="casepart[{{$i}}]" value="{{$tccomp->case_parts}}">
                                                        <input type="text" name="casepartno[{{$i}}]" class="form-control" id="" placeholder="part no">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="caseqty[{{$i}}]" class="form-control" id="" placeholder="qty">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="casecond[{{$i}}]" class="form-control" id="" placeholder="condition">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        @if($showtransmission!=Null)
                                                            <input name="caseradio[{{$i}}]" class="custom-control-input" id="casereused{{$tccomp->id}}" type="radio" value="Reused">

                                                        @else
                                                            <input name="caseradio[{{$i}}]" class="custom-control-input" id="casereused{{$tccomp->id}}" type="radio" value="Reused">
                                                        @endif
                                                        <label class="custom-control-label" for="casereused{{$tccomp->id}}">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        @if($showtransmission!=Null)
                                                            <input name="caseradio[{{$i}}]" class="custom-control-input" id="casereject{{$tccomp->id}}" type="radio" value="Rejected">

                                                        @else
                                                            <input name="caseradio[{{$i}}]" class="custom-control-input" id="casereject{{$tccomp->id}}" type="radio" value="Rejected">
                                                        @endif
                                                        <label class="custom-control-label" for="casereject{{$tccomp->id}}">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach




                                </tbody>
                            </table>
                        </div>

                        @hasrole('dept_eng_disassembly')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole
                        @hasrole('dept_eng')
                        <input type="hidden" name="dept_id" value="1">
                        @endhasrole

                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        @if((isset($allvaltrans->id)&& $allvaltrans->work_done==0)||!isset($allvaltrans->id))
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-warning" type="reset">Reset form</button>
                        @else
                            <button class="btn btn-primary" type="submit" disabled>Save</button>
                            <button class="btn btn-warning" type="reset" disabled>Reset form</button>
                        @endif
                    </form>
                </div>

            </div>
        </div>

        




        <!-- Engine Assembly Check sheet  -->
        
        @if(!empty($sec_engassem))
            @php
                $engassemhiddden = '';

            @endphp
        @else
            @php
                $engassemhiddden = 'hidden';

            @endphp
        @endif

        <div class="card" {{$engassemhiddden}}>
            <div class="card-header" id="engineassemblychecksheet">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseengineassemblychecksheet" aria-expanded="false" aria-controls="collapseengineassemblychecksheet">
                        @foreach($compdet as $dynamicsectionname)

                            @if($dynamicsectionname['section_id']==17)
                                {{$dynamicsectionname['section_name']}}
                            @endif
                        @endforeach
                    </button>
                </h2>
            </div>
            <div id="collapseengineassemblychecksheet" class="collapse show" aria-labelledby="engineassemblychecksheet" data-parent="#checkSheet">
                <div class="card-body">
                    <form method="post" action="{{url('admin/engine-assembly-save')}}" enctype="multipart/form-data">


                         <div class="table-responsive">
                            <table class="table align-items-center table-flush">

                            @php

                        
                                $i=0;
                            @endphp
                            <!-- dynamic repeater wrapper -->
                                <div class="engine-assembly-checksheet">


                                    <thead class="thead-light">
                                    <tr>
                                        <th>Operation despcription</th>
                                        <th>Specification</th>
                                        <th>Actual Value</th>

                                        <th>Updated By</th>

                                    </tr>
                                    </thead>

                                    @php
                                    

                                        $i=0;
                                    @endphp
                                    @foreach($engineassembly as $qes)
                                        @if(!empty($qes->operation_desp))
                                            @if($showassembly!=Null)
                                                @php
                                                    $actual=array_search($qes->operation_desp,$showassembly->operationdesp);

                                                @endphp
                                                <tbody>
                                                <tr>
                                                    <td style="max-width: 300px; white-space: pre-line;"><h3>{{$qes->header}}</h3> <br> {{$qes->operation_desp}}</td>
                                                    <td style="max-width: 250px;white-space: pre-line;">
                                                        <input type="hidden" name="operationdesp[{{$i}}]" value="{{$qes->operation_desp}}">
                                                        <div class="form-group mb-0">
                                                            <input type="hidden" name="specification[{{$i}}]" value="{{$qes->specification}}">
                                                            
                                                            {{$qes->specification}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($showassembly->actval[$i] !='')

                                                        @if(!empty($mydata) && $mydata[$i] !='')
                                                            <div class="form-group mb-0">
                                                                <input type="text" name="actval[{{$i}}]" value="{{$showassembly->actval[$i]}}" class="round">
                                                            </div>
                                                        @else

                                                            <div class="form-group mb-0">
                                                                <input type="text" name="actval[{{$i}}]" value="{{$showassembly->actval[$i]}}" disabled="disabled" class="round">
                                                            </div>
                                                            
                                                                <input type="hidden" name="actval[{{$i}}]" value="{{$showassembly->actval[$i]}}">


                                                            
                                                        

                                                        @endif    



                                                        @else

                                                        <div class="form-group mb-0">
                                                            <input type="text" name="actval[{{$i}}]" value="{{$showassembly->actval[$i]}}" class="round">
                                                        </div>


                                                        @endif
                                                    </td>

                                                    <td> @if (isset($showassembly->username[$i])) 
                                                        {{$showassembly->username[$i]}}
                                                       
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                                @php
                                                    $i++;
                                                @endphp
                                            @else


                                                <tbody>
                                                <tr>
                                                    <td style="max-width: 300px; white-space: pre-line;"><h3>{{$qes->header}}</h3> <br>{{$qes->operation_desp}}</td>
                                                    <td style="max-width: 250px;white-space: pre-line;">
                                                        <input type="hidden" name="operationdesp[{{$i}}]" value="{{$qes->operation_desp}}">
                                                        <div class="form-group mb-0">
                                                            <input type="hidden" name="specification[{{$i}}]" value="{{$qes->specification}}">
                                                            <!-- <input type="hidden" name="username[{{$i}}]" value="{{$username}}"> -->
                                                            {{$qes->specification}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group mb-0">
                                                            <input type="text" name="actval[{{$i}}]" value="" class="round">
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>

                                                @php
                                                    $i++;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach

                                </div>
                            </table>
                        </div> @php
                            $i++;
                        @endphp

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="date-of-dispatch">Actual Start Date</label>
                                    @if(!empty($allvalassembly->actual_start_date))
                                        @if(DateTime::createFromFormat('Y-m-d', $allvalassembly->actual_start_date) !== FALSE)
                                        <input type="text" name="actual_start_date" class="form-control" id="" placeholder="Date" value=" {{ date('d/m/Y', strtotime($allvalassembly->actual_start_date))}}" readonly>
                                         @else
                                        <input type="text" name="actual_start_date" class=" form-control" id="date-of-dispatch" placeholder="Date" value="{{$allvalassembly->actual_start_date}}" readonly>
                                           @endif
                                    @else
                                        <input type="text" name="actual_start_date" class="form-control" id="assemblydate" placeholder="Date" value="" required>

                                    @endif

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="date-of-dispatch">Actual End Date</label>
                                    @if(!empty($allvalassembly->actual_end_date))
                                        @if(DateTime::createFromFormat('Y-m-d', $allvalassembly->actual_end_date) !== FALSE)
                                            <input type="text" name="actual_end_date" class="form-control" id="assemblydate1" placeholder="Date" value=" {{ date('d/m/Y', strtotime($allvalassembly->actual_end_date))}}" required>
                                        @else
                                            <input type="text" name="actual_end_date" class=" form-control" id="assemblydate1" placeholder="Date" value="{{$allvalassembly->actual_end_date}}" required>
                                        @endif
                                    @else
                                        <input type="text" name="actual_end_date" class="form-control" id="assemblydate1" placeholder="Date" value="" required>

                                    @endif

                                </div>
                            </div>
							<!--coded by amanur start-->
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-control-label" for="serial">Bay No</label>
									<select name="bay_no" class="form-control ">
										<option value="">--Select--</option>
										@for ($i = 0; $i <= 10; $i++)
										<option value="{{ $i }}"  {{ (isset($allvalassembly) && ($allvalassembly->bay_no == $i ))  ? 'selected' : '' }}  >{{ $i }}</option>

									@endfor
									</select>
								</div>
                            </div>
                        </div>
						<!--coded by amanur end-->

                        <input type="hidden" name="assembly_status" value="1">
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <!-- /row -->
                                 
                       @if((isset($allvalassembly->id)&& $allvalassembly->ass_Work_done==0) || empty($allvalassembly->id))
                        
                            <button class="btn btn-primary" type="submit">Save</button>
                            
                         
                        @endif
                    </form>

                </div>
            </div>
        </div>

        



        @php
            $countsection=App\Helpers\UserHelper::sectionassycount($deptid,$service->machine_modelno);
            $totalassytable =App\Helpers\UserHelper::tableassycount($deptid,$service->id);



        @endphp

            @if(($countsection == $totalassytable) && ($rejectmsg1['assembly_status'] == 'Pending'))
            <form method="post" action="{{url('admin/check-sheet-assy-total-form-save')}}" enctype="multipart/form-data">
                <input type="hidden" name="service_id" value="{{$service->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input class="btn btn-primary" type="submit" value="submit">

            </form>
        @elseif(($countsection == $totalassytable) && ($rejectmsg1['assembly_status'] == 'Rejected'))
                <form method="post" action="{{url('admin/check-sheet-assy-total-form-save')}}" enctype="multipart/form-data">
                    <input type="hidden" name="service_id" value="{{$service->id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input class="btn btn-primary" type="submit" value="submit">

                </form>

        @elseif(($countsection == $totalassytable) && ($rejectmsg1['assembly_status'] == 'Submitted'))
            <input class="btn btn-primary" type="submit" value="submit" hidden>


        @endif

        {{-- @if(isset($agrregate->id) && $agrregate->work_done ==1)
              <form method="post" action="{{url('admin/excel-download')}}" enctype="multipart/form-data">
                  <input type="hidden" name="service_id" value="{{$service->id}}">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input class="btn btn-primary" type="submit" value="Excel Download">
              </form>
          @endif--}}


    </div>
    
     @if (request()->session()->get('user')['section_id'] == '10'|| request()->session()->get('user')['section_id'] == '11'||request()->session()->get('user')['section_id'] == '12'||request()->session()->get('user')['section_id'] == '14'||request()->session()->get('user')['section_id'] == '15')
                @if(request()->session()->get('user')['role_id'] == '1')
                    <div class="col-14">
                        @if($rejectmsg1['assembly_status']=='Rejected')
                            <label class="form-control-label" for="customer" style="padding-top: 20px">CheckSheet Rejected  at   {{$rejectmsg1['created_at']}}</label>
                            <textarea type="text" name="comment_for_approve" class="form-control " id="commentrgt" disabled>{{$rejectmsg1['assembly_comment']}}</textarea>
                        @endif
                    </div>
                @endif
            @endif

    @if (request()->session()->get('user')['section_id'] == '10' ||request()->session()->get('user')['section_id'] == '11' ||request()->session()->get('user')['section_id'] == '12' ||request()->session()->get('user')['section_id'] == '14' ||request()->session()->get('user')['section_id'] == '15')
        @if(request()->session()->get('user')['role_id'] == '2')
          @if($rejectmsg1['assembly_status'] != 'Approved')
            <div class="" style="padding-right: 70px">
                <form method="post" action="{{url('admin/head-approve-assemblychecksheet-save')}}" enctype="multipart/form-data">
                    <div class="custom-control custom-control-inline custom-radio">
                        <input name="status" class="custom-control-input approved" id="approved" type="radio" value="Approved">
                        <label class="custom-control-label" for="approved">Approve</label>
                    </div>
                    <div class="text-right mb-1 col-md-4 commentapr"  style="display:none" >

                        <input type="text" name="comment_for_approve" class="form-control" id="commentapr" value="" >
                    </div>

                    <div class="custom-control custom-control-inline custom-radio">
                        <input name="status" class="custom-control-input rejected" id="rejected" type="radio" value="Rejected">
                        <label class="custom-control-label" for="rejected">Reject</label>
                    </div>
                    <div class="text-right mb-1 col-md-4 commentrgt"  style="display:none">

                        <input type="text" name="comment_for_approve" class="form-control " id="commentrgt1" value="">
                    </div>

                    <input type="hidden" name="service_id" value="{{$service->id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input class="btn btn-primary" type="submit" value="submit">

                </form>


            </div>
            @endif
        @endif
    @endif


@endsection

@section('after_script')
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        $('.select2').select2();

    </script>

<script type="text/javascript">
        /*component model no*/
        $('#rejected').click(function(event) {
            //var commodel = $(this).val();
            var commodel = $("input[name='service_id']").val();
            //alert(commodel);
            console.log(commodel);

            $.ajax({

                url: '{{ url("/admin/checksheet-assy-button-open-form-save") }}',

                type: 'POST',

                data: {commodel:commodel,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {
                    //console.log(response);







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

    <!-- Loose parts report add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.loose-part-repeat'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col-md-2">'+
                '<div class="form-group">'+
                '<select name="part_no[]" class="form-control select2">'+
                ' <option selected disabled>--Select--</option>'+

                    {{--+--}}
                        " @foreach($partno as $desig) " +
                '<option value="{{$desig->id}}">{{$desig->comp_serial_no}}</option>'+
                " @endforeach " +
                '</select>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="part_description[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col-md-1">'+
                '<div class="form-group">'+
                '<input type="text" name="qty[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="part_condition[]" class="form-control" placeholder="Part condition" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<div class="custom-file">'+
                '<input name="photograph[]" type="file" class="custom-file-input" id="customFileLang" lang="en">'+
                '<label class="custom-file-label" for="customFileLang">Photograph taken</label>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- Missing/Damaged Parts add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.missing-damaged-part-repeat'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col-2"{{$prtdeshiddden}}>'+
                '<div class="form-group">'+
                '<textarea type="text" name="description[]" class="form-control" placeholder="Part Description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col-md-1" {{$qqtyhiddden}}>'+
                '<div class="form-group">'+
                '<input type="text" name="qty[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col"{{$mishiddden}}>'+
                '<div class="form-group">'+
                '<textarea type="text" name="missing_damage[]" class="form-control" placeholder="Missing/ Damaged" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col-2"{{$phohiddden}}>'+
                '<div class="form-group">'+
                '<div class="custom-control custom-control custom-radio">'+
                '<input name="photo[]" class="custom-control-input" id="y1[]" type="radio" value="yes">'+
                '<label class="custom-control-label" for="y1[]">Yes</label>'+
                '</div>'+
                '<div class="custom-control custom-control custom-radio">'+
                '<input name="photo[]" class="custom-control-input" id="n1[]" type="radio" value="no">'+
                '<label class="custom-control-label" for="n1[]">No</label>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="col"{{$damhiddden}}>'+
                '<div class="form-group"><textarea type="text" name="damage_details[]" class="form-control" placeholder="Damage Details" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col"{{$acthiddden}}>'+
                '<div class="form-group">'+
                '<textarea type="text" name="action_taken[]" class="form-control" placeholder="Action taken" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col-auto"> '+
                ' <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- LIST OF SALVAGE COMPONENT add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.salvage-part-repeat'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col"{{$comnmehiddden}}>'+
                '<div class="form-group">'+
                '<input type="text" name="component_name[]" class="form-control" placeholder="Component name">'+
                '</div>'+
                '</div>'+
                '<div class="col"{{$valdes}}>'+
                '<div class="form-group">'+
                '<textarea type="text" name="description[]" class="form-control" placeholder="Description of rework" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col-1"{{$valqty }}>'+
                '<div class="form-group">'+
                '<input type="text" name="qty[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col"{{$valotdate}}>'+
                '<div class="form-group">'+
                '<input type="date" name="out_date[]" class="datepicker form-control" placeholder="Out date">'+
                '</div>'+
                '</div>'+
                '<div class="col"{{$valindte}}>'+
                '<div class="form-group">'+
                '<input type="date" name="in_date[]" class="datepicker form-control" placeholder="In date">'+
                '</div>'+
                '</div>'+
                '<div class="col"{{$valven}}>'+
                '<div class="form-group">'+
                '<input type="text" name="vendor_name[]" class="form-control" placeholder="Vendor name">'+
                '</div>'+
                '</div>'+
                '<div class="col"{{$valins}}>'+
                '<div class="form-group">'+
                '<input type="text" name="inspected_by[]" class="form-control" placeholder="Inspected by">'+
                '</div>'+
                '</div>'+
                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!--Status of Revision-->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.status-revision'); //Input field wrapper
            var fieldHTML = '<div class="row">'+

                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="details_of_amendment[]" class="form-control" placeholder="Details of Amendment" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="revision_no[]" class="form-control" placeholder="Revision No">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="page_no[]" class="form-control" placeholder="Page No">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="reason_for_amendment[]" class="form-control" placeholder="Reason for Amendment">'+
                '</div>'+
                '</div>'+
                '<div class="col-auto"> '+
                ' <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

//Once add button is clicked
            $(addButton).click(function(){
//Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

//Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>


    <!-- Failed parts list add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.failed-part-list'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<select name="part_no[]" class="form-control select2">'+
                ' <option selected disabled>--Select--</option>'+

                    {{--+--}}
                        " @foreach($partno_1 as $desig) " +
                '<option value="{{$desig->id}}">{{$desig->comp_serial_no}}</option>'+
                " @endforeach " +
                '</select>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="description[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="qty[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+

                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- clutch pack thickness add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.clutch-pack-thickness'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<select name="part_no[]" class="form-control select2">'+
                ' <option selected disabled>--Select--</option>'+

                    {{--+--}}
                        " @foreach($partno_1 as $desig) " +
                '<option value="{{$desig->id}}">{{$desig->comp_serial_no}}</option>'+
                " @endforeach " +
                '</select>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="description[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="qty[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="section[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="actual_val[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="measured_val[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+

                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- clutch plate thickness add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.clutch-plate-thickness'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<select name="part_no[]" class="form-control select2">'+
                ' <option selected disabled>--Select--</option>'+

                    {{--+--}}
                        " @foreach($partno_1 as $desig) " +
                '<option value="{{$desig->id}}">{{$desig->comp_serial_no}}</option>'+
                " @endforeach " +
                '</select>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="description[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="qty[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="section[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="actual_val[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="measured_val[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+

                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- clutch plate flatness add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.clutch-plate-flatness'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<select name="part_no[]" class="form-control select2">'+
                ' <option selected disabled>--Select--</option>'+

                    {{--+--}}
                        " @foreach($partno_1 as $desig) " +
                '<option value="{{$desig->id}}">{{$desig->comp_serial_no}}</option>'+
                " @endforeach " +
                '</select>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="description[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="qty[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="section[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="actual_val[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="measured_val[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+

                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- torque converter add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.torque-converter'); //Input field wrapper
            var fieldHTML = '<div class="row">'+

                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="clearance_component[]" class="form-control" placeholder="" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="turbine_diameter[]" class="form-control" placeholder="">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="stator_diameter[]" class="form-control" placeholder="">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="max_worn[]" class="form-control" placeholder="">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="measured_val[]" class="form-control" placeholder="">'+
                '</div>'+
                '</div>'+

                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- rooler spe add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.roller-spec-insp'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<select name="part_no[]" class="form-control select2">'+
                ' <option selected disabled>--Select--</option>'+

                    {{--+--}}
                        " @foreach($partno_1 as $desig) " +
                '<option value="{{$desig->id}}">{{$desig->comp_serial_no}}</option>'+
                " @endforeach " +
                '</select>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="out_spd[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="tread[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="inside_flade[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="shell_bore[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="tread_diameter[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="outside_flg[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="total_flage[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="tread_diahund[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+

                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- rooler spe end  list add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.rooler-spe-endcol'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<select name="part_no[]" class="form-control select2">'+
                ' <option selected disabled>--Select--</option>'+

                    {{--+--}}
                        " @foreach($partno_1 as $desig) " +
                '<option value="{{$desig->id}}">{{$desig->comp_serial_no}}</option>'+
                " @endforeach " +
                '</select>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="description[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="specification[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="measured[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="remarks[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+

                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- roller clear shaft add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.roller-clear-shaft'); //Input field wrapper
            var fieldHTML = '<div class="row">'+

                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="description[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="specification[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+

                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="measured[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="remarks[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+


                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- idler spe add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.idler-spec-insp'); //Input field wrapper
            var fieldHTML = '<div class="row">'+

                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="width1[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="width2[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="hub1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="diameter1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="diameter2[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="height1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="diameter3[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="radious1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="install1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- idler meas before add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.idler-meas-before'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="idler_no[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="width1[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="width2[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="hub1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="diameter1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="diameter2[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="height1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="diameter3[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="radious1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="install1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>


    <!-- idler meas after add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.idler-meas-after'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="idler_no[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="width1[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="width2[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="hub1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="diameter1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="diameter2[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="height1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="diameter3[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="radious1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="install1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- idler spc endcol add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.idler-spec-endcol'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<select name="part_no[]" class="form-control select2">'+
                ' <option selected disabled>--Select--</option>'+

                    {{--+--}}
                        " @foreach($partno_1 as $desig) " +
                '<option value="{{$desig->id}}">{{$desig->comp_serial_no}}</option>'+
                " @endforeach " +
                '</select>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="description[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="specification[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="idler1[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="idler2[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="idler3[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="idler4[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="idler5[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="idler6[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+

                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <!-- idler clear shaft add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.idler-clear-shaft'); //Input field wrapper
            var fieldHTML = '<div class="row">'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="idler_no[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<textarea type="text" name="description[]" class="form-control" placeholder="Part description" rows="1"></textarea>'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="specification[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+

                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="measured[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+
                '<div class="col">'+
                '<div class="form-group">'+
                '<input type="text" name="remarks[]" class="form-control" placeholder="QTY">'+
                '</div>'+
                '</div>'+


                '<div class="col-auto">'+
                '<a href="javascript:void(0);" class="btn btn-danger remove_button">-</a>'+
                '</div>'+
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $('.select2').select2();
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>


    <!-- head radio button approve/reject -->
    <script type="text/javascript">
        /*Model serial no*/
        $('#approved').change(function() {
            //alert(1);
            $(".commentapr").show();
            $(".commentrgt").hide();

            //console.log(model);

        });
        $('#rejected').change(function() {
            // alert(1);
            $(".commentapr").hide();
            $(".commentrgt").show();
            $(".commentrgt").prop("disabled".false);


            //console.log(model);

        });

    </script>









    <script type="text/javascript">
        /*Model serial no*/
        $('#approved').change(function() {
            //alert(1);
            $(".commentapr").show();
            $(".commentrgt").hide();

            //console.log(model);

        });
        $('#rejected').change(function() {
            // alert(1);
            $(".commentapr").hide();
            $(".commentrgt").show();
            $(".commentrgt").prop("disabled".false);


            //console.log(model);

        });

    </script>

<script>

            $('#assemblydate').datepicker({


        format: "dd/mm/yyyy",
            autoclose: true,
        //startDate: new Date('2019-12-5'),
         endDate: "today",
         });

            $('#assemblydate1').datepicker({


                format: "dd/mm/yyyy",
                autoclose: true,
                //startDate: new Date('2019-12-5'),
                endDate: "today",
            });



        </script>



@endsection

