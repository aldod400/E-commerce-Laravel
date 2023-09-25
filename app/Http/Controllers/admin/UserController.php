<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\storeUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $users = User::paginate(10);

        if(!empty($request->get('search')))
            $users = User::where('name','like','%'.$request->get('search').'%')->paginate(10);

        return view('admin.users',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.create-user', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeUserRequest $request)
    {

        $pic = time() . '-' . $request->name . '.' . $request->picture->extension();
        $request->picture->move('storage/images/user-image',$pic);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $request->role,
            'picture'  => $pic,
            'phone'    => $request->phone,
            'country'  => $request->country,
            'city'     => $request->city,
            'address'  => $request->address,
            'status'   => $request->status,
        ]);

        return redirect(route('users.index'))->with('message', 'User Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();
        // dd($user);
        $roles = Role::get();
        return view('admin.update-user', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        if($request->password != null){
            $pic = time() . '-' . $request->name . '.' . $request->picture->extension();
            $request->picture->move('storage/images/user-image',$pic);

            User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'picture' => $pic,
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'status' => $request->status,
            ]);
        }else{
            User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'status' => $request->status,
            ]);
        }

        return redirect(route('users.index'))->with('message','User Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect(route('users.index'))->with('message', 'User Deleted');
    }
}
