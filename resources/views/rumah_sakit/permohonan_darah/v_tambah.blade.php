@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold">Form {{$sub_title}}</h6>
        </div>
        <div class="card-body">
            <form action="/tambah_permohonan_darah" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_rs">Nama Rumah Sakit</label>
                        <input type="text" class="form-control @error('nama_rs') is-invalid @enderror" name="nama_rs" id="nama_rs" value="{{$user->nama}}" autofocus placeholder="Masukkan Nama Rumah Sakit" readonly>
                        @error('nama_rs')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_dokter">Nama Dokter</label>
                        <input type="text" class="form-control @error('nama_dokter') is-invalid @enderror" name="nama_dokter" id="nama_dokter" value="{{old('nama_dokter')}}" placeholder="Masukkan Nama Dokter">
                        @error('nama_dokter')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_pasien">Nama Pasien</label>
                        <input type="text" class="form-control @error('nama_pasien') is-invalid @enderror" name="nama_pasien" id="nama_pasien" value="{{old('nama_pasien')}}" placeholder="Masukkan Nama Pasien">
                        @error('nama_pasien')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="golda">Golongan Darah <span><a href="#" class="text-danger" data-toggle="modal" data-target="#stok_darah">Lihat Stok</a></span></label>
                        <select name="golda" class="form-control @error('golda') is-invalid @enderror" id="golda">
                            <option value="">Pilih</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                        @error('golda')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="rhesus">Rhesus</label>
                        <select name="rhesus" class="form-control @error('rhesus') is-invalid @enderror" id="rhesus">
                            <option value="">Pilih</option>
                            <option value="Positif">Positif</option>
                            <option value="Negatif">Negatif</option>
                        </select>
                        @error('rhesus')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="jenis_darah">Jenis Darah</label>
                        <select name="jenis_darah" class="form-control @error('jenis_darah') is-invalid @enderror" id="jenis_darah">
                            <option value="">Pilih</option>
                            <option value="Darah Segar">Darah Segar</option>
                            <option value="Darah Simpan">Darah Simpan</option>
                        </select>
                        @error('jenis_darah')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="touchSpin1">Jumlah (Kantong)</label>
                        <input id="touchSpin1" type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{old('jumlah')}}">
                        @error('jumlah')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="upload_surat">Upload Surat</label>
                        <input type="file" class="form-control @error('upload_surat') is-invalid @enderror" name="upload_surat">
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


{{-- stok darah --}}
<div class="modal fade" id="stok_darah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Stok Darah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Stok Darah</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Golongan Darah</th>
                                    <th>Rhesus</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>A</td>
                                    <td>Positif</td>
                                    <td><?= $gol['a+'] == 0 ? '<span class="badge badge-danger">' . $gol['a+'] . '</span>' : $gol['a+'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>B</td>
                                    <td>Positif</td>
                                    <td><?= $gol['b+'] == 0 ? '<span class="badge badge-danger">' . $gol['b+'] . '</span>' : $gol['b+'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>AB</td>
                                    <td>Positif</td>
                                    <td><?= $gol['ab+'] == 0 ? '<span class="badge badge-danger">' . $gol['ab+'] . '</span>' : $gol['ab+'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>O</td>
                                    <td>Positif</td>
                                    <td><?= $gol['o+'] == 0 ? '<span class="badge badge-danger">' . $gol['o+'] . '</span>' : $gol['o+'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>A</td>
                                    <td>Negatif</td>
                                    <td><?= $gol['a-'] == 0 ? '<span class="badge badge-danger">' . $gol['a-'] . '</span>' : $gol['a-'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>B</td>
                                    <td>Negatif</td>
                                    <td><?= $gol['b-'] == 0 ? '<span class="badge badge-danger">' . $gol['b-'] . '</span>' : $gol['b-'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>AB</td>
                                    <td>Negatif</td>
                                    <td><?= $gol['ab-'] == 0 ? '<span class="badge badge-danger">' . $gol['ab-'] . '</span>' : $gol['ab-'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>O</td>
                                    <td>Negatif</td>
                                    <td><?= $gol['o-'] == 0 ? '<span class="badge badge-danger">' . $gol['o-'] . '</span>' : $gol['o-'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
</div>

@endsection