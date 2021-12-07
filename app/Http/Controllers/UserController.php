<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerUserController;

class UserController extends VoyagerUserController
{

    public function filter(Request $request)
    {
        if ($request['submit'] == 'search') {
            $dataTypeContent = User::all()->where('status', 1);
            return view('vendor.voyager.users.filter',compact('dataTypeContent'));
        } else {

        }
    }


}
