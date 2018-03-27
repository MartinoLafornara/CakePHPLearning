<!-- app/View/Users/add.ctp -->
<?php $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css',array('inline'=>False)); ?>

<?= $this->Form->create('User', array('class'=>'well form-horizontal','id'=>'contact_form','action'=>'signup')); ?>
<!-- Form Name -->
  <legend><center><h2><b><?=  __('Registrazione'); ?></b></h2></center></legend><br>

  <div class="form-group">
    <label class="col-md-4 control-label">Nome</label>
    <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <?= $this->Form->input('first_name', array('label'=>'','placeholder'=>'Nome','class'=>'form-control')); ?>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label">Cognome</label>
    <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <?= $this->Form->input('last_name', array('label'=>'','placeholder'=>'Cognome','class'=>'form-control')); ?>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label">E-Mail</label>
    <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
          <?= $this->Form->input('email', array('label'=>'','placeholder'=>'Indirizzo E-Mail','class'=>'form-control','type'=>'email')); ?>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label">Data Nascita</label>
    <div class="col-md-4 inputGroupContainer">
      <div class='input-group date' id='datapicker' >
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
        </span>
        <?= $this->Form->input('date_birth', array(
                                                'label'=>'',
                                                'class'=>'form-control',
                                                'type'=>'text',
                                                'empty' => true,
                                                'placeholder' => 'gg/mm/yyyy',
                                            ));?>
      </div>
    </div>
  </div>

  <!-- Password Input-->
  <div class="form-group">
    <label class="col-md-4 control-label" >Password</label>
    <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <?= $this->Form->input('password', array('label'=>'','placeholder'=>'Password','class'=>'form-control')); ?>
      </div>
    </div>
  </div>

    <div class="form-group">
      <label class="col-md-4 control-label" >Conferma Password</label>
      <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <?= $this->Form->input('confirm_password', array('label'=>'','placeholder'=>'Conferma Password','class'=>'form-control')); ?>
        </div>
      </div>
    </div>

  <?= $this->Form->submit(__('Registrati'),array('class'=>'btn btn-warning center-block','align'=>'center')); ?>

<?= $this->Form->end(); ?>

<?php
  $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js',array('inline' => false));
  $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.it.min.js',array('inline' => false));
  $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js',array('inline' => false));
  $this->Html->script('custom.js',array('inline' => false));
?>
