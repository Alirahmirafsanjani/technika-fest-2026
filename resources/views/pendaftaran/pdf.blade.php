<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ID Card Peserta</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 15px;
            color: #333;
        }
        .card {
            border: 2px dashed #2563eb;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .subtitle {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 20px;
        }
        .qr-container {
            margin: 15px 0;
        }
        .details {
            text-align: left;
            margin-top: 15px;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }
        .label {
            font-size: 10px;
            color: #9ca3af;
            margin-bottom: 2px;
            text-transform: uppercase;
        }
        .value {
            font-size: 14px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
        }
        td {
            vertical-align: top;
        }
        .token {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            color: #2563eb;
            letter-spacing: 2px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="title">Identity Card Peserta</div>
        <div class="subtitle">Seminar Nasional Dies Natalis</div>
        
        <div class="qr-container">
            <img src="data:image/svg+xml;base64,{{ $qrCodeImage }}" alt="QR Code">
        </div>

        <div class="details">
            <div class="label">Nama Lengkap</div>
            <div class="value">{{ $peserta->nama_lengkap }}</div>
            
            <table>
                <tr>
                    <td>
                        <div class="label">NIM</div>
                        <div class="value">{{ $peserta->nim }}</div>
                    </td>
                    <td>
                        <div class="label">Instansi</div>
                        <div class="value">{{ $peserta->asal_instansi }}</div>
                    </td>
                </tr>
            </table>

            <div class="token">ID: {{ $peserta->qr_token }}</div>
        </div>
    </div>
</body>
</html>