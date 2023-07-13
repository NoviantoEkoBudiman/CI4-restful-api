<?php

namespace App\Models;

use CodeIgniter\Model;

class Buku extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'buku_id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['buku_id','buku_judul','buku_deskripsi','created_at','updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
