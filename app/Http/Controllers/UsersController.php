<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with(['position'])->get();

        return Inertia::render('User/Users', [
            'userData' => $users,
        ]);
    }
    public function show(User $user)
    {
        return Inertia::render('User/UsersShow', [
            'user' => $user->load('position'),
        ]);
    }

    public function create()
    {
        return Inertia::render('User/UsersCreate', [
            'positions' => Position::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => ['required', 'string', 'unique:users,nip'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'position_id' => ['nullable', 'exists:positions,id'],
        ]);

        User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'position_id' => $request->position_id,
            'password' => 'password', //default gan 🗿 // 🙇🏽‍♂️ \\
        ]);

        return redirect()->route('users')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        $positions = Position::all();

        return Inertia::render('User/UsersEdit', [
            'user' => $user->load('position'),
            'positions' => $positions,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'position_id' => ['nullable', 'exists:positions,id'],
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'position_id' => $request->position_id,
        ]);

        return redirect()->route('users')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'Pengguna berhasil dihapus!');
    }
}
