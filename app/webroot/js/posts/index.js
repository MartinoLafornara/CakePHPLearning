$('.delPost').on('click',function(e){
    $('#deletepostid').val($(this).data('postid'));
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

    if (pathname[pathname.length-1] == 'posts'){
        window.location = $(this).data("href");
    } else {
        var pathedit = '';
        for (let element of pathname) {
            if (element == 'posts') {
                break;
            }
            pathedit += element+'/';
        }
        window.location = pathedit+$(this).data("href");
    }
});
