<div class="container">
          <div class="page-inner">
            <div class="page-header">
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Tambah Data Dosen</div>
                  </div>
                  <form action="<?= base_url('dosen1/tambah_dosen')?>" method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="nidn">NIDN</label>
                          <input
                            type="number"
                            class="form-control"
                            id="nidn"
                            name="nidn"
                            placeholder="Masukan NIDN"
                          />
                        </div>
                        <div class="form-group">
                          <label for="namadosen">Nama</label>
                          <input
                            type="text"
                            class="form-control"
                            id="namadosen"
                            name="namadosen"
                            placeholder="Masukan Nama"
                          />
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input
                            type="text"
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
                            id="alamat"
                            name="alamat"
                            placeholder="Masukan Alamat"
                          />
                        </div>
                        <div class="form-group">
                          <label for="prodi">Prodi</label>
                          <input
                            type="text"
                            class="form-control"
                            id="prodi"
                            name="prodi"
                            placeholder="Masukan Prodi"
                          />
                        </div>
                       
                  <div class="card-action">
                    <button class="btn btn-success">Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
