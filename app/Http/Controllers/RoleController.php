<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Facade;
use Yoeunes\Toastr\Facades\Toastr;
use Yoeunes\Toastr\Toastr as ToastrToastr;

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
        // dd(Permission::all());
        return view('admin.roles.edit',[
            'role'=>$role,
            'permissions'=>Permission::all()
        ]);
    }

    public function update(Role $role)
    {
        request()->validate([
            'name'=>['required']
        ]);

        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::lower(request('name'));

        if ($role->isDirty('name')) {

            Toastr::success('Role has been updated', 'Update',[
                'showEasing'=>'linear',
                'hideEasing'=>'swing',
                'showMethod'=>'fadeIn',
                'hideMethod'=>'fadeOut'
            ]);

            $role->save();
            return redirect()->route('roles.index');
        }

        else{
            toastr()->warning('Not Change Anything');
            return back();
        }

        

        

        
    }
}
