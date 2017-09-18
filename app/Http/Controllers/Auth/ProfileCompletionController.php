<?php

namespace App\Http\Controllers\Auth;

use App\Models\AcademicLevel;
use App\Models\Age;
use App\Models\Disability;
use App\Models\Extra;
use App\Models\Location\Area;
use App\Models\MaritalStatus;
use App\Models\RefugeeState;
use App\Models\Sector;
use App\Models\Users\Citizen;
use App\Models\Users\Company;
use App\Models\Users\ServiceProvider;
use App\Models\WorkingState;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;

class ProfileCompletionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'noUserType']);
    }

    public function index()
    {
        return view('auth.choose');
    }

    public function choosePath($type)
    {
        $func = 'choose' . ucfirst($type);
        return $this->$func();
    }

    private function chooseCitizen()
    {
        return view('endusers.citizens.complete', [
            'fields' => config('extra_types.citizen'),
            'fieldsManyToMany'=>config('extra_types.citizen_many'),
            'extras' => Extra::whereIn('name', config('extra_types.citizen'))->get()->groupBy('name'),
        ]);
    }

    private function chooseSp()
    {
        return view('endusers.organizations.complete', [
            'fields' => config('extra_types.service_provider'),
            'extras' => Extra::whereIn('name', config('extra_types.service_provider'))->get()->groupBy('name'),
        ]);

    }

    public function completeCitizenProfile(Requests\NewCitizenRequest $request)
    {

        $citizen = new Citizen($request->all());
        $citizen->user()->associate(Auth::user());
        $citizen->save();
        $citizen->extras()->attach(array_flatten(array_values($request->get('extra'))));
        return redirect()->route('profile');
    }

    public function completeSpProfile(Requests\NewOrgRequest $request)
    {

        $sp = new ServiceProvider($request->except(['area_id', 'sector_id']));
        $sp->user()->associate(Auth::user());
        $sp->save();
        $sp->extras()->attach(array_values($request->get('extra')));
        return redirect()->route('profile');
    }
}
