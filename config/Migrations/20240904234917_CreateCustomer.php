<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCustomer extends AbstractMigration
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
        $table = $this->table('customer');
        $table->addColumn('name', 'string', ['limit' => 255])
        ->addColumn('address', 'text')
        ->addColumn('phone', 'string', ['limit' => 20])
        ->addColumn('email', 'string', ['limit' => 255])
        ->create();
    }
}
