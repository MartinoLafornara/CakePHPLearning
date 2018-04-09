<!-- File: /app/View/Posts/edit.ctp -->
<div class="container-fluid">
    <h3>Modifica</h3>
    <hr />
    <?= $this->Form->create('Post'); ?>
        <fieldset>
            <div class="form-group">
                <?= $this->Form->input('title',array('label' => 'Titolo','class' => 'form-control','placeholder' => 'Inserisci Titolo')); ?>
            </div>
            <div class="form-group">
                <?= $this->Form->input('body',array('label' => 'Titolo','class' => 'form-control','placeholder' => 'Inserisci Contenuto','type' => 'textarea','rows' => '4')); ?>
                <small id="BodyHelp" class="form-text text-muted">Inserisci un contenuto sensibile.</small>
            </div>
            </fieldset>
            <?= $this->Form->input('id', array('type' => 'hidden')); ?>
            <?= $this->Form->submit(__('Aggiungi Post'),array('class'=>'btn btn-primary')); ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>
