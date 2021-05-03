<?php
$DataDiri = $nama;
if (strlen($DataDiri) > 30)
    $DataDiri = substr($DataDiri, 0, 30) . '..';
$this->load->view('Template/Link-css'); ?>
<title>
    | <?= $DataDiri ?>
</title>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/table-data.css') ?>">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"> -->
<style>
    .dt-buttons button {
        margin-left: 10px;
        margin-top: 10px;
        font-weight: 400;
        color: #212529;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        color: #fff;
        background-color: #206BC4;
        border-color: #206BC4;
    }

    #DTPenilaianPerorangan>tbody>tr:last-child {
        background: #206BC4;
        color: white;
    }
</style>
<?php
$this->load->view('Template/Header');
$this->load->view('Template/SubHeader');
// $this->load->view('Template/TemplateTabs');


if (true) { ?>

    <!-- Table -->
    <section class="container mt-3 px-4">
        <div class="row">
            <div class="col-lg-3">
                <!-- BACK -->
                <a href="<?= base_url('laporanperorangan/' . $this->uri->segment(4)) ?>">
                    <i style="position:absolute; margin-left:-50px; margin-top:10px" class="text-primary fas fa-arrow-circle-left text-size-11"></i>

                </a>
                <!-- BACK -->
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class='w-100 text-center text-light montserrat-600 letter-spacing'>Data Anggota
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center mt-3">
                            <i class="fas fa-user text-muted" style="font-size:150px"></i>
                            <br />
                            <div class="d-flex letter-spacing justify-content-between mt-4">
                                <iv class="montserrat-600" style='font-size:11px;'>NAMA</iv>
                                <div class="text-muted" style="font-size:12px"> <?= $nama ?></div>
                            </div>

                            <div class="d-flex letter-spacing justify-content-between mt-2">
                                <div class="montserrat-600" style='font-size:11px;'>NRP </div>
                                <div class="text-muted" style="font-size:12px"> <b><?= $nrp ?></b>
                                </div>
                            </div>

                            <div class="d-flex letter-spacing justify-content-between mt-2">
                                <div class="montserrat-600" style='font-size:10px;'>Pangkat</div>
                                <div class="text-muted" style="font-size:12px">
                                    <b><?= $pangkat ?></b>
                                </div>
                            </div>

                            <div class="d-flex letter-spacing justify-content-between mt-2">
                                <div class="montserrat-600" style='font-size:10px;'>Jabatan</div>
                                <div class="text-muted" style="font-size:12px">
                                    <b><?= $jabatan ?></b>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header bg-primary d-flex justify-content-between text-center">
                        <div class="w-100">
                            <h3 class="card-title text-light">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="roundr" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <polyline points="9 11 12 14 20 6" />
                                    <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                                Laporan Penilaian</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-striped table-vcenter text-nowrap datatable mb-0 table-sm" id="DTPenilaianPerorangan">
                            <thead>
                                <tr>
                                    <th class="letter-spacing" style="font-size:15px">Ceklist</th>
                                    <th class="letter-spacing" style="font-size:15px">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Table -->
<?php } else { ?>
    <section class="mt-5">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class='montserrat-600 letter-spacing'>Anggota Kosong</h1>
                <div style="font-size:100px">
                    <i class="far fa-user text-muted"></i>
                </div>
                <p class='text-size-5 text-muted montserrat-500 letter-spacing'>Anggota pada kelompok
                    <b><?= $nama_kelompok ?></b>
                    kosong</p>
                <!-- <p class='text-size-5 text-muted montserrat-500 letter-spacing'>silahakan isi <a href="<?= base_url('penilaian/anggota') ?>">disini</a> -->
                </p>
            </div>
        </div>
    </section>
<?php } ?>
<?php $this->load->view('Template/Link-js'); ?>
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
    table = $('#DTPenilaianPerorangan').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ],
        "processing": true,
        "serverSide": true,
        "pageLength": 50,
        "searching": false,
        "paging": false,
        "bInfo": false,
        "ordering": false,
        "ajax": {
            "url": url + router + "getdetail/<?= $this->uri->segment(3) ?>",
            "type": 'POST',
        },
        "columnDefs": [{
                targets: 1,
                className: 'montserrat-600'
            },

        ],
        "language": {
            "lengthMenu": "Menampilkan _MENU_ data per halaman",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "Data belum tersedia",
            "infoFiltered": "(tersaring dari _MAX_ total data)"
        },
        columns: [

            {
                "data": 0
            },
            {
                "data": 1
            }
        ]
    });
    $('.dataTables_wrapper .row:nth-child(3)').addClass("bg-grey px-4 card-footer pb-1").css({
        'padding-top': '10px',
        'margin-top': '-8px'
    })
    $('.dataTables_wrapper .row:nth-child(3) .dataTables_info').addClass("p-0");
    $('.dataTables_wrapper .row:nth-child(3) .dataTables_paginate').addClass("m-0");
    $('table thead tr th:nth-child(1) label span').css('padding', '0px');
</script>