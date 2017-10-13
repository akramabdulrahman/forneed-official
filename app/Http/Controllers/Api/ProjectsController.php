<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if($user->isWorker()){
            return response()->json($user->worker()->first()->projects()->get());
        }
        return response()->json(['error'=>'Unauthorized User Type']);
    }
}
