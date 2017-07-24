<?php

namespace App\Http\Controllers\Dashboard\Beneficiaries;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportingController extends Controller
{
    public function index(){
        return view('dashboard.beneficiaries.reporting');
    }
}
