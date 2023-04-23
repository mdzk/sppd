<?php

namespace App\Controllers;

use App\Models\SuratModel;

class Surat extends BaseController
{
    public function index()
    {

        $surat = new SuratModel();
        $data = [
            'surats'  => $surat->orderBy('created_at', 'DESC')->findAll(),
        ];
        return view('admin/surat', $data);
    }

    public function edit($id)
    {

        $surat = new SuratModel();
        $data = [
            'surat'  => $surat->find($id),
        ];
        return view('admin/surat-edit', $data);
    }

    public function add()
    {
        return view('admin/surat-add');
    }

    public function save()
    {
        if ($this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'nomor' => [
                'label' => 'nomor',
                'rules' => "required|is_unique[surat_tugas.nomor]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => '{field} sudah digunakan, cari yang lain!'
                ]
            ],
            'dasar' => [
                'label' => 'dasar',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'tanggal_pelaksanaan' => [
                'label' => 'Tanggal Pelaksanaan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'tempat' => [
                'label' => 'tempat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $surat = new SuratModel();
            $surat->save([
                'nama' => $this->request->getVar('nama'),
                'nomor' => $this->request->getVar('nomor'),
                'dasar' => $this->request->getVar('dasar'),
                'tanggal_pelaksanaan' => $this->request->getVar('tanggal_pelaksanaan'),
                'tempat' => $this->request->getVar('tempat'),
                'status' => "diajukan",
            ]);

            session()->setFlashdata('pesan', 'SPT berhasil diajukan');
            return redirect()->to('diajukan');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('diajukan/add');
        }
    }

    public function update()
    {
        $user = new SuratModel();
        $data = $user->find($this->request->getVar('id_surat'));
        $id = $data['id_surat_tugas'];
        if ($this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'nomor' => [
                'label' => 'nomor',
                'rules' => "required|is_unique[surat_tugas.nomor, id_surat_tugas, $id]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => '{field} sudah digunakan, cari yang lain!'
                ]
            ],
            'dasar' => [
                'label' => 'dasar',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'tanggal_pelaksanaan' => [
                'label' => 'Tanggal Pelaksanaan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'tempat' => [
                'label' => 'tempat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {

            $user->replace([
                'id_surat_tugas' => $this->request->getVar('id_surat'),
                'nama' => $this->request->getVar('nama'),
                'nomor' => $this->request->getVar('nomor'),
                'dasar' => $this->request->getVar('dasar'),
                'tanggal_pelaksanaan' => $this->request->getVar('tanggal_pelaksanaan'),
                'tempat' => $this->request->getVar('tempat'),
                'status' => "diajukan",
            ]);

            session()->setFlashdata('pesan', 'SPT berhasil diedit');
            return redirect()->to('diajukan');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('diajukan/add');
        }
    }

    public function delete()
    {
        $surat = new SuratModel();
        $surat->delete($this->request->getVar('id_surat'));
        session()->setFlashdata('pesan', 'SPT berhasil dihapus');
        return redirect()->to('diajukan');
    }
}
