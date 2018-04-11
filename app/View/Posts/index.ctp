<!-- File: /app/View/Posts/index.ctp -->

<!-- <h1>Test CakePHP 2.5.7</h1> -->

<?php //print_r($userLogged); ?>
<?php echo $this->Html->script('posts/index.js',array('inline' => false));?>


<div class="container-fluid">
    <h3>Posts</h3>
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
                <th>Titolo</th>
                <th>Data Inserimento</th>
                <th>Azioni</th>
            </tr>
        </thead>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
        <tr data-href="posts/view/<?= $post['Post']['id'] ?>">
            <td class='clickable-row'>
                <?php
                    echo $this->Html->link(
                        $post['Post']['title'],
                        array('action' => 'view', $post['Post']['id'])
                    );
                ?>
            </td>
            <td class='clickable-row'>
                <?php echo $post['Post']['created']; ?>
            </td>
            <td>
                <?php
                    echo $this->Html->link(
                        'Modifica',
                        array('action' => 'edit', $post['Post']['id']),
                        array('class' => ' btn btn-sm btn-outline-secondary')
                    );
                ?>
                <?php
                    // echo $this->Form->postLink(
                    //     'Elimina',
                    //     array('action' => 'delete', $post['Post']['id']),
                    //     array('confirm' => 'Sei sicuro?','id' => 'delPost')
                    // );
                    echo $this->Html->link(
                        'Elimina','',
                        array('class' => 'delPost btn btn-sm btn-outline-danger', 'data-postid' => $post['Post']['id'])
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
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                    <h5 class="modal-title">Eliminare</h5>
                </div>
                <div class="modal-body">
                    <p>Sicuro di voler eliminare questo post?</p>
                </div>
                <div class="modal-footer">
                    <?php echo $this->Form->create(false,array('controller' => 'posts','action' => 'delete')); ?>
                    <?= $this->Form->input('deletepostid',array('type'=>'hidden')); ?>
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
