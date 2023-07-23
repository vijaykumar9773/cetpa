<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserAPIController extends Controller
{
    //Get user list
    public function getUserList(){
        try{
            $userLists = User::getUserList();
            $users = [];
            if(!empty($userLists)){
                foreach($userLists as $user){
                    $users[] = [
                        'name' => $user->name ?? '',
                        'email' => $user->email ?? '',
                        'status' => $user->status ?? '',
                        'is_deleted' => $user->is_deleted ?? '',
                        'created_at' => $user->created_at ? date($user->created_at) : '',
                        'updated_at' => $user->updated_at ?? '',
                    ];
                }
            }
            return $this->sendResponse($users,'User list retrieved successfully.');
        }catch (\Exception $e) {
            return $this->sendError('OOPs...Something went wrong!',$e->getMessage(), 401);
        }
    }

    //Get user list
    public function getUserDetail(Request $request){
        try{
            $userDetail = User::getUserDetail($request->user_id);
            $userInfo = '';
            if(!empty($userDetail)){
                $userInfo = [
                    'name' => $userDetail->name ?? '',
                    'email' => $userDetail->email ?? '',
                    'status' => $userDetail->status ?? '',
                    'is_deleted' => $userDetail->is_deleted ?? '',
                    'created_at' => $userDetail->created_at ? date($userDetail->created_at) : '',
                    'updated_at' => $userDetail->updated_at ?? '',
                ];
                return $this->sendResponse($userInfo,'User detail has been retrieved successfully.');
            }else{
                $userInfo = [
                    'name' => '',
                    'email' => '',
                    'status' => '',
                    'is_deleted' => '',
                    'created_at' => '',
                    'updated_at' => '',
                ];

                return $this->sendResponse($userInfo,'User not exist.');
            }
        }catch (\Exception $e) {
            return $this->sendError('OOPs...Something went wrong!',$e->getMessage(), 401);
        }
    }
}
