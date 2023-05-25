@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold">Form {{$sub_title}}</h6>
        </div>
        <div class="card-body">
            <form action="/edit_darah/{{$detail->id_darah_masuk}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <label><strong>Data Anggota</strong></label>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_anggota">Nama Anggota</label>
                        <input type="hidden" class="form-control @error('id_anggota') is-invalid @enderror" name="id_anggota" id="id_anggota" value="{{$detail->id_anggota}}" placeholder="Masukkan Nama Anggota">
                        <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" name="nama_anggota" id="nama_anggota" value="{{$detail->nama_anggota}}" readonly placeholder="Masukkan Nama Anggota">
                        @error('nama_anggota')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" value="{{$detail->alamat}}" readonly placeholder="Masukkan Nama Anggota">
                        @error('alamat')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="text" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin" value="{{$detail->jenis_kelamin}}" readonly placeholder="Masukkan Nama Anggota">
                        @error('jenis_kelamin')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="hasil_kusioner">Hasil Kusioner</label>
                        <select name="hasil_kusioner" class="form-control @error('hasil_kusioner') is-invalid @enderror" id="hasil_kusioner" disabled>
                            <option value="{{$detail->hasil_kusioner}}">{{$detail->hasil_kusioner}}</option>
                            <option value="Lolos">Lolos</option>
                            <option value="Tidak Lolos">Tidak Lolos</option>
                        </select>
                        @error('hasil_kusioner')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="deskripsi_hasil_kusioner">Deskripsi Hasil Kusioner</label>
                        <textarea name="deskripsi_hasil_kusioner" class="form-control @error('deskripsi_hasil_kusioner') is-invalid @enderror" cols="10" rows="3" placeholder="Masukkan Deskripsi Hasil Kusioner" readonly>{{$detail->deskripsi_hasil_kusioner}}</textarea>
                        @error('deskripsi_hasil_kusioner')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-12">
                    <label><strong>Data Darah</strong></label>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="no_kantong">No. Kantong</label>
                        <input type="text" class="form-control @error('no_kantong') is-invalid @enderror" name="no_kantong" id="no_kantong" value="{{$detail->no_kantong;}}" readonly placeholder="Masukkan No. Kantong">
                        <input type="hidden" class="form-control @error('id_darah') is-invalid @enderror" name="id_darah" id="id_darah" value="{{$detail->id_darah}}">
                        @error('no_kantong')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="golongan_darah">Golongan Darah</label>
                        <input type="text" class="form-control @error('golongan_darah') is-invalid @enderror" name="golongan_darah" id="golongan_darah" value="{{$detail->golongan_darah}}" autofocus placeholder="Masukkan Golongan Darah">
                        @error('golongan_darah')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="resus">Resus</label>
                        <input type="text" class="form-control @error('resus') is-invalid @enderror" name="resus" id="resus" value="{{$detail->resus}}" placeholder="Masukkan Golongan Darah">
                        @error('resus')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="volume_darah">Volume Darah</label>
                        <input type="text" class="form-control @error('volume_darah') is-invalid @enderror" name="volume_darah" id="volume_darah" value="{{$detail->volume_darah}}" placeholder="Masukkan Golongan Darah">
                        @error('volume_darah')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tanggal_kedaluwarsa">Tanggal Kedaluwarsa</label>
                        <div class="input-group date">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                          </div>
                          <input type="date" class="form-control @error('tanggal_kedaluwarsa') is-invalid @enderror" name="tanggal_kedaluwarsa" value="{{$detail->tanggal_kedaluwarsa}}" id="simpleDataInput">
                      </div>
                        @error('tanggal_kedaluwarsa')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-12 mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    </div>
</div>

@endsection