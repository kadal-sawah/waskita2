<?php
$this->load->view('Template/Link-css'); ?>
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
    border: 1px solid #555;
    margin-top: 20px;
}

table.table-bordered>thead>tr>th {
    border: 1px solid #555;
}

table.table-bordered>tbody>tr>td {
    border: 1px solid #555;
}

table.table-bordered>tfoot>tr>td {
    border: 1px solid #555;
}
table tr td{
    font-family: sans-serif;

}
.serif {
    font-family: sans-serif;
}

.serif-bold {
    font-family: sans-serif;
    font-weight: bold;
}
body{
    font-family: sans-serif;
}
@media print {
    body * {
        visibility: hidden;
    }
    table{
        width:95vw;
    }
    #page-print,
    #page-print * {
        visibility: visible;
    }

    #page-print {
        position: absolute;
        left: 0;
        top: 0;
    }
}

tfoot {page-break-after: always;}
</style>


<body class="">
            <div id="page-print">
                <div style="width:100%">

            <div class="container">
                <h1 class="text-center">PENILAIAN PRODUK</h1>
                <br/><br/>
                <!-- TABLE -->
            <table>
            <tr>
                    <td class="text-size-6">GELADI POSKO</td>
                    <td class="text-size-6">: KRIDAYUDHA</td>
                </tr>
                <tr>
                    <td class="text-size-6">PRODUK</td>
                    <td class="text-size-6">: <?=$nama_ceklis?></td>
                </tr>

            </table>
                <?php $no = 1; 
                foreach($collections as $list): ?>
            <br/>

                <table >


                <tr>
                        <td class="text-size-7"><?=$this->library->numberToRoman($no++).' '.$list['nama_kelompok']?> </td>
                    </tr>

            </table>


                <table class="table table-bordered table-sm" width="100%" border=1>
                    <tr class="text-center bg-dark text-light">
                        <td>NO</td>
                        <td>ASPEK</td>
                        <td>MAKS</td>
                        <td>NILAI</td>
                    </tr>
                    <?php $y=1; $tot = 0; foreach($list['soal'] as $ListSoal): $tot+=$ListSoal['maks']; ?>
                    <tr>
                        <td class="text-center"><?=$y++;?></td>
                        <td><?=$ListSoal['aspek']?></td>
                        <td class="text-center"><?=number_format($ListSoal['maks'],2)?></td>
                        <td></td>

                    </tr>
                    <?php endforeach; ?>
                    <tr class="foot">
                        <td class="text-center serif-bold" colspan=2>NILAI</td>
                        <td class="text-center"><?=number_format($tot,2);?></td>
                        <td></td>
                    </tr>
                </table>
                <?php if($no == 1) { ?>
                <br/><br/><br/><br/><br/><br/><br/><br/><br/>
                <?php }elseif($no == 2){ ?> 
                    <br/><br/><br/><br>
                <?php }elseif($no == 3){ ?> 
                  <br/><br/><br/><br/>    
                    <?php }elseif($no > 3){ ?> 
                        <br/><br/><br/><br/>
                <?php } ?>
                <?php endforeach; ?>
                <!-- /TABLE -->
</div>
                <!-- TTD -->
                <div class="container">
                    <div class="row" style="margin-top:50px">
                        <div class="col-lg-12 text-right">
                            <h2 class="mb-5 serif mr-5"  style="">PENILAI</h2>
                            <br /><br /><br />
                            <div class="float-right " style="width:200px; border:0.2px solid #444;"></div>
                        </div>
                    </div>
                </div>
                <!-- TTD -->
            </div>
            </div></div>
</body>
<?php $this->load->view('Template/Link-js'); ?>
<script>
function PRINT() {
    alert('asd');
    window.print();
}
</script>