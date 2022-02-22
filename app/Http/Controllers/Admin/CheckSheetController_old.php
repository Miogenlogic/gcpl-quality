<?php

namespace App\Http\Controllers\admin;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckGateQuestionEditRequest;
use App\Http\Requests\CheckGateQuestionRequest;

use App\Http\Requests\DisassmblyAggregateRequest;
use App\Models\ChecksheetStatus;
use App\Models\CheckgateOneFollowedUp;
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
use App\Models\MasterCoolerInspection;
use App\Models\MasterDissamblyCleaningInspection;
use App\Models\MasterAggregate;
use App\Models\MasterCcinspectionExternalWashDetails;
use App\Models\MasterCcinspectionPartCleanDetails;
use App\Models\MasterCheckGate;
use App\Models\MasterCheckGateInspectionQuestion;
use App\Models\MasterCommercialValues;
use App\Models\MasterComponentDetails;
use App\Models\CheckgateStatus;
use App\Models\MasterFailedParts;
use App\Models\MasterListofSalvageDis;
use App\Models\MasterLoosepartDis;
use App\Models\MasterMCModel;
use App\Models\MasterMCSerialNumber;
use App\Models\MasterMissingdamagePartDis;
use App\Models\MasterPartAirCompressorValues;
use App\Models\MasterPartCamshaftValue;
use App\Models\MasterPartConnectingRodValues;
use App\Models\MasterPartCrankshaftValue;
use App\Models\MasterPartCylinderHeadValues;
use App\Models\MasterPartFanDriveValues;
use App\Models\MasterPartinspectionCylinderHeadDetails;
use App\Models\MasterPartOilPumpValues;
use App\Models\MasterPartOthercomponentValues;
use App\Models\MasterPartsInspectionCylinderHeadValues;
use App\Models\MasterPartWaterPumpValues;
use App\Models\MasterPreHistoryDis;
use App\Models\PartCamshaftBushboreValues;
use App\Models\PartCylinderBlockBushboreValues;
use App\Models\PartCylinderBlockCamboreValues;
use App\Models\PartCylinderBlockCapNoValues;
use App\Models\PartCylinderBlockLinearValues;
use App\Models\PartCylinderBlockThreadValues;
use App\Models\PartCylinderBlockTopDeckValues;
use App\Models\PartLhCamshaftValue;
use App\Models\PartRhCamshaftValue;
use App\Models\PartPinInspMea;
use App\Models\PartBushInspMea;
use App\Models\PartTrackLinkBush;
use App\Models\PartTrackLinkHeight;
use App\Models\PartTrackLinkPin;
use App\Models\PartTrackPitch;
use App\Models\PartTrackShoe;
use App\Models\RollerspcClearShaftValues;
use App\Models\RoolerMeasuredValues;
use App\Models\RoolerSpecificationValues;
use App\Models\RoolerSpecifiEndColValues;
use App\Models\Service;
use App\Models\User;
use App\Models\ProjectPlanMaster;
use App\Models\ProjectTask;
use App\Models\ProjectUser;
use App\Models\TaskUser;
use App\Models\MasterCCinspectionBeforeStartAssembly;
use App\Models\StatusRevision;
use App\Models\ChecksheetAssembly;
use App\Models\TorqueConverterValues;
use App\Models\TransmissionComponent;
use App\Models\SubworkorderStore;
use Illuminate\Http\Request;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Rap2hpoutre\FastExcel\FastExcel;
use Box\Spout\Writer\Style\StyleBuilder;


use PHPExcel;
use PHPExcel_IOFactory;

use Carbon\Carbon;
use DB;
use Hash;
use File;
use Auth;
use Mail;
use DataTables;
use Session;
use Redirect;
use Alert;
use Input;
use Illuminate\Support\Facades\Crypt;
use App\Providers\HelperServiceProvider;
class CheckSheetController extends Controller
{
//engine

    public function engineDissList()
    {


        return view('admin.checksheet.disassembly.engineDissList');
    }

    public function engineDissgetTable(Request $request)
    {

    $data = Session::all();
    $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
         $emp_code=$data['user']['emp_code'];
    
        if (request()->session()->get('user')['section_id'] == '4') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('service_request.*','checksheet_status.disassembly_status')
                 ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=',$dept_id)
                    ->where('service_request.location_id','=',$location)
                   //->where('service_request.chkonedept','=',$dept_id)
                   ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                       ->where(function($query) {
                           $query->where('disassembly_status', 'Submitted')
                        ->orWhere('disassembly_status', 'Approved');
                    })
                    ->orderby('service_request.created_at','DESC')->get();

                   

                    
             }
             else{
                 $table = Service::select('service_request.*','checksheet_status.disassembly_status')
                  ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=',$dept_id)
                     ->where('service_request.location_id','=',$location)
                     ->where('service_request.cg1_status','=','Approved')
                    ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                     ->where('checksheet_status.disassembly_status','!=','Approved')
                      ->whereRaw("FIND_IN_SET({$emp_code},users)")
                     ->orderby('service_request.created_at','DESC')->get();
             }
        }
        else{
            $table = Service::select('*')
                //->where('service_request.location_id','=',$location)
                ->orderby('created_at','DESC')->get();
        }

        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {
                /*if(isset($table->checkgate1) && strlen($table->checkgate1) > 1 && $table->work_done==0){
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Dissassembly Checksheet</a>
                                             <!--<a class="dropdown-item" href="'.url('admin/check-gate-form-one-listing')."/"."$table->id".'">Check Gate 1</a>
                                             <a class="dropdown-item" href="' . url('admin/check-sheet-assembly-common')."/". "$table->id". '">Assembly Checksheet</a>-->
                                             </div>
                                        </div>';
                }
                elseif(isset($table->work_done) && $table->work_done==1){
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <!--<a class="dropdown-item" href="'.url('admin/check-gate-form-one-listing')."/"."$table->id".'">Check Gate 1</a>-->
                                            
                                             <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Dissassembly Checksheet</a>
                                            
                                            
                                                <!--a class="dropdown-item" href="' . url('admin/check-gate-form-two-add')."/"."$table->id". '">Check Gate 2</a>
                                            <a class="dropdown-item" href="' . url('admin/check-sheet-assembly-common')."/". "$table->id". '">Assembly Checksheet</a>-->
                                                
                                            </div>
                                        </div>';
                }else {
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                            
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-one-add')."/"."$table->id". '">Check Gate 1</a>
                                          
                                                
                                               
                                                
                                            </div>
                                        </div>';
                }*/
                if (request()->session()->get('user')['section_id'] == '4') {

                    if (request()->session()->get('user')['role_id'] == '2'){

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Approve/Reject</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                    else{
                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                }

                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function engineAssList()
    {


        return view('admin.checksheet.disassembly.engineAssList');
    }

    public function engineAssgetTable(Request $request)
    {
        $data = Session::all();
       $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
         $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['section_id'] == '10') {

            if (request()->session()->get('user')['role_id'] == '2'){
                 $table = Service::select('service_request.*','checksheet_status.assembly_status')
                 ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=','4')
                    ->where('service_request.location_id','=',$location)
                  
                   ->whereRaw("FIND_IN_SET('4',chkonedept)")
                       ->where(function($query) {
                           $query->where('assembly_status', 'Submitted')
                        ->orWhere('assembly_status', 'Approved');
                    })
                    ->orderby('service_request.created_at','DESC')->get();

                
               
                    //->where('service_request.asc_status','=','Submitted')
                    
                    //->orderby('created_at','DESC')->get();

            }
            else{
                
                 $table = Service::select('service_request.*','checksheet_status.assembly_status')
                  ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=','4')
                     ->where('service_request.location_id','=',$location)
                    ->where('service_request.cg2_status','=','Approved')
                     ->where('service_request.store_status','=','Material Issued')
                    ->whereRaw("FIND_IN_SET('4',chkonedept)")
                     ->where('checksheet_status.assembly_status','!=','Approved')
                      ->whereRaw("FIND_IN_SET({$emp_code},users)")
                     ->orderby('service_request.created_at','DESC')->get();
                
                
            }
        }
        else{
                $table = Service::select('*')->whereNotNull('checkgate2')->orderby('created_at','DESC')->get();
            }
//dd($table);exit;
        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {

                if (request()->session()->get('user')['section_id'] == '10') {

                    if (request()->session()->get('user')['role_id'] == '2'){

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-assembly-common')."/". "$table->id". '">Approve/Reject</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                    else{
                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-assembly-common')."/". "$table->id". '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                }
                
                return $btns;

            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }



//trans
    public function transDissList()
    {


        return view('admin.checksheet.disassembly.transDissList');
    }

    public function transDissgetTable(Request $request)
    {

     $data = Session::all();
      $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
         $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['section_id'] == '5') {

            if (request()->session()->get('user')['role_id'] == '2'){
                 $table = Service::select('service_request.*','checksheet_status.disassembly_status')
                 ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=',$dept_id)
                    ->where('service_request.location_id','=',$location)
                   //->where('service_request.chkonedept','=',$dept_id)
                   ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                       ->where(function($query) {
                           $query->where('disassembly_status', 'Submitted')
                        ->orWhere('disassembly_status', 'Approved');
                    })
                    ->orderby('service_request.created_at','DESC')->get();
                    //->where('service_request.dcs_status','=','Submitted')
                   

            }
            else{
                 $table = Service::select('service_request.*','checksheet_status.disassembly_status')
                  ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=',$dept_id)
                     ->where('service_request.location_id','=',$location)
                     ->where('service_request.cg1_status','=','Approved')
                    ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                     ->where('checksheet_status.disassembly_status','!=','Approved')
                      ->whereRaw("FIND_IN_SET({$emp_code},users)")
                     ->orderby('service_request.created_at','DESC')->get();
            }
        }


        $datatables =  Datatables::of($table)

                ->addColumn('action', function ($table) {

                    if (request()->session()->get('user')['section_id'] == '5') {

                        if (request()->session()->get('user')['role_id'] == '2'){

                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Approve/Reject</a>
                                          
                                                
                                            </div>
                                        </div>';
                        }
                        else{
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                        }
                    }

                    return $btns;
                })

                    ->rawColumns(['action']);

        return $datatables->make(true);
    }

    public function transAssList()
    {


        return view('admin.checksheet.disassembly.transAssList');
    }

    public function transAssgetTable(Request $request)
    {
         $data = Session::all();
       $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
         $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['section_id'] == '11') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('service_request.*','checksheet_status.assembly_status')
                 ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=','5')
                    ->where('service_request.location_id','=',$location)
                  
                   ->whereRaw("FIND_IN_SET('5',chkonedept)")
                       ->where(function($query) {
                           $query->where('assembly_status', 'Submitted')
                        ->orWhere('assembly_status', 'Approved');
                    })
                    ->orderby('service_request.created_at','DESC')->get();
                    //->where('service_request.asc_status','=','Submitted')->get();

            }
            else{
                $table = Service::select('service_request.*','checksheet_status.assembly_status')
                 ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=','5')
                     ->where('service_request.location_id','=',$location)
                    ->where('service_request.cg2_status','=','Approved')
                     ->where('service_request.store_status','=','Material Issued')
                    ->whereRaw("FIND_IN_SET('5',chkonedept)")
                     ->where('checksheet_status.assembly_status','!=','Approved')
                      ->whereRaw("FIND_IN_SET({$emp_code},users)")
                     ->orderby('service_request.created_at','DESC')->get();
                
            }
        }
//dd($table);exit;
        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {


                if (request()->session()->get('user')['section_id'] == '11') {

                    if (request()->session()->get('user')['role_id'] == '2'){

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-assembly-common')."/". "$table->id". '">Approve/Reject</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                    else{
                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-assembly-common')."/". "$table->id". '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                }



                return $btns;

            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

//hyd
    public function hydDissList()
    {


        return view('admin.checksheet.disassembly.hydDissList');
    }

    public function hydDissgetTable(Request $request)
    {

       $data = Session::all();
      $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
         $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['section_id'] == '13') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('service_request.*','checksheet_status.disassembly_status')
                 ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=',$dept_id)
                    ->where('service_request.location_id','=',$location)
                   //->where('service_request.chkonedept','=',$dept_id)
                   ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                       ->where(function($query) {
                           $query->where('disassembly_status', 'Submitted')
                        ->orWhere('disassembly_status', 'Approved');
                    })
                    ->orderby('service_request.created_at','DESC')->get();
                    //->where('service_request.dcs_status','=','Submitted')->get();

            }
            else{
                $table = Service::select('service_request.*','checksheet_status.disassembly_status')
                 ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=',$dept_id)
                     ->where('service_request.location_id','=',$location)
                     ->where('service_request.cg1_status','=','Approved')
                    ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                     ->where('checksheet_status.disassembly_status','!=','Approved')
                      ->whereRaw("FIND_IN_SET({$emp_code},users)")
                     ->orderby('service_request.created_at','DESC')->get();
            }
        }


        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {

                if (request()->session()->get('user')['section_id'] == '13') {

                    if (request()->session()->get('user')['role_id'] == '2'){

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Approve/Reject</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                    else{
                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                }

                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }
    public function hydAssList()
    {


        return view('admin.checksheet.disassembly.hydAssList');
    }

    public function hydAssgetTable(Request $request)
    {
        $data = Session::all();
       $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
         $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['section_id'] == '12') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('service_request.*','checksheet_status.assembly_status')
                 ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=','13')
                    ->where('service_request.location_id','=',$location)
                  
                   ->whereRaw("FIND_IN_SET('13',chkonedept)")
                       ->where(function($query) {
                           $query->where('assembly_status', 'Submitted')
                        ->orWhere('assembly_status', 'Approved');
                    })
                    ->orderby('service_request.created_at','DESC')->get();
                    //->where('service_request.asc_status','=','Submitted')->get();

            }
            else{
                $table = Service::select('service_request.*','checksheet_status.assembly_status')
                 ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=','13')
                     ->where('service_request.location_id','=',$location)
                    ->where('service_request.cg2_status','=','Approved')
                     ->where('service_request.store_status','=','Material Issued')
                    ->whereRaw("FIND_IN_SET('13',chkonedept)")
                     ->where('checksheet_status.assembly_status','!=','Approved')
                      ->whereRaw("FIND_IN_SET({$emp_code},users)")
                     ->orderby('service_request.created_at','DESC')->get();
                
            }
        }

        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {


                if (request()->session()->get('user')['section_id'] == '12') {

                    if (request()->session()->get('user')['role_id'] == '2'){

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-assembly-common')."/". "$table->id". '">Approve/Reject</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                    else{
                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-assembly-common')."/". "$table->id". '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                }

                return $btns;

            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }
//mor

    public function morDissList()
    {


        return view('admin.checksheet.disassembly.morDissList');
    }

   public function morDissgetTable(Request $request)
    {

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
         //$emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['section_id'] == '6') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('service_request.location_id','=',$location)
                    //$data = $table(service_request.chkonedept)
                    //->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")

                    ->where('service_request.cg1_status','=','Approved')
                    ->orderby('created_at','DESC')->get();


            }
            else{
                $table = Service::select('*')

                    ->where('service_request.location_id','=',$location)
                    //->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                    ->where('service_request.cg1_status','=','Approved')

  //->whereRaw("FIND_IN_SET({$emp_code},users)")
                    ->orderby('created_at','DESC')->get();
            }
        }


        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
           if ($table->work_orderno != Null) {
                if (request()->session()->get('user')['section_id'] == '6') {

                    if (request()->session()->get('user')['role_id'] == '2'){

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/mor-assign')."/". "$table->id". '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                    else{
                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/mor-assign')."/". "$table->id". '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                }

                return $btns;
           }
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

 //mor assign
    public function morAssign($id)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $pdiadd = Service::find($id);

        $subwork = SubworkorderStore::where('service_request_id','=',$id)->where('dept_id','=',$dept_id)->get();

        //dd($subwork);
//        if(isset($subwork_1)){
//            $subwork=$subwork_1;
//
//
//        }else{
//            $subwork=Null;
//
//        }

        $customer = Service::select('gw_master_customer.name')
            ->join('gw_master_customer','gw_master_customer.id','=','service_request.customer')
            ->where('service_request.id','=',$id)
            ->get()->toArray();

        $model = Service::select('gw_master_mc_model.model_no')
            ->join('gw_master_mc_model','gw_master_mc_model.id','=','service_request.machine_modelno')
            ->where('service_request.id','=',$id)
            ->get()->toArray();

        $serial = Service::select('gw_master_comp_details.comp_serial_no')
            ->join('gw_master_comp_details','gw_master_comp_details.id','=','service_request.component_serial_no')
            ->where('service_request.id','=',$id)
            ->get()->toArray();


        return view('admin.include.morAssign')
            ->with('customer', $customer)
            ->with('model', $model)
            ->with('serial', $serial)
            ->with('subwork', $subwork)
            ->with('pdiadd', $pdiadd);


    }
   public function morAssignSave(Request $request)

    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $morAddSave = $request->all();
        $location=$data['user']['location_id'];
        $obj = Service::find($request['service_id']);

        $morassign_dept1 = implode(',',$request['department']);
        if($dept_id == '6') {
            $obj->chkonedept =$morassign_dept1 . ',' . '6';
        }


         $obj->mor_date  =date("Y-m-d");
        $obj->mor_status= 'SubWorkOrderCreated';
        $obj->save();
        
//       $myrequest=$request->all();
//        dd($myrequest);


        $exterwash_res = SubworkorderStore ::where('service_request_id','=',$request['service_id'])
            ->where('workorder','=',$request['work_order'])
            ->where('dept_id','=',$dept_id)
            ->get()->toArray();
        //echo '<pre>';print_r($exterwash_res[0]['created_at']);exit;
        if(count($exterwash_res)<=0){
            $colu = new SubworkorderStore();

        }
        else{
            $colu = SubworkorderStore::find($exterwash_res[0]['id']);


        }
        $file=$request['subwork'];

        if(isset($obj->id)){

            SubworkorderStore::where('service_request_id','=',$request['service_id'])
                ->where('workorder','=',$request['work_order'])->where('dept_id','=',$dept_id)->delete();
                //->where('dept_id','=',$dept_id)

            foreach($file as $key=>$val){

                 //echo'<pre>';print_r($file);
                //$obj->photograph=$request['photograph'];

                $txt= $val;


                $colu = new SubworkorderStore();
                $colu->service_request_id = $obj->id;
                $colu->dept_id= $dept_id;
                $colu->department = $request['department'][$key];

                $colu->workorder = $request['work_order'];

                $colu->subworkorder = $txt;
                 
                $colu->save();

             
                //send Notification

                foreach ($request['department'] as $empcode) {
                    $mail = UserHelper::assigndept($empcode);
                    $to_email = $mail[0]['email'];
                    //echo '<pre>';print_r($mail);
                    $subject = 'Assign To Department Mail';
                    $message = view('admin.mail.assignUserMail')->render();
                    mail($to_email, $subject, $message);
                    //$notification = UserHelper::mailnotification($to_email, $subject, $message);
                }
                //exit;
            }

        }

              //project create


        $obj1 = Service::find($request['service_id'])->toArray();

        $dept_name = UserHelper::getDeptName('6')[0];
        $getDeptEmp = UserHelper::getDeptEmp($location);

        //$onebyonedepy=explode(',',$obj1['chkonedept']);
        $onebyonedepy=$request['department'];




        $emp_res = '';
        $task_res = '';
        $task_tat_cal = 0;
        $rim = 0;
        foreach($onebyonedepy as $onedept) {

            $getDeptTasks = UserHelper::getDeptTask($onedept, $obj1['machine_modelno']);



         if (!empty($getDeptTasks)) {

            if (!empty($getDeptEmp)) {
                foreach ($getDeptEmp as $key => $emp) {
                    if ($key == 0) {
                        $emp_res = $emp['emp_code'];
                    } else {

                        $emp_res = $emp_res . ',' . $emp['emp_code'];
                    }
                }
            }
            if (!empty($getDeptTasks)) {
                foreach ($getDeptTasks as $key => $task) {
                    if (empty($task['tat'])) {
                        $task['tat'] = 0;
                    }
                    $task_tat_cal += $task['tat'];
                    if ($key == 0) {
                        $task_res = $task['id'];
                    } else {
                        $task_res = $task_res . ',' . $task['id'];
                    }
                }
            }

//echo '<pre>';print_r($exterwash_res[0]['created_at']);exit;
        $number = $task_tat_cal . ' days';
        //$estm_end_date=date_create($obj1['po_date']);
        
        $estm_end_date = date_create($obj->mor_date);
        
        date_add($estm_end_date, date_interval_create_from_date_string($number));

            if($rim == 0){
                $project_id = '#PRO' . substr(str_shuffle("12345"), -1) . mt_rand(1000, 99999);

                $obj_project_plan = new ProjectPlanMaster();
                $obj_project_plan->service_id = $obj1['id'];
                $obj_project_plan->service_request_no = $obj1['service_request_no'];
                 $obj_project_plan->workorder = $obj1['work_orderno'];
                $obj_project_plan->project_id = $project_id;
                $obj_project_plan->name = $dept_name['name'];
                $obj_project_plan->dept_id = $dept_id;
                $obj_project_plan->dept_name = $dept_name['name'];
                $obj_project_plan->customer_id = $obj1['customer'];
                $obj_project_plan->estm_start_date = $obj->mor_date;
                $obj_project_plan->estm_end_date = date_format($estm_end_date, "Y-m-d");
                $obj_project_plan->estm_days = $task_tat_cal;
                $obj_project_plan->save();
            }



            $obj_project_task = new ProjectTask();
            $obj_project_task->prj_id = $obj_project_plan->id;
            $obj_project_task->project_id = $project_id;
            // $obj_project_task->dept_id = $onemordept;
            $obj_project_task->dept_id = $onedept;
            $obj_project_task->tasks = $task_res;
            $obj_project_task->save();

            $obj_checksheetstatus = new ChecksheetStatus();
            $obj_checksheetstatus->service_request_id = $request['service_id'];
            $obj_checksheetstatus->dept_id = $onedept;
            $obj_checksheetstatus->save();

           $obj_checksheetgate = new CheckgateStatus();
            $obj_checksheetgate->service_request_id = $request['service_id'];
            $obj_checksheetgate->dept_id = $onedept;
            $obj_checksheetgate->save();

            $userexpld = explode(',', $task_res);

            foreach ($userexpld as $taskwiserow) {
                $taskrow = new TaskUser();
                $taskrow->prj_id = $obj_project_plan->id;
                $taskrow->project_id = $project_id;
                $taskrow->dept_id = $onedept;
                $taskrow->task = $taskwiserow;
                $task_name = UserHelper::getTaskName($taskwiserow);

                $taskrow->task_name = $task_name[0]['name'];
				if($taskrow->task_name == ' Disassembly'){
                    $eststrt_date = $obj->mor_date;
                    $tat = round($task_name[0]['tat']);
                    //dd($tat);
                    $taskrow->est_start_date =$eststrt_date;
                    $numbers = $tat.' days';
                    $estmenddate=date_create($eststrt_date);
                    date_add($estmenddate,date_interval_create_from_date_string($numbers));
                    $estend_date = date_format($estmenddate,"Y-m-d");
                    //dd($estend_date);
                    $taskrow->est_start_date =$eststrt_date;
                    $taskrow->est_end_date =$estend_date;
                }
                elseif($taskrow->task_name == 'Store'){

                    $predicessor = UserHelper::predicessorfind($task_name[0]['predicessor'],$onedept,$project_id);
                    //dd($predicessor[0]['est_end_date']);
                    if (!empty($predicessor)) {
                        if ($task_name[0]['relation_type'] == "Start to start") {
                            $eststrt_date = $predicessor[0]['est_start_date'];
                            $tat = round($task_name[0]['tat']);

                            $numbers = $tat . ' days';
                            $estmenddate = date_create($eststrt_date);
                            date_add($estmenddate, date_interval_create_from_date_string($numbers));
                            $estend_date = date_format($estmenddate, "Y-m-d");

                            $taskrow->est_start_date = $eststrt_date;
                            $taskrow->est_end_date = $estend_date;
                        }
                        elseif ($task_name[0]['relation_type'] == "Finish to start"){
                            $tat = round($task_name[0]['tat']);
                            $eststrt_date = $predicessor[0]['est_end_date'];
                            $numbers = $tat . ' days';

                            $estmenddate = date_create($eststrt_date);
                            date_add($estmenddate, date_interval_create_from_date_string($numbers));
                            $estend_date = date_format($estmenddate, "Y-m-d");

                            $taskrow->est_start_date = $eststrt_date;
                            $taskrow->est_end_date = $estend_date;
                        }elseif ($task_name[0]['relation_type'] == "Finish to finish"){
                            $tat = round($task_name[0]['tat']);
                            $estend_date = $predicessor[0]['est_end_date'];
                            $numbers = $tat . ' days';

                            $estmenddate = date_create($estend_date);
                            DATE_SUB($estmenddate, date_interval_create_from_date_string($numbers));
                            $eststrt_date = date_format($estmenddate, "Y-m-d");

                            if($eststrt_date < $obj->mor_date){
                                $taskrow->est_start_date = $obj->mor_date;
                            }else{
                                $taskrow->est_start_date = $eststrt_date;
                            }

                            $taskrow->est_end_date = $estend_date;
                        }

                    }
                    else{
                        $taskrow->est_start_date =null;
                        $taskrow->est_end_date =null;
                    }
                }
                elseif($taskrow->task_name == ' Assembly'){

                    $tat = round($task_name[0]['tat']);
                    //dd($task_name[0]['predicessor']);
                    $predicessor = UserHelper::predicessorfind($task_name[0]['predicessor'],$onedept,$project_id);
                    //dd($predicessor[0]['est_end_date']);
                    if (!empty($predicessor)) {
                        if ($task_name[0]['relation_type'] == "Start to start") {
                            $eststrt_date = $predicessor[0]['est_start_date'];
                            $tat = round($task_name[0]['tat']);

                            $numbers = $tat . ' days';
                            $estmenddate = date_create($eststrt_date);
                            date_add($estmenddate, date_interval_create_from_date_string($numbers));
                            $estend_date = date_format($estmenddate, "Y-m-d");

                            $taskrow->est_start_date = $eststrt_date;
                            $taskrow->est_end_date = $estend_date;
                        }
                        elseif ($task_name[0]['relation_type'] == "Finish to start"){
                            $tat = round($task_name[0]['tat']);
                            $eststrt_date = $predicessor[0]['est_end_date'];
                            $numbers = $tat . ' days';

                            $estmenddate = date_create($eststrt_date);
                            date_add($estmenddate, date_interval_create_from_date_string($numbers));
                            $estend_date = date_format($estmenddate, "Y-m-d");

                            $taskrow->est_start_date = $eststrt_date;
                            $taskrow->est_end_date = $estend_date;
                        }elseif ($task_name[0]['relation_type'] == "Finish to finish"){
                            $tat = round($task_name[0]['tat']);
                            $estend_date = $predicessor[0]['est_end_date'];
                            $numbers = $tat . ' days';

                            $estmenddate = date_create($estend_date);
                            DATE_SUB($estmenddate, date_interval_create_from_date_string($numbers));
                            $eststrt_date = date_format($estmenddate, "Y-m-d");

                            if($eststrt_date < $obj->mor_date){
                                $taskrow->est_start_date = $obj->mor_date;
                            }else{
                                $taskrow->est_start_date = $eststrt_date;
                            }

                            $taskrow->est_end_date = $estend_date;
                        }

                    }
                    else{
                        $taskrow->est_start_date =null;
                        $taskrow->est_end_date =null;
                    }
                    //dd($eststrt_date);

                }
                elseif($taskrow->task_name == 'Testing'){

                    $tat = round($task_name[0]['tat']);
                    //dd($tat);
                    $predicessor = UserHelper::predicessorfind($task_name[0]['predicessor'],$onedept,$project_id);
                    //dd($predicessor);
                    if (!empty($predicessor)) {
                        if ($task_name[0]['relation_type'] == "Start to start") {
                            $eststrt_date = $predicessor[0]['est_start_date'];
                            $tat = round($task_name[0]['tat']);

                            $numbers = $tat . ' days';
                            $estmenddate = date_create($eststrt_date);
                            date_add($estmenddate, date_interval_create_from_date_string($numbers));
                            $estend_date = date_format($estmenddate, "Y-m-d");

                            $taskrow->est_start_date = $eststrt_date;
                            $taskrow->est_end_date = $estend_date;
                        }
                        elseif ($task_name[0]['relation_type'] == "Finish to start"){
                            $tat = round($task_name[0]['tat']);
                            $eststrt_date = $predicessor[0]['est_end_date'];
                            $numbers = $tat . ' days';

                            $estmenddate = date_create($eststrt_date);
                            date_add($estmenddate, date_interval_create_from_date_string($numbers));
                            $estend_date = date_format($estmenddate, "Y-m-d");

                            $taskrow->est_start_date = $eststrt_date;
                            $taskrow->est_end_date = $estend_date;
                        }elseif ($task_name[0]['relation_type'] == "Finish to finish"){
                            $tat = round($task_name[0]['tat']);
                            $estend_date = $predicessor[0]['est_end_date'];
                            $numbers = $tat . ' days';

                            $estmenddate = date_create($estend_date);
                            DATE_SUB($estmenddate, date_interval_create_from_date_string($numbers));
                            $eststrt_date = date_format($estmenddate, "Y-m-d");

                            if($eststrt_date < $obj->mor_date){
                                $taskrow->est_start_date = $obj->mor_date;
                            }else{
                                $taskrow->est_start_date = $eststrt_date;
                            }

                            $taskrow->est_end_date = $estend_date;
                        }

                    }
                    else{
                        $taskrow->est_start_date =null;
                        $taskrow->est_end_date =null;
                    }
                    //dd($eststrt_date);

                }

                elseif($taskrow->task_name == 'QAQC'){

                    $tat = round($task_name[0]['tat']);
                    //dd($tat);
                    $predicessor = UserHelper::predicessorfind($task_name[0]['predicessor'],$onedept,$project_id);
                    //dd($predicessor);
                    if (!empty($predicessor)) {
                        if ($task_name[0]['relation_type'] == "Start to start") {
                            $eststrt_date = $predicessor[0]['est_start_date'];
                            $tat = round($task_name[0]['tat']);

                            $numbers = $tat . ' days';
                            $estmenddate = date_create($eststrt_date);
                            date_add($estmenddate, date_interval_create_from_date_string($numbers));
                            $estend_date = date_format($estmenddate, "Y-m-d");

                            $taskrow->est_start_date = $eststrt_date;
                            $taskrow->est_end_date = $estend_date;
                        }
                        elseif ($task_name[0]['relation_type'] == "Finish to start"){
                            $tat = round($task_name[0]['tat']);
                            $eststrt_date = $predicessor[0]['est_end_date'];
                            $numbers = $tat . ' days';

                            $estmenddate = date_create($eststrt_date);
                            date_add($estmenddate, date_interval_create_from_date_string($numbers));
                            $estend_date = date_format($estmenddate, "Y-m-d");

                            $taskrow->est_start_date = $eststrt_date;
                            $taskrow->est_end_date = $estend_date;
                        }elseif ($task_name[0]['relation_type'] == "Finish to finish"){
                            $tat = round($task_name[0]['tat']);
                            $estend_date = $predicessor[0]['est_end_date'];
                            $numbers = $tat . ' days';

                            $estmenddate = date_create($estend_date);
                            DATE_SUB($estmenddate, date_interval_create_from_date_string($numbers));
                            $eststrt_date = date_format($estmenddate, "Y-m-d");

                            if($eststrt_date < $obj->mor_date){
                                $taskrow->est_start_date = $obj->mor_date;
                            }else{
                                $taskrow->est_start_date = $eststrt_date;
                            }

                            $taskrow->est_end_date = $estend_date;
                        }

                    }
                    else{
                        $taskrow->est_start_date =null;
                        $taskrow->est_end_date =null;
                    }
                    //dd($eststrt_date);

                }
                elseif($taskrow->task_name == 'Dispatch'){

                    $tat = round($task_name[0]['tat']);
                    //dd($tat);
                    $predicessor = UserHelper::predicessorfind($task_name[0]['predicessor'],$onedept,$project_id);
                    //dd($predicessor);
                    if (!empty($predicessor)) {
                        if ($task_name[0]['relation_type'] == "Start to start") {
                            $eststrt_date = $predicessor[0]['est_start_date'];
                            $tat = round($task_name[0]['tat']);

                            $numbers = $tat . ' days';
                            $estmenddate = date_create($eststrt_date);
                            date_add($estmenddate, date_interval_create_from_date_string($numbers));
                            $estend_date = date_format($estmenddate, "Y-m-d");

                            $taskrow->est_start_date = $eststrt_date;
                            $taskrow->est_end_date = $estend_date;
                        }
                        elseif ($task_name[0]['relation_type'] == "Finish to start"){
                            $tat = round($task_name[0]['tat']);
                            $eststrt_date = $predicessor[0]['est_end_date'];
                            $numbers = $tat . ' days';

                            $estmenddate = date_create($eststrt_date);
                            date_add($estmenddate, date_interval_create_from_date_string($numbers));
                            $estend_date = date_format($estmenddate, "Y-m-d");

                            $taskrow->est_start_date = $eststrt_date;
                            $taskrow->est_end_date = $estend_date;
                        }elseif ($task_name[0]['relation_type'] == "Finish to finish"){
                            $tat = round($task_name[0]['tat']);
                            $estend_date = $predicessor[0]['est_end_date'];
                            $numbers = $tat . ' days';

                            $estmenddate = date_create($estend_date);
                            DATE_SUB($estmenddate, date_interval_create_from_date_string($numbers));
                            $eststrt_date = date_format($estmenddate, "Y-m-d");

                            if($eststrt_date < $obj->mor_date){
                                $taskrow->est_start_date = $obj->mor_date;
                            }else{
                                $taskrow->est_start_date = $eststrt_date;
                            }

                            $taskrow->est_end_date = $estend_date;
                        }

                    }
                    else{
                        $taskrow->est_start_date =null;
                        $taskrow->est_end_date =null;
                    }


                    //dd($eststrt_date);

                }
				
                $taskrow->save();
            }
			
			foreach ($userexpld as $taskwiserow1) {

                 $taskrow1 =TaskUser::where('task','=',$taskwiserow1)->where('dept_id','=',$onedept)->where('project_id','=',$project_id)
                     ->get()->first();
                 //dd($taskrow1['task_name']);
                 $task_name1 = UserHelper::getTaskName($taskwiserow1);
                 //$predicessor = UserHelper::predicessorfind($taskwiserow1,$obj1['chkonedept'],$project_id);
                 if($taskrow1['task_name'] == ' Disassembly'){
                     if(empty($taskrow1['est_start_date']) || empty($taskrow1['est_end_date'])){
                         $eststrt_date = $obj->mor_date;
                         $tat = round($task_name1[0]['tat']);
                         //dd($tat);
                         //$taskrow->est_start_date =$eststrt_date;
                         $numbers = $tat.' days';
                         $estmenddate=date_create($eststrt_date);
                         date_add($estmenddate,date_interval_create_from_date_string($numbers));
                         $estend_date = date_format($estmenddate,"Y-m-d");
                         //dd($estend_date);
                         $taskrow1->est_start_date =$eststrt_date;
                         $taskrow1->est_end_date =$estend_date;
                     }


                 }
                 elseif($taskrow1['task_name'] == 'Store') {
                     if(empty($taskrow1['est_start_date']) || empty($taskrow1['est_end_date'])){
                         $predicessor = UserHelper::predicessorfind($task_name1[0]['predicessor'],$onedept,$project_id);
                         if (!empty($predicessor)) {
                             if ($task_name1[0]['relation_type'] == "Start to start") {
                                 $eststrt_date = $predicessor[0]['est_start_date'];
                                 $tat = round($task_name1[0]['tat']);

                                 $numbers = $tat . ' days';
                                 $estmenddate = date_create($eststrt_date);
                                 date_add($estmenddate, date_interval_create_from_date_string($numbers));
                                 $estend_date = date_format($estmenddate, "Y-m-d");

                                 $taskrow1->est_start_date = $eststrt_date;
                                 $taskrow1->est_end_date = $estend_date;
                             }
                             elseif ($task_name1[0]['relation_type'] == "Finish to start"){
                                 $tat = round($task_name1[0]['tat']);
                                 $eststrt_date = $predicessor[0]['est_end_date'];
                                 $numbers = $tat . ' days';

                                 $estmenddate = date_create($eststrt_date);
                                 date_add($estmenddate, date_interval_create_from_date_string($numbers));
                                 $estend_date = date_format($estmenddate, "Y-m-d");

                                 $taskrow1->est_start_date = $eststrt_date;
                                 $taskrow1->est_end_date = $estend_date;
                             }elseif ($task_name1[0]['relation_type'] == "Finish to finish"){
                                 $tat = round($task_name1[0]['tat']);
                                 $estend_date = $predicessor[0]['est_end_date'];
                                 $numbers = $tat . ' days';

                                 $estmenddate = date_create($estend_date);
                                 DATE_SUB($estmenddate, date_interval_create_from_date_string($numbers));
                                 $eststrt_date = date_format($estmenddate, "Y-m-d");

                                 if($eststrt_date < $obj->mor_date){
                                     $taskrow1->est_start_date = $obj->mor_date;
                                 }else{
                                     $taskrow1->est_start_date = $eststrt_date;
                                 }

                                 $taskrow1->est_end_date = $estend_date;
                             }

                         }
                         else{
                             $taskrow1->est_start_date =null;
                             $taskrow1->est_end_date =null;
                         }
                     }
                 }
                 elseif($taskrow1['task_name'] == ' Assembly'){
                     if(empty($taskrow1['est_start_date']) || empty($taskrow1['est_end_date'])) {
                         //$tat = round($task_name1[0]['tat']);

                         $predicessor = UserHelper::predicessorfind($task_name1[0]['predicessor'],$onedept,$project_id);
                         if (!empty($predicessor)) {
                             if ($task_name1[0]['relation_type'] == "Start to start") {
                                 $eststrt_date = $predicessor[0]['est_start_date'];
                                 $tat = round($task_name1[0]['tat']);

                                 $numbers = $tat . ' days';
                                 $estmenddate = date_create($eststrt_date);
                                 date_add($estmenddate, date_interval_create_from_date_string($numbers));
                                 $estend_date = date_format($estmenddate, "Y-m-d");

                                 $taskrow1->est_start_date = $eststrt_date;
                                 $taskrow1->est_end_date = $estend_date;
                             }
                             elseif ($task_name1[0]['relation_type'] == "Finish to start"){
                                 $tat = round($task_name1[0]['tat']);
                                 $eststrt_date = $predicessor[0]['est_end_date'];
                                 $numbers = $tat . ' days';

                                 $estmenddate = date_create($eststrt_date);
                                 date_add($estmenddate, date_interval_create_from_date_string($numbers));
                                 $estend_date = date_format($estmenddate, "Y-m-d");

                                 $taskrow1->est_start_date = $eststrt_date;
                                 $taskrow1->est_end_date = $estend_date;
                             }elseif ($task_name1[0]['relation_type'] == "Finish to finish"){
                                 $tat = round($task_name1[0]['tat']);
                                 $estend_date = $predicessor[0]['est_end_date'];
                                 $numbers = $tat . ' days';

                                 $estmenddate = date_create($estend_date);
                                 DATE_SUB($estmenddate, date_interval_create_from_date_string($numbers));
                                 $eststrt_date = date_format($estmenddate, "Y-m-d");

                                 if($eststrt_date < $obj->mor_date){
                                     $taskrow1->est_start_date = $obj->mor_date;
                                 }else{
                                     $taskrow1->est_start_date = $eststrt_date;
                                 }

                                 $taskrow1->est_end_date = $estend_date;
                             }

                         }
                         else{
                             $taskrow1->est_start_date =null;
                             $taskrow1->est_end_date =null;
                         }

                         //dd($eststrt_date);
                     }
                 }
                 elseif($taskrow1['task_name'] == 'Testing'){
                     if(empty($taskrow1['est_start_date']) || empty($taskrow1['est_end_date'])) {
                         $predicessor = UserHelper::predicessorfind($task_name1[0]['predicessor'],$onedept,$project_id);
                         if (!empty($predicessor)) {
                             if ($task_name1[0]['relation_type'] == "Start to start") {
                                 $eststrt_date = $predicessor[0]['est_start_date'];
                                 $tat = round($task_name1[0]['tat']);

                                 $numbers = $tat . ' days';
                                 $estmenddate = date_create($eststrt_date);
                                 date_add($estmenddate, date_interval_create_from_date_string($numbers));
                                 $estend_date = date_format($estmenddate, "Y-m-d");

                                 $taskrow1->est_start_date = $eststrt_date;
                                 $taskrow1->est_end_date = $estend_date;
                             }
                             elseif ($task_name1[0]['relation_type'] == "Finish to start"){
                                 $tat = round($task_name1[0]['tat']);
                                 $eststrt_date = $predicessor[0]['est_end_date'];
                                 $numbers = $tat . ' days';

                                 $estmenddate = date_create($eststrt_date);
                                 date_add($estmenddate, date_interval_create_from_date_string($numbers));
                                 $estend_date = date_format($estmenddate, "Y-m-d");

                                 $taskrow1->est_start_date = $eststrt_date;
                                 $taskrow1->est_end_date = $estend_date;
                             }elseif ($task_name1[0]['relation_type'] == "Finish to finish"){
                                 $tat = round($task_name1[0]['tat']);
                                 $estend_date = $predicessor[0]['est_end_date'];
                                 $numbers = $tat . ' days';

                                 $estmenddate = date_create($estend_date);
                                 DATE_SUB($estmenddate, date_interval_create_from_date_string($numbers));
                                 $eststrt_date = date_format($estmenddate, "Y-m-d");

                                 if($eststrt_date < $obj->mor_date){
                                     $taskrow1->est_start_date = $obj->mor_date;
                                 }else{
                                     $taskrow1->est_start_date = $eststrt_date;
                                 }

                                 $taskrow1->est_end_date = $estend_date;
                             }

                         }
                         else{
                             $taskrow1->est_start_date =null;
                             $taskrow1->est_end_date =null;
                         }

                         //dd($eststrt_date);
                     }
                 }

                 elseif($taskrow1['task_name'] == 'QAQC'){
                     if(empty($taskrow1['est_start_date']) || empty($taskrow1['est_end_date'])) {
                         $predicessor = UserHelper::predicessorfind($task_name1[0]['predicessor'],$onedept,$project_id);
                         if (!empty($predicessor)) {
                             if ($task_name1[0]['relation_type'] == "Start to start") {
                                 $eststrt_date = $predicessor[0]['est_start_date'];
                                 $tat = round($task_name1[0]['tat']);

                                 $numbers = $tat . ' days';
                                 $estmenddate = date_create($eststrt_date);
                                 date_add($estmenddate, date_interval_create_from_date_string($numbers));
                                 $estend_date = date_format($estmenddate, "Y-m-d");

                                 $taskrow1->est_start_date = $eststrt_date;
                                 $taskrow1->est_end_date = $estend_date;
                             }
                             elseif ($task_name1[0]['relation_type'] == "Finish to start"){
                                 $tat = round($task_name1[0]['tat']);
                                 $eststrt_date = $predicessor[0]['est_end_date'];
                                 $numbers = $tat . ' days';

                                 $estmenddate = date_create($eststrt_date);
                                 date_add($estmenddate, date_interval_create_from_date_string($numbers));
                                 $estend_date = date_format($estmenddate, "Y-m-d");

                                 $taskrow1->est_start_date = $eststrt_date;
                                 $taskrow1->est_end_date = $estend_date;
                             }elseif ($task_name1[0]['relation_type'] == "Finish to finish"){
                                 $tat = round($task_name1[0]['tat']);
                                 $estend_date = $predicessor[0]['est_end_date'];
                                 $numbers = $tat . ' days';

                                 $estmenddate = date_create($estend_date);
                                 DATE_SUB($estmenddate, date_interval_create_from_date_string($numbers));
                                 $eststrt_date = date_format($estmenddate, "Y-m-d");

                                 if($eststrt_date < $obj->mor_date){
                                     $taskrow1->est_start_date = $obj->mor_date;
                                 }else{
                                     $taskrow1->est_start_date = $eststrt_date;
                                 }

                                 $taskrow1->est_end_date = $estend_date;
                             }

                         }
                         else{
                             $taskrow1->est_start_date =null;
                             $taskrow1->est_end_date =null;
                         }

                         //dd($eststrt_date);
                     }
                 }
                 elseif($taskrow1['task_name'] == 'Dispatch'){
                     //dd($taskrow1['est_start_date']);
                     if(empty($taskrow1['est_start_date']) || empty($taskrow1['est_end_date'])) {
                         $predicessor = UserHelper::predicessorfind($task_name1[0]['predicessor'],$onedept,$project_id);

                         if (!empty($predicessor)) {
                             if ($task_name1[0]['relation_type'] == "Start to start") {
                                 $eststrt_date = $predicessor[0]['est_start_date'];
                                 $tat = round($task_name1[0]['tat']);

                                 $numbers = $tat . ' days';
                                 $estmenddate = date_create($eststrt_date);
                                 date_add($estmenddate, date_interval_create_from_date_string($numbers));
                                 $estend_date = date_format($estmenddate, "Y-m-d");

                                 $taskrow1->est_start_date = $eststrt_date;
                                 $taskrow1->est_end_date = $estend_date;
                             }
                             elseif ($task_name1[0]['relation_type'] == "Finish to start"){
                                 $tat = round($task_name1[0]['tat']);
                                 $eststrt_date = $predicessor[0]['est_end_date'];
                                 $numbers = $tat . ' days';

                                 $estmenddate = date_create($eststrt_date);
                                 date_add($estmenddate, date_interval_create_from_date_string($numbers));
                                 $estend_date = date_format($estmenddate, "Y-m-d");

                                 $taskrow1->est_start_date = $eststrt_date;
                                 $taskrow1->est_end_date = $estend_date;
                             }elseif ($task_name1[0]['relation_type'] == "Finish to finish"){
                                 $tat = round($task_name1[0]['tat']);
                                 $estend_date = $predicessor[0]['est_end_date'];
                                 $numbers = $tat . ' days';

                                 $estmenddate = date_create($estend_date);
                                 DATE_SUB($estmenddate, date_interval_create_from_date_string($numbers));
                                 $eststrt_date = date_format($estmenddate, "Y-m-d");

                                 if($eststrt_date < $obj->mor_date){
                                     $taskrow1->est_start_date = $obj->mor_date;
                                 }else{
                                     $taskrow1->est_start_date = $eststrt_date;
                                 }

                                 $taskrow1->est_end_date = $estend_date;
                             }
                             //dd($taskrow1->est_end_date);
                         }
                         else{
                             $taskrow1->est_start_date =null;
                             $taskrow1->est_end_date =null;
                         }


                         //dd($eststrt_date);
                     }
                 }

                 $taskrow1->save();
             }
			 
			 
			 $findestend_date = TaskUser::where('project_id','=',$project_id)
			   //->where('dept_id', '=', $onedept)
                 //->where('task_name','=','Dispatch')
                 ->where('est_end_date','!=',Null)
                 ->get()->toArray();
             
             if(!empty($findestend_date)){
                  $i=0;
                $result=0;
                $userlist=[];

                foreach($findestend_date as $key=>$var){
                    if($key == 0)
                    {
                        $result = $var['est_end_date'];
                    } else {
                        $result = $result.','.$var['est_end_date'];
                    }



                    $userlist[$i]=$var['est_end_date'];


                    $i++;
                }

                $max = max(array_map('strtotime', $userlist));

                $dateput=date('Y-m-d', $max);
                 

                 $change_estend_date = DB::table('gw_project_plan_master')->where('project_id', '=', $project_id)->where('dept_id', '=', $dept_id)->update(array('estm_end_date' => $dateput));
             }
			
			$finddiff_date = ProjectPlanMaster::where('project_id','=',$project_id)->where('dept_id', '=', $dept_id)->get()->toArray();
            if(!empty($finddiff_date[0]['estm_start_date']) && !empty($finddiff_date[0]['estm_end_date'])){
                $to =Carbon::parse($finddiff_date[0]['estm_start_date']);
                $from =Carbon::parse($finddiff_date[0]['estm_end_date']);
                //$diff = strtotime($finddiff_date[0]['estm_end_date']) - strtotime($finddiff_date[0]['estm_start_date']);
                $diff = $to->diffInDays($from);

                //dd($diff);
                if(!empty($diff)){
                    $change_estdayleft = DB::table('gw_project_plan_master')->where('project_id', '=', $project_id)->where('dept_id', '=', $dept_id)->update(array('estm_days' => $diff));
                }

            }
			
            if($rim == 0) {
                $obj_project_user = new ProjectUser();
                $obj_project_user->prj_id = $obj_project_plan->id;
                $obj_project_user->project_id = $project_id;
                $obj_project_user->dept_id = $dept_id;
                $obj_project_user->users = $emp_res;
                $obj_project_user->save();
            }
            $rim++;
        }

       }





        return redirect('admin/mor-assign/'.$request['service_id']);

    }



    public function morAssList()
    {


        return view('admin.checksheet.disassembly.morAssList');
    }

   public function morAssgetTable(Request $request)
    {

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        if (request()->session()->get('user')['section_id'] == '14') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('service_request.location_id','=',$location)
                    //$data = $table(service_request.chkonedept)
                    ->whereRaw("FIND_IN_SET('6',chkonedept)")

                    ->where('service_request.cg1_status','=','Approved')
                    ->orderby('created_at','DESC')->get();


            }
            else{
                $table = Service::select('*')

                    ->where('service_request.location_id','=',$location)
                    ->whereRaw("FIND_IN_SET('6',chkonedept)")
                    ->where('service_request.cg1_status','=','Approved')
//

                    ->orderby('created_at','DESC')->get();
            }
        }


        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {

                if (request()->session()->get('user')['section_id'] == '14') {

                    if (request()->session()->get('user')['role_id'] == '2'){

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/mor-assign')."/". "$table->id". '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                    else{
                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/mor-assign')."/". "$table->id". '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                }

                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }
    
//undercarraige
    public function undercargDissList()
    {


        return view('admin.checksheet.disassembly.undercarrigeDissList');
    }

    public function undercargDissgetTable(Request $request)
    {
       
        $data = Session::all();
      $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
         $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['section_id'] == '7') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('service_request.*','checksheet_status.disassembly_status')
                 ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=',$dept_id)
                    ->where('service_request.location_id','=',$location)
                   //->where('service_request.chkonedept','=',$dept_id)
                   ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                       ->where(function($query) {
                           $query->where('disassembly_status', 'Submitted')
                        ->orWhere('disassembly_status', 'Approved');
                    })
                    ->orderby('service_request.created_at','DESC')->get();
                    //->where('service_request.dcs_status','=','Submitted')->get();

            }
            else{
               $table = Service::select('service_request.*','checksheet_status.disassembly_status')
                ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=',$dept_id)
                     ->where('service_request.location_id','=',$location)
                     ->where('service_request.cg1_status','=','Approved')
                    ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                     ->where('checksheet_status.disassembly_status','!=','Approved')
                      ->whereRaw("FIND_IN_SET({$emp_code},users)")
                     ->orderby('service_request.created_at','DESC')->get();
            }
        }


        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {

                if (request()->session()->get('user')['section_id'] == '7') {

                    if (request()->session()->get('user')['role_id'] == '2'){

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Approve/Reject</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                    else{
                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                }

                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function undercargAssList()
    {


        return view('admin.checksheet.disassembly.undercarrigeAssList');
    }

    public function undercargAssgetTable(Request $request)
    {
         $data = Session::all();
       $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
         $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['section_id'] == '15') {

            if (request()->session()->get('user')['role_id'] == '2'){
               $table = Service::select('service_request.*','checksheet_status.assembly_status')
                 ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=','7')
                    ->where('service_request.location_id','=',$location)
                  
                   ->whereRaw("FIND_IN_SET('7',chkonedept)")
                       ->where(function($query) {
                           $query->where('assembly_status', 'Submitted')
                        ->orWhere('assembly_status', 'Approved');
                    })
                    ->orderby('service_request.created_at','DESC')->get();
                    //->where('service_request.asc_status','=','Submitted')->get();

            }
            else{
                $table = Service::select('service_request.*','checksheet_status.assembly_status')
                 ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                    ->where('checksheet_status.dept_id','=','7')
                     ->where('service_request.location_id','=',$location)
                    ->where('service_request.cg2_status','=','Approved')
                     ->where('service_request.store_status','=','Material Issued')
                    ->whereRaw("FIND_IN_SET('7',chkonedept)")
                     ->where('checksheet_status.assembly_status','!=','Approved')
                      ->whereRaw("FIND_IN_SET({$emp_code},users)")
                     ->orderby('service_request.created_at','DESC')->get();
                
            }
        }
//dd($table);exit;
        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {


                if (request()->session()->get('user')['section_id'] == '15') {

                    if (request()->session()->get('user')['role_id'] == '2'){

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-assembly-common')."/". "$table->id". '">Approve/Reject</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                    else{
                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-sheet-assembly-common')."/". "$table->id". '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                    }
                }

                return $btns;

            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

      //store
    public function storeList()
    {


        return view('admin.checksheet.disassembly.storeList');
    }



    public function storegetTable(Request $request)
    {

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['section_id'] == '9') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('service_request.location_id','=',$location)
                    //$data = $table(service_request.chkonedept)
                    //->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")

                    ->where('service_request.dcs_status','=','Approved')
                    ->orderby('created_at','DESC')->get();


            }
            else{
                $table = Service::select('*')

                    ->where('service_request.location_id','=',$location)
                    //->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                    ->where('service_request.dcs_status','=','Approved')
                    ->whereRaw("FIND_IN_SET({$emp_code},users)")
                    ->orderby('created_at','DESC')->get();
            }
        }


        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                if ($table->work_orderno != Null) {
                    if (request()->session()->get('user')['section_id'] == '9') {

                        if (request()->session()->get('user')['role_id'] == '2') {


                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/store-assign') . "/" . "$table->id" . '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                        } else {
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/store-assign') . "/" . "$table->id" . '">Edit</a>
                                          
                                                
                                            </div>
                                        </div>';
                        }
                    }

                    return $btns;
                }
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function storeAssign($id)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $pdiadd = Service::find($id);

        $missingpart = MasterMissingdamagePartDis::where('service_request_id','=',$id)->get()->toArray();



        $customer = Service::select('gw_master_customer.name')
            ->join('gw_master_customer','gw_master_customer.id','=','service_request.customer')
            ->where('service_request.id','=',$id)
            ->get()->toArray();

        $model = Service::select('gw_master_mc_model.model_no')
            ->join('gw_master_mc_model','gw_master_mc_model.id','=','service_request.machine_modelno')
            ->where('service_request.id','=',$id)
            ->get()->toArray();

        $serial = Service::select('gw_master_comp_details.comp_serial_no')
            ->join('gw_master_comp_details','gw_master_comp_details.id','=','service_request.component_serial_no')
            ->where('service_request.id','=',$id)
            ->get()->toArray();


        return view('admin.include.storeStatus')
            ->with('customer', $customer)
            ->with('model', $model)
            ->with('serial', $serial)
            ->with('missingpart', $missingpart)
            ->with('pdiadd', $pdiadd);


    }

    public function storeStatusSave(Request $request)

    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $morAddSave = $request->all();
        $location=$data['user']['location_id'];
        $obj = Service::find($request['service_id']);

        $obj->store_status= $request['store_status'];
        $obj->store_comment= $request['store_comment'];
        $obj->store_actual_start_date= Carbon::createFromFormat('d/m/Y', $request['store_actual_start_date'])->format('Y-m-d');
        $obj->store_actual_end_date= date("Y-m-d");
        $obj->save();

       $status="Store Status Submitted";
        $adminstatus= UserHelper::adminstatus($request['service_id'],$status);

        /*$missingpart = MasterMissingdamagePartDis::where('service_request_id','=',$request['service_id'])->get()->toArray();
        

        //$file=$request['status'];
      


      /* if(isset($obj->id)) {
           foreach ($file as $key => $val) {

               $txt = $val;


               //echo '<pre>';   print_r($request['status'][$key]);

               DB::statement("UPDATE gw_master_disa_missing_damaged_part SET status = '".$request['status'][$key]."' where service_request_id = '". $request['service_id']."' AND dept_id = '".$request['dept_id'][$key]."' AND part_no = '".$request['part_no'][$key]."'");

               

           }

       }*/
       
//       $myrequest=$request->all();
//        dd($myrequest);

        $sec=26;

        $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['service_id'],$sec,$obj->store_actual_start_date, $obj->store_actual_end_date);


        return redirect('admin/store-assign/'.$request['service_id']);

    }








    //super admin
    public function checkSheetEntryCommonold($id)
    {
        $data = Session::all();


        $service = Service::find($id);
        if(!empty($service)){
            $route_check =  request()->segment(2);
            if($route_check == 'check-sheet-entry-common'){
                $dept_id=$data['user']['section_id'];
                $disassembly_status = 1;
                $agrregate=MasterAggregate::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $prehist=MasterPreHistoryDis::where('service_request_id','=',$service->id)
                    //->where('disassembly_status','=',$disassembly_status)
                    //->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showrejectcom =ChecksheetStatus::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $commercialLogistic=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalcommercialLog=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $externalWash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalexterwash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $partsClean=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalpartcln=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $beforestartccassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $ccbeforestartassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cominspecreport=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $cccompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalinsprpt=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showtransmission=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaltrans=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showloosepat_1=MasterLoosepartDis::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showmissing_1=MasterMissingdamagePartDis::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblklinear=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkliner=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcycap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcyCap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcrankshaft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcranksft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcamshaft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showlhcamshaft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvallLhcamsft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrhcamshaft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrLhcamsft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrhcambush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsftbush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cylinder=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderheadoil=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showothercomp=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalothercom=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfandrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvfanaldrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showoilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaloilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfailed_1=MasterFailedParts::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showsalvage_1=MasterListofSalvageDis::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluthick_1=ClutchPackThicknessValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplatethi_1=ClutchPlateThicknessValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplateflt_1=ClutchPlateFlatnessValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showtorque_1=TorqueConverterValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspec_1=RoolerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspcend_1=RoolerSpecifiEndColValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrollclr_1=RollerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerpec_1=IdlerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesbef_1=IdlerMeasuredBeforeValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesaft_1=IdlerMeasuredAfterValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerspend_1=IdlerSpeciEndcolerValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidleclr_1=IdlerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();



            }
            else{
                $dept_id=1;
                $assembly_status = 1;
                $agrregate=MasterAggregate::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $prehist=MasterPreHistoryDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showrejectcom =ChecksheetStatus::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $commercialLogistic=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcommercialLog=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $externalWash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalexterwash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $partsClean=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalpartcln=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $beforestartccassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $ccbeforestartassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();


                $cominspecreport=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cccompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalinsprpt=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showtransmission=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaltrans=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showloosepat_1=MasterLoosepartDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showmissing_1=MasterMissingdamagePartDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblklinear=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkliner=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcycap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcyCap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcrankshaft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcranksft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcamshaft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showlhcamshaft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvallLhcamsft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();


                $showrhcamshaft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrLhcamsft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrhcambush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsftbush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cylinder=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderheadoil=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showothercomp=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalothercom=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfandrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvfanaldrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showoilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaloilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfailed_1=MasterFailedParts::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showsalvage_1=MasterListofSalvageDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluthick_1=ClutchPackThicknessValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplatethi_1=ClutchPlateThicknessValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplateflt_1=ClutchPlateFlatnessValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showtorque_1=TorqueConverterValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspec_1=RoolerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspcend_1=RoolerSpecifiEndColValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrollclr_1=RollerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerpec_1=IdlerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesbef_1=IdlerMeasuredBeforeValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesaft_1=IdlerMeasuredAfterValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerspend_1=IdlerSpeciEndcolerValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidleclr_1=IdlerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();


            }

            //aggregation show


            $mcModel=MasterMCModel::find($service->machine_modelno);

            $mcSerial = Service::select('service_request.id','machine_serialno', 'gw_master_machine_serial_no.serial_no')
                ->leftjoin('gw_master_machine_serial_no','gw_master_machine_serial_no.id', '=', 'service_request.machine_serialno')
                ->where('service_request.id', '=' ,$id)->get();
            $componentSerial=MasterComponentDetails::find($service->comp_model_no);


            //prehistory show

            if(isset($prehist->id)) {
                $machSerial=MasterMCSerialNumber::find($service->machine_serialno);
                $comSerial=MasterComponentDetails::find($service->component_serial_no);

            }
            else{
                $machSerial=Null;
                $comSerial=Null;
            }

            //Commercial and logistics


            if(isset($commercialLogistic->id)){
                $commercialLogistic=json_decode($commercialLogistic->values);
            }else{
                $commercialLogistic=Null;
            }

            //ccinspection after external wash

            if(isset($externalWash->id)){
                $externalWash=json_decode($externalWash->values);
            }else{
                $externalWash=Null;
            }

            //before start assembly


            if(isset($beforestartccassembly->id)){
                $beforestartccassembly=json_decode($beforestartccassembly->ccvalues);
            }else{
                $beforestartccassembly=Null;
            }


            //Conrod After Bush Replacement



            if(isset($showconrodbush->id)){
                $showconrodbush=json_decode($showconrodbush->values);
            }else{
                $showconrodbush=Null;
            }

         //Component Inspection report

            if(isset( $cominspecreport->id)){
                $cominspecreport=json_decode( $cominspecreport->ccvalues);
            }else{
                $cominspecreport=Null;
            }


            //cc inspection after parts clean

            if(isset($partsClean->id)){
                $partsClean=json_decode($partsClean->values);
            }else{
                $partsClean=Null;
            }



            //partsinspection cylinder head


            if(isset($cylinder->id)){
                $cylinder=json_decode($cylinder->details);
            }else{
                $cylinder=Null;
            }




            //parts inspection cooler insp


            if(isset($showcooler->id)){
                $showcooler=json_decode($showcooler->values);
            }else{
                $showcooler=Null;
            }




            //partinspection other component


            if(isset($showothercomp->id)){
                $showothercomp=json_decode($showothercomp->values);
            }else{
                $showothercomp=Null;
            }



            //transmisssion component

            if(isset($showtransmission->id)){
                $showtransmission=json_decode($showtransmission->values);
            }else{
                $showtransmission=Null;
            }





            // commponent inspection report

            if(isset($showcompinsp->id)){
                $showcompinsp=json_decode($showcompinsp->ccvalues);
            }else{
                $showcompinsp=Null;
            }

           /* */


            //parts rooler measured

            if(isset($showrolmea->id)){
                $showrolmea=json_decode($showrolmea->values);
            }else{
                $showrolmea=Null;
            }



            //partsinspection connecting rod

            if(isset($showconrod->id)){
                $showconrod=json_decode($showconrod->values);
            }else{
                $showconrod=Null;
            }



            //partinspection cylinder block

            if(isset($showcylinderblock->id)){
                $showcylinderblock=json_decode($showcylinderblock->values);
            }else{
                $showcylinderblock=Null;
            }
            //$var = $showcylinderblock->frontcenter;
            if(isset($showcylinderblock->frontcenter)){
                $myArray = json_decode(json_encode($showcylinderblock->frontcenter), true);
            }
            else{
                $myArray=Null;
            }
            if(isset($showcylinderblock->frontresult)) {
                $frntreslt = json_decode(json_encode($showcylinderblock->frontresult), true);
            }else{
                $frntreslt=Null;
            }
            if(isset($showcylinderblock->mainfrontremarks)) {
                $frtmainrst = json_decode(json_encode($showcylinderblock->mainfrontremarks), true);
            }else{
                $frtmainrst=Null;
            }
            if(isset($showcylinderblock->centerresult)) {
                $rearcenteryes = json_decode(json_encode($showcylinderblock->centerresult), true);
            }else{
                $rearcenteryes=Null;
            }
            if(isset($showcylinderblock->rearresults)) {
                $rearresyes = json_decode(json_encode($showcylinderblock->rearresults), true);
            }else{
                $rearresyes=Null;
            }
            if(isset($showcylinderblock->rearresults)) {
                $rearremaryes = json_decode(json_encode($showcylinderblock->mainrearremarks), true);
            }else{
                $rearremaryes=Null;
            }


            //partinspection cylinder block linear

            if(isset($showcylblklinear->id)){
                $showcylblklinear=json_decode($showcylblklinear->values);
            }else{
                $showcylblklinear=Null;
            }

            if(isset($showcylblklinear->frontcenter)){
                $linArray = json_decode(json_encode($showcylblklinear->frontcenter), true);
            }
            else{
                $linArray=Null;
            }
            if(isset($showcylblklinear->frontresult)) {
                $linfrntreslt = json_decode(json_encode($showcylblklinear->frontresult), true);
            }else{
                $linfrntreslt=Null;
            }
            if(isset($showcylblklinear->mainfrontremarks)) {
                $linfrtmainrst = json_decode(json_encode($showcylblklinear->mainfrontremarks), true);
            }else{
                $linfrtmainrst=Null;
            }
            if(isset($showcylblklinear->centerresult)) {
                $linrearcenteryes = json_decode(json_encode($showcylblklinear->centerresult), true);
            }else{
                $linrearcenteryes=Null;
            }
            if(isset($showcylblklinear->rearresults)) {
                $linrearresyes = json_decode(json_encode($showcylblklinear->rearresults), true);
            }else{
                $linrearresyes=Null;
            }
            if(isset($showcylblklinear->rearresults)) {
                $linrearremaryes = json_decode(json_encode($showcylblklinear->mainrearremarks), true);
            }else{
                $linrearremaryes=Null;
            }



            //partinspection cylinder block cam bore

            if(isset($showcylblkcam->id)){
                $showcylblkcam=json_decode($showcylblkcam->values);
            }else{
                $showcylblkcam=Null;
            }
            if(isset($showcylblkcam->frontcenter)){
                $camArray = json_decode(json_encode($showcylblkcam->frontcenter), true);
            }
            else{
                $camArray=Null;
            }
            if(isset($showcylblkcam->frontresult)) {
                $camfrntreslt = json_decode(json_encode($showcylblkcam->frontresult), true);
            }else{
                $camfrntreslt=Null;
            }
            if(isset($showcylblkcam->mainfrontremarks)) {
                $camfrtmainrst = json_decode(json_encode($showcylblkcam->mainfrontremarks), true);
            }else{
                $camfrtmainrst=Null;
            }
            if(isset($showcylblkcam->centerresult)) {
                $camrearcenteryes = json_decode(json_encode($showcylblkcam->centerresult), true);
            }else{
                $camrearcenteryes=Null;
            }
            if(isset($showcylblkcam->rearresults)) {
                $camrearresyes = json_decode(json_encode($showcylblkcam->rearresults), true);
            }else{
                $camrearresyes=Null;
            }
            if(isset($showcylblkcam->rearresults)) {
                $camrearremaryes = json_decode(json_encode($showcylblkcam->mainrearremarks), true);
            }else{
                $camrearremaryes=Null;
            }




            //parts inspection crankshaft inspection

            if(isset($showcrankshaft->id)){
                $showcrankshaft=json_decode($showcrankshaft->values);
            }else{
                $showcrankshaft=Null;
            }


            //parts inspection camshaft inspection


            if(isset($showcamshaft->id)){
                $showcamshaft=json_decode($showcamshaft->values);
            }else{
                $showcamshaft=Null;
            }



            //parts inspection lh camshaft inspection


            if(isset($showlhcamshaft->id)){
                $showlhcamshaft=json_decode($showlhcamshaft->values);
            }else{
                $showlhcamshaft=Null;
            }



            //parts inspection rh camshaft inspection


            if(isset($showrhcamshaft->id)){
                $showrhcamshaft=json_decode($showrhcamshaft->values);
            }else{
                $showrhcamshaft=Null;
            }


            //parts inspection camshaft bushbore inspection


            if(isset($showrhcambush->id)){
                $showrhcambush=json_decode($showrhcambush->values);
            }else{
                $showrhcambush=Null;
            }



            //missingdamagepart


            if(isset($showmissing_1)){
                $showmissing=$showmissing_1;


            }else{
                $showmissing=Null;

            }
            //status of revision
            $showmissingstatus_1=StatusRevision::where('service_request_id','=',$service->id)
                //->where('dept_id','=',1)
                ->get();

            if(isset($showmissingstatus_1)){
                $showmissingstatus=$showmissingstatus_1;


            }else{
                $showmissingstatus=Null;

            }
            //Assembly checksheet
            /* $showcheckassembly_1=ChecksheetAssembly::where('service_request_id','=',$service->id)
                 //->where('dept_id','=',1)
                 ->get();
             //dd($showcheckassembly_1);exit;
             if(isset($showcheckassembly_1)){
                 $showcheckassembly=$showcheckassembly_1;
                 //dd($showcheckassembly);exit;

             }else{
                 $showcheckassembly=Null;

             }*/

            //disassembly cleaning inspection
            $showdissambly_1=MasterDissamblyCleaningInspection::where('service_request_id','=',$service->id)
                //->where('dept_id','=',1)
                ->get();
            //dd($showdissambly_1);exit;
            if(isset($showdissambly)){
                $showdissambly=$showdissambly_1;
                //dd($showdissambly);exit;

            }else{
                $showdissambly=Null;

            }
            //list of salvage


            //dd($showmissing_1);exit;
            if(isset($showsalvage_1)){
                $showsalvage=$showsalvage_1;
                //dd($showmissing);exit;

            }else{
                $showsalvage=Null;
            }

            //loose parts

            // dd($showloosepat_1);exit;
            if(isset($showloosepat_1)){
                $showloosepat=$showloosepat_1;
                //dd($showmissing);exit;

            }else{
                $showloosepat=Null;
            }

            //Failed Parts


            if(isset($showfailed_1)){
                $showfailed=$showfailed_1;


            }else{
                $showfailed=Null;

            }

            //rooler spe endcol


            if(isset($showrolspcend_1)){
                $showrolspcend=$showrolspcend_1;


            }else{
                $showrolspcend=Null;

            }


            //parts rooler specification

            if(isset($showrolspec_1)){
                $showrolspec=$showrolspec_1;


            }else{
                $showrolspec=Null;

            }

            //parts idler specification


            if(isset($showidlerpec_1)){
                $showidlerpec=$showidlerpec_1;


            }else{
                $showidlerpec=Null;

            }

            //parts idler measured before


            if(isset($showidlermesbef_1)){
                $showidlermesbef=$showidlermesbef_1;


            }else{
                $showidlermesbef=Null;

            }

            //parts idler measured after


            if(isset($showidlermesaft_1)){
                $showidlermesaft=$showidlermesaft_1;


            }else{
                $showidlermesaft=Null;

            }

            //parts clutch pack thickness


            if(isset($showcluthick_1)){
                $showcluthick=$showcluthick_1;


            }else{
                $showcluthick=Null;

            }

            //parts clutch plate thickness



            if(isset($showcluplatethi_1)){
                $showcluplatethi=$showcluplatethi_1;


            }else{
                $showcluplatethi=Null;

            }

            //parts clutch plate flatness


            if(isset($showcluplateflt_1)){
                $showcluplateflt=$showcluplateflt_1;


            }else{
                $showcluplateflt=Null;

            }

            //parts torque converter



            if(isset($showtorque_1)){
                $showtorque=$showtorque_1;


            }else{
                $showtorque=Null;

            }

            //parts idler spec endcol



            if(isset($showidlerspend_1)){
                $showidlerspend=$showidlerspend_1;


            }else{
                $showidlerspend=Null;

            }

            //parts idler clear shaft



            if(isset($showidleclr_1)){
                $showidleclr=$showidleclr_1;


            }else{
                $showidleclr=Null;

            }

            //parts roller clear shaft



            if(isset($showrollclr_1)){
                $showrollclr=$showrollclr_1;


            }else{
                $showrollclr=Null;

            }

            //Parts Fan Drive

            if(isset($showfandrive->id)){
                $showfandrive=json_decode($showfandrive->values);
            }else{
                $showfandrive=Null;
            }



            //Parts Oil Pump

            if(isset($showoilpump->id)){
                $showoilpump=json_decode($showoilpump->values);
            }else{
                $showoilpump=Null;
            }



            //air compressor

            if(isset($showaircomp->id)){
                $showaircomp=json_decode($showaircomp->values);
            }else{
                $showaircomp=Null;
            }



            //water pump

            if(isset($showwaterpump->id)){
                $showwaterpump=json_decode($showwaterpump->values);
            }else{
                $showwaterpump=Null;
            }



            //cylinder block top deck

            if(isset($showcytopdk->id)){
                $showcytopdk=json_decode($showcytopdk->values);
            }else{
                $showcytopdk=Null;
            }



            //cylinder block thread

            if(isset($showcythread->id)){
                $showcythread=json_decode($showcythread->values);
            }else{
                $showcythread=Null;
            }



            //cylinder block bush bore

            if(isset($showcybush->id)){
                $showcybush=json_decode($showcybush->values);
            }else{
                $showcybush=Null;
            }


            //cylinder block Cap no

            if(isset($showcycap->id)){
                $showcycap=json_decode($showcycap->values);
            }else{
                $showcycap=Null;
            }



            return view('admin.include.checksheetCommon')
                ->with('service',$service)
                ->with('agrregate', $agrregate)
                ->with('mcModel', $mcModel)
                ->with('mcSerial', $mcSerial)
                ->with('componentSerial', $componentSerial)
                ->with('commercialLogistic',$commercialLogistic)
                ->with('prehist',$prehist)
                ->with('machSerial',$machSerial)
                ->with('comSerial',$comSerial)
                ->with('externalWash',$externalWash)
                ->with('partsClean',$partsClean)
                ->with('cylinder',$cylinder)
                ->with('showothercomp',$showothercomp)
                ->with('myArray',$myArray)
                ->with('showconrod',$showconrod)
                ->with('showconrodbush',$showconrodbush)
                ->with('frntreslt',$frntreslt)
                ->with('frtmainrst',$frtmainrst)
                ->with('rearcenteryes',$rearcenteryes)
                ->with('rearresyes',$rearresyes)
                ->with('rearremaryes',$rearremaryes)
                ->with('showcrankshaft',$showcrankshaft)
                ->with('showcamshaft',$showcamshaft)
                ->with('showcylinderblock',$showcylinderblock)
                ->with('showmissing',$showmissing)
                ->with('showoilpump',$showoilpump)
                ->with('showaircomp',$showaircomp)
                ->with('showsalvage',$showsalvage)
                ->with('showcooler',$showcooler)
                ->with('showloosepat',$showloosepat)
                ->with('showfailed',$showfailed)
                ->with('showfandrive',$showfandrive)
                ->with('showwaterpump',$showwaterpump)
                ->with('showcompinsp',$showcompinsp)
                ->with('showcluthick',$showcluthick)
                ->with('allvalcommercialLog',$allvalcommercialLog)
                ->with('allvalexterwash',$allvalexterwash)
                ->with('allvalpartcln',$allvalpartcln)
                ->with('allvalconrod',$allvalconrod)
                ->with('allvaloilpump',$allvaloilpump)
                ->with('allvalcylinderblock',$allvalcylinderblock)
                ->with('allvalcranksft',$allvalcranksft)
                ->with('allvalcamsft',$allvalcamsft)
                ->with('allvalothercom',$allvalothercom)
                ->with('allvalinsprpt',$allvalinsprpt)
                ->with('allvalcooler',$allvalcooler)
                ->with('allvalconrodbush',$allvalconrodbush)
                //->with('allvalfandrive',$allvalfandrive)
                ->with('allvalaircomp',$allvalaircomp)
                ->with('allvalwaterpump',$allvalwaterpump)
                ->with('showrejectcom',$showrejectcom)
                ->with('showmissingstatus',$showmissingstatus)
                //->with('showcheckassembly', $showcheckassembly)
                ->with('showdissambly',$showdissambly)
                //->with('beforestart',$beforestart)
                ->with('beforestartccassembly', $beforestartccassembly)
                ->with('allvalcylinderheadoil',$allvalcylinderheadoil)
                ->with('cominspecreport',$cominspecreport)
                ->with('showcluplatethi',$showcluplatethi)
                ->with('showcluplateflt',$showcluplateflt)
                ->with('showtorque',$showtorque)
                ->with('showtransmission',$showtransmission)
                ->with('allvaltrans',$allvaltrans)
                ->with('showrolspec',$showrolspec)
                ->with('showrolmea',$showrolmea)
                ->with('showidlerpec',$showidlerpec)
                ->with('allvalrolmea',$allvalrolmea)
                ->with('showrolspcend',$showrolspcend)
                ->with('showidlermesbef',$showidlermesbef)
                ->with('showidlermesaft',$showidlermesaft)
                ->with('showidlerspend',$showidlerspend)
                ->with('showidleclr',$showidleclr)
                ->with('showrollclr',$showrollclr)
                ->with('showlhcamshaft',$showlhcamshaft)
                ->with('showrhcamshaft',$showrhcamshaft)
                ->with('showrhcambush',$showrhcambush)
                ->with('allvallLhcamsft',$allvallLhcamsft)
                ->with('allvalrLhcamsft',$allvalrLhcamsft)
                ->with('allvalcamsftbush',$allvalcamsftbush)
                ->with('showcylblklinear',$showcylblklinear)
                ->with('allvalcylblkliner',$allvalcylblkliner)
                ->with('showcylblkcam',$showcylblkcam)
                ->with('allvalcylblkcam',$allvalcylblkcam)
                ->with('linArray',$linArray)
                ->with('linfrntreslt',$linfrntreslt)
                ->with('linfrtmainrst',$linfrtmainrst)
                ->with('linrearcenteryes',$linrearcenteryes)
                ->with('linrearresyes',$linrearresyes)
                ->with('linrearremaryes',$linrearremaryes)
                ->with('camArray',$camArray)
                ->with('camfrntreslt',$camfrntreslt)
                ->with('camfrtmainrst',$camfrtmainrst)
                ->with('camrearcenteryes',$camrearcenteryes)
                ->with('camrearresyes',$camrearresyes)
                ->with('camrearremaryes',$camrearremaryes)
                ->with('showcytopdk',$showcytopdk)
                ->with('allvalcytopdk',$allvalcytopdk)
                ->with('showcythread',$showcythread)
                ->with('allvalcythread',$allvalcythread)
                ->with('showcybush',$showcybush)
                ->with('allvalcybush',$allvalcybush)
                ->with('allvalcyCap',$allvalcyCap)
                ->with('showcycap',$showcycap)
                ->with('allvfanaldrive',$allvfanaldrive)

                ->with('ccbeforestartassembly',$ccbeforestartassembly)
                ->with('cccompinsp',$cccompinsp);


        }
        else{
            $service=Null;
            $agrregate=Null;
            $mcModel=Null;
            $mcSerial=Null;
            $componentSerial=Null;
            $commercialLogistic=Null;
            $prehist=Null;
            $machSerial=Null;
            $comSerial=Null;
            $externalWash=Null;
            $beforestartccassembly=Null;
            $partsClean=Null;
            $cylinder=Null;
            $showothercomp=Null;
            $myArray=Null;
            $showconrod=Null;
            $showconrodbush=Null;
            $frntreslt=Null;
            $rearcenteryes=Null;
            $rearresyes=Null;
            $rearremaryes=Null;
            $showcrankshaft=Null;
            $showcamshaft=Null;
            $showcylinderblock=Null;
            $frtmainrst=Null;
            $showfandrive=Null;
            $showoilpump=Null;
            $showaircomp=Null;
            $showwaterpump=Null;
            $showcompinsp=Null;
            $beforestartassembly=Null;
            $showcooler=Null;
            $showrolmea=Null;
            $showlhcamshaft=Null;
            $showrhcamshaft=Null;
            $showrhcambush=Null;
            $showcylblklinear=Null;
            $showcylblkcam=Null;
            $linArray=Null;
            $linfrntreslt=Null;
            $linfrtmainrst=Null;
            $linrearcenteryes=Null;
            $linrearresyes=Null;
            $linrearremaryes=Null;
            $camArray=Null;
            $camfrntreslt=Null;
            $camfrtmainrst=Null;
            $camrearcenteryes=Null;
            $camrearresyes=Null;
            $camrearremaryes=Null;
            $showcytopdk=Null;
            $showcythread=Null;
            $showcybush=Null;
            $showcycap=Null;
            $allvalcommercialLog=Null;
            $allvalexterwash=Null;
            $allvalpartcln=Null;
            $allvalinsprpt=Null;
            $allvaltrans=Null;
            $allvalcylinderblock=Null;
            $allvalcylblkcam=Null;
             $allvalcytopdk=Null;
            $allvalcythread=Null;
            $allvalcybush=Null;
            $allvalcyCap=Null;
            $allvalcamsft=Null;
            $allvallLhcamsft=Null;
            $allvalrLhcamsft=Null;
            $allvalcamsftbush=Null;
            $allvalconrod=Null;
            $allvalcylinderheadoil=Null;
            $allvalothercom=Null;
            $allvfanaldrive=Null;
            $allvaloilpump=Null;
            $allvalaircomp=Null;
            $allvalwaterpump=Null;
            $allvalcooler=Null;
            $allvalrolmea=Null;

            return view('admin.include.checksheetCommon')
                ->with('service',$service)
                ->with('agrregate', $agrregate)
                ->with('mcModel', $mcModel)
                ->with('mcSerial', $mcSerial)
                ->with('componentSerial', $componentSerial)
                ->with('commercialLogistic',$commercialLogistic)
                ->with('prehist',$prehist)
                ->with('machSerial',$machSerial)
                ->with('comSerial',$comSerial)
                ->with('externalWash',$externalWash)
                ->with('partsClean',$partsClean)
                ->with('cylinder',$cylinder)
                ->with('showothercomp',$showothercomp)
                ->with('showcompinsp',$showcompinsp)
                ->with('myArray',$myArray)
                ->with('showconrod',$showconrod)
                ->with('showconrodbush',$showconrodbush)
                ->with('showfandrive',$showfandrive)
                ->with('showoilpump',$showoilpump)
                ->with('showaircomp',$showaircomp)
                ->with('showwaterpump',$showwaterpump)
                //->with('showcluthick',$showcluthick)
                ->with('frntreslt',$frntreslt)
                ->with('frtmainrst',$frtmainrst)
                ->with('rearcenteryes',$rearcenteryes)
                ->with('rearresyes',$rearresyes)
                ->with('rearremaryes',$rearremaryes)
                ->with('showcrankshaft',$showcrankshaft)
                ->with('showcamshaft',$showcamshaft)
                ->with('showcooler',$showcooler)
                ->with('showrolmea',$showrolmea)
                ->with('showrhcamshaft',$showrhcamshaft)
                ->with('showrhcambush',$showrhcambush)
                ->with('showcylblklinear',$showcylblklinear)
                ->with('showcylblkcam',$showcylblkcam)
                ->with('linArray',$linArray)
                ->with('linfrntreslt',$linfrntreslt)
                ->with('linfrtmainrst',$linfrtmainrst)
                ->with('linrearcenteryes',$linrearcenteryes)
                ->with('linrearresyes',$linrearresyes)
                ->with('linrearremaryes',$linrearremaryes)
                ->with('camArray',$camArray)
                ->with('camfrntreslt',$camfrntreslt)
                ->with('camfrtmainrst',$camfrtmainrst)
                ->with('camrearcenteryes',$camrearcenteryes)
                ->with('camrearresyes',$camrearresyes)
                ->with('camrearremaryes',$camrearremaryes)
                ->with('showcytopdk',$showcytopdk)
                ->with('showcythread',$showcythread)
                ->with('showcybush',$showcybush)
                ->with('showcycap',$showcycap)
                //->with('showcluplatethi',$showcluplatethi)
                ->with('beforestartassembly',$beforestartassembly)
                ->with('allvalcommercialLog',$allvalcommercialLog)
                ->with('allvalexterwash',$allvalexterwash)
                ->with('allvalpartcln',$allvalpartcln)
                ->with('allvalinsprpt',$allvalinsprpt)
                ->with('allvaltrans',$allvaltrans)
                ->with('allvalcylinderblock',$allvalcylinderblock)
                ->with('allvalcylblkcam',$allvalcylblkcam)
                ->with('allvalcytopdk',$allvalcytopdk)
                ->with('allvalcythread',$allvalcythread)
                ->with('allvalcybush',$allvalcybush)
                ->with('allvalcyCap',$allvalcyCap)
                ->with('allvalcamsft',$allvalcamsft)
                ->with('allvallLhcamsft',$allvallLhcamsft)
                ->with('allvalrLhcamsft',$allvalrLhcamsft)
                ->with('allvalcamsftbush',$allvalcamsftbush)
                ->with('allvalconrod',$allvalconrod)
                ->with('allvalcylinderheadoil',$allvalcylinderheadoil)
                ->with('allvalothercom',$allvalothercom)
                ->with('allvfanaldrive',$allvfanaldrive)
                ->with('allvaloilpump',$allvaloilpump)
                ->with('allvalaircomp',$allvalaircomp)
                ->with('allvalwaterpump',$allvalwaterpump)
                ->with('allvalcooler',$allvalcooler)
                ->with('allvalrolmea',$allvalrolmea)

                ->with('showcylinderblock',$showcylinderblock);



        }



    }
    
    //super admin
    public function checkSheetEntryCommon($id)
    {
        $data = Session::all();


        $service = Service::find($id);
        if(!empty($service)){
            $route_check =  request()->segment(2);
            if($route_check == 'check-sheet-entry-common'){
                $dept_id=$data['user']['section_id'];
                $disassembly_status = 1;
                $agrregate=MasterAggregate::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $prehist=MasterPreHistoryDis::where('service_request_id','=',$service->id)
                    //->where('disassembly_status','=',$disassembly_status)
                    //->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showrejectcom =ChecksheetStatus::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $commercialLogistic=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalcommercialLog=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $externalWash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalexterwash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $partsClean=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalpartcln=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $beforestartccassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $ccbeforestartassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cominspecreport=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $cccompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalinsprpt=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showtransmission=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaltrans=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showloosepat_1=MasterLoosepartDis::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showmissing_1=MasterMissingdamagePartDis::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblklinear=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkliner=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcycap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcyCap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcrankshaft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcranksft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcamshaft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showlhcamshaft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvallLhcamsft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrhcamshaft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrLhcamsft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrhcambush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsftbush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cylinder=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderheadoil=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showothercomp=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalothercom=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfandrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvfanaldrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showoilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaloilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfailed_1=MasterFailedParts::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showsalvage_1=MasterListofSalvageDis::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluthick_1=ClutchPackThicknessValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplatethi_1=ClutchPlateThicknessValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplateflt_1=ClutchPlateFlatnessValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showtorque_1=TorqueConverterValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspec_1=RoolerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspcend_1=RoolerSpecifiEndColValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrollclr_1=RollerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerpec_1=IdlerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesbef_1=IdlerMeasuredBeforeValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesaft_1=IdlerMeasuredAfterValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerspend_1=IdlerSpeciEndcolerValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidleclr_1=IdlerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtracklinkheight_1=PartTrackLinkHeight::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtrackpitch_1=PartTrackPitch::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtracklinkpin_1=PartTrackLinkPin::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtracklinkbush_1=PartTrackLinkBush::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtrackshoe_1=PartTrackShoe::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showpininspmea_1=PartPinInspMea::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showbushinspmea_1=PartBushInspMea::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();


            }
            else{
                $dept_id=1;
                $assembly_status = 1;
                $agrregate=MasterAggregate::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $prehist=MasterPreHistoryDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showrejectcom =ChecksheetStatus::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $commercialLogistic=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcommercialLog=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $externalWash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalexterwash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $partsClean=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalpartcln=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $beforestartccassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $ccbeforestartassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();


                $cominspecreport=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cccompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalinsprpt=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showtransmission=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaltrans=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showloosepat_1=MasterLoosepartDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showmissing_1=MasterMissingdamagePartDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblklinear=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkliner=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcycap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcyCap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcrankshaft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcranksft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcamshaft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showlhcamshaft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvallLhcamsft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();


                $showrhcamshaft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrLhcamsft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrhcambush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsftbush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cylinder=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderheadoil=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showothercomp=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalothercom=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfandrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvfanaldrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showoilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaloilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfailed_1=MasterFailedParts::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showsalvage_1=MasterListofSalvageDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluthick_1=ClutchPackThicknessValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplatethi_1=ClutchPlateThicknessValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplateflt_1=ClutchPlateFlatnessValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showtorque_1=TorqueConverterValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspec_1=RoolerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspcend_1=RoolerSpecifiEndColValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrollclr_1=RollerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerpec_1=IdlerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesbef_1=IdlerMeasuredBeforeValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesaft_1=IdlerMeasuredAfterValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerspend_1=IdlerSpeciEndcolerValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidleclr_1=IdlerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtracklinkheight_1=PartTrackLinkHeight::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtrackpitch_1=PartTrackPitch::where('service_request_id','=',$service->id)
                     ->where('assembly_status','=',$assembly_status)
                     ->where('dept_id','=',$dept_id)
                     ->get();
                $showtracklinkpin_1=PartTrackLinkPin::where('service_request_id','=',$service->id)
                        ->where('assembly_status','=',$assembly_status)
                        ->where('dept_id','=',$dept_id)
                        ->get();
                $showtracklinkbush_1=PartTrackLinkBush::where('service_request_id','=',$service->id)
                        ->where('assembly_status','=',$assembly_status)
                        ->where('dept_id','=',$dept_id)
                        ->get();
                $showtrackshoe_1=PartTrackShoe::where('service_request_id','=',$service->id)
                        ->where('assembly_status','=',$assembly_status)
                        ->where('dept_id','=',$dept_id)
                        ->get();
                $showpininspmea_1=PartPinInspMea::where('service_request_id','=',$service->id)
                        ->where('assembly_status','=',$assembly_status)
                        ->where('dept_id','=',$dept_id)
                        ->get();
                    $showbushinspmea_1=PartBushInspMea::where('service_request_id','=',$service->id)
                        ->where('assembly_status','=',$assembly_status)
                        ->where('dept_id','=',$dept_id)
                        ->get();
            }

            //aggregation show


            $mcModel=MasterMCModel::find($service->machine_modelno);

            $mcSerial = Service::select('service_request.id','machine_serialno', 'gw_master_machine_serial_no.serial_no')
                ->leftjoin('gw_master_machine_serial_no','gw_master_machine_serial_no.id', '=', 'service_request.machine_serialno')
                ->where('service_request.id', '=' ,$id)->get();
            $componentSerial=MasterComponentDetails::find($service->comp_model_no);


            //prehistory show

            if(isset($prehist->id)) {
                $machSerial=MasterMCSerialNumber::find($service->machine_serialno);
                $comSerial=MasterComponentDetails::find($service->component_serial_no);

            }
            else{
                $machSerial=Null;
                $comSerial=Null;
            }

            //Commercial and logistics


            if(isset($commercialLogistic->id)){
                $commercialLogistic=json_decode($commercialLogistic->values);
            }else{
                $commercialLogistic=Null;
            }

            //ccinspection after external wash

            if(isset($externalWash->id)){
                $externalWash=json_decode($externalWash->values);
            }else{
                $externalWash=Null;
            }

            //before start assembly


            if(isset($beforestartccassembly->id)){
                $beforestartccassembly=json_decode($beforestartccassembly->ccvalues);
            }else{
                $beforestartccassembly=Null;
            }


            //Conrod After Bush Replacement



            if(isset($showconrodbush->id)){
                $showconrodbush=json_decode($showconrodbush->values);
            }else{
                $showconrodbush=Null;
            }

         //Component Inspection report

            if(isset( $cominspecreport->id)){
                $cominspecreport=json_decode( $cominspecreport->ccvalues);
            }else{
                $cominspecreport=Null;
            }


            //cc inspection after parts clean

            if(isset($partsClean->id)){
                $partsClean=json_decode($partsClean->values);
            }else{
                $partsClean=Null;
            }



            //partsinspection cylinder head


            if(isset($cylinder->id)){
                $cylinder=json_decode($cylinder->details);
            }else{
                $cylinder=Null;
            }




            //parts inspection cooler insp


            if(isset($showcooler->id)){
                $showcooler=json_decode($showcooler->values);
            }else{
                $showcooler=Null;
            }




            //partinspection other component


            if(isset($showothercomp->id)){
                $showothercomp=json_decode($showothercomp->values);
            }else{
                $showothercomp=Null;
            }



            //transmisssion component

            if(isset($showtransmission->id)){
                $showtransmission=json_decode($showtransmission->values);
            }else{
                $showtransmission=Null;
            }





            // commponent inspection report

            if(isset($showcompinsp->id)){
                $showcompinsp=json_decode($showcompinsp->ccvalues);
            }else{
                $showcompinsp=Null;
            }

           /* */


            //parts rooler measured

            if(isset($showrolmea->id)){
                $showrolmea=json_decode($showrolmea->values);
            }else{
                $showrolmea=Null;
            }



            //partsinspection connecting rod

            if(isset($showconrod->id)){
                $showconrod=json_decode($showconrod->values);
            }else{
                $showconrod=Null;
            }



            //partinspection cylinder block

            if(isset($showcylinderblock->id)){
                $showcylinderblock=json_decode($showcylinderblock->values);
            }else{
                $showcylinderblock=Null;
            }
            //$var = $showcylinderblock->frontcenter;
            if(isset($showcylinderblock->frontcenter)){
                $myArray = json_decode(json_encode($showcylinderblock->frontcenter), true);
            }
            else{
                $myArray=Null;
            }
            if(isset($showcylinderblock->frontresult)) {
                $frntreslt = json_decode(json_encode($showcylinderblock->frontresult), true);
            }else{
                $frntreslt=Null;
            }
            if(isset($showcylinderblock->mainfrontremarks)) {
                $frtmainrst = json_decode(json_encode($showcylinderblock->mainfrontremarks), true);
            }else{
                $frtmainrst=Null;
            }
            if(isset($showcylinderblock->centerresult)) {
                $rearcenteryes = json_decode(json_encode($showcylinderblock->centerresult), true);
            }else{
                $rearcenteryes=Null;
            }
            if(isset($showcylinderblock->rearresults)) {
                $rearresyes = json_decode(json_encode($showcylinderblock->rearresults), true);
            }else{
                $rearresyes=Null;
            }
            if(isset($showcylinderblock->rearresults)) {
                $rearremaryes = json_decode(json_encode($showcylinderblock->mainrearremarks), true);
            }else{
                $rearremaryes=Null;
            }


            //partinspection cylinder block linear

            if(isset($showcylblklinear->id)){
                $showcylblklinear=json_decode($showcylblklinear->values);
            }else{
                $showcylblklinear=Null;
            }

            if(isset($showcylblklinear->frontcenter)){
                $linArray = json_decode(json_encode($showcylblklinear->frontcenter), true);
            }
            else{
                $linArray=Null;
            }
            if(isset($showcylblklinear->frontresult)) {
                $linfrntreslt = json_decode(json_encode($showcylblklinear->frontresult), true);
            }else{
                $linfrntreslt=Null;
            }
            if(isset($showcylblklinear->mainfrontremarks)) {
                $linfrtmainrst = json_decode(json_encode($showcylblklinear->mainfrontremarks), true);
            }else{
                $linfrtmainrst=Null;
            }
            if(isset($showcylblklinear->centerresult)) {
                $linrearcenteryes = json_decode(json_encode($showcylblklinear->centerresult), true);
            }else{
                $linrearcenteryes=Null;
            }
            if(isset($showcylblklinear->rearresults)) {
                $linrearresyes = json_decode(json_encode($showcylblklinear->rearresults), true);
            }else{
                $linrearresyes=Null;
            }
            if(isset($showcylblklinear->rearresults)) {
                $linrearremaryes = json_decode(json_encode($showcylblklinear->mainrearremarks), true);
            }else{
                $linrearremaryes=Null;
            }



            //partinspection cylinder block cam bore

            if(isset($showcylblkcam->id)){
                $showcylblkcam=json_decode($showcylblkcam->values);
            }else{
                $showcylblkcam=Null;
            }
            if(isset($showcylblkcam->frontcenter)){
                $camArray = json_decode(json_encode($showcylblkcam->frontcenter), true);
            }
            else{
                $camArray=Null;
            }
            if(isset($showcylblkcam->frontresult)) {
                $camfrntreslt = json_decode(json_encode($showcylblkcam->frontresult), true);
            }else{
                $camfrntreslt=Null;
            }
            if(isset($showcylblkcam->mainfrontremarks)) {
                $camfrtmainrst = json_decode(json_encode($showcylblkcam->mainfrontremarks), true);
            }else{
                $camfrtmainrst=Null;
            }
            if(isset($showcylblkcam->centerresult)) {
                $camrearcenteryes = json_decode(json_encode($showcylblkcam->centerresult), true);
            }else{
                $camrearcenteryes=Null;
            }
            if(isset($showcylblkcam->rearresults)) {
                $camrearresyes = json_decode(json_encode($showcylblkcam->rearresults), true);
            }else{
                $camrearresyes=Null;
            }
            if(isset($showcylblkcam->rearresults)) {
                $camrearremaryes = json_decode(json_encode($showcylblkcam->mainrearremarks), true);
            }else{
                $camrearremaryes=Null;
            }




            //parts inspection crankshaft inspection

            if(isset($showcrankshaft->id)){
                $showcrankshaft=json_decode($showcrankshaft->values);
            }else{
                $showcrankshaft=Null;
            }


            //parts inspection camshaft inspection


            if(isset($showcamshaft->id)){
                $showcamshaft=json_decode($showcamshaft->values);
            }else{
                $showcamshaft=Null;
            }



            //parts inspection lh camshaft inspection


            if(isset($showlhcamshaft->id)){
                $showlhcamshaft=json_decode($showlhcamshaft->values);
            }else{
                $showlhcamshaft=Null;
            }



            //parts inspection rh camshaft inspection


            if(isset($showrhcamshaft->id)){
                $showrhcamshaft=json_decode($showrhcamshaft->values);
            }else{
                $showrhcamshaft=Null;
            }


            //parts inspection camshaft bushbore inspection


            if(isset($showrhcambush->id)){
                $showrhcambush=json_decode($showrhcambush->values);
            }else{
                $showrhcambush=Null;
            }



            //missingdamagepart


            if(isset($showmissing_1)){
                $showmissing=$showmissing_1;


            }else{
                $showmissing=Null;

            }
            //status of revision
            $showmissingstatus_1=StatusRevision::where('service_request_id','=',$service->id)
                //->where('dept_id','=',1)
                ->get();

            if(isset($showmissingstatus_1)){
                $showmissingstatus=$showmissingstatus_1;


            }else{
                $showmissingstatus=Null;

            }
            //Assembly checksheet
            /* $showcheckassembly_1=ChecksheetAssembly::where('service_request_id','=',$service->id)
                 //->where('dept_id','=',1)
                 ->get();
             //dd($showcheckassembly_1);exit;
             if(isset($showcheckassembly_1)){
                 $showcheckassembly=$showcheckassembly_1;
                 //dd($showcheckassembly);exit;

             }else{
                 $showcheckassembly=Null;

             }*/

            //disassembly cleaning inspection
            $showdissambly_1=MasterDissamblyCleaningInspection::where('service_request_id','=',$service->id)
                //->where('dept_id','=',1)
                ->get();
            //dd($showdissambly_1);exit;
            if(isset($showdissambly)){
                $showdissambly=$showdissambly_1;
                //dd($showdissambly);exit;

            }else{
                $showdissambly=Null;

            }
            //list of salvage


            //dd($showmissing_1);exit;
            if(isset($showsalvage_1)){
                $showsalvage=$showsalvage_1;
                //dd($showmissing);exit;

            }else{
                $showsalvage=Null;
            }

            //loose parts

            // dd($showloosepat_1);exit;
            if(isset($showloosepat_1)){
                $showloosepat=$showloosepat_1;
                //dd($showmissing);exit;

            }else{
                $showloosepat=Null;
            }

            //Failed Parts


            if(isset($showfailed_1)){
                $showfailed=$showfailed_1;


            }else{
                $showfailed=Null;

            }

            //rooler spe endcol


            if(isset($showrolspcend_1)){
                $showrolspcend=$showrolspcend_1;


            }else{
                $showrolspcend=Null;

            }


            //parts rooler specification

            if(isset($showrolspec_1)){
                $showrolspec=$showrolspec_1;


            }else{
                $showrolspec=Null;

            }

            //parts idler specification


            if(isset($showidlerpec_1)){
                $showidlerpec=$showidlerpec_1;


            }else{
                $showidlerpec=Null;

            }

            //parts idler measured before


            if(isset($showidlermesbef_1)){
                $showidlermesbef=$showidlermesbef_1;


            }else{
                $showidlermesbef=Null;

            }

            //parts idler measured after


            if(isset($showidlermesaft_1)){
                $showidlermesaft=$showidlermesaft_1;


            }else{
                $showidlermesaft=Null;

            }

            //parts clutch pack thickness


            if(isset($showcluthick_1)){
                $showcluthick=$showcluthick_1;


            }else{
                $showcluthick=Null;

            }

            //parts clutch plate thickness



            if(isset($showcluplatethi_1)){
                $showcluplatethi=$showcluplatethi_1;


            }else{
                $showcluplatethi=Null;

            }

            //parts clutch plate flatness


            if(isset($showcluplateflt_1)){
                $showcluplateflt=$showcluplateflt_1;


            }else{
                $showcluplateflt=Null;

            }

            //parts torque converter



            if(isset($showtorque_1)){
                $showtorque=$showtorque_1;


            }else{
                $showtorque=Null;

            }

            //parts idler spec endcol



            if(isset($showidlerspend_1)){
                $showidlerspend=$showidlerspend_1;


            }else{
                $showidlerspend=Null;

            }

            //parts track link height
            if(isset($showtracklinkheight_1)){
                $showtracklinkheight=$showtracklinkheight_1;


            }else{
                $showtracklinkheight=Null;

            }
                // parts track pitch
            if(isset($showtrackpitch_1)){
                $showtrackpitch=$showtrackpitch_1;


            }else{
                $showtrackpitch=Null;

            }
                // parts track link pin
            if(isset($showtracklinkpin_1)){
                $showtracklinkpin=$showtracklinkpin_1;


            }else{
                $showtracklinkpin=Null;

            }
                //parts track link bush
            if(isset($showtracklinkbush_1)){
                $showtracklinkbush=$showtracklinkbush_1;


            }else{
                $showtracklinkbush=Null;

            }
                //parts track shoe
            if(isset($showtrackshoe_1)){
                $showtrackshoe=$showtrackshoe_1;


            }else{
                $showtrackshoe=Null;

            }
                //parts pin insp mea
            if(isset($showpininspmea_1)){
                $showpininspmea=$showpininspmea_1;


            }else{
                $showpininspmea=Null;

            }
                //parts bush insp mea
            if(isset($showbushinspmea_1)){
                $showbushinspmea=$showbushinspmea_1;


            }else{
                $showbushinspmea=Null;

            }
            //parts idler clear shaft



            if(isset($showidleclr_1)){
                $showidleclr=$showidleclr_1;


            }else{
                $showidleclr=Null;

            }

            //parts roller clear shaft



            if(isset($showrollclr_1)){
                $showrollclr=$showrollclr_1;


            }else{
                $showrollclr=Null;

            }

            //Parts Fan Drive

            if(isset($showfandrive->id)){
                $showfandrive=json_decode($showfandrive->values);
            }else{
                $showfandrive=Null;
            }



            //Parts Oil Pump

            if(isset($showoilpump->id)){
                $showoilpump=json_decode($showoilpump->values);
            }else{
                $showoilpump=Null;
            }



            //air compressor

            if(isset($showaircomp->id)){
                $showaircomp=json_decode($showaircomp->values);
            }else{
                $showaircomp=Null;
            }



            //water pump

            if(isset($showwaterpump->id)){
                $showwaterpump=json_decode($showwaterpump->values);
            }else{
                $showwaterpump=Null;
            }



            //cylinder block top deck

            if(isset($showcytopdk->id)){
                $showcytopdk=json_decode($showcytopdk->values);
            }else{
                $showcytopdk=Null;
            }



            //cylinder block thread

            if(isset($showcythread->id)){
                $showcythread=json_decode($showcythread->values);
            }else{
                $showcythread=Null;
            }



            //cylinder block bush bore

            if(isset($showcybush->id)){
                $showcybush=json_decode($showcybush->values);
            }else{
                $showcybush=Null;
            }


            //cylinder block Cap no

            if(isset($showcycap->id)){
                $showcycap=json_decode($showcycap->values);
            }else{
                $showcycap=Null;
            }



            return view('admin.include.checksheetCommon')
                ->with('service',$service)
                ->with('agrregate', $agrregate)
                ->with('mcModel', $mcModel)
                ->with('mcSerial', $mcSerial)
                ->with('componentSerial', $componentSerial)
                ->with('commercialLogistic',$commercialLogistic)
                ->with('prehist',$prehist)
                ->with('machSerial',$machSerial)
                ->with('comSerial',$comSerial)
                ->with('externalWash',$externalWash)
                ->with('partsClean',$partsClean)
                ->with('cylinder',$cylinder)
                ->with('showothercomp',$showothercomp)
                ->with('myArray',$myArray)
                ->with('showconrod',$showconrod)
                ->with('showconrodbush',$showconrodbush)
                ->with('frntreslt',$frntreslt)
                ->with('frtmainrst',$frtmainrst)
                ->with('rearcenteryes',$rearcenteryes)
                ->with('rearresyes',$rearresyes)
                ->with('rearremaryes',$rearremaryes)
                ->with('showcrankshaft',$showcrankshaft)
                ->with('showcamshaft',$showcamshaft)
                ->with('showcylinderblock',$showcylinderblock)
                ->with('showmissing',$showmissing)
                ->with('showoilpump',$showoilpump)
                ->with('showaircomp',$showaircomp)
                ->with('showsalvage',$showsalvage)
                ->with('showcooler',$showcooler)
                ->with('showloosepat',$showloosepat)
                ->with('showfailed',$showfailed)
                ->with('showfandrive',$showfandrive)
                ->with('showwaterpump',$showwaterpump)
                ->with('showcompinsp',$showcompinsp)
                ->with('showcluthick',$showcluthick)
                ->with('allvalcommercialLog',$allvalcommercialLog)
                ->with('allvalexterwash',$allvalexterwash)
                ->with('allvalpartcln',$allvalpartcln)
                ->with('allvalconrod',$allvalconrod)
                ->with('allvaloilpump',$allvaloilpump)
                ->with('allvalcylinderblock',$allvalcylinderblock)
                ->with('allvalcranksft',$allvalcranksft)
                ->with('allvalcamsft',$allvalcamsft)
                ->with('allvalothercom',$allvalothercom)
                ->with('allvalinsprpt',$allvalinsprpt)
                ->with('allvalcooler',$allvalcooler)
                ->with('allvalconrodbush',$allvalconrodbush)
                //->with('allvalfandrive',$allvalfandrive)
                ->with('allvalaircomp',$allvalaircomp)
                ->with('allvalwaterpump',$allvalwaterpump)
                ->with('showrejectcom',$showrejectcom)
                ->with('showmissingstatus',$showmissingstatus)
                //->with('showcheckassembly', $showcheckassembly)
                ->with('showdissambly',$showdissambly)
                //->with('beforestart',$beforestart)
                ->with('beforestartccassembly', $beforestartccassembly)
                ->with('allvalcylinderheadoil',$allvalcylinderheadoil)
                ->with('cominspecreport',$cominspecreport)
                ->with('showcluplatethi',$showcluplatethi)
                ->with('showcluplateflt',$showcluplateflt)
                ->with('showtorque',$showtorque)
                ->with('showtransmission',$showtransmission)
                ->with('allvaltrans',$allvaltrans)
                ->with('showrolspec',$showrolspec)
                ->with('showrolmea',$showrolmea)
                ->with('showidlerpec',$showidlerpec)
                ->with('allvalrolmea',$allvalrolmea)
                ->with('showrolspcend',$showrolspcend)
                ->with('showidlermesbef',$showidlermesbef)
                ->with('showidlermesaft',$showidlermesaft)
                ->with('showidlerspend',$showidlerspend)
                 ->with('showtracklinkheight',$showtracklinkheight)
                 ->with('showtrackpitch',$showtrackpitch)
                 ->with('showtracklinkpin',$showtracklinkpin)
                 ->with('showtracklinkbush',$showtracklinkbush)
                 ->with('showtrackshoe',$showtrackshoe)
                 ->with('showpininspmea',$showpininspmea)
                 ->with('showbushinspmea',$showbushinspmea)
                ->with('showidleclr',$showidleclr)
                ->with('showrollclr',$showrollclr)
                ->with('showlhcamshaft',$showlhcamshaft)
                ->with('showrhcamshaft',$showrhcamshaft)
                ->with('showrhcambush',$showrhcambush)
                ->with('allvallLhcamsft',$allvallLhcamsft)
                ->with('allvalrLhcamsft',$allvalrLhcamsft)
                ->with('allvalcamsftbush',$allvalcamsftbush)
                ->with('showcylblklinear',$showcylblklinear)
                ->with('allvalcylblkliner',$allvalcylblkliner)
                ->with('showcylblkcam',$showcylblkcam)
                ->with('allvalcylblkcam',$allvalcylblkcam)
                ->with('linArray',$linArray)
                ->with('linfrntreslt',$linfrntreslt)
                ->with('linfrtmainrst',$linfrtmainrst)
                ->with('linrearcenteryes',$linrearcenteryes)
                ->with('linrearresyes',$linrearresyes)
                ->with('linrearremaryes',$linrearremaryes)
                ->with('camArray',$camArray)
                ->with('camfrntreslt',$camfrntreslt)
                ->with('camfrtmainrst',$camfrtmainrst)
                ->with('camrearcenteryes',$camrearcenteryes)
                ->with('camrearresyes',$camrearresyes)
                ->with('camrearremaryes',$camrearremaryes)
                ->with('showcytopdk',$showcytopdk)
                ->with('allvalcytopdk',$allvalcytopdk)
                ->with('showcythread',$showcythread)
                ->with('allvalcythread',$allvalcythread)
                ->with('showcybush',$showcybush)
                ->with('allvalcybush',$allvalcybush)
                ->with('allvalcyCap',$allvalcyCap)
                ->with('showcycap',$showcycap)
                ->with('allvfanaldrive',$allvfanaldrive)

                ->with('ccbeforestartassembly',$ccbeforestartassembly)
                ->with('cccompinsp',$cccompinsp);


        }
        else{
            $service=Null;
            $agrregate=Null;
            $mcModel=Null;
            $mcSerial=Null;
            $componentSerial=Null;
            $commercialLogistic=Null;
            $prehist=Null;
            $machSerial=Null;
            $comSerial=Null;
            $externalWash=Null;
            $beforestartccassembly=Null;
            $partsClean=Null;
            $cylinder=Null;
            $showothercomp=Null;
            $myArray=Null;
            $showconrod=Null;
            $showconrodbush=Null;
            $frntreslt=Null;
            $rearcenteryes=Null;
            $rearresyes=Null;
            $rearremaryes=Null;
            $showcrankshaft=Null;
            $showcamshaft=Null;
            $showcylinderblock=Null;
            $frtmainrst=Null;
            $showfandrive=Null;
            $showoilpump=Null;
            $showaircomp=Null;
            $showwaterpump=Null;
            $showcompinsp=Null;
            $beforestartassembly=Null;
            $showcooler=Null;
            $showrolmea=Null;
            $showlhcamshaft=Null;
            $showrhcamshaft=Null;
            $showrhcambush=Null;
            $showcylblklinear=Null;
            $showcylblkcam=Null;
            $linArray=Null;
            $linfrntreslt=Null;
            $linfrtmainrst=Null;
            $linrearcenteryes=Null;
            $linrearresyes=Null;
            $linrearremaryes=Null;
            $camArray=Null;
            $camfrntreslt=Null;
            $camfrtmainrst=Null;
            $camrearcenteryes=Null;
            $camrearresyes=Null;
            $camrearremaryes=Null;
            $showcytopdk=Null;
            $showcythread=Null;
            $showcybush=Null;
            $showcycap=Null;
            $allvalcommercialLog=Null;
            $allvalexterwash=Null;
            $allvalpartcln=Null;
            $allvalinsprpt=Null;
            $allvaltrans=Null;
            $allvalcylinderblock=Null;
            $allvalcylblkcam=Null;
             $allvalcytopdk=Null;
            $allvalcythread=Null;
            $allvalcybush=Null;
            $allvalcyCap=Null;
            $allvalcamsft=Null;
            $allvallLhcamsft=Null;
            $allvalrLhcamsft=Null;
            $allvalcamsftbush=Null;
            $allvalconrod=Null;
            $allvalcylinderheadoil=Null;
            $allvalothercom=Null;
            $allvfanaldrive=Null;
            $allvaloilpump=Null;
            $allvalaircomp=Null;
            $allvalwaterpump=Null;
            $allvalcooler=Null;
            $allvalrolmea=Null;

            return view('admin.include.checksheetCommon')
                ->with('service',$service)
                ->with('agrregate', $agrregate)
                ->with('mcModel', $mcModel)
                ->with('mcSerial', $mcSerial)
                ->with('componentSerial', $componentSerial)
                ->with('commercialLogistic',$commercialLogistic)
                ->with('prehist',$prehist)
                ->with('machSerial',$machSerial)
                ->with('comSerial',$comSerial)
                ->with('externalWash',$externalWash)
                ->with('partsClean',$partsClean)
                ->with('cylinder',$cylinder)
                ->with('showothercomp',$showothercomp)
                ->with('showcompinsp',$showcompinsp)
                ->with('myArray',$myArray)
                ->with('showconrod',$showconrod)
                ->with('showconrodbush',$showconrodbush)
                ->with('showfandrive',$showfandrive)
                ->with('showoilpump',$showoilpump)
                ->with('showaircomp',$showaircomp)
                ->with('showwaterpump',$showwaterpump)
                //->with('showcluthick',$showcluthick)
                ->with('frntreslt',$frntreslt)
                ->with('frtmainrst',$frtmainrst)
                ->with('rearcenteryes',$rearcenteryes)
                ->with('rearresyes',$rearresyes)
                ->with('rearremaryes',$rearremaryes)
                ->with('showcrankshaft',$showcrankshaft)
                ->with('showcamshaft',$showcamshaft)
                ->with('showcooler',$showcooler)
                ->with('showrolmea',$showrolmea)
                ->with('showrhcamshaft',$showrhcamshaft)
                ->with('showrhcambush',$showrhcambush)
                ->with('showcylblklinear',$showcylblklinear)
                ->with('showcylblkcam',$showcylblkcam)
                ->with('linArray',$linArray)
                ->with('linfrntreslt',$linfrntreslt)
                ->with('linfrtmainrst',$linfrtmainrst)
                ->with('linrearcenteryes',$linrearcenteryes)
                ->with('linrearresyes',$linrearresyes)
                ->with('linrearremaryes',$linrearremaryes)
                ->with('camArray',$camArray)
                ->with('camfrntreslt',$camfrntreslt)
                ->with('camfrtmainrst',$camfrtmainrst)
                ->with('camrearcenteryes',$camrearcenteryes)
                ->with('camrearresyes',$camrearresyes)
                ->with('camrearremaryes',$camrearremaryes)
                ->with('showcytopdk',$showcytopdk)
                ->with('showcythread',$showcythread)
                ->with('showcybush',$showcybush)
                ->with('showcycap',$showcycap)
                //->with('showcluplatethi',$showcluplatethi)
                ->with('beforestartassembly',$beforestartassembly)
                ->with('allvalcommercialLog',$allvalcommercialLog)
                ->with('allvalexterwash',$allvalexterwash)
                ->with('allvalpartcln',$allvalpartcln)
                ->with('allvalinsprpt',$allvalinsprpt)
                ->with('allvaltrans',$allvaltrans)
                ->with('allvalcylinderblock',$allvalcylinderblock)
                ->with('allvalcylblkcam',$allvalcylblkcam)
                ->with('allvalcytopdk',$allvalcytopdk)
                ->with('allvalcythread',$allvalcythread)
                ->with('allvalcybush',$allvalcybush)
                ->with('allvalcyCap',$allvalcyCap)
                ->with('allvalcamsft',$allvalcamsft)
                ->with('allvallLhcamsft',$allvallLhcamsft)
                ->with('allvalrLhcamsft',$allvalrLhcamsft)
                ->with('allvalcamsftbush',$allvalcamsftbush)
                ->with('allvalconrod',$allvalconrod)
                ->with('allvalcylinderheadoil',$allvalcylinderheadoil)
                ->with('allvalothercom',$allvalothercom)
                ->with('allvfanaldrive',$allvfanaldrive)
                ->with('allvaloilpump',$allvaloilpump)
                ->with('allvalaircomp',$allvalaircomp)
                ->with('allvalwaterpump',$allvalwaterpump)
                ->with('allvalcooler',$allvalcooler)
                ->with('allvalrolmea',$allvalrolmea)

                ->with('showcylinderblock',$showcylinderblock);



        }



    }

    public function checkSheetAssemblyCommon($id)
    {

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $route_check =  request()->segment(2);

        if($route_check == 'check-sheet-entry-common'){

            $view='admin.include.checksheetCommon';
        }
        if($route_check == 'check-sheet-assembly-common'){


            $view='admin.include.checksheetAssemblyCommon';

        }

        $service = Service::find($id);
        if(!empty($service)){
            $route_check =  request()->segment(2);
            if($route_check == 'check-sheet-entry-common')
            {
                $dept_id=$data['user']['section_id'];
                $disassembly_status = 1;

                $checkgatefollow=CheckgateOneFollowedUp::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalchkgtfollow=CheckgateOneFollowedUp::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $agrregate=MasterAggregate::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $prehist=MasterPreHistoryDis::where('service_request_id','=',$service->id)
                    //->where('disassembly_status','=',$disassembly_status)
                    //->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showrejectcom =ChecksheetStatus::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $commercialLogistic=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalcommercialLog=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $externalWash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalexterwash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $partsClean=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalpartcln=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $beforestartccassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $ccbeforestartassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cominspecreport=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $cccompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalinsprpt=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showtransmission=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaltrans=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showloosepat_1=MasterLoosepartDis::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showmissing_1=MasterMissingdamagePartDis::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showmissingstatus_1=StatusRevision::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showdissambly_1=MasterDissamblyCleaningInspection::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblklinear=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkliner=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcycap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcyCap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcrankshaft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcranksft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcamshaft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showlhcamshaft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvallLhcamsft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrhcamshaft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrLhcamsft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrhcambush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsftbush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cylinder=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderheadoil=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showothercomp=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalothercom=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfandrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvfanaldrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showoilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaloilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfailed_1=MasterFailedParts::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showsalvage_1=MasterListofSalvageDis::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluthick_1=ClutchPackThicknessValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplatethi_1=ClutchPlateThicknessValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplateflt_1=ClutchPlateFlatnessValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showtorque_1=TorqueConverterValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspec_1=RoolerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspcend_1=RoolerSpecifiEndColValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrollclr_1=RollerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerpec_1=IdlerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesbef_1=IdlerMeasuredBeforeValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesaft_1=IdlerMeasuredAfterValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerspend_1=IdlerSpeciEndcolerValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtracklinkheight_1=PartTrackLinkHeight::where('service_request_id','=',$service->id)
                     ->where('disassembly_status','=',$disassembly_status)
                     ->where('dept_id','=',$dept_id)
                     ->get();
                $showtrackpitch_1=PartTrackPitch::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtracklinkpin_1=PartTrackLinkPin::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtracklinkbush_1=PartTrackLinkBush::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtrackshoe_1=PartTrackShoe::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showpininspmea_1=PartPinInspMea::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showbushinspmea_1=PartBushInspMea::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidleclr_1=IdlerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showassembly = ChecksheetAssembly::where('service_request_id', '=', $service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalassembly = ChecksheetAssembly::where('service_request_id', '=', $service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $rejectmsg=Null;
                $rejectmsg=ChecksheetStatus::where('service_request_id', '=', $service->id)
                    // ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                if (request()->session()->get('user')['section_id'] == '10'){
                    $dept_id1 = '4';
                }
                if(request()->session()->get('user')['section_id'] == '11'){
                    $dept_id1 = '5';
                }
                if(request()->session()->get('user')['section_id'] == '15'){
                    $dept_id1 = '7';
                }
                if(request()->session()->get('user')['section_id'] == '12'){
                    $dept_id1 = '13';
                }
                $rejectmsg1=Null;
                if(request()->session()->get('user')['section_id'] == '10' ||request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '15'){
                    $rejectmsg1=ChecksheetStatus::where('service_request_id', '=', $service->id)
                        // ->where('disassembly_status','=',$disassembly_status)
                        ->where('dept_id','=',$dept_id1)
                        ->get()->first();
                }

            }
            if($route_check == 'check-sheet-assembly-common'){

                $assembly_status = 1;
                $checkgatefollow=CheckgateOneFollowedUp::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalchkgtfollow=CheckgateOneFollowedUp::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $agrregate=MasterAggregate::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $prehist=MasterPreHistoryDis::where('service_request_id','=',$service->id)
                    // ->where('assembly_status','=',$assembly_status)
                    // ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showrejectcom =ChecksheetStatus::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $commercialLogistic=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcommercialLog=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $externalWash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalexterwash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $partsClean=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalpartcln=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $beforestartccassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $ccbeforestartassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();


                $cominspecreport=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cccompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalinsprpt=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showtransmission=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaltrans=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showloosepat_1=MasterLoosepartDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showmissing_1=MasterMissingdamagePartDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showmissingstatus_1=StatusRevision::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showdissambly_1=MasterDissamblyCleaningInspection::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblklinear=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkliner=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcycap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcyCap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcrankshaft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcranksft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcamshaft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showlhcamshaft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvallLhcamsft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();


                $showrhcamshaft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrLhcamsft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrhcambush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsftbush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cylinder=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderheadoil=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showothercomp=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalothercom=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfandrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvfanaldrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showoilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaloilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfailed_1=MasterFailedParts::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showsalvage_1=MasterListofSalvageDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluthick_1=ClutchPackThicknessValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplatethi_1=ClutchPlateThicknessValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplateflt_1=ClutchPlateFlatnessValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showtorque_1=TorqueConverterValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspec_1=RoolerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspcend_1=RoolerSpecifiEndColValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrollclr_1=RollerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerpec_1=IdlerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesbef_1=IdlerMeasuredBeforeValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesaft_1=IdlerMeasuredAfterValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerspend_1=IdlerSpeciEndcolerValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtracklinkheight_1=PartTrackLinkHeight::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtrackpitch_1=PartTrackPitch::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showtracklinkpin_1=PartTrackLinkPin::where('service_request_id','=',$service->id)
                        ->where('assembly_status','=',$assembly_status)
                        ->where('dept_id','=',$dept_id)
                        ->get();
                $showtracklinkbush_1=PartTrackLinkBush::where('service_request_id','=',$service->id)
                        ->where('assembly_status','=',$assembly_status)
                        ->where('dept_id','=',$dept_id)
                        ->get();
                $showtrackshoe_1=PartTrackShoe::where('service_request_id','=',$service->id)
                        ->where('assembly_status','=',$assembly_status)
                        ->where('dept_id','=',$dept_id)
                        ->get();
                $showpininspmea_1=PartPinInspMea::where('service_request_id','=',$service->id)
                        ->where('assembly_status','=',$assembly_status)
                        ->where('dept_id','=',$dept_id)
                        ->get();
                $showbushinspmea_1=PartBushInspMea::where('service_request_id','=',$service->id)
                        ->where('assembly_status','=',$assembly_status)
                        ->where('dept_id','=',$dept_id)
                        ->get();

                $showidleclr_1=IdlerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showassembly = ChecksheetAssembly::where('service_request_id', '=', $service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalassembly = ChecksheetAssembly::where('service_request_id', '=', $service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $rejectmsg=Null;
                $rejectmsg=ChecksheetStatus::where('service_request_id', '=', $service->id)
                    // ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                if (request()->session()->get('user')['section_id'] == '10'){
                    $dept_id1 = '4';
                }
                if(request()->session()->get('user')['section_id'] == '11'){
                    $dept_id1 = '5';
                }
                if(request()->session()->get('user')['section_id'] == '15'){
                    $dept_id1 = '7';
                }
                if(request()->session()->get('user')['section_id'] == '12'){
                    $dept_id1 = '13';
                }

                $rejectmsg1=Null;
                if(request()->session()->get('user')['section_id'] == '10' ||request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '15'){
                    $rejectmsg1=ChecksheetStatus::where('service_request_id', '=', $service->id)
                        // ->where('disassembly_status','=',$disassembly_status)
                        ->where('dept_id','=',$dept_id1)
                        ->get()->first();
                }

            }

            //engine assembly checksheet


            if (isset($showassembly->id)) {
                $showassembly = json_decode($showassembly->cc_value);
            } else {
                $showassembly = Null;
            }

            //check gate1 followed

            if(isset($checkgatefollow->id)){
                $checkgatefollow=json_decode($checkgatefollow->values);
            }else{
                $checkgatefollow=Null;
            }


            //aggregation show


            $mcModel=MasterMCModel::find($service->machine_modelno);

            $mcSerial = Service::select('service_request.id','machine_serialno', 'gw_master_machine_serial_no.serial_no')
                ->leftjoin('gw_master_machine_serial_no','gw_master_machine_serial_no.id', '=', 'service_request.machine_serialno')
                ->where('service_request.id', '=' ,$id)->get();
            $componentSerial=MasterComponentDetails::find($service->component_serial_no);
            $customer = Service::select('gw_master_customer.name')
                ->leftjoin('gw_master_customer','gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.id', '=' ,$id)->get()->toArray();

            //prehistory show

            if(isset($prehist->id)) {
                $machSerial=MasterMCSerialNumber::find($service->machine_serialno);
                $comSerial=MasterComponentDetails::find($service->component_serial_no);

            }
            else{
                $machSerial=Null;
                $comSerial=Null;
            }

            //Commercial and logistics


            if(isset($commercialLogistic->id)){
                $commercialLogistic=json_decode($commercialLogistic->values);
            }else{
                $commercialLogistic=Null;
            }

            //ccinspection after external wash

            if(isset($externalWash->id)){
                $externalWash=json_decode($externalWash->values);
            }else{
                $externalWash=Null;
            }

            //before start assembly


            if(isset($beforestartccassembly->id)){
                $beforestartccassembly=json_decode($beforestartccassembly->ccvalues);
            }else{
                $beforestartccassembly=Null;
            }


            //Conrod After Bush Replacement



            if(isset($showconrodbush->id)){
                $showconrodbush=json_decode($showconrodbush->values);
            }else{
                $showconrodbush=Null;
            }

            //Component Inspection report

            if(isset( $cominspecreport->id)){
                $cominspecreport=json_decode( $cominspecreport->ccvalues);
            }else{
                $cominspecreport=Null;
            }


            //cc inspection after parts clean

            if(isset($partsClean->id)){
                $partsClean=json_decode($partsClean->values);
            }else{
                $partsClean=Null;
            }



            //partsinspection cylinder head


            if(isset($cylinder->id)){
                $cylinder=json_decode($cylinder->details);
            }else{
                $cylinder=Null;
            }




            //parts inspection cooler insp


            if(isset($showcooler->id)){
                $showcooler=json_decode($showcooler->values);
            }else{
                $showcooler=Null;
            }




            //partinspection other component


            if(isset($showothercomp->id)){
                $showothercomp=json_decode($showothercomp->values);
            }else{
                $showothercomp=Null;
            }



            //transmisssion component

            if(isset($showtransmission->id)){
                $showtransmission=json_decode($showtransmission->values);
            }else{
                $showtransmission=Null;
            }





            // commponent inspection report

            if(isset($showcompinsp->id)){
                $showcompinsp=json_decode($showcompinsp->ccvalues);
            }else{
                $showcompinsp=Null;
            }

            /* */


            //parts rooler measured

            if(isset($showrolmea->id)){
                $showrolmea=json_decode($showrolmea->values);
            }else{
                $showrolmea=Null;
            }



            //partsinspection connecting rod

            if(isset($showconrod->id)){
                $showconrod=json_decode($showconrod->values);
            }else{
                $showconrod=Null;
            }



            //partinspection cylinder block

            if(isset($showcylinderblock->id)){
                $showcylinderblock=json_decode($showcylinderblock->values);
            }else{
                $showcylinderblock=Null;
            }
            //$var = $showcylinderblock->frontcenter;
            if(isset($showcylinderblock->frontcenter)){
                $myArray = json_decode(json_encode($showcylinderblock->frontcenter), true);
            }
            else{
                $myArray=Null;
            }
            if(isset($showcylinderblock->frontresult)) {
                $frntreslt = json_decode(json_encode($showcylinderblock->frontresult), true);
            }else{
                $frntreslt=Null;
            }
            if(isset($showcylinderblock->mainfrontremarks)) {
                $frtmainrst = json_decode(json_encode($showcylinderblock->mainfrontremarks), true);
            }else{
                $frtmainrst=Null;
            }
            if(isset($showcylinderblock->centerresult)) {
                $rearcenteryes = json_decode(json_encode($showcylinderblock->centerresult), true);
            }else{
                $rearcenteryes=Null;
            }
            if(isset($showcylinderblock->rearresults)) {
                $rearresyes = json_decode(json_encode($showcylinderblock->rearresults), true);
            }else{
                $rearresyes=Null;
            }
            if(isset($showcylinderblock->rearresults)) {
                $rearremaryes = json_decode(json_encode($showcylinderblock->mainrearremarks), true);
            }else{
                $rearremaryes=Null;
            }


            //partinspection cylinder block linear

            if(isset($showcylblklinear->id)){
                $showcylblklinear=json_decode($showcylblklinear->values);
            }else{
                $showcylblklinear=Null;
            }

            if(isset($showcylblklinear->frontcenter)){
                $linArray = json_decode(json_encode($showcylblklinear->frontcenter), true);
            }
            else{
                $linArray=Null;
            }
            if(isset($showcylblklinear->frontresult)) {
                $linfrntreslt = json_decode(json_encode($showcylblklinear->frontresult), true);
            }else{
                $linfrntreslt=Null;
            }
            if(isset($showcylblklinear->mainfrontremarks)) {
                $linfrtmainrst = json_decode(json_encode($showcylblklinear->mainfrontremarks), true);
            }else{
                $linfrtmainrst=Null;
            }
            if(isset($showcylblklinear->centerresult)) {
                $linrearcenteryes = json_decode(json_encode($showcylblklinear->centerresult), true);
            }else{
                $linrearcenteryes=Null;
            }
            if(isset($showcylblklinear->rearresults)) {
                $linrearresyes = json_decode(json_encode($showcylblklinear->rearresults), true);
            }else{
                $linrearresyes=Null;
            }
            if(isset($showcylblklinear->rearresults)) {
                $linrearremaryes = json_decode(json_encode($showcylblklinear->mainrearremarks), true);
            }else{
                $linrearremaryes=Null;
            }



            //partinspection cylinder block cam bore

            if(isset($showcylblkcam->id)){
                $showcylblkcam=json_decode($showcylblkcam->values);
            }else{
                $showcylblkcam=Null;
            }
            if(isset($showcylblkcam->frontcenter)){
                $camArray = json_decode(json_encode($showcylblkcam->frontcenter), true);
            }
            else{
                $camArray=Null;
            }
            if(isset($showcylblkcam->frontresult)) {
                $camfrntreslt = json_decode(json_encode($showcylblkcam->frontresult), true);
            }else{
                $camfrntreslt=Null;
            }
            if(isset($showcylblkcam->mainfrontremarks)) {
                $camfrtmainrst = json_decode(json_encode($showcylblkcam->mainfrontremarks), true);
            }else{
                $camfrtmainrst=Null;
            }
            if(isset($showcylblkcam->centerresult)) {
                $camrearcenteryes = json_decode(json_encode($showcylblkcam->centerresult), true);
            }else{
                $camrearcenteryes=Null;
            }
            if(isset($showcylblkcam->rearresults)) {
                $camrearresyes = json_decode(json_encode($showcylblkcam->rearresults), true);
            }else{
                $camrearresyes=Null;
            }
            if(isset($showcylblkcam->rearresults)) {
                $camrearremaryes = json_decode(json_encode($showcylblkcam->mainrearremarks), true);
            }else{
                $camrearremaryes=Null;
            }




            //parts inspection crankshaft inspection

            if(isset($showcrankshaft->id)){
                $showcrankshaft=json_decode($showcrankshaft->values);
            }else{
                $showcrankshaft=Null;
            }


            //parts inspection camshaft inspection


            if(isset($showcamshaft->id)){
                $showcamshaft=json_decode($showcamshaft->values);
            }else{
                $showcamshaft=Null;
            }



            //parts inspection lh camshaft inspection


            if(isset($showlhcamshaft->id)){
                $showlhcamshaft=json_decode($showlhcamshaft->values);
            }else{
                $showlhcamshaft=Null;
            }



            //parts inspection rh camshaft inspection


            if(isset($showrhcamshaft->id)){
                $showrhcamshaft=json_decode($showrhcamshaft->values);
            }else{
                $showrhcamshaft=Null;
            }


            //parts inspection camshaft bushbore inspection


            if(isset($showrhcambush->id)){
                $showrhcambush=json_decode($showrhcambush->values);
            }else{
                $showrhcambush=Null;
            }



            //missingdamagepart


            if(isset($showmissing_1)){
                $showmissing=$showmissing_1;


            }else{
                $showmissing=Null;

            }
            //status of revision


            if(isset($showmissingstatus_1)){
                $showmissingstatus=$showmissingstatus_1;


            }else{
                $showmissingstatus=Null;

            }
            //Assembly checksheet
            /* $showcheckassembly_1=ChecksheetAssembly::where('service_request_id','=',$service->id)
                 //->where('dept_id','=',1)
                 ->get();
             //dd($showcheckassembly_1);exit;
             if(isset($showcheckassembly_1)){
                 $showcheckassembly=$showcheckassembly_1;
                 //dd($showcheckassembly);exit;

             }else{
                 $showcheckassembly=Null;

             }*/

            //disassembly cleaning inspection

            //dd($showdissambly_1);exit;
            if(isset($showdissambly_1)){
                $showdissambly=$showdissambly_1;
                //dd($showdissambly);exit;

            }else{
                $showdissambly=Null;

            }
            //list of salvage


            //dd($showmissing_1);exit;
            if(isset($showsalvage_1)){
                $showsalvage=$showsalvage_1;
                //dd($showmissing);exit;

            }else{
                $showsalvage=Null;
            }

            //loose parts

            // dd($showloosepat_1);exit;
            if(isset($showloosepat_1)){
                $showloosepat=$showloosepat_1;
                //dd($showmissing);exit;

            }else{
                $showloosepat=Null;
            }

            //Failed Parts


            if(isset($showfailed_1)){
                $showfailed=$showfailed_1;


            }else{
                $showfailed=Null;

            }

            //rooler spe endcol


            if(isset($showrolspcend_1)){
                $showrolspcend=$showrolspcend_1;


            }else{
                $showrolspcend=Null;

            }


            //parts rooler specification

            if(isset($showrolspec_1)){
                $showrolspec=$showrolspec_1;


            }else{
                $showrolspec=Null;

            }

            //parts idler specification


            if(isset($showidlerpec_1)){
                $showidlerpec=$showidlerpec_1;


            }else{
                $showidlerpec=Null;

            }

            //parts idler measured before


            if(isset($showidlermesbef_1)){
                $showidlermesbef=$showidlermesbef_1;


            }else{
                $showidlermesbef=Null;

            }

            //parts idler measured after


            if(isset($showidlermesaft_1)){
                $showidlermesaft=$showidlermesaft_1;


            }else{
                $showidlermesaft=Null;

            }

            //parts clutch pack thickness


            if(isset($showcluthick_1)){
                $showcluthick=$showcluthick_1;


            }else{
                $showcluthick=Null;

            }

            //parts clutch plate thickness



            if(isset($showcluplatethi_1)){
                $showcluplatethi=$showcluplatethi_1;


            }else{
                $showcluplatethi=Null;

            }

            //parts clutch plate flatness


            if(isset($showcluplateflt_1)){
                $showcluplateflt=$showcluplateflt_1;


            }else{
                $showcluplateflt=Null;

            }

            //parts torque converter



            if(isset($showtorque_1)){
                $showtorque=$showtorque_1;


            }else{
                $showtorque=Null;

            }

            //parts idler spec endcol



            if(isset($showidlerspend_1)){
                $showidlerspend=$showidlerspend_1;


            }else{
                $showidlerspend=Null;

            }
                //parts track link height
            if(isset($showtracklinkheight_1)){
                $showtracklinkheight=$showtracklinkheight_1;


            }else{
                $showtracklinkheight=Null;

            }

                //parts track pitch
                   if(isset($showtrackpitch_1)){
                       $showtrackpitch=$showtrackpitch_1;


                   }else{
                       $showtrackpitch=Null;

                   }

                //parts track link pin
            if(isset($showtracklinkpin_1)){
                $showtracklinkpin=$showtracklinkpin_1;


            }else{
                $showtracklinkpin=Null;

            }
                // parts track link bush
            if(isset($showtracklinkbush_1)){
                $showtracklinkbush=$showtracklinkbush_1;


            }else{
                $showtracklinkbush=Null;

            }
                 // parts track shoe
            if(isset($showtrackshoe_1)){
                $showtrackshoe=$showtrackshoe_1;


            }else{
                $showtrackshoe=Null;

            }
                // parts pin insp
            if(isset($showpininspmea_1)){
                $showpininspmea=$showpininspmea_1;


            }else{
                $showpininspmea=Null;

            }
                 // parts bush insp
            if(isset($showbushinspmea_1)){
                $showbushinspmea=$showbushinspmea_1;


            }else{
                $showbushinspmea=Null;

            }
            //parts idler clear shaft



            if(isset($showidleclr_1)){
                $showidleclr=$showidleclr_1;


            }else{
                $showidleclr=Null;

            }

            //parts roller clear shaft



            if(isset($showrollclr_1)){
                $showrollclr=$showrollclr_1;


            }else{
                $showrollclr=Null;

            }

            //Parts Fan Drive

            if(isset($showfandrive->id)){
                $showfandrive=json_decode($showfandrive->values);
            }else{
                $showfandrive=Null;
            }



            //Parts Oil Pump

            if(isset($showoilpump->id)){
                $showoilpump=json_decode($showoilpump->values);
            }else{
                $showoilpump=Null;
            }



            //air compressor

            if(isset($showaircomp->id)){
                $showaircomp=json_decode($showaircomp->values);
            }else{
                $showaircomp=Null;
            }



            //water pump

            if(isset($showwaterpump->id)){
                $showwaterpump=json_decode($showwaterpump->values);
            }else{
                $showwaterpump=Null;
            }



            //cylinder block top deck

            if(isset($showcytopdk->id)){
                $showcytopdk=json_decode($showcytopdk->values);
            }else{
                $showcytopdk=Null;
            }



            //cylinder block thread

            if(isset($showcythread->id)){
                $showcythread=json_decode($showcythread->values);
            }else{
                $showcythread=Null;
            }



            //cylinder block bush bore

            if(isset($showcybush->id)){
                $showcybush=json_decode($showcybush->values);
            }else{
                $showcybush=Null;
            }


            //cylinder block Cap no

            if(isset($showcycap->id)){
                $showcycap=json_decode($showcycap->values);
            }else{
                $showcycap=Null;
            }


            //$route_check =  request()->segment(2);
            // return view('admin.include.checksheetAssemblyCommon')

            return view($view)
                ->with('service',$service)
                ->with('checkgatefollow',$checkgatefollow)
                ->with('allvalchkgtfollow',$allvalchkgtfollow)
                ->with('agrregate', $agrregate)
                ->with('mcModel', $mcModel)
                ->with('mcSerial', $mcSerial)
                ->with('componentSerial', $componentSerial)
                ->with('commercialLogistic',$commercialLogistic)
                ->with('prehist',$prehist)
                ->with('machSerial',$machSerial)
                ->with('comSerial',$comSerial)
                ->with('externalWash',$externalWash)
                ->with('partsClean',$partsClean)
                ->with('cylinder',$cylinder)
                ->with('showothercomp',$showothercomp)
                ->with('myArray',$myArray)
                ->with('showconrod',$showconrod)
                ->with('showconrodbush',$showconrodbush)
                ->with('frntreslt',$frntreslt)
                ->with('frtmainrst',$frtmainrst)
                ->with('rearcenteryes',$rearcenteryes)
                ->with('rearresyes',$rearresyes)
                ->with('rearremaryes',$rearremaryes)
                ->with('showcrankshaft',$showcrankshaft)
                ->with('showcamshaft',$showcamshaft)
                ->with('showcylinderblock',$showcylinderblock)
                ->with('showmissing',$showmissing)
                ->with('showoilpump',$showoilpump)
                ->with('showaircomp',$showaircomp)
                ->with('showsalvage',$showsalvage)
                ->with('showcooler',$showcooler)
                ->with('showloosepat',$showloosepat)
                ->with('showfailed',$showfailed)
                ->with('showfandrive',$showfandrive)
                ->with('showwaterpump',$showwaterpump)
                ->with('showcompinsp',$showcompinsp)
                ->with('showcluthick',$showcluthick)
                ->with('allvalcommercialLog',$allvalcommercialLog)
                ->with('allvalexterwash',$allvalexterwash)
                ->with('allvalpartcln',$allvalpartcln)
                ->with('allvalconrod',$allvalconrod)
                ->with('allvaloilpump',$allvaloilpump)
                ->with('allvalcylinderblock',$allvalcylinderblock)
                ->with('allvalcranksft',$allvalcranksft)
                ->with('allvalcamsft',$allvalcamsft)
                ->with('allvalothercom',$allvalothercom)
                ->with('allvalinsprpt',$allvalinsprpt)
                ->with('allvalcooler',$allvalcooler)
                ->with('allvalconrodbush',$allvalconrodbush)
                //->with('allvalfandrive',$allvalfandrive)
                ->with('allvalaircomp',$allvalaircomp)
                ->with('allvalwaterpump',$allvalwaterpump)
                ->with('showrejectcom',$showrejectcom)
                ->with('showmissingstatus',$showmissingstatus)
                //->with('showcheckassembly', $showcheckassembly)
                ->with('showdissambly',$showdissambly)
                //->with('beforestart',$beforestart)
                ->with('beforestartccassembly', $beforestartccassembly)
                ->with('allvalcylinderheadoil',$allvalcylinderheadoil)
                ->with('cominspecreport',$cominspecreport)
                ->with('showcluplatethi',$showcluplatethi)
                ->with('showcluplateflt',$showcluplateflt)
                ->with('showtorque',$showtorque)
                ->with('showtransmission',$showtransmission)
                ->with('allvaltrans',$allvaltrans)
                ->with('showrolspec',$showrolspec)
                ->with('showrolmea',$showrolmea)
                ->with('showidlerpec',$showidlerpec)
                ->with('allvalrolmea',$allvalrolmea)
                ->with('showrolspcend',$showrolspcend)
                ->with('showidlermesbef',$showidlermesbef)
                ->with('showidlermesaft',$showidlermesaft)
                ->with('showidlerspend',$showidlerspend)
                ->with('showtracklinkheight',$showtracklinkheight)
                ->with('showtrackpitch',$showtrackpitch)
                ->with('showtracklinkpin',$showtracklinkpin)
                ->with('showtracklinkbush',$showtracklinkbush)
                ->with('showtrackshoe',$showtrackshoe)
                ->with('showpininspmea',$showpininspmea)
                ->with('showbushinspmea',$showbushinspmea)
                ->with('showidleclr',$showidleclr)
                ->with('showrollclr',$showrollclr)
                ->with('showlhcamshaft',$showlhcamshaft)
                ->with('showrhcamshaft',$showrhcamshaft)
                ->with('showrhcambush',$showrhcambush)
                ->with('allvallLhcamsft',$allvallLhcamsft)
                ->with('allvalrLhcamsft',$allvalrLhcamsft)
                ->with('allvalcamsftbush',$allvalcamsftbush)
                ->with('showcylblklinear',$showcylblklinear)
                ->with('allvalcylblkliner',$allvalcylblkliner)
                ->with('showcylblkcam',$showcylblkcam)
                ->with('allvalcylblkcam',$allvalcylblkcam)
                ->with('linArray',$linArray)
                ->with('linfrntreslt',$linfrntreslt)
                ->with('linfrtmainrst',$linfrtmainrst)
                ->with('linrearcenteryes',$linrearcenteryes)
                ->with('linrearresyes',$linrearresyes)
                ->with('linrearremaryes',$linrearremaryes)
                ->with('camArray',$camArray)
                ->with('camfrntreslt',$camfrntreslt)
                ->with('camfrtmainrst',$camfrtmainrst)
                ->with('camrearcenteryes',$camrearcenteryes)
                ->with('camrearresyes',$camrearresyes)
                ->with('camrearremaryes',$camrearremaryes)
                ->with('showcytopdk',$showcytopdk)
                ->with('allvalcytopdk',$allvalcytopdk)
                ->with('showcythread',$showcythread)
                ->with('allvalcythread',$allvalcythread)
                ->with('showcybush',$showcybush)
                ->with('allvalcybush',$allvalcybush)
                ->with('allvalcyCap',$allvalcyCap)
                ->with('showcycap',$showcycap)
                ->with('allvfanaldrive',$allvfanaldrive)
                ->with('showassembly', $showassembly)
                ->with('allvalassembly', $allvalassembly)
                ->with('ccbeforestartassembly',$ccbeforestartassembly)
                ->with('rejectmsg',$rejectmsg)

                ->with('rejectmsg1',$rejectmsg1)

                ->with('customer',$customer)

                ->with('cccompinsp',$cccompinsp);


        }
        else{
            $service=Null;
            $checkgatefollow=Null;
            $allvalchkgtfollow=Null;
            $agrregate=Null;
            $mcModel=Null;
            $mcSerial=Null;
            $componentSerial=Null;
            $commercialLogistic=Null;
            $prehist=Null;
            $machSerial=Null;
            $comSerial=Null;
            $externalWash=Null;
            $beforestartccassembly=Null;
            $partsClean=Null;
            $cylinder=Null;
            $showothercomp=Null;
            $myArray=Null;
            $showconrod=Null;
            $showconrodbush=Null;
            $frntreslt=Null;
            $rearcenteryes=Null;
            $rearresyes=Null;
            $rearremaryes=Null;
            $showcrankshaft=Null;
            $showcamshaft=Null;
            $showcylinderblock=Null;
            $frtmainrst=Null;
            $showfandrive=Null;
            $showoilpump=Null;
            $showaircomp=Null;
            $showwaterpump=Null;
            $showcompinsp=Null;
            $beforestartassembly=Null;
            $showcooler=Null;
            $showrolmea=Null;
            $showlhcamshaft=Null;
            $showrhcamshaft=Null;
            $showrhcambush=Null;
            $showcylblklinear=Null;
            $showcylblkcam=Null;
            $linArray=Null;
            $linfrntreslt=Null;
            $linfrtmainrst=Null;
            $linrearcenteryes=Null;
            $linrearresyes=Null;
            $linrearremaryes=Null;
            $camArray=Null;
            $camfrntreslt=Null;
            $camfrtmainrst=Null;
            $camrearcenteryes=Null;
            $camrearresyes=Null;
            $camrearremaryes=Null;
            $showcytopdk=Null;
            $showcythread=Null;
            $showcybush=Null;
            $showcycap=Null;
            $allvalcommercialLog=Null;
            $allvalexterwash=Null;
            $allvalpartcln=Null;
            $allvalinsprpt=Null;
            $allvaltrans=Null;
            $allvalcylinderblock=Null;
            $allvalcylblkcam=Null;
            $allvalcytopdk=Null;
            $allvalcythread=Null;
            $allvalcybush=Null;
            $allvalcyCap=Null;
            $allvalcamsft=Null;
            $allvallLhcamsft=Null;
            $allvalrLhcamsft=Null;
            $allvalcamsftbush=Null;
            $allvalconrod=Null;
            $allvalcylinderheadoil=Null;
            $allvalothercom=Null;
            $allvfanaldrive=Null;
            $allvaloilpump=Null;
            $allvalaircomp=Null;
            $allvalwaterpump=Null;
            $allvalcooler=Null;
            $allvalrolmea=Null;
            $showassembly=Null;
            $allvalassembly=Null;
            $customer=Null;
            $showdissambly=Null;
            $rejectmsg1=Null;
            $rejectmsg=Null;

            return view($view)
                ->with('service',$service)
                ->with('checkgatefollow',$checkgatefollow)
                ->with('allvalchkgtfollow',$allvalchkgtfollow)
                ->with('agrregate', $agrregate)
                ->with('mcModel', $mcModel)
                ->with('mcSerial', $mcSerial)
                ->with('componentSerial', $componentSerial)
                ->with('commercialLogistic',$commercialLogistic)
                ->with('prehist',$prehist)
                ->with('machSerial',$machSerial)
                ->with('comSerial',$comSerial)
                ->with('externalWash',$externalWash)
                ->with('partsClean',$partsClean)
                ->with('cylinder',$cylinder)
                ->with('showothercomp',$showothercomp)
                ->with('showcompinsp',$showcompinsp)
                ->with('myArray',$myArray)
                ->with('showconrod',$showconrod)
                ->with('showconrodbush',$showconrodbush)
                ->with('showfandrive',$showfandrive)
                ->with('showoilpump',$showoilpump)
                ->with('showaircomp',$showaircomp)
                ->with('showwaterpump',$showwaterpump)
                //->with('showcluthick',$showcluthick)
                ->with('frntreslt',$frntreslt)
                ->with('frtmainrst',$frtmainrst)
                ->with('rearcenteryes',$rearcenteryes)
                ->with('rearresyes',$rearresyes)
                ->with('rearremaryes',$rearremaryes)
                ->with('showcrankshaft',$showcrankshaft)
                ->with('showcamshaft',$showcamshaft)
                ->with('showcooler',$showcooler)
                ->with('showrolmea',$showrolmea)
                ->with('showrhcamshaft',$showrhcamshaft)
                ->with('showrhcambush',$showrhcambush)
                ->with('showcylblklinear',$showcylblklinear)
                ->with('showcylblkcam',$showcylblkcam)
                ->with('linArray',$linArray)
                ->with('linfrntreslt',$linfrntreslt)
                ->with('linfrtmainrst',$linfrtmainrst)
                ->with('linrearcenteryes',$linrearcenteryes)
                ->with('linrearresyes',$linrearresyes)
                ->with('linrearremaryes',$linrearremaryes)
                ->with('camArray',$camArray)
                ->with('camfrntreslt',$camfrntreslt)
                ->with('camfrtmainrst',$camfrtmainrst)
                ->with('camrearcenteryes',$camrearcenteryes)
                ->with('camrearresyes',$camrearresyes)
                ->with('camrearremaryes',$camrearremaryes)
                ->with('showcytopdk',$showcytopdk)
                ->with('showcythread',$showcythread)
                ->with('showcybush',$showcybush)
                ->with('showcycap',$showcycap)
                //->with('showcluplatethi',$showcluplatethi)
                ->with('beforestartassembly',$beforestartassembly)
                ->with('allvalcommercialLog',$allvalcommercialLog)
                ->with('allvalexterwash',$allvalexterwash)
                ->with('allvalpartcln',$allvalpartcln)
                ->with('allvalinsprpt',$allvalinsprpt)
                ->with('allvaltrans',$allvaltrans)
                ->with('allvalcylinderblock',$allvalcylinderblock)
                ->with('allvalcylblkcam',$allvalcylblkcam)
                ->with('allvalcytopdk',$allvalcytopdk)
                ->with('allvalcythread',$allvalcythread)
                ->with('allvalcybush',$allvalcybush)
                ->with('allvalcyCap',$allvalcyCap)
                ->with('allvalcamsft',$allvalcamsft)
                ->with('allvallLhcamsft',$allvallLhcamsft)
                ->with('allvalrLhcamsft',$allvalrLhcamsft)
                ->with('allvalcamsftbush',$allvalcamsftbush)
                ->with('allvalconrod',$allvalconrod)
                ->with('allvalcylinderheadoil',$allvalcylinderheadoil)
                ->with('allvalothercom',$allvalothercom)
                ->with('allvfanaldrive',$allvfanaldrive)
                ->with('allvaloilpump',$allvaloilpump)
                ->with('allvalaircomp',$allvalaircomp)
                ->with('allvalwaterpump',$allvalwaterpump)
                ->with('allvalcooler',$allvalcooler)
                ->with('allvalrolmea',$allvalrolmea)
                ->with('showassembly', $showassembly)
                ->with('allvalassembly', $allvalassembly)
                ->with('customer', $customer)
                ->with('showdissambly', $showdissambly)
                ->with('rejectmsg1',$rejectmsg1)
                ->with('rejectmsg', $rejectmsg)
                ->with('showcylinderblock',$showcylinderblock);



        }








    }
    
    //checkgateone followedup
     public function checkGateOnefollowedUpDisSave(Request $request)
    {

        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $cmmercial_res = CheckgateOneFollowedUp ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();

            if(count($cmmercial_res)<=0){
                $cmmercial = new CheckgateOneFollowedUp();
                $cmmercial->disassembly_status = 1;
            }
            else{
                $cmmercial = CheckgateOneFollowedUp::find($cmmercial_res[0]['id']);
                $cmmercial->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cmmercial_res = CheckgateOneFollowedUp ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cmmercial_res)<=0){
                $cmmercial = new CheckgateOneFollowedUp();
                $cmmercial->assembly_status = 1;
            }
            else{
                $cmmercial = CheckgateOneFollowedUp::find($cmmercial_res[0]['id']);
                $cmmercial->assembly_status = 1;
            }
        }


        /* $service = Service::find($request['service_id']);
         $cmmercial=MasterCommercialValues::where('service_request_id','=',$service->id)
             ->where('dept_id','=',$request['dept_id'])->get()->first();
 //dd($cmmercial);exit;
         if(!isset($cmmercial)){
             $cmmercial =new MasterCommercialValues();
         }*/
        // if(isset($cmmercial->id))
        $commercialval=$request->all();

        //$obj = new MasterCommercialValues();

        if(isset($service->id)) {
            $cmmercial->service_request_id = $service->id;
            $cmmercial->dept_id = $dept_id;
            $cmmercial->disassembly_status = isset($request['disassembly_status']) ? '1':null;
            $cmmercial->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cmmercial->values = json_encode($commercialval);
            $cmmercial->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cmmercial->actual_end_date = date("Y-m-d");
            $cmmercial->save();
}
            //send Notification

   $sec=20;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$cmmercial->actual_start_date, $cmmercial->actual_end_date);

         $sec1=27;
        $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec1,$cmmercial->actual_start_date, $cmmercial->actual_end_date);


        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

   //aggregate
   public function checkGateAggregateSave(DisassmblyAggregateRequest $request)
    {

        $data = Session::all();
        $service = Service::find($request['service_id']);
         //echo '';print_r($data['user']['section_id']);exit;
        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $aggregate_res = MasterAggregate ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($aggregate_res)<=0){
                $aggregate = new MasterAggregate();
                $aggregate->disassembly_status = 1;
            }
            else{
                $aggregate = MasterAggregate::find($aggregate_res[0]['id']);
                $aggregate->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $aggregate_res = MasterAggregate ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($aggregate_res)<=0){
                $aggregate = new MasterAggregate();
                $aggregate->assembly_status = 1;
            }
            else{
                $aggregate = MasterAggregate::find($aggregate_res[0]['id']);
                $aggregate->assembly_status = 1;
            }
        }
        $aggregate->service_request_id =$request['service_id'];
        $aggregate->dept_id = $dept_id;
        $aggregate->disassembly_status = isset($request['disassembly_status']) ? '1':null;
        $aggregate->assembly_status = isset($request['assembly_status']) ? '1':null;
        //$aggregate->aggr_type = $request['aggr_type'];
        //$aggregate->arrangement_no = $request['arrangement_no'];
        //$aggregate->customer_contact = $request['customer_contact'];
        //$aggregate->branch_contact = $request['branch_contact'];
        //$aggregate->crc_supervisor = $request['crc_supervisor'];
        $aggregate->crc_job_no = $request['crc_job_no'];
        //$aggregate->branch_job_no = $request['branch_job_no'];
        $aggregate->machine_smu = $request['machine_smu'];
        $aggregate->component_smu = $request['component_smu'];
        $aggregate->date_arrival = Carbon::createFromFormat('d/m/Y', $request['date_arrival'])->format('Y-m-d');
        $aggregate->date_dispatch = Carbon::createFromFormat('d/m/Y', $request['date_dispatch'])->format('Y-m-d');
        $aggregate->machine_modelno = $request['machine_modelno'];
        $aggregate->machine_serialno = $request['machine_serialno'];
         $aggregate->iso_doc_no = $request['iso_doc_no'];
        $aggregate->customer = $request['customer'];
        $aggregate->servicing_branch = $request['servicing_branch'];
        $aggregate->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
        $aggregate->actual_end_date = date("Y-m-d");
        $aggregate->save();


    $sec=1;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$aggregate->actual_start_date, $aggregate->actual_end_date);

        /*$aggregate=MasterAggregate::where('service_request_id','=',$request['service_id'])
          ->where('dept_id','=',$request['dept_id'])->get()->first();

      /*isset($aggregate->service_request_id)){
          //echo "rimpi";exit;
          $aggregate =new MasterAggregate();
      }*/


 if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }
  
   //pre
     public function checkGatePreHisDisSave(Request $request)
    {
        //$myrequest=$request->all();
        //dd($myrequest);
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $prehist_res = MasterPreHistoryDis ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($prehist_res)<=0){
                $prehist = new MasterPreHistoryDis();
                $prehist->disassembly_status = 1;
            }
            else{
                $prehist = MasterPreHistoryDis::find($prehist_res[0]['id']);
                $prehist->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $prehist_res = MasterPreHistoryDis ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($prehist_res)<=0){
                $prehist = new MasterPreHistoryDis();
                $prehist->assembly_status = 1;
            }
            else{
                $prehist = MasterPreHistoryDis::find($prehist_res[0]['id']);
                $prehist->assembly_status = 1;
            }
        }
        /* $service = Service::find($request['service_id']);
         $prehist=MasterPreHistoryDis::where('service_request_id','=',$request['service_id'])
             ->where('dept_id','=',$request['dept_id'])->get()->first();

         if(!isset($prehist->id)){
             $prehist =new MasterPreHistoryDis();
         }*/

        $prehist->service_request_id = $request['service_id'];
        $prehist->dept_id = $dept_id;
        $prehist->disassembly_status = isset($request['disassembly_status']) ? '1':null;
        $prehist->assembly_status = isset($request['assembly_status']) ? '1':null;
        $prehist->repair_mode = $request['repair_mode'];
        $prehist->engine_serial_no = $request['engine_serial_no'];
        $prehist->engine_arrange_no =$request['engine_arrange_no'];
        $prehist->machine_type = $request['machine_type'];
        $prehist->machine_serial_no= $request['machine_serial_no'];
        $prehist->smu=$request['smu'];
        $prehist->no_of_overhauls_done=$request['no_of_overhauls_done'];
        $prehist->last_overhaul_smu=$request['last_overhaul_smu'];
        $prehist->failure_details=$request['failure_details'];
        $prehist->major_cylinder_head=$request['major_cylinder_head'];
        $prehist->major_injector=$request['major_injector'];
        $prehist->major_oil_pump=$request['major_oil_pump'];
        $prehist->major_fuel_injection_pump=$request['major_fuel_injection_pump'];
        $prehist->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
        $prehist->actual_end_date = date("Y-m-d");
        $prehist->save();

 if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
    
    //parts track link height
    public function checkGateTrackLinkHeightDisSave(Request $request)
    {
        $myrequest=$request->all();
        //dd($myrequest);


        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $loosepart_res = PartTrackLinkHeight ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartTrackLinkHeight();
                $loosepart->disassembly_status = 1;
            }
            else{
                $loosepart = PartTrackLinkHeight::find($loosepart_res[0]['id']);
                $loosepart->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $loosepart_res = PartTrackLinkHeight ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartTrackLinkHeight();
                $loosepart->assembly_status = 1;
            }
            else{
                $loosepart = PartTrackLinkHeight::find($loosepart_res[0]['id']);
                $loosepart->assembly_status = 1;
            }
        }


        $missing=$request['description'];

        if(isset($service->id)) {

            PartTrackLinkHeight::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();

            foreach ($missing as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $loosepart = new PartTrackLinkHeight();
                $loosepart->service_request_id = $service->id;
                $loosepart->dept_id = $dept_id;
                $loosepart->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $loosepart->assembly_status = isset($request['assembly_status']) ? '1':null;
                $loosepart->radio =  empty($request['radiotracklinkheig'][$key]) ? $request['radiotracklinkheigview'][$key]:$request['radiotracklinkheig'][$key];
                $loosepart->radio = empty($request['radiotracklinkheigview'][$key]) ? $request['radiotracklinkheig'][$key]:$request['radiotracklinkheigview'][$key];
                $loosepart->description = $request['description'][$key];
                $loosepart->bef_welding = $request['bef_welding'][$key];
                $loosepart->aft_welding=$request['aft_welding'][$key];
                $loosepart->remarks = $request['remarks'][$key];


                $loosepart->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $loosepart->actual_end_date = date("Y-m-d");

                $loosepart->save();


            }
        }
        $sec=8;
        $childorsub=23;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$loosepart->actual_start_date, $loosepart->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts track pitch
    public function checkGateTrackPitchDisSave(Request $request)
    {
        $myrequest=$request->all();
        //dd($myrequest);


        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $loosepart_res = PartTrackPitch ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartTrackPitch();
                $loosepart->disassembly_status = 1;
            }
            else{
                $loosepart = PartTrackPitch::find($loosepart_res[0]['id']);
                $loosepart->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $loosepart_res = PartTrackPitch ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartTrackPitch();
                $loosepart->assembly_status = 1;
            }
            else{
                $loosepart = PartTrackPitch::find($loosepart_res[0]['id']);
                $loosepart->assembly_status = 1;
            }
        }


        $missing=$request['description'];

        if(isset($service->id)) {

            PartTrackPitch::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();

            foreach ($missing as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $loosepart = new PartTrackPitch();
                $loosepart->service_request_id = $service->id;
                $loosepart->dept_id = $dept_id;
                $loosepart->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $loosepart->assembly_status = isset($request['assembly_status']) ? '1':null;
                $loosepart->radio =  empty($request['radiotrackpitch'][$key]) ? $request['radiotrackpitchview'][$key]:$request['radiotrackpitch'][$key];
                $loosepart->radio = empty($request['radiotrackpitchview'][$key]) ? $request['radiotrackpitch'][$key]:$request['radiotrackpitchview'][$key];
                $loosepart->description = $request['description'][$key];
                $loosepart->bef_assembly = $request['bef_assembly'][$key];
                $loosepart->aft_assembly=$request['aft_assembly'][$key];
                $loosepart->remarks = $request['remarks'][$key];


                $loosepart->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $loosepart->actual_end_date = date("Y-m-d");

                $loosepart->save();


            }
        }
        $sec=8;
        $childorsub=24;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$loosepart->actual_start_date, $loosepart->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts track link pin
    public function checkGateTrackLinkPinDisSave(Request $request)
    {
        $myrequest=$request->all();
        //dd($myrequest);


        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $loosepart_res = PartTrackLinkPin ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartTrackLinkPin();
                $loosepart->disassembly_status = 1;
            }
            else{
                $loosepart = PartTrackLinkPin::find($loosepart_res[0]['id']);
                $loosepart->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $loosepart_res = PartTrackLinkPin ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartTrackLinkPin();
                $loosepart->assembly_status = 1;
            }
            else{
                $loosepart = PartTrackLinkPin::find($loosepart_res[0]['id']);
                $loosepart->assembly_status = 1;
            }
        }


        $missing=$request['master_link'];

        if(isset($service->id)) {

            PartTrackLinkPin::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();

            foreach ($missing as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $loosepart = new PartTrackLinkPin();
                $loosepart->service_request_id = $service->id;
                $loosepart->dept_id = $dept_id;
                $loosepart->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $loosepart->assembly_status = isset($request['assembly_status']) ? '1':null;
                $loosepart->radio =  empty($request['radiotracklinkpin'][$key]) ? $request['radiotracklinkpinview'][$key]:$request['radiotracklinkpin'][$key];
                $loosepart->radio = empty($request['radiotracklinkpinview'][$key]) ? $request['radiotracklinkpin'][$key]:$request['radiotracklinkpinview'][$key];
                $loosepart->master_link = $request['master_link'][$key];
                $loosepart->before_after = $request['before_after'][$key];
                $loosepart->val_a=$request['val_a'][$key];
                $loosepart->val_b=$request['val_b'][$key];
                $loosepart->val_d=$request['val_d'][$key];
                $loosepart->val_e=$request['val_e'][$key];
                $loosepart->remarks = $request['remarks'][$key];


                $loosepart->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $loosepart->actual_end_date = date("Y-m-d");

                $loosepart->save();


            }
        }
        $sec=8;
        $childorsub=25;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$loosepart->actual_start_date, $loosepart->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts track link bush
    public function checkGateTrackLinkBushDisSave(Request $request)
    {
        $myrequest=$request->all();
        //dd($myrequest);


        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $loosepart_res = PartTrackLinkBush ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartTrackLinkBush();
                $loosepart->disassembly_status = 1;
            }
            else{
                $loosepart = PartTrackLinkBush::find($loosepart_res[0]['id']);
                $loosepart->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $loosepart_res = PartTrackLinkBush ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartTrackLinkBush();
                $loosepart->assembly_status = 1;
            }
            else{
                $loosepart = PartTrackLinkBush::find($loosepart_res[0]['id']);
                $loosepart->assembly_status = 1;
            }
        }


        $missing=$request['master_link'];

        if(isset($service->id)) {

            PartTrackLinkBush::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();

            foreach ($missing as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $loosepart = new PartTrackLinkBush();
                $loosepart->service_request_id = $service->id;
                $loosepart->dept_id = $dept_id;
                $loosepart->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $loosepart->assembly_status = isset($request['assembly_status']) ? '1':null;
                $loosepart->radio =  empty($request['radiotracklinkbush'][$key]) ? $request['radiotracklinkbushview'][$key]:$request['radiotracklinkbush'][$key];
                $loosepart->radio = empty($request['radiotracklinkbushview'][$key]) ? $request['radiotracklinkbush'][$key]:$request['radiotracklinkbushview'][$key];
                $loosepart->master_link = $request['master_link'][$key];
                $loosepart->before_after = $request['before_after'][$key];
                $loosepart->val_a=$request['val_a'][$key];
                $loosepart->val_b=$request['val_b'][$key];
                $loosepart->val_c=$request['val_c'][$key];
                //$loosepart->val_e=$request['val_e'][$key];
                $loosepart->remarks = $request['remarks'][$key];


                $loosepart->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $loosepart->actual_end_date = date("Y-m-d");

                $loosepart->save();


            }
        }
        $sec=8;
        $childorsub=26;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$loosepart->actual_start_date, $loosepart->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts track shoe
    public function checkGateTrackshoeDisSave(Request $request)
    {
        $myrequest=$request->all();
        //dd($myrequest);


        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $loosepart_res = PartTrackShoe ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartTrackShoe();
                $loosepart->disassembly_status = 1;
            }
            else{
                $loosepart = PartTrackShoe::find($loosepart_res[0]['id']);
                $loosepart->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $loosepart_res = PartTrackShoe ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartTrackShoe();
                $loosepart->assembly_status = 1;
            }
            else{
                $loosepart = PartTrackShoe::find($loosepart_res[0]['id']);
                $loosepart->assembly_status = 1;
            }
        }


        $missing=$request['description'];

        if(isset($service->id)) {

            PartTrackShoe::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();

            foreach ($missing as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $loosepart = new PartTrackShoe();
                $loosepart->service_request_id = $service->id;
                $loosepart->dept_id = $dept_id;
                $loosepart->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $loosepart->assembly_status = isset($request['assembly_status']) ? '1':null;
                $loosepart->radio =  empty($request['radiotrackshoe'][$key]) ? $request['radiotrackshoeview'][$key]:$request['radiotrackshoe'][$key];
                $loosepart->radio = empty($request['radiotrackshoeview'][$key]) ? $request['radiotrackshoe'][$key]:$request['radiotrackshoeview'][$key];
                $loosepart->description = $request['description'][$key];
                $loosepart->before_after = $request['before_after'][$key];
                $loosepart->grouser_height=$request['grouser_height'][$key];
                $loosepart->plate_thickness=$request['plate_thickness'][$key];
                $loosepart->shoe_width=$request['shoe_width'][$key];
                //$loosepart->val_e=$request['val_e'][$key];
                $loosepart->remarks = $request['remarks'][$key];


                $loosepart->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $loosepart->actual_end_date = date("Y-m-d");

                $loosepart->save();


            }
        }
        $sec=8;
        $childorsub=25;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$loosepart->actual_start_date, $loosepart->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts pin insp mea
    public function checkGatePinInspDisSave(Request $request)
    {
        $myrequest=$request->all();
        //dd($myrequest);


        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $loosepart_res = PartPinInspMea ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartPinInspMea();
                $loosepart->disassembly_status = 1;
            }
            else{
                $loosepart = PartPinInspMea::find($loosepart_res[0]['id']);
                $loosepart->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $loosepart_res = PartPinInspMea ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartPinInspMea();
                $loosepart->assembly_status = 1;
            }
            else{
                $loosepart = PartPinInspMea::find($loosepart_res[0]['id']);
                $loosepart->assembly_status = 1;
            }
        }


        $missing=$request['bush_no'];

        if(isset($service->id)) {

            PartPinInspMea::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();

            foreach ($missing as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $loosepart = new PartPinInspMea();
                $loosepart->service_request_id = $service->id;
                $loosepart->dept_id = $dept_id;
                $loosepart->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $loosepart->assembly_status = isset($request['assembly_status']) ? '1':null;
                $loosepart->radio =  empty($request['radiopininspmea'][$key]) ? $request['radiopininspmeaview'][$key]:$request['radiopininspmea'][$key];
                $loosepart->radio = empty($request['radiopininspmeaview'][$key]) ? $request['radiopininspmea'][$key]:$request['radiopininspmeaview'][$key];
                $loosepart->description = $request['description'][$key];
                $loosepart->bush_no = $request['bush_no'][$key];
                $loosepart->measurement_val=$request['measurement_val'][$key];

                //$loosepart->val_e=$request['val_e'][$key];
                $loosepart->remarks = $request['remarks'][$key];


                $loosepart->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $loosepart->actual_end_date = date("Y-m-d");

                $loosepart->save();


            }
        }
        $sec=8;
        $childorsub=28;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$loosepart->actual_start_date, $loosepart->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts bush insp mea
    public function checkGateBushInspDisSave(Request $request)
    {
        $myrequest=$request->all();
        //dd($myrequest);


        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $loosepart_res = PartBushInspMea ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartBushInspMea();
                $loosepart->disassembly_status = 1;
            }
            else{
                $loosepart = PartBushInspMea::find($loosepart_res[0]['id']);
                $loosepart->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $loosepart_res = PartBushInspMea ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new PartBushInspMea();
                $loosepart->assembly_status = 1;
            }
            else{
                $loosepart = PartBushInspMea::find($loosepart_res[0]['id']);
                $loosepart->assembly_status = 1;
            }
        }


        $missing=$request['bush_no1'];

        if(isset($service->id)) {

            PartBushInspMea::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();

            foreach ($missing as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $loosepart = new PartBushInspMea();
                $loosepart->service_request_id = $service->id;
                $loosepart->dept_id = $dept_id;
                $loosepart->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $loosepart->assembly_status = isset($request['assembly_status']) ? '1':null;
                $loosepart->radio =  empty($request['radiobushinspmea'][$key]) ? $request['radiobushinspmeaview'][$key]:$request['radiobushinspmea'][$key];
                $loosepart->radio = empty($request['radiobushinspmeaview'][$key]) ? $request['radiobushinspmea'][$key]:$request['radiobushinspmeaview'][$key];
                $loosepart->description = $request['description'][$key];
                $loosepart->bush_no = $request['bush_no1'][$key];
                $loosepart->measurement_val=$request['measurement_val'][$key];

                //$loosepart->val_e=$request['val_e'][$key];
                $loosepart->remarks = $request['remarks'][$key];


                $loosepart->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $loosepart->actual_end_date = date("Y-m-d");

                $loosepart->save();


            }
        }
        $sec=8;
        $childorsub=27;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$loosepart->actual_start_date, $loosepart->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
	
	//commercial
   public function checkGateCommerciallogisticDisSave(Request $request)
    {

        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $cmmercial_res = MasterCommercialValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
           
            if(count($cmmercial_res)<=0){
                $cmmercial = new MasterCommercialValues();
                $cmmercial->disassembly_status = 1;
            }
            else{
                $cmmercial = MasterCommercialValues::find($cmmercial_res[0]['id']);
                $cmmercial->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cmmercial_res = MasterCommercialValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cmmercial_res)<=0){
                $cmmercial = new MasterCommercialValues();
                $cmmercial->assembly_status = 1;
            }
            else{
                $cmmercial = MasterCommercialValues::find($cmmercial_res[0]['id']);
                $cmmercial->assembly_status = 1;
            }
        }


        /* $service = Service::find($request['service_id']);
         $cmmercial=MasterCommercialValues::where('service_request_id','=',$service->id)
             ->where('dept_id','=',$request['dept_id'])->get()->first();
 //dd($cmmercial);exit;
         if(!isset($cmmercial)){
             $cmmercial =new MasterCommercialValues();
         }*/
        // if(isset($cmmercial->id))
        $commercialval=$request->all();

        //$obj = new MasterCommercialValues();

        if(isset($service->id)) {
            $cmmercial->service_request_id = $service->id;
            $cmmercial->dept_id = $dept_id;
             $cmmercial->disassembly_status = isset($request['disassembly_status']) ? '1':null;
            $cmmercial->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cmmercial->values = json_encode($commercialval);
             $cmmercial->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
             $cmmercial->actual_end_date = date("Y-m-d");
            $cmmercial->save();

           

        }
        
         $sec=3;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$cmmercial->actual_start_date, $cmmercial->actual_end_date);

 if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
    //cc external
   public function checkGateCcexternalwashDisSave(Request $request)
    {
        //$myrequest=$request->all();
        // dd($myrequest);
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $exterwash_res = MasterCcinspectionExternalWashDetails ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($exterwash_res)<=0){
                $exterwash = new MasterCcinspectionExternalWashDetails();
                $exterwash->disassembly_status = 1;
            }
            else{
                $exterwash = MasterCcinspectionExternalWashDetails::find($exterwash_res[0]['id']);
                $exterwash->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $exterwash_res = MasterCcinspectionExternalWashDetails ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($exterwash_res)<=0){
                $exterwash = new MasterCcinspectionExternalWashDetails();
                $exterwash->assembly_status = 1;
            }
            else{
                $exterwash = MasterCcinspectionExternalWashDetails::find($exterwash_res[0]['id']);
                $exterwash->assembly_status = 1;
            }
        }


        /*$externalwas=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
//dd($cmmercial);exit;
        if(!isset($externalwas)){
            $externalwas =new MasterCcinspectionExternalWashDetails();
        }*/

        $exterwashal=$request->all();

        // $obj = new MasterCcinspectionExternalWashDetails();

        if(isset($service->id)) {
            $exterwash->service_request_id = $service->id;
            $exterwash->dept_id = $dept_id;
             $exterwash->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $exterwash->assembly_status = isset($request['assembly_status']) ? '1':null;
             $exterwash->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $exterwash->assembly_status = isset($request['assembly_status']) ? '1':null;
            $exterwash->values = json_encode($exterwashal);
            $exterwash->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $exterwash->actual_end_date = date("Y-m-d");
            $exterwash->save();

           

        }
        
          $sec=5;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$exterwash->actual_start_date, $exterwash->actual_end_date);
        
 if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

     //CcinspectionBeforeStartAssembly
     public function inspectionbeforestartassembly(Request $request)
    {
        /*$service = Service::find($request['service_id']);
        $externalwas=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();*/

        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $beforeassembly_res = MasterCCinspectionBeforeStartAssembly ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($beforeassembly_res)<=0){
                $beforeassembly = new MasterCCinspectionBeforeStartAssembly();
                $beforeassembly->disassembly_status = 1;
            }
            else{
                $beforeassembly = MasterCCinspectionBeforeStartAssembly::find($beforeassembly_res[0]['id']);
                $beforeassembly->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $beforeassembly_res = MasterCCinspectionBeforeStartAssembly ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($beforeassembly_res)<=0){
                $beforeassembly = new MasterCCinspectionBeforeStartAssembly();
                $beforeassembly->assembly_status = 1;
            }
            else{
                $beforeassembly = MasterCCinspectionBeforeStartAssembly::find($beforeassembly_res[0]['id']);
                $beforeassembly->assembly_status = 1;
            }
        }


        /*$beforeassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();

        if(!isset($beforeassembly)){
            $beforeassembly =new MasterCCinspectionBeforeStartAssembly();
        }*/
        $beforestart=$request->all();

        if(isset($service->id)) {
            $beforeassembly->service_request_id = $service->id;
            $beforeassembly->dept_id = $dept_id;
             $beforeassembly->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $beforeassembly->assembly_status = isset($request['assembly_status']) ? '1':null;
            $beforeassembly->ccvalues = json_encode($beforestart);
             $beforeassembly->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
           $beforeassembly->actual_end_date = date("Y-m-d");
            $beforeassembly->save();

        }
        
          $sec=14;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$beforeassembly->actual_start_date, $beforeassembly->actual_end_date);
       
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

   //cc parts clean
   public function checkGateCcpartcleanDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $cleaning_res = MasterCcinspectionPartCleanDetails ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cleaning_res)<=0){
                $cleaning = new MasterCcinspectionPartCleanDetails();
                $cleaning->disassembly_status = 1;
            }
            else{
                $cleaning = MasterCcinspectionPartCleanDetails::find($cleaning_res[0]['id']);
                $cleaning->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cleaning_res = MasterCcinspectionPartCleanDetails ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cleaning_res)<=0){
                $cleaning = new MasterCcinspectionPartCleanDetails();
                $cleaning->assembly_status = 1;
            }
            else{
                $cleaning = MasterCcinspectionPartCleanDetails::find($cleaning_res[0]['id']);
                $cleaning->assembly_status = 1;
            }
        }
        /* $cleaning=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
             ->where('dept_id','=',$request['dept_id'])->get()->first();
 //dd($cmmercial);exit;
         if(!isset($cleaning)){
             $cleaning =new MasterCcinspectionPartCleanDetails();
         }*/
        $partclean=$request->all();

        //$obj = new MasterCcinspectionPartCleanDetails();

        if(isset($service->id)) {
            $cleaning->service_request_id = $service->id;
            $cleaning->dept_id = $dept_id;
            $cleaning->values = json_encode($partclean);
            $cleaning->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cleaning->actual_end_date = date("Y-m-d");
            $cleaning->save();

            //send Notification

        }
$sec=6;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$cleaning->actual_start_date, $cleaning->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
   //loose parts
     public function checkGateLoosepartsDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $loosepart_res = MasterLoosepartDis ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new MasterLoosepartDis();
                $loosepart->disassembly_status = 1;
            }
            else{
                $loosepart = MasterLoosepartDis::find($loosepart_res[0]['id']);
                $loosepart->disassembly_status = 1;
            }

        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];

            $assembly_status = 1;

            $loosepart_res = MasterLoosepartDis ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new MasterLoosepartDis();
                $loosepart->assembly_status = 1;
            }
            else{
                $loosepart = MasterLoosepartDis::find($loosepart_res[0]['id']);
                $loosepart->assembly_status = 1;
            }
        }
        $file=$request['part_description'];
        if(isset($service->id)){

            MasterLoosepartDis::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            foreach($file as $key=>$val){
                // echo'<pre>';print_r($val);echo'<pre>';
                //$obj->photograph=$request['photograph'];

                $txt= $val;


                $loosepart=new MasterLoosepartDis();
                $loosepart->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $loosepart->assembly_status = isset($request['assembly_status']) ? '1':null;
                $loosepart->service_request_id = $service->id;
                $loosepart->dept_id = $dept_id;
                $loosepart->part_no=$request['part_no'][$key];
                $loosepart->part_description=$request['part_description'][$key];
                $loosepart->qty=$request['qty'][$key];
                $loosepart->part_condition=$request['part_condition'][$key];
                $loosepart->photograph = Null ;
                $loosepart->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $loosepart->actual_end_date = date("Y-m-d");

                //echo '<pre>';print_r($loosepart);
                $loosepart->save();

            }
           // exit;


        }
        
        $sec=4;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$loosepart->actual_start_date, $loosepart->actual_end_date);


        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
   //missing parst
     public function checkGateMissingdamagepartDisSave(Request $request)
    {
        // $myrequest=$request->all();
        // dd($myrequest);


        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $loosepart_res = MasterMissingdamagePartDis ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new MasterMissingdamagePartDis();
                $loosepart->disassembly_status = 1;
            }
            else{
                $loosepart = MasterMissingdamagePartDis::find($loosepart_res[0]['id']);
                $loosepart->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $loosepart_res = MasterMissingdamagePartDis ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($loosepart_res)<=0){
                $loosepart = new MasterMissingdamagePartDis();
                $loosepart->assembly_status = 1;
            }
            else{
                $loosepart = MasterMissingdamagePartDis::find($loosepart_res[0]['id']);
                $loosepart->assembly_status = 1;
            }
        }


        $missing=$request['missing_damage'];

        if(isset($service->id)) {

            MasterMissingdamagePartDis::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();

            foreach ($missing as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $loosepart = new MasterMissingdamagePartDis();
                $loosepart->service_request_id = $service->id;
                $loosepart->dept_id = $dept_id;
                $loosepart->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $loosepart->assembly_status = isset($request['assembly_status']) ? '1':null;
                $loosepart->description = $request['description'][$key];
                $loosepart->qty = $request['qty'][$key];
                $loosepart->part_no=$request['part_no'][$key];
                $loosepart->missing_damage = $txt;
				if(!empty($request['photo'][$key])){
                $loosepart->photo = $request['photo'][$key];
				}
                $loosepart->damage_details = $request['damage_details'][$key];
                $loosepart->action_taken = $request['action_taken'][$key];
               $loosepart->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $loosepart->actual_end_date = date("Y-m-d");

                $loosepart->save();


            }
        }
        
         $sec=7;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$loosepart->actual_start_date, $loosepart->actual_end_date);
        
         if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
    
    //status revision
    public function statusrevision(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = StatusRevision ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $statusrevision = new StatusRevision();
                $statusrevision->disassembly_status = 1;
            }
            else{
                $statusrevision = StatusRevision::find($cylhead_res[0]['id']);
                $statusrevision->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = StatusRevision ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $statusrevision = new StatusRevision();
                $statusrevision->assembly_status = 1;
            }
            else{
                $statusrevision = StatusRevision::find($cylhead_res[0]['id']);
                $statusrevision->assembly_status = 1;
            }
        }




       // $service = Service::find($request['service_id']);
        $status=$request['details_of_amendment'];
        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            StatusRevision::where('service_request_id',$request['service_id'])->where('dept_id','=',$dept_id)->delete();
            foreach ($status as $key => $val) {
                //echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;
                $statusrevision = new StatusRevision();
                $statusrevision->service_request_id = $service->id;
                $statusrevision->dept_id = $dept_id;
                 $statusrevision->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $statusrevision->assembly_status = isset($request['assembly_status']) ? '1':null;
                $statusrevision->details_of_amendment= $txt;
                $statusrevision->revision_no = $request['revision_no'][$key];
                $statusrevision->page_no= $request['page_no'][$key];
                $statusrevision->reason_for_amendment = $request['reason_for_amendment'][$key];
                $statusrevision->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $statusrevision->actual_end_date = date("Y-m-d");
                $statusrevision->save();

            }
        }
        
         $sec=12;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$statusrevision->actual_start_date, $statusrevision->actual_end_date);
       
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
      //disassembly cleaning
      public function checkgatedisassembly(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $cleaning_res = MasterDissamblyCleaningInspection ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cleaning_res)<=0){
                $masterdissambly = new MasterDissamblyCleaningInspection();
                $masterdissambly->disassembly_status = 1;
            }
            else{
                $masterdissambly = MasterDissamblyCleaningInspection::find($cleaning_res[0]['id']);
                $masterdissambly->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cleaning_res = MasterDissamblyCleaningInspection ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cleaning_res)<=0){
                $masterdissambly = new MasterDissamblyCleaningInspection();
                $masterdissambly->assembly_status = 1;
            }
            else{
                $masterdissambly = MasterDissamblyCleaningInspection::find($cleaning_res[0]['id']);
                $masterdissambly->assembly_status = 1;
            }
        }

        if(isset($service->id)) {
            $masterdissambly->service_request_id = $service->id;
            $masterdissambly->dept_id = $dept_id;
            $masterdissambly->disassembly_status = isset($request['disassembly_status']) ? '1':null;
            $masterdissambly->assembly_status = isset($request['assembly_status']) ? '1':null;
            $masterdissambly->comp_dissambly_start_date = Carbon::createFromFormat('d/m/Y', $request['comp_dissambly_start_date'])->format('Y-m-d');
            $masterdissambly->comp_dissambly_end_date = Carbon::createFromFormat('d/m/Y', $request['comp_dissambly_end_date'])->format('Y-m-d');
            $masterdissambly->comp_cleaning_start_date = Carbon::createFromFormat('d/m/Y', $request['comp_cleaning_start_date'])->format('Y-m-d');
            $masterdissambly->comp_cleaning_end_date = Carbon::createFromFormat('d/m/Y', $request['comp_cleaning_end_date'])->format('Y-m-d');
            $masterdissambly->comp_inspection_assessment_start_date = Carbon::createFromFormat('d/m/Y', $request['comp_inspection_assessment_start_date'])->format('Y-m-d');
            $masterdissambly->comp_inspection_assessment_end_date = Carbon::createFromFormat('d/m/Y', $request['comp_inspection_assessment_end_date'])->format('Y-m-d');
            $masterdissambly->comp_offer_send_date = Carbon::createFromFormat('d/m/Y', $request['comp_offer_send_date'])->format('Y-m-d');
			
            $masterdissambly->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $masterdissambly->actual_end_date = date("Y-m-d");
            $masterdissambly->save();

            //send Notification

        }
$sec=13;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$masterdissambly->actual_start_date, $masterdissambly->actual_end_date);


        //old
       /* $service = Service::find($request['service_id']);
        $disassembly=$request['comp_dissambly_start_date'];
        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();

            foreach ($disassembly as $key => $val) {
                // echo'<pre>';//print_r($val);
                $txt= $val;
                $masterdissambly = new MasterDissamblyCleaningInspection();
                $masterdissambly->service_request_id = $service->id;

                $masterdissambly->dept_id = $request['dept_id'];


                $masterdissambly->comp_dissambly_start_date = $txt;
                $masterdissambly->comp_dissambly_end_date = $request['comp_dissambly_end_date'][$key];
                $masterdissambly->comp_cleaning_start_date = $request['comp_cleaning_start_date'][$key];
                $masterdissambly->comp_cleaning_end_date = $request['comp_cleaning_end_date'][$key];
                $masterdissambly->comp_inspection_assessment_start_date = $request['comp_inspection_assessment_start_date'][$key];
                $masterdissambly->comp_inspection_assessment_end_date = $request['comp_inspection_assessment_end_date'][$key];
                $masterdissambly->comp_offer_send_date = $request['comp_offer_send_date'][$key];
                $masterdissambly->save();
            }
        }*/
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
 

    //list of sal
   public function checkGateListofsalvageDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = MasterListofSalvageDis ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new MasterListofSalvageDis();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = MasterListofSalvageDis::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = MasterListofSalvageDis ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new MasterListofSalvageDis();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = MasterListofSalvageDis::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }



        $salvage=$request['vendor_name'];



        if(isset($service->id)) {
            MasterListofSalvageDis::where('service_request_id','=',$request['service_id'])->where('dept_id','=',$dept_id)->delete();
            foreach ($salvage as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $cylhead = new MasterListofSalvageDis();
                $cylhead->service_request_id = $service->id;
                $cylhead->dept_id = $dept_id;
                $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
                $cylhead->component_name =$request['component_name'][$key];
                $cylhead->description = $request['description'][$key];
                $cylhead->qty = $request['qty'][$key];
				$cylhead->salvage_value = $request['salvage_value'][$key];
				if(!empty($request['out_date'][$key])){
                $cylhead->out_date = Carbon::createFromFormat('d/m/Y', $request['out_date'][$key])->format('Y-m-d');
				}
				if(!empty($request['in_date'][$key])){
                $cylhead->in_date = Carbon::createFromFormat('d/m/Y', $request['in_date'][$key])->format('Y-m-d');
				}
                $cylhead->vendor_name = $txt;
                $cylhead->inspected_by = $request['inspected_by'][$key];
                $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                        $cylhead->actual_end_date = date("Y-m-d");

                $cylhead->save();

            }
        }
        
        $sec=9;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
       if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
     //parts cylinder head
    public function checkGatePartinspectionCylinderheadDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $cylhead_res = MasterPartsInspectionCylinderHeadValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new MasterPartsInspectionCylinderHeadValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = MasterPartsInspectionCylinderHeadValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = MasterPartsInspectionCylinderHeadValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new MasterPartsInspectionCylinderHeadValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = MasterPartsInspectionCylinderHeadValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }

        /*$cylhead=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
//dd($cmmercial);exit;
        if(!isset($cylhead)){
            $cylhead =new MasterPartsInspectionCylinderHeadValues();
        }*/

        $partscylinder=$request->all();

        // $obj = new MasterPartsInspectionCylinderHeadValues();

        if(isset($service->id)) {
            $cylhead->service_request_id = $service->id;
            $cylhead->dept_id = $dept_id;
            $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cylhead->details = json_encode($partscylinder);
             $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
            $cylhead->save();

            //send Notification

        }

$sec=8;
        $childorsub=5;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //Parts Cooler Inspection
    public function partinspectionCoolerInspSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $cylhead_res = CoolerInspectionValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new CoolerInspectionValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = CoolerInspectionValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = CoolerInspectionValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new CoolerInspectionValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = CoolerInspectionValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }

        /*$cylhead=CoolerInspectionValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
//dd($cmmercial);exit;
        if(!isset($cylhead)){
            $cylhead =new CoolerInspectionValues();
        }*/
        $partscooler=$request->all();

        // $obj = new MasterPartsInspectionCylinderHeadValues();

        if(isset($service->id)) {
            $cylhead->service_request_id = $service->id;
            $cylhead->dept_id = $dept_id;
            $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cylhead->values = json_encode($partscooler);
             $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
            $cylhead->save();

            //send Notification

        }

 $sec=8;
        $childorsub=12;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
//parts other component 
     public function checkGatePartinspectionOthercomponentDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $cylhead_res = MasterPartOthercomponentValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new MasterPartOthercomponentValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = MasterPartOthercomponentValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = MasterPartOthercomponentValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new MasterPartOthercomponentValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = MasterPartOthercomponentValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }

        /*$partothercomp=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partothercomp)){
            $partothercomp =new MasterPartOthercomponentValues();
        }*/


        $othercomp = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {
            $cylhead->service_request_id = $service->id;
            $cylhead->dept_id = $dept_id;
            $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cylhead->values = json_encode($othercomp);
             $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
            $cylhead->save();
        }
        
        
         $sec=8;
        $childorsub=6;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        //send Notification
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //PartsFanDrive
   public function checkGatePartinspectionFandriveDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $partfan_res = MasterPartFanDriveValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partfan_res)<=0){
                $partfan = new MasterPartFanDriveValues();
                $partfan->disassembly_status = 1;
            }
            else{
                $partfan = MasterPartFanDriveValues::find($partfan_res[0]['id']);
                $partfan->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $partfan_res = MasterPartFanDriveValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partfan_res)<=0){
                $partfan = new MasterPartFanDriveValues();
                $partfan->assembly_status = 1;
            }
            else{
                $partfan = MasterPartFanDriveValues::find($partfan_res[0]['id']);
                $partfan->assembly_status = 1;
            }
        }

        /*$partfan=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partfan)){
            $partfan =new MasterPartFanDriveValues();
        }*/


        $othercomp = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {

            $partfan->service_request_id = $service->id;
            $partfan->dept_id = $dept_id;
            $partfan->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $partfan->assembly_status = isset($request['assembly_status']) ? '1':null;
            $partfan->values = json_encode($othercomp);
             $partfan->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $partfan->actual_end_date = date("Y-m-d");

            $partfan->save();
        }
        
        $sec=8;
        $childorsub=8;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$partfan->actual_start_date, $partfan->actual_end_date);

        //send Notification
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }

    //parts Oil Pump
    public function checkGatePartinspectionOilpumpDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $partfan_res = MasterPartOilPumpValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partfan_res)<=0){
                $partfan = new MasterPartOilPumpValues();
                $partfan->disassembly_status = 1;
            }
            else{
                $partfan = MasterPartOilPumpValues::find($partfan_res[0]['id']);
                $partfan->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $partfan_res = MasterPartOilPumpValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partfan_res)<=0){
                $partfan = new MasterPartOilPumpValues();
                $partfan->assembly_status = 1;
            }
            else{
                $partfan = MasterPartOilPumpValues::find($partfan_res[0]['id']);
                $partfan->assembly_status = 1;
            }
        }


      /*  $partoil=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partoil)){
            $partoil =new MasterPartOilPumpValues();
        }*/


        $othercomp = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {
            $partfan->service_request_id = $service->id;
            $partfan->dept_id = $dept_id;
             $partfan->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $partfan->assembly_status = isset($request['assembly_status']) ? '1':null;
            $partfan->values = json_encode($othercomp);
             $partfan->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $partfan->actual_end_date = date("Y-m-d");
            $partfan->save();
        }
        
        
        $sec=8;
        $childorsub=10;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$partfan->actual_start_date, $partfan->actual_end_date);
        
        
        //send Notification
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }

    //parts Air Compressor
    public function checkGatePartinspectionAircompressorDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $partfan_res = MasterPartAirCompressorValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partfan_res)<=0){
                $partfan = new MasterPartAirCompressorValues();
                $partfan->disassembly_status = 1;
            }
            else{
                $partfan = MasterPartAirCompressorValues::find($partfan_res[0]['id']);
                $partfan->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $partfan_res = MasterPartAirCompressorValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partfan_res)<=0){
                $partfan = new MasterPartAirCompressorValues();
                $partfan->assembly_status = 1;
            }
            else{
                $partfan = MasterPartAirCompressorValues::find($partfan_res[0]['id']);
                $partfan->assembly_status = 1;
            }
        }

        /*$partair=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partair)){
            $partair =new MasterPartAirCompressorValues();
        }*/


        $othercomp = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {
            $partfan->service_request_id = $service->id;
            $partfan->dept_id = $dept_id;
             $partfan->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $partfan->assembly_status = isset($request['assembly_status']) ? '1':null;
            $partfan->values = json_encode($othercomp);
             $partfan->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $partfan->actual_end_date = date("Y-m-d");
            $partfan->save();
        }
        
        
         $sec=8;
        $childorsub=11;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$partfan->actual_start_date, $partfan->actual_end_date);
        //send Notification
         if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }

    //parts Water Pump
    public function checkGatePartinspectionwaterpumpDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $partfan_res = MasterPartWaterPumpValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partfan_res)<=0){
                $partfan = new MasterPartWaterPumpValues();
                $partfan->disassembly_status = 1;
            }
            else{
                $partfan = MasterPartWaterPumpValues::find($partfan_res[0]['id']);
                $partfan->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $partfan_res = MasterPartWaterPumpValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partfan_res)<=0){
                $partfan = new MasterPartWaterPumpValues();
                $partfan->assembly_status = 1;
            }
            else{
                $partfan = MasterPartWaterPumpValues::find($partfan_res[0]['id']);
                $partfan->assembly_status = 1;
            }
        }

        /*$partwater=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partwater)){
            $partwater =new MasterPartWaterPumpValues();
        }*/


        $othercomp = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {
            $partfan->service_request_id = $service->id;
            $partfan->dept_id = $dept_id;
             $partfan->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $partfan->assembly_status = isset($request['assembly_status']) ? '1':null;
            $partfan->values = json_encode($othercomp);
             $partfan->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $partfan->actual_end_date = date("Y-m-d");
            $partfan->save();
        }
        
        $sec=8;
        $childorsub=7;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$partfan->actual_start_date, $partfan->actual_end_date);
        
        //send Notification
       if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }

//connection rod
    public function checkGatePartinspectionConnectingrodDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $connectingrod_res = MasterPartConnectingRodValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($connectingrod_res)<=0){
                $connectingrod = new MasterPartConnectingRodValues();
                $connectingrod->disassembly_status = 1;
            }
            else{
                $connectingrod = MasterPartConnectingRodValues::find($connectingrod_res[0]['id']);
                $connectingrod->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $connectingrod_res = MasterPartConnectingRodValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($connectingrod_res)<=0){
                $connectingrod = new MasterPartConnectingRodValues();
                $connectingrod->assembly_status = 1;
            }
            else{
                $connectingrod = MasterPartConnectingRodValues::find($connectingrod_res[0]['id']);
                $connectingrod->assembly_status = 1;
            }
        }

        /*$connectingrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($connectingrod)){
            $connectingrod =new MasterPartConnectingRodValues();
        }*/
        $partconrod=$request->all();

        //$obj = new MasterCcinspectionPartCleanDetails();

        if(isset($service->id)) {
            $connectingrod->service_request_id = $service->id;
            $connectingrod->dept_id = $dept_id;
             $connectingrod->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $connectingrod->assembly_status = isset($request['assembly_status']) ? '1':null;
            $connectingrod->values = json_encode($partconrod);
             $connectingrod->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $connectingrod->actual_end_date = date("Y-m-d");
            $connectingrod->save();

            //send Notification

        }
 $sec=8;
        $childorsub=4;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$connectingrod->actual_start_date, $connectingrod->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

// parts cylinder block main
     public function checkGatePartinspectionCylinderblockDisSave(Request $request)
    {

        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $partcylinderblock_res = MasterPartCylinderHeadValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partcylinderblock_res)<=0){
                $partcylinderblock = new MasterPartCylinderHeadValues();
                $partcylinderblock->disassembly_status = 1;
            }
            else{
                $partcylinderblock = MasterPartCylinderHeadValues::find($partcylinderblock_res[0]['id']);
                $partcylinderblock->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $partcylinderblock_res = MasterPartCylinderHeadValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partcylinderblock_res)<=0){
                $partcylinderblock = new MasterConRodBushReplacementValues();
                $partcylinderblock->assembly_status = 1;
            }
            else{
                $partcylinderblock = MasterPartCylinderHeadValues::find($partcylinderblock_res[0]['id']);
                $partcylinderblock->assembly_status = 1;
            }
        }

       /* $partcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partcylinderblock)){
            $partcylinderblock =new MasterPartCylinderHeadValues();
        }*/


        $cyblockdetails = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {
            $partcylinderblock->service_request_id = $service->id;
            $partcylinderblock->dept_id =$dept_id;
             $partcylinderblock->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $partcylinderblock->assembly_status = isset($request['assembly_status']) ? '1':null;
            $partcylinderblock->values = json_encode($cyblockdetails);
             $partcylinderblock->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $partcylinderblock->actual_end_date = date("Y-m-d");
            $partcylinderblock->save();
        }
        
        
        $sec=8;
        $childorsub=1;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$partcylinderblock->actual_start_date, $partcylinderblock->actual_end_date);

        //send Notification
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }

    // parts cylinder block linear
    public function checkGatePartinspectionCylinderblockLinearSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $partcylinderblock_res = PartCylinderBlockLinearValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partcylinderblock_res)<=0){
                $partcylinderblock = new PartCylinderBlockLinearValues();
                $partcylinderblock->disassembly_status = 1;
            }
            else{
                $partcylinderblock = PartCylinderBlockLinearValues::find($partcylinderblock_res[0]['id']);
                $partcylinderblock->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $partcylinderblock_res = PartCylinderBlockLinearValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partcylinderblock_res)<=0){
                $partcylinderblock = new PartCylinderBlockLinearValues();
                $partcylinderblock->assembly_status = 1;
            }
            else{
                $partcylinderblock = PartCylinderBlockLinearValues::find($partcylinderblock_res[0]['id']);
                $partcylinderblock->assembly_status = 1;
            }
        }




        /*$partcylinderblock=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partcylinderblock)){
            $partcylinderblock =new PartCylinderBlockLinearValues();
        }*/


        $cyblockdetails = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {
            $partcylinderblock->service_request_id = $service->id;
            $partcylinderblock->dept_id =$dept_id;
            $partcylinderblock->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $partcylinderblock->assembly_status = isset($request['assembly_status']) ? '1':null;
            $partcylinderblock->values = json_encode($cyblockdetails);
            $partcylinderblock->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $partcylinderblock->actual_end_date = date("Y-m-d");
            $partcylinderblock->save();
        }
        
        
        $sec=8;
        $childorsub=2;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$partcylinderblock->actual_start_date, $partcylinderblock->actual_end_date);

        //send Notification
       if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }

    // parts cylinder block cam bore
     public function checkGatePartinspectionCylinderblockCamboreSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $partcylinderblock_res = PartCylinderBlockCamboreValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partcylinderblock_res)<=0){
                $partcylinderblock = new PartCylinderBlockCamboreValues();
                $partcylinderblock->disassembly_status = 1;
            }
            else{
                $partcylinderblock = PartCylinderBlockCamboreValues::find($partcylinderblock_res[0]['id']);
                $partcylinderblock->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $partcylinderblock_res = PartCylinderBlockCamboreValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($partcylinderblock_res)<=0){
                $partcylinderblock = new PartCylinderBlockCamboreValues();
                $partcylinderblock->assembly_status = 1;
            }
            else{
                $partcylinderblock = PartCylinderBlockCamboreValues::find($partcylinderblock_res[0]['id']);
                $partcylinderblock->assembly_status = 1;
            }
        }

       


        $cyblockdetails = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {
            $partcylinderblock->service_request_id = $service->id;
            $partcylinderblock->dept_id = $dept_id;
            $partcylinderblock->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $partcylinderblock->assembly_status = isset($request['assembly_status']) ? '1':null;
            $partcylinderblock->values = json_encode($cyblockdetails);
            $partcylinderblock->actual_start_date =Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $partcylinderblock->actual_end_date = date("Y-m-d");
            $partcylinderblock->save();
        }
        
        $sec=8;
        $childorsub=15;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$partcylinderblock->actual_start_date, $partcylinderblock->actual_end_date);
        //send Notification
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }

    //parts cylinder block top deck
    public function checkGatePartinspectionCylinderblockTopdeckSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = PartCylinderBlockTopDeckValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartCylinderBlockTopDeckValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = PartCylinderBlockTopDeckValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = PartCylinderBlockTopDeckValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartCylinderBlockTopDeckValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = PartCylinderBlockTopDeckValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        
        $partscylinder=$request->all();

        // $obj = new MasterPartsInspectionCylinderHeadValues();

        if(isset($service->id)) {
            $cylhead->service_request_id = $service->id;
            $cylhead->dept_id = $dept_id;
            $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cylhead->values = json_encode($partscylinder);
             $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
            $cylhead->save();

            //send Notification

        }
     $sec=8;
        $childorsub=3;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);


        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts cylinder block thread
   public function checkGatePartinspectionCylinderblockThreadSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = PartCylinderBlockThreadValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartCylinderBlockThreadValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = PartCylinderBlockThreadValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = PartCylinderBlockThreadValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartCylinderBlockThreadValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = PartCylinderBlockThreadValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        /* $cylhead=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
             ->where('dept_id','=',$request['dept_id'])->get()->first();
 //dd($cmmercial);exit;
         if(!isset($cylhead)){
             $cylhead =new PartCylinderBlockThreadValues();
         }*/
        $partscylinder=$request->all();

        // $obj = new MasterPartsInspectionCylinderHeadValues();

        if(isset($service->id)) {
            $cylhead->service_request_id = $service->id;
            $cylhead->dept_id = $dept_id;
            $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cylhead->values = json_encode($partscylinder);
            $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
            $cylhead->save();

            //send Notification

        }

$sec=8;
        $childorsub=4;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);

         if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts cylinder block bush bore
    public function checkGatePartinspectionCylinderblockBushboreSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = PartCylinderBlockBushboreValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartCylinderBlockBushboreValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = PartCylinderBlockBushboreValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = PartCylinderBlockBushboreValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartCylinderBlockBushboreValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = PartCylinderBlockBushboreValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        /*$cylhead=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
//dd($cmmercial);exit;
        if(!isset($cylhead)){
            $cylhead =new PartCylinderBlockBushboreValues();
        }*/
        $partscylinder=$request->all();

        // $obj = new MasterPartsInspectionCylinderHeadValues();

        if(isset($service->id)) {
            $cylhead->service_request_id = $service->id;
            $cylhead->dept_id = $dept_id;
            $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cylhead->values = json_encode($partscylinder);
            $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
            //$cylhead->actual_start_date = $request['actual_start_date'];
            //$cylhead->actual_end_date = date("Y-m-d");
            $cylhead->save();

            //send Notification

        }
$sec=8;
        $childorsub=8;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);


        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts cylinder block cap no
   public function checkGatePartinspectionCylinderblockCapnoSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = PartCylinderBlockCapNoValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartCylinderBlockCapNoValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = PartCylinderBlockCapNoValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = PartCylinderBlockCapNoValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartCylinderBlockCapNoValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = PartCylinderBlockCapNoValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        /*$cylhead=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
//dd($cmmercial);exit;
        if(!isset($cylhead)){
            $cylhead =new PartCylinderBlockCapNoValues();
        }*/
        $partscylinder=$request->all();

        // $obj = new MasterPartsInspectionCylinderHeadValues();

        if(isset($service->id)) {
            $cylhead->service_request_id = $service->id;
            $cylhead->dept_id = $dept_id;
            $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cylhead->values = json_encode($partscylinder);
            $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
            $cylhead->save();

            //send Notification

        }

$sec=8;
        $childorsub=9;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }


    //crankshaft
   public function checkGatePartinspectionCrankshaftDisSave(Request $request)
    {
        //$myrequest = $request->all();
        //dd($myrequest);
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = MasterPartCrankshaftValue ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new MasterPartCrankshaftValue();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = MasterPartCrankshaftValue::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = MasterPartCrankshaftValue ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new MasterPartCrankshaftValue();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = MasterPartCrankshaftValue::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }

        /*$partcrankshaft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partcrankshaft)){
            $partcrankshaft =new MasterPartCrankshaftValue();
        }*/


        $pcrankshaft = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {
            $cylhead->service_request_id = $service->id;
            $cylhead->dept_id = $dept_id;
            $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cylhead->values = json_encode($pcrankshaft);
             $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
            $cylhead->save();
        }
        
         $sec=8;
        $childorsub=2;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
        //send Notification
       if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }

   //parts camshaft
     public function checkGatePartinspectionCamshaftDisSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $service = Service::find($request['service_id']);
        $parcamshaftput = $request->all();
        if(isset($request['disassembly_status'])){
            //echo '<pre>';print_r($data['user']['section_id']);exit;


            $disassembly_status = 1;
            $cylhead_res = MasterPartCamshaftValue ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new MasterPartCamshaftValue();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = MasterPartCamshaftValue::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = MasterPartCamshaftValue ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new MasterPartCamshaftValue();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = MasterPartCamshaftValue::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }

        /*$partcamshaft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partcamshaft)){
            $partcamshaft =new MasterPartCamshaftValue();
        }*/




        // $obj = new MasterPartOthercomponentValues();

//        echo '<pre>';print_r($cylhead);exit;
        //if (!empty($service->id)) {
           // $cylhead = new MasterPartCamshaftValue();
            $cylhead->service_request_id = $parcamshaftput['service_id'];
            $cylhead->dept_id = $dept_id;
            $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cylhead->values = json_encode($parcamshaftput);
             $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
            $cylhead->save();
       // }
       
       
       $sec=8;
        $childorsub=3;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
        //send Notification
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }

    //parts lh camshaft
    public function checkGatePartinspectionLhCamshaftDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = PartLhCamshaftValue ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartLhCamshaftValue();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = PartLhCamshaftValue::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = PartLhCamshaftValue ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartLhCamshaftValue();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = PartLhCamshaftValue::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }

        /*$partcamshaft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partcamshaft)){
            $partcamshaft =new PartLhCamshaftValue();
        }*/


        $parcamshaftput = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {
            $cylhead->service_request_id = $service->id;
            $cylhead->dept_id = $dept_id;
            $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cylhead->values = json_encode($parcamshaftput);
             $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
            $cylhead->save();
        }
        
        
         $sec=8;
        $childorsub=10;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        //send Notification
       if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }

    //parts rh camshaft
    public function checkGatePartinspectionRhCamshaftDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = PartRhCamshaftValue ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartRhCamshaftValue();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = PartRhCamshaftValue::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = PartRhCamshaftValue ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartRhCamshaftValue();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = PartRhCamshaftValue::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


       /* $partcamshaft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partcamshaft)){
            $partcamshaft =new PartRhCamshaftValue();
        }*/


        $parcamshaftput = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {
            $cylhead->service_request_id = $service->id;
            $cylhead->dept_id = $dept_id;
            $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cylhead->values = json_encode($parcamshaftput);
             $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
            $cylhead->save();
        }
        
        $sec=8;
        $childorsub=11;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
        //send Notification
         if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }
    //parts bush camshaft
    public function checkGatePartinspectionRhCamshaftBushboreDisSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = PartCamshaftBushboreValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartCamshaftBushboreValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = PartCamshaftBushboreValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = PartCamshaftBushboreValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartCamshaftBushboreValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = PartCamshaftBushboreValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }

        /*$partcamshaft=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partcamshaft)){
            $partcamshaft =new PartCamshaftBushboreValues();
        }*/


        $parcamshaftput = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {
            $cylhead->service_request_id = $service->id;
            $cylhead->dept_id = $dept_id;
            $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
            $cylhead->values = json_encode($parcamshaftput);
             $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
            $cylhead->save();
        }
        
        
        $sec=8;
        $childorsub=12;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
        //send Notification
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }

    //failed parts
     public function checkGateFailedPartsDisSave(Request $request)
    {
        // $myrequest=$request->all();
        // dd($myrequest);


        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = MasterFailedParts ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new MasterFailedParts();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = MasterFailedParts::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = MasterFailedParts ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new MasterFailedParts();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = MasterFailedParts::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }

        $failed=$request['qty'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            MasterFailedParts::where('service_request_id','=',$request['service_id'])->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $cylhead = new MasterFailedParts();
                $cylhead->service_request_id = $service->id;
                $cylhead->dept_id = $dept_id;
                $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
                $cylhead->qty = $txt;
                $cylhead->description = $request['description'][$key];
                $cylhead->part_no = $request['part_no'][$key];
				 $cylhead->remarks = $request['remarks'][$key];
            $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
                $cylhead->save();

            }
        }
        
         $sec=16;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }


    //parts rooler specific end cooler
    public function rollerSpcendcoolSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = RoolerSpecifiEndColValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new RoolerSpecifiEndColValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = RoolerSpecifiEndColValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = RoolerSpecifiEndColValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new RoolerSpecifiEndColValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = RoolerSpecifiEndColValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        $failed=$request['description'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            RoolerSpecifiEndColValues::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $failedpart = new RoolerSpecifiEndColValues();
                $failedpart->service_request_id = $service->id;
                $failedpart->dept_id = $dept_id;
                $failedpart->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $failedpart->assembly_status = isset($request['assembly_status']) ? '1':null;
                 $failedpart->radio =  empty($request['radiorollerspend'][$key]) ? $request['radiorollerspendview'][$key]:$request['radiorollerspend'][$key];
                $failedpart->radio = empty($request['radiorollerspendview'][$key]) ? $request['radiorollerspend'][$key]:$request['radiorollerspendview'][$key];
                $failedpart->description = $txt;
                $failedpart->part_no = $request['part_no'][$key];
               // $failedpart->specification = $request['specification'][$key];
                $failedpart->measured = $request['measured'][$key];
                $failedpart->remarks = $request['remarks'][$key];
                $failedpart->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $failedpart->actual_end_date = date("Y-m-d");
                

                $failedpart->save();

            }
        }
        
         $sec=8;
        $childorsub=21;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$failedpart->actual_start_date, $failedpart->actual_end_date);
        
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts clutch pack thickness

     public function partinspectionClutchpackThicknessSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = ClutchPackThicknessValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new ClutchPackThicknessValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = ClutchPackThicknessValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = ClutchPackThicknessValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new ClutchPackThicknessValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = ClutchPackThicknessValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }

        $failed=$request['qty'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            ClutchPackThicknessValues::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $cylhead = new ClutchPackThicknessValues();
                $cylhead->service_request_id = $service->id;
                $cylhead->dept_id = $dept_id;
                $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
                $cylhead->qty = $txt;
                $cylhead->description = $request['description'][$key];
                $cylhead->part_no = $request['part_no'][$key];
                $cylhead->actual_val = $request['actual_val'][$key];
                $cylhead->measured_val = $request['measured_val'][$key];
                $cylhead->section = $request['section'][$key];
                 $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");

                $cylhead->save();

            }
        }
        
         $sec=8;
        $childorsub=15;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts clutch plate thickness
    public function partinspectionClutchplateThicknessSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = ClutchPlateThicknessValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new ClutchPlateThicknessValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = ClutchPlateThicknessValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = ClutchPlateThicknessValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new ClutchPlateThicknessValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = ClutchPlateThicknessValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        $failed=$request['qty'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            ClutchPlateThicknessValues::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $cylhead = new ClutchPlateThicknessValues();
                $cylhead->service_request_id = $service->id;
                $cylhead->dept_id = $dept_id;
                $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
                $cylhead->qty = $txt;
                $cylhead->description = $request['description'][$key];
                $cylhead->part_no = $request['part_no'][$key];
                $cylhead->actual_val = $request['actual_val'][$key];
                $cylhead->measured_val = $request['measured_val'][$key];
                $cylhead->section = $request['section'][$key];
              $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
              $cylhead->actual_end_date = date("Y-m-d");
                $cylhead->save();

            }
        }
        
         $sec=8;
        $childorsub=16;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts clutch plate flatness
    public function partinspectionClutchplateFlatnessSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = ClutchPlateFlatnessValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new ClutchPlateFlatnessValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = ClutchPlateFlatnessValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = ClutchPlateFlatnessValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new ClutchPlateFlatnessValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = ClutchPlateFlatnessValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        $failed=$request['qty'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            ClutchPlateFlatnessValues::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $cylhead = new ClutchPlateFlatnessValues();
                $cylhead->service_request_id = $service->id;
                $cylhead->dept_id = $dept_id;
                $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
                $cylhead->qty = $txt;
                $cylhead->description = $request['description'][$key];
                $cylhead->part_no = $request['part_no'][$key];
                $cylhead->actual_val = $request['actual_val'][$key];
                $cylhead->measured_val = $request['measured_val'][$key];
                $cylhead->section = $request['section'][$key];
                 $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");
                $cylhead->save();

            }
        }
        
         $sec=8;
        $childorsub=17;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts torque converter
   public function partinspectionTorqueConverterSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = TorqueConverterValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new TorqueConverterValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = TorqueConverterValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = TorqueConverterValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new TorqueConverterValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = TorqueConverterValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        $failed=$request['clearance_component'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            TorqueConverterValues::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $cylhead = new TorqueConverterValues();
                $cylhead->service_request_id = $service->id;
                $cylhead->dept_id = $dept_id;
                $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
                $cylhead->clearance_component = $txt;
                $cylhead->turbine_diameter = $request['turbine_diameter'][$key];
                $cylhead->stator_diameter = $request['stator_diameter'][$key];
                $cylhead->max_worn = $request['max_worn'][$key];
                $cylhead->measured_val = $request['measured_val'][$key];
                // $failedpart->section = $request['section'][$key];
                 $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $cylhead->actual_end_date = date("Y-m-d");

                $cylhead->save();

            }
        }
        
         $sec=8;
        $childorsub=18;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }


   //component inspection report

     public function componentinspectionreport(Request $request)
    {


        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $component_res = ComponentInspReport ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($component_res)<=0){
                $component = new ComponentInspReport();
                $component->disassembly_status = 1;
            }
            else{
                $component = ComponentInspReport::find($component_res[0]['id']);
                $component->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $component_res = ComponentInspReport ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($component_res)<=0){
                $component = new ComponentInspReport();
                $component->assembly_status = 1;
            }
            else{
                $component = ComponentInspReport::find($component_res[0]['id']);
                $component->assembly_status = 1;
            }
        }
       /* $component=ComponentInspReport::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();

        if(!isset( $component)){
            $component =new ComponentInspReport();
        }*/
        $cominspreport=$request->all();



        if(isset($service->id)) {
            $component->service_request_id = $service->id;
            $component->dept_id = $dept_id;
            $component->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $component->assembly_status = isset($request['assembly_status']) ? '1':null;
            $component->ccvalues = json_encode($cominspreport);
            $component->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
           $component->actual_end_date = date("Y-m-d");
            $component->save();

        }
        
         $sec=11;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$component->actual_start_date, $component->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    // parts roller specification
   public function rollerSpecificationSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = RoolerSpecificationValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new RoolerSpecificationValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = RoolerSpecificationValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = RoolerSpecificationValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new RoolerSpecificationValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = RoolerSpecificationValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        $failed=$request['out_spd'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            RoolerSpecificationValues::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $cylhead = new RoolerSpecificationValues();
                $cylhead->service_request_id = $service->id;
                $cylhead->dept_id = $dept_id;
                $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
                $cylhead->part_no = $request['part_no'][$key];
                $cylhead->out_spd = $txt;
                $cylhead->tread = $request['tread'][$key];
                $cylhead->inside_flade = $request['inside_flade'][$key];
                $cylhead->shell_bore = $request['shell_bore'][$key];
                $cylhead->tread_diameter = $request['tread_diameter'][$key];
                $cylhead->outside_flg = $request['outside_flg'][$key];
                $cylhead->total_flage = $request['total_flage'][$key];
                $cylhead->tread_diahund = $request['tread_diahund'][$key];
                 $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                  $cylhead->actual_end_date = date("Y-m-d");
                  //$cylhead->actual_start_date = $request['actual_start_date'];
            //$cylhead->actual_end_date = date("Y-m-d");

                $cylhead->save();

            }
        }
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts roller measured
    public function rollerMeasuredSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $component_res = RoolerMeasuredValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($component_res)<=0){
                $component = new RoolerMeasuredValues();
                $component->disassembly_status = 1;
            }
            else{
                $component = RoolerMeasuredValues::find($component_res[0]['id']);
                $component->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $component_res = RoolerMeasuredValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($component_res)<=0){
                $component = new RoolerMeasuredValues();
                $component->assembly_status = 1;
            }
            else{
                $component = RoolerMeasuredValues::find($component_res[0]['id']);
                $component->assembly_status = 1;
            }
        }

        /*$partoil=RoolerMeasuredValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($partoil)){
            $partoil =new RoolerMeasuredValues();
        }*/


        $othercomp = $request->all();

        // $obj = new MasterPartOthercomponentValues();

        if (isset($service->id)) {
            $component->service_request_id = $service->id;
            $component->dept_id =$dept_id;
            $component->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $component->assembly_status = isset($request['assembly_status']) ? '1':null;
            $component->values = json_encode($othercomp);
            $component->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $component->actual_end_date = date("Y-m-d");
            $component->save();
        }
        
        $sec=8;
        $childorsub=20;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$component->actual_start_date, $component->actual_end_date);
        
        //send Notification
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }
    //parts roller clear shaft salvage
     public function rollerClearBtwsftSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = RollerspcClearShaftValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new RollerspcClearShaftValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = RollerspcClearShaftValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = RollerspcClearShaftValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new RollerspcClearShaftValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = RollerspcClearShaftValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        $failed=$request['description'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            RollerspcClearShaftValues::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $cylhead = new RollerspcClearShaftValues();
                $cylhead->service_request_id = $service->id;
                $cylhead->dept_id = $dept_id;
                $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
                $cylhead->specification = $request['specification'][$key];
                $cylhead->description = $txt;
                 $cylhead->radio =  empty($request['radiorollerclear'][$key]) ? $request['radiorollerclrview'][$key]:$request['radiorollerclear'][$key];
                $cylhead->radio = empty($request['radiorollerclrview'][$key]) ? $request['radiorollerclear'][$key]:$request['radiorollerclrview'][$key];
                //$cylhead->specification = $request['specification'][$key];
                $cylhead->measured = $request['measured'][$key];
                $cylhead->remarks = $request['remarks'][$key];
                $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $cylhead->actual_end_date = date("Y-m-d");



                $cylhead->save();

            }
        }
        
         $sec=8;
        $childorsub=22;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    // parts idler specification
    public function idlerSpecificationSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = IdlerSpecificationValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new IdlerSpecificationValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = IdlerSpecificationValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = IdlerSpecificationValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new IdlerSpecificationValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = IdlerSpecificationValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        $failed=$request['width1'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            IdlerSpecificationValues::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $cylhead = new IdlerSpecificationValues();
                $cylhead->service_request_id = $service->id;
                $cylhead->dept_id = $dept_id;
                $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
                $cylhead->width2 = $request['width2'][$key];
                $cylhead->width1 = $txt;
                $cylhead->hub1 = $request['hub1'][$key];
                $cylhead->diameter1 = $request['diameter1'][$key];
                $cylhead->diameter2 = $request['diameter2'][$key];
                $cylhead->height1 = $request['height1'][$key];
                $cylhead->diameter3 = $request['diameter3'][$key];
                $cylhead->radious1 = $request['radious1'][$key];
                $cylhead->install1 = $request['install1'][$key];
                $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $cylhead->actual_end_date = date("Y-m-d");


                $cylhead->save();

            }
        }
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //parts idler before salvage
    public function idlerMeasuredBeforeSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = IdlerMeasuredBeforeValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new IdlerMeasuredBeforeValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = IdlerMeasuredBeforeValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = IdlerMeasuredBeforeValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new IdlerMeasuredBeforeValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = IdlerMeasuredBeforeValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        $failed=$request['width1'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            IdlerMeasuredBeforeValues::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $cylhead = new IdlerMeasuredBeforeValues();
                $cylhead->service_request_id = $service->id;
                $cylhead->dept_id = $dept_id;
                $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
                $cylhead->idler_no = $request['idler_no'][$key];
                $cylhead->width2 = $request['width2'][$key];
                $cylhead->width1 = $txt;
                $cylhead->hub1 = $request['hub1'][$key];
                $cylhead->radio =  empty($request['radio'][$key]) ? $request['radio1'][$key]:$request['radio'][$key];
                $cylhead->radio = empty($request['radio1'][$key]) ? $request['radio'][$key]:$request['radio1'][$key];
                $cylhead->diameter1 = $request['diameter1'][$key];
                $cylhead->diameter2 = $request['diameter2'][$key];
                $cylhead->height1 = $request['height1'][$key];
                $cylhead->diameter3 = $request['diameter3'][$key];
                $cylhead->radious1 = $request['radious1'][$key];
                $cylhead->install1 = $request['install1'][$key];
                $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $cylhead->actual_end_date = date("Y-m-d");


                $cylhead->save();

            }
        }
        
        $sec=8;
        $childorsub=16;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
        
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

  //parts idler after salvage
    public function idlerMeasuredAfterSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = IdlerMeasuredAfterValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new IdlerMeasuredAfterValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = IdlerMeasuredAfterValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = IdlerMeasuredAfterValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new IdlerMeasuredAfterValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = IdlerMeasuredAfterValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        $failed=$request['width1'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            IdlerMeasuredAfterValues::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $cylhead = new IdlerMeasuredAfterValues();
                $cylhead->service_request_id = $service->id;
                $cylhead->dept_id = $dept_id;
                $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
                $cylhead->idler_no = $request['idler_no'][$key];
                $cylhead->width2 = $request['width2'][$key];
                $cylhead->width1 = $txt;
                $cylhead->hub1 = $request['hub1'][$key];
                 $cylhead->radio =  empty($request['radioaft'][$key]) ? $request['radioaft1'][$key]:$request['radioaft'][$key];
                $cylhead->radio = empty($request['radioaft1'][$key]) ? $request['radioaft'][$key]:$request['radioaft1'][$key];
                $cylhead->diameter1 = $request['diameter1'][$key];
                $cylhead->diameter2 = $request['diameter2'][$key];
                $cylhead->height1 = $request['height1'][$key];
                $cylhead->diameter3 = $request['diameter3'][$key];
                $cylhead->radious1 = $request['radious1'][$key];
                $cylhead->install1 = $request['install1'][$key];
                $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $cylhead->actual_end_date = date("Y-m-d");


                $cylhead->save();

            }
        }
        
         $sec=8;
        $childorsub=17;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
        
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

  //parts idler spc end coler salvage
   public function idlerSpecEndcoolerSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = IdlerSpeciEndcolerValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new IdlerSpeciEndcolerValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = IdlerSpeciEndcolerValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = IdlerSpeciEndcolerValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new IdlerSpeciEndcolerValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = IdlerSpeciEndcolerValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }


        $failed=$request['description'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            IdlerSpeciEndcolerValues::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $cylhead = new IdlerSpeciEndcolerValues();
                $cylhead->service_request_id = $service->id;
                $cylhead->dept_id = $dept_id;
                $cylhead->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $cylhead->assembly_status = isset($request['assembly_status']) ? '1':null;
                $cylhead->part_no = $request['part_no'][$key];
                //$cylhead->specification = $request['specification'][$key];
                $cylhead->description = $txt;
                 $cylhead->radio =  empty($request['radiospend'][$key]) ? $request['radiospendview'][$key]:$request['radiospend'][$key];
                $cylhead->radio = empty($request['radiospendview'][$key]) ? $request['radiospend'][$key]:$request['radiospendview'][$key];
                $cylhead->idler1 = $request['idler1'][$key];
                $cylhead->idler2 = $request['idler2'][$key];
                $cylhead->idler3 = $request['idler3'][$key];
                $cylhead->idler4 = $request['idler4'][$key];
                $cylhead->idler5 = $request['idler5'][$key];
                $cylhead->idler6 = $request['idler6'][$key];
                //$failedpart->install1 = $request['install1'][$key];
                $cylhead->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $cylhead->actual_end_date = date("Y-m-d");


                $cylhead->save();

            }
        }
        
        
         $sec=8;
        $childorsub=18;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$cylhead->actual_start_date, $cylhead->actual_end_date);
       if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
    //parts idler clear shaft salvage
    public function idlerClearBtwsftSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];

            $disassembly_status = 1;
            $cylhead_res = PartCamshaftBushboreValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartCamshaftBushboreValues();
                $cylhead->disassembly_status = 1;
            }
            else{
                $cylhead = PartCamshaftBushboreValues::find($cylhead_res[0]['id']);
                $cylhead->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $cylhead_res = PartCamshaftBushboreValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($cylhead_res)<=0){
                $cylhead = new PartCamshaftBushboreValues();
                $cylhead->assembly_status = 1;
            }
            else{
                $cylhead = PartCamshaftBushboreValues::find($cylhead_res[0]['id']);
                $cylhead->assembly_status = 1;
            }
        }

        $failed=$request['description'];

        if(isset($service->id)) {
            // $missing=MasterMissingdamagePartDis::find($request['service_id']);
            // $missing=delete();
            IdlerspcClearShaftValues::where('service_request_id','=',$request['service_id'])
                ->where('dept_id','=',$dept_id)->delete();
            //echo '<pre>';print_r($request['part_no']);exit;
            foreach ($failed as $key => $val) {
                // echo'<pre>';print_r($val);echo'<pre>';
                $txt= $val;

                $failedpart = new IdlerspcClearShaftValues();
                $failedpart->service_request_id = $service->id;
                $failedpart->dept_id = $dept_id;
                $failedpart->disassembly_status = isset($request['disassembly_status']) ? '1':null;
                $failedpart->assembly_status = isset($request['assembly_status']) ? '1':null;

                $failedpart->idler_no = $request['idler_no'][$key];
                $failedpart->specification = $request['specification'][$key];
                $failedpart->description = $txt;
                 $failedpart->radio =  empty($request['radioclear'][$key]) ? $request['radioclrview'][$key]:$request['radioclear'][$key];
                $failedpart->radio = empty($request['radioclrview'][$key]) ? $request['radioclear'][$key]:$request['radioclrview'][$key];
               // $failedpart->specification = $request['specification'][$key];
                $failedpart->measured = $request['measured'][$key];
                $failedpart->remarks = $request['remarks'][$key];
                $failedpart->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
                $failedpart->actual_end_date = date("Y-m-d");



                $failedpart->save();

            }
        }
        
         $sec=8;
        $childorsub=19;
        $notification= UserHelper::partsinspupdatetasktable($dept_id,$service->machine_modelno,$request['service_id'],$sec,$childorsub,$failedpart->actual_start_date, $failedpart->actual_end_date);
        
        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //transmission & tc component
   public function transmissionComponentSave(Request $request)
    {


        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $component_res = TransmissionComponent ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($component_res)<=0){
                $component = new TransmissionComponent();
                $component->disassembly_status = 1;
            }
            else{
                $component = TransmissionComponent::find($component_res[0]['id']);
                $component->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $component_res = TransmissionComponent ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($component_res)<=0){
                $component = new TransmissionComponent();
                $component->assembly_status = 1;
            }
            else{
                $component = TransmissionComponent::find($component_res[0]['id']);
                $component->assembly_status = 1;
            }
        }
       /* $component=TransmissionComponent::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();

        if(!isset( $component)){
            $component =new TransmissionComponent();
        }*/
        $cominspreport=$request->all();

        if(isset($service->id)) {
            $component->service_request_id = $service->id;
            $component->dept_id = $dept_id;
            $component->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $component->assembly_status = isset($request['assembly_status']) ? '1':null;
            $component->values = json_encode($cominspreport);
             $component->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
           $component->actual_end_date = date("Y-m-d");
            $component->save();

        }
        
        
         $sec=15;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$component->actual_start_date, $component->actual_end_date);

        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }

    //Con Rod After Bush Replacement
     public function checkGateConrodBushReplacementDisSave(Request $request)
    {
        //$myrequest = $request->all();
        //dd($myrequest);
        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($request['disassembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $disassembly_status = 1;
            $conrodbusrep_res = MasterConRodBushReplacementValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('disassembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($conrodbusrep_res)<=0){
                $conrodbusrep = new MasterConRodBushReplacementValues();
                $conrodbusrep->disassembly_status = 1;
            }
            else{
                $conrodbusrep = MasterConRodBushReplacementValues::find($conrodbusrep_res[0]['id']);
                $conrodbusrep->disassembly_status = 1;
            }
        }
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $conrodbusrep_res = MasterConRodBushReplacementValues ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            //echo '<pre>';print_r($aggregate_res);exit;
            if(count($conrodbusrep_res)<=0){
                $conrodbusrep = new MasterConRodBushReplacementValues();
                $conrodbusrep->assembly_status = 1;
            }
            else{
                $conrodbusrep = MasterConRodBushReplacementValues::find($conrodbusrep_res[0]['id']);
                $conrodbusrep->assembly_status = 1;
            }
        }
        /*$conrodbusrep=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$request['dept_id'])->get()->first();
        //dd($cmmercial);exit;
        if(!isset($conrodbusrep)){
            $conrodbusrep =new MasterConRodBushReplacementValues();
        }*/


        $othercomp = $request->all();

        if (isset($service->id)) {
            $conrodbusrep->service_request_id = $service->id;
            $conrodbusrep->dept_id = $dept_id;
            $conrodbusrep->disassembly_status = isset($request['disassembly_status']) ? '1':null;
           $conrodbusrep->assembly_status = isset($request['assembly_status']) ? '1':null;
            $conrodbusrep->values = json_encode($othercomp);
            $conrodbusrep->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $conrodbusrep->actual_end_date = date("Y-m-d");
            $conrodbusrep->save();
        }
        
          $sec=10;
       $notification= UserHelper::tasktableupdateactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$conrodbusrep->actual_start_date, $conrodbusrep->actual_end_date);
        
        //send Notification
         if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }

    }

     public function checkSheetAssemblyCommonold($id)
    {

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $route_check =  request()->segment(2);

        if($route_check == 'check-sheet-entry-common'){
            
            $view='admin.include.checksheetCommon';
        }
        if($route_check == 'check-sheet-assembly-common'){

            
            $view='admin.include.checksheetAssemblyCommon';
            
        }

        $service = Service::find($id);
        if(!empty($service)){
            $route_check =  request()->segment(2);
            if($route_check == 'check-sheet-entry-common')
            {
                $dept_id=$data['user']['section_id'];
                $disassembly_status = 1;

                $checkgatefollow=CheckgateOneFollowedUp::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalchkgtfollow=CheckgateOneFollowedUp::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $agrregate=MasterAggregate::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $prehist=MasterPreHistoryDis::where('service_request_id','=',$service->id)
                    //->where('disassembly_status','=',$disassembly_status)
                    //->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showrejectcom =ChecksheetStatus::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $commercialLogistic=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalcommercialLog=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $externalWash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalexterwash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $partsClean=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalpartcln=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $beforestartccassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $ccbeforestartassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cominspecreport=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $cccompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalinsprpt=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showtransmission=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaltrans=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showloosepat_1=MasterLoosepartDis::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showmissing_1=MasterMissingdamagePartDis::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showmissingstatus_1=StatusRevision::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showdissambly_1=MasterDissamblyCleaningInspection::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblklinear=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkliner=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcycap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcyCap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcrankshaft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcranksft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcamshaft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showlhcamshaft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvallLhcamsft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrhcamshaft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrLhcamsft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrhcambush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsftbush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cylinder=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderheadoil=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showothercomp=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalothercom=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfandrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvfanaldrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showoilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaloilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfailed_1=MasterFailedParts::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showsalvage_1=MasterListofSalvageDis::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluthick_1=ClutchPackThicknessValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplatethi_1=ClutchPlateThicknessValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplateflt_1=ClutchPlateFlatnessValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showtorque_1=TorqueConverterValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspec_1=RoolerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspcend_1=RoolerSpecifiEndColValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrollclr_1=RollerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerpec_1=IdlerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesbef_1=IdlerMeasuredBeforeValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesaft_1=IdlerMeasuredAfterValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerspend_1=IdlerSpeciEndcolerValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidleclr_1=IdlerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showassembly = ChecksheetAssembly::where('service_request_id', '=', $service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalassembly = ChecksheetAssembly::where('service_request_id', '=', $service->id)
                    ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

            $rejectmsg=Null;
                $rejectmsg=ChecksheetStatus::where('service_request_id', '=', $service->id)
                   // ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                    
                    if (request()->session()->get('user')['section_id'] == '10'){
            $dept_id1 = '4';
        }
        if(request()->session()->get('user')['section_id'] == '11'){
            $dept_id1 = '5';
        }
        if(request()->session()->get('user')['section_id'] == '15'){
             $dept_id1 = '7';
        }
        if(request()->session()->get('user')['section_id'] == '12'){
              $dept_id1 = '13';
        }
                  $rejectmsg1=Null;
                 if(request()->session()->get('user')['section_id'] == '10' ||request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '15'){   
                $rejectmsg1=ChecksheetStatus::where('service_request_id', '=', $service->id)
                    // ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id1)
                    ->get()->first();
                 }

            }
            if($route_check == 'check-sheet-assembly-common'){
      
                $assembly_status = 1;
                $checkgatefollow=CheckgateOneFollowedUp::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalchkgtfollow=CheckgateOneFollowedUp::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $agrregate=MasterAggregate::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $prehist=MasterPreHistoryDis::where('service_request_id','=',$service->id)
                   // ->where('assembly_status','=',$assembly_status)
                   // ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showrejectcom =ChecksheetStatus::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $commercialLogistic=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcommercialLog=MasterCommercialValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $externalWash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalexterwash=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $partsClean=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalpartcln=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $beforestartccassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $ccbeforestartassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $showconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalconrodbush=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();


                $cominspecreport=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cccompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                $allvalinsprpt=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcompinsp=ComponentInspReport::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showtransmission=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaltrans=TransmissionComponent::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showloosepat_1=MasterLoosepartDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showmissing_1=MasterMissingdamagePartDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();
                $showmissingstatus_1=StatusRevision::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showdissambly_1=MasterDissamblyCleaningInspection::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderblock=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblklinear=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkliner=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylblkcam=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcytopdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcythread=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcybush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcycap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcyCap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcrankshaft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcranksft=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcamshaft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsft=MasterPartCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showlhcamshaft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvallLhcamsft=PartLhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();


                $showrhcamshaft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrLhcamsft=PartRhCamshaftValue::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrhcambush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcamsftbush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalconrod=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $cylinder=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcylinderheadoil=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showothercomp=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalothercom=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfandrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvfanaldrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showoilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvaloilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalaircomp=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalwaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalcooler=CoolerInspectionValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalrolmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $showfailed_1=MasterFailedParts::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showsalvage_1=MasterListofSalvageDis::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluthick_1=ClutchPackThicknessValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplatethi_1=ClutchPlateThicknessValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showcluplateflt_1=ClutchPlateFlatnessValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showtorque_1=TorqueConverterValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspec_1=RoolerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrolspcend_1=RoolerSpecifiEndColValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showrollclr_1=RollerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerpec_1=IdlerSpecificationValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesbef_1=IdlerMeasuredBeforeValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlermesaft_1=IdlerMeasuredAfterValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidlerspend_1=IdlerSpeciEndcolerValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showidleclr_1=IdlerspcClearShaftValues::where('service_request_id','=',$service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get();

                $showassembly = ChecksheetAssembly::where('service_request_id', '=', $service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();

                $allvalassembly = ChecksheetAssembly::where('service_request_id', '=', $service->id)
                    ->where('assembly_status','=',$assembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                    
                     $rejectmsg=Null;
                     $rejectmsg=ChecksheetStatus::where('service_request_id', '=', $service->id)
                   // ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id)
                    ->get()->first();
                    
                    if (request()->session()->get('user')['section_id'] == '10'){
            $dept_id1 = '4';
        }
        if(request()->session()->get('user')['section_id'] == '11'){
            $dept_id1 = '5';
        }
        if(request()->session()->get('user')['section_id'] == '15'){
             $dept_id1 = '7';
        }
        if(request()->session()->get('user')['section_id'] == '12'){
              $dept_id1 = '13';
        }
                    
                    $rejectmsg1=Null;
                if(request()->session()->get('user')['section_id'] == '10' ||request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '15'){     
                $rejectmsg1=ChecksheetStatus::where('service_request_id', '=', $service->id)
                    // ->where('disassembly_status','=',$disassembly_status)
                    ->where('dept_id','=',$dept_id1)
                    ->get()->first();
                }

            }

            //engine assembly checksheet


            if (isset($showassembly->id)) {
                $showassembly = json_decode($showassembly->cc_value);
            } else {
                $showassembly = Null;
            }

            //check gate1 followed

            if(isset($checkgatefollow->id)){
                $checkgatefollow=json_decode($checkgatefollow->values);
            }else{
                $checkgatefollow=Null;
            }


            //aggregation show


            $mcModel=MasterMCModel::find($service->machine_modelno);

            $mcSerial = Service::select('service_request.id','machine_serialno', 'gw_master_machine_serial_no.serial_no')
                ->leftjoin('gw_master_machine_serial_no','gw_master_machine_serial_no.id', '=', 'service_request.machine_serialno')
                ->where('service_request.id', '=' ,$id)->get();
            $componentSerial=MasterComponentDetails::find($service->component_serial_no);
            $customer = Service::select('gw_master_customer.name')
                ->leftjoin('gw_master_customer','gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.id', '=' ,$id)->get()->toArray();

            //prehistory show

            if(isset($prehist->id)) {
                $machSerial=MasterMCSerialNumber::find($service->machine_serialno);
                $comSerial=MasterComponentDetails::find($service->component_serial_no);

            }
            else{
                $machSerial=Null;
                $comSerial=Null;
            }

            //Commercial and logistics


            if(isset($commercialLogistic->id)){
                $commercialLogistic=json_decode($commercialLogistic->values);
            }else{
                $commercialLogistic=Null;
            }

            //ccinspection after external wash

            if(isset($externalWash->id)){
                $externalWash=json_decode($externalWash->values);
            }else{
                $externalWash=Null;
            }

            //before start assembly


            if(isset($beforestartccassembly->id)){
                $beforestartccassembly=json_decode($beforestartccassembly->ccvalues);
            }else{
                $beforestartccassembly=Null;
            }


            //Conrod After Bush Replacement



            if(isset($showconrodbush->id)){
                $showconrodbush=json_decode($showconrodbush->values);
            }else{
                $showconrodbush=Null;
            }

            //Component Inspection report

            if(isset( $cominspecreport->id)){
                $cominspecreport=json_decode( $cominspecreport->ccvalues);
            }else{
                $cominspecreport=Null;
            }


            //cc inspection after parts clean

            if(isset($partsClean->id)){
                $partsClean=json_decode($partsClean->values);
            }else{
                $partsClean=Null;
            }



            //partsinspection cylinder head


            if(isset($cylinder->id)){
                $cylinder=json_decode($cylinder->details);
            }else{
                $cylinder=Null;
            }




            //parts inspection cooler insp


            if(isset($showcooler->id)){
                $showcooler=json_decode($showcooler->values);
            }else{
                $showcooler=Null;
            }




            //partinspection other component


            if(isset($showothercomp->id)){
                $showothercomp=json_decode($showothercomp->values);
            }else{
                $showothercomp=Null;
            }



            //transmisssion component

            if(isset($showtransmission->id)){
                $showtransmission=json_decode($showtransmission->values);
            }else{
                $showtransmission=Null;
            }





            // commponent inspection report

            if(isset($showcompinsp->id)){
                $showcompinsp=json_decode($showcompinsp->ccvalues);
            }else{
                $showcompinsp=Null;
            }

            /* */


            //parts rooler measured

            if(isset($showrolmea->id)){
                $showrolmea=json_decode($showrolmea->values);
            }else{
                $showrolmea=Null;
            }



            //partsinspection connecting rod

            if(isset($showconrod->id)){
                $showconrod=json_decode($showconrod->values);
            }else{
                $showconrod=Null;
            }



            //partinspection cylinder block

            if(isset($showcylinderblock->id)){
                $showcylinderblock=json_decode($showcylinderblock->values);
            }else{
                $showcylinderblock=Null;
            }
            //$var = $showcylinderblock->frontcenter;
            if(isset($showcylinderblock->frontcenter)){
                $myArray = json_decode(json_encode($showcylinderblock->frontcenter), true);
            }
            else{
                $myArray=Null;
            }
            if(isset($showcylinderblock->frontresult)) {
                $frntreslt = json_decode(json_encode($showcylinderblock->frontresult), true);
            }else{
                $frntreslt=Null;
            }
            if(isset($showcylinderblock->mainfrontremarks)) {
                $frtmainrst = json_decode(json_encode($showcylinderblock->mainfrontremarks), true);
            }else{
                $frtmainrst=Null;
            }
            if(isset($showcylinderblock->centerresult)) {
                $rearcenteryes = json_decode(json_encode($showcylinderblock->centerresult), true);
            }else{
                $rearcenteryes=Null;
            }
            if(isset($showcylinderblock->rearresults)) {
                $rearresyes = json_decode(json_encode($showcylinderblock->rearresults), true);
            }else{
                $rearresyes=Null;
            }
            if(isset($showcylinderblock->rearresults)) {
                $rearremaryes = json_decode(json_encode($showcylinderblock->mainrearremarks), true);
            }else{
                $rearremaryes=Null;
            }


            //partinspection cylinder block linear

            if(isset($showcylblklinear->id)){
                $showcylblklinear=json_decode($showcylblklinear->values);
            }else{
                $showcylblklinear=Null;
            }

            if(isset($showcylblklinear->frontcenter)){
                $linArray = json_decode(json_encode($showcylblklinear->frontcenter), true);
            }
            else{
                $linArray=Null;
            }
            if(isset($showcylblklinear->frontresult)) {
                $linfrntreslt = json_decode(json_encode($showcylblklinear->frontresult), true);
            }else{
                $linfrntreslt=Null;
            }
            if(isset($showcylblklinear->mainfrontremarks)) {
                $linfrtmainrst = json_decode(json_encode($showcylblklinear->mainfrontremarks), true);
            }else{
                $linfrtmainrst=Null;
            }
            if(isset($showcylblklinear->centerresult)) {
                $linrearcenteryes = json_decode(json_encode($showcylblklinear->centerresult), true);
            }else{
                $linrearcenteryes=Null;
            }
            if(isset($showcylblklinear->rearresults)) {
                $linrearresyes = json_decode(json_encode($showcylblklinear->rearresults), true);
            }else{
                $linrearresyes=Null;
            }
            if(isset($showcylblklinear->rearresults)) {
                $linrearremaryes = json_decode(json_encode($showcylblklinear->mainrearremarks), true);
            }else{
                $linrearremaryes=Null;
            }



            //partinspection cylinder block cam bore

            if(isset($showcylblkcam->id)){
                $showcylblkcam=json_decode($showcylblkcam->values);
            }else{
                $showcylblkcam=Null;
            }
            if(isset($showcylblkcam->frontcenter)){
                $camArray = json_decode(json_encode($showcylblkcam->frontcenter), true);
            }
            else{
                $camArray=Null;
            }
            if(isset($showcylblkcam->frontresult)) {
                $camfrntreslt = json_decode(json_encode($showcylblkcam->frontresult), true);
            }else{
                $camfrntreslt=Null;
            }
            if(isset($showcylblkcam->mainfrontremarks)) {
                $camfrtmainrst = json_decode(json_encode($showcylblkcam->mainfrontremarks), true);
            }else{
                $camfrtmainrst=Null;
            }
            if(isset($showcylblkcam->centerresult)) {
                $camrearcenteryes = json_decode(json_encode($showcylblkcam->centerresult), true);
            }else{
                $camrearcenteryes=Null;
            }
            if(isset($showcylblkcam->rearresults)) {
                $camrearresyes = json_decode(json_encode($showcylblkcam->rearresults), true);
            }else{
                $camrearresyes=Null;
            }
            if(isset($showcylblkcam->rearresults)) {
                $camrearremaryes = json_decode(json_encode($showcylblkcam->mainrearremarks), true);
            }else{
                $camrearremaryes=Null;
            }




            //parts inspection crankshaft inspection

            if(isset($showcrankshaft->id)){
                $showcrankshaft=json_decode($showcrankshaft->values);
            }else{
                $showcrankshaft=Null;
            }


            //parts inspection camshaft inspection


            if(isset($showcamshaft->id)){
                $showcamshaft=json_decode($showcamshaft->values);
            }else{
                $showcamshaft=Null;
            }



            //parts inspection lh camshaft inspection


            if(isset($showlhcamshaft->id)){
                $showlhcamshaft=json_decode($showlhcamshaft->values);
            }else{
                $showlhcamshaft=Null;
            }



            //parts inspection rh camshaft inspection


            if(isset($showrhcamshaft->id)){
                $showrhcamshaft=json_decode($showrhcamshaft->values);
            }else{
                $showrhcamshaft=Null;
            }


            //parts inspection camshaft bushbore inspection


            if(isset($showrhcambush->id)){
                $showrhcambush=json_decode($showrhcambush->values);
            }else{
                $showrhcambush=Null;
            }



            //missingdamagepart


            if(isset($showmissing_1)){
                $showmissing=$showmissing_1;


            }else{
                $showmissing=Null;

            }
            //status of revision


            if(isset($showmissingstatus_1)){
                $showmissingstatus=$showmissingstatus_1;


            }else{
                $showmissingstatus=Null;

            }
            //Assembly checksheet
            /* $showcheckassembly_1=ChecksheetAssembly::where('service_request_id','=',$service->id)
                 //->where('dept_id','=',1)
                 ->get();
             //dd($showcheckassembly_1);exit;
             if(isset($showcheckassembly_1)){
                 $showcheckassembly=$showcheckassembly_1;
                 //dd($showcheckassembly);exit;

             }else{
                 $showcheckassembly=Null;

             }*/

            //disassembly cleaning inspection

            //dd($showdissambly_1);exit;
            if(isset($showdissambly_1)){
                $showdissambly=$showdissambly_1;
                //dd($showdissambly);exit;

            }else{
                $showdissambly=Null;

            }
            //list of salvage


            //dd($showmissing_1);exit;
            if(isset($showsalvage_1)){
                $showsalvage=$showsalvage_1;
                //dd($showmissing);exit;

            }else{
                $showsalvage=Null;
            }

            //loose parts

            // dd($showloosepat_1);exit;
            if(isset($showloosepat_1)){
                $showloosepat=$showloosepat_1;
                //dd($showmissing);exit;

            }else{
                $showloosepat=Null;
            }

            //Failed Parts


            if(isset($showfailed_1)){
                $showfailed=$showfailed_1;


            }else{
                $showfailed=Null;

            }

            //rooler spe endcol


            if(isset($showrolspcend_1)){
                $showrolspcend=$showrolspcend_1;


            }else{
                $showrolspcend=Null;

            }


            //parts rooler specification

            if(isset($showrolspec_1)){
                $showrolspec=$showrolspec_1;


            }else{
                $showrolspec=Null;

            }

            //parts idler specification


            if(isset($showidlerpec_1)){
                $showidlerpec=$showidlerpec_1;


            }else{
                $showidlerpec=Null;

            }

            //parts idler measured before


            if(isset($showidlermesbef_1)){
                $showidlermesbef=$showidlermesbef_1;


            }else{
                $showidlermesbef=Null;

            }

            //parts idler measured after


            if(isset($showidlermesaft_1)){
                $showidlermesaft=$showidlermesaft_1;


            }else{
                $showidlermesaft=Null;

            }

            //parts clutch pack thickness


            if(isset($showcluthick_1)){
                $showcluthick=$showcluthick_1;


            }else{
                $showcluthick=Null;

            }

            //parts clutch plate thickness



            if(isset($showcluplatethi_1)){
                $showcluplatethi=$showcluplatethi_1;


            }else{
                $showcluplatethi=Null;

            }

            //parts clutch plate flatness


            if(isset($showcluplateflt_1)){
                $showcluplateflt=$showcluplateflt_1;


            }else{
                $showcluplateflt=Null;

            }

            //parts torque converter



            if(isset($showtorque_1)){
                $showtorque=$showtorque_1;


            }else{
                $showtorque=Null;

            }

            //parts idler spec endcol



            if(isset($showidlerspend_1)){
                $showidlerspend=$showidlerspend_1;


            }else{
                $showidlerspend=Null;

            }

            //parts idler clear shaft



            if(isset($showidleclr_1)){
                $showidleclr=$showidleclr_1;


            }else{
                $showidleclr=Null;

            }

            //parts roller clear shaft



            if(isset($showrollclr_1)){
                $showrollclr=$showrollclr_1;


            }else{
                $showrollclr=Null;

            }

            //Parts Fan Drive

            if(isset($showfandrive->id)){
                $showfandrive=json_decode($showfandrive->values);
            }else{
                $showfandrive=Null;
            }



            //Parts Oil Pump

            if(isset($showoilpump->id)){
                $showoilpump=json_decode($showoilpump->values);
            }else{
                $showoilpump=Null;
            }



            //air compressor

            if(isset($showaircomp->id)){
                $showaircomp=json_decode($showaircomp->values);
            }else{
                $showaircomp=Null;
            }



            //water pump

            if(isset($showwaterpump->id)){
                $showwaterpump=json_decode($showwaterpump->values);
            }else{
                $showwaterpump=Null;
            }



            //cylinder block top deck

            if(isset($showcytopdk->id)){
                $showcytopdk=json_decode($showcytopdk->values);
            }else{
                $showcytopdk=Null;
            }



            //cylinder block thread

            if(isset($showcythread->id)){
                $showcythread=json_decode($showcythread->values);
            }else{
                $showcythread=Null;
            }



            //cylinder block bush bore

            if(isset($showcybush->id)){
                $showcybush=json_decode($showcybush->values);
            }else{
                $showcybush=Null;
            }


            //cylinder block Cap no

            if(isset($showcycap->id)){
                $showcycap=json_decode($showcycap->values);
            }else{
                $showcycap=Null;
            }


            //$route_check =  request()->segment(2);
               // return view('admin.include.checksheetAssemblyCommon')

            return view($view)
                ->with('service',$service)
                ->with('checkgatefollow',$checkgatefollow)
                ->with('allvalchkgtfollow',$allvalchkgtfollow)
                ->with('agrregate', $agrregate)
                ->with('mcModel', $mcModel)
                ->with('mcSerial', $mcSerial)
                ->with('componentSerial', $componentSerial)
                ->with('commercialLogistic',$commercialLogistic)
                ->with('prehist',$prehist)
                ->with('machSerial',$machSerial)
                ->with('comSerial',$comSerial)
                ->with('externalWash',$externalWash)
                ->with('partsClean',$partsClean)
                ->with('cylinder',$cylinder)
                ->with('showothercomp',$showothercomp)
                ->with('myArray',$myArray)
                ->with('showconrod',$showconrod)
                ->with('showconrodbush',$showconrodbush)
                ->with('frntreslt',$frntreslt)
                ->with('frtmainrst',$frtmainrst)
                ->with('rearcenteryes',$rearcenteryes)
                ->with('rearresyes',$rearresyes)
                ->with('rearremaryes',$rearremaryes)
                ->with('showcrankshaft',$showcrankshaft)
                ->with('showcamshaft',$showcamshaft)
                ->with('showcylinderblock',$showcylinderblock)
                ->with('showmissing',$showmissing)
                ->with('showoilpump',$showoilpump)
                ->with('showaircomp',$showaircomp)
                ->with('showsalvage',$showsalvage)
                ->with('showcooler',$showcooler)
                ->with('showloosepat',$showloosepat)
                ->with('showfailed',$showfailed)
                ->with('showfandrive',$showfandrive)
                ->with('showwaterpump',$showwaterpump)
                ->with('showcompinsp',$showcompinsp)
                ->with('showcluthick',$showcluthick)
                ->with('allvalcommercialLog',$allvalcommercialLog)
                ->with('allvalexterwash',$allvalexterwash)
                ->with('allvalpartcln',$allvalpartcln)
                ->with('allvalconrod',$allvalconrod)
                ->with('allvaloilpump',$allvaloilpump)
                ->with('allvalcylinderblock',$allvalcylinderblock)
                ->with('allvalcranksft',$allvalcranksft)
                ->with('allvalcamsft',$allvalcamsft)
                ->with('allvalothercom',$allvalothercom)
                ->with('allvalinsprpt',$allvalinsprpt)
                ->with('allvalcooler',$allvalcooler)
                ->with('allvalconrodbush',$allvalconrodbush)
                //->with('allvalfandrive',$allvalfandrive)
                ->with('allvalaircomp',$allvalaircomp)
                ->with('allvalwaterpump',$allvalwaterpump)
                ->with('showrejectcom',$showrejectcom)
                ->with('showmissingstatus',$showmissingstatus)
                //->with('showcheckassembly', $showcheckassembly)
                ->with('showdissambly',$showdissambly)
                //->with('beforestart',$beforestart)
                ->with('beforestartccassembly', $beforestartccassembly)
                ->with('allvalcylinderheadoil',$allvalcylinderheadoil)
                ->with('cominspecreport',$cominspecreport)
                ->with('showcluplatethi',$showcluplatethi)
                ->with('showcluplateflt',$showcluplateflt)
                ->with('showtorque',$showtorque)
                ->with('showtransmission',$showtransmission)
                ->with('allvaltrans',$allvaltrans)
                ->with('showrolspec',$showrolspec)
                ->with('showrolmea',$showrolmea)
                ->with('showidlerpec',$showidlerpec)
                ->with('allvalrolmea',$allvalrolmea)
                ->with('showrolspcend',$showrolspcend)
                ->with('showidlermesbef',$showidlermesbef)
                ->with('showidlermesaft',$showidlermesaft)
                ->with('showidlerspend',$showidlerspend)
                ->with('showidleclr',$showidleclr)
                ->with('showrollclr',$showrollclr)
                ->with('showlhcamshaft',$showlhcamshaft)
                ->with('showrhcamshaft',$showrhcamshaft)
                ->with('showrhcambush',$showrhcambush)
                ->with('allvallLhcamsft',$allvallLhcamsft)
                ->with('allvalrLhcamsft',$allvalrLhcamsft)
                ->with('allvalcamsftbush',$allvalcamsftbush)
                ->with('showcylblklinear',$showcylblklinear)
                ->with('allvalcylblkliner',$allvalcylblkliner)
                ->with('showcylblkcam',$showcylblkcam)
                ->with('allvalcylblkcam',$allvalcylblkcam)
                ->with('linArray',$linArray)
                ->with('linfrntreslt',$linfrntreslt)
                ->with('linfrtmainrst',$linfrtmainrst)
                ->with('linrearcenteryes',$linrearcenteryes)
                ->with('linrearresyes',$linrearresyes)
                ->with('linrearremaryes',$linrearremaryes)
                ->with('camArray',$camArray)
                ->with('camfrntreslt',$camfrntreslt)
                ->with('camfrtmainrst',$camfrtmainrst)
                ->with('camrearcenteryes',$camrearcenteryes)
                ->with('camrearresyes',$camrearresyes)
                ->with('camrearremaryes',$camrearremaryes)
                ->with('showcytopdk',$showcytopdk)
                ->with('allvalcytopdk',$allvalcytopdk)
                ->with('showcythread',$showcythread)
                ->with('allvalcythread',$allvalcythread)
                ->with('showcybush',$showcybush)
                ->with('allvalcybush',$allvalcybush)
                ->with('allvalcyCap',$allvalcyCap)
                ->with('showcycap',$showcycap)
                ->with('allvfanaldrive',$allvfanaldrive)
                ->with('showassembly', $showassembly)
                ->with('allvalassembly', $allvalassembly)
                ->with('ccbeforestartassembly',$ccbeforestartassembly)
                ->with('rejectmsg',$rejectmsg)
                 
                ->with('rejectmsg1',$rejectmsg1)
                 
                ->with('customer',$customer)

                ->with('cccompinsp',$cccompinsp);


        }
        else{
            $service=Null;
            $checkgatefollow=Null;
            $allvalchkgtfollow=Null;
            $agrregate=Null;
            $mcModel=Null;
            $mcSerial=Null;
            $componentSerial=Null;
            $commercialLogistic=Null;
            $prehist=Null;
            $machSerial=Null;
            $comSerial=Null;
            $externalWash=Null;
            $beforestartccassembly=Null;
            $partsClean=Null;
            $cylinder=Null;
            $showothercomp=Null;
            $myArray=Null;
            $showconrod=Null;
            $showconrodbush=Null;
            $frntreslt=Null;
            $rearcenteryes=Null;
            $rearresyes=Null;
            $rearremaryes=Null;
            $showcrankshaft=Null;
            $showcamshaft=Null;
            $showcylinderblock=Null;
            $frtmainrst=Null;
            $showfandrive=Null;
            $showoilpump=Null;
            $showaircomp=Null;
            $showwaterpump=Null;
            $showcompinsp=Null;
            $beforestartassembly=Null;
            $showcooler=Null;
            $showrolmea=Null;
            $showlhcamshaft=Null;
            $showrhcamshaft=Null;
            $showrhcambush=Null;
            $showcylblklinear=Null;
            $showcylblkcam=Null;
            $linArray=Null;
            $linfrntreslt=Null;
            $linfrtmainrst=Null;
            $linrearcenteryes=Null;
            $linrearresyes=Null;
            $linrearremaryes=Null;
            $camArray=Null;
            $camfrntreslt=Null;
            $camfrtmainrst=Null;
            $camrearcenteryes=Null;
            $camrearresyes=Null;
            $camrearremaryes=Null;
            $showcytopdk=Null;
            $showcythread=Null;
            $showcybush=Null;
            $showcycap=Null;
            $allvalcommercialLog=Null;
            $allvalexterwash=Null;
            $allvalpartcln=Null;
            $allvalinsprpt=Null;
            $allvaltrans=Null;
            $allvalcylinderblock=Null;
            $allvalcylblkcam=Null;
            $allvalcytopdk=Null;
            $allvalcythread=Null;
            $allvalcybush=Null;
            $allvalcyCap=Null;
            $allvalcamsft=Null;
            $allvallLhcamsft=Null;
            $allvalrLhcamsft=Null;
            $allvalcamsftbush=Null;
            $allvalconrod=Null;
            $allvalcylinderheadoil=Null;
            $allvalothercom=Null;
            $allvfanaldrive=Null;
            $allvaloilpump=Null;
            $allvalaircomp=Null;
            $allvalwaterpump=Null;
            $allvalcooler=Null;
            $allvalrolmea=Null;
            $showassembly=Null;
            $allvalassembly=Null;
            $customer=Null;
            $showdissambly=Null;
             $rejectmsg1=Null;
             $rejectmsg=Null;

            return view($view)
                ->with('service',$service)
                ->with('checkgatefollow',$checkgatefollow)
                ->with('allvalchkgtfollow',$allvalchkgtfollow)
                ->with('agrregate', $agrregate)
                ->with('mcModel', $mcModel)
                ->with('mcSerial', $mcSerial)
                ->with('componentSerial', $componentSerial)
                ->with('commercialLogistic',$commercialLogistic)
                ->with('prehist',$prehist)
                ->with('machSerial',$machSerial)
                ->with('comSerial',$comSerial)
                ->with('externalWash',$externalWash)
                ->with('partsClean',$partsClean)
                ->with('cylinder',$cylinder)
                ->with('showothercomp',$showothercomp)
                ->with('showcompinsp',$showcompinsp)
                ->with('myArray',$myArray)
                ->with('showconrod',$showconrod)
                ->with('showconrodbush',$showconrodbush)
                ->with('showfandrive',$showfandrive)
                ->with('showoilpump',$showoilpump)
                ->with('showaircomp',$showaircomp)
                ->with('showwaterpump',$showwaterpump)
                //->with('showcluthick',$showcluthick)
                ->with('frntreslt',$frntreslt)
                ->with('frtmainrst',$frtmainrst)
                ->with('rearcenteryes',$rearcenteryes)
                ->with('rearresyes',$rearresyes)
                ->with('rearremaryes',$rearremaryes)
                ->with('showcrankshaft',$showcrankshaft)
                ->with('showcamshaft',$showcamshaft)
                ->with('showcooler',$showcooler)
                ->with('showrolmea',$showrolmea)
                ->with('showrhcamshaft',$showrhcamshaft)
                ->with('showrhcambush',$showrhcambush)
                ->with('showcylblklinear',$showcylblklinear)
                ->with('showcylblkcam',$showcylblkcam)
                ->with('linArray',$linArray)
                ->with('linfrntreslt',$linfrntreslt)
                ->with('linfrtmainrst',$linfrtmainrst)
                ->with('linrearcenteryes',$linrearcenteryes)
                ->with('linrearresyes',$linrearresyes)
                ->with('linrearremaryes',$linrearremaryes)
                ->with('camArray',$camArray)
                ->with('camfrntreslt',$camfrntreslt)
                ->with('camfrtmainrst',$camfrtmainrst)
                ->with('camrearcenteryes',$camrearcenteryes)
                ->with('camrearresyes',$camrearresyes)
                ->with('camrearremaryes',$camrearremaryes)
                ->with('showcytopdk',$showcytopdk)
                ->with('showcythread',$showcythread)
                ->with('showcybush',$showcybush)
                ->with('showcycap',$showcycap)
                //->with('showcluplatethi',$showcluplatethi)
                ->with('beforestartassembly',$beforestartassembly)
                ->with('allvalcommercialLog',$allvalcommercialLog)
                ->with('allvalexterwash',$allvalexterwash)
                ->with('allvalpartcln',$allvalpartcln)
                ->with('allvalinsprpt',$allvalinsprpt)
                ->with('allvaltrans',$allvaltrans)
                ->with('allvalcylinderblock',$allvalcylinderblock)
                ->with('allvalcylblkcam',$allvalcylblkcam)
                ->with('allvalcytopdk',$allvalcytopdk)
                ->with('allvalcythread',$allvalcythread)
                ->with('allvalcybush',$allvalcybush)
                ->with('allvalcyCap',$allvalcyCap)
                ->with('allvalcamsft',$allvalcamsft)
                ->with('allvallLhcamsft',$allvallLhcamsft)
                ->with('allvalrLhcamsft',$allvalrLhcamsft)
                ->with('allvalcamsftbush',$allvalcamsftbush)
                ->with('allvalconrod',$allvalconrod)
                ->with('allvalcylinderheadoil',$allvalcylinderheadoil)
                ->with('allvalothercom',$allvalothercom)
                ->with('allvfanaldrive',$allvfanaldrive)
                ->with('allvaloilpump',$allvaloilpump)
                ->with('allvalaircomp',$allvalaircomp)
                ->with('allvalwaterpump',$allvalwaterpump)
                ->with('allvalcooler',$allvalcooler)
                ->with('allvalrolmea',$allvalrolmea)
                ->with('showassembly', $showassembly)
                ->with('allvalassembly', $allvalassembly)
                ->with('customer', $customer)
                ->with('showdissambly', $showdissambly)
             ->with('rejectmsg1',$rejectmsg1)
                ->with('rejectmsg', $rejectmsg)
                ->with('showcylinderblock',$showcylinderblock);



        }








    }
    
    public function engineassembly(Request $request)
    {
         $data = Session::all();
        $dept_id=$data['user']['section_id'];
       // $service = Service::find($request['service_id']);
        //$engine=ChecksheetAssembly::where('service_request_id','=',$service->id)
           // ->where('dept_id','=',$request['dept_id'])->get()->first();

        $service = Service::find($request['service_id']);
        //$engineassemly=ChecksheetAssembly::where('service_request_id','=',$service->id)
            //->where('dept_id','=',$request['dept_id'])->get()->first();
        if(isset($request['assembly_status'])){
            $dept_id=$data['user']['section_id'];
            //$srv_id;
            $assembly_status = 1;
            $assembly_res = ChecksheetAssembly ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->where('assembly_status','=',1)
                ->get()->toArray();
            
            if(count($assembly_res)<=0){
                $engineassemly = new ChecksheetAssembly();
                $engineassemly->assembly_status = 1;
            }
            else{
                $engineassemly = ChecksheetAssembly::find($assembly_res[0]['id']);
                $engineassemly->assembly_status = 1;
            }
        }

        $engineassemblyreport=$request->all();
        if(isset($service->id)) {
            $engineassemly->service_request_id = $service->id;
            $engineassemly->dept_id = $dept_id;

            $engineassemly->assembly_status = isset($request['assembly_status']) ? '1':null;
            $engineassemly->cc_value = json_encode($engineassemblyreport);
            $engineassemly->actual_start_date = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'])->format('Y-m-d');
            $engineassemly->actual_end_date = date("Y-m-d");
            $engineassemly->save();
        }



   $sec=17;
       $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec,$engineassemly->actual_start_date, $engineassemly->actual_end_date);
       
        $sec1=28;
        $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$service->machine_modelno,$request['service_id'],$sec1,$engineassemly->actual_start_date, $engineassemly->actual_end_date);

        return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
    }


  public function checkSheetTotalFormSave(Request $request)
   
    {

        $data = Session::all();
        $service = Service::find($request['service_id']);

        $dept_id=$data['user']['section_id'];
        //dd($service->id);exit;


        $route_check =  request()->segment(2);

        //if($route_check == 'check-sheet-entry-common'){
            //Aggregate Freeze
            //dd($route_check);exit;
            
            $checkgatefollow=CheckgateOneFollowedUp::where('service_request_id','=',$service->id)

            ->where('dept_id','=',$dept_id)
            ->get()->first();
        if (isset($checkgatefollow->id)){
            $checkgatefollow->work_done = 1;
            $checkgatefollow->save();
        }
            $agreesubmit = MasterAggregate::where('service_request_id', '=', $service->id)
                ->where('dept_id', '=', $dept_id)->get()->first();
            //echo '<pre>';print_r($agreesubmit);exit;
            //dd($agreesubmit);exit;
            if (isset($agreesubmit->id)){
                $agreesubmit->work_done = 1;
                $agreesubmit->save();
            }
            //pre history freeze

            $presubmit=MasterPreHistoryDis::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($presubmit->id)) {
                $presubmit->work_done = 1;
                $presubmit->save();
            }
			
			 //parts track link height
        $tracklinheisubmit=PartTrackLinkHeight::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($tracklinheisubmit->id)) {
            $tracklinheisubmit->work_done = 1;
            $tracklinheisubmit->save();
        }
        // parts track pitch
        $trackpitchsubmit=PartTrackPitch::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($trackpitchsubmit->id)) {
            $trackpitchsubmit->work_done = 1;
            $trackpitchsubmit->save();
        }
        // parts track link pin
        $tracklinkpinsubmit=PartTrackLinkPin::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($tracklinkpinsubmit->id)) {
            $tracklinkpinsubmit->work_done = 1;
            $tracklinkpinsubmit->save();
        }
        // parts track link bush
        $tracklinkbushsubmit=PartTrackLinkBush::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($tracklinkbushsubmit->id)) {
            $tracklinkbushsubmit->work_done = 1;
            $tracklinkbushsubmit->save();
        }
        // parts track shoe
        $trackshoesubmit=PartTrackShoe::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($trackshoesubmit->id)) {
            $trackshoesubmit->work_done = 1;
            $trackshoesubmit->save();
        }
        // parts pin insp
        $pininspsubmit=PartPinInspMea::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($pininspsubmit->id)) {
            $pininspsubmit->work_done = 1;
            $pininspsubmit->save();
        }
        // parts bush insp
        $bushinspsubmit=PartBushInspMea::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($bushinspsubmit->id)) {
            $bushinspsubmit->work_done = 1;
            $bushinspsubmit->save();
        }
			
            //commercial freeze
            $commercialsubmit=MasterCommercialValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($commercialsubmit->id)) {
                $commercialsubmit->work_done = 1;
                $commercialsubmit->save();
            }
            //loose part
            $loosesubmit=MasterLoosepartDis::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($loosesubmit->id)) {
                $loosesubmit->work_done = 1;
                $loosesubmit->save();
            }

            //cc external wash
            $externalwashsubmit=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($externalwashsubmit->id)) {
                $externalwashsubmit->work_done = 1;
                $externalwashsubmit->save();
            }
             //cc inspection before start assembly

            $beforestartassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($beforestartassembly->id)) {
                $beforestartassembly->work_done = 1;
                $beforestartassembly->save();
            }
            //component inspection report
            $compinspectionreport=ComponentInspReport::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset( $compinspectionreport->id)) {
                $compinspectionreport->work_done = 1;
                $compinspectionreport->save();
            }
            //status_revision
            $statusrevision=StatusRevision::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($statusrevision->id)) {
                $statusrevision->work_done = 1;
                $statusrevision->save();
            }
            //disassembly checksheet inspection checksheet
            $showdiss=MasterDissamblyCleaningInspection::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($showdiss->id)) {
                $showdiss->work_done = 1;
                $showdiss->save();
            }


            //cc part clean
            $partcleansubmit=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($partcleansubmit->id)) {
                $partcleansubmit->work_done = 1;
                $partcleansubmit->save();
            }

            //missing damage
            $partcleansubmit=MasterMissingdamagePartDis::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($partcleansubmit->id)) {
                $partcleansubmit->work_done = 1;
                $partcleansubmit->save();
            }

            //parts-cylinder block
            $cylinderblocksubmit=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($cylinderblocksubmit->id)) {
                $cylinderblocksubmit->work_done = 1;
                $cylinderblocksubmit->save();
            }

            //parts-cranshaft
            $cranshaftsubmit=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($cranshaftsubmit->id)) {
                $cranshaftsubmit->work_done = 1;
                $cranshaftsubmit->save();
            }

            //parts-camshaft
            $camshaftsubmit=MasterPartCamshaftValue::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($camshaftsubmit->id)) {
                $camshaftsubmit->work_done = 1;
                $camshaftsubmit->save();
            }

            //parts-connectingrod
            $connrodsubmit=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($connrodsubmit->id)) {
                $connrodsubmit->work_done = 1;
                $connrodsubmit->save();
            }

            //parts-fandrive
            $partsfandrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($partsfandrive->id)) {
                $partsfandrive->work_done = 1;
                $partsfandrive->save();
            }

            //parts-oil pump
            $partsoilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)->get()->first();
            if (isset($partsoilpump->id)) {
                $partsoilpump->work_done = 1;
                $partsoilpump->save();
            }
            //parts-water pump
            $partswaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($partswaterpump->id)) {
                $partswaterpump->work_done = 1;
                $partswaterpump->save();
            }
            //parts-cylinder head &oil
            $cyheadsubmit=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
                ->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($cyheadsubmit->id)) {
                $cyheadsubmit->work_done = 1;
                $cyheadsubmit->save();
            }

            //parts-othercomp
            $othersubmit=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($othersubmit->id)) {
                $othersubmit->work_done = 1;
                $othersubmit->save();
            }

            //list of salvage
            $listsalsubmit=MasterListofSalvageDis::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($listsalsubmit->id)) {

                $listsalsubmit->work_done = 1;
                $listsalsubmit->save();
            }

            //Failed parts
            $listsalsubmit=MasterFailedParts::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($listsalsubmit->id)) {

                $listsalsubmit->work_done = 1;
                $listsalsubmit->save();
            }

            //Conrod bush
            $listcon=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)->get()->where('dept_id', '=', $dept_id)->first();
            if (isset($listcon->id)) {

                $listcon->work_done = 1;
                $listcon->save();
            }

            //Transmission
            $trans=TransmissionComponent::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($trans->id)) {

                $trans->work_done = 1;
                $trans->save();
            }
            //parts cylinder linear
            $lin=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($lin->id)) {

                $lin->work_done = 1;
                $lin->save();
            }
            //parts cylinder linear
            $cambre=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($cambre->id)) {

                $cambre->work_done = 1;
                $cambre->save();
            }
            //parts cylinder top deck
            $topdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($topdk->id)) {

                $topdk->work_done = 1;
                $topdk->save();
            }
            //parts cylinder thred
            $tred=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($tred->id)) {

                $tred->work_done = 1;
                $tred->save();
            }
            //parts cylinder bush bore
            $bush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($bush->id)) {

                $bush->work_done = 1;
                $bush->save();
            }
            //parts cylinder cap width
            $cap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($cap->id)) {

                $cap->work_done = 1;
                $cap->save();
            }
            //parts camshaft lh
            $camlh=PartLhCamshaftValue::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($camlh->id)) {

                $camlh->work_done = 1;
                $camlh->save();
            }
            //parts camshaft rh
            $camrh=PartRhCamshaftValue::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($camrh->id)) {

                $camrh->work_done = 1;
                $camrh->save();
            }
            //parts camshaft cam bush
            $cambush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($cambush->id)) {

                $cambush->work_done = 1;
                $cambush->save();
            }
            //parts air
            $air=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($air->id)) {

                $air->work_done = 1;
                $air->save();
            }
            //parts cooler
            $coleer=CoolerInspectionValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($coleer->id)) {

                $coleer->work_done = 1;
                $coleer->save();
            }
            //parts clutch pack
            $clupck=ClutchPackThicknessValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($clupck->id)) {

                $clupck->work_done = 1;
                $clupck->save();
            }
            //parts clutch plate thi
            $plathi=ClutchPlateThicknessValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($plathi->id)) {

                $plathi->work_done = 1;
                $plathi->save();
            }
            //parts clutch plate flat
            $plaflt=ClutchPlateFlatnessValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($plaflt->id)) {

                $plaflt->work_done = 1;
                $plaflt->save();
            }
            //parts torque
            $torque=TorqueConverterValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($torque->id)) {

                $torque->work_done = 1;
                $torque->save();
            }
            //parts roller spci
            $rollpcs=RoolerSpecificationValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($rollpcs->id)) {

                $rollpcs->work_done = 1;
                $rollpcs->save();
            }
            //parts roller meas
            $rollmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($rollmea->id)) {

                $rollmea->work_done = 1;
                $rollmea->save();
            }
            //parts roller end col
            $rollend=RoolerSpecifiEndColValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($rollend->id)) {

                $rollend->work_done = 1;
                $rollend->save();
            }
            //parts roller clr shft
            $rolshft=RollerspcClearShaftValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($rolshft->id)) {

                $rolshft->work_done = 1;
                $rolshft->save();
            }

            //parts idler spc
            $idlerspc=IdlerSpecificationValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($idlerspc->id)) {

                $idlerspc->work_done = 1;
                $idlerspc->save();
            }
            //parts idler mea before
            $idlebf=IdlerMeasuredBeforeValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($idlebf->id)) {

                $idlebf->work_done = 1;
                $idlebf->save();
            }
            //parts idler mea after
            $idleaaf=IdlerMeasuredAfterValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($idleaaf->id)) {

                $idleaaf->work_done = 1;
                $idleaaf->save();
            }
            //parts idler end col
            $idleend=IdlerSpeciEndcolerValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($idleend->id)) {

                $idleend->work_done = 1;
                $idleend->save();
            }
            //parts idler clear
            $idlclr=IdlerspcClearShaftValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
            if (isset($idlclr->id)) {

                $idlclr->work_done = 1;
                $idlclr->save();
            }
            
            // $statussubmit=Service::where('id','=',$service->id)->get()->first();
            // if (isset($statussubmit->id)) {

            //     $statussubmit->dcs_status = 'Submitted';
            //     $statussubmit->save();
            // }
        //}

           $chechsheetstatus=ChecksheetStatus::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$dept_id)->get()->first();
          if (isset($chechsheetstatus->id)) {

              $chechsheetstatus->disassembly_status = 'Submitted';
              $chechsheetstatus->save();
            }



        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
    
    
    //assy total form submit
    public function checkSheetAssyTotalFormSave(Request $request){

        $data = Session::all();
        $service = Service::find($request['service_id']);

        $dept_id=$data['user']['section_id'];
        $assemcheck = ChecksheetAssembly::where('service_request_id', '=', $service->id)
            ->where('dept_id', '=', $dept_id)->get()->first();
        //echo '<pre>';print_r($agreesubmit);exit;
        //dd($agreesubmit);exit;
        if (isset($assemcheck->id)){
            $assemcheck->ass_Work_done = 1;
            $assemcheck->save();
        }
        // $statussubmit=Service::where('id','=',$service->id)->get()->first();
        // if (isset($statussubmit->id)) {

        //     $statussubmit->asc_status = 'Submitted';
        //     $statussubmit->save();
        // }
        
        if (request()->session()->get('user')['section_id'] == '10'){
            $dept_id1 = '4';
        }
        if(request()->session()->get('user')['section_id'] == '11'){
            $dept_id1 = '5';
        }
        if(request()->session()->get('user')['section_id'] == '15'){
             $dept_id1 = '7';
        }
        if(request()->session()->get('user')['section_id'] == '12'){
              $dept_id1 = '13';
        }
        
         $chechsheetstatus=ChecksheetStatus::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$dept_id1)->get()->first();
          if (isset($chechsheetstatus->id)) {

              $chechsheetstatus->assembly_status = 'Submitted';
              $chechsheetstatus->save();
            }
        
        return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);

    }


    //again diss assy save button open
    public function checkSheetButtonOpenFormSave(Request $request)
    {

        $data = Session::all();
        $service = Service::find($request['commodel']);

        $dept_id=$data['user']['section_id'];



        $route_check =  request()->segment(2);

        //if($route_check == 'check-sheet-entry-common'){
        //Aggregate Freeze
        //dd($route_check);exit;
        $checkgatefollow=CheckgateOneFollowedUp::where('service_request_id','=',$service->id)

            ->where('dept_id','=',$dept_id)
            ->get()->first();
        if (isset($checkgatefollow->id)){
            $checkgatefollow->work_done = 0;
            $checkgatefollow->save();
        }
        
        $agreesubmit = MasterAggregate::where('service_request_id', '=', $service->id)
            ->where('dept_id', '=', $dept_id)->get()->first();
        //echo '<pre>';print_r($agreesubmit);exit;
        //dd($agreesubmit);exit;
        if (isset($agreesubmit->id)){
            $agreesubmit->work_done = 0;
            $agreesubmit->save();
        }
        //pre history freeze

        $presubmit=MasterPreHistoryDis::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($presubmit->id)) {
            $presubmit->work_done = 0;
            $presubmit->save();
        }
		//track link height
        $tracklinheisubmit=PartTrackLinkHeight::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($tracklinheisubmit->id)) {
            $tracklinheisubmit->work_done = 0;
            $tracklinheisubmit->save();
        }

        // parts track pitch
        $trackpitchsubmit=PartTrackPitch::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($trackpitchsubmit->id)) {
            $trackpitchsubmit->work_done = 0;
            $trackpitchsubmit->save();
        }

        // parts track link pin
        $tracklinkpinsubmit=PartTrackLinkPin::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($tracklinkpinsubmit->id)) {
            $tracklinkpinsubmit->work_done = 0;
            $tracklinkpinsubmit->save();
        }
        // parts track link bush
        $tracklinkbushsubmit=PartTrackLinkBush::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($tracklinkbushsubmit->id)) {
            $tracklinkbushsubmit->work_done = 0;
            $tracklinkbushsubmit->save();
        }

        // parts track shoe
        $trackshoesubmit=PartTrackShoe::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($trackshoesubmit->id)) {
            $trackshoesubmit->work_done = 0;
            $trackshoesubmit->save();
        }
        // parts pin insp
        $pininspsubmit=PartPinInspMea::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($pininspsubmit->id)) {
            $pininspsubmit->work_done = 0;
            $pininspsubmit->save();
        }

        // parts bush insp
        $bushinspsubmit=PartBushInspMea::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($bushinspsubmit->id)) {
            $bushinspsubmit->work_done = 0;
            $bushinspsubmit->save();
        }
		
        //commercial freeze
        $commercialsubmit=MasterCommercialValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($commercialsubmit->id)) {
            $commercialsubmit->work_done = 0;
            $commercialsubmit->save();
        }
        //loose part
        $loosesubmit=MasterLoosepartDis::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($loosesubmit->id)) {
            $loosesubmit->work_done = 0;
            $loosesubmit->save();
        }

        //cc external wash
        $externalwashsubmit=MasterCcinspectionExternalWashDetails::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($externalwashsubmit->id)) {
            $externalwashsubmit->work_done = 0;
            $externalwashsubmit->save();
        }
        //cc inspection before start assembly

        $beforestartassembly=MasterCCinspectionBeforeStartAssembly::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($beforestartassembly->id)) {
            $beforestartassembly->work_done = 0;
            $beforestartassembly->save();
        }
        //component inspection report
        $compinspectionreport=ComponentInspReport::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset( $compinspectionreport->id)) {
            $compinspectionreport->work_done = 0;
            $compinspectionreport->save();
        }
        //status_revision
        $statusrevision=StatusRevision::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($statusrevision->id)) {
            $statusrevision->work_done = 0;
            $statusrevision->save();
        }
        //disassembly checksheet inspection checksheet
        $showdiss=MasterDissamblyCleaningInspection::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($showdiss->id)) {
            $showdiss->work_done = 0;
            $showdiss->save();
        }


        //cc part clean
        $partcleansubmit=MasterCcinspectionPartCleanDetails::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($partcleansubmit->id)) {
            $partcleansubmit->work_done = 0;
            $partcleansubmit->save();
        }

        //missing damage
        $partcleansubmit=MasterMissingdamagePartDis::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($partcleansubmit->id)) {
            $partcleansubmit->work_done = 0;
            $partcleansubmit->save();
        }

        //parts-cylinder block
        $cylinderblocksubmit=MasterPartCylinderHeadValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($cylinderblocksubmit->id)) {
            $cylinderblocksubmit->work_done = 0;
            $cylinderblocksubmit->save();
        }

        //parts-cranshaft
        $cranshaftsubmit=MasterPartCrankshaftValue::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($cranshaftsubmit->id)) {
            $cranshaftsubmit->work_done = 0;
            $cranshaftsubmit->save();
        }

        //parts-camshaft
        $camshaftsubmit=MasterPartCamshaftValue::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($camshaftsubmit->id)) {
            $camshaftsubmit->work_done = 0;
            $camshaftsubmit->save();
        }

        //parts-connectingrod
        $connrodsubmit=MasterPartConnectingRodValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($connrodsubmit->id)) {
            $connrodsubmit->work_done = 0;
            $connrodsubmit->save();
        }

        //parts-fandrive
        $partsfandrive=MasterPartFanDriveValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($partsfandrive->id)) {
            $partsfandrive->work_done = 0;
            $partsfandrive->save();
        }

        //parts-oil pump
        $partsoilpump=MasterPartOilPumpValues::where('service_request_id','=',$service->id)->get()->first();
        if (isset($partsoilpump->id)) {
            $partsoilpump->work_done = 0;
            $partsoilpump->save();
        }
        //parts-water pump
        $partswaterpump=MasterPartWaterPumpValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($partswaterpump->id)) {
            $partswaterpump->work_done = 0;
            $partswaterpump->save();
        }
        //parts-cylinder head &oil
        $cyheadsubmit=MasterPartsInspectionCylinderHeadValues::where('service_request_id','=',$service->id)
            ->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($cyheadsubmit->id)) {
            $cyheadsubmit->work_done = 0;
            $cyheadsubmit->save();
        }

        //parts-othercomp
        $othersubmit=MasterPartOthercomponentValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($othersubmit->id)) {
            $othersubmit->work_done = 0;
            $othersubmit->save();
        }

        //list of salvage
        $listsalsubmit=MasterListofSalvageDis::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($listsalsubmit->id)) {

            $listsalsubmit->work_done = 0;
            $listsalsubmit->save();
        }

        //Failed parts
        $listsalsubmit=MasterFailedParts::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($listsalsubmit->id)) {

            $listsalsubmit->work_done = 0;
            $listsalsubmit->save();
        }

        //Conrod bush
        $listcon=MasterConRodBushReplacementValues::where('service_request_id','=',$service->id)->get()->where('dept_id', '=', $dept_id)->first();
        if (isset($listcon->id)) {

            $listcon->work_done = 0;
            $listcon->save();
        }

        //Transmission
        $trans=TransmissionComponent::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($trans->id)) {

            $trans->work_done = 0;
            $trans->save();
        }
        //parts cylinder linear
        $lin=PartCylinderBlockLinearValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($lin->id)) {

            $lin->work_done = 0;
            $lin->save();
        }
        //parts cylinder linear
        $cambre=PartCylinderBlockCamboreValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($cambre->id)) {

            $cambre->work_done = 0;
            $cambre->save();
        }
        //parts cylinder top deck
        $topdk=PartCylinderBlockTopDeckValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($topdk->id)) {

            $topdk->work_done = 0;
            $topdk->save();
        }
        //parts cylinder thred
        $tred=PartCylinderBlockThreadValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($tred->id)) {

            $tred->work_done = 0;
            $tred->save();
        }
        //parts cylinder bush bore
        $bush=PartCylinderBlockBushboreValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($bush->id)) {

            $bush->work_done = 0;
            $bush->save();
        }
        //parts cylinder cap width
        $cap=PartCylinderBlockCapNoValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($cap->id)) {

            $cap->work_done = 0;
            $cap->save();
        }
        //parts camshaft lh
        $camlh=PartLhCamshaftValue::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($camlh->id)) {

            $camlh->work_done = 0;
            $camlh->save();
        }
        //parts camshaft rh
        $camrh=PartRhCamshaftValue::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($camrh->id)) {

            $camrh->work_done = 0;
            $camrh->save();
        }
        //parts camshaft cam bush
        $cambush=PartCamshaftBushboreValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($cambush->id)) {

            $cambush->work_done = 0;
            $cambush->save();
        }
        //parts air
        $air=MasterPartAirCompressorValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($air->id)) {

            $air->work_done = 0;
            $air->save();
        }
        //parts cooler
        $coleer=CoolerInspectionValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($coleer->id)) {

            $coleer->work_done = 0;
            $coleer->save();
        }
        //parts clutch pack
        $clupck=ClutchPackThicknessValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($clupck->id)) {

            $clupck->work_done = 0;
            $clupck->save();
        }
        //parts clutch plate thi
        $plathi=ClutchPlateThicknessValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($plathi->id)) {

            $plathi->work_done = 0;
            $plathi->save();
        }
        //parts clutch plate flat
        $plaflt=ClutchPlateFlatnessValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($plaflt->id)) {

            $plaflt->work_done = 0;
            $plaflt->save();
        }
        //parts torque
        $torque=TorqueConverterValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($torque->id)) {

            $torque->work_done = 0;
            $torque->save();
        }
        //parts roller spci
        $rollpcs=RoolerSpecificationValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($rollpcs->id)) {

            $rollpcs->work_done = 0;
            $rollpcs->save();
        }
        //parts roller meas
        $rollmea=RoolerMeasuredValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($rollmea->id)) {

            $rollmea->work_done = 0;
            $rollmea->save();
        }
        //parts roller end col
        $rollend=RoolerSpecifiEndColValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($rollend->id)) {

            $rollend->work_done = 0;
            $rollend->save();
        }
        //parts roller clr shft
        $rolshft=RollerspcClearShaftValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($rolshft->id)) {

            $rolshft->work_done = 0;
            $rolshft->save();
        }

        //parts idler spc
        $idlerspc=IdlerSpecificationValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($idlerspc->id)) {

            $idlerspc->work_done = 0;
            $idlerspc->save();
        }
        //parts idler mea before
        $idlebf=IdlerMeasuredBeforeValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($idlebf->id)) {

            $idlebf->work_done = 0;
            $idlebf->save();
        }
        //parts idler mea after
        $idleaaf=IdlerMeasuredAfterValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($idleaaf->id)) {

            $idleaaf->work_done = 0;
            $idleaaf->save();
        }
        //parts idler end col
        $idleend=IdlerSpeciEndcolerValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($idleend->id)) {

            $idleend->work_done = 0;
            $idleend->save();
        }
        //parts idler clear
        $idlclr=IdlerspcClearShaftValues::where('service_request_id','=',$service->id)->where('dept_id', '=', $dept_id)->get()->first();
        if (isset($idlclr->id)) {

            $idlclr->work_done = 0;
            $idlclr->save();
        }
        
        // $statussubmit=Service::where('id','=',$service->id)->get()->first();
        // if (isset($statussubmit->id)) {

        //     $statussubmit->dcs_status = 'Submitted';
        //     $statussubmit->save();
        // }
        //}

         $chechsheetstatus=ChecksheetStatus::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$dept_id)->get()->first();
          if (isset($chechsheetstatus->id)) {

              $chechsheetstatus->disassembly_status = 'Submitted';
              $chechsheetstatus->save();
            }



        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }
    
    //again assy save button open
    public function checkSheetAssyButtonOpenFormSave(Request $request)
    {

        $data = Session::all();
        $service = Service::find($request['commodel']);

        $dept_id=$data['user']['section_id'];



        //engine assembly
        $assemcheck = ChecksheetAssembly::where('service_request_id', '=', $service->id)
            ->where('dept_id', '=', $dept_id)->get()->first();
        //echo '<pre>';print_r($agreesubmit);exit;
        //dd($agreesubmit);exit;
        if (isset($assemcheck->id)){
            $assemcheck->ass_Work_done = 0;
            $assemcheck->save();
        }
        // $statussubmit=Service::where('id','=',$service->id)->get()->first();
        // if (isset($statussubmit->id)) {

        //     $statussubmit->asc_status = 'Submitted';
        //     $statussubmit->save();
        // }
        //}
        
        if (request()->session()->get('user')['section_id'] == '10'){
            $dept_id1 = '4';
        }
        if(request()->session()->get('user')['section_id'] == '11'){
            $dept_id1 = '5';
        }
        if(request()->session()->get('user')['section_id'] == '15'){
             $dept_id1 = '7';
        }
        if(request()->session()->get('user')['section_id'] == '12'){
              $dept_id1 = '13';
        }
      $chechsheetstatus=ChecksheetStatus::where('service_request_id','=',$service->id)
            ->where('dept_id','=',$dept_id1)->get()->first();
          if (isset($chechsheetstatus->id)) {

              $chechsheetstatus->assembly_status = 'Submitted';
              $chechsheetstatus->save();
            }



        if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/check-sheet-entry-common/'.$request['service_id']);
        }else{

            return redirect('admin/check-sheet-assembly-common/'.$request['service_id']);
        }
    }


    //checksheet download in excel

     public function excelDownload(Request $request)
    {
        $service = Service::find($request['service_id']);
        $data = Session::all();
        $dept_id=$data['user']['section_id'];


        $objPHPExcel = new PHPExcel();

        /* Create a first sheet, representing sales data*/
        $aggregate   = MasterAggregate::select('*')->where('service_request_id','=',$service->id)->where('dept_id','=',$dept_id)->get()->toArray();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Equipment Model');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Machine SMU');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Component SMU');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'ISO Document Number');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Date of arrival');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Date of dispatch');
        //$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Actual Start Date');
        $i=2;
        foreach ($aggregate as $key=> $row){
            //dd($row);
        //while($row = array($aggregate)) {
            //dd($row[0][0]['machine_modelno']);
            $mode=$row['machine_modelno'];
            $macsmu=$row['machine_smu'];
            $compsmu=$row['component_smu'];
            $iso=$row['iso_doc_no'];
            $datearrivl=Carbon::parse($row['date_arrival'])->format('d/m/Y');
            $datedispact=Carbon::parse($row['date_dispatch'])->format('d/m/Y');
            //$actualdt=$row['actual_start_date'];
            $objPHPExcel->getActiveSheet()->setCellValue("A$i",$mode);
             $objPHPExcel->getActiveSheet()->setCellValue("B$i",$macsmu);
             $objPHPExcel->getActiveSheet()->setCellValue("C$i",$compsmu);
             $objPHPExcel->getActiveSheet()->setCellValue("D$i",$iso);
             $objPHPExcel->getActiveSheet()->setCellValue("E$i",$datearrivl);
             $objPHPExcel->getActiveSheet()->setCellValue("F$i",$datedispact);
             //$objPHPExcel->getActiveSheet()->setCellValue("G$i",$actualdt);


          $i++;

        }

        /*Rename sheet*/
        $objPHPExcel->getActiveSheet()->setTitle('Aggregate');


        /* Create a 2 worksheet, after the default sheet*/
        $checkgateonefollow=UserHelper::checkgateonefollowby();
        $chkgte=CheckgateOneFollowedUp::select('gw_checkgateonefollowed_values.values as chkgteval')->where('service_request_id','=',$service->id)->where('dept_id','=',$dept_id)->get()->toArray();



    $objPHPExcel->createSheet();

    /* Add some data to the 2nd sheet, resembling some different data types*/
    $objPHPExcel->setActiveSheetIndex(1);


        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Question');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Answer');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Remarks');
        $i = 2;
        if(!empty($chkgte)) {
            $fstval = json_decode($chkgte[0]['chkgteval']);
        foreach ($checkgateonefollow as $comm) {
            //dd($row1);
            $chk = array_search($comm->inspection_criteria, $fstval->question);

            $question = $fstval->question[$chk];
            $chkanswer = $fstval->chkanswer[$chk];
            $remark = $fstval->remark[$chk];


            $objPHPExcel->getActiveSheet()->setCellValue("A$i", $question);
            $objPHPExcel->getActiveSheet()->setCellValue("B$i", $chkanswer);
            $objPHPExcel->getActiveSheet()->setCellValue("C$i", $remark);
            $i++;
        }
    }
    /* Rename 2nd sheet*/
    $objPHPExcel->getActiveSheet()->setTitle('Check Gate 1 Followed');


        /* Create a 3 worksheet, after the default sheet*/

        $commerlogis=MasterCommercialValues::select('*')->where('service_request_id','=',$service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        /* Add some data to the second sheet, resembling some different data types*/
        $objPHPExcel->setActiveSheetIndex(2);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Question');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Answer');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Remarks');
        $i=2;


        $commercial=UserHelper::commertciallogistic();
        if(!empty($commerlogis)) {
            $fstval1 = json_decode($commerlogis[0]['values']);
            foreach ($commercial as $comm) {
                //dd($row1);
                $chk = array_search($comm->documents_receipt_status, $fstval1->question);

                $question = $fstval1->question[$chk];
                $chkanswer = $fstval1->answer[$chk];
                $remark = $fstval1->remark[$chk];


                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $question);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $chkanswer);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $remark);
                $i++;
            }
        }
//exit;
        /* Rename 3nd sheet*/
        $objPHPExcel->getActiveSheet()->setTitle('Commercial & Logistic');

        /* Create a 4 sheet, representing sales data*/

        $loosepart = MasterLoosepartDis::select('*')->where('gw_master_disa_loose_part.service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(3);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Part No');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Part Condition');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'QTY');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Condition');

        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        foreach ($loosepart as $key=> $loose){
            //dd($row);
            //while($row = array($aggregate)) {
            //dd($row[0][0]['machine_modelno']);
            $looprt=$loose['part_no'];
            $loodes=$loose['part_description'];
            $looqty=$loose['qty'];
            $loocond=$loose['part_condition'];
            //$looactualdt=$loose['actual_start_date'];
            $objPHPExcel->getActiveSheet()->setCellValue("A$i",$looprt);
            $objPHPExcel->getActiveSheet()->setCellValue("B$i",$loodes);
            $objPHPExcel->getActiveSheet()->setCellValue("C$i",$looqty);
            $objPHPExcel->getActiveSheet()->setCellValue("D$i",$loocond);

           // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


            $i++;

        }

        /*Rename sheet 4th*/
        $objPHPExcel->getActiveSheet()->setTitle('Loose Part');

        /* Create a 5 sheet, representing sales data*/

        $ccinsextw = MasterCcinspectionExternalWashDetails::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(4);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Question');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Answer');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Remarks');
        //$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Condition');

        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;

        $ccwash=UserHelper::ccinspexternalwash();
        if(!empty($ccinsextw)) {
            $fstval2 = json_decode($ccinsextw[0]['values']);
            foreach ($ccwash as $key => $washcc) {

                $chk = array_search($washcc->check_points, $fstval2->checkquestion);

                $question1 = $fstval2->checkquestion[$chk];
                $chkanswer2 = $fstval2->checkanswer[$chk];
                $remark3 = $fstval2->remarks[$chk];


                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $question1);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $chkanswer2);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $remark3);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;

            }
        }
        /*Rename sheet 5th*/
        $objPHPExcel->getActiveSheet()->setTitle('CC After External wash');

        /* Create a 6 sheet, representing sales data*/

        $ccpart = MasterCcinspectionPartCleanDetails::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(5);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Question');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Answer');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Remarks');
        //$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Condition');

        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;

        $ccwash=UserHelper::ccpartclean();
        if(!empty($ccpart)) {
            $fstval3 = json_decode($ccpart[0]['values']);
            foreach ($ccwash as $key => $partcc) {

                $chk = array_search($partcc->check_points, $fstval3->partquestion);

                $question2 = $fstval3->partquestion[$chk];
                $chkanswer2 = $fstval3->partanswer[$chk];
                $remark2 = $fstval3->partremarks[$chk];


                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $question2);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $chkanswer2);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $remark2);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;

            }
        }
        /*Rename sheet 6th*/
        $objPHPExcel->getActiveSheet()->setTitle('CC After Part Clean');


        $objPHPExcel->createSheet();

        /* Create a 7 sheet, representing sales data*/
        $disclean   = MasterDissamblyCleaningInspection::select('*')->where('service_request_id','=',$service->id)->where('dept_id','=',$dept_id)->get()->toArray();
        $objPHPExcel->setActiveSheetIndex(6);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Component Disassembly Start Date');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Component Disassembly End Date');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Component Cleaning Start Date');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Component Cleaning End Date');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Component Inspection & assessment Start Date');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Component Inspection & assessment End Date');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Component Offer Send Date');
        //$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Actual Start Date');
        $i=2;
        foreach ($disclean as $key=> $discl){

            $comdi=$discl['comp_dissambly_start_date'];
            $dismacsmu=$discl['comp_dissambly_end_date'];
            $discompsmu=$discl['comp_cleaning_start_date'];
            $disiso=$discl['comp_cleaning_end_date'];
            $disdatearrivl=$discl['comp_inspection_assessment_start_date'];
            $disdatedispact=$discl['comp_inspection_assessment_end_date'];
            $disacmoff=$discl['comp_offer_send_date'];
            //$disactualdt=$discl['actual_start_date'];

            $objPHPExcel->getActiveSheet()->setCellValue("A$i",$comdi);
            $objPHPExcel->getActiveSheet()->setCellValue("B$i",$dismacsmu);
            $objPHPExcel->getActiveSheet()->setCellValue("C$i",$discompsmu);
            $objPHPExcel->getActiveSheet()->setCellValue("D$i",$disiso);
            $objPHPExcel->getActiveSheet()->setCellValue("E$i",$disdatearrivl);
            $objPHPExcel->getActiveSheet()->setCellValue("F$i",$disdatedispact);
            $objPHPExcel->getActiveSheet()->setCellValue("G$i",$disacmoff);
            //$objPHPExcel->getActiveSheet()->setCellValue("H$i",$disactualdt);


            $i++;

        }

        /*Rename sheet 7th*/
        $objPHPExcel->getActiveSheet()->setTitle('Disassembly Cleaning');

        $objPHPExcel->createSheet();

        /* Create a 8 sheet, representing sales data*/
        $missing   = MasterMissingdamagePartDis::select('*')->where('service_request_id','=',$service->id)->where('dept_id','=',$dept_id)->get()->toArray();
        $objPHPExcel->setActiveSheetIndex(7);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Part NO');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Part Description');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'QTY');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Missing/damaged');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Photo taken?');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Damage details');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Action taken');
        //$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Actual Start Date');
        $i=2;
        foreach ($missing as $key=> $misdam){
//dd($misdam['description']);
            $misprt=$misdam['part_no'];
            $mismacsmu = $misdam['description'];
            $miscompsmu=$misdam['qty'];
            $misiso=$misdam['missing_damage'];
            $misdatearrivl=$misdam['photo'];
            $misdatedispact=$misdam['damage_details'];
            $misacmoff=$misdam['action_taken'];
            //$disactualdt=$discl['actual_start_date'];

            $objPHPExcel->getActiveSheet()->setCellValue("A$i",$misprt);
            $objPHPExcel->getActiveSheet()->setCellValue("B$i",$mismacsmu);
            $objPHPExcel->getActiveSheet()->setCellValue("C$i",$miscompsmu);
            $objPHPExcel->getActiveSheet()->setCellValue("D$i",$misiso);
            $objPHPExcel->getActiveSheet()->setCellValue("E$i",$misdatearrivl);
            $objPHPExcel->getActiveSheet()->setCellValue("F$i",$misdatedispact);
            $objPHPExcel->getActiveSheet()->setCellValue("G$i",$misacmoff);
            //$objPHPExcel->getActiveSheet()->setCellValue("H$i",$disactualdt);


            $i++;

        }

        /*Rename sheet 8th*/
        $objPHPExcel->getActiveSheet()->setTitle('Missing Damage');


        /* Create a 9 sheet, representing sales data*/

        $cylimain = MasterPartCylinderHeadValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(8);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Front Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Front 1');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Front 2');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Front 3');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Front 4');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Front 5');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Front 6');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Front 7');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Front Remarks');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Front Center');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Front Result');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Fort Final Remarks');

        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Rear Option');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Rear 1');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Rear 2');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Rear 3');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Rear 4');
        $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Rear 5');
        $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Rear 6');
        $objPHPExcel->getActiveSheet()->setCellValue('T1', 'Rear 7');
        $objPHPExcel->getActiveSheet()->setCellValue('U1', 'Rear Remarks');
        $objPHPExcel->getActiveSheet()->setCellValue('V1', 'Rear Center');
        $objPHPExcel->getActiveSheet()->setCellValue('W1', 'Rear Result');
        $objPHPExcel->getActiveSheet()->setCellValue('X1', 'Rear Final Remarks');

        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;

        $cymainbear=UserHelper::partcylinderhead();
        if(!empty($cylimain)) {
            $mainbearing = json_decode($cylimain[0]['values']);
            //dd($mainbearing);
            foreach ($cymainbear as $key => $mainbr) {

                $chk = array_search($mainbr->front, $mainbearing->checkquestion);

                //front
                $frontradio = $mainbearing->radiomainbr[$chk];
                $front1 = $mainbearing->frontA1[$chk];
                $front2 = $mainbearing->frontA2[$chk];
                $front3 = $mainbearing->frontA3[$chk];
                $front4 = $mainbearing->frontA4[$chk];
                $front5 = $mainbearing->frontA5[$chk];
                $front6 = $mainbearing->frontA6[$chk];
                $front7 = $mainbearing->frontA7[$chk];
                $front8 = $mainbearing->frontAremarks[$chk];
				$frntcent='';
                if(isset($mainbearing->frontcenter)) {
                    $frntcent = json_decode(json_encode($mainbearing->frontcenter), true);
					$front9 = $frntcent[3];
                }else{
					$front9 = "";
				}
                
                if(isset($mainbearing->frontresult)) {
                    $frntreslt = json_decode(json_encode($mainbearing->frontresult), true);
					$front10 = $frntreslt[3];
                }else{
					$front10 = "";
				}
                
                if(isset($mainbearing->mainfrontremarks)) {
                    $frntfinal = json_decode(json_encode($mainbearing->mainfrontremarks), true);
					$front11 = $frntfinal[3];
                }else{
					$front11 = "";
				}
                
                //rear

                $rearradio = $mainbearing->radiomainrear[$chk];
                $rear1 = $mainbearing->rearA1[$chk];
                $rear2 = $mainbearing->rearA2[$chk];
                $rear3 = $mainbearing->rearA3[$chk];
                $rear4 = $mainbearing->rearA4[$chk];
                $rear5 = $mainbearing->rearA5[$chk];
                $rear6 = $mainbearing->rearA6[$chk];
                $rear7 = $mainbearing->rearA7[$chk];
                $rear8 = $mainbearing->rearAremarks[$chk];
                if(isset($mainbearing->centerresult)) {
                    $rearcent = json_decode(json_encode($mainbearing->centerresult), true);
					$rear9 = $rearcent[3];
                }
				else{
					$rear9 = "";
				}
                
                if(isset($mainbearing->rearresults)) {
                    $rearreslt = json_decode(json_encode($mainbearing->rearresults), true);
					$rear10 = $rearreslt[3];
                }else{
					$rear10 = "";
				}
                
                if(isset($mainbearing->mainrearremarks)) {
                    $rearfinal = json_decode(json_encode($mainbearing->mainrearremarks), true);
					$rear11 = $rearfinal[3];
                }else{
					$rear11 = "";
				}
                

                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front9);
                $objPHPExcel->getActiveSheet()->setCellValue("K$i", $front10);
                $objPHPExcel->getActiveSheet()->setCellValue("L$i", $front11);
                $objPHPExcel->getActiveSheet()->setCellValue("M$i", $rearradio);
                $objPHPExcel->getActiveSheet()->setCellValue("N$i", $rear1);
                $objPHPExcel->getActiveSheet()->setCellValue("O$i", $rear2);
                $objPHPExcel->getActiveSheet()->setCellValue("P$i", $rear3);
                $objPHPExcel->getActiveSheet()->setCellValue("Q$i", $rear4);
                $objPHPExcel->getActiveSheet()->setCellValue("R$i", $rear5);
                $objPHPExcel->getActiveSheet()->setCellValue("S$i", $rear6);
                $objPHPExcel->getActiveSheet()->setCellValue("T$i", $rear7);
                $objPHPExcel->getActiveSheet()->setCellValue("U$i", $rear8);
                $objPHPExcel->getActiveSheet()->setCellValue("V$i", $rear9);
                $objPHPExcel->getActiveSheet()->setCellValue("W$i", $rear10);
                $objPHPExcel->getActiveSheet()->setCellValue("X$i", $rear11);
                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;

            }
        }
        /*Rename sheet 9th*/
        $objPHPExcel->getActiveSheet()->setTitle('Parts CylinderBlock Mainbearing');


        /* Create a 10 sheet, representing sales data*/

        $cyliear = PartCylinderBlockLinearValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(9);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Front Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Front 1');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Front 2');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Front 3');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Front 4');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Front 5');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Front 6');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Front 7');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Front Remarks');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Front Center');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Front Result');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Fort Final Remarks');

        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Rear Option');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Rear 1');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Rear 2');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Rear 3');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Rear 4');
        $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Rear 5');
        $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Rear 6');
        $objPHPExcel->getActiveSheet()->setCellValue('T1', 'Rear 7');
        $objPHPExcel->getActiveSheet()->setCellValue('U1', 'Rear Remarks');
        $objPHPExcel->getActiveSheet()->setCellValue('V1', 'Rear Center');
        $objPHPExcel->getActiveSheet()->setCellValue('W1', 'Rear Result');
        $objPHPExcel->getActiveSheet()->setCellValue('X1', 'Rear Final Remarks');

        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;

        $cylinearbr=UserHelper::partcylinderhead();
        if(!empty($cyliear)) {
            $linearbr = json_decode($cyliear[0]['values']);
            //dd($mainbearing);
            foreach ($cylinearbr as $key => $cyliearb) {

                $chk = array_search($cyliearb->front, $linearbr->checkquestion);

                //front
                $frontradio = $linearbr->radiolinerbr[$chk];
                $front1 = $linearbr->frontA1[$chk];
                $front2 = $linearbr->frontA2[$chk];
                $front3 = $linearbr->frontA3[$chk];
                $front4 = $linearbr->frontA4[$chk];
                $front5 = $linearbr->frontA5[$chk];
                $front6 = $linearbr->frontA6[$chk];
                $front7 = $linearbr->frontA7[$chk];
                $front8 = $linearbr->frontAremarks[$chk];
                if(isset($linearbr->linearfrontcenter)) {
                    $frntcent = json_decode(json_encode($linearbr->linearfrontcenter), true);
					 $front9 = $frntcent[3];
                }else{
					$front9 = "";
				}
               
                if(isset($linearbr->linfrontresult)) {
                    $frntreslt = json_decode(json_encode($linearbr->linfrontresult), true);
					 $front10 = $frntreslt[3];
                }else{
					$front10 = "";
				}
               
                if(isset($linearbr->mainfrontremarks)) {
                    $frntfinal = json_decode(json_encode($linearbr->mainfrontremarks), true);
					 $front11 = $frntfinal[3];
                }else{
					$front11 = "";
				}
               
                //rear

                $rearradio = $linearbr->radiolinerrear[$chk];
                $rear1 = $linearbr->rearA1[$chk];
                $rear2 = $linearbr->rearA2[$chk];
                $rear3 = $linearbr->rearA3[$chk];
                $rear4 = $linearbr->rearA4[$chk];
                $rear5 = $linearbr->rearA5[$chk];
                $rear6 = $linearbr->rearA6[$chk];
                $rear7 = $linearbr->rearA7[$chk];
                $rear8 = $linearbr->rearAremarks[$chk];
                if(isset($linearbr->lincenterresult)) {
                    $rearcent = json_decode(json_encode($linearbr->lincenterresult), true);
					 $rear9 = $rearcent[3];
                }else{
					$rear9 = "";
				}
               
                if(isset($linearbr->linrearresults)) {
                    $rearreslt = json_decode(json_encode($linearbr->linrearresults), true);
					$rear10 = $rearreslt[3];
                }else{
					$rear10 = "";
				}
                
                if(isset($linearbr->mainrearremarks)) {
                    $rearfinal = json_decode(json_encode($linearbr->mainrearremarks), true);
					$rear11 = $rearfinal[3];
                }else{
					$rear11 = "";
				}
                

                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front9);
                $objPHPExcel->getActiveSheet()->setCellValue("K$i", $front10);
                $objPHPExcel->getActiveSheet()->setCellValue("L$i", $front11);
                $objPHPExcel->getActiveSheet()->setCellValue("M$i", $rearradio);
                $objPHPExcel->getActiveSheet()->setCellValue("N$i", $rear1);
                $objPHPExcel->getActiveSheet()->setCellValue("O$i", $rear2);
                $objPHPExcel->getActiveSheet()->setCellValue("P$i", $rear3);
                $objPHPExcel->getActiveSheet()->setCellValue("Q$i", $rear4);
                $objPHPExcel->getActiveSheet()->setCellValue("R$i", $rear5);
                $objPHPExcel->getActiveSheet()->setCellValue("S$i", $rear6);
                $objPHPExcel->getActiveSheet()->setCellValue("T$i", $rear7);
                $objPHPExcel->getActiveSheet()->setCellValue("U$i", $rear8);
                $objPHPExcel->getActiveSheet()->setCellValue("V$i", $rear9);
                $objPHPExcel->getActiveSheet()->setCellValue("W$i", $rear10);
                $objPHPExcel->getActiveSheet()->setCellValue("X$i", $rear11);
                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;

            }
        }
        /*Rename sheet 10th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartCylinderBlockLinearbearing');

        /* Create a 11 sheet, representing sales data*/

        $cycam = PartCylinderBlockCamboreValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(10);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Front Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Front 1');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Front 2');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Front 3');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Front 4');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Front 5');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Front 6');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Front 7');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Front Remarks');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Front Center');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Front Result');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Fort Final Remarks');

        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Rear Option');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Rear 1');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Rear 2');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Rear 3');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Rear 4');
        $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Rear 5');
        $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Rear 6');
        $objPHPExcel->getActiveSheet()->setCellValue('T1', 'Rear 7');
        $objPHPExcel->getActiveSheet()->setCellValue('U1', 'Rear Remarks');
        $objPHPExcel->getActiveSheet()->setCellValue('V1', 'Rear Center');
        $objPHPExcel->getActiveSheet()->setCellValue('W1', 'Rear Result');
        $objPHPExcel->getActiveSheet()->setCellValue('X1', 'Rear Final Remarks');

        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;

        $cycambore=UserHelper::partcylinderhead();
        if(!empty($cycam)) {
            $camborebr = json_decode($cycam[0]['values']);
            //dd($mainbearing);
            foreach ($cycambore as $key => $cycamb) {

                $chk = array_search($cycamb->front, $camborebr->checkquestion);

                //front
                $frontradio = $camborebr->radiocamfr[$chk];
                $front1 = $camborebr->frontA1[$chk];
                $front2 = $camborebr->frontA2[$chk];
                $front3 = $camborebr->frontA3[$chk];
                $front4 = $camborebr->frontA4[$chk];
                $front5 = $camborebr->frontA5[$chk];
                $front6 = $camborebr->frontA6[$chk];
                $front7 = $camborebr->frontA7[$chk];
                $front8 = $camborebr->frontAremarks[$chk];
                if(isset($camborebr->camfrontcenter)) {
                    $frntcent = json_decode(json_encode($camborebr->camfrontcenter), true);
					$front9 = $frntcent[3];
                }else{
					$front9 = "";
				}
                
                if(isset($camborebr->camfrontresult)) {
                    $frntreslt = json_decode(json_encode($camborebr->camfrontresult), true);
					 $front10 = $frntreslt[3];
                }else{
					$front10 = "";
				}
               
                if(isset($camborebr->mainfrontremarks)) {
                    $frntfinal = json_decode(json_encode($camborebr->mainfrontremarks), true);
					$front11 = $frntfinal[3];
                }else{
					$front11 = "";
				}
                
                //rear

                $rearradio = $camborebr->radiocamre[$chk];
                $rear1 = $camborebr->rearA1[$chk];
                $rear2 = $camborebr->rearA2[$chk];
                $rear3 = $camborebr->rearA3[$chk];
                $rear4 = $camborebr->rearA4[$chk];
                $rear5 = $camborebr->rearA5[$chk];
                $rear6 = $camborebr->rearA6[$chk];
                $rear7 = $camborebr->rearA7[$chk];
                $rear8 = $camborebr->rearAremarks[$chk];
                if(isset($camborebr->lincenterresult)) {
                    $rearcent = json_decode(json_encode($camborebr->lincenterresult), true);
					$rear9 = $rearcent[3];
                }else{
					$rear9 = "";
				}
                
                if(isset($camborebr->camrearresults)) {
                    $rearreslt = json_decode(json_encode($camborebr->camrearresults), true);
					$rear10 = $rearreslt[3];
                }else{
					$rear10 = "";
				}
                
                if(isset($camborebr->mainrearremarks)) {
                    $rearfinal = json_decode(json_encode($camborebr->mainrearremarks), true);
					$rear11 = $rearfinal[3];
                }else{
					$rear11 = "";
				}
                

                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front9);
                $objPHPExcel->getActiveSheet()->setCellValue("K$i", $front10);
                $objPHPExcel->getActiveSheet()->setCellValue("L$i", $front11);
                $objPHPExcel->getActiveSheet()->setCellValue("M$i", $rearradio);
                $objPHPExcel->getActiveSheet()->setCellValue("N$i", $rear1);
                $objPHPExcel->getActiveSheet()->setCellValue("O$i", $rear2);
                $objPHPExcel->getActiveSheet()->setCellValue("P$i", $rear3);
                $objPHPExcel->getActiveSheet()->setCellValue("Q$i", $rear4);
                $objPHPExcel->getActiveSheet()->setCellValue("R$i", $rear5);
                $objPHPExcel->getActiveSheet()->setCellValue("S$i", $rear6);
                $objPHPExcel->getActiveSheet()->setCellValue("T$i", $rear7);
                $objPHPExcel->getActiveSheet()->setCellValue("U$i", $rear8);
                $objPHPExcel->getActiveSheet()->setCellValue("V$i", $rear9);
                $objPHPExcel->getActiveSheet()->setCellValue("W$i", $rear10);
                $objPHPExcel->getActiveSheet()->setCellValue("X$i", $rear11);
                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;

            }
        }
        /*Rename sheet 11th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartCylinderBlockCamBore');


        /* Create a 12 sheet, representing sales data*/

        $cytopdk = PartCylinderBlockTopDeckValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(11);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Parameter');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Value');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Remarks');


        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
         $top=0;
        $cytop=UserHelper::partcylinderTop();
        if(!empty($cytopdk)) {
            $decktop = json_decode($cytopdk[0]['values']);
            //dd($mainbearing);
            foreach ($cytop as $key => $cytopdeck) {

                $chk = array_search($cytopdeck->parameter, $decktop->parameter);

                //front
                $frontradio = $decktop->radiotopdk[$top];
                $front1 = $decktop->parameter[$top];
                $front2 = $decktop->results[$top];
                $front3 = $decktop->cylinderremarks[$top];


                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $top++;

            }
        }
        /*Rename sheet 12th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartCylinderBlockTopDeck');

        /* Create a 13 sheet, representing sales data*/

        $cythread = PartCylinderBlockThreadValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(12);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Parameter');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'OK');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Damage');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Remarks');


        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $thr=0;
        $cylinderthrd=UserHelper::partcylinderThread();
        if(!empty($cythread)) {
            $thrdcylin = json_decode($cythread[0]['values']);
            //dd($mainbearing);
            foreach ($cylinderthrd as $key => $thredcy) {

                $chk = array_search($thredcy->parameter, $thrdcylin->parameter);

                //front
                $frontradio = $thrdcylin->parameter[$thr];
                $front1 = $thrdcylin->ok[$thr];
                $front2 = $thrdcylin->dam[$thr];
                $front3 = $thrdcylin->cylinderremarks[$thr];


                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $thr++;

            }
        }
        /*Rename sheet 13th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartCylinderBlockThread');



        /* Create a 14 sheet, representing sales data*/

        $cybush = PartCylinderBlockBushboreValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(13);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Front Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Front 1');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Front 2');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Front 3');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Front 4');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Front 5');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Front 6');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Front 7');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Front Remarks');


        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Rear Option');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Rear 1');
        $objPHPExcel->getActiveSheet()->setCellValue('l1', 'Rear 2');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Rear 3');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Rear 4');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Rear 5');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Rear 6');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Rear 7');
        $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Rear Remarks');


        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $bush=0;

        $cybushbore=UserHelper::partcylinderhead();
        if(!empty($cybush)) {
            $bushborebr = json_decode($cybush[0]['values']);
            //dd($mainbearing);
            foreach ($cybushbore as $key => $cybushbre) {

                $chk = array_search($cybushbre->front, $bushborebr->checkquestion);

                //front
                $frontradio = $bushborebr->radiobush[$bush];
                $front1 = $bushborebr->frontA1[$bush];
                $front2 = $bushborebr->frontA2[$bush];
                $front3 = $bushborebr->frontA3[$bush];
                $front4 = $bushborebr->frontA4[$bush];
                $front5 = $bushborebr->frontA5[$bush];
                $front6 = $bushborebr->frontA6[$bush];
                $front7 = $bushborebr->frontA7[$bush];
                $front8 = $bushborebr->frontAremarks[$bush];

                //rear

                $rearradio = $bushborebr->radiobushrear[$bush];
                $rear1 = $bushborebr->rearA1[$bush];
                $rear2 = $bushborebr->rearA2[$bush];
                $rear3 = $bushborebr->rearA3[$bush];
                $rear4 = $bushborebr->rearA4[$bush];
                $rear5 = $bushborebr->rearA5[$bush];
                $rear6 = $bushborebr->rearA6[$bush];
                $rear7 = $bushborebr->rearA7[$bush];
                $rear8 = $bushborebr->rearAremarks[$bush];


                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $rearradio);
                $objPHPExcel->getActiveSheet()->setCellValue("K$i", $rear1);
                $objPHPExcel->getActiveSheet()->setCellValue("L$i", $rear2);
                $objPHPExcel->getActiveSheet()->setCellValue("M$i", $rear3);
                $objPHPExcel->getActiveSheet()->setCellValue("N$i", $rear4);
                $objPHPExcel->getActiveSheet()->setCellValue("O$i", $rear5);
                $objPHPExcel->getActiveSheet()->setCellValue("P$i", $rear6);
                $objPHPExcel->getActiveSheet()->setCellValue("Q$i", $rear7);
                $objPHPExcel->getActiveSheet()->setCellValue("R$i", $rear8);

                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $bush++;

            }
        }
        /*Rename sheet 14th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartCylinderBlockBushBore');

        /* Create a 15 sheet, representing sales data*/

        $cycapwid = PartCylinderBlockCapNoValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(14);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Parameter');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Val 1');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Val 2');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Val 3');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Val 4');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Val 5');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Val 6');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Val 7');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Remarks');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $cap=0;

        $cycapno=UserHelper::partcylinderCapClear();
        if(!empty($cycapwid)) {
            $cycapwidth = json_decode($cycapwid[0]['values']);
            //dd($mainbearing);
            foreach ($cycapno as $key => $cycapwno) {

                $chk = array_search($cycapwno->parameter, $cycapwidth->parameter);

                //front
                $frontradio = $cycapwidth->radiocapfr[$cap];
                $front1 = $cycapwidth->parameter[$cap];
                $front2 = $cycapwidth->val1[$cap];
                $front3 = $cycapwidth->val2[$cap];
                $front4 = $cycapwidth->val3[$cap];
                $front5 = $cycapwidth->val4[$cap];
                $front6 = $cycapwidth->val5[$cap];
                $front7 = $cycapwidth->val6[$cap];
                $front8 = $cycapwidth->val7[$cap];
                $front9 = $cycapwidth->cylinderremarks[$cap];




                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front9);


                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $cap++;

            }
        }
        /*Rename sheet 15th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartCylinderBlockCapWidth');


        /* Create a 16 sheet, representing sales data*/

        $crank = MasterPartCrankshaftValue::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(15);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Parameter');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Main 1');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Main 2');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Main 3');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Main 4');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Main 5');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Main 6');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Main 7');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Main Remarks');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Option');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Parameter');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Con 1');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Con 2');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Con 3');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Con 4');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Con 5');
        $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Con 6');
        $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Con 7');
        $objPHPExcel->getActiveSheet()->setCellValue('T1', 'Con Remarks');
        $objPHPExcel->getActiveSheet()->setCellValue('U1', 'Remarks');




        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $crnk=0;

        $prtcrnk=UserHelper::partcrankshaft();
        if(!empty($crank)) {
            $crankshf = json_decode($crank[0]['values']);
            //dd($mainbearing);
            foreach ($prtcrnk as $key => $prtcrk) {

                $chk = array_search($prtcrk->main_journal, $crankshf->mainjornal);

                //front
                $frontradio = $crankshf->radiocrankfr[$crnk];
                $front1 = $crankshf->mainjornal[$crnk];
                $front2 = $crankshf->mainvalue1[$crnk];
                $front3 = $crankshf->mainvalue2[$crnk];
                $front4 = $crankshf->mainvalue3[$crnk];
                $front5 = $crankshf->mainvalue4[$crnk];
                $front6 = $crankshf->mainvalue5[$crnk];
                $front7 = $crankshf->mainvalue6[$crnk];
                $front8 = $crankshf->mainvalue7[$crnk];
                $front9 = $crankshf->mainremarks[$crnk];
                $front10 = $crankshf->radiocrankre[$crnk];
                $front11 = $crankshf->conjornal[$crnk];
                $front12 = $crankshf->convalue1[$crnk];
                $front13 = $crankshf->convalue2[$crnk];
                $front14 = $crankshf->convalue3[$crnk];
                $front15 = $crankshf->convalue4[$crnk];
                $front16 = $crankshf->convalue5[$crnk];
                $front17 = $crankshf->convalue6[$crnk];
                $front18 = $crankshf->convalue7[$crnk];
                $front19 = $crankshf->conremarks[$crnk];
                $front20 = $crankshf->othervalue[0];



                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front9);
                $objPHPExcel->getActiveSheet()->setCellValue("K$i", $front10);
                $objPHPExcel->getActiveSheet()->setCellValue("L$i", $front11);
                $objPHPExcel->getActiveSheet()->setCellValue("M$i", $front12);
                $objPHPExcel->getActiveSheet()->setCellValue("N$i", $front13);
                $objPHPExcel->getActiveSheet()->setCellValue("O$i", $front14);
                $objPHPExcel->getActiveSheet()->setCellValue("P$i", $front15);
                $objPHPExcel->getActiveSheet()->setCellValue("Q$i", $front16);
                $objPHPExcel->getActiveSheet()->setCellValue("R$i", $front17);
                $objPHPExcel->getActiveSheet()->setCellValue("S$i", $front18);
                $objPHPExcel->getActiveSheet()->setCellValue("T$i", $front19);
                $objPHPExcel->getActiveSheet()->setCellValue("U$i", $front20);


                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $crnk++;

            }
        }
        /*Rename sheet 16th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartCrankshaft');

        /* Create a 17 sheet, representing sales data*/

        $camsft = MasterPartCamshaftValue::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(16);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Parameter');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Val 1');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Val 2');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Val 3');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Val 4');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Val 5');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Val 6');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Val 7');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Remarks');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $cam=0;

        $cmsft=UserHelper::partcamshaftdetails();
        if(!empty($camsft)) {
            $camshaftmea = json_decode($camsft[0]['values']);
            //dd($mainbearing);
            foreach ($cmsft as $key => $campsft) {

                $chk = array_search($campsft->parameter, $camshaftmea->camshaft);

                //front
                $frontradio = $camshaftmea->radiocams[$cam];
                $front1 = $camshaftmea->camshaft[$cam];
                $front2 = $camshaftmea->cam1[$cam];
                $front3 = $camshaftmea->cam2[$cam];
                $front4 = $camshaftmea->cam3[$cam];
                $front5 = $camshaftmea->cam4[$cam];
                $front6 = $camshaftmea->cam5[$cam];
                $front7 = $camshaftmea->cam6[$cam];
                $front8 = $camshaftmea->cam7[$cam];
                $front9 = $camshaftmea->camremarks[$cam];




                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front9);


                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $cam++;

            }
        }
        /*Rename sheet 17th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartCamshaft');

        /* Create a 18 sheet, representing sales data*/

        $camsftlh = PartLhCamshaftValue::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(17);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Parameter');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Val 1');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Val 2');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Val 3');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Val 4');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Val 5');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Val 6');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Val 7');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Remarks');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $camlh=0;

        $cmsftlh=UserHelper::partcamshaftdetails();
        if(!empty($camsftlh)) {
            $camshaftmealh = json_decode($camsftlh[0]['values']);
            //dd($mainbearing);
            foreach ($cmsftlh as $key => $campsftlh) {

                $chk = array_search($campsftlh->parameter, $camshaftmealh->camshaft);

                //front
                $frontradio = $camshaftmealh->radiocamlh[$camlh];
                $front1 = $camshaftmealh->camshaft[$camlh];
                $front2 = $camshaftmealh->cam1[$camlh];
                $front3 = $camshaftmealh->cam2[$camlh];
                $front4 = $camshaftmealh->cam3[$camlh];
                $front5 = $camshaftmealh->cam4[$camlh];
                $front6 = $camshaftmealh->cam5[$camlh];
                $front7 = $camshaftmealh->cam6[$camlh];
                $front8 = $camshaftmealh->cam7[$camlh];
                $front9 = $camshaftmealh->camremarks[$camlh];




                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front9);


                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $camlh++;

            }
        }
        /*Rename sheet 18th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartLHCamshaft');

        /* Create a 19 sheet, representing sales data*/

        $camsftrh = PartRhCamshaftValue::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(18);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Parameter');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Val 1');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Val 2');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Val 3');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Val 4');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Val 5');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Val 6');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Val 7');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Remarks');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $camrh=0;

        $cmsftrh=UserHelper::partcamshaftdetails();
        if(!empty($camsftrh)) {
            $camshaftmearh = json_decode($camsftrh[0]['values']);
            //dd($mainbearing);
            foreach ($cmsftrh as $key => $campsftrh) {

                $chk = array_search($campsftrh->parameter, $camshaftmearh->camshaft);

                //front
                $frontradio = $camshaftmearh->radiocamrh[$camrh];
                $front1 = $camshaftmearh->camshaft[$camrh];
                $front2 = $camshaftmearh->cam1[$camrh];
                $front3 = $camshaftmearh->cam2[$camrh];
                $front4 = $camshaftmearh->cam3[$camrh];
                $front5 = $camshaftmearh->cam4[$camrh];
                $front6 = $camshaftmearh->cam5[$camrh];
                $front7 = $camshaftmearh->cam6[$camrh];
                $front8 = $camshaftmearh->cam7[$camrh];
                $front9 = $camshaftmearh->camremarks[$camrh];




                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front9);


                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $camrh++;

            }
        }
        /*Rename sheet 19th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartRHCamshaft');

        /* Create a 20 sheet, representing sales data*/

        $camsftbush = PartCamshaftBushboreValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(19);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Parameter');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Val 1');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Val 2');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Val 3');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Val 4');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Val 5');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Val 6');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Val 7');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Remarks');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $cambush=0;

        $cmsftbush=UserHelper::partcamshaftbushbore();
        if(!empty($camsftbush)) {
            $camshaftmeabush = json_decode($camsftbush[0]['values']);
            //dd($mainbearing);
            foreach ($cmsftbush as $key => $campsftbush) {

                $chk = array_search($campsftbush->parameter, $camshaftmeabush->camshaft);

                //front
                $frontradio = $camshaftmeabush->radiocambush[$cambush];
                $front1 = $camshaftmeabush->camshaft[$cambush];
                $front2 = $camshaftmeabush->cam1[$cambush];
                $front3 = $camshaftmeabush->cam2[$cambush];
                $front4 = $camshaftmeabush->cam3[$cambush];
                $front5 = $camshaftmeabush->cam4[$cambush];
                $front6 = $camshaftmeabush->cam5[$cambush];
                $front7 = $camshaftmeabush->cam6[$cambush];
                $front8 = $camshaftmeabush->cam7[$cambush];
                $front9 = $camshaftmeabush->camremarks[$cambush];




                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front9);


                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $cambush++;

            }
        }
        /*Rename sheet 20th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartCamshaftCamBush');

        /* Create a 21 sheet, representing sales data*/

        $conrod = MasterPartConnectingRodValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(20);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Parameter');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Val 1');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Val 2');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Val 3');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Val 4');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Val 5');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Val 6');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Val 7');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Remarks');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $conr=0;

        $conrd=UserHelper::partconnectingrod();
        if(!empty($conrod)) {
            $conrodd = json_decode($conrod[0]['values']);
            //dd($mainbearing);
            foreach ($conrd as $key => $con) {

                $chk = array_search($con->parameter, $conrodd->connectparameter);

                //front
                $frontradio = $conrodd->radioconrod[$conr];
                $front1 = $conrodd->connectparameter[$conr];
                $front2 = $conrodd->view1[$conr];
                $front3 = $conrodd->view1[$conr];
                $front4 = $conrodd->view3[$conr];
                $front5 = $conrodd->view4[$conr];
                $front6 = $conrodd->view5[$conr];
                $front7 = $conrodd->view6[$conr];
                $front8 = $conrodd->view7[$conr];
                $front9 = $conrodd->viewremarks[$conr];




                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front9);


                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $conr++;

            }
        }
        /*Rename sheet 21th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartConnectingRod');

        /* Create a 22 sheet, representing sales data*/

        $cyhead = MasterPartsInspectionCylinderHeadValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(21);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Parameter');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Val 1');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Val 2');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Val 3');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Remarks');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $cyhd=0;

        $cylinhead=UserHelper::partinspectioncylinderhead();
        if(!empty($cyhead)) {
            $cylihed = json_decode($cyhead[0]['details']);
            //dd($mainbearing);
            foreach ($cylinhead as $key => $cylhd) {

                $chk = array_search($cylhd->description, $cylihed->parameter);

                //front
                $frontradio = $cylihed->radioheadoil[$cyhd];
                $front1 = $cylihed->parameter[$cyhd];
                $front2 = $cylihed->results1[$cyhd];
                $front3 = $cylihed->results2[$cyhd];
                $front4 = $cylihed->results3[$cyhd];
                $front5 = $cylihed->cylinderremarks[$cyhd];





                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);



                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $cyhd++;

            }
        }
        /*Rename sheet 22th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartCylinderHeadOil');


        /* Create a 23 sheet, representing sales data*/

        $othercom = MasterPartOthercomponentValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(22);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Part No');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'QTY');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Condition');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Reused/Rejected');
        //$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Reject');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $other=0;

        $partothercom=UserHelper::partothercompbasicengine($dept_id,$service->machine_modelno);
        //dd($partothercom);
        if(!empty($othercom)) {
            $prtother = json_decode($othercom[0]['values']);

            foreach ($partothercom as $key => $prtoth) {

                $chk = array_search($prtoth->basic_engine, $prtother->basicdescription);

                //front
                $frontradio = $prtother->basicdescription[$other];
                $front1 = $prtother->basicpart[$other];
                $front2 = $prtother->basicqty[$other];
                $front3 = $prtother->basiccondition[$other];
                $front4 = $prtother->basicreuse[$other];
                //$front5 = $prtother->cylinderremarks[$other];





                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                //$objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);



                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $other++;

            }
        }
        /*Rename sheet 23th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartOtherComponent');

        /* Create a 24 sheet, representing sales data*/

        $fandrv = MasterPartFanDriveValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(23);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Condition');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Reused/Rejected');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Remarks');

        //$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Reject');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $fan=0;

        $partfandrive=UserHelper::partsfandrive();
        //dd($partothercom);
        if(!empty($fandrv)) {
            $prtfan = json_decode($fandrv[0]['values']);

            foreach ($partfandrive as $key => $partfandri) {

                $chk = array_search($partfandri->component, $prtfan->fancomponent);

                //front
                $frontradio = $prtfan->fancomponent[$fan];
                $front1 = $prtfan->fancondition[$fan];
                $front2 = $prtfan->answer[$fan];
                $front3 = $prtfan->fanremarks[$fan];
                //$front4 = $prtother->basicreuse[$other];
                //$front5 = $prtother->cylinderremarks[$other];





                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                //$objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                //$objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);



                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $fan++;

            }
        }
        /*Rename sheet 24th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartFanDrive');

        /* Create a 25 sheet, representing sales data*/

        $oildrv = MasterPartOilPumpValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(24);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Condition');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Reused/Rejected');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Remarks');

        //$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Reject');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $oil=0;

        $partoildrive=UserHelper::partsoilpump();
        //dd($partothercom);
        if(!empty($oildrv)) {
            $prtoil = json_decode($oildrv[0]['values']);

            foreach ($partoildrive as $key => $partoildri) {

                $chk = array_search($partoildri->component, $prtoil->oilcomponent);

                //front
                $frontradio = $prtoil->oilcomponent[$oil];
                $front1 = $prtoil->oilcondition[$oil];
                $front2 = $prtoil->oilanswer[$oil];
                $front3 = $prtoil->oilremarks[$oil];
                //$front4 = $prtother->basicreuse[$other];
                //$front5 = $prtother->cylinderremarks[$other];





                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                //$objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                //$objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);



                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $oil++;

            }
        }
        /*Rename sheet 25th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartOilPump');


        /* Create a 26 sheet, representing sales data*/

        $airdrv = MasterPartAirCompressorValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(25);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Condition');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Reused/Rejected');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Remarks');

        //$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Reject');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $air=0;

        $partairdrive=UserHelper::partaircompressor();
        //dd($partothercom);
        if(!empty($airdrv)) {
            $prtair = json_decode($airdrv[0]['values']);

            foreach ($partairdrive as $key => $partairdri) {

                $chk = array_search($partairdri->component, $prtair->aircomponent);

                //front
                $frontradio = $prtair->aircomponent[$air];
                $front1 = $prtair->aircondition[$air];
                $front2 = $prtair->airanswer[$air];
                $front3 = $prtair->airremarks[$air];






                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                //$objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                //$objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);



                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $air++;

            }
        }
        /*Rename sheet 26th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartAirPump');

        /* Create a 27 sheet, representing sales data*/

        $waterdrv = MasterPartWaterPumpValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(26);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Condition');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Reused/Rejected');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Remarks');

        //$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Reject');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $water=0;

        $partwaterdrive=UserHelper::partwaterpump();
        //dd($partothercom);
        if(!empty($waterdrv)) {
            $prtwater = json_decode($waterdrv[0]['values']);

            foreach ($partwaterdrive as $key => $partwaterdri) {

                $chk = array_search($partwaterdri->component, $prtwater->watercomponent);

                //front
                $frontradio = $prtwater->watercomponent[$water];
                $front1 = $prtwater->watercondition[$water];
                $front2 = $prtwater->wateranswer[$water];
                $front3 = $prtwater->waterremarks[$water];






                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                //$objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                //$objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);



                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $water++;

            }
        }
        /*Rename sheet 27th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartWaterPump');

        /* Create a 28 sheet, representing sales data*/

        $coolerdrv = CoolerInspectionValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(27);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'PRESSURE TEST RESULT');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'ANY EXTERNAL DAMAGE');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'SEAL AREA');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'TEST TEMP');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'TEST PRESSURE');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'REMARKS');

        //$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Reject');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $cooler=0;

        $partcoolerdrive=UserHelper::coolerinsp();
        //dd($partothercom);
        if(!empty($coolerdrv)) {
            $prtcooler = json_decode($coolerdrv[0]['values']);

            foreach ($partcoolerdrive as $key => $partcoolerdri) {

                $chk = array_search($partcoolerdri->component, $prtcooler->parameter);

                //front
                $frontradio = $prtcooler->parameter[$cooler];
                $front1 = $prtcooler->pressure[$cooler];
                $front2 = $prtcooler->external[$cooler];
                $front3 = $prtcooler->sealarea[$cooler];
                $front4 = $prtcooler->testtemp[$cooler];
                $front5 = $prtcooler->testpressure[$cooler];
                $front6 = $prtcooler->coolerremarks[$cooler];






                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);



                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $cooler++;

            }
        }
        /*Rename sheet 28th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartCoolerInspection');

        /* Create a 29 sheet, representing sales data*/

        $clutchpck = ClutchPackThicknessValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(28);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Part No');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'QTY');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Section');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Measured Value');


        $i=2;

        if(!empty($clutchpck)) {


            foreach ($clutchpck as $key => $partclutchpck) {


                //dd($partclutchpck);

                //front
                $frontradio = $partclutchpck['part_no'];
                $front1 = $partclutchpck['description'];
                $front2 = $partclutchpck['qty'];
                $front3 = $partclutchpck['section'];
                $front4 = $partclutchpck['measured_val'];







                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);


                $i++;


            }
        }
        /*Rename sheet 29th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartClutchPackThickness');

        /* Create a 30 sheet, representing sales data*/

        $clutchplt = ClutchPlateThicknessValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(29);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Part No');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'QTY');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Section');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Measured Value');


        $i=2;

        if(!empty($clutchplt)) {


            foreach ($clutchplt as $key => $partclutchplt) {


                //dd($partclutchpck);

                //front
                $frontradio = $partclutchplt['part_no'];
                $front1 = $partclutchplt['description'];
                $front2 = $partclutchplt['qty'];
                $front3 = $partclutchplt['section'];
                $front4 = $partclutchplt['measured_val'];







                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);


                $i++;


            }
        }
        /*Rename sheet 30th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartClutchPlateThickness');

        /* Create a 31 sheet, representing sales data*/

        $clutchflt = ClutchPlateFlatnessValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(30);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Part No');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'QTY');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Section');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Measured Value');


        $i=2;

        if(!empty($clutchflt)) {


            foreach ($clutchflt as $key => $partclutchflt) {


                //dd($partclutchpck);

                //front
                $frontradio = $partclutchflt['part_no'];
                $front1 = $partclutchflt['description'];
                $front2 = $partclutchflt['qty'];
                $front3 = $partclutchflt['section'];
                $front4 = $partclutchflt['measured_val'];







                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);


                $i++;


            }
        }
        /*Rename sheet 31th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartClutchPlateFlatness');

        /* Create a 32 sheet, representing sales data*/

        $torque = TorqueConverterValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(31);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'CLEARANCE BETWEEN COMPONENTS');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'TURBINE INSIDE DIAMETER(mm)');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'STATOR OUTSIDE DIAMETER(mm)');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Measured Value');



        $i=2;

        if(!empty($torque)) {


            foreach ($torque as $key => $prttorque) {


                //dd($partclutchpck);

                //front
                $frontradio = $prttorque['clearance_component'];
                $front1 = $prttorque['turbine_diameter'];
                $front2 = $prttorque['stator_diameter'];
                $front3 = $prttorque['measured_val'];








                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);



                $i++;


            }
        }
        /*Rename sheet 32th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartTorqueConverterReport');

        /* Create a 33 sheet, representing sales data*/

        $rollmea = RoolerMeasuredValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(32);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'OPTION');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'DESCRIPTION');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'MEASURED');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'REMARKS');


        //$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Reject');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $roll=0;

        $partrollmea=UserHelper::RoolerMeasued();
        //dd($partothercom);
        if(!empty($rollmea)) {
            $prtrolm = json_decode($rollmea[0]['values']);

            foreach ($partrollmea as $key => $partrollmeasur) {

                $chk = array_search($partrollmeasur->description, $prtrolm->parameter);

                //front
                $frontradio = $prtrolm->radiorollermea[$roll];
                $front1 = $prtrolm->parameter[$roll];
                $front2 = $prtrolm->measured[$roll];
                $front3 = $prtrolm->roolmearemarks[$roll];







                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);




                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $roll++;

            }
        }
        /*Rename sheet 33th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartRollerMeasurement');

        /* Create a 34 sheet, representing sales data*/

        $rollendcol = RoolerSpecifiEndColValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(33);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Part No');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Measured Value');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Remarks');



        $i=2;

        if(!empty($rollendcol)) {


            foreach ($rollendcol as $key => $rollerendcol) {


                //dd($partclutchpck);

                //front
                $frontradio = $rollerendcol['radio'];
                $front1 = $rollerendcol['part_no'];
                $front2 = $rollerendcol['description'];
                $front3 = $rollerendcol['measured'];
                $front4 = $rollerendcol['remarks'];








                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);



                $i++;


            }
        }
        /*Rename sheet 34th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartRollerEnd Collar');

        /* Create a 35 sheet, representing sales data*/

        $rollerclr = RollerspcClearShaftValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(34);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');

        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Measured Value');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Remarks');



        $i=2;

        if(!empty($rollerclr)) {


            foreach ($rollerclr as $key => $rollerclearr) {


                //dd($partclutchpck);

                //front
                $frontradio = $rollerclearr['radio'];

                $front2 = $rollerclearr['description'];
                $front3 = $rollerclearr['measured'];
                $front4 = $rollerclearr['remarks'];








                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front4);



                $i++;


            }
        }
        /*Rename sheet 35th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartRollerClearance');

        /* Create a 36 sheet, representing sales data*/

        $idlerbefore = IdlerMeasuredBeforeValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(35);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');

        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'IdlerNo');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Width of Center Flange from Center Line of Idler');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Tread Width from Center Line of Idler');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Hub Face width');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Diameter of Center Bore in Idle');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Diameter of Tread');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Height of Center Flange');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Diameter of Tread at 100% wear');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Radius at Base of Center Flange');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Installed Bearing Diameter');



        $i=2;

        if(!empty($idlerbefore)) {


            foreach ($idlerbefore as $key => $idlerbef) {


                //dd($partclutchpck);

                //front
                $frontradio = $idlerbef['radio'];

                $front2 = $idlerbef['idler_no'];
                $front3 = $idlerbef['width1'];
                $front4 = $idlerbef['width2'];
                $front5 = $idlerbef['hub1'];
                $front6 = $idlerbef['diameter1'];
                $front7 = $idlerbef['diameter2'];
                $front8 = $idlerbef['height1'];
                $front9 = $idlerbef['diameter3'];
                $front10 = $idlerbef['radious1'];
                $front11 = $idlerbef['install1'];








                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front9);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front10);
                $objPHPExcel->getActiveSheet()->setCellValue("K$i", $front11);



                $i++;


            }
        }
        /*Rename sheet 36th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartIdlerBeforeMeasurement');


        /* Create a 37 sheet, representing sales data*/

        $idlerafter = IdlerMeasuredAfterValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(36);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');

        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'IdlerNo');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Width of Center Flange from Center Line of Idler');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Tread Width from Center Line of Idler');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Hub Face width');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Diameter of Center Bore in Idle');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Diameter of Tread');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Height of Center Flange');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Diameter of Tread at 100% wear');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Radius at Base of Center Flange');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Installed Bearing Diameter');



        $i=2;

        if(!empty($idlerafter)) {


            foreach ($idlerafter as $key => $idleraft) {


                //dd($partclutchpck);

                //front
                $frontradio = $idleraft['radio'];

                $front2 = $idleraft['idler_no'];
                $front3 = $idleraft['width1'];
                $front4 = $idleraft['width2'];
                $front5 = $idleraft['hub1'];
                $front6 = $idleraft['diameter1'];
                $front7 = $idleraft['diameter2'];
                $front8 = $idleraft['height1'];
                $front9 = $idleraft['diameter3'];
                $front10 = $idleraft['radious1'];
                $front11 = $idleraft['install1'];








                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front9);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front10);
                $objPHPExcel->getActiveSheet()->setCellValue("K$i", $front11);



                $i++;


            }
        }
        /*Rename sheet 37th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartIdlerAfterMeasurement');


        /* Create a 38 sheet, representing sales data*/

        $idlerendcoller = IdlerSpeciEndcolerValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(37);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');

        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Part No');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Idler1');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Idler2');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Idler3');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Idler4');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Idler5');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Idler6');




        $i=2;

        if(!empty($idlerendcoller)) {


            foreach ($idlerendcoller as $key => $idlerendcol) {


                //dd($partclutchpck);

                //front
                $frontradio = $idlerendcol['radio'];

                $front2 = $idlerendcol['part_no'];
                $front3 = $idlerendcol['description'];
                $front4 = $idlerendcol['idler1'];
                $front5 = $idlerendcol['idler2'];
                $front6 = $idlerendcol['idler3'];
                $front7 = $idlerendcol['idler4'];
                $front8 = $idlerendcol['idler5'];
                $front9 = $idlerendcol['idler6'];









                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front9);




                $i++;


            }
        }
        /*Rename sheet 38th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartIdlerEnd Collar');

        /* Create a 39 sheet, representing sales data*/

        $idlerclearence = IdlerspcClearShaftValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(38);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');

        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Part No');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Measured');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Remarks');





        $i=2;

        if(!empty($idlerclearence)) {


            foreach ($idlerclearence as $key => $idlerclr) {


                //dd($partclutchpck);

                //front
                $frontradio = $idlerclr['radio'];

                $front2 = $idlerclr['idler_no'];
                $front3 = $idlerclr['description'];
                $front4 = $idlerclr['measured'];
                $front5 = $idlerclr['remarks'];











                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front5);





                $i++;


            }
        }
        /*Rename sheet 39th*/
        $objPHPExcel->getActiveSheet()->setTitle('PartIdlerClearance');

        /* Create a 40 sheet, representing sales data*/

        $listofsal = MasterListofSalvageDis::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(39);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Component');

        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'QTY');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'OUT Date');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'IN Date');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Vendor');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Inspected');





        $i=2;

        if(!empty($listofsal)) {


            foreach ($listofsal as $key => $listsal) {


                //dd($partclutchpck);

                //front
                $frontradio = $listsal['component_name'];

                $front2 = $listsal['description'];
                $front3 = $listsal['qty'];
                $front4 = Carbon::parse($listsal['out_date'])->format('d/m/Y');
                $front5 = Carbon::parse($listsal['in_date'])->format('d/m/Y');
                $front6 = $listsal['vendor_name'];
                $front7 = $listsal['inspected_by'];











                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);





                $i++;


            }
        }
        /*Rename sheet 40th*/
        $objPHPExcel->getActiveSheet()->setTitle('LiatOfSalvage');

        /* Create a 41 sheet, representing sales data*/

        $statusrevision = StatusRevision::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(40);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Details of Amendment');

        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Revision No');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Page no');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Reason for Amendment');
//        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'IN Date');
//        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Vendor');
//        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Inspected');





        $i=2;

        if(!empty($statusrevision)) {


            foreach ($statusrevision as $key => $statusrevi) {


                //dd($partclutchpck);

                //front
                $frontradio = $statusrevi['details_of_amendment'];

                $front2 = $statusrevi['revision_no'];
                $front3 = $statusrevi['page_no'];
                $front4 = $statusrevi['reason_for_amendment'];
//                $front5 = $listsal['in_date'];
//                $front6 = $listsal['vendor_name'];
//                $front7 = $listsal['inspected_by'];











                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front4);
//                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front5);
//                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front6);
//                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);





                $i++;


            }
        }
        /*Rename sheet 41th*/
        $objPHPExcel->getActiveSheet()->setTitle('StatusOfRevision');


        /* Create a 42 worksheet, after the default sheet*/

        $ccbeforeasse=UserHelper::beforestartassembly();
        $ccbefore=MasterCCinspectionBeforeStartAssembly::select('*')->where('service_request_id','=',$service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();


        $objPHPExcel->setActiveSheetIndex(41);


        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Question');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Answer');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Remarks');
        $i = 2;
        $befcc = 0;
        if(!empty($ccbefore)) {
            $fstvalcc = json_decode($ccbefore[0]['ccvalues']);
            foreach ($ccbeforeasse as $comm1) {
                //dd($row1);
                $chk = array_search($comm1->check_points, $fstvalcc->checkquestion);

                $question = $fstvalcc->checkquestion[$befcc];
                $chkanswer = $fstvalcc->checkans[$befcc];
                $remark = $fstvalcc->rem[$befcc];


                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $question);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $chkanswer);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $remark);
                $i++;
                $befcc++;
            }
        }
        /* Rename 42 sheet*/
        $objPHPExcel->getActiveSheet()->setTitle('CcInspectionBeforeAssembly');


        /* Create a 43 sheet, representing sales data*/

        $conrodbush = MasterConRodBushReplacementValues::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(42);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Parameter');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Val 1');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Val 2');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Val 3');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Val 4');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Val 5');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Val 6');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Val 7');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Remarks');





        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $conrbush=0;

        $conrdbush=UserHelper::conrodbushreplacemnt();
        if(!empty($conrodbush)) {
            $conroddbush = json_decode($conrodbush[0]['values']);
            //dd($mainbearing);
            foreach ($conrdbush as $key => $conbush) {

                $chk = array_search($conbush->parameter, $conroddbush->parameter);

                //front
                $frontradio = $conroddbush->radioconbush[$conrbush];
                $front1 = $conroddbush->parameter[$conrbush];
                $front2 = $conroddbush->val1[$conrbush];
                $front3 = $conroddbush->val2[$conrbush];
                $front4 = $conroddbush->val3[$conrbush];
                $front5 = $conroddbush->val4[$conrbush];
                $front6 = $conroddbush->val5[$conrbush];
                $front7 = $conroddbush->val6[$conrbush];
                $front8 = $conroddbush->val7[$conrbush];
                $front9 = $conroddbush->remark[$conrbush];




                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);
                $objPHPExcel->getActiveSheet()->setCellValue("J$i", $front9);


                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $conrbush++;

            }
        }
        /*Rename sheet 43th*/
        $objPHPExcel->getActiveSheet()->setTitle('ConnectionrodBushReplace');


        /* Create a 44 sheet, representing sales data*/

        $failedparts = MasterFailedParts::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(43);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Part No');

        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'QTY');
       $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Remarks');
//        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'IN Date');
//        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Vendor');
//        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Inspected');





        $i=2;

        if(!empty($failedparts)) {


            foreach ($failedparts as $key => $failedpar) {


                //dd($partclutchpck);

                //front
                $frontradio = $failedpar['part_no'];

                $front2 = $failedpar['description'];
                $front3 = $failedpar['qty'];
              $front4 = $statusrevi['remarks'];
//                $front5 = $listsal['in_date'];
//                $front6 = $listsal['vendor_name'];
//                $front7 = $listsal['inspected_by'];


                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front3);
               $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front4);
//                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front5);
//                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front6);
//                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);
             $i++;


            }
        }
        /*Rename sheet 44th*/
        $objPHPExcel->getActiveSheet()->setTitle('FailedParts');

        /* Create a 45 sheet, representing sales data*/

        $compinsp = ComponentInspReport::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(44);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Part No');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'QTY');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Condition');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Reused/Reject');






        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $compi=0;

        $compins=UserHelper::ComponentInspectionReport($dept_id,$service->machine_modelno);
        if(!empty($compinsp)) {
            $compinspe = json_decode($compinsp[0]['ccvalues']);
            //dd($mainbearing);
            foreach ($compins as $key => $compin) {

                $chk = array_search($compin->transmission_hyd_control_gp, $compinspe->transmissionhyd);

                //front
                $frontradio = $compinspe->transmissionhyd[$compi];
                $front1 = $compinspe->hydpartno[$compi];
                $front2 = $compinspe->hydqty[$compi];
                $front3 = $compinspe->hydcond[$compi];
                $front4 = $compinspe->hyd[$compi];





                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);



                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $compi++;

            }
        }
        /*Rename sheet 45th*/
        $objPHPExcel->getActiveSheet()->setTitle('ComponentInspection');

        /* Create a 46 sheet, representing sales data*/

        $transmis = TransmissionComponent::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        //dd($cylimain);

        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(45);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Part No');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'QTY');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Condition');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Reused/Reject');






        //$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Actual Start Date');
        $i=2;
        $tran=0;

        $transmission=UserHelper::TransmissionComponent($dept_id,$service->machine_modelno);
        if(!empty($transmis)) {
            $transmissioncom = json_decode($transmis[0]['values']);
            //dd($mainbearing);
            foreach ($transmission as $key => $transmisso) {

                $chk = array_search($transmisso->case_parts, $transmissioncom->casepart);

                //front
                $frontradio = $transmissioncom->casepart[$tran];
                $front1 = $transmissioncom->casepartno[$tran];
                $front2 = $transmissioncom->caseqty[$tran];
                $front3 = $transmissioncom->casecond[$tran];
                $front4 = $transmissioncom->caseradio[$tran];





                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);



                //$objPHPExcel->getActiveSheet()->setCellValue("I$i", $front8);


                // $objPHPExcel->getActiveSheet()->setCellValue("E$i",$looactualdt);


                $i++;
                $tran++;

            }
        }
        /*Rename sheet 46th*/
        $objPHPExcel->getActiveSheet()->setTitle('Tramsmission&TCInspection');
		
		/* Create a 47 sheet, representing sales data */

         $parttracklinkheigh = PartTrackLinkHeight::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



         $objPHPExcel->createSheet();

         $objPHPExcel->setActiveSheetIndex(46);
         $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');

         $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Description');
         $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Before Welding');
         $objPHPExcel->getActiveSheet()->setCellValue('D1', 'After Welding');
         $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Remarks');
//        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'IN Date');
//        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Vendor');
//        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Inspected');





         $i=2;

         if(!empty($parttracklinkheigh)) {


             foreach ($parttracklinkheigh as $key => $trcklinkhei) {


                 //dd($partclutchpck);

                 //front
                 $frontradio = $trcklinkhei['radio'];

                 $front2 = $trcklinkhei['description'];
                 $front3 = $trcklinkhei['bef_welding'];
                 $front4 = $trcklinkhei['aft_welding'];
                $front5 = $trcklinkhei['remarks'];
//                $front6 = $listsal['vendor_name'];
//                $front7 = $listsal['inspected_by'];


                 $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                 $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front2);
                 $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front3);
                 $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front4);
                 $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front5);
//                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front6);
//                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);
                 $i++;


             }
         }
         /*Rename sheet 47th*/
         $objPHPExcel->getActiveSheet()->setTitle('Parts Track Link Height');

         /* Create a 48 sheet, representing sales data*/

         $parttrackpitch = PartTrackPitch::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



         $objPHPExcel->createSheet();

         $objPHPExcel->setActiveSheetIndex(47);
         $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');

         $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Description');
         $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Before Assembly');
         $objPHPExcel->getActiveSheet()->setCellValue('D1', 'After Assembly');
         $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Remarks');
//        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'IN Date');
//        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Vendor');
//        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Inspected');





         $i=2;

         if(!empty($parttrackpitch)) {


             foreach ($parttrackpitch as $key => $trckpitch) {


                 //dd($partclutchpck);

                 //front
                 $frontradio = $trckpitch['radio'];

                 $front2 = $trckpitch['description'];
                 $front3 = $trckpitch['bef_assembly'];
                 $front4 = $trckpitch['aft_assembly'];
                 $front5 = $trckpitch['remarks'];
//                $front6 = $listsal['vendor_name'];
//                $front7 = $listsal['inspected_by'];


                 $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                 $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front2);
                 $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front3);
                 $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front4);
                 $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front5);
//                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front6);
//                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);
                 $i++;


             }
         }
         /*Rename sheet 48th*/
         $objPHPExcel->getActiveSheet()->setTitle('Parts Track Pitch');

         /* Create a 49 sheet, representing sales data*/

         $parttrackpin = PartTrackLinkPin::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



         $objPHPExcel->createSheet();

         $objPHPExcel->setActiveSheetIndex(48);
         $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');

         $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Master Link');
         $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Before /After');
         $objPHPExcel->getActiveSheet()->setCellValue('D1', 'A');
         $objPHPExcel->getActiveSheet()->setCellValue('E1', 'B');

        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'D');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'E');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Remarks');





         $i=2;

         if(!empty($parttrackpin)) {


             foreach ($parttrackpin as $key => $trckpin) {


                 //dd($partclutchpck);

                 //front
                 $frontradio = $trckpin['radio'];

                 $front2 = $trckpin['master_link'];
                 $front3 = $trckpin['before_after'];
                 $front4 = $trckpin['val_a'];
                 $front5 = $trckpin['val_b'];
                $front6 = $trckpin['val_d'];
                $front7 = $trckpin['val_e'];
                $front8 = $trckpin['remarks'];


                 $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                 $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front2);
                 $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front3);
                 $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front4);
                 $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front5);
                $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front6);
                $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);
                $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front8);
                 $i++;


             }
         }
         /*Rename sheet 49th*/
         $objPHPExcel->getActiveSheet()->setTitle('Parts Master Track Pin');

         /* Create a 50 sheet, representing sales data*/

         $parttrackbush = PartTrackLinkBush::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



         $objPHPExcel->createSheet();

         $objPHPExcel->setActiveSheetIndex(49);
         $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');

         $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Master Link');
         $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Before /After');
         $objPHPExcel->getActiveSheet()->setCellValue('D1', 'A');
         $objPHPExcel->getActiveSheet()->setCellValue('E1', 'B');

         $objPHPExcel->getActiveSheet()->setCellValue('F1', 'C');
         $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Remarks');
        // $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Remarks');





         $i=2;

         if(!empty($parttrackbush)) {


             foreach ($parttrackbush as $key => $trckbush) {


                 //dd($partclutchpck);

                 //front
                 $frontradio = $trckbush['radio'];

                 $front2 = $trckbush['master_link'];
                 $front3 = $trckbush['before_after'];
                 $front4 = $trckbush['val_a'];
                 $front5 = $trckbush['val_b'];
                 $front6 = $trckbush['val_c'];
                 $front7 = $trckbush['remarks'];
                // $front8 = $trckpin['remarks'];


                 $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                 $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front2);
                 $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front3);
                 $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front4);
                 $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front5);
                 $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front6);
                 $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);
                // $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front8);
                 $i++;


             }
         }
         /*Rename sheet 50th*/
         $objPHPExcel->getActiveSheet()->setTitle('Parts Master Track Bush');

         /* Create a 51 sheet, representing sales data*/

         $partbushinsp = PartBushInspMea::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



         $objPHPExcel->createSheet();

         $objPHPExcel->setActiveSheetIndex(50);
         $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
         $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Bush No');

         $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Description');
         $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Measurement Value');
         $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Remarks');
//         $objPHPExcel->getActiveSheet()->setCellValue('E1', 'B');
//
//         $objPHPExcel->getActiveSheet()->setCellValue('F1', 'C');
//         $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Remarks');
         // $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Remarks');





         $i=2;

         if(!empty($partbushinsp)) {


             foreach ($partbushinsp as $key => $bushinsp) {


                 //dd($partclutchpck);

                 //front
                 $frontradio = $bushinsp['radio'];
                 $front1 = $bushinsp['bush_no'];

                 $front2 = $bushinsp['description'];
                 $front3 = $bushinsp['measurement_val'];
                 $front4 = $bushinsp['remarks'];
//                 $front5 = $trckbush['val_b'];
//                 $front6 = $trckbush['val_c'];
//                 $front7 = $trckbush['remarks'];
                 // $front8 = $trckpin['remarks'];


                 $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                 $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                 $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                 $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                 $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
//                 $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front6);
//                 $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);
                 // $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front8);
                 $i++;


             }
         }
         /*Rename sheet 51th*/
         $objPHPExcel->getActiveSheet()->setTitle('Parts Bush Inspection');

         /* Create a 52 sheet, representing sales data*/

         $partpininsp = PartPinInspMea::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



         $objPHPExcel->createSheet();

         $objPHPExcel->setActiveSheetIndex(51);
         $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
         $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Bush No');

         $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Description');
         $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Measurement Value');
         $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Remarks');
//         $objPHPExcel->getActiveSheet()->setCellValue('E1', 'B');
//
//         $objPHPExcel->getActiveSheet()->setCellValue('F1', 'C');
//         $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Remarks');
         // $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Remarks');





         $i=2;

         if(!empty($partpininsp)) {


             foreach ($partpininsp as $key => $pininsp) {


                 //dd($partclutchpck);

                 //front
                 $frontradio = $pininsp['radio'];
                 $front1 = $pininsp['bush_no'];


                 $front2 = $pininsp['description'];
                 $front3 = $pininsp['measurement_val'];
                 $front4 = $pininsp['remarks'];
//                 $front5 = $trckbush['val_b'];
//                 $front6 = $trckbush['val_c'];
//                 $front7 = $trckbush['remarks'];
                 // $front8 = $trckpin['remarks'];


                 $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                 $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                 $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                 $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                 $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
//                 $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front5);
//                 $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front6);
//                 $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);
                 // $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front8);
                 $i++;


             }
         }
         /*Rename sheet 52th*/
         $objPHPExcel->getActiveSheet()->setTitle('Parts Pin Inspection');

         /* Create a 53 sheet, representing sales data*/

         $parttrackshoe = PartTrackShoe::select('*')->where('service_request_id', '=', $service->id)->where('dept_id','=',$dept_id)->get()->toArray();



         $objPHPExcel->createSheet();

         $objPHPExcel->setActiveSheetIndex(52);
         $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Option');
         $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Description');

         $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Before/After');
         $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Grouser Height');
         $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Plate Thickness');
         $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Shoe Width');

         $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Remarks');
//         $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Remarks');
         // $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Remarks');





         $i=2;

         if(!empty($parttrackshoe)) {


             foreach ($parttrackshoe as $key => $trackshoeval) {


                 //dd($partclutchpck);

                 //front
                 $frontradio = $trackshoeval['radio'];
                 $front1 = $trackshoeval['description'];


                 $front2 = $trackshoeval['before_after'];
                 $front3 = $trackshoeval['grouser_height'];
                 $front4 = $trackshoeval['plate_thickness'];
                 $front5 = $trackshoeval['shoe_width'];
                 $front6 = $trackshoeval['remarks'];
//                 $front7 = $trckbush['remarks'];
                 // $front8 = $trckpin['remarks'];


                 $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);

                 $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                 $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);
                 $objPHPExcel->getActiveSheet()->setCellValue("D$i", $front3);
                 $objPHPExcel->getActiveSheet()->setCellValue("E$i", $front4);
                 $objPHPExcel->getActiveSheet()->setCellValue("F$i", $front5);
                 $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front6);
//                 $objPHPExcel->getActiveSheet()->setCellValue("G$i", $front7);
                 // $objPHPExcel->getActiveSheet()->setCellValue("H$i", $front8);
                 $i++;


             }
         }
         /*Rename sheet 52th*/
         $objPHPExcel->getActiveSheet()->setTitle('Parts Track Shoe Inspection');




        /* Redirect output to a client’s web browser (Excel5)*/


        $xlsName='test.xlsx'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$xlsName.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');


    }
	
	
	public function assyexcelDownload (Request $request)
    {
        $service = Service::find($request['service_id']);
        $data = Session::all();
        $dept_id=$data['user']['section_id'];


        $objPHPExcel = new PHPExcel();

        /* Create a first sheet, representing sales data*/
        $engineassembly   = ChecksheetAssembly::select('*')->where('service_request_id','=',$service->id)->where('dept_id','=',$dept_id)->get()->toArray();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Description');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Specification');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Actual Value');


        $i=2;
        $ass=0;


        $assembly=UserHelper::assemblychecksheet($dept_id,$service->machine_modelno);
        if(!empty($engineassembly)) {
            $engassemb = json_decode($engineassembly[0]['cc_value']);
            //dd($mainbearing);
            foreach ($assembly as $key => $assemb) {

                $chk = array_search($assemb->operation_desp, $engassemb->operationdesp);

                //front
                $frontradio = $engassemb->operationdesp[$ass];
                $front1 = $engassemb->specification[$ass];
                $front2 = $engassemb->actval[$ass];


                $objPHPExcel->getActiveSheet()->setCellValue("A$i", $frontradio);
                $objPHPExcel->getActiveSheet()->setCellValue("B$i", $front1);
                $objPHPExcel->getActiveSheet()->setCellValue("C$i", $front2);



                $i++;
                $ass++;

            }
        }

        /*Rename sheet*/
        $objPHPExcel->getActiveSheet()->setTitle('AssemblyChecksheet');

        /* Redirect output to a client’s web browser (Excel5)*/


        $xlsName='assytest.xlsx'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$xlsName.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

    }
	
	

    //disassembly chechsheet approved/reject by det head
   public function headApproveChecksheetSave(Request $request)
    {
        $data = Session::all();
        $service = Service::find($request['service_id']);
        // echo '';print_r($data['user']['section_id']);exit;
        $dept_id=$data['user']['section_id'];
        
         $status_res = ChecksheetStatus ::where('dept_id','=',$dept_id)
            ->where('service_request_id','=',$request['service_id'])

            ->get()->toArray();
        //echo '<pre>';print_r($aggregate_res);exit;
        if(count($status_res)<=0){
            $obj = new ChecksheetStatus();

        }
        else{
            $obj = ChecksheetStatus::find($status_res[0]['id']);

        }
        
        //$obj = new ChecksheetStatus();

       // $obj->service_request_id=$service->id;
       // $obj->dept_id=$dept_id;
        $obj->disassembly_status=$request['status'];
        $obj->disassembly_comment=$request['comment_for_approve'];
        $obj->save();

       
  $countapprv = ChecksheetStatus::Select('disassembly_status')->where('service_request_id','=',$request['service_id'])

            ->get()->toArray();


       $final=array_search('Rejected',array_column($countapprv, 'disassembly_status'));
         $final1=array_search('Pending',array_column($countapprv, 'disassembly_status'));
         $final2=array_search('Submitted',array_column($countapprv, 'disassembly_status'));
      //dd($final);
        if(($final===false) && ($final1===false) && ($final2===false)){

            $service->dcs_status='Approved';
            $service->save();
			
			

           //print_r( 'no reject present');
        }
		
		$status='Disassembly'.' '.$request['status'];
        $adminstatus= UserHelper::adminstatus($request['service_id'],$status);
        
        // $service->dcs_status=$request['status'];
        // $service->save();
        
        //rejected checksheet will be reopen for fillup



        //mail send to dept for approve/reject
        
        $url=url('/');
       $mailsend=User::select('*')->where('section_id','=',21)->where('section_id','=',3)->where('role_id','=',2)->get()->toArray();
        //echo '<pre>';print_r($mailsend);exit;
        if(!empty($mailsend)){
            foreach ($mailsend as $mail){

                $to_email = $mail['email'];
                $subject = 'CheckSheet Approve Mail';
                $message = view('admin.mail.checkSheetNotificationMail', ['url'=>$url,'serviceno' => $service->service_request_no])->render();
                $notification= UserHelper::mailnotification($to_email,$subject,$message);
            }
        }
        


        //return redirect('admin/engine-diss-list');
         if (request()->session()->get('user')['section_id'] == '4'){
             return redirect('admin/engine-diss-list');
         }
        elseif(request()->session()->get('user')['section_id'] == '5'){
             return redirect('admin/trans-diss-list');
        }
        // elseif(request()->session()->get('user')['section_id'] == '6' ){
        //     return redirect('admin/mor-diss-list');
        // }
          elseif(request()->session()->get('user')['section_id'] == '7'){
               return redirect('admin/undercarg-diss-list');
           }
             elseif(request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/hyd-diss-list');
        }
    }

    //assembly chechsheet approved/reject by det head
     public function headApproveAssemblyChecksheetSave(Request $request)
    {

        $data = Session::all();
        $service = Service::find($request['service_id']);
        // echo '';print_r($data['user']['section_id']);exit;
        $dept_id=$data['user']['section_id'];
        //dd($obj);exit;
        
          if (request()->session()->get('user')['section_id'] == '10'){
            $dept_id1 = '4';
        }
        if(request()->session()->get('user')['section_id'] == '11'){
            $dept_id1 = '5';
        }
        if(request()->session()->get('user')['section_id'] == '15'){
             $dept_id1 = '7';
        }
        if(request()->session()->get('user')['section_id'] == '12'){
              $dept_id1 = '13';
        }
        
        
         $status_res = ChecksheetStatus ::where('dept_id','=',$dept_id1)
            ->where('service_request_id','=',$request['service_id'])

            ->get()->toArray();
        //echo '<pre>';print_r($aggregate_res);exit;
        if(count($status_res)<=0){
            $obj = new ChecksheetStatus();

        }
        else{
            $obj = ChecksheetStatus::find($status_res[0]['id']);

        }
        
        //$obj = new ChecksheetStatus();

        //$obj->service_request_id=$service->id;
        //$obj->dept_id=$dept_id;
        $obj->assembly_status=$request['status'];
        $obj->assembly_comment=$request['comment_for_approve'];
        $obj->save();

  $countapprv = ChecksheetStatus::Select('assembly_status')->where('service_request_id','=',$request['service_id'])

            ->get()->toArray();


       $final=array_search('Rejected',array_column($countapprv, 'assembly_status'));
     $final1=array_search('Pending',array_column($countapprv, 'assembly_status'));
          $final2=array_search('Submitted',array_column($countapprv, 'assembly_status'));
       
      //dd($final2);
        if(($final===false) && ($final1===false) && ($final2===false)){

            $service->asc_status='Approved';
            $service->save();

           //print_r( 'no reject present');
        }

        // $service->asc_status=$request['status'];
        // $service->save();
       
               $status='Assembly'.' '.$request['status'];
        $adminstatus= UserHelper::adminstatus($request['service_id'],$status);



        //return redirect('admin/engine-ass-list');
         if (request()->session()->get('user')['section_id'] == '10'){
             return redirect('admin/engine-ass-list');
         }
        elseif(request()->session()->get('user')['section_id'] == '11'){
             return redirect('admin/trans-ass-list');
        }
        // elseif(request()->session()->get('user')['section_id'] == '6' ){
        //     return redirect('admin/mor-ass-list');
        // }
          elseif(request()->session()->get('user')['section_id'] == '15'){
               return redirect('admin/undercarg-ass-list');
           }
             elseif(request()->session()->get('user')['section_id'] == '12'){

            return redirect('admin/hyd-ass-list');
        }
    }

}
