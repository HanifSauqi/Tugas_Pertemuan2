<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;


/**
 * Reports Controller
 *
 * @method \App\Model\Entity\Report[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportsController extends AppController
{
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

    public function export()
    {
        $startDate = $this->request->getQuery('start_date') ? FrozenTime::parse($this->request->getQuery('start_date')) : FrozenTime::now()->subMonth();
        $endDate = $this->request->getQuery('end_date') ? FrozenTime::parse($this->request->getQuery('end_date')) : FrozenTime::now();

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

        $periode = $startDate->format('d F Y') . ' - ' . $endDate->format('d F Y');

        $this->exportToExcel(compact('purchases', 'transactions', 'periode'));
    }

    private function exportToExcel($data)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Pembelian dan Transaksi');
        $sheet->setCellValue('A4', 'Report Pembelian dan Transaksi');
        $sheet->setCellValue('A5', 'Tanggal');
        $sheet->setCellValue('B5', $data['periode']);

        // Sheet untuk Pembelian
        $sheet->setCellValue('A7', 'Laporan Pembelian');
        $row = 8;
        $sheet->setCellValue('A' . $row, 'Tanggal');
        $sheet->setCellValue('B' . $row, 'Model Motor');
        $sheet->setCellValue('C' . $row, 'Nama Supplier');
        $sheet->setCellValue('D' . $row, 'Jumlah');
        $sheet->setCellValue('E' . $row, 'Harga');

        $row = 9;
        foreach ($data['purchases'] as $purchase) {
            $sheet->setCellValue('A' . $row, $purchase->purchase_date->i18nFormat('yyyy-MM-dd'));
            $sheet->setCellValue('B' . $row, $purchase->motorcycle->model);
            $sheet->setCellValue('C' . $row, $purchase->supplier->name);
            $sheet->setCellValue('D' . $row, $purchase->quantity);
            $sheet->setCellValue('E' . $row, $purchase->price);
            $row++;
        }

        // Sheet untuk Transaksi
        $row += 2; // Tambahkan jarak antara tabel pembelian dan transaksi
        $sheet->setCellValue('A' . $row, 'Laporan Transaksi');
        $row++;
        $sheet->setCellValue('A' . $row, 'Tanggal');
        $sheet->setCellValue('B' . $row, 'Model Motor');
        $sheet->setCellValue('C' . $row, 'Nama Customer');
        $sheet->setCellValue('D' . $row, 'Tipe Transaksi');
        $sheet->setCellValue('E' . $row, 'Kode Transaksi');
        $sheet->setCellValue('F' . $row, 'Jumlah');

        $row++;
        foreach ($data['transactions'] as $transaction) {
            $sheet->setCellValue('A' . $row, $transaction->transaction_date ? $transaction->transaction_date->i18nFormat('yyyy-MM-dd') : '');
            $sheet->setCellValue('B' . $row, $transaction->motorcycle->model);
            $sheet->setCellValue('C' . $row, $transaction->customer->name);
            $sheet->setCellValue('D' . $row, $transaction->transaction_type);
            $sheet->setCellValue('E' . $row, $transaction->transaction_code);
            $sheet->setCellValue('F' . $row, $transaction->amount);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('report_pembelian_transaksi.xlsx') . '"');
        $writer->save('php://output');
        exit;
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
