<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\MasterMachineModelNo;


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




use App\Http\Requests\MachinemodelRequest;
class MasterMachineModelController extends Controller
{

public function showmachinemodel()
{
    return view('admin.dashboard.machinemodelno');
}
    public function insertdata(MachinemodelRequest $request)
    {
        // $data = $request->input();
        // dd($data);
        $obj = new MasterMachineModelNo();
        $obj->model_no = $request['model_no'];
        $obj->save();
        return redirect('admin/fetchmachinemodel');

    }
    public function fetchmachinemodel()
    {

        return view('admin.dashboard.fetchmachinemodel');


    }


    public function fetchmodelGetTable(Request $request)
    {
        $table = MasterMachineModelNo::select('*')->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/model-save/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/machinemodel-delete/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);
    }
    public function fetchserialno($id) {

        $errors = MasterMachineModelNo::find($id);


        return view('admin.branchengineer.editmodelMachineRequest')
            ->with('errors',$errors);
    }
    public function updatemachinemodel(Request $request)
    {

        $obj = MasterMachineModelNo::find($request['id']);

        $obj->model_no=$request['model_no'];
        $obj->save();
        return redirect('admin/fetchmachinemodel');


    }
    public function machinemodelDelete($user_id)
    {
        $blog =  MasterMachineModelNo::find($user_id);


        $blog->delete();

        return redirect('admin/fetchmachinemodel');
    }
}
