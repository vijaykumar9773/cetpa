<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Session;
use Validator;
use Throwable;
use Log;
use App\Traits\Commontrait;

class UsersController extends Controller
{
    use Commontrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //Check admin is login or not
        $this->checkAdminLogin();

        $adminName = $this->getAdminName();

        $userList = User::getUserList();

        return view('backend.users.manage_users',compact('userList','adminName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Check admin is login or not
        if (empty(Session::get('adminId'))) {
            return redirect('admin/login');
        }

        $adminName = Session::get('adminName');

        return view('backend.users.create_user',compact('adminName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            //--- Validation Section Start
            $rules = [
                'name'    => 'required',
                'email'   => 'required|email|unique:users',
                'password' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
        
            if ($validator->fails()) {
                $result = [
                    'status'    => 'false',
                    'errortrue' => true,
                    'message'   => $validator->errors()
                ];
                return response()->json($result);
            }
            //--- Validation Section Ends

            $data = [
                'name' => $request->name ?? '',
                'email' => $request->email ?? '',
                'password' => bcrypt($request->password),
                'created_at' => date('Y-m-d H:i:s')
            ];
        
            $user = User::storeUsers($data);
            
            if($user){
                $status = true;
                $errortrue = '';
                $message = 'User created successfully';
            }else{
                $status = 'false';
                $errortrue = '';
                $message = 'Unable to create user. Please try again...!!!';
            }

            $result = [
                'status' => $status ?? '',
                'errortrue' => $errortrue ?? '',
                'message' => $message ?? ''
            ];
            return response()->json($result);

        } catch (Throwable $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id=0)
    {
        try{
        
            //Check admin is login or not
            if (empty(Session::get('adminId'))) {
                return redirect('admin/login');
            }

            $adminName = Session::get('adminName');

            //Get user detail
            $userDetail = User::getUserDetail($id);

            return view('backend.users.view_user',compact('adminName','userDetail'));
        } catch (Throwable $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //Check admin is login or not
        if (empty(Session::get('adminId'))) {
            return redirect('admin/login');
        }

        $adminName = Session::get('adminName');

        //Get user detail
        $userDetail = User::getUserDetail($id);

        return view('backend.users.create_user',compact('adminName','userDetail','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try{
            //--- Validation Section Start
            $rules = [
                'name'    => 'required'
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
            #exit($request->name);
            $data = [
                'name' => isset($request->name)?$request->name:'',
                'updated_at' => date('Y-m-d H:i:s')
            ];
            #echo '<pre>';print_r($data);exit;
            $user = User::updateUserByID($id,$data);
            
            if($user){
                $status = true;
                $errortrue = '';
                $message = 'User updated successfully';
            }else{
                $status = 'false';
                $errortrue = '';
                $message = 'Unable to update user. Please try again...!!!';
            }

            $result = [
                'status' => $status ?? '',
                'errortrue' => $errortrue ?? '',
                'message' => $message ?? ''
            ];
            return response()->json($result);

        } catch (Throwable $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id=0)
    {
        try{
            //Delete user
            $data = ['is_deleted'=>1];
            $delete = User::updateUserByID($id,$data);
           
            if ($delete) {
                return redirect("admin/users")
                ->with('success', 'User deleted successfully');
            } else {
                return redirect("admin/users")
                ->withErrors('Unable to delete user. Please try again...!!!');
            }
        } catch (Exception $ex) {
            return Redirect::back()->withErrors(['message', 'OOPs...Something went wrong!' ]);
        }
    }

    /**
     * Change customer status
     *
     * @param CustomersController $request comment about this variable
     *
     * @return int
     */
    public function changeStatus(Request $request){
        try{
            $id     = !empty($request->id)?$request->id:'';
            $status_value = !empty($request->status_value)?$request->status_value:'0';

            //Get user detail by user id
            $userDetail = User::getUserDetail($id);

            /*if($userDetail->is_deleted=='1'){
                $is_deleted = '0';
            }else{
                $is_deleted = '1';
            }*/

            $data   = [
                'status' => $status_value,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            //Update customer status
            $update = User::updateUserByID($id, $data);
            
            $status = 'false';
            $message = 'Unable to change user status. Please try again...!!!';
            if ($update) {
                $status = true;
                $message = 'User enabled successfully.';
                if(!$status_value)
                    $message = 'User disabled successfully.';
            }
            $result = [
                'status' => !empty($status)?$status:'',
                'message' => !empty($message)?$message:''
            ];
            return response()->json($result);
        } catch (Throwable $e) {
            Log::info($e->getMessage());
        }
    }
}
