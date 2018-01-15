<?php

namespace App\Http\Controllers\EndUsers\ServiceProvider;

use App\Http\Controllers\Dashboard\StatsController;
use App\Models\ExtraType;
use App\Models\Project;
use App\Models\Users\SocialWorker;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ChartRepositoryRepositoryEloquent;
use Auth;
use DB;

class ReportController
{
    private $chartRepo;

    function __construct(ChartRepositoryRepositoryEloquent $chartRepo)
    {
        $this->chartRepo = $chartRepo;
    }

    public function index($project_id)
    {
        $libs = config('charts.libs');

        if ($project_id) {
            $project = Project::with('surveys')->find($project_id);
        }
        $chartRepo = $this->chartRepo;
        $savedCharts = $project->surveys->mapWithKeys(function ($survey) use ($chartRepo) {
            return [$survey->id => $survey->charts()->get()->map(function ($chart) use ($chartRepo) {

                return $chartRepo->visualize(
                    ['theme' => "{$chart->theme_lib}_{$chart->theme_chart}",
                    'multi' => $chart->multi,
                    'func' => $chart->attr_list['func'],
                    'first_ans' => $chart->attr_list['first_ans']
                ]);
            })];
        });
        return view('endusers.organizations.report', compact('project', 'savedCharts','libs'));
    }

    private function output($chart, $multi = false)
    {
        $base_model = snake_case(class_basename($this->model()));
        $targets = ExtraType::getExtraTypes(config('extra_types.' . $base_model))->toArray();
        $targets_types_m = ExtraType::getExtraTypesWithTypes(config('extra_types.' . $base_model))->toArray();

        return view('endusers.organizations.statistics',
            [
                'chart' => $chart,
                'libs' => config('charts.libs'),
                'multi_libs' => config('charts.multi_libs'),
                'target_types' => $targets,
                'target_types_m' => $targets_types_m,
                'model' => $base_model,
                'namespace' => $this->model()
            ]);
    }

    public function performanceStatsChart(Request $request)
    {
        $project_id = $request->input('project_id');
        $theme = explode('_', $request->input('theme'));
        $survey = $request->has('survey_id');
        $workers = SocialWorker::select(DB::raw('users.name as username'), DB::raw(' social_worker_id'),
            !$survey ?
                DB::raw('sum(social_worker_survey.count) as aggregate') :
                DB::raw('social_worker_survey.count as aggregate'), 'survey_id')
            ->whereHas('projects', function ($query) use ($project_id) {
                $query->where('id', $project_id);
            })
            ->join('users', 'users.id', '=', 'user_id')
            ->join('social_worker_survey',
                "social_worker_survey.social_worker_id", '=', 'social_workers.id');

        if ($survey) {
            $workers->where('survey_id', $request->input('survey_id'))
                ->groupBy('social_worker_id', 'users.name', 'survey_id', 'social_worker_survey.count');
        } else {
            $workers->groupBy('social_worker_id', 'users.name', 'survey_id');
        }

        $workers = $workers->get()->groupBy('username');


        return Charts::create($theme[1], $theme[0])
            ->labels($workers->keys())
            ->values(array_values($workers->map(function ($val) {
                return $val->sum('aggregate');
            })->toArray()))
            ->title("")
            ->elementLabel('Workers Surveys')
            ->responsive(false)->width(0)->height(300)->render();
    }

    public function performance_stats(Request $request)
    {
        return view('endusers.organizations.performance', [
            'projects' => Auth::user()->serviceProvider()->first()->projects()->pluck('name', 'id'),
            'libs' => config('charts.libs'),
        ]);
    }
}
