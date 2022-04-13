<?php

namespace App\Http\Controllers\admin;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
//use App\Http\Requests\CustomerRequest;
use App\Http\Requests\BisRequest;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\MasterTaskRequest;
use App\Models\AisChecksheet;
use App\Models\MasterBis;
use App\Models\MasterDesignation;
use App\Models\MasterEmployee;
use App\Models\MasterMCModel;
use App\Models\MasterTask;
use App\Models\Service;
use Illuminate\Http\Request;
use PHPUnit\Util\Color;
use Rap2hpoutre\FastExcel\FastExcel;
use Box\Spout\Writer\Style\StyleBuilder;
use App\Models\BisQuestion;
use App\Models\ChecksheetStatus;
use App\Models\MasterBisTestReport;
use App\Models\MasterBisTestReportTrans;
use App\Models\MasterComponentModelNo;
use App\Models\MasterComponentDetails;
use App\Models\MasterMCSerialNumber;
use App\Models\MasterBranch;
use App\Models\Menu;
use App\Models\Menuaccess;
use App\Models\MasterCustomer;
use App\Models\WorkFlow;
//use response;
//use App\Models\MasterEmployee;

//use App\Models\MasterMCModel;


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


use App\Http\Requests\CustomerRequest;

use App\Http\Requests\BranchRequest;
class MasterSuperAdminController extends Controller
{
    public function addcustomer()
    {
        return view('admin.master.addCustomer');

    }

    public function mastercustomerStore(CustomerRequest $request)
    {
        $obj = new MasterCustomer();
         $obj->name = $request['name'];
        $obj->customer_code = $request['customer_code'];
        $obj->address = $request['address'];
        $obj->branch = $request['branch'];
        $obj->company_code = $request['company_code'];
        $obj->contact_details = $request['contact_details'];
        $obj->cust_email = $request['cust_email'];

        $obj->save();
        return redirect('admin/master-customer');
    }

    public function customerexcel()
    {
        (new FastExcel)->import('C:\Users\User\Downloads\SAP_Integration_Data.xls', function ($line) {
            if ($line['Name1']) {
                $mcModel = MasterCustomer::where('name', '=', $line['Name1'])->get()->first();
                if (!isset($mcModel->id)) {
                    $mcModel = new MasterCustomer();
                    $mcModel->name = $line['Name 1'];
                    $mcModel->customer_code = $line['Customer ID'];
                    $mcModel->address = $line['Customer Address 1'];
                    $mcModel->address2 = $line['Customer Address 2'];
                    $mcModel->address3 = $line['Customer Address 3'];
                    $mcModel->phone_no = $line['Customer Phone No.'];
                    $mcModel->email = $line['Customer email'];
                    $mcModel->region = $line['Region'];
                    //  $mcModel->guard_name = 'web';
                    $mcModel->save();

                }
            }
        });
    }

    public function mastercustomer() 
    {
        return view('admin.master.masterCustomer');
    }

    public function fetchcustomerGetTable(Request $request)
    {
        $table = MasterCustomer::select('*')->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/editcustomer/' . $table->id) . '">Edit</a>
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function editcustomer($id)
    {

        $errors = MasterCustomer::find($id);


        return view('admin.master.editcustomer')
            ->with('errors', $errors);
    }

    public function updatecustomer(Request $request)
    {
        $obj = MasterCustomer::find($request['id']);

        $obj->name = $request['name'];
        $obj->customer_code = $request['customer_code'];
        $obj->address = $request['address'];
        $obj->branch = $request['branch'];
        $obj->company_code = $request['company_code'];
        $obj->contact_details = $request['contact_details'];
        $obj->cust_email = $request['cust_email'];
        $obj->save();
        return redirect('admin/master-customer');
    }

    public function downloadcustomer()
    {
        $table = MasterCustomer::select('*')->get();
        $style = (new StyleBuilder())
            ->setFontBold()
            //  ->setBackgroundColor(Color::YELLOW)
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/Customer download.xlsx';
        //$path = 'C:/Apache24/htdocs/gcpl-quality/template files/Customer download.xlsx';
        // $path = '/home/vhruqiyfkeq2/public_html/gcpl-quality/template files/Customer download.xlsx';
        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Name' => $table['name'],
                'Customer Code' => $table['customer_code'],
                'Customer Address' => $table['address'],
                'Contact Details' => $table['contact_details'],
                'Branch' => $table['branch'],
                'Company Code' => $table['company_code'],
                'Customer email' => $table['cust_email'],

            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }


    public function downloadtemplatecustomer()
    {


        $style = (new StyleBuilder())
            ->setFontBold()
            //  ->setBackgroundColor(Color::YELLOW)
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/Customer Template download.xlsx';


        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }


    public function uploadcustomer()
    {
        (new FastExcel)->import('C:/Apache24/htdocs/gcpl-quality/template files/SAP_Integration_Data.xls', function ($line) {
            if ($line['Name 1']) {
                $mcModel = MasterCustomer::where('name', '=', $line['Name 1'])->get()->first();
                if (!isset($mcModel->id)) {
                    $mcModel = new MasterCustomer();
                    $mcModel->name = $line['Name 1'];
                    $mcModel->customer_code = $line['Customer ID'];
                    $mcModel->address = $line['Customer Address 1'];
                    $mcModel->address2 = $line['Customer Address 2'];
                    $mcModel->address3 = $line['Customer Address 3'];
                    $mcModel->phone_no = $line['Customer Phone No.'];
                    $mcModel->email = $line['Customer email'];
                    $mcModel->region = $line['Region'];
                    $mcModel->save();
                    return redirect('admin/master-customer');

                }
            }
        });
    }

    public function uploadtemplatecustomer()
    {
        (new FastExcel)->import('D:/GWApps\gcpl-quality\template files\Customer Template download.xlsx', function ($line) {

            $mcModel = MasterCustomer::where('name', '=', $line['Name1'])->get()->first();
            if (!isset($mcModel->id)) {
                $mcModel->save();
                return redirect('admin/master-customer');


            }
        });
    }

    public function masterbranch()
    {
        return view('admin.master.masterbranch');
    }

    public function fetchbranchGetTable(Request $request)
    {
        $table = MasterBranch::select('*')->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/edit-branch/' . $table->id) . '">Edit</a>
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function editbranch($id)
    {

        $errors = MasterBranch::find($id);


        return view('admin.master.editbranch')
            ->with('errors', $errors);
    }

    public function updatebranch(Request $request)
    {
        $obj = MasterBranch::find($request['id']);

        $obj->sales_ofc = $request['sales_ofc'];
        $obj->sales_ofc_code = $request['sales_ofc_code'];
        $obj->save();
        return redirect('admin/master-branch');
    }


    public function addbranch()
    {
        $title = 'Add Branch';


        return view('admin.master.addBranch');
    }

    public function masterbranchStore(BranchRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj = new MasterBranch();
        $obj->sales_ofc = $request['sales_ofc'];
        $obj->sales_ofc_code = $request['sales_ofc_code'];
        $obj->save();
        return redirect('admin/master-branch');
    }


    public function downloadbranch()
    {
        $table = MasterBranch::select('gw_master_branch.*')->get();
        $style = (new StyleBuilder())
            ->setFontBold()
            //  ->setBackgroundColor(Color::YELLOW)
            ->build();
        //$path = '/home/vhruqiyfkeq2/public_html/gcpl-quality/template files/Branch Template download.xlsx';
       $path = 'C:/Apache24/htdocs/gcpl-quality/template files/Branch Template download.xlsx';
        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'SALES OFFICE' => $table['sales_ofc'],
                'SALES OFFICE CODE' => $table['sales_ofc_code'],

            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }

    public function downloadtemplatebranch()
    {


        $style = (new StyleBuilder())
            ->setFontBold()
            //  ->setBackgroundColor(Color::YELLOW)
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/Branch Template download.xlsx';


        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }

    public function uploadbranch()
    {
        /*  (new FastExcel)->import('C:\Users\User\Downloads\SAP_Integration_Data.xls', function ($line) {
              if ($line['Name1']) {
                  $mcModel = MasterCustomer::where('name', '=', $line['Name1'])->get()->first();
                  if (!isset($mcModel->id)) {
                      $mcModel = new MasterCustomer();
                      $mcModel->name = $line['Name1'];
                      $mcModel->customer_code = $line['Customer ID'];
                      $mcModel->address = $line['Customer Address 1'];
                      $mcModel->address2 = $line['Customer Address 2'];
                      $mcModel->address3 = $line['Customer Address 3'];
                      $mcModel->phone_no = $line['Customer Phone No.'];
                      $mcModel->email = $line['Customer email'];
                      $mcModel->region = $line['Region'];
                      //  $mcModel->guard_name = 'web';
                      $mcModel->save();*/

        (new FastExcel)->import('C:/Apache24/htdocs/gcpl-quality/template files/examplebranch.xlsx', function ($line) {
            if ($line['sales ofc']) {
                $mcModel = MasterBranch::where('sales_ofc', '=', $line['sales ofc'])->get()->first();
                if (!isset($mcModel->id)) {
                    $mcModel = new MasterBranch();
                    $mcModel->sales_ofc = $line['sales ofc'];
                    $mcModel->sales_ofc_code = $line['sales ofc code'];
                    $mcModel->save();
                }
            }
        });
    }

    public function rollmenu()
    {
        //$masterrole = Masterrole::find($id);
        //$mastermenu = Menu::select('menu');
        $items = Menu::all();
        return view('admin.superadmin.rollmenuadd', compact('items'));
        //  ->with('mastermenu', $mastermenu);
        //->with('masterrole', $masterrole);
    }

    public function rollmenusave(Request $request)
    {
        $rollmenulist = $request->all();
        //echo'<pre>';print_r($rollmenulist);exit;
        //dd($rollmenulist);exit;
        //$rollmenu=$request->all('menu');
        $obj = new Menuaccess();
        //$obj->role = json_encode($rollmenulist);
        $obj->role = $rollmenulist['role'];
        // echo '<pre>';print_r($request['rolemenu']);exit;
        $obj->rolemenu = implode(',', $request['rolemenu']);
        // echo '<pre>';print_r($obj->rolemenu);exit;
        //  $obj->rolemenu = json_encode($rollmenulist['checked']);
        $obj->save();
        return redirect('admin/check-rollmenu-listing');
    }

    public function rollmenufetching()
    {

        $title = '';
        return view('admin.superadmin.rolemenulisting')
            ->with('title', $title);

    }

    public function rollmenulistinggettable(Request $request)

    {
        $rolemenu = Menuaccess::select('menu_access.role', 'menu_access.rolemenu', 'roles.name', 'menus.menu')->leftjoin('roles',
            'roles.id', '=', 'menu_access.role')->leftjoin('menus', 'menus.id', '=', 'menu_access.rolemenu')->get();
        //  $table = Menuaccess::select('*')->get();
        $datatables = Datatables::of($rolemenu)
            ->addColumn('action', function ($rolemenu) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/editmachine/' . $rolemenu->id) . '">Edit</a>
                                   </div>
                            </div>';

                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function servicedashboardcheckgateone()
    {

        return view('admin.branchengineer.servicedashboardCheckgateOne');
    }

    public function fetchservicedashboardcheckgateone(Request $request)
    {
       /* $table = Service::select('*')->orderby('created_at','DESC')->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {

                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">';
                if ($table->checkgate1 != Null) {
                    $btns .= '<a class="dropdown-item" href="' . url('admin/check-gate-form-one-listing/' . $table->id) . '">Edit</a>';
                } else {
                    $btns .= '<a class="dropdown-item" href="' . url('admin/check-gate-form-one-add/' . $table->id) . '">Add</a>';
                }

                $btns .= '             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);*/
        $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
         if (request()->session()->get('user')['role_id'] == '2') {
            $table = Service::Select('*')
                //->WHERE('cg1_status', '=', 'Submitted')
                 ->where(function($query) {
                           $query->where('cg1_status', 'Submitted')
                        ->orWhere('cg1_status', 'Approved');
                    })
                ->where('service_request.location_id','=',$location)
                ->orderby('created_at','DESC')
                 //->WHERE('dcs_status', '=', 'Submitted')
                ->get();

            //echo '<pre>';
            // print_r($table);
            //   exit;
            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '3') {

                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-one-listing') . "/" . "$table->id" . '">Approve/Reject</a>
                                          
                                            </div>
                                        </div>';
                  
                        return $btns;
                    }

                })
                ->rawColumns(['action']);
        }
        if (request()->session()->get('user')['role_id'] == '1') {
            $table = Service::Select('*')
            ->orderby('created_at','DESC')
                ->where('cg1_status','!=','Approved')
                ->where('service_request.location_id','=',$location)
                //->orwhere('cg1_status','=','Submitted')
                ->get();

            
            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '3') {

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
                    return $btns;

                })
                ->rawColumns(['action']);
        }
        if (request()->session()->get('user')['section_id'] == '4' || request()->session()->get('user')['section_id'] == '5' || request()->session()->get('user')['section_id'] == '6' || request()->session()->get('user')['section_id'] == '7' || request()->session()->get('user')['section_id'] == '13' || request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15' || request()->session()->get('user')['section_id'] == '25' || request()->session()->get('user')['section_id'] == '26') {


                $table = Service::select('*')
                    ->where('service_request.cg1_status','=','Approved')
                    ->where('service_request.location_id','=',$location)

                    ->orderby('created_at','DESC')->get();




        //}

        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {


                if (request()->session()->get('user')['section_id'] == '4' || request()->session()->get('user')['section_id'] == '5' || request()->session()->get('user')['section_id'] == '6' || request()->session()->get('user')['section_id'] == '7' || request()->session()->get('user')['section_id'] == '13' || request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15' || request()->session()->get('user')['section_id'] == '25' || request()->session()->get('user')['section_id'] == '26') {



                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-one-listing')."/". "$table->id". '">View</a>
                                          
                                                
                                            </div>
                                        </div>';


                }

                return $btns;

            })
            ->rawColumns(['action']);
    
        }
                return $datatables->make(true);
    }


    public function fetchservicedashboardcheckgateonedatefilter(Request $request)
    {
       
        $startDate = $endDate ='';
        if($request['startdate'] !='')
        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        if($request['enddate'] !='')
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');
        $locationId = $request['location'];
        $segment = $request['segment'];
        $component = $request['component'];

        $data = Session::all();
        //echo '<pre>';print_r($data);exit;
        $location=$data['user']['location_id'];
         if (request()->session()->get('user')['role_id'] == '2') {
            $table = Service::Select('*')
                //->WHERE('cg1_status', '=', 'Submitted')
                 ->where(function($query) {
                           $query->where('cg1_status', 'Submitted')
                        ->orWhere('cg1_status', 'Approved');
                    })
                ->where('service_request.location_id','=',$location)
                //->where('service_request.checkgate1_actual_end_date', '>=', $startDate)
                //->where('service_request.checkgate1_actual_end_date', '<=', $endDate)

                // ->when($segment !='', function($query){
                //      return $query->where('service_request.segmentp', '=', 'construction');
                // })

                ->when($startDate, function ($query) use ($startDate) {
                    return $query->where('service_request.checkgate1_actual_end_date', '>=', $startDate);
                })

                ->when($endDate, function ($query) use ($endDate) {
                    return $query->where('service_request.checkgate1_actual_end_date', '<=', $endDate);
                })

                ->when($segment, function ($query) use ($segment) {
                    return $query->where('service_request.segment', $segment);
                })

                ->when($component, function ($query) use ($component) {
                    return $query->where('service_request.component_name', $component);
                })

               // ->where('service_request.segment', '=', $segment)
                ->orderby('created_at','DESC')
                 //->WHERE('dcs_status', '=', 'Submitted')
                ->get();

            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '3') {

                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-one-listing') . "/" . "$table->id" . '">Approve/Reject</a>
                                          
                                            </div>
                                        </div>';
                  
                        return $btns;
                    }

                })
                ->rawColumns(['action']);
        }
        if (request()->session()->get('user')['role_id'] == '1') {
            $table = Service::Select('*')
            ->orderby('created_at','DESC')
                ->where('cg1_status','!=','Approved')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.checkgate1_actual_end_date', '>=', $startDate)
                //->where('service_request.checkgate1_actual_end_date', '<=', $endDate)
                ->when($startDate, function ($query) use ($startDate) {
                    return $query->where('service_request.checkgate1_actual_end_date', '>=', $startDate);
                })

                ->when($endDate, function ($query) use ($endDate) {
                    return $query->where('service_request.checkgate1_actual_end_date', '<=', $endDate);
                })
                ->when($segment, function ($query) use ($segment) {
                    return $query->where('service_request.segment', $segment);
                })
                ->when($component, function ($query) use ($component) {
                    return $query->where('service_request.component_name', $component);
                })

                //->where('service_request.segment', '=', $segment)
                //->orwhere('cg1_status','=','Submitted')
                ->get();

            
            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '3') {

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
                    return $btns;

                })
                ->rawColumns(['action']);
        }
        if (request()->session()->get('user')['section_id'] == '4' || request()->session()->get('user')['section_id'] == '5' || request()->session()->get('user')['section_id'] == '6' || request()->session()->get('user')['section_id'] == '7' || request()->session()->get('user')['section_id'] == '13' || request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15') {


                $table = Service::select('*')
                    ->where('service_request.cg1_status','=','Approved')
                    ->where('service_request.location_id','=',$location)
                    ->where('service_request.checkgate1_actual_end_date', '>=', $startDate)
                    ->where('service_request.checkgate1_actual_end_date', '<=', $endDate)

                    ->orderby('created_at','DESC')->get();




        //}

        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {


                if (request()->session()->get('user')['section_id'] == '4' || request()->session()->get('user')['section_id'] == '5' || request()->session()->get('user')['section_id'] == '6' || request()->session()->get('user')['section_id'] == '7' || request()->session()->get('user')['section_id'] == '13' || request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15') {



                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-one-listing')."/". "$table->id". '">View</a>
                                          
                                                
                                            </div>
                                        </div>';


                }

                return $btns;

            })
            ->rawColumns(['action']);
    
        }
                return $datatables->make(true);
    }

    public function downloadcheckgate(Request $request)
    {
        $startDate = $endDate ='';
        if($request['startdate'] !='')
        $startDate = Carbon::createFromFormat('d/m/Y', $request['startdate'])->format('Y-m-d');
        if($request['enddate'] !='')
        $endDate =  Carbon::createFromFormat('d/m/Y', $request['enddate'])->format('Y-m-d');
        $segment = $request['segment'];
        $component = $request['component'];

        $data = Session::all();
        $location=$data['user']['location_id'];

        
        $table = Service::Select('*')
                 ->where(function($query) {
                           $query->where('cg1_status', 'Submitted')
                        ->orWhere('cg1_status', 'Approved');
                    })
                ->where('service_request.location_id','=',$location)

                ->when($startDate, function ($query) use ($startDate) {
                    return $query->where('service_request.checkgate1_actual_end_date', '>=', $startDate);
                })

                ->when($endDate, function ($query) use ($endDate) {
                    return $query->where('service_request.checkgate1_actual_end_date', '<=', $endDate);
                })

                ->when($segment, function ($query) use ($segment) {
                    return $query->where('service_request.segment', $segment);
                })

                ->when($component, function ($query) use ($component) {
                    return $query->where('service_request.component_name', $component);
                })

                ->orderby('created_at','DESC')
                ->get();



        $style = (new StyleBuilder())
            ->setFontBold()
            //  ->setBackgroundColor(Color::YELLOW)
            ->build();
        //$path = '/home/vhruqiyfkeq2/public_html/gcpl-quality/ComponentStatusFacility.xlsx';
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/CheckgetFacility.xlsx';
       // $path = "{{URL::asset('public/assets/download/ComponentStatusFacility.xlsx')}}";


        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [

                'Sr No' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'SEGMENT' => $table['segment'],
                'JOB' => $table['job_type'],
                'COMPONENT' => $table['component_name'],
                'Current Status' => $table['cg1_status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }


    public function servicedashboardcheckgatetwo()
    {

        return view('admin.branchengineer.servicedashboardCheckgateTwo');
    }

    public function fetchservicedashboardcheckgatetwoDownload(){

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['role_id'] == '2') {
            $table = Service::Select('service_request.*','checksheet_status.disassembly_status','check_gate_status.service_request_id','check_gate_status.cg2_status AS cg2Status')
                ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                ->leftjoin('check_gate_status','check_gate_status.service_request_id','service_request.id')
                ->where('checksheet_status.dept_id','=',$dept_id)
                ->where('check_gate_status.dept_id','=',$dept_id)
                ->where('service_request.location_id','=',$location)
                ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                ->where(function($query) {
                        $query->where('check_gate_status.cg2_status', 'Submitted')
                        ->orWhere('check_gate_status.cg2_status', 'Approved');
                })
                ->orderby('check_gate_status.created_at','DESC')->get();
        }else{

            $table = Service::Select('*','checksheet_status.disassembly_status','check_gate_status.cg2_status AS cg2Status')
                  ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                  ->leftjoin('check_gate_status','check_gate_status.service_request_id','service_request.id')
                ->where('service_request.location_id','=',$location)
                ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                ->where('checksheet_status.disassembly_status','=','Approved')
                ->where('check_gate_status.cg2_status','!=','Approved')
                ->where('checksheet_status.dept_id','=',$dept_id)
                ->where('check_gate_status.dept_id','=',$dept_id)
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
                ->get();
        }

        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/ServicedashboardCheckgatetwo.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'SERVICE  NO' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'SEGMENT' => $table['segment'],
                'JOB' => $table['job_type'],
                'COMPONENT' => $table['component_name'],
                'STATUS' => $table['cg2Status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }

    public function fetchservicedashboardcheckgatetwo(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];

        $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['role_id'] == '2') {
            $table = Service::Select('service_request.*','checksheet_status.disassembly_status','check_gate_status.service_request_id','check_gate_status.cg2_status AS cg2Status')
                ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                ->leftjoin('check_gate_status','check_gate_status.service_request_id','service_request.id')
                ->where('checksheet_status.dept_id','=',$dept_id)
                 ->where('check_gate_status.dept_id','=',$dept_id)
                ->where('service_request.location_id','=',$location)
              ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                       ->where(function($query) {
                           $query->where('check_gate_status.cg2_status', 'Submitted')
                        ->orWhere('check_gate_status.cg2_status', 'Approved');
                    })
                    ->orderby('check_gate_status.created_at','DESC')->get();
                // ->WHERE('status', '=', 'Submitted')
                //  ->WHERE('cg2_status', '=', 'Submitted')
                //  ->orWHERE('cg2_status', '=', 'Approved')
                // ->get();

            //echo '<pre>';
            // print_r($table);
            //   exit;
            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '4' || request()->session()->get('user')['section_id'] == '5' || request()->session()->get('user')['section_id'] == '6' || request()->session()->get('user')['section_id'] == '7' || request()->session()->get('user')['section_id'] == '13') {

                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             <a class="dropdown-item" href="' . url('admin/check-gate-form-two-listing/' . $table->service_request_id) . '">Approve/Reject</a>
                                                
                                          
                                            </div>
                                        </div>';
//                        } else {
//                            if ($table->checkgate1 != Null) {
//                                $btns = ' <div class="dropdown">
//                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
//                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//                                                <i class="fas fa-ellipsis-v"></i>
//                                            </a>
//                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
//                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-two-listing/' . $table->id) . '">Edit</a>
//
//                                            </div>
//                                        </div>';
//
//                            } else{
//                                $btns = ' <div class="dropdown">
//                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
//                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//                                                <i class="fas fa-ellipsis-v"></i>
//                                            </a>
//                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
//                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-two-add/' . $table->id) . '">Add</a>
//
//
//                                            </div>
//                                        </div>';
//                            }
//                        }
//
//                    }
                        return $btns;
                    }

                })
                ->rawColumns(['action']);
        }
        else {
            $table = Service::Select('*','checksheet_status.disassembly_status','check_gate_status.cg2_status AS cg2Status')
                  ->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                  ->leftjoin('check_gate_status','check_gate_status.service_request_id','service_request.id')
                ->where('service_request.location_id','=',$location)
               ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
               ->where('checksheet_status.disassembly_status','=','Approved')
                ->where('check_gate_status.cg2_status','!=','Approved')
                ->where('checksheet_status.dept_id','=',$dept_id)
                ->where('check_gate_status.dept_id','=',$dept_id)
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
                // ->where('dcs_status','=','Approved')
                // ->where('cg2_status','!=','Approved')
                //->orwhere('dcs_status','=','Submitted')
                ->get();

           //echo '<pre>';
            // print_r($table);
            //   exit;
            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '4' || request()->session()->get('user')['section_id'] == '5' || request()->session()->get('user')['section_id'] == '6' || request()->session()->get('user')['section_id'] == '7' || request()->session()->get('user')['section_id'] == '13') {

                        if ($table->cg2Status != 'Pending') {
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-two-listing/' . $table->service_request_id) . '">Edit</a>

                                            </div>
                                        </div>';

                        } else {
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-two-add/' . $table->service_request_id) . '">Add</a>


                                            </div>
                                        </div>';
                        }
                    }
                    return $btns;

                })
                ->rawColumns(['action']);
        }
        
         if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15') {

$dept_id1='';
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
            $table = Service::Select('service_request.*','check_gate_status.service_request_id','check_gate_status.cg2_status AS cg2Status')
                //->leftjoin('checksheet_status','checksheet_status.service_request_id','service_request.id')
                ->leftjoin('check_gate_status','check_gate_status.service_request_id','service_request.id')
                ->where('check_gate_status.cg2_status','=','Approved')
                //->where('service_request.cg2_status','=','Approved')
                ->where('service_request.location_id','=',$location)
                 ->where('check_gate_status.dept_id','=',$dept_id1)
                ->orderby('created_at','DESC')->get();






            $datatables =  Datatables::of($table)

                ->addColumn('action', function ($table) {


                    if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15') {



                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                           
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-two-listing/' . $table->service_request_id) . '">View</a>
                                          
                                                
                                            </div>
                                        </div>';


                    }

                    return $btns;

                })
                ->rawColumns(['action']);

        }
                return $datatables->make(true);
    }
    
    public function servicedashboardcheckgatethree()
    {

        return view('admin.branchengineer.servicedashboardCheckgateThree');
    }


    public function fetchservicedashboardcheckgatethreeDownload(){

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        $emp_code=$data['user']['emp_code'];

        if (request()->session()->get('user')['role_id'] == '2') {

            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
               //->where('service_request.chkonedept','=',$dept_id)
                ->where(function($query) {
                        $query->where('cg3_status', 'Submitted')
                        ->orWhere('cg3_status', 'Approved');
                })
                ->orderby('created_at','DESC')->get();
        }else{

            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                 //->where('service_request.chkonedept','=',$dept_id)
                // ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
                ->where('asc_status','=','Approved')
                ->where('cg3_status','!=','Approved')
                //->where('asc_status','=','Submitted')
                //->orwhere('cg3_status','!=','Approved')
                 ->orderby('created_at','DESC')->get();
        }
        if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15'|| request()->session()->get('user')['section_id'] == '21') {

            $table = Service::Select('*')
                ->where('service_request.location_id', '=', $location)
                ->where('cg3_status','=', 'Approved')
                //->where('service_request.chkonedept','=',$dept_id)
                /*->where(function ($query) {
                    $query->where('cg3_status', 'Submitted')
                        ->orWhere('cg3_status', 'Approved');
                })*/
                ->orderby('created_at', 'DESC')->get();

        }


        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/ServicedashboardCheckgatethree.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'SERVICE  NO' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'SEGMENT' => $table['segment'],
                'JOB' => $table['job_type'],
                'COMPONENT' => $table['component_name'],
                'STATUS' => $table['cg3_status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);

    }



    public function fetchservicedashboardcheckgatethreeDownloadDepartmental(){

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        $emp_code=$data['user']['emp_code'];

        if (request()->session()->get('user')['role_id'] == '2') {

            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
               //->where('service_request.chkonedept','=',$dept_id)
                ->where(function($query) {
                        $query->where('cg3_status', 'Submitted')
                        ->orWhere('cg3_status', 'Approved');
                })
                ->orderby('created_at','DESC')->get();
        }else{

            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                 //->where('service_request.chkonedept','=',$dept_id)
                // ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
                ->where('asc_status','=','Approved')
                ->where('cg3_status','!=','Approved')
                //->where('asc_status','=','Submitted')
                //->orwhere('cg3_status','!=','Approved')
                 ->orderby('created_at','DESC')->get();
        }
        if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15'|| request()->session()->get('user')['section_id'] == '21') {

            $table = Service::Select('*')
                ->where('service_request.location_id', '=', $location)
                ->where('cg3_status','=', 'Approved')
                //->where('service_request.chkonedept','=',$dept_id)
                /*->where(function ($query) {
                    $query->where('cg3_status', 'Submitted')
                        ->orWhere('cg3_status', 'Approved');
                })*/
                ->orderby('created_at', 'DESC')->get();

        }


        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/DepartmentalDashboard.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'SERVICE  NO' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'SEGMENT' => $table['segment'],
                'JOB' => $table['job_type'],
                'COMPONENT' => $table['component_name'],
                'STATUS' => $table['cg3_status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);

    }

    public function fetchservicedashboardcheckgatethree(Request $request)
    {

      $data = Session::all();
       $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
      $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['role_id'] == '2') {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
               //->where('service_request.chkonedept','=',$dept_id)
                       ->where(function($query) {
                           $query->where('cg3_status', 'Submitted')
                        ->orWhere('cg3_status', 'Approved');
                    })
                    ->orderby('created_at','DESC')->get();
                

            //echo '<pre>';
            // print_r($table);
            //   exit;
            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '23') {

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-three-listing') . "/" . "$table->id" . '">Approved/Reject</a>
                                          
                                            </div>
                                        </div>';

                        return $btns;
                    }

                })
                ->rawColumns(['action']);
        }
        else {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                 //->where('service_request.chkonedept','=',$dept_id)
                // ->whereRaw("FIND_IN_SET({$dept_id},chkonedept)")
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
                ->where('asc_status','=','Approved')
                ->where('cg3_status','!=','Approved')
                //->where('asc_status','=','Submitted')
                //->orwhere('cg3_status','!=','Approved')
                 ->orderby('created_at','DESC')->get();


            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '23') {

                        if ($table->checkgate3 != Null) {
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-three-listing/' . $table->id) . '">Edit</a>

                                            </div>
                                        </div>';

                        } else {
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-three-add/' . $table->id) . '">Add</a>


                                            </div>
                                        </div>';
                        }
                    }
                    return $btns;

                })
                ->rawColumns(['action']);
        }
        if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15'|| request()->session()->get('user')['section_id'] == '21') {
            $table = Service::Select('*')
                ->where('service_request.location_id', '=', $location)
                ->where('cg3_status','=', 'Approved')
                //->where('service_request.chkonedept','=',$dept_id)
                /*->where(function ($query) {
                    $query->where('cg3_status', 'Submitted')
                        ->orWhere('cg3_status', 'Approved');
                })*/
                ->orderby('created_at', 'DESC')->get();


            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15' || request()->session()->get('user')['section_id'] == '21') {

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-three-listing') . "/" . "$table->id" . '">View</a>
                                          
                                            </div>
                                        </div>';

                        return $btns;
                    }

                })
                ->rawColumns(['action']);


        }
        return $datatables->make(true);
    }
    
    public function servicedashboardcheckgatefour()
    {

        return view('admin.branchengineer.servicedashboardCheckgateFour');
    }

    public function fetchservicedashboardcheckgatefourDownload(){

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        $emp_code=$data['user']['emp_code'];

        if (request()->session()->get('user')['role_id'] == '2') {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
               //->where('service_request.chkonedept','=',$dept_id)
                ->where(function($query) {
                    $query->where('cg4_status', 'Submitted')
                        ->orWhere('cg4_status', 'Approved');
                })
                ->orderby('created_at','DESC')->get();
        }else {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
               //->where('service_request.chkonedept','=',$dept_id)
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
                ->where('bis_status','=','Approved')
                
                ->where('cg4_status','!=','Approved')
                ->get();
        }

        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/Checkgatefour.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'SERVICE  NO' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'SEGMENT' => $table['segment'],
                'JOB' => $table['job_type'],
                'COMPONENT' => $table['component_name'],
                'STATUS' => $table['cg4_status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);


    }

    public function fetchservicedashboardcheckgatefour(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['role_id'] == '2') {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
               //->where('service_request.chkonedept','=',$dept_id)
                ->where(function($query) {
                    $query->where('cg4_status', 'Submitted')
                        ->orWhere('cg4_status', 'Approved');
                })
                ->orderby('created_at','DESC')->get();
                //->where('cg4_status', '=', 'Submitted')
                

           
            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '21') {

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-four-listing') . "/" . "$table->id" . '">Approved/Reject</a>
                                          
                                            </div>
                                        </div>';

                        return $btns;
                    }

                })
                ->rawColumns(['action']);
        }
        else {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
               //->where('service_request.chkonedept','=',$dept_id)
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
				->where('bis_status','=','Approved')
                
                ->where('cg4_status','!=','Approved')
                ->get();

//            echo '<pre>';
//             print_r($table);
//               exit;
            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '21') {

                        if ($table->checkgate4 != Null) {
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-four-listing/' . $table->id) . '">Edit</a>

                                            </div>
                                        </div>';

                        } else {
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/check-gate-form-four-add/' . $table->id) . '">Add</a>


                                            </div>
                                        </div>';
                        }
                    }
                    return $btns;

                })
                ->rawColumns(['action']);
        }
        return $datatables->make(true);
    }

    public function servicedashboardpending()
    {

        return view('admin.branchengineer.servicedashboardPending');
    }

    public function fetchservicedashboardpending(Request $request)
    {
        $table = Service::Select('service_request.id', 'service_request.service_request_no', 'service_request.status')->WHERE('status', '=', 'Pending')->get();
        //echo '<pre>';
        // print_r($table);
        //   exit;
        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                               <a class="dropdown-item" href="' . url('admin/check-gate-form-two-add/' . $table->id) . '">Add</a>
                                <a class="dropdown-item" href="' . url('admin/check-gate-form-two-listing/' . $table->id) . '">Edit</a>
                                
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function servicedashboardinprogress()
    {

        return view('admin.branchengineer.servicedashboardInprogress');
    }

    public function fetchservicedashboardinprogress(Request $request)
    {
        $table = Service::Select('service_request.id', 'service_request.service_request_no', 'service_request.status')->WHERE('status', '=', 'Inprogress')->get();
        //echo '<pre>';
        // print_r($table);
        //   exit;
        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                               <a class="dropdown-item" href="' . url('admin/check-gate-form-two-add/' . $table->id) . '">Add</a>
                                <a class="dropdown-item" href="' . url('admin/check-gate-form-two-listing/' . $table->id) . '">Edit</a>
                                
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }


    public function servicedashboardsubmit()
    {

        return view('admin.branchengineer.servicedashboardSubmit');
    }

    public function fetchservicedashboardsubmit(Request $request)
    {
        $table = Service::Select('service_request.id', 'service_request.service_request_no', 'service_request.status')->WHERE('status', '=', 'Submitted')->get();
        //echo '<pre>';
        // print_r($table);
        //   exit;
        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                               <a class="dropdown-item" href="' . url('admin/check-gate-form-two-add/' . $table->id) . '">Add</a>
                                <a class="dropdown-item" href="' . url('admin/check-gate-form-two-listing/' . $table->id) . '">Edit</a>
                                
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }


    public function servicedashboardreject()
    {

        return view('admin.branchengineer.servicedashboardReject');
    }

    public function fetchservicedashboardreject(Request $request)
    {
        $table = Service::Select('service_request.id', 'service_request.service_request_no', 'service_request.status')->WHERE('status', '=', 'Rejected')->get();
        //echo '<pre>';
        // print_r($table);
        //   exit;
        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                               <a class="dropdown-item" href="' . url('admin/check-gate-form-two-add/' . $table->id) . '">Add</a>
                                <a class="dropdown-item" href="' . url('admin/check-gate-form-two-listing/' . $table->id) . '">Edit</a>
                                
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function servicerequest()
    {

        return view('admin.serviceengineer.servicerequest');
    }

    public function fetchservicerequest(Request $request)
    {
        $table = Service::select('*')->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                               <a class="dropdown-item" href="' . url('admin/listing/' . $table->id) . '">Edit</a>
                                
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function showchecksheet()
    {
        $title = '';

        return view('admin.serviceengineer.showCheckSheet')
            ->with('title', $title);
    }

    public function showchecksheetdetails(Request $request)

    {
        $table = Service::Select('service_request.id', 'service_request.service_request_no', 'service_request.status')->WHERE('status', '=', 'submitted')->get();
        //  $table = Service::Select('service_request.id', 'service_request.checkgate1', 'service_request.status')->WHERE('checkgate1', '!=', NULL)->get();
        // echo '<pre>';
        //print_r($table);
        //exit;
        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                 <a class="dropdown-item" href="' . url('admin/check-sheet-entry-common/' . $table->id) . '">Show Checksheet</a>
                                                             </div>
                                                             
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    /* public function approvedchecksheet($id)
     {
         $service = Service::where('id', '=', $id)->first();

         if ($service) {
             $service->status = true;
             return redirect()->back()->with('info', 'The application was approved successfully');
         }
     }*/
    /* public function uploadbisreport()
     {

         (new FastExcel)->import('C:\Apache24\htdocs\gcpl-quality\template files\NEW FORMAT OF BIS REPORT 2019.xlsx', function ($line) {
            if ($line['Sl #']) {
                $mcBis = MasterBis::where('sl_no', '=', $line['Sl #'])->get()->first();
                if (!isset($mcBis->id)) {
                    $mcBis = new MasterBis();
                    $mcBis->sl_no = $line['Sl #'];
                    $mcBis->job_no = $line['Job No'];
                    $mcBis->technician = $line['TECHNICIAN'];
                    $mcBis->model = $line['Model'];
                    $mcBis->component_sl_no = $line['COMPONENT SL NO.'];
                    $mcBis->customer = $line['Customer'];
                    $mcBis->test_smu = $line['Test SMU'];
                    $mcBis->engine_enter_date_time_in_the_test_bench = $line['Engine enter date & time in the test bench'];
                    $mcBis->month = $line['Month'];
                    $mcBis->problem_during_testing = $line['Problem during testing'];
                    $mcBis->root_cause_analysis = $line['Root cause Analysis'];
                    $mcBis->why = $line['Why'];
                    $mcBis->solution = $line['Solution'];
                    $mcBis->engine_out_date_time = $line['Engine out date & time'];
                    $mcBis->impact = $line['Impact'];
                    $mcBis->type_of_problem = $line['Type of Problem'];
                    $mcBis->area_of_problem = $line['Area of Problem'];
                    $mcBis->portion_of_problem = $line['Portion of Problem'];
                    $mcBis->further_action = $line['Further action'];
                    $mcBis->save();
                    return redirect('admin/master-customer');

                }
            }
         });
     }*/
    /*public function uploadworkflow()


    {
        (new FastExcel)->import('C:\Apache24\htdocs\gcpl-quality\template files\Work Flow & Access Control 2019.xlsx', function ($line) {
          if ($line['Section'])
              {
               $mcwork = WorkFlow::where('section', '=', $line['Section'])->get()->first();
               if (!isset($mcwork->id)) {
         $mcwork = new WorkFlow();
         $mcwork->section= $line['Section'];
         $mcwork->details_entry=$line['Details Entry'];
          $mcwork->job_open=$line['Job Open/Allocate'];
           $mcwork->review=$line['Review '];
           $mcwork->parts_availability= $line['parts_availability'];
           $mcwork->review_approval_supervisor_level=$line['Review & Approval - Supervisor Level'];
            $mcwork->quality_check_pdi=$line['Quality Check & PDI'];
            $mcwork->initial_approval=$line['Intial Approval- Section Incharge Level'];
            $mcwork->final_approval_crc_head=$line['Final Approval CRC Head'];
            $mcwork->job_closing=$line['Job Closing/ Invoicing '];
            $mcwork->despatch_confirmation=$line['Despatch Confirmation'];
            $mcwork->save();
      }
           }

        }*/

   public function bisAdd($id)
    {
        $title = 'Add Bis';
        $serviceid = Service::find($id);

        $servicereq=Service::select('service_request.*','gw_master_comp_details.comp_serial_no')
            ->join('gw_master_comp_details','gw_master_comp_details.id','=','service_request.component_serial_no')
            ->where('service_request.id', '=', $serviceid->id)

            ->get();


        
            $modelno=Service::Select('service_request.*','gw_master_mc_model.model_no')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','service_request.machine_modelno')
           ->where('service_request.id', '=', $id)
            ->get();
            
        $customer = Service::select('gw_master_customer.name')
            ->join('gw_master_customer','gw_master_customer.id','=','service_request.customer')
            ->where('service_request.id','=',$id)
            ->get()->toArray();    

        return view('admin.bischecksheet.bisCheckSheetAdd')
 ->with('customer',$customer)
            ->with('serviceid',$serviceid)
            ->with('servicereq',$servicereq)
            ->with('modelno',$modelno);

    }
     public function bisAddSave(Request $request)
    {
        $data = Session::all();
        $deptmt_id=$data['user']['section_id'];
        $service=Service::find($request['service_request_id']);
        
        
        


        $engineEnterDate=$request['engine_enter_date_time_in_the_test_bench'];



        foreach ($engineEnterDate as $key => $value) {
            
        
            $obj = new MasterBis();
            $obj->dept_id = $deptmt_id;
            //$obj->department_id = $request['department_id'];
            $obj->service_request_id = $request['service_request_id'];

            $obj->job_no = $request['job_no'];

            $obj->technician = $request['technician'][$key];
            $obj->model = $request['model'];
            $obj->component_sl_no = $request['component_sl_no'];
            $obj->customer = $request['customer'];
            $obj->test_smu = $request['test_smu'][$key];
    		if(!empty($request['engine_enter_date_time_in_the_test_bench'][$key])){
            $obj->engine_enter_date_time_in_the_test_bench = Carbon::createFromFormat('d/m/Y', $request['engine_enter_date_time_in_the_test_bench'][$key])->format('Y-m-d');
            }
    		$obj->month = $request['month'][$key];
            $obj->problem_during_testing = $request['problem_during_testing'][$key];
            $obj->root_cause_analysis = $request['root_cause_analysis'][$key];
            $obj->why = $request['why'][$key];
            $obj->solution = $request['solution'][$key];
            //$obj->engine_out_date_time = $request['engine_out_date_time'];
            $obj->impact = $request['impact'][$key];
            $obj->type_of_problem = $request['type_of_problem'][$key];
            $obj->area_of_problem = $request['area_of_problem'][$key];
            $obj->portion_of_problem = $request['portion_of_problem'][$key];
            $obj->further_action = $request['further_action'][$key];
            $obj->actual_start_date  = Carbon::createFromFormat('d/m/Y', $request['actual_start_date'][$key])->format('Y-m-d');
            $obj->actual_end_date  = Carbon::createFromFormat('d/m/Y', $request['actual_end_date'][$key])->format('Y-m-d');
            //$obj->actual_end_date = date("Y-m-d");

            $obj->save();




        }



        $service->bis_status = "submitted";
        $service->save();
        
		$status='BIS Submitted';
        $adminstatus= UserHelper::adminstatus($request['service_request_id'],$status);
        
        // echo '<pre>';
        // print_r($deptmt_id);
        // print_r($service->machine_modelno);
        // print_r($request['service_request_id']);
        //  print_r($obj->actual_start_date);
        //   print_r($obj->actual_end_date);
        // exit;
        
         $sec=23;
       
       $notification= UserHelper::tasktableupdatesubdptactualdate($deptmt_id,$service->machine_modelno,$request['service_request_id'],$sec,$obj->actual_start_date, $obj->actual_end_date);
        
          $sec1=29;
       
       $notification= UserHelper::tasktableupdatesubdptactualdate($deptmt_id,$service->machine_modelno,$request['service_request_id'],$sec1,$obj->actual_start_date, $obj->actual_end_date);

        //$id = $obj->id;
        return redirect('admin/bis-listing');

    }

    public function bislisting()
    {
         return view('admin.bischecksheet.bisCheckSheetListing');
    }


     public function testreport()
    {
         return view('admin.bischecksheet.testreport');
    }

    public function fetchbischecksheetDownload(){

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        $emp_code=$data['user']['emp_code'];

        if (request()->session()->get('user')['role_id'] == '2') {

            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.chkonedept','=',$dept_id)
                ->where(function($query) {
                    $query->where('bis_status', 'Submitted')
                        ->orWhere('bis_status', 'Approved');
                })
                ->orderby('created_at','DESC')->get();
        }else{

            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.chkonedept','=',$dept_id)
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
                ->where('asc_status','=','Approved')
                ->where('cg3_status','=','Approved')
                ->where('bis_status','!=','Approved')

                ->orderby('created_at','DESC')->get();
        }
        if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15'|| request()->session()->get('user')['section_id'] == '21') {

            $table = Service::Select('*')
                ->where('service_request.location_id', '=', $location)
                ->where('bis_status','=', 'Approved')
                //->where('service_request.chkonedept','=',$dept_id)
                /*->where(function ($query) {
                    $query->where('cg3_status', 'Submitted')
                        ->orWhere('cg3_status', 'Approved');
                })*/
                ->orderby('created_at', 'DESC')->get();
        }


        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/BisListing.xlsx';


        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'SERVICE  NO' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'SEGMENT' => $table['segment'],
                'JOB' => $table['job_type'],
                'COMPONENT' => $table['component_name'],
                'STATUS' => $table['bis_status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);






    }

    public function testreporttransdownlaod($id){


        $table = MasterBisTestReportTrans ::where('service_request_id','=',$id)
                ->get();
                        

         $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/TestReportTrans.xlsx';


        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'Job No' => $table['job_no'],
                'RECORD & VERIFY PRESSURE' => $table['record'],
                'DATA TYPE' => $table['datatype'],                       
                'STANDARD VALUE' => $table['standard'],
                'ACTUAL' => $table['actual'],
                'REMARKS' => $table['remarks'],                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);       



    }

    public function testreportdownlaod($id){


        $table = MasterBisTestReport ::where('service_request_id','=',$id)
                ->get();
                        

         $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/TestReportEngine.xlsx';


        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'Job No' => $table['job_no'],
                'SPEED RPM' => $table['speed_rpm'],
                'TORQUE ( ft-lbs )' => $table['torque'],                       
                'POWER (HP )' => $table['power'],
                'LOAD IN %' => $table['load_in'],
                'OIL PR. (PSI )' => $table['oil_pr'], 
                'FUEL PRESSURE(PSI)' => $table['fuel_pressure'],
                'FUEL RAIL PR. (PSI)' => $table['fuel_rail_pr'],                       
                'BOOST PR. (PSI)' => $table['boost_pr'],
                'OIL TEMP.DEG. (F)' => $table['oil_temp_deg'],
                'OUT LET WATER TEMP. DEG. (F)' => $table['out_let_water'],  
                'INLET AIR TEMP. DEG.(F)' => $table['in_let_air_temp'],
                'EXAHSUT TEMP. DEG. (F) LEFT BANK' => $table['exahsut_temp_left_bank'],                       
                'EXAHSUT TEMP. DEG. (F) RIGHT BANK' => $table['exahsut_temp_right_bank'],
                'BLOW BY RATE IN CU.FT/HR' => $table['blow_by_rate'],            
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);       



    }

    public function fetchbischecksheet(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        $emp_code=$data['user']['emp_code'];
        if (request()->session()->get('user')['role_id'] == '2') {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.chkonedept','=',$dept_id)
                ->where(function($query) {
                    $query->where('bis_status', 'Submitted')
                        ->orWhere('bis_status', 'Approved');
                })
                ->orderby('created_at','DESC')->get();


            //echo '<pre>';
            // print_r($table);
            //   exit;
            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '23') {

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/editbischecksheet') . "/" . "$table->id" . '">Approved/Reject</a>
                                          
                                            </div>
                                        </div>';

                        return $btns;
                    }

                })
                ->rawColumns(['action']);
        }
        else {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.chkonedept','=',$dept_id)
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
                ->where('asc_status','=','Approved')
                ->where('cg3_status','=','Approved')
                ->where('bis_status','!=','Approved')

                ->orderby('created_at','DESC')->get();


            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '23') {

                        if ($table->bis_status != "Pending") {
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/editbischecksheet/' . $table->id) . '">Edit</a>

                                            </div>
                                        </div>';

                        } else {
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/bis-add/' . $table->id) . '">Add</a>


                                            </div>
                                        </div>';
                        }
                    }
                    return $btns;

                })
                ->rawColumns(['action']);
        }
        if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15'|| request()->session()->get('user')['section_id'] == '21' || request()->session()->get('user')['section_id'] == '26') {
            $table = Service::Select('*')
                ->where('service_request.location_id', '=', $location)
                ->where('bis_status','=', 'Approved')
                //->where('service_request.chkonedept','=',$dept_id)
                /*->where(function ($query) {
                    $query->where('cg3_status', 'Submitted')
                        ->orWhere('cg3_status', 'Approved');
                })*/
                ->orderby('created_at', 'DESC')->get();


            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15' || request()->session()->get('user')['section_id'] == '21' || request()->session()->get('user')['section_id'] == '26') {

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/editbischecksheet') . "/" . "$table->id" . '">View</a>
                                          
                                            </div>
                                        </div>';

                        return $btns;
                    }

                })
                ->rawColumns(['action']);


        }

        return $datatables->make(true);
    }

    public function fetchtestreport(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        $emp_code=$data['user']['emp_code'];

        if (request()->session()->get('user')['role_id'] == '2') {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.chkonedept','=',$dept_id)
                ->where(function($query) {
                    $query->where('bis_status', 'Submitted')
                        ->orWhere('bis_status', 'Approved');
                })
                ->orderby('created_at','DESC')->get();


            //echo '<pre>';
            // print_r($table);
            //   exit;
            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '23') {

                        if ($table->component_name == "Transmission") {

                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/test-report-add-trans') . "/" . "$table->id" . '">Add Test Report</a>
                                          
                                            </div>
                                        </div>';


                        }elseif ($table->component_name == "Engine"){

                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/test-report-add') . "/" . "$table->id" . '">Add Test Report</a>
                                          
                                            </div>
                                        </div>';
                        }else{
                            
                            $btns = '';

                        }

                        return $btns;
                    }

                })
                ->rawColumns(['action']);
        }
        else {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.chkonedept','=',$dept_id)
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
                ->where('asc_status','=','Approved')
                ->where('cg3_status','=','Approved')
                ->where('bis_status','=','Pending')

                ->orderby('created_at','DESC')->get();


            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '23') {

                        if ($table->component_name == "Transmission") {
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/test-report-add-trans/' . $table->id) . '">Add Test Report</a>

                                            </div>
                                        </div>';

                        } elseif ($table->component_name == "Engine"){
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/test-report-add/' . $table->id) . '">Add Test Report</a>


                                            </div>
                                        </div>';
                        }else{
                            
                            $btns = '';

                        }
                    }
                    return $btns;

                })
                ->rawColumns(['action']);
        }
        if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15'|| request()->session()->get('user')['section_id'] == '21') {
            $table = Service::Select('*')
                ->where('service_request.location_id', '=', $location)
                ->where('bis_status','=', 'Approved')
                //->where('service_request.chkonedept','=',$dept_id)
                /*->where(function ($query) {
                    $query->where('cg3_status', 'Submitted')
                        ->orWhere('cg3_status', 'Approved');
                })*/
                ->orderby('created_at', 'DESC')->get();


            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15' || request()->session()->get('user')['section_id'] == '21') {

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/editbischecksheet') . "/" . "$table->id" . '">View</a>
                                          
                                            </div>
                                        </div>';

                        return $btns;
                    }

                })
                ->rawColumns(['action']);


        }

        return $datatables->make(true);
    }

    public function editbischecksheet($id)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $serviceid = Service::find($id);
        
        $servicerequest = MasterBis::where('service_request_id','=',$id)->get()->toArray(); ;


        $compsl=Service::select('service_request.*','gw_master_comp_details.comp_serial_no')
            ->join('gw_master_comp_details','gw_master_comp_details.id','=','service_request.component_serial_no')
            ->where('service_request.id', '=', $serviceid->id)

            ->get();
            
            $modelno=Service::Select('service_request.*','gw_master_mc_model.model_no')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','service_request.machine_modelno')
           ->where('service_request.id', '=', $id)
            ->get();
            
        $rootanalysis = BisQuestion::select('gw_master_bis.root_cause_analysis')->get();
        $typeofproblem = BisQuestion::select('gw_master_bis.type_of_problem')->get();
        $areaproblem = BisQuestion::select('gw_master_bis.area_of_problem')->get();
        $portionproblem = BisQuestion::select('gw_master_bis.portion_of_problem')->get();
        $checkgate=Service::find($id);
        $department=MasterBis::select('gw_master_bis_checksheet.id','gw_master_bis_checksheet.dept_id','gw_master_department.name')
            ->leftjoin('gw_master_department','gw_master_department.id', '=', 'gw_master_bis_checksheet.dept_id')
            //->where('gw_master_bis_checksheet.id', '=' ,$id)
            ->get();
            
            $customer = Service::select('gw_master_customer.name')
            ->join('gw_master_customer','gw_master_customer.id','=','service_request.customer')
            ->where('service_request.id','=',$id)
            ->get()->toArray(); 
        $rejectmsg=ChecksheetStatus::select('*')->where('service_request_id','=',$checkgate->id)
        ->where('dept_id','=',$dept_id)->get()->toArray();

        return view('admin.bischecksheet.editBisCheckSheet')
        ->with('serviceid',$serviceid)
            ->with('rootanalysis', $rootanalysis)
             ->with('customer',$customer)
            ->with('typeofproblem', $typeofproblem)
            ->with('areaproblem', $areaproblem)
            ->with('department',$department)
            ->with('compsl',$compsl)
            ->with('modelno', $modelno)
            ->with('checkgate', $checkgate)
            ->with('rejectmsg', $rejectmsg)
            ->with('portionproblem', $portionproblem)
            ->with('servicerequestdata', $servicerequest);
    }


    public function addtestreport($id)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $serviceid = Service::find($id);

        $report_res = MasterBisTestReport ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$serviceid->id)
                ->get()->toArray();


        
        $servicerequest = MasterBis::where('service_request_id','=',$id)->get();
        $compsl=Service::select('service_request.*','gw_master_comp_details.comp_serial_no')
            ->join('gw_master_comp_details','gw_master_comp_details.id','=','service_request.component_serial_no')
            ->where('service_request.id', '=', $serviceid->id)

            ->get();
            
            $modelno=Service::Select('service_request.*','gw_master_mc_model.model_no')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','service_request.machine_modelno')
           ->where('service_request.id', '=', $id)
            ->get();
            
        $rootanalysis = BisQuestion::select('gw_master_bis.root_cause_analysis')->get();
        $typeofproblem = BisQuestion::select('gw_master_bis.type_of_problem')->get();
        $areaproblem = BisQuestion::select('gw_master_bis.area_of_problem')->get();
        $portionproblem = BisQuestion::select('gw_master_bis.portion_of_problem')->get();
        $checkgate=Service::find($id);
        $department=MasterBis::select('gw_master_bis_checksheet.id','gw_master_bis_checksheet.dept_id','gw_master_department.name')
            ->leftjoin('gw_master_department','gw_master_department.id', '=', 'gw_master_bis_checksheet.dept_id')
            //->where('gw_master_bis_checksheet.id', '=' ,$id)
            ->get();
            
            $customer = Service::select('gw_master_customer.customer_code','gw_master_customer.name')
            ->join('gw_master_customer','gw_master_customer.id','=','service_request.customer')
            ->where('service_request.id','=',$id)
            ->get()->toArray(); 
        $rejectmsg=ChecksheetStatus::select('*')->where('service_request_id','=',$checkgate->id)
        ->where('dept_id','=',$dept_id)->get()->toArray();

        return view('admin.bischecksheet.addtestreport')
        ->with('serviceid',$serviceid)
            ->with('rootanalysis', $rootanalysis)
             ->with('customer',$customer)
            ->with('typeofproblem', $typeofproblem)
            ->with('areaproblem', $areaproblem)
            ->with('department',$department)
            ->with('compsl',$compsl)
            ->with('modelno', $modelno)
            ->with('checkgate', $checkgate)
            ->with('rejectmsg', $rejectmsg)
            ->with('portionproblem', $portionproblem)
            ->with('reportdata',$report_res)
            ->with('servicerequest', $servicerequest);
    }


    public function addtestreporttrans($id)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        
        $serviceid = Service::find($id);

        $report_res = MasterBisTestReportTrans ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$serviceid->id)
                ->get()->toArray();


        
        $servicerequest = MasterBis::where('service_request_id','=',$id)->get();
        $compsl=Service::select('service_request.*','gw_master_comp_details.comp_serial_no')
            ->join('gw_master_comp_details','gw_master_comp_details.id','=','service_request.component_serial_no')
            ->where('service_request.id', '=', $serviceid->id)

            ->get();
            
            $modelno=Service::Select('service_request.*','gw_master_mc_model.model_no')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','service_request.machine_modelno')
           ->where('service_request.id', '=', $id)
            ->get();
            
        $rootanalysis = BisQuestion::select('gw_master_bis.root_cause_analysis')->get();
        $typeofproblem = BisQuestion::select('gw_master_bis.type_of_problem')->get();
        $areaproblem = BisQuestion::select('gw_master_bis.area_of_problem')->get();
        $portionproblem = BisQuestion::select('gw_master_bis.portion_of_problem')->get();
        $checkgate=Service::find($id);
        $department=MasterBis::select('gw_master_bis_checksheet.id','gw_master_bis_checksheet.dept_id','gw_master_department.name')
            ->leftjoin('gw_master_department','gw_master_department.id', '=', 'gw_master_bis_checksheet.dept_id')
            //->where('gw_master_bis_checksheet.id', '=' ,$id)
            ->get();
            
            $customer = Service::select('gw_master_customer.customer_code','gw_master_customer.name')
            ->join('gw_master_customer','gw_master_customer.id','=','service_request.customer')
            ->where('service_request.id','=',$id)
            ->get()->toArray(); 
        $rejectmsg=ChecksheetStatus::select('*')->where('service_request_id','=',$checkgate->id)
        ->where('dept_id','=',$dept_id)->get()->toArray();

        return view('admin.bischecksheet.addtestreporttrans')
        ->with('serviceid',$serviceid)
            ->with('rootanalysis', $rootanalysis)
             ->with('customer',$customer)
            ->with('typeofproblem', $typeofproblem)
            ->with('areaproblem', $areaproblem)
            ->with('department',$department)
            ->with('compsl',$compsl)
            ->with('modelno', $modelno)
            ->with('checkgate', $checkgate)
            ->with('rejectmsg', $rejectmsg)
            ->with('portionproblem', $portionproblem)
            ->with('reportdata',$report_res)
            ->with('servicerequest', $servicerequest);
    }




    public function bistestreportsave(Request $request){

        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($service)){
            $dept_id=$data['user']['section_id'];

            $report_res = MasterBisTestReport ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->get()->toArray();

            if(count($report_res)<=0){
                $report = new MasterBisTestReport();
            }
            else{
                $report = MasterBisTestReport::find($report_res[0]['id']);
            }
        }
        


        $speed=$request['speed'];



        if(isset($service->id)) {
            MasterBisTestReport::where('service_request_id','=',$request['service_id'])->where('dept_id','=',$dept_id)->delete();
            foreach ($speed as $key => $val) {
                

                $report = new MasterBisTestReport();
                $report->service_request_id = $service->id;
                $report->dept_id = $dept_id;
                $report->job_no = isset($request['job_no']) ? $request['job_no']:null;
                $report->customer_code = isset($request['customer_code']) ? $request['customer_code']:null;
                $report->customer_name = isset($request['customer_name']) ? $request['customer_name']:null;
                $report->engine_model = isset($request['engine_model']) ? $request['engine_model']:null;
                $report->engine_serial_no = isset($request['engine_serial_no']) ? $request['engine_serial_no']:null;

                $report->machine_model =isset($request['machine_model']) ? $request['machine_model']:null;
                $report->machine_serial_no = isset($request['machine_serial_no']) ? $request['machine_serial_no']:null;
                $report->speed_rpm = $request['speed'][$key];
                $report->torque = $request['torque'][$key];
                $report->power = $request['power'][$key];
                $report->load_in = $request['loadin'][$key];
                $report->oil_pr = $request['oilpr'][$key];


                $report->fuel_pressure = $request['fuelpresure'][$key];
                $report->fuel_rail_pr = $request['fuelrail'][$key];
                $report->boost_pr = $request['boost'][$key];
                $report->oil_temp_deg = $request['oiltemp'][$key];
                $report->out_let_water = $request['outletwater'][$key];
                $report->in_let_air_temp = $request['inletairtemp'][$key];
                $report->exahsut_temp_left_bank = $request['exahsuttempleft'][$key];


                $report->exahsut_temp_right_bank = $request['exahsuttempright'][$key];
                $report->blow_by_rate = $request['blowbyrate'][$key];

                $report->remarks = isset($request['remarks']) ? $request['remarks']:null;
                $report->signature_test_engineer = isset($request['signature']) ? $request['signature']:null;
                $report->authorized_signature = isset($request['authorize_signature']) ? $request['authorize_signature']:null;
                

                $report->save();

            }


            $service->doc_no = isset($request['docNo']) ? $request['docNo']:null;
            $service->issued_on = isset($request['issuedOn']) ? $request['issuedOn']:null;
            $service->save();
        }
        
       
        
       if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/test-report-add/'.$request['service_id']);
        }else{

            return redirect('admin/test-report-add/'.$request['service_id']);
        }

    }


    public function bistestreportsavetrans(Request $request){

        $data = Session::all();
        $service = Service::find($request['service_id']);

        if(isset($service)){
            $dept_id=$data['user']['section_id'];

            $report_res = MasterBisTestReportTrans ::where('dept_id','=',$dept_id)
                ->where('service_request_id','=',$request['service_id'])
                ->get()->toArray();

            if(count($report_res)<=0){
                $report = new MasterBisTestReportTrans();
            }
            else{
                $report = MasterBisTestReportTrans::find($report_res[0]['id']);
            }
        }
        


        $recore=$request['recore'];



        if(isset($service->id)) {
            MasterBisTestReportTrans::where('service_request_id','=',$request['service_id'])->where('dept_id','=',$dept_id)->delete();
            foreach ($recore as $key => $val) {
                

                $report = new MasterBisTestReportTrans();
                $report->service_request_id = $service->id;
                $report->dept_id = $dept_id;
                $report->job_no = isset($request['job_no']) ? $request['job_no']:null;
                $report->customer_code = isset($request['customer_code']) ? $request['customer_code']:null;
                $report->customer_name = isset($request['customer_name']) ? $request['customer_name']:null;
                $report->engine_model = isset($request['engine_model']) ? $request['engine_model']:null;
                $report->engine_serial_no = isset($request['engine_serial_no']) ? $request['engine_serial_no']:null;

                $report->machine_model =isset($request['machine_model']) ? $request['machine_model']:null;
                $report->machine_serial_no = isset($request['machine_serial_no']) ? $request['machine_serial_no']:null;
                $report->record = $request['recore'][$key];
                $report->datatype = $request['datatype'][$key];
                $report->standard = $request['standard'][$key];
                $report->actual = $request['actual'][$key];
                $report->remarks = $request['remarks'][$key];


                $report->signature_test_engineer = isset($request['signature']) ? $request['signature']:null;
                $report->authorized_signature = isset($request['authorize_signature']) ? $request['authorize_signature']:null;

                 $report->start_date = Carbon::createFromFormat('Y-m-d', $request['start_date'])->format('Y-m-d');
                $report->end_date = Carbon::createFromFormat('Y-m-d', $request['end_date'])->format('Y-m-d');

                

                $report->save();

            }

            $service->doc_no = isset($request['docNo']) ? $request['docNo']:null;
            $service->issued_on = isset($request['issuedOn']) ? $request['issuedOn']:null;
            $service->save();

        }
        
       
        
       if (request()->session()->get('user')['section_id'] == '4' ||request()->session()->get('user')['section_id'] == '5'||request()->session()->get('user')['section_id'] == '6' ||request()->session()->get('user')['section_id'] == '7'||request()->session()->get('user')['section_id'] == '13'){

            return redirect('admin/test-report-add-trans/'.$request['service_id']);
        }else{

            return redirect('admin/test-report-add-trans/'.$request['service_id']);
        }

    }




    
    public function editbissave(Request $request)
    {
        $data = Session::all();
        $dept_id=$data['user']['section_id'];
          
        $engineEnterDate=$request['engine_enter_date_time_in_the_test_bench'];

        foreach ($engineEnterDate as $key => $value) { 
            $obj = MasterBis::find($request['id'][$key]);
            $obj['technician']=$request['technician'][$key];
            $obj->test_smu = $request['test_smu'][$key];
            //$obj->engine_enter_date_time_in_the_test_bench = $request['engine_enter_date_time_in_the_test_bench'];
            $obj->month = $request['month'][$key];
            $obj->problem_during_testing = $request['problem_during_testing'][$key];
            $obj->root_cause_analysis = $request['root_cause_analysis'][$key];
            $obj->why = $request['why'][$key];
            $obj->solution = $request['solution'][$key];
            //$obj->engine_out_date_time = $request['engine_out_date_time'];
            $obj->impact = $request['impact'][$key];
            $obj->type_of_problem = $request['type_of_problem'][$key];
            $obj->area_of_problem = $request['area_of_problem'][$key];
            $obj->portion_of_problem = $request['portion_of_problem'][$key];
            $obj->further_action = $request['further_action'][$key];
    		$obj->actual_end_date  = Carbon::createFromFormat('d/m/Y', $request['actual_end_date'][$key])->format('Y-m-d');
            //$obj->actual_end_date = date("Y-m-d");

            $obj->save();
        }
        
         
        
        $service=Service::find($request['service_request_id']);
        $service->bis_status = "submitted";
        $service->save();
		
		$status='BIS Submitted';
        $adminstatus= UserHelper::adminstatus($request['service_request_id'],$status);
        
        $sec=23;
        $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$service->machine_modelno,$request['service_request_id'],$sec,$obj->actual_start_date, $obj->actual_end_date);


    $sec1=29;
       
       $notification= UserHelper::tasktableupdatesubdptactualdate($dept_id,$service->machine_modelno,$request['service_request_id'],$sec1,$obj->actual_start_date, $obj->actual_end_date);
        return redirect('admin/bis-listing');
    }


   
   //excel
    public function bisexcelDownload(Request $request)
    {
        $service = Service::find($request['service_id']);

        $data = Session::all();
        $dept_id=$data['user']['section_id'];

        $servicerequest = MasterBis::where('service_request_id','=',$request['service_id'])
            ->where('dept_id','=',$dept_id)
            ->get();

//dd($servicerequest);
        $style = (new StyleBuilder())
            ->setFontBold()

            ->build();
        //$path='/home/vhruqiyfkeq2/public_html/gcpl-quality/';
        $path='C:/Apache24/htdocs/gcpl-quality/';





        //use($fstval) for two parameter pass

        (new FastExcel($servicerequest))->headerStyle($style)->export($path.'bistest.xlsx', function ($servicerequest)  {

            return [


                'Technician' =>  $servicerequest['technician'] ,
                'Test Smu' =>  $servicerequest['test_smu'] ,
                'Engine Enter Date Time In The Test Bench' => Carbon::parse($servicerequest['engine_enter_date_time_in_the_test_bench'])->format('d/m/Y'),
                'Month' => $servicerequest['month'],
                'Problem During Testing' => $servicerequest['problem_during_testing'],
                'Root Cause Analysis' => $servicerequest['root_cause_analysis'],
                'Why' => $servicerequest['why'],
                'Solution' => $servicerequest['solution'],
                //'Date' => $servicerequest['engine_out_date_time'],
                'Impact' => $servicerequest['impact'],
                'Type of Problem' => $servicerequest['type_of_problem'],
                'Area Of Problem' => $servicerequest['area_of_problem'],
                'Portion of Problem' => $servicerequest['portion_of_problem'],
                'Further Action' => $servicerequest['further_action'],

            ];


        });



        $file=$path.'bistest.xlsx';
        $name = basename($file);
        return response()->download($file, $name);


    }
	
    //pdi checksheet

    public function servicedashboardPdiList()
    {

        return view('admin.pdichecksheet.pdiList');
    }

    public function servicePdiList()
    {

        return view('admin.pdichecksheet.dispatchpdiList');
    }



    public function fetchpdiGatetableDownload(){

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        $emp_code=$data['user']['emp_code'];

        if (request()->session()->get('user')['role_id'] == '2') {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.chkonedept','=',$dept_id)
                ->where(function($query) {
                    $query->where('pdi_status', 'Submitted')
                        ->orWhere('pdi_status', 'Approved');
                })
                ->orderby('created_at','DESC')->get();
        }

        if (request()->session()->get('user')['role_id'] == '1') {

            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.chkonedept','=',$dept_id)
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
                ->where('cg4_status','=','Approved')
                ->where('pdi_status','!=','Approved')
                //->where('asc_status','=','Submitted')
                //->orwhere('cg3_status','!=','Approved')
                ->orderby('created_at','DESC')->get();
        }

        if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15'|| request()->session()->get('user')['section_id'] == '21') {


            $table = Service::Select('*')
                ->where('service_request.location_id', '=', $location)
                ->where('pdi_status','=', 'Approved')
                //->where('service_request.chkonedept','=',$dept_id)
                /*->where(function ($query) {
                    $query->where('cg3_status', 'Submitted')
                        ->orWhere('cg3_status', 'Approved');
                })*/
                ->orderby('created_at', 'DESC')->get();
        }


        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/ServicedashboardPdilist.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'SERVICE  NO' => $table['service_request_no'],
                'WORK ORDER NO' => $table['work_orderno'],                       
                'SEGMENT' => $table['segment'],
                'JOB' => $table['job_type'],
                'COMPONENT' => $table['component_name'],
                'STATUS' => $table['pdi_status'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);


    }

    public function fetchpdiGatetable(Request $request)
    {

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        $emp_code=$data['user']['emp_code'];
        //echo '<pre>';print_r($data);exit;

        if (request()->session()->get('user')['role_id'] == '2') {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.chkonedept','=',$dept_id)
                ->where(function($query) {
                    $query->where('pdi_status', 'Submitted')
                        ->orWhere('pdi_status', 'Approved');
                })
                ->orderby('created_at','DESC')->get();


           
            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '22') {

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/pdi-listing/' . $table->id) . '">Approved/Reject</a>
                                          
                                            </div>
                                        </div>';

                        return $btns;
                    }

                })
                ->rawColumns(['action']);
        }
         if (request()->session()->get('user')['role_id'] == '1') {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.chkonedept','=',$dept_id)
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
                ->where('cg4_status','=','Approved')
                ->where('pdi_status','!=','Approved')
                //->where('asc_status','=','Submitted')
                //->orwhere('cg3_status','!=','Approved')
                ->orderby('created_at','DESC')->get();


            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '22') {

                        if ($table->pdi_checksheet != Null) {
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/pdi-listing/' . $table->id) . '">Edit</a>

                                            </div>
                                        </div>';

                        } else {
                            $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/pdi-add/' . $table->id) . '">Add</a>


                                            </div>
                                        </div>';
                        }
                    }
                    return $btns;

                })
                ->rawColumns(['action']);
        }
        if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15'|| request()->session()->get('user')['section_id'] == '21') {
            $table = Service::Select('*')
                ->where('service_request.location_id', '=', $location)
                ->where('pdi_status','=', 'Approved')
                //->where('service_request.chkonedept','=',$dept_id)
                /*->where(function ($query) {
                    $query->where('cg3_status', 'Submitted')
                        ->orWhere('cg3_status', 'Approved');
                })*/
                ->orderby('created_at', 'DESC')->get();


            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15' || request()->session()->get('user')['section_id'] == '21') {

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/pdi-listing') . "/" . "$table->id" . '">View</a>
                                          
                                            </div>
                                        </div>';

                        return $btns;
                    }

                })
                ->rawColumns(['action']);


        }
        return $datatables->make(true);
    }


    public function fetchpdiGatetabledispatch(Request $request)
    {

        $data = Session::all();
        $dept_id=$data['user']['section_id'];
        $location=$data['user']['location_id'];
        $emp_code=$data['user']['emp_code'];
        //echo '<pre>';print_r($data);exit;

        if (request()->session()->get('user')['role_id'] == '2') {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.chkonedept','=',$dept_id)
                ->where(function($query) {
                    $query->where('pdi_status', 'Submitted')
                        ->orWhere('pdi_status', 'Approved');
                })
                ->orderby('created_at','DESC')->get();


           
            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '22') {

                        if($table->component_name == 'Engine'){

                            if ($table->pdi_checksheet_engine != Null) {
                                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/dispatch-pdi-listing/' . $table->id) . '">Edit</a>

                                            </div>
                                        </div>';

                                } else {
                                    $btns = ' <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="' . url('admin/dispatch-pdi-add/' . $table->id) . '">Add</a>


                                                    </div>
                                                </div>';
                                }
                        
                        }else{

                            $btns = '';
                        }

                        return $btns;
                    }

                })
                ->rawColumns(['action']);
        }
         if (request()->session()->get('user')['role_id'] == '1') {
            $table = Service::Select('*')
                ->where('service_request.location_id','=',$location)
                //->where('service_request.chkonedept','=',$dept_id)
                ->whereRaw("FIND_IN_SET({$emp_code},users)")
                ->where('cg4_status','=','Approved')
                ->where('pdi_status','!=','Approved')
                //->where('asc_status','=','Submitted')
                //->orwhere('cg3_status','!=','Approved')
                ->orderby('created_at','DESC')->get();


            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '22') {

                        if($table->component_name == 'Engine'){

                            if ($table->pdi_checksheet_engine != Null) {
                                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/dispatch-pdi-listing/' . $table->id) . '">Edit</a>

                                            </div>
                                        </div>';

                                } else {
                                    $btns = ' <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="' . url('admin/dispatch-pdi-add/' . $table->id) . '">Add</a>


                                                    </div>
                                                </div>';
                                }
                        
                        }elseif($table->component_name == 'Transmission'){

                            if ($table->pdi_checksheet_transmission != Null) {
                                $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="' . url('admin/transmission-pdi-listing/' . $table->id) . '">Edit</a>

                                            </div>
                                        </div>';

                                } else {
                                    $btns = ' <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="' . url('admin/transmission-pdi-add/' . $table->id) . '">Add</a>


                                                    </div>
                                                </div>';
                                }
                        
                        }else{

                            $btns = '';
                        }

                        //return $btns;


                    }
                    return $btns;

                })
                ->rawColumns(['action']);
        }
        if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15'|| request()->session()->get('user')['section_id'] == '21') {
            $table = Service::Select('*')
                ->where('service_request.location_id', '=', $location)
                ->where('pdi_status','=', 'Approved')
                //->where('service_request.chkonedept','=',$dept_id)
                /*->where(function ($query) {
                    $query->where('cg3_status', 'Submitted')
                        ->orWhere('cg3_status', 'Approved');
                })*/
                ->orderby('created_at', 'DESC')->get();


            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    if (request()->session()->get('user')['section_id'] == '10' || request()->session()->get('user')['section_id'] == '11' || request()->session()->get('user')['section_id'] == '12' || request()->session()->get('user')['section_id'] == '14' || request()->session()->get('user')['section_id'] == '15' || request()->session()->get('user')['section_id'] == '21') {

                        $btns = ' <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                             
                                                <a class="dropdown-item" href="' . url('admin/pdi-listing') . "/" . "$table->id" . '">View</a>
                                          
                                            </div>
                                        </div>';

                        return $btns;
                    }

                })
                ->rawColumns(['action']);


        }
        return $datatables->make(true);
    }
   

    public function aisAdd($id)
    {
        $masterais = Service::find($id);
        $masterjobno = Service::find($id);

        return view('admin.aischecksheet.aisCheckSheetAdd')
            ->with('masterais', $masterais)
            ->with('masterjobno', $masterjobno);
    }

    public function aisAddSave(Request $request)
    {
        $obj = new AisChecksheet();
        $obj->sl_no = $request['sl_no'];
        $obj->job_no = $request['job_no'];
        $obj->customer = $request['customer'];
        $obj->branch = $request['branch'];
        $obj->component = $request['component'];
        $obj->smu_hours = $request['smu_hours'];
        $obj->model = $request['model'];
        $obj->serial_no = $request['serial_no'];
        $obj->dispatch_date = $request['dispatch_date'];
        $obj->job_done_by = $request['job_done_by'];
        $obj->business_segment = $request['business_segment'];
        $obj->complain_receive_date = $request['complain_receive_date'];
        $obj->month = $request['month'];
        $obj->customer_complain = $request['customer_complain'];
        $obj->response_date = $request['response_date'];
        $obj->attainded_by = $request['attainded_by'];
        $obj->completion_date = $request['completion_date'];
        $obj->root_cause = $request['root_cause'];
        $obj->why_y1 = $request['why_y1'];
        $obj->why_y2 = $request['why_y2'];
        $obj->resolution = $request['resolution'];
        $obj->type_of_problem = $request['type_of_problem'];
        $obj->condition_details = $request['condition_details'];
        $obj->status = $request['status'];
        $obj->actual_resolution_date = $request['actual_resolution_date'];
        $obj->area_of_problem = $request['area_of_problem'];
        $obj->system = $request['system'];
        $obj->save();
        $id = $obj->id;


    }

    public function aislisting()
    {
        return view('admin.aischecksheet.aisCheckSheetListing');
    }

    public function fetchaischecksheet(Request $request)
    {
        $table = AisChecksheet::select('*')->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                               <a class="dropdown-item" href="' . url('admin/editaischecksheet/' . $table->id) . '">Edit</a>
                                
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function editaischecksheet($id)
    {
        $servicerequest = AisChecksheet::find($id);
        return view('admin.aischecksheet.editAisCheckSheet')
            ->with('servicerequest', $servicerequest);
    }

    public function editaisave(Request $request)
    {
        $obj = AisChecksheet::find($request['id']);
        $obj->sl_no = $request['sl_no'];
        $obj->job_no = $request['job_no'];
        $obj->customer = $request['customer'];
        $obj->branch = $request['branch'];
        $obj->component = $request['component'];
        $obj->smu_hours = $request['smu_hours'];
        $obj->model = $request['model'];
        $obj->serial_no = $request['serial_no'];
        $obj->dispatch_date = $request['dispatch_date'];
        $obj->job_done_by = $request['job_done_by'];
        $obj->business_segment = $request['business_segment'];
        $obj->complain_receive_date = $request['complain_receive_date'];
        $obj->month = $request['month'];
        $obj->customer_complain = $request['customer_complain'];
        $obj->response_date = $request['response_date'];
        $obj->attainded_by = $request['attainded_by'];
        $obj->completion_date = $request['completion_date'];
        $obj->root_cause = $request['root_cause'];
        $obj->why_y1 = $request['why_y1'];
        $obj->why_y2 = $request['why_y2'];
        $obj->resolution = $request['resolution'];
        $obj->type_of_problem = $request['type_of_problem'];
        $obj->condition_details = $request['condition_details'];
        $obj->status = $request['status'];
        $obj->actual_resolution_date = $request['actual_resolution_date'];
        $obj->area_of_problem = $request['area_of_problem'];
        $obj->system = $request['system'];
        $obj->save();
        return redirect('admin/ais-listing');

    }

    public function uploadmodeldepartment(Request $request)
    {

        /*  (new FastExcel)->import('C:\Apache24\htdocs\gcpl-quality\template files\enginemodel.xlsx', function ($line) {
              $model_no = $line['Machine Model'];
              $dept_id = $line['CRC_SECTION'];
              $obj = MasterMCModel::where('model_no', '=', $model_no)->update(['dept_id' => $dept_id]);
              $obj->save();
  */
        (new FastExcel)->import('C:/Apache24/htdocs/gcpl-quality/template files/enginemodel.xlsx', function ($line) {
            if ($line['Machine Model']) {
                $mcModel = MasterMCModel::where('model_no', '=', $line['Machine Model'])->get()->first();
                if (!isset($mcModel->id)) {
                    $mcModel = new MasterMCModel();
                    $mcModel->model_no = $line['Machine Model'];
                    $mcModel->dept_id = $line['CRC_SECTION'];
                    $mcModel->save();
                }
            }
        });
    }

    public function sectionselection() 
    {
        return view('admin.master.sectionselection');
    }

    public function fetchsectionselectionGetTable(Request $request)
    {
        $table = MasterCustomer::select('*')->get();
        // print_r($table);die();
        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/editcustomer/' . $table->id) . '">Edit</a>
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        // return $datatables->make(true);

        $finalarr = array();
        
        $data = array();
        $data['id'] = 1;
        $data['name'] = 'Cylinder Block Inspection';
        $data['parent_section'] = 'Aggregation Information';
        $data['department'] = 'Engine Disassembly';
        $data['model_no'] = '3805';

        $data['created_at'] = '2022-04-08 12:38:51';

        $finalarr[] = $data;

        $data = array();
        $data['id'] = 2;
        $data['name'] = 'Crankshaft Inspection';
        $data['parent_section'] = 'Aggregation Information';
       $data['department'] = 'Engine Disassembly';
        $data['model_no'] = '3805';
        $data['created_at'] = '2022-04-08 12:39:51';

        $finalarr[] = $data;

        $data = array();
        $data['id'] = 3;
        $data['name'] = 'Connecting Rod Inspection';
        $data['parent_section'] = 'Aggregation Information';
        $data['department'] = 'Engine Disassembly';
        $data['model_no'] = '3805';  
        $data['created_at'] = '2022-04-08 12:30:51';

        $finalarr[] = $data;

        return json_encode(
                        array(
                            'draw'=>1,
                            'recordsTotal' => sizeof($finalarr),
                            'recordsFiltered' => sizeof($finalarr),
                            'data'=>$finalarr
                            )
                        );

    }

        public function addsection()
    {
        return view('admin.master.addsection');

    }

    public function mastersectionStore(CustomerRequest $request)
    {
        $obj = new MasterCustomer();
         $obj->name = $request['name'];
        $obj->customer_code = $request['customer_code'];
        $obj->address = $request['address'];
        $obj->branch = $request['branch'];
        $obj->company_code = $request['company_code'];
        $obj->contact_details = $request['contact_details'];
        $obj->cust_email = $request['cust_email'];

        $obj->save();
        return redirect('admin/master-customer');
    }
}


