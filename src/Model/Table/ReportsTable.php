<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PurchasesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('purchases');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // Definisikan asosiasi
        $this->belongsTo('Motorcycles', [
            'foreignKey' => 'motorcycle_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        // Tambahkan aturan validasi lainnya sesuai kebutuhan

        return $validator;
    }
}
