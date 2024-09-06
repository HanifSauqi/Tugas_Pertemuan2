<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Motorcycle Entity
 *
 * @property int $id
 * @property string $brand
 * @property string $model
 * @property int $year
 * @property string $price
 * @property int $units_available
 * @property string|null $image
 *
 * @property \App\Model\Entity\Transaction[] $transaction
 */
class Motorcycle extends Entity
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
        'brand' => true,
        'model' => true,
        'year' => true,
        'price' => true,
        'units_available' => true,
        'image' => true,
        'transaction' => true,
    ];

}
