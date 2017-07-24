<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Age;
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
use App\Repositories\CitizenRepository;
use App\Repositories\ServiceProviderRepository;
use App\Repositories\SocialWorkerRepository;
use function response;

class AjaxApiController extends Controller
{

    private $citizenRepo;
    private $service_providerRepo;
    private $social_workerRepo;

    public function __construct(CitizenRepository $citizenRepo, ServiceProviderRepository $service_providerRepo, SocialWorkerRepository $social_workerRepo)
    {
        $this->middleware('auth');
        $this->citizenRepo = $citizenRepo;
        $this->service_providerRepo = $service_providerRepo;
        $this->social_workerRepo = $social_workerRepo;
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

    public function questionChart($question_id)
    {

    }
}
