<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;

class ServiceProviderDataTable extends BaseDatatable
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
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
;        $request = $this->request();
        $query = $this->repo->getPopulated();

        if ($request->has('name')) {
            $query->whereHas('user', function ($u) use ($request) {
                if ($request->has('name') && $name = $request->input('name')) {
                    $u->where('name', $name);
                }
            });
        }

        if ($request->has('area')) {
            $query->whereHas('areas', function ($a) use ($request) {
                if ($request->has('area') && $area = $request->input('area')) {
                    $a->where('area_service_provider.area_id', $area);
                }
            });
        }
        if ($request->has('sector')) {
            $query->whereHas('sectors', function ($s) use ($request) {
                if ($request->has('sector') && $sector = $request->input('sector')) {
                    $s->where('sector_service_provider.sector_id', $sector);
                }
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
