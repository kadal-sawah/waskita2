<?php
// $level = $this->session->userdata(sha1('user') . '_level');
/*
        Level
        1 = Admin
        2 = Penilai
        3 = Siswa
        Akses
        1 = Produk
        2 = Telegram
        3 = Telepon
        4 = Posko
        5 = Perorangan
    */
$level = $_SESSION['level'];
// $this->req->print($_SESSION);
// try {
//     $hehe = json_decode($_SESSION['akses']);
//     foreach ($hehe as $key) {
//         $akses .= $key->value;
//     }
//     $_SESSION['akses'] = $akses;
//     $this->req->print($_SESSION);
// } catch (\Error $error) {
//     $this->req->print($_SESSION);
// } catch (\Throwable $th) {
//     //throw $th;
// }

// 0 => 
?>



<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <?php if ($level == 1) { ?>
                        <a class="nav-link active dropdown-toggle" id="menu-master" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fas fa-server"> </i> Master
                        </a>
                        <ul class="dropdown-menu" style="margin-left:50px">
                            <li>
                                <a class="dropdown-item" id="sub-pangkat" href="<?= base_url('pangkat/') ?>">
                                    <i class="fas fa-star"> </i> Pangkat
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" id="sub-jabatan" href="<?= base_url('jabatan/') ?>">
                                    <i class="fas fa-trophy"> </i> Jabatan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" id="sub-anggota" href="<?= base_url('anggota/') ?>">
                                    <i class="fas fa-users"> </i> Anggota
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" id="sub-perorangan" href="<?= base_url('soalperorangan/') ?>">
                                    <i class="fas fa-check"></i> Ceklis Perorangan
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" id="sub-cek-kelompok" href="<?= base_url('soalkelompok/') ?>">
                                    <i class="fas fa-check"></i> Ceklis Kelompok
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" id="sub-ceklis" href="<?= base_url('ceklis/') ?>">
                                    <i class="fas fa-check"> </i> Ceklis
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" id="sub-kelompok" href="<?= base_url('kelompok/') ?>">
                                    <i class="fas fa-users"></i> Kelompok
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" id="sub-engguna" href="<?= base_url('user/') ?>">
                                    <i class="fas fa-user"></i> Pengguna
                                </a>
                            </li>
                        </ul>

                    <?php } ?>

                    <?php if ($level == 2 || $level == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('penilaiankelompok') ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <polyline points="9 11 12 14 20 6" />
                                        <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                                </span>
                                <span class="nav-link-title">
                                    Penilaian
                                </span>
                            </a>
                        </li>
                    <?php } ?>
                    <!-- <?php if ($level == 2 || $level == 1 || $level == 3) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('laporankelompok') ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <polyline points="14 3 14 8 19 8"></polyline>
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                        </path>
                                        <line x1="9" y1="9" x2="10" y2="9"></line>
                                        <line x1="9" y1="13" x2="15" y2="13"></line>
                                        <line x1="9" y1="17" x2="15" y2="17"></line>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Laporan
                                </span>
                            </a>
                        </li>
                    <?php } ?> -->
                </ul>
            </div>
        </div>
    </div>
</div>