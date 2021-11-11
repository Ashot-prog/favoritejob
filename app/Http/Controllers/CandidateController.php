<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
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
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $candidate = Candidate::create($validated);
        if ($candidate) {
            Auth::login($candidate);
            return redirect(asset('/'));
        }

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
