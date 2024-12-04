<div class="container">
          <div class="page-inner">
            <div class="page-header">
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Tambah Data Mahasiswa</div>
                  </div>
                  <form action="<?= base_url('mahasiswa1/mahasiswa_action')?>" method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="nidn">NPM</label>
                          <input
                            type="number"
                            class="form-control"
                            id="npm"
                            name="npm"
                            placeholder="Masukan NPM Mahasiswa"
                          />
                        </div>
                        <div class="form-group">
                          <label for="namadosen">Nama Mahasiswa</label>
                          <input
                            type="text"
                            class="form-control"
                            id="nama_mahasiswa"
                            name="nama_mahasiswa"
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
