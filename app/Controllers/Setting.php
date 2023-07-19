<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Setting extends BaseController
{
    public function index()
    {
        $user       = new UsersModel();
        $data = [
            'user'  => $user->find(session()->get('id_users')),
        ];
        return view('admin/setting', $data);
    }

    public function update()
    {
        $user = new UsersModel();
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
            'email' => [
                'label' => 'Email',
                'rules' => "required|is_unique[users.email, id_users, $id]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'Email sudah digunakan, cari yang lain!'
                ]
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'max_size[foto,10240]|mime_in[foto,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran {field} max 10 Mb',
                    'mime_in' => 'Format {field} wajib png, jpg, dan jpeg',
                ]
            ],
        ])) {
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                $user->replace([
                    'id_users' => $this->request->getVar('id_users'),
                    'name' => $this->request->getVar('name') ? $this->request->getVar('name') : $data['name'],
                    'email' => $this->request->getVar('email') ? $this->request->getVar('email') : $data['email'],
                    'role' => $data['role'],
                    'password' => empty($this->request->getVar('password')) ? $data['password'] : password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'foto' => $data['foto'],
                ]);
            } else {
                $nama_file = $foto->getRandomName();
                $user->replace([
                    'id_users' => $this->request->getVar('id_users'),
                    'name' => $this->request->getVar('name') ? $this->request->getVar('name') : $data['name'],
                    'email' => $this->request->getVar('email') ? $this->request->getVar('email') : $data['email'],
                    'role' => $data['role'],
                    'password' => empty($this->request->getVar('password')) ? $data['password'] : password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'foto' => $nama_file,
                ]);
                if ($data['foto'] !== 'default.jpg') {
                    unlink('foto/' . $data['foto']);
                }
                $foto->move('foto', $nama_file);
            }

            session()->setFlashdata('pesan', 'Data berhasil diedit');
            return redirect()->to('setting');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('setting');
        }
    }
}
