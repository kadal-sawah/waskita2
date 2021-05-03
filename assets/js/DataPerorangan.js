sessionStorage.clear();
$("tbody").click(function (evt) {
    evt.stopPropagation();
    if (evt.target.className == 'subSelect') {
        // alert( parseInt(sessionStorage.getItem('count')) );
        if (sessionStorage.getItem('count') == 'NaN' || sessionStorage.getItem('count') == null) {
            sessionStorage.setItem('count', 0);
        }
        if (evt.target.checked == true) {
            let input_ = document.createElement('input');
            input_.setAttribute('type', 'hidden');
            input_.setAttribute('value', 'YO_' + evt.target.defaultValue);
            input_.setAttribute('name', 'selectPerorangan[]');
            $('#input-selected').append(input_);
            sessionStorage.setItem('count', parseInt(sessionStorage.getItem('count')) + 1);
            $('.MYbounce').show();
            $('.page').css('background', 'rgba(46, 49, 49, 1)');
            $('#data-card').css({ 'box-shadow': '0px 0px 0px transparent' })
            $('#fixedbutton').show();
            $('#fixedbutton2').show();
        }
        else {
            $("input[value='YO_" + evt.target.defaultValue + "']").remove();
            if (sessionStorage.getItem('count') == 1) {
                const boxShadow = "0 1px 2px #e5e5e5, 0 2px 4px #e5e5e5, 0 4px 8px #e5e5e5, 0 8px 16px #e5e5e5, 0 16px 32px #e5e5e5, 0 32px 64px #e5e5e5";
                $('.MYbounce').hide();
                $('.page').css('background', 'rgba(236, 240, 241, 1)');
                $('#fixedbutton').hide();
                $('#fixedbutton2').hide();
                $('#data-card').css({ 'box-shadow': boxShadow })

            }
            sessionStorage.setItem('count', parseInt(sessionStorage.getItem('count')) - 1);

        }

        $('#counter-selected').html(sessionStorage.getItem('count'));
        $(".MYbounce").effect("bounce", { times: 2 }, 100);

    }
});


$('select[name=nama_kelompok]').change(function (evt) {
    const val = $(this).val();
    urlna = url + router + 'ajaxkelompok/' + val;
    $('#DTPenilaianPerorangan').DataTable().destroy();
    $('#DTPenilaianPerorangan').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url + router + 'ajaxkelompok/' + val,
            "type": 'POST',
        },
        "columnDefs": [{
            targets: 1,
            className: 'montserrat-600'
        },
        {
            targets: 4,
            className: 'text-center'
        }, {
            targets: 0,
            orderable: false
        }
        ],
        "language": {
            "lengthMenu": "Menampilkan _MENU_ data per halaman",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoFiltered": "(tersaring dari _MAX_ total data)"
        }
    });
    $('.dataTables_wrapper .row:nth-child(3)').addClass("bg-grey px-4 card-footer pb-1").css({
        'padding-top': '10px',
        'margin-top': '-8px'
    })
    // table.ajax.url(url + router + 'ajaxkelompok/' + val);
    // table.ajax.reload(null, false);
    // table.DataTable({
    //     "processing": true,
    //     "serverSide": true,
    //     "ajax": {
    //         "url": url + router + 'ajaxkelompok/' + val,
    //     },
    //     "columnDefs": [{
    //         targets: 1,
    //         className: 'montserrat-600'
    //     },
    //     {
    //         targets: 5,
    //         className: 'text-center'
    //     }, {
    //         targets: 0,
    //         orderable: false
    //     }
    //     ]
    // }).ajax.reload()

})

// 356a192b7913b04c54574d18c28d46e6395428ab
// da4b9237bacccdf19c0760cab7aec4a8359010b0