    <?php $router =  strtolower($this->router->fetch_class());
    $uri = $router == 'penilaianperorangan' ? 2 : 3;
    $level = $_SESSION['level'];
    // $this->req->print($_SESSION);
    if ($_SESSION['akses'] != '') {
        $aksesCeklis = json_decode($_SESSION['akses']);
    }

    $muncul = false;
    if (isset($aksesCeklis)) {
        if (count($aksesCeklis) > 0) {
            foreach ($aksesCeklis as $key) {
                if ($key->value == '4') {
                    $muncul = true;
                }
            }
        }
    }

    ?>
    <div class="mt-3 d-flex justify-content-center">
        <ul class="nav nav-tabs">
            <?php if ($level == 1) { ?>
                <li class="nav-item ">
                    <a class="nav-link <?= $router == 'penilaianperorangan' ? 'active' : ''; ?>" href="<?= base_url('penilaianperorangan/' . $this->uri->segment($uri)) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            <path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path>
                        </svg> &nbsp;
                        Perorangan</a>
                </li>
            <?php } ?>
            <li class="nav-item ">
                <a class="nav-link <?= $router == 'penilaiankelompok' ? 'active' : ''; ?>" href="<?= base_url('penilaiankelompok') ?>"><i class="fas fa-users"></i>
                    &nbsp; Kelompok</a>
            </li>
            <?php if ($level == 1) { ?>
                <li class="nav-item ">
                    <a class="nav-link <?= $router == 'geladi' ? 'active' : ''; ?>" href="<?= base_url('geladi') ?>">
                        <i class="far fa-list-alt"></i> &nbsp;
                        Geladi</a>
                </li>
            <?php } ?>

        </ul>
    </div>