<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use stdClass;

class UserController extends Controller
{
    public function showUserName()
    {
        return 'Pegasus';
    }
    public function getIndex()
    {
        $data = [];
        return view('welcome',compact('data'));

        /* $obj=new stdClass();
        $obj->name='pegasus';
        $obj->id='7';
        $obj->gender='male';
        return view('welcome',compact('obj')); */
        
    }
}
