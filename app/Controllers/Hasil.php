<?php

namespace App\Controllers;

use App\Models\HasilModel;
use App\Models\SuratModel;

class Hasil extends BaseController
{
    public function index()
    {

        $hasil = new HasilModel();
        $data = [
            'hasil'  => $hasil->join('surat_tugas', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id')->findAll(),
        ];
        return view('admin/hasil', $data);
    }

    public function add()
    {
        $surat = new SuratModel();
        $data = [
            'surat' => $surat->join('hasil', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id', 'left')
                ->where('hasil.surat_tugas_id IS NULL')
                ->where('status', 'diterima')
                ->findAll()
        ];
        return view('admin/hasil-add', $data);
    }
    public function save()
    {
        $id_spt = $this->request->getVar('surat_tugas_id');
        if ($this->validate([
            'surat_tugas_id' => [
                'label' => 'Nama Kegiatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib dipilih !',
                ]
            ],
            'notulen' => [
                'label' => 'Notulen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'deskripsi' => [
                'label' => 'Hasil Perjalanan Dinas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'notulis' => [
                'label' => 'Notulis',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $hasil = new HasilModel();
            $hasil->save([
                'notulen' => $this->request->getVar('notulen'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'notulis' => $this->request->getVar('notulis'),
                'surat_tugas_id' => $id_spt,
            ]);

            session()->setFlashdata('pesan', 'Laporan Perjalanan berhasil ditambahkan');
            return redirect()->to('hasil');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }
}
