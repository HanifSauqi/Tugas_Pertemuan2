<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction $transaction
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Transaction'), ['action' => 'edit', $transaction->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Transaction'), ['action' => 'delete', $transaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Transaction'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Transaction'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="transaction view content">
            <h3><?= h($transaction->transaction_type) ?></h3>
            <table>
                <tr>
                    <th><?= __('Motorcycle') ?></th>
                    <td><?= $transaction->has('motorcycle') ? h($transaction->motorcycle->model) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Transaction Type') ?></th>
                    <td><?= h($transaction->transaction_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $transaction->has('customer') ? h($transaction->customer->name) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('quantity') ?></th>
                    <td><?= $this->Number->format($transaction->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Transaction Date') ?></th>
                    <td><?= h($transaction->transaction_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
