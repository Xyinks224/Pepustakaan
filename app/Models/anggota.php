<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = ['nama_anggota', 'jenis_kelamin', 'alamat', 'email', 'no_telp'];
}
