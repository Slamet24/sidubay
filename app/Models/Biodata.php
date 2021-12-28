<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';

    protected $fillable = [
        'user_id',
        'tempat_lahir',
        'tanggal_lahir',
        'instansi',
        'alamat',
        'no_telp',
        'foto',
        'cv',
        'karya_tulis'
    ];
}
