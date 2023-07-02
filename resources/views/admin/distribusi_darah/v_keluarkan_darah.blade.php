@extends('layout.v_template')

@section('content')
    @php
        function hitungUmur($tanggal_darah_masuk)
        {
            $tgl_lahir = new DateTime($tanggal_darah_masuk);
            $sekarang = new DateTime();
            $diff = $tgl_lahir->diff($sekarang);
            $umur = $diff->days;
        
            $data_umur = $umur . ' hari.';
            return $data_umur;
        }
    @endphp

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">{{ $sub_title }}</h6>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <table>
                                <tr>
                                    <th>Nama Rumah Sakit</th>
                                    <td>:</td>
                                    <td>{{ $detail->nama_rs }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Permohonan</th>
                                    <td>:</td>
                                    <td>{{ $detail->tanggal_permohonan }}</td>
                                </tr>
                                <tr>
                                    <th>Golongan Darah</th>
                                    <td>:</td>
                                    <td>{{ $detail->golda }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah {Kantong}</th>
                                    <td>:</td>
                                    <td>{{ $detail->jumlah }}</td>
                                </tr>
                                <tr>
                                    <th>Status Permohonan</th>
                                    <td>:</td>
                                    <td>
                                        @if ($detail->status_permohonan === 'Belum Dikirim')
                                            <span class="badge badge-danger">{{ $detail->status_permohonan }}</span>
                                        @elseif($detail->status_permohonan === 'Menunggu Proses')
                                            <span class="badge badge-primary">{{ $detail->status_permohonan }}</span>
                                        @elseif($detail->status_permohonan === 'Diterima')
                                            <span class="badge badge-success">{{ $detail->status_permohonan }}</span>
                                        @elseif($detail->status_permohonan === 'Dikirim')
                                            <span class="badge badge-warning">{{ $detail->status_permohonan }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <form action="/keluarkan_darah/{{ $detail->id_permohonan_darah }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="id_darah_masuk">Darah</label>
                                            <select
                                                class="select2-single-placeholder form-control @error('id_darah_masuk') is-invalid @enderror"
                                                name="id_darah_masuk" autofocus id="select2SinglePlaceholder" required>
                                                <option value="">Pilih</option>
                                                @foreach ($data_darah as $row)
                                                    @if ($row->status_darah_masuk == 'Sudah Masuk' && $row->tanggal_kedaluwarsa >= date('Y-m-d'))
                                                        <option value="{{ $row->id_darah_masuk }}">{{ $row->no_kantong }}
                                                            | {{ $row->golongan_darah }} | {{ $row->resus }} |
                                                            {{ hitungUmur($row->tanggal_darah_masuk) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('id_darah_masuk')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" data-toggle="modal"
                                                data-target="#keluarkan">Keluarkan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-header flex flex-row">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#kirim">Kirim</button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>No Kantung</th>
                                <th>Golongan Darah</th>
                                <th>Resus</th>
                                <th>Umur</th>
                                <th>Tanggal Kedaluwarsa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data_darah_keluar as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->no_kantong }}</td>
                                    <td>{{ $row->golongan_darah }}</td>
                                    <td>{{ $row->resus }}</td>
                                    <td>{{ hitungUmur($row->tanggal_darah_masuk) }}</td>
                                    <td>{{ $row->tanggal_kedaluwarsa }}</td>
                                    <td>
                                        <a href="/hapus_darah_keluar/{{ $row->id_darah_keluar }}"
                                            class="btn btn-sm btn-danger">Hapus</a>
                                        <a href="/cetak_invoice_distribusi/{{ $row->id_darah_keluar }}"
                                            class="btn btn-success btn-sm">Cetak</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}

    {{-- <div class="modal fade" id="keluarkan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Keluarkan Darah</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <form action="/keluarkan_darah/{{$detail->id_permohonan_darah}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="no_kantong">No. Kantong</label>
                        <input type="text" class="form-control @error('no_kantong') is-invalid @enderror" name="no_kantong" id="no_kantong" value="{{$no_kantong;}}" readonly placeholder="Masukkan No. Kantong">
                        <input type="hidden" class="form-control @error('form_darah') is-invalid @enderror" name="form_darah" id="form_darah" value="Online">
                        @error('no_kantong')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="id_anggota">Anggota</label>
                        <select class="select2-single-placeholder form-control @error('id_anggota') is-invalid @enderror" name="id_anggota" autofocus id="select2SinglePlaceholder">
                            <option value="">Pilih</option>
                            @foreach ($data_darah as $row)
                                <option value="{{$row->id_darah}}">{{$row->golongan_darah}}</option>
                            @endforeach
                        </select>
                        @error('id_anggota')
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
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
      <button type="submit" class="btn btn-danger">Keluarkan</button>
    </div>
    </form>
  </div>
</div>
</div> --}}


    <div class="modal fade" id="kirim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kirim</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin akan kirim distribusi darah ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                    <a href="/kirim_distribusi_darah/{{ $detail->id_permohonan_darah }}" class="btn btn-danger">Kirim</a>
                </div>
            </div>
        </div>
    </div>
@endsection
