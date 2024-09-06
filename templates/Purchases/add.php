<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchase $purchase
 * @var \Cake\Collection\CollectionInterface|string[] $motorcycles
 * @var \Cake\Collection\CollectionInterface|string[] $models
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Purchases'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="purchases form content">
            <?= $this->Form->create($purchase) ?>
            <fieldset>
                <legend><?= __('Add Purchase') ?></legend>
                <?php
                    echo $this->Form->control('motorcycle_id', ['label' => 'Brand', 'options' => $motorcycles]);
                    echo $this->Form->control('supplier_id', ['label' => 'Supplier', 'options' => $suppliers]);
                    echo $this->Form->control('model', ['label' => 'Model', 'options' => $models]);
                    echo $this->Form->control('year');
                    echo $this->Form->control('price');
                    echo $this->Form->control('quantity');
                    echo $this->Form->control('purchase_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
