<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\FavoriteJob;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class FavoriteJobController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function store(Request $request)
    {

        $validated = $request->validate([
            'job_id' => 'required',
            'candidate_id' => 'required'
        ]);
        FavoriteJob::create($validated,);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required',
        ]);
        $favorites = FavoriteJob::all()->where("job_id", "", $validated["job_id"])->where("candidate_id", "", Auth::id());
        foreach ($favorites as $favorite) {
            FavoriteJob::destroy($favorite->id);
        }

    }
}
