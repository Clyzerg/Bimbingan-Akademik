<div class="container">
    <div class="page-inner">
        <h2>Pilih Semester untuk Bimbingan</h2>
        <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('message'); ?></div>
        <?php endif; ?>
        <form action="<?= base_url('Bimbingan/create'); ?>" method="post">
            <div class="form-group">
                <label for="semester_id">Pilih Semester:</label>
                <select name="semester_id" id="semester_id" class="form-control">
                    <?php foreach ($semester as $sem): ?>
                        <?php 
                        // Cek jika semester sudah diambil
                        $disabled = in_array($sem['id'], array_column($taken_semesters, 'semester_id')) ? 'disabled' : ''; 
                        ?>
                        <option value="<?= $sem['id'] ?>" <?= $disabled ?>>Semester <?= $sem['semester'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lanjutkan</button>
        </form>
    </div>
</div>
