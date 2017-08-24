<?php

namespace App\DataTables;

use App\Models\Users\SocialWorker;
use App\User;
use Yajra\Datatables\Services\DataTable;

class SurveysWorkersDatatable extends BaseDatatable
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
    public function dataTable()
    {

        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($row) {
                $modelRoute = "Dashboard.work";
                $id = $row->id;
                $survey_id = $this->includes['survey_id'];
                return view('dashboard.workers.actions', compact('modelRoute', 'survey_id', 'id'));
            });
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $request = $this->request();
        $query = SocialWorker::with(array('user'))
            ->whereHas('surveys', function ($s) use ($request) {
                $survey = $this->includes['survey_id'];
                $s->where('social_worker_survey.survey_id', $survey);
            })
            ->where('is_accepted', true)
            ->selectRaw(' social_workers.*');

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
            ['title' => 'Name', 'name' => 'user.name', 'data' => 'user.name', 'searchable' => true],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'surveysworkersdatatables_' . time();
    }
}
