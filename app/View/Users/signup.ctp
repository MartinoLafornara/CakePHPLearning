<!-- app/View/Users/add.ctp -->
<?php $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css',array('inline' => false)); ?>
<?php $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.2/css/bootstrapValidator.css',array('inline' => false)); ?>

<?php
    $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js',array('inline' => false));
    $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.it.min.js',array('inline' => false));
    $this->Html->script('https://momentjs.com/downloads/moment.min.js',array('inline' => false));

    // bsvalidator
    $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js',array('inline' => false));
    $this->Html->script('users/signup.js',array('inline' => false));
?>


<?= $this->Form->create('User', array('class'=>'form-horizontal',
    'action'=>'signup',
    'id'=>'signup_form',
    'inputDefaults' => array(
        'label' => false,
        'div' => false
        )
    )
);
?>
<!-- Form Name -->
<fieldset>
    <legend><center><h2><b><?=  __('Registrazione'); ?></b></h2></center></legend><br>
    <div class="form-group">
        <?= $this->Form->label('first_name','Nome',array('class' =>'col-md-4 control-label','for' => 'first_name')); ?>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <?= $this->Form->input('first_name', array(
                    'placeholder' => 'Nome',
                    'class' => 'form-control',
                    'id' => 'first_name',
                    'maxlength' => 30
                ));
                ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= $this->Form->label('last_name','Cognome',array('class' =>'col-md-4 control-label','for' => 'last_name')); ?>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <?= $this->Form->input('last_name', array(
                    'placeholder'=>'Cognome',
                    'class'=>'form-control',
                    'id' => 'last_name',
                    'maxlength' => 30
                ));
                ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= $this->Form->label('email','E-mail',array('class' =>'col-md-4 control-label','for' => 'email')); ?>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <?= $this->Form->input('email', array(
                'placeholder'=>'Indirizzo E-Mail',
                'class'=>'form-control',
                'type'=>'email',
                'id' => 'email'
                ));
                ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= $this->Form->label('date_birth','Data Nascita',array('class' =>'col-md-4 control-label','for' => 'date_birth')); ?>
        <div class="col-md-4 inputGroupContainer">
            <div class='input-group date' id='datapicker' >
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <?= $this->Form->input('date_birth', array(
                'class'=>'form-control',
                'type'=>'text',
                'placeholder' => 'gg/mm/yyyy',
                'id' => 'date_birth',
                'maxlength' => 10
                ));
                ?>
            </div>
        </div>
    </div>

    <!-- Password Input-->
    <div class="form-group">
        <?= $this->Form->label('password','Password',array('class' =>'col-md-4 control-label','for' => 'password')); ?>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <?= $this->Form->input('password', array(
                'placeholder'=>'Password',
                'class'=>'form-control',
                'id' => 'password',
                'maxlength' => 16
                )); ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= $this->Form->label('confirm_password','Conferma Password',array('class' =>'col-md-4 control-label','for' => 'confirm_password')); ?>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <?= $this->Form->input('confirm_password', array(
                'placeholder'=>'Conferma Password',
                'class'=>'form-control',
                'type' => 'password',
                'id' => 'confirm_password',
                'name' => 'confirm_password',
                'maxLength' => 16
                )); ?>
            </div>
        </div>
    </div>

    <?= $this->Form->submit(__('Registrati'),array('class'=>'btn btn-warning center-block','align'=>'center')); ?>
</fieldset>
<?= $this->Form->end(); ?>
