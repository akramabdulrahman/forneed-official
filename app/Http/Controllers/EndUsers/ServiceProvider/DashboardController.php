<?php

namespace App\Http\Controllers\EndUsers\ServiceProvider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('endusers.organizations.index');
    }
}
