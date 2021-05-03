<?php
$this->load->view('Template/Link-css'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/table-data.css') ?>">
<?php
$this->load->view('Template/Header');
$this->load->view('Template/SubHeader'); ?>

<!-- Content -->
<div class='MYbounce bg-warning'>
    <h4 class="text-center montserrat-600 letter-spacing text-white text-size-5" id='text-selected ' style="padding: 0; margin: 0;">
        <label class="text-center" id='counter-selected' style="padding: 0; margin: 0;"></label> Item terpilih
    </h4>
</div>
<!-- /BOUNCE -->

<!-- OPTION -->
<div class="text-center" style="position:relative;">

    <button type="submit" title="Edit" name="action" value='edit' id="fixedbutton" class="btn btn-primary btn-sm px-3 py-3">
        <i class="text-size-10 fas fa-pencil-alt"></i>
    </button>


    <button onclick="return confirm('Apakah anda yakin, ingin menghapusnya ?')" type="submit" name="action" value='hapus' id="fixedbutton2" class="btn btn-primary btn-sm px-3 py-3" title="Hapus">
        <i class="text-size-10 far fa-trash-alt"></i>
    </button>


</div>
<!-- /OPTION -->


<!-- Table -->
<section class="container mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"></path>
                    <rect x="3" y="4" width="18" height="4" rx="2"></rect>
                    <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path>
                    <line x1="10" y1="12" x2="14" y2="12"></line>
                </svg>
                Soal Kelompok</h3>
            <!-- <div class="input-icon">
                <label>Filter tipe ceklis</label>
                <select class="form-select text-muted">
                    <option value="">- Pilih tipe ceklis - &nbsp; &nbsp;</option>
                    <?php foreach ($collections as $list) : ?>
                        <option value="<?= $list['id_ceklis'] ?>"><?= $list['id_ceklis'] . ' - ' . $list['nama_ceklis'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div> -->
            <a href="#" class="btn btn-primary px-2 montserrat-600 letter-spacing py-2" data-toggle="modal" data-target="#modal-simple">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" /></svg>
                Tambah
            </a>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-striped table-vcenter text-nowrap datatable mb-0 table-sm" id="listna">
                <thead>
                    <tr>
                        <th class="letter-spacing text-center" style="width:5%; font-size:15px; text-transform:capitalize">Ceklis
                        </th>
                        <th class="letter-spacing text-center" style="font-size:15px; text-transform:capitalize">Nama
                            Ceklis
                        </th>
                        <th class="letter-spacing text-center" style="font-size:15px; text-transform:capitalize">Aspek
                        </th>
                        <th class="letter-spacing text-center" style="font-size:15px; text-transform:capitalize">Nilai
                            Maks
                        </th>
                        <!-- <th class="letter-spacing text-center" style="font-size:15px; text-transform:capitalize">
                            Tindakan/Macam kegiatan</th> -->
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <circle cx="12" cy="9" r="6" />
                        <polyline points="9 14.2 9 21 12 19 15 21 15 14.2" transform="rotate(-30 12 9)" />
                        <polyline points="9 14.2 9 21 12 19 15 21 15 14.2" transform="rotate(30 12 9)" /></svg>
                    Tambah Soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" /></svg>
                </button>
            </div>
            <div class="modal-body my-1">
                <!-- Content -->
                <form id="formAddSoal">
                    <div class="row">

                        <!-- Nama Pangkat -->
                        <div class="col-lg-2"></div>
                        <div class="col-lg-12">
                            <div class="input-icon">
                                <label>Filter tipe ceklis</label>
                                <select name="id_ceklis" class="form-select text-muted">
                                    <option value="">- Pilih tipe ceklis - &nbsp; &nbsp;</option>
                                    <?php foreach ($collections as $list) : ?>
                                        <option value="<?= $list['id_ceklis'] ?>">
                                            <?= $list['id_ceklis'] . ' - ' . $list['nama_ceklis'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-icon">
                                <label>Tipe</label>
                                <select name="tipe_nilai" class="form-select text-muted">
                                    <option value="">- Pilih tipe ceklis - &nbsp; &nbsp;</option>
                                    <option value="1"> Penilaian Produk</option>
                                    <option value="2"> Penilaian Telegram</option>
                                    <option value="3"> Penilaian Telepon</option>
                                    <option value="4"> Penilaian Posko</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">aspek Add</label>
                            <!-- <input type="text" class="form-control" name="aspek" placeholder="Aspek" required> -->
                            <textarea class="form-control" name="aspek" cols="30" rows="10"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Nilai Maksimal</label>
                            <input type="text" class="form-control" name="maks" placeholder="Nilai Maksimal" required>
                        </div>
                        <!-- <div class="col-lg-12">
                            <label class="form-label">Tindakan Macam</label>
                            <input type="text" class="form-control" name="tindakan_macam" placeholder="Tindakan Macam" required>
                        </div> -->
                        <!-- /Nama Pangkat -->

                    </div>
                    <!-- /Content -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"></path>
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                        <circle cx="12" cy="14" r="2"></circle>
                        <polyline points="14 4 14 8 8 8 8 4"></polyline>
                    </svg>
                    Simpan
                </button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <circle cx="12" cy="9" r="6" />
                        <polyline points="9 14.2 9 21 12 19 15 21 15 14.2" transform="rotate(-30 12 9)" />
                        <polyline points="9 14.2 9 21 12 19 15 21 15 14.2" transform="rotate(30 12 9)" /></svg>
                    Edit Soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" /></svg>
                </button>
            </div>
            <div class="modal-body my-1">
                <!-- Content -->
                <form id="formEditSoal">
                    <div class="row">

                        <!-- Nama Pangkat -->
                        <div class="col-lg-2"></div>
                        <div class="col-lg-12">
                            <div class="input-icon">
                                <label>Filter tipe ceklis</label>
                                <select name="id_ceklis" id="id_ceklis1" class="form-select text-muted">
                                    <option value="">- Pilih tipe ceklis - &nbsp; &nbsp;</option>
                                    <?php foreach ($collections as $list) : ?>
                                        <option value="<?= $list['id_ceklis'] ?>">
                                            <?= $list['id_ceklis'] . ' - ' . $list['nama_ceklis'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-icon">
                                <label>Tipe</label>
                                <select name="tipe_nilai" id="tipeNilai" class="form-select text-muted">
                                    <option value="">- Pilih tipe ceklis - &nbsp; &nbsp;</option>
                                    <option value="1"> Penilaian Produk</option>
                                    <option value="2"> Penilaian Telegram</option>
                                    <option value="3"> Penilaian Telepon</option>
                                    <option value="4"> Penilaian Posko</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="id_soal_kelompok" id="idData" required>

                        <div class="col-lg-12">
                            <label class="form-label">aspek</label>
                            <!-- <input type="text" class="form-control" name="aspek" id="aspek2" placeholder="Aspek" required> -->
                            <textarea name="aspek" class="form-control" id="aspek1" cols="30" rows="10"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Nilai Maksimal</label>
                            <input type="text" class="form-control" name="maks" id="maks1" placeholder="Nilai Maksimal" required>
                        </div>
                        <!-- <div class="col-lg-12">
                            <label class="form-label">Tindakan Macam</label>
                            <input type="text" class="form-control" name="tindakan_macam" placeholder="Tindakan Macam" required>
                        </div> -->
                        <!-- /Nama Pangkat -->

                    </div>
                    <!-- /Content -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"></path>
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                        <circle cx="12" cy="14" r="2"></circle>
                        <polyline points="14 4 14 8 8 8 8 4"></polyline>
                    </svg>
                    Simpan
                </button>
            </div>
            </form>
        </div>
    </div>
</div>


<?php $this->load->view('Template/Link-js'); ?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
</script>
<script>
    $(document).ready(function() {

        // CKEDITOR.replace('aspek1', {
        //     height: 100,
        // });
        // CKEDITOR.replace('aspek2', {
        //     height: 100,
        // });

        table = $('#listna').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": url + router + 'get',
                'type': 'POST'
            },
            "columnDefs": [{
                    targets: 1,
                    className: 'text-center montserrat-600'
                },
                {
                    targets: 0,
                    orderable: false
                },
                {
                    targets: 2,
                    className: 'text-center'
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

    $("#formAddSoal").submit(function(e) {
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

    $("#formEditSoal").submit(function(e) {
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

    $('#listna').on('click', '#edit', function() {
        let id = $(this).data('id');
        // alert(id)
        $.ajax({
            url: url + router + 'getData/' + id,
            type: "GET",
            success: function(result) {
                response = JSON.parse(result)
                $("#idData").val(response.id_soal_kelompok)
                $("#id_ceklis1").val(response.id_ceklis).change()
                $("#aspek1").val(response.aspek)
                $("#tipeNilai").val(response.tipe_nilai).change()
                // CKEDITOR.instances.aspek2.setData(response.aspek);
                $("#maks1").val(response.maks)
                $("#modal-edit").modal('show')
            },
            error: function(error) {
                errorCode(error)
            }
        })
    })

    $('#listna').on('click', '#delete', function() {
        // alert('sss')
        let id = $(this).data('id');
        // alert(id)
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