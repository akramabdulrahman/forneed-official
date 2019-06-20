<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;

class ServiceProviderDataTable extends BaseDatatable
{

    private $includes = [];

    /**
     *
     */
    function include($var)
    {
        $this->includes[$var['name']] = $var['val'];
        return $this;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        ;
        $request = $this->request();
        $query = $this->repo->getPopulated();

        if ($request->has('name')) {
            $query->whereHas('user', function ($u) use ($request) {
                if ($request->has('name') && $name = $request->input('name')) {
                    $u->where('name', $name);
                }
            });
        }

        if ($request->has('criteria') && $targets = $request->input('criteria')) {
            $query->whereHas('extras', function ($t) use ($targets) {
                $t->whereIn('extra_id', $targets);
            });
        }

        if ($request->has('targets')) {
            $query->whereHas('projects', function ($p) use ($request) {

                if ($request->has('targets') && $targets = $request->input('targets')) {
                    $p->whereHas('extras', function ($t) use ($targets) {
                        $t->whereIn('extra_id', $targets);
                    });
                }
            });
        }


        return $this->applyScopes($query);
    }
}
