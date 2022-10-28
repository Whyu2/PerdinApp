<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Pulau;
use App\Models\Perdin;
use Illuminate\Http\Request;


class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kota = Kota::all();
        $data = [
            'tittle' => 'Master Kota',
            'kota' => $kota
        ];
        return view('sdm.list_kota', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
        $provinsi = Provinsi::all();
        $pulau = Pulau::all();
        $data = [
            'tittle' => 'Tambah Kota',
            'provinsi' => $provinsi,
            'pulau' => $pulau
        ];
        return view('sdm.add_kota', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kota' => 'required|max:128|unique:kotas,nama_kota',
            'provinsi_id' => 'required',
            'pulau_id' => 'required',
            'long' => 'required|regex:/^-?\d{1,3}\.\d{6,}$/',
            'lat' => 'required|regex:/^-?\d{1,3}\.\d{6,}$/',
            'luar_negeri' => 'required'
        ]);

            Kota::create([
            'nama_kota' => $request->nama_kota,
            'provinsi_id' => $request->provinsi_id,
            'pulau_id' => $request->pulau_id,
            'luar_negeri' => $request->luar_negeri,
            'lat' =>  $request->lat,
            'long' =>  $request->long,
        ]);
        
        return redirect('sdm')->with('sukses', 'Data User, Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function show(Kota $kota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kota = Kota::find($id);
        $provinsi = Provinsi::all();
        $pulau = Pulau::all();
        $data = [
            'tittle' => 'Edit Kota',
            'kota' => $kota,
            'provinsi' => $provinsi,
            'pulau' => $pulau
        ];
        return view('sdm.edit_kota', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'nama_kota' => 'required|max:128',
            'provinsi_id' => 'required',
            'pulau_id' => 'required',
            'long' => 'required',
            'lat' => 'required',
            'luar_negeri' => 'required'
        ]);

        $kota = Kota::whereid($id)->first();

        $kota->update([
            'nama_kota' => $request->nama_kota,
            'provinsi_id' => $request->provinsi_id,
            'pulau_id' => $request->pulau_id,
            'luar_negeri' => $request->luar_negeri,
            'lat' =>  $request->lat,
            'long' =>  $request->long,
        ]);

        return redirect('sdm')->with('sukses', 'Data Kota, Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id= $request->id_kota;
        //validasi ketika data digunakan
        $perdin = Perdin::where(function ($query) use ($id) {
            $query->where('kota_asal_id', '=', $id)
                  ->orWhere('kota_tujuan_id', '=', $id);
        })->get();

        if (!$perdin) {
            return redirect('sdm')->with('sukses_delete', 'Data Kota Gagal Dihapus Karena Masih Digunakan !');
        } else {
            Kota::whereId($id)->delete();
            return redirect('sdm')->with('sukses_delete', 'Data Kota, Berhasil Dihapus!');
        }

    }
}
