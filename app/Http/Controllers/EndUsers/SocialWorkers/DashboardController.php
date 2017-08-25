<?php

namespace App\Http\Controllers\EndUsers\SocialWorkers;

use App\DataTables\CitizensDatatable;
use App\Http\Requests\BenRequest;
use App\Models\AcademicLevel;
use App\Models\Age;
use App\Models\Disability;
use App\Models\Extra;
use App\Models\Location\Area;
use App\Models\MaritalStatus;
use App\Models\RefugeeState;
use App\Models\Sector;
use App\Models\Users\Citizen;
use App\Models\WorkingState;
use App\Repositories\CitizenRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class DashboardController extends Controller
{
    private $citizenRepo;

    public function __construct(CitizenRepository $citizenRepo)
    {
        $this->citizenRepo = $citizenRepo;
    }

    /*
     * beneficiaies view from admin panel
     * sign in as button inside datatable
     *
     * submit service request
     *
     * */
    public function index(CitizensDatatable $citizensDatatable)
    {
        $hired = Auth::user()->worker->first()->projects()->exists();
        if (!$hired) {
            Flash::warning('You are not Hired in a project yet , 
            stay tuned we will email you once your application gets checked');
        }
        return $citizensDatatable->setColumns(collect(
            [
                ['data' => 'id', 'name' => 'id',
                    'title' => 'Id', 'searchable' => true],
                ['data' => 'user.name', 'name' => 'user.name',
                    'title' => 'name', 'searchable' => true],
                ['data' => 'user.email', 'name' => 'user.email',
                    'title' => 'name', 'searchable' => true],
                'sectors' => ['title' => 'Sectors', 'name' => 'sectors.name',
                    'data' => 'sectorsPopulated'],
                'areas' => ['title' => 'Areas', 'name' => 'areas.name',
                    'data' => 'areasPopulated'],
                ['data' => 'contactable', 'name' => 'contactable', 'title' => 'Contactable', 'searchable' => true],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At', 'searchable' => false],
                ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At', 'searchable' => false],
            ]))
            ->repoConfig($this->citizenRepo)->render('endusers.workers.crud', ['hired' => $hired]);
    }


    public function loginas($id)
    {
        session()->put('impersonator', Auth::user()->id);
        Auth::loginUsingId($id);
        return redirect()->route('profile');
    }


    public function createCitizen()
    {
        return view('endusers.workers.forms.create', [
            'sectors' => Sector::pluck('name', 'id'),
            'areas' => Area::pluck('name', 'id'),
            'fields' => config('extra_types.citizen'),
            'extras' => Extra::whereIn('name', config('extra_types.citizen'))->get()->groupBy('name')
        ])->with('input');
    }

    public function storeCitizen(BenRequest $request)
    {
        DB::transaction(function () use ($request) {

            $user = User::create($request->only('user')['user']);
            $citizen = new Citizen($request->only('contactable'));
            $citizen->user()->associate($user);
            $citizen->save();
            $citizen->extras()->attach(array_values($request->get('extra')));
            $citizen->sectors()->attach(array_keys(array_flip($request->get('sector_id'))));
            $citizen->areas()->attach(array_keys(array_flip($request->get('area_id'))));

        }, 5);
        Flash::success('User saved successfully.');

        return redirect()->route('profile');
    }


}
