<?php

namespace App\Helpers;

use App\Models\CcInspectionAfterExternalwashDis;
use App\Models\CcInspectionAfterPartCleaningDis;
use App\Models\ChecksheetAssembly;
use App\Models\ChecksheetChildSection;
use App\Models\ChecksheetColumn;
use App\Models\ChecksheetSectionWiseColumn;
use App\Models\ChecksheetColumnStore;
use App\Models\ChecksheetSubChildSection;
use App\Models\EngineAssembly;
use App\Models\MasterAggregate;
use App\Models\MasterBranch;
use App\Models\MasterCCinspectionBeforeStartAssembly;
use App\Models\MasterCcinspectionExternalWashDetails;
use App\Models\MasterCheckGate;
use App\Models\MasterCheckGateInspectionQuestion;
use App\Models\MasterCheckSheetSection;
use App\Models\MasterCommercialLogisticDetails;
use App\Models\CheckgateOneFollowedUp;
use App\Models\MasterCommercialValues;
use App\Models\MasterComponentArrangementNo;
use App\Models\MasterComponentDetails;
use App\Models\MasterComponentModelNo;
use App\Models\MasterComponentSerialNo;
use App\Models\MasterComponentType;
use App\Models\MasterConRodBushReplacementDetails;
use App\Models\MasterCoolerInspection;
use App\Models\MasterCustomer;
use App\Models\MasterDepartment;
use App\Models\MasterEmployee;
use App\Models\MasterDesignation;
use App\Models\MasterJobType;
use App\Models\MasterListofSalvageDis;
use App\Models\MasterLocation;
use App\Models\MasterLoosepartDis;
use App\Models\MasterMachine;
use App\Models\MasterMachineModelNo;
use App\Models\MasterMachineSerialNo;
use App\Models\MasterMCModel;
use App\Models\MasterMCSerialNumber;
use App\Models\MasterMissingdamagePartDis;
use App\Models\MasterPartAirCompressorDetails;
use App\Models\MasterPartCamshaftBushboreDetails;
use App\Models\MasterPartCamshaftDetails;
use App\Models\MasterPartCamshaftValue;
use App\Models\MasterPartConnectingRodDetails;
use App\Models\MasterPartConnectingRodValues;
use App\Models\MasterPartCrankshaftDetails;
use App\Models\MasterPartCrankshaftValue;
use App\Models\MasterPartCylinderBlockCapNODetails;
use App\Models\MasterPartCylinderBlockThreadDetails;
use App\Models\MasterPartCylinderBlockTopDeckDetails;
use App\Models\MasterPartCylinderHeadDetails;
use App\Models\MasterPartCylinderHeadValues;
use App\Models\MasterPartFanDriveDetails;
use App\Models\MasterPartinspectionCylinderHeadDetails;
use App\Models\MasterPartOilPumpDetails;
use App\Models\MasterPartOthercomponentBasicEngine;
use App\Models\MasterPartOthercomponentCoolingSystem;
use App\Models\MasterPartOthercomponentFuelSystem;
use App\Models\MasterPartOthercomponentLubricationSystem;
use App\Models\MasterPartOthercomponentValues;
use App\Models\MasterPartsInspectionCylinderHeadValues;
use App\Models\MasterPartWaterPumpDetails;
use App\Models\MasterPreHistoryDis;
use App\Models\PartPinInspMea;
use App\Models\PartBushInspMea;
use App\Models\PartTrackLinkBush;
use App\Models\PartTrackLinkHeight;
use App\Models\PartTrackLinkPin;
use App\Models\PartTrackPitch;
use App\Models\PartTrackShoe;
use App\Models\MasterSection;
use App\Models\MasterSegment;
use App\Models\MasterTaskName;
use App\Models\ModelWiseCheecksheet;
use App\Models\PdiChecksheetDetails;
use App\Models\PdiChecksheetEngineAssy;
use App\Models\PdiChecksheetTransmissionAssy;
use App\Models\BisQuestion;
use App\Models\Roles;
use App\Models\Masterrole;
use App\Models\MasterTask;
use App\Models\Menu;
use App\Models\Menuaccess;
use App\Models\RoolerMeasuredDetails;
use App\Models\Service;
use App\Models\StoreStatus;
use App\Models\InspectionBeforeStartAssembly;
use App\Models\ComponentInspectionReport;
use App\Models\StatusRevision;
use App\Models\TorqueConverterValues;
use App\Models\TransmissionComponent;
use App\Models\TransmissionComponentDetails;

use App\Models\ClutchPackThicknessValues;
use App\Models\ClutchPlateFlatnessValues;
use App\Models\ClutchPlateThicknessValues;
use App\Models\ComponentInspReport;
use App\Models\CoolerInspectionValues;
use App\Models\IdlerMeasuredAfterValues;
use App\Models\IdlerMeasuredBeforeValues;
use App\Models\IdlerspcClearShaftValues;
use App\Models\IdlerSpeciEndcolerValues;
use App\Models\IdlerSpecificationValues;
use App\Models\MasterConRodBushReplacementValues;

use App\Models\MasterDissamblyCleaningInspection;


use App\Models\MasterCcinspectionPartCleanDetails;



use App\Models\MasterFailedParts;

use App\Models\MasterPartAirCompressorValues;

use App\Models\MasterPartFanDriveValues;

use App\Models\MasterPartOilPumpValues;

use App\Models\MasterPartWaterPumpValues;
use App\Models\MasterStdData;
use App\Models\PartsInspectionStdData;
use App\Models\PartCamshaftBushboreValues;
use App\Models\PartCylinderBlockBushboreValues;
use App\Models\PartCylinderBlockCamboreValues;
use App\Models\PartCylinderBlockCapNoValues;
use App\Models\PartCylinderBlockLinearValues;
use App\Models\PartCylinderBlockThreadValues;
use App\Models\PartCylinderBlockTopDeckValues;
use App\Models\PartLhCamshaftValue;
use App\Models\PartRhCamshaftValue;
use App\Models\RollerspcClearShaftValues;
use App\Models\RoolerMeasuredValues;
use App\Models\RoolerSpecificationValues;
use App\Models\RoolerSpecifiEndColValues;
use App\Models\ProjectPlanMaster;
use App\Models\ProjectTask;
use App\Models\ProjectUser;
use App\Models\User;
use App\Models\TaskUser;
use Carbon\Carbon;
use DB;
use Hash;
use Auth;
use Mail;
use DataTables;
use Session;
use Redirect;
use Alert;
use Input;
use Illuminate\Support\Facades\Crypt;
use App\Providers\HelperServiceProvider;
use Spatie\Permission\Models\Role;


class UserHelper extends HelperServiceProvider{


    static function role()
    {
        $role=Role::where('name','!=','super_admin')->get();

        return $role;
    }
    static function checkgate()
    {
        $checkgate=MasterCheckGate::get();

        return $checkgate;
    }
    static function checkgatejobtype()
    {
        $checkjob=MasterJobType::select('*')->where('status','=','Active')->get();

        return $checkjob;
    }

    static function customer()
    {
        $custom = MasterCustomer::get();
        return $custom;
    }
    static function componentserialno()
    {
        //$compserial = MasterComponentSerialNo::get();
		$compserial = MasterComponentDetails::get();
        return $compserial;
    }

    static function componenttype()
    {
        $comptype = MasterComponentType::get();
        return $comptype;
    }

    static function componentmodelno()
    {
        //$compmodel=MasterComponentModelNo::get();
		$compmodel=MasterComponentDetails::get();

        return $compmodel;
    }
    static function getComponentModelNoById($id)
    {
        $compmodel=MasterComponentModelNo::find($id);
        return $compmodel;
    }
    
    
    static function bis()
    {
        $bischeck=BisQuestion::get();

        return $bischeck;
    }
    
    static function departmentname()
	  {
      $deptname=MasterDepartment::select('*')->get();
	  
	  return $deptname;
	  }

    static function branchname()
    {
        $branchnme=MasterBranch::get();

        return $branchnme;
    }

    static function segment()
    {
        $segment=MasterSegment::get();

        return $segment;
    }


//time sheet
    static function serviceRequestNo()
    {
        $serviceRequestNo=Service::get();

        return $serviceRequestNo;
    }

    static function workOrderNo()
    {
        $workOrderNo=Service::select('*')
            ->where('work_orderno','!=',Null)->get();

        return $workOrderNo;
    }
    static function projects()
    {
        $projects=ProjectPlanMaster::select('*')->get();

        return $projects;
    }

    static function tasks()
    {
        $tasks=MasterTask::select('*')->get();

        return $tasks;
    }
    static function checkgatequestion()
    {
        $question=MasterCheckGateInspectionQuestion::select('*')->where('check_gate_id','=','1')->get();

        return $question;
    }
    static function checkgatequestiontwo()
    {
        $checktwoquestion=MasterCheckGateInspectionQuestion::select('*')->where('check_gate_id','=','2')->get();

        return $checktwoquestion;
    }
    static function checkgatequestionthree()
    {
        $checkthreequestion=MasterCheckGateInspectionQuestion::select('*')->where('check_gate_id','=','3')->get();

        return $checkthreequestion;
    }
    static function checkgatequestionfour()
    {
        $checkfourquestion=MasterCheckGateInspectionQuestion::select('*')->where('check_gate_id','=','4')->get();

        return $checkfourquestion;
    }

    static function checkgateonefollowby()
    {
        $checkgateonefollow=MasterCheckGateInspectionQuestion::select('*')->where('check_gate_id','=','5')->get();

        return $checkgateonefollow;
    }
    static function servicerequest()
    {
        $servicereq=Service::get();

        return $servicereq;
    }

    static function arrangementno()
    {
        $arrno=MasterComponentArrangementNo::get();

        return $arrno;
    }
    static function machinemodelno()
    {
        $mchmodel=MasterMCModel::get();

        return $mchmodel;
    }
    static function mastermachineserialno()
    {
        //$mchserial=MasterMachineSerialNo::get();
                     $mchserial=MasterMCSerialNumber::get();
        return $mchserial;
    }

    static function machineserialno($model_no)
    {
        $mchserial=MasterMCSerialNumber::where('mc_model_id','=',$model_no)->get();
        return $mchserial;
    }
    static function getmachineserialnoById($id)
    {
        $mchserial=MasterMCModel::find($id);
        return $mchserial;
    }
    static function getmodelnoById($id)
    {
        $mchmodel=MasterComponentDetails::find($id);
        return $mchmodel;
    }


    static function componentdetails($comserial)
    {
        $compdet=MasterComponentDetails::where('mc_model_id','=',$comserial)->get();
        /*$compdet=MasterComponentDetails::select('gw_master_comp_details.*')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_comp_details.mc_model_id')
            //->where('mc_model_id','=','gw_master_mc_model.id')
            ->get();
        //dd($mchserial);*/
        return $compdet;
    }

    static function componentserial($serialcomp)
    {
        $compse=MasterComponentDetails::where('mc_model_id','=',$serialcomp)->get();
        /*$compdet=MasterComponentDetails::select('gw_master_comp_details.*')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_comp_details.mc_model_id')
            //->where('mc_model_id','=','gw_master_mc_model.id')
            ->get();
        //dd($mchserial);*/
        return $compse;
    }



    static function ccinspexternalwash()
    {
        $exterwash=CcInspectionAfterExternalwashDis::get();

        return $exterwash;
    }
    static function commertciallogistic()
    {
        $commercial=MasterCommercialLogisticDetails::get();

        return $commercial;
    }
    static function ccpartclean()
    {
        $ccpartclean=CcInspectionAfterPartCleaningDis::get();

        return $ccpartclean;
    }

    static function partinspectioncylinderhead()
    {
        $cylinderhead=MasterPartinspectionCylinderHeadDetails::get();

        return $cylinderhead;
    }

     static function partothercompbasicengine($dept_id,$model_id)
    {
        $basicengine=MasterPartOthercomponentBasicEngine::where('dept_id','=',$dept_id)->where('model_id','=',$model_id)->get();

        return $basicengine;
    }
    static function partothercomplubrication()
    {
        $lubri=MasterPartOthercomponentLubricationSystem::get();

        return $lubri;
    }
    static function partothercompcooler()
    {
        $cooler=MasterPartOthercomponentCoolingSystem::get();

        return $cooler;
    }
    static function partothercompfuel()
    {
        $fuel=MasterPartOthercomponentFuelSystem::get();

        return $fuel;
    }
    static function partconnectingrod()
    {
        $conrod=MasterPartConnectingRodDetails::get();

        return $conrod;
    }
    static function partcylinderhead()
    {
        $cylinhed=MasterPartCylinderHeadDetails::get();

        return $cylinhed;
    }

    static function partcrankshaft()
    {

        $camshaft=MasterPartCrankshaftDetails::get();

        return $camshaft;
    }
    static function partcamshaftdetails()
    {
        $cmsftdetails=MasterPartCamshaftDetails::get();

        return $cmsftdetails;
    }
    //cylinder block top deck
    static function partcylinderTop()
    {
        $cylindertop=MasterPartCylinderBlockTopDeckDetails::get();

        return $cylindertop;
    }

//cylinder block top deck
    static function partcylinderThread()
    {
        $cylinderthred=MasterPartCylinderBlockThreadDetails::get();

        return $cylinderthred;
    }
//cylinder block cap clear
    static function partcylinderCapClear()
    {
        $cylindercapclr=MasterPartCylinderBlockCapNODetails::get();

        return $cylindercapclr;
    }


    static function partcamshaftbushbore()
    {
        $bushbore=MasterPartCamshaftBushboreDetails::get();

        return $bushbore;
    }
    static function roles()

    {
        $roles=Masterrole::get();

        return $roles;
    }
    static function menus()
    {
        $menus = Menu::get();


        return $menus;
    }

    static function menuaccess()
    {
        $menuaccess=Menuaccess::get();
        return $menuaccess;
    }
    static function checkmenu()
    {
        $checkmenu=Menu::select('*');
        return $checkmenu;
    }

    static function machinemodeltask()
    {
        $machinemodeltask=MasterTask::get();
        return $machinemodeltask;



    }


    static function section()
    {
        $section=MasterSection::get();
        return $section;
    }
    static function beforestartassembly()
    {
        $beforestart=InspectionBeforeStartAssembly::get();
        return $beforestart;
    }

     static function ComponentInspectionReport($dept_id,$model_id)
    {
        $cominspreport=ComponentInspectionReport::where('dept_id','=',$dept_id)->where('model_id','=',$model_id)->get();
        return $cominspreport;
    }

    static function designation()
    {
        $designation=MasterDesignation::get();
        return $designation;
    }

    static function jobrole()
    {
        $jobrole=Role::get();
        //dd($jobrole);exit;
        return $jobrole;
    }

    //url encode
    static function urlEncode($str)
    {
        $encrypted = Crypt::encryptString($str);
        return $encrypted;
    }
    //url decode
    static function urlDecode($str)
    {
        $decrypted = Crypt::decryptString($str);
        return $decrypted;
    }


    static function servicedepartment($id)
    {
        //$employee=MasterEmployee::find($id);
        $employee=User::find($id);

        return $employee;
    }

    static function designation1()
    {
        $masterdesignation=MasterDesignation::get();
        return $masterdesignation;

    }
    //transmission
    static function TransmissionComponent($dept_id,$model_id)
    {
        $transmiss=TransmissionComponentDetails::where('dept_id','=',$dept_id)->where('model_id','=',$model_id)
		->get();
        return $transmiss;
    }

    //rooler measured
    static function RoolerMeasued()
    {
        $roolermea=RoolerMeasuredDetails::get();
        return $roolermea;
    }



    static function authenticate()
    {
        //$login=session->user("logged_in");
        // $login=\Illuminate\Support\Facades\Session::get();
        // $value = session()->get('key');
        /*if (!function_exists('authenticate')) {

           function authenticate() {
               $CI = & get_instance();
               $empCode=$CI->session->userdata("logged_in");
               if(!$empCode['emp_code']){

                   echo "<script>window.parent.location.href='".base_url()."'</script>";
                   exit;
               }
           }
       }*/

    }

    static function dropdownpartnumber()
    {
        $partno=MasterComponentDetails::  get();
            //select('id','comp_serial_no')
            //->groupby('comp_serial_no')


        return $partno;
    }


    static function dropdownpartnumber_1()
    {
        $partno=MasterComponentDetails::get();

        return $partno;
    }


   static function mailnotification($to,$subj,$msg)
    {

        $url=url('/');
        $to = $to;
        $subj = $subj;

        //$msg = view('admin.mail.checkgateOneNotificationMail', ['url'=>$url])->render();
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From:' . \Config::get('env.service_mail')."\r\n";
        mail($to, $subj, $msg, $headers);

    }

    static function checkmenulisting()
    {
        $checkmenu=Menuaccess::select('*')->get();


        return $checkmenu;
    }

    //parts cooler inspection
    static function coolerinsp()
    {
        $cooler=MasterCoolerInspection::select('*')->get();

        return $cooler;
    }
    static function pdichecksheet()
    {
        $pdienginevisual=PdiChecksheetDetails::select('*')->get();

        return $pdienginevisual;
    }

    static function pdichecksheetengineassy()
    {
        $pdienginevisual=PdiChecksheetEngineAssy::select('*')->get();

        return $pdienginevisual;
    }

    static function pdichecksheettransmissionassy()
    {
        $pdienginevisual=PdiChecksheetTransmissionAssy::select('*')->get();

        return $pdienginevisual;
    }

    static function departmentforchecksheet()
    {
        $dept=MasterDepartment::get();


        return $dept;
    }
    static function sectionforchecksheet()
    {
        $sect=MasterCheckSheetSection::get();


        return $sect;
    }
    static function childsectionforchecksheet()
    {
        $ch_sect=ChecksheetChildSection::get();

        return $ch_sect;
    }
    static function subchildsectionforchecksheet()
    {
        $sub_ch_sect=ChecksheetSubChildSection::get();


        return $sub_ch_sect;
    }
    //fan drive
    static function partsfandrive()
    {
        $fandri=MasterPartFanDriveDetails::get();


        return $fandri;
    }
    //oil pump
    static function partsoilpump()
    {
        $oilpump=MasterPartOilPumpDetails::get();


        return $oilpump;
    }

    //Master Location
    static function location()
    {
        $location=MasterLocation::get();


        return $location;
    }

    //air compressor
    static function partaircompressor()
    {
        $aircompressor=MasterPartAirCompressorDetails::get();


        return $aircompressor;
    }
    //water pump
    static function partwaterpump()
    {
        $waterpump=MasterPartWaterPumpDetails::get();


        return $waterpump;
    }
    //Con Rod After Bush Replacement
    static function conrodbushreplacemnt()
    {
        $conrodbush=MasterConRodBushReplacementDetails::get();


        return $conrodbush;
    }


    static function childsectionchecksheet($child)
    {
        $childsection=ChecksheetChildSection::where('section_id','=',$child)->get();

        //dd($childsection);
        return $childsection;
    }
    static function subChildsectionchecksheet($subchild)
    {
        $subchildsection=ChecksheetSubChildSection::where('child_id','=',$subchild)->get();
        //echo '<pre>';print_r($subchildsection);exit;
        //dd($childsection);
        return $subchildsection;
    }
    
   static function subchildpopulate ()
    {
        // $subchildsecnew=ChecksheetSubChildSection::where(function($query) {
        //     $query->where('child_id','1')
        //         ->orWhere('child_id', '3')
        //         ->orWhere('child_id', '19')
        //         ->orWhere('child_id', '20');
        // })


        $subchildsecnew=ChecksheetSubChildSection::get();
        //echo '<pre>';print_r($subchilddemo);exit;
        //dd($childsection);
        return $subchildsecnew;
    }

    static function childpopulate ()
    {
        $subchildsecnew=ChecksheetChildSection::get();
        //echo '<pre>';print_r($subchilddemo);exit;
        //dd($childsection);
        return $subchildsecnew;
    }
	
	 static function columnpopulate ()
    {
        $subchildsecnew = ChecksheetColumn::get();
//        where(function ($query) {
//            $query->where('child_id', '1')
//                ->orWhere('child_id', '3')
//                ->orWhere('child_id', '19')
//                ->orWhere('child_id', '20');
//        })

        //echo '<pre>';print_r($subchilddemo);exit;
        //dd($childsection);
        return $subchildsecnew;
    }

    static function columnforchecksheet($chkshtcolumn)
    {
        //$colfrchksht=ChecksheetSectionWiseColumn::where('section_id','=',$chkshtcolumn)->get()->toArray();
		 $colfrchksht=ChecksheetColumnStore::where('section_id','=',$chkshtcolumn)->get()->toArray();

        /*$columnId = explode(',', $colfrchksht->section_id);

        $i=0;
        foreach($columnId as $columnIdArr){
            $section=ChecksheetColumn::find($columnIdArr);
            $column[$i]['column_id']=$section->id;
            $column[$i]['column_name']=$section->columns;

            $i++;
        }
        return $column;*/
        //$sectionId = explode(',', $colfrchksht->section_id);

       // $i=0;
        $j=0;
        //foreach($sectionId as $sectionIdArr){
            $section=ChecksheetColumnStore::find($colfrchksht);

           // echo '<pre>';print_r($section);exit;
            $columnId = explode(',', $section[0]['column_id']);

            if(isset($section)) {

                foreach ($columnId as $columnIdArr) {

                    $columnfind = ChecksheetColumn::find($columnIdArr);
                    $columnsection[$j]['column_id'] = $columnfind['id'];
                    $columnsection[$j]['column_name'] = $columnfind['columns'];
                    $j++;
                }
                //echo '<pre>';print_r($columnsection);exit;
            }
            //$i++;
       // }


        //echo "<pre>";print_r($section); exit;
        return $columnsection;



    }
    static function sectionname($secti){

        $sec=MasterCheckSheetSection::select('gw_master_checksheet_section.name as secname')
            ->leftjoin('model_wise_checksheet', 'model_wise_checksheet.section_id', '=', 'gw_master_checksheet_section.id')
//->where('model_wise_checksheet.section_id','=',$secti)
            ->get()->toArray();
        //dd($sec);
        return $sec;
    }
    static function deptName($dtname){
        $dept=MasterDepartment::select('gw_master_department.name as deptname')


            ->get();
        //dd($sec);
        return $dept;
    }
    static function dynamicchkshtdemo($dept_id,$model_id)
    {
        
         $compdet=[];
         //$sectionId=[];
        $dychdemo = ModelWiseCheecksheet::where('model_id','=',$model_id)
            ->where('dept_id','=',$dept_id)

            ->get()->first();
            
            
 //echo "$dychdemo->section_id";exit;
        //newline
        if(!empty($dychdemo)) {
            
            $sectionId = explode(',', $dychdemo->section_id);
            
      //echo '<pre>';print_r($sectionId);exit;
            $i = 0;
            foreach ($sectionId as $sectionIdArr) {
               
                
                $section = MasterCheckSheetSection::find($sectionIdArr);
                if(!empty($section)){
                $compdet[$i]['section_id'] = $section->id;
                $compdet[$i]['section_name'] = $section->name;
                // $compdet[$i]=$section->name;
                }
                 else{
                   
                     continue;
                 }
               
                 $i++;
            }
            
        }
        //echo '<pre>';print_r($compdet);die;
        return $compdet;
    }
    static function assemblychecksheet($dept_id,$model_id)
    { 
	$engineassembly=EngineAssembly::where('dept_id','=',$dept_id)
            ->where('model_id','=',$model_id)
            ->get();
        return $engineassembly;
    }
    static function dynamicchildsec($dept_id,$model_id)
    {


        $childsec=[];
        $dychild = ModelWiseCheecksheet::where('model_id','=',$model_id)
            ->where('dept_id','=',$dept_id)

            ->get()->first();
            
        if(!empty($dychild->child_id)){
            $sectionId = explode(',', $dychild->child_id);

            $i=0;
 
            foreach($sectionId as $sectionIdArr){
                
                $section=ChecksheetChildSection::find($sectionIdArr);
                
                 if(!empty($section)){
                     $childsec[$i]['child_id']=$section->id;
                 $childsec[$i]['child_section']=$section->child_section;
                
                 }
                 else{
                   
                     continue;
                 }
             //echo "<pre>";print_r($section); exit;
               
              
                $i++;
                  
            }
       
            
        }
        return $childsec;
    }
    static function subchilddynamicsec($dept_id,$model_id)
    {

        $subchildsec=[];
        $dychild = ModelWiseCheecksheet::where('model_id','=',$model_id)
             ->where('dept_id','=',$dept_id)

            ->get()->first();
        if(!empty($dychild->subsection_id)){
            $sectionId = explode(',', $dychild->subsection_id);

            $i=0;
            //echo '<pre>';print_r($sectionId);exit;
            foreach($sectionId as $sectionIdArr){
             
                $section=ChecksheetSubChildSection::find($sectionIdArr);
                if(!empty($section)){
                //echo "<pre>";print_r($section);exit;
                $subchildsec[$i]['subsection_id']=$section['id'];
                $subchildsec[$i]['subchild_section']=$section['sub_child_section'];
                // $compdet[$i]=$section->name;
             }
                 else{
                   
                     continue;
                 }
                
                $i++;
            }

        }
        return $subchildsec;
    }


    /* static function dynamiccolumns($dept_id,$model_id){

        $columnsection=[];


        $columndychk= ModelWiseCheecksheet::where('dept_id','=',$dept_id)
            ->where('model_id','=',$model_id)
            ->get()->first();

        $sectionId = explode(',', $columndychk->section_id);

        $i=0;
        foreach($sectionId as $sectionIdArr){
            $section=ChecksheetColumn::find($sectionIdArr);

            $columnsection[$i]['column_id']=$section->id;
           // $colum = explode(',', $section->columns);

            $columnsection[$i]['column_name']=$section->columns;
            //echo "<pre>";print_r($columnsection);exit;
            // $compdet[$i]=$section->name;
            $i++;
        }
        return $columnsection;
    }*/

    static function columndynamic($dept_id,$model_id,$section_id)
    {
        $columnsection=[];
       

        $columnId=[];
      //foreach($sectionId as $sectionIdArr){
            $section=ChecksheetSectionWiseColumn::where('section_id','=',$section_id)
			->where('dept_id','=',$dept_id)
               ->where('model_id','=',$model_id)
                ->get()->toArray();
         //echo "<pre>";print_r($section);
            if(!empty($section)){
                $j =0;

                $columnId = explode(',', $section[0]['column_id']);
                //echo "<pre>";print_r($columnId);



           if(!empty($columnId)) {
               //$columnsection=[];
               //$j=0;
                foreach ($columnId as $columnIdArr) {
                    //echo $j;
                   // echo "<pre>";print_r($columnIdArr);
                    $columnfind = ChecksheetColumn::find($columnIdArr);


                    $columnsection[$j]['column_id'] = $columnfind['id'];

                    $columnsection[$j]['column_name'] = $columnfind['columns'];

                    $j++;
                   //echo "<pre>"; print_r($columnsection);exit;
                }
//                exit;
                //echo "<pre>";print_r($columnsection);
            }

        }
            //$i++;
       // }
           // echo "<pre>";print_r($columnsection); exit;

//exit;
        //echo "<pre>";print_r($columnsection); exit;

        return $columnsection;
       //echo "<pre>";print_r($columnsection); exit;
   }


//for duplicate assemblychecksheet
static function columndynamic1($model_id,$section_id)
    {
        $columnsection=[];
       

        $columnId=[];
      //foreach($sectionId as $sectionIdArr){
            $section=ChecksheetColumnStore::where('section_id','=',$section_id)
			//->where('dept_id','=',$dept_id)
               ->where('model_id','=',$model_id)
                ->get()->toArray();
         //echo "<pre>";print_r($section);
            if(!empty($section)){
                $j =0;

                $columnId = explode(',', $section[0]['column_id']);
                //echo "<pre>";print_r($columnId);



           if(!empty($columnId)) {
               //$columnsection=[];
               //$j=0;
                foreach ($columnId as $columnIdArr) {
                    //echo $j;
                   // echo "<pre>";print_r($columnIdArr);
                    $columnfind = ChecksheetColumn::find($columnIdArr);


                    $columnsection[$j]['column_id'] = $columnfind['id'];

                    $columnsection[$j]['column_name'] = $columnfind['columns'];

                    $j++;
                   //echo "<pre>"; print_r($columnsection);exit;
                }
     // exit;
                //echo "<pre>";print_r($columnsection);
            }

        }
            //$i++;
       // }
           // echo "<pre>";print_r($columnsection); exit;

    //exit;
    //echo "<pre>";print_r($columnsection); exit;

        return $columnsection;
       //echo "<pre>";print_r($columnsection); exit;
   }


    // PROJECT PLAN

    // Get Department Name
    static function getDeptName($dept_id)
    {
        $dept_name = MasterDepartment::where('id','=',$dept_id)
            ->get()->toArray();
        return $dept_name;
    }

    // Get Department Wise Employee
    static function getDeptEmp($location)
    {
        //$emp_det = MasterEmployee::where('dept_id','=',$dept_id)
          $emp_det = User::select('users.emp_code','users.name')->where('location_id','=',$location)
            ->groupby('emp_code','name')->orderby('name')->get()->toArray();
        return $emp_det;
    }

    // Get Department Wise Employee
    static function getDeptEmpBySec($location,$section)
    {
        //$emp_det = MasterEmployee::where('dept_id','=',$dept_id)
          $emp_det = User::select('users.emp_code','users.name')->where('location_id','=',$location)->where('section_id','=',$section)
            ->groupby('emp_code','name')->orderby('name')->get()->toArray();
        return $emp_det;
    }

    //mail send
    static function getempcodeformail($emp_code)
    {
        //echo $emp_code;
        //$emp_det = MasterEmployee::where('dept_id','=',$dept_id)
        $emp_mail = User::select('*')->where('emp_code','=',$emp_code)
            ->get()->toArray();
        return $emp_mail;
    }
    
    // Get Department Wise Tasks
    static function getDeptTask($dept_id,$model_id)
    {
        $task_det = MasterTask::where('dept_id','=',$dept_id)->where('model_no','=',$model_id)
            ->get()->toArray();
        return $task_det;
    }

    static function getTaskName($task_id)
    {
        $task_name = MasterTask::select('*')->where('id','=',$task_id)
            ->get()->toArray();
        return $task_name;
    }

    // Get Employee Details

    static function checkParentTask($id,$dept_id,$model_id){

        $child_task=MasterTask::where('parent','=',$id)->where('dept_id','=',$dept_id)->where('model_no','=',$model_id)
            ->get()->toArray();
        return $child_task;
    }

    // Task User Details
    static function taskUserDet($id,$prj_id){
        $task_det=TaskUser::where('task','=',$id)
            ->where('prj_id','=',$prj_id)
            ->get()->toArray();
        // echo "<pre>";print_r($task_det);exit;
        return $task_det;
    }
    // Task User Details
    static function empDetails($codes){
        $c=0;
        $emp_det=[];
        if(!empty($codes)){
            $codess = explode(',', $codes);
            foreach ($codess as $key => $code) {
                //$emp_det[$c]=MasterEmployee::where('emp_code','=',$code)
                 $emp_det[$c]=User::where('emp_code','=',$code)
                    ->get()->toArray()[0];
                $c++;
            }
            return $emp_det;
        }

    }
    
     static function countService(){
        $serviceCount=Service::all()->toArray();
        return $serviceCount;
    }
    
    static function totalservicecount(){
        $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
        $serCount=Service::select('service_request.id')
            ->where('service_request.location_id','=',$location)
            ->get()->count();
        return $serCount;
    }
     static function totalquotationcount(){
         $data = Session::all();
         //echo '<pre>';print_r($data);exit;
         $location=$data['user']['location_id'];
        $serquotation=Service::select('service_request.id')
            ->where('service_request.location_id','=',$location)
            ->where('service_request.quotation','!=','NULL')->get()->count();
        return $serquotation;
    }
    static function ongoingservice(){
        $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
        $onservice=Service::select('service_request.id')
            ->where('service_request.location_id','=',$location)
            ->where('service_request.status','!=','Closed')->get()->count();
        return $onservice;
    }

   static function totalcg1count(){
       $data = Session::all();
       //echo '<pre>';print_r($data);exit;
       $location=$data['user']['location_id'];
        $cg1=Service::select('service_request.id')
            ->where('service_request.location_id','=',$location)
            ->where('service_request.checkgate1','!=','NULL')->get()->count();
        return $cg1;
    
    }
    static function leftcg1count(){
        $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
        $leftcg1=Service::select('service_request.id')
            ->where('service_request.location_id','=',$location)
            ->where('service_request.checkgate1','=','NULL')->get()->count();
        return $leftcg1;
    
    }

        static function countworkorder(){
            $data = Session::all();
            //echo '<pre>';print_r($data);exit;
            $location=$data['user']['location_id'];
                $woCount=Service::select('service_request.id')
                    ->where('service_request.location_id','=',$location)
                    ->where('service_request.work_orderno','!=',NULL)->get()->count();
                return $woCount;
            }

            //section count
     static function sectioncount($dept_id,$model_id){

        $countsec=0;
        $chilscount =0;
        $countsubchild =0;
        $total =0;
        $mainsection=ModelWiseCheecksheet::where('dept_id','=',$dept_id)
            ->where('model_id','=',$model_id)
            ->get()->toArray();
        //echo '<pre>';print_r($mainsection);exit;
        if (!empty($mainsection)) {
            if (!empty($mainsection[0]['child_id'])) {

                $sectionId = explode(',', $mainsection[0]['section_id']);

                //echo '<pre>';print_r($sectionId);exit;
                $i = 0;
                foreach ($sectionId as $sectionIdArr) {
                    $section = ModelWiseCheecksheet::find($sectionIdArr);

                    $i++;
                }
                $countsec = $i - 1;
            } else {

                $sectionId = explode(',', $mainsection[0]['section_id']);

                //echo '<pre>';print_r($sectionId);exit;
                $i = 0;
                foreach ($sectionId as $sectionIdArr) {
                    $section = ModelWiseCheecksheet::find($sectionIdArr);

                    $i++;
                }
                $countsec = $i;

            }

            //subchild section
            $l = 0;
            if (!empty($mainsection[0]['subsection_id'])) {
                $subchildId = explode(',', $mainsection[0]['subsection_id']);
                foreach ($subchildId as $subchildIdArr) {
                    $subchild = ModelWiseCheecksheet::find($subchildIdArr);
                    $l++;
                }
                $countsubchild = $l;
            } else {
                $countsubchild = 0;
            }


            //child section
            $m = 0;
            $child1 = 0;
            $child2 = 0;
            $child3 = 0;
            $child4 = 0;
            $child5 = 0;
			$child6 = 0;
            $child7 = 0;
            $child8 = 0;
            $child9 = 0;
            $child10 = 0;
            $totalchild = 0;

            if (!empty($subchildId)) {
                $findchild = ChecksheetSubChildSection::find($subchildId);
                //echo '<pre>';print_r($findchild);exit;
                foreach ($findchild as $findchildArr) {
                    if ($findchildArr['child_id'] == 1) {

                        $child1 = 1;

                    }
                    if ($findchildArr['child_id'] == 3) {
                        $child2 = 1;
                    }

                    if ($findchildArr['child_id'] == 19) {
                        $child4 = 1;
                    }
                    if ($findchildArr['child_id'] == 20) {
                        $child5 = 1;
                    }
					if ($findchildArr['child_id'] == 21) {
                        $child6 = 1;
                    }
                    if ($findchildArr['child_id'] == 22) {
                        $child7 = 1;
                    }
                    if ($findchildArr['child_id'] == 23) {
                        $child8 = 1;
                    }
                    if ($findchildArr['child_id'] == 24) {
                        $child9 = 1;
                    }
                    if ($findchildArr['child_id'] == 25) {
                        $child10 = 1;
                    }
                    else {
                        $child3 = 0;

                    }
                    $m++;
                    $totalchild = $child1 + $child2 + $child3 + $child4 + $child5 + $child6 + $child7 + $child8 + $child9 + $child10;
                }
            }


            //echo '<pre>';print_r($totalchild);exit;
//         foreach($findchild as $findchildArr){
//
//             $child=$findchildArr[0]['child_id'];
//             $m++;
//         }


            $j = 0;
			 if (!empty($mainsection[0]['child_id'])) {
            if (!empty($mainsection[0]['subsection_id'])) {
                //$k = 1;
                $childId = explode(',', $mainsection[0]['child_id']);
                foreach ($childId as $childIdArr) {
                    $child = ModelWiseCheecksheet::find($childIdArr);

//                if(!empty($child)){
//                    $k++;
//                }
//                else{
//                    $j++;
//                }
                    $j++;

                }
                $chilscount = $j - $totalchild;
                // echo '<pre>';print_r($chilscount);exit;

            } else {

                $childId = explode(',', $mainsection[0]['child_id']);

                //echo '<pre>';print_r($sectionId);exit;
                $p = 0;
                foreach ($childId as $childIdArr) {
                    $section = ModelWiseCheecksheet::find($childIdArr);

                    $p++;
                }
                $chilscount = $p;

            }
			 }else{
				  $chilscount = 0;
			 }
//echo '<pre>';print_r($chilscount);exit;

            $total = $countsec + $chilscount + $countsubchild - 1;
            //$total = $countsec + $chilscount + $countsubchild;
            //$totalcount=$countsec+$countchild+$countsubchild;

             //echo '<pre>';print_r($countsec);exit;

        }
		
		
        return $total;

        //$var1 = Model::select(count (*))->where


    }

    //table count
    static function tablecount($dept_id,$service_id){

        $var1 = MasterAggregate::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();

         
            
        $var3 = MasterCommercialValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var4 = MasterLoosepartDis::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var5 = MasterCcinspectionExternalWashDetails::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var6 = MasterCCinspectionBeforeStartAssembly::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var7 = ComponentInspReport::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
          
        $var8 = StatusRevision::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var9 = MasterDissamblyCleaningInspection::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();

        $var10 = MasterCcinspectionPartCleanDetails::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var11 = MasterMissingdamagePartDis::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
            
        $var12 = MasterPartCylinderHeadValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var13 = MasterPartCrankshaftValue::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var14 = MasterPartCamshaftValue::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var15 = MasterPartConnectingRodValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var16 = MasterPartFanDriveValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var17 = MasterPartOilPumpValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var18 = MasterPartWaterPumpValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var19 = MasterPartsInspectionCylinderHeadValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var20 = MasterPartOthercomponentValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var21 = MasterListofSalvageDis::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var22 = MasterFailedParts::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var23 = MasterConRodBushReplacementValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var24 = TransmissionComponent::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var25 = PartCylinderBlockLinearValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var26 = PartCylinderBlockCamboreValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var27 = PartCylinderBlockTopDeckValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var28 = PartCylinderBlockThreadValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var29 = PartCylinderBlockBushboreValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var30 = PartCylinderBlockCapNoValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var31 = PartLhCamshaftValue::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var32 = PartRhCamshaftValue::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var33 = PartCamshaftBushboreValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var34 = MasterPartAirCompressorValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var35 = CoolerInspectionValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var36 = ClutchPackThicknessValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
           
        $var37 = ClutchPlateThicknessValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
            
        $var38 = ClutchPlateFlatnessValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
             
        $var39 = TorqueConverterValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var40 = RoolerSpecificationValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var41 = RoolerMeasuredValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var42 = RoolerSpecifiEndColValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var43 = RollerspcClearShaftValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var44 = IdlerSpecificationValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var45 = IdlerMeasuredBeforeValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var46 = IdlerMeasuredAfterValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var47 = IdlerSpeciEndcolerValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var48 = IdlerspcClearShaftValues::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
            $var49 = CheckgateOneFollowedUp::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
			$var50 = PartTrackLinkHeight::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var51 = PartTrackPitch::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var52 = PartTrackLinkPin::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var53 = PartTrackLinkBush::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var54 = PartTrackShoe::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var55 = PartPinInspMea::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();
        $var56 = PartBushInspMea::select('id')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->groupby('id')->count();




           //delete var2 bcz prehistory no data
  $totaltable = $var1+$var3+$var4+$var5+$var6+$var7+$var8+$var9+$var10+$var11+$var12+$var13+$var14+$var15+$var16+$var17+$var18+$var19+$var20+$var21+$var22+$var23+$var24+$var25+$var26+$var27+$var28+$var29+$var30+$var31+$var32+$var33+$var34+$var35+$var36+$var37+$var38+$var39+$var40+$var41+$var42+$var43+$var44+$var45+$var46+$var47+$var48+$var49+$var50+$var51+$var52+$var53+$var54+$var55+$var56;



        // echo '<pre>';print_r($var49);
        // print_r($var1);
        //  print_r($var8);
        //   print_r($var4);
        //   print_r($var5);
        //     print_r($var9);
        //      print_r($var11);
        //       print_r($var21);
        //       print_r($var6);
        //       print_r($var20);
        //         print_r($var36);
        //          print_r($var37);
        //           print_r($var38);
        //           print_r('rimpi');
        //           print_r($var3);
        //             print_r($var7);
        //              print_r($var10);
        //               print_r($var12);
        //               print_r($var13);
        //                 print_r($var14);
        //                  print_r($var15);
        //                   print_r($var16);
        //                   print_r($var17);
        //                     print_r($var18);
        //                      print_r($var19);
        //                       print_r($var22);
        //                       print_r($var23);
        //                         print_r($var24);
        //                          print_r($var25);
        //                           print_r($var26);
        //                           print_r($var27);
        //                             print_r($var28);
        //                              print_r($var29);
        //                               print_r($var30);
        //                               print_r($var31);
        //                                 print_r($var32);
        //                                  print_r($var33);
        //                                   print_r($var34);
        //                                   print_r($var35);
        //                                     print_r($var39);
        //                                      print_r($var40);
        //                                       print_r($var41);
        //                                       print_r($var42);
        //                                         print_r($var43);
        //                                          print_r($var44);
        //                                           print_r($var45);
        //                                           print_r($var46);
        //                                             print_r($var47);
        //                                              print_r($var48);
        
        // print_r($totaltable);
        // exit;



        return $totaltable;
    }

    //table assy count

    static function tableassycount($dept_id,$service_id){
        $var1 = ChecksheetAssembly::select('*')->where('service_request_id','=',$service_id)
            ->where('dept_id','=',$dept_id)->count();
        $totalassytable = $var1;

        return $totalassytable;
    }


    static function sectionassycount($dept_id,$model_id)
    {

        $countsec = 0;
        $chilscount = 0;
        $countsubchild = 0;
        $mainsection = ModelWiseCheecksheet::where('dept_id', '=', $dept_id)
            ->where('model_id', '=', $model_id)
            ->get()->toArray();
        //echo '<pre>';print_r($mainsection[0]['section_id']);exit;
        
        if(!empty($mainsection)) {
        if (!empty($mainsection[0]['child_id'])) {

            $sectionId = explode(',', $mainsection[0]['section_id']);

            //echo '<pre>';print_r($sectionId);exit;
            $i = 0;
            foreach ($sectionId as $sectionIdArr) {
                $section = ModelWiseCheecksheet::find($sectionIdArr);

                $i++;
            }
            $countsec = $i-1 ;
        }
        if (empty($mainsection[0]['child_id'])) {

            $sectionId = explode(',', $mainsection[0]['section_id']);

            //echo '<pre>';print_r($sectionId);exit;
            $i = 0;
            foreach ($sectionId as $sectionIdArr) {
                $section = ModelWiseCheecksheet::find($sectionIdArr);

                $i++;
            }
            $countsec = $i ;
        }

}
        return $countsec;
    }
    
    
    
     //std data description
    static function stddatashow($dept_id,$model_id){


        $stddata=PartsInspectionStdData::get()->toArray();

        $value=[];
        if(!empty($stddata['part_no'])){

            $value=PartsInspectionStdData::where('dept_id','=',$dept_id)
                ->where('model_id','=',$model_id)
                //->where('part_no','=',$part_no)
            ->get()->toArray();

        }
        else{
            $value=PartsInspectionStdData::where('dept_id','=',$dept_id)
                ->where('model_id','=',$model_id)
                ->get()->toArray();
        }


        //echo '<pre>';print_r($value);exit;

        return $value;
    }
    static function stddatavalidation($dept_id,$model_id){

        $stddataactual=PartsInspectionStdData::get()->toArray();

        $actualvalue=[];
        if(!empty($stddataactual['part_no'])){

            $actualvalue=PartsInspectionStdData::where('dept_id','=',$dept_id)
                ->where('model_id','=',$model_id)
                //->where('part_no','=',$part_no)
                ->get()->toArray();

        }
        else{
            $actualvalue=PartsInspectionStdData::where('dept_id','=',$dept_id)
                ->where('model_id','=',$model_id)
                ->get()->toArray();
        }


        //echo '<pre>';print_r($actualvalue);exit;



        return $actualvalue;



    }
    
    
      //mail for assign department from mor section
    static function assigndept($dept)
    {
       
       
        $emp_mail = User::select('*')->where('section_id','=',$dept)
            ->get()->toArray();
        return $emp_mail;
    }
    
    //task table update

    static function tasktableupdateactualdate($dept_id,$model_id,$serviceid,$section_id,$actual_start_date,$actual_end_date)
    {
        $projid=ProjectPlanMaster::select('project_id')->where('service_id','=',$serviceid)->get()->toArray();

        $sec=MasterTask::select('task_id')->where('model_no','=',$model_id)->where('dept_id','=',$dept_id)->where('section_id','=',$section_id)->get()->toArray();


             if(!empty($projid) && !empty($sec)) {

                 $taskuser=TaskUser::select('*')->where('project_id', '=', $projid[0]['project_id'])->where('task', '=', $sec[0]['task_id'])->get()->toArray();
                 if(empty($taskuser[0]['actual_strt_dt'])) {
                     $acdat = DB::table('gw_task_users')->where('project_id', '=', $projid[0]['project_id'])->where('task', '=', $sec[0]['task_id'])->update(array('actual_strt_dt' => $actual_start_date, 'end_dt' => $actual_end_date));
                 }
                 $acdat = DB::table('gw_task_users')->where('project_id', '=', $projid[0]['project_id'])->where('task', '=', $sec[0]['task_id'])->update(array( 'end_dt' => $actual_end_date));

             }


    }

 //update for different department
    static function tasktableupdatesubdptactualdate($dept_id,$model_id,$serviceid,$section_id,$actual_start_date,$actual_end_date)
    {
        $projid=ProjectPlanMaster::select('project_id')->where('service_id','=',$serviceid)->get()->toArray();

        $sec=MasterTask::select('task_id')->where('model_no','=',$model_id)->where('subdept_id','=',$dept_id)->where('section_id','=',$section_id)->get()->toArray();

 //echo '<pre>';print_r($sec);exit;

        if(!empty($projid) && !empty($sec)) {
           foreach($sec as $key=> $val) {

        $taskuser = TaskUser::select('*')->where('project_id', '=', $projid[0]['project_id'])->where('task', '=', $val)->get()->toArray();
        //dd($taskuser);
        if (empty($taskuser[0]['actual_strt_dt'])) {
            $acdat = DB::table('gw_task_users')->where('project_id', '=', $projid[0]['project_id'])->where('task', '=', $val)->update(array('actual_strt_dt' => $actual_start_date, 'end_dt' => $actual_end_date));
        }
        $acdat = DB::table('gw_task_users')->where('project_id', '=', $projid[0]['project_id'])->where('task', '=', $val)->update(array('end_dt' => $actual_end_date));
             }
        }


    }



    static function partsinspupdatetasktable($dept_id,$model_id,$serviceid,$section_id,$suborchildif,$actual_start_date,$actual_end_date)
    {
        $projid=ProjectPlanMaster::select('project_id')->where('service_id','=',$serviceid)->get()->toArray();

        $sec=MasterTask::select('task_id')->where('model_no','=',$model_id)->where('dept_id','=',$dept_id)->where('section_id','=',$section_id)->get()->toArray();

        $taskuser=TaskUser::select('*')->where('project_id', '=', $projid[0]['project_id'])->where('task', '=', $sec[0]['task_id'])->get()->toArray();
        // echo'<pre>';print_r($taskuser[0]['actual_strt_dt']);exit;
        if($section_id=='8'){
            $sectionactu=ModelWiseCheecksheet::select('*')->where('model_id','=',$model_id)->where('dept_id','=',$dept_id)->get()->toArray();

            if(!empty($sectionactu[0]['subsection_id'])){
                $subchild=explode(',',$sectionactu[0]['subsection_id']);
                $sortsubmin=sort($subchild);
                $sortsubmax=max($subchild);
                //$sortsubmax=sort($max);

            }
            else{
                //$subchild=explode(',',$sectionactu[0]['child_id']);
                $subchild=explode(',',$sectionactu[0]['child_id']);
                $sortsubmin=sort($subchild);
                $sortsubmax=max($subchild);
            }
            $subchild=explode(',',$sectionactu[0]['child_id']);
            //$sortsubmin=sort($subchild);
            $sortsubmax=max($subchild);

            if(!empty($projid) && !empty($sec)) {

                if(empty($taskuser[0]['actual_strt_dt'])) {
                    if ($sortsubmin == $suborchildif) {
                        $acdat = DB::table('gw_task_users')->where('project_id', '=', $projid[0]['project_id'])->where('task', '=', $sec[0]['task_id'])->update(array('actual_strt_dt' => $actual_start_date));
                    }
                }

                    if ($sortsubmax == $suborchildif) {
                        $acdate = DB::table('gw_task_users')->where('project_id', '=', $projid[0]['project_id'])->where('task', '=', $sec[0]['task_id'])->update(array('end_dt' => $actual_end_date));
                    }


            }
        }

    }

    //store status
    static function storeStatus()
    {
        $store=StoreStatus::where('status','=','Active')->get();


        return $store;
    }
    
//tat report
    static function locationfind($id)
    {
        $loc_name=MasterLocation::select('description')->where('id','=',$id)->get()->toarray();


        return $loc_name;
    }




    static function sectionfind($id)
    {
        $section = MasterDepartment::select('name')->where('id','=',$id)->get()->toarray();


        return $section;
    }


    static function countcomponentReceived($service_id)
    {
        $section = MasterMissingdamagePartDis::select('part_no')->where('service_request_id','=',$service_id)->count();
        return $section;
    }

    static function countcomponentDespatch($service_id)
    {
        $section = MasterMissingdamagePartDis::select('gw_master_disa_missing_damaged_part.part_no')
            ->leftjoin('service_request','service_request.id', '=', 'gw_master_disa_missing_damaged_part.service_request_id')
            ->where('service_request_id','=',$service_id)
            ->where('service_request.status','=','Closed')
            ->count();

        return $section;
    }
    static function created_datefind($service_id)
    {
        $section = MasterMissingdamagePartDis::select('created_at')->where('service_request_id','=',$service_id)->get()->toArray();
        return $section;
    }
static function predicessorfind($task_id,$dept_id,$project_id)
    {
        $task_det = TaskUser::where('task','=',$task_id)
            ->where('dept_id','=',$dept_id)
            ->where('project_id','=',$project_id)
            ->get()->toArray();
        return $task_det;
    }
	
	//high deviation in project plan

    static function highdevi(){
        $task_det = TaskUser::get()->toArray();

        //$task_det1 = TaskUser::where('end_dt','!=',NULL)->where('est_end_date','!=',NULL)->where('end_dt','!=','est_end_date')->get()->count();
        $finddate='';
        $finddate1='';
        $count=0;

        foreach($task_det as $key => $val){
            if(!empty($val['est_end_date']) && !empty($val['end_dt'])){
                if ($val['end_dt'] > $val['est_end_date']){

                    $array[] =$val['end_dt'];
                    $count = count($array);

                }
            }


        }




        return $count;
    }
	
	static function totaldevi(){
        //$task_det = TaskUser::get()->toArray();

       $task_det = TaskUser::where('est_end_date','!=',NULL)->get()->count();

        return $task_det;
    }


     //admin status update
    static function adminstatus($service_id,$status)
    {
        $project = ProjectPlanMaster::where('service_id','=',$service_id)

            ->get()->toArray();
        if(!empty($project)){


            $change_estend_date = DB::table('gw_project_plan_master')->where('service_id','=',$service_id)->update(array('status' => $status));
        }


        return $project;
    }
	
	 // predecessor find or task

    static function predecessorfind($dept_id,$model_id){

        $task_det = MasterTask::where('dept_id','=',$dept_id)->where('model_no','=',$model_id)
            ->where(function($query) {
                $query->where('parent', NULL)
                     ->orWhere('parent', ' ')
                     ->orWhere('parent', 'NULL');
            })

            ->get()->toArray();

        return $task_det;
    }



    //taskname add
    static function taskname(){

        $task_det = MasterTaskName::where('parent_task','=','1')->get()->toArray();
        return $task_det;
    }

    //sub taskname add
    static function subtaskname(){

        $task_det = MasterTaskName::where('parent_task','=',Null)->get()->toArray();
        return $task_det;
    }


    static function prediorparentname($id){

        $task_det = MasterTask::where('id','=',$id)->get()->toArray();

        return $task_det;
    }
	
	 static function sectionforcolumn()
    {
        $dept=MasterCheckSheetSection::where(function($query) {
            $query->where('id','7')
                ->orWhere('id', '8')
                ->orWhere('id', '9');
        })

            ->get();


        return $dept;
    }
	
	 static function viewstdData()
    {
        $std=MasterStdData::get();


        return $std;
    }
    static function viewstdDataName()
    {
        $stdname=MasterStdData::where('name','!=',Null)->get();


        return $stdname;
    }
	//code optimize customer
    static function codeOptimizeCustomer($customer)
    {
        $compse=MasterCustomer::where('name','LIKE', "" . $customer . "%")->get();

        /*$compdet=MasterComponentDetails::select('gw_master_comp_details.*')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_comp_details.mc_model_id')
            //->where('mc_model_id','=','gw_master_mc_model.id')
            ->get();
        dd($mchserial);*/

        return $compse;
    }
    //code optimize machine model
    static function codeOptimizeMachmodel($customer)
    {
        $compse=MasterMCModel::where('model_no','LIKE', "%" . $customer . "%")->get();

        /*$compdet=MasterComponentDetails::select('gw_master_comp_details.*')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_comp_details.mc_model_id')
            //->where('mc_model_id','=','gw_master_mc_model.id')
            ->get();
        dd($mchserial);*/

        return $compse;
    }

    //code optimize machine serial
    static function codeOptimizeMachserial($customer)
    {
        $compse=MasterMCSerialNumber::where('serial_no','LIKE', "%" . $customer . "%")->get();

        /*$compdet=MasterComponentDetails::select('gw_master_comp_details.*')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_comp_details.mc_model_id')
            //->where('mc_model_id','=','gw_master_mc_model.id')
            ->get();
        dd($mchserial);*/

        return $compse;
    }

    //code optimize component model
    static function codeOptimizeCompmodel($customer)
    {
        $compse=MasterComponentDetails::where('comp_model_no','LIKE', "%" . $customer . "%")->get();

        /*$compdet=MasterComponentDetails::select('gw_master_comp_details.*')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_comp_details.mc_model_id')
            //->where('mc_model_id','=','gw_master_mc_model.id')
            ->get();
        dd($mchserial);*/

        return $compse;
    }

    //code optimize component serial
    static function codeOptimizeCompserial($customer)
    {
        $compse=MasterComponentDetails::where('comp_serial_no','LIKE', "%" . $customer . "%")->get();

        /*$compdet=MasterComponentDetails::select('gw_master_comp_details.*')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_comp_details.mc_model_id')
            //->where('mc_model_id','=','gw_master_mc_model.id')
            ->get();
        dd($mchserial);*/

        return $compse;
    }

}



