<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        return Datatables::of(User::query())->addColumn('action', function ($user) {
            return '

                <div class="btn-group btn-octonary">
                    <a type="button" href="' . route('users.show', [$user->id]) . '" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-success" href="' . route('users.edit', [$user->id]) . '"><i class="fa fa-edit"></i></a>
                   
                </div>
            ';

        })
            ->make(true);
    }

    public function index()
    {
        $data['users'] = User::all();
        return view('admin.users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasPermissionTo('create user')) {
            $data['user'] = User::all();
            flash(__('User Created Successfully'))->success();
            return view('admin.users.create')->with($data);
        } else {
            flash(__('You are Not Permitted to Create User'))->error();
            return redirect()->action("UserController");

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password == $request->confirm_password) {
            $user->password = bcrypt($request->password);
        } else {
            flash(__('password did not match'))->error();
            return redirect()->action('UserController@create');
        }
        $user->save();
        return redirect()->action('UserController@create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('view user')) {
            $data['user'] = User::with('roles')->find($id);
            return view('admin.users.view')->with($data);
        } else {
            flash(__('You are Not Permitted to Create User'))->error();
            return redirect()->action("UserController");

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->hasPermissionTo('edit user')) {
            $data['user'] = User::with('roles')->find($id);
            $data['roles'] = Role::all();
            return view('admin.users.edit')->with($data);
        } else {
            flash(__('You are Not Permitted to Create User'))->error();
            return redirect()->action("UserController");

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->save();
        $role = $request->input('role');

        $user->roles()->sync($role);
        return redirect()->action("UserController@index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        if (auth()->user->hasPermissionTo('delete user')) {
//            $user = User::find($id);
//            $role = $user->roles->all();
//            if (!$user) {
//                flash(__('unable to find user'))->error();
//                 return response()->json([
//                    "error" => true,
//                    "message" => 'User Does not exist'
//                ], 400);
//            } elseif (!empty($role)) {
//                flash(__('Can not delete User Role Exist for user!!'))->error();
//                return response()->json([
//                    "error" => true,
//                    "message" => 'User Role exist'
//                ], 400);
//            } else {
//                $delete = $user->delete();
//                if ($delete) {
//                    flash(__('User deleted Successfully'))->success();
//                    return response()->json([
//                        "error" => true,
//                        "message" => 'User deleted successfully'
//                    ], 400);
//                }
//                else{
//                    flash(__('user cannot be deleted'))->error();
//                    return response()->json([
//                        "error" => true,
//                        "message" => 'user cannot be deleted'
//                    ], 400);
//                }
//            }
//
//        } else {
//            flash(__('You are Not Permitted to Delete User'))->error();
//            return view('admin.roles.index');
//        }

    }
}
