<?php

namespace App\DataTables;

use App\Repositories\CitizenRepository;
use App\User;
use Yajra\Datatables\Services\DataTable;

class BaseDatatable extends DataTable implements ConfigurableTable
{
    private $initial_columns = [];
    private $extra_columns = [];
    protected $repo = CitizenRepository::class;
    private $collapse = true;
    private $isExcel = false;

    /**
     * @param $extra [$name,$callback]
     * @return this
     **/
    public function withColumn($extra_columns)
    {
        $this->extra_columns = collect($this->extra_columns)
            ->merge(collect($extra_columns)->filter(function ($column) {
                return count(array_intersect(array_flip(array_keys($column)), ['name', 'callback'])) == 2;
            }))->toArray();
        return $this;
    }

    /**
     * @param $tableReference @type Datatable
     * @return this
     **/
    protected function includeExtraColumns(&$table)
    {
        collect($this->extra_columns)->each(function ($column) use (&$table) {
            $table->addColumn($column['name'], $column['callback']);
        });
        return $table;
    }

    public function uncollapseRows()
    {
        $this->collapse = false;
    }

    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        $table = $this->ajaxConfig();
        return $this->includeExtraColumns($table)
            ->addColumn('action', function ($row) {
                $modelRoute = config("datatables_actions." . class_basename($this->repo->model()));
                $id = $row->id;
                return view(config('datatables_actions.general_actions_view'), compact('modelRoute', 'id'));
            });
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = $this->repo->getPopulated();
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
            ->parameters(([
                'order' => [[0, 'desc']],
                'dom' => 'lBfrtip',
                "bDestroy" => true,
                'buttons' => [
                    'print',
                    'reset',
                    'reload',
                    'export',
                ]
            ]));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $collapse = $this->collapse;
        return collect($this->initial_columns)->pipe(function ($cols) use ($collapse) {
            return $collapse ?
                $cols->prepend([
                    'name' => '',
                    'title' => '',
                    'data' => null,
                    'searchable' => false,
                    'orderable' => false,
                    'sorting' => 'false',
                    'width' => '20px',
                    'className' => 'details-control',
                    "defaultContent" => '+'])
                : $cols;
        })->merge(collect($this->extra_columns)->map(function ($column) {
            return $column['name'];
        }))->toArray();

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return snake_case(class_basename($this->repo->model())) . '_datatable_' . time();
    }

    public function ajaxConfig()
    {
        return $this->datatables->eloquent($this->query());
    }

    public function setColumns($columns)
    {
        $this->initial_columns = $columns;
        return $this;
    }

    public function repoConfig($model)
    {
        ($this->repo = $model);
        return $this;
    }

    protected function buildExcelFile()
    {
        $this->collapse = false;
        return parent::buildExcelFile();
    }
}
