<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * FinancialyearwiseMaterialCostDetails Controller
 *
 * @property \App\Model\Table\FinancialyearwiseMaterialCostDetailsTable $FinancialyearwiseMaterialCostDetails
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FinancialyearwiseMaterialCostDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['FinancialYears'],
        ];
        $financialyearwiseMaterialCostDetails = $this->paginate($this->FinancialyearwiseMaterialCostDetails);

        $this->set(compact('financialyearwiseMaterialCostDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Financialyearwise Material Cost Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $financialyearwiseMaterialCostDetail = $this->FinancialyearwiseMaterialCostDetails->get($id, [
            'contain' => ['FinancialYears', 'FinancialyearwiseMaterialCostSubdetails'],
        ]);

        $this->set(compact('financialyearwiseMaterialCostDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $financialyearwiseMaterialCostDetail = $this->FinancialyearwiseMaterialCostDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $financialyearwiseMaterialCostDetail = $this->FinancialyearwiseMaterialCostDetails->patchEntity($financialyearwiseMaterialCostDetail, $this->request->getData());
            if ($this->FinancialyearwiseMaterialCostDetails->save($financialyearwiseMaterialCostDetail)) {
                $this->Flash->success(__('The financialyearwise material cost detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The financialyearwise material cost detail could not be saved. Please, try again.'));
        }
        $financialYears = $this->FinancialyearwiseMaterialCostDetails->FinancialYears->find('list', ['limit' => 200])->all();
        $this->set(compact('financialyearwiseMaterialCostDetail', 'financialYears'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Financialyearwise Material Cost Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $financialyearwiseMaterialCostDetail = $this->FinancialyearwiseMaterialCostDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $financialyearwiseMaterialCostDetail = $this->FinancialyearwiseMaterialCostDetails->patchEntity($financialyearwiseMaterialCostDetail, $this->request->getData());
            if ($this->FinancialyearwiseMaterialCostDetails->save($financialyearwiseMaterialCostDetail)) {
                $this->Flash->success(__('The financialyearwise material cost detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The financialyearwise material cost detail could not be saved. Please, try again.'));
        }
        $financialYears = $this->FinancialyearwiseMaterialCostDetails->FinancialYears->find('list', ['limit' => 200])->all();
        $this->set(compact('financialyearwiseMaterialCostDetail', 'financialYears'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Financialyearwise Material Cost Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $financialyearwiseMaterialCostDetail = $this->FinancialyearwiseMaterialCostDetails->get($id);
        if ($this->FinancialyearwiseMaterialCostDetails->delete($financialyearwiseMaterialCostDetail)) {
            $this->Flash->success(__('The financialyearwise material cost detail has been deleted.'));
        } else {
            $this->Flash->error(__('The financialyearwise material cost detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
