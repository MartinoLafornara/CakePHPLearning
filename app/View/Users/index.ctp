<pre>
<?php print_r($users) ?>
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
