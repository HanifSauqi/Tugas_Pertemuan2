<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Purchase Entity
 *
 * @property int $id
 * @property int $motorcycle_id
 * @property int $supplier_id
 * @property string $model
 * @property int $year
 * @property string $price
 * @property int $quantity
 * @property \Cake\I18n\FrozenTime $purchase_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Motorcycle $motorcycle
 * @property \App\Model\Entity\Supplier $supplier
 */
class Purchase extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'motorcycle_id' => true,
        'supplier_id' => true,
        'model' => true,
        'year' => true,
        'price' => true,
        'quantity' => true,
        'purchase_date' => true,
        'created' => true,
        'modified' => true,
        'motorcycle' => true,
        'supplier' => true,
    ];
}
