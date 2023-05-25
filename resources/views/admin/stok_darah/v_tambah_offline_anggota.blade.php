@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold">Form {{$sub_title}} Anggota</h6>
        </div>
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a href="/tambah_darah_offline" class="btn btn-danger">Form Bukan Anggota</a>
          </div>
        <div class="card-body">
            <form action="/tambah_darah_offline" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <label><strong>Data Anggota</strong></label>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="id_anggota">Nama Anggota</label>
                        <input type="hidden" class="form-control @error('form_anggota') is-invalid @enderror" name="form_anggota" id="form_anggota" value="Anggota">
                        <select class="select2-single-placeholder form-control @error('id_anggota') is-invalid @enderror" name="id_anggota" autofocus id="select2SinglePlaceholder">
                            <option value="">Pilih</option>
                            @foreach ($anggota as $row)
                                    <option value="{{$row->id_anggota}}"><b>{{$row->nama_anggota}}</b></option>
                            @endforeach
                        </select>
                        @error('nama_anggota')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="hasil_kusioner">Hasil Kusioner</label>
                        <select name="hasil_kusioner" class="form-control @error('hasil_kusioner') is-invalid @enderror" id="hasil_kusioner">
                            <option value="">Pilih</option>
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
                        <textarea name="deskripsi_hasil_kusioner" class="form-control @error('deskripsi_hasil_kusioner') is-invalid @enderror" cols="10" rows="3" placeholder="Masukkan Deskripsi Hasil Kusioner"></textarea>
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
                        <input type="text" class="form-control @error('no_kantong') is-invalid @enderror" name="no_kantong" id="no_kantong" value="{{$no_kantong;}}" readonly placeholder="Masukkan No. Kantong">
                        <input type="hidden" class="form-control @error('form_darah') is-invalid @enderror" name="form_darah" id="form_darah" value="Offline">
                        @error('no_kantong')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="golongan_darah">Golongan Darah</label>
                        <input type="text" class="form-control @error('golongan_darah') is-invalid @enderror" name="golongan_darah" id="golongan_darah" value="{{old('golongan_darah');}}" placeholder="Masukkan Golongan Darah">
                        @error('golongan_darah')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="resus">Resus</label>
                        <input type="text" class="form-control @error('resus') is-invalid @enderror" name="resus" id="resus" value="{{old('resus');}}" placeholder="Masukkan Golongan Darah">
                        @error('resus')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="volume_darah">Volume Darah</label>
                        <input type="text" class="form-control @error('volume_darah') is-invalid @enderror" name="volume_darah" id="volume_darah" value="{{old('volume_darah');}}" placeholder="Masukkan Golongan Darah">
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
                          <input type="date" class="form-control @error('tanggal_kedaluwarsa') is-invalid @enderror" name="tanggal_kedaluwarsa" value="{{date('Y-m-d')}}" id="simpleDataInput">
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