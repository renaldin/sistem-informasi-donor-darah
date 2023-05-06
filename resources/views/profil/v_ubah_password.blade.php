@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold">Form {{$sub_title}}</h6>
        </div>
        <div class="card-body">
            <form action="/ubah_password/{{$user->id_user}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" class="form-control @error('password_lama') is-invalid @enderror" name="password_lama" id="password_lama" placeholder="Masukkan Password Lama">
                        @error('password_lama')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>       
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" class="form-control @error('password_baru') is-invalid @enderror" name="password_baru" id="password_baru" placeholder="Masukkan Password Lama">
                        @error('password_baru')
                            <small class="form-text text-danger">{{$message}}</small>
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

@endsection