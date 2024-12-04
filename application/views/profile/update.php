<div class="container">
          <div class="page-inner">
            <div class="page-header">
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Silahkan Lenkapi Profile Dahulu !!</div>
                  </div>
                  <form action="<?= base_url('Profile/update')?>" method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="nidn">Masukan NIDN/NPM anda</label>
                          <input type="hidden" class="form-control" name="id" placeholder="ID" value="<?= $this->session->userdata('id') ?>" >
                          <input  type="number" class="form-control" id="nidn" name="nidn"  placeholder="Masukan NIDN"  />

                        </div>
                        <div class="form-group">
                          <label for="namadosen">Nama Lengkap</label>
                          <input
                            type="text"
                            class="form-control"
                            id="full_name"
                            name="full_name"
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
                          <label for="email">Alamat</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="address"
                            placeholder="Masukan Alamat"
                          />
                        </div>
                        <div class="form-group">
                          <label for="alamat">Nomor Telepon</label>
                          <input
                            type="text"
                            class="form-control"
                            id="alamat"
                            name="phone_number"
                            placeholder="Masukan Nomor Telepon"
                          />
                        </div>                   
                  <div class="card-action">
                    <button class="btn btn-success">Simpan Data</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
