<?php

namespace App\Http\Controllers\EndUsers\ServiceProvider;

use App\Models\Chart;
use App\Models\Project;

use App\Models\Surveys\Answer;
use App\Models\Surveys\Question;
use App\Models\Surveys\Survey;
use App\Models\Target;
use App\Models\Users\Citizen;
use App\Repositories\ChartRepositoryRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Charts;
use Auth;
class SurveyStatsController extends Controller
{
    private $chartRepo;

    function __construct(ChartRepositoryRepositoryEloquent $chartRepo)
    {
        $this->chartRepo = $chartRepo;
    }

    public function index()
    {
        $projects = Auth::user()->serviceProvider()->first()->projects()->pluck('name', 'id');

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
        $chart = Charts::create('pie','c3')
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

        $chart = $this->chartRepo->visualize($request->all());

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
