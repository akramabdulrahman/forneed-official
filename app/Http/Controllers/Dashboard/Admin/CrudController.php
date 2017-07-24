<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\Users\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Laracasts\Flash\Flash;

class CrudController extends Controller
{
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('dashboard.admin.crud');
    }

    public function create()
    {
        return view('dashboard.admin.forms.create', ['user' => new user(), 'roles' => Role::pluck('name', 'id')]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }
        return view('dashboard.admin.forms.edit',
            ['roles' => Role::pluck('name', 'id')])->with('user', $user);
    }

    public function store(UserRequest $request)
    {
        $input = $request->all();
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);
        if (isset($input['roles'])) {
            $user->roles()->attach($input['roles']);
        }
        Flash::success('User saved successfully.');
        return redirect()->back();
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }
        $input = $request->all();
        $user->update([
            'name' => $input['name'],
            'email' => $input['email'],
        ]);
        if (!isset($input['roles'])) {
            $input['roles'] = [];
        }
        $user->roles()->sync($input['roles']);
        Flash::success('User updated successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect()->back();
        }
        $user->delete($id);
        Flash::success('User deleted successfully.');
        return redirect()->back();
    }
}
