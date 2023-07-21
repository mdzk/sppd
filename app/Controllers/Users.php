<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{

    public function index()
    {

        $user       = new UsersModel();
        $data = [
            'user'  => $user->find(session()->get('id_users')),
            'users'  => $user->findAll(),
        ];
        return view('admin/users', $data);
    }

    public function add()
    {
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
                'rules' => "required|is_unique[users.email]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'Email sudah digunakan, cari yang lain!'
                ]
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $user = new UsersModel();
            $user->save([
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'role' => $this->request->getVar('role'),
                'foto' => 'default.jpg',
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('pesan', 'Akun berhasil ditambahkan');
            return redirect()->to('users');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('users');
        }
    }

    public function delete()
    {
        $user = new UsersModel();
        $data = $user->find($this->request->getVar('id_users'));
        if ($data['foto'] !== 'default.jpg') {
            unlink('foto/' . $data['foto']);
        }
        $user->delete($this->request->getVar('id_users'));
        session()->setFlashdata('pesan', 'Akun berhasil dihapus');
        return redirect()->to('users');
    }

    public function update()
    {
        $user = new UsersModel();
        if ($this->validate([
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $data = [
                'role' => $this->request->getVar('role'),
            ];

            $user->set($data);
            $user->where('id_users', $this->request->getVar('id_users'));
            $user->update();

            session()->setFlashdata('pesan', 'Akun berhasil diedit');
            return redirect()->to('users');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('users');
        }
    }
}
