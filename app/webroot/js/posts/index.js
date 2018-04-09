$('.delPost').on('click',function(e){
    $('#deletepostid').val($(this).data('postid'));
    $('#mymodal').css('display', 'block');
    // console.log('cliccato');
    e.preventDefault();
    return false;
});

$('.closemodal').on('click', function(e){
    $('#mymodal').css('display', 'none');
})
