<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MotorcyclesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MotorcyclesTable Test Case
 */
class MotorcyclesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MotorcyclesTable
     */
    protected $Motorcycles;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Motorcycles',
        'app.Transaction',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Motorcycles') ? [] : ['className' => MotorcyclesTable::class];
        $this->Motorcycles = $this->getTableLocator()->get('Motorcycles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Motorcycles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MotorcyclesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
