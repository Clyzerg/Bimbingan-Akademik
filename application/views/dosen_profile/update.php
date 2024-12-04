<div class="container">
    <div class="page-inner">
        <div class="page-header">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Lengkapi Profile !!</div>
                    </div>
                    <?php if ($this->session->flashdata('error_message')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error_message'); ?>
                        </div>
                    <?php endif; ?>
                    <form id="dosenProfileCompleteForm" action="<?= base_url('DosenProfile/update') ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $this->session->userdata('id'); ?>" />
                                        <label for="nidn">NIDN</label>
                                        <input type="number" class="form-control" id="nidn" name="nidn" placeholder="Masukan NIDN" />
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="number" class="form-control" id="nik" name="nik" placeholder="Masukan NIK" />
                                    </div>
                                    <div class="form-group">
                                        <label for="full_name">Nama</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Masukan Nama" />
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" />
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Masukan Alamat" />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Masukan Nomor Telepon" />
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukan Jabatan" />
                                    </div>
                                    <div class="form-group">
                                        <label for="kepangkatan">Kepangkatan</label>
                                        <input type="text" class="form-control" id="kepangkatan" name="kepangkatan" placeholder="Masukan Kepangkatan" />
                                    </div>
                                    <div class="form-group">
                                        <label for="jenjang_pendidikan">Jenjang Pendidikan</label>
                                        <input type="text" class="form-control" id="jenjang_pendidikan" name="jenjang_pendidikan" placeholder="Masukan Jenjang Pendidikan" />
                                    </div>
                                    <div class="form-group">
                                        <label for="bidang_studi">Bidang Studi</label>
                                        <input type="text" class="form-control" id="bidang_studi" name="bidang_studi" placeholder="Masukan Bidang Studi" />
                                    </div>
                                    <div class="form-group">
                                        <label for="perguruan_tinggi">Perguruan Tinggi</label>
                                        <input type="text" class="form-control" id="perguruan_tinggi" name="perguruan_tinggi" placeholder="Masukan Perguruan Tinggi" />
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun_lulus">Tahun Lulus</label>
                                        <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" placeholder="Masukan Tahun Lulus" />
                                    </div>
                                    <div class="form-group">
                                        <label for="foto_profil">Foto Profile</label>
                                        <input type="file" class="form-control" id="foto_profil" name="foto_profil" />
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
    document.getElementById('dosenProfileCompleteForm').addEventListener('submit', function(event) {
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
                document.getElementById('dosenProfileCompleteForm').submit(); // Submit form jika pengguna memilih 'Ya, Simpan'
            }
        });
    });
</script>
