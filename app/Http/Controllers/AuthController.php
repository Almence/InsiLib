<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ])->onlyInput('email');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil Logout');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function processRegister(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required|string|max:20|unique:users,nis',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nis' => $validatedData['nis'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'user', // Set default role as user
        ]);

        if (!$user) {
            return back()->withErrors([
                'email' => 'Gagal mendaftar. Silakan coba lagi.',
            ])->onlyInput('email');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))->with('success', 'Berhasil mendaftar dan login');
    }

    public function toManageUser()
    {
        $users = User::all();
        return view('admin.user-manager', compact('users'));
    }

    public function updateUserCred(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nis' => 'nullable|string|max:20|unique:users,nis,'.$user->id,
            'name' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:255',
            'password' => 'nullable|max:6',
        ]);

        if ($request->filled('nis')) {
            $user->nis = $request->nis;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;

        $user->kelas = $request->kelas;

        $user->save();

        return redirect()->back()->with('success', 'Update kredensial untuk akun ' . $user->name . ' berhasil!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Akun dengan Email ' . $user->email . ' berhasil dihapus!');
    }

    public function addUser(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required|string|max:20|unique:users,nis',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nis' => $validatedData['nis'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'user', // Set default role as user
        ]);

        if (!$user) {
            return back()->withErrors([
                'email' => 'Gagal mendaftar. Silakan coba lagi.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.user-manager'))->with('success', 'Berhasil menambah akun!');
    }

    public function toAddUser()
    {
        return view('admin.add-account');
    }
}
