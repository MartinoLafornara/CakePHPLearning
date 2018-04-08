$(".clickable-row").on('click', function (e) {

    pathname = location.pathname.split('/');

    if (pathname[pathname.length-1] == 'users'){
        window.location = $(this).data("href");
    } else {
        var pathedit = '';
        for (let element of pathname) {
            if (element == 'users') {
                break;
            }
            pathedit += element+'/';
        }
        window.location = pathedit+$(this).data("href");
    }
});
