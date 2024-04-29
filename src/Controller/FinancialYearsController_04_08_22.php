<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * FinancialYears Controller
 *
 * @property \App\Model\Table\FinancialYearsTable $FinancialYears
 * @method \App\Model\Entity\FinancialYear[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FinancialYearsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $financialYears = $this->paginate($this->FinancialYears);

        $this->set(compact('financialYears'));
    }

    /**
     * View method
     *
     * @param string|null $id Financial Year id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $financialYear = $this->FinancialYears->get($id, [
            'contain' => ['ProjectWorks'],
        ]);

        $this->set(compact('financialYear'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $financialYear = $this->FinancialYears->newEmptyEntity();
        if ($this->request->is('post')) {
            $financialYear = $this->FinancialYears->patchEntity($financialYear, $this->request->getData());
            if ($this->FinancialYears->save($financialYear)) {
                $this->Flash->success(__('The financial year has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The financial year could not be saved. Please, try again.'));
        }
        $this->set(compact('financialYear'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Financial Year id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $financialYear = $this->FinancialYears->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $financialYear = $this->FinancialYears->patchEntity($financialYear, $this->request->getData());
            if ($this->FinancialYears->save($financialYear)) {
                $this->Flash->success(__('The financial year has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The financial year could not be saved. Please, try again.'));
        }
        $this->set(compact('financialYear'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Financial Year id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $financialYear = $this->FinancialYears->get($id);
        if ($this->FinancialYears->delete($financialYear)) {
            $this->Flash->success(__('The financial year has been deleted.'));
        } else {
            $this->Flash->error(__('The financial year could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
