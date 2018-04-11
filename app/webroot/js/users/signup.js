/**
 *   Popup del calendario durante l'inserimento della data di nascita.
 */
$('.input-group.date').datepicker({
    startDate: '-100y',
    endDate: '-18y',
    language:'it', //se utilizzo datepicker.it.js
    autoclose: 'true',
});

$('#date_birth').on('change', function (ev) {
    $('#date_birth').trigger('input');
    // Validazione durante l'evento change.(problema bootstrapValidator)
});

$('#email').on('change', function (ev) {
    $('#email').trigger('input');
});

/**
 *   evento Change => quando l'elemento perde il focus.
 *   - Prende il valore dell'input;
 *   - Elimina gli spazi finali;
 *   - Sostituisce eventuali spazi interni (1 o più) in un singolo carattere di spaziantura.
 */

$('#first_name,#last_name,#email').on('change',function(e){
    $('#'+e.currentTarget.id).val($('#'+e.currentTarget.id).val().trim().replace(new RegExp(' +', 'g'),' '));
});

/**
 *    evento keyup => rilascio del tasto
 *    - resetta il campo 'conferma password';
 *    - rivalida quel singolo campo con il trigger.
 */

$('#password').on('keyup',function(){
    if($('#confirm_password').val()!=''){
        $('#confirm_password').val('');
        $('#confirm_password').trigger('input');

        // 'Trigger Manuale'
        // $('#confirm_password').parents('div.form-group.has-feedback').removeClass('has-error has-success');
        // $('#confirm_password').closest('.inputGroupContainer').find('i.form-control-feedback').removeClass('glyphicon-ok gly');
    }
});


/* Per evitare che termini l'evento
  $('.divQualunque').on('click', function(e){
    e.preventDefault();
    return false;
  });
*/

/**
 *    bootstrapValidator (Libreria js)
 *    - Definisco le regole di validazione per ogni songolo campo (name attribute)
 *
 *    [Osservazione#1] => è possibile eseguire una callback durante la validazione
 *     di un singolo campo.
 *
 *    [Osservazione#2] => remote si usa per inviare richieste e validare il campo
 *     in base al risultato di quest'ultima.
 */

$('#signup_form').bootstrapValidator({
        // feedbackIcons: {
        //     //valid: 'glyphicon glyphicon-ok',
        //     invalid: 'glyphicon glyphicon-remove',
        //     validating: 'glyphicon glyphicon-refresh'
        // },
        fields: {
            "data[User][first_name]" :{
                validators: {
                    notEmpty: {
                        message: 'Campo obbligatorio.'
                    },
                    regexp: {
                        regexp: /^[a-z ]+$/i,
                        message: 'Sono ammessi solamente caratteri alfabetici e spazi.'
                    },
                    stringLength:{
                        message: 'Il nome deve contenere al massimo 30 caratteri.'
                    }
                }
            },
            "data[User][last_name]" : {
                validators: {
                    notEmpty: {
                        message: 'Campo obbligatorio.'
                    },
                    regexp: {
                        regexp: /^[a-z ]+$/i,
                        message: 'Sono ammessi solamente caratteri alfabetici e spazi.'
                    },
                    stringLength: {
                        message: 'Il nome deve contenere al massimo 30 caratteri.'
                    }
                }
            },
            "data[User][email]" : {
                validators: {
                    notEmpty: {
                        message: 'Campo obbligatorio.'
                    },
                    stringLength : {
                        min : 1,
                        message: 'Almeno un carattere'
                    },
                    emailAddress: {
                        message: " "
                    },
                    // remote: {
                    //     url : 'check_domain',
                    //     message : 'Email non valida.'
                    // }
                    // callback : {
                    //     message: 'prova message',
                    //     callback: function (value, validator) {
                    //         var check = $.get('check_duplicate?email='+value, function(data, response) {
                    //             //console.log(data, response);
                    //             console.log(data.valid);
                    //             if(data.valid){
                    //                 //$('#email').parents('div.form-group').removeClass('has-error has-success');
                    //                 validator.updateStatus('data[User][email]', 'INVALID', validator);
                    //                 validator.updateMessage('data[User][email]', 'Email già registrata');
                    //                 // $('#email').parents('div.form-group').addClass('has-error');
                    //                 console.log(validator);
                    //                 // $('#email').val('');
                    //             }
                    //         },'json');
                    //         return true;
                    //     }
                    // }
                }
            },
            "data[User][date_birth]" : {
                validators: {
                    notEmpty: {
                        message: 'Campo obbligatorio.'
                    },
                    date: {
                        format: "DD/MM/YYYY",
                        message: 'Data non valida.'
                    },
                    callback: {
                        callback: function(value, validator) {
                            var m =  moment(value, 'DD/MM/YYYY').format('YYYY/MM/DD');
                            var insert = moment(m);
                            var fine = moment(new Date()).format('YYYY/MM/DD');
                            var inizio = moment(new Date()).subtract(18, 'years').format('YYYY/MM/DD');
                            var inizio_datepicker = moment(new Date()).subtract(100, 'years').format('YYYY/MM/DD');
                            if (insert.isAfter(fine)||insert.isBefore(inizio_datepicker)) {
                                return {
                                    valid: false,
                                    message : ' '
                                }
                            }
                            //moment/().isBetween(YYYY/MM/DD, YYYY/MM/DD, null, '()]')
                            if (insert.isBetween(inizio,fine,null,'(]')) {
                                return {
                                    valid: false,
                                    message : 'Devi essere maggiorenne.'
                                }
                            }
                            return true;
                        }
                    }
                }
            },
            "data[User][password]" : {
                validators: {
                    notEmpty: {
                        message: 'Campo obbligatorio.'
                    },
                    regexp: {
                        regexp: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_#\$@%\*\-])[A-Za-z0-9_#\$@%\*\-]{8,16}$/,
                        message: 'La password deve avere lunghezza compresa tra 8 e 16 caratteri.<br> Almeno una maiuscola, una minuscola, un numero e un carattere consentito (_#$@%*-).'
                    }
                    // identical: {
                    //     field: 'confirm_password',
                    //     message: 'Conferma la tua password.'
                    // }
                }
            },
            confirm_password : {
                validators : {
                    identical: {
                        field: "data[User][password]",
                        message: 'Le password non coincidono.'
                    },
                    notEmpty: {
                        message: 'Conferma la tua password.'
                    }
                }
            }
        }
});

/**
 * evento change di #email
 *
 * - Faccio una get a un metodo interno (controllo duplicati email).
 * - Faccio una get per verificare il dominio email.
 */

$('#email').on('change', function(){
    if ($('#email').val()!=''){
        $.get('check_duplicate?email='+$('#email').val(), function(data,response){
            if(data.valid){
                //console.log('duplicato');
                //$('#email').parents('div.form-group').removeClass('has-error has-success');
                //$('#email').parents('div.form-group').addClass('has-error');
                $('#signup_form').data('bootstrapValidator').updateStatus('data[User][email]', 'INVALID', 'stringLength');
                $('#signup_form').data('bootstrapValidator').updateMessage('data[User][email]', 'stringLength', 'Email già registrata.');

            }
        },'json');

        $.get('check_domain?email='+$('#email').val(), function(data,response){
            if(!data.valid){
                $('#signup_form').data('bootstrapValidator').updateStatus('data[User][email]', 'INVALID', 'stringLength');
                $('#signup_form').data('bootstrapValidator').updateMessage('data[User][email]', 'stringLength', 'Email non valida.');
            }
        },'json');
    }
});


//GET con Javascript

// $('#email').on('change', function (ev) {
////    var hostname = $('#email').val().split("@")[1];
//     console.log('https://dns-api.org/MX/'+hostname);
//     $.get('https://dns-api.org/MX/'+hostname,function(data, response){
//         if(data.error){
//             console.log('sbagliato');
//         }
//      },'json');
// });
