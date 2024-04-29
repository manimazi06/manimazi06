<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OpeningBalanceDetails Controller
 *
 * @property \App\Model\Table\OpeningBalanceDetailsTable $OpeningBalanceDetails
 * @method \App\Model\Entity\OpeningBalanceDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OpeningBalanceDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $openingBalanceDetails = $this->paginate($this->OpeningBalanceDetails);

        $this->set(compact('openingBalanceDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Opening Balance Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $openingBalanceDetail = $this->OpeningBalanceDetails->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('openingBalanceDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $openingBalanceDetail = $this->OpeningBalanceDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $openingBalanceDetail = $this->OpeningBalanceDetails->patchEntity($openingBalanceDetail, $this->request->getData());
            if ($this->OpeningBalanceDetails->save($openingBalanceDetail)) {
                $this->Flash->success(__('The opening balance detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The opening balance detail could not be saved. Please, try again.'));
        }
        $this->set(compact('openingBalanceDetail'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Opening Balance Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $openingBalanceDetail = $this->OpeningBalanceDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $openingBalanceDetail = $this->OpeningBalanceDetails->patchEntity($openingBalanceDetail, $this->request->getData());
            if ($this->OpeningBalanceDetails->save($openingBalanceDetail)) {
                $this->Flash->success(__('The opening balance detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The opening balance detail could not be saved. Please, try again.'));
        }
        $this->set(compact('openingBalanceDetail'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Opening Balance Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $openingBalanceDetail = $this->OpeningBalanceDetails->get($id);
        if ($this->OpeningBalanceDetails->delete($openingBalanceDetail)) {
            $this->Flash->success(__('The opening balance detail has been deleted.'));
        } else {
            $this->Flash->error(__('The opening balance detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
