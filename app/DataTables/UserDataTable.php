<?php

namespace App\DataTables;

use App\User;
use Form;
use Intervention\Image\Facades\Image;
use Yajra\Datatables\Services\DataTable;

class UserDataTable extends BaseDatatable
{

//    public function __construct(Datatables $datatables, Factory $viewFactory)
//    {
//        parent::__construct($datatables, $viewFactory);
//    }


    /**
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($row) {
                $modelRoute = "Dashboard.admin.crud";
                $id = $row->id;
                return view('dashboard.layout.datatables_actions', compact('modelRoute', 'id'));
            })
            ->editColumn('avatar', function ($row) {
                return '<img src="' . route('admin.users.image', ['id' => $row->id]) . '"  width=70 alt=""></div>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public
    function query()
    {
        $users = User::with('roles')->selectRaw('distinct users.*')->orderBy('created_at', 'desc');
        return $this->applyScopes($users);
    }


    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'avatar' => ['name' => 'avatar', 'data' => 'avatar', 'searchable' => false, 'orderable' => false, 'width' => '20px'],
            'name' => ['name' => 'name', 'data' => 'name'],
            'email' => ['name' => 'email', 'data' => 'email'],
            'user_type' => ['name' => 'roles.name', 'data' => 'userType', 'searchable' => true, 'orderable' => true],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected
    function filename()
    {
        return 'users';
    }
}
