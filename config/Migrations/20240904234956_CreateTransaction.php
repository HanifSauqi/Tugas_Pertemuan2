<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTransaction extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('transaction');
        $table->addColumn('motorcycle_id', 'integer')
        ->addColumn('customer_id', 'integer')
        ->addColumn('transaction_type', 'string', ['limit' => 50])
        ->addColumn('transaction_date', 'datetime')
        ->addColumn('amount', 'decimal', ['precision' => 10, 'scale' => 2])
        ->addForeignKey('motorcycle_id', 'motorcycle', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->addForeignKey('customer_id', 'customer', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->create();
    }
}
