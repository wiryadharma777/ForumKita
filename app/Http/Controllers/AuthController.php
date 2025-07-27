<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // Function yang digunakan untuk halaman Daftar Akun
    #region daftar akun
    public static function daftar(){
        return view('auth.daftar');
    }

    public static function daftarProcess(){
        $userdata = request()->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:15|unique:users,username',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:5',
            'password_confirmation' => 'required|same:password',
        ],[
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 100 karakter',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'username.max' => 'Username maksimal 15 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 5 karakter',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi',
            'password_confirmation.same' => 'Konfirmasi password tidak cocok'
        ]);

        $userdata['email'] = strtolower($userdata['email']);
        $userdata['password'] = bcrypt($userdata['password']);

        User::create($userdata);
        return redirect()->back()->with('success', 'Pendaftaran berhasil! ');
    }

    #endregion

    // Function yang digunakan untuk halaman Login Akun
    #region login akun
    public static function login(){
        return view('auth.login');
    }

    public static function loginProcess(){
        $credentials = request()->validate([
            'email' => 'required|email|max:100|',
            'password' => 'required|string|min:5'
        ],[
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 100 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 5 karakter.'
        ]);

        $credentials['email'] = strtolower($credentials['email']);

        if(Auth::attempt($credentials)){
            $user = Auth::user();

            if($user->status == 0){
                Auth::logout();
                return redirect('/login')->with('error', 'Akun ada telah dinonaktifkan.')->withInput();
            }

            request()->session()->regenerate();
            return redirect('/')->with('success', 'Login berhasil!');
        } else {
            return redirect()->back()->with('error', 'Login gagal! Periksa email dan password anda.')->withInput();
        }
    }

    #endregion

    // Function yang digunakan header untuk Logout
    #region logout
    public static function logoutProcess(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logout berhasil!');
    }

    #endregion

    // Function yg digunakan halaman Profile untuk reset password
    #region reset password
    public static function resetPasswordProcess(){
        $data = request()->validate([
            'password_sebelumnya' => 'required|string',
            'password_baru' => 'required|string|min:5',
            'password_baru_confirmation' => 'required|same:password_baru'
        ],[
            'password_sebelumnya.required' => 'Password sebelumnya wajib diisi.',
            'password_baru.required' => 'Password baru wajib diisi.',
            'password_baru.min' => 'Password baru minimal 5 karakter.',
            'password_baru_confirmation.same' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = auth()->user();

        if (!Hash::check($data['password_sebelumnya'], $user->password)) {
            return back()->withErrors(['password_sebelumnya' => 'Password sebelumnya salah.'])->withInput();
        }

        $user->password = Hash::make($data['password_baru']);

        $user->save();

        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Password berhasil diperbarui. Silahkan login.');
    }

    #endregion
}
