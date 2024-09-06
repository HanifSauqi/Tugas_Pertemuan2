<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $customer
 * @var \Cake\Collection\CollectionInterface $purchases
 * @var \Cake\Collection\CollectionInterface $transactions
 * @var \Cake\I18n\FrozenTime $startDate
 * @var \Cake\I18n\FrozenTime $endDate
 */
?>
<div class="reports index content">
    <h3><?= __('Report') ?></h3>
    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <fieldset>
        <legend><?= __('Select Period') ?></legend>
        <?= $this->Form->control('start_date', ['type' => 'date', 'default' => $startDate->format('Y-m-d')]) ?>
        <?= $this->Form->control('end_date', ['type' => 'date', 'default' => $endDate->format('Y-m-d')]) ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

    <div style="margin-top: 30px;"></div> <!-- Add space between sections -->

    <h4><?= __('Customers') ?></h4>
    <table>
        <thead>
            <tr>
                <th><?= __('Date') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Address') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customer as $customers): ?>
                <tr>
                    <td><?= h($customers->registration_date->i18nFormat('yyyy-MM-dd')) ?></td>
                    <td><?= h($customers->name) ?></td>
                    <td><?= h($customers->address) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="margin-top: 30px;"></div> <!-- Add space between sections -->

    <h4><?= __('Purchases') ?></h4>
    <table>
        <thead>
            <tr>
                <th><?= __('Date') ?></th>
                <th><?= __('Motorcycle') ?></th>
                <th><?= __('Supplier') ?></th>
                <th><?= __('Quantity') ?></th>
                <th><?= __('Price') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchases as $purchase): ?>
                <tr>
                    <td><?= h($purchase->purchase_date->i18nFormat('yyyy-MM-dd')) ?></td>
                    <td><?= h($purchase->motorcycle->model) ?></td>
                    <td><?= h($purchase->supplier->name) ?></td>
                    <td><?= h($purchase->quantity) ?></td>
                    <td><?= $this->Number->format($purchase->price) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="margin-top: 30px;"></div> <!-- Add space between sections -->

    <h4><?= __('Transactions') ?></h4>
    <table>
        <thead>
            <tr>
                <th><?= __('Date') ?></th>
                <th><?= __('Motorcycle') ?></th>
                <th><?= __('Customer') ?></th>
                <th><?= __('Transaction Type') ?></th>
                <th><?= __('Quantity') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?= $transaction->transaction_date ? h($transaction->transaction_date->i18nFormat('yyyy-MM-dd')) : '' ?></td>
                    <td><?= h($transaction->motorcycle->model) ?></td>
                    <td><?= h($transaction->customer->name) ?></td>
                    <td><?= h($transaction->transaction_type) ?></td>
                    <td><?= $this->Number->format($transaction->quantity) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>