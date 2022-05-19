<?php

namespace App\Http\Controllers\admin;
use App\Helpers\UserHelper;
use App\Http\Requests\OtpFormRequest;
use App\Models\ChecksheetChildSection;
use App\Models\ChecksheetColumn;
use App\Models\ChecksheetSubChildSection;
use App\Models\MasterBranch;
use App\Models\MasterBis;
use App\Models\MasterCheckSheetSection;
use App\Models\MasterComponentArrangementNo;
use App\Models\MasterComponentDetails;
use App\Models\MasterComponentModelNo;
use App\Models\MasterComponentSerialNo;
use App\Models\MasterComponentType;
use App\Models\MasterCustomer;
use App\Models\MasterDesignation;
use App\Models\MasterEmployee;
use App\Models\MasterJobType;
use App\Models\MasterMachine;
use App\Models\MasterMachineDetails;
use App\Models\MasterMachineModelNo;
use App\Models\MasterMachineSerialNo;
use App\Models\MasterMCModel;
use App\Models\MasterMCSerialNumber;
use App\Models\MasterPartOthercomponentBasicEngine;
use App\Models\MasterPartOthercomponentCoolingSystem;
use App\Models\MasterPartOthercomponentFuelSystem;
use App\Models\MasterPartOthercomponentLubricationSystem;
use App\Models\MasterSection;
use App\Models\MasterListofSalvageDis;
use App\Models\MasterSegment;
use App\Models\Service;
use Box\Spout\Writer\Style\StyleBuilder;
use App\Models\TimeSheetEntry;
use App\Models\CapacityUtilization;
use App\Models\MasterMissingdamagePartDis;

use App\Models\Roles;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Models\MasterEngineModel;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


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

use Excel;
use Illuminate\Support\Facades\Crypt;
use App\Providers\HelperServiceProvider;
class UserController extends Controller
{
    public function test(){
        /*
        Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'crc_head']);
        Role::create(['name' => 'spc']);
        Role::create(['name' => 'branch_engineer']);
        Role::create(['name' => 'section_supervisor']);
        Role::create(['name' => 'section_engineer']);
        Role::create(['name' => 'qa_qc']);
        Role::create(['name' => 'planning_supervisor']);
        Role::create(['name' => 'store_manager']);
        Role::create(['name' => 'despatch_manager']);

        Permission::create(['name' => 'edit articles']);

        A permission can be assigned to a role using 1 of these methods:

        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        A permission can be removed from a role using 1 of these methods:

        $role->revokePermissionTo($permission);
        $permission->removeRole($role);

        // get a list of all permissions directly assigned to the user
        $permissionNames = $user->getPermissionNames(); // collection of name strings
        $permissions = $user->permissions; // collection of permission objects

        // get all permissions for the user, either directly, or from roles, or from both
        $permissions = $user->getDirectPermissions();
        $permissions = $user->getPermissionsViaRoles();
        $permissions = $user->getAllPermissions();

        // get the names of the user's roles
        $roles = $user->getRoleNames();

        $users = User::role('writer')->get(); // Returns only users with the role 'writer'

        $users = User::permission('edit articles')->get(); // Returns only users with the permission 'edit articles' (inherited or directly)

        $all_users_with_all_their_roles = User::with('roles')->get();
        $all_users_with_all_direct_permissions = User::with('permissions')->get();
        $all_roles_in_database = Role::all()->pluck('name');


        You can check if a user has Any of an array of permissions:

        $user->hasAnyPermission(['edit articles', 'publish articles', 'unpublish articles']);

        user has All of an array of permissions:

        $user->hasAllPermissions(['edit articles', 'publish articles', 'unpublish articles']);

        $user->can('edit articles');

        //Assign Role to User
        $user=User::find(1);
        $user->assignRole('super_admin');

        // Adding permissions to a user
        $user->givePermissionTo('edit articles');


        $user=User::find(1);
        $user->assignRole('super_admin');
        echo "Assign Role";


        $user=User::find(1);
        $user->removeRole('super_admin');
        echo "Delete Role";
        Role::create(['name' => 'dept_hyd_disassembly']);
        */

        $user=User::find(31);
        $user->assignRole('dept_undercarriage');
        echo "Assign Role";


    }

    /*Read excel file with fastexcel and insert data into database autometically*/

    public function test2(Request $request){


       (new FastExcel)->import('D:/GWApps/gcpl-qualitynew htmls/Book1.xlsx', function ($line) {
//echo "<pre>"; print_r($line);exit;
           if($line['Section'] ) {
               $mcModel = MasterCheckSheetSection::where('name', '=', $line['Section'])->get()->first();
               if (!isset($mcModel->id)) {
                   $mcModel = new MasterCheckSheetSection();
                   //$mcModel->section_id = $line['Section'];

                   $mcModel->name = $line['Section'];
                   $mcModel->save();

               }
           }


       /* if($line['child section'] ) {
             $section = ChecksheetChildSection::where('child_section', '=', $line['child section'])
                 //->where('section_id','=',$mcModel->id)
                ->get()->first();
             if (!isset($section->id)) {
                 $section = new ChecksheetChildSection();
                 $section->section_id = $mcModel->id;
                 $section->child_section = $line['child section'];
                 $section->save();

             }
         }
           if($line['subsection'] ) {
               $sub = ChecksheetSubChildSection::where('sub_child_section', '=', $line['subsection'])
                   //->where('section_id','=',$mcModel->id)
                   ->get()->first();
               if (!isset($sub->id)) {
                   $sub = new ChecksheetSubChildSection();
                   $sub->section_id = $mcModel->id;
                   $sub->child_id = $section->id;
                   $sub->sub_child_section = $line['subsection'];
                   $sub->save();

               }
           }*/
           if($line['columns'] ) {
               $colu = ChecksheetColumn::where('columns', '=', $line['columns'])
                   //->where('section_id','=',$mcModel->id)
                   ->get();
               if (!isset($colu->id)) {
                   $colu = new ChecksheetColumn();
                   $colu->section_id = $mcModel->id;
                   $colu->columns = $line['columns'];
                   $colu->save();

               }
           }
       /*  if ($line['Designation ']) {
                   $desig = MasterDesignation::where('designation', '=', $line['Designation '])->get()->first();
                   if (!isset($desig->id)) {
                       $desig = new MasterDesignation();
                       $desig->designation = $line['Designation '];
                       $desig->save();

                   }*/
                /*if($e['MACHINE SL NO']){
                       $mcSerialNumber=MasterMCSerialNumber::where('serial_no','=',$line['MACHINE SL NO'])
                           ->where('mc_model_id','=',$mcModel->id)
                           ->get()->first();
                       if(!isset($mcSerialNumber->id)) {
                           $mcSerialNumber = new MasterMCSerialNumber();
                           $mcSerialNumber->mc_model_id = $mcModel->id;
                           $mcSerialNumber->serial_no = $line['MACHINE SL NO'];
                           $mcSerialNumber->save();
                       }
                   }*/

                  /* if ($line['Name']) {
                       $compSerialNumber = MasterEmployee::where('name', '=', $line['Name'])
                           ->where('jobrole_id', '=', $mcModel->id)
                           //->where('designation_id', '=', $desig->id)
                           ->get()->first();
                       if (!isset($compSerialNumber->id)) {
                           $compSerialNumber = new MasterEmployee();
                           $compSerialNumber->section_id = $section->id;
                           $compSerialNumber->jobrole_id = $mcModel->id;
                           $compSerialNumber->name = $line['Name'];
                           $compSerialNumber->emp_code = $line['Emp Code'];
                           $compSerialNumber->designation_id =$desig->id;


                           $compSerialNumber->save();
                       }
                   }*/


                  //$obj->comp_serial_no = $line['COMPONENT_MC  SERIAL NO'];
                  //$obj->comp_type = $line['COMPONENT'];

             // }
         // }
        });



  }

    public function test3(Request $request)
    {
        $session = $request->session()->all();
        $users = (new FastExcel)->import($request->file('user_excel'), function ($line) {
            if($line['MACHINE MODEL'] !="" && $line['MACHINE MODEL']!=null){
                $emp=MasterMachine::where('machine_model_no','=',$line['MACHINE MODEL'])->get();
                if(!isset($emp[0]->machine_model_no)){
                    $obj=new User();
                    $obj->machine_model_no = $line['MACHINE MODEL'];
                    $obj->machine_serial_no = $line['MACHINE SL NO'];

                   // $obj->email = $line['Email'];
                    //$obj->password = Hash::make('123456');
                    //$obj->employee_code = $line['Employee_Code'];
                    $obj->save();

                    //echo $mail;exit;

                    /*****Email to Employee**********/
                }
            }

        });

        $excelfile = $request->file('user_excel');
        $tmp = explode('.', $excelfile->getClientOriginalName());
        $ext = end($tmp);
        $save_exlfile = time() . '.' . $ext;
        $destinationPath = 'public/assets/upload/sys_user';
        $excelfile->move($destinationPath, $save_exlfile);
        $users_upload = $save_exlfile;

        $activity=UserHelper::getRecentActivities($session['user']['user_id'],'uploaded User details',$session['user']['user_id'],'User',$session['user']['user_id'],$session['user']['name']);

        if($users){
            Session::flash('msg', 'User created successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/userlist');
        }else{
            Session::flash('msg', 'Excel failed to upload!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/user-create');
        }

    }

    //report
    //component status
    public function componentstatusfacilitylisting()
    {
        return view('admin.report.componentStatusFacilityList');
    }

    public function componentstatusfacilityGetTableold(Request $request)
    {
//dd($request);
        $data = Session::all();

        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
            $table = Service::select('service_request.*', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_comp_details.comp_serial_no as compserial', 'gw_master_customer.name as cust')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $location)
                ->get();
        }

        if($location == '3'){
            $table = Service::select('service_request.*', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_comp_details.comp_serial_no as compserial', 'gw_master_customer.name as cust')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                //->where('service_request.location_id', '=', $location)
                ->get();
        }

        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
			->addColumn('servicedate', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($table->date)->format('d/m/Y');

                return $formatted_dt1;

            })
			 ->addColumn('parts_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt2= "";

                return $formatted_dt2;

            })
			 ->addColumn('service_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt3= "";

                return $formatted_dt3;

            })
			 ->addColumn('total_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt4= "";

                return $formatted_dt4;

            })
			
            ->addColumn('salvage_val', function ($table) {




                $formatted_dt5 = MasterListofSalvageDis::select('salvage_value')->where('service_request_id','=',$table['id'])->get();

           //dd($formatted_dt5); 
                     $formatted_dt6="";
					 
                 if(!empty($formatted_dt5)){  
                   if(!empty($formatted_dt5[0]['salvage_value'])){
                     $formatted_dt6=$formatted_dt5[0]['salvage_value'];
				   }
				 }else{
					$formatted_dt6="";
				 }
               
                return $formatted_dt6;

            })
			

            ->rawColumns(['action','roles','servicedate','parts_val','service_val','total_val','salvage_val']);


        return $datatables->make(true);
    }

    public function componentstatusfacilityFilterold(Request $request){

        $locationId = $request['location'];
        //dd($locationId);

        if($locationId != '3') {
            $table = Service::select('service_request.*', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_comp_details.comp_serial_no as compserial', 'gw_master_customer.name as cust')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $locationId)
                ->get();
        }else{
            $table = Service::select('service_request.*', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_comp_details.comp_serial_no as compserial', 'gw_master_customer.name as cust')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                //->where('service_request.location_id', '=', $location)
                ->get();
        }
//dd($request);
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })

           ->addColumn('servicedate', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($table->date)->format('d/m/Y');

                return $formatted_dt1;

            })
         
            ->addColumn('parts_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt2= "";

                return $formatted_dt2;

            })
			 ->addColumn('service_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt3= "";

                return $formatted_dt3;

            })
			 ->addColumn('total_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt4= "";

                return $formatted_dt4;

            })
			
           ->addColumn('salvage_val', function ($table) {




                $formatted_dt5 = MasterListofSalvageDis::select('salvage_value')->where('service_request_id','=',$table['id'])->get();

           //dd($formatted_dt5); 
                     $formatted_dt6="";
					 
                 if(!empty($formatted_dt5)){  
                   if(!empty($formatted_dt5[0]['salvage_value'])){
                     $formatted_dt6=$formatted_dt5[0]['salvage_value'];
				   }
				 }else{
					$formatted_dt6="";
				 }
               
                return $formatted_dt6;

            })
			
			

            ->rawColumns(['action','roles','servicedate','parts_val','service_val','total_val','salvage_val']);


        return $datatables->make(true);

    }

    public function componentstatusfacilityGetTable(Request $request){
               //dd($request);
        $data = Session::all();

        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
            $table = Service::select('service_request.*', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_comp_details.comp_serial_no as compserial', 'gw_master_customer.name as cust')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $location)
                ->get();
        }

        if($location == '3'){
            $table = Service::select('service_request.*', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_comp_details.comp_serial_no as compserial', 'gw_master_customer.name as cust')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                //->where('service_request.location_id', '=', $location)
                ->get();
        }

        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
			    ->addColumn('servicedate', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($table->date)->format('d/m/Y');

                return $formatted_dt1;

            })
			   /*->addColumn('parts_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt2= "";

                return $formatted_dt2;

            })
			    ->addColumn('service_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt3= "";

                return $formatted_dt3;

            })*/
			    ->addColumn('total_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt4= "";

                return $formatted_dt4;

            })
			
            ->addColumn('salvage_val', function ($table) {




                $formatted_dt5 = MasterListofSalvageDis::select('salvage_value')->where('service_request_id','=',$table['id'])->get();

           //dd($formatted_dt5); 
                     $formatted_dt6="";
					 
                 if(!empty($formatted_dt5)){  
                   if(!empty($formatted_dt5[0]['salvage_value'])){
                     $formatted_dt6=$formatted_dt5[0]['salvage_value'];
				   }
				 }else{
					$formatted_dt6="";
				 }
               
                return $formatted_dt6;

            })
			

            ->rawColumns(['action','roles','servicedate','total_val','salvage_val']);


        return $datatables->make(true);
    }


     public function componentstatusfacilityGetTabledatefilter(Request $request){
               //dd($request);
        $data = Session::all();

        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');
        $locationId = $request['location'];

        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
            $table = Service::select('service_request.*', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_comp_details.comp_serial_no as compserial', 'gw_master_customer.name as cust')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $location)
                ->where('service_request.date', '>=', $startDate)
                ->where('service_request.date', '<=', $endDate)
                ->get();
        }

        if($location == '3'){
            $table = Service::select('service_request.*', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_comp_details.comp_serial_no as compserial', 'gw_master_customer.name as cust')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                //->where('service_request.location_id', '=', $location)
                ->where('service_request.date', '>=', $startDate)
                ->where('service_request.date', '<=', $endDate)
                ->get();
        }

        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
          ->addColumn('servicedate', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($table->date)->format('d/m/Y');

                return $formatted_dt1;

            })
         /*->addColumn('parts_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt2= "";

                return $formatted_dt2;

            })
          ->addColumn('service_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt3= "";

                return $formatted_dt3;

            })*/
          ->addColumn('total_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt4= "";

                return $formatted_dt4;

            })
      
            ->addColumn('salvage_val', function ($table) {




                $formatted_dt5 = MasterListofSalvageDis::select('salvage_value')->where('service_request_id','=',$table['id'])->get();

           //dd($formatted_dt5); 
                     $formatted_dt6="";
           
                 if(!empty($formatted_dt5)){  
                   if(!empty($formatted_dt5[0]['salvage_value'])){
                     $formatted_dt6=$formatted_dt5[0]['salvage_value'];
           }
         }else{
          $formatted_dt6="";
         }
               
                return $formatted_dt6;

            })
      

            ->rawColumns(['action','roles','servicedate','total_val','salvage_val']);


        return $datatables->make(true);
    }

    public function componentstatusfacilityFilter(Request $request){

        $locationId = $request['location'];
        //dd($locationId);

        if($locationId != '3') {
            $table = Service::select('service_request.*', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_comp_details.comp_serial_no as compserial', 'gw_master_customer.name as cust')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $locationId)
                ->get();
        }else{
            $table = Service::select('service_request.*', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_comp_details.comp_serial_no as compserial', 'gw_master_customer.name as cust')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                //->where('service_request.location_id', '=', $location)
                ->get();
        }
//dd($request);
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })

           ->addColumn('servicedate', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($table->date)->format('d/m/Y');

                return $formatted_dt1;

            })
         
            /*->addColumn('parts_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt2= "";

                return $formatted_dt2;

            })
			 ->addColumn('service_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt3= "";

                return $formatted_dt3;

            })*/
			 ->addColumn('total_val', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt4= "";

                return $formatted_dt4;

            })
			
           ->addColumn('salvage_val', function ($table) {




                $formatted_dt5 = MasterListofSalvageDis::select('salvage_value')->where('service_request_id','=',$table['id'])->get();

           //dd($formatted_dt5); 
                     $formatted_dt6="";
					 
                 if(!empty($formatted_dt5)){  
                   if(!empty($formatted_dt5[0]['salvage_value'])){
                     $formatted_dt6=$formatted_dt5[0]['salvage_value'];
				   }
				 }else{
					$formatted_dt6="";
				 }
               
                return $formatted_dt6;

            })
			
			

            ->rawColumns(['action','roles','servicedate','total_val','salvage_val']);


        return $datatables->make(true);

    }



    public function downloadcomponentstatus()
     {
        $data = Session::all();

        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
            $table = Service::select('service_request.*', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_comp_details.comp_serial_no as compserial', 'gw_master_customer.name as cust')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $location)
                ->get();
        }
        if($location == '3'){
            $table = Service::select('service_request.*', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_comp_details.comp_serial_no as compserial', 'gw_master_customer.name as cust')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                //->where('service_request.location_id', '=', $location)
                ->get();
        }

        $style = (new StyleBuilder())
            ->setFontBold()
            //  ->setBackgroundColor(Color::YELLOW)
            ->build();
        //$path = '/home/vhruqiyfkeq2/public_html/gcpl-quality/ComponentStatusFacility.xlsx';
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/ComponentStatusFacility.xlsx';
       // $path = "{{URL::asset('public/assets/download/ComponentStatusFacility.xlsx')}}";


        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [

                'Sr No' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],
                'CUSTOMER' => $table['cust'],
                'BRANCH' => $table['branch_name'],        
                'SEGMENT' => $table['segment'],
                'COMPONENT' => $table['component_name'],
                'COMPONENT MODEL' => $table['compmodel'],
                'COMPONENT/MC  SERIAL NO' => $table['compserial'],
                'JOB TYPE' =>$table['job_type'],
                'RECEIVE DATE' => $table['date'],
                //'PARTS VALUE( In Lacs)' => null,
               // 'SERVICE VALUE ( In Lacs)' => null,
                'Current Status' => $table['status'],
                'Remarks' => null,
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }

    //job details
    public function jobdetailslisting()
    {
        return view('admin.report.jobDetailsList');
    }

    public function jobdetailsGetTableold(Request $request)
    {
        $data = Session::all();

        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
            $table = Service::select('service_request.*', 'gw_project_plan_master.estm_days as estm_days', 'gw_project_plan_master.estm_start_date as estm_start_date', 'gw_project_plan_master.estm_end_date as estm_end_date', 'gw_master_mc_model.model_no', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_customer.name as cust')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.service_id', '=', 'service_request.id')
                ->leftjoin('gw_master_mc_model', 'gw_master_mc_model.id', '=', 'service_request.machine_modelno')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $location)
                ->orderby('created_at')
                ->get();
        }
        if($location == '3'){
            $table = Service::select('service_request.*', 'gw_project_plan_master.estm_days as estm_days', 'gw_project_plan_master.estm_start_date as estm_start_date', 'gw_project_plan_master.estm_end_date as estm_end_date', 'gw_master_mc_model.model_no', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_customer.name as cust')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.service_id', '=', 'service_request.id')
                ->leftjoin('gw_master_mc_model', 'gw_master_mc_model.id', '=', 'service_request.machine_modelno')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')

                ->orderby('created_at')
                ->get();
        }


        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
			
			->addColumn('projectstartdate', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($table->estm_start_date)->format('d/m/Y');

                return $formatted_dt1;

            })
			->addColumn('projectenddate', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt2=Carbon::parse($table->estm_end_date)->format('d/m/Y');

                return $formatted_dt2;

            })

            ->rawColumns(['action','roles','projectstartdate','projectenddate']);


        return $datatables->make(true);
    }

    public function jobdetailsFilterold(Request $request){

        $locationId = $request['location'];
        //dd($locationId);

        if($locationId != '3') {
            $table = Service::select('service_request.*', 'gw_project_plan_master.estm_days as estm_days', 'gw_project_plan_master.estm_start_date as estm_start_date', 'gw_project_plan_master.estm_end_date as estm_end_date', 'gw_master_mc_model.model_no', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_customer.name as cust')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.service_id', '=', 'service_request.id')
                ->leftjoin('gw_master_mc_model', 'gw_master_mc_model.id', '=', 'service_request.machine_modelno')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $locationId)
                ->orderby('created_at')
                ->get();
        }else{
            $table = Service::select('service_request.*', 'gw_project_plan_master.estm_days as estm_days', 'gw_project_plan_master.estm_start_date as estm_start_date', 'gw_project_plan_master.estm_end_date as estm_end_date', 'gw_master_mc_model.model_no', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_customer.name as cust')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.service_id', '=', 'service_request.id')
                ->leftjoin('gw_master_mc_model', 'gw_master_mc_model.id', '=', 'service_request.machine_modelno')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')

                ->orderby('created_at')
                ->get();
        }
//dd($request);
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
          ->addColumn('projectstartdate', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($table->estm_start_date)->format('d/m/Y');

                return $formatted_dt1;

            })
			->addColumn('projectenddate', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt2=Carbon::parse($table->estm_end_date)->format('d/m/Y');

                return $formatted_dt2;

            })

            ->rawColumns(['action','roles','projectstartdate','projectenddate']);


        return $datatables->make(true);

    }

   public function jobdetailsGetTable(Request $request)
    {
        $data = Session::all();

        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
            $table = Service::select('service_request.*', 'gw_project_plan_master.estm_days as estm_days', 'gw_project_plan_master.estm_start_date as estm_start_date', 'gw_project_plan_master.estm_end_date as estm_end_date', 'gw_master_mc_model.model_no', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_customer.name as cust')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.service_id', '=', 'service_request.id')
                ->leftjoin('gw_master_mc_model', 'gw_master_mc_model.id', '=', 'service_request.machine_modelno')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $location)
                ->orderby('created_at')
                ->get();
        }
        if($location == '3'){
            $table = Service::select('service_request.*', 'gw_project_plan_master.estm_days as estm_days', 'gw_project_plan_master.estm_start_date as estm_start_date', 'gw_project_plan_master.estm_end_date as estm_end_date', 'gw_master_mc_model.model_no', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_customer.name as cust')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.service_id', '=', 'service_request.id')
                ->leftjoin('gw_master_mc_model', 'gw_master_mc_model.id', '=', 'service_request.machine_modelno')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')

                ->orderby('created_at')
                ->get();
        }

      

        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
			
			->addColumn('projectstartdate', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($table->estm_start_date)){
                    $formatted_dt1 = Carbon::parse($table->estm_start_date)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
			->addColumn('projectenddate', function ($table) {
                if(!empty($table->estm_end_date)){
                    $formatted_dt2=Carbon::parse($table->estm_end_date)->format('d/m/Y');
                }else{
                    $formatted_dt2 = 'NULL';
                }



                return $formatted_dt2;

            })

            ->rawColumns(['action','roles','projectstartdate','projectenddate']);


        return $datatables->make(true);
    }


   public function jobdetailsGetTabledatefilter(Request $request)
    {
        $data = Session::all();

        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');
        $locationId = $request['location'];


        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
            $table = Service::select('service_request.*', 'gw_project_plan_master.estm_days as estm_days', 'gw_project_plan_master.estm_start_date as estm_start_date', 'gw_project_plan_master.estm_end_date as estm_end_date', 'gw_master_mc_model.model_no', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_customer.name as cust')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.service_id', '=', 'service_request.id')
                ->leftjoin('gw_master_mc_model', 'gw_master_mc_model.id', '=', 'service_request.machine_modelno')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $location)
                ->where('gw_project_plan_master.estm_start_date', '>=', $startDate)
                ->where('gw_project_plan_master.estm_start_date', '<=', $endDate)

                ->orderby('created_at')
                ->get();
        }
        if($location == '3'){
            $table = Service::select('service_request.*', 'gw_project_plan_master.estm_days as estm_days', 'gw_project_plan_master.estm_start_date as estm_start_date', 'gw_project_plan_master.estm_end_date as estm_end_date', 'gw_master_mc_model.model_no', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_customer.name as cust')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.service_id', '=', 'service_request.id')
                ->leftjoin('gw_master_mc_model', 'gw_master_mc_model.id', '=', 'service_request.machine_modelno')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('gw_project_plan_master.estm_start_date', '>=', $startDate)
                ->where('gw_project_plan_master.estm_start_date', '<=', $endDate)
                ->orderby('created_at')
                ->get();
        }


        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
      
      ->addColumn('projectstartdate', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($table->estm_start_date)){
                    $formatted_dt1 = Carbon::parse($table->estm_start_date)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
      ->addColumn('projectenddate', function ($table) {
                if(!empty($table->estm_end_date)){
                    $formatted_dt2=Carbon::parse($table->estm_end_date)->format('d/m/Y');
                }else{
                    $formatted_dt2 = 'NULL';
                }



                return $formatted_dt2;

            })

            ->rawColumns(['action','roles','projectstartdate','projectenddate']);


        return $datatables->make(true);
    }

    public function jobdetailsFilter(Request $request){

        $locationId = $request['location'];
        //dd($locationId);

        if($locationId != '3') {
            $table = Service::select('service_request.*', 'gw_project_plan_master.estm_days as estm_days', 'gw_project_plan_master.estm_start_date as estm_start_date', 'gw_project_plan_master.estm_end_date as estm_end_date', 'gw_master_mc_model.model_no', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_customer.name as cust')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.service_id', '=', 'service_request.id')
                ->leftjoin('gw_master_mc_model', 'gw_master_mc_model.id', '=', 'service_request.machine_modelno')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $locationId)
                ->orderby('created_at')
                ->get();
        }else{
            $table = Service::select('service_request.*', 'gw_project_plan_master.estm_days as estm_days', 'gw_project_plan_master.estm_start_date as estm_start_date', 'gw_project_plan_master.estm_end_date as estm_end_date', 'gw_master_mc_model.model_no', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_customer.name as cust')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.service_id', '=', 'service_request.id')
                ->leftjoin('gw_master_mc_model', 'gw_master_mc_model.id', '=', 'service_request.machine_modelno')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')

                ->orderby('created_at')
                ->get();
        }

//dd($request);
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
            ->addColumn('projectstartdate', function ($table) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($table->estm_start_date)){
                    $formatted_dt1 = Carbon::parse($table->estm_start_date)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('projectenddate', function ($table) {
                if(!empty($table->estm_end_date)){
                    $formatted_dt2=Carbon::parse($table->estm_end_date)->format('d/m/Y');
                }else{
                    $formatted_dt2 = 'NULL';
                }



                return $formatted_dt2;

            })

            ->rawColumns(['action','roles','projectstartdate','projectenddate']);


        return $datatables->make(true);

    }   
	

   public function downloadjobdetails(Request $request)
    {



        $data = Session::all();
        $startDate = $endDate ='';
        if($request['startdate'] !='')
        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        if($request['enddate'] !='')
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');

        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
            $table = Service::select('service_request.*', 'gw_project_plan_master.estm_days as estm_days', 'gw_project_plan_master.estm_start_date as estm_start_date', 'gw_project_plan_master.estm_end_date as estm_end_date', 'gw_master_mc_model.model_no', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_customer.name as cust')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.service_id', '=', 'service_request.id')
                ->leftjoin('gw_master_mc_model', 'gw_master_mc_model.id', '=', 'service_request.machine_modelno')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $location)
                ->when($startDate, function ($query) use ($startDate) {
                    return $query->where('gw_project_plan_master.estm_start_date', '>=', $startDate);
                })

                ->when($endDate, function ($query) use ($endDate) {
                    return $query->where('gw_project_plan_master.estm_start_date', '<=', $endDate);
                })

                ->orderby('created_at')
                ->get();
        }
        if($location == '3'){
            $table = Service::select('service_request.*', 'gw_project_plan_master.estm_days as estm_days', 'gw_project_plan_master.estm_start_date as estm_start_date', 'gw_project_plan_master.estm_end_date as estm_end_date', 'gw_master_mc_model.model_no', 'gw_master_comp_details.comp_model_no as compmodel', 'gw_master_customer.name as cust')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.service_id', '=', 'service_request.id')
                ->leftjoin('gw_master_mc_model', 'gw_master_mc_model.id', '=', 'service_request.machine_modelno')
                ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.comp_model_no')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->when($startDate, function ($query) use ($startDate) {
                    return $query->where('gw_project_plan_master.estm_start_date', '>=', $startDate);
                })

                ->when($endDate, function ($query) use ($endDate) {
                    return $query->where('gw_project_plan_master.estm_start_date', '<=', $endDate);
                })

                ->orderby('created_at')
                ->get();
        }

        $style = (new StyleBuilder())
            ->setFontBold()
            //  ->setBackgroundColor(Color::YELLOW)
            ->build();
        //$path = '/home/vhruqiyfkeq2/public_html/gcpl-quality/Jobdetails.xlsx';
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/Jobdetails.xlsx';
        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [

                'Sr No' => $table['service_request_no'],
                'WO No' => $table['work_orderno'],
                'Customer' => $table['cust'],

                'Component' => $table['compmodel'],
                'SR No' => $table['service_request_no'],
                'Arr No' => $table['ar_no'],
                'Machine Model' => $table['model_no'],
                'Total Hours' => $table['estm_days'],
                'Starts Date' => $table['estm_start_date'],
                'Completion Date' =>$table['estm_end_date'],
//                'Day 1' => null,
//                'Day 2' => null,
//                'Day 3' => null,
//                'Day 4' => null,
//                'Day 5' => null,
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }

//Men Power
    public function menPowerlisting()
    {
        return view('admin.report.menPowerList');
    }

    public function menPowerGetTable(Request $request)
    {
        $data = Session::all();

        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
            $table = User::select('users.*', 'gw_master_department.name as dept', 'gw_master_location.description as description')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'users.location_id')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'users.section_id')
                ->where('users.location_id', '=', $location)
                ->get();
        }
        if($location == '3'){
            $table = User::select('users.*', 'gw_master_department.name as dept', 'gw_master_location.description as description')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'users.location_id')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'users.section_id')

                ->get();
        }


        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })

            ->rawColumns(['action','roles']);


        return $datatables->make(true);
    }

    public function menPowerFilter(Request $request){

        $locationId = $request['location'];
        //dd($locationId);

        if($locationId != '3') {
            $table = User::select('users.*', 'gw_master_department.name as dept', 'gw_master_location.description as description')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'users.location_id')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'users.section_id')
                ->where('users.location_id', '=', $locationId)
                ->get();
        }else{
            $table = User::select('users.*', 'gw_master_department.name as dept', 'gw_master_location.description as description')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'users.location_id')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'users.section_id')

                ->get();
        }
//dd($request);
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })

            ->rawColumns(['action','roles']);


        return $datatables->make(true);

    }



    public function downloadmenPower()
    {

        $data = Session::all();
        $location=$data['user']['location_id'];
        
        if($location == '1' || $location == '2') {
            $table = User::select('users.*', 'gw_master_department.name as dept', 'gw_master_location.description as description')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'users.location_id')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'users.section_id')
                ->where('users.location_id', '=', $location)
                ->get();
        }
        if($location == '3'){
            $table = User::select('users.*', 'gw_master_department.name as dept', 'gw_master_location.description as description')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'users.location_id')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'users.section_id')

                ->get();
        }

        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/MenPower.xlsx';
        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [

//                'id' => $table['id'],
                'Plant Desc' => $table['description'],
                'Employee Name' => $table['name'],
                'Partner Type' => $table['dept'],
                'Employee Code' => $table['emp_code'],

            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }

//Workorder details
    public function workorderlisting()
    {
        return view('admin.report.workorderDetailsList');
    }

    public function workorderGetTableold(Request $request)
    {

       /* select s.project_id,s.dept_id,s.task_name,c.workorder,sr.po_date,sr.checkgate1_actual_end_date,sum(case when task_name = ' Disassembly' then actual_strt_dt end),sum(case when task_name = ' Disassembly' then end_dt end),sum(case when task_name = 'Engine Assembly Check sheet' then actual_strt_dt end),sum(case when task_name = 'Engine Assembly Check sheet' then end_dt end),sum(case when task_name = 'Testing' then actual_strt_dt end) from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno group by s.project_id , s.dept_id;*/

        $data = Session::all();

        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
    $results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,sr.quotation_date,c.workorder,dp.name as dept,  (case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, (case when task_name = ' Disassembly' then end_dt end) as DissEndDate, (case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, (case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, (case when task_name = 'Testing' then end_dt end) as TestingEndDate,(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, (case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, (case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $location  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date"));

   }
        if($location == '3') {
            $results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,sr.quotation_date,c.workorder,dp.name as dept,  (case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, (case when task_name = ' Disassembly' then end_dt end) as DissEndDate, (case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, (case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, (case when task_name = 'Testing' then end_dt end) as TestingEndDate,(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, (case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, (case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_department dp ON s.dept_id = dp.id  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date"));
        }
        //,'Y-m-d' )
        $datatables =  Datatables::of($results)
		
		    ->addColumn('podate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $po_dat=Carbon::parse($results->po_date)->format('d/m/Y');

                return $po_dat;

            })
			
			 ->addColumn('quotationdate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $qo_dat=Carbon::parse($results->quotation_date)->format('d/m/Y');

                return $qo_dat;

            })

            ->addColumn('dissstartdate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissStartDate)->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('dissenddate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissEndDate)->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('storeenddate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->StoreEndDate)->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('assystartdate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyStartDate)->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('assyenddate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyEndDate)->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('testingstartdate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingStartDate)->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('testingenddate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingEndDate)->format('d/m/Y');

                return $formatted_dt1;

            })


         ->addColumn('tat', function ($results) {
             //dd( $results->DissStartDate);
              //dd( $table['end_dt']);
               //$dissstartdate= $startdate['actual_strt_dt'];

              $formatted_dt1=Carbon::parse($results->DissStartDate);
              $formatted_dt2=Carbon::parse($results->DissEndDate);



              if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                  $diff = 0; // or throw new \InvalidArgumentException();
              } else {
                  $diff = $formatted_dt1->diffInDays($formatted_dt2);;
              }


              return $diff;

            })
            ->addColumn('disstoquotation_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissEndDate);
                $formatted_dt2=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;



                return $diff1;

            })
            ->addColumn('quotationtostore_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->quotation_date);
                $formatted_dt2=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff2;

            })
            ->addColumn('assy_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyStartDate);
                $formatted_dt2=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff3;

            })
            ->addColumn('testing_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingStartDate);
                $formatted_dt2=Carbon::parse($results->TestingEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff4 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff4 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff4;

            })
            ->addColumn('assytotesting_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyEndDate);
                $formatted_dt2=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff5;

            })
            ->addColumn('testingtodispatch_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingEndDate);
                $formatted_dt2=Carbon::parse($results->DispatchStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff6;

            })
            ->addColumn('crc_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
            $crc_cycle= $diff + $diff1 + $diff3 + $diff5;
                return $crc_cycle;

            })
            ->addColumn('total_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $formatted_dt9=Carbon::parse($results->quotation_date);
                $formatted_dt10=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt9) || is_null($formatted_dt10)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt9->diffInDays($formatted_dt10);;
                }

                $formatted_dt11=Carbon::parse($results->TestingEndDate);
                $formatted_dt12=Carbon::parse($results->DispatchStartDate);

                if (is_null($formatted_dt11) || is_null($formatted_dt12)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt11->diffInDays($formatted_dt12);;
                }

            $total_cycle= $diff + $diff1 + $diff2 + $diff3 +  $diff5 + $diff6 ;
                return $total_cycle;

            })

               /* $loc_name= UserHelper::locationfind($table['location_id']);
              //dd($loc_name[0]['description']);die;



                    return $loc_name[0]['description'];

            })
            ->addColumn('project', function ($table) {
                $projectval='';
                if(!empty($table['work_orderno'])){
                    $project = UserHelper::projectfind($table['work_orderno']);
                }
                if(!empty($project[0]['project_id'])){
                    $projectval = $project[0]['project_id'];
                }



                return $projectval;

            })

            ->addColumn('dissstartdate', function ($table) {
                $startdate='';
                $projectval='';
                if(!empty($table['work_orderno'])){
                    $project = UserHelper::projectfind($table['work_orderno']);
                }
                if(!empty($project[0]['project_id'])){
                    $projectval = $project[0]['project_id'];
                }
                if(!empty($projectval)) {
                    $startdate = UserHelper::taskdissstartdate($projectval);
                }
                //dd($startdate);die;
                if(!empty($startdate)) {
                    foreach ($startdate as $key => $val) {

                        $dept = $val['dept_id'];

                        $section = UserHelper::sectionfind($dept);

                    }
                }

                return $section;*/

            ->rawColumns(['podate','quotationdate','tat','disstoquotation_tat','quotationtostore_tat','assy_tat','testing_tat','assytotesting_tat','testingtodispatch_tat','crc_cycle','total_cycle','dissstartdate','dissenddate','storeenddate','assystartdate','assyenddate','testingstartdate','testingenddate']);


        return $datatables->make(true);
    }

    public function workorderFilterold(Request $request)
    {
        $locationId = $request['location'];


        if($locationId != '3') {
            $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,sr.quotation_date,c.workorder,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $locationId  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date"));

        }
        else {
            $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,sr.quotation_date,c.workorder,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_department dp ON s.dept_id = dp.id  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date"));
        }
        //,'Y-m-d' )
        $datatables =  Datatables::of($results)

               ->addColumn('podate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $po_dat=Carbon::parse($results->po_date)->format('d/m/Y');

                return $po_dat;

            })
			
			 ->addColumn('quotationdate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $qo_dat=Carbon::parse($results->quotation_date)->format('d/m/Y');

                return $qo_dat;

            })
        
            ->addColumn('dissstartdate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissStartDate)->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('dissenddate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissEndDate)->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('storeenddate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->StoreEndDate)->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('assystartdate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyStartDate)->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('assyenddate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyEndDate)->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('testingstartdate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingStartDate)->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('testingenddate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingEndDate)->format('d/m/Y');

                return $formatted_dt1;

            })


            ->addColumn('tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }


                return $diff;

            })
            ->addColumn('disstoquotation_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissEndDate);
                $formatted_dt2=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;



                return $diff1;

            })
            ->addColumn('quotationtostore_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->quotation_date);
                $formatted_dt2=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff2;

            })
            ->addColumn('assy_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyStartDate);
                $formatted_dt2=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff3;

            })
            ->addColumn('testing_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingStartDate);
                $formatted_dt2=Carbon::parse($results->TestingEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff4 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff4 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff4;

            })
            ->addColumn('assytotesting_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyEndDate);
                $formatted_dt2=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff5;

            })
            ->addColumn('testingtodispatch_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingEndDate);
                $formatted_dt2=Carbon::parse($results->DispatchStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff6;

            })
            ->addColumn('crc_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $crc_cycle= $diff + $diff1 + $diff3 + $diff5;
                return $crc_cycle;

            })
            ->addColumn('total_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $formatted_dt9=Carbon::parse($results->quotation_date);
                $formatted_dt10=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt9) || is_null($formatted_dt10)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt9->diffInDays($formatted_dt10);;
                }

                $formatted_dt11=Carbon::parse($results->TestingEndDate);
                $formatted_dt12=Carbon::parse($results->DispatchStartDate);

                if (is_null($formatted_dt11) || is_null($formatted_dt12)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt11->diffInDays($formatted_dt12);;
                }

                $total_cycle= $diff + $diff1 + $diff2 + $diff3 +  $diff5 + $diff6 ;
                return $total_cycle;

            })

            /* $loc_name= UserHelper::locationfind($table['location_id']);
           //dd($loc_name[0]['description']);die;



                 return $loc_name[0]['description'];

         })
         ->addColumn('project', function ($table) {
             $projectval='';
             if(!empty($table['work_orderno'])){
                 $project = UserHelper::projectfind($table['work_orderno']);
             }
             if(!empty($project[0]['project_id'])){
                 $projectval = $project[0]['project_id'];
             }



             return $projectval;

         })

         ->addColumn('dissstartdate', function ($table) {
             $startdate='';
             $projectval='';
             if(!empty($table['work_orderno'])){
                 $project = UserHelper::projectfind($table['work_orderno']);
             }
             if(!empty($project[0]['project_id'])){
                 $projectval = $project[0]['project_id'];
             }
             if(!empty($projectval)) {
                 $startdate = UserHelper::taskdissstartdate($projectval);
             }
             //dd($startdate);die;
             if(!empty($startdate)) {
                 foreach ($startdate as $key => $val) {

                     $dept = $val['dept_id'];

                     $section = UserHelper::sectionfind($dept);

                 }
             }

             return $section;*/

            ->rawColumns(['podate','quotationdate','tat','disstoquotation_tat','quotationtostore_tat','assy_tat','testing_tat','assytotesting_tat','testingtodispatch_tat','crc_cycle','total_cycle','dissstartdate','dissenddate','storeenddate','assystartdate','assyenddate','testingstartdate','testingenddate']);


        return $datatables->make(true);
    }
  
public function workorderGetTableold1(Request $request)
    {

       /* select s.project_id,s.dept_id,s.task_name,c.workorder,sr.po_date,sr.checkgate1_actual_end_date,sum(case when task_name = ' Disassembly' then actual_strt_dt end),sum(case when task_name = ' Disassembly' then end_dt end),sum(case when task_name = 'Engine Assembly Check sheet' then actual_strt_dt end),sum(case when task_name = 'Engine Assembly Check sheet' then end_dt end),sum(case when task_name = 'Testing' then actual_strt_dt end) from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno group by s.project_id , s.dept_id;*/

        $data = Session::all();

        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
    $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,sr.quotation_date,c.workorder,sr.description,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $location  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description"));

   }
        if($location == '3') {
            $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,sr.quotation_date,c.workorder,sr.description,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_department dp ON s.dept_id = dp.id  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description"));
        }
        //,'Y-m-d' )
        $datatables =  Datatables::of($results)
		
		    ->addColumn('podate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                    if(!empty($results->po_date)){
                        $po_dat=Carbon::parse($results->po_date)->format('d/m/Y');
                    }else{
                        $po_dat = 'NULL';
                    }


                return $po_dat;

            })
			
			 ->addColumn('quotationdate', function ($results) {

                 if(!empty($results->quotation_date)){
                     $qo_dat=Carbon::parse($results->quotation_date)->format('d/m/Y');
                 }else{
                     $qo_dat = 'NULL';
                 }


                return $qo_dat;

            })

            ->addColumn('dissstartdate', function ($results) {

                if(!empty($results->DissStartDate)){
                    $formatted_dt1=Carbon::parse($results->DissStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('dissenddate', function ($results) {

                if(!empty($results->DissEndDate)){
                    $formatted_dt1=Carbon::parse($results->DissEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('storeenddate', function ($results) {
                if(!empty($results->StoreEndDate)){
                    $formatted_dt1=Carbon::parse($results->StoreEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assystartdate', function ($results) {
                if(!empty($results->AssyStartDate)){
                    $formatted_dt1=Carbon::parse($results->AssyStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assyenddate', function ($results) {
                if(!empty($results->AssyEndDate)){
                    $formatted_dt1=Carbon::parse($results->AssyEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingstartdate', function ($results) {
                if(!empty($results->TestingStartDate)){
                    $formatted_dt1=Carbon::parse($results->TestingStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingenddate', function ($results) {
                if(!empty($results->TestingEndDate)){
                    $formatted_dt1=Carbon::parse($results->TestingEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })


         ->addColumn('tat', function ($results) {
             //dd( $results->DissStartDate);
              //dd( $table['end_dt']);
               //$dissstartdate= $startdate['actual_strt_dt'];

              $formatted_dt1=Carbon::parse($results->DissStartDate);
              $formatted_dt2=Carbon::parse($results->DissEndDate);



              if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                  $diff = 0; // or throw new \InvalidArgumentException();
              } else {
                  $diff = $formatted_dt1->diffInDays($formatted_dt2);;
              }


              return $diff;

            })
            ->addColumn('disstoquotation_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissEndDate);
                $formatted_dt2=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;



                return $diff1;

            })
            ->addColumn('quotationtostore_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->quotation_date);
                $formatted_dt2=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff2;

            })
            ->addColumn('assy_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyStartDate);
                $formatted_dt2=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff3;

            })
            ->addColumn('testing_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingStartDate);
                $formatted_dt2=Carbon::parse($results->TestingEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff4 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff4 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff4;

            })
            ->addColumn('assytotesting_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyEndDate);
                $formatted_dt2=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff5;

            })
            ->addColumn('testingtodispatch_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingEndDate);
                $formatted_dt2=Carbon::parse($results->DispatchStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff6;

            })
            ->addColumn('crc_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
            $crc_cycle= $diff + $diff1 + $diff3 + $diff5;
                return $crc_cycle;

            })
            ->addColumn('total_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $formatted_dt9=Carbon::parse($results->quotation_date);
                $formatted_dt10=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt9) || is_null($formatted_dt10)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt9->diffInDays($formatted_dt10);;
                }

                $formatted_dt11=Carbon::parse($results->TestingEndDate);
                $formatted_dt12=Carbon::parse($results->DispatchStartDate);

                if (is_null($formatted_dt11) || is_null($formatted_dt12)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt11->diffInDays($formatted_dt12);;
                }

            $total_cycle= $diff + $diff1 + $diff2 + $diff3 +  $diff5 + $diff6 ;
                return $total_cycle;

            })

               /* $loc_name= UserHelper::locationfind($table['location_id']);
              //dd($loc_name[0]['description']);die;



                    return $loc_name[0]['description'];

            })
            ->addColumn('project', function ($table) {
                $projectval='';
                if(!empty($table['work_orderno'])){
                    $project = UserHelper::projectfind($table['work_orderno']);
                }
                if(!empty($project[0]['project_id'])){
                    $projectval = $project[0]['project_id'];
                }



                return $projectval;

            })

            ->addColumn('dissstartdate', function ($table) {
                $startdate='';
                $projectval='';
                if(!empty($table['work_orderno'])){
                    $project = UserHelper::projectfind($table['work_orderno']);
                }
                if(!empty($project[0]['project_id'])){
                    $projectval = $project[0]['project_id'];
                }
                if(!empty($projectval)) {
                    $startdate = UserHelper::taskdissstartdate($projectval);
                }
                //dd($startdate);die;
                if(!empty($startdate)) {
                    foreach ($startdate as $key => $val) {

                        $dept = $val['dept_id'];

                        $section = UserHelper::sectionfind($dept);

                    }
                }

                return $section;*/

            ->rawColumns(['podate','quotationdate','tat','disstoquotation_tat','quotationtostore_tat','assy_tat','testing_tat','assytotesting_tat','testingtodispatch_tat','crc_cycle','total_cycle','dissstartdate','dissenddate','storeenddate','assystartdate','assyenddate','testingstartdate','testingenddate']);


        return $datatables->make(true);
    }

    public function workorderFilterold1(Request $request)
    {
        $locationId = $request['location'];


        if($locationId != '3') {
            $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,sr.quotation_date,c.workorder,sr.description,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $locationId  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description"));

        }
        else {
            $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,sr.quotation_date,c.workorder,sr.description,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_department dp ON s.dept_id = dp.id  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description"));
        }
        //,'Y-m-d' )
        $datatables =  Datatables::of($results)

            ->addColumn('podate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->po_date)){
                    $po_dat=Carbon::parse($results->po_date)->format('d/m/Y');
                }else{
                    $po_dat = 'NULL';
                }


                return $po_dat;

            })

            ->addColumn('quotationdate', function ($results) {

                if(!empty($results->quotation_date)){
                    $qo_dat=Carbon::parse($results->quotation_date)->format('d/m/Y');
                }else{
                    $qo_dat = 'NULL';
                }


                return $qo_dat;

            })

            ->addColumn('dissstartdate', function ($results) {

                if(!empty($results->DissStartDate)){
                    $formatted_dt1=Carbon::parse($results->DissStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('dissenddate', function ($results) {

                if(!empty($results->DissEndDate)){
                    $formatted_dt1=Carbon::parse($results->DissEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('storeenddate', function ($results) {
                if(!empty($results->StoreEndDate)){
                    $formatted_dt1=Carbon::parse($results->StoreEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assystartdate', function ($results) {
                if(!empty($results->AssyStartDate)){
                    $formatted_dt1=Carbon::parse($results->AssyStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assyenddate', function ($results) {
                if(!empty($results->AssyEndDate)){
                    $formatted_dt1=Carbon::parse($results->AssyEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingstartdate', function ($results) {
                if(!empty($results->TestingStartDate)){
                    $formatted_dt1=Carbon::parse($results->TestingStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingenddate', function ($results) {
                if(!empty($results->TestingEndDate)){
                    $formatted_dt1=Carbon::parse($results->TestingEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })


            ->addColumn('tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }


                return $diff;

            })
            ->addColumn('disstoquotation_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissEndDate);
                $formatted_dt2=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;



                return $diff1;

            })
            ->addColumn('quotationtostore_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->quotation_date);
                $formatted_dt2=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff2;

            })
            ->addColumn('assy_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyStartDate);
                $formatted_dt2=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff3;

            })
            ->addColumn('testing_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingStartDate);
                $formatted_dt2=Carbon::parse($results->TestingEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff4 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff4 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff4;

            })
            ->addColumn('assytotesting_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyEndDate);
                $formatted_dt2=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff5;

            })
            ->addColumn('testingtodispatch_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingEndDate);
                $formatted_dt2=Carbon::parse($results->DispatchStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff6;

            })
            ->addColumn('crc_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $crc_cycle= $diff + $diff1 + $diff3 + $diff5;
                return $crc_cycle;

            })
            ->addColumn('total_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $formatted_dt9=Carbon::parse($results->quotation_date);
                $formatted_dt10=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt9) || is_null($formatted_dt10)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt9->diffInDays($formatted_dt10);;
                }

                $formatted_dt11=Carbon::parse($results->TestingEndDate);
                $formatted_dt12=Carbon::parse($results->DispatchStartDate);

                if (is_null($formatted_dt11) || is_null($formatted_dt12)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt11->diffInDays($formatted_dt12);;
                }

                $total_cycle= $diff + $diff1 + $diff2 + $diff3 +  $diff5 + $diff6 ;
                return $total_cycle;

            })

            /* $loc_name= UserHelper::locationfind($table['location_id']);
           //dd($loc_name[0]['description']);die;



                 return $loc_name[0]['description'];

         })
         ->addColumn('project', function ($table) {
             $projectval='';
             if(!empty($table['work_orderno'])){
                 $project = UserHelper::projectfind($table['work_orderno']);
             }
             if(!empty($project[0]['project_id'])){
                 $projectval = $project[0]['project_id'];
             }



             return $projectval;

         })

         ->addColumn('dissstartdate', function ($table) {
             $startdate='';
             $projectval='';
             if(!empty($table['work_orderno'])){
                 $project = UserHelper::projectfind($table['work_orderno']);
             }
             if(!empty($project[0]['project_id'])){
                 $projectval = $project[0]['project_id'];
             }
             if(!empty($projectval)) {
                 $startdate = UserHelper::taskdissstartdate($projectval);
             }
             //dd($startdate);die;
             if(!empty($startdate)) {
                 foreach ($startdate as $key => $val) {

                     $dept = $val['dept_id'];

                     $section = UserHelper::sectionfind($dept);

                 }
             }

             return $section;*/

            ->rawColumns(['podate','quotationdate','tat','disstoquotation_tat','quotationtostore_tat','assy_tat','testing_tat','assytotesting_tat','testingtodispatch_tat','crc_cycle','total_cycle','dissstartdate','dissenddate','storeenddate','assystartdate','assyenddate','testingstartdate','testingenddate']);


        return $datatables->make(true);
    }    

 public function workorderGetTable_old(Request $request)
    {

       /* select s.project_id,s.dept_id,s.task_name,c.workorder,sr.po_date,sr.checkgate1_actual_end_date,sum(case when task_name = ' Disassembly' then actual_strt_dt end),sum(case when task_name = ' Disassembly' then end_dt end),sum(case when task_name = 'Engine Assembly Check sheet' then actual_strt_dt end),sum(case when task_name = 'Engine Assembly Check sheet' then end_dt end),sum(case when task_name = 'Testing' then actual_strt_dt end) from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id group by s.project_id , s.dept_id;*/

        $data = Session::all();

        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
    /*$results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,sr.quotation_date,c.workorder,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $location  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date"));*/

            $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id  where sr.location_id = $location  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date"));
//dd($results);
   }
        if($location == '3') {
            $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date"));
        }
        //,'Y-m-d' )
        $datatables =  Datatables::of($results)

            ->addColumn('estistart_date', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->estm_start_date)){
                    $esti_start=Carbon::parse($results->estm_start_date)->format('d/m/Y');
                }else{
                    $esti_start = 'NULL';
                }


                return $esti_start;

            })

            ->addColumn('estiend_date', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->estm_end_date)){
                    $esti_end=Carbon::parse($results->estm_end_date)->format('d/m/Y');
                }else{
                    $esti_end = 'NULL';
                }


                return $esti_end;

            })
		
		    ->addColumn('podate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                    if(!empty($results->po_date)){
                        $po_dat=Carbon::parse($results->po_date)->format('d/m/Y');
                    }else{
                        $po_dat = 'NULL';
                    }


                return $po_dat;

            })
			
			 ->addColumn('quotationdate', function ($results) {

                 if(!empty($results->quotation_date)){
                     $qo_dat=Carbon::parse($results->quotation_date)->format('d/m/Y');
                 }else{
                     $qo_dat = 'NULL';
                 }


                return $qo_dat;

            })

            ->addColumn('dissstartdate', function ($results) {

                if(!empty($results->DissStartDate)){
                    $formatted_dt1=Carbon::parse($results->DissStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('dissenddate', function ($results) {

                if(!empty($results->DissEndDate)){
                    $formatted_dt1=Carbon::parse($results->DissEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('storeenddate', function ($results) {
                if(!empty($results->StoreEndDate)){
                    $formatted_dt1=Carbon::parse($results->StoreEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assystartdate', function ($results) {
                if(!empty($results->AssyStartDate)){
                    $formatted_dt1=Carbon::parse($results->AssyStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assyenddate', function ($results) {
                if(!empty($results->AssyEndDate)){
                    $formatted_dt1=Carbon::parse($results->AssyEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingstartdate', function ($results) {
                if(!empty($results->TestingStartDate)){
                    $formatted_dt1=Carbon::parse($results->TestingStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingenddate', function ($results) {
                if(!empty($results->TestingEndDate)){
                    $formatted_dt1=Carbon::parse($results->TestingEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })


         ->addColumn('tat', function ($results) {
             //dd( $results->DissStartDate);
              //dd( $table['end_dt']);
               //$dissstartdate= $startdate['actual_strt_dt'];

              $formatted_dt1=Carbon::parse($results->DissStartDate);
              $formatted_dt2=Carbon::parse($results->DissEndDate);



              if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                  $diff = 0; // or throw new \InvalidArgumentException();
              } else {
                  $diff = $formatted_dt1->diffInDays($formatted_dt2);;
              }


              return $diff;

            })
            ->addColumn('disstoquotation_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissEndDate);
                $formatted_dt2=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;



                return $diff1;

            })
            ->addColumn('quotationtostore_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->quotation_date);
                $formatted_dt2=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff2;

            })
            ->addColumn('assy_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyStartDate);
                $formatted_dt2=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff3;

            })
            ->addColumn('testing_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingStartDate);
                $formatted_dt2=Carbon::parse($results->TestingEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff4 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff4 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff4;

            })
            ->addColumn('assytotesting_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyEndDate);
                $formatted_dt2=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff5;

            })
            ->addColumn('testingtodispatch_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingEndDate);
                $formatted_dt2=Carbon::parse($results->DispatchStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff6;

            })
            ->addColumn('crc_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
            $crc_cycle= $diff + $diff1 + $diff3 + $diff5;
                return $crc_cycle;

            })
            ->addColumn('total_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $formatted_dt9=Carbon::parse($results->quotation_date);
                $formatted_dt10=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt9) || is_null($formatted_dt10)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt9->diffInDays($formatted_dt10);;
                }

                $formatted_dt11=Carbon::parse($results->TestingEndDate);
                $formatted_dt12=Carbon::parse($results->DispatchStartDate);

                if (is_null($formatted_dt11) || is_null($formatted_dt12)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt11->diffInDays($formatted_dt12);;
                }

            $total_cycle= $diff + $diff1 + $diff2 + $diff3 +  $diff5 + $diff6 ;
                return $total_cycle;

            })

               /* $loc_name= UserHelper::locationfind($table['location_id']);
              //dd($loc_name[0]['description']);die;



                    return $loc_name[0]['description'];

            })
            ->addColumn('project', function ($table) {
                $projectval='';
                if(!empty($table['work_orderno'])){
                    $project = UserHelper::projectfind($table['work_orderno']);
                }
                if(!empty($project[0]['project_id'])){
                    $projectval = $project[0]['project_id'];
                }



                return $projectval;

            })

            ->addColumn('dissstartdate', function ($table) {
                $startdate='';
                $projectval='';
                if(!empty($table['work_orderno'])){
                    $project = UserHelper::projectfind($table['work_orderno']);
                }
                if(!empty($project[0]['project_id'])){
                    $projectval = $project[0]['project_id'];
                }
                if(!empty($projectval)) {
                    $startdate = UserHelper::taskdissstartdate($projectval);
                }
                //dd($startdate);die;
                if(!empty($startdate)) {
                    foreach ($startdate as $key => $val) {

                        $dept = $val['dept_id'];

                        $section = UserHelper::sectionfind($dept);

                    }
                }

                return $section;*/

            ->rawColumns(['podate','estistart_date','estiend_date','quotationdate','tat','disstoquotation_tat','quotationtostore_tat','assy_tat','testing_tat','assytotesting_tat','testingtodispatch_tat','crc_cycle','total_cycle','dissstartdate','dissenddate','storeenddate','assystartdate','assyenddate','testingstartdate','testingenddate']);


        return $datatables->make(true);
    }

    public function workorderFilter_old(Request $request)
    {
        $locationId = $request['location'];

        $myrequest=$request->all();
        //dd($myrequest);

        if($locationId != '3') {
            $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $locationId  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date"));

        }
        else {
            $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date"));
        }
        //,'Y-m-d' )
        $datatables =  Datatables::of($results)

            ->addColumn('estistart_date', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->estm_start_date)){
                    $esti_start=Carbon::parse($results->estm_start_date)->format('d/m/Y');
                }else{
                    $esti_start = 'NULL';
                }


                return $esti_start;

            })

            ->addColumn('estiend_date', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->estm_end_date)){
                    $esti_end=Carbon::parse($results->estm_end_date)->format('d/m/Y');
                }else{
                    $esti_end = 'NULL';
                }


                return $esti_end;

            })

            ->addColumn('podate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->po_date)){
                    $po_dat=Carbon::parse($results->po_date)->format('d/m/Y');
                }else{
                    $po_dat = 'NULL';
                }


                return $po_dat;

            })

            ->addColumn('quotationdate', function ($results) {

                if(!empty($results->quotation_date)){
                    $qo_dat=Carbon::parse($results->quotation_date)->format('d/m/Y');
                }else{
                    $qo_dat = 'NULL';
                }


                return $qo_dat;

            })

            ->addColumn('dissstartdate', function ($results) {

                if(!empty($results->DissStartDate)){
                    $formatted_dt1=Carbon::parse($results->DissStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('dissenddate', function ($results) {

                if(!empty($results->DissEndDate)){
                    $formatted_dt1=Carbon::parse($results->DissEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('storeenddate', function ($results) {
                if(!empty($results->StoreEndDate)){
                    $formatted_dt1=Carbon::parse($results->StoreEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assystartdate', function ($results) {
                if(!empty($results->AssyStartDate)){
                    $formatted_dt1=Carbon::parse($results->AssyStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assyenddate', function ($results) {
                if(!empty($results->AssyEndDate)){
                    $formatted_dt1=Carbon::parse($results->AssyEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingstartdate', function ($results) {
                if(!empty($results->TestingStartDate)){
                    $formatted_dt1=Carbon::parse($results->TestingStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingenddate', function ($results) {
                if(!empty($results->TestingEndDate)){
                    $formatted_dt1=Carbon::parse($results->TestingEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })


            ->addColumn('tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }


                return $diff;

            })
            ->addColumn('disstoquotation_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissEndDate);
                $formatted_dt2=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;



                return $diff1;

            })
            ->addColumn('quotationtostore_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->quotation_date);
                $formatted_dt2=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff2;

            })
            ->addColumn('assy_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyStartDate);
                $formatted_dt2=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff3;

            })
            ->addColumn('testing_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingStartDate);
                $formatted_dt2=Carbon::parse($results->TestingEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff4 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff4 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff4;

            })
            ->addColumn('assytotesting_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyEndDate);
                $formatted_dt2=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff5;

            })
            ->addColumn('testingtodispatch_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingEndDate);
                $formatted_dt2=Carbon::parse($results->DispatchStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff6;

            })
            ->addColumn('crc_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $crc_cycle= $diff + $diff1 + $diff3 + $diff5;
                return $crc_cycle;

            })
            ->addColumn('total_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $formatted_dt9=Carbon::parse($results->quotation_date);
                $formatted_dt10=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt9) || is_null($formatted_dt10)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt9->diffInDays($formatted_dt10);;
                }

                $formatted_dt11=Carbon::parse($results->TestingEndDate);
                $formatted_dt12=Carbon::parse($results->DispatchStartDate);

                if (is_null($formatted_dt11) || is_null($formatted_dt12)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt11->diffInDays($formatted_dt12);;
                }

                $total_cycle= $diff + $diff1 + $diff2 + $diff3 +  $diff5 + $diff6 ;
                return $total_cycle;

            })

            /* $loc_name= UserHelper::locationfind($table['location_id']);
           //dd($loc_name[0]['description']);die;



                 return $loc_name[0]['description'];

         })
         ->addColumn('project', function ($table) {
             $projectval='';
             if(!empty($table['work_orderno'])){
                 $project = UserHelper::projectfind($table['work_orderno']);
             }
             if(!empty($project[0]['project_id'])){
                 $projectval = $project[0]['project_id'];
             }



             return $projectval;

         })

         ->addColumn('dissstartdate', function ($table) {
             $startdate='';
             $projectval='';
             if(!empty($table['work_orderno'])){
                 $project = UserHelper::projectfind($table['work_orderno']);
             }
             if(!empty($project[0]['project_id'])){
                 $projectval = $project[0]['project_id'];
             }
             if(!empty($projectval)) {
                 $startdate = UserHelper::taskdissstartdate($projectval);
             }
             //dd($startdate);die;
             if(!empty($startdate)) {
                 foreach ($startdate as $key => $val) {

                     $dept = $val['dept_id'];

                     $section = UserHelper::sectionfind($dept);

                 }
             }

             return $section;*/

            ->rawColumns(['podate','estistart_date','estiend_date','quotationdate','tat','disstoquotation_tat','quotationtostore_tat','assy_tat','testing_tat','assytotesting_tat','testingtodispatch_tat','crc_cycle','total_cycle','dissstartdate','dissenddate','storeenddate','assystartdate','assyenddate','testingstartdate','testingenddate']);


        return $datatables->make(true);
    }

    public function workorderDateFilter_old(Request $request)
    {
        $myrequest=$request->all();
   //dd($myrequest);

        $locationId = $request['location'];
        $data = Session::all();

        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];


        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');
        //dd($request['startdate']);exit;
        if(!empty($startDate) && !empty($endDate)) {
            if($location == '3') {
             //echo 'rim';exit;
                if ($locationId != '3') {

                    $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $locationId And c.estm_start_date >= '".$startDate."' And c.estm_start_date <= '".$endDate."' And c.estm_end_date >= '".$startDate."' And c.estm_end_date <= '".$endDate."' group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date"));

                }
                if ($locationId == '3') {
                    //echo 'das';exit;
                    $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where c.estm_start_date >= '".$startDate."' And c.estm_start_date <= '".$endDate."' And c.estm_end_date >= '".$startDate."' And c.estm_end_date <= '".$endDate."' group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date"));
                }

            }else{
                $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $location And c.estm_start_date >= '".$startDate."' And c.estm_start_date <= '".$endDate."' And c.estm_end_date >= '".$startDate."' And c.estm_end_date <= '".$endDate."' group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date"));
            }




        }

        else {
            $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $location  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date"));
        }


        //,'Y-m-d' )
        $datatables =  Datatables::of($results)

            ->addColumn('estistart_date', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->estm_start_date)){
                    $esti_start=Carbon::parse($results->estm_start_date)->format('d/m/Y');
                }else{
                    $esti_start = 'NULL';
                }


                return $esti_start;

            })

            ->addColumn('estiend_date', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->estm_end_date)){
                    $esti_end=Carbon::parse($results->estm_end_date)->format('d/m/Y');
                }else{
                    $esti_end = 'NULL';
                }


                return $esti_end;

            })

            ->addColumn('podate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->po_date)){
                    $po_dat=Carbon::parse($results->po_date)->format('d/m/Y');
                }else{
                    $po_dat = 'NULL';
                }


                return $po_dat;

            })

            ->addColumn('quotationdate', function ($results) {

                if(!empty($results->quotation_date)){
                    $qo_dat=Carbon::parse($results->quotation_date)->format('d/m/Y');
                }else{
                    $qo_dat = 'NULL';
                }


                return $qo_dat;

            })

            ->addColumn('dissstartdate', function ($results) {

                if(!empty($results->DissStartDate)){
                    $formatted_dt1=Carbon::parse($results->DissStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('dissenddate', function ($results) {

                if(!empty($results->DissEndDate)){
                    $formatted_dt1=Carbon::parse($results->DissEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('storeenddate', function ($results) {
                if(!empty($results->StoreEndDate)){
                    $formatted_dt1=Carbon::parse($results->StoreEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assystartdate', function ($results) {
                if(!empty($results->AssyStartDate)){
                    $formatted_dt1=Carbon::parse($results->AssyStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assyenddate', function ($results) {
                if(!empty($results->AssyEndDate)){
                    $formatted_dt1=Carbon::parse($results->AssyEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingstartdate', function ($results) {
                if(!empty($results->TestingStartDate)){
                    $formatted_dt1=Carbon::parse($results->TestingStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingenddate', function ($results) {
                if(!empty($results->TestingEndDate)){
                    $formatted_dt1=Carbon::parse($results->TestingEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })


            ->addColumn('tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }


                return $diff;

            })
            ->addColumn('disstoquotation_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissEndDate);
                $formatted_dt2=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;



                return $diff1;

            })
            ->addColumn('quotationtostore_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->quotation_date);
                $formatted_dt2=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff2;

            })
            ->addColumn('assy_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyStartDate);
                $formatted_dt2=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff3;

            })
            ->addColumn('testing_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingStartDate);
                $formatted_dt2=Carbon::parse($results->TestingEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff4 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff4 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff4;

            })
            ->addColumn('assytotesting_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyEndDate);
                $formatted_dt2=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff5;

            })
            ->addColumn('testingtodispatch_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingEndDate);
                $formatted_dt2=Carbon::parse($results->DispatchStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff6;

            })
            ->addColumn('crc_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $crc_cycle= $diff + $diff1 + $diff3 + $diff5;
                return $crc_cycle;

            })
            ->addColumn('total_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $formatted_dt9=Carbon::parse($results->quotation_date);
                $formatted_dt10=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt9) || is_null($formatted_dt10)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt9->diffInDays($formatted_dt10);;
                }

                $formatted_dt11=Carbon::parse($results->TestingEndDate);
                $formatted_dt12=Carbon::parse($results->DispatchStartDate);

                if (is_null($formatted_dt11) || is_null($formatted_dt12)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt11->diffInDays($formatted_dt12);;
                }

                $total_cycle= $diff + $diff1 + $diff2 + $diff3 +  $diff5 + $diff6 ;
                return $total_cycle;

            })

            /* $loc_name= UserHelper::locationfind($table['location_id']);
           //dd($loc_name[0]['description']);die;



                 return $loc_name[0]['description'];

         })
         ->addColumn('project', function ($table) {
             $projectval='';
             if(!empty($table['work_orderno'])){
                 $project = UserHelper::projectfind($table['work_orderno']);
             }
             if(!empty($project[0]['project_id'])){
                 $projectval = $project[0]['project_id'];
             }



             return $projectval;

         })

         ->addColumn('dissstartdate', function ($table) {
             $startdate='';
             $projectval='';
             if(!empty($table['work_orderno'])){
                 $project = UserHelper::projectfind($table['work_orderno']);
             }
             if(!empty($project[0]['project_id'])){
                 $projectval = $project[0]['project_id'];
             }
             if(!empty($projectval)) {
                 $startdate = UserHelper::taskdissstartdate($projectval);
             }
             //dd($startdate);die;
             if(!empty($startdate)) {
                 foreach ($startdate as $key => $val) {

                     $dept = $val['dept_id'];

                     $section = UserHelper::sectionfind($dept);

                 }
             }

             return $section;*/

            ->rawColumns(['podate','estistart_date','estiend_date','quotationdate','tat','disstoquotation_tat','quotationtostore_tat','assy_tat','testing_tat','assytotesting_tat','testingtodispatch_tat','crc_cycle','total_cycle','dissstartdate','dissenddate','storeenddate','assystartdate','assyenddate','testingstartdate','testingenddate']);


        return $datatables->make(true);
    }
  
  
  public function workorderGetTable(Request $request)
    {

       /* select s.project_id,s.dept_id,s.task_name,c.workorder,sr.po_date,sr.checkgate1_actual_end_date,sum(case when task_name = ' Disassembly' then actual_strt_dt end),sum(case when task_name = ' Disassembly' then end_dt end),sum(case when task_name = 'Engine Assembly Check sheet' then actual_strt_dt end),sum(case when task_name = 'Engine Assembly Check sheet' then end_dt end),sum(case when task_name = 'Testing' then actual_strt_dt end) from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id group by s.project_id , s.dept_id;*/

        $data = Session::all();

        $location=$data['user']['location_id'];
        if($location == '1' || $location == '2') {
			
            /*$results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,sr.quotation_date,c.workorder,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
            from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $location  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date"));*/

            /************** SAMIM */            
			$results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
			from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id  where sr.location_id = $location AND sr.status ='Closed' group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));

			/******************* SAMIM */

			/*$results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,  (case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, (case when task_name = ' Disassembly' then end_dt end) as DissEndDate, (case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, (case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, (case when task_name = 'Testing' then end_dt end) as TestingEndDate,(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, (case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, (case when task_name = 'Store' then end_dt end) as StoreEndDate
             from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id  where sr.location_id = $location  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));*/
             //dd($results);
        }
		
		
        if($location == '3') {
			
			/***********SAMIM  */
            $results = DB::select(DB::raw("select s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,  sum(case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, sum(case when task_name = ' Disassembly' then end_dt end) as DissEndDate, sum(case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, sum(case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,sum(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, sum(case when task_name = 'Testing' then end_dt end) as TestingEndDate,sum(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,sum(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,sum(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, sum(case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,sum(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, sum(case when task_name = 'Store' then end_dt end) as StoreEndDate
			from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.status ='Closed' group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));
            /***************SAMIM */
			
            /*$results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,  (case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, (case when task_name = ' Disassembly' then end_dt end) as DissEndDate, (case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, (case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, (case when task_name = 'Testing' then end_dt end) as TestingEndDate,(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, (case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, (case when task_name = 'Store' then end_dt end) as StoreEndDate
            from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));*/
        }
		
        //,'Y-m-d' )
		//echo'<pre>';print_r($results);exit;
        $datatables =  Datatables::of($results)

            ->addColumn('estistart_date', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->estm_start_date)){
                    $esti_start=Carbon::parse($results->estm_start_date)->format('d/m/Y');
                }else{
                    $esti_start = 'NULL';
                }


                return $esti_start;

            })

            ->addColumn('estiend_date', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->estm_end_date)){
                    $esti_end=Carbon::parse($results->estm_end_date)->format('d/m/Y');
                }else{
                    $esti_end = 'NULL';
                }


                return $esti_end;

            })
		
		    ->addColumn('podate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                    if(!empty($results->po_date)){
                        $po_dat=Carbon::parse($results->po_date)->format('d/m/Y');
                    }else{
                        $po_dat = 'NULL';
                    }


                return $po_dat;

            })
			
			 ->addColumn('quotationdate', function ($results) {

                 if(!empty($results->quotation_date)){
                     $qo_dat=Carbon::parse($results->quotation_date)->format('d/m/Y');
                 }else{
                     $qo_dat = 'NULL';
                 }


                return $qo_dat;

            })

            ->addColumn('dissstartdate', function ($results) {

                if(!empty($results->DissStartDate)){
                    $formatted_dt1=Carbon::parse($results->DissStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('dissenddate', function ($results) {

                if(!empty($results->DissEndDate)){
                    $formatted_dt1=Carbon::parse($results->DissEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('storeenddate', function ($results) {
                if(!empty($results->StoreEndDate)){
                    $formatted_dt1=Carbon::parse($results->StoreEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assystartdate', function ($results) {
                if(!empty($results->AssyStartDate)){
                    $formatted_dt1=Carbon::parse($results->AssyStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assyenddate', function ($results) {
                if(!empty($results->AssyEndDate)){
                    $formatted_dt1=Carbon::parse($results->AssyEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingstartdate', function ($results) {
                if(!empty($results->TestingStartDate)){
                    $formatted_dt1=Carbon::parse($results->TestingStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingenddate', function ($results) {
                if(!empty($results->TestingEndDate)){
                    $formatted_dt1=Carbon::parse($results->TestingEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })


         ->addColumn('tat', function ($results) {
             //dd( $results->DissStartDate);
              //dd( $table['end_dt']);
               //$dissstartdate= $startdate['actual_strt_dt'];

              $formatted_dt1=Carbon::parse($results->DissStartDate);
              $formatted_dt2=Carbon::parse($results->DissEndDate);



              if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                  $diff = 0; // or throw new \InvalidArgumentException();
              } else {
                  $diff = $formatted_dt1->diffInDays($formatted_dt2);;
              }


              return $diff;

            })
            ->addColumn('disstoquotation_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissEndDate);
                $formatted_dt2=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;



                return $diff1;

            })
            ->addColumn('quotationtostore_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->quotation_date);
                $formatted_dt2=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff2;

            })
            ->addColumn('assy_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyStartDate);
                $formatted_dt2=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff3;

            })
            ->addColumn('testing_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingStartDate);
                $formatted_dt2=Carbon::parse($results->TestingEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff4 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff4 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff4;

            })
            ->addColumn('assytotesting_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyEndDate);
                $formatted_dt2=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff5;

            })
            ->addColumn('testingtodispatch_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingEndDate);
                $formatted_dt2=Carbon::parse($results->DispatchStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff6;

            })
            ->addColumn('crc_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
            $crc_cycle= $diff + $diff1 + $diff3 + $diff5;
                return $crc_cycle;

            })
            ->addColumn('total_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $formatted_dt9=Carbon::parse($results->quotation_date);
                $formatted_dt10=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt9) || is_null($formatted_dt10)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt9->diffInDays($formatted_dt10);;
                }

                $formatted_dt11=Carbon::parse($results->TestingEndDate);
                $formatted_dt12=Carbon::parse($results->DispatchStartDate);

                if (is_null($formatted_dt11) || is_null($formatted_dt12)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt11->diffInDays($formatted_dt12);;
                }

            $total_cycle= $diff + $diff1 + $diff2 + $diff3 +  $diff5 + $diff6 ;
                return $total_cycle;

            })

               /* $loc_name= UserHelper::locationfind($table['location_id']);
              //dd($loc_name[0]['description']);die;



                    return $loc_name[0]['description'];

            })
            ->addColumn('project', function ($table) {
                $projectval='';
                if(!empty($table['work_orderno'])){
                    $project = UserHelper::projectfind($table['work_orderno']);
                }
                if(!empty($project[0]['project_id'])){
                    $projectval = $project[0]['project_id'];
                }



                return $projectval;

            })

            ->addColumn('dissstartdate', function ($table) {
                $startdate='';
                $projectval='';
                if(!empty($table['work_orderno'])){
                    $project = UserHelper::projectfind($table['work_orderno']);
                }
                if(!empty($project[0]['project_id'])){
                    $projectval = $project[0]['project_id'];
                }
                if(!empty($projectval)) {
                    $startdate = UserHelper::taskdissstartdate($projectval);
                }
                //dd($startdate);die;
                if(!empty($startdate)) {
                    foreach ($startdate as $key => $val) {

                        $dept = $val['dept_id'];

                        $section = UserHelper::sectionfind($dept);

                    }
                }

                return $section;*/

            ->rawColumns(['podate','estistart_date','estiend_date','quotationdate','tat','disstoquotation_tat','quotationtostore_tat','assy_tat','testing_tat','assytotesting_tat','testingtodispatch_tat','crc_cycle','total_cycle','dissstartdate','dissenddate','storeenddate','assystartdate','assyenddate','testingstartdate','testingenddate']);


        return $datatables->make(true);
    }

    public function workorderFilter(Request $request)
    {
        $locationId = $request['location'];

        $myrequest=$request->all();
        //dd($myrequest);

        if($locationId != '3') {
            $results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,  (case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, (case when task_name = ' Disassembly' then end_dt end) as DissEndDate, (case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, (case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, (case when task_name = 'Testing' then end_dt end) as TestingEndDate,(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, (case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, (case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $locationId  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));

        }
        else {
            $results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,  (case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, (case when task_name = ' Disassembly' then end_dt end) as DissEndDate, (case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, (case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, (case when task_name = 'Testing' then end_dt end) as TestingEndDate,(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, (case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, (case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));
        }
        //,'Y-m-d' )
        $datatables =  Datatables::of($results)

            ->addColumn('estistart_date', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->estm_start_date)){
                    $esti_start=Carbon::parse($results->estm_start_date)->format('d/m/Y');
                }else{
                    $esti_start = 'NULL';
                }


                return $esti_start;

            })

            ->addColumn('estiend_date', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->estm_end_date)){
                    $esti_end=Carbon::parse($results->estm_end_date)->format('d/m/Y');
                }else{
                    $esti_end = 'NULL';
                }


                return $esti_end;

            })

            ->addColumn('podate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->po_date)){
                    $po_dat=Carbon::parse($results->po_date)->format('d/m/Y');
                }else{
                    $po_dat = 'NULL';
                }


                return $po_dat;

            })

            ->addColumn('quotationdate', function ($results) {

                if(!empty($results->quotation_date)){
                    $qo_dat=Carbon::parse($results->quotation_date)->format('d/m/Y');
                }else{
                    $qo_dat = 'NULL';
                }


                return $qo_dat;

            })

            ->addColumn('dissstartdate', function ($results) {

                if(!empty($results->DissStartDate)){
                    $formatted_dt1=Carbon::parse($results->DissStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('dissenddate', function ($results) {

                if(!empty($results->DissEndDate)){
                    $formatted_dt1=Carbon::parse($results->DissEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('storeenddate', function ($results) {
                if(!empty($results->StoreEndDate)){
                    $formatted_dt1=Carbon::parse($results->StoreEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assystartdate', function ($results) {
                if(!empty($results->AssyStartDate)){
                    $formatted_dt1=Carbon::parse($results->AssyStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assyenddate', function ($results) {
                if(!empty($results->AssyEndDate)){
                    $formatted_dt1=Carbon::parse($results->AssyEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingstartdate', function ($results) {
                if(!empty($results->TestingStartDate)){
                    $formatted_dt1=Carbon::parse($results->TestingStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingenddate', function ($results) {
                if(!empty($results->TestingEndDate)){
                    $formatted_dt1=Carbon::parse($results->TestingEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })


            ->addColumn('tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }


                return $diff;

            })
            ->addColumn('disstoquotation_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissEndDate);
                $formatted_dt2=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;



                return $diff1;

            })
            ->addColumn('quotationtostore_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->quotation_date);
                $formatted_dt2=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff2;

            })
            ->addColumn('assy_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyStartDate);
                $formatted_dt2=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff3;

            })
            ->addColumn('testing_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingStartDate);
                $formatted_dt2=Carbon::parse($results->TestingEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff4 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff4 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff4;

            })
            ->addColumn('assytotesting_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyEndDate);
                $formatted_dt2=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff5;

            })
            ->addColumn('testingtodispatch_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingEndDate);
                $formatted_dt2=Carbon::parse($results->DispatchStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff6;

            })
            ->addColumn('crc_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $crc_cycle= $diff + $diff1 + $diff3 + $diff5;
                return $crc_cycle;

            })
            ->addColumn('total_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $formatted_dt9=Carbon::parse($results->quotation_date);
                $formatted_dt10=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt9) || is_null($formatted_dt10)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt9->diffInDays($formatted_dt10);;
                }

                $formatted_dt11=Carbon::parse($results->TestingEndDate);
                $formatted_dt12=Carbon::parse($results->DispatchStartDate);

                if (is_null($formatted_dt11) || is_null($formatted_dt12)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt11->diffInDays($formatted_dt12);;
                }

                $total_cycle= $diff + $diff1 + $diff2 + $diff3 +  $diff5 + $diff6 ;
                return $total_cycle;

            })

            /* $loc_name= UserHelper::locationfind($table['location_id']);
           //dd($loc_name[0]['description']);die;



                 return $loc_name[0]['description'];

         })
         ->addColumn('project', function ($table) {
             $projectval='';
             if(!empty($table['work_orderno'])){
                 $project = UserHelper::projectfind($table['work_orderno']);
             }
             if(!empty($project[0]['project_id'])){
                 $projectval = $project[0]['project_id'];
             }



             return $projectval;

         })

         ->addColumn('dissstartdate', function ($table) {
             $startdate='';
             $projectval='';
             if(!empty($table['work_orderno'])){
                 $project = UserHelper::projectfind($table['work_orderno']);
             }
             if(!empty($project[0]['project_id'])){
                 $projectval = $project[0]['project_id'];
             }
             if(!empty($projectval)) {
                 $startdate = UserHelper::taskdissstartdate($projectval);
             }
             //dd($startdate);die;
             if(!empty($startdate)) {
                 foreach ($startdate as $key => $val) {

                     $dept = $val['dept_id'];

                     $section = UserHelper::sectionfind($dept);

                 }
             }

             return $section;*/

            ->rawColumns(['podate','estistart_date','estiend_date','quotationdate','tat','disstoquotation_tat','quotationtostore_tat','assy_tat','testing_tat','assytotesting_tat','testingtodispatch_tat','crc_cycle','total_cycle','dissstartdate','dissenddate','storeenddate','assystartdate','assyenddate','testingstartdate','testingenddate']);


        return $datatables->make(true);
    }

    public function workorderDateFilter(Request $request)
    {
        $myrequest=$request->all();
   //dd($myrequest);

        $locationId = $request['location'];
        $data = Session::all();

        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];


        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');
        //dd($request['startdate']);exit;
        if(!empty($startDate) && !empty($endDate)) {
            if($location == '3') {
             //echo 'rim';exit;
                if ($locationId != '3') {

                    $results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,  max((case when task_name = ' Disassembly' then actual_strt_dt end)) as DissStartDate, max((case when task_name = ' Disassembly' then end_dt end)) as DissEndDate, max((case when task_name = ' Assembly' then actual_strt_dt end)) as AssyStartDate, max((case when task_name = ' Assembly' then end_dt end)) as AssyEndDate ,max((case when task_name = 'Testing' then actual_strt_dt end)) as TestingStartDate, max((case when task_name = 'Testing' then end_dt end)) as TestingEndDate,max((case when task_name = 'Dispatch' then actual_strt_dt end)) as DispatchStartDate,max((case when task_name = 'Dispatch' then end_dt end)) as DispatchEndDate,max((case when task_name = 'QAQC' then actual_strt_dt end)) as QAQCStartDate, max((case when task_name = 'QAQC' then end_dt end)) as QAQCEndDate,max((case when task_name = 'Store'then actual_strt_dt end)) as StoreStartDate, max((case when task_name = 'Store' then end_dt end)) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $locationId And c.estm_start_date >= '".$startDate."' And c.estm_start_date <= '".$endDate."' And c.estm_end_date >= '".$startDate."' And c.estm_end_date <= '".$endDate."' group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));

                }
                if ($locationId == '3') {
                    //echo 'das';exit;
                    $results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,   max((case when task_name = ' Disassembly' then actual_strt_dt end)) as DissStartDate, max((case when task_name = ' Disassembly' then end_dt end)) as DissEndDate, max((case when task_name = ' Assembly' then actual_strt_dt end)) as AssyStartDate, max((case when task_name = ' Assembly' then end_dt end)) as AssyEndDate ,max((case when task_name = 'Testing' then actual_strt_dt end)) as TestingStartDate, max((case when task_name = 'Testing' then end_dt end)) as TestingEndDate,max((case when task_name = 'Dispatch' then actual_strt_dt end)) as DispatchStartDate,max((case when task_name = 'Dispatch' then end_dt end)) as DispatchEndDate,max((case when task_name = 'QAQC' then actual_strt_dt end)) as QAQCStartDate, max((case when task_name = 'QAQC' then end_dt end)) as QAQCEndDate,max((case when task_name = 'Store'then actual_strt_dt end)) as StoreStartDate, max((case when task_name = 'Store' then end_dt end)) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where c.estm_start_date >= '".$startDate."' And c.estm_start_date <= '".$endDate."' And c.estm_end_date >= '".$startDate."' And c.estm_end_date <= '".$endDate."' group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));
                }

            }else{


                $results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,   max((case when task_name = ' Disassembly' then actual_strt_dt end)) as DissStartDate, max((case when task_name = ' Disassembly' then end_dt end)) as DissEndDate, max((case when task_name = ' Assembly' then actual_strt_dt end)) as AssyStartDate, max((case when task_name = ' Assembly' then end_dt end)) as AssyEndDate ,max((case when task_name = 'Testing' then actual_strt_dt end)) as TestingStartDate, max((case when task_name = 'Testing' then end_dt end)) as TestingEndDate,max((case when task_name = 'Dispatch' then actual_strt_dt end)) as DispatchStartDate,max((case when task_name = 'Dispatch' then end_dt end)) as DispatchEndDate,max((case when task_name = 'QAQC' then actual_strt_dt end)) as QAQCStartDate, max((case when task_name = 'QAQC' then end_dt end)) as QAQCEndDate,max((case when task_name = 'Store'then actual_strt_dt end)) as StoreStartDate, max((case when task_name = 'Store' then end_dt end)) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $location And c.estm_start_date >= '".$startDate."' And c.estm_start_date <= '".$endDate."' And c.estm_end_date >= '".$startDate."' And c.estm_end_date <= '".$endDate."' group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));
            }




        }

        else {
            $results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,   max((case when task_name = ' Disassembly' then actual_strt_dt end)) as DissStartDate, max((case when task_name = ' Disassembly' then end_dt end)) as DissEndDate, max((case when task_name = ' Assembly' then actual_strt_dt end)) as AssyStartDate, max((case when task_name = ' Assembly' then end_dt end)) as AssyEndDate ,max((case when task_name = 'Testing' then actual_strt_dt end)) as TestingStartDate, max((case when task_name = 'Testing' then end_dt end)) as TestingEndDate,max((case when task_name = 'Dispatch' then actual_strt_dt end)) as DispatchStartDate,max((case when task_name = 'Dispatch' then end_dt end)) as DispatchEndDate,max((case when task_name = 'QAQC' then actual_strt_dt end)) as QAQCStartDate, max((case when task_name = 'QAQC' then end_dt end)) as QAQCEndDate,max((case when task_name = 'Store'then actual_strt_dt end)) as StoreStartDate, max((case when task_name = 'Store' then end_dt end)) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $location  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));
        }


        //,'Y-m-d' )
        $datatables =  Datatables::of($results)

            ->addColumn('estistart_date', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->estm_start_date)){
                    $esti_start=Carbon::parse($results->estm_start_date)->format('d/m/Y');
                }else{
                    $esti_start = 'NULL';
                }


                return $esti_start;

            })

            ->addColumn('estiend_date', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->estm_end_date)){
                    $esti_end=Carbon::parse($results->estm_end_date)->format('d/m/Y');
                }else{
                    $esti_end = 'NULL';
                }


                return $esti_end;

            })

            ->addColumn('podate', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                if(!empty($results->po_date)){
                    $po_dat=Carbon::parse($results->po_date)->format('d/m/Y');
                }else{
                    $po_dat = 'NULL';
                }


                return $po_dat;

            })

            ->addColumn('quotationdate', function ($results) {

                if(!empty($results->quotation_date)){
                    $qo_dat=Carbon::parse($results->quotation_date)->format('d/m/Y');
                }else{
                    $qo_dat = 'NULL';
                }


                return $qo_dat;

            })

            ->addColumn('dissstartdate', function ($results) {

                if(!empty($results->DissStartDate)){
                    $formatted_dt1=Carbon::parse($results->DissStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('dissenddate', function ($results) {

                if(!empty($results->DissEndDate)){
                    $formatted_dt1=Carbon::parse($results->DissEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }


                return $formatted_dt1;

            })
            ->addColumn('storeenddate', function ($results) {
                if(!empty($results->StoreEndDate)){
                    $formatted_dt1=Carbon::parse($results->StoreEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assystartdate', function ($results) {
                if(!empty($results->AssyStartDate)){
                    $formatted_dt1=Carbon::parse($results->AssyStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('assyenddate', function ($results) {
                if(!empty($results->AssyEndDate)){
                    $formatted_dt1=Carbon::parse($results->AssyEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingstartdate', function ($results) {
                if(!empty($results->TestingStartDate)){
                    $formatted_dt1=Carbon::parse($results->TestingStartDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })
            ->addColumn('testingenddate', function ($results) {
                if(!empty($results->TestingEndDate)){
                    $formatted_dt1=Carbon::parse($results->TestingEndDate)->format('d/m/Y');
                }else{
                    $formatted_dt1 = 'NULL';
                }



                return $formatted_dt1;

            })


            ->addColumn('tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }


                return $diff;

            })
            ->addColumn('disstoquotation_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->DissEndDate);
                $formatted_dt2=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;



                return $diff1;

            })
            ->addColumn('quotationtostore_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->quotation_date);
                $formatted_dt2=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff2;

            })
            ->addColumn('assy_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyStartDate);
                $formatted_dt2=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff3;

            })
            ->addColumn('testing_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingStartDate);
                $formatted_dt2=Carbon::parse($results->TestingEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff4 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff4 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff4;

            })
            ->addColumn('assytotesting_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->AssyEndDate);
                $formatted_dt2=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff5;

            })
            ->addColumn('testingtodispatch_tat', function ($results) {
                //dd( $results->DissStartDate);
                //dd( $table['end_dt']);
                //$dissstartdate= $startdate['actual_strt_dt'];

                $formatted_dt1=Carbon::parse($results->TestingEndDate);
                $formatted_dt2=Carbon::parse($results->DispatchStartDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt1->diffInDays($formatted_dt2);;
                }
                //$tat = $table['end_dt'] - $table['actual_strt_dt']  ;
                //$diff1=$diff/24 ;
                //$diff2= $diff1 .substring(0,2);


                return $diff6;

            })
            ->addColumn('crc_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $crc_cycle= $diff + $diff1 + $diff3 + $diff5;
                return $crc_cycle;

            })
            ->addColumn('total_cycle', function ($results) {

                $formatted_dt1=Carbon::parse($results->DissStartDate);
                $formatted_dt2=Carbon::parse($results->DissEndDate);



                if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                    $diff = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff = $formatted_dt1->diffInDays($formatted_dt2);;
                }

                $formatted_dt3=Carbon::parse($results->DissEndDate);
                $formatted_dt4=Carbon::parse($results->quotation_date);



                if (is_null($formatted_dt3) || is_null($formatted_dt4)) {
                    $diff1 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff1 = $formatted_dt3->diffInDays($formatted_dt4);;
                }

                $formatted_dt5=Carbon::parse($results->AssyStartDate);
                $formatted_dt6=Carbon::parse($results->AssyEndDate);



                if (is_null($formatted_dt5) || is_null($formatted_dt6)) {
                    $diff3 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff3 = $formatted_dt5->diffInDays($formatted_dt6);;
                }

                $formatted_dt7=Carbon::parse($results->AssyEndDate);
                $formatted_dt8=Carbon::parse($results->TestingStartDate);



                if (is_null($formatted_dt7) || is_null($formatted_dt7)) {
                    $diff5 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff5 = $formatted_dt7->diffInDays($formatted_dt8);;
                }
                $formatted_dt9=Carbon::parse($results->quotation_date);
                $formatted_dt10=Carbon::parse($results->StoreEndDate);



                if (is_null($formatted_dt9) || is_null($formatted_dt10)) {
                    $diff2 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff2 = $formatted_dt9->diffInDays($formatted_dt10);;
                }

                $formatted_dt11=Carbon::parse($results->TestingEndDate);
                $formatted_dt12=Carbon::parse($results->DispatchStartDate);

                if (is_null($formatted_dt11) || is_null($formatted_dt12)) {
                    $diff6 = 0; // or throw new \InvalidArgumentException();
                } else {
                    $diff6 = $formatted_dt11->diffInDays($formatted_dt12);;
                }

                $total_cycle= $diff + $diff1 + $diff2 + $diff3 +  $diff5 + $diff6 ;
                return $total_cycle;

            })

            /* $loc_name= UserHelper::locationfind($table['location_id']);
           //dd($loc_name[0]['description']);die;



                 return $loc_name[0]['description'];

         })
         ->addColumn('project', function ($table) {
             $projectval='';
             if(!empty($table['work_orderno'])){
                 $project = UserHelper::projectfind($table['work_orderno']);
             }
             if(!empty($project[0]['project_id'])){
                 $projectval = $project[0]['project_id'];
             }



             return $projectval;

         })

         ->addColumn('dissstartdate', function ($table) {
             $startdate='';
             $projectval='';
             if(!empty($table['work_orderno'])){
                 $project = UserHelper::projectfind($table['work_orderno']);
             }
             if(!empty($project[0]['project_id'])){
                 $projectval = $project[0]['project_id'];
             }
             if(!empty($projectval)) {
                 $startdate = UserHelper::taskdissstartdate($projectval);
             }
             //dd($startdate);die;
             if(!empty($startdate)) {
                 foreach ($startdate as $key => $val) {

                     $dept = $val['dept_id'];

                     $section = UserHelper::sectionfind($dept);

                 }
             }

             return $section;*/

            ->rawColumns(['podate','estistart_date','estiend_date','quotationdate','tat','disstoquotation_tat','quotationtostore_tat','assy_tat','testing_tat','assytotesting_tat','testingtodispatch_tat','crc_cycle','total_cycle','dissstartdate','dissenddate','storeenddate','assystartdate','assyenddate','testingstartdate','testingenddate']);


        return $datatables->make(true);
    }

    public function workorderGraph(Request $request)
    {
        $myrequest=$request->all();
        //dd($myrequest);

        $locationId = $request['location'];
        $segmentId = $request['segment'];
        $data = Session::all();

        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];


        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');
        //dd($request['startdate']);exit;
        if(!empty($startDate) && !empty($endDate)) {
            if($location == '3') {
                //echo 'rim';exit;
                if ($locationId != '3') {

                    $results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,  (case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, (case when task_name = ' Disassembly' then end_dt end) as DissEndDate, (case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, (case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, (case when task_name = 'Testing' then end_dt end) as TestingEndDate,(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, (case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, (case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $locationId And sr.segment = '".$segmentId."' And c.estm_start_date >= '".$startDate."' And c.estm_start_date <= '".$endDate."' And c.estm_end_date >= '".$startDate."' And c.estm_end_date <= '".$endDate."' group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));

                }
                if ($locationId == '3') {
                    //echo 'das';exit;
                    $results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,  (case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, (case when task_name = ' Disassembly' then end_dt end) as DissEndDate, (case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, (case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, (case when task_name = 'Testing' then end_dt end) as TestingEndDate,(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, (case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, (case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.segment = '".$segmentId."' And c.estm_start_date >= '".$startDate."' And c.estm_start_date <= '".$endDate."' And c.estm_end_date >= '".$startDate."' And c.estm_end_date <= '".$endDate."' group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));
                }

            }else{
                $results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,  (case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, (case when task_name = ' Disassembly' then end_dt end) as DissEndDate, (case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, (case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, (case when task_name = 'Testing' then end_dt end) as TestingEndDate,(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, (case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, (case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $location And sr.segment = '".$segmentId."' And c.estm_start_date >= '".$startDate."' And c.estm_start_date <= '".$endDate."' And c.estm_end_date >= '".$startDate."' And c.estm_end_date <= '".$endDate."' group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));
            }




        }

        else {
            $results = DB::select(DB::raw("select distinct s.project_id,s.dept_id,sr.po_date,c.estm_days,c.estm_start_date,c.estm_end_date,sr.quotation_date,model.model_no,comp.comp_model_no,c.workorder,sr.description,sr.segment,dp.name as dept,  (case when task_name = ' Disassembly' then actual_strt_dt end) as DissStartDate, (case when task_name = ' Disassembly' then end_dt end) as DissEndDate, (case when task_name = ' Assembly' then actual_strt_dt end) as AssyStartDate, (case when task_name = ' Assembly' then end_dt end) as AssyEndDate ,(case when task_name = 'Testing' then actual_strt_dt end) as TestingStartDate, (case when task_name = 'Testing' then end_dt end) as TestingEndDate,(case when task_name = 'Dispatch' then actual_strt_dt end) as DispatchStartDate,(case when task_name = 'Dispatch' then end_dt end) as DispatchEndDate,(case when task_name = 'QAQC' then actual_strt_dt end) as QAQCStartDate, (case when task_name = 'QAQC' then end_dt end) as QAQCEndDate,(case when task_name = 'Store'then actual_strt_dt end) as StoreStartDate, (case when task_name = 'Store' then end_dt end) as StoreEndDate
from gw_project_plan_master c inner join gw_task_users s on c.project_id = s.project_id LEFT JOIN service_request sr ON c.workorder= sr.work_orderno LEFT JOIN gw_master_mc_model model ON sr.machine_modelno= model.id LEFT JOIN gw_master_comp_details comp ON sr.comp_model_no= comp.id LEFT JOIN gw_master_department dp ON s.dept_id = dp.id where sr.location_id = $location And sr.segment = $segmentId  group by s.project_id ,s.dept_id,sr.po_date,c.workorder,dp.name,sr.quotation_date,sr.description,c.estm_days,model.model_no,comp.comp_model_no,c.estm_start_date,c.estm_end_date,sr.segment"));
        }

        //calculation tat
//dd($results);
        $comptojob=0;
        foreach($results as $res){


            $diff=2;


            $comptojob += $diff;

            //dd($disstoquotation);
        }

        $disstodiss=0;
        foreach($results as $res){

            $formatted_dt1=Carbon::parse($res->DissStartDate);
            $formatted_dt2=Carbon::parse($res ->DissEndDate);



            if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                $diff = 0; // or throw new \InvalidArgumentException();
            } else {
                $diff = $formatted_dt1->diffInDays($formatted_dt2);;
            }

            $disstodiss += $diff;

            //dd($totaldiff);
        }
        $disstoquotation=0;
        foreach($results as $res){

            $formatted_dt1=Carbon::parse($res->DissEndDate);
            $formatted_dt2=Carbon::parse($res ->quotation_date);



            if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                $diff = 0; // or throw new \InvalidArgumentException();
            } else {
                $diff = $formatted_dt1->diffInDays($formatted_dt2);;
            }

            $disstoquotation += $diff;

            //dd($disstoquotation);
        }
        $offertoparts=0;
        foreach($results as $res){

            $formatted_dt1=Carbon::parse($res->quotation_date);
            $formatted_dt2=Carbon::parse($res ->StoreEndDate);



            if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                $diff = 0; // or throw new \InvalidArgumentException();
            } else {
                $diff = $formatted_dt1->diffInDays($formatted_dt2);;
            }

            $offertoparts += $diff;

            //dd($disstoquotation);
        }
        $assytoassy=0;
        foreach($results as $res){

            $formatted_dt1=Carbon::parse($res->AssyStartDate);
            $formatted_dt2=Carbon::parse($res ->AssyEndDate);



            if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                $diff = 0; // or throw new \InvalidArgumentException();
            } else {
                $diff = $formatted_dt1->diffInDays($formatted_dt2);;
            }

            $assytoassy += $diff;

            //dd($disstoquotation);
        }
        $testingtodispa=0;
        foreach($results as $res){

            $formatted_dt1=Carbon::parse($res->TestingEndDate);
            $formatted_dt2=Carbon::parse($res ->DispatchStartDate);



            if (is_null($formatted_dt1) || is_null($formatted_dt2)) {
                $diff = 0; // or throw new \InvalidArgumentException();
            } else {
                $diff = $formatted_dt1->diffInDays($formatted_dt2);;
            }

            $testingtodispa += $diff;

            //dd($disstoquotation);
        }

        $plus_all_date=0;
       $plus_all_date = $comptojob + $disstodiss + $disstoquotation + $offertoparts + $assytoassy + $testingtodispa;
       if($plus_all_date > 0) {
           $comptojob_point = 0;
           $comptojob_point = $comptojob / $plus_all_date;
           $comptojob_percent = round($comptojob_point * 100, 2);

           $disstodiss_point = 0;
           $disstodiss_point = $disstodiss / $plus_all_date;
           $disstodiss_percent = round($disstodiss_point * 100, 2);

           $disstoquotation_point = 0;
           $disstoquotation_point = $disstoquotation / $plus_all_date;
           $disstoquotation_percent = round($disstoquotation_point * 100, 2);

           $offertoparts_point = 0;
           $offertoparts_point = $offertoparts / $plus_all_date;
           $offertoparts_percent = round($offertoparts_point * 100, 2);

           $assytoassy_point = 0;
           $assytoassy_point = $assytoassy / $plus_all_date;
           $assytoassy_percent = round($assytoassy_point * 100, 2);

           $testingtodispa_point = 0;
           $testingtodispa_point = $testingtodispa / $plus_all_date;
           $testingtodispa_percent = round($testingtodispa_point * 100, 2);

           //$total = $comptojob_percent + $disstodiss_percent + $disstoquotation_percent + $offertoparts_percent + $assytoassy_percent + $testingtodispa_percent ;

           //dlimi
           $val = [$comptojob_percent, $disstodiss_percent, $disstoquotation_percent, $offertoparts_percent, $assytoassy_percent, $testingtodispa_percent];

           $percentage = implode('-', $val);
           echo $percentage;
       }else{
           echo "failure";
       }
        //dd($plus_all_date);



       // return redirect('admin/time-sheet-edit/'.$request['emp_code']);
        //return redirect('admin/time-sheet-listing');
    }
  
  
     //COMPONENT RECEIVED & DISPATCH List
    public function comprecdisplisting()
    {
        return view('admin.report.comprecdispaList');
    }
    public function comprecdispGetTable(Request $request)
    {
        $data = Session::all();

        $location=$data['user']['location_id'];

        if($location == '1' || $location == '2') {
            $table = MasterMissingdamagePartDis::select('gw_master_disa_missing_damaged_part.service_request_id', 'service_request.work_orderno')
                ->leftjoin('service_request', 'service_request.id', '=', 'gw_master_disa_missing_damaged_part.service_request_id')
                ->where('service_request.location_id', '=', $location)
                ->groupby('gw_master_disa_missing_damaged_part.service_request_id','service_request.work_orderno')
                ->get();
        }
        if($location == '3'){
            $table = MasterMissingdamagePartDis::select('gw_master_disa_missing_damaged_part.service_request_id', 'service_request.work_orderno')
                ->leftjoin('service_request', 'service_request.id', '=', 'gw_master_disa_missing_damaged_part.service_request_id')
                //->where('service_request.location_id', '=', $location)
               ->groupby('gw_master_disa_missing_damaged_part.service_request_id','service_request.work_orderno')
                ->get();
        }

        $datatables =  Datatables::of($table)


            ->addColumn('count_receive', function ($table) {

                $receive_count = UserHelper::countcomponentReceived($table['service_request_id']);

                return $receive_count;

            })
            ->addColumn('count_dispatch', function ($table) {

                $dispatch_count = UserHelper::countcomponentDespatch($table['service_request_id']);

                return $dispatch_count;

            })

            ->addColumn('createddate', function ($table) {

                $created  = UserHelper::created_datefind($table['service_request_id']);
//dd($created[0]['created_at']);
                $formatted_dt1=Carbon::parse($created[0]['created_at'])->format('Y-m-d');

                return $formatted_dt1;

            })
            ->rawColumns(['count_receive','count_dispatch','createddate']);


        return $datatables->make(true);
    }
    public function comprecdispFilter(Request $request)
    {
        //$data = Session::all();

        $locationId = $request['location'];


        if($locationId != '3') {
            $table = MasterMissingdamagePartDis::select('gw_master_disa_missing_damaged_part.service_request_id', 'service_request.work_orderno')
                ->leftjoin('service_request', 'service_request.id', '=', 'gw_master_disa_missing_damaged_part.service_request_id')
                ->where('service_request.location_id', '=', $locationId)
                ->groupby('gw_master_disa_missing_damaged_part.service_request_id','service_request.work_orderno')
                ->get();
        }
        else{
            $table = MasterMissingdamagePartDis::select('gw_master_disa_missing_damaged_part.service_request_id', 'service_request.work_orderno')
                ->leftjoin('service_request', 'service_request.id', '=', 'gw_master_disa_missing_damaged_part.service_request_id')
                //->where('service_request.location_id', '=', $location)
                ->groupby('gw_master_disa_missing_damaged_part.service_request_id','service_request.work_orderno')
                ->get();
        }

        $datatables =  Datatables::of($table)


            ->addColumn('count_receive', function ($table) {

                $receive_count = UserHelper::countcomponentReceived($table['service_request_id']);

                return $receive_count;

            })
            ->addColumn('count_dispatch', function ($table) {

                $dispatch_count = UserHelper::countcomponentDespatch($table['service_request_id']);

                return $dispatch_count;

            })

            ->addColumn('createddate', function ($table) {

                $created  = UserHelper::created_datefind($table['service_request_id']);
//dd($created[0]['created_at']);
                $formatted_dt1=Carbon::parse($created[0]['created_at'])->format('Y-m-d');

                return $formatted_dt1;

            })
            ->rawColumns(['count_receive','count_dispatch','createddate']);


        return $datatables->make(true);
    }
    
     //time sheet
    public function timeSheetEntry()
    {
        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
        $emp_email=$data['user']['email'];
        $location=$data['user']['location_id'];

        $emp_name=User::where('emp_code','=',$emp_id)->get()->toArray();
//dd($emp_name[0]['name']);
        return view('admin.report.timeSheetEntry')
            ->with('emp_id',$emp_id)
            ->with('emp_name',$emp_name)
            ->with('emp_email',$emp_email);
    }

    public function customerListShow(Request $request){

        //$machserial= UserHelper::machineserialno($request['model']);

        $findworkorder=Service::where('work_orderno','=',$request['workorder'])->get()->toArray();
        //dd($findworkorder[0]['customer']);

        if(!empty($findworkorder))
        {
            $cust_val=MasterCustomer::find($findworkorder[0]['customer']);

            if(!empty($cust_val))
            {
                echo $cust_val['name'];
            }
            else
            {
                echo "Not Required";
            }
        }
        else
        {
            echo "Not Required";
        }

        //$str =  '<input class="form-control" name="cust_name" type="text" value='. $cust_val['name'] .' id="custname" readonly>';

    }
	
    public function timeSheetEntrySave(Request $request)
    {

        if(isset($request['dated'])){
            foreach($request['work_order'] as $key => $value){
                $data = Session::all();

                $emp_id=$data['user']['emp_code'];
                $location=$data['user']['location_id'];
                $emp_name=User::where('emp_code','=',$emp_id)->get()->toArray();
                $obj = new TimeSheetEntry();
                $obj->emp_id = $emp_id;
                $obj->emp_name = $emp_name[0]['name'];
                $obj->location_id = $location;

                //$obj->dated = $request['dated'];
                $obj->task = $request['task'];
                $obj->job_summery = $request['job_summery'];
                $obj->remarks = $request['remarks'];

                //$obj->service_req = $request['service_req'][$key];
                $obj->work_order = $request['work_order'][$key];
                $obj->cust_name = $request['cust_name'][$key];
                //$obj->day = $request['day'][$key];
                $obj->dated  = Carbon::createFromFormat('d/m/Y', $request['dated'][$key])->format('Y-m-d');
                //$obj->dated  =$request['dated'][$key];
                $obj->shift = $request['shift'][$key];
                $obj->start_time = $request['start_time'][$key];
                $obj->end_time = $request['end_time'][$key];
                //$obj->project = $request['project'][$key];
                 $obj->hours = $request['hours'][$key];

                $obj->save();
            }
//    exit();
        }


        return redirect('admin/time-sheet-listing');
    }

    public function timeSheetEdit($id)
    {
        $data = Session::all();

        $emp_id=$data['user']['emp_code'];
        $emp_name=User::where('emp_code','=',$emp_id)->get()->toArray();
       // dd($emp_id);
        $emp_email=$data['user']['email'];
        //$timesheet=TimeSheetEntry::find($id);
        $timesheet=TimeSheetEntry::where('id','=',$id)->get()->toArray();
      $customer1 = TimeSheetEntry::select('gw_master_customer.*')
            ->leftjoin('gw_master_customer',
                'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
            ->where('time_sheet_entry.id', '=', $id)->get();
			
        return view('admin.report.timeSheetEdit')
            ->with('emp_id',$emp_id)
            ->with('emp_name',$emp_name)
            ->with('timesheet',$timesheet)
			->with('customer1',$customer1)
            ->with('emp_email',$emp_email);
    }

     public function timeSheetEditSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];
        $emp_name=User::where('emp_code','=',$emp_id)->get()->toArray();
//        $myrequest=$request->all();
//        dd($myrequest);
        $edittimesheet = TimeSheetEntry::where('id','=',$request['id'])->get()->toArray();
//dd($edittimesheet);
        if(count($edittimesheet)<=0){
            $obj = new TimeSheetEntry();

        }
        else{
            $obj = TimeSheetEntry::find($edittimesheet[0]['id']);
//         $i=0;
////            foreach ($edittimesheet as $key=> $val) {
////                $obj = TimeSheetEntry::find($edittimesheet[$key]['id']);
////                $i++;
////                //$obj = TimeSheetEntry::where('emp_id','=',$request['emp_code'])->get()->toArray();
////                //dd($obj);
////            }
        }

        if(isset($request['work_order'])) {
            TimeSheetEntry::where('id','=',$request['id'])->delete();

            foreach ($request['work_order'] as $key => $value) {




                $obj =  new TimeSheetEntry();

                $obj->emp_id = $emp_id;
                $obj->emp_name = $emp_name[0]['name'];
                $obj->location_id = $location;
                //$obj->dated = $request['dated'];
                $obj->task = $request['task'];
                $obj->job_summery = $request['job_summery'];
                $obj->remarks = $request['remarks'];

                //$obj->service_req = $request['service_req'][$key];
                $obj->work_order = $request['work_order'][$key];
                $obj->cust_name = $request['cust_name'][$key];
//                $obj->day = $request['day'][$key];
                $obj->dated  = Carbon::createFromFormat('d/m/Y', $request['dated'][$key])->format('Y-m-d');
                //$obj->dated  =$request['dated'][$key];
                $obj->shift = $request['shift'][$key];
                $obj->start_time = $request['start_time'][$key];
                $obj->end_time = $request['end_time'][$key];
                //$obj->project = $request['project'][$key];
                $obj->hours = $request['hours'][$key];

                $obj->save();
            }
        }

       // dd($edittimesheet);





        /*$file=$request['service_req'];
        //$myrequest=$request->all();

        //dd($file);
        if(isset($obj->id)) {
            foreach ($file as $key => $val) {

                $txt = $val;

                DB::statement("UPDATE time_sheet_entry SET emp_id = '".$request['emp_code']."' AND shift = '".$request['shift']."' AND date = '".$request['date']."' AND start_time = '".$request['start_time']."' AND end_time = '".$request['end_time']."' AND job_summery = '".$request['job_summery']."' AND remarks = '".$request['remarks']."' AND service_req = '".$request['service_req'][$key]."' AND work_order = '".$request['work_order'][$key]."' AND task = '".$request['task'][$key]."'  AND day = '".$request['day'][$key]."' AND hours = '".$request['hours'][$key]."'  where emp_id = '". $request['emp_code']."' AND service_req = '".$request['service_req'][$key]."");



            }

        }*/



       // return redirect('admin/time-sheet-edit/'.$request['emp_code']);
        return redirect('admin/time-sheet-listing');
    }

    public function timeSheetlisting()
    {

        return view('admin.report.timeSheetList');
    }

    public function timeSheetGetTable(Request $request)
    {
        $data = Session::all();

//        $dept_id=$data['user']['section_id'];
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];

        if($location == '1' || $location == '2') {
            $table = TimeSheetEntry::select('time_sheet_entry.emp_name', 'emp_id', 'id', 'shift', 'dated', 'work_order', 'start_time', 'end_time','hours','created_at')
                //select('gw_project_plan_master.id', 'machine_modelno', 'gw_master_mc_model.model_no')
                //->leftjoin('gw_project_plan_master','gw_project_plan_master.service_id', '=', 'service_request.id')
                // ->leftjoin('gw_master_customer','gw_master_customer.id', '=', 'service_request.customer')
                ->where('time_sheet_entry.emp_id', '=', $emp_id)
                ->where('time_sheet_entry.location_id', '=', $location)
                // ->groupby('emp_id')
                ->orderby('dated')
                ->get();
        }
        if($location == '3'){
            $table = TimeSheetEntry::select('time_sheet_entry.emp_name', 'emp_id', 'id', 'shift', 'dated', 'work_order', 'start_time', 'end_time','hours')
                //select('gw_project_plan_master.id', 'machine_modelno', 'gw_master_mc_model.model_no')
                //->leftjoin('gw_project_plan_master','gw_project_plan_master.service_id', '=', 'service_request.id')
                // ->leftjoin('gw_master_customer','gw_master_customer.id', '=', 'service_request.customer')
                //->where('time_sheet_entry.emp_id', '=', $emp_id)
                //->where('time_sheet_entry.location_id', '=', $location)
                // ->groupby('emp_id')
                ->get();
        }

        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $data = Session::all();

                $emp_id=$data['user']['emp_code'];
                if($table->emp_id == $emp_id){
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/time-sheet-edit') . "/" . "$table->id" . '">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;
            }
            })
			->addColumn('dateformat', function ($table) {

                
                $formatted_dt1=Carbon::parse($table['dated'])->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('datetimeformat', function ($table) {

                
                $formatted_dt1=Carbon::parse($table['created_at'])->format('d/m/Y H:i:s');

                return $formatted_dt1;

            })
            ->rawColumns(['action','roles','dateformat','datetimeformat']);


        return $datatables->make(true);
    }
    
     public function timeSheetGetTabledatefilter(Request $request)
    {
        $data = Session::all();

        $startDate = $endDate ='';
        if($request['startdate'] !='')
        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        if($request['enddate'] !='')
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');

//        $dept_id=$data['user']['section_id'];
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];

        if($location == '1' || $location == '2') {
            $table = TimeSheetEntry::select('time_sheet_entry.emp_name', 'emp_id', 'id', 'shift', 'dated', 'work_order', 'start_time', 'end_time','hours')
                //select('gw_project_plan_master.id', 'machine_modelno', 'gw_master_mc_model.model_no')
                //->leftjoin('gw_project_plan_master','gw_project_plan_master.service_id', '=', 'service_request.id')
                // ->leftjoin('gw_master_customer','gw_master_customer.id', '=', 'service_request.customer')
                ->where('time_sheet_entry.emp_id', '=', $emp_id)
                ->where('time_sheet_entry.location_id', '=', $location)

                 ->when($startDate, function ($query) use ($startDate) {
                    return $query->where('time_sheet_entry.dated', '>=', $startDate);
                })

                ->when($endDate, function ($query) use ($endDate) {
                    return $query->where('time_sheet_entry.dated', '<=', $endDate);
                })

                // ->groupby('emp_id')
                ->orderby('dated')
                ->get();
        }
        if($location == '3'){
            $table = TimeSheetEntry::select('time_sheet_entry.emp_name', 'emp_id', 'id', 'shift', 'dated', 'work_order', 'start_time', 'end_time','hours')
                //select('gw_project_plan_master.id', 'machine_modelno', 'gw_master_mc_model.model_no')
                //->leftjoin('gw_project_plan_master','gw_project_plan_master.service_id', '=', 'service_request.id')
                // ->leftjoin('gw_master_customer','gw_master_customer.id', '=', 'service_request.customer')
                //->where('time_sheet_entry.emp_id', '=', $emp_id)
                //->where('time_sheet_entry.location_id', '=', $location)
                // ->groupby('emp_id')

                 ->when($startDate, function ($query) use ($startDate) {
                    return $query->where('time_sheet_entry.dated', '>=', $startDate);
                })

                ->when($endDate, function ($query) use ($endDate) {
                    return $query->where('time_sheet_entry.dated', '<=', $endDate);
                })

                ->get();
        }

        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $data = Session::all();

                $emp_id=$data['user']['emp_code'];
                if($table->emp_id == $emp_id){
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/time-sheet-edit') . "/" . "$table->id" . '">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;
            }
            })
      ->addColumn('dateformat', function ($table) {

                
                $formatted_dt1=Carbon::parse($table['dated'])->format('d/m/Y');

                return $formatted_dt1;

            })

            ->rawColumns(['action','roles','dateformat']);


        return $datatables->make(true);
    }

    public function downloadtimesheet(Request $request){

      $startDate = $endDate ='';
        if($request['startdate'] !='')
        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        if($request['enddate'] !='')
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');
        $segment = $request['segment'];
        $component = $request['component'];

        $data = Session::all();
         $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];

        if($location == '1' || $location == '2') {
            $table = TimeSheetEntry::select('time_sheet_entry.emp_name', 'emp_id', 'id', 'shift', 'dated', 'work_order', 'start_time', 'end_time','hours')
                ->where('time_sheet_entry.emp_id', '=', $emp_id)
                ->where('time_sheet_entry.location_id', '=', $location)

                 ->when($startDate, function ($query) use ($startDate) {
                    return $query->where('time_sheet_entry.dated', '>=', $startDate);
                })

                ->when($endDate, function ($query) use ($endDate) {
                    return $query->where('time_sheet_entry.dated', '<=', $endDate);
                })

                ->orderby('dated')
                ->get();
        }
        if($location == '3'){
            $table = TimeSheetEntry::select('time_sheet_entry.emp_name', 'emp_id', 'id', 'shift', 'dated', 'work_order', 'start_time', 'end_time','hours')

                 ->when($startDate, function ($query) use ($startDate) {
                    return $query->where('time_sheet_entry.dated', '>=', $startDate);
                })

                ->when($endDate, function ($query) use ($endDate) {
                    return $query->where('time_sheet_entry.dated', '<=', $endDate);
                })

                ->get();
        }



        $style = (new StyleBuilder())
            ->setFontBold()
            //  ->setBackgroundColor(Color::YELLOW)
            ->build();
        //$path = '/home/vhruqiyfkeq2/public_html/gcpl-quality/ComponentStatusFacility.xlsx';
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/TimeSheet.xlsx';
       // $path = "{{URL::asset('public/assets/download/ComponentStatusFacility.xlsx')}}";


        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [

              


                'ID' => $table['id'],
                'TECHNICIAN' => $table['emp_name'],                       
                'WO No' => $table['work_order'],
                'DATE' => $table['dated'],
                'SHIFT' => $table['shift'],
                'START Time' => $table['start_time'],
                'END Time' => $table['end_time'],
                'Total Hour' => $table['hours'],

                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);



    }



    public function timeSheetFilter(Request $request)
    {
        $data = Session::all();

//        $dept_id=$data['user']['section_id'];
        $emp_id=$data['user']['emp_code'];
        //$location=$data['user']['location_id'];
        $locationId = $request['location'];

        if($locationId != '3') {
            $table = TimeSheetEntry::select('time_sheet_entry.emp_name', 'emp_id', 'id', 'shift', 'dated', 'work_order', 'start_time', 'end_time','hours')
                //select('gw_project_plan_master.id', 'machine_modelno', 'gw_master_mc_model.model_no')
                //->leftjoin('gw_project_plan_master','gw_project_plan_master.service_id', '=', 'service_request.id')
                // ->leftjoin('gw_master_customer','gw_master_customer.id', '=', 'service_request.customer')
               // ->where('time_sheet_entry.emp_id', '=', $emp_id)
                ->where('time_sheet_entry.location_id', '=', $locationId)
                // ->groupby('emp_id')
                ->get();
        }
       else{
            $table = TimeSheetEntry::select('time_sheet_entry.emp_name', 'emp_id', 'id', 'shift', 'dated', 'work_order', 'start_time', 'end_time','hours')
                //select('gw_project_plan_master.id', 'machine_modelno', 'gw_master_mc_model.model_no')
                //->leftjoin('gw_project_plan_master','gw_project_plan_master.service_id', '=', 'service_request.id')
                // ->leftjoin('gw_master_customer','gw_master_customer.id', '=', 'service_request.customer')
                //->where('time_sheet_entry.emp_id', '=', $emp_id)
                //->where('time_sheet_entry.location_id', '=', $location)
                // ->groupby('emp_id')
                ->get();
        }

        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $data = Session::all();

                $emp_id=$data['user']['emp_code'];
                if($table->emp_id == $emp_id){
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/time-sheet-edit') . "/" . "$table->emp_id" . '">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;
            }
            })
			->addColumn('dateformat', function ($table) {

                
                $formatted_dt1=Carbon::parse($table['dated'])->format('d/m/Y');

                return $formatted_dt1;

            })

            ->rawColumns(['action','roles','dateformat']);


        return $datatables->make(true);
    }
    
    //Labour Job Activity
    public function labourJobActivitylisting()
    {
        return view('admin.report.labourJobActivityList');
    }
	
	public function labourJobActivityGetTable_old(Request $request)
    {
        //        $table=TimeSheetEntry::select('*')->get();,'service_request.service_request_no as service_request_no','users.name as name','users.emp_code as emp_code','gw_project_plan_master.status as job_status','gw_master_customer.name as cust','users.name as empname'
        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];
        if($location != '3') {
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
        ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
                ->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
        if($location == '3'){
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
                //->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
      //echo'<pre>';print_r($table);exit();
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
			->addColumn('dateformat', function ($table) {

                //dd($table['dated']);
                
                $formatted_dt1=Carbon::parse($table['dated'])->format('d/m/Y');

                return $formatted_dt1;

            })
			

            ->rawColumns(['action','roles','dateformat']);


        return $datatables->make(true);
    }

     public function labourJobActivityFilter_old(Request $request)
    {
        //        $table=TimeSheetEntry::select('*')->get();,'service_request.service_request_no as service_request_no','users.name as name','users.emp_code as emp_code','gw_project_plan_master.status as job_status','gw_master_customer.name as cust','users.name as empname'
        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
       // $location=$data['user']['location_id'];
         $locationId = $request['location'];
        if($locationId != '3') {
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
                ->where('time_sheet_entry.location_id', '=', $locationId)
                ->get();
        }
        if($locationId == '3'){
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
                //->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
        //        echo'<pre>';print_r($table);exit();
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
			->addColumn('dateformat', function ($table) {

         //dd($table['dated']);
                
                $formatted_dt1=Carbon::parse($table['dated'])->format('d/m/Y');

                return $formatted_dt1;

            })

            ->rawColumns(['action','roles','dateformat']);


        return $datatables->make(true);
    }

    public function labourJobActivityDateFilter_old(Request $request)
    {

        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
         $location=$data['user']['location_id'];

        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');

        //$startDate = date('d/m/Y', strtotime($request['startdate']));
        //$endDate =  date('d/m/Y', strtotime($request['enddate']));

        //        $startDate = $request['startdate'];
        //        $endDate =  $request['enddate'];
       //dd($startDate);

     $locationId = $request['location'];
        //print_r($locationId);
       //dd($location);
			if(!empty($startDate) && !empty($endDate)) {
				if($location == '3'){
				if($locationId != '3'){

				$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                    ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])


					->where('time_sheet_entry.dated', '>=', $startDate)
					->where('time_sheet_entry.dated', '<=', $endDate)
					->where('time_sheet_entry.location_id', '=', $locationId)

					->get();

				}
				if($locationId == '3'){

				$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                    ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])


					->where('time_sheet_entry.dated', '>=', $startDate)
					->where('time_sheet_entry.dated', '<=', $endDate)
					//->where('time_sheet_entry.location_id', '=', $locationId)

					->get();

				}
				}else{

					$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                        ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])


					->where('time_sheet_entry.dated', '>=', $startDate)
					->where('time_sheet_entry.dated', '<=', $endDate)
					->where('time_sheet_entry.location_id', '=', $location)

					->get();
				}
			}
        else{
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
                ->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
        // echo'<pre>';print_r($table);exit();
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
            ->addColumn('dateformat', function ($table) {

                //dd($table['dated']);

                $formatted_dt1=Carbon::parse($table['dated'])->format('d/m/Y');

                return $formatted_dt1;

            })

            ->rawColumns(['action','roles','dateformat']);


        return $datatables->make(true);
    }



    public function labourJobActivityGetTableold(Request $request)
    {
        //        $table=TimeSheetEntry::select('*')->get();,'service_request.service_request_no as service_request_no','users.name as name','users.emp_code as emp_code','gw_project_plan_master.status as job_status','gw_master_customer.name as cust','users.name as empname'
        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];
        if($location != '3') {
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
        ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
        if($location == '3'){
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                 ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                //->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
        // echo'<pre>';print_r($table);exit();
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
			->addColumn('dateformat', function ($table) {

         //dd($table['dated']);
                
                $formatted_dt1=Carbon::parse($table['dated'])->format('d/m/Y');

                return $formatted_dt1;

            })
			

            ->rawColumns(['action','roles','dateformat']);


        return $datatables->make(true);
    }

     public function labourJobActivityFilterold(Request $request)
    {
        //        $table=TimeSheetEntry::select('*')->get();,'service_request.service_request_no as service_request_no','users.name as name','users.emp_code as emp_code','gw_project_plan_master.status as job_status','gw_master_customer.name as cust','users.name as empname'
        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
       // $location=$data['user']['location_id'];
         $locationId = $request['location'];
        if($locationId != '3') {
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->where('time_sheet_entry.location_id', '=', $locationId)
                ->get();
        }
        if($locationId == '3'){
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                //->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
        // echo'<pre>';print_r($table);exit();
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
			->addColumn('dateformat', function ($table) {

         //dd($table['dated']);
                
                $formatted_dt1=Carbon::parse($table['dated'])->format('d/m/Y');

                return $formatted_dt1;

            })

            ->rawColumns(['action','roles','dateformat']);


        return $datatables->make(true);
    }

    public function labourJobActivityDateFilterold(Request $request)
    {

        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
         $location=$data['user']['location_id'];

        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');

        //$startDate = date('d/m/Y', strtotime($request['startdate']));
        //$endDate =  date('d/m/Y', strtotime($request['enddate']));

        //        $startDate = $request['startdate'];
        //        $endDate =  $request['enddate'];
       //dd($startDate);

        $locationId = $request['location'];
        //print_r($locationId);
       //dd($location);
			if(!empty($startDate) && !empty($endDate)) {
				if($location == '3'){
				if($locationId != '3'){
				
				$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status')
					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )

					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])


					->where('time_sheet_entry.dated', '>=', $startDate)
					->where('time_sheet_entry.dated', '<=', $endDate)
					->where('time_sheet_entry.location_id', '=', $locationId)

					->get();
			    
				}
				if($locationId == '3'){
				
				$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status')
					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )

					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])


					->where('time_sheet_entry.dated', '>=', $startDate)
					->where('time_sheet_entry.dated', '<=', $endDate)
					//->where('time_sheet_entry.location_id', '=', $locationId)

					->get();
			    
				}
				}else{
					
					$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status')
					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )

					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])


					->where('time_sheet_entry.dated', '>=', $startDate)
					->where('time_sheet_entry.dated', '<=', $endDate)
					->where('time_sheet_entry.location_id', '=', $location)

					->get();
				}
			}
        else{
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )

                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
        // echo'<pre>';print_r($table);exit();
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
            ->addColumn('dateformat', function ($table) {

                //dd($table['dated']);

                $formatted_dt1=Carbon::parse($table['dated'])->format('d/m/Y');

                return $formatted_dt1;

            })

            ->rawColumns(['action','roles','dateformat']);


        return $datatables->make(true);
    }

    public function labourJobActivityGetTable(Request $request)
    {
        //        $table=TimeSheetEntry::select('*')->get();,'service_request.service_request_no as service_request_no','users.name as name','users.emp_code as emp_code','gw_project_plan_master.status as job_status','gw_master_customer.name as cust','users.name as empname'
        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];
        if($location != '3') {
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
                ->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
        if($location == '3'){
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
                //->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
        //echo'<pre>';print_r($table);exit();
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
			->addColumn('dateformat', function ($table) {

            //dd($table['']);
                
                $formatted_dt1=Carbon::parse($table['dated'])->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('createdatformat', function ($table) {

                
                $formatted_dt1=Carbon::parse($table['created_at'])->format('d/m/Y H:i:s');

                return $formatted_dt1;

            })
			->addColumn('hours', function ($table) {

                
                $hours=str_replace(':','.',$table['hours']);

                return $hours;

            })

            ->rawColumns(['action','roles','dateformat','createdatformat']);


        return $datatables->make(true);
    }

    public function labourJobActivityFilter(Request $request)
    {
        //        $table=TimeSheetEntry::select('*')->get();,'service_request.service_request_no as service_request_no','users.name as name','users.emp_code as emp_code','gw_project_plan_master.status as job_status','gw_master_customer.name as cust','users.name as empname'
        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
       // $location=$data['user']['location_id'];
         $locationId = $request['location'];
        if($locationId != '3') {
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
                ->where('time_sheet_entry.location_id', '=', $locationId)
                ->get();
        }
        if($locationId == '3'){
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
                //->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
        // echo'<pre>';print_r($table);exit();
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
			->addColumn('dateformat', function ($table) {

         //dd($table['dated']);
                
                $formatted_dt1=Carbon::parse($table['dated'])->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('createdatformat', function ($table) {

                
                $formatted_dt1=Carbon::parse($table['created_at'])->format('d/m/Y H:i:s');

                return $formatted_dt1;

            })
            ->addColumn('hours', function ($table) {

                
                $hours=str_replace(':','.',$table['hours']);

                return $hours;

            })

            ->rawColumns(['action','roles','dateformat','createdatformat']);


        return $datatables->make(true);
    }

     public function labourJobActivityDateFilter(Request $request)
    {

        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
         $location=$data['user']['location_id'];

        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');

        //$startDate = date('d/m/Y', strtotime($request['startdate']));
        //$endDate =  date('d/m/Y', strtotime($request['enddate']));

        //        $startDate = $request['startdate'];
        //        $endDate =  $request['enddate'];
       //dd($startDate);

        $locationId = $request['location'];
        //print_r($locationId);
       //dd($location);
			if(!empty($startDate) && !empty($endDate)) {
				if($location == '3'){
				if($locationId != '3'){

				$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                    ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])


					->where('time_sheet_entry.dated', '>=', $startDate)
					->where('time_sheet_entry.dated', '<=', $endDate)
					->where('time_sheet_entry.location_id', '=', $locationId)

					->get();

				}
				if($locationId == '3'){

				$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                    ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])


					->where('time_sheet_entry.dated', '>=', $startDate)
					->where('time_sheet_entry.dated', '<=', $endDate)
					//->where('time_sheet_entry.location_id', '=', $locationId)

					->get();

				}
				}else{

					$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                        ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])


					->where('time_sheet_entry.dated', '>=', $startDate)
					->where('time_sheet_entry.dated', '<=', $endDate)
					->where('time_sheet_entry.location_id', '=', $location)

					->get();
				}
			}
        else{
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
                ->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
        //echo'<pre>';print_r($table);exit();
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
            ->addColumn('dateformat', function ($table) {

                //dd($table['dated']);

                $formatted_dt1=Carbon::parse($table['dated'])->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('createdatformat', function ($table) {

                
                $formatted_dt1=Carbon::parse($table['created_at'])->format('d/m/Y H:i:s');

                return $formatted_dt1;

            })
            ->addColumn('hours', function ($table) {

                
                $hours=str_replace(':','.',$table['hours']);

                return $hours;

            })
            ->rawColumns(['action','roles','dateformat','createdatformat']);
           


        return $datatables->make(true);
    }


     public function labourJobActivitydownload(Request $request)
    {

        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
         $location=$data['user']['location_id'];

         $startDate = $endDate ='';
        if($request['startdate'] !='')
        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        if($request['enddate'] !='')
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');


        //$startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
       // $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');

        //$startDate = date('d/m/Y', strtotime($request['startdate']));
        //$endDate =  date('d/m/Y', strtotime($request['enddate']));

        // $startDate = $request['startdate'];
        // $endDate =  $request['enddate'];
       //dd($startDate);

        $locationId = $request['location'];
        //print_r($locationId);
       //dd($location);
      if(!empty($startDate) && !empty($endDate)) {
        if($location == '3'){
        if($locationId != '3'){

        $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
          // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
          ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
          ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                    ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
           // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])


          ->where('time_sheet_entry.dated', '>=', $startDate)
          ->where('time_sheet_entry.dated', '<=', $endDate)
          ->where('time_sheet_entry.location_id', '=', $locationId)

          ->get();

        }
        if($locationId == '3'){

        $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
          // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
          ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
          ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                    ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
           // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])


          ->where('time_sheet_entry.dated', '>=', $startDate)
          ->where('time_sheet_entry.dated', '<=', $endDate)
          //->where('time_sheet_entry.location_id', '=', $locationId)

          ->get();

        }
        }else{

          $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
          // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
          ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
          ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                        ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
           // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])


          ->where('time_sheet_entry.dated', '>=', $startDate)
          ->where('time_sheet_entry.dated', '<=', $endDate)
          ->where('time_sheet_entry.location_id', '=', $location)

          ->get();
        }
      }
        else{
            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
                ->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
        $style = (new StyleBuilder())
            ->setFontBold()
            //  ->setBackgroundColor(Color::YELLOW)
            ->build();
        //$path = '/home/vhruqiyfkeq2/public_html/gcpl-quality/Jobdetails.xlsx';
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/labourJobActivity.xlsx';
        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [

                'ID' => $table['id'],
                'SIFT' => $table['shift'],
                'Dateformat' => $table['dateformat'],
                'DEPT' => $table['dept'],
                'WORK ORDER' => $table['work_order'],
                'DESCRIPTION' => $table['description'],
                'CUSTOMER' => $table['cust'],
                'TECHNICIAN' => $table['emp_name'],
                'EMP CODE' => $table['emp_id'],
                'JOB DETAILS' =>$table['job_summery'],
                'START TIME' => $table['start_time'],
                'END TIME' => $table['end_time'],
                'TOTAL HOURS' => $table['hours'],
                'JOB STATUS' => $table['job_status'],
                'REMARKS' =>$table['remarks'],

            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }




 public function labourGraph(Request $request)
    {

        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
         $location=$data['user']['location_id'];

        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');
        $dept = $request['section'];
        //$startDate = date('d/m/Y', strtotime($request['startdate']));
        //$endDate =  date('d/m/Y', strtotime($request['enddate']));

//        $startDate = $request['startdate'];
//        $endDate =  $request['enddate'];
       //dd($startDate);

     $locationId = $request['location'];
        //print_r($locationId);
       //dd($location);
			if(!empty($startDate) && !empty($endDate)) {
				if($location == '3'){
				if($locationId != '3'){

//				$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
//					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
//                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
//					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
//					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
//                    ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
//				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])
//
//
//					->where('time_sheet_entry.dated', '>=', $startDate)
//					->where('time_sheet_entry.dated', '<=', $endDate)
//					->where('time_sheet_entry.location_id', '=', $locationId)
//
//					->get();

                    $qry = DB::select(DB::raw("SELECT SUM(hours) AS totalhour ,  work_order ,task
        FROM time_sheet_entry t where t.task = $dept And t.dated >= '".$startDate."' And t.dated <= '".$endDate."' And t.location_id = $locationId
        GROUP BY t.task, t.work_order "));

				}
				if($locationId == '3'){



                    $qry = DB::select(DB::raw("SELECT SUM(hours) AS totalhour , task, work_order 
        FROM time_sheet_entry t where t.task = $dept And t.dated >= '".$startDate."' And t.dated <= '".$endDate."' 
        GROUP BY t.task, t.work_order "));

				}
				}else{

//					$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
//					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
//                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
//					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
//					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
//                        ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
//				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])
//
//
//					->where('time_sheet_entry.dated', '>=', $startDate)
//					->where('time_sheet_entry.dated', '<=', $endDate)
//					->where('time_sheet_entry.location_id', '=', $location)
//
//					->get();
                    $qry = DB::select(DB::raw("SELECT SUM(hours) AS totalhour , task, work_order 
        FROM time_sheet_entry t where t.task = $dept And t.dated >= '".$startDate."' And t.dated <= '".$endDate."' And t.location_id = $location
        GROUP BY t.task, t.work_order "));
				}
			}
        else{
//            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
//                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
//                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
//                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
//                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
//                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
//                ->where('time_sheet_entry.location_id', '=', $location)
//                ->get();
            $qry = DB::select(DB::raw("SELECT SUM(hours) AS totalhour , task, work_order 
        FROM time_sheet_entry t where t.task = $dept And t.location_id = $location
        GROUP BY t.task, t.work_order "));
        }

//              $tabe = TimeSheetEntry::select(SUM(hours) AS totalhour)
//
//                  ->groupby('task','work_order')
//                  ->get();
//         $dept = 4;
//         $qry = DB::select(DB::raw("SELECT SUM(hours) AS totalhour ,  work_order
//        FROM time_sheet_entry t where t.task = $dept
//        GROUP BY  t.work_order "));



     // echo'<pre>';print_r($qry);exit();
         if(!empty($qry)) {
             foreach ($qry as $oneval) {
                 //dd($oneval->work_order);die;

                 //$depart[]="'".$oneval->name."'";
                 //$dept = implode(',',$depart);
                 //$json[] = $oneval->work_order.'-'. $oneval->totalhour;
                 //$json = ['{'.'name:'.$oneval->work_order.'}'. $oneval->totalhour.'}'];
                 // $json_val = [$oneval->work_order.'-'. $oneval->totalhour .'-'. $oneval->name];
                 $json1[] = $oneval->work_order;
                 $json2[] = $oneval->totalhour;

                 $wono = json_encode($json1);
                 $wono1 = json_encode($json2);

             }
             $labour = $wono . '-' . $wono1;
             //foreach($wono)
             //echo '<pre>'; print_r($json2); exit;

             echo $labour;
         }else{
             echo 'failure';
         }
          // exit;

    }

   public function labourTechGraph(Request $request)
    {

        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];

        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');
        $dept = $request['section'];
        //$startDate = date('d/m/Y', strtotime($request['startdate']));
        //$endDate =  date('d/m/Y', strtotime($request['enddate']));

//        $startDate = $request['startdate'];
//        $endDate =  $request['enddate'];
       //dd($startDate);

     $locationId = $request['location'];
        //print_r($locationId);
       //dd($location);
			if(!empty($startDate) && !empty($endDate)) {
				if($location == '3'){
				if($locationId != '3'){

//				$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
//					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
//                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
//					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
//					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
//                    ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
//				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])
//
//
//					->where('time_sheet_entry.dated', '>=', $startDate)
//					->where('time_sheet_entry.dated', '<=', $endDate)
//					->where('time_sheet_entry.location_id', '=', $locationId)
//
//					->get();

                    $qry = DB::select(DB::raw("SELECT SUM(hours) AS totalhour ,  emp_name ,task
        FROM time_sheet_entry t where t.task = $dept And t.dated >= '".$startDate."' And t.dated <= '".$endDate."' And t.location_id = $locationId
        GROUP BY t.task, t.emp_name "));

				}
				if($locationId == '3'){



                    $qry = DB::select(DB::raw("SELECT SUM(hours) AS totalhour , task, emp_name 
        FROM time_sheet_entry t where t.task = $dept And t.dated >= '".$startDate."' And t.dated <= '".$endDate."' 
        GROUP BY t.task, t.emp_name "));

				}
				}else{

//					$table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
//					// ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
//                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
//					->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
//					->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
//                        ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
//				   // ->whereBetween('time_sheet_entry.dated', [$startDate, $endDate])
//
//
//					->where('time_sheet_entry.dated', '>=', $startDate)
//					->where('time_sheet_entry.dated', '<=', $endDate)
//					->where('time_sheet_entry.location_id', '=', $location)
//
//					->get();
                    $qry = DB::select(DB::raw("SELECT SUM(hours) AS totalhour , task, emp_name  FROM time_sheet_entry t where t.task = $dept And t.dated >= '".$startDate."' And t.dated <= '".$endDate."' And t.location_id = $location
        GROUP BY t.task, t.emp_name "));
				}
			}
        else{
//            $table = TimeSheetEntry::select('time_sheet_entry.*', 'gw_master_department.name as dept', 'gw_project_plan_master.status as job_status','gw_master_customer.name as cust','service_request.description')
//                // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )
//                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'time_sheet_entry.cust_name')
//                ->leftjoin('gw_project_plan_master', 'gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')
//                ->leftjoin('gw_master_department', 'gw_master_department.id', '=', 'time_sheet_entry.task')
//                ->leftjoin('service_request', 'service_request.work_orderno', '=', 'time_sheet_entry.work_order')
//                ->where('time_sheet_entry.location_id', '=', $location)
//                ->get();
            $qry = DB::select(DB::raw("SELECT SUM(hours) AS totalhour , task, emp_name 
        FROM time_sheet_entry t where t.task = $dept And t.location_id = $location
        GROUP BY t.task, t.emp_name "));
        }

//              $tabe = TimeSheetEntry::select(SUM(hours) AS totalhour)
//
//                  ->groupby('task','work_order')
//                  ->get();
//         $dept = 4;
//         $qry = DB::select(DB::raw("SELECT SUM(hours) AS totalhour ,  work_order
//        FROM time_sheet_entry t where t.task = $dept
//        GROUP BY  t.work_order "));



     // echo'<pre>';print_r($qry);exit();
         if(!empty($qry)) {
             foreach ($qry as $oneval) {
                 //dd($oneval->work_order);die;

                 //$depart[]="'".$oneval->name."'";
                 //$dept = implode(',',$depart);
                 //$json[] = $oneval->work_order.'-'. $oneval->totalhour;
                 //$json = ['{'.'name:'.$oneval->work_order.'}'. $oneval->totalhour.'}'];
                 // $json_val = [$oneval->work_order.'-'. $oneval->totalhour .'-'. $oneval->name];
                 $json1[] = $oneval->emp_name;
                 $json2[] = $oneval->totalhour;

                 $wono = json_encode($json1);
                 $wono1 = json_encode($json2);

             }
             $labour = $wono . '-' . $wono1;
             //foreach($wono)
             //echo '<pre>'; print_r($json2); exit;

             echo $labour;
         }else{
             echo 'failure';
         }
          // exit;

    }


    public function labourTimeUpdate(Request $request){
      $id = $request['id'];
      $time =  $request['value'];

      $query = DB::table('time_sheet_entry')
              ->where('id', $id)  // find your user by their email
              ->update(array('hours' => $time));  // update the record in the DB.


      return $time;
    }

 public function downloadlabourJobActivity()
    {
        $table =TimeSheetEntry::select('time_sheet_entry.*','gw_master_department.name as dept','gw_project_plan_master.status as job_status')

            // ->leftjoin('service_request','service_request.service_request_no', '=','time_sheet_entry.service_req' )

            ->leftjoin('gw_project_plan_master','gw_project_plan_master.workorder', '=', 'time_sheet_entry.work_order')

            ->leftjoin('gw_master_department','gw_master_department.id', '=','time_sheet_entry.task')

            ->get();
        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/LabourJobActivity.xlsx';
        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [

                //'id' => $table['id'],

                'Date' => $table['dated'],
                'Shift' => $table['shift'],
                'Section' => $table['dept'],
                'WO Number' => $table['work_order'],
                'Customer' => $table['cust_name'],
                'Technician' => $table['emp_name'],
                'Emp Code' => $table['emp_id'],
                'Details Of Job' => $table['job_summery'],
                'Start Time' => $table['start_time'],
                'End Time' => $table['end_time'],
                'Toal Time' =>$table['hours'],
                'Job Status ' =>$table['job_status'],
                'Remarks' =>$table['remarks'],
//                'Job Type 2' => $table['job_status'],
//                'Section Supervisor' => $table['remarks'],
//                'Column 2' => $table['sec_name'],
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }
    
     //Bis Report

    public function bisReportlisting()
    {
        return view('admin.report.bisReportList');
    }

    public function bisReportGetTable(Request $request)
    {

        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];


        if($location != '3') {
            $table = MasterBis::select('gw_master_bis_checksheet.*', 'gw_master_customer.name as cust','service_request.work_orderno as workorder')
                ->leftjoin('service_request', 'service_request.id', '=', 'gw_master_bis_checksheet.service_request_id')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $location)
                ->get();

        }
        if($location == '3'){
            $table = MasterBis::select('gw_master_bis_checksheet.*', 'gw_master_customer.name as cust','service_request.work_orderno as workorder')
                ->leftjoin('service_request', 'service_request.id', '=', 'gw_master_bis_checksheet.service_request_id')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                //->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
       //echo'<pre>';print_r($table);exit();
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
            ->addColumn('dateformat', function ($table) {

                //dd($table['dated']);

                $formatted_dt1=Carbon::parse($table['engine_enter_date_time_in_the_test_bench'])->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('actualstartdate', function ($table) {

                //dd($table['dated']);

                $formatted_dt1=Carbon::parse($table['actual_start_date'])->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('actualenddate', function ($table) {

                //dd($table['dated']);

                $formatted_dt1=Carbon::parse($table['actual_end_date'])->format('d/m/Y');

                return $formatted_dt1;

            })


            ->rawColumns(['action','roles','dateformat','actualstartdate','actualenddate']);


        return $datatables->make(true);
    }

    public function bisReportFilter(Request $request)
    {

        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
        // $location=$data['user']['location_id'];
        $locationId = $request['location'];
        if($locationId != '3') {
            $table = MasterBis::select('gw_master_bis_checksheet.*', 'gw_master_customer.name as cust','service_request.work_orderno as workorder')
                ->leftjoin('service_request', 'service_request.id', '=', 'gw_master_bis_checksheet.service_request_id')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                ->where('service_request.location_id', '=', $locationId)
                ->get();
        }
        if($locationId == '3'){
            $table = MasterBis::select('gw_master_bis_checksheet.*', 'gw_master_customer.name as cust','service_request.work_orderno as workorder')
                ->leftjoin('service_request', 'service_request.id', '=', 'gw_master_bis_checksheet.service_request_id')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                //->where('time_sheet_entry.location_id', '=', $location)
                ->get();
        }
//        echo'<pre>';print_r($table);exit();
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
            ->addColumn('dateformat', function ($table) {

                //dd($table['dated']);

                $formatted_dt1=Carbon::parse($table['engine_enter_date_time_in_the_test_bench'])->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('actualstartdate', function ($table) {

                //dd($table['dated']);

                $formatted_dt1=Carbon::parse($table['actual_start_date'])->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('actualenddate', function ($table) {

                //dd($table['dated']);

                $formatted_dt1=Carbon::parse($table['actual_end_date'])->format('d/m/Y');

                return $formatted_dt1;

            })


            ->rawColumns(['action','roles','dateformat','actualstartdate','actualenddate']);


        return $datatables->make(true);
    }

    public function bisReportDateFilter(Request $request)
    {

        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];

        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');

        //$startDate = date('d/m/Y', strtotime($request['startdate']));
        //$endDate =  date('d/m/Y', strtotime($request['enddate']));

//        $startDate = $request['startdate'];
//        $endDate =  $request['enddate'];
        //dd($startDate);

        $locationId = $request['location'];
        //print_r($locationId);
        //dd($location);
        if(!empty($startDate) && !empty($endDate)) {
            if($location == '3'){
                if($locationId != '3'){

                    $table = MasterBis::select('gw_master_bis_checksheet.*', 'gw_master_customer.name as cust','service_request.work_orderno as workorder')
                        ->leftjoin('service_request', 'service_request.id', '=', 'gw_master_bis_checksheet.service_request_id')
                        ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                        ->where('gw_master_bis_checksheet.actual_start_date', '>=', $startDate)
                        ->where('gw_master_bis_checksheet.actual_end_date', '<=', $endDate)
                        ->where('service_request.location_id', '=', $locationId)
                        ->get();


                }
                if($locationId == '3'){

                    $table = MasterBis::select('gw_master_bis_checksheet.*', 'gw_master_customer.name as cust','service_request.work_orderno as workorder')
                        ->leftjoin('service_request', 'service_request.id', '=', 'gw_master_bis_checksheet.service_request_id')
                        ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                        ->where('gw_master_bis_checksheet.actual_start_date', '>=', $startDate)
                        ->where('gw_master_bis_checksheet.actual_end_date', '<=', $endDate)
                       // ->where('service_request.location_id', '=', $locationId)
                        ->get();
                }
            }else{

                $table = MasterBis::select('gw_master_bis_checksheet.*', 'gw_master_customer.name as cust','service_request.work_orderno as workorder')
                    ->leftjoin('service_request', 'service_request.id', '=', 'gw_master_bis_checksheet.service_request_id')
                    ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
                    ->where('gw_master_bis_checksheet.actual_start_date', '>=', $startDate)
                    ->where('gw_master_bis_checksheet.actual_end_date', '<=', $endDate)
                    ->where('service_request.location_id', '=', $location)
                    ->get();

            }
        }
        else{
            $table = MasterBis::select('gw_master_bis_checksheet.*', 'gw_master_customer.name as cust','service_request.work_orderno as workorder')
                ->leftjoin('service_request', 'service_request.id', '=', 'gw_master_bis_checksheet.service_request_id')
                ->leftjoin('gw_master_customer', 'gw_master_customer.id', '=', 'service_request.customer')
               // ->where('gw_master_bis_checksheet.actual_start_date', '>=', $startDate)
               // ->where('gw_master_bis_checksheet.actual_end_date', '<=', $endDate)
                ->where('service_request.location_id', '=', $location)
                ->get();

        }
//        echo'<pre>';print_r($table);exit();
        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;

            })
            ->addColumn('dateformat', function ($table) {

                //dd($table['dated']);

                $formatted_dt1=Carbon::parse($table['engine_enter_date_time_in_the_test_bench'])->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('actualstartdate', function ($table) {

                //dd($table['dated']);

                $formatted_dt1=Carbon::parse($table['actual_start_date'])->format('d/m/Y');

                return $formatted_dt1;

            })
            ->addColumn('actualenddate', function ($table) {

                //dd($table['dated']);

                $formatted_dt1=Carbon::parse($table['actual_end_date'])->format('d/m/Y');

                return $formatted_dt1;

            })


            ->rawColumns(['action','roles','dateformat','actualstartdate','actualenddate']);


        return $datatables->make(true);
    }



  //super admin
    public function userAdd()
    {
        $title='Add User';


        return view('admin.user.addUser');
    }

    public function userAddStore(UserRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj =new User();
        $obj->username = $request['username'];
        $obj->email = $request['email'];
        $obj->password=Hash::make($request['password']);

        $obj->status = $request['status'];
        $obj->save();

        //Assign Role
        foreach ($request['role'] as $role){
            $obj->assignRole($role);
        }


        return redirect('admin/super-admin-dashboard');

    }

    public function userList()
    {
        return view('admin.user.listUser');
    }

    public function getTableUser(Request $request)
    {

        $table =User::select('*')->get();


        $datatables =  Datatables::of($table)
            ->addColumn('roles', function ($table) {
                $str="";
                $roles=$table->getRoleNames();
                foreach($roles as $arrRole){
                    $rol_uc = str_replace("_"," ",$arrRole);
                    $rol_uc = ucwords($rol_uc);
                   $str .= $rol_uc.", ";
                }
                $roles=substr($str, 0, -2);

                return $roles;
            })

            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/user-edit')."/"."$table->id".'">EDIT</a>
                                                
                                            </div>
                                        </div>';

                return $btns;
                //$btns = ' <a href="' . url('admin/user-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';
                //  $btns .=' <a href="' . url('admin/cms-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                //return $btns;
            })

            ->rawColumns(['action','roles']);


        return $datatables->make(true);
    }

    public function userEdit($id)
    {
        $title='Edit User';
        $arrroles=[];
        $user=User::find($id);
        $roles=$user->getRoleNames();
        foreach($roles as $arrRole){
            array_push($arrroles, $arrRole);
        }
        $user->role=$arrroles;
        return view('admin.user.editUser')
            ->with('user',$user);
    }

    public function userEditStore(UserEditRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($request);

        $obj=User::find($request['id']);
        $obj->username = $request['username'];

        $obj->email = $request['email'];
        if($request['password']!=NULL){
            $obj->password=Hash::make($request['password']);
        };

        $obj->status = $request['status'];
        $obj->save();

        //Delete Role
        $obj->roles()->detach();

        foreach ($request['role'] as $role){
            $obj->assignRole($role);
        }
        //$obj->removeRole($request['role']);

        //$obj->assignRole($request['role']);


        return redirect('admin/super-admin-dashboard');

    }
	public function changePassword(){

        $msg='hii';
        return view('admin.user.changePassword')
        ->with('msg',$msg);
    }

    public function changePasswordSave(OtpFormRequest $request){

        $session = $request->session()->all();


        $user_id=$session['user']['user_id'];



        $obj=User::find($user_id);
        //dd($obj);
        if(isset($obj->id)){
            $obj->password=Hash::make($request['password']);
            //$obj->otp=Null;
            $obj->save();
            //return redirect('admin/change-password')
            return view('admin.user.changePassword')
                ->with('msg','success');
        }else{
            //return redirect('admin/change-password')
            return view('admin.user.changePassword')
                ->with('msg','error');
        }
    }
	
	//coded by amanur start
	
	//capacity utilization

     public function capacityUtilizationlisting(Request $request)
    {
        $data = Session::all();
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];
        $year = date("Y");
        #$request->input('year');
        $checked = $request->has('year') ? true: false;
        if($checked){
          $year = $request->input('year');
        }

        $pageData = array();
        if($location != '3') {

          /*FOR ENGINE CI START******/

          $component_name = 'Engine';
          $segment_CI = array('Construction','Machine Sales');
          $get_ci_data = $this->capacityUtilizationlistingQuery($component_name,$segment_CI,$location,$year);
            if(count($get_ci_data) > 0){
                $ci_actual_count = $get_ci_data['actual_count'];
                $ci_actual_uti = $get_ci_data['actual_uti'];
                $pageData[] = array("model"=>"Engine-CI","actual"=>$ci_actual_count,"actual_uti"=>$ci_actual_uti,"order"=>1);
            }else{
              $pageData[] = array("model"=>"Engine-CI","actual"=>0,"actual_uti"=>0,"order"=>1);
            }
          /*END ENGINE CI**/

          /*FOR ENGINE Mining START******/
          $component_name = 'Engine';
          $segment_mining = array('Mining','MARC');
          $mining = $this->capacityUtilizationlistingQuery($component_name,$segment_mining,$location,$year);
            if(count($mining) > 0){
                $mining_actual_count = $mining['actual_count'];
                $mining_actual_uti = $mining['actual_uti'];
                $pageData[] = array("model"=>"Engine-MINING","actual"=>$mining_actual_count,"actual_uti"=>$mining_actual_uti,"order"=>1);
            }else{
              $pageData[] = array("model"=>"Engine-MINING","actual"=>0,"actual_uti"=>0,"order"=>1);
            }
          /*END ENGINE mining**/

         /*FOR ENGINE E & T START******/
          $component_name = 'Engine';
          $segment_EandT = array('OEM','EPD','Petro','Marine');
          $e_t = $this->capacityUtilizationlistingQuery($component_name,$segment_EandT,$location,$year);
            if(count($e_t) > 0){
                $e_t_actual_count = $e_t['actual_count'];
                $e_t_actual_uti = $e_t['actual_uti'];
                $pageData[] = array("model"=>"Engine-E&T","actual"=>$e_t_actual_count,"actual_uti"=>$e_t_actual_uti,"order"=>1);
            }else{
              $pageData[] = array("model"=>"Engine-E&T","actual"=>0,"actual_uti"=>0,"order"=>1);
            }
          /*END ENGINE**/
          /*************************************************************/
          #transmission start
          $component_name_tr = 'Transmission';
          $segment_CI = array('Construction','Machine Sales');
          $tr_ci = $this->capacityUtilizationlistingQuery($component_name_tr,$segment_CI,$location,$year);
            if(count($tr_ci) > 0){
                $tr_ci_actual_count = $tr_ci['actual_count'];
                $tr_ci_actual_uti = $tr_ci['actual_uti'];
                $pageData[] = array("model"=>"Transmission-CI","actual"=>$tr_ci_actual_count,"actual_uti"=>$tr_ci_actual_uti,"order"=>2);
            }else{
              $pageData[] = array("model"=>"Transmission-CI","actual"=>0,"actual_uti"=>0,"order"=>2);
            }
          /************************/


          $segment_mining = array('Mining','MARC');
          $mining_tra = $this->capacityUtilizationlistingQuery($component_name_tr,$segment_CI,$location,$year);
            if(count($mining_tra) > 0){
                $mining_tra_actual_count = $mining_tra['actual_count'];
                $mining_tra_actual_uti = $mining_tra['actual_uti'];
                $pageData[] = array("model"=>"Transmission-MINING","actual"=>$mining_tra_actual_count,"actual_uti"=>$mining_tra_actual_uti,"order"=>2);
            }else{
              $pageData[] = array("model"=>"Transmission-MINING","actual"=>0,"actual_uti"=>0,"order"=>2);
            }
          

          #transmission end
            /******************************************/

          #Hydraulics start
          $component_name_hy = 'Hydraulics Cylinder';
          $segment_CI_hy = array('Construction','Machine Sales');
          $hy_ci = $this->capacityUtilizationlistingQuery($component_name_hy,$segment_CI_hy,$location,$year);
            if(count($hy_ci) > 0){
                $hy_ci_actual_count = $hy_ci['actual_count'];
                $hy_ci_actual_uti = $hy_ci['actual_uti'];
                $pageData[] = array("model"=>"Hydraulics Cylinder-CI","actual"=>$hy_ci_actual_count,"actual_uti"=>$hy_ci_actual_uti,"order"=>3);
            }else{
              $pageData[] = array("model"=>"Hydraulics Cylinder-CI","actual"=>0,"actual_uti"=>0,"order"=>3);
            }

         /********************************************/


          $segment_mining_hy = array('Mining','MARC');
          $mining_hy = $this->capacityUtilizationlistingQuery($component_name_hy,$segment_mining_hy,$location,$year);
            if(count($mining_hy) > 0){
                $mining_hy_actual_count = $mining_hy['actual_count'];
                $mining_hy_actual_uti = $mining_hy['actual_uti'];
                $pageData[] = array("model"=>"Hydraulics Cylinder-MINING","actual"=>$mining_hy_actual_count,"actual_uti"=>$mining_hy_actual_uti,"order"=>3);
            }else{
              $pageData[] = array("model"=>"Hydraulics Cylinder-MINING","actual"=>0,"actual_uti"=>0,"order"=>3);
            }
          #Hydraulics end
          
        }
        $list = $this->array_sort($pageData, 'order', SORT_ASC);


       
        return view('admin.report.capacityUtilizationList')->with('data',$list)->with('year', $year);;
    }

    public function capacityUtilizationlistingQuery($component_name,$segment,$location,$year){
      $bay_sum = 0;
        $query = CapacityUtilization::select('service_request.id','gw_master_aggregate.bay_no') 
              ->join('gw_master_aggregate', 'gw_master_aggregate.service_request_id', '=', 'service_request.id')
              ->join('gw_master_engine_assembly_checksheet','gw_master_engine_assembly_checksheet.service_request_id','=','service_request.id')
              ->where('service_request.component_name', '=', $component_name)
              ->whereIn('service_request.segment',$segment)
              ->where('service_request.location_id', '=', $location)
              ->where('gw_master_aggregate.bay_no','!=',null)
              ->where('gw_master_engine_assembly_checksheet.bay_no','!=',null)
              ->where('gw_master_aggregate.actual_end_date','!=',null)
              ->where('gw_master_engine_assembly_checksheet.actual_end_date','!=',null)
              ->whereYear('gw_master_aggregate.actual_end_date', '=', $year)
              ->get();



              if(count($query) > 0){
                $actual_count = $query->count();
                foreach ($query as $key => $query_val) {
                  if($component_name=='Engine')
                  {
                    $bay_multiply = $this->engineCal($query_val->bay_no,$location);
                    $bay_sum += $bay_multiply; 
                  }elseif ($component_name=='Transmission') {
                    $bay_multiply = $this->transmissionCal($query_val->bay_no,$location);
                    $bay_sum += $bay_multiply;
                  }
                  elseif ($component_name=='Hydraulics Cylinder') {
                    $bay_multiply = $this->hydraulicCal($query_val->bay_no,$location);
                    $bay_sum += $bay_multiply;
                  }
                }
                 $actualUtiVal = ($actual_count)/$bay_sum;
                 $actualUti = round($actualUtiVal, 2);
                 return array("actual_count"=>$actual_count,"actual_uti"=>$actualUti);
            }else{
                 $actualUti = 0;
                 $actual_count = 0;
                 return array("actual_count"=>$actual_count,"actual_uti"=>$actualUti);
            }
    }

    public function engineCal($bay_no,$location){
      if($location==1){
        //Asansol
          if($bay_no==1){
            return 2*12;
          }elseif ($bay_no==2) {
            return 2*12;
          }elseif ($bay_no==3) {
            return 3*12;
          }elseif ($bay_no==4 || $bay_no==5 || $bay_no==6) {
            return 5*12;
          }else{
            return 0;
          }

      }elseif ($location==2) {
        //unnati
        if($bay_no==1){
            return 4*12;
          }elseif ($bay_no==2) {
            return 4*12;
          }elseif ($bay_no==3) {
            return 5*12;
          }elseif ($bay_no==4 || $bay_no==5) {
            return 2*12;
          }else{
            return 0;
          }
      }
    }
    public function transmissionCal($bay_no,$location){
      if($location==1){
        //Asansol
          if($bay_no==1){
            return 5*12;
          }elseif ($bay_no==2) {
            return 7*12;
          }else{
            return 0;
          }

      }elseif ($location==2) {
        //unnati
        if($bay_no==1){
            return 1*12;
          }elseif ($bay_no==2) {
            return 3*12;
          }elseif ($bay_no==3) {
            return 3*12;
          }elseif ($bay_no==4) {
            return 3*12;
          }else{
            return 0;
          }
      }
    }
    public function hydraulicCal($bay_no,$location){
      if($location==1){
        //Asansol
          return 60;

      }elseif ($location==2) {
        //unnati
        if($bay_no==3){
            return 5*12;
          }elseif ($bay_no==4) {
            return 4*12;
          }else{
            return 0;
          }
      }
    }



    public function array_sort($array, $on, $order=SORT_ASC){

    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}


    
    public function capacityUtilizationGetTable(Request $request)
    {

        $data = Session::all();
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];
        if($location != '3') {
          //SELECT COUNT(a.id) as actual FROM `service_request` as a JOIN gw_master_aggregate as b  ON a.service_request_no = b.service_request_id WHERE a.component_name='Engine' AND (a.segment = 'OEM' OR a.segment = 'EPD' OR a.segment = 'Petro' OR a.segment='Marine') AND b.work_done='1' AND YEAR(b.actual_end_date) = '2021'

          //SELECT COUNT(a.id) as actual FROM `service_request` as a LEFT JOIN gw_master_aggregate as b  ON a.service_request_no = b.service_request_id WHERE a.component_name='Engine' AND (a.segment = 'OEM' OR a.segment = 'EPD' OR a.segment = 'Petro' OR a.segment='Marine') AND YEAR(b.actual_end_date) ='2020'

          $component_name = 'Engine';
          $segment_EandT = array('OEM','EPD','Petro','Marine');
              $table = CapacityUtilization::select(DB::raw('count(service_request.id) as actual')) 
              ->leftjoin('gw_master_aggregate', 'gw_master_aggregate.id', '=', 'service_request.id')
              ->where('service_request.component_name', '=', $component_name)
              ->whereIn('service_request.segment',$segment_EandT)
              ->where('service_request.location_id', '=', $location)
              ->get();
        }
        if($location == '3'){
            $component_name = 'Engine';
          $segment_EandT = array('OEM','EPD','Petro','Marine');
              $table = CapacityUtilization::select(DB::raw('count(service_request.id) as actual')) 
              ->leftjoin('gw_master_aggregate', 'gw_master_aggregate.id', '=', 'service_request.id')
              ->where('service_request.component_name', '=', $component_name)
              ->whereIn('service_request.segment',$segment_EandT)
              ->where('service_request.location_id', '=', $location)
              ->get();
        }

        
       /* $datatables =  Datatables::of($table)
        ->addColumn('id', function ($table) {
                $id = '1';
                return $id;
            }) 
        ->addColumn('model', function ($table) {
                $model = 'Engine';
                return $model;
            })
        ->addColumn('Actual Uti', function ($table) {
                $actual_uti = ;
                return $model;
            });
*/
        return $datatables->make(true);
    }
	//end coded by amanur

}
