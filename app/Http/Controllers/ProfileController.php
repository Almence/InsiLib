<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view("profile");
    }

    public function updateNameClass(Request $request)
    {
        $user = auth()->user();

        $request->validate(['name' => 'required|string|max:255', 'kelas' => 'nullable|string|max:255']);

        $user->name = $request->name;
        $user->kelas = $request->kelas;

        $user->save();

        return redirect()->back()->with('success', 'Nama berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate(['password'=> 'nullable|min:6|confirmed']);

        if ($request->filled('password')) {
            $user->password = Hask::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui!');
    }

    public function updateAvatar(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && \Storage::disk('public')->exists($user->profile_image)) {
                \Storage::disk('public')->delete($user->profile_image);
            }

            $path =  $request->file('profile_image')->store('profiles', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil diperbarui!');
    }
}