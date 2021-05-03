<?php
$this->load->view('Template/Link-css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/table-data.css') ?>">

<?php
$this->load->view('Template/Header');
$this->load->view('Template/SubHeader');
?>

<!-- Content -->
<div class='MYbounce bg-warning'>
    <h4 class="text-center montserrat-600 letter-spacing text-white text-size-5" id='text-selected '
        style="padding: 0; margin: 0;"> <label class="text-center" id='counter-selected'
            style="padding: 0; margin: 0;"></label> Item terpilih
    </h4>
</div>
<!-- /BOUNCE -->

<!-- OPTION -->
<div class="text-center" style="position:relative;">

    <button type="submit" title="Edit" name="action" value='edit' id="fixedbutton"
        class="btn btn-primary btn-sm px-3 py-3"> <i class="text-size-10 fas fa-pencil-alt"></i>
    </button>


    <button onclick="return confirm('Apakah anda yakin, ingin menghapusnya ?')" type="submit" name="action"
        value='hapus' id="fixedbutton2" class="btn btn-primary btn-sm px-3 py-3" title="Hapus"> <i
            class="text-size-10 far fa-trash-alt"></i>
    </button>


</div>
<!-- /OPTION -->


<!-- Table -->
<section class="container-fluid mt-3 px-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin=" <path stroke=" none" d="M0 0h24v24H0z" />
                <polyline points="9 11 12 14 20 6" />
                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                Penilaian Kelompok</h3>

        </div>
        <div class="table-responsive px-3">
            <table class="table card-table table-striped table-vcenter text-nowrap datatable mb-0 table-sm"
                id="DTPenilaianKelompok">
                <thead>
                    <tr>
                        <th class="letter-spacing" style="font-size:13px; width:5%">Nama kelompok</th>
                        <th class="letter-spacing" style="font-size:13px; width:2">Jumlah anggota</th>
                        <th class="letter-spacing" style="font-size:13px; width:3%">Nilai Produk</th>
                        <th class="letter-spacing" style="font-size:13px; width:3%">Nilai Posko</th>
                        <th class="letter-spacing" style="font-size:13px; width:3%">Nilai Telepon</th>
                        <th class="letter-spacing" style="font-size:13px; width:3%">Nilai Telegram</th>
                        <th class="letter-spacing" style="font-size:13px; width:3%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /Table -->

<?php $this->load->view('Template/Link-js'); ?>
<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.bootstrap4.min.js') ?>"></script>
</script>
<script>
$(document).ready(function() {
    $('#DTPenilaianKelompok').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url + router + 'get',
            "type": 'POST'
        },
        "columnDefs": [{
                targets: 1,
                className: 'text-center montserrat-600'
            },
            {
                targets: 2,
                className: 'text-center'
            },
            {
                targets: 0,
                className: 'text-center montserrat-600',
                orderable: false
            }
        ],
    });

    $('.dataTables_wrapper .row:nth-child(3)').addClass("bg-grey px-4 card-footer pb-1").css({
        'padding-top': '10px',
        'margin-top': '-8px'
    })
    $('.dataTables_wrapper .row:nth-child(3) .dataTables_info').addClass("p-0")
    $('.dataTables_wrapper .row:nth-child(3) .dataTables_paginate').addClass("m-0")
    $('table thead tr th:nth-child(1) label span').css('padding', '0px')
    $('label.pure-material-checkbox').css('padding', '0px')
    if (IsMobile() == true) {
        $('#fixedbutton').css('left', "45%")
        $('#fixedbutton2').css('left', "62%")
    }

});
</script>