<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>
<div class="container">
          <div class="page-inner">
    <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Edit Data Dosen</h4>
                    </div>
</div> 

    <form action="<?= base_url('dosen1/edit')?>" method="post">
        <div class="form-group">
            <label for="nidn">NIDN:</label>
            <input type="hidden" class="form-control" id="nidn" name="nidn" value="<?php echo $dosen['user_id']; ?>">
            <input type="text" class="form-control" id="nidn" name="nidn" value="<?php echo $dosen['nidn']; ?>">
        </div>
        <div class="form-group">
            <label for="full_name">Nama Lengkap:</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $dosen['full_name']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $dosen['email']; ?>">
        </div>
        <div class="form-group">
            <label for="address">Alamat:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $dosen['address']; ?>">
        </div>
        <div class="form-group">
            <label for="phone_number">Nomor Telepon:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $dosen['phone_number']; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>
</div>
    </div></div></div>