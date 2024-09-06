<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMotorcycles extends AbstractMigration
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
        $table = $this->table('motorcycles');
        $table->addColumn('brand', 'string', ['limit' => 255])
        ->addColumn('model', 'string', ['limit' => 255])
        ->addColumn('year', 'integer')
        ->addColumn('price', 'decimal', ['precision' => 10, 'scale' => 2])
        ->addColumn('units_available', 'integer')
        ->addColumn('image', 'string', ['limit' => 255, 'null' => true])
        ->create();
    }
}
