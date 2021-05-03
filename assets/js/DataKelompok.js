sessionStorage.clear();
// $("tbody").click(function (evt) {
//     evt.stopPropagation();
//     if (evt.target.className == 'subSelect') {
//         // alert( parseInt(sessionStorage.getItem('count')) );
//         if (sessionStorage.getItem('count') == 'NaN' || sessionStorage.getItem('count') == null) {
//             sessionStorage.setItem('count', 0);
//         }
//         if (evt.target.checked == true) {
//             let input_ = document.createElement('input');
//             input_.setAttribute('type', 'hidden');
//             input_.setAttribute('value', 'YO_' + evt.target.defaultValue);
//             input_.setAttribute('name', 'selectKelompok[]');
//             $('#input-selected').append(input_);
//             sessionStorage.setItem('count', parseInt(sessionStorage.getItem('count')) + 1);
//             $('.MYbounce').show();
//             $('.page').css('background', 'rgba(46, 49, 49, 1)');
//             $('#data-card').css({ 'box-shadow': '0px 0px 0px transparent' })
//             $('#fixedbutton').show();
//             $('#fixedbutton2').show();
//         }
//         else {
//             $("input[value='YO_" + evt.target.defaultValue + "']").remove();
//             if (sessionStorage.getItem('count') == 1) {
//                 const boxShadow = "0 1px 2px #e5e5e5, 0 2px 4px #e5e5e5, 0 4px 8px #e5e5e5, 0 8px 16px #e5e5e5, 0 16px 32px #e5e5e5, 0 32px 64px #e5e5e5";
//                 $('.MYbounce').hide();
//                 $('.page').css('background', 'rgba(236, 240, 241, 1)');
//                 $('#fixedbutton').hide();
//                 $('#fixedbutton2').hide();
//                 $('#data-card').css({ 'box-shadow': boxShadow })

//             }
//             sessionStorage.setItem('count', parseInt(sessionStorage.getItem('count')) - 1);

//         }

//         $('#counter-selected').html(sessionStorage.getItem('count'));
//         $(".MYbounce").effect("bounce", { times: 2 }, 100);

//     }
// });


