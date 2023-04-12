<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Gate;


class AuthController extends Controller
{

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->isAdmin()) {
                return redirect()->intended('/dashboard')->withSuccess('You have Successfully loggedin as admin');
            }
            return redirect()->intended('/')->withSuccess('You have Successfully loggedin');
        }

        // Peringatan dengan menggunakan method withError()
        return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("login")->withSuccess('Great! You have Successfully Register');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if (Auth::check()) {
            if (Auth::user()->isAdmin()) {
                return view('admin.dashboard');
            } else {
                return view('pages.dashboard');
            }
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        event(new Registered($user)); // tambahkan kode ini untuk mengirimkan email verifikasi

        return $user;
    }
    public function login(Request $request)
    {
        // Proses login
        // ...

        // Simpan informasi pengguna ke dalam sesi baru
        session(['user' => Auth::user()]);

        // Redirect ke halaman utama
        return redirect('/');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
