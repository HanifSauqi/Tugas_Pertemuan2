<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Cake\Log\Log;


/**
 * Reports Controller
 *
 * @method \App\Model\Entity\Report[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $startDate = $this->request->getQuery('start_date') ? FrozenTime::parse($this->request->getQuery('start_date')) : FrozenTime::now()->subMonth();
        $endDate = $this->request->getQuery('end_date') ? FrozenTime::parse($this->request->getQuery('end_date')) : FrozenTime::now();
    
        $customer = TableRegistry::getTableLocator()->get('Customer')
            ->find()
            ->where(function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('DATE(registration_date)', $startDate->format('Y-m-d'), $endDate->format('Y-m-d'));
            })
            ->all()
            ->toArray();
    
        $purchasesQuery = TableRegistry::getTableLocator()->get('Purchases')
            ->find()
            ->contain(['Suppliers', 'Motorcycles'])
            ->where(function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('DATE(purchase_date)', $startDate->format('Y-m-d'), $endDate->format('Y-m-d'));
            });
        $purchases = $purchasesQuery->all()->toArray();
    
        $transactionsQuery = TableRegistry::getTableLocator()->get('Transaction')
            ->find()
            ->contain(['Customer', 'Motorcycles'])
            ->where(function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('DATE(transaction_date)', $startDate->format('Y-m-d'), $endDate->format('Y-m-d'));
            });
        $transactions = $transactionsQuery->all()->toArray();

    
        $this->set(compact('customer', 'purchases', 'transactions', 'startDate', 'endDate'));
    }
    
    
    

    
    /**
     * View method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $report = $this->Reports->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('report'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $report = $this->Reports->newEmptyEntity();
        if ($this->request->is('post')) {
            $report = $this->Reports->patchEntity($report, $this->request->getData());
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }
        $this->set(compact('report'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $report = $this->Reports->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $report = $this->Reports->patchEntity($report, $this->request->getData());
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }
        $this->set(compact('report'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $report = $this->Reports->get($id);
        if ($this->Reports->delete($report)) {
            $this->Flash->success(__('The report has been deleted.'));
        } else {
            $this->Flash->error(__('The report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
