<?php

namespace App\Http\Controllers\EndUsers\ServiceProvider;

use App\Models\Chart;
use App\Models\Project;

use App\Models\Surveys\Answer;
use App\Models\Surveys\Question;
use App\Models\Surveys\Survey;
use App\Models\Target;
use App\Models\Users\Citizen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Charts;

class SurveyStatsController extends Controller
{
    public function index()
    {
        $projects = Project::all()->pluck('name', 'id');

        return view('endusers.organizations.surveyStats', [
            'projects' => $projects,
        ]);
    }

    public function question_chart(Request $request, $id)
    {
        $question = Question::find($id);
        $chart_dataset = $question->answers
            ->mapWithKeys(function ($v) {
                return [$v->answer => $v->citizens_count()];
            })->toArray();
        $chart = Charts::create('pie')
            ->title('answers pick rate ')
            ->elementLabel("Citizens Count")
            ->labels(array_values(array_keys($chart_dataset)))
            ->values(array_values(array_values($chart_dataset)))
            ->dimensions(1000, 500)
            ->responsive(false)->width(0)->height(300);
        if ($request->isXmlHttpRequest()) {
            return $chart->render();
        }
    }

    public function relationChart($survey_id)
    {
        $survey = Survey::find($survey_id);
        return view('endusers.organizations.forms.questions.stats', [
            'libs' => config('charts.libs'),
            'survey' => $survey
        ]);
    }

    public function visualizeRelation(Request $request)
    {

        $theme = explode('_', $request->input('theme'));
        $survey = null;
        $answers = [$request->input('first_ans'), $request->input('second_ans')];
        $data = Answer::with('citizens')->whereIn('id', $answers)->get()->map(function ($v) {
            return count($v->citizens);
        })->toArray();
        $labels = array_values(Answer::with('question')->whereIn('id', $answers)
            ->get()->map(function ($v) use (&$survey) {
                $survey = $v->question->survey()->first()->id;
                return $v->question->body . ':' . $v->answer;
            })->toArray());

        $chart = Charts::create($theme[1], $theme[0])
            ->title('Citizens that satisfy : ' . collect($labels)->map(function ($v) {
                    return "({$v})";
                })->implode(','))
            ->elementLabel("Citizens")
            ->responsive(false)
            ->dimensions(0, 300)
            ->labels($labels)
            ->values(array_values($data))
            ->responsive(false)->width(0)->height(300);


        return $chart->render();

    }

    public function question_chart_theme(Request $request, $id)
    {

        $question = Question::find($id);
        $theme = explode('_', $request->input('theme'));

        $chart_dataset = $question->answers->mapWithKeys(function ($v) {
            return [$v->answer => $v->citizens_count()];
        })->toArray();
        $chart = Charts::create($theme[1], $theme[0])
            ->title('answers pick rate ')
            ->elementLabel("Citizens Count")
            ->labels(array_values(array_keys($chart_dataset)))
            ->values(array_values(array_values($chart_dataset)))
            ->dimensions(1000, 500)
            ->responsive(false)->width(0)->height(300);
        return $chart->render();

    }
}
