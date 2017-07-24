<?php

namespace App\Http\Controllers\Dashboard\Organizations;

use App\Models\Users\ServiceProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        return view('dashboard.organizations.forms.rfp', [
            'organizations' => ServiceProvider::with('user')->get()->pluck('user.name', 'id'),
        ]);
    }
}
