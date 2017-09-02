<?php

namespace App\DataTables;

use App\Models\Project;
use App\User;
use Yajra\Datatables\Services\DataTable;

class ProjectsDataTablePending extends BaseDatatable
{
    /**
     * Display ajax response.
     *
     * @return \Yajra\Datatables\Engines\EloquentEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($row) {
                $modelRoute = str_replace('\\', '-', Project::class);
                $id = $row->id;
                return view('dashboard.organizations.forms.accept-org', compact('modelRoute', 'id'));
            });
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Project::with(array('serviceProvider','sector'))->selectRaw(' projects.*');
        $query->where('is_accepted', false);
        return $this->applyScopes($query);
    }


    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => '',
                'title' => '',
                'data' => null,
                'searchable' => false,
                'orderable' => false,
                'sorting' => 'false',
                'width' => '20px',
                'className' => 'details-control',
                "defaultContent" => '+'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name', 'searchable' => true]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'projectsdatatablependings_' . time();
    }
}
