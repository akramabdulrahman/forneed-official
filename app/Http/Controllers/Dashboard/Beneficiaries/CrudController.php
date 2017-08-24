<?php

namespace App\Http\Controllers\Dashboard\Beneficiaries;

use App\DataTables\BaseDatatable;
use App\DataTables\BaseDatatableOld;
use App\DataTables\CitizensDatatable;
use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use DB;

class CrudController extends Controller
{
    private $citizenRepo;

    public function __construct(CitizenRepository $citizenRepo)
    {
        $this->citizenRepo = $citizenRepo;
    }

    public function index(BaseDatatable $citizensDatatable)
    {
        return $citizensDatatable
            ->repoConfig($this->citizenRepo)
            ->setColumns(collect(
                [
                    ['data' => 'id', 'name' => 'id',
                        'title' => 'Id', 'searchable' => true],
                    'created_at',
                    'sectors' => ['title' => 'Sectors', 'name' => 'sectors.name',
                        'data' => 'sectorsPopulated'],
                    'areas' => ['title' => 'Areas', 'name' => 'areas.name',
                        'data' => 'areasPopulated'],
                ])
                ->merge(collect(config('extra_types.citizen'))
                    ->map(function ($item) {
                        return [
                            'data' => "extrasPopulated.{$item}",
                            'name' => "extras.extra",
                            'title' => ucfirst(str_replace('_', ' ', snake_case($item))),
                            'searchable' => true,
                            'defaultContent' => '-',
                            'orderable' => 'false',
                            'sorting' => 'true'];
                    }))->toArray())
            ->render('dashboard.beneficiaries.crud');
    }

    public function create()
    {
        return view('dashboard.beneficiaries.forms.create', [
            'sectors' => Sector::pluck('name', 'id'),
            'areas' => Area::pluck('name', 'id'),
            'fields' => config('extra_types.citizen'),
            'extras' => Extra::whereIn('name', config('extra_types.citizen'))->get()->groupBy('name')
        ])->with('input');
    }

    public function edit($id)
    {

        $user = Citizen::with('user')->find($id);
        return view('dashboard.beneficiaries.forms.edit', [
            "user" => $user->user()->first(),
            'citizen' => $user,
            'sectors' => Sector::pluck('name', 'id'),
            'areas' => Area::pluck('name', 'id'),
            'fields' => config('extra_types.citizen'),
            'extras' => Extra::whereIn('name', config('extra_types.citizen'))->get()->groupBy('name'),
            'citizen_extras' => $user->extras()->pluck('id', 'name')
        ]);
    }

    public function store(BenRequest $request)
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

        return redirect()->back();
    }

    public function update(BenRequest $request, $id)
    {
        $citizen = Citizen::findOrFail($id);
        DB::transaction(function () use ($request, $citizen) {
            $citizen->update($request->only('contactable'));
            $citizen->extras()->sync(array_values($request->get('extra')));
            $citizen->sectors()->sync(array_values($request->get('sector_id')));
            $citizen->areas()->sync(array_values($request->get('area_id')));
            $user = $citizen->user;
            $user->update($request->only('name', 'email'));
            $user->save();
        }, 5);
        Flash::success('User Updated successfully.');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $citizen = Citizen::find($id);

        if (empty($citizen)) {
            \Laracasts\Flash\Flash::error('User not found');

            return redirect()->back();
        }
        if ($citizen->user) {
            $user = $citizen->user;
            $user->delete();
        }
        $citizen->delete();

        \Laracasts\Flash\Flash::success('citizen deleted successfully.');

        return redirect()->back();
    }


}
