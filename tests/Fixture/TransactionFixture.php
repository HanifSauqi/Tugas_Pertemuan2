<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TransactionFixture
 */
class TransactionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'transaction';
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
                'customer_id' => 1,
                'transaction_type' => 'Lorem ipsum dolor sit amet',
                'transaction_date' => '2024-09-04 23:59:11',
                'amount' => 1.5,
            ],
        ];
        parent::init();
    }
}
