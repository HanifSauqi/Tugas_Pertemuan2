<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction $transaction
 * @var string[]|\Cake\Collection\CollectionInterface $motorcycles
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $transaction->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Transaction'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="transaction form content">
            <?= $this->Form->create($transaction) ?>
            <fieldset>
                <legend><?= __('Edit Transaction') ?></legend>
                <?php
                    echo $this->Form->control('motorcycle_id', ['options' => $motorcycles]);
                    echo $this->Form->control('customer_id', ['options' => $customer]);
                    echo $this->Form->control('transaction_type');
                    echo $this->Form->control('transaction_date');
                    echo $this->Form->control('amount');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
