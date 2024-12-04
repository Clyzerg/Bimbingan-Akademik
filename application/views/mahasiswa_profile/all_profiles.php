<script>
    function printTable() {
        var printWindow = window.open('', '', 'height=600,width=800');

        // Mengambil nama dosen dari baris pertama kolom kedua tabel
        var dosenName = document.querySelector('#printableTable tbody tr td:nth-child(2)').innerText;

        var tableHtml = `
            <table>
                <thead>
                    <tr>
                        <th>NPM</th>
                        <th>Nama Lengkap</th>
                    </tr>
                </thead>
                <tbody>
                    ${Array.from(document.querySelectorAll('#printableTable tbody tr'))
                        .map(row => {
                            const cells = row.querySelectorAll('td');
                            return `
                                <tr>
                                    <td>${cells[2].innerText}</td> <!-- NPM -->
                                    <td>${cells[3].innerText}</td> <!-- Nama Lengkap -->
                                </tr>
                            `;
                        }).join('')}
                </tbody>
            </table>
        `;

        var style = `
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                    font-weight: bold;
                }
                /* Mengatur posisi nama dosen di kanan bawah */
                .dosen-info {
                    text-align: right;
                    margin-top: 20px;
                    font-size: 14px;
                    font-weight: bold;
                }
            </style>
        `;

        // Membuat tampilan cetak dengan nama dosen di kanan bawah tabel
        printWindow.document.write('<html><head><title>Print</title>' + style + '</head><body>');
        printWindow.document.write('<h4>Daftar Mahasiswa Bimbingan</h4>'); // Judul
        printWindow.document.write(tableHtml);
        printWindow.document.write('<div class="dosen-info">Dosen Pembimbing Akademik: ' + dosenName + '</div>'); // Nama dosen di kanan bawah
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }
</script>



    <div class="container mt-5">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title m-0">Daftar Mahasiswa </h4>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <!-- Filter Form -->
                        <button class="btn btn-success" onclick="printTable()">Print</button>
                        <br>
                        <br>
                        <?php if ($this->session->userdata('level') === '1') { ?>
                        <form method="get" action="<?= base_url('MahasiswaProfile/all_profiles'); ?>" class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <select id="dosen_id" name="dosen_id" class="form-control">
                                        <option value="">Pilih Dosen</option>
                                        <?php foreach ($dosen_list as $dosen): ?>
                                        <option value="<?= $dosen['user_id'] ?>" <?= isset($_GET['dosen_id']) && $_GET['dosen_id'] == $dosen['user_id'] ? 'selected' : '' ?>>
                                            <?= $dosen['full_name'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">Cari</button>
                                </div>
                            </div>
                        </form>
                        <?php } ?>

                        <div class="table-responsive">
                            <table id="printableTable" class="display table table-bordered table-hover table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Dosen PA</th>
                                        <th>NPM</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Agama</th>
                                        <th>Nomor Telepon</th>
                                        <th>Angkatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($profile as $profile): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($profile['dosen_name']) ?></td>
                                        <td><?= htmlspecialchars($profile['nim']) ?></td>
                                        <td><?= htmlspecialchars($profile['full_name']) ?></td>
                                        <td><?= htmlspecialchars($profile['email']) ?></td>
                                        <td><?= htmlspecialchars($profile['address']) ?></td>
                                        <td><?= htmlspecialchars($profile['tgl_lahir']) ?></td>
                                        <td><?= htmlspecialchars($profile['jenkel']) ?></td>
                                        <td><?= htmlspecialchars($profile['agama']) ?></td>
                                        <td><?= htmlspecialchars($profile['phone_number']) ?></td>
                                        <td><?= htmlspecialchars($profile['angkatan_tahun']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-right">
                      
                        <small class="text-muted">© 2024 Tugas Akhir <a href="https://www.tiktok.com/@_ki1mm?_t=8pFpQPRmKJD&_r=1" target="_blank">Muhammad Al Mustaqim</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
