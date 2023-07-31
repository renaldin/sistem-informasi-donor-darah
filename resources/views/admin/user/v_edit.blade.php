@extends('layout.v_template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Form {{ $sub_title }}</h6>
                </div>
                <div class="card-body">
                    <form action="/edit_user/{{ $detail->id_user }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            @if ($detail->role === 'Petugas Kesehatan')
                                <div class="col-lg-12" id="petugas_kesehatan">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Lengkap <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror" name="nama"
                                                    id="nama" value="{{ $detail->nama }}"
                                                    placeholder="Masukkan Nama Lengkap">
                                                <input type="hidden" name="role" value="Petugas Kesehatan">
                                                @error('nama')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="alamat_user">Alamat <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('alamat_user') is-invalid @enderror"
                                                    name="alamat_user" id="alamat_user" value="{{ $detail->alamat_user }}"
                                                    placeholder="Masukkan Alamat">
                                                @error('alamat_user')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('kecamatan') is-invalid @enderror"
                                                    name="kecamatan" id="kecamatan" value="{{ $detail->kecamatan }}"
                                                    placeholder="Masukkan Kecamatan">
                                                @error('kecamatan')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('kabupaten') is-invalid @enderror"
                                                    name="kabupaten" id="kabupaten" value="{{ $detail->kabupaten }}"
                                                    placeholder="Masukkan Kabupaten">
                                                @error('kabupaten')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nomor_telepon">Nomor Telepon <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('nomor_telepon') is-invalid @enderror"
                                                    name="nomor_telepon" id="nomor_telepon"
                                                    onkeydown="return hanyaAngka(event)"
                                                    value="{{ $detail->nomor_telepon }}"
                                                    placeholder="Masukkan Nomor Telepon">
                                                @error('nomor_telepon')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    id="email" value="{{ $detail->email }}"
                                                    placeholder="Masukkan Email">
                                                @error('email')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="password">Password <span class="text-danger">*</span></label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" id="password" placeholder="Masukkan Password">
                                                <small class="form-text text-danger">Password minimal 6 karakter</small>
                                                @error('password')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="foto">Foto <span class="text-danger">*</span></label>
                                                <input type="file"
                                                    class="form-control @error('foto') is-invalid @enderror"
                                                    name="foto">
                                                @error('foto')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($detail->role === 'Event')
                                <div class="col-lg-12" id="event">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nama">Kode Instansi <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="kode_instansi"
                                                    class="form-control @error('kode_instansi') is-invalid @enderror"
                                                    value="{{ $detail->kode_instansi }}"
                                                    placeholder="Masukkan Kode Instansi">
                                                <input type="hidden" name="role" value="Event">
                                                @error('kode_instansi')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Instansi <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    name="nama" id="nama" value="{{ $detail->nama }}"
                                                    placeholder="Masukkan Nama Instansi">
                                                @error('nama')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="alamat_user">Alamat <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('alamat_user') is-invalid @enderror"
                                                    name="alamat_user" id="alamat_user"
                                                    value="{{ $detail->alamat_user }}" placeholder="Masukkan Alamat">
                                                @error('alamat_user')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('kecamatan') is-invalid @enderror"
                                                    name="kecamatan" id="kecamatan" value="{{ $detail->kecamatan }}"
                                                    placeholder="Masukkan Kecamatan">
                                                @error('kecamatan')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="kabupaten">Kabupaten <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('kabupaten') is-invalid @enderror"
                                                    name="kabupaten" id="kabupaten" value="{{ $detail->kabupaten }}"
                                                    placeholder="Masukkan Kabupaten">
                                                @error('kabupaten')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nomor_telepon">Nomor Telepon <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('nomor_telepon') is-invalid @enderror"
                                                    name="nomor_telepon" id="nomor_telepon"
                                                    onkeydown="return hanyaAngka(event)"
                                                    value="{{ $detail->nomor_telepon }}"
                                                    placeholder="Masukkan Nomor Telepon">
                                                @error('nomor_telepon')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" id="email" value="{{ $detail->email }}"
                                                    placeholder="Masukkan Email">
                                                @error('email')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="password">Password <span class="text-danger">*</span></label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" id="password" placeholder="Masukkan Password">
                                                <small class="form-text text-danger">Password minimal 6 karakter</small>
                                                @error('password')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="foto">Foto <span class="text-danger">*</span></label>
                                                <input type="file"
                                                    class="form-control @error('foto') is-invalid @enderror"
                                                    name="foto">
                                                @error('foto')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($detail->role === 'Donatur')
                                <div class="col-lg-12" id="donatur">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Lengkap <span
                                                        class="text-danger">*</span></label>
                                                <input type="hidden" name="role" value="Donatur">
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    name="nama" id="nama" value="{{ $detail->nama }}"
                                                    placeholder="Masukkan Nama Lengkap">
                                                @error('nama')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="kartu">Jenis Kartu <span
                                                        class="text-danger">*</span></label>
                                                <select name="kartu"
                                                    class="form-control @error('kartu') is-invalid @enderror" required
                                                    onchange="handleChange(event)" id="kartu">
                                                    <option value="{{ $detail->kartu }}">{{ $detail->kartu }}</option>
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
                                                <label for="nik">NIK/No. SIM <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="nik_sim" name="nik"
                                                    onkeydown="return hanyaAngka(event)"
                                                    class="form-control @error('nik') is-invalid @enderror"
                                                    value="{{ $detail->nik }}">
                                                @error('nik')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="tanggal_lahir"
                                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                    value="{{ $detail->tanggal_lahir }}" placeholder="Tanggal Lahir"
                                                    onfocus="(this.type='date')">
                                                @error('tanggal_lahir')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="jk">Jenis Kelamin <span
                                                        class="text-danger">*</span></label>
                                                <select name="jk"
                                                    class="form-control @error('jk') is-invalid @enderror">
                                                    <option value="{{ $detail->jk }}">{{ $detail->jk }}</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                                @error('jk')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="gol_darah">Golongan Darah (Opsional)</label>
                                                <select name="gol_darah"
                                                    class="form-control @error('gol_darah') is-invalid @enderror">
                                                    <option value="{{ $detail->gol_darah }}">{{ $detail->gol_darah }}
                                                    </option>
                                                    <option value="A">A</option>
                                                    <option value="AB">AB</option>
                                                    <option value="B">B</option>
                                                    <option value="O">O</option>
                                                </select>
                                                @error('gol_darah')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="alamat_user">Alamat <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('alamat_user') is-invalid @enderror"
                                                    name="alamat_user" id="alamat_user"
                                                    value="{{ $detail->alamat_user }}" placeholder="Masukkan Alamat">
                                                @error('alamat_user')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('kecamatan') is-invalid @enderror"
                                                    name="kecamatan" id="kecamatan" value="{{ $detail->kecamatan }}"
                                                    placeholder="Masukkan Kecamatan">
                                                @error('kecamatan')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="kabupaten">Kabupaten <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('kabupaten') is-invalid @enderror"
                                                    name="kabupaten" id="kabupaten" value="{{ $detail->kabupaten }}"
                                                    placeholder="Masukkan Kabupaten">
                                                @error('kabupaten')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nomor_telepon">Nomor Telepon <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('nomor_telepon') is-invalid @enderror"
                                                    name="nomor_telepon" id="nomor_telepon"
                                                    onkeydown="return hanyaAngka(event)"
                                                    value="{{ $detail->nomor_telepon }}"
                                                    placeholder="Masukkan Nomor Telepon">
                                                @error('nomor_telepon')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" id="email" value="{{ $detail->email }}"
                                                    placeholder="Masukkan Email">
                                                @error('email')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="password">Password <span class="text-danger">*</span></label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" id="password" placeholder="Masukkan Password">
                                                <small class="form-text text-danger">Password minimal 6 karakter</small>
                                                @error('password')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="foto">Foto <span class="text-danger">*</span></label>
                                                <input type="file"
                                                    class="form-control @error('foto') is-invalid @enderror"
                                                    name="foto">
                                                @error('foto')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($detail->role === 'Rumah Sakit')
                                <div class="col-lg-12" id="rumah_sakit">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nama">Kode Rumah Sakit <span
                                                        class="text-danger">*</span></label>
                                                <input type="hidden" name="role" value="Rumah Sakit">
                                                <input type="text" name="kode_rs"
                                                    class="form-control @error('kode_rs') is-invalid @enderror"
                                                    value="{{ $detail->kode_rs }}"
                                                    placeholder="Masukkan Kode Rumah Sakit">
                                                @error('kode_rs')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Rumah Sakit <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    name="nama" id="nama" value="{{ $detail->nama }}"
                                                    placeholder="Masukkan Nama Rumah Sakit">
                                                @error('nama')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="alamat_user">Alamat <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('alamat_user') is-invalid @enderror"
                                                    name="alamat_user" id="alamat_user"
                                                    value="{{ $detail->alamat_user }}" placeholder="Masukkan Alamat">
                                                @error('alamat_user')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('kecamatan') is-invalid @enderror"
                                                    name="kecamatan" id="kecamatan" value="{{ $detail->kecamatan }}"
                                                    placeholder="Masukkan Kecamatan">
                                                @error('kecamatan')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="kabupaten">Kabupaten <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('kabupaten') is-invalid @enderror"
                                                    name="kabupaten" id="kabupaten" value="{{ $detail->kabupaten }}"
                                                    placeholder="Masukkan Kabupaten">
                                                @error('kabupaten')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nomor_telepon">Nomor Telepon <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('nomor_telepon') is-invalid @enderror"
                                                    name="nomor_telepon" id="nomor_telepon"
                                                    onkeydown="return hanyaAngka(event)"
                                                    value="{{ $detail->nomor_telepon }}"
                                                    placeholder="Masukkan Nomor Telepon">
                                                @error('nomor_telepon')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" id="email" value="{{ $detail->email }}"
                                                    placeholder="Masukkan Email">
                                                @error('email')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="password">Password <span class="text-danger">*</span></label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" id="password" placeholder="Masukkan Password">
                                                <small class="form-text text-danger">Password minimal 6 karakter</small>
                                                @error('password')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="foto">Foto <span class="text-danger">*</span></label>
                                                <input type="file"
                                                    class="form-control @error('foto') is-invalid @enderror"
                                                    name="foto">
                                                @error('foto')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-12 mt-5">
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
                div_nik.style.display = "block";
            } else {
                nik.placeholder = "Masukkan No. SIM";
                div_nik.style.display = "block";
            }

            // Tambahkan logika atau tindakan lain yang ingin Anda lakukan
        }

        function handleRole(event) {
            var selectedValue = event.target.value;
            var petugas_kesehatan = document.getElementById("petugas_kesehatan");
            var rumah_sakit = document.getElementById("rumah_sakit");
            var donatur = document.getElementById("donatur");
            var event = document.getElementById("event");

            if (selectedValue === 'Petugas Kesehatan') {
                petugas_kesehatan.style.display = "block";
                rumah_sakit.style.display = "none";
                donatur.style.display = "none";
                event.style.display = "none";
            } else if (selectedValue === 'Rumah Sakit') {
                petugas_kesehatan.style.display = "none";
                rumah_sakit.style.display = "block";
                donatur.style.display = "none";
                event.style.display = "none";
            } else if (selectedValue === 'Donatur') {
                petugas_kesehatan.style.display = "none";
                rumah_sakit.style.display = "none";
                donatur.style.display = "block";
                event.style.display = "none";
            } else if (selectedValue === 'Event') {
                petugas_kesehatan.style.display = "none";
                rumah_sakit.style.display = "none";
                donatur.style.display = "none";
                event.style.display = "block";
            }

            // Tambahkan logika atau tindakan lain yang ingin Anda lakukan
        }
    </script>
@endsection
