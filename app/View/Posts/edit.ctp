<!-- File: /app/View/Posts/edit.ctp -->

<h1>Modifica Post</h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title', array('label'=>'Titolo'));
echo $this->Form->input('body', array('rows' => '3', 'label'=>'Contenuto'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Modifica');


// Esempio di import di file.css dinamico
  $this->append('css'); ?>  <!--- Import di stile direttamente dal file stesso --->
    <style>
      .miaclasse{ background-color: black; }
    </style>
  <?php $this->end();
  echo $this->Html->css('custom', ['inline' => FALSE]); //  Import di stile esterno da locale o da remoto (primo parametro)
?>
