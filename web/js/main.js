$(function () {
    $('.modalButton').click(function(){
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
        $('.modal-dialog').addClass('modal-lg');
    });


    // // $('#modalFio').click(function () {
    // //     $('#modal').modal('show')
    // //         .find('#modalContent')
    // //         .load($(this).attr('value') + "?search=" + $('#app-fio').val().replace(/\s/ig, '-'));
    // // });
    // // $('#modalIp').click(function () {
    // //     $('#modal').modal('show')
    // //         .find('#modalContent')
    // //         .load($(this).attr('value') + "?search=" + $('#app-ip').val());
    // // });
    // // $('#modalPhone').click(function () {
    // //     $('#modal').modal('show')
    // //         .find('#modalContent')
    // //         .load($(this).attr('value') + "?search=" + $('#app-phone').val());
    // // });


    // // $(document).on('click', '.modalButton', function (event) {
    // //     $('#modal').modal('show')
    // //         .find('#modalContent')
    // //         .load($(this).attr('value'));
    // //     $('.modal-dialog').addClass('modal-sm');
    // // });

    // // $(document).on('click', '.modal-btn-xl', function (event) {
    // //     $('#modal').modal('show')
    // //         .find('#modalContent')
    // //         .load($(this).attr('value'));
    // //     $('.modal-dialog').addClass('modal-xl');
    // // });


    // /*
    //  Изменяем размер поля ввода "Коментарий, Напоминания" по мере изменения количество строк в тексте
    //  */
    // // $('.app-input-comment, .app-input-recal').click('input',function () {
    // //     this.style.height = 'auto';
    // //     this.style.height = (this.scrollHeight) + px;
    // // });

    // // Новый класс, для Clipboard. Копирование текста в буффер.
    // new Clipboard('.btncopy');

    // $('.btncopy').mouseover(function () {
    //     $(this).removeClass('myCopy');
    //     $(this).addClass('myCopyOver');
    // });
    // $('.btncopy').mouseout(function () {
    //     $(this).removeClass('myCopyOver');
    //     $(this).addClass('myCopy');
    // });

    // $('.myRecNone').mouseover(function () {
    //     $(this).children().fadeIn(300);
    // });
    // $('.myRecNone').mouseout(function () {
    //     $('.remove').fadeOut(50);
    // });

    // $('#add').click(function () {
    //     var val = $("#inpText").val();
    //     if (val !== '') {
    //         addRecal(val);
    //     }
    // });

    // $(".remove").click(function () {
    //     if (this.id !== '') {
    //         deleteRecal(this.id);
    //     }
    // });


    // /**
    //  * Раскрываем форму для добавления фактического времени исполнения
    //  */
    // $("#app_time_fact").click(function () {
    //     $("#app_imput_time_fact").removeClass('display-none');
    // });


    // function getErr() {
    //     jQuery.ajax({
    //         type: "GET",
    //         url: "site/err",
    //         success: function (data) {
    //             $('#app-message-section').append(data);
    //         }
    //     });
    //     setTimeout(function () {
    //         $('#app-message').remove();
    //     }, 15000);
    // }


    // $('#inpText').keydown(function (e) {
    //     if (e.ctrlKey && e.keyCode == 13) {
    //         $("#add").trigger("click");
    //     }
    // });

    // function toggle(val) {
    //     $(val).slideDown(1000);
    //     $(val).delay(1500);
    //     $(val).slideUp(1000);
    // }

    // // Копируем текст
    // function copyToClipboard(element) {
    //     var $temp = $("<input>");
    //     $("body").append($temp);
    //     $temp.val($(element).text()).select();
    //     document.execCommand("copy");
    //     $temp.remove();
    // }

    // $("#cb1").change(function () {
    //     $('.cat1').fadeToggle(300);
    // });

    // $("#fioCaseLogin").change(function () {
    //     $('.fioCaseLogin').fadeToggle(100);
    // });
    // $("#fioCaseName").change(function () {
    //     $('.fioCaseName').fadeToggle(100);
    // });

    // $("[data-toggle='tooltip']").tooltip({html: true});
    // $("[data-toggle='popover']").popover();


    // $('#buh').click(function () {
    //     $('.buh option[value=' + 18 + ']').attr('selected', 'selected').siblings().removeAttr('selected');
    // });

    // function clock() {
    //     var id = $(".app-time").attr('id');
    //     if (id) {
    //         jQuery.ajax({
    //             type: "GET",
    //             url: "site/time",
    //             data: 'id=' + id,
    //             success: function (data) {
    //                 $(".app-time").html(data);
    //             }
    //         });
    //     }
    // }


    // var hash = window.location.hash;
    // if (hash) {
    //     // alert(hash);
    //     $('#sidebar-wrapper').animate({scrollTop: $(hash).position().top - 200});
    // }


    // /**
    //  * Меняем время
    //  * Показываем время
    //  */
    // $("#app-id_user").change(function () {
    //     var val = $(this).val();
    //     if (val) {
    //         jQuery.ajax({
    //             type: "GET",
    //             url: "site/usertime",
    //             data: 'id=' + val,
    //             success: function (data) {
    //                 $("select#app-time").html(data);
    //                 alert(data);
    //             }
    //         });
    //     }

    //     $.get("http://webtest.snhrs.ru/usertime?id=" + $(this).val(), function (data) {
    //         $("select#app-mark_id").html(data);
    //     });
    // });
});




// function keyUp(event) {
//     if (event.keyCode == 13) {
//         event.preventDefault();
//     }
// }

// function keyDown(e) {
//     if (e.keyCode == 17)
//         ctrl = true;
//     else if (e.keyCode == 13 && ctrl) {
//         document.getElementById("btnComment").click();
//     } else {
//         ctrl = false;
//     }
// }

// function keyDownRecal(e) {
//     if (e.keyCode == 17)
//         ctrl = true;
//     else if (e.keyCode == 13 && ctrl) {
//         document.getElementById("btnRecal").click();
//     } else {
//         ctrl = false;
//     }
// }

// function show(id) {
//     div = document.getElementById(id);
//     if (div.style.display == 'block') {
//         div.style.display = 'none';
//     } else {
//         div.style.display = 'block';
//     }
// }


// $(document).on('change', '#remark-text', function (event) {
//     var id = $(this).attr('data-id');
//     var text = $(this).val();

//     $.ajax({
//         type: "GET",
//         url: "/file-text",
//         data: "id=" + id + "&text=" + encodeURI(text),
//         success: function (data) {
//             var result = jQuery.parseJSON(data);
//             console.log(result);
//             animation(result, $('#show-message'))
//         }
//     });
// });


// $(document).on('change', '#remark-file-name', function (event) {
//     var id = $(this).attr('data-id');
//     var text = $(this).val();

//     $.ajax({
//         type: "GET",
//         url: "/file-text",
//         data: "id=" + id + "&name=" + encodeURI(text),
//         success: function (data) {
//             var result = jQuery.parseJSON(data);
//             console.log(result);
//             animation(result, $('#show-message'))
//         }
//     });
// });

// $(document).on('click', '.remark-act', function (event) {
//     var id = $(this).attr('id');
//     var text = $(this).val();

//     $('.remark-act:not(#' + id + ')').hide();  // hide everything that isn't #myDiv
// });


// function animation(result, selector) {
//     console.log(selector);

//     if (result.data === true)
//         selector.addClass('alert-success').html(result.message).show();
//     else
//         selector.addClass('alert-danger').html(result.message).show();

//     setTimeout(function () {
//         selector.removeClass('alert-danger', 'alert-success').hide()
//     }, 5000);
// }


// /**
//  * Меня расположение верхнего меню заявки при прокручиваниии вниз
//  */
// $(document).ready(function () {
//     $(window).scroll(function () {
//         var scrollValue = $(window).scrollTop();
//         if (scrollValue > 50) {
//             $('#myAffix').addClass('fixed');
//             $('#login-form').addClass('mt-5');
//         } else {
//             $('#myAffix').removeClass('fixed');
//             $('#login-form').removeClass('mt-5');
//         }
//     });
// });