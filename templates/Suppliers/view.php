<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier $supplier
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Supplier'), ['action' => 'edit', $supplier->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Supplier'), ['action' => 'delete', $supplier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplier->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Suppliers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Supplier'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="suppliers view content">
            <h3><?= h($supplier->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($supplier->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contact') ?></th>
                    <td><?= h($supplier->contact) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($supplier->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($supplier->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($supplier->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Address') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($supplier->address)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Purchases') ?></h4>
                <?php if (!empty($supplier->purchases)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Motorcycle Id') ?></th>
                            <th><?= __('Supplier Id') ?></th>
                            <th><?= __('Model') ?></th>
                            <th><?= __('Year') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Purchase Date') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($supplier->purchases as $purchases) : ?>
                        <tr>
                            <td><?= h($purchases->id) ?></td>
                            <td><?= h($purchases->motorcycle_id) ?></td>
                            <td><?= h($purchases->supplier_id) ?></td>
                            <td><?= h($purchases->model) ?></td>
                            <td><?= h($purchases->year) ?></td>
                            <td><?= h($purchases->price) ?></td>
                            <td><?= h($purchases->quantity) ?></td>
                            <td><?= h($purchases->purchase_date) ?></td>
                            <td><?= h($purchases->created) ?></td>
                            <td><?= h($purchases->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Purchases', 'action' => 'view', $purchases->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Purchases', 'action' => 'edit', $purchases->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Purchases', 'action' => 'delete', $purchases->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchases->id)]) ?>
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
