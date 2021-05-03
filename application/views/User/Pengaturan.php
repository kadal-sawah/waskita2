<?php
$this->load->view('Template/Link-css'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/table-data.css') ?>">
<?php
$this->load->view('Template/Header');
$this->load->view('Template/SubHeader'); ?>


<!-- Table -->
<section class="container mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">
                <?= ICON_LENCANA ?>
                Pengaturan </h3>
        </div>
        <form id="formEditUser">
            <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user') ?>">
            <div class="container col-md-6">
                <div class="form-group ">
                    <label class="form-label">Password Baru</label>
                    <input type="password" class="form-control" name="password" placeholder="Password..">
                </div>
            </div>
            <div class="card-footer text-right">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                </div>
            </div>
        </form>

        <!-- <br><br> -->
        <br><br>
    </div>
</section> <!-- /Table -->


<?php $this->load->view('Template/Link-js'); ?>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $("#formEditUser").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: url + router + "updatePassword",
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                disableButton()
            },
            complete: function() {

            },

            success: function(result) {
                enableButton()
                alert("Berhasil Merubah Password")
                clearInput($("input"))
                table.ajax.reload(null, false)

            },
            error: function(event) {
                errorCode(event)
            }
        })
    })
</script>