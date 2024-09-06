<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Motorcycle> $motorcycles
 */
?>
<div class="motorcycles index content">
    <?= $this->Html->link(__('New Motorcycle'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Motorcycles') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('brand') ?></th>
                    <th><?= $this->Paginator->sort('model') ?></th>
                    <th><?= $this->Paginator->sort('year') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('units_available') ?></th>
                    <th><?= $this->Paginator->sort('image') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($motorcycles as $motorcycle): ?>
                <tr>
                    <td><?= $this->Number->format($motorcycle->id) ?></td>
                    <td><?= h($motorcycle->brand) ?></td>
                    <td><?= h($motorcycle->model) ?></td>
                    <td><?= $this->Number->format($motorcycle->year) ?></td>
                    <td><?= $this->Number->format($motorcycle->price) ?></td>
                    <td><?= $this->Number->format($motorcycle->units_available) ?></td>
                    <td><?= h($motorcycle->image) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $motorcycle->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $motorcycle->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $motorcycle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $motorcycle->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
