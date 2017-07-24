<?php

namespace App\Http\Controllers\Dashboard\Workers;

use App\DataTables\SurveysWorkersDatatable;
use App\Models\Project;
use App\Models\Surveys\Survey;
use App\Models\Users\ServiceProvider;
use App\Models\Users\SocialWorker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MandeController extends Controller
{
    public function index()
    {

        return view('dashboard.workers.mande', [
            'service_providers' => ServiceProvider::with(['projects' => function ($query) {
                $query->with('surveys');
            }])->get()
        ]);
    }

    public function survery_workers($id, SurveysWorkersDatatable $surveysWorkersDatatable)
    {
        $survey = Survey::find($id);
        $project = Project::find($survey->project_id);
        $sp = ServiceProvider::find($project->service_provider_id);
        return $surveysWorkersDatatable->include(['name' => 'survey_id', 'val' => $id])->render('dashboard.workers.surveryworkers', [
            'survey' => $survey,
            'project' => $project,
            'sp' => $sp
        ]);
    }

    public function message(Request $request)
    {
        $title = $request->input('title');
        $message = $request->input('message');
        Mail::send('emails.send', ['title' => $title, 'message' => $message], function ($message) {
            $message->from('no-reply@scotch.io', 'Scotch.IO');
            $message->to('batman@batcave.io');
        });
    }

    public function make_payment($id, $worker_id)
    {
        return view('dashboard.workers.forms.payment', [
            'survey' => Survey::findOrFail($id),
            'worker' => SocialWorker::findOrFail($worker_id)
        ]);
    }

    public function store_payment()
    {

    }


}
