$('.input-group.date').datepicker({
    startDate: '-100y',
    endDate: '-18y',
    language:'it',
    autoclose: 'true',
});

$('form').on('submit', function(){
  // cambio il formato della data di nascita
  var dataNascita = moment($('#UserDateBirth').val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
  $('#UserDateBirth').val(dataNascita);
});


/* Per evitare che termini l'evento
  $('.divQualunque').on('click', function(e){
    e.preventDefault();
    return false;
  });
*/
