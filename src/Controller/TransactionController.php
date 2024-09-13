<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Transaction Controller
 *
 * @property \App\Model\Table\TransactionTable $Transaction
 * @method \App\Model\Entity\Transaction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransactionController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Motorcycles', 'Customer'],
        ];
        $transactions = $this->paginate($this->Transaction);

        $this->set(compact('transactions'));
    }


    /**
     * View method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $transaction = $this->Transaction->get($id, [
            'contain' => ['Motorcycles', 'Customer', 'Creators', 'Modifiers']
            ]);
            // In src/Controller/ReportsController.php
            debug($transaction->creator);
            debug($transaction->modifier);

            $this->set(compact('transaction'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error(__('Transaction not found.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('TransactionCode');
        $this->loadModel('Transaction'); // Pastikan model di-load
        $this->loadComponent('Authentication.Authentication');
    }

    public function add()
    {
        $transaction = $this->Transaction->newEmptyEntity();
        if ($this->request->is('post')) {
            $transaction = $this->Transaction->patchEntity($transaction, $this->request->getData());
            $transaction->transaction_code = $this->TransactionCode->generateCode('PRC');
            $transaction->created_by = $this->request->getAttribute('identity')->getIdentifier();
            $transaction->modified_by = $this->request->getAttribute('identity')->getIdentifier();
            if ($this->Transaction->save($transaction)) {
                $this->Flash->success(__('The transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
        }
        $motorcycles = $this->Transaction->Motorcycles->find('list', [
            'keyField' => 'id',
            'valueField' => 'model'
        ])->select(['id', 'model'])->all();

        $customer = $this->Transaction->Customer->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->select(['id', 'name'])->all();

        $this->set(compact('transaction', 'motorcycles', 'customer'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transaction = $this->Transaction->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transaction = $this->Transaction->patchEntity($transaction, $this->request->getData());
            $transaction->modified_by = $this->request->getAttribute('identity')->getIdentifier();
            if ($this->Transaction->save($transaction)) {
                $this->Flash->success(__('The transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
        }
        $motorcycles = $this->Transaction->Motorcycles->find('list', [
            'keyField' => 'id',
            'valueField' => 'model'
        ])->select(['id', 'model'])->all();

        $customer = $this->Transaction->Customer->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->select(['id', 'name'])->all();

        $this->set(compact('transaction', 'motorcycles', 'customer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transaction = $this->Transaction->get($id);
        if ($this->Transaction->delete($transaction)) {
            $this->Flash->success(__('The transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
