<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class TransactionCodeComponent extends Component
{
    public function generateCode($prefix)
    {
        $year = date('y');
        $month = date('m');
        $transactionTable = TableRegistry::getTableLocator()->get('Transaction');

        // Get the last transaction code for the current month
        $lastTransaction = $transactionTable->find()
            ->select(['transaction_code'])
            ->where([
                'transaction_code LIKE' => $prefix . $year . $month . '%'
            ])
            ->order(['transaction_code' => 'DESC'])
            ->first();

        if ($lastTransaction) {
            $lastNumber = (int)substr($lastTransaction->transaction_code, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . $year . $month . $newNumber;
    }
}
