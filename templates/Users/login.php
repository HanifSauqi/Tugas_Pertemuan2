<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username or email and password') ?></legend>
        <?= $this->Form->control('username', ['label' => 'Username or Email']) ?>
        <?= $this->Form->control('password', ['label' => 'Password']) ?>
    </fieldset>
    <?= $this->Form->button(__('Login')) ?>
    <?= $this->Form->end() ?>
</div>
