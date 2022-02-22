<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterMachineSerialNo;


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




use App\Http\Requests\MachineSerialRequest;
class MasterMachineSerialController extends Controller
{
    public function showmachineserial()
    {
        return view('admin.dashboard.machineserialno');
    }
    public function insertmachineserial(MachineSerialRequest $request)
    {
        $obj = new MasterMachineSerialNo();
        $obj->serial_no = $request['serial_no'];
        $obj->save();
        return redirect('admin/fetch-machine-serial');

    }
    public function fetchmachineserial()
    {
        return view('admin.dashboard.fetchmachineserial');
    }
    public function fetchmachineserialgettable(Request $request)
    {

        $table = MasterMachineSerialNo::select('*')->get();

        $datatables = Datatables::of($table)
            ->addColumn('action', function ($table) {
                $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/machine-serial-save/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/machine-serial-delete/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>                              </div>
                            </div>';
                // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);


        return $datatables->make(true);

    }
    public function fetchmachineserialno($id) {

        $errors = MasterMachineSerialNo::find($id);


        return view('admin.branchengineer.editmachineSerial')
            ->with('errors',$errors);
    }
    public function serialupdate(Request $request)
    {
        $obj = MasterMachineSerialNo::find($request['id']);

        $obj->serial_no=$request['serial_no'];
        $obj->save();
        return redirect('admin/fetch-machine-serial');
    }
    public function machineserialdelete($user_id)
    {
        $blog = MasterMachineSerialNo::find($user_id);


        $blog->delete();

        return redirect('admin/fetch-machine-serial');
    }
}
