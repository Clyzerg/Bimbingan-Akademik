<div class="container">
    <div class="page-inner">
        <h2>Pengelolaan Sesi Bimbingan</h2>
        <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('message'); ?></div>
        <?php endif; ?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>  
                    <th>Semester</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>  
                    <td>Semester Ganjil</td>
                    <td>
                        <?= $ganjil_open ? '<span class="badge badge-success">Dibuka</span>' : '<span class="badge badge-danger">Ditutup</span>'; ?>
                    </td>
                    <td>
                        <?php if ($ganjil_open): ?>
                            <a href="<?= base_url('BimbinganSession/toggle_session/ganjil'); ?>" class="btn btn-warning btn-sm" onclick="return confirm('Apakah Anda yakin ingin menutup sesi bimbingan untuk semester ganjil?');">Tutup Sesi</a>
                        <?php else: ?>
                            <a href="<?= base_url('BimbinganSession/toggle_session/ganjil'); ?>" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin membuka sesi bimbingan untuk semester ganjil?');">Buka Sesi</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>  
                    <td>Semester Genap</td>
                    <td>
                        <?= $genap_open ? '<span class="badge badge-success">Dibuka</span>' : '<span class="badge badge-danger">Ditutup</span>'; ?>
                    </td>
                    <td>
                        <?php if ($genap_open): ?>
                            <a href="<?= base_url('BimbinganSession/toggle_session/genap'); ?>" class="btn btn-warning btn-sm" onclick="return confirm('Apakah Anda yakin ingin menutup sesi bimbingan untuk semester genap?');">Tutup Sesi</a>
                        <?php else: ?>
                            <a href="<?= base_url('BimbinganSession/toggle_session/genap'); ?>" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin membuka sesi bimbingan untuk semester genap?');">Buka Sesi</a>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
