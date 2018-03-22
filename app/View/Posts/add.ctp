<!-- File: /app/View/Posts/add.ctp -->

<h1>Aggiungi Post</h1>
<?php
  echo $this->Form->create('Post');
  echo $this->Form->input('title', array('label'=>'Titolo'));
  echo $this->Form->input('body', array('rows' => '3', 'label'=>'Contenuto'));
  echo $this->Form->end('Aggiungi');
?>
