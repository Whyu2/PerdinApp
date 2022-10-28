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

        $user_id = auth()->user()->id;
        $perdin = Perdin::where('user_id', $user_id)->get();
        $data = [
            'tittle' => 'Perdin',
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
            'tittle' => 'Konfirmasi Perdin',
            'f_perdin' => new Perdin(),
            'perdin' => $perdin,
            'count_p' => $count_p
        ];
        return view('sdm.konfirmasi_perdin', $data);
    }

    public function detail_konfirmasi_perdin($id)
    {
   
        $perdin = Perdin::whereid($id)->first();
        $data = [
            'tittle' => 'Detail Perdin',
            'f_kota' => new Kota(),
            'f_perdin' => new Perdin(),
            'perdin' => $perdin
        ];
        return view('sdm.detail_konfirmasi_perdin', $data);
    }

    public function approve_perdin($id){

        $perdin = Perdin::whereid($id)->first();

        $perdin->update([
            'konfirmasi' =>  'y'
        ]);

        return redirect('history_perdin')->with('approved', 'Perdin Di Approved !');

    }
    
    public function reject_perdin($id){

        $perdin = Perdin::whereid($id)->first();

        $perdin->update([
            'konfirmasi' =>  'n'
        ]);

        return redirect('history_perdin')->with('rejected', 'Perdin Di Reject !');
    }

    public function history_perdin()
    {
   
        $perdin = Perdin::where('konfirmasi', 'y')->orWhere('konfirmasi', 'n')->get();
        $count_y = Perdin::where('konfirmasi', 'y')->count();
        $count_n = Perdin::where('konfirmasi', 'n')->count();
   
        $data = [
            'tittle' => 'History Perdin',
            'f_perdin' => new Perdin(),
            'perdin' => $perdin,
            'count_y' => $count_y,
            'count_n' => $count_n
        ];
        return view('sdm.history_konfirmasi_perdin', $data);
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
            'tittle' => 'Kota',
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
            'kota_asal_id' => 'required',
            'kota_tujuan_id' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'keterangan' => 'required'
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

        //ambil session user_id
        $user_id = auth()->user()->id;

        //menghitung ungsaku
        $uangsaku = $f_perdin->uangsaku($jarak_km,$kota_asal,$kota_tujuan);
        
        Perdin::create([
        'user_id' =>  $user_id,
        'kota_asal_id' => $request->kota_asal_id,
        'kota_tujuan_id' => $request->kota_tujuan_id,
        'tgl_berangkat' => $request->tgl_mulai,
        'tgl_pulang' => $request->tgl_selesai,
        'durasi' =>  $durasi,
        'uangsaku' =>  $uangsaku,
        'keterangan' => $request->keterangan,
        'konfirmasi' => 'p',
    ]);

    return redirect('pegawai')->with('sukses', 'Permohonan Perdin Berhasil Ditambah !');
                


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
    public function 
    troy(Perdin $perdin)
    {
        //
    }
}
