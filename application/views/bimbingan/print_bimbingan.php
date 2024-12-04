<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Bimbingan Pembimbing Akademik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #000;
        }
        .container {
            width: 210mm;
            margin: 20mm auto;
            padding: 10mm;
            border: 1px solid #000;
        }
        .header {
            text-align: center;
        }
        .header img {
            width: 150px;
        }
        .header h4 {
            margin: 5px 0;
            font-size: 14px;
        }
        .info {
            margin: 20px 0;
        }
        .info table {
            width: 100%;
            border-collapse: collapse;
        }
        .info td {
            padding: 5px;
            vertical-align: top;
        }
        .info td.label {
            width: 30%;
        }
        .info td.value {
            width: 40%;
            border-bottom: 1px dotted #000;
        }
        .info td.photo {
            width: 30%;
            text-align: center;
        }
        .info img {
            width: 80px; /* Adjust the size as needed */
            height: 80px; /* Adjust the size as needed */
            border: 1px solid #000;
            border-radius: 4px;
        }
        .table-bimbingan {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table-bimbingan th, .table-bimbingan td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
        .table-bimbingan th {
            text-align: center;
            background-color: #f2f2f2;
        }
        .ketentuan {
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body onload="window.print();">
    <div class="container">
        <div class="header" style="display: flex; align-items: center;">
            <img src="<?= base_url('assets/img/sttp.png')?>" width="200" style="margin-right: 20px;">
            <div style="text-align: center; flex-grow: 1;">
                <h4>Program Studi Teknik Komputer</h4>
                <h3>SEKOLAH TINGGI TEKNOLOGI PAYAKUMBUH</h3>
                <p>Jl.Khatib Sulaiman Sawah Padang Telp.(0752) 7010851 Fax (0752) 796063</p>
                <p>PAYAKUMBUH 26227</p>
            </div>
        </div>

        <hr>
        <h3 align="center">KARTU BIMBINGAN PEMBIMBING AKADEMIK (PA)</h3>

        <!-- Tampilkan informasi mahasiswa dan dosen -->
        <div class="info">
            <table>
                <tr>
                    <td class="label">Nama Mahasiswa</td>
                    <td class="value">: <?= $bimbingan['full_name'] ?></td>
                    <td class="photo" rowspan="3">
                        <?php if ($bimbingan['foto_profil']): ?>
                            <img src="<?= base_url('uploads/foto_profil/' . $bimbingan['foto_profil']) ?>" alt="Foto Mahasiswa">
                        <?php else: ?>
                            <img src="<?= base_url('assets/img/default-avatar.png') ?>" alt="Foto Mahasiswa">
                        <?php endif; ?>
                        <br>2x3
                    </td>
                </tr>
                <tr>
                    <td class="label">NPM</td>
                    <td class="value">: <?= $bimbingan['nim'] ?></td>
                </tr>
                <tr>
                    <td class="label">Dosen PA</td>
                    <td class="value">: <?= $comments[0]['dosen_name'] ?></td> <!-- Ambil nama dosen dari komentar pertama -->
                </tr>
            </table>
        </div>

        <!-- Tampilkan tabel bimbingan dan komentar -->
        <table class="table-bimbingan">
            <thead>
                <tr>
                    <th width="20%">Tanggal Konsultasi</th>
                    <th width="20%">Semester</th>
                    <th width="40%">Komentar Pembimbing</th>
                    <th width="20%">Tanda Tangan Pembimbing</th>
                    <th width="20%">Tanda Tangan Prodi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?= date('d F Y', strtotime($comment['created_at'])) ?></td>
                    <td><?= $comment['semester_id']  ?></td>
                    <td><?= $comment['comment'] ?></td>
                    <td></td>
                    <td>
                        <!-- Periksa status ACC untuk setiap entri bimbingan -->
                        <?php if ($bimbingan['acc'] == 1): ?>
                            <span style="font-size: 18px;">✔️</span> 
                            <!-- Centang jika sudah ACC -->
                        <?php else: ?>
                            Belum di Tanda Tangan !
                            
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="ketentuan">
            <p><strong>KETENTUAN:</strong></p>
            <ul>
                <li>Konsultasi dengan Dosen Pembimbing.</li>
                <li>Setiap konsultasi harap membawa Kartu Bimbingan.</li>
                <li>Kartu yang hilang atau tidak dibawa saat konsultasi tidak dilayani.</li>
            </ul>
        </div>
    </div>
</body>
</html>
