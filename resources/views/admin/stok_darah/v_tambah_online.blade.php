@extends('layout.v_template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Form {{ $sub_title }}</h6>
                </div>
                <div class="card-body">
                    <form action="/tambah_darah_online" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="no_kantong">No. Kantong <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('no_kantong') is-invalid @enderror"
                                        name="no_kantong" id="no_kantong" value="{{ $no_kantong }}" readonly
                                        placeholder="Masukkan No. Kantong">
                                    <input type="hidden" class="form-control @error('form_darah') is-invalid @enderror"
                                        name="form_darah" id="form_darah" value="Online">
                                    @error('no_kantong')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="id_donor">Pendonor <span class="text-danger">*</span></label>
                                    <select
                                        class="select2-single-placeholder form-control @error('id_donor') is-invalid @enderror"
                                        name="id_donor" autofocus id="select2SinglePlaceholder">
                                        <option value="">Pilih</option>
                                        @foreach ($donor as $row)
                                            @if ($row->status_donor == 'Ready')
                                                <option value="{{ $row->id_donor }}"><b>{{ $row->nama_anggota }}</b> |
                                                    {{ date('d F Y H:i', strtotime($row->tanggal_donor)) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('id_donor')
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
