<?php

namespace App\Http\Controllers\EndUsers\ServiceProvider;

use App\DataTables\ProjectsDatatable;
use App\DataTables\SurveysDatatable;
use App\Http\Requests\ProjectRequest;
use App\Models\Extra;
use App\Models\ExtraType;
use App\Models\Project;
use App\Models\Sector;
use App\Models\Target;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class ProjectsController extends Controller
{
    public function index(ProjectsDatatable $projectsDatatable)
    {
        return $projectsDatatable->render('endusers.organizations.projects');
    }

    public function show(SurveysDatatable $surveysDatatable, $id)
    {
        $project = Project::with(['sector', 'serviceProvider'])->find($id);
        return $surveysDatatable->with('project_id', $id)->render('endusers.organizations.projectSurveys', compact('project'));
    }



    public function create()
    {
        return view('endusers.organizations.forms.projects.create', [
            'sectors' => Sector::all()->pluck('name', 'id')->toArray(),
            'extra_types' => ExtraType::getExtraTypes( config('extra_types.citizen'))
        ]);
    }

    public function edit($id)
    {
        return view('endusers.organizations.forms.projects.edit', [
            'sectors' => Sector::all()->pluck('name', 'id')->toArray(),
            'extra_types' => ExtraType::getExtraTypes(config('extra_types.citizen')),
            'project' => Project::find($id)
        ]);
    }

    public function store(ProjectRequest $request)
    {
        $project = null;
        $input = $request->all();
        DB::transaction(function () use ($input, &$project) {
            $input['service_provider_id'] = Auth::user()->serviceProvider()->first()->id;
            $project = Project::create($input);

            if (isset($input['targets'])) {
                $project->extras()->attach($input['targets']);
            }
        });
        if (($project !== null)) {
            Flash::success('Project saved successfully.');
            return redirect()->back();
        } else {
            Flash::error('something went wrong.');

            return redirect()->back();
        }

    }

    public function update(ProjectRequest $request, $id)
    {
        $project = null;
        $input = $request->all();

        DB::transaction(function () use ($input, &$project, $id) {

            $project = Project::find($id);
            $project->update($input);

            if (isset($input['targets'])) {

                foreach ($input['targets'] as $target) {
                    $val = explode('#', $target);
                    Target::updateOrCreate([
                        'project_id' => $project->id,
                        'targetable_id' => $val[1],
                        'targetable_type' => $val[0]
                    ]);
                }
            }
        });
        if (($project !== null)) {
            Flash::success('Project saved successfully.');
            return redirect()->back();
        } else {
            Flash::error('something went wrong.');

            return redirect()->back();
        }
    }

    public function delete($id)
    {
        if (Project::find($id)->delete()) {
            Flash::success('Project deleted successfully.');
        }
        return redirect()->back();

    }
}
