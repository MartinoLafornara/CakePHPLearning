<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php
      echo $this->Html->link("#PostIT",array('controller'=>'pages','action' => 'home'), array('class' => 'navbar-brand'));
      ?>

    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-2">
      <ul class="nav navbar-nav navbar-right">
        <li><?= $this->Html->link('Home',array('controller' => 'pages', 'action' => 'home'));?></li>
      	<li><?= $this->Html->link('Signup',array('controller' => 'users', 'action' => 'signup'));?></li>

        <?php if(isset($userLogged)): ?>
            <li>
            <?= $this->Html->link('Login',array('controller'=>'posts', 'action'=>'index'),array('class' => 'btn btn-default btn-outline btn-circle'));?>
            </li>
        <?php else: ?>
            <li>
            <a class="btn btn-default btn-outline btn-circle"  data-toggle="collapse" data-target="#nav-collapse2" aria-expanded="false" aria-controls="nav-collapse2">Login</a>
            </li>
        <?php endif; ?>
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
