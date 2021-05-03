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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

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
                                    <a class="text-light"
                                        href='<?= base_url('penilaianperorangan/' . $list['id_kelompok']) ?>'><?= $list['nama_kelompok'] ?></a>
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
                                    <table class='table table-bordered' id="example">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>NAMA</th>
                                                <th>PANGKAT</th>
                                                <th>JABATAN</th>
                                                <!-- <th>HARI KE - 1</th> -->
                                                <!-- <th>HARI KE - 2</th> -->
                                                <!-- <th>HARI KE 1-2 </th> -->
                                                <!-- <?php if ($this->uri->segment(2) == 1) { ?> -->
                                                <!-- <th>HARI KE - 4</th> -->
                                                <!-- <?php } ?> -->
                                                <th>PENILAI 1</th>
                                                <th>PENILAI 2</th>
                                                <th>NILAI TOTAL</th>
                                               <!--  <th>AKSI</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $agt = 0;
                                            $total = 0;
                                            $NilaiAktivitas = 0;
                                            foreach ($collections as $list) :
                                                if (isset($list['nilai_aktivitas'])) {
                                                    // kalo kogab
                                                    // if ($list['id_kelompok'] == 1) {
                                                        // $NilaiAktivitas = $list['is_plus'] == 1 ?  array_sum($list['nilai_aktivitas']) / 1 : array_sum($list['nilai_aktivitas']) / 4;
                                                        $NilaiAktivitas =  array_sum($list['nilai_aktivitas']);
                                                    // } else
                                                        // $NilaiAktivitas = $list['is_plus'] == 1 ?  array_sum($list['nilai_aktivitas']) / 1 : array_sum($list['nilai_aktivitas']) / 3;
                                                // } else
                                                    // $NilaiAktivitas = 0;
                                                    //if($list['nilai_produk'] == null) {
                                                        $TotalNilai = number_format((/*$list['nilai_produk'] + */$NilaiAktivitas) / 2, 2);

                                                        // if ($list['id_kelompok'] == 3) {
        
                                                        //     if ($list['id_jabatan'] == 9)
                                                        //         $TotalNilai += 0.55;
                                                        //     elseif ($list['id_jabatan'] == 27)
                                                        //         $TotalNilai += 0.2;
                                                        // } else {
                                                        //     if ($list['id_jabatan'] == 9)
                                                        //         $TotalNilai += 0.3;
                                                        //     elseif ($list['id_jabatan'] == 27)
                                                        //         $TotalNilai += 0.2;
                                                        // }

                                                    }

                                                // if ($list['is_plus'] == 1) $NilaiAktivitas += 0.5;
                                                // elseif ($list['is_plus'] == 2) $NilaiAktivitas += 0;
                                            ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $list['nama'] ?></td>
                                                <td><?= $list['nama_pangkat'] ?></td>
                                                <td><?= $list['nama_jabatan'] ?></td>
                                                <!-- <td><?= $list['nilai_aktivitas'][0] ?></td> -->
                                                <!-- <td><?= !isset($list['nilai_aktivitas'][1]) ? $list['nilai_aktivitas'][0] : $list['nilai_aktivitas'][1]; ?></td> -->
                                                <!-- <td><?= !isset($list['nilai_aktivitas'][2]) ? $list['nilai_aktivitas'][0] : $list['nilai_aktivitas'][2]; ?></td> -->
                                                <!-- <?php if ($list['id_kelompok'] == 1) { ?> -->
                                                <!-- <td><?= !isset($list['nilai_aktivitas'][3]) ? $list['nilai_aktivitas'][0] : $list['nilai_aktivitas'][3]; ?></td> -->
                                                <!-- <?php } ?> -->
                                                <td class="text-center"><?= number_format($NilaiAktivitas, 2) ?>
                                                </td>
                                                <td class="text-center"><?php error_reporting(0); echo $list['nilai_produk']; ?></td>
                                                <td class="text-center"><?= $TotalNilai ?></td>
                                               <!--  <td ></td> -->
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
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
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    </script>

    <script src="<?= base_url('assets/js/show.js') ?>"></script>
    <script>

    </script>
</body>

</html>
</script>
</body>

</html>