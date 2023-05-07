@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold">Form {{$sub_title}}</h6>
        </div>
        <div class="card-body">
            <form action="/tambah_event" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_instansi">Nama Instansi</label>
                        <input type="text" class="form-control @error('nama_instansi') is-invalid @enderror" name="nama_instansi" id="nama_instansi" value="{{old('nama_instansi')}}" placeholder="Masukkan Nama Instansi">
                        @error('nama_instansi')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="alamat_lengkap">Alamat Lengkap</label>
                        <input type="text" class="form-control @error('alamat_lengkap') is-invalid @enderror" name="alamat_lengkap" id="alamat_lengkap" value="{{old('alamat_lengkap')}}" placeholder="Masukkan Alamat Lengkap">
                        @error('alamat_lengkap')
                            <small class="form-text text-danger">{{$message}}</small>
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
                            <input type="text" class="form-control @error('tanggal_event') is-invalid @enderror" name="tanggal_event" value="{{date('Y-m-d')}}" id="simpleDataInput">
                        </div>
                        @error('tanggal_event')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="clockPicker2">Jam Event</label>
                        <div class="input-group clockpicker" id="clockPicker2">
                          <input type="text" class="form-control @error('jam') is-invalid @enderror" name="jam" value="00:00">                     
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
                        <label for="touchSpin1">Jumlah Orang</label>
                        <input id="touchSpin1" type="text" name="jumlah_orang" class="form-control @error('jumlah_orang') is-invalid @enderror">
                        @error('jumlah_orang')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="upload_surat">Upload Surat</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('upload_surat') is-invalid @enderror" name="upload_surat" id="customFile">
                            <label class="custom-file-label" for="customFile">Pilih file</label>
                        </div>
                        @error('upload_surat')
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