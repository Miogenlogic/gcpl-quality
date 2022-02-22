<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\MasterComponentSerialNo;


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




use App\Http\Requests\SerialRequest;
class MasterComponentSerialController extends Controller
{
    public function showcomponentserial()
    {
        return view('admin.dashboard.branchserialno');


    }

    public function insertdata(SerialRequest $request)
    {
        // $data = $request->input();
        // dd($data);
        $obj = new MasterComponentSerialNo();
        $obj->serial_no = $request['serial_no'];
        $obj->save();
        return redirect('admin/fetchserial');

    }
    public function fetchserial()
    {
        return view('admin.dashboard.fetchserial');
    }
    public function fetchserialGetTable(Request $request)
    {

            $table = MasterComponentSerialNo::select('*')->get();

            $datatables = Datatables::of($table)
                ->addColumn('action', function ($table) {
                    $btns = ' <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="' . url('admin/serial-save/' . $table->id) . '">Edit</a>
                                 <a class="dropdown-item" href="' . url('admin/serial-delete/') . "/". "$table->id" . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>                              </div>
                            </div>';
                    // $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                    return $btns;
                })
                ->rawColumns(['action']);


            return $datatables->make(true);

    }
    public function fetchserialno($id) {

        $errors = MasterComponentSerialNo::find($id);


        return view('admin.branchengineer.editserialRequest')
            ->with('errors',$errors);
    }
    public function serialupdate(Request $request)
    {
        $obj = MasterComponentSerialNo::find($request['id']);

        $obj->serial_no=$request['serial_no'];
        $obj->save();
        return redirect('admin/fetchserial');
    }
    public function serialdelete($user_id)
    {
        $blog = MasterComponentSerialNo::find($user_id);


        $blog->delete();

        return redirect('admin/fetchserial');
    }

}
