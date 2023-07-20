<?php

namespace App\Controllers;

use App\Models\KwitansiModel;
use App\Models\SuratModel;
use App\Models\UsersModel;

class Home extends BaseController
{
    public function index()
    {
        $surat = new SuratModel();
        $kwitansi = new KwitansiModel();

        $usersModel = new UsersModel();

        $data = [];
        $userData = [];

        if (get_user('role') == 'admin' || get_user('role') == 'pimpinan') {
            $userData = $usersModel->where('role', 'user')->findAll();
        }

        if (get_user('role') == 'user') {
            $userData = $usersModel->where('id_users', get_user('id_users'))->findAll();
        }

        $data = [
            'terlaksana' => $surat->where('status', 'selesai')->countAllResults(),
            'diajukan'   => $surat->where('status', 'diajukan')->countAllResults(),
            'kwitansi'   => $kwitansi->where('status_kwitansi', 'diajukan')->countAllResults(),
            'surat' => $surat->where('status', 'diajukan')->limit(5)->orderBy('created_at', 'DESC')->findAll(),
            'users' => $userData,
        ];

        return view('admin/home', $data);
    }

    public function terlaksana($id_users)
    {
        $visitor = new SuratModel();
        $bulan = [];

        for ($i = 1; $i <= 12; $i++) {
            $bulan[] = $visitor->join('users', 'users.id_users = surat_tugas.id_users')->where('role', 'user')->where('MONTH(created_at)', $i)->where('YEAR(created_at)', date('Y'))->where('status', 'selesai')->where('surat_tugas.id_users', $id_users)->countAllResults();
        }

        return json_encode($bulan);
    }
}
