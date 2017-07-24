<?php

namespace App\Http\Controllers\EndUsers\ServiceProvider;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index($projet_id = null)
    {
        $libs = config('charts.libs');

        if ($projet_id)
            $project = Project::with('surveys')->find($projet_id);
        return view('endusers.organizations.report', compact('project', 'libs'));
    }


}
