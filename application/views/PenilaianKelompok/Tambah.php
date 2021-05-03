<?php
$GetDay = $this->library->GetDay(date('D'));
$GetMonth = $this->library->GetMonth(date('M'));
$CombineTanggal = '<b>'.$GetDay.'</b>, '.date('d').' '.$GetMonth.' '.date('Y');

$this->load->view('Template/Link-css');
?>

<style>
.text-size-profile {
    font-size: 1.7vh;
}

input[type='number'].tel {
    border: 1px solid #444;
}

#fixedbutton {
    position: fixed;
    bottom: 20px;
    right: 3px;
}

.rounded-pill {
    border-radius: 50%;
}

.text-size-10 {
    font-size: 2.500em;
}
</style>
<?php
$this->load->view('Template/Header');
$this->load->view('Template/SubHeader');
$level = $_SESSION['level'];
$akses = $_SESSION['akses'];
$aksesKelompok = $_SESSION['akses_kelompok'];
?>

<body class="">
    <div class="page">

        <div class="container">
            <?php $this->load->view('Template/TemplateTabs'); ?>
            <!-- Content -->
            <div id="input-edit"></div>
            <div class="row mt-3" id="page-1">

                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header bg-primary d-flex justify-content-between ">
                            <div>&nbsp;</div>
                            <div class='ml-5 text-light montserrat-600 letter-spacing'>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <polyline points="9 11 12 14 20 6" />
                                    <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                                Penilaian kelompok
                            </div>
                            <i class='text-light montserrat-500'><?= $CombineTanggal; ?></i>

                        </div>

                        <?php
                        $aksesna = '';
                        if ($level != 1) {
                            if ($akses != '') {
                                $aksesna_ = json_decode($aksesKelompok);
                                foreach ($aksesna_ as $key) {
                                    $aksesna .= "$key->value,";
                                }
                            }
                        }
                        // echo $aksesna;
                        $aksesUser = $aksesna;
                        ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <div class="form-label">Kelompok</div>
                                    <select class="form-select" id="kelompok" name="kelompok" required>
                                        <option value="">- Pilih Kelompok -</option>
                                        <?php foreach ($CollectionsKelompok as $list) : ?>
                                        <?php if ($level != 1) : ?>
                                        <?php if (strpos($aksesUser, strval($list['nama_kelompok'])) > -1) : ?>
                                        <option value="<?= $list['id_kelompok']; ?>"><?= $list['nama_kelompok']; ?>
                                        </option>
                                        <?php endif; ?>
                                        <?php else : ?>
                                        <option value="<?= $list['id_kelompok']; ?>"><?= $list['nama_kelompok']; ?>
                                        </option>
                                        <?php endif; ?>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <!-- Tipe nilai -->

                                <?php
                                $aksesna = '';
                                if ($level != 1) {
                                    if ($akses != '') {
                                        $aksesna_ = json_decode($akses);
                                        foreach ($aksesna_ as $key) {
                                            $aksesna .= $key->value;
                                        }
                                    }
                                }

                                if ($level == 1) {
                                    $aksesUser = '1,2,3,4';
                                } else {
                                    $aksesUser = $aksesna;
                                }

                                $penilaian = [
                                    [
                                        'id' => '1',
                                        'value' => 'Aktivitas',
                                        'caption' => 'AKTIVITAS',
                                    ],
                                    [
                                        'id' => '2',
                                        'value' => 'Produk',
                                        'caption' => 'PRODUK',
                                    ],
                                    // [
                                    //     'id' => '3',
                                    //     'value' => 'Posko',
                                    //     'caption' => 'POSKO'
                                    // ],
                                    // [
                                    //     'id' => '4',
                                    //     'value' => 'TelTel',
                                    //     'caption' => 'TELEPON & TELEGRAM'
                                    // ],
                                    [
                                        'id' => '6',
                                        'value' => 'Paparan',
                                        'caption' => 'PAPARAN',
                                    ],
                                ];

                                ?>
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <div class="input-icon">
                                        <div class="form-label">Penilaian</div>
                                        <select class="form-select" name="penilaian" id="penilaian" required>
                                            <option value="">- Pilih Penilaian -</option>
                                            <?php foreach ($penilaian as $key) : ?>
                                                <?php if (strpos($aksesUser, strval($key['id'])) > -1) : ?>
                                                <option value="<?= $key['value']; ?>"><?= $key['caption']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <!-- <option value="Aktivitas">AKTIVITAS</option>
                                            <option value="Posko">POSKO</option>
                                            <option value="Produk">PRODUK</option>
                                            <option value='TelTel'>TELEPON & TELEGRAM</option> -->
                                        </select>
                                    </div>
                                </div>
                                <!-- /Tipe nilai -->
                            </div>

                            <div id="show"></div>

                            <!-- /Content -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br /><br />
    <?php
    $this->load->view('Template/Link-js'); ?>
    <script src="<?= base_url('assets/js/show.js'); ?>"></script>
    <script>

    </script>
</body>

</html>