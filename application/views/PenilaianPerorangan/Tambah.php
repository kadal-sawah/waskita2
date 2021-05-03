<?php
$GetDay = $this->library->GetDay(date('D'));
$GetMonth = $this->library->GetMonth(date('M'));
$CombineTanggal = '<b>' . $GetDay . '</b>, ' . date('d') . ' ' . $GetMonth . ' ' . date('Y');

$this->load->view('Template/Link-css'); ?>
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
?>

<body class="">
    <div class="page">

        <div class="container">
            <?php $this->load->view('Template/TemplateTabs'); ?>
            <!-- Content -->
            <?= form_open(base_url('penilaiankelompok/store'), ['id' => 'penilaian', 'autocomplete' => 'off']); ?>
            <div id="input-edit"></div>
            <div class="row mt-3" id="page-1">

                <div class="col-lg-3">
                    <div class="card">

                        <div class="card-header bg-primary text-light montserrat-600 ">
                            <center>KELOMPOK</center>
                        </div>
                        <div class="card-body">
                            <ul class='list-unstyled'>
                                <?php foreach ($CollectionsKelompok as $list) : ?>
                                <li class='bg-dark text-light mb-1 px-2 py-1 montserrat-600'>
                                    <?= $list['nama_kelompok'] ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card">

                        <div class="card-header bg-primary d-flex justify-content-between ">
                            <div>&nbsp;</div>
                            <div class='ml-5 text-light montserrat-600 letter-spacing'>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <polyline points="9 11 12 14 20 6" />
                                    <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                </svg>
                                Penilaian Perorangan
                            </div>
                            <i class='text-light montserrat-500'><?= $CombineTanggal ?></i>

                        </div>
                        <div class="card-body">
                            <div class="row">

                            </div>
                            <div class="row mt-3">
                                <!-- Tipe nilai -->
                                <div class="col-lg-12">
                                    <table class='table table-bordered'>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA</th>
                                            <th>PANGKAT</th>
                                            <th>JABATAN</th>
                                            <th>NILAI AKT</th>
                                            <th>NILAI PROD</th>
                                            <th>NILAI TOTAL</th>
                                            <th>KET</th>
                                        </tr>
                                        <?php foreach ($CollectionsJabatan as $list) : ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><?= $list['nama_jabatan'] ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                                <!-- /Tipe nilai -->
                            </div>

                            <div id="show"></div>

                            <!-- /Content -->
                        </div>
                    </div>
                </div>
            </div>

            <?= form_close() ?>

        </div>
    </div>
    <br /><br />
    <?php
    $this->load->view('Template/Link-js'); ?>
    <script src="<?= base_url('assets/js/show.js') ?>"></script>
</body>

</html>