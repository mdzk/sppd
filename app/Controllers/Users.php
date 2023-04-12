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
        $user = new UsersModel();
        $user->save([
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'role' => $this->request->getVar('role'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ]);

        session()->setFlashdata('pesan', 'Akun berhasil ditambahkan');
        return redirect()->to('users');
    }

    public function delete()
    {
        $user = new UsersModel();
        $user->delete($this->request->getVar('id_users'));
        session()->setFlashdata('pesan', 'Akun berhasil dihapus');
        return redirect()->to('users');
    }

    public function update()
    {
        $user = new UsersModel();
        $data = $user->find($this->request->getVar('id_users'));
        $user->replace([
            'id_users' => $this->request->getVar('id_users'),
            'name' => $this->request->getVar('name'),
            'role' => $this->request->getVar('role'),
            'username' => $this->request->getVar('username'),
            'password' => empty($this->request->getVar('password')) ? $data['password'] : password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ]);

        session()->setFlashdata('pesan', 'Akun berhasil diedit');
        return redirect()->to('users');
    }
}
