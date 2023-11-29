<?php

namespace App\Http\Controllers;

// use App\Models\Role;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role; //FAI-231
use Spatie\Permission\Models\Permission;  //FAI-231

/**
 * Class RoleController
 * @package App\Http\Controllers
 */
class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $txtBuscar = $request->get('txtBuscar');
        $roles = Role::where('name', 'like', '%' . $txtBuscar . '%')->paginate();

        return view('role.index', compact('roles', 'txtBuscar'))
            ->with('i', (request()->input('page', 1) - 1) * $roles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();
        //Obtengo todos los permisos de la BD
        $permisos = Permission::get()->pluck('name', 'name');

        return view('role.create', compact('role','permisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request()->validate(Role::$rules);

        $role = Role::create($request->all());

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        //Obtengo todos los permisos de la BD
        $permisos = Permission::get()->pluck('name', 'name');

        return view('role.show', compact('role', 'permisos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        //Obtengo todos los permisos de la BD
        $permisos = Permission::get()->pluck('name', 'name');

        return view('role.edit', compact('role', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //request()->validate(Role::$rules);

        $role->update($request->all());

        //Asigno Permisos
        $role->syncPermissions($request->input('asignarPermisos'));

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $role = Role::find($id)->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
