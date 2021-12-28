<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\PassStore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function peserta()
    {
        $peserta = User::where('level','peserta')->leftJoin('pass_store','users.id','=','pass_store.user_id')->select(['users.*','pass_store.plain'])->get();
        return view('admin.peserta',['peserta' => $peserta]);
    }

    public function pesertaEdit($id)
    {
        $exists = User::find($id);
        if (!$exists) {
            abort(404);
        }

        $getPass = $this->_randPass();
        $aktifkan = User::where('id',$id)->update([
            'active' => true,
            'password' => Hash::make($getPass)
        ]);

        $plain = PassStore::updateOrCreate([
            'user_id' => $id
        ],[
            'plain' => $getPass
        ]);

        if ($aktifkan && $plain) {
            return redirect('admin/peserta')->with('status','Berhasil mengaktifkan akun');
        }
        return redirect('admin/peserta')->with('status','Gagal mengaktifkan akun');
    }

    public function pesertaHapus($id)
    {
        $exists = User::find($id);
        if (!$exists) {
            abort(404);
        }

        $plain = PassStore::where(['user_id' => $id])->delete();
        $hapusbio = Biodata::where('user_id',$id)->delete();
        $hapus = User::where('id',$id)->delete();

        if ($hapusbio && $hapus && $plain) {
            return redirect('admin/peserta')->with('status','Berhasil menghapus akun');
        }
        return redirect('admin/peserta')->with('status','Gagal menghapus akun');
    }

    private function _randPass()
    {
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randStr = '';
        for ($i=0; $i < 8; $i++) { 
            $randStr .= $str[rand(0,61)];
        }
        return str_shuffle($randStr);
    }

    public function biodata()
    {
        $bio = User::join('biodata','biodata.user_id','=','users.id')->get();
        return view('admin.biodata',['biodata' => $bio]);
    }


    public function biodataHapus($id)
    {
        $exists = Biodata::find($id);
        if (!$exists) {
            abort(404);
        }

        $hapusbio = Biodata::where('user_id',$id)->delete();

        if ($hapusbio) {
            return redirect('admin/peserta')->with('status','Berhasil menghapus biodata.');
        }
        return redirect('admin/peserta')->with('status','Gagal menghapus biodata.');
    }

    // public function biodataEdit($id)
    // {
    //     $exists = Biodata::find($id);
    //     if (!$exists) {
    //         abort(404);
    //     }

    //     $hapusbio = Biodata::where('user_id',$id)->delete();

    //     if ($hapusbio) {
    //         return redirect('admin/peserta')->with('status','Berhasil menghapus biodata.');
    //     }
    //     return redirect('admin/peserta')->with('status','Gagal menghapus biodata.');
    // }
}
