<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta name=Generator content="Microsoft Word 15 (filtered)">
    <style>
        @font-face {
            font-family: "Cambria Math";
            panose-1: 2 4 5 3 5 4 6 3 2 4;
        }

        @font-face {
            font-family: Calibri;
            panose-1: 2 15 5 2 2 2 4 3 2 4;
        }

        /* Style Definitions */
        p.MsoNormal,
        li.MsoNormal,
        div.MsoNormal {
            margin-top: 0in;
            margin-right: 0in;
            margin-bottom: 8.0pt;
            margin-left: 0in;
            line-height: 107%;
            font-size: 11.0pt;
            font-family: "Calibri", sans-serif;
        }

        p.MsoHeader,
        li.MsoHeader,
        div.MsoHeader {
            mso-style-link: "Header Char";
            margin: 0in;
            font-size: 11.0pt;
            font-family: "Calibri", sans-serif;
        }

        span.HeaderChar {
            mso-style-name: "Header Char";
            mso-style-link: Header;
        }

        .MsoChpDefault {
            font-family: "Calibri", sans-serif;
        }

        .MsoPapDefault {
            margin-bottom: 8.0pt;
            line-height: 107%;
        }

        /* Page Definitions */
        @page WordSection1 {
            size: 595.3pt 841.9pt;
            margin: 0in 0in 0in 0in;
        }

        div.WordSection1 {
            page: WordSection1;
        }
    </style>
</head>

<body lang=EN-US style='word-wrap:break-word'>
    <div class=WordSection1>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;line-height:normal;'>
            <span lang=IN style='font-size:100.0pt;font-family:"Times New Roman",serif;'>&nbsp;</span>
        </p>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;line-height:normal; text-decoration:underline'>
            <b>
                <span lang=IN style='font-size:16.0pt;font-family:"Times New Roman",serif;'>SURAT PERINTAH</span>
            </b>
        </p>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;line-height:normal'>
            <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>Nomor: <?= $surat['nomor']; ?></span>
        </p>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;line-height:normal'>
            <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>&nbsp;</span>
        </p>
        <table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
            <tr>
                <td width=162 valign=top style='width:60pt;padding:0in 5.4pt 0in 5.4pt'>
                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>Dasar</span>
                    </p>
                </td>
                <td width=18 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>:</span>
                    </p>
                </td>
                <td valign=top style='padding:0in 5.4pt 0in 5.4pt'>
                    <p class=MsoNormal style='text-align: justify;margin-bottom:0in;line-height:normal'>
                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'><?= $surat['dasar']; ?></span>
                    </p>
                </td>
            </tr>
        </table>
        <p class=MsoNormal align=center style='margin-bottom:10pt;text-align:center;
line-height:normal'>
            <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>&nbsp;</span>
        </p>
        <p class=MsoNormal align=center style='margin-bottom:10pt;text-align:center;
line-height:normal'>
            <b>
                <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>MEMERINTAHKAN :</span>
            </b>
        </p>
        <table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
            <tr>
                <td width=162 valign=top style='width:60pt;padding:0in 5.4pt 0in 5.4pt'>
                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>Kepada</span>
                    </p>
                </td>
                <td width=18 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>:</span>
                    </p>
                </td>
                <td valign=top style='padding:0in 5.4pt 0in 5.4pt'>
                    <table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
                        <?php $i = 1;
                        foreach ($pegawai as $data) : ?>
                            <tr>
                                <td width=27 valign=top style='width:10.6pt;padding:0in 5.4pt 10pt 5.4pt'>
                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'><?= $i++; ?>.</span>
                                    </p>
                                </td>
                                <td width=86 valign=top style='width:74.35pt;padding:0in 5.4pt 10pt 5.4pt'>
                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>Nama</span>
                                    </p>
                                    <?php if ($data['nip'] !== NULL) : ?>
                                        <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                            <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>NIP</span>
                                        </p>
                                    <?php endif; ?>
                                    <?php if ($data['pangkat'] !== NULL) : ?>
                                        <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                            <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>Pangkat / Gol</span>
                                        </p>
                                    <?php endif; ?>
                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>Jabatan</span>
                                    </p>
                                </td>
                                <td valign=top style='padding:0in 5.4pt 10pt 5.4pt'>
                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>:</span>
                                    </p>
                                    <?php if ($data['nip'] !== NULL) : ?>
                                        <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                            <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>:</span>
                                        </p>
                                    <?php endif; ?>
                                    <?php if ($data['pangkat'] !== NULL) : ?>
                                        <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                            <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>:</span>
                                        </p>
                                    <?php endif; ?>
                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>:</span>
                                    </p>
                                </td>
                                <td valign=top style='padding:0in 5.4pt 10pt 5.4pt'>
                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'><?= $data['nama']; ?></span>
                                    </p>
                                    <?php if ($data['nip'] !== NULL) : ?>
                                        <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                            <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'><?= $data['nip']; ?></span>
                                        </p>
                                    <?php endif; ?>
                                    <?php if ($data['pangkat'] !== NULL) : ?>
                                        <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                            <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'><?= $data['pangkat']; ?></span>
                                        </p>
                                    <?php endif; ?>
                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'><?= $data['jabatan']; ?></span>
                                    </p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>&nbsp;</span>
                    </p>
                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>&nbsp;</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td width=162 valign=top style='width:60pt;padding:0in 5.4pt 0in 5.4pt'>
                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>Untuk</span>
                    </p>
                </td>
                <td width=18 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                        <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>:</span>
                    </p>
                </td>
                <td valign=top style='padding:0in 5.4pt 0in 5.4pt'>
                    <table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
                        <tr>
                            <td valign=top style='padding:0in 5.4pt 10pt 5.4pt'>
                                <p class=MsoNormal style='text-align: justify;margin-bottom:0in;line-height:normal'>
                                    <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>Menghadiri acara <?= $surat['nama']; ?>, yang dilaksanakan pada :</span>
                                </p>
                                <table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
                                    <tr>
                                        <td width=100 valign=top>
                                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>Hari/Tanggal</span>
                                            </p>
                                        </td>
                                        <td width=18 valign=top style='width:1pt;padding:0in 1pt 0in 1pt'>
                                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>:</span>
                                            </p>
                                        </td>
                                        <td valign=top style='padding:0in 5.4pt 0in 5.4pt'>
                                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'><?= tanggal($surat['tanggal_pelaksanaan']); ?></span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width=100 valign=top>
                                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>Tempat</span>
                                            </p>
                                        </td>
                                        <td width=18 valign=top style='width:1pt;padding:0in 1pt 0in 1pt'>
                                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>:</span>
                                            </p>
                                        </td>
                                        <td valign=top style='padding:0in 5.4pt 0in 5.4pt'>
                                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'><?= $surat['tempat']; ?></span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width=100 valign=top>
                                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>Waktu</span>
                                            </p>
                                        </td>
                                        <td width=18 valign=top style='width:1pt;padding:0in 1pt 0in 1pt'>
                                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>:</span>
                                            </p>
                                        </td>
                                        <td valign=top style='padding:0in 5.4pt 0in 5.4pt'>
                                            <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>Pukul <?= $surat['waktu']; ?></span>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign=top style='padding:0in 5.4pt 10pt 5.4pt'>
                                <p class=MsoNormal style='text-align: justify;margin-bottom:0in;line-height:normal'>
                                    <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Segala biaya yang timbul dalam pelaksanaan tugas dibebankan pada Dokumen Pelaksanaan Anggaran Satuan Kerja Perangkat Daerah (DPA-SKPD) Bappelitbang Kabupaten Tanggamus Tahun Anggaran <?= date('Y') ?>.</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td valign=top style='padding:0in 5.4pt 10pt 5.4pt'>
                                <p class=MsoNormal style='text-align: justify;margin-bottom:0in;line-height:normal'>
                                    <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian Surat Perintah Tugas ini dikeluarkan untuk dilaksanakan dengan penuh tanggungjawab dan melaporkan hasilnya</span>
                                </p>
                            </td>
                        </tr>

                    </table>
                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'></p>
                </td>
            </tr>
        </table>
        <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
            <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>&nbsp;</span>
        </p>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
line-height:normal'>
            <b>
                <span lang=IN style='font-size:12.0pt;font-family:"Times New Roman",serif'>&nbsp;</span>
            </b>
        </p>
    </div>
    <div style="">
        <div style="width: fit-content; float: right;">
            <div class="tanggal">
                <table border="0" width="100%" style="border-bottom:1px solid #000;">
                    <tr>
                        <td>Ditetapkan di</td>
                        <td>: Kota Agung</td>
                    </tr>
                    <tr>
                        <td>Pada Tanggal</td>
                        <td>: <?= tanggal($surat['tanggal_ttd']); ?></td>
                    </tr>
                </table>
            </div>
            <div style="text-align: center; font-weight: bold;">
                <p style="width: 220pt;margin-bottom: 60pt;">a.n <?= $surat['ttd_jabatan']; ?></p>
                <p><span style="text-decoration: underline;"><?= $surat['ttd_nama']; ?></span></p>
            </div>
        </div>
    </div>
</body>

</html>