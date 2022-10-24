<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Pulau;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

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
            'tittle' => 'index',
            'kota' => $kota
        ];
        return view('devisisdm.list_kota', $data);
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
            'tittle' => 'index',
            'provinsi' => $provinsi,
            'pulau' => $pulau
        ];
        return view('devisisdm.add_kota', $data);
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
            'nama_kota' => 'required|max:128',
            'provinsi_id' => 'required',
            'pulau_id' => 'required',
            'long' => 'required',
            'lat' => 'required',
            'luar_negeri' => 'required'
        ]);

        $kota = Kota::create([
            'nama_kota' => $request->nama_kota,
            'provinsi_id' => $request->provinsi_id,
            'pulau_id' => $request->pulau_id,
            'luar_negeri' => $request->luar_negeri,
            'lat' =>  $request->lat,
            'long' =>  $request->long,
        
        ]);
        
        return redirect('devisisdm')->with('sukses', 'Data User, Berhasil Ditambah!');
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
        return view('devisisdm.edit_kota', $data);
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

        return redirect('devisisdm')->with('sukses', 'Data Kota, Berhasil Diubah!');
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

        Kota::whereId($id)->delete();

        return redirect('devisisdm')->with('sukses_delete', 'Data Kota, Berhasil Dihapus!');

    }
}
