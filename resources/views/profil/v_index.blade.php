@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold">{{$sub_title}}</h6>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                <img class="img-profile rounded-circle" style="width: 120px;" src="@if($user->foto === null) {{ asset('foto_user/default.jpg') }} @else {{ asset('foto_user/'.$user->foto) }} @endif" alt="profile">
            </div>
            <div class="card-header d-flex flex-row align-items-center justify-content-center">
                <h6 class="m-0 font-weight-bold">{{$user->nama}}</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nomor Telepon : {{$user->nomor_telepon}}</label>
                </div>
                <div class="form-group">
                    <label>Email : {{$user->email}}</label>
                </div>
                <div class="form-group">
                    <label>Status : {{$user->role}}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold">Form Edit Profil</h6>
        </div>
        <div class="card-body">
            <form action="/edit_profil/{{$user->id_user}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{$user->nama}}" placeholder="Masukkan Nama Lengkap">
                        @error('nama')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nomor_telepon">Nomor Telepon</label>
                        <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" name="nomor_telepon" id="nomor_telepon" value="{{$user->nomor_telepon}}" placeholder="Masukkan Nomor Telepon">
                        @error('nomor_telepon')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{$user->email}}" placeholder="Masukkan Email">
                        @error('email')
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
                <div class="col-lg-12 mt-5">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    </div>
</div>

@endsection