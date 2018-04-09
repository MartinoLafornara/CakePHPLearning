<?php echo  $this->Html->script('users/index.js',array('inline' => false));?>

<div class="container-fluid">
    <h3>Lista Utenti</h3>
    <hr>
    <div class='pagination'>
        <?php
        echo $this->Paginator->counter(
            '{:start} - {:end}'
        );
        ?>

    </div>

    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr class ='info'>
                <th>
                <?php
                echo $this->Paginator->sort('first_name', 'Nome');
                ?>
                </th>
                <th><?= $this->Paginator->sort('last_name', 'Cognome');?></th>
                <th>Email</th>
                <th>Data Registrazione</th>
                <th>Azioni</th>
            </tr>
        </thead>

        <?php foreach ($users as $user): ?>
            <tr class='clickable-row' data-href="users/view/<?= $user['User']['id'] ?>">
                <td>
                <?php  //$this->Html->link($user['User']['first_name'], array('action' => 'view', $user['User']['id']));  ?>
                <?= $user['User']['first_name']; ?>
                </td>
                <td>
                <?php //$this->Html->link($user['User']['last_name'], array('action' => 'view', $user['User']['id']));  ?>
                <?= $user['User']['last_name']; ?>
                </td>
                <td>
                <?= $user['User']['email'] ?>
                </td>
                <td>
                <?= $user['User']['created'] ?>
                </td>
                <td>
                    <?php
                        echo $this->Html->link(
                            'Modifica',
                            array('action' => 'edit', $user['User']['id'])
                        );
                    ?>
                    <?php
                        echo $this->Html->link(
                            'Elimina','',
                            array('class' => 'delUser', 'data-userid' => $user['User']['id'])
                        );
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div>
        <ul class="pagination">
            <?php
            echo $this->Paginator->first('<<', array(
                'tag' => 'li'
            ));
            if($this->paginator->hasPrev()){
                echo $this->Paginator->prev(__('Precedente'), array('tag' => 'li'),null,array('class' => 'disabled'));
            }
            echo $this->Paginator->numbers(array(
                'modulus' => 2,
                'tag' => 'li',
                'separator' => null,
                'currentClass' => 'active',
                'currentTag'=>'a',
            ));
            if($this->paginator->hasNext()){
                echo $this->Paginator->next(__('Successivo'), array('tag' => 'li'));
            }
            echo $this->Paginator->last('>>', array(
                'tag' => 'li'
            ));
            ?>
        </ul>
    </div>

    <div class="modal" id='mymodal'>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <?= $this->Form->button('<span aria-hidden="true">&times;</span>', array(
                        'type'=>'button',
                        'class' => 'close',
                        'data-dismiss' => 'modal',
                        'class' => 'close closemodal',
                        'aria-label' => 'Close',
                        'escape' => false
                        )
                    ); ?>
                    <h5 class="modal-title">Eliminare</h5>
                </div>
                <div class="modal-body">
                    <p>Sicuro di voler eliminare questo utente?</p>
                </div>
                <div class="modal-footer">
                    <?php echo $this->Form->create(false,array('controller' => 'users','action' => 'delete')); ?>
                    <?= $this->Form->input('deleteuserid',array('type'=>'hidden')); ?>
                    <?php
                    //echo $this->Form->postLink('Elimina',array('action' => 'delete'),array('class' => 'btn btn-primary'));
                    ?>
                    <?= $this->Form->button('Annulla', array(
                        'type' => 'button',
                        'class' => 'btn btn-secondary closemodal',
                        'data-dismiss' => 'modal'
                        )
                    ); ?>
                    <?php echo $this->Form->button('Elimina',array('class' => 'btn btn-primary','type'=>'submit'));?>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
