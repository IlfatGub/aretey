$(function () {
    $('.modalButton').click(function () {
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
        $('.modal-dialog').addClass('modal-lg');
    });
});


/**
 *
 * @param controller
 * @param action
 * @param content_block
 * @param val
 * @param val2
 */
function getUrl(controller, action, content_block, val, val2) {
    let remark_report = document.querySelector(content_block);

    if (remark_report) remark_report.classList.add('op03');

    let url;
    if (val && val2)
        url = 'val=' + val + "&val2=" + val2;

    jQuery.ajax({
        type: "GET",
        url: "/" + controller + "/" + action,
        data: url,
        success: function (data) {
            $(content_block).html(data);
            $('.progress').hide();

            if (remark_report) remark_report.classList.remove('op03');
        },
    });
}


// ------------------------------ Отчет по пользователям -----------------------------------------
// const price_input = document.querySelectorAll('.price-input');


document.body.addEventListener("change", function(event){
    if (event.target.classList.contains('price-input')){
        let price = event.target;
        let price_id = price.getAttribute('data-id');
        let field = price.id;
        let text = price.value;
        let old_data = price.getAttribute('data-old');
        jQuery.ajax({
            type: "GET",
            url: "/prices/edit-field",
            data: 'id=' + price_id + "&field=" + field + "&value=" + text,
            beforeSend:function(){
                if(confirm("Вы точно хотите изменить данные?")){
                    return true;
                }else{
                    price.value = old_data;
                    return false;
                }
            },
            success: function (data) {
                let r = JSON.parse(data);
                    let div = document.createElement('div');
                    div.className = "notify";
                    div.innerHTML = r.message;
                  
                    document.body.append(div);
                    setTimeout(() => div.remove(), 3000);
            },
        });
    }
});

// if (price_input) {
//     price_input.forEach(function (price) {
//         price.addEventListener('change', () => {
//             let price_id = price.getAttribute('data-id');
//             let field = price.id;
//             let text = price.value;
//             let old_data = price.getAttribute('data-old');
//             jQuery.ajax({
//                 type: "GET",
//                 url: "/prices/edit-field",
//                 data: 'id=' + price_id + "&field=" + field + "&value=" + text,
//                 beforeSend:function(){
//                     if(confirm("Вы точно хотите изменить данные?")){
//                         return true;
//                     }else{
//                         price.value = old_data;
//                         return false;
//                     }
//                 },
//                 success: function (data) {
//                     let r = JSON.parse(data);
//                         let div = document.createElement('div');
//                         div.className = "notify";
//                         div.innerHTML = r.message;
                      
//                         document.body.append(div);
//                         setTimeout(() => div.remove(), 3000);
//                 },
//             });
//         });
//     })
// }

// $(document).ready( //Выполнить, когда дерево элементов готово (jQuery)
//     function(){
//         getReportRemark('report', 'get-user-app', '#userapp-remark-content');
//     }
// );

// ------------------------------ Отчет по пользователям -----------------------------------------