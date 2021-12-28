<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PesertaController extends Controller
{
    public function index()
    {
        $peserta = Biodata::find(Auth::user()->id)->first();
        return view('peserta.profile',['peserta' => $peserta]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'nama' => 'required|string',
            'email' => 'required|email',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
            'foto_closeup' => 'image|mimes:jpg,jpeg,png',
            'foto_full' => 'image|mimes:jpg,jpeg,png',
            'cv' => 'file|mimes:pdf,doc,docx',
            'karya_tulis' => 'file|mimes:pdf,doc,docx',
        ]);

        if ($validate->fails()) {
            return redirect('peserta')->withErrors($validate->errors(),'peserta');
        }

        $validate->validate();
        
        if ($request->hasFile('foto_closeup')) {
            $filenameClose = uniqid().'-'.now()->timestamp.'.'.$request->file('foto_closeup')->getClientOriginalExtension();
            Storage::putFileAs('bio',$request->file('foto_closeup'),$filenameClose);
        }

        if ($request->hasFile('foto_full')) {
            $filenameFull = uniqid().'-'.now()->timestamp.'.'.$request->file('foto_full')->getClientOriginalExtension();
            Storage::putFileAs('bio',$request->file('foto_full'),$filenameFull);
        }

        if ($request->hasFile('cv')) {
            $filenameCV = uniqid().'-'.now()->timestamp.'.'.$request->file('cv')->getClientOriginalExtension();
            Storage::putFileAs('bio',$request->file('cv'),$filenameCV);
        }

        if ($request->hasFile('karya_tulis')) {
            $filenameKarya = uniqid().'-'.now()->timestamp.'.'.$request->file('karya_tulis')->getClientOriginalExtension();
            Storage::putFileAs('bio',$request->file('karya_tulis'),$filenameKarya);
        }

        $user = User::where('id',Auth::user()->id)->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);
        $updatedBio = [
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
        ];

        if ($request->hasFile('foto_closeup')) {
            $updatedBio['foto_closeup'] = $filenameClose;
        }

        if ($request->hasFile('foto_full')) {
            $updatedBio['foto_body'] = $filenameFull;
        }

        if ($request->hasFile('cv')) {
            $updatedBio['cv'] = $filenameCV;
        }

        if ($request->hasFile('karya_tulis')) {
            $updatedBio['karya_tulis'] = $filenameKarya;
        }
        
        $bio = Biodata::where('user_id',Auth::user()->id)->update($updatedBio);

        if ($user && $bio) {
            return redirect('peserta')->with('status','Berhasil mengubah Biodata.');
        }
        return redirect('peserta')->with('status','Gagal mengubah Biodata.');
    }
}
