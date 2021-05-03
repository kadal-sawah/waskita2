<?php
$this->load->view('Template/Link-css'); ?>
<style>
    .h-6 {
        height: 2rem !important;
    }
</style>
</head>

<body class="">
    <div class="page">
        <div class="page-single">
            <div class="container mt-5">
                <br />
                <div class="row">

                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <form class="card" action="<?= base_url('login/aksi') ?>" method="post">
                            <div class="card-body">
                                <div class="card-title montserrat-600 text-size-4 letter-spacing">Login akun</div>
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username"" placeholder=" username">
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">
                                        Password
                                    </label>
                                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                                </div>

                                <div class="form-group mt-2">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" />
                                        <span class="custom-control-label">Remember me</span>
                                    </label>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                    <!-- <a href="?= base_url('/') ?>" class="btn btn-primary btn-block">Masuk</a> -->
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- <div class="text-center text-muted">
                        login sebagai <a href="./register.html">Admin</a>
                    </div> -->
                </div>
            </div>
        </div>
        <?php
        $this->load->view('Template/Link-js'); ?>
</body>

</html>