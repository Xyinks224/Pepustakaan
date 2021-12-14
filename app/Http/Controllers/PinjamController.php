<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;
use App\Buku;
use App\Kategori;
use App\Pinjam;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjam = DB::table('table_pinjam')->join('table_buku', 'table_buku.id_buku', '=', 'table_pinjam.id_buku' )
                                              ->join('table_kategori', 'table_kategori.kategori', '=', 'table_buku.kategori')
                                              ->join('table_anggota', 'table_pinjam.id_anggota', '=', 'table_anggota.id_anggpta')
                                              -select('table_pinjam.id', 'table_anggota.nama_anggota', 'table_buku.id_buku', 'table_buku.judul_buku', 'table_buku,deskripsi', 'table_kategori.deskripsi as kategori', 'table_pinjam.tgl_pinjam', 'table_pinjam.tgl_kembali')
                                              ->get();

        return view('pinjam.index', compact('pinjam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pinjam.pinjam');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Anggota::where('id_anggota', $request -> id_anggota)->count() > 0)
        {
            if (Buku::where('id_buku', $request -> id_buku)-> count() > 0) {
                $pinjam = new Pinjam;

                $pinjam -> id_anggota = $request -> id_anggota;
                $pinjam -> id_buku = $request -> id_buku;

                if ($request -> tipe_pinjam == 'pinjam') {
                    $pinjam -> tgl_pinjam = $request -> tgl_pinjam;
                    $pinjam -> tgl_kembali = null;
                    $pinjam -> save();

                    return redirect('transaksi')->with('msg', 'Data Berhasil Disimpan');
                }
                else
                {
                    $pinjam -> tgl_kembali = $request -> tgl_kembali;
                }
            }
            else
            {
                return json_encode('Buku Tidak Ditemukan');
            }
        }
        else
        {
            return json_encode('Anggota Tidak Ditemukan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pinjaman = DB::table('table_pinjam')->join('table_buku', '.table_buku.id_buku', '=', 'table_pinjam.id_buku')
                                             ->join('table_anggota', 'table_anggota.id_anggota', '=', 'table_pinjam.id_anggota')
                                             ->join('table_kategori', 'table_kategori.kategori', '=', 'table_buku.kategori')
                                             ->select('table_pinjam.id', 'table_pinjam.id_anggota', 'table_anggota.nama_anggota', 'table_buku.id_buku', 'table_buku.judul_buku', 'table_buku.deskripsi', 'table_kategori.deskripsi as kategori', 'table_pinjam.tgl_pinjam', 'table_pinjam.tgl_kembali')
                                             ->where('table_pinjam.id', '=', $id)
                                             ->first();

        return json_encode($pinjaman);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showBuku($id)
    {
        if (Buku::where('id_buku', $id)->count > 0)
        {
            $buku = DB::table('table_buku')->join('table_kategori', 'table_buku.kategori', '=', 'table_kategori.kategori')
                                           ->select('table_buku,id_buku', 'table_buku.judul_buku', 'table_buku.deksripsi', 'table_kateogri.deskripsi as kategori', 'table_buku.cover')
                                           ->where('table_buku.id_buku', '=', $id)
                                           ->get();

            return $buku;
        }
        else
        {
            return 'false';
        }

    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAnggota($id)
    {
        $anggota = Anggota::where('id_anggota', $id)->first();

        if (anggota == null)
        {
            return 'false';
        }
        else
        {
            return $anggota;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pinjaman = DB::table('table-_pinjam')->join('table_buku', 'table_buku.id_buku', '=', 'table_pinjam.id_buku')
                                              ->join('table_anggota', 'table_anggota.id_anggota', '=', 'table_pinjam.id_anggota')
                                              ->join('table_kategori', 'table_kategori.kategori', '=', 'table_buku.kategori')
                                              ->select('table_pinjam.id', 'table_pinjam.id_anggota', 'table_anggota.nama_anggota', 'table_buku.id_buku', 'table_buku.judul_buku', 'table_buku.deskripsi', 'table_kategori.deskripsi as kategori', 'table_pinjam.tgl_pinjam', 'table_pinjam.tgl_kembali')
                                              ->where('table_pinjam.id', '=', $id)
                                              ->first();

        return view('pinjam.kembali', compact('pinjaman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Pinjam::where('id', $id)->update(['tgl_kembali' => $request -> tgl_kembali]);
        return redirect('pinjam')->with('msg', 'Buku Telah DIkembalikan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
