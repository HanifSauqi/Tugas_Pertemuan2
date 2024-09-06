<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddRegistrationDateToCustomers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('customer');
        $table->addColumn('registration_date', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ]);
        $table->update();
    }
}
