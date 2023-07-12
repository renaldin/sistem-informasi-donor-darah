@extends('layout.v_template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Form Tambah Darah Event</h6>
                </div>
                <div class="card-body">
                    <form action="/tambah_darah_event/{{ $detail->id_event }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <label><strong>Data Pendonor</strong></label>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_anggota">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror"
                                        name="nama_anggota" id="nama_anggota" value="{{ old('nama_anggota') }}" autofocus
                                        placeholder="Masukkan Nama Anggota">
                                    @error('nama_anggota')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                        name="nik" id="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK"
                                        required>
                                    @error('nik')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="no_wa">Nomor Whatsapp</label>
                                    <input type="number" class="form-control @error('no_wa') is-invalid @enderror"
                                        name="no_wa" id="no_wa" value="{{ old('no_wa') }}"
                                        placeholder="Masukkan Nomor Whatsapp" required>
                                    @error('no_wa')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat" id="alamat" value="{{ old('alamat') }}"
                                        placeholder="Masukkan Alamat">
                                    @error('alamat')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin"
                                        class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                        <option value="">Pilih</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label><strong>Data Darah</strong></label>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="no_kantong">No. Kantong</label>
                                    <input type="text" class="form-control @error('no_kantong') is-invalid @enderror"
                                        name="no_kantong" id="no_kantong" value="{{ $no_kantong }}" readonly
                                        placeholder="Masukkan No. Kantong">
                                    @error('no_kantong')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="golongan_darah">Golongan Darah</label>
                                    <select name="golongan_darah"
                                        class="form-control @error('golongan_darah') is-invalid @enderror">
                                        <option value="">Pilih</option>
                                        <option value="A">A</option>
                                        <option value="AB">AB</option>
                                        <option value="B">B</option>
                                        <option value="O">O</option>
                                    </select>
                                    @error('golongan_darah')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="resus">Rhesus</label>
                                    <select name="resus" class="form-control @error('resus') is-invalid @enderror">
                                        <option value="">Pilih</option>
                                        <option value="Positif">Positif</option>
                                        <option value="Negatif">Negatif</option>
                                    </select>
                                    @error('resus')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="volume_darah">Volume Darah (CC)</label>
                                    <input type="text" class="form-control @error('volume_darah') is-invalid @enderror"
                                        name="volume_darah" id="volume_darah" value="{{ old('volume_darah') }}"
                                        placeholder="Masukkan Golongan Darah">
                                    @error('volume_darah')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
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
                </div> --}}
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
