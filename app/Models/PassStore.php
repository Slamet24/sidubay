<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassStore extends Model
{
    use HasFactory;

    protected $table = 'pass_store';

    protected $fillable = [
        'user_id',
        'plain'
    ];
}
