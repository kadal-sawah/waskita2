<?php
$this->load->view('Template/Link-css'); ?>
<style>
.bg-orange {
    background: orange;
}

.bg-grey {
    background: grey;
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
</style>
<?php
$this->load->view('Template/Header');
$this->load->view('Template/SubHeader');
?>

<?php print_r($CustomProduk); ?>

<body class="">
    <div class="page">

        <div class="container-fluid">
            <?php $this->load->view('Template/TemplateTabs'); ?>
            <div class="row mt-5" id="page-1">
                <div class="col-lg-12">
                    <table class="table-sm table table-bordered">
                        <!-- <thead class='bg-primary text-light' style='border:1px solid #fff;'>
                            <tr>
                                <td rowspan=2 class="text-center montserrat-600">NAMA KELOMPOK</td>
                                <td colspan=12 class="text-center montserrat-600">BOBOT</td>
                                <td rowspan=2 class="text-center montserrat-600">NILAI AKHIR</td>
                                <!-- <td rowspan=2 class="text-center montserrat-600">PERINGKAT</td> -
                            </tr>
                            <tr class="montserrat-600">
                                <td class="bg-orange text-center text-size-4">PRODUK</td>
                                <td class="bg-grey text-center text-size-4 px-3">80%</td>
                                <td class="bg-orange text-center text-size-4">POSKO</td>
                                <td class="bg-grey text-center text-size-4 px-3">20%</td>
                                <td class="bg-orange text-center text-size-4">AKTIVITAS</td>
                                <td class="bg-grey text-center text-size-4 px-3">80%</td>

                                <td class="bg-orange text-center text-size-4">TELEPON</td>
                                <td class="bg-info text-center text-size-4">KONV.TELP</td>
                                <td class="bg-grey text-center text-size-4 px-3">10%</td>

                                <td class="bg-orange text-center text-size-4">TELEGRAM</td>
                                <td class="bg-orange text-center text-size-4 bg-info">KONV.TEL</td>
                                <td class="bg-grey text-center text-size-4 px-3">10%</td>
                            </tr>
                        </thead> -->

                        <thead class='bg-primary text-light' style='border:1px solid #ffff;'>
                            <tr class="montserrat-600 text-center">
                                <td colspan=17 class="bg-gray-dark">GELADI WASKITA DHARMA SESKO TNI TA 2021
                                </td>
                            </tr>
                            <tr class="montserrat-500 text-center">
                                <td rowspan=2 class="bg-azure text-size-3">GRUP</td>
                                <td colspan=6 class="bg-blue text-size-3">PRODUK</td>
                                <td colspan=4 class="bg-indigo text-size-3">AKTIVITAS</td>
                                <td colspan=3 class="bg-purple text-size-3">PAPARAN</td>
                                <td rowspan=2 class="bg-red text-size-3">NILAI AKHIR</td>
                                <td rowspan=2 class="bg-green text-size-3">PERINGKAT</td>
                            </tr>
                            <tr class="montserrat-400 text-center">
                                <td bgcolor="#00b4d8" class="text-size-2 text-dark">&Sigma;Rentinkon</td>
                                <td bgcolor="#caf0f8" class="text-size-2 text-dark">70%</td>
                                <td bgcolor="#ff9e00" class="text-size-2 text-dark">&Sigma;RO</td>
                                <td bgcolor="#ffb600" class="text-size-2 text-dark">30%</td>
                                <td bgcolor="#ff5d8f" class="text-size-2 text-dark">&Sigma; Pro</td>
                                <td bgcolor="#fadde1" class="text-size-2 text-dark">75%</td>
                                <td bgcolor="#70e000" class="text-size-2 text-dark">&Sigma;Kinerja</td>
                                <td bgcolor="#ccff33" class="text-size-2 text-dark">&Sigma;Kerjasama</td>
                                <td bgcolor="#a6a2a2" class="text-size-2 text-dark">&Sigma;Akt</td>
                                <td bgcolor="#cfd2cd" class="text-size-2 text-dark">20%</td>
                                <td bgcolor="#b8c0ff" class="text-size-2 text-dark">&Sigma;Paparan</td>
                                <td bgcolor="#c8b6ff" class="text-size-2 text-dark">&Sigma;Ppr</td>
                                <td bgcolor="#ffd6ff" class="text-size-2 text-dark">5%</td>
                            </tr>
                        </thead>
                        <?php
                        $color = ['#f3722c', '#f8961e', '#f94144', '#90be6d', '#43aa8b',  '#f9c74f', '#577590', '#8338ec', '#3a86ff'];
                        $romawi = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];
                        $x = 0;
                        $i = 0;
                        foreach ($CollectionsKelompok as $list) :
                            $TampungTelepon[] = $list['nilai_telepon'];
                            $TampungTelegram[] = $list['nilai_telegram'];

                            $TampungNilaiAkhir[] = number_format((($list['nilai_produk'] * 0.8) + ($list['nilai_posko'] * 0.2) + ($list['total_aktivitas'] * 0.8)), 2);
                            // $TampungNilaiAkhir[] = number_format((($list['nilai_produk'] * 0.8) + ($list['nilai_posko']/4 * 0.2) + ($list['total_aktivitas'] * 0.8) ) , 2)?>
                        <tr>
                            <td class="text-light montserrat-600 text-size-5" style="background:<?= $color[$x++]; ?>">
                                <?= $list['nama_kelompok']; ?>
                            </td>
                            <td class="bg-yellow text-center montserrat-500 text-size-9">
                                <?php echo number_format($CustomProduk[$i], 3); ?></td>
                            <td class="bg-light text-center montserrat-500 text-size-9 produk80">
                                <?= number_format($CustomProduk[$i] * 0.8, 2); ?></td>
                            <td class="bg-yellow text-center montserrat-500 text-size-9 ">
                                    <!-- <?= number_format($list['nilai_posko'] / 4, 2); ?></td> -->
                                <?= number_format($list['nilai_posko'], 2); ?></td>
                            <td class="bg-light text-center montserrat-500 text-size-9 posko20">
                                    <!-- <?= number_format(($list['nilai_posko'] / 4) * 0.2, 2); ?></td> -->
                                <?= number_format($list['nilai_posko'] * 0.2, 2); ?></td>
                            <td class="bg-yellow text-center montserrat-500 text-size-9">
                                <?= number_format($list['total_aktivitas'], 2); ?></td>
                            <td class="bg-light text-center montserrat-500 text-size-9 aktivitas80">
                                <?= number_format($list['total_aktivitas'] * 0.8, 2); ?></td>

                            <td class="bg-yellow text-center montserrat-500 text-size-9 telepon">
                                <?= number_format($list['nilai_telepon']); ?></td>

                            <td class="bg-primary text-light text-center montserrat-500 text-size-9 convert-telepon">0</td>
                            <td class="bg-light text-center montserrat-500 text-size-9 persen-telepon"></td>

                            <td class="bg-yellow text-center montserrat-500 text-size-9 telegram">
                                <?= number_format($list['nilai_telegram']); ?></td>

                            <td class="bg-primary text-light text-center montserrat-500 text-size-9  convert-telegram">0</td>
                            <td class="bg-light text-center montserrat-500 text-size-9 persen-telegram"></td>
                            <td class="bg-green-light text-center montserrat-500 text-size-9 nilaiakhir"> 0
                            </td>

                        </tr>
                        <?php
                    ++$i;
                    endforeach; ?>

                    </table>
                </div>
            </div>

        </div>

    </div>
</body>
<?php
$HasilTelepon = json_encode($TampungTelepon);
$HasilTelegram = json_encode($TampungTelegram);
$HasilAkhir = json_encode($TampungNilaiAkhir);

$this->load->view('Template/Link-js'); ?>
<script>
const HasilTelepon = JSON.parse('<?= $HasilTelepon; ?>');
const HasilTelegram = JSON.parse('<?= $HasilTelegram; ?>');
const HasilAkhir = JSON.parse('<?= $HasilAkhir; ?>');
// console.log(HasilAkhir);
function ArrToFloat(arr) {
    let tampung = [];
    for (let x = 0; x < arr.length; x++) {
        tampung[x] = parseFloat(arr[x]);
    }
    return tampung;
}

function RankingFloat(arr) {
    let tampungArr = ArrToFloat(arr);
    console.log(tampungArr);
    var sorted = tampungArr.slice().sort(function(a, b) {
        return parseFloat(b) - parseFloat(a)
    })
    var ranks = tampungArr.map(function(v) {
        return sorted.indexOf(v) + 1
    });

    return ranks;

}

function romanize(num) {
    if (isNaN(num))
        return NaN;
    var digits = String(+num).split(""),
        key = ["", "C", "CC", "CCC", "CD", "D", "DC", "DCC", "DCCC", "CM",
            "", "X", "XX", "XXX", "XL", "L", "LX", "LXX", "LXXX", "XC",
            "", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX"
        ],
        roman = "",
        i = 3;
    while (i--)
        roman = (key[+digits.pop() + (i * 10)] || "") + roman;
    return Array(+digits.join("") + 1).join("M") + roman;
}

function Ranking(arr) {
    var sorted = arr.slice().sort(function(a, b) {
        return parseFloat(b) - parseFloat(a)
    })
    var ranks = arr.map(function(v) {
        return sorted.indexOf(v) + 1
    });

    return ranks;
}

const ResultRankingTelepon = Ranking(HasilTelepon);
const ResultRankingTelegram = Ranking(HasilTelegram);
const ResultRankingAkhir = RankingFloat(HasilAkhir);

showRankingTel('convert-telepon', 'persen-telepon', ResultRankingTelepon);
showRankingTel('convert-telegram', 'persen-telegram', ResultRankingTelegram);
showRankingAkhir('convert-akhir', ResultRankingAkhir);

function CONV(numb) {
    let conv = '';
    if (numb == 1)
        conv = 84.9;
    else if (numb == 2)
        conv = 84.7;
    else if (numb == 3)
        conv = 84.5;
    else if (numb == 4)
        conv = 84.3;
    else if (numb == 5)
        conv = 84.1;
    else if (numb == 6)
        conv = 83.9;
    else if (numb == 7)
        conv = 83.7;
    else if (numb == 8)
        conv = 83.5;
    else if (numb == 9)
        conv = 83.3;
    else
        conv = numb;
    return conv;
}
function showRankingTel(name,akhir, arr) {
    const element = $('.' + name);
    const Akhir = $('.' + akhir);

    let romawi = '';
    for (let i = 0; i < element.length; i++) {
        romawi = CONV(arr[i]);
        element.eq(i).text(romawi);
        Akhir.eq(i).text( (romawi * 0.1).toFixed(2) );
    }
}

function showRanking(name, arr) {
    const element = $('.' + name);
    let romawi = '';
    for (let i = 0; i < element.length; i++) {
        romawi = CONV(arr[i]);
        element.eq(i).text(romawi);
    }
}

function showRankingAkhir(name, arr) {
    const element = $('.' + name);
    let romawi = '';
    for (let i = 0; i < arr.length; i++) {
        romawi = romanize(arr[i])
        element.eq(i).text(romawi);
    }
    // console.log(romawi)
    // element.eq(i).text(romawi);
}
let nilAkhir = $('.nilaiakhir');
// let nilAkhir = 0;
let produk80 = $('.produk80'),nilaiproduk = 0;
let posko20 = $('.posko20'), nilaiposko = 0;
let aktivitas = $('.aktivitas80'), nilaiaktivitas = 0;
let telepon = $('.persen-telepon'), nilaitelepon = 0;
let telegram = $('.persen-telegram'), nlaitelegram = 0;

let grandtotal = 0;
// alert(nilAkhir.length);
for(let i = 0; i<nilAkhir.length; i++){
    nilaiproduk = parseFloat(produk80.eq(i).text());
    nilaiposko = parseFloat(posko20.eq(i).text());
    nilaiaktivitas = parseFloat(aktivitas.eq(i).text());
    nilaitelepon = parseFloat(telepon.eq(i).text());
    nilaitelegram = parseFloat(telegram.eq(i).text());
    grandtotal = parseFloat((nilaiproduk + nilaiposko + nilaiaktivitas + nilaitelepon + nilaitelegram) /2).toFixed(2);
    parseFloat(nilAkhir.eq(i).text(grandtotal));
    // alert(nilaiproduk + ' - ' + nilaiposko + ' - ' + nilaiaktivitas + ' - ' + nilaitelepon + ' - ' +nilaitelegram);
}
</script>