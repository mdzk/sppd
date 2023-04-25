<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\SuratModel;
use Dompdf\Dompdf;

class PdfController extends BaseController
{
    public function index()
    {
        $surat = new SuratModel();
        $pegawai = new PegawaiModel();
        $data = [
            'surat'  => $surat->find(10),
            'pegawai'  => $pegawai->where('id_surat_tugas', 10)->findAll(),
        ];
        return view('pdf_view', $data);
    }

    public function generate()
    {
        $filename = date('y-m-d-H-i-s') . '-qadr-labs-report';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $surat = new SuratModel();
        $pegawai = new PegawaiModel();
        $data = [
            'surat'  => $surat->find(10),
            'pegawai'  => $pegawai->where('id_surat_tugas', 10)->findAll(),
        ];

        // load HTML content
        $dompdf->loadHtml(view('pdf_view', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}
