@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold">Form {{$sub_title}}</h6>
        </div>
        <div class="card-body">
            <form action="/edit_user/{{$detail->id_user}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                {{-- @if ($detail->role === 'Event')
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="kode_instansi">Kode Instansi</label>
                            <input type="text" class="form-control @error('kode_instansi') is-invalid @enderror" name="kode_instansi" id="kode_instansi" value="{{$detail->kode_instansi}}" placeholder="Masukkan Kode Instansi">
                            @error('kode_instansi')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>       
                    </div>
                @endif --}}

                {{-- @if ($detail->role === 'Rumah Sakit')
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="kode_rs">Kode Rumah Sakit</label>
                            <input type="text" class="form-control @error('kode_rs') is-invalid @enderror" name="kode_rs" id="kode_rs" value="{{$detail->kode_rs}}" placeholder="Masukkan Kode Rumah Sakit">
                            @error('kode_rs')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>       
                    </div>
                @endif --}}

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama">@if($detail->role === 'Event') Nama Instansi @elseif($detail->role === 'Rumah Sakit') Nama Rumah Sakit @else Nama Lengkap @endif</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{$detail->nama}}" placeholder="Masukkan Nama Lengkap">
                        @error('nama')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>

                {{-- @if ($detail->role === 'Donatur')
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" value="{{$detail->nik}}" placeholder="Masukkan NIK">
                            @error('nik')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>       
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="number" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" value="{{$detail->tanggal_lahir}}" placeholder="Masukkan Tanggal Lahir">
                            @error('tanggal_lahir')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>       
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="select2-single-placeholder form-control @error('jk') is-invalid @enderror" name="jk" id="select2SinglePlaceholder">
                                @if ($detail->jk)
                                    <option value="{{$detail->jk}}">{{$detail->jk}}</option>
                                @else
                                    <option value="">-- Pilih --</option>
                                @endif
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jk')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>       
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="gol_darah">Golongan Darah</label>
                            <select class="select2-single-placeholder form-control @error('gol_darah') is-invalid @enderror" name="gol_darah" id="select2SinglePlaceholder">
                                @if ($detail->gol_darah)
                                    <option value="{{$detail->gol_darah}}">{{$detail->gol_darah}}</option>
                                @else
                                    <option value="">-- Pilih --</option>
                                @endif
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                            @error('gol_darah')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>       
                    </div>
                @endif --}}

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="alamat_user">Alamat</label>
                        <input type="text" class="form-control @error('alamat_user') is-invalid @enderror" name="alamat_user" id="alamat_user" value="{{$detail->alamat_user}}" placeholder="Masukkan Alamat">
                        @error('alamat_user')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nomor_telepon">Nomor Telepon</label>
                        <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" name="nomor_telepon" id="nomor_telepon" value="{{$detail->nomor_telepon}}" placeholder="Masukkan Nomor Telepon">
                        @error('nomor_telepon')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{$detail->email}}" placeholder="Masukkan Email">
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
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                        @error('foto')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="custom-file">
                            <img class="img-profile rounded-circle" style="width: 90px;" src="@if($detail->foto === null) {{ asset('foto_user/default.jpg') }} @else {{ asset('foto_user/'.$detail->foto) }} @endif" alt="profile">
                        </div>
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