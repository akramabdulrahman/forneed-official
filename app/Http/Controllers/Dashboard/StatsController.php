<?php

namespace App\Http\Controllers\Dashboard;

use App\Entities\CitizenRepository;
use App\Http\Controllers\Controller;
use App\Models\ChartRepository;
use App\Models\Extra;
use App\Models\ExtraType;
use App\Models\Users\Citizen;
use App\Models\Users\ServiceProvider;
use App\Repositories\ChartRepositoryRepository;
use App\Repositories\ChartRepositoryRepositoryEloquent;
use App\Repositories\ServiceProviderRepository;
use ConsoleTVs\Charts\Facades\Charts;
use DB;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    private $chartRepo;

    function __construct(ChartRepositoryRepositoryEloquent $chartRepo)
    {
        $this->chartRepo = $chartRepo;
    }

    public function index()
    {
        $chart = Charts::create('line');
        return $this->output($chart);
    }

    private function output($chart, $multi = false)
    {
        $base_model = snake_case(class_basename($this->model()));
        $targets = ExtraType::getExtraTypes(config('extra_types.' . $base_model))->toArray();
        $targets_types_m = ExtraType::getExtraTypesWithTypes(config('extra_types.' . $base_model))->toArray();

        return view('dashboard.beneficiaries.statistics',
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

    public function render(Request $request)
    {
        $chart = $this->chartRepo->render($request, $this->model());
        if ($request->isXmlHttpRequest()) {
            return $chart->render();
        }
        return $this->output($chart);
    }

    public function multiRender(Request $request)
    {
        $chart = $this->chartRepo->multiRender($request, $this->model());
        if ($request->isXmlHttpRequest()) {
            return $chart->render();
        }
        return $this->output($chart);
    }

    protected function model()
    {
        return ServiceProvider::class;
    }
}


