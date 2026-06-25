<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Sertifikat - {{ $peserta->nama_lengkap }}</title>
    <style>
        /* Pengaturan Kertas A4 Landscape untuk DomPDF */
        @page {
            size: A4 landscape;
            margin: 0;
        }
        body {
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
            color: #1e293b;
        }
        /* Bingkai Sertifikat */
        .certificate-container {
            width: 100%;
            height: 100%;
            padding: 40px;
            box-sizing: border-box;
        }
        .certificate-border {
            border: 10px solid #1e3a8a; /* Biru Gelap */
            padding: 10px;
            height: 90%;
            background-color: #ffffff;
            position: relative;
        }
        .certificate-inner-border {
            border: 2px solid #cbd5e1;
            height: 100%;
            text-align: center;
            padding-top: 50px;
            box-sizing: border-box;
        }
        /* Tipografi */
        .header {
            font-size: 48px;
            font-weight: bold;
            color: #1e3a8a;
            letter-spacing: 5px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .subheader {
            font-size: 20px;
            color: #64748b;
            letter-spacing: 2px;
            margin-bottom: 40px;
        }
        .presentation-text {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            color: #475569;
            margin-bottom: 20px;
        }
        .nama-peserta {
            font-size: 42px;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            border-bottom: 2px solid #cbd5e1;
            display: inline-block;
            padding-bottom: 5px;
            margin-bottom: 10px;
            min-width: 500px;
        }
        .nim-instansi {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            color: #64748b;
            margin-bottom: 40px;
        }
        .description {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #334155;
            padding: 0 100px;
        }
        /* Tanda Tangan */
        .signatures {
            margin-top: 70px;
            width: 100%;
            table-layout: fixed;
        }
        .signature-block {
            width: 50%;
            text-align: center;
            display: inline-block;
        }
        .signature-line {
            width: 200px;
            border-bottom: 1px solid #1e293b;
            margin: 50px auto 10px auto;
        }
        .signature-name {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            font-size: 14px;
        }
        .signature-title {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #64748b;
        }
        /* Ornamen Bawah */
        .footer-note {
            font-family: 'Arial', sans-serif;
            position: absolute;
            bottom: 30px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

    <div class="certificate-container">
        <div class="certificate-border">
            <div class="certificate-inner-border">
                
                <div class="header">Sertifikat Penghargaan</div>
                <div class="subheader">DIES NATALIS HIMSI</div>

                <div class="presentation-text">Dengan bangga diberikan kepada:</div>

                <div class="nama-peserta">{{ $peserta->nama_lengkap }}</div>
                <div class="nim-instansi">{{ $peserta->nim }} | {{ $peserta->asal_instansi }}</div>

                <div class="description">
                    Atas partisipasi aktifnya sebagai <strong>PESERTA</strong> dalam rangkaian acara Seminar Nasional 
                    dengan tema "Inovasi UI/UX & Pameran Poster Digital" yang diselenggarakan oleh 
                    Himpunan Mahasiswa Sistem Informasi.
                </div>

                <table class="signatures">
                    <tr>
                        <td class="signature-block">
                            <div class="signature-line"></div>
                            <div class="signature-name">Ketua Panitia</div>
                            <div class="signature-title">Dies Natalis HIMSI</div>
                        </td>
                        <td class="signature-block">
                            <div class="signature-line"></div>
                            <div class="signature-name">Ketua Program Studi</div>
                            <div class="signature-title">Sistem Informasi</div>
                        </td>
                    </tr>
                </table>

                <div class="footer-note">
                    Dokumen ini digenerate secara otomatis oleh Sistem Registrasi Terpadu HIMSI.
                </div>

            </div>
        </div>
    </div>

</body>
</html>