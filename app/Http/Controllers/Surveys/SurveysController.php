<?php

namespace App\Http\Controllers\Surveys;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Users\SocialWorker;
use App\Models\Surveys\Answer;
use App\Models\Surveys\Question;
use App\Models\Surveys\Survey;
use App\Models\Users\ServiceProvider;
use App\User;
use Flash;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;

class SurveysController extends Controller
{
    public function create()
    {

        return view("surveys.complete", [
            'projects' => Project::all()->pluck('name', 'id')->toarray(),
            'serviceProviders' => ServiceProvider::all()->pluck('name', 'id')->toarray(),
            'surveys' => Survey::all()->pluck('subject', 'id')->toarray(),
//            "user_attrs" => User::getFieldsSearchable()

        ]);
    }

    public function storeSurvey(Request $request)
    {
        $input = $request->all();

        $survey = Survey::create(array_merge($input, ['questions_count' => 0]));
        Flash::success('Survey saved successfully.');
        return response()->json(collect(["id" => $survey->id]));
    }

    public function storeQuestions(Request $request)
    {
        $input = $request->all();
        $question = Question::create($input);
        $input['answer'] = array_filter($input['answer']);

        $input['order'] = array_filter($input['answer']['order']);
        unset($input['answer']['order']);
        foreach ($input['answer'] as $key => $val) {
            Answer::create(
                array(
                    "question_id" => $question->id,
                    "order" => (isset($input['order'][$key])) ? $input['order'][$key] : 1,
                    "answer" => $input['answer'][$key]
                ));
        }
        Flash::success('Survey saved successfully.');
        return response()->json(collect(["id" => $question->id]));
    }

    public function storeUserSurvey(Request $request)
    {

        $input = $request->all();
        $citizen = Auth::user()->citizen()->first();

        DB::transaction(function () use ($input, $citizen) {
            $citizen->surveys()->attach($input['survey_id'], array(
                'step' => $input['step'],
                'is_final_step' => isset($input['final_step'])
            ));
            if(session()->has('impersonator')){

                $worker = User::find(session('impersonator'))->worker()->first();
                $worker->surveys()->increment('count'); 
            }
            $citizen->answers()->attach(((array_values($input['answers']))));
        });
        return redirect()->route('endusers.ben.index');
    }

    public function surveysUser($id)
    {
        $sur = Survey::find($id);
        $questions_chuncked = [];
        $citizen = Auth::user()->citizen()->first();
        $questions = $sur->questions->groupBy('step');
        $surveys = $citizen->surveys()->where('id', $sur->id)->withPivot('step', 'is_final_step')->get();
        foreach ($surveys as $sur) {
            unset($questions[$sur->pivot->step]);
        }
        foreach ($questions as $question) {
            $questions_chuncked[] = $question;
        }
        return view('frontend.surveys.citizen.fill', ['survey' => $sur, 'questions' => $questions_chuncked]);

    }

}
