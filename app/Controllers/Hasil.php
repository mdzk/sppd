<?php

namespace App\Controllers;

use App\Models\HasilModel;
use App\Models\KwitansiModel;
use App\Models\SuratModel;

class Hasil extends BaseController
{
    public function index()
    {

        $hasil = new HasilModel();
        if (get_user('role') == 'user') {
            $data = [
                'hasil'  => $hasil->where('id_users', get_user('id_users'))
                    ->join('surat_tugas', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id')
                    ->findAll(),
            ];
        } else {
            $data = [
                'hasil'  => $hasil->join('surat_tugas', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id')
                    ->findAll(),
            ];
        }
        return view('admin/hasil', $data);
    }

    public function add()
    {
        $surat = new SuratModel();
        $data = [
            'surat' => $surat->join('hasil', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id', 'left')
                ->where('hasil.surat_tugas_id IS NULL')
                ->where('status', 'diterima')
                ->where('id_users', get_user('id_users'))
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

            $surat = new SuratModel();
            if ($surat->where('bukti IS NOT NULL')->where('id_surat_tugas', $id_spt)->find()) {
                $status = 'selesai';
            };

            if ($surat->where('bukti IS NULL')->where('id_surat_tugas', $id_spt)->find()) {
                $status = 'diterima';
            };
            $data = [
                'status' => $status,
            ];

            $surat->set($data);
            $surat->where('id_surat_tugas', $id_spt);
            $surat->update();

            $kwitansi = new KwitansiModel();
            $dataKwitansi = $kwitansi->where('id_surat_tugas', $id_spt)
                ->find();

            $dataKwitansi = [
                'status_kwitansi' => $status,
            ];
            $kwitansi->set($dataKwitansi);
            $kwitansi->where('id_surat_tugas', $id_spt);
            $kwitansi->update();

            session()->setFlashdata('pesan', 'Laporan Perjalanan berhasil ditambahkan');
            return redirect()->to('hasil');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }

    public function delete()
    {
        $hasil = new HasilModel();

        if (get_user('role') == 'user' && !$hasil->join('surat_tugas', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id')->where('id_users', get_user('id_users'))->find($this->request->getVar('id_hasil'))) {
            return redirect()->to('/');
        }

        $hasilData = $hasil->join('surat_tugas', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id')
            ->where('hasil.id_hasil', $this->request->getVar('id_hasil'))
            ->get()
            ->getRow();
        $suratTugasId = $hasilData->surat_tugas_id;

        $surat = new SuratModel();
        $data = [
            'status' => 'diterima',
        ];
        $surat->set($data);
        $surat->where('id_surat_tugas', $suratTugasId);
        $surat->update();

        $kwitansi = new KwitansiModel();
        $dataKwitansi = $kwitansi->where('id_surat_tugas', $suratTugasId)
            ->find();

        $dataKwitansi = [
            'status_kwitansi' => 'diterima',
        ];
        $kwitansi->set($dataKwitansi);
        $kwitansi->where('id_surat_tugas', $suratTugasId);
        $kwitansi->update();

        $hasil->delete($this->request->getVar('id_hasil'));

        session()->setFlashdata('pesan', 'Laporan Perjalanan berhasil dihapus');
        return redirect()->to('hasil');
    }

    public function show($id)
    {
        $hasil = new HasilModel();
        if ($hasil->find($id) == NULL) {
            return redirect()->back();
        }

        if (get_user('role') == 'user' && !$hasil->join('surat_tugas', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id')->where('id_users', get_user('id_users'))->find($id)) {
            return redirect()->to('/');
        }
        $data = [
            'surat'  => $hasil->join('surat_tugas', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id')->find($id),
        ];
        return view('admin/hasil-show', $data);
    }

    public function edit($id)
    {
        $hasil = new HasilModel();
        $surat = new SuratModel();
        if ($hasil->find($id) == NULL) {
            return redirect()->to('hasil');
        }
        if (get_user('role') == 'user' && !$hasil->join('surat_tugas', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id')->where('id_users', get_user('id_users'))->find($id)) {
            return redirect()->to('/');
        }
        $data = [
            'surat' => $surat->findAll(),
            'hasil'  => $hasil->find($id),
        ];
        return view('admin/hasil-edit', $data);
    }

    public function update()
    {
        $hasil = new HasilModel();
        $data = $hasil->find($this->request->getVar('id_hasil'));
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

            $data = [
                'surat_tugas_id' => $this->request->getVar('surat_tugas_id'),
                'notulen' => $this->request->getVar('notulen'),
                'notulis' => $this->request->getVar('notulis'),
                'deskripsi' => $this->request->getVar('deskripsi'),
            ];
            $hasil->set($data);
            $hasil->where('id_hasil', $this->request->getVar('id_hasil'));
            $hasil->update();

            session()->setFlashdata('pesan', 'Laporan Perjalanan berhasil diedit');
            return redirect()->to('hasil');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }
}
