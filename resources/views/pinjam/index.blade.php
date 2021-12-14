@extends('layout.main')

@section('title', 'SI Perpustakaan')

@section('content')
<div class="container">
    <div class="jumbotron">

        @if(session('msg'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{session('msg')}}
            <button class="close" type="button" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <h1 class="display-6">Data Pinjam Buku</h1>
        <hr class="my-4">

        <a href="pinjam/create" class="btn btn-primary mb-1">Pinjam Buku</a>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No Peminjaman</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Deskripsi Buku</th>
                    <th scope="col">Kategori Buku</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Tanggal Kembali</th>
                </tr>
            </thead>

            <tbody>

            @foreach (@pinjam as @pjm)

                <tr>
                    <td> {{ $pjm -> id }} </td>
                    <td> {{ $pjm -> judul_buku }} </td>
                    <td> {{ $pjm -> deskripsi }} </td>
                    <td> {{ $pjm -> kategori }} </td>
                    <td> {{ $pjm -> tgl_pinjam }} </td>
                    <td> {{ $pjm -> tgl_kembali }} </td>
                    <td>
                        @if(pjm->tgl_kembali == null)
                        <a href="pinjam/edit/{{ $pjm -> id }}" class="badge badge-primary">Pengembalian</a>
                        @else
                        <p class="badge badge-success">Dikembalikan</p>
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
