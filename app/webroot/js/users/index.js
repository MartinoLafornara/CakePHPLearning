/**
 *   Javascript simile a posts/index.js
 */

$('.delUser').on('click',function(e){
    $('#deleteuserid').val($(this).data('userid'));
    $('#mymodal').css('display', 'block');
    // console.log('cliccato');
    e.preventDefault();
    return false;
});

$('.closemodal').on('click', function(e){
    $('#mymodal').css('display', 'none');
});

$(".clickable-row").on('click', function (e) {

    pathname = location.pathname.split('/');

    if (pathname[pathname.length-1] == 'users'){
        window.location = $(this).parent().data("href");
    } else {
        var pathedit = '';
        for (let element of pathname) {
            if (element == 'users') {
                break;
            }
            pathedit += element+'/';
        }
        window.location = pathedit+$(this).parent().data("href");
    }
});
