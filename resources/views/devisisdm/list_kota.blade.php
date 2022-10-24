
            
        @extends('layout/main')
        @section('container')
            
            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Master Kota</h1>
                        <a href="{{route('tambah.kota')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                          class="fas fa-download fa-sm text-white-50"></i> Tambah Kota</a>
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
                                    <h6 class="m-0 font-weight-bold text-primary">List Kota</h6>
                             
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
                                    <table id="example" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Kota</th>
                                                <th>Provinsi</th>
                                                <th>Pulau</th>
                                                <th>Long</th>
                                                <th>Lat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php $number=1; ?>
                                          @foreach ($kota as $key => $k)
                                            <tr>
                                                <td>{{$number}}</td>
                                                <?php $number++; ?>
                                                <td>{{$k->nama_kota}}</td>
                                                <td>{{$k->provinsi->nama_provinsi}}</td>
                                                <td>{{$k->pulau->nama_pulau}}</td>
                                                <td>{{$k->long}}</td>
                                                <td>{{$k->lat}}</td>
                                                <th>
                                                  <a href="{{route('edit.kota',$k->id)}}" class="btn btn-primary btnku " ><i class="fas fa-edit"></i></a>
                                                  <button type="button" value="{{$k->id}}" class="btn btn-danger delete_btn_kota"><i class="fa fa-trash"></i></button>
                                              </th>
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
                          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>


                  
                @endsection
           