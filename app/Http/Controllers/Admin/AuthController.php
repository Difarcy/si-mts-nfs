<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect to admin dashboard
            $request->session()->forget('url.intended');
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil.');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function updateUsername(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'username' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z0-9_-]+$/', 'unique:user,username,' . $user->id],
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'current_password.current_password' => 'Kata sandi saat ini tidak sesuai.',
            'username.required' => 'Username baru wajib diisi.',
            'username.max' => 'Username maksimal :max karakter.',
            'username.regex' => 'Username hanya boleh berisi huruf, angka, underscore (_), dan dash (-).',
            'username.unique' => 'Username sudah digunakan. Silakan gunakan username lain.',
        ]);

        if ($validated['username'] === $user->username) {
            return back()->withErrors([
                'username' => 'Username baru tidak boleh sama dengan username saat ini.',
            ])->onlyInput('username');
        }

        $user->username = $validated['username'];
        $user->save();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Username berhasil diubah. Silakan login kembali.');
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'regex:/\d/', 'confirmed'],
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'current_password.current_password' => 'Kata sandi saat ini tidak sesuai.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal :min karakter.',
            'password.regex' => 'Kata sandi baru harus mengandung minimal 1 angka.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak sama.',
        ]);

        if (Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Kata sandi baru tidak boleh sama dengan kata sandi saat ini.',
            ]);
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login kembali.');
    }
}
