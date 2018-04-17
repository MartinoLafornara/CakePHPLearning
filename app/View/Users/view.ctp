<h5><?php print_r($user) ?></h5>
<!-- Import CSS -->
<?php $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.2/css/bootstrapValidator.css',array('inline' => false)); ?>

<!-- Import JavaScript -->
<?php
$this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js',array('inline' => false));
$this->Html->script('users/view.js',array('inline' => false));
?>

<div class="container-fluid">
    <div class="row">
  		<div class="col-sm-10"><h3><?= $user['User']['first_name'].' '.$user['User']['last_name'] ?></h3></div>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <ul class="nav nav-tabs" id="myTab">
                <li class='active'><a href="#changeEmail" data-toggle="tab">Cambio Email</a></li>
                <li><a href="#changePassword" data-toggle="tab">Aggiorna Password</a></li>
            </ul>
            <div class="tab-content">
                <br>
                <div class="tab-pane active" id='changeEmail'>
                    <?php
                    echo $this->Form->create('User',array(
                            "url" => array('controller' => 'users','action' => 'edit',$user['User']['id']),
                            'inputDefaults' => array(
                                'div' => false,
                                'label' => false,
                            ),
                            'id'=>'change_email_form',
                            'class' => 'col-xs-12'
                        )
                    );
                    ?>
                    <fieldset>
                    <div class="form-group col-md-4">
                        <?= $this->Form->label('email','Email',array('class' =>'control-label','for' => 'email')); ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <?php
                            echo $this->Form->input('email',array(
                                    'class' => 'form-control',
                                    'type' => 'email',
                                    'id' => 'email'
                                )
                            );
                            ?>
                        </div>
                    </div>

                    <div class="form-group col-md-9">
                    <?php
                        echo $this->Form->button('Cambia Email <i class="glyphicon glyphicon-ok-sign"></i>',array(
                            'class' => 'btn btn-success',
                            'type' => 'submit',
                            'escape' => false
                            )
                        );
                    ?>
                    </div>
                    </fieldset>
                    <?php echo $this->Form->end(); ?>
                </div>
                <div class="tab-pane" id="changePassword">
                    <?php
                    echo $this->Form->create('User',array(
                            "url" => array('controller' => 'users','action' => 'edit',$user['User']['id']),
                            'inputDefaults' => array(
                                'div' => false,
                                'label' => false,
                            ),
                            'id'=>'change_password_form',
                            'class' => 'col-md-4'
                        )
                    );
                    ?>
                    <div class="form-group">
                        <?php
                        echo $this->Form->input('user_id', array(
                            'type' => 'hidden',
                            'value'=> $user['User']['id'],
                            'id' => 'user_id'
                            )
                        );
                        ?>
                        <?= $this->Form->label('check_password','Password Attuale',array('class' =>'control-label','for' => 'check_password')); ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <?php
                            echo $this->Form->input('check_password', array(
                            'placeholder'=>'Password Attuale',
                            'class' => 'form-control',
                            'type' => 'password',
                            'id' => 'check_password',
                            'maxlength' => 16
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->label('password','Nuova Password',array('class' =>'control-label','for' => 'password')); ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <?php
                            echo $this->Form->input('password', array(
                            'placeholder'=>'Nuova Password',
                            'class'=>'form-control',
                            'id' => 'password',
                            'maxlength' => 16
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->label('confirm_password','Conferma Nuova Password',array('class' =>'control-label','for' => 'confirm_password')); ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <?php
                            echo $this->Form->input('confirm_password', array(
                            'placeholder'=>'Nuova Password',
                            'type' => 'password',
                            'class'=>'form-control',
                            'id' => 'confirm_password',
                            'maxlength' => 16
                            ));
                            ?>
                        </div>
                    </div>
                    <?php
                    echo $this->Form->button('Cambia Password <i class="glyphicon glyphicon-ok-sign"></i> ',array(
                        'class' => 'btn btn-success',
                        'type' => 'submit',
                        'escape' => false
                        )
                    );
                    ?>
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
                <li class="list-group-item text-right"><span class="pull-left"><strong>Registrazione</strong></span><?= $user['User']['created'] ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Utente</strong></span><?= $user['User']['role'] ?></li>
            </ul>
        </div>
    </div>
</div>
