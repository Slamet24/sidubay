<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }
    
    public function proses_login(Request $request)
    {
        request()->validate([
        'email' => 'required|email',
        'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect('admin');
            } elseif ($user->level == 'peserta') {
                return redirect('peserta');
            }
            return redirect('/');
        }
        return redirect('login')->withSuccess('Oppes! Silahkan Cek Inputanmu');
    }

    public function proses_daftar(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'nama' => 'required|string',
            'email' => 'required|email|unique:users',
            'tanggal_lahir' => 'required|string',
            'instansi' => 'required|string'
        ]);

        if ($validate->fails()) {
            return redirect('daftar')->withErrors($validate->errors(),'daftar');
        }

        $validate->validate();

        $insert = User::insert([
            'name' => $request->nama,
            'email' => $request->email,
            'level' => 'peserta',
            'active' => false
        ]);

        if ($insert) {
            $id = User::orderBy('created_at','desc')->select('id')->first();
            $bio = Biodata::create([
                'user_id' => $id->id,
                'tanggal_lahir' => $request->tanggal_lahir,
                'instansi' => $request->instansi
            ]);

            if ($bio) {
                return redirect('daftar')->with('status','Berhasil mendaftar. Tunggu hingga Admin memverifikasi.');
            }
            return redirect('daftar')->with('status','Gagal saat membuat Biodata.');
        }
        return redirect('daftar')->with('status','Gagal mendaftar.');
    }

    public function daftar()
    {
        return view('daftar');
    }

    public function logout(Request $request) {
        $request->session()->flush();
        Auth::logout();
        return redirect('login');
    }
}
