<?php

namespace App\Http\Controllers\admin;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;

use App\Http\Requests\BranchServiceRequest;
use App\Models\MasterAllComponentName;
use App\Models\MasterBranch;
use App\Models\MasterEngineModel;
use App\Models\MasterMachine;
use App\Models\MasterPreHistoryDis;
use App\Models\MasterSegment;
use App\Models\Service;
use App\Models\MasterMCModel;
use App\Models\MasterComponentDetails;
use App\Models\MasterMCSerialNumber;
use App\Models\MasterCustomer;
use App\Models\MasterMachineModelNo;
use App\Models\Masterrole;
use App\Models\Menuaccess;
use App\Models\MasterStatus;
use App\Models\Menu;
use App\Models\MasterEmployee;
use Illuminate\Http\Request;
use App\Models\MasterDepartment;
use App\Models\StatusRevision;
use App\Models\CheckgateStatus;
use App\Models\ChecksheetStatus;


use SoapClient;
use App\Models\MasterTask;
use App\Models\ProjectPlanMaster;
use App\Models\ProjectTask;
use App\Models\ProjectUser;
use App\Models\TaskUser;
use App\Models\User;

use phpDocumentor\Reflection\Types\Collection;
use Rap2hpoutre\FastExcel\FastExcel;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;


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
use File;
use \PDF;
use Response;
use Illuminate\Support\Facades\Crypt;
use App\Providers\HelperServiceProvider;
class ServiceController extends Controller
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

        $user=User::find(11);
        $user->assignRole('receiving');
        echo "Assign Role";*/
        //Role::create(['name' => 'receiving']);

    }

    public function test3(){

        //echo "test 2";
        return view('admin.serviceengineer.transmissioncheckSheetEntry');

    }



//brunch engineeer

    public function branchDashboardListGetTableDownload(){

        $data = Session::all();
        $location=$data['user']['location_id'];
        $status = '';

        if (request()->session()->get('user')['section_id'] == '1') {

            if (request()->session()->get('user')['role_id'] == '2'){

                die;

                $table = Service::select('*')
                    //->where('service_request.status','=','Submitted')
                    ->where('service_request.location_id','=',$location)

                    ->where(function($query) {
                        $query->where('status', 'Work Order Generated')
                            ->orWhere('status', 'Service Request Generated')
                            ->orwhere('status','=','Submitted');
                    })
                    //->orwhere('service_request.status','=','Work Order Generated')
                    //->orwhere('service_request.status','=','Service Request Generated')
                    // ->orwhere('service_request.status','=','Approved')
                    ->get();

                    

            }elseif (request()->session()->get('user')['role_id'] == '1'){

               
                $table = Service::select('*')
                    ->where('service_request.location_id','=',$location)
                    ->where('status','!=','Approved')
                    ->orderby('created_at','DESC')
                    ->get();
            }

        }

        if (request()->session()->get('user')['section_id'] == '2') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('work_orderno','!=','Null')
                    ->get();
    
            }
            elseif (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('po_status','=','Submitted')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }

        if (request()->session()->get('user')['section_id'] == '4'||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6'||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('cg1_status','=','Submitted')
                    ->get();
    
            }
            elseif (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('dcs_status','=','Submitted')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }
        
        if (request()->session()->get('user')['section_id'] == '10'||request()->session()->get('user')['section_id'] == '11'||request()->session()->get('user')['section_id'] == '12'||request()->session()->get('user')['section_id'] == '14'||request()->session()->get('user')['section_id'] == '15') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('cg2_status','=','Submitted')
                    ->get();
    
            }
            elseif (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('asc_status','=','Submitted')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }
        
        if (request()->session()->get('user')['section_id'] == '21') {

            if (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('pdi_status','!=','Approved')
                    ->where('bis_status','=','Approved')
                    ->get();
            }
            elseif (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('pdi_status','=','Submitted')
                    ->orwhere('pdi_status','=','Approved')
                    ->where('bis_status','=','Approved')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }
        
        if (request()->session()->get('user')['section_id'] == '22') {
            if (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('pdi_status','=','Approved')
                    ->get();
            }
            elseif (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                  //->where('pdi_status','=','Submitted')
                    ->orwhere('pdi_status','=','Approved')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }


        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/CertificateList.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'SERVICE  NO' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'SEGMENT' => $table['segment'],
                'JOB' => $table['job_type'],
                'COMPONENT' => $table['component_name'],
                'STATUS' =>  $table['pdi_status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);



    } 




    public function branchDashboardListGetTablebranchDownload(){

        $data = Session::all();
        $location=$data['user']['location_id'];
        $status = '';

        if (request()->session()->get('user')['section_id'] == '1') {

            if (request()->session()->get('user')['role_id'] == '2'){

                die;

                $table = Service::select('*')
                    //->where('service_request.status','=','Submitted')
                    ->where('service_request.location_id','=',$location)

                    ->where(function($query) {
                        $query->where('status', 'Work Order Generated')
                            ->orWhere('status', 'Service Request Generated')
                            ->orwhere('status','=','Submitted');
                    })
                    //->orwhere('service_request.status','=','Work Order Generated')
                    //->orwhere('service_request.status','=','Service Request Generated')
                    // ->orwhere('service_request.status','=','Approved')
                    ->get();

                    

            }elseif (request()->session()->get('user')['role_id'] == '1'){

               
                $table = Service::select('*')
                    ->where('service_request.location_id','=',$location)
                    ->where('status','!=','Approved')
                    ->orderby('created_at','DESC')
                    ->get();
            }

        }

        if (request()->session()->get('user')['section_id'] == '2') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('work_orderno','!=','Null')
                    ->get();
    
            }
            elseif (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('po_status','=','Submitted')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }

        if (request()->session()->get('user')['section_id'] == '4'||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6'||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('cg1_status','=','Submitted')
                    ->get();
    
            }
            elseif (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('dcs_status','=','Submitted')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }
        
        if (request()->session()->get('user')['section_id'] == '10'||request()->session()->get('user')['section_id'] == '11'||request()->session()->get('user')['section_id'] == '12'||request()->session()->get('user')['section_id'] == '14'||request()->session()->get('user')['section_id'] == '15') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('cg2_status','=','Submitted')
                    ->get();
    
            }
            elseif (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('asc_status','=','Submitted')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }
        
        if (request()->session()->get('user')['section_id'] == '21') {

            if (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('pdi_status','!=','Approved')
                    ->where('bis_status','=','Approved')
                    ->get();
            }
            elseif (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('pdi_status','=','Submitted')
                    ->orwhere('pdi_status','=','Approved')
                    ->where('bis_status','=','Approved')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }
        
        if (request()->session()->get('user')['section_id'] == '22') {
            if (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('pdi_status','=','Approved')
                    ->get();
            }
            elseif (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                  //->where('pdi_status','=','Submitted')
                    ->orwhere('pdi_status','=','Approved')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }
        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/BranchList.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {

            return [
                'Sr No' => $table['id'],
                'SERVICE  NO' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'SEGMENT' => $table['segment'],
                'JOB' => $table['job_type'],
                'COMPONENT' => $table['component_name'],
                'STATUS' =>  $table['status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);



    }

   public function branchDashboardListGetTable(Request $request)
    {
        $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
        //echo '<pre>';print_r($location);exit;

        if (request()->session()->get('user')['section_id'] == '1') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    //->where('service_request.status','=','Submitted')
                    ->where('service_request.location_id','=',$location)

                    ->where(function($query) {
                        $query->where('status', 'Work Order Generated')
                            ->orWhere('status', 'Service Request Generated')
                            ->orwhere('status','=','Submitted');
                    })
                    //->orwhere('service_request.status','=','Work Order Generated')
                    //->orwhere('service_request.status','=','Service Request Generated')
                    // ->orwhere('service_request.status','=','Approved')
                    ->get();
               // echo '<pre>';print_r($table);exit;
            }
            elseif (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('service_request.location_id','=',$location)
                    ->where('status','!=','Approved')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }
        
        if (request()->session()->get('user')['section_id'] == '2') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('work_orderno','!=','Null')
                    ->get();
    
            }
            elseif (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('po_status','=','Submitted')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }
        
        if (request()->session()->get('user')['section_id'] == '4'||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6'||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('cg1_status','=','Submitted')
                    ->get();
    
            }
            elseif (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('dcs_status','=','Submitted')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }
        
        if (request()->session()->get('user')['section_id'] == '10'||request()->session()->get('user')['section_id'] == '11'||request()->session()->get('user')['section_id'] == '12'||request()->session()->get('user')['section_id'] == '14'||request()->session()->get('user')['section_id'] == '15') {

            if (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('cg2_status','=','Submitted')
                    ->get();
    
            }
            elseif (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('asc_status','=','Submitted')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }
        
        if (request()->session()->get('user')['section_id'] == '21') {

            if (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('pdi_status','!=','Approved')
                    ->where('bis_status','=','Approved')
                    ->get();
            }
            elseif (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
                    ->where('pdi_status','=','Submitted')
                    ->orwhere('pdi_status','=','Approved')
                    ->where('bis_status','=','Approved')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }
        
        if (request()->session()->get('user')['section_id'] == '22') {
            if (request()->session()->get('user')['role_id'] == '1'){
                $table = Service::select('*')
                    ->where('pdi_status','=','Approved')
                    ->get();
            }
            elseif (request()->session()->get('user')['role_id'] == '2'){
                $table = Service::select('*')
//                    ->where('pdi_status','=','Submitted')
                    ->orwhere('pdi_status','=','Approved')
                    ->orderby('created_at','DESC')
                    ->get();
            }
        }

//        $table = Service::select('*')->orderby('created_at','DESC')->get();
        $datatables =  Datatables::of($table)

             ->addColumn('action', function ($table) {
//                 if (request()->session()->get('user')['section_id'] == '2' || request()->session()->get('user')['section_id'] == '4' || request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6'||request()->session()->get('user')['section_id'] == '7'|| request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12'||request()->session()->get('user')['section_id'] == '13'||request()->session()->get('user')['section_id'] == '14'||request()->session()->get('user')['section_id'] == '15'||request()->session()->get('user')['section_id'] == '21') {
//
//                     if (request()->session()->get('user')['role_id'] == '2'){
//
//                         $btns = ' <div class="dropdown">
//                                             <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
//                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//                                                 <i class="fas fa-ellipsis-v"></i>
//                                             </a>
//                                             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
//
//
//                                                 <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Approve/Reject</a>
//
//
//                                             </div>
//                                         </div>';
//                     }
//                     else{
//                         $btns = ' <div class="dropdown">
//                                             <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
//                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//                                                 <i class="fas fa-ellipsis-v"></i>
//                                             </a>
//                                             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
//
//
//                                                 <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Edit</a>
//
//
//                                             </div>
//                                         </div>';
//                     }
//                 }

                 if (request()->session()->get('user')['section_id'] == '1') {

                     if (request()->session()->get('user')['role_id'] == '2'){

                         $btns = ' <div class="dropdown">
                                             <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                 <i class="fas fa-ellipsis-v"></i>
                                             </a>
                                             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">


                                                 <a class="dropdown-item" href="' . url('admin/listing')."/". "$table->id". '">Approve/Reject</a>


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


                                                 <a class="dropdown-item" href="' . url('admin/listing')."/". "$table->id". '">Edit</a>
                                                  <a class="dropdown-item" href="' . url('admin/service-request-delete/'.$table->id ) . '" onclick="return confirm(\'Are you sure ? \')">Delete</a>

                                             </div>
                                         </div>';
                     }
                 }
                 if (request()->session()->get('user')['section_id'] == '2') {

                    if (request()->session()->get('user')['role_id'] == '2'){

                        $btns = ' <div class="dropdown">
                                             <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                 <i class="fas fa-ellipsis-v"></i>
                                             </a>
                                             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">


                                                 <a class="dropdown-item" href="' . url('admin/support-quotation-add')."/". "$table->id". '">Upload PO</a>


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


                                                 <a class="dropdown-item" href="' . url('admin/support-quotation-add')."/". "$table->id". '">Upload PO</a>


                                             </div>
                                         </div>';
                    }
                }
                 if (request()->session()->get('user')['section_id'] == '4'||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6'||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13') {

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
                 if (request()->session()->get('user')['section_id'] == '10'||request()->session()->get('user')['section_id'] == '11'||request()->session()->get('user')['section_id'] == '12'||request()->session()->get('user')['section_id'] == '14'||request()->session()->get('user')['section_id'] == '15') {

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
                 if (request()->session()->get('user')['section_id'] == '21') {

                     if (request()->session()->get('user')['role_id'] == '2'){

                         $btns = ' <div class="dropdown">
                                             <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                 <i class="fas fa-ellipsis-v"></i>
                                             </a>
                                             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">


                                                 <a class="dropdown-item" href="#">Approve/Reject</a>


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


                                                 <a class="dropdown-item" href="#">Edit</a>
                                          

                                             </div>
                                         </div>';
                     }
                 }
                 if (request()->session()->get('user')['section_id'] == '22') {
                         $btns = ' <div class="dropdown">
                                             <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                 <i class="fas fa-ellipsis-v"></i>
                                             </a>
                                             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">


                                                 <a class="dropdown-item" href="' . url('admin/engine-certificate')."/". "$table->id". '">Certificate</a>


                                             </div>
                                         </div>';

                 }
                 return $btns;
             })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }



    public function serviceRequestList($msg='')
    {
        if(!empty($msg)){
            return view('admin.branchengineer.allserviceRequest')
                    ->with('msg',$msg);
        }
        else{
            return view('admin.branchengineer.allserviceRequest')
                    ->with('msg',$msg);
        }

        
    }

    public function serviceRequestGetTableold(Request $request)
    {
        $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
        // $table = Service::select('*')->orderby('created_at','DESC')->get();

        if (request()->session()->get('user')['role_id'] == '2'){
            $table = Service::select('*')
                ->where('service_request.location_id','=',$location)
                ->orderby('created_at','DESC')->get();

        }
        elseif (request()->session()->get('user')['role_id'] == '1'){
            $table = Service::select('*')
                ->where('service_request.location_id','=',$location)
                ->where('status','!=','Approved')
                ->orderby('created_at','DESC')->get();
        }
        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            /*->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/
            ->addColumn('action', function ($table) {
                //  if (request()->session()->get('user')['section_id'] == '1') {

                    if (request()->session()->get('user')['role_id'] == '2') {

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Approve/Reject</a>
                                          
                                                
                                            </div>
                                        </div>';
                    } else {
                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Edit</a>
                                          <a class="dropdown-item" href="' . url('admin/service-request-delete/'.$table->id ) . '">Delete</a>
                                                
                                            </div>
                                        </div>';
                    // }
                 }
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }


public function serviceRequestGetTable(Request $request)
    {
        $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
        // $table = Service::select('*')->orderby('created_at','DESC')->get();

        if (request()->session()->get('user')['role_id'] == '2'){
            $table = Service::select('*')
                ->where('service_request.location_id','=',$location)
                ->orderby('created_at','DESC')->get();

        }
        elseif (request()->session()->get('user')['role_id'] == '1'){
            $table = Service::select('*')
                ->where('service_request.location_id','=',$location)
                ->where('status','!=','Approved')
                ->orderby('created_at','DESC')->get();
        }
        elseif (request()->session()->get('user')['role_id'] == '3'){
            $table = Service::select('*')
                ->where('service_request.location_id','=',$location)
                //->where('status','!=','Approved')
                ->orderby('created_at','DESC')->get();
        }elseif (request()->session()->get('user')['role_id'] == '4'){
            $table = Service::select('*')
                //->where('service_request.location_id','=',$location)
                //->where('status','!=','Approved')
                ->orderby('created_at','DESC')->get();
        }
        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            /*->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/
            ->addColumn('action', function ($table) {
                //  if (request()->session()->get('user')['section_id'] == '1') {

                if (request()->session()->get('user')['role_id'] == '2') {

                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Approve/Reject</a>
                                          
                                                
                                            </div>
                                        </div>';
                } elseif(request()->session()->get('user')['role_id'] == '1') {
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Edit</a>
                                          <a class="dropdown-item" href="' . url('admin/service-request-delete/'.$table->id ) . '" onclick="return confirm(\'Are you sure ? \')">Delete</a>
                                                
                                            </div>
                                        </div>';
                    // }
                }
                elseif(request()->session()->get('user')['role_id'] == '3') {
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Edit</a>
                                          <a class="dropdown-item" href="' . url('admin/service-request-delete/'.$table->id ) . '" onclick="return confirm(\'Are you sure ? \')">Delete</a>
                                                
                                            </div>
                                        </div>';
                    // }
                }
                elseif(request()->session()->get('user')['role_id'] == '4') {
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Edit</a>
                                          <a class="dropdown-item" href="' . url('admin/service-request-delete/'.$table->id ) . '" onclick="return confirm(\'Are you sure ? \')">Delete</a>
                                                
                                            </div>
                                        </div>';
                    // }
                }
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }
	
	public function serviceRequestFilterGetTable(Request $request)
    {
        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
        // $location=$data['user']['location_id'];
        $locationId = $request['location'];
        // $table = Service::select('*')->orderby('created_at','DESC')->get();
        if($locationId != '3') {
            $table = Service::select('*')
                ->where('service_request.location_id','=',$locationId)
                //->where('status','!=','Approved')
                ->orderby('created_at', 'DESC')->get();
//            if (request()->session()->get('user')['role_id'] == '2') {
//                $table = Service::select('*')
//                    ->where('service_request.location_id', '=', $locationId)
//                    ->orderby('created_at', 'DESC')->get();
//
//            } elseif (request()->session()->get('user')['role_id'] == '1') {
//                $table = Service::select('*')
//                    ->where('service_request.location_id', '=', $locationId)
//                    ->where('status', '!=', 'Approved')
//                    ->orderby('created_at', 'DESC')->get();
//            } elseif (request()->session()->get('user')['role_id'] == '3') {
//                $table = Service::select('*')
//                    ->where('service_request.location_id', '=', $locationId)
//                    //->where('status','!=','Approved')
//                    ->orderby('created_at', 'DESC')->get();
//            } elseif (request()->session()->get('user')['role_id'] == '4') {
//                $table = Service::select('*')
//                    //->where('service_request.location_id','=',$location)
//                    //->where('status','!=','Approved')
//                    ->orderby('created_at', 'DESC')->get();
//            }
        }
        if($locationId == '3'){

            $table = Service::select('*')
                //->where('service_request.location_id','=',$location)
                //->where('status','!=','Approved')
                ->orderby('created_at', 'DESC')->get();
        }
        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            /*->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/
            ->addColumn('action', function ($table) {
                //  if (request()->session()->get('user')['section_id'] == '1') {

                if (request()->session()->get('user')['role_id'] == '2') {

                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Approve/Reject</a>
                                          
                                                
                                            </div>
                                        </div>';
                } elseif(request()->session()->get('user')['role_id'] == '1') {
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Edit</a>
                                          <a class="dropdown-item" href="' . url('admin/service-request-delete/'.$table->id ) . '" onclick="return confirm(\'Are you sure ? \')">Delete</a>
                                                
                                            </div>
                                        </div>';
                    // }
                }
                elseif(request()->session()->get('user')['role_id'] == '3') {
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Edit</a>
                                          <a class="dropdown-item" href="' . url('admin/service-request-delete/'.$table->id ) . '" onclick="return confirm(\'Are you sure ? \')">Delete</a>
                                                
                                            </div>
                                        </div>';
                    // }
                }
                elseif(request()->session()->get('user')['role_id'] == '4') {
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Edit</a>
                                          <a class="dropdown-item" href="' . url('admin/service-request-delete/'.$table->id ) . '" onclick="return confirm(\'Are you sure ? \')">Delete</a>
                                                
                                            </div>
                                        </div>';
                    // }
                }
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }
    public function serviceRequestDateFilterGetTable(Request $request)
    {
        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];

        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');



        $locationId = $request['location'];

//dd($locationId);
        if(!empty($startDate) && !empty($endDate)) {
            if(!empty($locationId)){
                if($location == '3'){
                    if($locationId != '3'){
                        $table = Service::select('*')
                            ->where('service_request.location_id','=',$locationId)
                            ->where('service_request.date', '>=', $startDate)
                            ->where('service_request.date', '<=', $endDate)
                            //->where('status','!=','Approved')
                            ->orderby('created_at', 'DESC')->get();


                    }
                    if($locationId == '3'){

                        $table = Service::select('*')
                            //->where('service_request.location_id','=',$locationId)
                            ->where('service_request.date', '>=', $startDate)
                            ->where('service_request.date', '<=', $endDate)
                            //->where('status','!=','Approved')
                            ->orderby('created_at', 'DESC')->get();

                    }
                }else{

                    $table = Service::select('*')
                        ->where('service_request.location_id','=',$locationId)
                        ->where('service_request.date', '>=', $startDate)
                        ->where('service_request.date', '<=', $endDate)
                        //->where('status','!=','Approved')
                        ->orderby('created_at', 'DESC')->get();
                }
            }else{
                $table = Service::select('*')
                    ->where('service_request.location_id','=',$location)
                    ->where('service_request.date', '>=', $startDate)
                    ->where('service_request.date', '<=', $endDate)
                    //->where('status','!=','Approved')
                    ->orderby('created_at', 'DESC')->get();
            }

        }
        else{
            $table = Service::select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.date', '>=', $startDate)
                //->where('service_request.date', '<=', $endDate)
                //->where('status','!=','Approved')
                ->orderby('created_at', 'DESC')->get();
        }


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            /*->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/
            ->addColumn('action', function ($table) {
                //  if (request()->session()->get('user')['section_id'] == '1') {

                if (request()->session()->get('user')['role_id'] == '2') {

                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Approve/Reject</a>
                                          
                                                
                                            </div>
                                        </div>';
                } elseif(request()->session()->get('user')['role_id'] == '1') {
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Edit</a>
                                          <a class="dropdown-item" href="' . url('admin/service-request-delete/'.$table->id ) . '" onclick="return confirm(\'Are you sure ? \')">Delete</a>
                                                
                                            </div>
                                        </div>';
                    // }
                }
                elseif(request()->session()->get('user')['role_id'] == '3') {
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Edit</a>
                                          <a class="dropdown-item" href="' . url('admin/service-request-delete/'.$table->id ) . '" onclick="return confirm(\'Are you sure ? \')">Delete</a>
                                                
                                            </div>
                                        </div>';
                    // }
                }
                elseif(request()->session()->get('user')['role_id'] == '4') {
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/listing') . "/" . "$table->id" . '">Edit</a>
                                          <a class="dropdown-item" href="' . url('admin/service-request-delete/'.$table->id ) . '" onclick="return confirm(\'Are you sure ? \')">Delete</a>
                                                
                                            </div>
                                        </div>';
                    // }
                }
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }
	

    public function serviceRequestAdd()
    {
        $status = MasterStatus::select('gw_master_status.*')->get();
        //$employee = MasterEmployee::select('gw_master_employee.*')->get();
         $employee = User::select('*')->get();
        return view('admin.branchengineer.newserviceRequest')
            ->with('employee',$employee)
            ->with('status',$status);
    }

    public function serviceRequestAddSave(BranchServiceRequest $request)
    {
        $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
        $service = mt_rand(100000,999999);

        //$ser="SR";
		if(!empty($request['machserial_notmain'])){
            $equ_ser = new MasterMCSerialNumber();
            $equ_ser->serial_no = $request['machserial_notmain'];
            $equ_ser->notmaintain_status = 'N';
            $equ_ser->save();

        }
        if(!empty($request['machmodel_notmain'])){
            $equ_mod = new MasterMCModel();
            $equ_mod->model_no = $request['machmodel_notmain'];
            $equ_mod->notmaintain_status = 'N';
            $equ_mod->save();

        }
        if(!empty($request['compmodel_notmain'])){
            $comp_mod = new MasterComponentDetails();
            $comp_mod->comp_model_no = $request['compmodel_notmain'];
            $comp_mod->notmaintain_status = 'N';
            $comp_mod->save();

        }
        if(!empty($request['compserial_notmain'])){
            $comp_ser = new MasterComponentDetails();
            $comp_ser->comp_serial_no = $request['compserial_notmain'];
            $comp_ser->notmaintain_status = 'N';
            $comp_ser->save();

        }

        $customer = MasterCustomer::where('customer_code','=',$request['customer'])->get()->toarray();


        $obj = new Service();
        // $obj->service_request_no = $ser.$request['date'];
        $obj->service_request_no = $service;
        $obj->description = $request['description'];
        $obj->empres = $request['empres'];
        $obj->cc_status = $request['cc_status'];
        $obj->impact = $request['impact'];$obj->recom=$request['recom'];
        $obj->customer=isset($customer[0]['id']) ? $customer[0]['id'] : '';
        $obj->location_id=$location;
        $obj->job_type=$request['job_type'];
        //$obj->component_serial_no=$request['component_serial_no'];
        $obj->component_name=$request['component_name'];
        //$obj->comp_model_no=$request['comp_model_no'];
        //$obj->machine_modelno=$request['machine_modelno'];
        //$obj->machine_serialno=$request['machine_serialno'];
		if(empty($request['compserial_notmain'])){
            $obj->component_serial_no=$request['component_serial_no'];
        }else{
            $obj->component_serial_no=$comp_ser->id;
        }
        if(empty($request['compmodel_notmain'])){
            $obj->comp_model_no=$request['comp_model_no'];
        }else{
            $obj->comp_model_no=$comp_mod->id;
        }
        if(empty($request['machmodel_notmain'])){
        $obj->machine_modelno=$request['machine_modelno'];
        }else{
            $obj->machine_modelno=$equ_mod->id;
        }
        
        if(empty($request['machserial_notmain'])) {
            $obj->machine_serialno = $request['machine_serialno'];
        }else {
            $obj->machine_serialno = $equ_ser->id;
        }
		
        $obj->ar_no=$request['ar_no'];
        $obj->branch_name=$request['branch_name'];
        $obj->segment=$request['segment'];
        $obj->branch_location=$request['branch_location'];
        $obj->date=Carbon::createFromFormat('d/m/Y', $request['date'])->format('Y-m-d');
        $obj->machine_smu=$request['machine_smu'];
        $obj->component_smu=$request['component_smu'];
        $obj->work_orderno=$request['work_orderno'];
        if($request['work_orderno']!=Null){
            $obj->status="Work Order Generated";
        }
        else{
            $obj->status="Service Request Generated";
        }
        

      
                  
          if ($request->file('import_file')) {
            $imgfile = $request->file('import_file');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/serviceprehistory';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
           // echo $ext;exit;
            if($ext=='xlsx' || $ext=='xls'){
                //echo $ext;exit;
                 (new FastExcel)->import($destinationPath.'/'.$image, function ($line) {
            //dd($line);die;
            
            $getServiceId = Service::selectRaw('max(id) as serviceID')->get();
            $incre=1;
            $serviceID = $getServiceId[0]['serviceID'] + $incre;
            //dd($serviceID);exit;
            if ($line[' Arrange no']) {
                $mcModel = MasterPreHistoryDis::get();
                if (!isset($mcModel->id)) {
                    $mcModel = new MasterPreHistoryDis();
                    //$mcModel->dept_id = 1;
                    $mcModel->service_request_id = $serviceID;
                    $mcModel->repair_mode = $line['Repair Mode'];
                    //$mcModel->engine_serial_no = $line['Engine serial no'];
                    $mcModel->engine_arrange_no = $line[' Arrange no'];
                    //$mcModel->machine_type = $line['Machine type'];
                    //$mcModel->machine_serial_no = $line['Machine serial no'];
                    $mcModel->smu = $line['Total component life(SMU)'];
                    $mcModel->no_of_overhauls_done = $line['No of Overhauls Done'];
                    $mcModel->last_overhaul_smu = $line['Last Overhaul SMU'];
                    $mcModel->failure_details = $line['Failure Details & nature of failure'];
                    //$mcModel->major_cylinder_head = $line['Cylinder head'];
                    //$mcModel->major_injector = $line['Injector'];
                    //$mcModel->major_oil_pump = $line['Oil pump'];
                    //$mcModel->major_fuel_injection_pump = $line['Fuel injection pump'];

                    $mcModel->save();

                }

            }

        });
        
            }
                else {
                $image = '';
            }
        //echo $ext.'1';exit;
        } else {
            $image = '';
        }
        $obj->pre_history = $image;
        
       // print_r($obj->pre_history);exit;
       
       
       



        //$obj = new Service();
        
        
        if ($request->file('et_report')) {
            $imgfile = $request->file('et_report');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/serviveETReport';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
        } else {
            $image = '';
        }
        $obj->et_report = $image;
        
        if ($request->file('pre_invoice_chksht')) {
            $imgfile = $request->file('pre_invoice_chksht');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/servicePreInvoiceChecksheet';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
        } else {
            $image = '';
        }
        $obj->pre_invoice_chksht = $image;
        
        $obj->save();

     //send notification
     $url=url('/');
        //dd($url);exit;

        //$mailsend=User::select('*')->where('role_id','=',2)->get()->toArray();
		$mailsend=User::select('email')

           ->where(function($query) use($location) {

               $query->where('location_id','=',$location)
                   ->orWhere('location_id','=','3');


           })
           ->where('role_id','!=', '1')

            ->where(function($query) {

                $query->where('section_id','=', '3')
                    ->orWhere('section_id','=', '8')
                    ->orWhere('section_id','=', '21')
                    ->orWhere('section_id','=', '24')

                    ->orwhere('section_id','=','20');
            })
            ->groupby('email')
            ->get()->toArray();
        //echo '<pre>';print_r($mailsend);exit;
		//$emailId=['rimpidas329@gmail.com','rimpi.329.das@gmail.com'];
        if(!empty($mailsend)){
			
			foreach ($mailsend as $mailone){
				$tomail = $mailone['email'];
				//echo '<pre>';print_r($tomail);exit;
            $data=['subject'=>'Service Create Mail','email'=>$tomail,'serviceno' => $obj->service_request_no,'url'=>$url];


            Mail::send('admin.mail.serviceNotificationMail', $data, function($message) use ($data) {

                $message->to($data['email'])->subject($data['subject']);
                //dd($message);
                $message->from(env('service_mail'),'QMS');
                //$message->from(\Config::get('env.service_mail'),'loyalty@gainwellindia.com');
             });
           }
			
            
        }
        
		
		
      
 
      
        $msg = 'Service Request Number Generated :'.$service;
        return $this->serviceRequestList($msg);

       
             
            // return redirect('admin/service-request-list');
    }

    public function importPrehistSave(Request $request)
    {

        $service = Service::find($request['service_id']);
        // $path='C:/Apache24/htdocs/gcpl-quality/prehistoryupload';

//dd($service);exit;


        (new FastExcel)->import($request->file('import_file'), function ($line) {

            if ($line['Engine serial no']) {
                $mcModel = MasterPreHistoryDis::get();
                if (!isset($mcModel->id)) {
                    $mcModel = new MasterPreHistoryDis();
                    //$mcModel->dept_id = 1;
                    //$mcModel->service_request_id =18;
                    $mcModel->engine_serial_no = $line['Engine serial no'];
                    $mcModel->engine_arrange_no = $line['Engine arrange no'];
                    $mcModel->machine_type = $line['Machine type'];
                    $mcModel->machine_serial_no = $line['Machine serial no'];
                    $mcModel->smu = $line['Total component life(SMU)'];
                    $mcModel->no_of_overhauls_done = $line['No of Overhauls Done'];
                    $mcModel->last_overhaul_smu = $line['Last Overhaul SMU'];
                    $mcModel->failure_details = $line['Failure Details & nature of failure'];
                    $mcModel->major_cylinder_head = $line['Cylinder head'];
                    $mcModel->major_injector = $line['Injector'];
                    $mcModel->major_oil_pump = $line['Oil pump'];
                    $mcModel->major_fuel_injection_pump = $line['Fuel injection pump'];

                    $mcModel->save();

                }

            }

        });
        
        $obj = new Service();
        if ($request->file('import_file')) {
            $imgfile = $request->file('import_file');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/serviceprehistory';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
        } else {
            $image = '';
        }
        $obj->pre_history = $image;
        // Excel::import(new ImportContacts, request()->file('import_file'));

        return redirect('admin/service-request-list');
    }



    //ServicerequestEdit
    public function servicerequestlisting($id)
    {
       



        $servicerequest = Service::find($id);


        $machinemodel = Service::select('gw_master_mc_model.*')->leftjoin('gw_master_mc_model',
            'gw_master_mc_model.id', '=', 'service_request.machine_modelno')->where('service_request.id', '=', $id)->get();
			
			//echo '<pre>';print_r($machinemodel[0]['id']);

        $status = MasterStatus::select('gw_master_status.*')->get();
        
         $customer = Service::select('gw_master_customer.*')
            ->leftjoin('gw_master_customer',
            'gw_master_customer.id', '=', 'service_request.customer')
            ->where('service_request.id', '=', $id)->get();
        
           //print_r($customer);
		   //exit;

        //$employee = MasterEmployee::select('gw_master_employee.name')->get();
         $employee = User::select('users.name')->get();

        $compmodelno = Service::select('gw_master_comp_details.*')->leftjoin('gw_master_comp_details',

            'gw_master_comp_details.id', '=', 'service_request.comp_model_no')->where('service_request.id', '=', $id)->get();
        $machserial = Service::select( 'gw_master_mc_serial_number.*')
            ->leftjoin('gw_master_mc_serial_number','gw_master_mc_serial_number.id', '=', 'service_request.machine_serialno')
            ->where('service_request.id', '=' ,$id)->get();


        $compserialno = Service::select('gw_master_comp_details.*')
            ->leftjoin('gw_master_comp_details', 'gw_master_comp_details.id', '=', 'service_request.component_serial_no')->where('service_request.id',
                '=' , $id)->get();
                
               
                
        $reject_msg = CheckgateStatus::select('*')
        ->where('service_request_id','=',$servicerequest->id)->get()->toArray();
       
        return view('admin.branchengineer.servicerequestlisting')
            ->with('servicerequest', $servicerequest)
            ->with('employee',$employee)
            ->with('customer',$customer)
            ->with('machinemodel', $machinemodel)
            ->with('compmodelno', $compmodelno)
            ->with('machserial',$machserial)
           
            ->with('status',$status)
            ->with('reject_msg',$reject_msg)
            ->with('compserialno', $compserialno);
    }

    //service request edit save
    public function updateservicerequest(Request $request)
    {

        //$myrequest=$request->all();


        //dd($myrequest);exit;
		$data = Session::all();
        //echo '<pre>';print_r($data);exit;

        if(!empty($request['machserial_notmain'])){
            $equ_ser = new MasterMCSerialNumber();
            $equ_ser->serial_no = $request['machserial_notmain'];
            $equ_ser->notmaintain_status = 'N';
            $equ_ser->save();

        }

        if(!empty($request['machmodel_notmain'])){
            $equ_mod = new MasterMCModel();
            $equ_mod->model_no = $request['machmodel_notmain'];
            $equ_mod->notmaintain_status = 'N';
            $equ_mod->save();

        }

        if(!empty($request['compmodel_notmain'])){
            $comp_mod = new MasterComponentDetails();
            $comp_mod->comp_model_no = $request['compmodel_notmain'];
            $comp_mod->notmaintain_status = 'N';
            $comp_mod->save();

        }
        if(!empty($request['compserial_notmain'])){
            $comp_ser = new MasterComponentDetails();
            $comp_ser->comp_serial_no = $request['compserial_notmain'];
            $comp_ser->notmaintain_status = 'N';
            $comp_ser->save();

        }

        $location=$data['user']['location_id'];
        $obj = Service::find($request['id']);

       // $obj->service_request_no = $service;
        $obj->description = $request['description'];
        $obj->empres = $request['empres'];
        $obj->cc_status = $request['cc_status'];
        $obj->impact = $request['impact'];
        $obj->recom=$request['recom'];
        $obj->customer=$request['customer'];
        //$obj->job_no=$request['job_no'];
        $obj->job_type=$request['job_type'];
        //$obj->component_serial_no=$request['component_serial_no'];
        $obj->component_name=$request['component_name'];

        if(empty($request['compserial_notmain'])){
            $obj->component_serial_no=$request['component_serial_no'];
        }else{
            $obj->component_serial_no=$comp_ser->id;
        }

        if(empty($request['compmodel_notmain'])){
            $obj->comp_model_no=$request['comp_model_no'];
        }else{
            $obj->comp_model_no=$comp_mod->id;
        }

        //$obj->comp_model_no=$request['comp_model_no'];

        if(empty($request['machmodel_notmain'])){
            $obj->machine_modelno=$request['machine_modelno'];
        }else{
            $obj->machine_modelno=$equ_mod->id;
        }

        //$obj->machine_modelno=$request['machine_modelno'];

        if(empty($request['machserial_notmain'])) {
            $obj->machine_serialno = $request['machine_serialno'];
        }else {
            $obj->machine_serialno = $equ_ser->id;
        }

       // $obj->machine_serialno=$request['machine_serialno'];
        $obj->ar_no=$request['ar_no'];
        $obj->branch_name=$request['branch_name'];
        $obj->segment=$request['segment'];
        $obj->branch_location=$request['branch_location'];
        //$obj->date=$request['date'];
        $obj->machine_smu=$request['machine_smu'];
        $obj->component_smu=$request['component_smu'];
        $obj->work_orderno=$request['work_orderno'];
		 $obj->receiving_status='Submitted';
        if($request['work_orderno']!=Null){
            $obj->status="Work Order Generated";
        }
        else{
            $obj->status="Service Request Generated";
        }
        $id = $obj->id;

        //  if ($request->file('import_file')) {
        //     $imgfile = $request->file('import_file');
        //     $tmp = explode('.', $imgfile->getClientOriginalName());
        //     $ext = end($tmp);
        //     $save_imgfile = time() . '.' . $ext;
        //     $destinationPath = 'public/assets/uploads/serviceprehistory';
        //     $imgfile->move($destinationPath, $save_imgfile);
        //     $image = $save_imgfile;
        // } else {
        //     $image = '';
        // }
        // $obj->pre_history = $image;
        
       
        
        if ($request->file('import_file')) {
            $imgfile = $request->file('import_file');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/serviceprehistory';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->pre_history);
            
           
            if($ext=='xlsx' || $ext=='xls'){
                 //echo $ext;exit;
                    (new FastExcel)->import($destinationPath.'/'.$image, function ($line) {
                $getServiceId = Service::selectRaw('max(id) as serviceID')->get();
                 $incre=1;
                //$serviceID = $getServiceId[0]['serviceID'] + $incre;
                $serviceID=$getServiceId[0]['serviceID'];
                //dd($serviceID);exit;
				MasterPreHistoryDis::where('service_request_id','=',$serviceID)
                ->delete();
                if ($line[' Arrange no']) {
                    $mcModel = MasterPreHistoryDis::get();
                    if (!isset($mcModel->id)) {
                        $mcModel = new MasterPreHistoryDis();
                        //$mcModel->dept_id = 1;
                        /*$mcModel->service_request_id = $serviceID;
                        $mcModel->repair_mode = $line['Repair Mode'];
                        $mcModel->engine_serial_no = $line['Engine serial no'];
                        $mcModel->engine_arrange_no = $line['Engine arrange no'];
                        $mcModel->machine_type = $line['Machine type'];
                        $mcModel->machine_serial_no = $line['Machine serial no'];
                        $mcModel->smu = $line['Total component life(SMU)'];
                        $mcModel->no_of_overhauls_done = $line['No of Overhauls Done'];
                        $mcModel->last_overhaul_smu = $line['Last Overhaul SMU'];
                        $mcModel->failure_details = $line['Failure Details & nature of failure'];
                        $mcModel->major_cylinder_head = $line['Cylinder head'];
                        $mcModel->major_injector = $line['Injector'];
                        $mcModel->major_oil_pump = $line['Oil pump'];
                        $mcModel->major_fuel_injection_pump = $line['Fuel injection pump'];*/
						
						
						$mcModel->service_request_id = $serviceID;
                    $mcModel->repair_mode = $line['Repair Mode'];
                    //$mcModel->engine_serial_no = $line['Engine serial no'];
                    $mcModel->engine_arrange_no = $line[' Arrange no'];
                    //$mcModel->machine_type = $line['Machine type'];
                    //$mcModel->machine_serial_no = $line['Machine serial no'];
                    $mcModel->smu = $line['Total component life(SMU)'];
                    $mcModel->no_of_overhauls_done = $line['No of Overhauls Done'];
                    $mcModel->last_overhaul_smu = $line['Last Overhaul SMU'];
                    $mcModel->failure_details = $line['Failure Details & nature of failure'];
                    //$mcModel->major_cylinder_head = $line['Cylinder head'];
                    //$mcModel->major_injector = $line['Injector'];
                    //$mcModel->major_oil_pump = $line['Oil pump'];
                    //$mcModel->major_fuel_injection_pump = $line['Fuel injection pump'];
    
                        $mcModel->save();
    
                    }
    
                }
    
            });
            }
            else {
                $image = '';
            }
            // echo $ext.'1';exit;
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/serviceprehistory';
                File::delete($destinationPath . '/' . $obj->pre_history);
                $image='';
            }else{
                $image = $obj->pre_history;
            }

        }
        $obj->pre_history = $image;

        
        //   if ($request->file('et_report')) {
        //     $imgfile = $request->file('et_report');
        //     $tmp = explode('.', $imgfile->getClientOriginalName());
        //     $ext = end($tmp);
        //     $save_imgfile = time() . '.' . $ext;
        //     $destinationPath = 'public/assets/uploads/serviveETReport';
        //     $imgfile->move($destinationPath, $save_imgfile);
        //     $image = $save_imgfile;
        // } else {
        //     $image = '';
        // }
        // $obj->et_report = $image;
        
        if ($request->file('et_report')) {
            $imgfile = $request->file('et_report');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/serviveETReport';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->et_report);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/serviveETReport';
                File::delete($destinationPath . '/' . $obj->et_report);
                $image='';
            }else{
                $image = $obj->et_report;
            }

        }
        $obj->et_report = $image;
        
        
        // if ($request->file('pre_invoice_chksht')) {
        //     $imgfile = $request->file('pre_invoice_chksht');
        //     $tmp = explode('.', $imgfile->getClientOriginalName());
        //     $ext = end($tmp);
        //     $save_imgfile = time() . '.' . $ext;
        //     $destinationPath = 'public/assets/uploads/servicePreInvoiceChecksheet';
        //     $imgfile->move($destinationPath, $save_imgfile);
        //     $image = $save_imgfile;
        // } else {
        //     $image = '';
        // }
        // $obj->pre_invoice_chksht = $image;
        
        if ($request->file('pre_invoice_chksht')) {
            $imgfile = $request->file('pre_invoice_chksht');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/servicePreInvoiceChecksheet';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->pre_invoice_chksht);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/servicePreInvoiceChecksheet';
                File::delete($destinationPath . '/' . $obj->pre_invoice_chksht);
                $image='';
            }else{
                $image = $obj->pre_invoice_chksht;
            }

        }
        $obj->pre_invoice_chksht = $image;
        
        
        
        $obj->save();

        $url=url('/');
        //dd($url);exit;

        //$mailsend=User::select('*')->where('role_id','=',2)->get()->toArray();
		$mailsend=User::select('email')
            ->where('location_id','=',$location)
            ->orwhere('location_id','=','3')

            ->where(function($query) {
                $query->where('role_id', '2')
                    ->orWhere('role_id', '3')

                    ->orwhere('role_id','=','4');
            })
            ->groupby('email')
            ->get()->toArray();
        //echo '<pre>';print_r($mailsend);exit;
		//$emailId=['rimpidas329@gmail.com','rimpi.329.das@gmail.com'];
        if(!empty($mailsend)){
			/*foreach ($mailsend as $mailone){
				$tomail = $mailone['email'];
                $data=['subject'=>'Service Update Mail','email'=>$tomail,'serviceno' => $obj->service_request_no,'url'=>$url];


                Mail::send('admin.mail.serviceNotificationMail', $data, function($message) use ($data) {

                    $message->to($data['email'])->subject($data['subject']);
                    //dd($message);
                    $message->from(env('service_mail'),'QMS');
                    //$message->from(\Config::get('env.service_mail'),'loyalty@gainwellindia.com');
                });
            }*/
			
           
        }
        /*if(!empty($mailsend)){
            foreach ($mailsend as $mail){

                $to_email = $mail['email'];
                $subject = 'Service Update Mail';
                $message = view('admin.mail.serviceNotificationMail', ['serviceno' => $obj->service_request_no,'url'=>$url])->render();
                 mail($to_email, $subject, $message);
				//$notification= UserHelper::mailnotification($to_email,$subject,$message);
            }
        }*/



        return redirect('admin/service-request-list');


    }


   //service request delete
    public function serviceRequestDelete($user_id)
    {
        $sr = Service::find($user_id);


        $sr->delete();

        return redirect('admin/service-request-list');
    }

    /* public function serviceRequestEdit($id)
     {
         $title='Edit Service';

         $service=Service::find($id);

         return view('admin.branchengineer.editserviceRequest')
             ->with('service',$service);
     }


     public function serviceRequestEditSave(Request $request)
     {
         //  $myrequest=$request->all();
         //dd($request);

         $obj = Service::find($request['id']);

         $obj->customer=$request['customer'];
         $obj->job_no=$request['job_no'];
         $obj->component_serial_no=$request['component_serial_no'];
         $obj->component_name=$request['component_name'];
         $obj->model_no=$request['model_no'];
         $obj->machine_modelno=$request['machine_modelno'];

         $obj->ar_no=$request['ar_no'];
         $obj->branch_name=$request['branch_name'];
         $obj->segment=$request['segment'];
         $obj->branch_location=$request['branch_location'];
         $obj->date=$request['date'];
         
         if($obj->pre_history != '') {
             if ($file = $request->hasFile('pre_history')) {

                 $file = $request->file('pre_history');

                 $fileName = $file->getClientOriginalName();
                 $destinationPath = 'public/assets/uploads/serviceprehistory';
                 $file->move($destinationPath, $fileName);
                 $obj->pre_history = $fileName;
             }else{
                 $fileName = $obj->pre_history;
             }

         }
         if($request['work_orderno']!=Null){
            $obj->status="Work Order Generated";
        }
        else{
            $obj->status="Service Request Generated";
        }
         $obj->save();


         return redirect('admin/service-request-list');

     }*/



    public function quotationList()
    {

        return view('admin.branchengineer.quotation');
    }

    public function quotationListGetTable(Request $request)
    {

        $table = Service::select('*')->get();


        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {
                if(isset($table->quotation) && strlen($table->quotation) > 1) {
                    //dd($table);exit;
                    $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                              
                                <a class="dropdown-item" href="' . url('admin/quotation-download-show') . "/" . $table->id . '">Download quotation</a>
                              </div>
                            </div>';

                    //$btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                    return $btns;
                }
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }


    public function branchList()
    {

        return view('admin.branchengineer.listBranch');
    }

    public function branchGetTable(Request $request)
    {

        $table = MasterBranch::select('*')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            /*->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('#' . $table->id) . '">Edit</a>
                              </div>
                            </div>';
                //$btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function segmentList()
    {

        return view('admin.branchengineer.listSegment');
    }

    public function segmentGetTable(Request $request)
    {

        $table = MasterSegment::select('*')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            /*->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('#' . $table->id) . '">Edit</a>
                              </div>
                            </div>';
                //$btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }




//receiving



    public function receivingDashboardListGetTableDownload(){

        $data = Session::all();
        $location=$data['user']['location_id'];
        if (request()->session()->get('user')['role_id'] == '2'){
           $table = Service::select('*')
           ->where('checkgate1','!=',Null)
               ->where('service_request.location_id','=',$location)
           ->orderBy('id', 'DESC')
            ->offset(0)
            ->limit(3)->get(); 
        }
        else{
            $table = Service::select('*') ->orderBy('id', 'DESC')
                ->where('service_request.location_id','=',$location)
            ->offset(0)
            ->limit(3)->get();
        }


        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/ReceivingDashboard.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'SERVICE  NO' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'SEGMENT' => $table['segment'],
                'JOB' => $table['job_type'],
                'COMPONENT' => $table['component_name'],
                'STATUS' => $table['cg1_status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);

    }

    public function receivingDashboardListGetTable(Request $request)
    {
        $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
        if (request()->session()->get('user')['role_id'] == '2'){
           $table = Service::select('*')
           ->where('checkgate1','!=',Null)
               ->where('service_request.location_id','=',$location)
           ->orderBy('id', 'DESC')
            ->offset(0)
            ->limit(3)->get(); 
        }
        else{
            $table = Service::select('*') ->orderBy('id', 'DESC')
                ->where('service_request.location_id','=',$location)
            ->offset(0)
            ->limit(3)->get();
        }
        
        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            /*->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/
            // ->addColumn('action', function ($table) {
            //     if(isset($table->checkgate1) && strlen($table->checkgate1) > 1){
            //         $btns = ' <div class="dropdown">
            //                                 <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
            //                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            //                                     <i class="fas fa-ellipsis-v"></i>
            //                                 </a>
            //                                 <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                            
                                                
                                          
            //                                     <a class="dropdown-item" href="'.url('admin/check-gate-form-one-listing')."/"."$table->id".'">Check Gate 1</a>
                                               
                                                
            //                                 </div>
            //                             </div>';
            //     }else {
            //         $btns = ' <div class="dropdown">
            //                                 <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
            //                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            //                                     <i class="fas fa-ellipsis-v"></i>
            //                                 </a>
            //                                 <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                            
            //                                     <a class="dropdown-item" href="' . url('admin/check-gate-form-one-add') . "/" . "$table->id" . '">Check Gate 1 </a>
                                          
                                                
                                               
                                                
            //                                 </div>
            //                             </div>';
            //     }
            //     return $btns;
            // })
            ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '3') {
                        if (request()->session()->get('user')['role_id'] == '2'){
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-one-listing/' . $table->id) . '">Approve/Reject</a>

                                            </div>
                                        </div>';
                        }
                        else{
                            if ($table->checkgate1 != Null) {
                                $btns = ' <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="' . url('admin/check-gate-form-one-listing/' . $table->id) . '">Edit</a>
    
                                                </div>
                                            </div>';
    
                            } else {
                                $btns = ' <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="' . url('admin/check-gate-form-one-add/' . $table->id) . '">Add</a>
    
    
                                                </div>
                                            </div>';
                            }
                        }
                    }
                    return $btns;

                })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }



    public function serviceRequestLatestList()
    {


        return view('admin.receiving.allServiceRequests');
    }

    public function serviceRequestLatestListGetTable(Request $request)
    {

        $table = Service::select('*')->orderby('created_at','DESC')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            /*->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/



            ->addColumn('action', function ($table) {

                if(isset($table->checkgate1) && strlen($table->checkgate1) > 1){
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                            
                                                
                                          
                                                <a class="dropdown-item" href="'.url('admin/check-gate-form-one-listing')."/"."$table->id".'">Check Gate 1</a>
                                               
                                                
                                            </div>
                                        </div>';
                }else {
                    $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                            
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-one-add') . "/" . "$table->id" . '">Check Gate 1 </a>
                                          
                                                
                                               
                                                
                                            </div>
                                        </div>';
                }
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }



    public function checkGateFormOne()
    {

        return view('admin.receiving.checkGateFormOne');
    }

    public function checkGateFormOneAdd($id)
    {
        $checkgateone=Service::find($id);
        
        $model = Service::select('gw_master_mc_model.model_no')
            ->join('gw_master_mc_model','gw_master_mc_model.id','=','service_request.machine_modelno')
            ->where('service_request.id','=',$id)
            ->get()->toArray();

        $serial = Service::select('gw_master_comp_details.comp_serial_no')
            ->join('gw_master_comp_details','gw_master_comp_details.id','=','service_request.component_serial_no')
            ->where('service_request.id','=',$id)
            ->get()->toArray();

        
       
       $customer = Service::select('gw_master_customer.name')
            ->join('gw_master_customer','gw_master_customer.id','=','service_request.customer')
            ->where('service_request.id','=',$id)
            ->get()->toArray();
        return view('admin.receiving.checkGateFormOne')
         ->with('checkgateone',$checkgateone)
        ->with('model',$model)
        ->with('serial',$serial)
           
            ->with('customer',$customer);
            // ->with('reject_message',$reject_message);
    }

    public function checkGateFormOneAddSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
         $location=$data['user']['location_id'];
        $checkgate1=$request->all();
        $obj = Service::find($request['id']);
        $obj->checkgate1=$checkgate1;
        $obj->e_way_bill = $request['e_way_bill'];
        $obj->cg1_overall_remarks = $request['cg1_overall_remarks'];
        //$obj->checkgate1_actual_start_date = $request['checkgate1_actual_start_date'];
      
       $obj->checkgate1_actual_start_date  = Carbon::createFromFormat('d/m/Y', $request['checkgate1_actual_start_date'])->format('Y-m-d');
        
        //$obj->checkgate1_actual_end_date = date("Y-m-d");
		$obj->checkgate1_actual_end_date  = Carbon::createFromFormat('d/m/Y', $request['checkgate1_actual_end_date'])->format('Y-m-d');
        $obj->chkonedept = $request['chkonedept'];
        if(!empty($request['checkgate1_image']) && count($request['checkgate1_image'])<=5){
            $img = 0;
            foreach($request['checkgate1_image'] as $key=>$checkgate1_image){
                if ($request->file('checkgate1_image')) {
                    $imgfile = $request->file('checkgate1_image')[$key];
                    $tmp = explode('.', $imgfile->getClientOriginalName());
                    $ext = end($tmp);
                    $save_imgfile = rand(1000000000,9999999999) . '.' . $ext;
                    $destinationPath = 'public/assets/uploads/checkgate1Image';
                    $imgfile->move($destinationPath, $save_imgfile);
                    $image[$img] = $save_imgfile;
                } else {
                    $image = '';
                }

                $img++;
            }

            $space=str_replace('[', '', $image);

            $res_img = implode(',',$space);
            // echo $res_img;exit;
            $obj->checkgate1_image = $res_img;

        }

        //$obj->checkgate1_image = $res_img;

        if ($request->file('transporter_Copy')) {
            $imgfile = $request->file('transporter_Copy');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/receivingUploads';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
        } else {
            $image = '';
        }
        $obj->transporter_copy = $image;

        if ($request->file('e_way_image')) {
            $imgfile = $request->file('e_way_image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/receivingUploads';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
        } else {
            $image = '';
        }
        $obj->e_way_image = $image;


        if ($request->file('challan')) {
            $imgfile = $request->file('challan');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/receivingUploads';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
        } else {
            $image = '';
        }
        $obj->challan = $image;

        if ($request->file('gate_Pass')) {
            $imgfile = $request->file('gate_Pass');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/receivingUploads';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
        } else {
            $image = '';
        }
        $obj->gate_pass = $image;

//        if ($request->file('gate_Pass')) {
//            $imgfile = $request->file('gate_Pass');
//            $tmp = explode('.', $imgfile->getClientOriginalName());
//            $ext = end($tmp);
//            $save_imgfile = time() . '.' . $ext;
//            $destinationPath = 'public/assets/uploads/receivingUploads';
//            $imgfile->move($destinationPath, $save_imgfile);
//            $image = $save_imgfile;
//        } else {
//            $image = '';
//        }
//        $obj->gate_pass = $image;

        $obj->cg1_status='Submitted';
        $obj->save();
		
		 

        // $obj1 = new CheckgateStatus();

        // $obj1->service_request_id=$obj->id;
        // $obj1->dept_id=$dept_id;
        // $obj1->cg1_status=$request['status'];
        // $obj1->cg1_comment=$request['comment_for_approve'];
        // $obj1->save();

      //send Notification
        $url=url('/');
        //$mailsend=User::select('*')->where('role_id','=',2)->get()->toArray();
        //echo '<pre>';print_r($mailsend);exit;
		
		$mailsend=User::select('email')
            ->where('location_id','=',$location)
            //->orwhere('location_id','=','3')

            ->where(function($query) {

                $query->where('role_id', '2')
                    ->orWhere('role_id', '3');

                    //->orwhere('role_id','=','4');
            })

            ->where(function($query) use ($request) {

                $query->where('section_id','=', $request['chkonedept'])
                    //->orWhere('section_id', '8')

                    ->orwhere('section_id','=','20');
            })
            ->groupby('email')
             ->get()->toArray();
			 //dd($mailsend);
     //    if(!empty($mailsend)){
     //        foreach ($mailsend as $mailone){
				 // $tomail = $mailone['email'];
     //            $data=['subject'=>'Check Gate 1 Submitted Mail','email'=>$tomail,'serviceno' => $obj->service_request_no,'url'=>$url];


     //            Mail::send('admin.mail.serviceNotificationMail', $data, function($message) use ($data) {

     //                $message->to($data['email'])->subject($data['subject']);
     //                //dd(env('service_mail'));
     //                $message->from(env('service_mail'),'QMS');
     //                //$message->from(\Config::get('env.service_mail'),'loyalty@gainwellindia.com');
     //            });
     //        }
     //    }
        
         //project create

       $obj1 = Service::find($request['id'])->toArray();
         //echo'<pre>';print_r($obj1['chkonedept']);exit;
        // $machine_model = UserHelper::machineserialno($request['model']);
        // $dept_name = UserHelper::getDeptName($obj1['dept_id'])[0];
        //$getDeptEmp = UserHelper::getDeptEmp($obj1['dept_id']);
        //$getDeptTasks = UserHelper::getDeptTask($obj1['dept_id']);

        if($obj1['chkonedept'] != '6') {
         $dept_name = UserHelper::getDeptName($obj1['chkonedept'])[0];
         $getDeptEmp = UserHelper::getDeptEmp($location);
         $getDeptTasks = UserHelper::getDeptTask($obj1['chkonedept'], $obj1['machine_modelno']);

            //echo '<pre>';print_r($getDeptTasks);exit;

            if(!empty($getDeptTasks))  {  
             $project_id = '#PRO' . substr(str_shuffle("12345"), -1) . mt_rand(1000, 99999);
             $emp_res = '';
             $task_res = '';
             $task_tat_cal = 0;
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

                 $number = $task_tat_cal . ' days';
                 //$estm_end_date=date_create($obj1['po_date']);
                 //$estm_end_date = date_create($obj->checkgate1_actual_end_date);
        		 $estm_end_date = date_create($obj->checkgate1_actual_start_date);
                 date_add($estm_end_date, date_interval_create_from_date_string($number));

                 $obj_project_plan = new ProjectPlanMaster();
                 $obj_project_plan->service_id = $obj1['id'];
                 $obj_project_plan->service_request_no = $obj1['service_request_no'];
                 $obj_project_plan->workorder = $obj1['work_orderno'];
                 $obj_project_plan->project_id = $project_id;
                 $obj_project_plan->name = $dept_name['name'];
                 $obj_project_plan->dept_id = $obj1['chkonedept'];
                 $obj_project_plan->dept_name = $dept_name['name'];
                 $obj_project_plan->customer_id = $obj1['customer'];
                 //$obj_project_plan->estm_start_date = $obj->checkgate1_actual_end_date;
        		 $obj_project_plan->estm_start_date = $obj->checkgate1_actual_start_date;
                 $obj_project_plan->estm_end_date = date_format($estm_end_date, "Y-m-d");
                 $obj_project_plan->estm_days = $task_tat_cal;
                 $obj_project_plan->save();
                 //echo '<pre>';print_r('rim');print_r($obj_project_plan->id);exit;
                 $obj_project_task = new ProjectTask();
                 $obj_project_task->prj_id = $obj_project_plan->id;
                 $obj_project_task->project_id = $project_id;
                 $obj_project_task->dept_id = $obj1['chkonedept'];
                 $obj_project_task->tasks = $task_res;
                 $obj_project_task->save();


                 $obj_checksheetstatus = new ChecksheetStatus();
                 $obj_checksheetstatus->service_request_id = $request['id'];
                 $obj_checksheetstatus->dept_id = $obj1['chkonedept'];

                 $obj_checksheetstatus->save();


                $obj_checksheetgate = new CheckgateStatus();
                $obj_checksheetgate->service_request_id = $request['id'];
                $obj_checksheetgate->dept_id = $obj1['chkonedept'];
                $obj_checksheetgate->save();


         $userexpld = explode(',', $task_res);

         foreach ($userexpld as $taskwiserow) {

             $taskrow = new TaskUser();
             $taskrow->prj_id = $obj_project_plan->id;
             $taskrow->project_id = $project_id;
               $taskrow->dept_id = $obj1['chkonedept'];
             $taskrow->task = $taskwiserow;
             $task_name = UserHelper::getTaskName($taskwiserow);

                $taskrow->task_name = $task_name[0]['name'];
				 if($taskrow->task_name == ' Disassembly'){
                    $eststrt_date = $obj->checkgate1_actual_start_date;
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

                    $predicessor = UserHelper::predicessorfind($task_name[0]['predicessor'],$obj1['chkonedept'],$project_id);
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

                            if($eststrt_date < $obj->checkgate1_actual_start_date){
                                $taskrow->est_start_date = $obj->checkgate1_actual_start_date;
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
                    $predicessor = UserHelper::predicessorfind($task_name[0]['predicessor'],$obj1['chkonedept'],$project_id);
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

                            if($eststrt_date < $obj->checkgate1_actual_start_date){
                                $taskrow->est_start_date = $obj->checkgate1_actual_start_date;
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
                    $predicessor = UserHelper::predicessorfind($task_name[0]['predicessor'],$obj1['chkonedept'],$project_id);
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

                            if($eststrt_date < $obj->checkgate1_actual_start_date){
                                $taskrow->est_start_date = $obj->checkgate1_actual_start_date;
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
                    $predicessor = UserHelper::predicessorfind($task_name[0]['predicessor'],$obj1['chkonedept'],$project_id);
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

                            if($eststrt_date < $obj->checkgate1_actual_start_date){
                                $taskrow->est_start_date = $obj->checkgate1_actual_start_date;
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
                    $predicessor = UserHelper::predicessorfind($task_name[0]['predicessor'],$obj1['chkonedept'],$project_id);
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

                            if($eststrt_date < $obj->checkgate1_actual_start_date){
                                $taskrow->est_start_date = $obj->checkgate1_actual_start_date;
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

                $taskrow1 =TaskUser::where('task','=',$taskwiserow1)->where('dept_id','=',$obj1['chkonedept'])->where('project_id','=',$project_id)
                    ->get()->first();
                //dd($taskrow1['task_name']);
                $task_name1 = UserHelper::getTaskName($taskwiserow1);
                //$predicessor = UserHelper::predicessorfind($taskwiserow1,$obj1['chkonedept'],$project_id);
                if($taskrow1['task_name'] == ' Disassembly'){
                    if(empty($taskrow1['est_start_date']) || empty($taskrow1['est_end_date'])){
                        $eststrt_date = $obj->checkgate1_actual_start_date;
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
                        $predicessor = UserHelper::predicessorfind($task_name1[0]['predicessor'],$obj1['chkonedept'],$project_id);
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

                                if($eststrt_date < $obj->checkgate1_actual_start_date){
                                    $taskrow1->est_start_date = $obj->checkgate1_actual_start_date;
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

                        $predicessor = UserHelper::predicessorfind($task_name1[0]['predicessor'],$obj1['chkonedept'],$project_id);
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

                                if($eststrt_date < $obj->checkgate1_actual_start_date){
                                    $taskrow1->est_start_date = $obj->checkgate1_actual_start_date;
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
                        $predicessor = UserHelper::predicessorfind($task_name1[0]['predicessor'],$obj1['chkonedept'],$project_id);
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

                                if($eststrt_date < $obj->checkgate1_actual_start_date){
                                    $taskrow1->est_start_date = $obj->checkgate1_actual_start_date;
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
                        $predicessor = UserHelper::predicessorfind($task_name1[0]['predicessor'],$obj1['chkonedept'],$project_id);
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

                                if($eststrt_date < $obj->checkgate1_actual_start_date){
                                    $taskrow1->est_start_date = $obj->checkgate1_actual_start_date;
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
                        $predicessor = UserHelper::predicessorfind($task_name1[0]['predicessor'],$obj1['chkonedept'],$project_id);

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

                                if($eststrt_date < $obj->checkgate1_actual_start_date){
                                    $taskrow1->est_start_date = $obj->checkgate1_actual_start_date;
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
		 
         // echo'<pre>';print_r( $task_res);exit;

           $findestend_date = TaskUser::where('project_id','=',$project_id)->where('dept_id', '=', $obj1['chkonedept'])
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
			  
			  
                     $change_estend_date = DB::table('gw_project_plan_master')->where('project_id', '=', $project_id)->where('dept_id', '=', $obj1['chkonedept'])->update(array('estm_end_date' => $dateput));
            }

              $finddiff_date = ProjectPlanMaster::where('project_id','=',$project_id)->where('dept_id', '=', $obj1['chkonedept'])->get()->toArray();
            if(!empty($finddiff_date[0]['estm_start_date']) && !empty($finddiff_date[0]['estm_end_date'])){
                $to =Carbon::parse($finddiff_date[0]['estm_start_date']);
                $from =Carbon::parse($finddiff_date[0]['estm_end_date']);
                //$diff = strtotime($finddiff_date[0]['estm_end_date']) - strtotime($finddiff_date[0]['estm_start_date']);
                $diff = $to->diffInDays($from);

                //dd($diff);
                if(!empty($diff)){
                    $change_estdayleft = DB::table('gw_project_plan_master')->where('project_id', '=', $project_id)->where('dept_id', '=', $obj1['chkonedept'])->update(array('estm_days' => $diff));
                }

            }


         $obj_project_user = new ProjectUser();
         $obj_project_user->prj_id = $obj_project_plan->id;
         $obj_project_user->project_id = $project_id;
         $obj_project_user->dept_id = $obj1['chkonedept'];
         $obj_project_user->users = $emp_res;
         $obj_project_user->save();
      }

     }
        
		$status="CheckGate1 Submitted";
        $adminstatus= UserHelper::adminstatus($request['id'],$status);
		
        return redirect('admin/servicedashboard-checkgateone');
    }

    //Check Gate Form One Listing
    public function checkgatefromOnelisting($id)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $checkgateone=Service::find($id);
        $rejectmsg=CheckgateStatus::select('*')->where('service_request_id','=',$checkgateone->id)
        ->where('dept_id','=',$dept_id)->get()->toArray();
        // dd($rejectmsg);
        $checkgateonelist=Service::select('*')->where('id','=',$checkgateone->id)
            ->get()->first();
        if(isset($checkgateonelist->id)){
            $checkgateonelist=json_decode($checkgateonelist->checkgate1);
        }else{
            $checkgateonelist=Null;
        }
        
        
        return view('admin.receiving.checkGateFormOneListing')
            ->with('checkgateone',$checkgateone)
            ->with('rejectmsg',$rejectmsg)
            ->with('checkgateonelist',$checkgateonelist);
    }

    public function checkGateFormOneEditSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];

        $checkgateoneedit=$request->all();
        $obj = Service::find($request['id']);
        $obj->checkgate1=$checkgateoneedit;
        $obj->e_way_bill = $request['e_way_bill'];
        $obj->cg1_overall_remarks = $request['cg1_overall_remarks'];
        //$obj->checkgate1_actual_end_date = date("Y-m-d");
		$obj->checkgate1_actual_end_date  = Carbon::createFromFormat('d/m/Y', $request['checkgate1_actual_end_date'])->format('Y-m-d');
        $obj->chkonedept = $request['chkonedept'];
        if(isset($request['img_rem'])){
            //$chk_img = json_decode($obj['checkgate1_image']);
            //$image = $obj->checkgate1_image;
            $image = $obj['checkgate1_image'];

            //$str = ['"','[',']'];
            // $rplc =['','',''];

            //echo str_replace('"', '[',']',str_replace("","","",$image));

            $space = str_replace('"', '',$image);
            //echo '<pre>';print_r($space);exit;
            $chk_img = explode(',',$space);

            foreach($request['img_rem'] as $img_rem){



                $pos= array_search($img_rem, $chk_img);
                unset($chk_img[$pos]);
            }
            //echo '<pre>';print_r($pos);exit;
            $obj->checkgate1_image = $chk_img;
            //echo '<pre>';print_r($chk_img);exit;

        }
        if(isset($checkgateoneedit['checkgate1_image']) && (count($checkgateoneedit['checkgate1_image'])<=5)){
            $i = 0;
            foreach ($checkgateoneedit['checkgate1_image'] as $key=>$checkgate1_image ){
                if ($request->file('checkgate1_image')) {
                    $imgfile = $request->file('checkgate1_image')[$key];
                    $tmp = explode('.', $imgfile->getClientOriginalName());
                    $ext = end($tmp);
                    $save_imgfile = rand(1000000000,9999999999).'.'. $ext;
                    $destinationPath = 'public/assets/uploads/checkgate1Image';
                    $imgfile->move($destinationPath, $save_imgfile);
                    $image[$i] = $save_imgfile;
                    File::delete($destinationPath . '/' . $obj->checkgate1_image);
                } else {
                    if(isset($request['img_rem'])){
                        $destinationPath = 'public/assets/uploads/checkgate1Image';
                        File::delete($destinationPath . '/' . $obj->checkgate1_image);
                        $image='';
                    }else{
                        $image = $obj->checkgate1_image;
                    }

                }

                $i++;
            }
//                echo '<pre>';print_r($image);exit;
//                echo '<pre>';print_r(implode(',',$image));exit;

            $obj->checkgate1_image = json_encode(implode(',',$image));
        }

        if ($request->file('transporter_copy')) {
            $imgfile = $request->file('transporter_copy');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/receivingUploads';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->transporter_copy);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/receivingUploads';
                File::delete($destinationPath . '/' . $obj->transporter_copy);
                $image='';
            }else{
                $image = $obj->transporter_copy;
            }

        }
        $obj->transporter_copy = $image;

       if ($request->file('e_way_image')) {
            $imgfile = $request->file('e_way_image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/receivingUploads';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->e_way_image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/receivingUploads';
                File::delete($destinationPath . '/' . $obj->e_way_image);
                $image='';
            }else{
                $image = $obj->e_way_image;
            }

        }
        $obj->e_way_image = $image;

        if ($request->file('challan')) {
            $imgfile = $request->file('challan');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/receivingUploads';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->challan);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/receivingUploads';
                File::delete($destinationPath . '/' . $obj->challan);
                $image='';
            }else{
                $image = $obj->challan;
            }

        }
        $obj->challan = $image;

        if ($request->file('gate_Pass')) {
            $imgfile = $request->file('gate_Pass');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/receivingUploads';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->gate_Pass);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/receivingUploads';
                File::delete($destinationPath . '/' . $obj->gate_Pass);
                $image='';
            }else{
                $image = $obj->gate_Pass;
            }

        }
        $obj->gate_Pass = $image;

        $obj->cg1_status='Submitted';
        $obj->save();
		
		$status="CheckGate1 Submitted";
        $adminstatus= UserHelper::adminstatus($request['id'],$status);

        // $obj1 = new CheckgateStatus();

        // $obj1->service_request_id=$obj->id;
        // $obj1->dept_id=$dept_id;
        // $obj1->cg1_status=$request['status'];
        // $obj1->cg1_comment=$request['comment_for_approve'];
        // $obj1->save();
        //send Notification

        //send Notification
        $url=url('/');


        $mailsend=User::select('*')->where('role_id','=',2)->get()->toArray();
        //echo '<pre>';print_r($mailsend);exit;
        if(!empty($mailsend)){
            foreach ($mailsend as $mail){

                $to_email = $mail['email'];
                $subject = 'CheckGate1 Update Mail';
                $message = view('admin.mail.checkgateOneNotificationMail', ['url'=>$url])->render();
                $notification= UserHelper::mailnotification($to_email,$subject,$message);
            }
        }
        return redirect('admin/servicedashboard-checkgateone');
    }



    /*  public function checkGateFormOneList()
     {

         return view('admin.receiving.checkGateFormList');
     }

     public function checkGateFormOneListGetTable(Request $request)
     {


         $table = Service::select('*')->get();


         $datatables =  Datatables::of($table)
             /*->addColumn('usertype', function ($table) {
                 if(){

                 }
                 return $btns;
             })
            /*->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/
    /*->addColumn('action', function ($table) {
        $btns = '';
        //$btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
        return $btns;
    })

    ->rawColumns([]);


return $datatables->make(true);
}*/

    /*public function checkGateFormTwo()
     {

         return view('admin.receiving.checkGateFormTwo');

     }*/
    //checkgate-form-two
    public function checkGateFormTwoAdd($id)
    {
        $checkgate=Service::find($id);
        
        $model = Service::select('gw_master_mc_model.model_no')
            ->join('gw_master_mc_model','gw_master_mc_model.id','=','service_request.machine_modelno')
            ->where('service_request.id','=',$id)
            ->get()->toArray();

        $serial = Service::select('gw_master_comp_details.comp_serial_no')
            ->join('gw_master_comp_details','gw_master_comp_details.id','=','service_request.component_serial_no')
            ->where('service_request.id','=',$id)
            ->get()->toArray();

        
       
       $customer = Service::select('gw_master_customer.name')
            ->join('gw_master_customer','gw_master_customer.id','=','service_request.customer')
            ->where('service_request.id','=',$id)
            ->get()->toArray();
            
        //$checkgatetwolist=Service::where('id','=',$checkgate->id)

        //  ->get()->first();
        //if(isset($checkgatetwolist->id)){
        //  $checkgatetwolist=json_decode($checkgatetwolist->values);
        //}else{
        //  $checkgatetwolist=Null;
        //}
        return view('admin.receiving.checkGateFormTwo')
            //    ->with('checkgatetwolist','$checkgatetwolist')
             ->with('model',$model)
        ->with('serial',$serial)
           
            ->with('customer',$customer)
            ->with('checkgate',$checkgate) ;

    }

    public function checkGateFormTwoAddSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];

        $checkgate2=$request->all();
        $obj1 = Service::find($request['id']);
        
        $find =CheckgateStatus::select('id')->where('service_request_id','=',$request['id'])
            ->where('dept_id','=',$dept_id)->get()->toArray();
              $obj = CheckgateStatus::find($find[0]['id']);
        //$obj = new CheckgateStatus();
        $obj->service_request_id=$request['id'];
        $obj->dept_id=$dept_id;
        $obj->checkgate2=json_encode($checkgate2);
        //$obj->checkgate2=$checkgate2;
         $obj->cg2_overall_remarks = $request['cg2_overall_remarks'];
         $obj->checkgate2_actual_start_date  = Carbon::createFromFormat('d/m/Y', $request['checkgate2_actual_start_date'])->format('Y-m-d');
        $obj->checkgate2_actual_end_date  = Carbon::createFromFormat('d/m/Y', $request['checkgate2_actual_end_date'])->format('Y-m-d');
		//$obj->checkgate2_actual_end_date = date("Y-m-d");
        $obj->cg2_status='Submitted';
        $obj->save();
		
		$status="CheckGate2 Submitted";
        $adminstatus= UserHelper::adminstatus($request['id'],$status);

        // $obj1 = new CheckgateStatus();

        // $obj1->service_request_id=$obj->id;
        // $obj1->dept_id=$dept_id;
        // $obj1->cg2_status=$request['status'];
        // $obj1->cg2_comment=$request['comment_for_approve'];
        // $obj1->save();
        //send Notification
        
         $sec=21;
        $notification= UserHelper::tasktableupdateactualdate($dept_id,$obj1->machine_modelno,$request['id'],$sec,$obj->checkgate2_actual_start_date, $obj->checkgate2_actual_end_date);
        
         $sec1=27;
        $notification= UserHelper::tasktableupdateactualdate($dept_id,$obj1->machine_modelno,$request['id'],$sec1,$obj->checkgate2_actual_start_date, $obj->checkgate2_actual_end_date);
        
        return redirect('admin/servicedashboard-checkgatetwo');


    }

    //Check Gate Form Two Listing
    public function checkgatefromtwolisting($id)
    {
        //$myrequest=$request->all();
        //dd($myrequest);exit;
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $checkgate=Service::find($id);
        
        
        if($dept_id == '10' || $dept_id == '11' || $dept_id == '12' ||$dept_id == '15') {
            
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
             $rejectmsg=CheckgateStatus::select('*')->where('service_request_id','=',$checkgate->id)
        ->where('dept_id','=',$dept_id1)->get()->toArray();
       
        if(isset($rejectmsg[0]['id'])){
            $checkgatetwolist=json_decode($rejectmsg[0]['checkgate2']);
        }else{
            $checkgatetwolist=Null;
        }
        }
       else{
        
        $rejectmsg=CheckgateStatus::select('*')->where('service_request_id','=',$checkgate->id)
        ->where('dept_id','=',$dept_id)->get()->toArray();
       
        if(isset($rejectmsg[0]['id'])){
            $checkgatetwolist=json_decode($rejectmsg[0]['checkgate2']);
        }else{
            $checkgatetwolist=Null;
        }
        
       }
       // $checkgatetwolist=Service::where('id','=',$checkgate->id)->get()->first();
        // if(isset($checkgatetwolist->id)){
        //     $checkgatetwolist=json_decode($checkgatetwolist->checkgate2);
        // }else{
        //     $checkgatetwolist=Null;
        // }
        //dd($checkgatetwolist);exit;

        return view('admin.receiving.checkGateFormTwoListing')
            ->with('checkgate',$checkgate)
            ->with('rejectmsg',$rejectmsg)
            ->with('checkgatetwolist',$checkgatetwolist);
    }
    public function checkGateFormTwoEditSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];

        $checkgatetwoedit=$request->all();
        $obj1 = Service::find($request['id']);
        
         $find =CheckgateStatus::select('id')->where('service_request_id','=',$request['id'])
            ->where('dept_id','=',$dept_id)->get()->toArray();
              $obj = CheckgateStatus::find($find[0]['id']);
        $obj->checkgate2=json_encode($checkgatetwoedit);
        //$obj->checkgate2=$checkgatetwoedit;
         $obj->cg2_overall_remarks = $request['cg2_overall_remarks'];
		 $obj->checkgate2_actual_end_date  = Carbon::createFromFormat('d/m/Y', $request['checkgate2_actual_end_date'])->format('Y-m-d');
         //$obj->checkgate2_actual_end_date = date("Y-m-d");
        $obj->cg2_status='Submitted';
        $obj->save();
		
		$status="CheckGate2 Submitted";
        $adminstatus= UserHelper::adminstatus($request['id'],$status);
        
        // $obj1 = new CheckgateStatus();

        // $obj1->service_request_id=$obj->id;
        // $obj1->dept_id=$dept_id;
        // $obj1->cg2_status=$request['status'];
        // $obj1->cg2_comment=$request['comment_for_approve'];
        // $obj1->save();
        //send Notification
        
         $sec=21;
        $notification= UserHelper::tasktableupdateactualdate($dept_id,$obj1->machine_modelno,$request['id'],$sec,$obj->checkgate2_actual_start_date, $obj->checkgate2_actual_end_date);
         
         $sec1=27;
        $notification= UserHelper::tasktableupdateactualdate($dept_id,$obj1->machine_modelno,$request['id'],$sec1,$obj->checkgate2_actual_start_date, $obj->checkgate2_actual_end_date);
        
        return redirect('admin/servicedashboard-checkgatetwo');
    }

    //checkgate-form-threee
    public function checkGateFormThreeAdd($id)
    {
        $checkgate=Service::find($id);
//dd($checkgate);exit;
 $model = Service::select('gw_master_mc_model.model_no')
            ->join('gw_master_mc_model','gw_master_mc_model.id','=','service_request.machine_modelno')
            ->where('service_request.id','=',$id)
            ->get()->toArray();

        $serial = Service::select('gw_master_comp_details.comp_serial_no')
            ->join('gw_master_comp_details','gw_master_comp_details.id','=','service_request.component_serial_no')
            ->where('service_request.id','=',$id)
            ->get()->toArray();

        
       
       $customer = Service::select('gw_master_customer.name')
            ->join('gw_master_customer','gw_master_customer.id','=','service_request.customer')
            ->where('service_request.id','=',$id)
            ->get()->toArray();


        return view('admin.receiving.checkGateFormThree')
 ->with('model',$model)
        ->with('serial',$serial)
           
            ->with('customer',$customer)
            ->with('checkgate',$checkgate) ;

    }

    public function checkGateFormThreeAddSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];

        $checkgate3=$request->all();
        $obj = Service::find($request['id']);
        $obj->checkgate3=$checkgate3;
         $obj->cg3_overall_remarks = $request['cg3_overall_remarks'];
         $obj->checkgate3_actual_start_date  = Carbon::createFromFormat('d/m/Y', $request['checkgate3_actual_start_date'])->format('Y-m-d');
        $obj->checkgate3_actual_end_date  = Carbon::createFromFormat('d/m/Y', $request['checkgate3_actual_end_date'])->format('Y-m-d');
        //$obj->checkgate3_actual_end_date = date("Y-m-d");
        $obj->cg3_status="Submitted";
        $obj->save();

       $status="CheckGate3 Submitted";
        $adminstatus= UserHelper::adminstatus($request['id'],$status);

     $sec=22;
      $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec,$obj->checkgate3_actual_start_date, $obj->checkgate3_actual_end_date);
        
        $sec1=29;
      $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec1,$obj->checkgate3_actual_start_date, $obj->checkgate3_actual_end_date);
        
        // $obj1 = new CheckgateStatus();

        // $obj1->service_request_id=$obj->id;
        // $obj1->dept_id=$dept_id;
        // $obj1->cg3_status=$request['status'];
        // $obj1->cg3_comment=$request['comment_for_approve'];
        // $obj1->save();

        //send Notification
        return redirect('admin/servicedashboard-checkgatethree');


    }

//Check Gate Form three Listing
    public function checkgatefromThreelisting($id)
    {
        //$myrequest=$request->all();
        //dd($myrequest);exit;
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $checkgate=Service::find($id);
        $checkgatethreelist=Service::where('id','=',$checkgate->id)

            ->get()->first();
        if(isset($checkgatethreelist->id)){
            $checkgatethreelist=json_decode($checkgatethreelist->checkgate3);
        }else{
            $checkgatethreelist=Null;
        }
        
        $rejectmsg=CheckgateStatus::select('*')->where('service_request_id','=',$checkgate->id)
        ->where('dept_id','=',$dept_id)->get()->toArray();
        //dd($checkgatetwolist);exit;

        return view('admin.receiving.checkGateFormThreeListing')
            ->with('checkgate',$checkgate)
            ->with('rejectmsg',$rejectmsg)
            ->with('checkgatethreelist',$checkgatethreelist);
    }
    public function checkGateFormThreeEditSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];

        $checkgatetwoedit=$request->all();
        $obj = Service::find($request['id']);
        $obj->checkgate3=$checkgatetwoedit;
         $obj->cg3_overall_remarks = $request['cg3_overall_remarks'];
		 $obj->checkgate3_actual_end_date  = Carbon::createFromFormat('d/m/Y', $request['checkgate3_actual_end_date'])->format('Y-m-d');
          //$obj->checkgate3_actual_end_date = date("Y-m-d");
        $obj->cg3_status='Submitted';
        $obj->save();
        
		
		$status="CheckGate3 Submitted";
        $adminstatus= UserHelper::adminstatus($request['id'],$status);
        
        $sec=22;
        $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec,$obj->checkgate3_actual_start_date, $obj->checkgate3_actual_end_date);

     $sec1=29;
      $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec1,$obj->checkgate3_actual_start_date, $obj->checkgate3_actual_end_date);

        // $obj1 = new CheckgateStatus();

        // $obj1->service_request_id=$obj->id;
        // $obj1->dept_id=$dept_id;
        // $obj1->cg3_status=$request['status'];
        // $obj1->cg3_comment=$request['comment_for_approve'];
        // $obj1->save();
        //send Notification
        return redirect('admin/servicedashboard-checkgatethree');
    }






//super admin
    public function projectsOpenList()
    {

        return view('admin.superadmin.openProjects');
    }

    public function projectsCompletedList()
    {

        return view('admin.superadmin.completedProjects');
    }
   /* public function projectDetails()
    {

        return view('admin.superadmin.projectDetails');
    }*/

    //engine model no
    public function engineModelNoList()
    {

        return view('admin.serviceform.listEngineModelNo');
    }

    public function engineModelNoListGetTable(Request $request)
    {

        $table = MasterEngineModel::select('*')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            /*->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('#' . $table->id) . '">Download quotation</a>
                              </div>
                            </div>';
                //$btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })*/

            ->rawColumns([]);


        return $datatables->make(true);
    }


    //Component Name
    public function componentNameAdd()
    {

        return view('admin.serviceform.addComponentName');
    }

    public function componentNameAddSave(Request $request)
    {

        $obj = new MasterAllComponentName();

        $obj->name=$request['name'];
        /*$obj->job_no=$request['job_no'];
        $obj->component_name=$request['component_name'];
        $obj->model_no=$request['model_no'];
        $obj->ar_no=$request['ar_no'];
        $obj->ar_no=$request['ar_no'];*/


        $obj->save();


        return redirect('admin/super-admin-dashboard');
    }

    public function componentNameEdit($id)
    {
        $title='Edit User';

        $ques=MasterAllComponentName::find($id);

        return view('admin.serviceform.editComponentName')
            ->with('ques',$ques);
    }





    //formelements

    public function formElementsForm()
    {

        return view('admin.dashboard.formElements');
    }


    //service engineer
    public function checkSheetEntry()
    {

        return view('admin.serviceengineer.checkSheetEntry');
    }

    public function checkSheetEntryCommon($id)
    {

        $checkcommon = Service::find($id);
        return view('admin.include.checkSheetCommon')
            ->with('checkcommon',$checkcommon);
    }

    public function serviceList()
    {

        return view('admin.serviceengineer.allserviceList');
    }

    public function serviceGetTable(Request $request)
    {

        $table = Service::select('*')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            /*->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Check Sheet Entry</a>
                              </div>
                            </div>';
                //$btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function machineSerialListShow(Request $request){

        //$machserial= UserHelper::machineserialno($request['model']);
   $machserial= UserHelper::mastermachineserialno();

        //$model=$_POST['model'];


        $str = '<option selected="selected" disabled="disabled">Select Machine Serial number</option>';
        if (!isset($machserial->mc_model_id)) {
            foreach ($machserial as $key => $value) {
                $str .= '<option value=' . $value['id'] . '>' . $value['serial_no'] . '</option>';
            }
        }
        echo $str;

        //$model=$_POST['model'];
        //echo $model;

    }


    public function componentModelListShow(Request $request)
    {

        // $machserial = UserHelper::machineserialno();
        //$compdet = UserHelper::componentdetails($request['commodel']);
		$compdet = UserHelper::componentmodelno();

        $commod = '<option selected="selected" disabled="disabled">Select Component Model number</option>';
        if (!isset($compdet->mc_model_id)) {
            foreach ($compdet as $key => $value) {
                $commod .= '<option value=' . $value['id'] . '>' . $value['comp_model_no'] . '</option>';
            }
        }
        echo $commod;

    }

    public function componentSerialListShow(Request $request)
    {

        // $machserial = UserHelper::machineserialno();
        //$compse = UserHelper::componentserial($request['coserial']);
		$compse = UserHelper::componentserialno();
//dd($compse);exit;
        $comser = '<option selected="selected" disabled="disabled">Select Component Serial number</option>';
        if (!isset($compse->mc_model_id)) {
            foreach ($compse as $key => $value) {
                $comser .= '<option value=' . $value['id'] . '>' . $value['comp_serial_no'] . '</option>';
            }
        }
        echo $comser;
    }

//quotation upload
    public function supportQuotationList(){

        return view('admin.support.quotationUpload');
    }

    public function supportQuotationgetTableDownload(){

        $data = Session::all();
        // echo '<pre>';print_r($data['user']);exit;
        $location=$data['user']['location_id'];
        $table = Service::select('*')
        //->where('quotation','!=','Null')
        ->where('location_id','=',$location)

        ->orderby('created_at','DESC')->get();

        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/SupportQuotationList.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'SERVICE  NO' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'SEGMENT' => $table['segment'],
                'JOB' => $table['job_type'],
                'COMPONENT' => $table['component_name'],
                'QUOTATION' =>($table['quotation'] != '') ? "http://182.73.17.4:81/gcpl-quality/public/assets/uploads/quotationupload/".$table['quotation'] : 'NULL',
                'STATUS' => $table['status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);


    }

    public function supportQuotationgetTable(Request $request)
    {

        $data = Session::all();
        // echo '<pre>';print_r($data['user']);exit;
        $location=$data['user']['location_id'];
        $table = Service::select('*')
        //->where('quotation','!=','Null')
        ->where('location_id','=',$location)

        ->orderby('created_at','DESC')->get();
        
        if($data['user']['section_id']==1){
             $datatables =  Datatables::of($table)
            ->addColumn('action', function ($table) {
				if($table->quotation != Null){
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                 <a class="dropdown-item" href="' . url('admin/quotation-download-show/' ) ."/". $table->id. '">Download Quotation</a>
                              </div>
                            </div>';
               
                return $btns;
				}
            })

            ->rawColumns(['action']);
        }
        elseif($data['user']['section_id']==2 || $data['user']['section_id']==8){
             $datatables =  Datatables::of($table)
            ->addColumn('action', function ($table) {
               
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/support-quotation-add/' ) ."/". $table->id. '">Upload Quotation</a>
                                 <!--<a class="dropdown-item" href="' . url('admin/quotation-download-show/' ) ."/". $table->id. '">Download Quotation</a>-->
                              </div>
                            </div>';
                //$btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);
        }
        else{
            $datatables =  Datatables::of($table)
            ->addColumn('action', function ($table) {
				if($table->quotation != Null){
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/support-quotation-add/' ) ."/". $table->id. '">Upload Quotation</a>
                                 <a class="dropdown-item" href="' . url('admin/quotation-download-show/' ) ."/". $table->id. '">Download Quotation</a>
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
                                <a class="dropdown-item" href="' . url('admin/support-quotation-add/' ) ."/". $table->id. '">Upload Quotation</a>
                                 
                              </div>
                            </div>';
				}
                //$btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);
        }

       
            
        return $datatables->make(true);
    }
    public function supportQuotationAdd($id)
    {

        $service=Service::find($id);
        return view('admin.support.addQuotation')
            ->with('service',$service);
    }

    public function supportQuotationAddSave(Request $request)
    {
      $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
        $obj = Service::find($request['id']);

        //$request->file('quotation')

        $data=[];

        // $data=$request->file('quotation');

        /*$pdf_path='public/assets/uploads/quotationupload/1234567.pdf';
        $pdf = \PDF::loadView('admin.support.pdfQuotation', $data)->save($pdf_path);

        $obj->quotation=$request['quotation'];
        $obj->save();*/

        if ($request->file('quotation')) {
            $imgfile = $request->file('quotation');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/quotationupload';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
        } else {
            $image = '';
        }
        $obj->quotation = $image;
		$obj->quotation_date  = Carbon::createFromFormat('d/m/Y', $request['quotation_date'])->format('Y-m-d');
        //$obj->quotation_date = date("Y-m-d");
        $obj->save();
		
		//$status="Quotation Uploaded";
        //$adminstatus= UserHelper::adminstatus($request['id'],$status);

        //send notification/mail

        $url=url('/');


        //$mailsend=User::select('*')->where('section_id','=',1)->where('role_id','=',2)->get()->toArray();
		
        $mailsend=User::select('email')
            ->where(function($query) use($location) {

                $query->where('location_id','=',$location)
                    ->orWhere('location_id','=','3');


            })

            ->where('role_id','!=', '1')

            ->where(function($query)  {

                $query->where('section_id','=', '20')

                    ->orWhere('section_id','=', '24');


                   // ->orwhere('section_id','=',$sectionid);
            })
            ->groupby('email')
            ->get()->toArray();
        //echo '<pre>';print_r($mailsend);exit;
		//$emailId=['rimpidas329@gmail.com','rimpi.329.das@gmail.com'];
        if(!empty($mailsend)){
			
			foreach ($mailsend as $mailone) {
				$tomail = $mailone['email'];
                $data = ['subject' => 'Quotation Upload Mail', 'email' => $tomail, 'serviceno' => $obj->service_request_no, 'url' => $url];


                Mail::send('admin.mail.quotationUploadMail', $data, function ($message) use ($data) {

                    $message->to($data['email'])->subject($data['subject']);
                    //dd($message);
                    $message->from(env('service_mail'), 'QMS');
                    //$message->from(\Config::get('env.service_mail'),'loyalty@gainwellindia.com');
                });
            }

        }


        return redirect('admin/support-quotation-list');
    }

    //upload Po in spc
    public function uploadPoAdd($id)
    {

        $service=Service::find($id);
        return view('admin.spc.addPO')
            ->with('service',$service);
    }
    public function uploadPoAddSave(Request $request)
    {

        $obj = Service::find($request['id']);

        if ($request->file('po_upload')) {
            $imgfile = $request->file('po_upload');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/servicePOUpload';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
        } else {
            $image = '';
        }
        $obj->po_upload = $image;
		
		if(!empty($request['parts_val'])){
            $obj->parts_val = $request['parts_val'];
        }
        if(!empty($request['service_val'])){
            $obj->service_val = $request['service_val'];
        }
       //$obj->po_date = $request['po_date'];
	   $obj->po_date  = Carbon::createFromFormat('d/m/Y', $request['po_date'])->format('Y-m-d');
        //$obj->po_date = date("Y-m-d");
        $obj->po_status = "Submitted";
        $obj->save();
		
		$status="PO Submitted";
        $adminstatus= UserHelper::adminstatus($request['id'],$status);
        
        /*$obj = Service::find($request['id'])->toArray();

        // $machine_model = UserHelper::machineserialno($request['model']);
        $dept_name = UserHelper::getDeptName($obj['dept_id'])[0];
        $getDeptEmp = UserHelper::getDeptEmp($obj['dept_id']);
        $getDeptTasks = UserHelper::getDeptTask($obj['dept_id']);
        $project_id = '#PRO'.substr(str_shuffle("12345"), -1).mt_rand(1000,99999);
        $emp_res = '';
        $task_res = '';
        $task_tat_cal = 0;
        if(!empty($getDeptEmp)){
            foreach ($getDeptEmp as $key => $emp) {
                if($key == 0)
                {
                    $emp_res =$emp['emp_code'];
                } else {
                    $emp_res =$emp_res.','.$emp['emp_code'];
                }
            }
        }
        if(!empty($getDeptTasks)){
            foreach ($getDeptTasks as $key => $task) {
                if(empty($task['tat'])){
                    $task['tat'] = 0;
                }
                $task_tat_cal += $task['tat'];
                if($key == 0)
                {
                    $task_res =$task['id'];
                } else {
                    $task_res =$task_res.','.$task['id'];
                }
            }
        }

        $number = $task_tat_cal.' days';
        $estm_end_date=date_create($obj['po_date']);
        date_add($estm_end_date,date_interval_create_from_date_string($number));

        $obj_project_plan = new ProjectPlanMaster();
        $obj_project_plan->service_id=$obj['id'];
        $obj_project_plan->service_request_no=$obj['service_request_no'];
        $obj_project_plan->project_id=$project_id;
        $obj_project_plan->name=$dept_name['name'];
        $obj_project_plan->dept_id=$obj['dept_id'];
        $obj_project_plan->dept_name=$dept_name['name'];
        $obj_project_plan->customer_id=$obj['customer'];
        $obj_project_plan->estm_start_date=$obj['po_date'];
        $obj_project_plan->estm_end_date=date_format($estm_end_date,"Y-m-d");
        $obj_project_plan->estm_days=$task_tat_cal;
        $obj_project_plan->save();

        $obj_project_task = new ProjectTask();
        $obj_project_task->prj_id = $obj_project_plan->id;
        $obj_project_task->project_id = $project_id;
        $obj_project_task->dept_id = $obj['dept_id'];
        $obj_project_task->tasks = $task_res;
        $obj_project_task->save();

        $obj_project_user = new ProjectUser();
        $obj_project_user->prj_id = $obj_project_plan->id;
        $obj_project_user->project_id = $project_id;
        $obj_project_user->dept_id = $obj['dept_id'];
        $obj_project_user->users = $emp_res;
        $obj_project_user->save();*/


//notification
        $data = Session::all();
        $url=url('/');
        $location=$data['user']['location_id'];
        $dpt= $obj->chkonedept;
        if($dpt == 4){
            $sectionid = 10;
        }else if($dpt == 5){
            $sectionid = 11;
        }else if($dpt == 7){
            $sectionid = 15;
        }else if($dpt == 6){
            $sectionid = 6;
        }else if($dpt == 13){
            $sectionid = 12;
        }



        $mailsend=User::select('email')


            ->where('location_id','=',$location)
            ->where('role_id','!=', '1')

            ->where(function($query) use($sectionid) {

                $query->where('section_id','=', $sectionid)

                    //->orWhere('section_id','=', '21')


                    ->orwhere('section_id','=','20');
            })
            ->groupby('email')
            ->get()->toArray();
        if(!empty($mailsend)){

            foreach ($mailsend as $mailone){
				$tomail = $mailone['email'];
                $data=['subject'=>'PO Upload Mail','email'=>$tomail,'serviceno' => $obj->service_request_no,'url'=>$url];


                Mail::send('admin.mail.serviceNotificationMail', $data, function($message) use ($data) {

                    $message->to($data['email'])->subject($data['subject']);
                    //dd($message);
                    $message->from(env('service_mail'),'QMS');
                    //$message->from(\Config::get('env.service_mail'),'loyalty@gainwellindia.com');
                });
            }
        }
        //dd($obj->work_orderno);exit;

        return redirect('admin/spc-dashboard');
    }

    public function spcDashboardListGetTableDownload(){

        $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
        $table = Service::select('*')
        ->where('work_orderno','!=','Null')
            ->where('service_request.location_id','=',$location)
        // ->where('work_orderno','!=',' ')
        ->orderby('created_at','DESC')->get();

        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/SpcDashboard.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'SERVICE  NO' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'SEGMENT' => $table['segment'],
                'JOB' => $table['job_type'],
                'QUOTATION' =>($table['po_upload'] != '') ? "http://182.73.17.4:81/gcpl-quality/public/assets/uploads/servicePOUpload/".$table['po_upload'] : 'NULL',
                'STATUS' => $table['status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);



    }


    //spc dashboard
    public function spcDashboardListGetTable(Request $request)
    {

        $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
        $table = Service::select('*')
        ->where('work_orderno','!=','Null')
            ->where('service_request.location_id','=',$location)
        // ->where('work_orderno','!=',' ')
        ->orderby('created_at','DESC')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            /* ->addColumn('quotation', function ($table) {
                  $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                  return $img;
              })*/

            ->addColumn('action', function ($table) {
                if(isset($table->po_upload) && strlen($table->po_upload) > 1) {
                    $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/upload-po-add/') . "/" . $table->id . '">Upload PO</a>
                                <a class="dropdown-item" href="' . url('admin/po-download-show/') . "/" . $table->id . '">Download PO</a>
                              </div>
                            </div>';
                    //$btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                    return $btns;
                }else{
                    $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/upload-po-add/') . "/" . $table->id . '">Upload PO</a>
                                
                              </div>
                            </div>';
                    //$btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                    return $btns;
                }
            })

            ->rawColumns(['action']);
        return $datatables->make(true);
    }


    //engine head dashboard

    public function engHeadDashboardGetTable(Request $request)
    {

        $table = Service::select('*')

            ->orderBy('status', 'DESC')
            ->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            /* ->addColumn('quotation', function ($table) {
                  $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                  return $img;
              })*/

            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                               <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common')."/". "$table->id". '">Checksheet entry</a>
                                
                              </div>
                            </div>';
                //$btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);
        return $datatables->make(true);
    }


    public function mastermachinedetails( request $id)
    {
        $servicerequest = Service::find($id);
        $machinemodel = Service::select('service_request.id', 'machine_modelno', 'gw_master_mc_model.model_no')->leftjoin('gw_master_mc_model',
            'gw_master_mc_model.id', '=', 'service_request.machine_modelno')->where('service_request.id', '=', $id)->get();

        $machserial = Service::select('service_request.id','machine_serialno', 'gw_master_machine_serial_no.serial_no')
            ->leftjoin('gw_master_machine_serial_no','gw_master_machine_serial_no.id', '=', 'service_request.machine_serialno')
            ->where('service_request.id', '=' ,$id)->get();
        return view('admin.receiving.mastermachinedetails')
            ->with('servicerequest', $servicerequest)
            ->with('machinemodel', $machinemodel)
            ->with('machserial',$machserial);
    }
    public function rollmenulist()
    {
        //$masterrole = Masterrole::find($id);
        //$mastermenu = Menu::select('menu');
        return view('admin.superadmin.rollmenulist');
        //->with('mastermenu', $mastermenu);
        //->with('masterrole', $masterrole);
    }



    public function rollmenulistsave(Request $request)

    {
        $rollmenulist=$request->all();
        //echo'<pre>';print_r($rollmenulist);exit;
        //dd($rollmenulist);exit;
        //$rollmenu=$request->all('menu');
        $obj = new Menuaccess();
        //$obj->role = json_encode($rollmenulist);
        $obj->role = $rollmenulist['role'];
        $obj->menu = json_encode($rollmenulist['checked']);
        $obj->save();
        return redirect('admin/rollmenu');
    }
    public function rollmenulisting($id)
    {
        $role=Menuaccess::find($id);
        $rollmenulist=Menuaccess::where('menu')->get()->first();
        if(isset($rollmenulist->id)) {
            $rollmenulist = json_decode($rollmenulist->menu);
        }else{
            $rollmenulist=Null;
        }

        $rolemenu = Menuaccess::select('menu_access.id', 'role', 'roles.name')->leftjoin('roles',
            'roles.id', '=', 'menu_access.role')->where('menu_access.role', '=', $id)->get();


        return view('admin.superadmin.rollmenulisting')

            ->with('rolemenu',$rolemenu)
            ->with('rollmenulist',$rollmenulist);
    }





    //quotation download

    public function quotationDownloadShow($id)
    {

        $service=Service::find($id);
        return view('admin.branchengineer.downloadQuotationShow')
            ->with('service',$service);
    }
    public function quotationDownload(Request $request)
    {

        $quotationdownload= Service::find($request['id']);

        //dd($quotationdownload);exit;


        $file='public/assets/uploads/quotationupload/';

        // $name= $file.$quotationdownload;

        $pathToFile=$file."/".$quotationdownload->quotation;
        // $file=$path.'1576847665.pdf';
        //$name = basename($file);
        return Response::download($pathToFile);

        //return redirect('admin/branch-dashboard');

    }


    public function poDownloadShow($id)
    {

        $service=Service::find($id);
        return view('admin.spc.downloadPO')
            ->with('service',$service);
    }
    public function poDownload(Request $request)
    {

        $podownload= Service::find($request['id']);

        //dd($quotationdownload);exit;


        $file='public/assets/uploads/servicePOUpload/';

        // $name= $file.$quotationdownload;

        $pathToFile=$file."/".$podownload->po_upload;
        // $file=$path.'1576847665.pdf';
        //$name = basename($file);
        return Response::download($pathToFile);

        //return redirect('admin/branch-dashboard');

    }

    public function checkGateFormFourAdd($id)
    {
        $checkgate = Service::find($id);
         $model = Service::select('gw_master_mc_model.model_no')
            ->join('gw_master_mc_model','gw_master_mc_model.id','=','service_request.machine_modelno')
            ->where('service_request.id','=',$id)
            ->get()->toArray();

        $serial = Service::select('gw_master_comp_details.comp_serial_no')
            ->join('gw_master_comp_details','gw_master_comp_details.id','=','service_request.component_serial_no')
            ->where('service_request.id','=',$id)
            ->get()->toArray();

        
       
       $customer = Service::select('gw_master_customer.name')
            ->join('gw_master_customer','gw_master_customer.id','=','service_request.customer')
            ->where('service_request.id','=',$id)
            ->get()->toArray();


        return view('admin.receiving.checkGateFormFour')
        ->with('model',$model)
        ->with('serial',$serial)
           
            ->with('customer',$customer)
            ->with('checkgate', $checkgate);
    }

    public function checkGateFormFourAddSave(Request $request)

    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $checkgate4 = $request->all();
        $obj = Service::find($request['id']);
        $obj->checkgate4 = $checkgate4;
         $obj->cg4_overall_remarks = $request['cg4_overall_remarks'];
        $obj->cg4_status='Submitted';
        $obj->checkgate4_actual_start_date  = Carbon::createFromFormat('d/m/Y', $request['checkgate4_actual_start_date'])->format('Y-m-d');
        $obj->checkgate4_actual_end_date  = Carbon::createFromFormat('d/m/Y', $request['checkgate4_actual_end_date'])->format('Y-m-d');
        //$obj->checkgate4_actual_end_date = date("Y-m-d");
        $obj->save();
        
        $status="CheckGate4 Submitted";
        $adminstatus= UserHelper::adminstatus($request['id'],$status);
		
        $sec=25;
        $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec,$obj->checkgate4_actual_start_date, $obj->checkgate4_actual_end_date);
        
         $sec1=31;
        $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec1,$obj->checkgate4_actual_start_date, $obj->checkgate4_actual_end_date);
        
        //send Notification
        $url=url('/');
        //dd($url);exit;

        $mailsend=User::select('*')->where('section_id','=',1)->where('role_id','=',2)->get()->toArray();
        //echo '<pre>';print_r($mailsend);exit;
        if(!empty($mailsend)){
            foreach ($mailsend as $mail){

                $to_email = $mail['email'];
                $subject = 'CheckGate 4 Create Mail';
                $message = view('admin.mail.checkgatefourNotificationMail', ['url'=>$url])->render();
                $notification= UserHelper::mailnotification($to_email,$subject,$message);
            }
        }
        
        
        return redirect('admin/servicedashboard-checkgatefour');

    }
    
    public function checkgatefromfourlisting($id)
    {
        //$myrequest=$request->all();
        //dd($myrequest);exit;
        
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $checkgate = Service::find($id);
        $checkgateFourlist = Service::where('id', '=', $checkgate->id)
            ->get()->first();
        if (isset($checkgateFourlist->id)) {
            $checkgateFourlist = json_decode($checkgateFourlist->checkgate4);


        } else {
            $checkgateFourlist = Null;
        }
        
        $rejectmsg=CheckgateStatus::select('*')->where('service_request_id','=',$checkgate->id)
        ->where('dept_id','=',$dept_id)->get()->toArray();
        //dd($checkgatetwolist);exit;

        return view('admin.receiving.checkGateFormFourListing')
            ->with('rejectmsg',  $rejectmsg)
            ->with('checkgate',  $checkgate)
            ->with('checkgateFourlist',  $checkgateFourlist);
    }
    public function checkGateFormFourEditSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $checkgatefouredit=$request->all();
        $obj = Service::find($request['id']);
        $obj->checkgate4=$checkgatefouredit;
        $obj->cg4_overall_remarks = $request['cg4_overall_remarks'];
        $obj->cg4_status='Submitted';
		$obj->checkgate4_actual_end_date  = Carbon::createFromFormat('d/m/Y', $request['checkgate4_actual_end_date'])->format('Y-m-d');
        //$obj->checkgate4_actual_end_date = date("Y-m-d");
        $obj->save();
        
		
		$status="CheckGate4 Submitted";
        $adminstatus= UserHelper::adminstatus($request['id'],$status);
		
        $sec=25;
        $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec,$obj->checkgate4_actual_start_date, $obj->checkgate4_actual_end_date);
        
         $sec1=31;
        $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec1,$obj->checkgate4_actual_start_date, $obj->checkgate4_actual_end_date);
        //send Notification
         $url=url('/');
        //dd($url);exit;

        $mailsend=User::select('*')->where('section_id','=',1)->where('role_id','=',2)->get()->toArray();
        //echo '<pre>';print_r($mailsend);exit;
        if(!empty($mailsend)){
            foreach ($mailsend as $mail){

                $to_email = $mail['email'];
                $subject = 'CheckGate 4 Update Mail';
                $message = view('admin.mail.checkgatefourNotificationMail', ['url'=>$url])->render();
                $notification= UserHelper::mailnotification($to_email,$subject,$message);
            }
        }
        
        return redirect('admin/servicedashboard-checkgatefour');
    }

    //common mail for all information

//PDI checksheet
    public function pdiAdd($id)
    {
       $pdiadd = Service::find($id);

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


        return view('admin.pdichecksheet.pdiCheckSheet')
            ->with('customer', $customer)
            ->with('model', $model)
            ->with('serial', $serial)
            ->with('pdiadd', $pdiadd);
    }


    public function dispatchpdiAdd($id)
    {
       $pdiadd = Service::find($id);

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

        return view('admin.pdichecksheet.dispatchpdiCheckSheet')
            ->with('customer', $customer)
            ->with('pdichecksheet', $pdiadd)
            ->with('model', $model)
            ->with('serial', $serial)
            ->with('pdiadd', $pdiadd);
    }


    public function transmissionpdiAdd($id)
    {
       $pdiadd = Service::find($id);

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

        return view('admin.pdichecksheet.transmissionpdiCheckSheet')
            ->with('customer', $customer)
            ->with('pdichecksheet', $pdiadd)
            ->with('model', $model)
            ->with('serial', $serial)
            ->with('pdiadd', $pdiadd);
    }



    public function pdiAddSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $pdiAddSave = $request->all();
        $obj = Service::find($request['id']);
        $obj->pdi_checksheet = $pdiAddSave;
        $obj->pdi_status= 'Submitted';
        $obj->pdi_actual_start_date  = Carbon::createFromFormat('d/m/Y', $request['pdi_actual_start_date'])->format('Y-m-d');
        $obj->pdi_actual_end_date  = Carbon::createFromFormat('d/m/Y', $request['pdi_actual_end_date'])->format('Y-m-d');
        //$obj->pdi_actual_end_date = date("Y-m-d");
        $obj->save();
        
        $status="PDI Submitted";
        $adminstatus= UserHelper::adminstatus($request['id'],$status);
		
        $sec=24;
        $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec,$obj->pdi_actual_start_date, $obj->pdi_actual_end_date);
        
        $sec1=30;
        $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec1,$obj->pdi_actual_start_date, $obj->pdi_actual_end_date);
        
        //send Notification
        return redirect('admin/servicedashboard-pdilist');

    }

    public function dispatchpdiAddSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $pdiAddSave = $request->all();
        $obj = Service::find($request['id']);
        $obj->pdi_checksheet_engine = $pdiAddSave;
        $obj->pdi_engine_status= 'Submitted';
        $obj->pdi_engine_start_date  = Carbon::createFromFormat('d/m/Y', $request['pdi_actual_start_date'])->format('Y-m-d');
        $obj->pdi_engine_end_date  = Carbon::createFromFormat('d/m/Y', $request['pdi_actual_end_date'])->format('Y-m-d');
        //$obj->pdi_actual_end_date = date("Y-m-d");
        $obj->save();
        
        // $status="PDI Submitted";
        // $adminstatus= UserHelper::adminstatus($request['id'],$status);
        
        // $sec=24;
        // $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec,$obj->pdi_actual_start_date, $obj->pdi_actual_end_date);
        
        // $sec1=30;
        // $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec1,$obj->pdi_actual_start_date, $obj->pdi_actual_end_date);
        
        //send Notification
        return redirect('admin/service-pdilist');

    }

     public function transmissionpdiAddSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $pdiAddSave = $request->all();
        $obj = Service::find($request['id']);
        $obj->pdi_checksheet_transmission = $pdiAddSave;
        $obj->pdi_transmission_status= 'Submitted';
        $obj->pdi_transmission_start_date  = Carbon::createFromFormat('d/m/Y', $request['pdi_actual_start_date'])->format('Y-m-d');
        $obj->pdi_transmission_end_date  = Carbon::createFromFormat('d/m/Y', $request['pdi_actual_end_date'])->format('Y-m-d');
        //$obj->pdi_actual_end_date = date("Y-m-d");
        $obj->save();
        
        // $status="PDI Submitted";
        // $adminstatus= UserHelper::adminstatus($request['id'],$status);
        
        // $sec=24;
        // $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec,$obj->pdi_actual_start_date, $obj->pdi_actual_end_date);
        
        // $sec1=30;
        // $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec1,$obj->pdi_actual_start_date, $obj->pdi_actual_end_date);
        
        //send Notification
        return redirect('admin/service-pdilist');

    }

    public function pdilisting($id)
    {
        

        $data = Session::all();
        $dept_id=$data['user']['section_id'];

            $pdichecksheet = Service::find($id);
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

            $pdichecksheetlist = Service::where('id', '=', $pdichecksheet->id)
                ->get()->first();
            if (isset($pdichecksheetlist->id)) {
                $pdichecksheetlist = json_decode($pdichecksheetlist->pdi_checksheet);

            } else {
                $pdichecksheetlist = Null;
            }

            $rejectmsg=CheckgateStatus::select('*')->where('service_request_id','=',$pdichecksheet->id)
                ->where('dept_id','=',$dept_id)->get()->toArray();

            return view('admin.pdichecksheet.pdiCheckSheetListing')
                ->with('customer', $customer)
                ->with('model', $model)
                ->with('serial', $serial)
                ->with('rejectmsg',  $rejectmsg)
                ->with('pdichecksheet',  $pdichecksheet)
                ->with('pdichecksheetlist',  $pdichecksheetlist);
    }

    public function dispatchpdilisting($id)
    {
        

        $data = Session::all();
        $dept_id=$data['user']['section_id'];

        $pdichecksheet = Service::find($id);
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

            $pdichecksheetlist = Service::where('id', '=', $pdichecksheet->id)
                ->get()->first();
            if (isset($pdichecksheetlist->id)) {
                $pdichecksheetlist = json_decode($pdichecksheetlist->pdi_checksheet_engine);

            } else {
                $pdichecksheetlist = Null;
            }



            $rejectmsg=CheckgateStatus::select('*')->where('service_request_id','=',$pdichecksheet->id)
                ->where('dept_id','=',$dept_id)->get()->toArray();

            return view('admin.pdichecksheet.dispatchpdiCheckSheetListing')
                ->with('customer', $customer)
                ->with('model', $model)
                ->with('serial', $serial)
                ->with('rejectmsg',  $rejectmsg)
                ->with('pdichecksheet',  $pdichecksheet)
                ->with('pdichecksheetlist',  $pdichecksheetlist);
    }


    public function transmissionpdilisting($id)
    {
        

        $data = Session::all();
        $dept_id=$data['user']['section_id'];

        $pdichecksheet = Service::find($id);
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

            $pdichecksheetlist = Service::where('id', '=', $pdichecksheet->id)
                ->get()->first();
            if (isset($pdichecksheetlist->id)) {
                $pdichecksheetlist = json_decode($pdichecksheetlist->pdi_checksheet_transmission);

            } else {
                $pdichecksheetlist = Null;
            }



            $rejectmsg=CheckgateStatus::select('*')->where('service_request_id','=',$pdichecksheet->id)
                ->where('dept_id','=',$dept_id)->get()->toArray();

            return view('admin.pdichecksheet.transmissionpdiCheckSheetListing')
                ->with('customer', $customer)
                ->with('model', $model)
                ->with('serial', $serial)
                ->with('rejectmsg',  $rejectmsg)
                ->with('pdichecksheet',  $pdichecksheet)
                ->with('pdichecksheetlist',  $pdichecksheetlist);
    }







    public function pdiEditSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $pdicheckgateedit=$request->all();
        $obj = Service::find($request['id']);
        $obj->pdi_checksheet= $pdicheckgateedit;
         $obj->pdi_status= 'Submitted';
		 $obj->pdi_actual_end_date  = Carbon::createFromFormat('d/m/Y', $request['pdi_actual_end_date'])->format('Y-m-d');
         //$obj->pdi_actual_end_date = date("Y-m-d");
        $obj->save();
        
		
		$status="PDI Submitted";
        $adminstatus= UserHelper::adminstatus($request['id'],$status);
		
         $sec=24;
        $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec,$obj->pdi_actual_start_date, $obj->pdi_actual_end_date);
        
         $sec1=30;
        $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec1,$obj->pdi_actual_start_date, $obj->pdi_actual_end_date);
        
        //send Notification
        return redirect('admin/servicedashboard-pdilist');
    }



    public function dispatchpdiEditSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $pdicheckgateedit=$request->all();


        $obj = Service::find($request['id']);
        $obj->pdi_checksheet_engine= $pdicheckgateedit;
         $obj->pdi_engine_status= 'Submitted';
         $obj->pdi_engine_end_date  = Carbon::createFromFormat('d/m/Y', $request['pdi_actual_end_date'])->format('Y-m-d');
         //$obj->pdi_actual_end_date = date("Y-m-d");
        $obj->save();
        
        
        // $status="PDI Submitted";
        // $adminstatus= UserHelper::adminstatus($request['id'],$status);
        
        //  $sec=24;
        // $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec,$obj->pdi_actual_start_date, $obj->pdi_actual_end_date);
        
        //  $sec1=30;
        // $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec1,$obj->pdi_actual_start_date, $obj->pdi_actual_end_date);
        
        //send Notification
        return redirect('admin/service-pdilist');
    }

    public function transmissionpdiEditSave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $pdicheckgateedit=$request->all();


        $obj = Service::find($request['id']);
        $obj->pdi_checksheet_transmission= $pdicheckgateedit;
         $obj->pdi_transmission_status= 'Submitted';
         $obj->pdi_transmission_end_date  = Carbon::createFromFormat('d/m/Y', $request['pdi_actual_end_date'])->format('Y-m-d');
         //$obj->pdi_actual_end_date = date("Y-m-d");
        $obj->save();
        
        
        // $status="PDI Submitted";
        // $adminstatus= UserHelper::adminstatus($request['id'],$status);
        
        //  $sec=24;
        // $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec,$obj->pdi_actual_start_date, $obj->pdi_actual_end_date);
        
        //  $sec1=30;
        // $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$obj->machine_modelno,$request['id'],$sec1,$obj->pdi_actual_start_date, $obj->pdi_actual_end_date);
        
        //send Notification
        return redirect('admin/service-pdilist');
    }

    //project plan
    // Assign Users to Project
    public function AssignUserProject(Request $request){
        $project_user = ProjectUser::find($request['prj_user_id']);
        $project_user->prj_id = $request['prj_id'];
        $project_user->project_id = $request['project_id'];
        $project_user->dept_id = $request['dept_id'];
        $project_user->users = implode(',', $request['asign_user']);
        //mail send
        if(isset($request['notifymailproj'])) {
            foreach ($request['asign_user'] as $empcode) {
                $mail = UserHelper::getempcodeformail($empcode);
                $to_email = $mail[0]['email'];
                //echo '<pre>';print_r($to_email);
                $subject = 'Assign Project Mail';
                $message = view('admin.mail.assignUserMail')->render();
                mail($to_email, $subject, $message);
                //$notification = UserHelper::mailnotification($to_email, $subject, $message);
            }
            //exit;

        }
        $project_user->save();
        return redirect('admin/project-details/'.$project_user->prj_id);
    }

    // Assign Users to Task
    public function AssignUserTask(Request $request){


        $date1=date_create($request['actual_strt_dt']);
        $date2=date_create($request['end_dt']);
        $diff=date_diff($date1,$date2);
        $tat =  $diff->format("%a");

        $masterTask = new MasterTask();
        $masterTask->dept_id  =  $request['dept_id'];
        $masterTask->model_no  =  $request['model_no'];
        $masterTask->name  =  $request['main_task'];
        if(isset($request['parent_task_id'])){
            $masterTask->parent  =  $request['parent_task_id'];
        }
        $masterTask->tat  =  $tat;
        $masterTask->save();

        $taskUsers = new TaskUser();
        $taskUsers->prj_id  =  $request['prj_id'];
        $taskUsers->project_id  =  $request['project_id'];
        $taskUsers->task  =  $masterTask->id;
        $taskUsers->actual_strt_dt  =  $request['actual_strt_dt'];
        $taskUsers->end_dt  =  $request['end_dt'];
        // $taskUsers->comment   =  $request['comment'];
        $taskUsers->users  =  implode(',', $request['task_users']);
        $taskUsers->save();

        $getDeptTasks = UserHelper::getDeptTask($request['dept_id']);
        $task_res = '';
        $task_tat_cal = 0;
        if(!empty($getDeptTasks)){
            foreach ($getDeptTasks as $key => $task) {
                if(empty($task['tat'])){
                    $task['tat'] = 0;
                }
                $task_tat_cal += $task['tat'];
                if($key == 0)
                {
                    $task_res =$task['id'];
                } else {
                    $task_res =$task_res.','.$task['id'];
                }
            }
        }

        $project_task=ProjectTask::find($request['prj_task_id']);
        $project_task->tasks = $task_res;
        $project_task->save();



        return redirect('admin/project-details/'.$request['prj_id']);
    }
    
    public function AssignUserProjectTaskold(Request $request){
        //$data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $taskUsers = TaskUser::where('task','=',$request['parent_task_id'])
            ->where('prj_id','=',$request['prj_id'])
            ->get()->toArray();
        $users = implode(',',$request['asign_user_task']);
        //echo '<pre>';print_r($users);exit;
        //mail send
        if(isset($request['notifyProjecttask'])) {
            foreach ($request['asign_user_task'] as $empcode) {
                $mail = UserHelper::getempcodeformail($empcode);
                $to_email = $mail[0]['email'];
                // echo '<pre>';print_r($to_email);
                $subject = 'Assign Project Task Mail';
                $message = view('admin.mail.assignUserMail')->render();
                //$notification = UserHelper::mailnotification($to_email, $subject, $message);
                mail($to_email, $subject, $message);
            }
            //exit;
        }


        //echo '<pre>';print_r($service);exit;
        if(!empty($taskUsers)){

            DB::statement("UPDATE gw_task_users SET users = '".$users."' where task = '". $request['parent_task_id']."' AND prj_id = '".$request['prj_id']."'");
        }
        else{
            $taskUsers = new TaskUser();
            $taskUsers->prj_id  =  $request['prj_id'];
            $taskUsers->project_id  =  $request['project_id'];
            $taskUsers->task  =  $request['parent_task_id'];
            $taskUsers->users  = $users;




            // $taskUsers->actual_strt_dt  =  $request['actual_strt_dt'];
            // $taskUsers->end_dt  =  $request['end_dt'];
            // $taskUsers->comment   =  $request['comment'];
            $taskUsers->save();
        }


        //assign user code save to service table



        $project_find = ProjectPlanMaster::where('project_id','=',$taskUsers[0]['project_id'])->get()->toArray();


        $i=0;

        $result=0;
       // $finalresult=0;

        $userlist=[];

        $taskusertotal=TaskUser::select('users')->where('prj_id','=',$project_find[0]['id'])->where('users','!=',null)->get()->toArray();

        //dd($taskusertotal);die;

        foreach($taskusertotal as $key=>$var){
            if($key == 0)
            {
                $result = $var['users'];
            } else {
                $result = $result.','.$var['users'];
            }



            $userlist[$i]=$var['users'];


            $i++;
        }


       //print_r($result);

        //$userlist = $taskusertotal[0]['users'] . ',' . $taskusertotal[1]['users'];
        //now fr diss assyand assy project user..if add new task then add $taskusertotal[2/3/4]['users']
        $service=Service::find($project_find[0]['service_id']);
        //$service->users = implode(',',$request['asign_user_task']);
        $service->users = $result;
        $service->save();



        return redirect('admin/project-details/'.$request['prj_id']);
    }

public function AssignUserProjectTask(Request $request){
        //$data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $taskUsers = TaskUser::where('task','=',$request['parent_task_id'])
            ->where('prj_id','=',$request['prj_id'])
            ->get()->toArray();
			$projectId = ProjectPlanMaster::find($request['prj_id']);
			$url=url('/');
        $users = implode(',',$request['asign_user_task']);
        //echo '<pre>';print_r($users);exit;
        //mail send
        //if(isset($request['notifyProjecttask'])) {
            foreach ($request['asign_user_task'] as $empcode) {
                $mail = UserHelper::getempcodeformail($empcode);
                $to_email = $mail[0]['email'];
                // echo '<pre>';print_r($to_email);
				$data=['subject'=>'Assign Project Task Mail','email'=>$to_email,'serviceno'=>$projectId->service_request_no,'workorder'=>$projectId->workorder,'url'=>$url];


                Mail::send('admin.mail.assignUserMail', $data, function($message) use ($data) {

                    $message->to($data['email'])->subject($data['subject']);
                    //dd($message);
                    $message->from(env('service_mail'),'QMS');
                    //$message->from(\Config::get('env.service_mail'),'loyalty@gainwellindia.com');
                });
				
                /*$subject = 'Assign Project Task Mail';
                $message = view('admin.mail.assignUserMail')->render();
                //$notification = UserHelper::mailnotification($to_email, $subject, $message);
                mail($to_email, $subject, $message);*/
             }
            //exit;
       // }


        //echo '<pre>';print_r($service);exit;
        if(!empty($taskUsers)){

            DB::statement("UPDATE gw_task_users SET users = '".$users."' where task = '". $request['parent_task_id']."' AND prj_id = '".$request['prj_id']."'");
        }
        else{
            $taskUsers = new TaskUser();
            $taskUsers->prj_id  =  $request['prj_id'];
            $taskUsers->project_id  =  $request['project_id'];
            $taskUsers->task  =  $request['parent_task_id'];
            $taskUsers->users  = $users;




            // $taskUsers->actual_strt_dt  =  $request['actual_strt_dt'];
            // $taskUsers->end_dt  =  $request['end_dt'];
            // $taskUsers->comment   =  $request['comment'];
            $taskUsers->save();
        }


        //assign user code save to service table



        $project_find = ProjectPlanMaster::where('project_id','=',$taskUsers[0]['project_id'])->get()->toArray();


        $i=0;

        $result=0;
       // $finalresult=0;

        $userlist=[];

        $taskusertotal=TaskUser::select('users')->where('prj_id','=',$project_find[0]['id'])->where('users','!=',null)->get()->toArray();

        //dd($taskusertotal);die;

        foreach($taskusertotal as $key=>$var){
            if($key == 0)
            {
                $result = $var['users'];
            } else {
                $result = $result.','.$var['users'];
            }



            $userlist[$i]=$var['users'];


            $i++;
        }


       //print_r($result);

        //$userlist = $taskusertotal[0]['users'] . ',' . $taskusertotal[1]['users'];
        //now fr diss assyand assy project user..if add new task then add $taskusertotal[2/3/4]['users']
        $service=Service::find($project_find[0]['service_id']);
        //$service->users = implode(',',$request['asign_user_task']);
        $service->users = $result;
        $service->save();



        return redirect('admin/project-details/'.$request['prj_id']);
    }

    


    // Edit Task
    public function editTask(Request $request){
        $taskUsers = TaskUser::where('task','=',$request['task_id'])
            ->where('prj_id','=',$request['prj_id'])
            ->get()->toArray();
        // $taskUsers->actual_strt_dt  =  $request['actual_strt_dt'];
        // $taskUsers->end_dt  =  $request['end_dt'];
        // $taskUsers->comment   =  $request['comment'];
        // $taskUsers->save();
        // echo "<pre>";print_r($request['actual_strt_dt']);exit;
        if(!empty($taskUsers)){
            DB::statement("UPDATE gw_task_users SET actual_strt_dt = '".$request['actual_strt_dt']."',end_dt = '".$request['end_dt']."' , comment = '".$request['comment']."' where task = '". $request['task_id']."' AND prj_id = '".$request['prj_id']."'");
        }
        else{
            $taskUsers = new TaskUser();
            $taskUsers->prj_id  =  $request['prj_id'];
            $taskUsers->project_id  =  $request['project_id'];
            $taskUsers->task  =  $request['task_id'];
            $taskUsers->actual_strt_dt  =  $request['actual_strt_dt'];
            $taskUsers->end_dt  =  $request['end_dt'];
            $taskUsers->comment   =  $request['comment'];
            $taskUsers->save();
        }
        return redirect('admin/project-details/'.$request['prj_id']);

    }

    // Project Note
    public function projectNote(Request $request){
        $project_user = ProjectPlanMaster::find($request['prj_id']);
        $project_user->comment = $request['project_note'];
        $project_user->save();
        return redirect('admin/project-details/'.$request['prj_id']);
    }
    
  public function projectDetails($id)
    {
        // ProjectPlanMaster;
        // ProjectTask;
        // ProjectUser;
        // TaskUser;
        // MasterDepartment;
        // MasterEmployee;
        // MasterTask
        $data = Session::all();

        //print_r($data);
        //die;

        $location=$data['user']['location_id'];
        $section_id = $data['user']['section_id'];
        $title='Project Details';
        $emp_details=[];
        $tasks=[];
        $project_plan=ProjectPlanMaster::find($id)->toArray();
        
        $project_task=ProjectTask::where('prj_id','=',$id)
            ->get()->toArray()[0];
        $project_user=ProjectUser::where('prj_id','=',$id)
            ->get()->toArray()[0];
        $task_user=TaskUser::where('prj_id','=',$id)
            ->get()->toArray();
        $service_details = Service::where('id','=',$project_plan['service_id'])
            ->get()->toArray()[0];
			
			 $service_assigned_user=0;
        $assignuser_service=$service_details['users'];
        if(!empty($assignuser_service)){
            $explode_user=explode(',',$assignuser_service);
            $service_assigned_user =count($explode_user);
        }


        if($project_plan['dept_id'] != '6') {
            $getDeptTasks = UserHelper::getDeptTask($project_plan['dept_id'], $service_details['machine_modelno']);

            $task_res = '';
            $task_tat_cal = 0;
            if (!empty($getDeptTasks)) {
                foreach ($getDeptTasks as $key => $task) {
                    $parentTask = UserHelper::checkParentTask($task['id'], $project_plan['dept_id'], $service_details['machine_modelno']);
                    // if(!empty($parentTask)){

                    // }

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
                // exit;
            }

            $number = $task_tat_cal . ' days';
            $estm_end_date = date_create($project_plan['estm_start_date']);
            date_add($estm_end_date, date_interval_create_from_date_string($number));


            $project_plan = ProjectPlanMaster::find($id);
            ///$project_plan->estm_end_date = date_format($estm_end_date, "Y-m-d");
            //$project_plan->estm_days = $task_tat_cal;
            $project_plan->save();

            $dept_employees = UserHelper::getDeptEmpBySec($location,$section_id);
            $emp_codes = explode(',', $project_user['users']);
            $dept_tasks = explode(',', $project_task['tasks']);
            if (count($emp_codes) > 0) {
                $e = 0;
                foreach ($emp_codes as $key => $emp_code) {
                    //$emp_details[$e] = MasterEmployee::where('emp_code','=',$emp_code)

                     $userdata = User::where('emp_code', '=', $emp_code)
                        ->get()->toArray();
                        if(!empty($userdata)){

                            $emp_details[$e] = $userdata[0];
                        }
                    
                   
                    $e++;


                    // $mail = UserHelper::getempcodeformail($emp_code);
                    // $to_email = $mail[0]['email'];
                    // //echo '<pre>';print_r($to_email);
                    // $subject = 'Service Create Mail';
                    // $message = view('admin.mail.assignUserMail')->render();
                    // $notification= UserHelper::mailnotification($to_email,$subject,$message);
                }
            }
            //dd($dept_tasks);
            if (count($dept_tasks) > 0) {
                $t = 0;
                foreach ($dept_tasks as $key => $task) {
                    $tasks[$t] = MasterTask::where('id', '=', $task)
                        ->get()->toArray()[0];
                    $t++;
                }
            }
        }



        //For mor department

        $result='';
        if($project_plan['dept_id']== '6') {
            $project_task1 = ProjectTask::where('prj_id', '=', $id)
                ->get()->toArray();
            //dd($project_task1);die;

        $i=0;
            $dept=[];
            $dept1=[];
            $dept3=[];
            foreach($project_task1 as $key=>$var){
                if($key == 0)
                {
                    $result = $var['tasks'];
                } else {
                    $result = $result.','.$var['tasks'];
                }
//                if($key == 0)
//                {
//                    $result1 = $var['dept_id'];
//                } else {
//                    $result1 = $result1.','.$var['dept_id'];
//                }


                $dept[$i]=$var['dept_id'];
                $dept1[$i]=$var['tasks'];
                //$finaldept =$var;

                //$dept3 = array_merge($dept1);
             $i++;
            }


        //dd($dept);

            //dd($dept);
            $task_res = '';
            $task_tat_cal = 0;
            $rim = 0;
            foreach($dept as $key=>$departmentfrmor) {
                //dd($departmentfrmor);die;
                $getDeptTasks = UserHelper::getDeptTask($departmentfrmor, $service_details['machine_modelno']);


                if (!empty($getDeptTasks)) {
                    foreach ($getDeptTasks as $key => $task) {

                        $parentTask = UserHelper::checkParentTask($task['id'], $departmentfrmor, $service_details['machine_modelno']);
                        // if(!empty($parentTask)){

                        // }
                        //dd($parentTask);
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
                    // exit;
                }

                $number = $task_tat_cal . ' days';
                $estm_end_date = date_create($project_plan['estm_start_date']);
                date_add($estm_end_date, date_interval_create_from_date_string($number));

                if($rim == 0) {
                    $project_plan = ProjectPlanMaster::find($id);
                    //$project_plan->estm_end_date = date_format($estm_end_date, "Y-m-d");
                    //$project_plan->estm_days = $task_tat_cal;
                    $project_plan->save();
                }
                $dept_employees = UserHelper::getDeptEmpBySec($location,$section_id); 
                $emp_codes = explode(',', $project_user['users']);
                //$dept_tasks = explode(',', $project_task1['tasks']);
                $dept_tasks = explode(',', $result);

                //dd($dept_tasks);
                if (count($emp_codes) > 0) {
                    $e = 0;
                    foreach ($emp_codes as $key => $emp_code) {
                        //$emp_details[$e] = MasterEmployee::where('emp_code','=',$emp_code)
                        $emp_details[$e] = User::where('emp_code', '=', $emp_code)
                            ->get()->toArray()[0];
                        $e++;
                        // $mail = UserHelper::getempcodeformail($emp_code);
                        // $to_email = $mail[0]['email'];
                        // //echo '<pre>';print_r($to_email);
                        // $subject = 'Service Create Mail';
                        // $message = view('admin.mail.assignUserMail')->render();
                        // $notification= UserHelper::mailnotification($to_email,$subject,$message);
                    }
                }


                if (count($dept_tasks) > 0) {
                    $t = 0;
                    foreach ($dept_tasks as $key => $task) {

                        $tasks[$t] = MasterTask::where('id', '=', $task)
                            ->get()->toArray()[0];
                        $t++;
                    }
                }

                $rim++;
            }
        }
//dd($dept);

        //echo'<pre>';print_r($tasks);exit;
        // $parentTask=UserHelper::checkParentTask();
        // $getDeptTasks = UserHelper::getDeptTask($obj['dept_id']);
        // echo "<pre>";print_r($project_plan);
        // echo "<pre>";print_r($project_task);
        // echo "<pre>";print_r($project_user);
        // echo "<pre>";print_r($emp_details);
//        foreach ($dept_employees as $key=>$dept_employee) {
          // echo '<pre>';
//            print_r($dept_employee['emp_code']);exit;
//
//        }
        // echo "<pre>";print_r($tasks);
        // echo "<pre>";print_r($service_details);
        //echo "<pre>";print_r($task_user);
       // echo "<pre>";print_r($tasks);
        // exit;
            if($project_plan['dept_id'] != '6') {
                return view('admin.superadmin.projectDetails')
                    ->with('project_plan', $project_plan)
                    ->with('project_task', $project_task)
                    ->with('project_user', $project_user)
                    ->with('emp_details', $emp_details)
                    ->with('dept_employees', $dept_employees)
                    ->with('tasks', $tasks)
                    //->with('dept', $dept)
                    ->with('task_user', $task_user)
                    ->with('result', $result)
					->with('service_assigned_user', $service_assigned_user)
                    ->with('service_details', $service_details);
            }else{

                return view('admin.superadmin.projectDetails')
                    ->with('project_plan', $project_plan)
                    ->with('project_task', $project_task)
                    ->with('project_user', $project_user)
                    ->with('emp_details', $emp_details)
                    ->with('dept_employees', $dept_employees)
                    ->with('tasks', $tasks)
                    ->with('dept', $dept)
                    ->with('task_user', $task_user)
                    ->with('result', $result)
					->with('service_assigned_user', $service_assigned_user)
                    ->with('service_details', $service_details);
            } 



    }

   public function getTableProjectMasterold(Request $request)
    {
        $data = Session::all();


        $location=$data['user']['location_id'];
        if($location != '3') {
            $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                ->where('service_request.location_id', '=', $location)
                ->get();
        }
        if($location == '3'){
            $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                //->where('service_request.location_id', '=', $location)
                ->get();
        }

        // echo "<pre>";print_r($table);exit();
        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/project-details')."/"."$table->id".'">Edit</a>
                                
                            </div>
                        </div>';

                return $btns;
            })
            ->addColumn('status', function ($table) {
                $btns = ' <span class="badge badge-success">'.$table->status.'</span>';

                return $btns;
            })
            ->addColumn('date_duration', function ($table) {
                $btns = date('d/m/Y',strtotime($table->estm_start_date)).' - '.date('d/m/Y',strtotime($table->estm_end_date));

                return $btns;
            })
            ->addColumn('estm_start_date', function ($table) {
                $btns = date('d/m/Y',strtotime($table->estm_start_date));

                return $btns;
            })
            ->rawColumns(['action','status','date_duration','estm_start_date']);
        return $datatables->make(true);
    }

    public function projectMasterFilterold(Request $request)
    {

        $locationId = $request['location'];

        if($locationId != '3') {
            $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                ->where('service_request.location_id', '=', $locationId)
                ->get();
        }
        if($locationId == '3'){
            $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                //->where('service_request.location_id', '=', $location)
                ->get();
        }

        // echo "<pre>";print_r($table);exit();
        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/project-details')."/"."$table->id".'">Edit</a>
                                
                            </div>
                        </div>';

                return $btns;
            })
            ->addColumn('status', function ($table) {
                $btns = ' <span class="badge badge-success">'.$table->status.'</span>';

                return $btns;
            })
            ->addColumn('date_duration', function ($table) {
                $btns = date('d/m/Y',strtotime($table->estm_start_date)).' - '.date('d/m/Y',strtotime($table->estm_end_date));

                return $btns;
            })
            ->addColumn('estm_start_date', function ($table) {
                $btns = date('d/m/Y',strtotime($table->estm_start_date));

                return $btns;
            })
            ->rawColumns(['action','status','date_duration','estm_start_date']);
        return $datatables->make(true);
    }

    public function getTableProjectMasterDownload(){

        $data = Session::all();
        $location=$data['user']['location_id'];
        $section_id=$data['user']['section_id'];

         if($location != '3') {
            $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                ->where('service_request.location_id', '=', $location)
                // ->where('gw_project_plan_master.dept_id', '=', $section_id)
                ->get();
        }
        if($location == '3'){
            $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                //->where('service_request.location_id', '=', $location)
                // ->where('gw_project_plan_master.dept_id', '=', $section_id)
                ->get();
        }

        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/ProjectsOpenList.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'SERVICE  NO' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'DESCRIPTION' => $table['description'],
                'DEPT NAME' => $table['dept_name'],
                'DATE DURATION' => date('d/m/Y',strtotime($table['estm_start_date'])).' - '.date('d/m/Y',strtotime($table['estm_end_date'])),
                'STATUS' => $table['status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);





    }

public function getTableProjectMaster(Request $request)
    {
        $data = Session::all();


        $location=$data['user']['location_id'];
        $section_id=$data['user']['section_id'];

        if($location != '3') {


            $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                ->where('service_request.location_id', '=', $location)
                 ->where('gw_project_plan_master.dept_id', '=', $section_id)
                ->get();
        }
        if($location == '3'){
            $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                //->where('service_request.location_id', '=', $location)
                 ->where('gw_project_plan_master.dept_id', '=', $section_id)
                ->get();
        }

        // echo "<pre>";print_r($table);exit();
        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/project-details')."/"."$table->id".'">Edit</a>
                                
                            </div>
                        </div>';

                return $btns;
            })
            ->addColumn('status', function ($table) {
                $btns = ' <span class="badge badge-success">'.$table->status.'</span>';

                return $btns;
            })
            ->addColumn('date_duration', function ($table) {
                $btns = date('d/m/Y',strtotime($table->estm_start_date)).' - '.date('d/m/Y',strtotime($table->estm_end_date));

                return $btns;
            })
            ->addColumn('estm_start_date', function ($table) {
                $btns = date('d/m/Y',strtotime($table->estm_start_date));

                return $btns;
            })
            ->rawColumns(['action','status','date_duration','estm_start_date']);
        return $datatables->make(true);
    }

    public function projectMasterFilter(Request $request)
    {

        $locationId = $request['location'];

        if($locationId != '3') {
            $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                ->where('service_request.location_id', '=', $locationId)
                ->get();
        }
        if($locationId == '3'){
            $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                //->where('service_request.location_id', '=', $location)
                ->get();
        }

        // echo "<pre>";print_r($table);exit();
        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/project-details')."/"."$table->id".'">Edit</a>
                                
                            </div>
                        </div>';

                return $btns;
            })
            ->addColumn('status', function ($table) {
                $btns = ' <span class="badge badge-success">'.$table->status.'</span>';

                return $btns;
            })
            ->addColumn('date_duration', function ($table) {
                $btns = date('d/m/Y',strtotime($table->estm_start_date)).' - '.date('d/m/Y',strtotime($table->estm_end_date));

                return $btns;
            })
            ->addColumn('estm_start_date', function ($table) {
                $btns = date('d/m/Y',strtotime($table->estm_start_date));

                return $btns;
            })
            ->rawColumns(['action','status','date_duration','estm_start_date']);
        return $datatables->make(true);
    }

 public function projectMasterDateFilter(Request $request)
    {
        $data = Session::all();
        //dd($data);
        $emp_id=$data['user']['emp_code'];
        $location=$data['user']['location_id'];

        $section_id=$data['user']['section_id'];


        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');
        $locationId = $request['location'];

        if(!empty($startDate) && !empty($endDate)) {
            if($location == '3') {
                if ($locationId != '3') {
                    $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                        ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                        ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                        ->where('gw_project_plan_master.estm_start_date', '>=', $startDate)
                        ->where('gw_project_plan_master.estm_start_date', '<=', $endDate)
                        ->where('gw_project_plan_master.estm_end_date', '>=', $startDate)
                        ->where('gw_project_plan_master.estm_end_date', '<=', $endDate)
                        ->where('service_request.location_id', '=', $locationId)
                        ->where('gw_project_plan_master.dept_id', '=', $section_id)
                        ->get();
                }
                if ($locationId == '3') {
                    $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                        ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                        ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                        ->where('gw_project_plan_master.estm_start_date', '>=', $startDate)
                        ->where('gw_project_plan_master.estm_start_date', '<=', $endDate)
                        ->where('gw_project_plan_master.estm_end_date', '>=', $startDate)
                        ->where('gw_project_plan_master.estm_end_date', '<=', $endDate)
                        ->where('gw_project_plan_master.dept_id', '=', $section_id)
                        //->where('service_request.location_id', '=', $location)
                        ->get();
                }
            }else{
                $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                    ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                    ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')
                    ->where('gw_project_plan_master.estm_start_date', '>=', $startDate)
                    ->where('gw_project_plan_master.estm_start_date', '<=', $endDate)
                    ->where('gw_project_plan_master.estm_end_date', '>=', $startDate)
                    ->where('gw_project_plan_master.estm_end_date', '<=', $endDate)
                    ->where('service_request.location_id', '=', $location)
                    ->where('gw_project_plan_master.dept_id', '=', $section_id)
                    ->get();
            }
        }else{
            $table = ProjectPlanMaster::select('gw_project_plan_master.*', 'service_request.work_orderno', 'gw_master_location.description')
                ->join('service_request', 'service_request.id', '=', 'gw_project_plan_master.service_id')
                ->leftjoin('gw_master_location', 'gw_master_location.id', '=', 'service_request.location_id')

                ->where('service_request.location_id', '=', $location)
                ->where('gw_project_plan_master.dept_id', '=', $section_id)
                ->get();
        }
        // echo "<pre>";print_r($table);exit();
        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/project-details')."/"."$table->id".'">Edit</a>
                                
                            </div>
                        </div>';

                return $btns;
            })
            ->addColumn('status', function ($table) {
                $btns = ' <span class="badge badge-success">'.$table->status.'</span>';

                return $btns;
            })
            ->addColumn('date_duration', function ($table) {
                $btns = date('d/m/Y',strtotime($table->estm_start_date)).' - '.date('d/m/Y',strtotime($table->estm_end_date));

                return $btns;
            })
            ->addColumn('estm_start_date', function ($table) {
                $btns = date('d/m/Y',strtotime($table->estm_start_date));

                return $btns;
            })
            ->rawColumns(['action','status','date_duration','estm_start_date']);
        return $datatables->make(true);
    }



//sync with workorder
    public function syncWithWorkorder(Request $request){

        //echo "<pre>"; print_r($request['workorder_no']);exit;

        //$serviceid=$request['workorder_no'];
        $serviceid=$request['coserial'];
        //echo '<pre>';print_r($request['coserial']);exit;

        (new FastExcel)->import('C:/Apache24/htdocs/gcpl-quality/syncservice.xlsx', function ($line) use($serviceid) {


            if($line['Service Request Id']) {
                $servicerequestid=$line['Service Request Id'];


                    if($servicerequestid==$serviceid){
                        $workorderno = $line['Work Order No'];
                    }
               if(!empty($workorderno)) {
                   (new FastExcel)->import('D:/GWApps/gcpl-qualitynew htmls/Master Sheet Work Order 2019.xlsx', function ($new) use ($workorderno, $serviceid) {
                       //echo '<pre>';print_r($workorderno);
                       //echo '<pre>';print_r($serviceid);
                       // exit;

                       if ($new['WORK ORDER NO '] == $workorderno) {


                           $servicenew = $new['WORK ORDER NO '];

                           // if (!empty($servicenew)) {
                           //$workno =Service::find($servicenew);
                           $workno = Service::where('work_orderno', '=', $servicenew);

                           //echo '<pre>';print_r($workno);exit;
                           if (isset($workno)) {
                               //update


                               $updateworkno = DB::table('service_request')->where('work_orderno', $servicenew)->update(array('customer' => $new['CUSTOMER'], 'component_serial_no' => $new['COMPONENT_MC  SERIAL NO'], 'component_name' => $new['COMPONENT'], 'comp_model_no' => $new['COMPONENT MODEL'], 'machine_modelno' => $new['MACHINE MODEL'], 'machine_serialno' => $new['MACHINE SL NO'], 'branch_name' => $new['BRANCH'], 'segment' => $new['SEGMENT'], 'work_orderno' => $servicenew, 'date' => $new['SERVICE REQUEST RECEIVE DATE'], 'service_request_no' => $serviceid));
                               //$updateworkno->save();
                           }
                           /*else {

                               //new add
                               $colu = new Service();
                               $colu->service_request_no = $serviceid;
                               $colu->customer = $new['CUSTOMER'];
                               $colu->component_serial_no = $new['COMPONENT_MC  SERIAL NO'];
                               $colu->component_name = $new['COMPONENT'];
                               $colu->comp_model_no = $new['COMPONENT MODEL'];
                               $colu->machine_modelno = $new['MACHINE MODEL'];
                               $colu->machine_serialno = $new['MACHINE SL NO'];
                               // $colu->ar_no = $new['CUSTOMER'];
                               $colu->branch_name = $new['BRANCH'];
                               $colu->segment = $new['SEGMENT'];
                               $colu->work_orderno = $servicenew;
                               //$colu->branch_location = $new['CUSTOMER'];
                               $colu->date = $new['SERVICE REQUEST RECEIVE DATE'];
                               //$colu->machine_serialno = $serviceid;

                               $colu->save();

                           }*/
                       }


                   });
               }
            }

        });
        $workordr = 'Work Order Number Generated For Service Id :'.$serviceid;

        //$worknot = 'Service Request No Is Invalid ';

        //return $this->serviceRequestList($workordr);
        return redirect('admin/service-request-list');

    }


    //sync with service request no

    public function syncWithServiceRequest(Request $request){

        //echo "<pre>"; print_r($request['workorder_no']);exit;

        //$serviceid=$request['workorder_no'];
        $serviceid=$request['serv'];

        (new FastExcel)->import('C:/Apache24/htdocs/gcpl-quality/syncservice.xlsx', function ($line) use($serviceid) {


            if($line['Service Request Id']) {
                $servicerequestid=$line['Service Request Id'];


                    //echo '<pre>';print_r($servicerequestid) ; exit;

                        if ($servicerequestid == $serviceid) {

                            $store=$servicerequestid;
                            $workorderno = $line['Work Order No'];


                            //echo '<pre>';print_r($workorderno);exit;

                            $servicerequest = Service::select('service_request.service_request_no')->get();
                            //echo '<pre>';print_r($servicerequest[0]['service_request_no']) ; exit;
                            if($servicerequest[0]['service_request_no'] != $store){
                               // $workno = $store;
                            //}
                            //echo '<pre>';print_r($workno);exit;
                           // if(isset($workno)){

                                (new FastExcel)->import('C:/Apache24/htdocs/gcpl-qualitynew htmls/Master Sheet Work Order 2019.xlsx', function ($new) use($store,$workorderno)  {

                                    if ($new['WORK ORDER NO '] == $workorderno) {

                                        //new add

                                        $colu = new Service();
                                        $colu->service_request_no = $store;
                                        $colu->customer = $new['CUSTOMER'];
                                        $colu->component_serial_no = $new['COMPONENT_MC  SERIAL NO'];
                                        $colu->component_name = $new['COMPONENT'];
                                        $colu->comp_model_no = $new['COMPONENT MODEL'];
                                        $colu->machine_modelno = $new['MACHINE MODEL'];
                                        $colu->machine_serialno = $new['MACHINE SL NO'];
                                        // $colu->ar_no = $new['CUSTOMER'];
                                        $colu->branch_name = $new['BRANCH'];
                                        $colu->segment = $new['SEGMENT'];
                                        $colu->work_orderno = $workorderno;
                                        //$colu->branch_location = $new['CUSTOMER'];
                                        $colu->date = $new['SERVICE REQUEST RECEIVE DATE'];
                                        $colu->status="Work Order Generated";
                                        //$colu->machine_serialno = $serviceid;

                                        $colu->save();
                                    }
                                });
                            }

                        }




            }

        });
        $workordr = 'Work Order Number Generated For Service Id :'.$serviceid;

        //$worknot = 'Service Request No Is Invalid ';

        return $this->serviceRequestList($workordr);
        //return redirect('admin/service-request-list');

    }

    //oldsap integation

   public function sapIntreSerreq (){



            $webservice_url = "http://qcatipl.tiplindia.com:8000/sap/bc/soap/wsdl";

            $request_param = array(
                "sap-client" => 300,
                "services" => 'Z_M_EQUIPMENT_CHECK'
            );

            $ch = curl_init($webservice_url);
            curl_setopt ($ch, CURLOPT_POST, 1);
            curl_setopt ($ch, CURLOPT_POSTFIELDS, $request_param);
            //curl_setopt ($ch, CURLOPT_TIMEOUT, 120);
            // time allowed to connect to server
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,30);
            // time allowed to process curl call
            curl_setopt($ch,CURLOPT_TIMEOUT,120);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            $verbose = fopen('php://temp', 'w+');
            curl_setopt($ch, CURLOPT_STDERR, $verbose);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, "QCARFCCONN:connect@2016");

            /* ** Alternative way to set username and password ** */
            //$headers = array(
            //    'Content-Type:application/xml',
            //    'Authorization: Basic '. base64_encode("<username>:<password>")
            //);
            //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_SSLVERSION,3);

            $data = curl_exec ($ch);

            $result = $data;

            if ($result === FALSE) {
                printf("cUrl error (#%d): %s<br>\n", curl_errno($ch),
                    htmlspecialchars(curl_error($ch)));
            }

            curl_close ($ch);
            echo "Responce : ".$data; die;

            /*
            http://qcatipl.tiplindia.com:8000/sap/bc/soap/wsdl?sap-client=300&services=Z_M_EQUIPMENT_CHECK



            User ID     : QCARFCCONN

            Password : connect@2016

            */


   }
   
   //sap
   
   public function sapresponse(Request $request){
	   
      //sync for model and serial number

         //$credentials = "QCARFCCONN:connect@2016";
         //$url = "http://qcatipl.tiplindia.com:8000/sap/bc/soap/rfc";
		 $credentials = "PC1RFCCONN:connectP@2016";
		 $url = "http://tiplcrm.tiplindia.com:8100/sap/bc/soap/rfc";
         $var1=$request['customerid'];
         
         $body = '<?xml version="1.0" encoding="utf-8"?>
                        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
   <soapenv:Header/>
   <soapenv:Body>
      <urn:Z_M_EQUIPMENT_CHECK>
         <!--You may enter the following 2 items in any order-->
         <!--Optional:-->
         <I_CUSTID>'.$var1.'</I_CUSTID>
         <T_MODEL>
            <!--Zero or more repetitions:-->
            <item>
               <!--Optional:-->
               <R3IDENT>?</R3IDENT>
               <!--Optional:-->
               <R3SER_NO>?</R3SER_NO>
               <!--Optional:-->
               <R3CATEG>?</R3CATEG>
               <!--Optional:-->
               <DESCR>?</DESCR>
            </item>
         </T_MODEL>
      </urn:Z_M_EQUIPMENT_CHECK>
   </soapenv:Body>
</soapenv:Envelope>';

         $headers = array(
             'Content-Type: text/xml; charset="utf-8"',
             'Content-Length: '.strlen($body),
             'Accept: text/xml',
             'Cache-Control: no-cache',
             'Pragma: no-cache',
             'SOAPAction: "http://www.sap.com/Z_M_EQUIPMENT_CHECK"'
         );
//$cust = array('I_CUSTID' => '0000954268');

         $ch = curl_init();
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_TIMEOUT, 60);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
         curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

         // Stuff I have added
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
         curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
         curl_setopt($ch, CURLOPT_USERPWD, $credentials);
         // curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $cust);

         $datamodel = curl_exec($ch);
//curl_close($ch);
//         dd($datamodel);die;

  //echo '<pre>'; print_r($datamodel);
  //exit;


         // xml parse



         $xml1=str_replace('<?xml version="1.0" encoding="UTF-8"?><SOAP-ENV:Envelope xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">', '', $datamodel);
         $xml2=str_replace('</SOAP-ENV:Envelope>', '', $xml1);
         $xml3=str_replace('<SOAP-ENV:Body>', '', $xml2);
         $xml4=str_replace('</SOAP-ENV:Body>', '', $xml3);
         $xml5=str_replace('<urn:Z_M_EQUIPMENT_CHECK.Response xmlns:urn="urn:sap-com:document:sap:rfc:functions">', '', $xml4);
         $xml6=str_replace('</urn:Z_M_EQUIPMENT_CHECK.Response>', '', $xml5);



         /*$data1 = "<note>
  <to>Tove</to>
  <from>Jani</from>
  <heading>Reminder</heading>
  <body>Don't forget me this weekend!</body>
  </note>";*/

         $Json1 = json_encode(simplexml_load_string($xml6, "SimpleXMLElement", LIBXML_NOCDATA));

         $array1 = json_decode($Json1,TRUE);

   //dd($array1);die;
         //echo count($array1['item']);exit;
             if($array1 != false) {
			//if(isset($array1)) {
                 foreach ($array1 as $key => $val) {


                     foreach ($val as $onemodel) {

                          if(!empty($onemodel['R3IDENT'])){

                            $modelno = MasterMCModel::where('model_no', '=', $onemodel['R3IDENT'])->get()->toArray();
                             //print_r($modelno);exit;
                             //$serialno = MasterMCSerialNumber::where('serial_no', '=', $onemodel['R3SER_NO'])->get()->toArray();

                             if (empty($modelno)) {
                                 $modl = new MasterMCModel();

                                 $modl->model_no = $onemodel['R3IDENT'];
                                 $modl->save();


                                 if (!empty($onemodel['R3SER_NO'])) {
                                     $seri = new MasterMCSerialNumber();

                                     $seri->mc_model_id = $modl->id;
                                     $seri->serial_no = $onemodel['R3SER_NO'];
                                     // $seri->model_no = $onemodel[0]['R3IDENT'];
                                     $seri->save();
                                 }


                                 //print_r($onemodel[0]['R3IDENT']);

                             } elseif (!empty($modelno)) {
                                 if(!empty($onemodel['R3SER_NO'])){
                                         $serialno1 = MasterMCSerialNumber::where('serial_no', '=', $onemodel['R3SER_NO'])->where('mc_model_id', '=', $modelno[0]['id'])->get()->toArray();
                                         //print_r($serialno1);
                                         if (empty($serialno1) && !empty(($onemodel['R3SER_NO'] ) || ($onemodel['R3SER_NO/']))) {

                                             $seri = new MasterMCSerialNumber();
            //                                 print_r($onemodel['R3IDENT']);
            //                                 print_r($onemodel['R3SER_NO']);
            //                                 print_r($modelno);
                                             $seri->mc_model_id = $modelno[0]['id'];
                                             $seri->serial_no = $onemodel['R3SER_NO'];
                                             // $seri->model_no = $onemodel[0]['R3IDENT'];
                                             $seri->save();

                                         }
                                   }
                           }
                          }
                     }
                 }
//
              // exit;
             }
         //dd($array1);die;

             
       //sync with service request and workorder
      //$credentials = "QCARFCCONN:connect@2016";
      //$url = "http://qcatipl.tiplindia.com:8000/sap/bc/soap/rfc";
	  $credentials = "PC1RFCCONN:connectP@2016";
	  $url = "http://tiplcrm.tiplindia.com:8100/sap/bc/soap/rfc";
      $var=$request['customerid'];
      $crc='CRC';
      //$url = "http://qcatipl.tiplindia.com:8000/sap/bc/soap/rfc";
      $body = '<?xml version="1.0" encoding="utf-8"?>
                        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
   <soapenv:Header/>
   <soapenv:Body>
      <urn:Z_CRC_GET_COMPLAINT>
         <!--You may enter the following 3 items in any order-->
         <!--Optional:-->
         <I_ERPID>'.$var.'</I_ERPID>
         <!--Optional:-->
         <I_ROLE>'.$crc.'</I_ROLE>
         <T_FINAL>
            <!--Zero or more repetitions:-->
            <item>
               <!--Optional:-->
               <OBJECTID>?</OBJECTID>
               <!--Optional:-->
               <DATE>?</DATE>
               <!--Optional:-->
               <STATUS>?</STATUS>
               <!--Optional:-->
               <IMPACT>?</IMPACT>
               <!--Optional:-->
               <PRIORITY>?</PRIORITY>
               <!--Optional:-->
               <WORKORDER>?</WORKORDER>
               <!--Optional:-->
               <MODEL>?</MODEL>
               <!--Optional:-->
               <SERIALNO>?</SERIALNO>
               <!--Optional:-->
               <DESCRIPTION>?</DESCRIPTION>
               <!--Optional:-->
               <DOCTYPE>?</DOCTYPE>
               <!--Optional:-->
               <CUSTOMERID>?</CUSTOMERID>
               <!--Optional:-->
               <CUSTNAME>?</CUSTNAME>
               <!--Optional:-->
               <CUSTSEG>?</CUSTSEG>
               <!--Optional:-->
               <CONTACTID>?</CONTACTID>
               <!--Optional:-->
               <CONTNAME>?</CONTNAME>
               <!--Optional:-->
               <CONTMOB>?</CONTMOB>
               <!--Optional:-->
               <PSMID>?</PSMID>
               <!--Optional:-->
               <PSMNAME>?</PSMNAME>
               <!--Optional:-->
               <CSCID>?</CSCID>
               <!--Optional:-->
               <CSCNAME>?</CSCNAME>
               <!--Optional:-->
               <PARTS>?</PARTS>
               <!--Optional:-->
               <DECISION>?</DECISION>
               <!--Optional:-->
               <NOTES>?</NOTES>
               <!--Optional:-->
               <SMU>?</SMU>
               <!--Optional:-->
               <VTYPE>?</VTYPE>
               <!--Optional:-->
               <LOCATION>?</LOCATION>
               <!--Optional:-->
               <PSMMOB>?</PSMMOB>
               <!--Optional:-->
               <CSEMOB>?</CSEMOB>
               <!--Optional:-->
               <CTYPE>?</CTYPE>
               <!--Optional:-->
               <MOTHER>?</MOTHER>
               <!--Optional:-->
               <EQLOC>?</EQLOC>
            </item>
         </T_FINAL>
      </urn:Z_CRC_GET_COMPLAINT>
   </soapenv:Body>
</soapenv:Envelope>';

        $headers = array(
'Content-Type: text/xml; charset="utf-8"',
'Content-Length: '.strlen($body),
'Accept: text/xml',
'Cache-Control: no-cache',
'Pragma: no-cache',
'SOAPAction: "http://www.sap.com/Z_M_EQUIPMENT_CHECK"'
);
//$cust = array('I_CUSTID' => '0000954268');

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

  // Stuff I have added
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
 curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 curl_setopt($ch, CURLOPT_USERPWD, $credentials);
 // curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $cust);

  $data = curl_exec($ch);
//curl_close($ch);
         //dd($data);die;

//  echo '<pre>'; print_r($data);
//  exit;


  // xml parse



         $xmltext=str_replace('<SOAP-ENV:Envelope xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">', '', $data);
         $xmltext1=str_replace('</SOAP-ENV:Envelope>', '', $xmltext);
         $xmltext2=str_replace('<SOAP-ENV:Body>', '', $xmltext1);
         $xmltext3=str_replace('</SOAP-ENV:Body>', '', $xmltext2);
         $xmltext4=str_replace('<urn:Z_M_EQUIPMENT_CHECK.Response xmlns:urn="urn:sap-com:document:sap:rfc:functions">', '', $xmltext3);
         $xmltext5=str_replace('</urn:Z_M_EQUIPMENT_CHECK.Response>', '', $xmltext4);



       /*$data1 = "<note>
<to>Tove</to>
<from>Jani</from>
<heading>Reminder</heading>
<body>Don't forget me this weekend!</body>
</note>";*/

         $Json = json_encode(simplexml_load_string($xmltext5, "SimpleXMLElement", LIBXML_NOCDATA));

         $array = json_decode($Json,TRUE);


   //dd($array);die;

   //echo '<pre>';print_r($array);exit;
         //$servicenumber=[];
//         $servicenumber=$request['servno'];
//
//         $arrayfound=[];
//
//         $arrayfound= array_search($servicenumber, array_column($array['T_FINAL'] ['item'], 'OBJECTID'));




         $data = Session::all();
         $location=$data['user']['location_id'];
         $msgwork='';
         $msgservice='';
         $msgworkordernull='';
         $servicenot='';
         $finalservice='';

         /*For button work order*/
         $serviceid=$request['coserial'];

        if($array === false){
			 $msgservice = "No Response coming from Sap.";
		 }
		  else{
        if(!empty($serviceid)) {

            $serviceIdFind = Service::where('service_request_no', '=', $serviceid)->get();
            //echo '<pre>';print_r($serviceIdFind);exit;
            if (!empty($serviceIdFind)) {

                $arrayfound=[];

                $arrayfound= array_search($serviceid, array_column($array['T_FINAL'] ['item'], 'OBJECTID'));
                //if(!empty($arrayfound)) {
                    //update service number with this workorder
                    if (!empty($array['T_FINAL'] ['item'][$arrayfound]['WORKORDER'])) {



                        //$customer = MasterCustomer::where('customer_code', '=', $request['customerid'])->get()->toarray();

                        //$model = MasterMCModel::where('model_no', '=', $array['T_FINAL'] ['item'][1]['MODEL'])->get()->toarray();

                        //$serial = MasterMCSerialNumber::where('serial_no', '=', $array['T_FINAL'] ['item'][1]['SERIALNO'])->get()->toarray();



                            $updateworkno = DB::table('service_request')->where('service_request_no', $serviceid)->update(array( 'work_orderno' => $array['T_FINAL'] ['item'][$arrayfound]['WORKORDER']));

                             $updateworknoinproj = DB::table('gw_project_plan_master')->where('service_request_no', $serviceid)->update(array( 'work_orderno' => $array['T_FINAL'] ['item'][$arrayfound]['WORKORDER']));
							 $finalservice = "WORKORDER is blank.Please Check";

                    } else {
                        // echo 'Work Order Number is null';
                        // exit;
                        //$msgworkordernull = "Customer Model no Serial no WorkOrder no Location is mandatory field Please check ";
                        if (empty($array['T_FINAL'] ['item'][$arrayfound]['WORKORDER'])) {
                            $servicenot = "WORKORDER is blank.Please Check";
                        }
//

                    }
//
            } else {
                //echo 'Service Request Number Does Not Exist In SAP';
               // exit;
                $msgwork = "Service Request Number Does Not Exist In SAP.";
            }

        }

		}
         /*For button Service request*/
         $serviceno=$request['servno'];
         //$serviceNoFind="";
		 if($array === false){
			 $msgservice = "No Response coming from Sap.";
		 }
         else{
         if(!empty($serviceno)) {


             $serviceNoFind = Service::where('service_request_no', '=', $serviceno)->get()->first();


             if (!empty($serviceNoFind)) {
                 //echo '<pre>';print_r($serviceNoFind);exit;
                 //echo 'This Service Request Number Already Exist : $serviceno';
                // exit;
                 $msgservice = "This Service Request Number Already Exist : $serviceno ";

             } else {
                 //$servicenumber=$request['servno'];

                 $arrayfound=[];

                 $arrayfound= array_search($serviceno, array_column($array['T_FINAL'] ['item'], 'OBJECTID'));


                 if ( !empty($array['T_FINAL'] ['item'][$arrayfound]['MODEL']) && !empty($array['T_FINAL'] ['item'][$arrayfound]['SERIALNO']) ){

                     $customer = MasterCustomer::where('customer_code','=',$request['customerid'])->get()->toarray();

                     $model = MasterMCModel::where('model_no','=',$array['T_FINAL'] ['item'][$arrayfound]['MODEL'])->get()->toarray();

                     $serial = MasterMCSerialNumber::where('serial_no','=',$array['T_FINAL'] ['item'][$arrayfound]['SERIALNO'])->get()->toarray();

                     if(!empty($customer) && !empty($model) && !empty($serial)) {
                     $colu = new Service();

                 $colu->service_request_no = $array['T_FINAL'] ['item'][$arrayfound]['OBJECTID'];
                 $colu->customer = $customer[0]['id'];

                 $colu->machine_modelno = $model[0]['id'];
                 $colu->machine_serialno = $serial[0]['id'];

                 if(!empty($array['T_FINAL'] ['item'][$arrayfound]['WORKORDER'])) {
                     $colu->work_orderno = $array['T_FINAL'] ['item'][$arrayfound]['WORKORDER'];
                 }
                 //$colu->branch_location = $new['CUSTOMER'];
                 if(!empty($array['T_FINAL'] ['item'][$arrayfound]['DATE'])) {
                     $colu->date = $array['T_FINAL'] ['item'][$arrayfound]['DATE'];
                 }
                  if(!empty($array['T_FINAL'] ['item'][$arrayfound]['DESCRIPTION'])) {
                      $colu->description = $array['T_FINAL'] ['item'][$arrayfound]['DESCRIPTION'];
                  }
                 //$colu->location_id = $array['T_FINAL'] ['item'][$arrayfound]['LOCATION'];

                 if (!empty( $array['T_FINAL'] ['item'][$arrayfound]['WORKORDER'])) {
                     $colu->status = "Work Order Generated";
                 } else {
                     $colu->status = "Service Request Generated";
                 }
                 //$colu->machine_serialno = $serviceid;


                         $colu->location_id = $location;//from session
//dd($colu);
                 $colu->save();
                 $finalservice="Service Request Generated";
                     }
                     else{
                         if(empty($model)) {
                             $servicenot = "MODEL  is missing in Database.Please Check";
                         }
                         elseif(empty($customer)) {
                             $servicenot = "Customer is missing in Database.Please Check";
                         }
                         elseif(empty($serial)) {
                             $servicenot = "SERIALNO is missing in Database.Please Check";
                         }
                     }
             }else{

                     if(empty($array['T_FINAL'] ['item'][$arrayfound]['MODEL'])) {
                         $servicenot = "MODEL: is blank.Please Check";
                     }
                     elseif(empty($array['T_FINAL'] ['item'][$arrayfound]['SERIALNO'])) {
                         $servicenot = "SERIALNO is blank.Please Check";
                     }
//                     elseif(empty($array['T_FINAL'] ['item'][$arrayfound]['WORKORDER'])) {
//                         $servicenot = "WORKORDER is blank.Please Check";
//                     }
//                     elseif(empty($array['T_FINAL'] ['item'][$arrayfound]['LOCATION'])) {
//                     $servicenot = "LOCATION is blank.Please Check";
//                     }

                 }
             }
         }

		 }



         //return $this->serviceRequestList($msgwork,$msgservice,$msgworkordernull,$servicenot,$finalservice);
          echo $msgservice.','.$servicenot.','.$msgworkordernull.','.$msgwork.','.$finalservice;
     }
  
  public function oldsapresponse1(Request $request){

    $credentials = "QCARFCCONN:connect@2016";
      $url = "http://qcatipl.tiplindia.com:8000/sap/bc/soap/rfc";
      $var=$request['customerid'];
      $crc='CRC';
      //$url = "http://qcatipl.tiplindia.com:8000/sap/bc/soap/rfc";
      $body = '<?xml version="1.0" encoding="utf-8"?>
                        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
   <soapenv:Header/>
   <soapenv:Body>
      <urn:Z_CRC_GET_COMPLAINT>
         <!--You may enter the following 3 items in any order-->
         <!--Optional:-->
         <I_ERPID>'.$var.'</I_ERPID>
         <!--Optional:-->
         <I_ROLE>'.$crc.'</I_ROLE>
         <T_FINAL>
            <!--Zero or more repetitions:-->
            <item>
               <!--Optional:-->
               <OBJECTID>?</OBJECTID>
               <!--Optional:-->
               <DATE>?</DATE>
               <!--Optional:-->
               <STATUS>?</STATUS>
               <!--Optional:-->
               <IMPACT>?</IMPACT>
               <!--Optional:-->
               <PRIORITY>?</PRIORITY>
               <!--Optional:-->
               <WORKORDER>?</WORKORDER>
               <!--Optional:-->
               <MODEL>?</MODEL>
               <!--Optional:-->
               <SERIALNO>?</SERIALNO>
               <!--Optional:-->
               <DESCRIPTION>?</DESCRIPTION>
               <!--Optional:-->
               <DOCTYPE>?</DOCTYPE>
               <!--Optional:-->
               <CUSTOMERID>?</CUSTOMERID>
               <!--Optional:-->
               <CUSTNAME>?</CUSTNAME>
               <!--Optional:-->
               <CUSTSEG>?</CUSTSEG>
               <!--Optional:-->
               <CONTACTID>?</CONTACTID>
               <!--Optional:-->
               <CONTNAME>?</CONTNAME>
               <!--Optional:-->
               <CONTMOB>?</CONTMOB>
               <!--Optional:-->
               <PSMID>?</PSMID>
               <!--Optional:-->
               <PSMNAME>?</PSMNAME>
               <!--Optional:-->
               <CSCID>?</CSCID>
               <!--Optional:-->
               <CSCNAME>?</CSCNAME>
               <!--Optional:-->
               <PARTS>?</PARTS>
               <!--Optional:-->
               <DECISION>?</DECISION>
               <!--Optional:-->
               <NOTES>?</NOTES>
               <!--Optional:-->
               <SMU>?</SMU>
               <!--Optional:-->
               <VTYPE>?</VTYPE>
               <!--Optional:-->
               <LOCATION>?</LOCATION>
               <!--Optional:-->
               <PSMMOB>?</PSMMOB>
               <!--Optional:-->
               <CSEMOB>?</CSEMOB>
               <!--Optional:-->
               <CTYPE>?</CTYPE>
               <!--Optional:-->
               <MOTHER>?</MOTHER>
               <!--Optional:-->
               <EQLOC>?</EQLOC>
            </item>
         </T_FINAL>
      </urn:Z_CRC_GET_COMPLAINT>
   </soapenv:Body>
</soapenv:Envelope>';

        $headers = array(
'Content-Type: text/xml; charset="utf-8"',
'Content-Length: '.strlen($body),
'Accept: text/xml',
'Cache-Control: no-cache',
'Pragma: no-cache',
'SOAPAction: "http://www.sap.com/Z_M_EQUIPMENT_CHECK"'
);
//$cust = array('I_CUSTID' => '0000954268');

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

  // Stuff I have added
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
 curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 curl_setopt($ch, CURLOPT_USERPWD, $credentials);
 // curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $cust);

  $data = curl_exec($ch);
//curl_close($ch);
         //dd($data);die;

 


  // xml parse



         $xmltext=str_replace('<SOAP-ENV:Envelope xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">', '', $data);
         $xmltext1=str_replace('</SOAP-ENV:Envelope>', '', $xmltext);
         $xmltext2=str_replace('<SOAP-ENV:Body>', '', $xmltext1);
         $xmltext3=str_replace('</SOAP-ENV:Body>', '', $xmltext2);
         $xmltext4=str_replace('<urn:Z_M_EQUIPMENT_CHECK.Response xmlns:urn="urn:sap-com:document:sap:rfc:functions">', '', $xmltext3);
         $xmltext5=str_replace('</urn:Z_M_EQUIPMENT_CHECK.Response>', '', $xmltext4);



       /*$data1 = "<note>
<to>Tove</to>
<from>Jani</from>
<heading>Reminder</heading>
<body>Don't forget me this weekend!</body>
</note>";*/

         $Json = json_encode(simplexml_load_string($xmltext5, "SimpleXMLElement", LIBXML_NOCDATA));

         $array = json_decode($Json,TRUE);




    //echo '<pre>';print_r($array);exit;
         //$servicenumber=[];
//         $servicenumber=$request['servno'];
//
//         $arrayfound=[];
//
//         $arrayfound= array_search($servicenumber, array_column($array['T_FINAL'] ['item'], 'OBJECTID'));




         $data = Session::all();
         $location=$data['user']['location_id'];
         $msgwork='';
         $msgservice='';
         $msgworkordernull='';
         $servicenot='';
         $finalservice='';

         /*For button work order*/
         $serviceid=$request['coserial'];

        if(!empty($serviceid)) {

            $serviceIdFind = Service::where('service_request_no', '=', $serviceid)->get();
            //echo '<pre>';print_r($serviceIdFind);exit;
            if (!empty($serviceIdFind)) {

                $arrayfound=[];

                $arrayfound= array_search($serviceid, array_column($array['T_FINAL'] ['item'], 'OBJECTID'));
                //if(!empty($arrayfound)) {
                    //update service number with this workorder
                    if (!empty($array['T_FINAL'] ['item'][$arrayfound]['WORKORDER'])) {

                        //$customer = MasterCustomer::where('customer_code', '=', $request['customerid'])->get()->toarray();

                        //$model = MasterMCModel::where('model_no', '=', $array['T_FINAL'] ['item'][1]['MODEL'])->get()->toarray();

                        //$serial = MasterMCSerialNumber::where('serial_no', '=', $array['T_FINAL'] ['item'][1]['SERIALNO'])->get()->toarray();



                            $updateworkno = DB::table('service_request')->where('service_request_no', $serviceid)->update(array( 'work_orderno' => $array['T_FINAL'] ['item'][$arrayfound]['WORKORDER']));
							
							


                    } else {
                        // echo 'Work Order Number is null';
                        // exit;
                        //$msgworkordernull = "Customer Model no Serial no WorkOrder no Location is mandatory field Please check ";
                        if (empty($array['T_FINAL'] ['item'][$arrayfound]['WORKORDER'])) {
                            $servicenot = "WORKORDER is blank.Please Check";
                        }
//

                    }
//
            } else {
                //echo 'Service Request Number Does Not Exist In SAP';
               // exit;
                $msgwork = "Service Request Number Does Not Exist In SAP.";
            }

        }

         /*For button Service request*/
         $serviceno=$request['servno'];
         //$serviceNoFind="";

         if(!empty($serviceno)) {


             $serviceNoFind = Service::where('service_request_no', '=', $serviceno)->get()->first();


             if (!empty($serviceNoFind)) {
                 //echo '<pre>';print_r($serviceNoFind);exit;
                 //echo 'This Service Request Number Already Exist : $serviceno';
                // exit;
                 $msgservice = "This Service Request Number Already Exist : $serviceno ";

             } else {
                 //$servicenumber=$request['servno'];

                 $arrayfound=[];

                 $arrayfound= array_search($serviceno, array_column($array['T_FINAL'] ['item'], 'OBJECTID'));


                 if ( !empty($array['T_FINAL'] ['item'][$arrayfound]['MODEL']) && !empty($array['T_FINAL'] ['item'][$arrayfound]['SERIALNO']) ){

                     $customer = MasterCustomer::where('customer_code','=',$request['customerid'])->get()->toarray();

                     $model = MasterMCModel::where('model_no','=',$array['T_FINAL'] ['item'][$arrayfound]['MODEL'])->get()->toarray();

                     $serial = MasterMCSerialNumber::where('serial_no','=',$array['T_FINAL'] ['item'][$arrayfound]['SERIALNO'])->get()->toarray();

                     if(!empty($customer) && !empty($model) && !empty($serial)) {
                     $colu = new Service();

                 $colu->service_request_no = $array['T_FINAL'] ['item'][$arrayfound]['OBJECTID'];
                 $colu->customer = $customer[0]['id'];

                 $colu->machine_modelno = $model[0]['id'];
                 $colu->machine_serialno = $serial[0]['id'];

                 if(!empty($array['T_FINAL'] ['item'][$arrayfound]['WORKORDER'])) {
                     $colu->work_orderno = $array['T_FINAL'] ['item'][$arrayfound]['WORKORDER'];
                 }
                 //$colu->branch_location = $new['CUSTOMER'];
                 if(!empty($array['T_FINAL'] ['item'][$arrayfound]['DATE'])) {
                     $colu->date = $array['T_FINAL'] ['item'][$arrayfound]['DATE'];
                 }
                  if(!empty($array['T_FINAL'] ['item'][$arrayfound]['DESCRIPTION'])) {
                      $colu->description = $array['T_FINAL'] ['item'][$arrayfound]['DESCRIPTION'];
                  }
                 //$colu->location_id = $array['T_FINAL'] ['item'][$arrayfound]['LOCATION'];

                 if (!empty( $array['T_FINAL'] ['item'][$arrayfound]['WORKORDER'])) {
                     $colu->status = "Work Order Generated";
                 } else {
                     $colu->status = "Service Request Generated";
                 }
                 //$colu->machine_serialno = $serviceid;


                         $colu->location_id = $location;//from session
//dd($colu);
                 $colu->save();
                 $finalservice="Service Request Generated";
                     }
                     else{
                         if(empty($model)) {
                             $servicenot = "MODEL  is missing in Database.Please Check";
                         }
                         elseif(empty($customer)) {
                             $servicenot = "Customer is missing in Database.Please Check";
                         }
                         elseif(empty($serial)) {
                             $servicenot = "SERIALNO is missing in Database.Please Check";
                         }
                     }
             }else{

                     if(empty($array['T_FINAL'] ['item'][$arrayfound]['MODEL'])) {
                         $servicenot = "MODEL: is blank.Please Check";
                     }
                     elseif(empty($array['T_FINAL'] ['item'][$arrayfound]['SERIALNO'])) {
                         $servicenot = "SERIALNO is blank.Please Check";
                     }
//                     elseif(empty($array['T_FINAL'] ['item'][$arrayfound]['WORKORDER'])) {
//                         $servicenot = "WORKORDER is blank.Please Check";
//                     }
//                     elseif(empty($array['T_FINAL'] ['item'][$arrayfound]['LOCATION'])) {
//                     $servicenot = "LOCATION is blank.Please Check";
//                     }

                 }
             }
         }





         //return $this->serviceRequestList($msgwork,$msgservice,$msgworkordernull,$servicenot,$finalservice);
          echo $msgservice.','.$servicenot.','.$msgworkordernull.','.$msgwork.','.$finalservice;
     }
	 
	 // code optimize customer

    public function customerDropdownFilter(Request $request)
    {

        // $machserial = UserHelper::machineserialno();
        $compse = UserHelper::codeOptimizeCustomer($request['customer']);
        //$compse = UserHelper::componentserialno();
//dd($compse);exit;
        $comser = '<option selected="selected" disabled="disabled" value="">Select Customer</option>';
        if (!isset($compse->name)) {
            foreach ($compse as $key => $value) {
                $comser .= '<option value=' . $value['customer_code'] . '>' . $value['name'].'-'. $value['customer_code'] . '</option>';
            }
        }
        echo $comser;
    }

    // code optimize machine model

    public function machinemodelDropdownFilter(Request $request)
    {

        // $machserial = UserHelper::machineserialno();
        $compse = UserHelper::codeOptimizeMachmodel($request['machmodel']);
        //$compse = UserHelper::componentserialno();
//dd($compse);exit;
        $comser = '<option selected="selected" disabled="disabled" value="">Select Equipment Model</option>';
		$comser .= '<option  value="0">Not Maintained</option>';
        if (!isset($compse->model_no)) {
            foreach ($compse as $key => $value) {
                $comser .= '<option value=' . $value['id'] . '>' . $value['model_no'] . '</option>';
            }
        }
        echo $comser;
    }

    // code optimize machine serial

    public function machineserialDropdownFilter(Request $request)
    {

        // $machserial = UserHelper::machineserialno();
        $compse = UserHelper::codeOptimizeMachserial($request['machserial']);
        //$compse = UserHelper::componentserialno();
//dd($compse);exit;
        $comser = '<option selected="selected" disabled="disabled" value="">Select Equipment Serial</option>';
		$comser .= '<option  value="0">Not Maintained</option>';
        if (!isset($compse->serial_no)) {
            foreach ($compse as $key => $value) {
                $comser .= '<option value=' . $value['id'] . '>' . $value['serial_no'] . '</option>';
            }
        }
        echo $comser;
    }

    // code optimize component model

    public function compmodelDropdownFilter(Request $request)
    {

        // $machserial = UserHelper::machineserialno();
        $compse = UserHelper::codeOptimizeCompmodel($request['compmodel']);
        //$compse = UserHelper::componentserialno();
//dd($compse);exit;
        $comser = '<option selected="selected" disabled="disabled" value="">Select Component Model</option>';
		$comser .= '<option  value="0">Not Maintained</option>';
        if (!isset($compse->comp_model_no)) {
            foreach ($compse as $key => $value) {
                $comser .= '<option value=' . $value['id'] . '>' . $value['comp_model_no'] . '</option>';
            }
        }
        echo $comser;
    }

    // code optimize component serial

    public function compserialDropdownFilter(Request $request)
    {

        // $machserial = UserHelper::machineserialno();
        $compse = UserHelper::codeOptimizeCompserial($request['compserial']);
        //$compse = UserHelper::componentserialno();
//dd($compse);exit;
        $comser = '<option selected="selected" disabled="disabled" value="">Select Component Serial</option>';
		$comser .= '<option  value="0">Not Maintained</option>';
        if (!isset($compse->comp_serial_no)) {
            foreach ($compse as $key => $value) {
                $comser .= '<option value=' . $value['id'] . '>' . $value['comp_serial_no'] . '</option>';
            }
        }
        echo $comser;
    }
   
   
   

}
