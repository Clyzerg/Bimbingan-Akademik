<div class="container">
          <div class="page-inner">
            <div class="page-header">
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Lengkapi Profile Mahasiswa</div>
                  </div>
                  <?php if ($this->session->flashdata('error_message')): ?>
            <div class="alert alert-danger">
              <?= $this->session->flashdata('error_message'); ?>
            </div>
          <?php endif; ?>
                  <form action="<?= base_url('MahasiswaProfile/update') ?>" method="post" enctype="multipart/form-data" onsubmit="return confirmSave();">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                        <input type="hidden" class="form-control"  id="nidn"name="id" value="<?= $this->session->userdata('id'); ?>" />
                          <label for="nidn">NPM Mahasiswa</label>
                          <input type="number" class="form-control"  id="nidn"name="nim" placeholder="Masukan NPM"/>
                        </div>
                        <div class="form-group">
                          <label for="namadosen">Nama</label>
                          <input
                            type="text"
                            class="form-control"
                            id="full_name"
                            name="full_name"
                            placeholder="Masukan Nama"
                          />
                        </div>
                        <div class="form-group">
                          <label for="namadosen">Tanggal Lahir</label>
                          <input
                            type="date"
                            class="form-control"
                            id="tgl_lahir"
                            name="tgl_lahir"
                           
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
                            placeholder="Masukan Email"
                          />
                        </div>

                        <div class="form-group">
                          <label for="alamat">Alamat</label>
                          <input
                            type="text"
                            class="form-control"
                            id="address"
                            name="address"
                            placeholder="Masukan Alamat"
                          />
                        </div>
                        <div class="form-group">
                          <label for="prodi">Nomor Telepon</label>
                          <input
                            type="text"
                            class="form-control"
                            id="phone_number"
                            name="phone_number"
                            placeholder="Masukan Nomor Telepon"
                          />
                        </div>
                        <div class="form-group">
                          <label for="prodi">Angkatan</label>
                          <select type="text" class="form-control" id="angkatan_id" name="angkatan_id">  
                          <?php foreach($angkatan as $angk): ?>
                            <option value="<?= $angk['id'] ?>"><?= $angk['tahun'];?></option>
            <?php endforeach; ?>
        </select>                
                        </div>
                        
        <div class="form-group">
    <label for="dosen_id">Pilih Dosen Pembimbing Akademik:</label>
    <select class="form-control" id="dosen_id" name="dosen_id" required>
        <option value="">-- Pilih Dosen Pembimbing Akademik --</option>
        <?php foreach ($dosen_list as $dosen): ?>
            <option value="<?= $dosen['user_id']; ?>"><?= $dosen['full_name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
                          <label for="alamat">Foto Profile</label>
                          <input
                            type="file"
                            class="form-control"
                            id="foto_profil"
                            name="foto_profil"
                       
                          />
                        </div>

                       
                  <div class="card-action">
                    <button class="btn btn-success">Simpan Data</button>
                    </form>
                    <script>
    function confirmSave() {
        return confirm("Apakah data yang Anda masukkan sudah benar?");
    }
</script>
                  </div>
              </div></div></div></div>
                </div>
              </div>
            </div>
          </div>
        </div>
       
   
