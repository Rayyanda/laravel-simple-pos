<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListProyek extends Model
{
    use HasFactory;

    protected $table = 'list_proyek';

    protected $fillable = [
        'uuid_list',
        'proyek_uuid',
        'deskripsi',
        'customer_uuid',
        'tgl_mulai',
        'tgl_selesai',
        'harga',
        'metode_pembayaran',
        'status'
    ];
}
