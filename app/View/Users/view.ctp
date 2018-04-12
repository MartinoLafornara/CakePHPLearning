<pre>
<h5><?php print_r($user) ?></h5>
</pre>


<div class="container-fluid">
    <div class="row">
  		<div class="col-sm-10"><h3><?= $user['User']['first_name'].' '.$user['User']['last_name'] ?></h3></div>
    </div>
    <div class="row">

        <!--  aggiunta-->
        <div class="col-sm-9">
            <ul class="nav nav-tabs" id="myTab">
                <li class='active'><a href="#settings" data-toggle="tab">Modifica utente</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="settings">
                        <?php echo $this->Form->create('User',array(
                            "url" => array('controller' => 'users','action' => 'edit',$user['User']['id'])
                            )
                        );
                        ?>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <?php echo $this->Form->input('email',array(
                                    'label' =>'<label for="email"><h4>Email</h4></label>',
                                    'class' => 'form-control',
                                    'type' => 'email'
                                    )
                                ); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <?php echo $this->Form->input('password',array(
                                    'label' =>'<label for="password"><h4>Password</h4></label>',
                                    'class' => 'form-control',
                                    'type' => 'password'
                                    )
                                ); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <?php echo $this->Form->button('<i class="glyphicon glyphicon-ok-sign"></i> Salva',array('class' => 'btn btn-success','type'=>'submit','escape' => false));?>
                                <?php echo $this->Form->button('Ripristina',array('class' => 'btn','type'=>'reset'));?>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-3"><!--left col-->

          <ul class="list-group">
            <li class="list-group-item text-muted">Informazioni Utente</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Nome</strong></span><?= $user['User']['first_name'] ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Cognome</strong></span> <?= $user['User']['last_name'] ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span> <?= $user['User']['email'] ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Data Nascita</strong></span><?= $user['User']['date_birth'] ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Utente</strong></span><?= $user['User']['role'] ?></li>
          </ul>
          <ul class="list-group">
        </div>
    </div>
</div>
