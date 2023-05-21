$(function () {
    $('.modalButton').click(function(){
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
const price_input = document.querySelector('.price-input');

if (price_input){

    price_input.forEach(function(price) {
        price.addEventListener('click', function() {
            let price_id = this.getAttribute('data-id');
            let id = this.id;
            let text = this.value;
            console.log(this);
            console.log(text);
            console.log(id);
            console.log(price_id);
        });
    }


    // let dp = document.querySelector('#userapp-report-datepicker-kvdate');
    // let select = document.querySelector('#userapp-report-select');

    // setFilter('userapp-report-datepicker-kvdate', '#userapp-report-select', userapp_report_btn); //устанавливаем значения фильтра

    // userapp_report_btn.addEventListener('click', function(){
    //     let user_id = getOptionsValue(select); //получаем данные из выпадающего списка

    //     getReportRemark('report', 'get-user-app', '#userapp-remark-content', dp.firstElementChild.value, dp.lastElementChild.value, JSON.stringify(user_id));

    // });

}

// $(document).ready( //Выполнить, когда дерево элементов готово (jQuery)
//     function(){
//         getReportRemark('report', 'get-user-app', '#userapp-remark-content');
//     }
// );

// ------------------------------ Отчет по пользователям -----------------------------------------