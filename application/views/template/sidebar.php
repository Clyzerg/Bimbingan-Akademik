<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> <?= $judul; ?> </title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="<?= base_url('assets/')?>img/sttp.png"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="<?= base_url('assets/')?>js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["<?= base_url('assets/')?>css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets/')?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/')?>css/plugins.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/')?>css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?= base_url('assets/')?>css/demo.css" />
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="<?= base_url()?>" class="logo">
              <img
                src="<?= base_url('assets/')?>img/sttp1.png"
                alt="navbar brand"
                class="navbar-brand"
                height="200"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
             
              <?php if ($this->session->userdata('level') === '1') { ?>
    <a href="<?= base_url('Admin/index') ?>">
        <i class="fas fa-home"></i>
        <p>Dashboard</p>
    </a>
<?php } else if ($this->session->userdata('level') === '2') { ?>
  <?php if($this->session->userdata('is_profile_complete')) {?>
    <a href="<?= base_url('Dosen') ?>">
        <i class="fas fa-home"></i>
        <p>Dashboard</p>
    </a>
    <?php } ?>
<?php } else if ($this->session->userdata('level') === '3') { ?>
  <?php if($this->session->userdata('is_profile_complete')) {?>
    <a href="<?= base_url('Mahasiswa') ?>">
        <i class="fas fa-home"></i>
        <p>Dashboard</p>
    </a>
    <?php } ?>
<?php } ?>

              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Menu</h4>
              </li>
              <?php if($this->session->userdata('level') === '1') { ?>
              <li class="nav-item"> <a data-bs-toggle="collapse" href="#base"> <i class="fas fa-user"></i>
                  <p> Dosen</p>
                  <span class="caret"></span>
                  <?php } ?> 
                </a>
                
                <div class="collapse" id="base">
                  <ul class="nav nav-collapse">
                  <?php if($this->session->userdata('level') === '1') { ?>
                    <li> <a href="<?= base_url('Dosen1/index')?>"> <span class="sub-item">Daftar Dosen</span></a> </li>                   
                    
                    <?php } ?>  
                    </li>                                
                  </ul>
                </div>
              
              </li>
              <?php if($this->session->userdata('level') === '1') { ?>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLayouts">
                  <i class="fas fa-th-list"></i>
                  <p>Mahasiswa</p>
                  <span class="caret"></span>
                  </a>
                  <div class="collapse" id="sidebarLayouts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="<?= base_url('MahasiswaProfile/all_profiles')?>">
                        <span class="sub-item">Data Mahasiswa</span>
                      </a>
                    </li>
                    
                  </ul>
                </div>
                  <?php } else if($this->session->userdata('level') === '2') { ?>
                    <?php if($this->session->userdata('is_profile_complete')) {?>
                    <li class="nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLayouts">
                  <i class="fas fa-th-list"></i>
                  <p>Mahasiswa</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="sidebarLayouts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="<?= base_url('MahasiswaProfile/all_profiles1')?>">
                        <span class="sub-item">Data Mahasiswa</span>
                      </a>
                    </li>
                    
                  </ul>
                </div>
                <?php } ?>
                <?php } ?>
              </li>
              <?php if($this->session->userdata('level') === '1') { ?>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#charts">
                <i class="fas fa-door-open"></i>
                  <p>Sesi Bimbingan</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="charts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="<?= base_url('BimbinganSession/index')?>">
                        <span class="sub-item">Detail</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <?php } ?>
              <?php if($this->session->userdata('is_profile_complete')) {?>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#forms">
                  <i class="fas fa-pen-square"></i>
                  <p>Bimbingan</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="forms">
                  <ul class="nav nav-collapse">
                  <?php if($this->session->userdata('level') === '1') { ?>
                    <li>
                      <a href="<?= base_url('Bimbingan/pilih_semester')?>">
                        <span class="sub-item">Lakukan Bimbingan</span>
                      </a>
                    </li>
                    <?php } else if($this->session->userdata('level') === '3') { ?>
                      <li>
                      <a href="<?= base_url('Bimbingan/pilih_semester')?>">
                        <span class="sub-item">Lakukan Bimbingan</span>
                      </a>
                    </li>
                    <?php } ?>
                    <?php if($this->session->userdata('level') === '2') { ?>
                    <li>
                      <a href="<?= base_url('Bimbingan/index1')?>">
                        <span class="sub-item">Proses Bimbingan</span>
                      </a>
                    </li>
                    <?php } else if($this->session->userdata('level') === '3') { ?>
                      <li>
                      <a href="<?= base_url('Bimbingan/index')?>">
                        <span class="sub-item">Proses Bimbingan</span>
                      </a>
                    </li>
                    <?php 
                  } else if($this->session->userdata('level') === '1' ) { ?>
                    <li>
                    <a href="<?= base_url('Bimbingan/index3')?>">
                      <span class="sub-item">Proses Bimbingan</span>
                    </a>
                  </li>
                  <?php } ?>
                  </ul>
                </div>
              </li>
             <?php  } ?>
             
              <?php if ($this->session->userdata('level') === '1') { ?>
              <li class="nav-item">
                <a href="<?= base_url('User/list')?>">
                  <i class="fas fa-users-cog"></i>
                  <p>Manage User</p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->
      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
         
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
             
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li
                  class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none"
                >
                  <a
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                  >
                    <i class="fa fa-search"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                      <div class="input-group">
                        <input
                          type="text"
                          placeholder="Search ..."
                          class="form-control"
                        />
                      </div>
                    </form>
                  </ul>
                </li>
                <li class="nav-item topbar-icon dropdown hidden-caret"> 
                </li>
                <?php if($this->session->userdata('level') === '2') { ?>
                  <?php if ($this->session->userdata('level') === '2') { ?>
                    <li class="nav-item topbar-icon dropdown hidden-caret">
    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bell"></i>
        <?php if (count($notifications) > 0) { ?>
            <span class="notification"><?= count($notifications) ?></span>
        <?php } ?>
    </a>
    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
        <li>
            <div class="dropdown-title">You have <?= count($notifications) ?> new notifications</div>
        </li>
        <li>
            <div class="notif-scroll scrollbar-outer">
                <div class="notif-center">
                    <?php foreach ($notifications as $notif) { ?>
                        <a href="<?= base_url('Bimbingan/index1') ?>" class="notif-item">
                            <div class="notif-icon">
                                <i class="fa fa-user-plus"></i>
                            </div>
                            <div class="notif-content">
                                <span class="notif-message"><?= $notif['message'] ?></span>
                             
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </li>
    </ul>
</li>


<?php } ?>

                <?php } else if($this->session->userdata('level') === '3') { ?>
                  <li class="nav-item topbar-icon dropdown hidden-caret">
        <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bell"></i>
            <?php if ($unread_count > 0): ?>
                <span class="notification"><?= $unread_count ?></span>
            <?php endif; ?>
        </a>
        <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
            <li>
                <div class="dropdown-title">You have <?= $unread_count ?> new notification(s)</div>
            </li>
            <li>
                <div class="notif-scroll scrollbar-outer">
                    <div class="notif-center">
                        <?php foreach ($notifications as $notif): ?>
                            <a href="<?= base_url('Bimbingan/index')?>">
                                <div class="notif-icon notif-primary"><i class="fa fa-check-circle"></i></div>
                                <div class="notif-content">
                                    <span class="block"><?= $notif->message ?></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </li>
            <li><a class="see-all" href="#">See all notifications</a></li>
        </ul>
    </li>
                <?php } ?>
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                  <?php


// Ambil level dan ID pengguna dari sesi
$level = $this->session->userdata('level');
$user_id = $this->session->userdata('id');

// Inisialisasi variabel username
$username = '';

// Ambil status profil pengguna
$this->db->select('is_profile_complete');
$this->db->from('user');
$this->db->where('id', $user_id);
$query = $this->db->get();
$user_status = $query->row();

if ($user_status && $user_status->is_profile_complete == 0) {
    $username = 'Lengkapi Profile !!';
} else {
    // Ambil nama pengguna berdasarkan level
    if ($level === '2') {
        // Jika pengguna adalah dosen
        $this->db->select('full_name');
        $this->db->from('dosen_profiles');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $user = $query->row();
        $username = $user ? $user->full_name : 'Nama Dosen Tidak Ditemukan';
    } elseif ($level === '3') {
        // Jika pengguna adalah mahasiswa
        $this->db->select('full_name');
        $this->db->from('mahasiswa_profiles');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $user = $query->row();
        $username = $user ? $user->full_name : 'Nama Mahasiswa Tidak Ditemukan';
    } else {
        // Untuk level lain, misalnya admin
        $username = 'Admin';
    }
}
?>

<span class="profile-username">
    <span class="op-7">Hi,</span>
    <span class="fw-bold"><?= htmlspecialchars($username) ?></span>
</span>



                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                        </div>
                      </li>
                      <li>
                     
                        <a class="dropdown-item" href="<?= base_url('Auth/logout')?>">Logout<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoutLink = document.querySelector('a[href="<?= base_url('Auth/logout') ?>"]');
    if (logoutLink) {
        logoutLink.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah link default action
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = logoutLink.href; // Redirect ke URL logout jika konfirmasi
                }
            });
        });
    }
});
</script></a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </div>
