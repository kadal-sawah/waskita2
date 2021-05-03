<?php
$this->load->view('Template/Link-css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/table-data.css') ?>">
<?php
$this->load->view('Template/Header');
$this->load->view('Template/SubHeader'); ?>

<!-- Content -->
<div class='MYbounce bg-warning'>
    <h4 class="text-center montserrat-600 letter-spacing text-white text-size-5" id='text-selected '
        style="padding: 0; margin: 0;">
        <label class="text-center" id='counter-selected' style="padding: 0; margin: 0;"></label> Item terpilih
    </h4>
</div>
<!-- /BOUNCE -->

<!-- OPTION -->
<div class="text-center" style="position:relative;">

    <button type="submit" title="Edit" name="action" value='edit' id="fixedbutton"
        class="btn btn-primary btn-sm px-3 py-3">
        <i class="text-size-10 fas fa-pencil-alt"></i>
    </button>


    <button onclick="return confirm('Apakah anda yakin, ingin menghapusnya ?')" type="submit" name="action"
        value='hapus' id="fixedbutton2" class="btn btn-primary btn-sm px-3 py-3" title="Hapus">
        <i class="text-size-10 far fa-trash-alt"></i>
    </button>


</div>
<!-- /OPTION -->


<!-- Table -->
<section class="container mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">
                <?= ICON_LENCANA ?>
                Ceklis</h3>
            <a href="#" class="btn btn-primary px-2 montserrat-600 letter-spacing py-2" data-toggle="modal"
                data-target="#modal-simple">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" /></svg>
                Tambah
            </a>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-striped table-vcenter text-nowrap datatable mb-0 table-sm"
                id="DTCeklis">
                <thead>
                    <tr>
                        <th class="letter-spacing text-center" style="font-size:15px; text-transform:capitalize">Id
                            Ceklis</th>
                        <th class="letter-spacing text-center" style="font-size:15px; text-transform:capitalize">Nama
                            Ceklis</th>
                        <th class="letter-spacing text-center" style="font-size:15px; text-transform:capitalize">
                            Aksi</th>
                    </tr>

                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /Table -->


<!-- Modal -->
<div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <?= ICON_LENCANA ?>
                    Tambah Ceklis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <?= ICON_CLOSE ?>
                </button>
            </div>
            <div class="modal-body my-1">
                <!-- Content -->
                <form id="formAddCeklis">
                    <div class="row">

                        <!-- Nama Ceklis -->
                        <div class="col-lg-2"></div>
                        <div class="col-lg-12">
                            <label class="form-label">Id Ceklis</label>
                            <input type="text" class="form-control" name="id_ceklis" placeholder="ID Ceklis" required>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Nama Ceklis</label>
                            <input type="text" class="form-control" name="nama_ceklis" placeholder="Nama Ceklis"
                                required>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Kategori Ceklis</label>
                            <select name="tipe" class="form-control" id="">
                                <option value="1">Penilaian Produk</option>
                                <option value="2">Penilaian Telegram</option>
                                <option value="3">Penilaian Telepon</option>
                                <option value="4">Penilaian Posko</option>
                                <option value="5">Penilaian Peroranggan</option>
                            </select>
                        </div>
                        <!-- /Nama Ceklis -->

                    </div>
                    <!-- /Content -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    <?= ICON_SAVE ?>
                    Simpan
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <?= ICON_LENCANA ?>
                    Tambah Ceklis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <?= ICON_CLOSE ?>
                </button>
            </div>
            <div class="modal-body my-1">
                <!-- Content -->
                <form id="formEditCeklis">
                    <div class="row">

                        <!-- Nama Ceklis -->
                        <div class="col-lg-2"></div>
                        <input type="hidden" name="id_ceklis" id="idData">
                        <div class="col-lg-12">
                            <label class="form-label">Nama Ceklis</label>
                            <input type="text" class="form-control" name="nama_ceklis" id="nama_ceklis"
                                placeholder="Nama Ceklis" required>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Kategori Ceklis</label>
                            <select name="tipe" class="form-control" id="tipe">
                                <option value="1">Penilaian Produk</option>
                                <option value="2">Penilaian Telegram</option>
                                <option value="3">Penilaian Telepon</option>
                                <option value="4">Penilaian Posko</option>
                                <option value="5">Penilaian Peroranggan</option>
                            </select>
                        </div>
                        <!-- /Nama Ceklis -->

                    </div>
                    <!-- /Content -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    <?= ICON_SAVE ?>
                    Simpan
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('Template/Link-js'); ?>
<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/DataKelompok.js') ?>"></script>
<script>
$(document).ready(function() {
    table = $('#DTCeklis').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url + router + 'get',
            'type': 'POST'
        },
        "columnDefs": [{
                targets: 0,
                className: ' montserrat-600'
            },
            {
                sClass: "text-center",
                targets: 2,
                orderable: false
            }
        ]
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


$("#formAddCeklis").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: url + router + "store",
        type: "post",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function() {
            disableButton()
        },
        complete: function() {
            enableButton()
        },
        success: function(result) {
            let response = JSON.parse(result)
            if (response.status == "fail") {
                pesan_error('Gagal', response.msg)
            } else {
                table.ajax.reload(null, false)
                pesan_sukses('Sukses', response.msg)
                clearInput($("input"))
            }
        },
        error: function(event) {
            errorCode(event)
        }
    })
})

$("#formEditCeklis").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: url + router + "update",
        type: "post",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function() {
            disableButton()
        },
        complete: function() {
            enableButton()
        },
        success: function(result) {
            let response = JSON.parse(result)
            if (response.status == "fail") {
                pesan_error('Gagal', response.msg)
            } else {
                table.ajax.reload(null, false)
                pesan_sukses('Sukses', response.msg)
                clearInput($("input"))
                $("#modal-edit").modal('hide')
            }
        },
        error: function(event) {
            errorCode(event)
        }
    })
})

$('#DTCeklis').on('click', '#edit', function() {
    let id = $(this).data('id');
    $.ajax({
        url: url + router + 'getData/' + id,
        type: "GET",
        success: function(result) {
            response = JSON.parse(result)
            $("#idData").val(response.id_ceklis)
            $("#id_ceklis").val(response.id_ceklis)
            $("#tipe").val(response.tipe)
            $("#nama_ceklis").val(response.nama_ceklis)
            $("#modal-edit").modal('show')
        },
        error: function(error) {
            errorCode(error)
        }
    })
})

$('#DTCeklis').on('click', '#delete', function() {
    let id = $(this).data('id');
    if (confirm("Yakin akan menghapus data ?")) {
        $.ajax({
            url: url + router + 'delete/' + id,
            type: "GET",
            success: function(result) {
                response = JSON.parse(result)
                if (response.status == 'ok') {
                    table.ajax.reload(null, false)
                    // msgSweetSuccess(response.msg)
                    pesan_sukses('Sukses', response.msg)
                } else {
                    // msgSweetWarning(response.msg)
                    pesan_warning('Warning', response.msg)
                }
            },
            error: function(error) {
                errorCode(error)
            }
        })
    }
})
</script>