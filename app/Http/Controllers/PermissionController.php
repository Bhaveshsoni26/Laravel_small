<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yoeunes\Toastr\Facades\Toastr;

class PermissionController extends Controller
{
    //
    public function index()
    {
        return view('admin.permissions.index',[
            'permissions'=>Permission::all(),

        ]);
    }

    public function store()
    {
        request()->validate([
            'name'=>['required']
        ]);
        Permission::create([
            'name'=> Str::ucfirst(request('name')),
            'slug'=> Str::of(Str::lower(request('name')))->slug('-')
        ]);

        return back();
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit',[
            'permissions'=>$permission,
        ]);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        toastr()->error('Permission Deleted', 'Delete');

        return back();
    }

    public function update(Permission $permission)
    {
        request()->validate([
            'name'=>['required']
        ]);

        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        if ($permission->isDirty('name')) {

            Toastr::success('Permission has been updated', 'Update',[
                'showEasing'=>'linear',
                'hideEasing'=>'swing',
                'showMethod'=>'fadeIn',
                'hideMethod'=>'fadeOut'
            ]);

            $permission->save();
            return redirect()->route('permissions.index');
        }

        else{
            toastr()->warning('Not Change Anything');
            return back();
        }
    }
}
