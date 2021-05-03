<?php
$this->load->view('Template/Link-css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css') ?>">
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
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <circle cx="12" cy="7" r="4" />
                    <path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2" /></svg>
                Anggota</h3>
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
                    <th class="letter-spacing" style="font-size:15px">NRP</th>
                    <th class="letter-spacing" style="font-size:15px">Nama</th>
                    <th class="letter-spacing" style="font-size:15px">Pangkat</th>
                    <th class="letter-spacing" style="font-size:15px">Jabatan</th>
                    <th class="letter-spacing" style="font-size:15px">Aksi</th>
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
        <form id="addAnggota">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <circle cx="12" cy="7" r="4" />
                            <path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2" /></svg>
                        Tambah Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" /></svg>
                    </button>
                </div>
                <div class="modal-body my-3">

                    <!-- Content -->
                    <div class="row">

                        <!-- NRP -->
                        <div class="col-lg-6">
                            <label class="form-label">NRP</label>
                            <input type="text" class="form-control" name="nrp" placeholder="11960035271653">
                        </div>
                        <!-- /NRP -->

                        <!-- Nama Anggota -->
                        <div class="col-lg-6">
                            <label class="form-label">Nama anggota</label>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <circle cx="12" cy="7" r="4" />
                                        <path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2" /></svg>
                                </span>
                                <input type="text" class="form-control" placeholder="Hilman Basuki" name="nama">
                            </div>
                        </div>
                        <!-- /Nama Anggota -->
                    </div>

                    <div class="row">
                        <!-- Pangkat -->
                        <div class="col-lg-6">
                            <div class="input-icon mb-3">
                                <div class="form-label">Pangkat</div>
                                <select name="id_pangkat" class="form-select">
                                    <option value="">- Pilih pangkat -</option>
                                    <?php foreach ($ref['pangkat'] as $list) : ?>
                                        <option value="<?= $list->id_pangkat ?>"><?= $list->nama_pangkat ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-icon mb-3">
                                <div class="form-label">Kelompok</div>
                                <select name="id_kelompok" class="form-select">
                                    <option value="">- Pilih Kelompok -</option>
                                    <?php foreach ($ref['kelompok'] as $list) : ?>
                                        <option value="<?= $list->id_kelompok ?>"><?= $list->nama_kelompok ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-icon mb-3">
                                <div class="form-label">Jabatan</div>
                                <select name="id_jabatan" class="form-select">
                                    <option value="">- Pilih jabatan -</option>
                                    <?php foreach ($ref['jabatan'] as $list) : ?>
                                        <option value="<?= $list->id_jabatan ?>"><?= $list->nama_jabatan ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- /Pangkat -->

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
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="EditAnggota">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <circle cx="12" cy="7" r="4" />
                            <path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2" /></svg>
                        Edit Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" /></svg>
                    </button>
                </div>
                <div class="modal-body my-3">

                    <!-- Content -->
                    <div class="row">

                        <!-- id anggota -->
                        <input type="hidden" class="form-control" name="id_anggota" placeholder="11960035271653" id="idData">
                        <!-- NRP -->
                        <div class="col-lg-6">
                            <label class="form-label">NRP</label>
                            <input type="text" class="form-control" name="nrp" placeholder="11960035271653" id="nrp1">
                        </div>
                        <!-- /NRP -->

                        <!-- Nama Anggota -->
                        <div class="col-lg-6">
                            <label class="form-label">Nama anggota</label>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <circle cx="12" cy="7" r="4" />
                                        <path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2" /></svg>
                                </span>
                                <input type="text" class="form-control" placeholder="Hilman Basuki" name="nama" id="nama1">
                            </div>
                        </div>
                        <!-- /Nama Anggota -->
                    </div>

                    <div class="row">
                        <!-- Pangkat -->
                        <div class="col-lg-6">
                            <div class="input-icon mb-3">
                                <div class="form-label">Pangkat</div>
                                <select name="id_pangkat" id="id_pangkat1" class="form-select">
                                    <option value="">- Pilih pangkat -</option>
                                    <?php foreach ($ref['pangkat'] as $list) : ?>
                                        <option value="<?= $list->id_pangkat ?>"><?= $list->nama_pangkat ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-icon mb-3">
                                <div class="form-label">Kelompok</div>
                                <select name="id_kelompok" id="id_kelompok1" class="form-select">
                                    <option value="">- Pilih Kelompok -</option>
                                    <?php foreach ($ref['kelompok'] as $list) : ?>
                                        <option value="<?= $list->id_kelompok ?>"><?= $list->nama_kelompok ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-icon mb-3">
                                <div class="form-label">Jabatan</div>
                                <select name="id_jabatan" id="id_jabatan1" class="form-select">
                                    <option value="">- Pilih jabatan -</option>
                                    <?php foreach ($ref['jabatan'] as $list) : ?>
                                        <option value="<?= $list->id_jabatan ?>"><?= $list->nama_jabatan ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- /Pangkat -->

                    </div>
                    <!-- /Content -->

                </div>
                <div class="modal-footer"></div>
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
    </div>
    </form>
</div>
</div>


<?php $this->load->view('Template/Link-js'); ?>
<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.bootstrap4.min.js') ?>"></script>
<!-- <script src="<?= base_url('assets/js/DataAnggota.js') ?>"></script> -->
<script>
    $(document).ready(function() {
        table = $('#listna').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": url + router + 'get',
                'type': 'POST'
            },
            "columnDefs": [{
                    targets: 3,
                    className: 'text-center montserrat-600'
                },
                {
                    targets: 0,
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
    $("#addAnggota").submit(function(e) {
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

    $("#EditAnggota").submit(function(e) {
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
        $.ajax({
            url: url + router + 'getData/' + id,
            type: "GET",
            success: function(result) {
                response = JSON.parse(result)
                console.log(response.nama_pangkat);
                $("#idData").val(response.id_anggota)
                $("#nrp1").val(response.nrp)
                $("#nama1").val(response.nama)
                $("#id_pangkat1").val(response.id_pangkat).change();
                $("#id_kelompok1").val(response.id_kelompok).change();
                $("#id_jabatan1").val(response.id_jabatan).change();
                $("#modal-edit").modal('show')

            },
            error: function(error) {
                errorCode(error)
            }
        })
    })



    $('#listna').on('click', '#delete', function() {
        let id = $(this).data('id');
        if (confirm("Yakin akan menghapus data ?" + id)) {
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


    $('#listna').on('click', '#reset', function() {
        let id = $(this).data('id');
        // alert(id)
        if (confirm("Kata sandi akan di Reset ke Awal")) {
            $.ajax({
                url: url + router + 'set/' + id + '/reset',
                // url: baseUrl + 'admin/user/upk/set/' + id + "/reset",
                type: "GET",
                success: function(result) {
                    response = JSON.parse(result)
                    if (response.status == 'ok') {
                        table.ajax.reload(null, false)
                        // msgSweetSuccess(response.msg)
                        toastSuccess(response.msg)
                    } else {
                        // msgSweetWarning(response.msg)
                        toastWarning(response.msg)
                    }
                },
                error: function(error) {
                    errorCode(error)
                }
            })
        }
    })
</script>