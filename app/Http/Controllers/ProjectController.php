<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * index project serviced
     */
    public function viewKatProyek()
    {
        $proyek = Proyek::all();

        return view('Pages.proyek.proj-setting',['projects' => $proyek]);
    }

    public function addCatProyek(Request $request)
    {
        //validasi data yang dikirim
        $validated = $request->validate([
            'jenis'=>'required',
            'model'=>'required',
            'harga'=>'required|numeric',
            'deskripsi'=>'required',
        ]);

        //simpan ke database
        $proyek = Proyek::create([
            'proyek_uuid'=>Str::uuid(),
            'jenis'=> $request->jenis,
            'model'=>$request->model,
            'harga'=>$request->harga,
            'deskripsi'=>$request->deskripsi
        ]);
        session()->flash('message','Berhasil menambahkan  jenis proyek');
        return redirect('/project/setting');
    }

    /**
     * indexCatProyek
     */

    public function indexCatProyek($uuid)
    {
        $proyek = Proyek::where('proyek_uuid',$uuid)->first();

        return view('Pages.proyek.detailCatProyek',['proyek'=>$proyek]);
    }

    /**
     * editCatProyek
     */
    public function editCatProyek(Request $request,$uuid)
    {
        //ambil data
        $proyek = Proyek::where('proyek_uuid',$uuid)->first();
        
        //validasi data
        $validated = $request->validate([
            'jenis'=>'required',
            'model'=>'required',
            'deskripsi'=>'required',
            'harga'=>'required|numeric',
        ]);

        //update data
        $proyek->update([
            'jenis'=>$request->jenis,
            'model'=>$request->model,
            'deskripsi'=>$request->deskripsi,
            'harga'=>$request->harga
        ]);

        //redirect ke halaman  utama dengan membawa pesan sukses
        return redirect('/project/setting')->with('message','Berhasil ubah data');
    }
}
