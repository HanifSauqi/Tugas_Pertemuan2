<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction $transaction
 * @var \Cake\Collection\CollectionInterface|string[] $motorcycles
 * @var \Cake\Collection\CollectionInterface|string[] $customer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Transaction'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="transaction form content">
            <?= $this->Form->create($transaction) ?>
            <fieldset>
                <legend><?= __('Add Transaction') ?></legend>
                <?php
                    echo $this->Form->control('motorcycle_id', ['options' => $motorcycles]);
                    echo $this->Form->control('customer_id', ['options' => $customer]);
                    echo $this->Form->control('transaction_type');
                    echo $this->Form->control('transaction_date');
                    echo $this->Form->control('quantity');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
