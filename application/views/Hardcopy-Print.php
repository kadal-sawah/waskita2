<style>
.bg-orange {
    background: orange;
}

.bg-grey {
    background: #555;
}

.bg-yellow {
    background: yellow;
}

.bg-green-old {
    background: green;
}

.bg-green-light {
    background: greenyellow;
}

tbody tr td {
    vertical-align: middle;
}

table.table-bordered {
    border: 1px solid #222;
    margin-top: 20px;
}

table.table-bordered>thead>tr>th {
    border: 1px solid #222;
}

table.table-bordered>tbody>tr>td {
    border: 1px solid #222;
}

table.table-bordered>tfoot>tr>td {
    border: 1px solid #222;
}

.serif {
    font-family: sans-serif;
}

.serif-bold {
    font-family: sans-serif;
    font-weight: bold;
}

.bg-primary {
    background: #222 !important;
}

.bg-warning {
    background: yellow !important;
}

.bg-dark {
    background: #222 !important;
}

.bg-success {
    background: green !important;
}

.bg-danger {
    background: red !important;
}

.text-light {
    color: #fff;
}

.text-center {
    text-align: center;
}
</style>


<body class="">
    <div class="bg-white">
        <?php if (isset($tipe) && $tipe == 'AKTIVITAS') { ?>
        <br /><br /><br /><br />
        <center>
            <div style="width:70%">

                <h3 class="serif-bold">POSKO PELAKU &nbsp; : <?= $KELOMPOK->nama_kelompok ?></h3>
                <table border=1 cellpadding="10" style="border-collapse:collapse;">
                    <thead style='border:1px solid #111; '>
                        <tr class='bg-primary text-light serif'>
                            <td class="text-center serif-bold letter-spacing">NO</td>
                            <td class="text-center serif-bold letter-spacing">TINDAKAN YANG DIHARAPKAN</td>
                            <td class="text-center serif-bold letter-spacing" width=10%>NILAI MAKS</td>
                            <td colspan=3 class="text-center serif-bold letter-spacing" width=10%>NILAI</td>
                        </tr>
                        <tr class="bg-warning text-center serif-bold">
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                            $jmlIndex = 0;
                            foreach ($collections as $list) :
                                $y = 0;
                                $jmlIndex = 0;
                                $DecodeJabatan = json_decode($list['id_jabatan'], true);
                            ?>
                        <tr>

                            <td class="text-center serif text-size-7" width=5%
                                rowspan="<?= count($DecodeJabatan) == 2 || count($DecodeJabatan) == 3 ? count($list['soal']) + 3 : count($list['soal']) + 2 ?>">
                                <?= $this->library->Romawi($i + 1) ?>
                            </td>
                            <?php
                                    $DecodeJabatan = json_decode($list['id_jabatan'], true);
                                    if (count($DecodeJabatan) == 1) { ?>
                            <td class=' bg-dark text-light letter-spacing serif text-size-6' colspan=2>
                                CA<?= $i + 1 ?> - <?= $list['nama_ceklis'] ?>
                            </td>
                            <td width="5%" class=" bg-dark text-light text-center letter-spacing serif text-size-6"
                                colspan=3>NILAI
                            </td>
                            <?php } elseif (count($DecodeJabatan) == 2) { ?>
                            <td class=' bg-dark text-light letter-spacing serif text-size-6' colspan=2>
                                CA<?= $i + 1 ?> - <?= $list['nama_ceklis'] ?>
                            </td>
                            <td width=6% class=" text-center bg-dark text-light letter-spacing serif text-size-6">
                                NILAI I
                            </td>
                            <td width=1% colspan=1
                                class=" text-center bg-dark text-light letter-spacing serif text-size-6">
                                NILAI II
                            </td>
                            <td width=1% colspan=1
                                class=" text-center bg-grey text-light letter-spacing serif text-size-6">
                            </td>

                            <?php } elseif (count($DecodeJabatan) == 3) { ?>
                            <td class=' bg-dark text-light letter-spacing serif text-size-6' colspan=2>
                                CA<?= $i + 1 ?> - <?= $list['nama_ceklis'] ?>
                            </td>
                            <td width="10%" class=" bg-dark text-light text-center letter-spacing serif text-size-6">
                                NILAI I
                            </td>
                            <td width="10%" class=" bg-dark text-light text-center letter-spacing serif text-size-6">
                                NILAI
                                II
                            </td>
                            <td width="10%" class=" bg-dark text-light text-center letter-spacing serif text-size-6">
                                NILAI
                                III
                            </td>

                            <?php } ?>
                            <?php foreach ($list['soal'] as $ListSoal) : $jmlIndex += $ListSoal['maks']; ?>
                        <tr>
                            <td class=" serif letter-spacing"><?= ($y + 1) . '.' . $ListSoal['aspek'] ?></td>
                            <td class="text-center serif"><?= $ListSoal['maks'] ?></td>
                            <?php if (count($DecodeJabatan) == 1) { ?>
                            <td class="text-center" colspan=3></td>
                            <?php } elseif (count($DecodeJabatan) == 2) { ?>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center bg-grey"></td>
                            <?php } elseif (count($DecodeJabatan) == 3) { ?>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <?php } ?>
                        </tr>

                        <?php $y++;
                                    endforeach; ?>
                        <td class='text-center letter-spacing serif text-size-6'>NILAI</td>
                        <td class="text-center text-size-5 serif"><?= $jmlIndex; ?></td>
                        <?php if (count($DecodeJabatan) == 1) { ?>
                        <td class="bg-danger text-center" colspan=3></td>
                        <?php } elseif (count($DecodeJabatan) == 2) { ?>
                        <td class="bg-success text-center"></td>
                        <td class="bg-success text-center"></td>
                        <td class="text-center bg-grey"></td>
                        <?php } elseif (count($DecodeJabatan) == 3) { ?>
                        <td class="bg-success text-center"></td>
                        <td class="bg-success text-center"></td>
                        <td class="bg-success text-center"></td>
                        <?php } ?>

                        </tr>
                        <?php if (count($DecodeJabatan) == 2) { ?>
                        <tr>
                            <td colspan=2 class="text-center letter-spacing serif-bold text-size-6">RATA
                                RATA
                            </td>
                            <td colspan=2 class="bg-danger text-center text-ligt"></td>
                            <td class="bg-grey text-center"></td>
                        </tr>
                        <?php } elseif (count($DecodeJabatan) == 3) { ?>
                        <tr>
                            <td colspan=2 class="text-center letter-spacing serif-bold text-size-6">RATA RATA
                            </td>
                            <td colspan=3 class="bg-danger text-center text-ligt"></td>
                        </tr>

                        <?php }
                                $i++;
                            endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan=3
                                class="bg-warning text-light text-center letter-spacing serif-bold text-size-6">
                                TOTAL
                                NILAI</td>
                            <td colspan=3 class="text-center bg-warning"></td>
                        </tr>
                    </tfoot>
                </table>
                <p class="serif">
                    (*) Penilaian dilihat dari kelengkapan dan ketentuan yang seharusnya dilakukan oleh Pasis.
                </p>
            </div>
        </center>
    </div>
    <?php } elseif (isset($tipe) && ($tipe == 'PRODUK' || $tipe == 'POSKO')) { ?>
    <div class="row" id="page-1">
        <div class="col-lg-12">
            <table border=1>
                <thead style='border:1px solid #111;'>
                    <tr class='bg-primary text-light serif '>
                        <td class="text-center serif-bold letter-spacing">NO</td>
                        <td class="text-center serif-bold letter-spacing">URAIAN MATERI PENILAIAN</td>
                        <td class="text-center serif-bold letter-spacing" width=10%>NILAI MAKS</td>
                        <td class="text-center serif-bold letter-spacing" width=10%>NILAI</td>
                    </tr>
                    <tr class="bg-warning text-light text-center serif">
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $jmlIndex = 0;
                    foreach ($collections as $list) :
                        $y = 0;
                        $jmlIndex = 0;
                    ?>
                    <tr>

                        <td class="text-center serif text-size-7" width=5% rowspan="<?= count($list['soal']) + 2 ?>">
                            <?= $this->library->Romawi($i + 1) ?>
                        </td>
                        <td class=' bg-dark text-light letter-spacing serif text-size-6' colspan=5>
                            CA<?= $i + 1 ?> - <?= $list['nama_ceklis'] ?>
                        </td>
                        <?php foreach ($list['soal'] as $ListSoal) : $jmlIndex += $ListSoal['maks']; ?>
                    <tr>
                        <td class=" serif letter-spacing"><?= ($y + 1) . '.' . $ListSoal['aspek'] ?></td>
                        <td class="text-center serif"><?= $ListSoal['maks'] ?></td>
                        <td class="text-center">...</td>
                    </tr>
                    <?php $y++; ?>
                    <?php
                            endforeach; ?>
                    <td class='text-center letter-spacing serif text-size-6'>NILAI</td>
                    <td class="text-center text-size-5 serif"><?= $jmlIndex; ?></td>
                    <td class="bg-danger"></td>

                    </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan=3 class="bg-warning text-light text-center letter-spacing serif-bold text-size-6">
                            TOTAL
                            NILAI</td>
                        <td class="text-center bg-warning"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <?php } ?>



    <!-- TTD -->
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12 text-right">
                <h2 class="mb-5 serif" style="margin-right:67px">PENILAI</h2>
                <br /><br /><br />
                <div class="float-right " style="width:200px; border:0.2px solid #444;"></div>
            </div>
        </div>
    </div>
    <!-- TTD -->
    </div>
</body>
<?php $this->load->view('Template/Link-js'); ?>