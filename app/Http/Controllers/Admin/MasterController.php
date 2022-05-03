<?php

namespace App\Http\Controllers\admin;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\MasterTaskRequest;

use App\Models\ChecksheetSectionWiseColumn;
use App\Models\ChecksheetSectionWiseColumnnew;
use App\Models\ChecksheetColumnStore;
use App\Models\ComponentInspectionReport;
use App\Models\EngineAssembly;
use App\Models\MasterPartOthercomponentBasicEngine;
use App\Models\TransmissionComponentDetails;
use App\Models\MasterDesignation;
use App\Models\MasterEmployee;
use App\Models\MasterMCModel;
use App\Models\MasterSection;
use App\Models\MasterTask;
use App\Models\User;
use App\Models\ModelWiseCheecksheet;
use Illuminate\Http\Request;
use App\Models\MasterCheckSheetSection;
use App\Models\MasterRelationType;
use App\Models\MasterCheckSheetMapping;
use App\Models\MasterStdData;
use App\Models\PartsInspectionStdData;
use App\Models\MasterComponentModelNo;
use App\Models\MasterComponentDetails;
use App\Models\MasterMCSerialNumber;
use App\Models\MasterBranch;
use App\Models\Service;
use App\Models\MasterDepartment;use App\Models\MasterMachineModelNo;
use App\Models\MasterCustomer;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use DB;
use Hash;
use Auth;
use Illuminate\Support\Str;
use Mail;
use DataTables;
use Session;
use Redirect;
use Alert;
use Input;
use Illuminate\Support\Facades\Crypt;
use App\Providers\HelperServiceProvider;
use Rap2hpoutre\FastExcel\FastExcel;
use Box\Spout\Writer\Style\StyleBuilder;




use App\Http\Requests\BranchRequest;
use Spatie\Permission\Models\Role;

class MasterController extends Controller
{

//checksheet section
    public function checksheetsectionAdd()
    {
        return view('admin.checksheet.addchecksheetsection');


    }

    public function checksheetsectionAddSave(Request $request)
    {
        // $data = $request->input();
        // dd($data);
        $obj = new ModelWiseCheecksheet();
        $obj->dept_id = $request['dept_id'];
        $obj->model_id = $request['model_id'];
        $obj->section_id=implode(',',$request['section_id']);
		
		$sectionfind3= Str::contains($obj->section_id,'17');
		 if($sectionfind3 === false){
			$sectionfind1= Str::contains($obj->section_id,'2'); //if pre history(2) exists or not check

			if($sectionfind1 === false){
				$obj->section_id = $obj->section_id . ','. '2'; // then add id 2
			}

			$sectionfind2= Str::contains($obj->section_id,'20'); //if chkgate1follow(20) exists or not check

			if($sectionfind2 === false){
				$obj->section_id = $obj->section_id . ','. '20';
			}
		 }
        if(!empty($request['childSection'])){
            $obj->child_id = implode(',',$request['childSection']);
        }else {
            $obj->child_id = NULL;
        }

        if(!empty($request['subsection_id'])) {
            $obj->subsection_id = implode(',', $request['subsection_id']);
        }else {
            $obj->subsection_id = NULL;
        }

        $obj->save();

        return redirect('admin/checksheetsection-listing');

    }

    public function checksheetsectionEdit($id) {

        $errors = ModelWiseCheecksheet::find($id);


        return view('admin.checksheet.editchecksheetsection')
            ->with('errors',$errors);
    }

    public function checksheetsectionEditSave(Request $request)
    {
//         $data = $request->input();
//        dd($data);

        $obj = ModelWiseCheecksheet::find($request['id']);
        //$obj = new ModelWiseCheecksheet();
        $obj->dept_id = $request['dept_id'];
        $obj->model_id = $request['model_id'];
        $obj->section_id=implode(',',$request['section_id']);
		
		$sectionfind3= Str::contains($obj->section_id,'17');
		 if($sectionfind3 === false){
			$sectionfind1= Str::contains($obj->section_id,'2'); //if pre history(2) exists or not check

			if($sectionfind1 === false){
				$obj->section_id = $obj->section_id . ','. '2'; // then add id 2
			}

			$sectionfind2= Str::contains($obj->section_id,'20'); //if chkgate1follow(20) exists or not check

			if($sectionfind2 === false){
				$obj->section_id = $obj->section_id . ','. '20';
			}
		 }

        if(!empty($request['childSection'])){
            $obj->child_id = implode(',',$request['childSection']);
        }else {
            $obj->child_id = NULL;
        }

        if(!empty($request['subsection_id'])) {
            $obj->subsection_id = implode(',', $request['subsection_id']);
        }else{
            $obj->subsection_id = NULL;
        }

        $obj->save();

        return redirect('admin/checksheetsection-listing');

    }

    public function checksheetsectionlisting()
    {
        return view('admin.checksheet.listchecksheetsection');
    }

    public function fetchchecksheetsectionDownload(){

        $table = ModelWiseCheecksheet::select('model_wise_checksheet.*','gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')
            ->leftjoin('gw_master_department','gw_master_department.id','=','model_wise_checksheet.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','model_wise_checksheet.model_id')
            ->get();

            $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/ChecksheetsectionList.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'DEPARTMENT' => $table['Dept'],
                'MODEL' => $table['Model'],                       
                
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }

    public function fetchchecksheetsection(Request $request)
    {
        $table = ModelWiseCheecksheet::select('model_wise_checksheet.*','gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')
            ->leftjoin('gw_master_department','gw_master_department.id','=','model_wise_checksheet.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','model_wise_checksheet.model_id')
            ->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/checksheetsection-edit/' . $table->id) . '">Edit</a>
                                <a href="' . url('admin/checksheetsection-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="dropdown-item">Delete</a>
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function checksheetsectionDelete($user_id)
    {
        $blog = ModelWiseCheecksheet::find($user_id);


        $blog->delete();

        return redirect('admin/checksheetsection-listing');
    } 


//checksheet column
   public function checksheetcolumnAdd()
    {
        return view('admin.checksheet.addchecksheetcolumn');


    }

    public function checksheetcolumnAddSave(Request $request)
    {

    //$data = $request->input();


            //$obj1 = new ChecksheetColumnStore();
            $obj1 = new ChecksheetSectionWiseColumn(); //remove comment and change columnSectionShow function's table name to ChecksheetColumnStore

            $obj1->dept_id = $request['dept_id'];
            $obj1->model_id = $request['model_id'];
            $obj1->section_id=$request['section_id1'];
        //dd($obj1->section_id);
        if(!empty($request['columnSection'])){
            $obj1->column_id = implode(',',$request['columnSection']);
        }
        else{
            $obj1->column_id = Null;
        }


       //dd($obj1->section_id);
            $obj1->save();



        return redirect('admin/checksheetcolumn-listing');

    }

    public function checksheetcolumnlisting()
    {
        return view('admin.checksheet.listchecksheetcolumn');
    }

    public function fetchchecksheetcolumnDownload(){

        $table = ChecksheetSectionWiseColumn::select('gw_master_section_column.*','gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')
            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_master_section_column.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_section_column.model_id')
            ->get();

            $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/ChecksheetcolumnList.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'DEPARTMENT' => $table['Dept'],
                'MODEL' => $table['Model'],                            
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }

    public function fetchchecksheetcolumn(Request $request)
    {
        $table = ChecksheetSectionWiseColumn::select('gw_master_section_column.*','gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')
            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_master_section_column.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_section_column.model_id')
            ->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/checksheetcolumn-edit/' . $table->id) . '">Edit</a>
                                <a href="' . url('admin/checksheetcolumn-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="dropdown-item">Delete</a>
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function checksheetcolumnEdit($id) {

        $errors = ChecksheetSectionWiseColumn::find($id);


        return view('admin.checksheet.editchecksheetcolumn')
            ->with('errors',$errors);
    }

    public function checksheetcolumnEditSave(Request $request)
    {
//         $data = $request->input();
//        dd($data);

        $obj = ChecksheetSectionWiseColumn::find($request['id']);
        //$obj = new ModelWiseCheecksheet();
        $obj->dept_id = $request['dept_id'];
        $obj->model_id = $request['model_id'];
        $obj->section_id=$request['section_id1'];

        if(!empty($request['columnSection'])){
            $obj->column_id = implode(',',$request['columnSection']);
        }else {
            $obj->column_id = NULL;
        }



        $obj->save();

        return redirect('admin/checksheetcolumn-listing');

    }

    public function checksheetcolumnDelete($user_id)
    {
        $blog = ChecksheetSectionWiseColumn::find($user_id);


        $blog->delete();

        return redirect('admin/checksheetcolumn-listing');
    }
//json value show in checksheet section column selection
    public function childSectionShow(Request $request)
    {

        $childSelection = '';
        // $checkshtchildArr=explode(',',$request['checkshtchild']);
        $i = 0;
        foreach($request['checkshtchild'] as $checkshtchild){


            $compdet = UserHelper::childsectionchecksheet($checkshtchild);


            if (!isset($compdet->section_id)) {

                foreach ($compdet as $key => $value) {

                    $childSelection .= '<div class="custom-control form-control-lg custom-checkbox childSection">
                                            <input type="checkbox"  name="childSection[]" value="'.$value['id'].'" class="custom-control-input childSection_1" id="childSection'.$i.'">
                                            <label class="custom-control-label" for="childSection'.$i.'">'.$value['child_section'].'</label></div>';
                    $i++;
                }

            }
        }

        echo $childSelection;

    }

    public function subChildSectionShow(Request $request)
    {

        $subchildSelection = '';

        $i = 0;
        foreach($request['subsect'] as $subsect){

//print_r($subsect);
            $compdet = UserHelper::subChildsectionchecksheet($subsect);
    //echo'<pre>';print_r($compdet);exit;

            if (!isset($compdet->child_id)) {


                foreach ($compdet as $key => $value) {

                    $subchildSelection .= '<div class="custom-control form-control-lg custom-checkbox">
                                            <input type="checkbox"  name="subchildSection[]" value="'.$value['id'].'" class="custom-control-input childSection2" id="subchildSection'.$i.'">
                                            <label class="custom-control-label" for="subchildSection'.$i.'">'.$value['sub_child_section'].'</label></div>';
                    $i++;
                }

            }
        }

        echo $subchildSelection;




        // $machserial = UserHelper::machineserialno();
        /*   $compdet = UserHelper::subChildsectionchecksheet($request['subsect']);
           // dd($compdet);exit;
           $commod = '<option selected="selected" disabled="disabled">Select Sub Child Section</option>';
           if (!isset($compdet->child_id)) {
               foreach ($compdet as $key => $value) {
                   $commod .= '<option value=' . $value['id'] . '>' . $value['sub_child_section'] . '</option>';
               }
           }
           echo $commod;*/

    }

    public function columnSectionShow(Request $request)
    {

        $columnSelection = '';
        // print_r($request['columnchksht']);
        $checkshtchildArr = $request['columnchksht'];
        // echo "string";die();
        $i = 0;
        // foreach($request['columnchksht'] as $columnchksht){
        foreach($checkshtchildArr as $columnchksht){
            //
            // echo "string1";die();
            // foreach(explode(',', $request->columnchksht) as $columnchksht){

            $compdet = UserHelper::columnforchecksheet($columnchksht);

            // echo "string";die();
            if (!isset($compdet->section_id)) {
                // echo "<pre>";print_r($compdet[0]['column_id']);echo "<br>";exit;
                foreach ($compdet as $key => $value) {

                    $columnSelection .= '<div class="custom-control form-control-lg custom-checkbox">
                                            <input type="checkbox"  name="columnSection[]" value="'.$value['column_id'].'" class="custom-control-input mainsection" id="columnSection'.$i.'">
                                            
                                            <label class="custom-control-label" for="columnSection'.$i.'">'.$value['column_name'].'</label></div>';

                    $i++;


                }

            }
        }




        echo $columnSelection ;

    }


//std data
    public function stddataAdd()
    {
        return view('admin.checksheet.addstddata');


    }

    public function stddataAddSave(Request $request)
    {

        //$data = $request->input();

        $obj1 = new PartsInspectionStdData();

        $obj1->dept_id = $request['dept_id'];
        $obj1->model_id = $request['model_id'];

        $allvalue=explode(',',$request['section_name']);

        //dd($allvalue);
        //for section id
        if(!empty($allvalue[1])){
            $obj1->section_id=$allvalue[1];
        }else{
            $obj1->section_id = Null;
        }
        //for child id
        if(!empty($allvalue[2])){
            $obj1->child_id=$allvalue[2];
        }else{
            $obj1->child_id = Null;
        }
        //for subchild id
        if(!empty($allvalue[3])){
            $obj1->subchild_id=$allvalue[3];
        }else{
            $obj1->subchild_id = Null;
        }
        $obj1->name = $request['name'];
        $obj1->lower_limit_mm = $request['lower_limit_mm'];
        $obj1->upper_limit_mm = $request['upper_limit_mm'];
        $obj1->lower_limit_inch = $request['lower_limit_inch'];
        $obj1->upper_limit_inch = $request['upper_limit_inch'];
        $obj1->description = $request['description'];

        $obj1->save();



        return redirect('admin/stddata-listing');

    }

    public function stddatalisting()
    {
        return view('admin.checksheet.liststddata');
    }

    public function fetchstddataDownload(){

        $table = PartsInspectionStdData::select('gw_parts_inspection_std_data.*','gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')
            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_parts_inspection_std_data.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_parts_inspection_std_data.model_id')
            ->get();

        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/StddataList.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'DEPARTMENT' => $table['Dept'],
                'MODEL' => $table['Model'],                       
               
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);

    }

    public function fetchstddata(Request $request)
    {
        $table = PartsInspectionStdData::select('gw_parts_inspection_std_data.*','gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')
            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_parts_inspection_std_data.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_parts_inspection_std_data.model_id')
            ->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/stddata-edit/' . $table->id) . '">Edit</a>
                                <a href="' . url('admin/stddata-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="dropdown-item">Delete</a>
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }


    public function stddataEdit($id) {

        $errors = PartsInspectionStdData::find($id);

 //dd($errors);
        $namefound="";
  if(!empty($errors->section_id)){
      $namefound = MasterStdData::select('section_name')->where('section_id','=',$errors->section_id)->get()->toArray();
  }
  elseif (!empty($errors->child_id)){
      $namefound = MasterStdData::select('section_name')->where('child_id','=',$errors->child_id)->get()->toArray();
  }
  elseif (!empty($errors->subchild_id)){
      $namefound = MasterStdData::select('section_name')->where('subchild_id','=',$errors->subchild_id)->get()->toArray();
  }

       if(!empty($namefound)){
           if(!empty($namefound[0]['section_name'])) {
               $namefind = $namefound[0]['section_name'];
           }
       }
        //dd($namefind);
        return view('admin.checksheet.editstddata')
            ->with('errors',$errors)
            ->with('namefind',$namefind);
    }

    public function stddataEditSave(Request $request)
    {
//         $data = $request->input();
//        dd($data);

        $obj1 = PartsInspectionStdData::find($request['id']);
        //$obj = new ModelWiseCheecksheet();

        $obj1->dept_id = $request['dept_id'];
        $obj1->model_id = $request['model_id'];
        $obj1->name = $request['name'];
        $obj1->lower_limit_mm = $request['lower_limit_mm'];
        $obj1->upper_limit_mm = $request['upper_limit_mm'];
        $obj1->lower_limit_inch = $request['lower_limit_inch'];
        $obj1->upper_limit_inch = $request['upper_limit_inch'];
        $obj1->description = $request['description'];


        $obj1->save();

        return redirect('admin/stddata-listing');

    }

    public function stddataDelete($user_id)
    {
        $blog = PartsInspectionStdData::find($user_id);


        $blog->delete();

        return redirect('admin/stddata-listing');
    }




    public function show()
    {
        return view('admin.dashboard.branch');


    }
    public function insertdata(BranchRequest $request)
    {
        // $data = $request->input();
        // dd($data);

        $obj = new MasterComponentModelNo();
        $obj->model_no = $request['model_no'];
        $obj->save();
        return redirect('admin/service-request-list');



    }



//fetch model_no
    public function fetch()
    {

        return view('admin.dashboard.fetchbranch');


    }

    public function fetchmodelGetTable(Request $request)
    {
        $table = MasterComponentModelNo::select('*')->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/fetchdata/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/model-delete/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    // public function fetchdata($id)
    //{
    // $title='Edit Service';

    //  $masterComponentModelNo=MasterComponentModelNo::find($id);

    //return view('admin.branchengineer.editmodelRequest')
    //  ->with('masterComponentModelNo',$masterComponentModelNo);
    //}
    public function fetchdata($id) {

        $errors = MasterComponentModelNo::find($id);


        return view('admin.branchengineer.editmodelRequest')
            ->with('errors',$errors);
    }


    public function update(Request $request)
    {

        $obj = MasterComponentModelNo::find($request['id']);

        $obj->model_no=$request['model_no'];
        $obj->save();
        return redirect('admin/fetch');


    }

    public function modelDelete($user_id)
    {
        $blog = MasterComponentModelNo::find($user_id);


        $blog->delete();

        return redirect('admin/fetch');
    }

    public function mastercustomer()
    {
        //$customerid = MasterCustomer::find('id');
        //$customername = MasterCustomer::select('name');
        return view ('admin.master.masterCustomer')	;
        //->with('customerid', $customerid)
        //->with('customername', $customername);




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


    public function editcustomer($id) {



        $errors = MasterCustomer::find($id);



        return view('admin.master.editcustomer')
            ->with('errors',$errors);



    }

    public function updatecustomer(Request $request)
    {
        $obj = MasterCustomer::find($request['id']);


        $obj->name=$request['name'];
        $obj->customer_code=$request['customer_code'];
        $obj->address=$request['address'];
        $obj->contact_details=$request['contact_details'];


        $obj->region=$request['region'];
        $obj->branch=$request['branch'];
        $obj->save();
        return redirect('admin/master-customer');

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
                                <a class="dropdown-item" href="' . url('admin/editbranch/' . $table->id) . '">Edit</a>
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function editbranch($id) {

        $errors =  MasterBranch::find($id);




        return view('admin.master.editbranch')
            ->with('errors',$errors);
    }

    public function updatebranch(Request $request)
    {
        $obj = MasterBranch::find($request['id']);

        $obj->sales_ofc=$request['sales_ofc'];
        $obj->sales_ofc_code=$request['sales_ofc_code'];
        $obj->save();
        return redirect('admin/master-branch');
    }

    public function mastercomp()
    {
        $title='';
        return view('admin.master.mastercomponentserial')
            ->with('title',$title);
    }

    public function fetchcompserial(Request $request)
    {
        $table = MasterComponentDetails::Select ('gw_master_comp_details.id','gw_master_component_model_no.model_no','gw_master_comp_details.comp_model_no','gw_master_comp_details.comp_serial_no','gw_master_comp_details.comp_type')-> leftjoin('gw_master_component_model_no' , 'gw_master_component_model_no.id','=','gw_master_comp_details.mc_model_id')->get();



        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/editcomponent/' . $table->id) . '">Edit</a>
                                   </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }


    public function editcomponent($id)
    {
        $mcComponent =  MasterComponentDetails::find($id);
        return view('admin.master.editcomponent')
            ->with('mcComponent',$mcComponent);

    }



    public function updatecomponent(Request $request)
    {
        $obj = MasterComponentDetails::find($request['id']);

        $obj->comp_model_no=$request['comp_model_no'];
        $obj->comp_serial_no=$request['comp_serial_no'];
        $obj->comp_type=$request['comp_type'];
        $obj->save();
        return redirect('admin/comp-details');
    }

    public function mastermodelserial()
    {
        $title='';
        return view('admin.master.mastermcmodel')
            ->with('title',$title);
    }

    public function fetchmodelserial(Request $request)

    {
        /*$table=MasterMCModel::Select('gw_master_mc_model.model_no','gw_master_mc_serial_number.serial_no','gw_master_comp_details.comp_type','gw_master_comp_details.comp_model_no','gw_master_comp_details.comp_serial_no')->join('gw_master_mc_serial_number','gw_master_mc_serial_number.mc_model_id','=','gw_master_mc_model.id')->join('gw_master_comp_details','gw_master_comp_details.mc_model_id','=','gw_master_mc_model.id')->get();*/

        $table=MasterMCModel::Select('gw_master_mc_model.model_no','gw_master_mc_serial_number.serial_no','gw_master_comp_details.comp_type','gw_master_comp_details.comp_model_no','gw_master_comp_details.comp_serial_no')
            ->LeftJoin('gw_master_mc_serial_number','gw_master_mc_serial_number.mc_model_id','=','gw_master_mc_model.id')
            ->LeftJoin('gw_master_comp_details','gw_master_comp_details.mc_model_id','=','gw_master_mc_model.id')->get();
        //  echo '<pre>';print_r($table);exit;
        //dd($table);
        // exit();
        /* $table = MasterMCSerialNumber::Select ('gw_master_mc_serial_number.id','gw_master_mc_serial_number.serial_no','gw_master_mc_model.model_no')
         ->leftJoin('gw_master_mc_model' , 'gw_master_mc_model.id','=','gw_master_mc_serial_number.mc_model_id')
             ->get();

         $fetchcomp = MasterComponentDetails::Select('gw_master_comp_details.id','gw_master_comp_details.comp_model_no','gw_master_comp_details.comp_serial_no','gw_master_comp_details.comp_type')
             ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_comp_details.mc_model_id')->get();
 */
        $datatables = Datatables::of($table)

            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/editmachine/' . $table->id) . '">Edit</a>
                                   </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }



    public function editmachine($id)
    {

        /*$table = MasterMCSerialNumber::Select ('gw_master_mc_serial_number.id','gw_master_mc_serial_number.serial_no','gw_master_mc_serial_number.created_at','gw_master_mc_model.model_no')
        ->leftJoin('gw_master_mc_model' , 'gw_master_mc_model.id','=','gw_master_mc_serial_number.mc_model_id')
        ->get();*/

        //$errors =  MasterMCSerialNumber::find($id);
        $mcMachine =  MasterMCSerialNumber::find($id);
        return view('admin.master.editmachine')
            ->with('mcMachine',$mcMachine);




        //  return view('admin.master.editmachine')
        //->with('table',$table);
        //    ->with('errors',$errors);

    }
    public function updatemachine(Request $request)
    {
        $obj = MasterMCSerialNumber::find($request['id']);


        $obj->serial_no=$request['serial_no'];

        $obj->save();
        return redirect('admin/master-machine');
    }
    
	
	//Master Task
    public function mastertask()
    {
        $data=session::all();
        $items = MasterTask::all();
        $predicessor = MasterTask::all()->toArray();
        //$machinemodel = MasterTask::select('machine_modelwise_task.dept_id', 'gw_master_department.name')->leftjoin('gw_master_department',
        //    'gw_master_department.id', '=', 'machine_modelwise_task.id')->get();
        $deptname = MasterDepartment::select('gw_master_department.id','gw_master_department.name')->get();
        $modelno=MasterMCModel::select('gw_master_mc_model.id','gw_master_mc_model.model_no')->get();
        $selecttask=MasterTask::select('machine_modelwise_task.*')->get();
        $checkSheet_sec = MasterCheckSheetMapping::select('*')
//            ->where('section_id','=',$data['user']['section_id'])
            ->get();
        $relation = MasterRelationType::get();
        return view ('admin.superadmin.machinemodelwisetask', compact('items'))
            ->with('selecttask',$selecttask)
            ->with('deptname',$deptname)
            ->with('predicessor',$predicessor)
            ->with('checkSheet_sec',$checkSheet_sec)
            ->with('relation',$relation)
            ->with('modelno',$modelno);

    }
   public function insertmastertask(Request $request)
    {

        $data = $request->input();

        $separate = explode(',',$data['name']);

       
        $obj = new MasterTask();

        $obj->dept_id=$request['dept_id'];


        //disassembly subdept
       if(($separate[0] == '1') && ($request['dept_id'] == '4')) {

           $obj->subdept_id = '4';
       }
        elseif(($separate[0] == '1') && ($request['dept_id'] == '5')) {

            $obj->subdept_id = '5';
        }
       elseif(($separate[0] == '1') && ($request['dept_id'] == '7')) {

           $obj->subdept_id = '7';
       }
       elseif(($separate[0] == '1') && ($request['dept_id'] == '13')) {

           $obj->subdept_id = '13';
       }
       elseif(($separate[0] == '1') && ($request['dept_id'] == '25')) {

           $obj->subdept_id = '25';
       }
       //assembly
       elseif(($separate[0] == '2') && ($request['dept_id'] == '4')) {

           $obj->subdept_id = '10';
       }
       elseif(($separate[0] == '2') && ($request['dept_id'] == '5')) {

           $obj->subdept_id = '11';
       }
       elseif(($separate[0] == '2') && ($request['dept_id'] == '7')) {

           $obj->subdept_id = '15';
       }
       elseif(($separate[0] == '2') && ($request['dept_id'] == '13')) {

           $obj->subdept_id = '12';
       }
       elseif(($separate[0] == '2') && ($request['dept_id'] == '25')) {

           $obj->subdept_id = '26';
       }
       //testing
       elseif(($separate[0] == '3')) {

           $obj->subdept_id = '23';
       }
       //qaqc
       elseif(($separate[0] == '4')) {

           $obj->subdept_id = '21';
       }
       //dispatch
       elseif(($separate[0] == '5')) {

           $obj->subdept_id = '22';
       }
       //store
       elseif(($separate[0] == '6')) {

           $obj->subdept_id = '9';
       }

        //dd($obj->subdept_id);
        $obj->model_no=$request['model_no'];

       if(!empty($separate[1])){
           $obj->name = $separate['1'];
       }
       //dd($obj->name);
        $obj->description=$request['description'];
        $obj->tat=$request['tat'];
        //$obj->parent=$request['parent'];
        $obj->predicessor=$request['predicessor'];
        if(!empty($separate[2])){
            $obj->section_id=$separate[2];
        }



        $obj->relation_type=$request['relation_type'];
        $obj->task_id=$obj->id;
        $obj->save();


       $obj1 =MasterTask::find($obj->id);

       $updatetask_id = DB::table('machine_modelwise_task')->where('id', '=', $obj->id)->update(array('task_id' => $obj1['id']));

        return redirect('admin/fetchmodelwisetask');
    }

    //predicessorshow
    public function predicessorfortask(Request $request){

        //dd($request['dept_id']);
       ///echo '<pre>'; print_r($request);exit;
        $machserial= UserHelper::predecessorfind($request['dept_id'],$request['model_id']);


        //$model=$_POST['model'];

  //dd($machserial);
        $str = '<option selected="selected" disabled="disabled">Select </option>';
        if (!isset($machserial['id'])) {
            foreach ($machserial as $key => $value) {
                $str .= '<option value=' . $value['id'] . '>' . $value['name'] . '</option>';
            }
        }
        echo $str;

        //$model=$_POST['model'];
        //echo $model;

    }

    public function mastersubtask()
    {
        $data=session::all();
        $items = MasterTask::all();
        $predicessor = MasterTask::all()->toArray();
        //$machinemodel = MasterTask::select('machine_modelwise_task.dept_id', 'gw_master_department.name')->leftjoin('gw_master_department',
        //    'gw_master_department.id', '=', 'machine_modelwise_task.id')->get();
        $deptname = MasterDepartment::select('gw_master_department.id','gw_master_department.name')->get();
        $modelno=MasterMCModel::select('gw_master_mc_model.id','gw_master_mc_model.model_no')->get();
        $selecttask=MasterTask::select('machine_modelwise_task.*')->get();
        $checkSheet_sec = MasterCheckSheetMapping::select('*')
//            ->where('section_id','=',$data['user']['section_id'])
            ->get();
        $relation = MasterRelationType::get();
        return view ('admin.superadmin.machinemodelwisesubtask', compact('items'))
            ->with('selecttask',$selecttask)
            ->with('deptname',$deptname)
            ->with('predicessor',$predicessor)
            ->with('checkSheet_sec',$checkSheet_sec)
            ->with('relation',$relation)
            ->with('modelno',$modelno);

    }

    public function insertmastersubtask(Request $request)
    {

        $data = $request->input();

        $separate = explode(',',$data['name']);

        $obj = new MasterTask();

        $obj->dept_id=$request['dept_id'];


       
        //assembly
        if(($separate[0] == '17') && ($request['dept_id'] == '4')) {

            $obj->subdept_id = '10';
        }
        elseif(($separate[0] == '17') && ($request['dept_id'] == '5')) {

            $obj->subdept_id = '11';
        }
        elseif(($separate[0] == '17') && ($request['dept_id'] == '7')) {

            $obj->subdept_id = '15';
        }
        elseif(($separate[0] == '17') && ($request['dept_id'] == '13')) {

            $obj->subdept_id = '12';
        }
        //testing
        elseif(($separate[0] == '11')) {

            $obj->subdept_id = '23';
        }
		elseif(($separate[0] == '10')) {

            $obj->subdept_id = '23';
        }
        //qaqc //checkgate4
        elseif(($separate[0] == '13')) {

            $obj->subdept_id = '21';
        }
        //dispatch //pdi
        elseif(($separate[0] == '12')) {

            $obj->subdept_id = '22';
        }
        

        //dd($obj->subdept_id);
        $obj->model_no=$request['model_no'];

        if(!empty($separate[1])){
            $obj->name = $separate['1'];
        }
        //dd($obj->name);
        $obj->description=$request['description'];
        $obj->tat=$request['tat'];
        //$obj->parent=$request['parent'];
        $obj->parent=$request['parent'];
        if(!empty($separate[2])){
            $obj->section_id=$separate[2];
        }



        $obj->relation_type=$request['relation_type'];
        $obj->task_id=$obj->id;
        $obj->save();


        $obj1 =MasterTask::find($obj->id);

        $updatetask_id = DB::table('machine_modelwise_task')->where('id', '=', $obj->id)->update(array('task_id' => $obj1['id']));

        return redirect('admin/fetchmodelwisetask');
    }


    public function fetchmachinetask()
    {
//        $table = MasterTask::Select('machine_modelwise_task.*', 'gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')
//            ->where('machine_modelwise_task.model_no','!=','0')
//            ->leftjoin('gw_master_department','gw_master_department.id','=','machine_modelwise_task.dept_id')
//            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','machine_modelwise_task.model_no')
//
//            ->get();
        //  echo '<pre>';
        //print_r($table);
        //exit;

        return view('admin.superadmin.machinemodelwisetasklisting');

    }

    public function fetchmachinemodeltaskDownload(){
       
       $table = MasterTask::Select('machine_modelwise_task.*', 'gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')
            ->where('machine_modelwise_task.model_no','!=','0')
            ->leftjoin('gw_master_department','gw_master_department.id','=','machine_modelwise_task.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','machine_modelwise_task.model_no')

            ->get();

        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/Fetchmodelwisetask.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'DEPARTMENT' => $table['Dept'],
                'MODEL' => $table['Model'],                       
                'NAME' => $table['name'],
                'TAT' => $table['tat'],
                'RELATION TYPE' => $table['relation_type'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);    

    }

    public function tatreport()
    {
        
       
       //$this->tatHourCalculation('2021-07-29','6.33'); 


        $table = MasterTask::Select('machine_modelwise_task.*')
            ->where('machine_modelwise_task.model_no','!=','0')
            ->where('machine_modelwise_task.name','=',' Disassembly')
            ->orWhere('machine_modelwise_task.name','=',' Assembly')
            ->get()->toArray();

        foreach ($table as $key => $value) {

           $createDate = date('Y-m-d',strtotime($value['created_at']));
           $tat = $value['tat'];
           $output = $this->tatHourCalculation($createDate,$tat); 
           $result[]  =  $output;
           $result[$key]['StartDate'] = $createDate;
           $result[$key]['modelNo'] = $value['model_no'];
           $result[$key]['name']= $value['name'];

        }
            print_r($result);




//echo end($nextDates);
        $table = MasterTask::Select('machine_modelwise_task.*', 'gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')
            ->where('machine_modelwise_task.model_no','!=','0')
            ->leftjoin('gw_master_department','gw_master_department.id','=','machine_modelwise_task.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','machine_modelwise_task.model_no')

            ->get();

            //print_r($table);


    }

    function tatHourCalculation($tatdate='',$tathours=''){

        //$datetime = DateTime::createFromFormat('Y-m-d', '2021-07-29');

        //echo $datetime->format('D');
        $roundTatHours = round($tathours*8);
        $day_before = date( 'Y-m-d', strtotime( $tatdate . ' -1 day' ) );

        $holidays = array('12-24' => '', '12-25' => '');
        $weekend = array('Sun' => '');
        $date = new DateTime($day_before);
        $dayInterval = new DateInterval('P1D');
        $nextDay = clone $date;
        $i = 0;
        $nextDates = array();
        $totalhours = 0;
        $lastKey = '';
        while ($i < 10)
        {
            $nextDay->add($dayInterval);
            if (isset($holidays[$nextDay->format('m-d')])) continue;
            if (isset($weekend[$nextDay->format('D')])) continue;
            $nextDates[] = $nextDay->format('Y-m-d');
            $days[] = $nextDay->format('D');
            $i++;
        }

        foreach ($days as $key => $value) {
            if($totalhours <= $roundTatHours ){
                if($value != 'Sat'){
                    $totalhours  +=8;
                }else{
                    $totalhours +=4;
                }

                $lastKey = $key;
            }
        }

        $response['ExpectedLastDate'] = $nextDates[$lastKey];
        $response['totalHours'] = $totalhours;
         
        return $response;

    }
    
    public function fetchmachinemodeltask(Request $request)
    {
        $table = MasterTask::Select('machine_modelwise_task.*', 'gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')
            ->where('machine_modelwise_task.model_no','!=','0')
            ->leftjoin('gw_master_department','gw_master_department.id','=','machine_modelwise_task.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','machine_modelwise_task.model_no')

            ->get();

           

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/editmachinetask/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/deletemachinetask/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">Delete</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }


    public function editmachinetask($id) {

        $data=session::all();

        $errors =  MasterTask::find($id);
        $predicessor = MasterTask::get();
        $checkSheet_sec = MasterCheckSheetMapping::select('*')
            ->get();
  $dept = MasterDepartment::select('*')->get();

        $relation = MasterRelationType::get();
        $modelno=MasterMCModel::select('gw_master_mc_model.id','gw_master_mc_model.model_no')->get();

        return view('admin.superadmin.editMachineModelTask')
            ->with('predicessor',$predicessor)
            ->with('checkSheet_sec',$checkSheet_sec)
            ->with('dept',$dept)
            ->with('relation',$relation)
            ->with('modelno',$modelno)
            ->with('errors',$errors);
    }


    public function updatemachinetask(Request $request)
    {
        $data = $request->input();
        //dd($request['name']);
        $obj = MasterTask::find($request['id']);

        //$separate = explode(',',$request['name']);

        $obj->dept_id=$request['dept_id'];
        $obj->model_no=$request['model_no'];
        //$obj->name	=$request['name'];
        $obj->description=$request['description'];
        $obj->tat=$request['tat'];
        $obj->relation_type=$request['relation_type'];

        if(!empty($request['parent'])){
            $obj->parent=$request['parent'];
        }

        if(!empty($request['predicessor'])) {
            $obj->predicessor = $request['predicessor'];
        }

        //disassembly subdept
        if(($request['name'] == 'Disassembly') && ($request['dept_id'] == '4')) {

            $obj->subdept_id = '4';
        }
        elseif(($request['name'] == 'Disassembly') && ($request['dept_id'] == '5')) {

            $obj->subdept_id = '5';
        }
        elseif(($request['name'] == 'Disassembly') && ($request['dept_id'] == '7')) {

            $obj->subdept_id = '7';
        }
        elseif(($request['name'] == 'Disassembly') && ($request['dept_id'] == '13')) {

            $obj->subdept_id = '13';
        }
        //assembly
        elseif(($request['name'] == 'Assembly') && ($request['dept_id'] == '4')) {

            $obj->subdept_id = '10';
        }
        elseif(($request['name'] == 'Assembly') && ($request['dept_id'] == '5')) {

            $obj->subdept_id = '11';
        }
        elseif(($request['name'] == 'Assembly') && ($request['dept_id'] == '7')) {

            $obj->subdept_id = '15';
        }
        elseif(($request['name'] == 'Assembly') && ($request['dept_id'] == '13')) {

            $obj->subdept_id = '12';
        }
        //testing
        elseif(($request['name'] == 'Testing')) {

            $obj->subdept_id = '23';
        }
        //qaqc
        elseif(($request['name'] == 'QAQC')) {

            $obj->subdept_id = '21';
        }
        //dispatch
        elseif(($request['name'] == 'Dispatch')) {

            $obj->subdept_id = '22';
        }
        //store
        elseif(($request['name'] == 'Store')) {

            $obj->subdept_id = '9';
        }
        elseif(($request['name'] == 'Assembly Check sheet') && ($request['dept_id'] == '4')) {

            $obj->subdept_id = '10';
        }
        elseif(($request['name'] == 'Assembly Check sheet') && ($request['dept_id'] == '5')) {

            $obj->subdept_id = '11';
        }
        elseif(($request['name'] == 'Assembly Check sheet') && ($request['dept_id'] == '7')) {

            $obj->subdept_id = '15';
        }
        elseif(($request['name'] == 'Assembly Check sheet') && ($request['dept_id'] == '13')) {

            $obj->subdept_id = '12';
        }
        elseif(($request['name'] == 'CheckGate3')) {

            $obj->subdept_id = '23';
        }
        elseif(($request['name'] == 'Bis')) {

            $obj->subdept_id = '23';
        }
        elseif(($request['name'] == 'Pdi')) {

            $obj->subdept_id = '22';
        }
        elseif(($request['name'] == 'CheckGate4')) {

            $obj->subdept_id = '21';
        }

        //$obj->sort_order=$request['sort_order'];
        $obj->save();


        return redirect('admin/fetchmodelwisetask');

    }
    
    public function deletemachinetask($user_id)
    {
        $machinetask = MasterTask::find($user_id);


        $machinetask->delete();

        return redirect('admin/fetchmodelwisetask');
    }


    public function getActivityByDept(Request $request){
        // echo'<pre>';print_r($request['dept_id']);exit;

        $activityStr="<option value=''>---Select---</option>";
            // $dept = MasterCheckSheetMapping::select('*')
            //     ->where('section_id','=',$request->dept_id)
            //     ->get();
                $dept = MasterCheckSheetMapping::select('gw_master_checksheet_section_mapping.section_id','gw_master_checksheet_section.*')
                    ->leftjoin('gw_master_checksheet_section','gw_master_checksheet_section.name','=','gw_master_checksheet_section_mapping.name')
                    ->where('section_id','=',$request->dept_id)
                    ->get();
            // dd($dept);
                foreach ($dept as $arr){
                    $activityStr .="<option value='".$arr->id."'>".$arr->name."</option>";
        }
        echo $activityStr;
    }








    //master employee name and code
    public function employeetNameList()
    {
        return view('admin.master.listEmployeeName');

    }
    public function employeeNameGetTable(Request $request)
    {
        $table = MasterEmployee::select('*')->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/fetchdata/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/model-delete/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }


    //employee section designation role
    public function employeetSectionDesigRoleList()
    {
        return view('admin.master.listEmployeeSectionDesigRole');


    }

    public function sectionAddSave(Request $request)
    {
        // $data = $request->input();
        // dd($data);
        $obj = new MasterSection();
        $obj->section = $request['section'];
        $obj->save();
        return redirect('admin/employee-section-desig-role-list');

    }

    public function designationAddSave(Request $request)
    {
        // $data = $request->input();
        // dd($data);
        $obj = new MasterDesignation();
        $obj->designation = $request['designation'];
        $obj->save();
        return redirect('admin/employee-section-desig-role-list');

    }
    public function jobroleAddSave(Request $request)
    {
        // $data = $request->input();
        // dd($data);
        $obj = new Role();
        $obj->name = $request['name'];
        $obj->guard_name = 'web';
        $obj->save();
        return redirect('admin/employee-section-desig-role-list');

    }

    public function sectionGetTable(Request $request)
    {
        $table = MasterSection::select('*')->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/fetchdata/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/model-delete/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function designationGetTable(Request $request)
    {
        $table = MasterDesignation::select('*')->get();


        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/fetchdata/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/model-delete/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function jobroleGetTable(Request $request)
    {
        $table = Role::select('*')->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/fetchdata/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/model-delete/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }



    //employee details

    public function employeeDetailsAdd()
    {
        return view('admin.master.addEmployeeDetails');


    }

   
    public function employeeDetailsAddSave(Request $request)
    {
        // $data = $request->input();
        // dd($data);
        $obj = new User();
        $obj->name = $request['name'];
        $obj->location_id = $request['location_id'];
        $obj->emp_code = $request['emp_code'];
        $obj->email = $request['email'];
        $obj->section_id = $request['section_id'];
        $obj->designation_id = $request['designation_id'];
        $obj->role_id = $request['role_id'];

        $obj->password=Hash::make($request['password']);
        $obj->save();
        // echo '<pre>';print_r($obj);exit;
        return redirect('admin/employee-detsils-list');

    }

public function userEdit($id)
    {
        $title='Edit User';

        $user=User::find($id);

        return view('admin.master.editEmployee')
            ->with('user',$user);
    }
    public function userEditStore(Request $request)
    {
        //  $myrequest=$request->all();
        //dd($request);

        $obj = User::find($request['id']);
        $obj->name = $request['name'];
        $obj->location_id = $request['location_id'];
        $obj->emp_code = $request['emp_code'];
        $obj->email = $request['email'];
        $obj->section_id = $request['section_id'];
        $obj->designation_id = $request['designation_id'];
        $obj->role_id = $request['role_id'];


             $obj->password = Hash::make($request['password']);

        $obj->save();
        return redirect('admin/employee-detsils-list');
    }
    public function employeedelete($user_id)
    {
        $sr = User::find($user_id);


        $sr->delete();

        return redirect('admin/employee-detsils-list');
    }

    public function employeeDetailsList()
    {
        return view('admin.master.listEmployeeDetails');


    }

   
    public function employeeDetailsGetTableDownload(){
       
       $table = User::select('users.*','users.name as username','gw_master_department.name as dept_name','gw_master_designation.designation as desg_name','roles.name as jobrole')
            ->join('gw_master_department','gw_master_department.id','=','users.section_id')
            ->join('gw_master_designation','gw_master_designation.id','=','users.designation_id')
            ->join('roles','roles.id','=','users.role_id')
            //->groupby('gw_master_employee.section_id')
            ->get();

        $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/EmployeeDetsilsList.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'USERNAME' => $table['username'],
                'EMP CODE' => $table['emp_code'],                       
                'DEPARTMENT' => $table['dept_name'],
                'DESIGNATION' => $table['desg_name'],
                'ROLE' => $table['jobrole'],
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);    


    }

    public function employeeDetailsGetTable(Request $request)
    {
        //$table = User::select('*')->get();
        $table = User::select('users.*','users.name as username','gw_master_department.name as dept_name','gw_master_designation.designation as desg_name','roles.name as jobrole')
            ->join('gw_master_department','gw_master_department.id','=','users.section_id')
            ->join('gw_master_designation','gw_master_designation.id','=','users.designation_id')
            ->join('roles','roles.id','=','users.role_id')
            //->groupby('gw_master_employee.section_id')
            ->get();


        // $table = MasterDesignation::select('*')->get();
        //$section=App\Helpers\UserHelper::section();



        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/employee-edit/' . $table->id) . '">Edit</a>
                                                             </div>
                            </div>';
               
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }


    //service depertment
    public function servicedepartment()



    {
        $masterdesignation=MasterDesignation::get();
        return view('admin.branchengineer.servicedepartment')
            ->with('masterdesignation','$masterdesignation');



    }
    public function insertservicedepartment(DepartmentRequest $request)
    {
        // $data = $request->input();
        // dd($data);
        $obj = new MasterEmployee();
        $obj->name = $request['name'];
        $obj->designation_id = $request['designation_id'];
        $obj->phone_no = $request['phone_no'];
        $obj->email = $request['email'];
        $obj->save();
        return redirect('admin/fetchservicedepartment');


    }



    public function fetchservicedepartment()
    {


        return view('admin.branchengineer.servicedepartmentlisting');


    }

    public function fetchdepartment(Request $request)
    {
        $table = MasterEmployee::select('*')->get();




        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/servicedepartment/' ) . '">ADD</a>
                                 <a class="dropdown-item" href="' . url('#') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">EDIT</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function editservicedepartment($id)
    {
        $deptemployee =  MasterEmployee::find($id);
        return view('admin.branchengineer.editservicedepartment')
            ->with('deptemployee',$deptemployee);



    }

//masterdatascreen

    //other component
    public function othercompAdd()
    {
        $data=session::all();

        $deptname = MasterDepartment::select('gw_master_department.id','gw_master_department.name')->get();
        $modelno=MasterMCModel::select('gw_master_mc_model.id','gw_master_mc_model.model_no')->get();


        return view ('admin.superadmin.masterdatascreen.addothercomponent')

            ->with('deptname',$deptname)

            ->with('modelno',$modelno);

    }

    public function othercompAddSave(Request $request)
    {

        $data = $request->input();



        $obj = new MasterPartOthercomponentBasicEngine();

        $obj->dept_id=$request['dept_id'];
        $obj->model_id=$request['model_id'];

        $obj->header=$request['header'];
        $obj->basic_engine=$request['basic_engine'];

        $obj->save();


        return redirect('admin/fetch-othercomponent');
    }

    public function othercompEdit($id) {

        $data=session::all();

        $errors =  MasterPartOthercomponentBasicEngine::find($id);

        $dept = MasterDepartment::select('*')->get();


        $modelno=MasterMCModel::select('gw_master_mc_model.id','gw_master_mc_model.model_no')->get();

        return view('admin.superadmin.masterdatascreen.editothercomponent')

            ->with('dept',$dept)

            ->with('modelno',$modelno)
            ->with('errors',$errors);
    }

    public function othercompEditSave(Request $request)
    {
        $data = $request->input();

        $obj = MasterPartOthercomponentBasicEngine::find($request['id']);



        $obj->dept_id=$request['dept_id'];
        $obj->model_id=$request['model_id'];

        $obj->header=$request['header'];
        $obj->basic_engine=$request['basic_engine'];

        $obj->save();


        return redirect('admin/fetch-othercomponent');

    }

    public function fetchothercomponent()
    {

        return view('admin.superadmin.masterdatascreen.listothercomponent');

    }

    public function fetchothercomponentTableDownload(){

        $table = MasterPartOthercomponentBasicEngine::Select('gw_parts_othercomponent_basic_engine.*', 'gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')

            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_parts_othercomponent_basic_engine.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_parts_othercomponent_basic_engine.model_id')

            ->get();

            $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/FetchOthercomponent.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'DEPARTMENT' => $table['Dept'],
                'MODEL' => $table['Model'],                       
                'HEADER' => $table['header'],                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);



    }

    public function fetchothercomponentTable(Request $request)
    {
        $table = MasterPartOthercomponentBasicEngine::Select('gw_parts_othercomponent_basic_engine.*', 'gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')

            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_parts_othercomponent_basic_engine.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_parts_othercomponent_basic_engine.model_id')

            ->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/othercomp-edit/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/othercomponent-delete/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">Delete</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function deleteothercomponent($user_id)
    {
        $machinetask = MasterPartOthercomponentBasicEngine::find($user_id);


        $machinetask->delete();

        return redirect('admin/fetch-othercomponent');
    }

    //component inspection

    public function compinspAdd()
    {
        $data=session::all();

        $deptname = MasterDepartment::select('gw_master_department.id','gw_master_department.name')->get();
        $modelno=MasterMCModel::select('gw_master_mc_model.id','gw_master_mc_model.model_no')->get();


        return view ('admin.superadmin.masterdatascreen.addcompinsp')

            ->with('deptname',$deptname)

            ->with('modelno',$modelno);

    }

    public function compinspAddSave(Request $request)
    {

        $data = $request->input();



        $obj = new ComponentInspectionReport();

        $obj->dept_id=$request['dept_id'];
        $obj->model_id=$request['model_id'];

        $obj->header=$request['header'];
        $obj->transmission_hyd_control_gp=$request['transmission_hyd_control_gp'];

        $obj->save();


        return redirect('admin/fetch-compinsp');
    }

    public function compinspEdit($id) {

        $data=session::all();

        $errors =  ComponentInspectionReport::find($id);

        $dept = MasterDepartment::select('*')->get();


        $modelno=MasterMCModel::select('gw_master_mc_model.id','gw_master_mc_model.model_no')->get();

        return view('admin.superadmin.masterdatascreen.editcompinsp')

            ->with('dept',$dept)

            ->with('modelno',$modelno)
            ->with('errors',$errors);
    }

    public function compinspEditSave(Request $request)
    {
        $data = $request->input();

        $obj = ComponentInspectionReport::find($request['id']);



        $obj->dept_id=$request['dept_id'];
        $obj->model_id=$request['model_id'];

        $obj->header=$request['header'];
        $obj->transmission_hyd_control_gp=$request['transmission_hyd_control_gp'];

        $obj->save();


        return redirect('admin/fetch-compinsp');

    }

    public function fetchcompinsp()
    {

        return view('admin.superadmin.masterdatascreen.listcompinsp');

    }

    public function fetchcompinspTableDownload(){

        $table = ComponentInspectionReport::Select('gw_master_inspection.*', 'gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')

            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_master_inspection.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_inspection.model_id')

            ->get();


            $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/FetchCompinsp.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'DEPARTMENT' => $table['Dept'],
                'MODEL' => $table['Model'],                       
                'HEADER' => $table['header'],
                
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);


    }

    public function fetchcompinspTable(Request $request)
    {
        $table = ComponentInspectionReport::Select('gw_master_inspection.*', 'gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')

            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_master_inspection.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_inspection.model_id')

            ->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/compinsp-edit/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/compinsp-delete/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">Delete</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function deletcompinsp($user_id)
    {
        $machinetask = ComponentInspectionReport::find($user_id);


        $machinetask->delete();

        return redirect('admin/fetch-compinsp');
    }

    //transmission & tc

    public function transmissionAdd()
    {
        $data=session::all();

        $deptname = MasterDepartment::select('gw_master_department.id','gw_master_department.name')->get();
        $modelno=MasterMCModel::select('gw_master_mc_model.id','gw_master_mc_model.model_no')->get();


        return view ('admin.superadmin.masterdatascreen.addtransmission')

            ->with('deptname',$deptname)

            ->with('modelno',$modelno);

    }

    public function transmissionAddSave(Request $request)
    {

        $data = $request->input();



        $obj = new TransmissionComponentDetails();

        $obj->dept_id=$request['dept_id'];
        $obj->model_id=$request['model_id'];

        $obj->header=$request['header'];
        $obj->case_parts=$request['case_parts'];

        $obj->save();


        return redirect('admin/fetch-transmission');
    }

    public function transmissionEdit($id) {

        $data=session::all();

        $errors =  TransmissionComponentDetails::find($id);

        $dept = MasterDepartment::select('*')->get();


        $modelno=MasterMCModel::select('gw_master_mc_model.id','gw_master_mc_model.model_no')->get();

        return view('admin.superadmin.masterdatascreen.edittransmission')

            ->with('dept',$dept)

            ->with('modelno',$modelno)
            ->with('errors',$errors);
    }

    public function transmissionEditSave(Request $request)
    {
        $data = $request->input();

        $obj = TransmissionComponentDetails::find($request['id']);



        $obj->dept_id=$request['dept_id'];
        $obj->model_id=$request['model_id'];

        $obj->header=$request['header'];
        $obj->case_parts=$request['case_parts'];

        $obj->save();


        return redirect('admin/fetch-transmission');

    }

    public function fetchtransmission()
    {

        return view('admin.superadmin.masterdatascreen.listtransmission');

    }

    public function fetchtransmissionTableDownload(){

         $table = TransmissionComponentDetails::Select('gw_master_transmission_details.*', 'gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')

            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_master_transmission_details.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_transmission_details.model_id')

            ->get();

            $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/FetchTransmission.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'DEPARTMENT' => $table['Dept'],
                'MODEL' => $table['Model'],                       
                'HEADER' => $table['header'],
                
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);
    }

    public function fetchtransmissionTable(Request $request)
    {
        $table = TransmissionComponentDetails::Select('gw_master_transmission_details.*', 'gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')

            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_master_transmission_details.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_transmission_details.model_id')

            ->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/transmission-edit/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/transmission-delete/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">Delete</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function delettransmission($user_id)
    {
        $machinetask = TransmissionComponentDetails::find($user_id);


        $machinetask->delete();

        return redirect('admin/fetch-transmission');
    }

    //assembly checksheet

    public function assemblyAdd()
    {
        $data=session::all();

        $deptname = MasterDepartment::select('gw_master_department.id','gw_master_department.name')->get();
        $modelno=MasterMCModel::select('gw_master_mc_model.id','gw_master_mc_model.model_no')->get();


        return view ('admin.superadmin.masterdatascreen.addassembly')

            ->with('deptname',$deptname)

            ->with('modelno',$modelno);

    }

    public function assemblyAddSave(Request $request)
    {

        $data = $request->input();



        $obj = new EngineAssembly();

        $obj->dept_id=$request['dept_id'];
        $obj->model_id=$request['model_id'];

        $obj->header=$request['header'];
        $obj->operation_desp=$request['operation_desp'];
        $obj->specification=$request['specification'];

        $obj->save();


        return redirect('admin/fetch-assembly');
    }

    public function assemblyEdit($id) {

        $data=session::all();

        $errors =  EngineAssembly::find($id);

        $dept = MasterDepartment::select('*')->get();


        $modelno=MasterMCModel::select('gw_master_mc_model.id','gw_master_mc_model.model_no')->get();

        return view('admin.superadmin.masterdatascreen.editassembly')

            ->with('dept',$dept)

            ->with('modelno',$modelno)
            ->with('errors',$errors);
    }

    public function assemblyEditSave(Request $request)
    {
        $data = $request->input();

        $obj = EngineAssembly::find($request['id']);



        $obj->dept_id=$request['dept_id'];
        $obj->model_id=$request['model_id'];

        $obj->header=$request['header'];
        $obj->operation_desp=$request['operation_desp'];
        $obj->specification=$request['specification'];


        $obj->save();


        return redirect('admin/fetch-assembly');

    }

    public function fetchassembly()
    {

        return view('admin.superadmin.masterdatascreen.listassembly');

    }

    public function fetchassemblyTableDownload(){
        
        $table = EngineAssembly::Select('gw_master_assembly.*', 'gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')

            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_master_assembly.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_assembly.model_id')

            ->get();

            $style = (new StyleBuilder())
            ->setFontBold()
            ->build();
        $path = 'C:/Apache24/htdocs/gcpl-quality/template files/FetchAssembly.xlsx';

        (new FastExcel($table))->headerStyle($style)->export($path, function ($table) {
            return [
                'Sr No' => $table['id'],
                'DEPARTMENT' => $table['Dept'],
                'MODEL' => $table['Model'],                       
                'HEADER' => $table['header'],
                
                
            ];
        });
        $file = $path;
        $name = basename($file);
        return response()->download($file, $name);


    }

    public function fetchassemblyTable(Request $request)
    {
        $table = EngineAssembly::Select('gw_master_assembly.*', 'gw_master_department.name as Dept','gw_master_mc_model.model_no as Model')

            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_master_assembly.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_assembly.model_id')

            ->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/assembly-edit/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/assembly-delete/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">Delete</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function deletassembly($user_id)
    {
        $machinetask = EngineAssembly::find($user_id);


        $machinetask->delete();

        return redirect('admin/fetch-assembly');
    }

    public function checksheetcolumnlistingnew()
    {
        return view('admin.checksheet.listchecksheetcolumnnew');
    }

    public function fetchchecksheetcolumnnew(Request $request)
    {
        $table = ChecksheetSectionWiseColumnnew::select('gw_master_section_column_new.*','gw_master_department.name as Dept','gw_master_mc_model.model_no as Model','gw_master_checksheet_section.name as Section','checksheet_section_child.child_section as ChildSection','checksheet_subchild_section.sub_child_section as SubChildSection')
            ->leftjoin('gw_master_department','gw_master_department.id','=','gw_master_section_column_new.dept_id')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','gw_master_section_column_new.model_id')
            ->leftjoin('gw_master_checksheet_section','gw_master_checksheet_section.id','=','gw_master_section_column_new.section_id')
            ->leftjoin('checksheet_section_child','checksheet_section_child.id','=','gw_master_section_column_new.child_section_id')
            ->leftjoin('checksheet_subchild_section','checksheet_subchild_section.id','=','gw_master_section_column_new.sub_child_section_id')
            ->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {



                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/checksheetcolumn-edit-new/' . $table->id) . '">Edit</a>
                                <a href="' . url('admin/checksheetcolumn-delete-new/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="dropdown-item">Delete</a>
                                                             </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function checksheetcolumnAddnew()
    {
        return view('admin.checksheet.addchecksheetcolumnnew');


    }

    public function checksheetcolumnAddSavenew(Request $request)
    {

    //$data = $request->input();

            // print_r($request);die();
            //$obj1 = new ChecksheetColumnStore();
            $obj1 = new ChecksheetSectionWiseColumnnew(); //remove comment and change columnSectionShow function's table name to ChecksheetColumnStore

            $obj1->dept_id = $request['dept_id'];
            $obj1->model_id = $request['model_id'];
            $obj1->section_id=$request['section_id'];
            if($request['child_section_id']==''){
                $obj1->child_section_id='';
            }else{
                $obj1->child_section_id=$request['child_section_id'];
            }
            if($request['sub_child_section_id']==''){
                $obj1->sub_child_section_id='';
            }else{
                $obj1->sub_child_section_id=$request['sub_child_section_id'];
            }
        //dd($obj1->section_id);
        if(!empty($request['columnSection'])){
            $obj1->column_id = implode(',',$request['columnSection']);
        }
        else{
            $obj1->column_id = Null;
        }


        $obj1->no_of_row_column = $request['no_of_row_column'];
        
       //dd($obj1->section_id);
            $obj1->save();



        return redirect('admin/checksheetcolumn-listing-new');

    }

    public function columnSectionShowNew(Request $request)
    {

        $columnSelection = '';
        // print_r($request['columnchksht']);
        $checkshtchildArr = $request['columnchksht'];
        // echo "string";die();
        $i = 0;
        // foreach($request['columnchksht'] as $columnchksht){
        foreach($checkshtchildArr as $columnchksht){
            //
            // echo "string1";die();
            // foreach(explode(',', $request->columnchksht) as $columnchksht){

            $compdet = UserHelper::columnforchecksheetnew($columnchksht);

            // print_r($compdet);die();
            // echo "string";die();
            if (!isset($compdet->section_id)) {
                // echo "<pre>";print_r($compdet[0]['column_id']);echo "<br>";exit;
                foreach ($compdet as $key => $value) {

                    $columnSelection .= '<div class="custom-control form-control-lg custom-checkbox">
                                            <input type="checkbox"  name="columnSection[]" value="'.$value['column_id'].'" class="custom-control-input mainsection" id="columnSection'.$i.'">
                                            
                                            <label class="custom-control-label" for="columnSection'.$i.'">'.$value['column_name'].'</label></div>';

                    $i++;


                }

            }
        }




        echo $columnSelection ;

    }

    public function checksheetcolumnEditnew($id) {

        $errors = ChecksheetSectionWiseColumnnew::find($id);


        return view('admin.checksheet.editchecksheetcolumnnew')
            ->with('errors',$errors);
    }

    public function checksheetcolumnEditSavenew(Request $request)
    {
        // $data = $request->input();
       // dd($request['no_of_row_column']);

        $obj = ChecksheetSectionWiseColumnnew::find($request['id']);
        //$obj = new ModelWiseCheecksheet();
        // $obj->dept_id = $request['dept_id'];
        // $obj->model_id = $request['model_id'];
        // $obj->section_id=$request['section_id'];

        if(!empty($request['columnSection'])){
            $obj->column_id = implode(',',$request['columnSection']);
        }else {
            $obj->column_id = NULL;
        }

        $obj->no_of_row_column = $request['no_of_row_column'];

        $obj->save();

        return redirect('admin/checksheetcolumn-listing-new');

    }

    public function checksheetcolumnDeletenew($user_id)
    {
        $blog = ChecksheetSectionWiseColumnnew::find($user_id);


        $blog->delete();

        return redirect('admin/checksheetcolumn-listing-new');
    }

    public function GetSectionForColumnNew(Request $request)
    {
        $sect=UserHelper::sectionforcolumnnew($request['dept_id'],$request['model_id']);
        // print_r($sect);die();
        $section_html = '<option value="">Select Section</option>';

        foreach ($sect as $sect_one) {
            $section_html .= '<option value='.$sect_one->id.'>'.$sect_one->name.'</option>';            
        }

        return $section_html;
    }

    public function GetChildSectionForColumnNew(Request $request)
    {
        $sect=UserHelper::childsectionforcolumnnew($request['dept_id'],$request['model_id']);
        // print_r($sect);die();
        $section_html = '<option value="">Select Section</option>';

        foreach ($sect as $sect_one) {
            $section_html .= '<option value='.$sect_one->id.'>'.$sect_one->child_section.'</option>';            
        }

        return $section_html;
    }


    public function GetSubChildSectionForColumnNew(Request $request)
    {
        $sect=UserHelper::subchildsectionforcolumnnew($request['dept_id'],$request['model_id']);
        // print_r($sect);die();
        $section_html = '<option value="">Select Section</option>';

        foreach ($sect as $sect_one) {
            $section_html .= '<option value='.$sect_one->id.'>'.$sect_one->sub_child_section.'</option>';            
        }

        return $section_html;
    }        


}
