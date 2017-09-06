<?php

namespace App\Http\Controllers\EndUsers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $menu = "organizations";

    public function index()
    {
        $user = Auth::user();
         if ($user->isServiceProvider()) {
            return redirect()->route('endusers.org.show');
        } else if ($user->isCitizen()) {
            return redirect()->route('endusers.ben.show');
        }else if ($user->isWorker()) {
            return redirect()->route('endusers.worker.show');
        }
    }

    public function admin()
    {
        return redirect()->route('Dashboard.landing');
    }

    public function show()
    {
        $user = Auth::user();
        return view('endusers.user_profile', ['user' => $user, 'types' => $user->type_relations(), 'menu' => $this->menu]);
    }
}
