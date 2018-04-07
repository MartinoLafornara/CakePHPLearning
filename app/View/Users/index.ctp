<?php //echo  $this->Html->script('users/index.js',array('inline' => false));?>

<div class="container-fluid">
    <h2>Lista Utenti</h2>
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
            </tr>
        </thead>

        <?php foreach ($users as $user): ?>
            <tr class='clickable-row'>
                <td>
                <?php  //$this->Html->link($user['User']['first_name'], array('action' => 'view', $user['User']['id']));  ?>
                <?php echo $user['User']['first_name']; ?>
                </td>
                <td>
                <?php //$this->Html->link($user['User']['last_name'], array('action' => 'view', $user['User']['id']));  ?>
                <?php echo $user['User']['last_name']; ?>
                </td>
                <td>
                <?= $user['User']['email'] ?>
                </td>
                <td>
                <?= $user['User']['created'] ?>
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
</div>
