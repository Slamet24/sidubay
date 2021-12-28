<?php

namespace App\Http\Controllers;

use App\Models\Artikel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArtikelController extends Controller
{
    public function index()
    {
        $data_artikel = Artikel::all();
        return view('artikel.index',[ 'artikel' => $data_artikel ]);
    }

    public function editForm($id)
    {
        $data_artikel = Artikel::find($id)->first();
        return view('artikel.edit',[ 'artikel' => $data_artikel ]);
    }

    public function form()
    {
        return view('artikel.tambah');
    }

    public function tambah(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
            'judul.required' => 'Mohon isi Judul Artikel.',
            'foto.image' => 'File bukan bertipe gambar.',
        ]);

        if ($validate->fails()) {
            return redirect('admin/artikel')->withErrors($validate->errors(),'artikel');
        }

        $validate->validate();

        if ($request->hasFile('foto')) {
            $filename = uniqid().'-'.now()->timestamp.'.'.$request->file('foto')->getClientOriginalExtension();
            Storage::putFileAs('artikels',$request->file('foto'),$filename);
        }

        $insert = Artikel::insert([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'foto' => $filename
        ]);

        if ($insert) {
            return redirect('admin/artikel')->with('status','Berhasil menambahkan Artikel');
        }
        return redirect('admin/artikel')->with('status','Gagal menambahkan Artikel');
    }


    public function edit(Request $request,$id)
    {
        $validate = Validator::make($request->all(),[
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'foto' => 'image|mimes:jpg,jpeg,png'
        ],[
            'judul.required' => 'Mohon isi Judul Artikel.',
            'foto.image' => 'File bukan bertipe gambar.',
        ]);

        if ($validate->fails()) {
            return redirect('admin/artikel')->withErrors($validate->errors(),'admin/artikel');
        }

        $validate->validate();
        
        if ($request->hasFile('foto')) {
            $filename = uniqid().'-'.now()->timestamp.'.'.$request->file('foto')->getClientOriginalExtension();
            Storage::putFileAs('artikels',$request->file('foto'),$filename);
        }

        $insData = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori
        ];


        if ($request->hasFile('foto')) {
            $insData['foto'] = $filename;
        }

        $insert = Artikel::where(['id' => $id])->update($insData);

        if ($insert) {
            return redirect('admin/artikel')->with('status','Berhasil menambahkan Artikel');
        }
        return redirect('admin/artikel')->with('status','Gagal menambahkan Artikel');
    }

    public function hapus($id)
    {
        $exists = Artikel::find($id)->first();
        if (!$exists) {
            abort(404);
        }

        $delete = Artikel::destroy($id);
        if ($delete) {
            return redirect('admin/artikel')->with('status','Berhasil menghapus Artikel');
        }
        return redirect('admin/artikel')->with('status','Gagal menghapus Artikel');
    }
}
