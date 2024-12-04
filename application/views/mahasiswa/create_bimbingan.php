<div class="container">
          <div class="page-inner">

  
                    <div class="d-flex align-items-center">
  <div class="container ">

    <div class="row">
      <div class="col">
   
     
        </nav>
      </div>
    </div><div class="container">
    <h2>Pilih Semester untuk Bimbingan</h2>
    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('message'); ?></div>
    <?php endif; ?>
    <form action="<?= base_url('Bimbingan/create'); ?>" method="get">
        <div class="form-group">
            <label for="semester_id">Pilih Semester:</label>
            <select name="semester_id" id="semester_id" class="form-control">
                <?php foreach ($semesters as $semester): ?>
                    <option value="<?= $semester['semester_id']; ?>">Semester <?= $semester['semester_id']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Lanjutkan</button>
    </form>
</div>
  </div></div></div></div>
