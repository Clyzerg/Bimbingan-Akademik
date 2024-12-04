<div class="container">
    <div class="page-inner">
        <div class="page-header">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Profile Dosen</div>
                    </div>
                    <form id="dosenProfileForm" action="<?= base_url('DosenProfile/edit_proccess') ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                        <?php if ($this->session->flashdata('error')): ?>
                                        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                                    <?php endif; ?>
                                    <?php if ($this->session->flashdata('message')): ?>
                                        <div class="alert alert-success"><?= $this->session->flashdata('message') ?></div>
                                    <?php endif; ?>
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $this->session->userdata('id'); ?>" />
                                        <input type="hidden" name="existing_foto_profil" value="<?= $profile['foto_profil']; ?>">  
                                        <label for="nidn">NIDN</label>
                                        <input type="number" class="form-control" id="nidn" name="nidn" value="<?= $profile['nidn']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="number" class="form-control" id="nik" name="nik" value="<?= $profile['nik']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="full_name">Nama</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?= $profile['full_name']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $profile['email']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?= $profile['address']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $profile['phone_number']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $profile['jabatan']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="kepangkatan">Kepangkatan</label>
                                        <input type="text" class="form-control" id="kepangkatan" name="kepangkatan" value="<?= $profile['kepangkatan']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="jenjang_pendidikan">Jenjang Pendidikan</label>
                                        <input type="text" class="form-control" id="jenjang_pendidikan" name="jenjang_pendidikan" value="<?= $profile['jenjang_pendidikan']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="bidang_studi">Bidang Studi</label>
                                        <input type="text" class="form-control" id="bidang_studi" name="bidang_studi" value="<?= $profile['bidang_studi']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="perguruan_tinggi">Perguruan Tinggi</label>
                                        <input type="text" class="form-control" id="perguruan_tinggi" name="perguruan_tinggi" value="<?= $profile['perguruan_tinggi']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun_lulus">Tahun Lulus</label>
                                        <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus" value="<?= $profile['tahun_lulus']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="foto_profil">Foto Profil:</label>
                                        <input type="file" class="form-control" id="foto_profil" name="foto_profil">
                                        <?php if ($profile['foto_profil']): ?>
                                            <img src="<?= base_url('uploads/foto_profil/' . $profile['foto_profil']); ?>" alt="Foto Profil" width="100">
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-action">
                                        <button type="submit" class="btn btn-success">Simpan Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('dosenProfileForm').addEventListener('submit', function(event) {
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
                // Jika Anda menggunakan AJAX
                var form = document.getElementById('dosenProfileForm');
                var formData = new FormData(form);
                
                fetch(form.action, {
                    method: form.method,
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) { // Jika respons menunjukkan sukses
                        Swal.fire(
                            'Sukses!',
                            'Profile berhasil disimpan.',
                            'success'
                        );
                        // Anda bisa menambahkan redirect atau tindakan lain di sini
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat menyimpan profile.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menyimpan profile.',
                        'error'
                    );
                });
            }
        });
    });
</script>


<script>
    document.getElementById('dosenProfileForm').addEventListener('submit', function(event) {
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
                document.getElementById('dosenProfileForm').submit(); // Submit form jika pengguna memilih 'Ya, Simpan'
            }
        });
    });
</script>
