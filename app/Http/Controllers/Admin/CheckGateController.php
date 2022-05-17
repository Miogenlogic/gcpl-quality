<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckGateQuestionEditRequest;
use App\Http\Requests\CheckGateQuestionRequest;
use App\Helpers\UserHelper;
use App\Models\MasterCheckGate;
use App\Models\MasterCheckGateInspectionQuestion;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\CheckgateStatus;
use App\Models\ChecksheetStatus;
use App\Models\Service;

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
class CheckGateController extends Controller
{
    
  //super admin
    public function checkGateQuestionAdd()
    {
        $title='Add Questions';

        return view('admin.checkGateQuestion.addCheckGateQuestion');
    }

    public function checkGateQuestionAddStore(CheckGateQuestionRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj =new MasterCheckGateInspectionQuestion();
        $obj->check_gate_id = $request['check_gate_id'];
        $obj->inspection_criteria = $request['inspection_criteria'];

        $obj->save();


        return redirect('admin/check-gate-question-list');

    }

    public function checkGateQuestionList()
    {
        return view('admin.checkGateQuestion.listCheckGateQuestion');
    }

    public function checkGateQuestionGetTable(Request $request)
    {

        //$table =MasterCheckGateInspectionQuestion::select('*')->get();
        $table = MasterCheckGateInspectionQuestion::select('gw_master_check_gate_inspection_question.*','gw_master_check_gate.name')
            ->leftjoin('gw_master_check_gate','gw_master_check_gate.id','=','gw_master_check_gate_inspection_question.check_gate_id')
            ->get();

        $datatables =  Datatables::of($table)
            /*->addColumn('roles', function ($table) {
                $str="";


                return $roles;
            })*/

            ->addColumn('action', function ($table) {
                return ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/check-gate-question-edit')."/"."$table->id".'">EDIT</a>
                                                <a class="dropdown-item" href="' . url('admin/check-gate-question-delete')."/"."$table->id".'">DELETE</a>
                                            </div>
                                        </div>';
                //$btns = ' <a href="' . url('admin/check-gate-question-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';
                  //$btns .=' <a href="' . url('admin/check-gate-question-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                //return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }


    public function checkGateQuestionEdit($id)
    {
        $title='Edit User';

        $ques=MasterCheckGateInspectionQuestion::find($id);

        return view('admin.checkGateQuestion.editCheckGateQuestion')
            ->with('ques',$ques);
    }

    public function checkGateQuestionEditStore(CheckGateQuestionEditRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($request);

        $obj=MasterCheckGateInspectionQuestion::find($request['id']);

        $obj->check_gate_id = $request['check_gate_id'];
        $obj->inspection_criteria = $request['inspection_criteria'];

        $obj->save();

        return redirect('admin/check-gate-question-list');

    }
    public function checkGateQuestionDelete($user_id)
    {
        $qstn = MasterCheckGateInspectionQuestion::find($user_id);

        $qstn->delete();
        //dd($location);
        return redirect('admin/check-gate-question-list');
    }
    public function headApproveCheckgateSave(Request $request)
    {
        $service = Service::find($request['service_id']);
        
        
        
        $obj = new CheckgateOneHeadApproveStatus();

        $obj->service_request_id=$service->id;
        $obj->status=$request['status'];
        $obj->comment=$request['comment'];
        $obj->save();
        $id=$obj->id;

        return redirect('admin/receiving-dashboard/')
            ->with('service',$service);
    }
    public function headApproveCheckgateOneSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $service = Service::find($request['service_id']);
        $service->cg1_status=$request['status'];
         $service->save();
         
         
		 $status='CheckGate1'.' '.$request['status'];
        $adminstatus= UserHelper::adminstatus($request['service_id'],$status);
        //$status_res = CheckgateStatus ::where('dept_id','=',$dept_id)
            //->where('service_request_id','=',$request['service_id'])

            //->get()->toArray();

        //if(count($status_res)<=0){
            //$obj = new CheckgateStatus();

        //}
        //else{
            //$obj = CheckgateStatus::find($status_res[0]['id']);

       // }
       // $obj = new CheckgateStatus();

        //$obj->service_request_id=$service->id;
        //$obj->dept_id=$dept_id;
        //$obj->cg1_status=$request['status'];
        //$obj->cg1_comment=$request['comment'];
        //$obj->save();
        //$id=$obj->id;

        return redirect('admin/servicedashboard-checkgateone')
            ->with('service',$service);
    }

    public function headApproveCheckgateTwoSave(Request $request)
    {
         $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $service = Service::find($request['service_id']);
       
        
        
        $status_res = CheckgateStatus ::where('dept_id','=',$dept_id)
            ->where('service_request_id','=',$request['service_id'])
               ->where('dept_id','=',$dept_id)
            ->get()->toArray();
  //dd($status_res[0]['id']);
        if(count($status_res)<=0){
            $obj = new CheckgateStatus();

        }
        else{
            $obj = CheckgateStatus::find($status_res[0]['id']);

        }
        
        //$obj = new CheckgateStatus();

       // $obj->service_request_id=$service->id;
        //$obj->dept_id=$dept_id;
        $obj->cg2_status=$request['status'];
        
        $obj->cg2_comment=$request['comment'];
        
        $obj->save();
        
        
        $countapprv = CheckgateStatus::Select('cg2_status')->where('service_request_id','=',$request['service_id'])

            ->get()->toArray();
//dd($countapprv);

       $final=array_search('Rejected',array_column($countapprv, 'cg2_status'));
         $final1=array_search('Pending',array_column($countapprv, 'cg2_status'));
          $final2=array_search('Submitted',array_column($countapprv, 'cg2_status'));
      //dd($final);
        if(($final===false) && ($final1===false) && ($final2===false)){

            $service->cg2_status='Approved';
            $service->save();

           //print_r( 'no reject present');
        }
        
		$status='CheckGate2'.' '.$request['status'];
        $adminstatus= UserHelper::adminstatus($request['service_id'],$status);
        //$id=$obj->id;
		
		//notification

        $url=url('/');
        $location=$data['user']['location_id'];
        $dpt= $service->chkonedept;
        if ($dpt == 4) {
									$sectionid = 10;
								} elseif ($dpt == 5) {
									$sectionid = 11;
								} elseif ($dpt == 7) {
									$sectionid = 15;
								} elseif ($dpt == 6) {
									$sectionid = 6;
								} elseif ($dpt == 13) {
									$sectionid = 12;
								}



        $mailsend=User::select('email')


            ->where('location_id','=',$location)
            ->where('role_id','!=', '1')

            ->where(function($query) use($sectionid) {

                $query->where('section_id','=', $sectionid)

                    ->orWhere('section_id','=', '21')


                    ->orwhere('section_id','=','20');
            })
            ->groupby('email')
            ->get()->toArray();
        if(!empty($mailsend)){

            foreach ($mailsend as $mailone){
				$tomail = $mailone['email'];
                $data=['subject'=>'Dissassembly Completion Mail','email'=>$tomail,'serviceno' => $service->service_request_no,'url'=>$url];


                Mail::send('admin.mail.serviceNotificationMail', $data, function($message) use ($data) {

                    $message->to($data['email'])->subject($data['subject']);
                    //dd($message);
                    $message->from(env('service_mail'),'QMS');
                    //$message->from(\Config::get('env.service_mail'),'loyalty@gainwellindia.com');
                });
            }
        }

        


        return redirect('admin/servicedashboard-checkgatetwo')
            ->with('service',$service);
    }

    public function headApproveCheckgateThreeSave(Request $request)
    {
         $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $service = Service::find($request['service_id']);
         $service->cg3_status=$request['status'];
        $service->save();
        
        $status_res = CheckgateStatus ::where('dept_id','=',$dept_id)
            ->where('service_request_id','=',$request['service_id'])
            ->where('dept_id','=',$dept_id)
            ->get()->toArray();

        if(count($status_res)<=0){
            $obj = new CheckgateStatus();

        }
        else{
            $obj = CheckgateStatus::find($status_res[0]['id']);

        }
        
        //$obj = new CheckgateStatus();

        $obj->service_request_id=$service->id;
        $obj->dept_id=$dept_id;
        $obj->cg3_status=$request['status'];
        $obj->cg3_comment=$request['comment'];
        $obj->save();
        $id=$obj->id;
		
		$status='CheckGate3'.' '.$request['status'];
        $adminstatus= UserHelper::adminstatus($request['service_id'],$status);

        return redirect('admin/servicedashboard-checkgatethree')
            ->with('service',$service);
    }
    
    public function headApproveCheckgateFourSave(Request $request)
    {
         $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $service = Service::find($request['service_id']);
        //echo '<pre';print_r($service);exit;
        
         $service->cg4_status=$request['status'];
         
        $service->save();
        
        $status_res = CheckgateStatus ::where('dept_id','=',$dept_id)
            ->where('service_request_id','=',$request['service_id'])
           ->where('dept_id','=',$dept_id)
            ->get()->toArray();

        if(count($status_res)<=0){
            $obj = new CheckgateStatus();

        }
        else{
            $obj = CheckgateStatus::find($status_res[0]['id']);

        }
        
        //$obj = new CheckgateStatus();

        $obj->service_request_id=$service->id;
        $obj->dept_id=$dept_id;
        $obj->cg4_status=$request['status'];
        $obj->cg4_comment=$request['comment'];
        $obj->save();
        $id=$obj->id;
		
		$status='CheckGate4'.' '.$request['status'];
        $adminstatus= UserHelper::adminstatus($request['service_id'],$status);
		
		//notification
        $url=url('/');
        $location=$data['user']['location_id'];
        $dpt= $service->chkonedept;
        if ($dpt == 4) {
									$sectionid = 10;
								} elseif ($dpt == 5) {
									$sectionid = 11;
								} elseif ($dpt == 7) {
									$sectionid = 15;
								} elseif ($dpt == 6) {
									$sectionid = 6;
								} elseif ($dpt == 13) {
									$sectionid = 12;
								}
        $mailsend=User::select('email')

            ->where(function($query) use($location) {

                $query->where('location_id','=',$location)
                    ->orWhere('location_id','=','3');


            })
            //->where('location_id','=',$location)
            ->where('role_id','!=', '1')

            ->where(function($query) use($sectionid) {

                $query->where('section_id','=', '20')

          ->orWhere('section_id','=', '24')


                    ->orwhere('section_id','=',$sectionid);
            })
            ->groupby('email')
            ->get()->toArray();
        if(!empty($mailsend)){

            foreach ($mailsend as $mailone){
				$tomail = $mailone['email'];
                $data=['subject'=>'QAQC Completion Mail','email'=>$tomail,'serviceno' => $service->service_request_no,'url'=>$url];


                Mail::send('admin.mail.serviceNotificationMail', $data, function($message) use ($data) {

                    $message->to($data['email'])->subject($data['subject']);
                    //dd($message);
                    $message->from(env('service_mail'),'QMS');
                    //$message->from(\Config::get('env.service_mail'),'loyalty@gainwellindia.com');
                });
            }
        }

        return redirect('admin/servicedashboard-checkgatefour')
            ->with('service',$service);
    }

    public function headApproveBISSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $service = Service::find($request['service_id']);
        $service->bis_status=$request['status'];
        $service->save();

        $status_res = ChecksheetStatus ::where('dept_id','=',$dept_id)
            ->where('service_request_id','=',$request['service_id'])
            ->where('dept_id','=',$dept_id)
            ->get()->toArray();

        if(count($status_res)<=0){
            $obj = new ChecksheetStatus();

        }
        else{
            $obj = ChecksheetStatus::find($status_res[0]['id']);

        }

        $obj->service_request_id=$service->id;
        $obj->dept_id=$dept_id;
        $obj->bis_status=$request['status'];
        $obj->bis_comment=$request['comment'];
        $obj->save();
        $id=$obj->id;
		
		$status='BIS'.' '.$request['status'];
        $adminstatus= UserHelper::adminstatus($request['service_id'],$status);
		
		//notification
        $url=url('/');
        $location=$data['user']['location_id'];
        $dpt= $service->chkonedept;
        if ($dpt == 4) {
									$sectionid = 10;
								} elseif ($dpt == 5) {
									$sectionid = 11;
								} elseif ($dpt == 7) {
									$sectionid = 15;
								} elseif ($dpt == 6) {
									$sectionid = 6;
								} elseif ($dpt == 13) {
									$sectionid = 12;
								}
        $mailsend=User::select('email')


            ->where('location_id','=',$location)
            ->where('role_id','!=', '1')

            ->where(function($query) use($sectionid) {

                $query->where('section_id','=', '20')
                    ->orWhere('section_id','=', '21')
                    ->orWhere('section_id','=', '22')


                    ->orwhere('section_id','=',$sectionid);
            })
            ->groupby('email')
            ->get()->toArray();
        if(!empty($mailsend)){

            foreach ($mailsend as $mailone){
				$tomail = $mailone['email'];
                $data=['subject'=>'Testing Completion Mail','email'=>$tomail,'serviceno' => $service->service_request_no,'url'=>$url];


                Mail::send('admin.mail.serviceNotificationMail', $data, function($message) use ($data) {

                    $message->to($data['email'])->subject($data['subject']);
                    //dd($message);
                    $message->from(env('service_mail'),'QMS');
                    //$message->from(\Config::get('env.service_mail'),'loyalty@gainwellindia.com');
                });
            }
        }

        return redirect('admin/bis-listing')
            ->with('service',$service);
    }
    
    
    //pdi
    public function headApprovePdiSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $service = Service::find($request['service_id']);
        $service->pdi_status=$request['status'];
		
		if($request['status'] == 'Approved'){
            $service->status='Closed';
        }
        $service->save();

        $status_res = CheckgateStatus ::where('dept_id','=',$dept_id)
            ->where('service_request_id','=',$request['service_id'])
              ->where('dept_id','=',$dept_id)
            ->get()->toArray();

        if(count($status_res)<=0){
            $obj = new CheckgateStatus();

        }
        else{
            $obj = CheckgateStatus::find($status_res[0]['id']);

        }

        //$obj = new CheckgateStatus();

        $obj->service_request_id=$service->id;
        $obj->dept_id=$dept_id;
        $obj->pdi_status=$request['status'];
        $obj->pdi_comment=$request['comment'];
        $obj->save();
        $id=$obj->id;
		
		$status='PDI'.' '.$request['status'];
        $adminstatus= UserHelper::adminstatus($request['service_id'],$status);
		
		//notification

        $url=url('/');
        $location=$data['user']['location_id'];
        $dpt= $service->chkonedept;
        if ($dpt == 4) {
									$sectionid = 10;
								} elseif ($dpt == 5) {
									$sectionid = 11;
								} elseif ($dpt == 7) {
									$sectionid = 15;
								} elseif ($dpt == 6) {
									$sectionid = 6;
								} elseif ($dpt == 13) {
									$sectionid = 12;
								}
        $mailsend=User::select('email')


            ->where('location_id','=',$location)
            ->where('role_id','!=', '1')

            ->where(function($query) use($sectionid) {

                $query->where('section_id','=', '20')

                    ->orWhere('section_id','=', '22')


                    ->orwhere('section_id','=',$sectionid);
            })
            ->groupby('email')
            ->get()->toArray();

        if(!empty($mailsend)){

            foreach ($mailsend as $mailone){
				$tomail = $mailone['email'];
                $data=['subject'=>'Dispatch Completion Mail','email'=>$tomail,'serviceno' => $service->service_request_no,'url'=>$url];


                Mail::send('admin.mail.serviceNotificationMail', $data, function($message) use ($data) {

                    $message->to($data['email'])->subject($data['subject']);
                    //dd($message);
                    $message->from(env('service_mail'),'QMS');
                    //$message->from(\Config::get('env.service_mail'),'loyalty@gainwellindia.com');
                });
            }
        }

        return redirect('admin/servicedashboard-pdilist')
            ->with('service',$service);
    }

    public function headApproveServiceRequestSave(Request $request)
    {
       
        $service = Service::find($request['service_id']);
        $service->receiving_status=$request['status'];
        $service->save();
       
       /*$status_res = CheckgateStatus ::where('service_request_id','=',$request['service_id'])

            ->get()->toArray();

        if(count($status_res)<=0){
            $obj = new CheckgateStatus();

        }
        else{
            $obj = CheckgateStatus::find($status_res[0]['id']);

        }
       
        //$obj = new CheckgateStatus();
        
        $obj->service_request_id=$service->id;
        $obj->dept_id=1;
        $obj->service_request_status=$request['status'];
        $obj->service_request_comment=$request['comment'];
        $obj->save();
        //$id=$obj->id;*/

        return redirect('admin/service-request-list/');
            // ->with('service',$service);
    }

}
