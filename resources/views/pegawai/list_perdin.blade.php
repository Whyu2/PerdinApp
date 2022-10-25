
            
        @extends('layout/main')
        @section('container')
            
            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Permohonan Perdin</h1>
                        <a href="{{route('tambah.perdin')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                          class="fas fa-download fa-sm text-white-50"></i> Ajukan Permohonan Perdin</a>
                    </div>

                    <!-- Content Row -->
            

                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">List Perdin</h6>
                             
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    @if(session()->has('sukses'))
                                    <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                                      {{session('sukses')}}
                                    </div>
                                    @endif
                                    @if(session()->has('sukses_delete'))
                                    <div class="alert alert-danger allert-dismissible fade show mt-1" role="alert">
                                      {{session('sukses_delete')}}
                                    </div>
                                    @endif
                                    <table id="example2" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                               
                                                <th>Kota</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Status</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php $number=1; ?>
                                          @foreach ($perdin as $key => $p)
                                          <?php 
                                          $kota_asal = $f_perdin->kota($p->kota_asal_id);
                                          $kota_tujuan = $f_perdin->kota($p->kota_tujuan_id);
                                          $durasi =  $f_perdin->durasi($p->tgl_berangkat,$p->tgl_pulang);
                                          $status =  $f_perdin->status($p->konfirmasi);
                                          ?>
                                            <tr>
                                                <td>{{$number}}</td>
                                                <?php $number++; ?>
                                               
                                                <td>{{$kota_asal->nama_kota}} <i class="fas fa-arrow-right"></i> {{$kota_tujuan->nama_kota}}</td>
                                                <td>  {{tanggal_bulan($p->tgl_berangkat)}} - {{tanggal_bulan_tahun($p->tgl_pulang)}} ({{$durasi}} Hari)</span></td>
                                                <td >{{$p->deskripsi}}</td>
                                                <td>{!!$status!!}</td>
                                              </tr>
                                          @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                      
                    </div>

                    <!-- Content Row -->
            

                </div>
                <!-- /.container-fluid -->

                    {{-- modal delete --}}
                <div class="modal fade" id="DeleteModalKota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash fa-1x"></i> Hapus Kota</h5>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('kota.delete')}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <label>Yakin akan ?</label>
                            <input type="hidden" id="id_delete" name="id_kota">
            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>


                  
                @endsection
           