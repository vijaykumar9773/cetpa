<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;

class DashboardController extends Controller
{
    //Dashboard
    public function index(){

        //Check admin is login or not
        if (empty(Session::get('adminId'))) {
            return redirect('admin/login');
        }

        //Count users
        $no_of_users = User::countUsers();

        $adminName = Session::get('adminName');
        return view('backend.dashboard',compact('adminName','no_of_users'));
    }

    //logout
    public function logout(){
        session()->forget('adminId');
        session()->forget('adminName');
        Auth::logout();
        return redirect('admin');
    }
}
