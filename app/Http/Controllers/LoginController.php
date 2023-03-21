<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function edit(User $user)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect('/register')
        ->with('success','Berhasil Hapus !');
    }

    public function login()
    {
        return view('resource.login');
    }

    public function register()
    {
        return view('resource.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authanticate(Request $request)
    {

        $login = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($login)) {
            $request->session()->regenerate();
            $id = Auth::user()->_id;


            //return redirect()->intended('/register');
            if (Auth::user()->role == 'admin') {
                return redirect("/admin")->with('success', 'login berhasil!');
            }elseif (Auth::user()->role == 'petugas') {
                return redirect("/homepetugas")->with('success', 'login berhasil!');
            }elseif (Auth::user()->role == 'masyarakat') {
                return redirect("/home")->with('success', 'login berhasil!');
            }
            // return redirect("/simbiling/dashboard")->with('error', 'login berhasil!');
        }
        return back()->with('error', 'Password Salah')->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


}
