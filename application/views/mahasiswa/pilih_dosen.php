<div class="container">
    <div class="page-inner">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pilih Dosen Pembimbing</h4>
                </div>
                <div class="card-body">
                    <?= form_open('Mahasiswa/pilih_dosen'); ?>
                    <div class="form-group">
                        <label for="dosen_id">Dosen Pembimbing:</label>
                        <select class="form-control" id="dosen_id" name="dosen_id" required>
                            <option value="">Pilih Dosen Pembimbing</option>
                            <?php foreach($dosen as $d): ?>
                                <option value="<?= $d['id']; ?>"><?= $d['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
