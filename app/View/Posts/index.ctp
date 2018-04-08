<!-- File: /app/View/Posts/index.ctp -->

<!-- <h1>Test CakePHP 2.5.7</h1> -->

<?php //print_r($userLogged); ?>


<div class="container-fluid">
    <h2>I tuoi Post</h2>
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
                <th>Azioni</th>
                <th>Data Inserimento</th>
            </tr>
        </thead>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
        <tr class='clickable-row'>
            <td>
                <?php
                    echo $this->Html->link(
                        $post['Post']['title'],
                        array('action' => 'view', $post['Post']['id'])
                    );
                ?>
            </td>
            <td>
                <?php
                    echo $this->Html->link(
                        'Modifica',
                        array('action' => 'edit', $post['Post']['id'])
                    );
                ?>
                <?php
                    echo $this->Form->postLink(
                        'Elimina',
                        array('action' => 'delete', $post['Post']['id']),
                        array('confirm' => 'Sei sicuro?')
                    );
                ?>
            </td>
            <td>
                <?php echo $post['Post']['created']; ?>
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
