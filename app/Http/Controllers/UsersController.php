<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        $users = UserResource::collection(User::with(['position'])->paginate(10));

        return Inertia::render('User/Index', [
            'userRes' => $users,
        ]);
    }
    public function show(User $user)
    {
        return Inertia::render('User/Show', [
            'user' => $user->load('position'),
        ]);
    }

    public function create()
    {
        return Inertia::render('User/Create', [
            'positions' => Position::all(),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'position_id' => $request->position_id,
            'password' => 'password', //default gan 🗿 // 🙇🏽‍♂️ \\
        ]);

        return Redirect::route('users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        $positions = Position::all();

        return Inertia::render('User/Edit', [
            'user' => $user->load('position'),
            'positions' => $positions,
        ]);
    }
    
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return Redirect::route('users.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        return $user->delete();
    }
}
