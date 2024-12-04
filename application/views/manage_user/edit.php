<div class="container">
          <div class="page-inner">

  
                    <div class="d-flex align-items-center">
  <div class="container ">

    <div class="row">
      <div class="col">
   
     
        </nav>
      </div>
    </div>
<div class="container">
    <h2><?= $judul ?></h2>
    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('message') ?></div>
    <?php endif; ?>
    <?= form_open('User/update') ?>
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>">
            <?= form_error('username') ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
     
        <div class="form-group">
            <label for="level_id">Level</label>
            <select class="form-control" id="level_id" name="level_id">
                <?php foreach ($level as $level): ?>
                    <option value="<?= $level['id'] ?>" <?= $user['level'] == $level['id'] ? 'selected' : '' ?>><?= $level['level'] ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('level_id') ?>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    <?= form_close() ?>
</div></div></div></div></div>
