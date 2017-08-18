<?php

namespace App\DataTables;

use App\Models\Project;
use App\User;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Services\DataTable;

class ProjectsDatatable extends BaseDatatable
{

    private $includes = [];

    /**
     *
     */
    function include ($var)
    {
        $this->includes[$var['name']] = $var['val'];
        return $this;
    }

    /**
     * Display ajax response.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    private $offset_index = 0;

    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addIndexColumn()

            ->editColumn('name', function ($project) {

                return view('link',
                    ['route'=>route('endusers.org.projects.show', $project->id),
                        'label'=>$project->name]);
            })
            ->addColumn('is_accepted', function ($row) {
                switch ($row->is_accepted) {
                    case 0:
                        return 'pending';
                        break;
                    case 1:
                        return 'accepted';
                        break;
                    case 2:
                        return 'rejected';
                        break;
                    default:
                        return 'pending';
                }
            })->editColumn('action', function ($row) {
                $modelRoute = 'endusers.org.projects';
                $id = $row->id;
                return view('endusers.layout.datatables_actions', compact('modelRoute', 'id'));
            })
            ->rawColumns(['name'])
            ->escapeColumns([])

            ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Project::where('service_provider_id', Auth::user()->serviceProvider()->first()->id)->selectRaw('distinct projects.*');
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->addAction(['width' => '80px'])
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'DT_Row_Index', 'name' => 'id', 'title' => '#', 'searchable' => false],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name', 'searchable' => true],
            ['data' => 'is_accepted', 'name' => 'is_accepted', 'title' => 'Status', 'searchable' => true]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'projectsdatatables_' . time();
    }
}
