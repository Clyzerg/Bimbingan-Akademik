<div class="container">
  <div class="page-inner">
    <!-- Bagian Foto Profil -->
    <div class="row justify-content-center mb-4">
      <div class="col-md-4 text-center">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <img src="<?php echo base_url('uploads/foto_profil/' . $profile['foto_profil']); ?>" class="img-fluid rounded-circle mb-3 border" alt="Foto Profil" style="width: 150px; height: 150px; object-fit: cover;">
            <h4 class="card-title mt-2"><?php echo $profile['full_name']; ?></h4>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Kiri -->
      <div class="col-lg-6">
        <div class="card mb-4 shadow-sm border-0">
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-sm-4">
                <p class="mb-0 font-weight-bold">Dosen PA</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['dosen_name']; ?></p>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4">
                <p class="mb-0 font-weight-bold">NPM</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['nim']; ?></p>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4">
                <p class="mb-0 font-weight-bold">Tanggal Lahir</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['tgl_lahir']; ?></p>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4">
                <p class="mb-0 font-weight-bold">Email</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['email']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Kanan -->
      <div class="col-lg-6">
        <div class="card mb-4 shadow-sm border-0">
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-sm-4">
                <p class="mb-0 font-weight-bold">Jenis Kelamin</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['jenkel']; ?></p>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4">
                <p class="mb-0 font-weight-bold">Alamat</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['address']; ?></p>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4">
                <p class="mb-0 font-weight-bold">Nomor Telepon</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['phone_number']; ?></p>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-sm-4">
                <p class="mb-0 font-weight-bold">Angkatan</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['angkatan_tahun']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 text-center">
        <a href="<?php echo site_url('MahasiswaProfile/edit'); ?>" class="btn btn-success">Ubah Data</a>
      </div>
    </div>
  </div>
</div>
