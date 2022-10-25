<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $users = User::where('role', 'pegawai')->orWhere('role', 'sdm')->get();
        
        $data = [
            'tittle' => 'index',
            'users' => $users
        ];
        return view('admin.list_user', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'tittle' => 'Tambah User',
        ];
        return view('admin.add_user', $data);
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
            'username' => 'required|max:128|unique:users,username',
            'nama' => 'required|max:128',
            'pass' => 'required|max:128',
        ]);

            User::create([
            'username' => $request->username,
            'password' => bcrypt($request->pass),
            'nama' => $request->nama,
            'role' => $request->role,
        ]);
        
        return redirect('admin')->with('sukses', 'Data User, Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enter  $enter
     * @return \Illuminate\Http\Response
     */
    public function show( $enter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enter  $enter
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $user = User::find($id);
        $data = [
            'tittle' => 'Edit User',
            'user' => $user,

        ];
        return view('admin.edit_user', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enter  $enter
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'nama' => 'required|max:128',
        ]);
        $user = User::whereid($id)->first();

        $user->update([
            'nama' => $request->nama,
            'role' => $request->role,
        ]);

        return redirect('admin')->with('sukses', 'Data User, Berhasil Diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enter  $enter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id= $request->id_user;
      
        User::whereId($id)->delete();

        return redirect('admin')->with('sukses_delete', 'Data User, Berhasil Dihapus!');

    }
}
