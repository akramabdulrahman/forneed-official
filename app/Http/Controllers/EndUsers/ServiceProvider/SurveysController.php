<?php

namespace App\Http\Controllers\EndUsers\ServiceProvider;

use App\Http\Requests\SurveyRequest;
use App\Models\ExtraType;
use App\Models\Project;
use App\Models\Surveys\Survey;
use App\Models\Target;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Charts;
use DB;
use Laracasts\Flash\Flash;

class SurveysController extends Controller
{
    public function index($id)
    {
        $survey = Survey::with('project')->find($id);
        $chart = Charts::create('line')->responsive(false)->width(0)->height(300);
        return view('endusers.organizations.surveyQuestions', compact('survey', 'chart'));
    }


    public function create($project_id)
    {
        return view('endusers.organizations.forms.surveys.create', ['project' => Project::findOrFail($project_id),
            'extra_types' => ExtraType::getExtraTypes(config('extra_types.citizen'))]);
    }

    public function edit($id)
    {
        $survey = Survey::with('project')->find($id);
        $extra_types = ExtraType::getExtraTypes(config('extra_types.citizen'));
        return view('endusers.organizations.forms.surveys.edit', compact('survey', 'extra_types'));
    }

    public function store(SurveyRequest $request)
    {
        
        $survey = null;
        $input = $request->all();
        DB::transaction(function () use ($input, &$survey) {
            $survey = Survey::create($input);

            if (isset($input['targets'])) {

                if (isset($input['targets'])) {
                    $survey->extras()->attach($input['targets']);
                }
                if (isset($input['social_worker_id'])) {
                    $survey->SocialWorkers()->sync(array_values($input['social_worker_id']));
                }
            }

        }, 5);
        if (($survey !== null)) {
            Flash::success('Survey saved successfully.');
            return redirect()->back();
        } else {
            Flash::error('something went wrong.');

            return redirect()->back();
        }
    }

    public function update(SurveyRequest $request, $id)
    {
        $survey = null;
        $input = $request->all();
        if (!isset($input['targets'])) {
            $input['targets'] = [];
        }
        DB::transaction(function () use ($input, &$survey, $id) {
            $survey = Survey::find($id);

            $survey->update($input);
            $survey->extras()->sync($input['targets']);


            if (isset($input['social_worker_id'])) {
                $survey->SocialWorkers()->sync(array_values($input['social_worker_id']));
            }

        });
        if (($survey !== null)) {
            Flash::success('Survey saved successfully.');
            return redirect()->back();
        } else {
            Flash::error('something went wrong.');

            return redirect()->back();
        }
    }

    public function delete($id)
    {
        if (Survey::find($id)->delete()) {
            Flash::success('Survey deleted successfully.');
        }
        return redirect()->back();
    }
}
