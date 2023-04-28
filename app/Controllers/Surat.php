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
        $data = [
            'surats'  => $surat->where('status', 'diajukan')->orderBy('created_at', 'DESC')->findAll(),
        ];
        return view('admin/surat', $data);
    }

    public function diterima()
    {

        $surat = new SuratModel();
        $data = [
            'surats'  => $surat->where('status', 'diterima')->orderBy('created_at', 'DESC')->findAll(),
        ];
        return view('admin/surat-diterima', $data);
    }

    public function selesai()
    {

        $surat = new SuratModel();
        $data = [
            'surats'  => $surat->where('status', 'selesai')->orderBy('created_at', 'DESC')->findAll(),
        ];
        return view('admin/surat-selesai', $data);
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
        ])) {
            $surat = new SuratModel();
            $surat->save([
                'nama' => $this->request->getVar('nama'),
                'nomor' => $this->request->getVar('nomor'),
                'waktu' => $this->request->getVar('waktu') . ' s.d ' . $this->request->getVar('waktu2'),
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
        ])) {

            $data = [
                'nama' => $this->request->getVar('nama'),
                'nomor' => $this->request->getVar('nomor'),
                'waktu' => $this->request->getVar('waktu') . ' s.d ' . $this->request->getVar('waktu2'),
                'dasar' => $this->request->getVar('dasar'),
                'tanggal_pelaksanaan' => $this->request->getVar('tanggal_pelaksanaan'),
                'tempat' => $this->request->getVar('tempat'),
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
            return redirect()->to('diajukan/add');
        }
    }

    public function delete()
    {
        $surat = new SuratModel();
        $pegawai = new PegawaiModel();
        $data = $surat->find($this->request->getVar('id_surat'));

        $pegawai->where('id_surat_tugas', $data['id_surat_tugas'])->delete();
        $surat->delete($this->request->getVar('id_surat'));
        session()->setFlashdata('pesan', 'SPT berhasil dihapus');
        return redirect()->to('diajukan');
    }

    public function show($id)
    {
        $surat = new SuratModel();
        $kwitansi = new KwitansiModel();
        $data = $surat->find($id);
        $id = $data['id_surat_tugas'];

        $pegawai = new PegawaiModel();
        $data = [
            'surat'  => $surat->find($id),
            'pegawai'  => $pegawai->where('id_surat_tugas', $id)->findAll(),
            'kwitansi'  => $kwitansi->where('id_surat_tugas', $id)->findAll(),
        ];
        return view('admin/surat-show', $data);
    }

    public function accept()
    {

        $kwitansi = new KwitansiModel();
        $data_kwitansi = [
            'status_kwitansi' => "diterima",
            'tanggal_verifikasi' => date('Y-m-d H:i:s'),
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

        session()->setFlashdata('pesan', 'SPT berhasil diverifikasi');
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
            $user = new SuratModel();

            $file = $this->request->getFile('bukti');
            $nama_file = $file->getRandomName();

            $data = [
                'status' => "selesai",
                'bukti'  => $nama_file,
            ];

            $user->set($data);
            $user->where('id_surat_tugas', $this->request->getVar('id_surat'));
            $user->update();

            $file->move('bukti', $nama_file);

            session()->setFlashdata('pesan', 'Bukti berhasil diupload');
            return redirect()->back();
        } else {
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back();
        }
    }
}
