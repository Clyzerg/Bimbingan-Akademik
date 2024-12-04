<div class="container">
    <div class="page-inner">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title"><?= $judul ?></h4>
                        <!-- Tombol Kembali Berdasarkan Level -->
                        <div class="ml-auto">
                            <?php if($this->session->userdata('level') === '2') { ?> 
                                <a href="<?= base_url('bimbingan/index1')?>"><button class="btn btn-primary">Kembali</button></a>
                            <?php } elseif($this->session->userdata('level') === '1') { ?> 
                                <a href="<?= base_url('bimbingan/index3')?>"><button class="btn btn-primary">Kembali</button></a>
                            <?php } elseif($this->session->userdata('level') === '3') { ?> 
                                <a href="<?= base_url('bimbingan/index')?>"><button class="btn btn-primary">Kembali</button></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- Content continues... -->

                
                <div class="card-body">
                    <?php if (!empty($bimbingan)): ?>
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Semester</th>
                                        <th>KRS</th>
                                        <th>KHS</th>
                                        <th>Tanda Tangan Prodi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $bimbingan['nim'] ?></td>
                                        <td><?= $bimbingan['full_name'] ?></td>
                                        <td><?= $bimbingan['semester_id'] ?></td>
                                        <td><a href="<?= base_url('uploads/'.$bimbingan['krs']) ?>" target="_blank">Lihat KRS</a></td>
                                        <td><a href="<?= base_url('uploads/'.$bimbingan['khs']) ?>" target="_blank">Lihat KHS</a></td>
                                        <td>
                                            <?php if ($bimbingan['acc'] == 1): ?>
                                                <span class="text-success">✔️</span>
                                            <?php elseif ($this->session->userdata('level') == 1): ?>
                                                <form method="post" action="<?= base_url('Bimbingan/acc_bimbingan/' . $bimbingan['id']) ?>"  onsubmit="return confirmSubmit()">
                                                    <input type="hidden" name="bimbingan_id" value="<?= $bimbingan['id']; ?>">
                                                    <button type="submit" class="btn btn-success btn-sm">ACC</button>
                                                </form>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Belum di Tanda Tangan.</span>
                                            <?php endif; ?>
                                            <script>
function confirmSubmit() {
    return confirm('Apakah Anda yakin ingin meng-ACC bimbingan ini?');
}
</script>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p>Data bimbingan tidak ditemukan.</p>
                    <?php endif; ?>
                    
                    <h4>Komentar Dosen</h4>
                    <div>
                        <?php if (!empty($comments)): ?>
                            <?php foreach ($comments as $comment): ?>
                                <p><strong><?= $comment['dosen_name']; ?>:</strong> <?= $comment['comment']; ?> (<?= $comment['created_at']; ?>)</p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Belum ada komentar.</p>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($this->session->userdata('level') == 2): // Jika user adalah dosen ?>
                        <form method="post" action="<?= base_url('Bimbingan/add_comment'); ?>">
                            <input type="hidden" name="bimbingan_id" value="<?= $bimbingan['id']; ?>">
                            <div class="form-group">
                                <label for="comment">Tambah Komentar:</label>
                                <textarea name="comment" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                        <br>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
