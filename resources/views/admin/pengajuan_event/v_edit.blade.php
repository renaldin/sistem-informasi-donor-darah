@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold">Form {{$sub_title}}</h6>
        </div>
        <div class="card-body">
            <form action="/edit_event/{{$detail->id_event}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nomor_pengajuan">Nomor Pengajuan</label>
                        <input type="text" class="form-control @error('nomor_pengajuan') is-invalid @enderror"
                            name="nomor_pengajuan" id="nomor_pengajuan" value="{{ $detail->nomor_pengajuan }}"
                            placeholder="Masukkan Nomor Pengajuan" readonly>
                        @error('nomor_pengajuan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nomor_koordinator">Nomor Koordinator</label>
                        <input type="text" class="form-control @error('nomor_koordinator') is-invalid @enderror"
                            name="nomor_koordinator" id="nomor_koordinator" value="{{ $detail->nomor_koordinator }}"
                            placeholder="Masukkan Nomor Koordinator" readonly>
                        @error('nomor_koordinator')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_koordinator">Nama Koordinator</label>
                        <input type="text" class="form-control @error('nama_koordinator') is-invalid @enderror"
                            name="nama_koordinator" id="nama_koordinator" value="{{ $detail->nama_koordinator }}"
                            placeholder="Masukkan Nama Koordinator">
                        @error('nama_koordinator')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="kd_instansi">Kode Instansi</label>
                        <input type="text" class="form-control @error('kd_instansi') is-invalid @enderror" name="kd_instansi" id="kd_instansi" value="{{$detail->kd_instansi}}" placeholder="Masukkan Kode Instansi">
                        @error('kd_instansi')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_instansi">Nama Instansi</label>
                        <input type="text" class="form-control @error('nama_instansi') is-invalid @enderror" name="nama_instansi" id="nama_instansi" value="{{$detail->nama_instansi}}" placeholder="Masukkan Nama Instansi">
                        @error('nama_instansi')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror"
                            name="nama_kegiatan" id="nama_kegiatan" value="{{ $detail->nama_kegiatan }}"
                            placeholder="Masukkan Nama Kegiatan">
                        @error('nama_kegiatan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="alamat_lengkap">Lokasi Kegiatan Dilaksanakan</label>
                        <input type="text" class="form-control @error('alamat_lengkap') is-invalid @enderror" name="alamat_lengkap" id="alamat_lengkap" value="{{$detail->alamat_lengkap}}" placeholder="Masukkan Alamat Lengkap">
                        @error('alamat_lengkap')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Tanggal Event</label>
                            <input type="date" class="form-control @error('tanggal_event') is-invalid @enderror" name="tanggal_event" value="{{$detail->tanggal_event}}" min="{{date("Y-m-d")}}">
                        @error('tanggal_event')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="clockPicker2">Jam Event</label>
                        <div class="input-group clockpicker" id="clockPicker2">
                          <input type="text" class="form-control @error('jam') is-invalid @enderror" name="jam" value="{{$detail->jam}}">                     
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                          </div>                      
                        </div>
                        @error('jam')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>    
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="touchSpin1">Target Pendonor</label>
                        <input id="touchSpin1" type="text" name="jumlah_orang" class="form-control @error('jumlah_orang') is-invalid @enderror" value="{{$detail->jumlah_orang}}">
                        @error('jumlah_orang')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="upload_surat">Upload Surat</label>
                        <input type="file" class="form-control @error('upload_surat') is-invalid @enderror" name="upload_surat" id="customFile">
                        @error('upload_surat')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12 mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <div class="col-lg-12 mt-3">
                    <div class="form-group">
                        <label for="upload_surat">Surat</label>
                        <iframe src="{{ asset('foto_surat/'.$detail->upload_surat) }}" frameborder="0" scrolling="auto" width="100%" height="500px"></iframe>
                    </div>
                </div>
            </form>
          </div>
        </div>
    </div>
    </div>
</div>

@endsection