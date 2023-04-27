<?php

namespace App\Controllers;

use App\Models\KwitansiModel;

class Kwitansi extends BaseController
{
    public function index()
    {

        $kwitansi = new KwitansiModel();
        $data = [
            'kwitansi'  => $kwitansi->join('surat_tugas', 'surat_tugas.id_surat_tugas = kwitansi.id_surat_tugas')->findAll(),
        ];
        return view('admin/kwitansi', $data);
    }

    public function save()
    {
        if ($this->validate([
            'no_kwitansi' => [
                'label' => 'Nomor Kwitansi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
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
                'no_kwitansi' => $this->request->getVar('no_kwitansi'),
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
            'no_kwitansi' => [
                'label' => 'Nomor Kwitansi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'nominal' => [
                'label' => 'Nominal',
                'rules' => "required",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {

            $data = [
                'nominal' => $this->request->getVar('nominal'),
                'no_kwitansi' => $this->request->getVar('no_kwitansi'),
                'status_kwitansi' => "diajukan",
            ];
            $kwitansi->set($data);
            $kwitansi->where('id_kwitansi', $this->request->getVar('id_kwitansi'));
            $kwitansi->update();

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
            'tanggal_verifikasi' => date('Y-m-d H:i:s'),
        ];
        $kwitansi->set($data);
        $kwitansi->where('id_kwitansi', $this->request->getVar('id_kwitansi'));
        $kwitansi->update();

        session()->setFlashdata('pesan', 'Kwitansi berhasil diterima');
        return redirect()->back();
    }
}
