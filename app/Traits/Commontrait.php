<?php
namespace App\Traits;

use Session;

trait Commontrait{

    //Check admin is login or not 
    public function checkAdminLogin(){
        if (empty(Session::get('adminId'))) {
            return redirect('admin/login');
        }
    }

    //Get admin name
    public function getAdminName(){
        $adminName = Session::get('adminName');
        return $adminName;
    }

}