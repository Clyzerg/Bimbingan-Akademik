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
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-center">
            <div class="container ">
                <div class="row">
                    <div class="col">
                        <nav>
                            <!-- Nav content here if any -->
                        </nav>
                    </div>
                </div>
                <div class="container">
                    <h2><?= $judul ?></h2>
                    <a href="<?= base_url('User/index')?>" class="btn btn-secondary">Tambah User </a>
                    <hr>

                    <!-- Notifikasi untuk pesan sukses -->
                    <?php if ($this->session->flashdata('message')): ?>
                        <div class="alert alert-success"><?= $this->session->flashdata('message') ?></div>
                    <?php endif; ?>

                    <!-- Tabel untuk menampilkan data pengguna -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($user as $user): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['level'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Pagination Links -->
                    <div class="pagination">
                        <?= $pagination; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
