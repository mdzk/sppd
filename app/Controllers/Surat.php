<?php

namespace App\Controllers;

use App\Models\SuratModel;

class Surat extends BaseController
{
    public function index()
    {

        $surat = new SuratModel();
        return view('admin/surat');
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
        $data = $user->find($this->request->getVar('id_users'));
        $id = $data['id_users'];
        if ($this->validate([
            'name' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => "required|is_unique[users.username, id_users, $id]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'Username sudah digunakan, cari yang lain!'
                ]
            ],
        ])) {

            $user->replace([
                'id_users' => $this->request->getVar('id_users'),
                'name' => $this->request->getVar('name') ? $this->request->getVar('name') : $data['name'],
                'username' => $this->request->getVar('username') ? $this->request->getVar('username') : $data['username'],
                'role' => $data['role'],
                'password' => empty($this->request->getVar('password')) ? $data['password'] : password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('pesan', 'Data berhasil diedit');
            return redirect()->to('setting');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('setting');
        }
    }
}
