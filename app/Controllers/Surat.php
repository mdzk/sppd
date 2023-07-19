<?php

namespace App\Controllers;

use App\Models\KwitansiModel;
use App\Models\PegawaiModel;
use App\Models\SuratModel;

class Surat extends BaseController
{
    public function index()
    {

        $surat = new SuratModel();
        if (get_user('role') == 'user') {
            $data = [
                'surats'  => $surat->where('id_users', get_user('id_users'))
                    ->where('status', 'diajukan')
                    ->orderBy('created_at', 'DESC')
                    ->findAll(),
            ];
        } else {
            $data = [
                'surats'  => $surat->where('status', 'diajukan')
                    ->orderBy('created_at', 'DESC')
                    ->findAll(),
            ];
        }

        return view('admin/surat', $data);
    }

    public function diproses()
    {

        $surat = new SuratModel();
        if (get_user('role') == 'user') {
            $data = [
                'surats'  => $surat->where('status', 'diproses')
                ->where('id_users', get_user('id_users'))
                    ->orderBy('created_at', 'DESC')
                    ->findAll(),
            ];
        } else {
            $data = [
                'surats'  => $surat->where('status', 'diproses')
                ->orderBy('created_at', 'DESC')
                ->findAll(),
            ];
        }
        return view('admin/surat-diproses', $data);
    }

    public function diterima()
    {

        $surat = new SuratModel();
        if (get_user('role') == 'user') {
            $data = [
                'surats'  => $surat->where('status', 'diterima')
                    ->where('id_users', get_user('id_users'))
                    ->orderBy('created_at', 'DESC')
                    ->findAll(),
            ];
        } else {
            $data = [
                'surats'  => $surat->where('status', 'diterima')
                    ->orderBy('created_at', 'DESC')
                    ->findAll(),
            ];
        }
        return view('admin/surat-diterima', $data);
    }

    public function selesai()
    {

        $surat = new SuratModel();
        if (get_user('role') == 'user') {
            $data = [
                'surats'  => $surat->join('hasil', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id', 'left')
                    ->where('hasil.surat_tugas_id IS NOT NULL')
                    ->where('status', 'selesai')
                    ->where('id_users', get_user('id_users'))
                    ->orderBy('created_at', 'DESC')->findAll(),
            ];
        } else {
            $data = [
                'surats'  => $surat->join('hasil', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id', 'left')
                    ->where('hasil.surat_tugas_id IS NOT NULL')
                    ->where('status', 'selesai')
                    ->orderBy('created_at', 'DESC')->findAll(),
            ];
        }
        return view('admin/surat-selesai', $data);
    }

    public function edit($id)
    {

        $surat = new SuratModel();
        if ($surat->find($id) == NULL) {
            return redirect()->to('diajukan');
        }

        if (get_user('role') == 'user' && !$surat->where('id_users', get_user('id_users'))->find($id)) {
            return redirect()->to('/');
        }

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
            'waktu' => [
                'label' => 'waktu',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'dasar' => [
                'label' => 'Dasar Surat',
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
            'nominal' => [
                'label' => 'nominal',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'ttd_jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'ttd_nama' => [
                'label' => 'Nama yang bertanda tangan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'ttd_golongan' => [
                'label' => 'Golongan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'ttd_nip' => [
                'label' => 'nip',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'tipe' => [
                'label' => 'tipe',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {

            $surat = new SuratModel();
            $kwitansi = new KwitansiModel();
            $surat->save([
                'nama' => $this->request->getVar('nama'),
                'nomor' => $this->request->getVar('nomor'),
                'waktu' => $this->request->getVar('waktu') . ' s.d ' . $this->request->getVar('waktu2'),
                'dasar' => $this->request->getVar('dasar'),
                'tanggal_pelaksanaan' => $this->request->getVar('tanggal_pelaksanaan'),
                'tempat' => $this->request->getVar('tempat'),
                'ttd_jabatan' => strtoupper($this->request->getVar('ttd_jabatan')),
                'ttd_nama' => $this->request->getVar('ttd_nama'),
                'ttd_nip' => $this->request->getVar('ttd_nip'),
                'ttd_golongan' => $this->request->getVar('ttd_golongan'),
                'tipe' => $this->request->getVar('tipe'),
                'id_users' => get_user('id_users'),
                'status' => "diajukan",
            ]);

            $kwitansi->save([
                'nominal' => $this->request->getVar('nominal'),
                'kode_rekening' => $this->request->getVar('kode_rekening'),
                'uraian' => $this->request->getVar('uraian'),
                'sumber' => $this->request->getVar('sumber'),
                'id_surat_tugas' => $surat->getInsertID(),
                'status_kwitansi' => "diajukan",
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
            'waktu' => [
                'label' => 'waktu',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'dasar' => [
                'label' => 'Dasar Surat',
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
            'ttd_jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'ttd_nama' => [
                'label' => 'Nama yang bertanda tangan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'ttd_golongan' => [
                'label' => 'Golongan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'ttd_nip' => [
                'label' => 'nip',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'tipe' => [
                'label' => 'tipe',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {

            $data = [
                'nama' => $this->request->getVar('nama'),
                'nomor' => $this->request->getVar('nomor'),
                'waktu' => $this->request->getVar('waktu') . ' s.d ' . $this->request->getVar('waktu2'),
                'dasar' => $this->request->getVar('dasar'),
                'tanggal_pelaksanaan' => $this->request->getVar('tanggal_pelaksanaan'),
                'tempat' => $this->request->getVar('tempat'),
                'ttd_jabatan' => strtoupper($this->request->getVar('ttd_jabatan')),
                'ttd_nama' => $this->request->getVar('ttd_nama'),
                'ttd_nip' => $this->request->getVar('ttd_nip'),
                'ttd_golongan' => $this->request->getVar('ttd_golongan'),
                'tipe' => $this->request->getVar('tipe'),
                'status' => "diajukan",
            ];
            $user->set($data);
            $user->where('id_surat_tugas', $this->request->getVar('id_surat'));
            $user->update();

            session()->setFlashdata('pesan', 'SPT berhasil diedit');
            return redirect()->to('diajukan');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }

    public function delete()
    {
        $surat = new SuratModel();
        $pegawai = new PegawaiModel();
        $data = $surat->find($this->request->getVar('id_surat'));

        if (get_user('role') == 'user' && !$surat->where('id_users', get_user('id_users'))->find($id)) {
            return redirect()->to('/');
        }

        $pegawai->where('id_surat_tugas', $data['id_surat_tugas'])->delete();
        $surat->delete($this->request->getVar('id_surat'));
        session()->setFlashdata('pesan', 'SPT berhasil dihapus');
        return redirect()->to('diajukan');
    }

    public function show($id)
    {
        $surat = new SuratModel();
        $kwitansi = new KwitansiModel();
        $pegawai = new PegawaiModel();

        $data = $surat->find($id);
        if ($data == NULL) {
            return redirect()->back();
        }

        if (get_user('role') == 'user' && !$surat->where('id_users', get_user('id_users'))->find($id)) {
            return redirect()->to('/');
        }

        $id = $data['id_surat_tugas'];
        $data = [
            'surat'  => $surat->find($id),
            'pegawai'  => $pegawai->where('id_surat_tugas', $id)->findAll(),
            'jumlah_pegawai'  => $pegawai->where('id_surat_tugas', $id)->countAllResults(),
            'kwitansi'  => $kwitansi->where('id_surat_tugas', $id)->findAll(),
        ];
        return view('admin/surat-show', $data);
    }

    public function process()
    {
        $surat = new SuratModel();
        $data = $surat->find($this->request->getVar('id_surat'));

        $data = [
            'status' => "diproses",
            // 'tanggal_ttd' => date('Y-m-d H:i:s'),
        ];
        $surat->set($data);
        $surat->where('id_surat_tugas', $this->request->getVar('id_surat'));
        $surat->update();

        session()->setFlashdata('pesan', 'SPT berhasil diproses');
        return redirect()->back();
    }

    public function accept()
    {

        $kwitansi = new KwitansiModel();
        $data_kwitansi = [
            'status_kwitansi' => "diterima",
        ];
        $kwitansi->set($data_kwitansi);
        $kwitansi->where('id_kwitansi', $this->request->getVar('id_kwitansi'));
        $kwitansi->update();

        $surat = new SuratModel();
        $data = $surat->find($this->request->getVar('id_surat'));

        $data = [
            'status' => "diterima",
            'tanggal_ttd' => date('Y-m-d H:i:s'),
        ];
        $surat->set($data);
        $surat->where('id_surat_tugas', $this->request->getVar('id_surat'));
        $surat->update();

        session()->setFlashdata('pesan', 'SPT berhasil diterima');
        return redirect()->back();
    }

    public function finish()
    {

        if ($this->validate([
            'bukti' => [
                'label' => 'bukti',
                'rules' => 'uploaded[bukti]|max_size[bukti,1024]|mime_in[bukti,image/png,image/jpg,image/jpeg,image/svg]',
                'errors' => [
                    'uploaded' => '{field} Wajib diisi!',
                    'max_size' => 'Ukuran {field} max 1024 Kb',
                    'mime_in' => 'Format {field} wajib png, jpg, jpeg, dan svg',
                ]
            ],
        ])) {
            $surat = new SuratModel();

            $file = $this->request->getFile('bukti');
            $nama_file = $file->getRandomName();

            if ($surat->join('hasil', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id', 'left')
                ->where('hasil.surat_tugas_id', $this->request->getVar('id_surat'))
                ->find()
            ) {
                $status = 'selesai';
            };

            if ($surat->join('hasil', 'surat_tugas.id_surat_tugas = hasil.surat_tugas_id', 'left')
                ->where('hasil.surat_tugas_id IS NULL')
                ->find()
            ) {
                $status = 'diterima';
            };
            $data = [
                'status' => $status,
                'bukti'  => $nama_file,
            ];

            $surat->set($data);
            $surat->where('id_surat_tugas', $this->request->getVar('id_surat'));
            $surat->update();

            $file->move('bukti', $nama_file);

            session()->setFlashdata('pesan', 'Bukti berhasil diupload');
            return redirect()->back();
        } else {
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }
}
