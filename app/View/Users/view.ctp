<h5><?php print_r($user) ?></h5>


<div class="container-fluid">
    <div class="row">
  		<div class="col-sm-10"><h3><?= $user['User']['first_name'].' '.$user['User']['last_name'] ?></h3></div>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <ul class="nav nav-tabs" id="myTab">
                <li class='active'><a href="#changeEmail" data-toggle="tab">Modifica Email</a></li>
                <li><a href="#changePassword" data-toggle="tab">Modifica Password</a></li>
            </ul>
        <?php
        // echo $this->Form->create('User',array(
        //         "url" => array('controller' => 'users','action' => 'edit',$user['User']['id']),
        //         'inputDefaults' => array(
        //             'div' => false
        //         ),
        //         'class' => 'col-sm-9'
        //     )
        // );
        ?>
            <div class="tab-content">
                <br>
                <div class="tab-pane active" id='changeEmail'>
                    <?php
                    echo $this->Form->create('User',array(
                            "url" => array('controller' => 'users','action' => 'edit',$user['User']['id']),
                            'inputDefaults' => array(
                                'div' => false,
                                'label' => false
                            ),
                            'class' => 'col-xs-12'
                        )
                    );
                    ?>
                    <div class="form-group col-md-4">
                        <?= $this->Form->label('email','Email',array('class' =>'control-label','for' => 'first_name')); ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <?php
                            echo $this->Form->input('email',array(
                                    'class' => 'form-control',
                                    'type' => 'email'
                                )
                            );
                            ?>
                        </div>
                    </div>
                    <div class="form-group col-xs-6">
                        <?php
                        echo $this->Form->button('<i class="glyphicon glyphicon-ok-sign"></i> Invia',array(
                                'class' => 'btn btn-success',
                                'type' => 'submit',
                                'escape' => false
                            )
                        );
                        ?>
                    </div>
                    <!-- </div> -->
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <?php //echo $this->Form->end(); ?>
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
