<?php

namespace App\DataTables;

use App\Models\Users\Citizen;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;

class CitizensDatatable extends BaseDatatable
{


    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Auth::user()->worker()->first()->citizens();
        return $this->applyScopes($query);
    }
    /**
     * Build DataTable class.
     *
     * @return \Yajra\DataTables\Engines\BaseEngine
     */
    public function dataTable()
    {
        $table = $this->ajaxConfig();
        return $this->includeExtraColumns($table)
            ->addColumn('action', function ($row) {
                $modelRoute = "endusers.worker";
                $id = $row->user->id;
                return view('endusers.workers.datatables_actions', compact('modelRoute', 'id'));
            });
    }

}
