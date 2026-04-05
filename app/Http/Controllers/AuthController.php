<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    //
    public function register()
    {
        return view("auth.register");
    }

    public function logicRegister()
    {
        $nama_lengkap = request()->nama_lengkap;
        $username = request()->username;
        $email = request()->email;
        $password = request()->password;
        $konfirmasi_password = request()->konfirmasi_password;

        if ($password != $konfirmasi_password) {
            return redirect()->back()->withInput()->with('error', 'Password tidak cocok');
        }

        $validation = Validator::make(request()->all(), [
            'username' => 'required|min:3|unique:users,username',
            'password' => ['required', \Illuminate\Validation\Rules\Password::min(8)->mixedCase()->numbers()->symbols()],
            'konfirmasi_password' => 'required|min:8',
            'email' => 'required|email|unique:users,email',
            'nama_lengkap' => 'required|min:3',
        ], [
            'password.mixed' => 'Password harus mengandung kombinasi huruf kapital (A-Z) dan huruf kecil.',
            'password.numbers' => 'Password harus mengandung setidaknya satu angka (0-9).',
            'password.symbols' => 'Password harus mengandung setidaknya satu simbol khusus (@$!%*?&).',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error', $validation->errors()->first());
        }

        $insertUser = User::create([
            'name' => $nama_lengkap,
            'username' => $username,
            'email' => $email,
            'password' => bcrypt($password),
            'role' => 'user',
        ]);

        if ($insertUser) {
            return redirect()->route('login')->with('success', 'Register berhasil');
        } else {
            return redirect()->back()->withInput()->with('error', 'Register gagal');
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function logicLogin()
    {
        $username = request()->username;
        $password = request()->password;

        $validation = Validator::make(request()->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with('error', $validation->errors()->first());
        }

        $user = User::where('username', $username)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                Auth::login($user);
                $roleUser = Auth::user()->role;
                return redirect()->route('dashboard', ['role' => $roleUser]);
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
