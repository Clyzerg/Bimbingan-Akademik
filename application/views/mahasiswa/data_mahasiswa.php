<div class="container">
          <div class="page-inner">

    <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Daftar Mahasiswa STT Payakumbuh Prodi D-3 Teknik Komputer</h4>
                     
                 
                    
            
                       
                    </div>
                  </div>
                
                  <div class="card-body">
                    <!-- Modal -->
                    <?php if($this->session->userdata('level') === '1') { ?>
                  
                        <a href="<?= base_url('mahasiswa1/tambah_mahasiswa')?>">
                        <button class="btn btn-secondary">
                        <span class="btn-label">
                          <i class="fa fa-plus"></i>
                        </span>
                     Tambah Data Mahasiswa
                      </button>
                        </a>
                  
                       <?php } ?>
                    <div class="table-responsive">
                      <table
                        id="add-row"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th style="width: 10%">Action</th>
                          </tr>
                        </thead>
                        <?php
				$no = 1;
				foreach ($mahasiswa as $m) {
				?>
                        <tbody>
                          <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $m->npm ?></td>
                            <td><?php echo $m->nama_mahasiswa ?></td>
                            <td><?php echo $m->email ?></td>
                            <td><?php echo $m->alamat ?></td>
                            <td>
                              <div class="form-button-action">
                                <a href="<?= base_url('mahasiswa1/edit_mahasiswa/'. $m->npm)?>">
                                <button
                                  type="button"
                                  data-bs-toggle="tooltip"
                                  title=""
                                  class="btn btn-link btn-primary btn-lg"
                                  data-original-title="Edit Task"
                                >
                                  <i class="fa fa-edit"></i>
                                  </a>
                                </button>
                                <a href="<?= base_url('mahasiswa1/hapus_mahasiswa/' . $m->npm)?>">
                                <button
                                  type="button"
                                  data-bs-toggle="tooltip"
                                  title=""
                                  class="btn btn-link btn-danger"
                                  data-original-title="Remove"
                                >
                                  <i class="fa fa-times"></i>
                                </button>
                                </a>
                              </div>
                            </td>
                          </tr>  
        </div>    
        <?php } ?>