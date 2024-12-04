<div class="container">
    <div class="page-inner">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Input data yang dibawah ini</h4>
                    </div>
                </div>
                <?= form_open_multipart('Bimbingan/insert', ['id' => 'bimbinganForm']); ?>
                <input type="hidden" class="form-control" id="id" name="id" required>
                <div class="form-group">
                    <label for="ipk">IPK Semester Sebelumnya:</label>
                    <input type="text" class="form-control" id="ipk" name="ipk" required>
                </div>

                <div class="form-group">
    <label for="semester_id">Semester:</label>
    <select name="semester_id" id="semester_id" class="form-control" required>
        <?php if (!empty($semesters)): ?>
            <?php foreach ($semesters as $semester): ?>
                <option value="<?= $semester['id'] ?>" <?= in_array($semester['id'], $taken_semester_ids) ? 'disabled' : '' ?>>
                    <?= $semester['semester'] ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">Tidak ada semester yang tersedia untuk bimbingan.</option>
        <?php endif; ?>
    </select>
    <small class="form-text text-muted">Hanya untuk sesi semester ini yang dibuka.</small>
</div>


                <div class="form-group">
                    <label for="krs">Upload KRS (PDF):</label>
                    <input type="file" class="form-control" id="krs" name="krs" required>
                    <?php if (isset($krs_error)) echo '<div class="text-danger">' . $krs_error . '</div>'; ?>
                </div>
                <div class="form-group">
                    <label for="khs">Upload KHS (PDF):</label>
                    <input type="file" class="form-control" id="khs" name="khs" required>
                    <?php if (isset($khs_error)) echo '<div class="text-danger">' . $khs_error . '</div>'; ?>
                </div>

                <br>
                <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('bimbinganForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form disubmit otomatis
        
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah data yang anda masukkan sudah benar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('bimbinganForm').submit(); // Submit form jika pengguna memilih 'Ya, Simpan'
            }
        });
    });
</script>
