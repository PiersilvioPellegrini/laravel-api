<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;




use Illuminate\Support\Facades\Auth;
class DashBoardController extends Controller
{
    public function index(){

        $user = Auth::user();
        if($user){
            $users = User::all();
        }

        return view("admin.dashboard",[
            "users"=> $users ?? null
        ]);


    }


    

}