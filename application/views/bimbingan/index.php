<style>
/* Style untuk pagination */
.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination {
    display: inline-flex;
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.pagination li {
    margin: 0 5px;
}

.pagination a, .pagination span {
    display: inline-block;
    width: 36px;
    height: 36px;
    line-height: 36px;
    text-align: center;
    border-radius: 50%;
    background-color: #f0f0f0;
    color: #007bff;
    text-decoration: none;
    font-size: 16px;
    transition: background-color 0.3s, color 0.3s;
}

.pagination a:hover, .pagination span:hover {
    background-color: #e9ecef;
    color: #0056b3;
}

.pagination .active a {
    background-color: #007bff;
    color: white;
    cursor: default;
}

.pagination .disabled a {
    background-color: #ddd;
    color: #aaa;
    cursor: not-allowed;
}

/* Style untuk form filter */
.form-inline .form-group {
    margin-bottom: 0;
}

.form-inline .form-control {
    width: auto;
    display: inline-block;
}

.form-inline .btn {
    margin-left: 10px;
}
</style>

<div class="container mt-5">
    <div class="page-inner">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title">Daftar Bimbingan Mahasiswa Prodi D-3 Teknik Komputer</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <?php if ($this->session->userdata('level') === '1'): ?>
                            <form method="get" action="<?= base_url('Bimbingan/index3') ?>" class="form-inline">
                                <div class="form-group mr-2">
                                    <label for="search_query" class="mr-2">Cari:</label>
                                    <input type="text" id="search_query" name="search_query" class="form-control" 
                                           placeholder="Cari..." value="<?= isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : '' ?>">
                                           <button type="submit" class="btn btn-primary">Cari</button>
                                        </div>
                              
                                
                            </form>
                        <?php endif; ?>
                         <?php if ($this->session->userdata('level') === '2'): ?>
                            <form method="get" action="<?= base_url('Bimbingan/index1') ?>" class="form-inline">
                                <div class="form-group mr-2">
                                    <label for="search_query" class="mr-2">Cari:</label>
                                    <input type="text" id="search_query" name="search_query" class="form-control" 
                                           placeholder="Cari..." value="<?= isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : '' ?>">
                                           <button type="submit" class="btn btn-primary">Cari</button>
                                        </div>
                              
                                
                            </form>
                        <?php endif; ?>
                        <?php if (!empty($bimbingan)): ?>
                        <a href="<?= base_url('Bimbingan/print_bimbingan/' . end($bimbingan)['id']) ?>" target="_blank" class="btn btn-light text-primary">
                            <i class="fas fa-print"></i> Print All
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="table-responsive">
                        <?php if (!empty($bimbingan)): ?>
                        <table id="add-row" class="display table table-bordered table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Semester</th>
                                    <th>IPK</th>
                                    <th>Grafik IPK</th>
                                    <th>KRS</th>
                                    <th>KHS</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($bimbingan as $b): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $b['nim'] ?></td>
                                    <td><?= $b['mahasiswa_name'] ?></td>
                                    <td><?= $b['dosen_name'] ?></td>
                                    <td><?= $b['semester_id'] ?></td>
                                    <td><?= $b['ipk'] ?></td>
                                    <td>
                                        <a href="<?= base_url('Bimbingan/chart_ipk/'.$b['mahasiswa_id']) ?>">
                                            <i class="fas fa-chart-line text-primary"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('uploads/'.$b['krs']) ?>" target="_blank">
                                            <i class="fas fa-file-alt text-success"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('uploads/'.$b['khs']) ?>" target="_blank">
                                            <i class="fas fa-file-alt text-warning"></i>
                                        </a>
                                    </td>
                                    <td><?= $b['created_at'] ?></td>
                                    <td>
                                        <?php if ($b['is_approved'] == 1): ?>
                                            <span class="badge badge-success">ACC</span>
                                        <?php elseif ($b['is_approved'] == 2): ?>
                                            <span class="badge badge-danger">Ditolak</span>
                                        <?php else: ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('Bimbingan/view/' . $b['id']) ?>">
                                            <i class="fas fa-info-circle"></i>
                                        </a> &nbsp;&nbsp;&nbsp;
                                        <?php if ($this->session->userdata('level') === '3'): ?>
                                        <?php if ($b['is_approved'] == 0): ?>
                                        <a href="<?= base_url('Bimbingan/delete/' . $b['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash-alt" style="color: #db3333;"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                            <?php if ($this->session->userdata('level') === '3'): ?>
                        <p>Belum melakukan bimbingan.</p>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('level') === '2'): ?>
                        <p>Tidak ada yang melakukan bimbingan.</p>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('level') === '1'): ?>
                        <p>Tidak ada data.</p>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($bimbingan)): ?>
                        <div class="pagination-container mt-4">
                            <ul class="pagination">
                                <?= $pagination_links ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
