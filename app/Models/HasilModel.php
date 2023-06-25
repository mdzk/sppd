<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilModel extends Model
{
    protected $table      = 'hasil';
    protected $primaryKey = 'id_hasil';
    protected $allowedFields = ['notulis', 'deskripsi', 'notulen', 'surat_tugas_id'];
}
