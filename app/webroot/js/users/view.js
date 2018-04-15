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
