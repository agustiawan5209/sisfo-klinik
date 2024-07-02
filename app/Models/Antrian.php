<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $tables = 'antrians';
    protected $fillable = [
        'user_id',
        'nomor_antrian',
        'tanggal',
        'status',
    ];
}
