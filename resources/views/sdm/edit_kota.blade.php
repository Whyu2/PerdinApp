
            
        @extends('layout/main')
        @section('container')
            
            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Kota</h1>
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
                                    <h6 class="m-0 font-weight-bold text-primary">Data Kota</h6>
                             
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form action="{{route('update.kota',$kota->id)}}" method="post">
                                        @csrf
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Nama Kota</label>
                                            <input type="text" name="nama_kota" placeholder="masukkan nama kota"  
                                            class="form-control @error('nama_kota') is-invalid @enderror" 
                                            value="{{ old('username', $kota->nama_kota) }}"
                                            required
                                            >
                                            @error('nama_kota')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Provinsi</label>
                                            <select class="form-control" name="provinsi_id" aria-label="Default select example" required>
                                             
                                                @foreach ($provinsi as $p)
                                                <option value="{{$p->id}}" {{($p->id == $kota->provinsi_id) ? "selected" : ""}}>{{$p->nama_provinsi}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Pulau</label>
                                            <select class="form-control" name="pulau_id" aria-label="Default select example" required>
                                                @foreach ($pulau as $pu)
                                                <option value="{{$pu->id}}" {{($pu->id == $kota->pulau_id) ? "selected" : ""}}>{{$pu->nama_pulau}}</option>
                                                @endforeach
                                              </select>
                                        </div>
    
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Latitude </label>
                                            <input type="text" name="lat" placeholder="masukkan latitude" 
                                            class="form-control @error('lat') is-invalid @enderror" 
                                            value="{{ old('username', $kota->lat) }}"
                                            required
                                            >
                                            @error('lat')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Longitude </label>
                                            <input type="text" name="long" placeholder="masukkan longitude" 
                                            class="form-control @error('long') is-invalid @enderror" 
                                            value="{{ old('username', $kota->long) }}"
                                            required
                                            >
                                            @error('long')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                      <div class="mb-2">
                                          <div class="form-check form-check-inline">
                                              <input type="radio" name="luar_negeri" id="inlineRadio2" value="0" 
                                              class="form-check-input  @error('luar_negeri') is-invalid @enderror" 
                                              required {{ $kota->luar_negeri == "0" ? 'checked' : '' }}
                                              >
                                              <label class="form-check-label" for="inlineRadio2">Dalam Negeri</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" name="luar_negeri" id="inlineRadio2" value="1" 
                                              class="form-check-input  @error('luar_negeri') is-invalid @enderror" 
                                              required {{ $kota->luar_negeri == "1" ? 'checked' : '' }}
                                              >
                                              <label class="form-check-label" for="inlineRadio2">Luar Negeri</label>
                                            </div>
                                       
                                      </div>
                                   
                                          <div class="mt-2">
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
           