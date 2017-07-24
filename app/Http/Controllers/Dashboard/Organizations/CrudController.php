<?php

namespace App\Http\Controllers\Dashboard\Organizations;

use App\DataTables\BaseDatatable;
use App\DataTables\ServiceProviderDataTable;
use App\Http\Requests\OrgRequest;
use App\Models\Extra;
use App\Models\ExtraType;
use App\Models\Location\Area;
use App\Models\Sector;
use App\Models\Target;
use App\Models\Users\Company;
use App\Models\Users\ServiceProvider;
use App\Repositories\ServiceProviderRepository;
use App\Repositories\ServiceProviderRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Laracasts\Flash\Flash;

class CrudController extends Controller
{
    private $serviceProviderRepo;

    function __construct(ServiceProviderRepository $serviceProviderRepo)
    {
        $this->serviceProviderRepo = $serviceProviderRepo;
    }

    public function index(Request $request,ServiceProviderDataTable $serviceProviderDataTable)
    {

        return $serviceProviderDataTable->repoConfig($this->serviceProviderRepo)
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
                ->merge(collect(config('extra_types.service_provider'))
                    ->map(function ($item) {
                        return [
                            'data' => "extrasPopulated.{$item}",
                            'name' => "extras.extra",
                            'title' => ucfirst(str_replace('_', ' ', snake_case($item))),
                            'searchable' => true,
                            'defaultContent' => '-',
                            'orderable' => 'false',
                            'sorting' => 'true'];
                    }))->toArray())->render('dashboard.organizations.crud', [
                'sectors' => Sector::pluck('name', 'id'),
                'areas' => Area::pluck('name', 'id'),
                'extra_types' => ExtraType::getExtraTypes(config('extra_types.citizen'))]);
    }

    public function create()
    {

        return view('dashboard.organizations.forms.create', [
            'sectors' => Sector::pluck('name', 'id'),
            'areas' => Area::pluck('name', 'id'),
            'extras' => Extra::whereIn('name', config('extra_types.service_provider'))->get()->groupBy('name')
        ]);
    }

    public function edit($id)
    {
        $user = ServiceProvider::with('user')->find($id);
        return view('dashboard.organizations.forms.edit', [
            "sp" => $user,
            'user' => $user->user()->first(),
            'sectors' => Sector::pluck('name', 'id'),
            'areas' => Area::pluck('name', 'id'),
            'extras' => Extra::whereIn('name', config('extra_types.service_provider'))->get()->groupBy('name'),
            'service_provider_extras' => $user->extras()->pluck('extra_id', 'name')
        ]);
    }

    public function store(OrgRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create($request->only('user')['user']);
            $sp = new ServiceProvider($request->except('sector_id', 'area_id', 'user'));
            $sp->user()->associate($user);
            $sp->save();
            $sp->extras()->attach(array_values($request->get('extra')));
            $sp->sectors()->attach(array_keys(array_flip($request->get('sector_id'))));
            $sp->areas()->attach(array_keys(array_flip($request->get('area_id'))));
        }, 5);
        Flash::success('User saved successfully.');
        return redirect()->back();
    }


    public function update(OrgRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $sp = ServiceProvider::findOrFail($id);
            $sp->update($request->except('sp.sector_id', 'sp.area_id')['sp']);
            $sp->extras()->sync(array_values($request->get('extra')));
            $sp->sectors()->sync($request->input()['sp']['sector_id']);
            $sp->areas()->sync($request->input()['sp']['area_id']);
            $user = $sp->user;
            $user->update($request->all());
            $user->save();
        }, 5);

        Flash::success('User saved successfully.');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $sp = ServiceProvider::find($id);

        if (empty($sp)) {
            Flash::error('User not found');
            return redirect()->back();
        }
        if ($sp->user) {
            $user = $sp->user;
            $user->delete();
        }
        $sp->delete();

        Flash::success('citizen deleted successfully.');

        return redirect()->back();
    }

}
