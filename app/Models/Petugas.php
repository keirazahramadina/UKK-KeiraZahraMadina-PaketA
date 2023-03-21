<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $fillable = [
            'id_petugas',
            'nama_petugas',
            'username',
            'password',
            'telp',
            'level'
    ];
    use HasFactory;
}
