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
            $terlaksanaData = $surat->where('status', 'selesai')->countAllResults();
            $diajukanData = $surat->where('status', 'diajukan')->countAllResults();
            $kwitansiData = $kwitansi->where('status_kwitansi', 'diajukan')->countAllResults();
            $suratData = $surat->where('status', 'diajukan')->limit(5)->orderBy('created_at', 'DESC')->findAll();
        }

        if (get_user('role') == 'user') {
            $userData = $usersModel->where('id_users', get_user('id_users'))->findAll();
            $terlaksanaData = $surat->where('status', 'selesai')->where('id_users', get_user('id_users'))->countAllResults();
            $diajukanData = $surat->where('status', 'diajukan')->where('id_users', get_user('id_users'))->countAllResults();
            $kwitansiData   = $kwitansi->where('status_kwitansi', 'diajukan')->join('surat_tugas', 'surat_tugas.id_surat_tugas = kwitansi.id_surat_tugas')->where('id_users', get_user('id_users'))->countAllResults();
            $suratData = $surat->where('status', 'diajukan')->where('id_users', get_user('id_users'))->limit(5)->orderBy('created_at', 'DESC')->findAll();
        }

        $data = [
            'terlaksana' => $terlaksanaData,
            'diajukan'   => $diajukanData,
            'kwitansi'   => $kwitansiData,
            'surat' => $suratData,
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
