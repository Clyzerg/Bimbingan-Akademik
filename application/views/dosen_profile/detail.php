<div class="container">
  <div class="page-inner">
    <!-- Bagian Foto Profil -->
    <div class="row justify-content-center mb-5">
      <div class="col-md-4 text-center">
        <div class="card shadow-lg border-0">
          <div class="card-body">
            <img src="<?php echo base_url('uploads/foto_profil/' . $profile['foto_profil']); ?>" class="img-fluid rounded-circle mb-3" alt="Foto Profil" style="width: 150px; height: 150px; object-fit: cover;">
            <h4 class="card-title"><?php echo $profile['full_name']; ?></h4>
            
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Kiri -->
      <div class="col-lg-6">
        <div class="card shadow-sm mb-4 border-0">
          <div class="card-body">
            <h5 class="card-title text-primary">Informasi Personal</h5>
            <hr class="mt-0 mb-4">
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Nama</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['full_name']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">NIK</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['nik']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">NIDN</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['nidn']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['email']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Tanggal Lahir</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['tgl_lahir']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Kanan -->
      <div class="col-lg-6">
        <div class="card shadow-sm mb-4 border-0">
          <div class="card-body">
            <h5 class="card-title text-primary">Informasi Kontak</h5>
            <hr class="mt-0 mb-4">
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Alamat</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['address']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Nomor Telepon</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['phone_number']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Kepangkatan</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['kepangkatan']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Jabatan</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['jabatan']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Informasi Akademik Kiri -->
      <div class="col-lg-6">
        <div class="card shadow-sm mb-4 border-0">
          <div class="card-body">
            <h5 class="card-title text-primary">Riwayat Pendidikan</h5>
            <hr class="mt-0 mb-4">
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Jenjang Pendidikan</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['jenjang_pendidikan']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Bidang Studi</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['bidang_studi']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Informasi Akademik Kanan -->
      <div class="col-lg-6">
        <div class="card shadow-sm mb-4 border-0">
          <div class="card-body">
            <h5 class="card-title text-primary">Detail Perguruan Tinggi</h5>
            <hr class="mt-0 mb-4">
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Perguruan Tinggi</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['perguruan_tinggi']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Tahun Lulus</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0"><?php echo $profile['tahun_lulus']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 text-center">
        <a href="<?php echo site_url('DosenProfile/edit'); ?>" class="btn btn-success btn-lg shadow-lg">Ubah Data</a>
      </div>
    </div>
  </div>
</div>
