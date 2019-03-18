<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function getRoles()
    {
        return Datatables::of(Role::query())->addColumn('action', function ($role) {
            return '

                <div class="btn-group btn-octonary">
                    <a type="button" href="' . route('roles.show', [$role->id]) . '" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-success" href="' . route('roles.edit', [$role->id]) . '"><i class="fa fa-edit"></i></a>
  
                </div>
            ';

        })
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data['role'] = Role::all();
            return view('admin.roles.index')->with($data);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasPermissionTO('create role')) {
            return view('admin.roles.create');
        }
        else{
            flash(__('You are Not Permitted to Create Role'))->error();
            return redirect()->action("RoleController");

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role;
        $role->name =$request->name;
        $role->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->user()->hasPermissionTO('view role')) {
        $data['roles'] = Role::with('permissions')->find($id);
        return view('admin.roles.view')->with($data);
    }
    else{
        flash(__('You are Not Permitted to view Role'))->error();
        return redirect()->action("RoleController");

    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->hasPermissionTO('view role')) {
            $data['role'] = Role::with('permissions')->find($id);
            $data['permissions'] = Permission::all();
            return view('admin.roles.edit')->with($data);
        }
        else{
            flash(__('You are Not Permitted to Edit Role'))->error();
            return redirect()->action("RoleController");

        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name= $request->name;
        $role->save();
        $permission = $request->input('permission');
        $role->permissions()->sync($permission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
