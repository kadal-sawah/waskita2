var url = document.querySelector("meta[name=url]").getAttribute("content");
var router = document.querySelector("meta[name=router]").getAttribute("content") + '/';
var uri1 = document.querySelector("meta[name=uri1]").getAttribute("content");
var uri2 = document.querySelector("meta[name=uri2]").getAttribute("content");
var uri3 = document.querySelector("meta[name=uri3]").getAttribute("content");
// var hashids = new Hashids.default('19elearning26', 19);
var Base64 = { _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=", encode: function (e) { var r, t, a, n, o, c, s, i = "", u = 0; for (e = Base64._utf8_encode(e); u < e.length;)n = (r = e.charCodeAt(u++)) >> 2, o = (3 & r) << 4 | (t = e.charCodeAt(u++)) >> 4, c = (15 & t) << 2 | (a = e.charCodeAt(u++)) >> 6, s = 63 & a, isNaN(t) ? c = s = 64 : isNaN(a) && (s = 64), i = i + this._keyStr.charAt(n) + this._keyStr.charAt(o) + this._keyStr.charAt(c) + this._keyStr.charAt(s); return i }, decode: function (e) { var r, t, a, n, o, c, s = "", i = 0; for (e = e.replace(/[^A-Za-z0-9\+\/\=]/g, ""); i < e.length;)r = this._keyStr.indexOf(e.charAt(i++)) << 2 | (n = this._keyStr.indexOf(e.charAt(i++))) >> 4, t = (15 & n) << 4 | (o = this._keyStr.indexOf(e.charAt(i++))) >> 2, a = (3 & o) << 6 | (c = this._keyStr.indexOf(e.charAt(i++))), s += String.fromCharCode(r), 64 != o && (s += String.fromCharCode(t)), 64 != c && (s += String.fromCharCode(a)); return s = Base64._utf8_decode(s) }, _utf8_encode: function (e) { e = e.replace(/\r\n/g, "\n"); for (var r = "", t = 0; t < e.length; t++) { var a = e.charCodeAt(t); a < 128 ? r += String.fromCharCode(a) : a > 127 && a < 2048 ? (r += String.fromCharCode(a >> 6 | 192), r += String.fromCharCode(63 & a | 128)) : (r += String.fromCharCode(a >> 12 | 224), r += String.fromCharCode(a >> 6 & 63 | 128), r += String.fromCharCode(63 & a | 128)) } return r }, _utf8_decode: function (e) { for (var r = "", t = 0, a = c1 = c2 = 0; t < e.length;)(a = e.charCodeAt(t)) < 128 ? (r += String.fromCharCode(a), t++) : a > 191 && a < 224 ? (c2 = e.charCodeAt(t + 1), r += String.fromCharCode((31 & a) << 6 | 63 & c2), t += 2) : (c2 = e.charCodeAt(t + 1), c3 = e.charCodeAt(t + 2), r += String.fromCharCode((15 & a) << 12 | (63 & c2) << 6 | 63 & c3), t += 3); return r } };
// function pesan_error(e, r) { toastr.options.closeButton = !0, toastr.error(r, e) } function pesan_sukses(e, r) { toastr.options.closeButton = !0, toastr.success(r, e) } function dot(e) { var r = e.toString(), t = r.length % 3, a = r.substr(0, t), n = r.substr(t).match(/\d{3}/g); return n && (separator = t ? "." : "", a += separator + n.join(".")), a } function GetDay(e) { let r = ""; switch (e) { case "Sun,": r = "Minggu"; break; case "Mon,": r = "Senin"; break; case "Tue,": r = "Selasa"; break; case "Wed,": r = "Rabu"; break; case "Thu,": r = "Kamis"; break; case "Fri,": r = "Jum'at"; break; case "Sat,": r = "Sabtu" }return r } function GetMonth(e) { let r = ""; switch (e) { case "Jan": r = "januari"; break; case "Feb": r = "februari"; break; case "Mar": r = "maret"; break; case "Apr": r = "april"; break; case "May": r = "mei"; break; case "Jun": r = "juni"; break; case "Jul": r = "juli"; break; case "Aug": r = "agustus"; break; case "Sept": r = "september"; break; case "Oct": r = "oktober"; break; case "Nov": r = "november"; break; case "Dec": r = "desember" }return r }
var table;
var urlna = url + router + 'get';

function disableButton() {
    $(':submit').append(' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>')
    $(':submit').attr('disabled', true)
}

function enableButton() {
    $(':submit').find('span').remove()
    $(':submit').removeAttr("disabled")
}

function errorCode(event) {
    iziToast.error({
        title: "Error",
        message: event.status + " " + event.statusText,
        position: 'topCenter'
    });
}

function clearInput(inp) {
    for (let index = 0; index < inp.length; index++) {
        inp[index].value = "";
    }
}

function pesan_error(title, message) {
    iziToast.error({
        title: title,
        message: message.replace("'", "\'"),
        progressBar: false,
        position: 'topCenter'
    });
}
function pesan_warning(title, message) {
    iziToast.warning({
        title: title,
        message: message.replace("'", "\'"),
        progressBar: false,
        position: 'topCenter'
    });
}
function pesan_sukses(title, message) {
    iziToast.success({
        title: title,
        message: message.replace("'", "\'"),
        progressBar: false,
        position: 'topCenter'
    });
}

function Encode(e, r = 7) { let t = []; for (let a = 0; a < r; a++)0 == t.length ? t[a] = Base64.encode(e.toString()) : t[a] = Base64.encode(t[a - 1].toString()); return t[t.length - 1].replace(/=/g, "") } function Decode(e, r, t = "") { $tampung = []; for (let t = 0; t < r; t++)0 == tampung.length ? tampung[t] = Base64.decode(e) : tampung[t] = Base64.decode(tampung[t - 1]); return tampung[tampung.length - 1].replace(/=/g, "") }
function loading(center = true) {
    return "<img " + (center == true ? "class='mx-auto mt-5'" : '') + " src='" + url + 'assets/images/loading2.gif' + "' width=100 height=100/>";
}

function LoadingButton(type, text, name = 'save') {
    let button = "button[name=" + name + "]";
    const btext = $(button).html();
    if (type == 'on') {
        $(button).html(" <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> " + text)
        $(button).attr('disabled', 'true');
    }
    else if (type == 'off') {
        $(button).html(text)
        $(button).removeAttr('disabled');
    }

    return btext;

}

function stripHtml(html) {
    // Create a new div element
    var temporalDivElement = document.createElement("div");
    // Set the HTML content with the providen
    temporalDivElement.innerHTML = html;
    // Retrieve the text property of the element (cross-browser support)
    return temporalDivElement.textContent || temporalDivElement.innerText || "";
}

function ValidateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function slug(text) {
    let tampung = text.replace(/[^a-zA-Z0-9]/gi, "-")
    return tampung.toLowerCase();
}

function IsMobile() {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
        return true;
    return false;
}