<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('username', 'string', ['limit' => 50])
        ->addColumn('email', 'string', ['limit' => 100])
        ->addColumn('password', 'string', ['limit' => 255])
        ->addColumn('role', 'string', ['limit' => 20])
        ->addColumn('created', 'datetime')
        ->addColumn('modified', 'datetime')
        
        ->create();
    }
}
