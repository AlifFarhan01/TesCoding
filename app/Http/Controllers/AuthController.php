<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function index ()
    {
        return view('auth/login');
    }

    function login (Request $request)
    {
        $request->validate([
            'email'=> 'required',
            'password'=>'required'
        ],[
            'email.required'=>'email wajib di isi',
            'password.required'=>'password wajib di isi',
        ]);

        $info=[
            'email'=> $request->email,
            'password'=> $request->password,
        ];

        if(Auth::attempt($info)){
            if(Auth::user()->role == 'penyewa'){
                return redirect('/home');
            }
            elseif(Auth::user()->role == 'pemilik'){
                return redirect('/kelolakendaraan');
            }
           
         } else {

               Session::flash('error', 'Email dan Password Salah');
        return redirect()->back()->withInput();
            }

        
    }

function regisview ()
    {
        return view('auth/register');
    }
function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'alamat' => ['required', 'string', 'max:255'],
            'notelp' => ['required', 'string', 'max:255'],
            'nosim' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:penyewa,pemilik'], // Menambahkan validasi untuk field 'role'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'notelp' => $request->notelp,
            'nosim' => $request->nosim,
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }


    function logout(){
        Auth::logout();
        return redirect('');
    }
}
