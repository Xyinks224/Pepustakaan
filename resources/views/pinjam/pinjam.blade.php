@extends('layout.main')

@section('title', 'SI Perpustakaan')

@section('content')

<div class="container">
    <div class="jumbotron">
            <h1 class="display-4">Pinjam Buku</h1>
            <hr class="my-4">

            <form action="/pinjam" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tipe_pinjam">Tipe Pinjam</label>
                <select name="tipe_pinjam" id="tipe_pinjam" class="form-control">
                    <option value="pinjam">Pinjam</option>
                </select>
            </div>

            <div class="form-group">
                <label for="id_buku">Kode Buku</label>
                <input type="text" name="id_buku" placeholder="Kode Buku" class="form-control" data-url=" {{ url('/') }} ">
            </div>

            <div class="form-group">
                <label for="judul_buku">Judul Buku</label>
                <input type="text" name="judul_buku" id="judul_buku" placeholder="Judul Buku" readonly="true">
            </div>

            <div class="form-group">
                <label for="judul_buku">Deskripsi Buku</label>
                <input type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi Buku" readonly="true">
            </div>

            <div class="form-group">
                <label for="judul_buku">Kategori Buku</label>
                <input type="text" name="kategori" id="kategori" placeholder="Kategori Buku" readonly="true">
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="kategori">Tanggal Pinjam</label>
                        <input type="date" name="tgl_pinjam" class="form-control">
                    </div>

                    <div class="col-sm-6">
                        <label for="kategori">Tanggal Kembali</label>
                        <input type="date" name="tgl_kembali" class="form-control" readonly="true">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="nama_anggota">ID Anggota Peminjam</label>
                <input type="text" name="id_anggota" id="id_anggota" class="form-control" data-url="{{ url('/') }}">
            </div>

            <div class="form-group">
                <label for="nama_anggota">Nama Peminjam</label>
                <input type="text" name="nama_anggota" id="nama_anggota" placeholder="Nama Peminjam" class="form-control" readonly="true">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
    $(function() {
        $('#id_buku').on('change', function(e){

            let id_buku = $('#id_buku').val();
            console.log(id_buku);

            let url = $(this).data('url') + '/pinjam/showBuku' + id_buku;
            console.log(url);

            getBuku(url);
        })

        $('#id_anggota').on('change', function(e){

            let id_anggota = $('#id_anggota').val();
            console.log(id_anggota);

            let url = $(this).data('url') + '/pinjam/getAnggota' + id_anggota;
            console.log(url);

            getAnggota(url);
        })
    })

    function getBuku(url) {
        $.getJSON(url, function(data){
            if (data === false)
            {
                alert('!! Buku Tidak Ditemukan !!')
                $('#id_buku').val("");
            }
            else
            {
                $('#judul_buku').val(data[0].judul_buku);
                $('#deskripsi').val(data[0].deskripsi);
                $('kategori').val(data[0].kategori);
            }
        });
    }

    function getAnggota(url) {
        $.getJSON(url, function(data){
            if (data === false)
            {
                alert('!! Data Anggota Tidak Ditemukan !!')
                $('#id_anggota').val("");
                $('#nama_anggota').val("");
            }
            else
            {
                $('#nama_anggota').val(data.nama_anggota);
            }
        });
    }
</script>

@endsection
