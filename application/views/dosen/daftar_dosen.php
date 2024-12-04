<style>
    /* Pagination Style */
.pagination {
    display: flex;
    justify-content: center;
    padding: 1rem 0;
}

.pagination a, .pagination span {
    display: inline-block;
    padding: 0.5rem 1rem;
    margin: 0 0.25rem;
    border-radius: 0.25rem;
    border: 1px solid #ddd;
    color: #007bff;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.pagination a:hover {
    background-color: #f8f9fa;
    color: #0056b3;
}

.pagination .active {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

.pagination .disabled {
    color: #6c757d;
    border-color: #ddd;
    cursor: not-allowed;
}

.pagination .disabled a {
    pointer-events: none;
}

</style>
<div class="container mt-5">
    <div class="page-inner">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title m-0">Daftar Dosen STT Payakumbuh Prodi Teknik Komputer</h4>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('success_message')): ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: '<?php echo $this->session->flashdata('success_message'); ?>',
                                confirmButtonColor: '#3085d6',
                            });
                        </script>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-bordered table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIDN</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>Jabatan</th>
                                    <th>Kepangkatan</th>
                                    <th>Jenjang Pendidikan</th>
                                    <th>Bidang Studi</th>
                                    <th>Perguruan Tinggi</th>
                                    <th>Tahun Lulus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($dosen as $d): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?php echo htmlspecialchars($d['nidn']); ?></td>
                                        <td><?php echo htmlspecialchars($d['nik']); ?></td>
                                        <td><?php echo htmlspecialchars($d['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($d['email']); ?></td>
                                        <td><?php echo htmlspecialchars($d['address']); ?></td>
                                        <td><?php echo htmlspecialchars($d['phone_number']); ?></td>
                                        <td><?php echo htmlspecialchars($d['jabatan']); ?></td>
                                        <td><?php echo htmlspecialchars($d['kepangkatan']); ?></td>
                                        <td><?php echo htmlspecialchars($d['jenjang_pendidikan']); ?></td>
                                        <td><?php echo htmlspecialchars($d['bidang_studi']); ?></td>
                                        <td><?php echo htmlspecialchars($d['perguruan_tinggi']); ?></td>
                                        <td><?php echo htmlspecialchars($d['tahun_lulus']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        <?= $pagination; ?>
                    </div>
                </div>
                <div class="card-footer bg-light text-right">
                <small class="text-muted">© 2024 Tugas Akhir <a href="https://www.tiktok.com/@_ki1mm?_t=8pFpQPRmKJD&_r=1" target="_blank">Muhammad Al Mustaqim</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
