<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table      = 'surat_tugas';
    protected $primaryKey = 'id_surat_tugas';
    protected $allowedFields = ['nama', 'nomor', 'dasar', 'id_pegawai', 'status', 'tanggal_pelaksanaan', 'tanggal_tdd', 'tempat'];
}
