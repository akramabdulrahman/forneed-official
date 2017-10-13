<?php

namespace App\Http\Controllers\Api;

use App\Models\Surveys\Survey;
use App\Models\Users\Citizen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class SurveysController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->isWorker()) {
            return response()->json(Survey::whereIn('project_id', $user->worker()->first()->projects()->pluck('id'))->get());
        }
        return response()->json(['error' => 'Unauthorized User Type']);
    }

    public function store(Request $request, Survey $survey, Citizen $citizen)
    {
        $input = $request->all();
        $response = array();

        DB::transaction(function () use ($input, $citizen, $survey, &$response) {
            try {
                $citizen->surveys()->attach($input['survey_id'], array(
                    'step' => $input['step'],
                    'is_final_step' => isset($input['final_step'])
                ));
                $worker = Auth::user()->worker()->first();
                $worker->surveys()->where('survey_id', $survey->id)->increment('count');

                $citizen->answers()->attach(((array_values($input['answers']))));
                $response['success'] = true;
            } catch (Exception $e) {
                $response['error'] = $e;
            }
        });
        return response()->json($response);
    }
}
