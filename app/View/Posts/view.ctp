<!-- File: /app/View/Posts/view.ctp -->

<div class="container-fluid">
    <h3><?php echo h($post['Post']['title']); ?></h3>

    <p><small><b>Creato: </b> <?= $post['Post']['created']; ?></small></p>
    <p><small><b>Ultima Modifica: </b> <?= $post['Post']['modified']; ?></small></p>    
    <p><small><b>Autore: </b><?= $post['User']['first_name'].' '.$post['User']['last_name']; ?></small></p>
    <hr />
    <p><?php echo h($post['Post']['body']); ?></p>
</div>
