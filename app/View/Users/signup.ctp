<!-- app/View/Users/add.ctp -->

<?= $this->Form->create('User', array('class'=>'well form-horizontal','id'=>'contact_form','action'=>'signup')); ?>
<!-- Form Name -->
  <legend><center><h2><b><?=  __('Registrazione'); ?></b></h2></center></legend><br>
  <!-- Username Input-->
  <div class="form-group">
    <label class="col-md-4 control-label">Username</label>
    <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <?= $this->Form->input('username', array('label'=>'','placeholder'=>'Username','class'=>'form-control')); ?>
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

  <?= $this->Form->submit(__('Registrati'),array('class'=>'btn btn-warning center-block','align'=>'center')); ?>

  <?= $this->Form->end(); ?>
