@extends('layout.v_template')

@section('content')

    @php
        function tanggal_indonesia($tanggal)
        {
            $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
            $tanggal_array = explode('-', $tanggal);
            $tahun = $tanggal_array[0];
            $bulan_angka = intval($tanggal_array[1]);
            $tanggal_angka = intval($tanggal_array[2]);
        
            $tanggal_indonesia = $tanggal_angka . ' ' . $bulan[$bulan_angka - 1] . ' ' . $tahun;
        
            return $tanggal_indonesia;
        }
    @endphp

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">{{ $sub_title }}</h6>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <img class="img-profile rounded-circle" style="width: 120px;"
                        src="@if ($user->foto === null) {{ asset('foto_user/default.jpg') }} @else {{ asset('foto_user/' . $user->foto) }} @endif"
                        alt="profile">
                </div>
                <div class="card-header d-flex flex-row align-items-center justify-content-center">
                    <h6 class="m-0 font-weight-bold">{{ $user->nama }}</h6>
                </div>
                <div class="card-body">
                    @if ($user->role === 'Event')
                        <div class="form-group">
                            <label>Kode Instansi : {{ $user->kode_instansi }}</label>
                        </div>
                    @endif
                    @if ($user->role === 'Rumah Sakit')
                        <div class="form-group">
                            <label>Kode Rumah Sakit : {{ $user->kode_rs }}</label>
                        </div>
                    @endif
                    @if ($user->role === 'Donatur')
                        <div class="form-group">
                            @if ($user->kartu === 'KTP')
                                <label>NIK : {{ $user->nik }}</label>
                            @else
                                <label>No. SIM : {{ $user->nik }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin : {{ $user->jk }}</label>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir : {{ tanggal_indonesia($user->tanggal_lahir) }}</label>
                        </div>
                        <div class="form-group">
                            <label>Golongan Darah : {{ $user->gol_darah ? $user->gol_darah : '-' }}</label>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Nomor Telepon : {{ $user->nomor_telepon }}</label>
                    </div>
                    <div class="form-group">
                        <label>Email : {{ $user->email }}</label>
                    </div>
                    <div class="form-group">
                        <label>Alamat :
                            {{ $user->alamat_user . ', Kec. ' . $user->kecamatan . ', Kab. ' . $user->kabupaten }}</label>
                    </div>
                    <div class="form-group">
                        <label>Status : {{ $user->role }}</label>
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
                    <form action="/edit_profil/{{ $user->id_user }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            @if ($user->role === 'Event')
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="kode_instansi">Kode Instansi</label>
                                        <input type="text"
                                            class="form-control @error('kode_instansi') is-invalid @enderror"
                                            name="kode_instansi" id="kode_instansi" value="{{ $user->kode_instansi }}"
                                            placeholder="Masukkan Kode Instansi" required>
                                        @error('kode_instansi')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            @if ($user->role === 'Rumah Sakit')
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="kode_rs">Kode Rumah Sakit</label>
                                        <input type="text" class="form-control @error('kode_rs') is-invalid @enderror"
                                            name="kode_rs" id="kode_rs" value="{{ $user->kode_rs }}"
                                            placeholder="Masukkan Kode Rumah Sakit" required>
                                        @error('kode_rs')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama">
                                        @if ($user->role === 'Event')
                                            Nama Instansi
                                        @elseif($user->role === 'Rumah Sakit')
                                            Nama Rumah Sakit
                                        @else
                                            Nama Lengkap
                                        @endif
                                    </label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        name="nama" id="nama" value="{{ $user->nama }}"
                                        placeholder="Masukkan Nama Lengkap">
                                    <input type="hidden" class="form-control" name="role" value="{{ $user->role }}">
                                    @error('nama')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Alamat</label>
                                    <input type="text" class="form-control @error('alamat_user') is-invalid @enderror"
                                        name="alamat_user" id="alamat_user" value="{{ $user->alamat_user }}"
                                        placeholder="Masukkan Alamat">
                                    @error('alamat_user')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Kecamatan</label>
                                    <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                        name="kecamatan" id="kecamatan" value="{{ $user->kecamatan }}"
                                        placeholder="Masukkan Kecamatan">
                                    @error('kecamatan')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Kabupaten</label>
                                    <input type="text" class="form-control @error('kabupaten') is-invalid @enderror"
                                        name="kabupaten" id="kabupaten" value="{{ $user->kabupaten }}"
                                        placeholder="Masukkan Kabupaten">
                                    @error('kabupaten')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            @if ($user->role === 'Donatur')
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="kartu">Jenis Kartu</label>
                                        <select name="kartu" class="form-control @error('kartu') is-invalid @enderror"
                                            required onchange="handleChange(event)" id="kartu">
                                            <option value="{{ $user->kartu }}">{{ $user->kartu }}</option>
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
                                        <label for="nik">NIK/No. SIM</label>
                                        <input type="text" id="nik_sim" name="nik"
                                            onkeydown="return hanyaAngka(event)"
                                            class="form-control @error('nik') is-invalid @enderror"
                                            value="{{ $user->nik }}">
                                        @error('nik')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            name="tanggal_lahir" id="tanggal_lahir" value="{{ $user->tanggal_lahir }}"
                                            placeholder="Masukkan Tanggal Lahir" required>
                                        @error('tanggal_lahir')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label>
                                        <select class="form-control @error('jk') is-invalid @enderror" name="jk"
                                            required>
                                            @if ($user->jk)
                                                <option value="{{ $user->jk }}">{{ $user->jk }}</option>
                                            @else
                                                <option value="">-- Pilih --</option>
                                            @endif
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
                                        <label for="gol_darah">Golongan Darah</label>
                                        <select class="form-control @error('gol_darah') is-invalid @enderror"
                                            name="gol_darah">
                                            @if ($user->gol_darah)
                                                <option value="{{ $user->gol_darah }}">{{ $user->gol_darah }}</option>
                                            @else
                                                <option value="">-- Pilih --</option>
                                            @endif
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>
                                        </select>
                                        @error('gol_darah')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text"
                                        class="form-control @error('nomor_telepon') is-invalid @enderror"
                                        onkeydown="return hanyaAngka(event)" name="nomor_telepon" id="nomor_telepon"
                                        value="{{ $user->nomor_telepon }}" placeholder="Contoh: 089876567654">
                                    @error('nomor_telepon')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ $user->email }}"
                                        placeholder="Masukkan Email">
                                    @error('email')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                        name="foto">
                                    @error('foto')
                                        <small class="form-text text-danger">{{ $message }}</small>
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
    </script>
@endsection
