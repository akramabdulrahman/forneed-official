<?php

namespace App\DataTables;

use App\Models\Users\SocialWorker;
use App\User;
use Yajra\DataTables\Services\DataTable;

class SocialWorkerDatatablePending extends BaseDatatable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function with($key, $val = Null)
    {
        $this->$key = $val;
        return $this;
    }

    public function dataTable()
    {
        return $this->ajaxConfig($this->query())
            ->editColumn('is_accepted', function ($worker) {
                return $worker->is_accepted ? 'true' : '-';
            })
            ->editColumn('cv', function ($worker) {

                $route = route('files', str_replace('public/cvs/', '', $worker->cv));
                return "<a href='{$route}' class='btn'><i class='glyphicon glyphicon-download-alt'></i></a>";
            })
            ->addColumn('action', function ($row) {
                $modelRoute = str_replace('\\', '-', SocialWorker::class);
                $id = $row->id;

                $project_id = $this->project_id;
                return view('dashboard.organizations.forms.accept-org', compact('modelRoute', 'id', 'project_id'));
            })->escapeColumns([]);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = SocialWorker::with(array('user','area','extras'))->selectRaw(' social_workers.*');
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
        return collect([

            ['title' => 'Name', 'name' => 'user.name', 'data' => 'user.name', 'searchable' => true],
            ['data' => 'area.name', 'name' => 'area.name', 'title' => 'Area', 'searchable' => true],
            ['title' => 'Address', 'name' => 'address', 'data' => 'address', 'searchable' => true],
            ['title' => 'Mobile',
                'name' => 'mobile',
                'data' => 'mobile', 'searchable' => true],
            ['title' => 'Telephone',
                'name' => 'telephone',
                'data' => 'telephone', 'searchable' => true],
            ['title' => 'CV',
                'name' => 'cv',
                'data' => 'cv', 'searchable' => true],
            ['title' => 'Accepted',
                'name' => 'is_accepted',
                'data' => 'is_accepted', 'searchable' => true],
            'created_at' => ['name' => 'created_at', 'data' => 'created_at'],
            'updated_at' => ['name' => 'updated_at', 'data' => 'updated_at']
        ])->merge(collect(config('extra_types.social_worker'))
            ->map(function ($item) {
                return [
                    'data' => "extrasPopulated.{$item}",
                    'name' => "extras.extra",
                    'title' => ucfirst(str_replace('_', ' ', snake_case($item))),
                    'searchable' => true,
                    'defaultContent' => '-',
                    'orderable' => 'false',
                    'sorting' => 'true'];
            }))->toArray();
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'socialworkerdatatables_' . time();
    }
}
