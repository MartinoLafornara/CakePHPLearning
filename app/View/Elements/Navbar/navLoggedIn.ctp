<nav class="navbar navbar-inverse">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-4">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <?= $this->Html->link("BackEnd", array('controller'=>'posts','action' => 'index'), array('class' => 'navbar-brand')); ?>
	</div>
	<div class="collapse navbar-collapse" id="navbar-collapse-4">
	  <ul class="nav navbar-nav navbar-right">
		  	<li><?= $this->Html->link("Home", array('controller'=>'pages','action' => 'home')); ?></li>
            <li><?=  $this->Html->link("I miei Post", array('controller'=>'posts' ,'action' => 'index')); ?> </li>
			<?php if($userLogged['role'] == 'admin'): ?>
			<li><?=  $this->Html->link("Lista Utenti", array('controller'=>'users' ,'action' => 'index')); ?> </li>
			<?php endif; ?>
			<li>
		    <a class="btn btn-default btn-outline btn-circle"  data-toggle="collapse" href="#nav-collapse4" aria-expanded="false" aria-controls="nav-collapse4">Profilo <i class=""></i> </a>
		    </li>
	  </ul>
	  <ul class="collapse nav navbar-nav nav-collapse" role="search" id="nav-collapse4">
		<!-- <li><a href="#">Support</a></li> -->
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $userLogged['first_name'].' '.$userLogged['last_name']?> <span class="caret"></span></a>
		  <ul class="dropdown-menu" role="menu">
			<li><?= $this->Html->link("Profilo", array('controller'=>'users','action' => 'view', $userLogged['id'])); ?></li>
			<!-- <li><a href="#">Settings</a></li> -->
            <li><?=  $this->Html->link("I miei Post", array('controller'=>'posts' ,'action' => 'index')); ?> </li>
			<li class="divider"></li>
			<li><?= $this->Html->link('Logout',array('controller'=>'users', 'action'=>'logout'));?></li>
		  </ul>
		</li>
	  </ul>
	</div>
  </div>
</nav>
