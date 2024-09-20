<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', ['users' => User::all()]);
    }

    public function create()
    {
        return view('admin.user.create', ['user' => new User]);
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        $data = $request->all();
        $data['role'] = 'admin';

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = Hash::make('123456789');
        }

        $user = $user->create($data);

        return redirect()->route('admin.user.index');
    }

    public function show(User $user)
    {
        return view('admin.user.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => Rule::unique('users')->ignore($user->id)
        ]);

        $data = $request->all();

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        if (array_key_exists('redirect', $data)) return redirect()->route('admin.dashboard')->with('success', __('Updated'));

        return redirect()->route('admin.user.index')->with('success', __('Updated'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return 'success';
    }

    public function relogin(Request $request, User $user)
    {
        if (Auth::user()->role == 'admin') {
            $request->session()->put('user', Auth::user()->id);
        }

        if ($request->session()->has('user')) {
            Auth::login($user);
            if ($user->role == 'admin') {
                $request->session()->forget('user');
            }
            return redirect()->route('/')->with('success', 'You now: '.$user->username);
        } else {
            return redirect('/');
        }
    }

}
