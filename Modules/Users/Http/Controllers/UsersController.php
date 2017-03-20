<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Users\Entities\Role;
use Modules\Users\Entities\User;
use Alert;
use Modules\Users\Http\Requests\EditUser;
use Modules\Users\Http\Requests\NewUser;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users = User::get();

        return view('users::users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name');
        return view('users::users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(NewUser $request)
    {

        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());
        $user->assignRole($request->role);
        Alert::success('Se ha Creado Correctamente');
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param id
     * @return Response
     */
    public function edit($id)
    {

        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'name');
        return view('users::users.create', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     * @param $id
     * @param  Request $request
     * @return Response
     */
    public function update($id, EditUser $request)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        if($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->removeRole(Role::all());
        $user->assignRole($request->role);
        $user->save();
        Alert::success('Se editó Correctamente');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Alert::error('No puede eliminar su propio Usuario');
        if(($user->id != Auth::user()->id)) {
            $user->delete();
            Alert::success('Se eliminó el usuario correctamente');
        }

    }
}
