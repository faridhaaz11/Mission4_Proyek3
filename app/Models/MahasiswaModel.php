<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    protected $allowedFields = ['nim', 'nama_lengkap', 'jenis_kelamin', 'tanggal_lahir', 'umur'];
    public $timestamps = false;
}