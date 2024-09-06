<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Motorcycles Controller
 *
 * @property \App\Model\Table\MotorcyclesTable $Motorcycles
 * @method \App\Model\Entity\Motorcycle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MotorcyclesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $motorcycles = $this->paginate($this->Motorcycles);

        $this->set(compact('motorcycles'));
    }

    /**
     * View method
     *
     * @param string|null $id Motorcycle id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $motorcycle = $this->Motorcycles->get($id, [
            'contain' => ['Transaction'],
        ]);

        $this->set(compact('motorcycle'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $motorcycle = $this->Motorcycles->newEmptyEntity();
        if ($this->request->is('post')) {
            $motorcycle = $this->Motorcycles->patchEntity($motorcycle, $this->request->getData());
    
            if (!$motorcycle->getErrors()) {
                $image = $this->request->getData('image_file');
                if ($image && $image->getError() === UPLOAD_ERR_OK) {
                    $name = $image->getClientFilename();
                    $targetPath = WWW_ROOT . 'img' . DS . $name;
                    try {
                        $image->moveTo($targetPath);
                        $motorcycle->image = $name;
                        $this->log('File moved to ' . $targetPath, 'debug');
                    } catch (\Laminas\Diactoros\Exception\UploadedFileAlreadyMovedException $e) {
                        $this->log('File already moved: ' . $e->getMessage(), 'debug');
                    }
                }
    
                if ($this->Motorcycles->save($motorcycle)) {
                    $this->Flash->success(__('The motorcycle has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The motorcycle could not be saved. Please, try again.'));
                    debug($motorcycle->getErrors());
                }
            }
        }
        $this->set(compact('motorcycle'));
    }
    
    

    /**
     * Edit method
     *
     * @param string|null $id Motorcycle id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $motorcycle = $this->Motorcycles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $motorcycle = $this->Motorcycles->patchEntity($motorcycle, $this->request->getData());
            if ($this->Motorcycles->save($motorcycle)) {
                $this->Flash->success(__('The motorcycle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The motorcycle could not be saved. Please, try again.'));
        }
        $this->set(compact('motorcycle'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Motorcycle id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $motorcycle = $this->Motorcycles->get($id);
        if ($this->Motorcycles->delete($motorcycle)) {
            $this->Flash->success(__('The motorcycle has been deleted.'));
        } else {
            $this->Flash->error(__('The motorcycle could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
