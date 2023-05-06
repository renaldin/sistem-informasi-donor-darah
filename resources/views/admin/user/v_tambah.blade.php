@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold">Form {{$sub_title}}</h6>
        </div>
        <div class="card-body">
            <form action="/tambah_user" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{old('nama')}}" placeholder="Masukkan Nama Lengkap">
                        @error('nama')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nomor_telepon">Nomor Telepon</label>
                        <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" name="nomor_telepon" id="nomor_telepon" value="{{old('nomor_telepon')}}" placeholder="Masukkan Nomor Telepon">
                        @error('nomor_telepon')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}" placeholder="Masukkan Email">
                        @error('email')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Masukkan Password">
                        @error('password')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="select2-single-placeholder form-control @error('role') is-invalid @enderror" name="role" id="select2SinglePlaceholder">
                            <option value="">Pilih</option>
                            <option value="Admin">Admin</option>
                            <option value="Donatur">Donatur</option>
                            <option value="Event">Event</option>
                            <option value="Petugas Kesehatan">Petugas Kesehatan</option>
                            <option value="Rumah Sakit">Rumah Sakit</option>
                            <option value="Pusat PMI">Pusat PMI</option>
                        </select>
                        @error('role')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" name="foto" id="customFile">
                            <label class="custom-file-label" for="customFile">Pilih file</label>
                        </div>
                        @error('foto')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    </div>
</div>

@endsection