
            
        @extends('layout/main')
        @section('container')
            
            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Perdin</h1>
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
                                    <form action="{{route('store.perdin')}}" method="post">
                                        @csrf
                                     
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Kota</label>
                                            <div class="row">
                                                <div class="col-5">
                                                    <select class="form-control" name="kota_asal_id" aria-label="Default select example" required>
                                                     <option value="" selected>pilih kota asal</option>
                                                        @foreach ($kota as $k)
                                                        <option value="{{$k->id}}">{{$k->nama_kota}}</option>
                                                        @endforeach
                                                      </select>
                                                </div>
                                                <div class="col-2 text-center mt-2">
                                                    <i class="fas fa-arrow-right"></i>
                                                </div>
                                                <div class="col-5">
                                                    <select class="form-control" name="kota_tujuan_id" aria-label="Default select example" required>
                                                     <option value="" selected>pilih kota tujuan</option>
                                                        @foreach ($kota as $k)
                                                        <option value="{{$k->id}}">{{$k->nama_kota}}</option>
                                                        @endforeach
                                                      </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Tanggal</label>
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="input-group">
                                                        <input type="text" id="datepicker" name="tgl_mulai"
                                                        class="form-control @error('tgl_mulai') is-invalid @enderror" 
                                                        value="{{ old('tgl_mulai') }}"  placeholder="tanggal mulai"
                                                        >
                                                        <span class="input-group-append">
                                                          <span class="input-group-text bg-white">
                                                              <i class="fa fa-calendar"></i>
                                                          </span>
                                                      </span>
                                                      @error('tgl_mulai')
                                                      <div class="invalid-feedback"> {{ $message }}</div>
                                                     @enderror
                                                      </div>
                                                </div>
                                         
                                                <div class="col-2 text-center mt-2">
                                                    <i class="fas fa-arrow-right"></i>
                                                </div>
                                                <div class="col-5">
                                                    <div class="input-group">
                                                        <input type="text" id="datepicker2" name="tgl_selesai"
                                                        class="form-control @error('tgl_selesai') is-invalid @enderror" 
                                                        value="{{ old('tgl_selesai') }}" placeholder="tanggal selesai"
                                                        >
                                                        <span class="input-group-append">
                                                          <span class="input-group-text bg-white">
                                                              <i class="fa fa-calendar"></i>
                                                          </span>
                                                      </span>
                                                      @error('tgl_selesai')
                                                      <div class="invalid-feedback"> {{ $message }}</div>
                                                     @enderror
                                                      </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Keterangan </label>
                                            <textarea type="text" name="deskripsi"  
                                            class="form-control @error('keterangan') is-invalid @enderror" 
                                            value="{{ old('deskripsi') }}" 
                                            required rows="5" 
                                            >
                                          </textarea>
                                          @error('deskripsi')
                                          <div class="invalid-feedback"> {{ $message }}</div>
                                         @enderror
                                        </div>
                                   
                                          <div class="mt-2">
                                            <a href="/pegawai" class="btn btn-secondary " >Kembali</a>
                                          <button type="submit" class="btn btn-primary">Submit</button>
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
           