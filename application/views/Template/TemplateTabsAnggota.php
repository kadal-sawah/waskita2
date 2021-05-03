<?php $router =  strtolower($this->router->fetch_class());
$uri = $router == 'penilaianperorangan' ? 3 : 4;
?>
<div class="mt-3 d-flex justify-content-center">
    <ul class="nav nav-tabs">
        <li class="nav-item ">
            <a class="nav-link <?= $router == 'penilaianperorangan' ? 'active' : ''; ?>"
                href="<?= base_url('penilaianperorangan/' . $this->uri->segment($uri)) ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                    <path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path>
                </svg> &nbsp;
                Perorangan</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link <?= $router == 'penilaiankelompok' ? 'active' : ''; ?>"
                href="<?= base_url('penilaiankelompok/tambah/' . $this->uri->segment($uri)) ?>"><i
                    class="fas fa-users"></i>
                &nbsp; Kelompok</a>
        </li>

        <li class="nav-item ">
            <a class="nav-link <?= $router == 'penilaiankelompok' ? 'active' : ''; ?>"
                href="<?= base_url('penilaiankelompok/tambah/' . $this->uri->segment($uri)) ?>"><i
                    class="fas fa-pencil"></i>
                &nbsp; Geladi</a>
        </li>
    </ul>
</div>