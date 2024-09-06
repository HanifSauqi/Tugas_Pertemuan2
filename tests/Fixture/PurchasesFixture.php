<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PurchasesFixture
 */
class PurchasesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'motorcycle_id' => 1,
                'supplier_id' => 1,
                'model' => 'Lorem ipsum dolor sit amet',
                'year' => 1,
                'price' => 1.5,
                'quantity' => 1,
                'purchase_date' => '2024-09-06 12:29:20',
                'created' => '2024-09-06 12:29:20',
                'modified' => '2024-09-06 12:29:20',
            ],
        ];
        parent::init();
    }
}
