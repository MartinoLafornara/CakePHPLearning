<pre>
<?php
echo $this->Paginator->sort('id');
echo '<br>';
// print_r($users)
echo $this->Paginator->numbers(array('first' => 1, 'last' => 2,'modulus' => 2,'after' => 'n','currentTag' => 'paginacorrente'));
echo '<br>';
echo $this->Paginator->counter(array(
    'format' => 'range'
));
echo '<br>';
echo $this->Paginator->prev(__('previous'), array('tag' => false));
echo $this->Paginator->next(__('next'), array('tag' => false));
echo '<br>';
echo $this->Paginator->first(3);
echo '<br>';
echo $this->Paginator->first('prima');
echo '<br>';
echo $this->Paginator->link('Sort by title on page 5',
    array('sort' => 'id', 'page' => 5, 'direction' => 'desc'));
?>

<?php print_r($data) ?>
</pre>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome Utente</th>
            <th>Email</th>
            <th>Data Registrazione</th>
        </tr>
    </thead>

    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['User']['id']; ?></td>
            <td>
            <?=  $this->Html->link($user['User']['first_name'].' '.$user['User']['last_name'], array('action' => 'view', $user['User']['id']));  ?>
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
