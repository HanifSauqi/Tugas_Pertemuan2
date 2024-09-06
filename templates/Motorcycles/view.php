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
            <?= $this->Html->link(__('Edit Motorcycle'), ['action' => 'edit', $motorcycle->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Motorcycle'), ['action' => 'delete', $motorcycle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $motorcycle->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Motorcycles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Motorcycle'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="motorcycles view content">
            <h3><?= h($motorcycle->brand) ?></h3>
            <table>
                <tr>
                    <th><?= __('Brand') ?></th>
                    <td><?= h($motorcycle->brand) ?></td>
                </tr>
                <tr>
                    <th><?= __('Model') ?></th>
                    <td><?= h($motorcycle->model) ?></td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= h($motorcycle->image) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($motorcycle->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Year') ?></th>
                    <td><?= $this->Number->format($motorcycle->year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($motorcycle->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Units Available') ?></th>
                    <td><?= $this->Number->format($motorcycle->units_available) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Transaction') ?></h4>
                <?php if (!empty($motorcycle->transaction)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Motorcycle Id') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('Transaction Type') ?></th>
                            <th><?= __('Transaction Date') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($motorcycle->transaction as $transaction) : ?>
                        <tr>
                            <td><?= h($transaction->id) ?></td>
                            <td><?= h($transaction->motorcycle_id) ?></td>
                            <td><?= h($transaction->customer_id) ?></td>
                            <td><?= h($transaction->transaction_type) ?></td>
                            <td><?= h($transaction->transaction_date) ?></td>
                            <td><?= h($transaction->amount) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Transaction', 'action' => 'view', $transaction->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Transaction', 'action' => 'edit', $transaction->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Transaction', 'action' => 'delete', $transaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
