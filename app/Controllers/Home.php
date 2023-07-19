<?php

namespace App\Controllers;

use App\Models\KwitansiModel;
use App\Models\SuratModel;
use App\Models\UsersModel;

class Home extends BaseController
{
    public function index()
    {
        $surat       = new SuratModel();
        $kwitansi       = new KwitansiModel();
        if (
            get_user('role') == 'admin' ||
            get_user('role') == 'pimpinan'
        ) {
            $data = [
                'terlaksana' => $surat->where('status', 'selesai')->countAllResults(),
                'diajukan'   => $surat->where('status', 'diajukan')->countAllResults(),
                'kwitansi'   => $kwitansi->where('status_kwitansi', 'diajukan')->countAllResults(),
                'surat'      => $surat->where('status', 'diajukan')->limit(5)->orderBy('created_at', 'DESC')->findAll(),
            ];
        }

        if (get_user('role') == 'user') {
            $data = [
                'terlaksana' => $surat->where('status', 'selesai')->where('id_users', get_user('id_users'))->countAllResults(),
                'diajukan'   => $surat->where('status', 'diajukan')->where('id_users', get_user('id_users'))->countAllResults(),
                'kwitansi'   => $kwitansi->where('status_kwitansi', 'diajukan')->join('surat_tugas', 'surat_tugas.id_surat_tugas = kwitansi.id_surat_tugas')->where('id_users', get_user('id_users'))->countAllResults(),
                'surat'      => $surat->where('status', 'diajukan')->where('id_users', get_user('id_users'))->limit(5)->orderBy('created_at', 'DESC')->findAll(),
            ];
        }
        return view('admin/home', $data);
    }

    public function terlaksana()
    {
        function bulan($a)
        {
            $visitor = new SuratModel();
            if (
                get_user('role') == 'admin' ||
                get_user('role') == 'pimpinan'
            ) {
                $bulan = $visitor->where('MONTH(created_at)', $a)->where('YEAR(created_at)', date('Y'))->where('status', 'selesai')->countAllResults();
            }

            if (get_user('role') == 'user') {
                $bulan = $visitor->where('MONTH(created_at)', $a)->where('YEAR(created_at)', date('Y'))->where('status', 'selesai')->where('id_users', get_user('id_users'))->countAllResults();
            }
            return $bulan;
        };
        $month = array(bulan(1), bulan(2), bulan(3), bulan(4), bulan(5), bulan(6), bulan(7), bulan(8), bulan(9), bulan(10), bulan(11), bulan(12));
        return print_r(json_encode(array_values($month)));
    }
}
