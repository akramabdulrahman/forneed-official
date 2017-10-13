<?php

namespace App\Http\Controllers\EndUsers\Citizens;

use App\Models\Location\Area;
use App\Models\Project;
use App\Models\Sector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
    
        $user = Auth::user();
        
        $impersonator = session()->has('impersonator')?
        User::find(session('impersonator'))->worker()->first()->id:null;

        return view('endusers.citizens.index', [
            "user" => $user,
            'projects' => Project::with('area')->get(),
            'surveys' => $user->citizen
                 ->applicable_surveys($impersonator)
            ->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function createNeed()
    {
        return view('endusers.citizens.need.create', [
            'sectors' => Sector::all()->pluck('name', 'id')->toArray(),
            'areas' => Area::all()
        ]);
    }

    public function logoutas()
    {
        Auth::loginUsingId(session('impersonator'));
        session()->put('impersonator', null);
        return redirect()->route('endusers.worker.index');
    }
}
