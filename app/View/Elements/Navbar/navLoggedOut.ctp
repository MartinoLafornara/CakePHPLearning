<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?= $this->Html->link("FrontEnd", array('controller'=>'pages','action' => 'home'), array('class' => 'navbar-brand')); ?>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-2">
      <ul class="nav navbar-nav navbar-right">
      	<li><?= $this->Html->link("Home", array('controller'=>'pages','action' => 'home')); ?></li>
      	<li><?= $this->Html->link('Signup',array('controller'=>'users', 'action'=>'signup'));?></li>
      	<li><?= $this->Html->link('About',array('controller'=>'pages', 'action'=>'about'));?></li>
      	<li><?= $this->Html->link('Contattaci',array('controller'=>'pages', 'action'=>'contact'));?></li>
      	<li>
      	<a class="btn btn-default btn-outline btn-circle"  data-toggle="collapse" data-target="#nav-collapse2" aria-expanded="false" aria-controls="nav-collapse2">Login</a>
    	</li>
      </ul>
      <div class="collapse nav navbar-nav nav-collapse" id="nav-collapse2">
        <?= $this->Session->flash('auth'); ?>
        <?= $this->Form->create('User', array('class'=>'navbar-form navbar-right form-inline','role'=>'form','action'=>'login')); ?>
        <div class="form-group">
          <?= $this->Form->input('email',array('class'=>'form-control','placeholder'=>'Email','label'=>'','type'=>'email','id'=>'UserEmail_login')); ?>
        </div>
        <div class="form-group">
          <?= $this->Form->input('password',array('class'=>'form-control','placeholder'=>'Password','label'=>'','id'=>'UserPassword_login')); ?>
        </div>
        <?= $this->Form->button(__('Login'),array('class'=>'btn btn-success')); ?>
        <?= $this->Form->end(); ?>
      </div>
    </div>
  </div>
</nav>
