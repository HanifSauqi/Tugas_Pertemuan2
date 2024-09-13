<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Register') ?></legend>
        <?= $this->Form->control('username', ['label' => 'Username']) ?>
        <?= $this->Form->control('email', ['label' => 'Email']) ?>
        <?= $this->Form->control('password', ['label' => 'Password']) ?>
        <?= $this->Form->control('role', ['label' => 'Role']) ?>
    </fieldset>
    <?= $this->Form->button(__('Register')) ?>
    <?= $this->Form->end() ?>
</div>
