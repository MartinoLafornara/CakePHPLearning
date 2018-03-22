<!--- app/View/Users/login.ctp  --->

<div class="users form">
<?= $this->Session->flash('auth'); ?>
<?= $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?= __('Accedi'); ?>
        </legend>
        <?= $this->Form->input('username',['label'=>'Utente']); ?>
        <?= $this->Form->input('password'); ?>
    </fieldset>
<?= $this->Form->end(__('Login')); ?>
</div>
