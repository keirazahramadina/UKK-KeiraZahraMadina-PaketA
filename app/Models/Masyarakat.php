<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    protected $table= 'masyarakat';
    protected $fillable = [
        'nik',
        'nama',
        'username',
        'password',
        'telp'
    ];
    use HasFactory; 
}
