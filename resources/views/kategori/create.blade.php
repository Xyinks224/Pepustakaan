@extends('layout.main')

@section('title', 'SI Perpustakaan')

@section('content')

    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Tambah Kategori Buku</h1>
            <hr class="my-4">

            <form action="/kategori" method="POST">
            @csrf
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Buku</label>
                    <input type="text" name="deskripsi" placeholder="Deskripsi Buku" value=" {{ old('deskripsi') }} ">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

@endsection
