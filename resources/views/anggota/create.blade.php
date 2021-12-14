@extends('layout.main')

@section('title', 'SI Perpustakaan')

@section('content')

    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Tambah Data Anggota</h1>
            <hr class="my-4">

            <form action="/anggota" method="POST">
            @csrf
                <div class="form-group">
                    <label for="nama_anggota">Nama Anggota</label>
                    <input type="text" name="nama_anggota" id="nama" class="form-control" placeholder="Nama Anggota" value=" {{ old('nama_anggota') }} ">
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                    @foreach ($jenis_kelamin as $jk)
                        <option value="{{ $jk->jenis_kelamin }}">
                        {{ $jk->jenis_kelamin }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value=" {{ old('email') }} ">
                </div>

                <div class="form-group">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="Nama Anggota" value=" {{ old('no_telp') }} ">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

@endsection
