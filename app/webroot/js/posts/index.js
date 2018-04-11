/**
 *   Evento click su 'Elimina' di posts/index
 *   [Osservazione#1] => e.preventDefault(); return false; esegue la callback
 *   ma non viene eseguito l'evento indicato.
 *
 *   [Osservazione#2] => è possibile attribuire un dato a un elemento html
 *   indicando per convenzione l'attributo 'data-nome = 'valore''.
 */
$('.delPost').on('click',function(e){
    // $(#deletepostid) => input hidden del Modal
    $('#deletepostid').val($(this).data('postid'));
    // Viene visualizzato il modal modificando il css
    $('#mymodal').css('display', 'block');
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
