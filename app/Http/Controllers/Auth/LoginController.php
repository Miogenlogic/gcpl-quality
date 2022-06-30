<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Mail;
use Session;
use Redirect;
use Alert;
//use Input;
use Eloquent;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }


    public function index() {

        $user = Auth::user();
        //$id = Auth::id();
        //return $id;

        if(!isset($user->id)){
            return view('auth.login');
            exit;
        }

        if($user->hasRole(['engineer','section_head','super_admin'])){
            $user_session=[ 'user_id'=>$user->id,'username'=>$user->username,'email'=>$user->email, 'user_type'=>$user->user_type];

            Session::put('user',$user_session);

            return redirect('/admin/branch-dashboard');
        }else{
            Session::flush();
            return redirect('/');
        }

        /*if(!isset($user->user_type)){
            return view('auth.login');
            exit;
        }
        if($user->hasRole(['admin','patient','doctor'])){
            $userDetails = UserDetails::where('user_id','=',$user->id)->get()->first();
            //dd($userDetails);die;
            // $doctorDetails = DoctorDetails::where('user_id','=',$user->id)->get()->first();
            //dd($doctorDetails);die;
            $user_session=[ 'user_id'=>$user->id,'name'=>$userDetails->name,'username'=>$user->username,'email'=>$user->email, 'user_type'=>$user->user_type];
            Session::put('user',$user_session);

            return redirect('/admin/admin-dashboard');
        }else{
            //Session::flush();
            //return redirect('/');
        }*/

        /*
               if($user->hasRole(['admin', 'doctor', 'clinic_attendant', 'pharmacy_admin', 'pharmacy_attendant'])){
                    $userDetails = UserDetails::where('user_id','=',$user->id)->get()->first();
                    $user_session=[ 'user_id'=>$user->id,'name'=>$userDetails->name,'username'=>$user->username,'email'=>$user->email, 'company'=>$user->company_id, 'user_type'=>$user->user_type ];
                    Session::put('user',$user_session);
                    return redirect('/client/doctor');
                }elseif($user->hasRole('patient')){
                   $userDetails = UserDetails::where('user_id','=',$user->id)->get()->first();
                   $user_session=[ 'user_id'=>$user->id,'name'=>$userDetails->name,'username'=>$user->username,'email'=>$user->email, 'company'=>$user->company_id, 'user_type'=>$user->user_type ];
                   Session::put('user',$user_session);
               }else{
                   //Session::flush();
                   //return redirect('/');
               }*/

    }

    public function checklogin(Request $request)
    {



        $field = filter_var($request['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$field =>$request['username'],'section_id' => $request['section_id'],'location_id' => $request['location_id'], 'password' => $request['password'],'status'=>'Active'];

//echo"<pre>";
        //	print_r($credentials);
        //exit();
        //echo"<pre>";
        //print_r($request['username']);
        //exit();

        //$loginrequest = User::find($id);
        //$login = User::select('users.section_id','users.jobrole_id')
        //->where('users.email','=',$request['username'])
        //->where('users.password','=',$request['password'])->get()->toArray();






        if (Auth::attempt($credentials,$request->has('remember_me'))) {

            $user = Auth::user();
//dd($user);
            $user_session=[ 'user_id'=>$user->id,'username'=>$user->name,'email'=>$user->email, 'user_type'=>$user->user_type,'section_id'=>$user->section_id,'location_id'=>$user->location_id,'emp_code' =>$user->emp_code,'role_id' =>$user->role_id, 'designation_id'=>$user->designation_id ];
            Session::put('user',$user_session);
           //dd($user_session);die;
            /*echo"<pre>";
            print_r($user);
            exit();*/

            //echo"<pre>";
            //print_r($user);
            //exit();

            if($user['section_id']=='1'){
                return redirect('/admin/branch-dashboard');
            }
            elseif($user['section_id']=='2'){
                return redirect('/admin/support-quotation-list');
            }
            elseif($user['section_id']=='3'){
                return redirect('/admin/receiving-dashboard');
            }
            elseif($user['section_id']=='4'){
//                return redirect('/admin/engine-dashboard');
                return redirect('/admin/engine-diss-list');
            }
            elseif($user['section_id']=='5'){
//                return redirect('/admin/trans-dashboard');
                return redirect('/admin/trans-diss-list');
            }
            elseif($user['section_id']=='6'){
//                return redirect('/admin/mor-dashboard');
                return redirect('/admin/mor-diss-list');
            }
            elseif($user['section_id']=='7'){
//                return redirect('/admin/undercarg-dashboard');
                return redirect('/admin/undercarg-diss-list');
            }
            elseif($user['section_id']=='8'){
                return redirect('/admin/spc-dashboard');
            }
            elseif($user['section_id']=='9'){
                return redirect('/admin/store-list');
            }
            elseif($user['section_id']=='10'){
                // return redirect('/admin/engine-dashboard');
                return redirect('/admin/engine-ass-list');
            }
            elseif($user['section_id']=='11'){
                // return redirect('/admin/trans-dashboard');
                return redirect('/admin/trans-ass-list');
            }
            elseif($user['section_id']=='12'){
                // return redirect('/admin/hyd-dashboard');
                return redirect('/admin/hyd-ass-list');
            }
            elseif($user['section_id']=='13'){
//                return redirect('/admin/hyd-dashboard');
                return redirect('/admin/hyd-diss-list');
            }
            elseif($user['section_id']=='14'){
//                return redirect('/admin/mor-dashboard');
                return redirect('/admin/mor-ass-list');
            }
            elseif($user['section_id']=='15'){
//                return redirect('/admin/undercarg-dashboard');
                return redirect('/admin/undercarg-ass-list');
            }
            elseif($user['section_id']=='20'){
                return redirect('/admin/super-admin-dashboard');
            }
            elseif($user['section_id']=='21'){
                return redirect('/admin/servicedashboard-checkgatefour');
            }
            elseif($user['section_id']=='22'){
                return redirect('/admin/servicedashboard-pdilist');
            }
            elseif($user['section_id']=='23'){
                return redirect('/admin/departmental-dashboard');
            }
            elseif($user['section_id']=='24'){
                return redirect('/admin/super-admin-dashboard');
            }
            elseif($user['section_id']=='25'){
//                return redirect('/admin/trans-dashboard');
                return redirect('/admin/engine-diss-list');
            }
             elseif($user['section_id']=='26'){
                // return redirect('/admin/engine-dashboard');
                return redirect('/admin/engine-ass-list');
            }
            
            //if($user['role_id']=='1' && $user['section_id']==''



            /*if($user['role_id']=='1' )
            {

             //  return view('/admin/branch-dashboard')
             return redirect('/admin/branch-dashboard');
                        //->with('user',$user);
             // return redirect('/admin/branch-dashboard');
             }


              /* elseif($user->hasRole('super_admin')){
                return redirect('/admin/super-admin-dashboard');
            }

            elseif ($user->hasRole('crc_head')){
                return redirect('/admin/crc-head-dashboard');

            }
            elseif ($user->hasRole('spc')){
                return redirect('/admin/spc-dashboard');

            }elseif ($user->hasRole('section_supervisor')){
               return redirect('/admin/section-supervisor-dashboard');

           }elseif ($user->hasRole('section_engineer')){
               return redirect('/admin/section-engineer-dashboard');

           }elseif ($user->hasRole('qa_qc')){
               return redirect('/admin/qaqc-dashboard');

           }elseif ($user->hasRole('planning_supervisor')){
               return redirect('/admin/planning-supervisor-dashboard');

           }elseif ($user->hasRole('store_manager')){
               return redirect('/admin/store-manager-dashboard');

           }elseif ($user->hasRole('receiving')){
               return redirect('/admin/receiving-dashboard');

           }
           elseif ($user->hasRole('service_engineer')){
               return redirect('/admin/service-engineer-dashboard');

           }
            elseif ($user->hasRole('despatch_manager')){
                return redirect('/admin/despatch-manager-dashboard');

            }
           elseif ($user->hasRole('dept_eng')){
               return redirect('/admin/engine-dashboard');

           }
           elseif ($user->hasRole('dept_eng_disassembly')){
               return redirect('/admin/engine-dashboard');

           }
           elseif ($user->hasRole('dept_eng_assembly')){
               return redirect('/admin/engine-dashboard');

           }
           elseif ($user->hasRole('dept_trans')){
               return redirect('/admin/trans-dashboard');

           }
           elseif ($user->hasRole('dept_trans_assembly')){
               return redirect('/admin/trans-dashboard');

           }
           elseif ($user->hasRole('dept_trans_disassembly')){
               return redirect('/admin/trans-dashboard');

           }
           elseif ($user->hasRole('dept_hyd')){
               return redirect('/admin/hyd-dashboard');

           }
           elseif ($user->hasRole('dept_hyd_assembly')){
               return redirect('/admin/hyd-dashboard');

           }
           elseif ($user->hasRole('dept_hyd_disassembly')){
               return redirect('/admin/hyd-dashboard');

           }
           elseif ($user->hasRole('dept_mor')){
               return redirect('/admin/mor-dashboard');

           }
           elseif ($user->hasRole('dept_mor_asembly')){
               return redirect('/admin/mor-dashboard');

           }
           elseif ($user->hasRole('dept_mor_disasembly')){
               return redirect('/admin/mor-dashboard');

           }
           elseif ($user->hasRole('dept_undercarriage')){
               return redirect('/admin/undercarg-dashboard');

           }
           elseif ($user->hasRole('dept_undercarriage_assembly')){
               return redirect('/admin/undercarg-dashboard');

           }
           elseif ($user->hasRole('dept_undercarriage_disassembly')){
               return redirect('/admin/undercarg-dashboard');

           }
           elseif ($user->hasRole('support')){
               return redirect('/admin/support-dashboard');

           }
            elseif ($user->hasRole('eng_head')){
               return redirect('/admin/eng-head-dashboard');

           }*/
            /*else{
                $request->session()->flush();
                return redirect('/');
            }*/
            else{
//            echo 'string';exit;
//            $request->session()->flush('Not valid User');
//            return redirect('/');
                $validation = 'Please enter correct Details';
                return view('auth.login')
                    ->with('validation',$validation);

            }

        }
        else{
//            echo 'string';exit;
//            $request->session()->flush('Not valid User');
//            return redirect('/');
            $validation = 'Please enter correct Details';
            return view('auth.login')
                ->with('validation',$validation);

        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }



    public function registration(){

        //echo 'hii';die;

        return view('auth.registration');
    }

    public function registerStore(Request $request){

        $obj =new User();
        $obj->username = $request['username'];
        $obj->email = $request['email'];
        $obj->password=Hash::make($request['password']);

        $obj->save();


        return redirect('/');
    }


   //forgot password
    public function forgotPassword(){

        //echo 'hii';die;

        return view('auth.forgotpassword');
    }

    public function forgotPasswordSave(Request $request){


        $obj = User::where('email', '=', $request['email'])->get()->first();

       //dd($obj);
        if (!empty($obj->email)) {
            //$obj = new User();
            //$obj->email = $request['email'];
            $obj->password = '$2y$10$7svNTkrCL1vB.FpqYsShUe9Z04nZsjuMyK5WM6vU2QDxnuRZkLBrm';
            $obj->save();

            $url = url('/');

            $data=['subject'=>'Forgot Password Mail','email'=>$request['email'],'url'=>$url];


            Mail::send('admin.mail.forgotPasswordMail', $data, function($message) use ($data) {

                $message->to($data['email'])->subject($data['subject']);
                //dd($message);
                $message->from(env('service_mail'),'QMS');
                //$message->from(\Config::get('env.service_mail'),'loyalty@gainwellindia.com');
            });

            //return redirect('/')
            return view('auth.login')
                ->with('validation',"Please Check Email For Password!");

        }else{

           // return redirect('/forgot-password')
            return view('auth.forgotpassword')
                ->with('message',"Email does not exist");
        }



    }
}
