<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman form login
     */
    public function showLoginForm()
    {
        return view('pages.login');
    }

    /**
     * Memproses otentikasi login
     */
    public function login(Request $request)
    {
        // Validasi input dari form
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'role'     => 'required|in:admin,client,artist'
        ]);

        // Mencoba login dengan mencocokkan Email, Password, DAN Role.
        // Ini memastikan Client tidak bisa login melalui form Admin, dsb.
        if (Auth::attempt([
            'email'    => $credentials['email'], 
            'password' => $credentials['password'], 
            'role'     => $credentials['role']
        ])) {
            
            // Regenerasi session untuk keamanan (mencegah session fixation)
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect ke dashboard masing-masing sesuai role
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->role === 'client') {
                return redirect()->intended(route('client.dashboard'));
            } elseif ($user->role === 'artist') {
                return redirect()->intended(route('editor.dashboard'));
            }
        }

        // Jika gagal login (kredensial salah atau role tidak cocok)
        return back()->withErrors([
            'email' => 'Kredensial tidak valid atau tidak cocok dengan otoritas peran (role) yang Anda pilih.',
        ])->onlyInput('email');
    }

    /**
     * Memproses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}