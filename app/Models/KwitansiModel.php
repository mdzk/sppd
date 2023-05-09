<?php

namespace App\Models;

use CodeIgniter\Model;

class KwitansiModel extends Model
{
    protected $table      = 'kwitansi';
    protected $primaryKey = 'id_kwitansi';
    protected $allowedFields = ['no_kwitansi', 'nominal', 'id_surat_tugas', 'status_kwitansi', 'tanggal_verifikasi', 'kode_rekening', 'uraian', 'sumber'];
}
