<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Crypt;
use App\Providers\HelperServiceProvider;
class DashboardController extends Controller
{

    public function branchDashboard()
    {

        return view('admin.dashboard.branchDashboard');
    }

    public function superAdminDashboard()
    {

        return view('admin.dashboard.superAdminDashboard');
    }
    public function crcHeadDashboard()
    {

        return view('admin.dashboard.crcheadDashboard');
    }
    public function spcDashboard()
    {

        return view('admin.dashboard.spcDashboard');
    }
    public function sectionSupervisorDashboard()
    {

        return view('admin.dashboard.sectionSupervisorDashboard');
    }
    public function sectionEngineerDashboard()
    {

        return view('admin.dashboard.sectionEngineerDashboard');
    }
    public function despatchDashboard()
    {

        return view('admin.dashboard.despatchManagerDashboard');
    }
    public function planningSupervisorDashboard()
    {

        return view('admin.dashboard.planningSupervisorDashboard');
    }
    public function storeManagerDashboard()
    {

        return view('admin.dashboard.storeManagerDashboard');
    }
    public function despatchManagerDashboard()
    {

        return view('admin.dashboard.despatchManagerDashboard');
    }


    public function receivingDashboard()
    {

        return view('admin.dashboard.receivingDashboard');
    }
    public function serviceEngineerDashboard()
    {

        return view('admin.dashboard.serviceEngineerDashboard');
    }

    public function engineDashboard()
    {

        return view('admin.dashboard.engineDashboard');

    }

    public function transDashboard()
    {

        return view('admin.dashboard.transDashboard');
    }
    public function hydDashboard()
    {

        return view('admin.dashboard.hydDashboard');
    }

    public function morDashboard()
    {

        return view('admin.dashboard.morDashboard');
    }
    public function undercargDashboard()
    {

        return view('admin.dashboard.undercarrigeDashboard');
    }
    public function supportDashboard()
    {

        return view('admin.dashboard.supportDashboard');
    }

    public function engHeadDashboard()
    {

        return view('admin.dashboard.engHeadDashboard');
    }
     public function qaqcDashboard()
    {

        return view('admin.dashboard.qaqcDashboard');
    }

    public function departmentalDashboard()
    {

        return view('admin.dashboard.departmentalDashboard');
    }

}
