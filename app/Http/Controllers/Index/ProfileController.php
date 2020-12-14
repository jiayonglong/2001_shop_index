<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //个人资料
    public function profile(){
        return view('profile.profile');
    }
    //修改密码
    public function changepass(){
        return view('profile.changepass');
    }
}
