<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction $transaction
 */
// templates/Purchases/view.php
// templates/Transactions/view.php
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Transaction'), ['action' => 'edit', $transaction->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Transaction'), ['action' => 'delete', $transaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Transactions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Transaction'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="transactions view content">
            <h3><?= $transaction->has('motorcycle') ? h($transaction->motorcycle->model) : '' ?></h3>
            <table>
                <tr>
                    <th><?= __('Brand') ?></th>
                    <td><?= $transaction->has('motorcycle') ? h($transaction->motorcycle->brand) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Model') ?></th>
                    <td><?= $transaction->has('motorcycle') ? h($transaction->motorcycle->model) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $transaction->has('customer') ? h($transaction->customer->name) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Transaction Type') ?></th>
                    <td><?= h($transaction->transaction_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Transaction Date') ?></th>
                    <td><?= h($transaction->transaction_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($transaction->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Transaction Code') ?></th>
                    <td><?= h($transaction->transaction_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $transaction->has('creator') ? h($transaction->creator->username) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $transaction->has('modifier') ? h($transaction->modifier->username) : '' ?></td>
                </tr>

            </table>
        </div>
    </div>
</div>