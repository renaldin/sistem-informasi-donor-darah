@extends('layout.v_template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Form {{ $sub_title }} Bukan Anggota</h6>
                </div>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a href="/tambah_darah_offline_anggota" class="btn btn-danger">Form Anggota</a>
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
                                    <label for="nama_anggota">Nama Anggota <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror"
                                        name="nama_anggota" id="nama_anggota" value="{{ old('nama_anggota') }}" autofocus
                                        placeholder="Masukkan Nama Anggota">
                                    <input type="hidden" class="form-control @error('form_anggota') is-invalid @enderror"
                                        name="form_anggota" id="form_anggota" value="Non Anggota"
                                        placeholder="Masukkan Nama Anggota">
                                    @error('nama_anggota')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kartu">Jenis Kartu <span class="text-danger">*</span></label>
                                    <select name="kartu" class="form-control @error('kartu') is-invalid @enderror"
                                        required onchange="handleChange(event)" id="kartu">
                                        <option value="">-- Jenis Kartu --</option>
                                        <option value="KTP">KTP</option>
                                        <option value="SIM">SIM</option>
                                    </select>
                                    @error('kartu')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6" id="div_nik" style="display: none;">
                                <div class="form-group">
                                    <label for="nik">NIK/No. SIM <span class="text-danger">*</span></label>
                                    <input type="text" id="nik_sim" name="nik" onkeydown="return hanyaAngka(event)"
                                        class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}">
                                    @error('nik')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                        name="nik" id="nik" value="{{ old('nik') }}"
                                        placeholder="Masukkan NIK">
                                    @error('nik')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="no_wa">No. Whatsapp <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('no_wa') is-invalid @enderror"
                                        name="no_wa" onkeydown="return hanyaAngka(event)" id="no_wa"
                                        value="{{ old('no_wa') }}" placeholder="Contoh: 089897675487">
                                    @error('no_wa')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat <span class="text-danger">*</span></label>
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
                                    <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
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
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                        name="kecamatan" id="kecamatan" value="{{ old('kecamatan') }}"
                                        placeholder="Masukkan Kecamatan">
                                    @error('kecamatan')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('kabupaten') is-invalid @enderror"
                                        name="kabupaten" id="kabupaten" value="{{ old('kabupaten') }}"
                                        placeholder="Masukkan Kabupaten">
                                    @error('kabupaten')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="hasil_kusioner">Hasil Kusioner <span class="text-danger">*</span></label>
                                    <select name="hasil_kusioner"
                                        class="form-control @error('hasil_kusioner') is-invalid @enderror"
                                        id="hasil_kusioner">
                                        <option value="">Pilih</option>
                                        <option value="Lolos">Lolos</option>
                                        <option value="Tidak Lolos">Tidak Lolos</option>
                                    </select>
                                    @error('hasil_kusioner')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="deskripsi_hasil_kusioner">Deskripsi Hasil Kusioner <span
                                            class="text-danger">*</span></label>
                                    <textarea name="deskripsi_hasil_kusioner"
                                        class="form-control @error('deskripsi_hasil_kusioner') is-invalid @enderror" cols="10" rows="3"
                                        placeholder="Masukkan Deskripsi Hasil Kusioner"></textarea>
                                    @error('deskripsi_hasil_kusioner')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label><strong>Data Darah</strong></label>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="no_kantong">No. Kantong <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('no_kantong') is-invalid @enderror"
                                        name="no_kantong" id="no_kantong" value="{{ $no_kantong }}" readonly
                                        placeholder="Masukkan No. Kantong">
                                    <input type="hidden" class="form-control @error('form_darah') is-invalid @enderror"
                                        name="form_darah" id="form_darah" value="Offline">
                                    @error('no_kantong')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="golongan_darah">Golongan Darah <span class="text-danger">*</span></label>
                                    <select name="golongan_darah"
                                        class="form-control @error('golongan_darah') is-invalid @enderror"
                                        id="golongan_darah">
                                        <option value="">Pilih</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                    @error('golongan_darah')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="resus">Rhesus <span class="text-danger">*</span></label>
                                    <select name="resus" class="form-control @error('resus') is-invalid @enderror"
                                        id="resus">
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
                                    <label for="volume_darah">Volume Darah (CC) <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @error('volume_darah') is-invalid @enderror"
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

    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>

    <script>
        function handleChange(event) {
            var selectedValue = event.target.value;
            var nik = document.getElementById("nik_sim");
            var div_nik = document.getElementById("div_nik");
            if (selectedValue === 'KTP') {
                nik.placeholder = "Masukkan NIK";
                $('#nik_sim').attr('maxlength', '16');
                $('#nik_sim').val('');
                div_nik.style.display = "block";
            } else {
                nik.placeholder = "Masukkan No. SIM";
                $('#nik_sim').attr('maxlength', '12');
                $('#nik_sim').val('');
                div_nik.style.display = "block";
            }

            // Tambahkan logika atau tindakan lain yang ingin Anda lakukan
        }
    </script>
@endsection
