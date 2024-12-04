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
                <h2><?= $judul ?></h2>
                
                <!-- Notifikasi untuk pesan error -->
                <?php if ($this->session->flashdata('message')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('message') ?></div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                <?php endif; ?>

                <!-- Form dengan konfirmasi JavaScript -->
                <?= form_open('User/add', ['onsubmit' => 'return confirmSubmit()']) ?>
                <input type="hidden" class="form-control" name="id" id="id" placeholder="ID" value="<?= set_value('id'); ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username') ?>" required>
                    <?= form_error('username') ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <?= form_error('password') ?>
                </div>
                <div class="form-group">
                    <label for="level">Sebagai :</label>
                    <select class="form-control" id="level" name="level" required>
                        <option value="2">Dosen</option>
                        <option value="3">Mahasiswa</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah User</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk konfirmasi -->
<script>
    function confirmSubmit() {
        return confirm('Apakah data yang Anda masukkan sudah benar?');
    }
</script>
