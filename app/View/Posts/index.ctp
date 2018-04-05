<!-- File: /app/View/Posts/index.ctp -->

<!-- <h1>Test CakePHP 2.5.7</h1> -->
<pre>
<?php print_r($userLogged); ?>
<?php print_r($data); ?>
</pre>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Titolo</th>
            <th>Azioni</th>
            <th>Data Inserimento</th>
        </tr>
    </thead>

<!-- Here's where we loop through our $posts array, printing out post info -->

<?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
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
