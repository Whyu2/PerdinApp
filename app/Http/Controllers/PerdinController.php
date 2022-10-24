<?php

namespace App\Http\Controllers;
use DateTime;
use App\Models\Kota;
use App\Models\Perdin;
use Illuminate\Http\Request;

class PerdinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $perdin = Perdin::all();
        $data = [
            'tittle' => 'index',
            'f_perdin' => new Perdin(),
            'perdin' => $perdin
        ];
        return view('pegawai.list_perdin', $data);
    }
    

    public function konfirmasi_perdin()
    {
   
        $perdin = Perdin::where('konfirmasi', 'p')->get();
        $count_p = Perdin::where('konfirmasi', 'p')->count();
   
        $data = [
            'tittle' => 'index',
            'f_perdin' => new Perdin(),
            'perdin' => $perdin,
            'count_p' => $count_p
        ];
        return view('devisisdm.konfirmasi_perdin', $data);
    }

    public function detail_konfirmasi_perdin($id)
    {
   
        $perdin = Perdin::whereid($id)->first();
        $data = [
            'tittle' => 'index',
            'f_kota' => new Kota(),
            'f_perdin' => new Perdin(),
            'perdin' => $perdin
        ];
        return view('devisisdm.detail_konfirmasi_perdin', $data);
    }

    public function approve_perdin($id){

        $perdin = Perdin::whereid($id)->first();

        $perdin->update([
            'konfirmasi' =>  'y'
        ]);

        return redirect('devisisdm.konfirmasi_perdin')->with('sukses', 'Perdin Di Approved !');

    }
    public function reject_perdin($id){

        $perdin = Perdin::whereid($id)->first();

        $perdin->update([
            'konfirmasi' =>  'n'
        ]);

        return redirect('devisisdm.konfirmasi_perdin')->with('sukses', 'Perdin Di Approved !');
    }
    public function history_perdin()
    {
   
        $perdin = Perdin::where('konfirmasi', 'y')->orWhere('konfirmasi', 'n')->get();
        $count_y = Perdin::where('konfirmasi', 'y')->count();
        $count_n = Perdin::where('konfirmasi', 'n')->count();
   
        $data = [
            'tittle' => 'index',
            'f_perdin' => new Perdin(),
            'perdin' => $perdin,
            'count_y' => $count_y,
            'count_n' => $count_n
        ];
        return view('devisisdm.history_konfirmasi_perdin', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kota = Kota::all();
   
        $data = [
            'tittle' => 'index',
            'kota' => $kota,
        ];
        return view('pegawai.add_perdin', $data);
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
            'nama_perdin' => 'required|max:128',
            'kota_asal_id' => 'required',
            'kota_tujuan_id' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'deskripsi' => 'required'
        ]);


        //panggil function
        $f_perdin = new Perdin();
        //pilihan kota
        $kota_asal =  $f_perdin->kota($request->kota_asal_id);
        $kota_tujuan =  $f_perdin->kota($request->kota_tujuan_id);
       
        //menghitung durasi perjalanan dinas
        $tgl_mulai = date('Y-m-d H:i:s', strtotime($request->tgl_mulai));
        $tgl_selesai = date('Y-m-d H:i:s', strtotime($request->tgl_selesai));
        $durasi =  $f_perdin->durasi($tgl_mulai,$tgl_selesai);
  
        //menghitung jarak
        $jarak_km = $f_perdin->jarak($kota_asal->lat,$kota_asal->long,$kota_tujuan->lat,$kota_tujuan->long);
    
       if ($kota_tujuan->luar_negeri !== 1) {
           if ($jarak_km<60) {
              $uangsaku = 0;
           }else{
               if ($kota_asal->provinsi_id == $kota_tujuan->provinsi_id){
                   $uangsaku = 200000;
               }else{
                   if ($kota_asal->pulau_id == $kota_tujuan->pulau_id) {
                       $uangsaku = 250000;
                   }else{
                       $uangsaku = 300000;
                   }
               }
           }        
       }else{
            $uangsaku = 50 ;
       }


       
       $perdin = Perdin::create([
        'nama_perdin' => $request->nama_perdin,
        'kota_asal_id' => $request->kota_asal_id,
        'kota_tujuan_id' => $request->kota_tujuan_id,
        'tgl_berangkat' => $request->tgl_mulai,
        'tgl_pulang' => $request->tgl_selesai,
        'durasi' =>  $durasi,
        'uangsaku' =>  $uangsaku,
        'deskripsi' => $request->deskripsi,
        'konfirmasi' => 'p',
    ]);

    dd('berhasil');
                


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perdin  $perdin
     * @return \Illuminate\Http\Response
     */
    public function show(Perdin $perdin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perdin  $perdin
     * @return \Illuminate\Http\Response
     */
    public function edit(Perdin $perdin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perdin  $perdin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perdin $perdin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perdin  $perdin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perdin $perdin)
    {
        //
    }
}
