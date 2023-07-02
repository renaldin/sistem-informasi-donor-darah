@extends('layout.v_template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Form {{ $sub_title }}</h6>
                </div>
                <div class="card-body">
                    <form action="/edit_pengajuan_event/{{ $detail->id_event }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_instansi">Nama Instansi</label>
                                    <input type="text" class="form-control @error('nama_instansi') is-invalid @enderror"
                                        name="nama_instansi" id="nama_instansi" value="{{ $detail->nama_instansi }}"
                                        placeholder="Masukkan Nama Instansi">
                                    @error('nama_instansi')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="alamat_lengkap">Alamat Lengkap</label>
                                    <input type="text" class="form-control @error('alamat_lengkap') is-invalid @enderror"
                                        name="alamat_lengkap" id="alamat_lengkap" value="{{ $detail->alamat_lengkap }}"
                                        placeholder="Masukkan Alamat Lengkap">
                                    @error('alamat_lengkap')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group" id="simple-date1">
                                    <label for="simpleDataInput">Tanggal Event</label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text"
                                            class="form-control @error('tanggal_event') is-invalid @enderror"
                                            name="tanggal_event" value="{{ $detail->tanggal_event }}" id="simpleDataInput">
                                    </div>
                                    @error('tanggal_event')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="clockPicker2">Jam Event</label>
                                    <div class="input-group clockpicker" id="clockPicker2">
                                        <input type="text" class="form-control @error('jam') is-invalid @enderror"
                                            name="jam" value="{{ $detail->jam }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>
                                    </div>
                                    @error('jam')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="touchSpin1">Target Pendonor</label>
                                    <input id="touchSpin1" type="text" name="jumlah_orang"
                                        class="form-control @error('jumlah_orang') is-invalid @enderror"
                                        value="{{ $detail->jumlah_orang }}">
                                    @error('jumlah_orang')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="upload_surat">Upload Surat</label>
                                    <input type="file" class="form-control @error('upload_surat') is-invalid @enderror"
                                        name="upload_surat">
                                    @error('upload_surat')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="upload_surat">Upload Gambar</label>
                                    <input type="file" class="form-control @error('upload_gambar') is-invalid @enderror"
                                        name="upload_gambar">
                                    @error('upload_gambar')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <img src="/foto_event/{{ $detail->gambar }}" alt="gambar" class="w-50">
                            </div>
                            <div class="col-lg-12 mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="form-group">
                                    <label for="upload_surat">Surat</label>
                                    <iframe src="{{ asset('foto_surat/' . $detail->upload_surat) }}" frameborder="0"
                                        scrolling="auto" width="100%" height="500px"></iframe>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
