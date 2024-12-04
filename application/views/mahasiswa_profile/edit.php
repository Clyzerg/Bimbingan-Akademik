<div class="container">
          <div class="page-inner">
            <div class="page-header">
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Edit Profile Mahasiswa</div>
                  </div>
                  <form action="<?= base_url('MahasiswaProfile/edit_proccess') ?>" method="post" enctype="multipart/form-data" onsubmit="return confirmSave();">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                        <input type="hidden" class="form-control"  id="nim" name="id" value="<?= $this->session->userdata('id'); ?>"/>
                          <label for="nidn">NPM</label>
                          <input type="number" class="form-control"  id="nim"name="nim" value="<?php echo $profile['nim']; ?>"/>
                        </div>
                        <div class="form-group">
                          <label for="namadosen">Nama</label>
                          <input
                            type="text"
                            class="form-control"
                            id="full_name"
                            name="full_name"
                            value="<?php echo $profile['full_name']; ?>"
                          />
                        </div>
                        <div class="form-group">
                          <label for="namadosen">Tanggal Lahir</label>
                          <input
                            type="date"
                            class="form-control"
                            id="tgl_laahir"
                            name="tgl_lahir"
                            value="<?php echo $profile['tgl_lahir']; ?>"
                          />
                        </div>
                        <div class="form-group">
    <label for="agama">Agama</label>
    <select class="form-control" id="agama" name="agama" required>
        <option value="">Pilih Agama</option>
        <option value="Islam">Islam</option>
        <option value="Kristen Protestan">Kristen Protestan</option>
        <option value="Kristen Katolik">Kristen Katolik</option>
        <option value="Hindu">Hindu</option>
        <option value="Buddha">Buddha</option>
        <option value="Konghucu">Konghucu</option>
        <option value="Lainnya">Lainnya</option>
    </select>
</div>
<div class="form-group">
    <label>Jenis Kelamin</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" id="jenis_kelamin_laki" name="jenkel" value="Laki-laki" required>
        <label class="form-check-label" for="jenis_kelamin_laki">
            Laki-laki
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" id="jenis_kelamin_perempuan" name="jenkel" value="Perempuan" required>
        <label class="form-check-label" for="jenis_kelamin_perempuan">
            Perempuan
        </label>
    </div>
</div>

                        <div class="form-group">
                          <label for="email">Email</label>
                          <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            value="<?php echo $profile['email']; ?>"
                          />
                        </div>

                        <div class="form-group">
                          <label for="alamat">Alamat</label>
                          <input type="text" class="form-control" id="address"  name="address" value="<?php echo $profile['address']; ?>" />
                        </div>
                        <div class="form-group">
                          <label for="prodi">Nomor Telepon</label>
                          <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $profile['phone_number']; ?>"/>
                        </div>
                        <div class="form-group">
                          <label for="prodi">Angkatan</label>
                          <select type="text" class="form-control" id="angkatan_id" name="angkatan_id">  
                          <?php foreach($angkatan as $angk): ?>
                <option value="<?= $angk['id'] ?>" <?= ($profile['angkatan_id'] == $angk['id']) ? 'selected' : '' ?>><?= $angk['tahun'] ?></option>
            <?php endforeach; ?>
        </select>                
                        </div>   
                         
        <div class="form-group">
    <label for="dosen_id">Dosen Pembimbing:</label>
    <select class="form-control" id="dosen_id" name="dosen_id" required>
        <option value="">Pilih Dosen Pembimbing</option>
        <?php foreach ($dosen as $d): ?>
            <option value="<?= $d['user_id']; ?>" <?= $profile['dosen_id'] == $d['user_id'] ? 'selected' : ''; ?>>
                <?= $d['full_name']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>  
<div class="form-group">
    <label for="foto_profil">Foto Profil:</label>
    <input type="file" class="form-control" id="foto_profil" name="foto_profil">
    <?php if ($profile['foto_profil']): ?>
        <img src="<?= base_url('uploads/foto_profil/' . $profile['foto_profil']); ?>" alt="Foto Profil" width="100">
    <?php endif; ?>
</div>
                  <div class="card-action">
                    <button class="btn btn-success">Simpan Profile</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
            </div></div></div>
            <script>
    function confirmSave() {
        return confirm("Apakah data yang Anda masukkan sudah benar?");
    }
</script>
