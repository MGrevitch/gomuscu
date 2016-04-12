<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Inscription') ?></legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->input('email', ['type' => 'email']) ?>
    </fieldset>
<?= $this->Form->button(__('S\'inscrire')); ?>
<?= $this->Form->end() ?>
