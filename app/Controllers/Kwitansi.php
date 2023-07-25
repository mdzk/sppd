<?php

namespace App\Controllers;

use App\Models\KwitansiModel;
use App\Models\SuratModel;

class Kwitansi extends BaseController
{
    public function index()
    {

        $kwitansi = new KwitansiModel();
        $data = [
            'kwitansi'  => $kwitansi->where('id_users', get_user('id_users'))
                ->join('surat_tugas', 'surat_tugas.id_surat_tugas = kwitansi.id_surat_tugas')
                ->findAll(),
        ];

        if (get_user('role') == 'user') {
            $data = [
                'kwitansi'  => $kwitansi->where('id_users', get_user('id_users'))
                ->join('surat_tugas', 'surat_tugas.id_surat_tugas = kwitansi.id_surat_tugas')
                ->findAll(),
            ];
        } else {
            $data = [
                'kwitansi'  => $kwitansi->join('surat_tugas', 'surat_tugas.id_surat_tugas = kwitansi.id_surat_tugas')
                ->findAll(),
            ];
        }
        return view('admin/kwitansi', $data);
    }

    public function save()
    {
        if ($this->validate([
            'nominal' => [
                'label' => 'Nominal',
                'rules' => "required",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'id_surat_tugas' => [
                'label' => 'SPT',
                'rules' => "required|is_unique[kwitansi.id_surat_tugas]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'SPT sudah diajukan kwitansi, silakan tunggu diterima oleh admin'
                ]
            ],
        ])) {
            $kwitansi = new KwitansiModel();
            $kwitansi->save([
                'nominal' => $this->request->getVar('nominal'),
                'id_surat_tugas' => $this->request->getVar('id_surat_tugas'),
                'status_kwitansi' => "diajukan",
            ]);

            session()->setFlashdata('pesan', 'Kwitansi berhasil diajukan');
            return redirect()->back();
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }

    public function update()
    {
        $kwitansi = new KwitansiModel();
        $data = $kwitansi->find($this->request->getVar('id_kwitansi'));
        $id = $data['id_kwitansi'];
        if ($this->validate([

            'nominal' => [
                'label' => 'Nominal',
                'rules' => "required",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],

            'sumber' => [
                'label' => 'Diterima dari',
                'rules' => "required",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],

            'uraian' => [
                'label' => 'uraian',
                'rules' => "required",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],

            'kode_rekening' => [
                'label' => 'Kode Rekening',
                'rules' => "required",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {

            $data = [
                'nominal' => $this->request->getVar('nominal'),
                'uraian' => $this->request->getVar('uraian'),
                'kode_rekening' => $this->request->getVar('kode_rekening'),
                'sumber' => $this->request->getVar('sumber'),
                'status_kwitansi' => "diajukan",
            ];
            $kwitansi->set($data);
            $kwitansi->where('id_kwitansi', $this->request->getVar('id_kwitansi'));
            $kwitansi->update();

            $surat = new SuratModel();
            $dataSurat = $surat->find($this->request->getVar('id_surat'));

            $dataSurat = [
                    'status' => "diajukan",
                ];
            $surat->set($dataSurat);
            $surat->where('id_surat_tugas', $this->request->getVar('id_surat'));
            $surat->update();

            session()->setFlashdata('pesan', 'Kwitansi berhasil diedit');
            return redirect()->back();
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }

    public function accept()
    {
        $kwitansi = new KwitansiModel();
        $data = [
            'status_kwitansi' => "diterima",
        ];
        $kwitansi->set($data);
        $kwitansi->where('id_kwitansi', $this->request->getVar('id_kwitansi'));
        $kwitansi->update();

        session()->setFlashdata('pesan', 'Kwitansi berhasil diterima');
        return redirect()->back();
    }
}
