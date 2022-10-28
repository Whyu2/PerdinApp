
            
        @extends('layout/main')
        @section('container')
            
            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
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
                                    <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                             
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form action="{{route('store.user')}}" method="post">
                                        @csrf
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Username</label>
                                            <input type="text" name="username" placeholder="masukkan username" 
                                            class="form-control @error('username') is-invalid @enderror" 
                                            value="{{ old('username') }}"
                                            required
                                            >
                                            @error('username')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Nama</label>
                                            <input type="text" name="nama" placeholder="masukkan nama" 
                                            class="form-control @error('nama') is-invalid @enderror" 
                                            value="{{ old('nama') }}"
                                            required
                                            >
                                            @error('nama')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Password</label>
                                            <input type="password" name="pass" placeholder="masukkan password" 
                                            class="form-control @error('pass') is-invalid @enderror" 
                                            value="{{ old('pass') }}"
                                            required
                                            >
                                            @error('pass')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                      <div class="mb-2">

                                          <div class="form-check form-check-inline">
                                              <input type="radio" name="role" id="inlineRadio2" value="pegawai" 
                                              class="form-check-input  @error('role') is-invalid @enderror" 
                                              required
                                              >
                                              <label class="form-check-label" for="inlineRadio2">Pegawai</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" name="role" id="inlineRadio2" value="sdm" 
                                              class="form-check-input  @error('role') is-invalid @enderror" 
                                              required
                                              >
                                              <label class="form-check-label" for="inlineRadio2">Devisi SDM</label>
                                          
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
           