<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Facade;
use Yoeunes\Toastr\Facades\Toastr;

class RoleController extends Controller
{
    //
    public function index()
    {
        return view('admin.roles.index',[
            'roles'=>Role::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name'=>['required']
        ]);
        Role::create([
            'name'=> Str::ucfirst(request('name')),
            'slug'=> Str::lower(request('name'))
        ]);

        return back();
        // dd(request('name'));
    }

    public function destroy(Role $role)
    {
        $role->delete();

        // session()->flash('role-deleted-message', 'Role has been deleted');

        Toastr::error('Role has been deleted');

        return back();
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit',['role'=>$role]);
    }

    public function update(Role $role)
    {
        request()->validate([
            'name'=>['required']
        ]);

        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::lower(request('name'));

        $role->save();

        Toastr::success('Role has been updated', 'Update',[
            'showEasing'=>'linear',
            'hideEasing'=>'swing',
            'showMethod'=>'fadeIn',
            'hideMethod'=>'fadeOut'
        ]);

        return redirect()->route('roles.index');
    }
}
