<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Validator;
use Auth;
use Log;
use Session;

class LoginController extends Controller
{
    //For login page
    public function index(){
        //Check admin is login or not
        if (!empty(Session::get('adminId'))) {
            return redirect('admin/dashboard');
        }

        return view('backend.index');
    }

    //For login submit
    public function loginSubmit(Request $request){
        try{
            //--- Validation Section Start
            $rules = [
                'email'   => 'required|email',
                'password' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
        
            if ($validator->fails()) {
                $result = [
                    'status'    => 'false',
                    'errortrue' => '',
                    'message'   => $validator->errors()
                ];
                return response()->json($result);
            }
            //--- Validation Section Ends

            
            $userDetail = Admin::where('email', $request->email)
            ->Where('password', md5($request->password))
            ->first();
            if (!empty($userDetail)) { 
                if(($userDetail->status=='0') && ($userDetail->is_deleted=='0')){
                    $message = 'Your accout is inactive.';
                }else if(($userDetail->status=='1') && ($userDetail->is_deleted=='1')){
                    $message = 'User does not exist. Please try again...!!!';
                }else{
                    session(['adminId' => $userDetail->id,'adminName' => $userDetail->name]);

                    return response()->json(route('admin.dashboard'));
                }
            }else{
                Auth::logout();
                $message = 'Incorrect username/password. Please try again...!!!';
            }

            // if unsuccessful, then redirect back to the login with the form data
            $result = [
                'status'    => 'false',
                'errortrue' => '',
                'message'   => !empty($message)?$message:''
            ];
            return response()->json($result);
        } catch (Throwable $e) {
            Log::info($e->getMessage());
        }
    }

}
