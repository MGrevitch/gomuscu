<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>

        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<?= $this->Form->button(__('Connexion')); ?>
<?= $this->Form->end() ?>
