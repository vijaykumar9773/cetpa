<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function countUsers(){
        $no_of_users = User::where('status',1)
        ->where('is_deleted',0)
        ->count();
        return $no_of_users;
    }

    //Get users list
    public static function getUserList(){
        $userList = User::where('is_deleted',0)
        ->get();
        return $userList;
    }

    //Store users
    public static function storeUsers($data=[])
    {
        $insertID = User::insert($data);
        return $insertID;
    }

    //Get user detail
    public static function getUserDetail($id){
        $userDetail = User::find($id);
        return $userDetail;
    }

    //Update user
    public static function updateUserByID(int $id=0,$data=[])
    {
        $userDetail = User::where('id', $id)
        ->update($data);
        if ($userDetail) {
            return 1;
        } else {
            return 0;
        }
    }

    //Delete User
    public static function deleteUserByID(int $id=0){
        $userDetail = User::where('id', $id)
        ->delete();
        if ($userDetail) {
            return 1;
        } else {
            return 0;
        }
    }

}
