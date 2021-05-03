var Base64 = { _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=", encode: function (e) { var r, t, a, n, o, c, s, i = "", u = 0; for (e = Base64._utf8_encode(e); u < e.length;)n = (r = e.charCodeAt(u++)) >> 2, o = (3 & r) << 4 | (t = e.charCodeAt(u++)) >> 4, c = (15 & t) << 2 | (a = e.charCodeAt(u++)) >> 6, s = 63 & a, isNaN(t) ? c = s = 64 : isNaN(a) && (s = 64), i = i + this._keyStr.charAt(n) + this._keyStr.charAt(o) + this._keyStr.charAt(c) + this._keyStr.charAt(s); return i }, decode: function (e) { var r, t, a, n, o, c, s = "", i = 0; for (e = e.replace(/[^A-Za-z0-9\+\/\=]/g, ""); i < e.length;)r = this._keyStr.indexOf(e.charAt(i++)) << 2 | (n = this._keyStr.indexOf(e.charAt(i++))) >> 4, t = (15 & n) << 4 | (o = this._keyStr.indexOf(e.charAt(i++))) >> 2, a = (3 & o) << 6 | (c = this._keyStr.indexOf(e.charAt(i++))), s += String.fromCharCode(r), 64 != o && (s += String.fromCharCode(t)), 64 != c && (s += String.fromCharCode(a)); return s = Base64._utf8_decode(s) }, _utf8_encode: function (e) { e = e.replace(/\r\n/g, "\n"); for (var r = "", t = 0; t < e.length; t++) { var a = e.charCodeAt(t); a < 128 ? r += String.fromCharCode(a) : a > 127 && a < 2048 ? (r += String.fromCharCode(a >> 6 | 192), r += String.fromCharCode(63 & a | 128)) : (r += String.fromCharCode(a >> 12 | 224), r += String.fromCharCode(a >> 6 & 63 | 128), r += String.fromCharCode(63 & a | 128)) } return r }, _utf8_decode: function (e) { for (var r = "", t = 0, a = c1 = c2 = 0; t < e.length;)(a = e.charCodeAt(t)) < 128 ? (r += String.fromCharCode(a), t++) : a > 191 && a < 224 ? (c2 = e.charCodeAt(t + 1), r += String.fromCharCode((31 & a) << 6 | 63 & c2), t += 2) : (c2 = e.charCodeAt(t + 1), c3 = e.charCodeAt(t + 2), r += String.fromCharCode((15 & a) << 12 | (63 & c2) << 6 | 63 & c3), t += 3); return r } };
function Encode(e, r = 7) { let t = []; for (let a = 0; a < r; a++)0 == t.length ? t[a] = Base64.encode(e.toString()) : t[a] = Base64.encode(t[a - 1].toString()); return t[t.length - 1].replace(/=/g, "") } function Decode(e, r, t = "") { $tampung = []; for (let t = 0; t < r; t++)0 == tampung.length ? tampung[t] = Base64.decode(e) : tampung[t] = Base64.decode(tampung[t - 1]); return tampung[tampung.length - 1].replace(/=/g, "") }
function LoadingButton(type, text, name = 'save') {
    const button = "button[name=" + name + "]";
    if (type == 'on') {
        $(button).html("<span style='font-size:24px;' class='spinner-border spinner-border-md' role='status' aria-hidden='true'></span> " + text)
        $(button).attr('disabled', 'true');
    }
    else if (type == 'off') {
        $(button).html(text)
        $(button).removeAttr('disabled');
    }

}
function IconSave(size = 'text-size-4') {
    return "<i class='fas fa-save " + size + "'></i>";
}

$('select[name=kelompok]').change(function () {
    $('select[name=penilaian]').val('');
})
function sumnilai(val, indeks, that) {
    const data = $('.nilai');
    let TampungNilai = 0;
    for (let i = 0; i < data.length; i++) {
        if (!isNaN(parseFloat(data.eq(i).val())))
            TampungNilai += parseFloat(data.eq(i).val());
    }

    $('#total_nilai').html(TampungNilai)
    if (val > indeks || val < 0) {
        pesan_warning('Pesan', 'nilai melebihi <b>MAKS</b>');
        that.value = 0;
    }

}

$('select[name=penilaian]').change(function (evt) {
    const val = $(this).val();
    $('#show').html('');
    if (val == '') return false;
    $('#show').html(
        "<br/> <div class='text-muted text-center'><span class='spinner-border spinner-border-md' role='status' aria-hidden='true'></span> Mencari dokumen</div>"
    );

    if (val == 'Aktivitas') {
        const kelompok = $('select[name=kelompok]').val();
        $.ajax({
            url: url + router + 'ajaxaktivitas',
            type: 'GET',
            data: {
                'tipe_ceklis': 5,
                'id_kelompok': kelompok
            },
            success: function (result) {
                const parse = JSON.parse(result);
                // console.log(parse);
                if (parse.CountSoal > 0) {
                    showProdukAktivitas(parse, parse.CountSoal);
                } else {
                    pesan_warning('Pesan', 'sedang terjadi masalah');
                }

            }
        })
    } else if (val == 'Posko') {

        $.ajax({
            url: url + router + 'ajaxposko',
            data: {
                'tipe_ceklis': 4,
                'kelompok': $('#kelompok').val(),
                'penilaian' : $('#penilaian').val(),
            },
            
            type: 'GET',
            success: function (result) {
                $('#input-ceklis').css('display', 'none');
                const parse = JSON.parse(result);
                // console.log(parse);
                if (parse.CountSoal > 0) {
                    showPoskoProduk(parse, parse.CountSoal, 'posko');
                } else {
                    pesan_warning('Pesan', 'sedang terjadi masalah');
                }

            }
        })
    } else if (val == 'Produk') {
        $.ajax({
            url: url + router + 'ajaxproduk',
            type: 'GET',
            data: {
                'tipe_ceklis': 1,
                // 'kelompok': kelompok,
                'id_kelompok': $('#kelompok').val(),
                'penilaian' : $('#penilaian').val(),
            },
            success: function (result) {
                const parse = JSON.parse(result);
                // console.log(parse);
                if (parse.CountSoal > 0) {
                    showPoskoProduk(parse, parse.CountSoal, 'produk');
                } else {
                    pesan_warning('Pesan', 'sedang terjadi masalah');
                }

            }
        })
    } else if (val == 'TelTel') {
        getTeleponTelegram($('#kelompok').val());
    }
})

function getTeleponTelegram(kelompok) {
    $.ajax({
        url: url + router + 'getTeleponTelegram',
        data: { 'kelompok': kelompok },
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            ShowTeleponTelegram(result);
        }
    });
}

function showPoskoProduk(data, count, tipe = 'posko') {
    // console.log(data['edit']);
    // var tipe = tipe;
    // if(tipe = 'posko');
    const source = data.CollectionsCeklis;
    let html = "";
    let Total = 0;
    html += "<div id='accordion' class='mt-4'>";
    let CEKLIS = 1;
    let Edit = data.edit;
    let EditTotal = [];
    // var date = 
    for (let i = 0; i < count; i++) {

        html += "<form action='" + url + router + 'penilaiankelompok/storeposkoproduk' + "' class='storeposkoproduk'>";
        html += "<div class='card' style='border-radius:0px; border:0px solid transparent; margin:0px;'>";
        html += "<a style='margin:0px; padding:0px;' href='#' onclick='event.preventDefault()' class='btn m-0 btn-link coleps on' data-toggle='collapse' data-target='#collapse" + i + "' aria-expanded='true'>";
        html += "<div class='card-header col-lg-12 text-light bg-dark text-center d-flex justify-content-between montserrat-600 letter-spacing text-size-7' id='headingOne' data-target='#collapse" + i + "' style='margin:0px;'> <span class='text-size-7'><i class='fas fa-chevron-up icon-down text-size-4'></i> "
        html += "CP" + (CEKLIS++) + ' - ' + source[i].nama_ceklis + "</span> <span class='total-nilai-accordion'>0</span></div></a>";

        html += "<div id='collapse" + i + "' class='collapse cus " + (i == 0 ? 'show' : '') + "' style='margin:0px;' aria-labelledby='headingOne'>";
        html += "<div class='card-body'>";

        html += "<table border=1 cellpadding=3 class='table table-bordered table-striped'>";
        html += "<tr>";
        html += "<th width=2% class='text-center'>NO</th>";
        html += "<th width=40%>ASPEK YANG DINILAI</th>";
        html += "<th width=2%>MAKS</th>";
        html += "<th width=10% class='text-center'>NILAI</th>";
        html += "</tr>";
        JmlIndeks = 0;
        Total = 0;
        for (let y = 0; y < source[i].soal.length; y++) {
            JmlIndeks += parseFloat(source[i].soal[y].maks);
            if (data.CountEdit > 0 && typeof Edit[source[i].id_ceklis] != 'undefined') {
                Total += parseFloat(Edit[source[i].id_ceklis][y]['nilai']);

            }
            html += "<tr>";
            html += "<td>" + (y + 1) + "</td>";
            html += "<td>" + source[i].soal[y].aspek + "</td>";
            html += "<td>" + source[i].soal[y].maks + "</td>";
            html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                "' value='" + (data.CountEdit > 0 && typeof Edit[source[i].id_ceklis] != 'undefined' ? (Edit[source[i].id_ceklis][y]['nilai']) : '') + "' name='nilai[" + source[i].id_ceklis + "][" + (source[i].soal[y].id_soal_kelompok) + "]' class='form-control nilai_" + (i) + "' value='' placeholder='Nilai' onchange='TotalNilai(this, " + (i) + ", " + (i) + ")'></td>";
            html += "</tr>";
        }
        EditTotal[i] = Total;
        html += "<tfoot>";
        html += "<tr>";
        html += "<th colspan=2 class='text-center montserrat-600'>NILAI</th>";
        html += "<th class='text-center montserrat-600'>" + (JmlIndeks) + "</th>";
        html += "<th class='text-center bg-danger text-light montserrat-600 total_nilai'>" + (Total != 0 ?
            Total.toFixed(2) : 0) + "</th>";
        html += "</tr>";
        html += "</tfoot> </table>";
        html += "<button class='btn text-light btn-primary btn-block mb-3 btn-produk' type='submit'>" + IconSave() + "&nbsp; SIMPAN NILAI </button>";

        html += "</div></div></div></form>";

    }
    // getTeleponTelegram();
    html += "</div>";
    $('#show').html(html);
    let total = $('.total-nilai-accordion');
    for (let i = 0; i < total.length; i++) {
        $('.total-nilai-accordion').eq(i).text(EditTotal[i].toFixed(2));
    }
    $('.coleps').click(function (evt) {
        evt.stopPropagation();
        const index = $('.coleps').index(this);
        onoff(index);
    });

    // panglima kas store
    $('.storeposkoproduk').submit(function (evt) {
        evt.preventDefault();
        const index = $('.btn-produk').index(this);
        $('.btn-produk').eq(index).prop('disabled', "true");
        $('.btn-produk').eq(index).html(IconLoading(' &nbsp; TUNGGU SEBENTAR'));
        let GetData = new FormData(this);
        GetData.append('kelompok', $('#kelompok').val());
        GetData.append('penilaian', $('#penilaian').val());

        $.ajax({
            url: url + router + 'storeposko',
            data: GetData,
            type: 'POST',
            processData: false,
            contentType: false,
            success: function (result) {
                const parse = JSON.parse(result);
                if (parse.status == 200) {
                    pesan_sukses('Pesan', parse.message);
                } else {
                    pesan_warning('Pesan', parse.message);
                }
                $('.btn-produk').eq(index).removeAttr('disabled');
                $('.btn-produk').eq(index).html(IconSave() + '&nbsp; SIMPAN NILAI');


            }
        })
    })


}

function CekNilai(index) {
    const cek = $('.total_nilai').eq(index);
    if (cek.length > 0) {

        if (parseFloat(cek.text()) <= 0)
            return false;

        return true;
    }
    return false;
}

function TotalNilai(that, index, indexceklis, countjabatan, jmlanggota = 1) {
    const nilai = parseFloat(that.value);
    const max = parseFloat(that.max);
    const Class = $(that)[0].classList[1];
    const data = $('.' + Class);
    let TampungNilai = 0;
    for (let i = 0; i < data.length; i++) {
        if (!isNaN(parseFloat(data.eq(i).val())))
            TampungNilai += parseFloat(data.eq(i).val());
    }
    // console.log(typeof (nilai))
    if (nilai > max || nilai < 0) {
        pesan_warning('Pesan', 'Nilai melebihi nilai Maksimal');
        that.value = 0;
    } else {
        $('.total_nilai').eq(index).text(TampungNilai.toFixed(2))
        $('.total-nilai-accordion').eq(indexceklis).text(TampungNilai.toFixed(2))
    }
    // alert("TOTNIL : " + indexroot);

    TotalNilaiAktivitas(jmlanggota);

}

function TotalNilaiPanglima(that, index, indexceklis, countjabatan, jmlanggota = 1) {
    const nilai = parseFloat(that.value);
    const max = parseFloat(that.max);
    const Class = $(that)[0].classList[1];
    const data = $('.' + Class);
    let TampungNilai = 0;
    for (let i = 0; i < data.length; i++) {
        if (!isNaN(parseFloat(data.eq(i).val())))
            TampungNilai += parseFloat(data.eq(i).val());
    }
    // console.log(typeof (nilai))
    if (nilai > max || nilai < 0) {
        pesan_warning('Pesan', 'Nilai melebihi nilai Maksimal');
        that.value = 0;
    } else {
        $('.total_nilai').eq(index).text(TampungNilai.toFixed(2))
        $('.total-nilai-accordion').eq(indexceklis).text(TampungNilai.toFixed(2))
    }
    // alert("TOTNIL : " + indexroot);

}

function TotalNilaiAsisten(that, indexratarata, indexasisten, indexcekklis, indextotal, countjabatan, jmlanggota = 1) {
    // alert(indexroot);
    const nilai = parseFloat(that.value);
    const max = parseFloat(that.max);
    const Class = $(that)[0].classList[1];
    const data = $('.' + Class);
    let TampungNilai = 0;
    for (let i = 0; i < data.length; i++) {
        if (!isNaN(parseFloat(data.eq(i).val())))
            TampungNilai += parseFloat(data.eq(i).val());
    }
    if (nilai > max || nilai < 0) {
        pesan_warning('Pesan', 'Nilai melebihi nilai Maksimal');
        that.value = 0;
    } else
        $('.total_nilai').eq(indextotal).html(TampungNilai.toFixed(2));

    RataRata = (parseFloat($('.total_nilai').eq(indexasisten).text()) + parseFloat($('.total_nilai').eq(indexasisten + 1).text())) / 2;
    if (countjabatan == 2) {
        if (CekNilai(indexasisten) == false || CekNilai(indexasisten + 1) == false)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten).text()) + parseFloat($('.total_nilai').eq(indexasisten + 1).text()));
    } else if (countjabatan == 3) {
        if (CekNilai(indexasisten) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten).text()));
        if (CekNilai(indexasisten + 1) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten + 1).text()));
        if (CekNilai(indexasisten + 2) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten + 2).text()));
        if (CekNilai(indexasisten) == true && CekNilai(indexasisten + 1) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten).text()) + parseFloat($('.total_nilai').eq(indexasisten + 1).text())) / 2;

        if (CekNilai(indexasisten) == true && CekNilai(indexasisten + 2) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten).text()) + parseFloat($('.total_nilai').eq(indexasisten + 2).text())) / 2;

        if (CekNilai(indexasisten + 1) == true && CekNilai(indexasisten + 2) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten + 1).text()) + parseFloat($('.total_nilai').eq(indexasisten + 2).text())) / 2;
        if (CekNilai(indexasisten) == true && CekNilai(indexasisten + 1) == true && CekNilai(indexasisten + 2) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten).text()) + parseFloat($('.total_nilai').eq(indexasisten + 1).text()) + parseFloat($('.total_nilai').eq(indexasisten + 2).text())) / 3;
    } else if (countjabatan == 4) {
        if (CekNilai(indexasisten) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten).text()));
        if (CekNilai(indexasisten + 1) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten + 1).text()));
        if (CekNilai(indexasisten + 2) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten + 2).text()));
        if (CekNilai(indexasisten + 3) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten + 3).text()));
        
            
        if (CekNilai(indexasisten) == true && CekNilai(indexasisten + 1) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten).text()) + parseFloat($('.total_nilai').eq(indexasisten + 1).text())) / 2;

        if (CekNilai(indexasisten) == true && CekNilai(indexasisten + 2) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten).text()) + parseFloat($('.total_nilai').eq(indexasisten + 2).text())) / 2;

        if (CekNilai(indexasisten + 1) == true && CekNilai(indexasisten + 2) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten + 1).text()) + parseFloat($('.total_nilai').eq(indexasisten + 2).text())) / 2;
       
        if (CekNilai(indexasisten) == true && CekNilai(indexasisten + 1) == true && CekNilai(indexasisten + 2) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten).text()) + parseFloat($('.total_nilai').eq(indexasisten + 1).text()) + parseFloat($('.total_nilai').eq(indexasisten + 2).text())) / 3;
        
        if (CekNilai(indexasisten) == true && CekNilai(indexasisten + 1) == true && CekNilai(indexasisten + 2) == true && CekNilai(indexasisten + 3) == true)
            RataRata = (parseFloat($('.total_nilai').eq(indexasisten).text()) + parseFloat($('.total_nilai').eq(indexasisten + 1).text()) + parseFloat($('.total_nilai').eq(indexasisten + 2).text()) + parseFloat($('.total_nilai').eq(indexasisten + 3).text())) / 4;
    }
    $('.rata-rata').eq(indexratarata).text(RataRata.toFixed(2));
    $('.total-nilai-accordion').eq(indexcekklis).text(RataRata.toFixed(2));
    TotalNilaiAktivitas(jmlanggota);
}
function TotalNilaiAktivitas(JmlAnggota) {
    const element = $('.total-nilai-accordion.on_math');
    let total = 0;
    let x = 0;
    for (x = 0; x < element.length; x++) {
        total += parseFloat(element.eq(x).text());
    }
    // alert(JmlAnggota)
    $('#nilai-oren').text((total / JmlAnggota).toFixed(2));
}
function ShowTeleponTelegram(get) {
    // return false;
    let data = [];
    if (get.count > 0)
        data = get.collections;
    // console.log
    let romawi = '';
    let html = "<div class='card mb-4 mt-4' style='border-radius:0px; border:0px solid transparent; margin:0px;'>";
    html += "<a style='margin:0px; padding:0px;' href='#' onclick='event.preventDefault()' class='btn m-0 btn-link coleps on' data-toggle='collapse' data-target='#collapsetel' aria-expanded='true'>";
    html += "<div class='card-header col-lg-12 text-light bg-dark text-center d-flex justify-content-between montserrat-600 letter-spacing text-size-7' id='headingOne' data-target='#collapsetel' style='margin:0px;'> <span class='text-size-7'><i class='fas fa-chevron-up icon-down text-size-4'></i> "
    html += "TELEPON & TELEGRAM </span> </div></a>";
    html += "<div id='collapsetel' class='collapse cus show' style='margin:0px;' aria-labelledby='headingOne'>";
    html += "<div class='card-body'>";
    html += "<div class='row'>";

    html += "<div class='col-lg-12'>";
    html += "<form action='" + url + router + 'storeteltelpon' + "' method='POST' id='storeteltelpon'>";
    html += "<table class='table table-bordered table-striped'>";
    html += "<tr>";
    html += "<th>NO</th>";
    html += "<th>HARI</th>";
    html += "<th>TELEPON</th>";
    html += "<th>TELEGRAM</th>";
    html += "</tr>";

    // 1
    html += "<tr>";
    html += "<td>1</td>";
    html += "<td>I</td>";
    html += "<td class='bg-success text-center text-light'><input class='px-2 telepon' value='" + (data.length > 0 ? data[0].h : 0) + "' onchange='teltelepon(this)' type='number' name='telepon[]' placeholder='nilai'></td>";
    html += "<td class='bg-success text-center text-light'><input class='px-2 telegram' value='" + (data.length > 0 ? data[1].h : 0) + "' onchange='teltelepon(this)' type='number' name='telegram[]' placeholder='nilai'></td>";
    html += "</tr>";

    // 2
    html += "<tr>";
    html += "<td>2</td>";
    html += "<td>II</td>";
    html += "<td class='bg-success text-center text-light'><input class='px-2 telepon' value='" + (data.length > 0 ? data[0].h1 : 0) + "' onchange='teltelepon(this)' type='number' name='telepon[]' placeholder='nilai'></td>";
    html += "<td class='bg-success text-center text-light'><input class='px-2 telegram' value='" + (data.length > 0 ? data[1].h1 : 0) + "' onchange='teltelepon(this)' type='number' name='telegram[]' placeholder='nilai'></td>";
    html += "</tr>";

    // 3
    html += "<tr>";
    html += "<td>3</td>";
    html += "<td>III</td>";
    html += "<td class='bg-success text-center text-light'><input class='px-2 telepon' value='" + (data.length > 0 ? data[0].h2 : 0) + "' onchange='teltelepon(this)' type='number' name='telepon[]' placeholder='nilai'></td>";
    html += "<td class='bg-success text-center text-light'><input class='px-2 telegram' value='" + (data.length > 0 ? data[1].h2 : 0) + "' onchange='teltelepon(this)' type='number' name='telegram[]' placeholder='nilai'></td>";
    html += "</tr>";

    // 4
    html += "<tr>";
    html += "<td>4</td>";
    html += "<td>IV</td>";
    html += "<td class='bg-success text-center text-light'><input class='px-2 telepon' value='" + (data.length > 0 ? data[0].h3 : 0) + "' onchange='teltelepon(this)' type='number' name='telepon[]' placeholder='nilai'></td>";
    html += "<td class='bg-success text-center text-light'><input class='px-2 telegram' value='" + (data.length > 0 ? data[1].h3 : 0) + "' onchange='teltelepon(this)' type='number' name='telegram[]' placeholder='nilai'></td>";
    html += "</tr>";


    html += "<tfoot>";
    html += "<tr>";
    html += "<th colspan=2 class='text-center'>TOTAL</th>";
    html += "<th class='text-center bg-danger text-light' id='total-telpon'>0</th>";
    html += "<th class='text-center bg-danger text-light' id='total-telegram'>0</th>";
    html += "</tr>";
    html += "</tfoot>";
    html += "</table>";
    html += "<button class='btn text-light btn-primary btn-block mb-3' id='btn-teltelpon' type='submit'>" + IconSave() + "&nbsp; SIMPAN NILAI TELEPON & TELEGRAM </button>";

    html += "</form>";
    html += "</div>";
    // html += "<div class='col-lg-4'>";
    // html += "<label>Telepon</label><div class='input-group mb-3'><input type='text' name='telepon' class='form-control text-size-5' placeholder=''><div class='input-group-append'><span class='input-group-text text-size-5'>kali</span></div></div>";
    // html += "</div>";

    // html += "<div class='col-lg-4'>";
    // html += "<label>Telegram</label><div class='input-group mb-3'><input type='text' name='telegram' class='form-control text-size-5' placeholder=''><div class='input-group-append'><span class='input-group-text text-size-5'>kali</span></div></div>";
    // html += "</div>";


    html += "</div></div>";
    html += "</div>";
    $('#show').html(html);

    teltelepon();
    $('#storeteltelpon').submit(function (evt) {
        evt.preventDefault();
        $('#btn-teltelpon').prop('disabled', "true");
        $('#btn-teltelpon').html(IconLoading(' &nbsp; TUNGGU SEBENTAR'));
        let GetData = new FormData(this);
        GetData.append('kelompok', $('#kelompok').val());
        $.ajax({
            url: url + router + 'storeteltelpon',
            data: GetData,
            type: 'POST',
            processData: false,
            contentType: false,
            success: function (result) {
                const parse = JSON.parse(result);
                if (parse.status == 200) {
                    pesan_sukses('Pesan', parse.message);
                } else {
                    pesan_warning('Pesan', parse.message);
                }
                $('#btn-teltelpon').removeAttr('disabled');
                $('#btn-teltelpon').html(IconSave() + '&nbsp; SIMPAN NILAI TELEPON & TELEGRAM');


            }
        })
    })

}

function teltelepon(that = '') {
    const telpon = $('.telepon');
    const telegram = $('.telegram');
    let total = 0;
    let total2 = 0;

    for (let i = 0; i < telpon.length; i++) {

        if (telpon.eq(i).val() == '') total += 0;
        else total += parseFloat(telpon.eq(i).val());

        if (telegram.eq(i).val() == '') total2 += 0
        else total2 += parseFloat(telegram.eq(i).val());

    }
    $('#total-telpon').text(total);
    $('#total-telegram').text(total2);
}
function buttonSave() {
    let html = "<div id='fixed-relative'><button id='fixedbutton' class='btn btn-primary px-3 py-2 text-size-4'>" + IconSave('text-size-4') + " Simpan</button></div>"
    return html;
}
function showProdukAktivitas(data, count) {
    // console.log(data);

    const source = data.CollectionsCeklis;
    const CountAnggota = data.CountSoal;
    // console.log(data.CountSoal);
    const sourceEdit = data.edit;
    let html = "";
    let Total = 0,
        total_nilai_index = 0, indexratarata = 0, EditRata = 0;
    html += "<div id='accordion' class='mt-4'>";
    let JmlIndeks = 0;
    let DataJabatan = [];
    let CEKLIS = 1;
    let Edit = [], z = 0, a = 0, EditTotal1 = 0, EditTotal2 = 0, EditTotal3 = 0, EditTotal4 = 0, EditTotal5 = 0, EditAccordion = [];
    let i = 0, b = 0;
    let nilaioren = [];
    let t = 0;
    for (i = 0; i < count; i++) {
        // if(i != 7 && $('#kelompok').val() != "9"){
        // console.log(source[i].id_jabatan);
        // alert(i + $('#kelompok').val())
        EditTotal1 = 0;
        EditTotal2 = 0;
        EditTotal3 = 0;
        
        EditTotal4 = 0;
        EditTotal5 = 0;

        JmlIndeks = 0;
        DataJabatan = JSON.parse(source[i].id_jabatan);

        // mode edit
        z = 0;
        Edit = [];
        for (let key in sourceEdit[source[i].id_ceklis]) {
            Edit[z++] = sourceEdit[source[i].id_ceklis][key];
        }
        z -= 1;
        // id_jabatan
        if (source[i]['is_asisten'] == 1 || source[i]['is_asisten'] == 3) {
            html += "<form class='asistenstore' action='" + url + router + 'storeakivitasasisten' + "' method='POST'>";

        }
        else {
            html += "<form class='pakastore' action='" + url + router + 'storeakivitaspanglimakas' + "' method='POST'>";
        }
        for (let x = 0; x < DataJabatan.length; x++) {
            html += "<input type='hidden' readonly name='id_jabatan[]' value='" + (DataJabatan[x].id_jabatan) + "'>";
        }

        html += "<div class='card' style='border-radius:0px; border:0px solid transparent; margin:0px;'>";
        html += "<a style='margin:0px; padding:0px;' href='#' onclick='event.preventDefault()' class='btn m-0 btn-link coleps on' data-toggle='collapse' data-target='#collapse" + i + "' aria-expanded='true'>";
        html += "<div class='card-header col-lg-12 text-light bg-dark text-center d-flex justify-content-between montserrat-600 letter-spacing text-size-7' id='headingOne' data-target='#collapse" + i + "' style='margin:0px;'> <span class='text-size-7'><i class='fas fa-chevron-up icon-down text-size-4'></i> "
        html += 'CA' + (CEKLIS++) + ' - ' + source[i].nama_ceklis + "</span> <span class='" + (source[i]['is_asisten'] == 1 || source[i]['is_asisten'] == 3 ? 'on_math' : '') + " total-nilai-accordion'>0</span></div></a>";

        html += "<div id='collapse" + i + "' class='collapse cus' style='margin:0px;' aria-labelledby='headingOne'>";
        html += "<div class='card-body'>";
        html += "<table border=1 cellpadding=3 class='table table-bordered table-striped'>";
        html += "<tr>";
        html += "<th width=2% class='text-center'>NO</th>";
        html += "<th width=40%>ASPEK YANG DINILAI</th>";
        html += "<th width=5%>MAKS</th>";

        if (source[i]['is_asisten'] == 1) {
            if (DataJabatan.length >= 2) {
                html += "<th width=10% class='text-center'>NILAI ASISTEN 1</th>";
                html += "<th width=10% class='text-center'>NILAI ASISTEN 2</th>";
            }
            if (DataJabatan.length >= 3){
                html += "<th width=10% class='text-center'>NILAI ASISTEN 3</th>";
            }
            if (DataJabatan.length >= 4){
                html += "<th width=10% class='text-center'>NILAI ASISTEN 4</th>";
            }
            if (DataJabatan.length >= 5){
                html += "<th width=10% class='text-center'>NILAI ASISTEN 5</th>";
            }
        } else {
            html += "<th width=10% class='text-center'>NILAI </th>";
        }

        html += "</tr>";
        t = 0;
        for (let y = 0; y < source[i].soal.length; y++) {
            // alert(z + ' - ' + y);
            JmlIndeks += parseFloat(source[i].soal[y].maks);
            // if($('#kelompok').val() == 1 && source[i].id_ceklis == 'C2' && y == 0)
            //     JmlIndeks -= parseFloat(source[i].soal[y].maks);

            html += "<tr>";
            html += "<td>" + (y + 1) + "</td>";
            html += "<td>" + source[i].soal[y].aspek + "</td>";
            html += "<td>" + parseFloat(source[i].soal[y].maks).toFixed(2) + "</td>";
            if (source[i]['is_asisten'] == 1 || source[i]['is_asisten'] == 3) {
                if (source[i]['is_asisten'] == 3) {
                    html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                        "' name='nilai_1[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index) +
                        "' value='" + (Edit.length <= 0 ? '' : Edit[0][y]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilai(this," + (total_nilai_index) + "," + (i) + ", " + (DataJabatan.length) + "," + (CountAnggota) + ")' ></td> ";
                }

                else if (source[i]['is_asisten'] == 1) {
                    if (DataJabatan.length == 2) {

                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_1[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[0][y]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_2[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index + 1) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[1][y + source[i].soal.length]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index + 1) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                    } else if (DataJabatan.length == 3) {
                        // console.log(source[i]);
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_1[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[0][y]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_2[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index + 1) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[1][y + source[i].soal.length]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index + 1) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_3[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index + 2) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[2][y + (source[i].soal.length * 2)]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index + 2) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";

                    } else if (DataJabatan.length == 4) {
                        // console.log(source[i]);
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_1[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[0][y]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_2[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index + 1) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[1][y + source[i].soal.length]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index + 1) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_3[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index + 2) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[2][y + (source[i].soal.length * 2)]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index + 2) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_4[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index + 3) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[3][y + (source[i].soal.length * 3)]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index + 3) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                    }else if (DataJabatan.length == 5) {
                        // console.log(source[i]);
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_1[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[0][y]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_2[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index + 1) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[1][y + source[i].soal.length]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index + 1) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_3[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index + 2) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[2][y + (source[i].soal.length * 2)]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index + 2) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_4[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index + 3) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[3][y + (source[i].soal.length * 3)]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index + 3) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                            "' name='nilai_4[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai_" + (total_nilai_index + 4) +
                            "' value='" + (Edit.length <= 0 ? '' : Edit[4][y + (source[i].soal.length * 4)]['nilai']) + "' placeholder='Nilai'  onchange='TotalNilaiAsisten(this," + (indexratarata) + "," + total_nilai_index + "," + (i) + "," + (total_nilai_index + 4) + "," + (DataJabatan.length) + "," + (CountAnggota-1) + ")' ></td> ";
                    }

                }
                // console.log(Edit);
                if (Edit.length > 0) {
                    EditTotal1 += parseFloat(Edit[0][y]['nilai']);
                    if (source[i]['is_asisten'] == 1)
                        EditTotal2 += parseFloat(Edit[1][y + source[i].soal.length]['nilai']);
                    if (DataJabatan.length == 3)
                        EditTotal3 += parseFloat(Edit[2][y + (source[i].soal.length * 2)]['nilai']);
                    if (DataJabatan.length == 4)
                        EditTotal4 += parseFloat(Edit[3][y + (source[i].soal.length * 3)]['nilai']);
                    if (DataJabatan.length == 5)
                        EditTotal4 += parseFloat(Edit[4][y + (source[i].soal.length * 4)]['nilai']);
                }

            } else {
                
                if($('#kelompok').val() == 1 && source[i].id_ceklis == 'C2'){
                    // console.log(Edit);
                    
                    html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                        "' name='nilai1[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai" + (i + 1) +
                        "' value='" + ( Edit.length == 0 ? '' : Edit[0][y]['nilai']) + "' placeholder='Nilai..' onchange='TotalNilaiPanglima(this," + (total_nilai_index) + "," + (i) + ", " + (DataJabatan.length) + ") '></td>";

                        if (Edit.length > 0) {
                            // console.log(JSON.stringify(Edit));
                        EditTotal1 += parseFloat(Edit[0][y]['nilai']);
                        // alert('tambah')
                        }
                }
                else{
                        // Edit[0][y]['nilai'] = 0;
                        html += "<td><input type='number' step='0.01' max='" + source[i].soal[y].maks +
                        "' name='nilai1[" + source[i].id_ceklis + "][" + source[i].soal[y].id_soal_perorangan + "]' class='form-control nilai" + (i + 1) +
                        "' value='' placeholder='Nilai..' onchange='TotalNilaiPanglima(this," + (total_nilai_index) + "," + (i) + ", " + (DataJabatan.length) + ") '></td>";
                    

                    // if (Edit.length > 0) {
                    // EditTotal1 += parseFloat(Edit[0][y]['nilai']);
                    // // alert('tambah')
                    // }


                }


            }
            html += "</tr>";
    
        }
        if (DataJabatan.length == 1)
            total_nilai_index += 1;
        else if (DataJabatan.length == 2)
            total_nilai_index += 2;
        else if (DataJabatan.length == 3)
            total_nilai_index += 3;
        else if (DataJabatan.length == 4)
            total_nilai_index += 4;
        else if (DataJabatan.length == 5)
            total_nilai_index += 5;

        html += "<tr>";
        html += "<tr>";
        html += "<th colspan=2 class='text-center montserrat-600'>NILAI</th>";
        if($('#kelompok').val() != 1 && source[i].id_ceklis == 'C2'){
            html += "<th width='7%' class='text-center montserrat-600'>25 - " + (JmlIndeks.toFixed(2)) + "</th>";
        }else if($('#kelompok').val() == 1 && source[i].id_ceklis == 'C2'){
            html += "<th class='text-center montserrat-600'>25 - " + (JmlIndeks.toFixed(2)) + "</th>";
        }else{
            html += "<th class='text-center montserrat-600'>" + (JmlIndeks.toFixed(2)) + "</th>";
        }
        if (source[i]['is_asisten'] == 1) {
            indexratarata++;
            if (EditTotal1 == 0 && EditTotal2 == 0 && EditTotal3 == 0 && EditTotal4 == 0) {
                if (DataJabatan.length >= 2) {
                    html += "<td class='text-center bg-success  total_nilai text-light montserrat-600' onchange='RataRata()'>" + (Total != 0 ?
                        Total : 0) + "</td>";
                    html += "<td class='text-center bg-success  total_nilai text-light montserrat-600' onchange='RataRata(" +
                        (total_nilai_index) + ")'>" + (Total != 0 ? Total : 0) + "</td>";
                }
                if (DataJabatan.length >= 3)
                    html += "<td class='text-center bg-success  total_nilai text-light montserrat-600' onchange='RataRata(" +
                        (total_nilai_index) + ")'>" + (Total != 0 ? Total : 0) + "</td>";
                
                if (DataJabatan.length >= 4)
                            html += "<td class='text-center bg-success  total_nilai text-light montserrat-600' onchange='RataRata(" +
                                (total_nilai_index) + ")'>" + (Total != 0 ? Total : 0) + "</td>";
                if (DataJabatan.length >= 5)
                            html += "<td class='text-center bg-success  total_nilai text-light montserrat-600' onchange='RataRata(" +
                                (total_nilai_index) + ")'>" + (Total != 0 ? Total : 0) + "</td>";

            } else {
                if (DataJabatan.length >= 2) {
                    html += "<td class='text-center bg-success  total_nilai text-light montserrat-600'>" + (EditTotal1 != 0 ?
                        EditTotal1.toFixed(2) : 0) + "</td>";
                    html += "<td class='text-center bg-success  total_nilai text-light montserrat-600'>" + (EditTotal2 != 0 ?
                        EditTotal2.toFixed(2) : 0) + "</td>";
                } 
                if (DataJabatan.length >= 3)
                    html += "<td class='text-center bg-success  total_nilai text-light montserrat-600'>" + (EditTotal3 != 0 ?
                        EditTotal3.toFixed(2) : 0) + "</td>";
                if (DataJabatan.length >= 4)
                    html += "<td class='text-center bg-success  total_nilai text-light montserrat-600'>" + (EditTotal4 != 0 ?
                        EditTotal4.toFixed(2) : 0) + "</td>";
                if (DataJabatan.length >= 5)
                    html += "<td class='text-center bg-success  total_nilai text-light montserrat-600'>" + (EditTotal5 != 0 ?
                        EditTotal4.toFixed(2) : 0) + "</td>";
            }

        } else {
            html += "<th width=10% class='bg-danger text-light text-center total_nilai'>" + (EditTotal1 > 0 ? EditTotal1.toFixed(2) : 0) + " </th>";
        }


        html += "</tr>";
        html += "</tr>";
        if (source[i]['is_asisten'] == 1) {
            // rata rata jika edit mode
            if (EditTotal1 == 0)
                EditRata = (EditTotal1 + EditTotal2 + EditTotal3 + EditTotal4 + EditTotal5);
            if (EditTotal2 == 0)
                EditRata = (EditTotal1 + EditTotal2 + EditTotal3 + EditTotal4 + EditTotal5);
            if (EditTotal3 == 0)
                EditRata = (EditTotal1 + EditTotal2 + EditTotal3 + EditTotal4 + EditTotal5);
            if (EditTotal4 == 0)
                EditRata = (EditTotal1 + EditTotal2 + EditTotal3 + EditTotal4 + EditTotal5);
            if (EditTotal4 == 0)
                EditRata = (EditTotal1 + EditTotal2 + EditTotal3 + EditTotal4 + EditTotal5);
                    
            if (EditTotal1 > 0 && EditTotal2 > 0)
                EditRata = (EditTotal1 + EditTotal2) / 2;
            if (EditTotal1 > 0 && EditTotal3 > 0)
                EditRata = (EditTotal1 + EditTotal3) / 2;
            if (EditTotal2 > 0 && EditTotal3 > 0)
                EditRata = (EditTotal1 + EditTotal2) / 2;
            if (EditTotal1 > 0 && EditTotal2 > 0 && EditTotal3 > 0)
                EditRata = (EditTotal1 + EditTotal2 + EditTotal3) / 3;
            
            if (EditTotal1 > 0 && EditTotal2 > 0 && EditTotal3 > 0 && EditTotal4 > 0)
                EditRata = (EditTotal1 + EditTotal2 + EditTotal3 + EditTotal4) / 4;

            if (EditTotal1 > 0 && EditTotal2 > 0 && EditTotal3 > 0 && EditTotal4 > 0 && EditTotal5 > 0)
                EditRata = (EditTotal1 + EditTotal2 + EditTotal3 + EditTotal4 + EditTotal4) / 5;

            html += "<tr>";
            html += "<td colspan='3'>RATA RATA</td>";
            html += "<td colspan='5' class='bg-danger text-light text-center montserrat-600 rata-rata'>" + (EditRata == 0 ? 0 : EditRata);
            html += "</td></tr>";
            // accordion
            EditAccordion[i] = Edit.length > 0 ? EditRata : 0;
            nilaioren[b] = Edit.length > 0 ? EditRata.toFixed(2) : 0;
            b++;

        } else {
            EditAccordion[i] = Edit.length > 0 ? EditTotal1 : 0;
            if (source[i]['is_asisten'] == 3 && Edit.length > 0) {
                nilaioren[b] = EditTotal1.toFixed(2);
                b++;
            }

        }
        html += "</table>";
        html += "<button class='btn text-light btn-primary btn-block mb-3 " + (source[i]['is_asisten'] == 1 ? 'btn-asisten' : 'btn-pakas') + "' type='submit'>" + IconSave() + "&nbsp; SIMPAN NILAI </button>";

        html += "</div></div>";

        html += "</div></form>";
    // }
    }
    // console.log(Edit);
    html += "</div>";

    //OREN 
    let totaloren = 0;
    let c = 0;
    // alert(jmljabatan);
    for (c = 0; c < nilaioren.length; c++) {
        totaloren += parseFloat(nilaioren[c]);
    }
    html += "<div class='card' style='border-radius:0px; border:0px solid transparent; margin:0px;'>";
    html += "<a style='margin:0px; padding:0px;' href='#' onclick='event.preventDefault()' class='btn m-0 btn-link coleps'>";
    html += "<div class='card-header col-lg-12 text-light bg-warning text-center d-flex justify-content-between montserrat-600 letter-spacing text-size-7' id='headingOne' data-target='#collapse" + i + "' style='margin:0px;'> <span class='text-size-7'>"
    html += "TOTAL NILAI AKTIVITAS HARI INI </span> <span id='nilai-oren' >" + (totaloren == 0 ? 0 : (totaloren / CountAnggota).toFixed(2)) + "</span></div></a>";
    // BUTTON 
    // html += buttonSave();
    $('#show').html(html);
    // console.log(EditAccordion);
    EditAccordion.forEach(function (val, key) {
        // alert(val + ' - ' + key);
        $('.total-nilai-accordion').eq(key).text(val.toFixed(2));
    })

    $('.coleps').click(function (evt) {
        evt.stopPropagation();
        const index = $('.coleps').index(this);
        onoff(index);
    });

    // panglima kas store
    $('.pakastore').submit(function (evt) {
        evt.preventDefault();
        const index = $('.pakastore').index(this);
        $('.btn-pakas').eq(index).prop('disabled', "true");
        $('.btn-pakas').eq(index).html(IconLoading(' &nbsp; TUNGGU SEBENTAR'));
        let GetData = new FormData(this);
        GetData.append('kelompok', $('#kelompok').val());
        $.ajax({
            url: url + router + 'storeakivitaspanglimakas',
            data: GetData,
            type: 'POST',
            processData: false,
            contentType: false,
            success: function (result) {
                const parse = JSON.parse(result);
                if (parse.status == 200) {
                    pesan_sukses('Pesan', parse.message);
                } else {
                    pesan_warning('Pesan', parse.message);
                }
                $('.btn-pakas').eq(index).removeAttr('disabled');
                $('.btn-pakas').eq(index).html(IconSave() + '&nbsp; SIMPAN NILAI');


            }
        })
    })

    // asisten store
    $('.asistenstore').submit(function (evt) {
        evt.preventDefault();
        const index = $('.btn-asisten').index(this);
        $('.btn-asisten').eq(index).prop('disabled', "true");
        $('.btn-asisten').eq(index).html(IconLoading(' &nbsp; TUNGGU SEBENTAR'));
        let GetData = new FormData(this);
        GetData.append('kelompok', $('#kelompok').val());
        $.ajax({
            url: url + router + 'storeakivitasasisten',
            data: GetData,
            type: 'POST',
            processData: false,
            contentType: false,
            success: function (result) {
                const parse = JSON.parse(result);
                if (parse.status == 200) {
                    pesan_sukses('Pesan', parse.message);
                } else {
                    pesan_warning('Pesan', parse.message);
                }
                $('.btn-asisten').eq(index).removeAttr('disabled');
                $('.btn-asisten').eq(index).html(IconSave() + '&nbsp; SIMPAN NILAI');


            }
        })
    })

}

function IconLoading(name = '') {
    return "<span style='font-size:24px;' class='spinner-border spinner-border-md' role='status' aria-hidden='true'></span> " + name;
}
function onoff(index) {
    if ($('.coleps').eq(index).hasClass('on')) {
        $('.coleps').eq(index).removeClass('on');
        $('.coleps').eq(index).addClass('off');
        $('.icon-down').eq(index).removeClass('fa-chevron-up');
        $('.icon-down').eq(index).addClass('fa-chevron-down');
    } else {
        $('.coleps').eq(index).removeClass('off');
        $('.coleps').eq(index).addClass('on');
        $('.icon-down').eq(index).removeClass('fa-chevron-down');
        $('.icon-down').eq(index).addClass('fa-chevron-up');
    }

    
}
