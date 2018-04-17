/**
 *    bootstrapValidator (Libreria js)
 *    - Definisco le regole di validazione per ogni songolo campo (name attribute)
 */

$('#change_email_form').bootstrapValidator({
    fields: {
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
            }
        }
    }
});

/**
 *    bootstrapValidator (Libreria js)
 *    - Definisco le regole di validazione per ogni songolo campo (name attribute)
 */

$('#change_password_form').bootstrapValidator({
    fields: {
        "data[User][password]" : {
            validators: {
                notEmpty: {
                    message: 'Campo obbligatorio.'
                },
                regexp: {
                    regexp: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_#\$@%\*\-])[A-Za-z0-9_#\$@%\*\-]{8,16}$/,
                    message: 'La password deve avere lunghezza compresa tra 8 e 16 caratteri.<br> Almeno una maiuscola, una minuscola, un numero e un carattere consentito (_#$@%*-).'
                }
            }
        },
        "data[User][confirm_password]" : {
            validators: {
                identical: {
                    field: "data[User][password]",
                    message: 'Le password non coincidono.'
                },
                notEmpty: {
                    message: 'Conferma la nuova password.'
                }
            }
        },
        "data[User][check_password]" : {
            validators: {
                notEmpty: {
                    message: ' '
                },
                stringLength : {
                    min : 1,
                    message: 'Almeno un carattere'
                },
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
        $.get('../check_duplicate?email='+$('#email').val(), function(data,response){
            if(data.valid){
                //console.log('duplicato');
                //$('#email').parents('div.form-group').removeClass('has-error has-success');
                //$('#email').parents('div.form-group').addClass('has-error');
                $('#change_email_form').data('bootstrapValidator').updateStatus('data[User][email]', 'INVALID', 'stringLength');
                $('#change_email_form').data('bootstrapValidator').updateMessage('data[User][email]', 'stringLength', 'Email già registrata.');
            }
        },'json');

        $.get('../check_domain?email='+$('#email').val(), function(data,response){
            if(!data.valid){
                $('#change_email_form').data('bootstrapValidator').updateStatus('data[User][email]', 'INVALID', 'stringLength');
                $('#change_email_form').data('bootstrapValidator').updateMessage('data[User][email]', 'stringLength', 'Email non valida.');
            }
        },'json');
    }
});

/**
 * evento change di #check_password
 *
 * - Faccio una post a un metodo interno (controllo password attuale).
 *
 */

$('#check_password').on('change',function(){
    data ='{"user_id":"'+$('#user_id').val()+'","check_password":"'+$('#check_password').val()+'"}';
    if($('#check_password').val()!='') {
        $.post('../check_password',JSON.parse(data),function(data,response){
            if(!data.valid){
                $('#change_password_form').data('bootstrapValidator').updateStatus('data[User][check_password]', 'INVALID', 'stringLength');
                $('#change_password_form').data('bootstrapValidator').updateMessage('data[User][check_password]', 'stringLength', 'Password errata!');
            }
        },'json');
    }
});

$('#password').on('keyup',function(){
    if($('#confirm_password').val()!='') {
        $('#confirm_password').val('');
        $('#confirm_password').trigger('input');
    }
});
