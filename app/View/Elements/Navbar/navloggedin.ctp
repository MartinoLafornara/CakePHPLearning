<div class="collapse navbar-collapse" id="navbar-collapse-2">
<ul class="nav navbar-nav navbar-right">
	<li><a href="#">Home</a></li>
	<li><?php echo $this->Html->link('Signup',array('controller'=>'users', 'action'=>'signup'));?><</li>
	<li><a href="#">About</a></li>
	<li><a href="#">Contact</a></li>
	<li>
		<a class="btn btn-default btn-outline btn-circle"  data-toggle="collapse" href="#nav-collapse2" aria-expanded="false" aria-controls="nav-collapse2">Sign in</a>
	</li>
</ul>
</div>
