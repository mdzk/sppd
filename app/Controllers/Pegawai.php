<?php

namespace App\Controllers;

use App\Models\PegawaiModel;

class Pegawai extends BaseController
{
    public function save()
    {
        $id_spt = $this->request->getVar('id_surat');
        if ($this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $pegawai = new PegawaiModel();
            $pegawai->save([
                'nama' => $this->request->getVar('nama'),
                'jabatan' => $this->request->getVar('jabatan'),
                'nip' => empty($this->request->getVar('nip')) ? NULL : $this->request->getVar('nip'),
                'pangkat' => empty($this->request->getVar('pangkat')) ? NULL : $this->request->getVar('pangkat'),
                'id_surat_tugas' => $id_spt,
            ]);

            session()->setFlashdata('pesan', 'Pegawai berhasil ditambahkan');
            return redirect()->back();
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->route("diajukan/detail/$id_spt");
        }
    }

    public function update()
    {
        $pegawai = new PegawaiModel();
        $id_spt = $this->request->getVar('id_surat_tugas');
        if ($this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {

            $pegawai->replace([
                'id_pegawai' => $this->request->getVar('id_pegawai'),
                'nip' => $this->request->getVar('nip'),
                'pangkat' => $this->request->getVar('pangkat'),
                'jabatan' => $this->request->getVar('jabatan'),
                'id_surat_tugas' => $id_spt,
            ]);

            session()->setFlashdata('pesan', 'Pegawai berhasil diedit');
            return redirect()->to("diajukan/detail/$id_spt");
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to("diajukan/detail/$id_spt");
        }
    }

    public function delete()
    {
        $pegawai = new PegawaiModel();
        $pegawai->delete($this->request->getVar('id_pegawai'));
        session()->setFlashdata('pesan', 'Pegawai berhasil dihapus');
        return redirect()->to('diajukan');
    }
}
