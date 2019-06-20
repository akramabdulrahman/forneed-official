<?php

namespace App\DataTables;

use App\Models\Surveys\Survey;
use App\User;
use Yajra\DataTables\Services\DataTable;

class SurveysDataTablePending extends BaseDatatable
{
    /**
     * Display ajax response.
     *
     * @return \Yajra\DataTables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->ajaxConfig($this->query())
            ->addColumn('action', function ($row) {
                $modelRoute = str_replace('\\', '-', Survey::class);
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
        $query = Survey::query();
        $query->where('is_accepted', false);

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */


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
            ['data' => 'subject', 'name' => 'subject', 'title' => 'Subject', 'searchable' => true],
            ['data' => 'description', 'name' => 'description', 'title' => 'description', 'searchable' => true]

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'surveysdatatablependings_' . time();
    }
}
