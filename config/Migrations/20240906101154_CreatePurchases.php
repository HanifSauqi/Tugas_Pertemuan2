<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePurchases extends AbstractMigration
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
        $table = $this->table('purchases');
        $table->addColumn('motorcycle_id', 'integer')
              ->addColumn('supplier_id', 'integer')
              ->addColumn('model', 'string', ['limit' => 255])
              ->addColumn('year', 'integer')
              ->addColumn('price', 'decimal', ['precision' => 10, 'scale' => 2])
              ->addColumn('quantity', 'integer')
              ->addColumn('purchase_date', 'datetime')
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addForeignKey('motorcycle_id', 'motorcycles', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
              ->addForeignKey('supplier_id', 'suppliers', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
              ->create();
    }
}
