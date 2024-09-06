<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transaction Entity
 *
 * @property int $id
 * @property int $motorcycle_id
 * @property int $customer_id
 * @property string $transaction_type
 * @property \Cake\I18n\FrozenTime $transaction_date
 * @property string $amount
 *
 * @property \App\Model\Entity\Motorcycle $motorcycle
 */
class Transaction extends Entity
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
        'customer_id' => true,
        'transaction_type' => true,
        'transaction_date' => true,
        'quantity' => true,
        'motorcycle' => true,
    ];
}
