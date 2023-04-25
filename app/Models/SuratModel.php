<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table      = 'surat_tugas';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $primaryKey = 'id_surat_tugas';
    protected $allowedFields = ['waktu', 'nama', 'nomor', 'dasar', 'status', 'tanggal_pelaksanaan', 'tanggal_ttd', 'tempat'];
    protected $createdField = 'created_at';
    protected $updatedField  = 'updated_at';
}
