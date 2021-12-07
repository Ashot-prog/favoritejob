<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class CandidateController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        //
    }

    public function store(Request $request)
    {   dd($request->hasFile('posters'));
        $input = $request->except('_token','posters');
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if ($request->hasFile('posters')){
            $files = $request->file('posters');
            $image=[];

            foreach ($files as $file){
                $file_name = rand(1,9999).$file->getClientOriginalName();
                array_push($image,$file_name);
                $file->move(public_path().'/images', $file_name);
            }
            $input['posters']= json_encode($image);
        }
        return redirect(asset('/'));

    }

    public function login(Request $request)
    {
        $formFields = $request->only(['email', 'password']);
        if (Auth::attempt($formFields)) {
            return redirect(asset('/'));
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(asset('/'));
    }

}
