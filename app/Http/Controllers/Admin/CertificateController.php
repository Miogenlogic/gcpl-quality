<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
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
use pdf;
use Illuminate\Support\Facades\Crypt;
use App\Providers\HelperServiceProvider;
class CertificateController extends Controller
{

    public function listCertificate()
    {

        return view('admin.certificate.listCertificate');
    }

    public function engineCertificate($id)
    {
        $certificate = Service::find($id);
        $serial_no = Service::select('gw_master_mc_serial_number.*')
            ->leftjoin('gw_master_mc_serial_number','gw_master_mc_serial_number.id','=','service_request.machine_serialno')
            ->where('service_request.id', '=' ,$id)->get();

        $model = Service::select('gw_master_mc_model.*')
            ->leftjoin('gw_master_mc_model','gw_master_mc_model.id','=','service_request.machine_modelno')
            ->where('service_request.id', '=' ,$id)->get();

//        $smu = Service::select('service_request.*','gw_master_aggregate.component_smu')
//            ->leftjoin('gw_master_aggregate','gw_master_aggregate.service_request_id','=','service_request.id')
//            ->where('service_request.id', '=' ,$id)->get();

//        dd($model);
        return view('admin.certificate.engineCertificate')
            ->with('certificate',$certificate)
            ->with('serial_no',$serial_no)
            ->with('model',$model);
//            ->with('smu',$smu);
    }

//    public function downloadCertificate(Request $request)
//    {
//        $certificatedownload= Service::find($request['id']);
//        $file='public/assets/uploads/quotationupload/';
//        $pathToFile=$file."/".$certificatedownload->quotation;
//        return Response::download($pathToFile);
//
//    }
    public function downloadCertificate(Request $request)
    {
        $items = DB::table("items")->get();
        view()->share('items',$items);


        if($request->has('download')){
            $pdf = PDF::loadView('pdfview');
            return $pdf->download('pdfview.pdf');
        }


        return view('pdfview');
    }

    public function getTableCertificate(Request $request)
    {
        $data = Session::all();
        $location=$data['user']['location_id'];

        $table = Service::select('*')
            ->where('pdi_status','=','Approved')
            ->get();

        $datatables =  Datatables::of($table)

            ->addColumn('action', function ($table) {
                
                if (request()->session()->get('user')['section_id'] == '22') {
                    $btns = ' <div class="dropdown">
                                             <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                 <i class="fas fa-ellipsis-v"></i>
                                             </a>
                                             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                 <a class="dropdown-item" href="#">Download Certificate</a>
                                             </div>
                                         </div>';

                }
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

}
