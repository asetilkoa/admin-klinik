<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penyakit extends Model
{
    use HasFactory;
    protected $table = 'penyakit';

    protected $fillable = [
        'nama_penyakit',
    ];


}
