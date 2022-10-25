
            
        @extends('layout/main')
        @section('container')
            
            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Detail Konfirmasi Perdin</h1>
                    </div>

                    <!-- Content Row -->
            

                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Perdin</h6>
                             
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form action="
                                    {{-- {{route('store.perdin')}} --}}
                                    " method="post">
                                        @csrf
                                        <?php 
                                        $kota_asal = $f_perdin->kota($perdin->kota_asal_id);
                                        $kota_tujuan = $f_perdin->kota($perdin->kota_tujuan_id);
                                        $durasi =  $f_perdin->durasi($perdin->tgl_berangkat,$perdin->tgl_pulang);
                                        $jarak_km = $f_perdin->jarak($kota_asal->lat,$kota_asal->long,$kota_tujuan->lat,$kota_tujuan->long);
                                        // $status =  $f_perdin->status($p->konfirmasi);
                                        $total_uang =  $f_perdin->total_uang($perdin->uangsaku,$durasi);
                                        $lebihkm =  $f_perdin->lebihkm($jarak_km);
                                        ?>
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Nama</label>
                                            <input type="text" name="nama_perdin" class="form-control" value="{{$perdin->user->nama}}" readonly
                                            >
                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Kota</label>
                                            <div class="row">
                                                <div class="col-5">
                                                    <input type="text" name="nama_perdin" class="form-control" value="{{$kota_asal->nama_kota}}"readonly
                                                    >
                                                </div>
                                                <div class="col-2 text-center mt-2">
                                                    <i class="fas fa-arrow-right"></i>
                                                </div>
                                                <div class="col-5">
                                                    <input type="text" name="nama_perdin" class="form-control" value="{{$kota_tujuan->nama_kota}}" readonly
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Tanggal</label>
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="input-group">
                                                        <input type="text"  name="tgl_selesai"
                                                        class="form-control" 
                                                        value="{{$perdin->tgl_berangkat}}" readonly
                                                        >
                                                        <span class="input-group-append">
                                                          <span class="input-group-text bg-white">
                                                              <i class="fa fa-calendar"></i>
                                                          </span>
                                                      </span>
                                                      </div>
                                                </div>
                                         
                                                <div class="col-2 text-center mt-2">
                                                    <i class="fas fa-arrow-right"></i>
                                                </div>
                                                <div class="col-5">
                                                    <div class="input-group">
                                                        <input type="text"  name="tgl_selesai"
                                                        class="form-control" 
                                                        value="{{$perdin->tgl_pulang}}" readonly
                                                        >
                                                        <span class="input-group-append">
                                                          <span class="input-group-text bg-white">
                                                              <i class="fa fa-calendar"></i>
                                                          </span>
                                                      </span>
                                                      </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Keterangan </label>
                                            <textarea type="text" name="deskripsi"  
                                            class="form-control"
                                        
                                            required rows="5"  readonly
                                            >   {{$perdin->deskripsi}}
                                          </textarea>
                                          @error('deskripsi')
                                          <div class="invalid-feedback"> {{ $message }}</div>
                                         @enderror
                                        </div>
                                        <table class="table table-striped">
                                            <thead class="thead-light">
                                              <tr>
                                                <th class=" text-center">Total Hari</th>
                                                <th class=" text-center">Jarak Tempuh</th>
                                                <th class=" text-center">Total Uang Perdin</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                    
                                                <td class="text-primary text-center">{{$durasi}} Hari</td>
                                                <td class="text-primary text-center">{{$jarak_km}} KM<br>
                                                    @if ($kota_tujuan->luar_negeri == 0)
                                                    <span class="text-secondary">{{formatIDR($perdin->uangsaku)}} / Hari</span> 
                                                    @endif
                                                    @if ($kota_tujuan->luar_negeri == 1)
                                                    <span class="text-secondary">${{$perdin->uangsaku}} / Hari</span> 
                                                    @endif
                                                    <br><span class="text-secondary fontkecil">{{$lebihkm}}</span></td>
                                                <td class="text-primary text-center">
                                                    @if ($kota_tujuan->luar_negeri == 0)
                                                    {{formatIDR($total_uang)}}
                                                    @endif
                                                    @if ($kota_tujuan->luar_negeri == 1)
                                                    ${{$total_uang}}
                                                    @endif
                                                  
                                                
                                                </td>
                                              </tr>
                                            
                                            </tbody>
                                          </table>
                                          <div class="mt-2 text-center">

                                            @if($perdin->konfirmasi =='y')
                                            <h3 class="text-success">Approved</h3>
                                            @endif

                                            @if($perdin->konfirmasi =='n')
                                            <h3 class="text-danger">Rejected</h3>
                                             @endif

                                             @if($perdin->konfirmasi =='p')
                                             <div class="row justify-content-center">
                                                <div class="col-6">   <a href="{{route('reject.perdin',$perdin->id)}}" class="btn btn-danger btnku " >reject</a></div>
                                                <div class="col-6">  <a href="{{route('approve.perdin',$perdin->id)}}" class="btn btn-success btnku " >Approve</a></div>
                                            </div>
                                             @endif
                                           
                                         
                                     
                                          </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                      
                    </div>

                    <!-- Content Row -->
            

                </div>
                <!-- /.container-fluid -->
                @endsection
           