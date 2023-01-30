<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yoeunes\Toastr\Facades\Toastr;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index',['users'=>$users]);
    }

    public function show(User $user)
    {
        return view('admin.users.profile', [
            'user'=>$user,
            'roles'=>Role::all(),
        
        
        ]);
        
    }

    public function update(User $user)
    {
        $inputs = request()->validate([
            'username'=> ['min:5','string', 'max:255', 'alpha_dash'],
            'name' => ['min:5','string', 'max:255'],
            'email' =>['email', 'max:255'],
            'avatar' => ['file:jpg,jpeg,png'],
            'password' => 'max:15',
            'confirm-password'=>'same:password',
        ]);

        if (request('avatar')) {
            $inputs['avatar'] = request('avatar')->store('images');
        }
        if (!request('password') || request('password') == null ) {
            unset($inputs['password']);   
        }
        if (!request('confirm-password') || request('confirm-password') == null ) {
            unset($inputs['confirm-password']);
        }
        $user->update($inputs);

        return back();
    }
    public function attach(User $user)
    {
        $user->roles()->attach(request('role'));

        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();

        // session()->flash('user-deleted', 'User has been deleted');
        Toastr::warning('User Deleted');

        return back();
    }

    public function detach(User $user)
    {
        $user->roles()->detach(request('role'));

        return back();
    }

    public function info(User $user)
    {
        return view('admin.users.userInfo', [
            'user'=>$user,
            'roles'=>$user->roles(),
        ]);
    }
}
