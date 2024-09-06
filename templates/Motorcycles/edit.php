<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Motorcycle $motorcycle
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $motorcycle->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $motorcycle->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Motorcycles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="motorcycles form content">
            <?= $this->Form->create($motorcycle) ?>
            <fieldset>
                <legend><?= __('Edit Motorcycle') ?></legend>
                <?php
                echo $this->Form->control('brand');
                echo $this->Form->control('model');
                echo $this->Form->control('year');
                echo $this->Form->control('price');
                echo $this->Form->control('units_available');
                echo $this->Form->control('image', ['type' => 'file']);
                echo $this->Form->button(__('Update Motorcycle'));
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>