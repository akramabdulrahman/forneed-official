<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Age;
use App\Models\Chart;
use App\Models\Disability;
use App\Models\Extra;
use App\Models\Gender;
use App\Models\Location\Area;
use App\Models\MaritalStatus;
use App\Models\Project;
use App\Models\RefugeeState;
use App\Models\Surveys\Survey;
use App\Models\Users\ServiceProvider;
use App\Models\WorkField;
use App\Models\WorkingState;
use App\Repositories\ChartRepositoryRepositoryEloquent;
use App\Repositories\CitizenRepository;
use App\Repositories\ServiceProviderRepository;
use App\Repositories\SocialWorkerRepository;
use function response;

class AjaxApiController extends Controller
{

    private $citizenRepo;
    private $service_providerRepo;
    private $social_workerRepo;
    private $chartRepo;

    public function __construct(CitizenRepository $citizenRepo, ChartRepositoryRepositoryEloquent $chartRepo, ServiceProviderRepository $service_providerRepo, SocialWorkerRepository $social_workerRepo)
    {
        $this->middleware('auth');
        $this->citizenRepo = $citizenRepo;
        $this->service_providerRepo = $service_providerRepo;
        $this->social_workerRepo = $social_workerRepo;
        $this->chartRepo = $chartRepo;
    }

    public function populate($model)
    {
        $repo = $model . "Repo";
        return response()->json(($this->$repo->getPopulatedPivot()));
    }

    public function cities($area_id)
    {
        $cities = $this->cityRepository->findByField('area_id', $area_id, array('id', 'name'));
        return response()->json($cities);
    }

    public function districts($city_id)
    {
        $districts = $this->districtRepository->findByField('city_id', $city_id, array('id', 'name'));
        return response()->json($districts);
    }

    public function streets($district_id)
    {
        $streets = $this->streetRepository->findByField('district_id', $district_id, array('id', 'name'));
        return response()->json($streets);
    }

    public function serviceTypes($sector_id)
    {
        $serviceTypes = $this->serviceTypeRepository->findByField('sector_id', $sector_id, array('id', 'name'));
        return response()->json($serviceTypes);
    }

    public function projects($service_provider_id)
    {

        $projects = Project::where('service_provider_id', $service_provider_id)->select(array('id', 'name'))->get();
        return response()->json($projects);
    }

    public function projectsWithAreas()
    {
        $projects = Project::with('area')->get()->map(function ($v) {
            if ($v->area)
                return ['name' => $v->name,
                    'lat' => $v->area->lat,
                    'lng' => $v->area->lng];
        })->filter();
        return response()->json($projects);
    }

    public function surveys($project_id)
    {
        $surveys = Survey::where('project_id', $project_id)->select(array('id', 'subject'))->get();
        return response()->json($surveys);
    }

    public function questions($survey_id)
    {
        $questions = $this->questionRepository->findByField('survey_id', $survey_id, array('id', 'body'));
        return response()->json($questions);
    }

    public function Listings($lookup)
    {
        return response()->json(Extra::where('extra_type_id', '=', $lookup)->pluck('extra', 'id'));
    }

    public function charts($chart_id)
    {
        $chart = Chart::findOrFail($chart_id)->toArray();
        $func = '';

        switch ($chart['multi']) {
            case 1:
                $func = 'render';
                break;
            case 0:
                $func = 'render';

                break;
            default:
                $func = 'visualize';
                $attrs = json_decode($chart['attr_list']);
                $chart['first_ans'] = $attrs->first_ans;
                $chart['second_ans'] = $attrs->second_ans;
        }
        $chart['theme'] = implode('_', [$chart['theme_lib'], $chart['theme_chart']]);

        return $this->chartRepo->$func($chart, $chart['model'])->render();

    }

    public function questionChart($question_id)
    {

    }
}
