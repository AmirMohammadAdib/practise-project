<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Repository\Elequents\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(private UserRepository $elequent_user){
        $this->authorizeResource(User::class, "user");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->elequent_user->all();
        return view("admin.user.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.user.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->elequent_user->store($request->toDTO());
        return redirect()->route("user.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = $this->elequent_user->find($user->id);
        return view("admin.user.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $request->password = $user->password;
        $this->elequent_user->update($user, $request->toDTO());
        return redirect()->route("user.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
