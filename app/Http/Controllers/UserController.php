<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Tables\UserTable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use ProtoneMedia\Splade\Facades\Toast;

class UserController extends Controller
{
    public function index() : View
    {
        return view('users.index',  ['users' => UserTable::class]);
    }
    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request) : RedirectResponse
    {
        User::query()->create($request->validated());

        Toast::message("Uspješno kreiran korisnik!")->autoDismiss(5);

        return redirect()->route('users.index');
    }

    public function update(User $user, UpdateUserRequest $request)
    {

        $user->update($request->validated());

        Toast::message("Uspješno izmijenjen korisnik!")->autoDismiss(5);

        return redirect()->route('users.index');
    }

    public function edit(User $user) : View
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->back();
    }
}
