<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProjectFinancialSanctions Controller
 *
 * @property \App\Model\Table\ProjectFinancialSanctionsTable $ProjectFinancialSanctions
 * @method \App\Model\Entity\ProjectFinancialSanction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectFinancialSanctionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ProjectWorks'],
        ];
        $projectFinancialSanctions = $this->paginate($this->ProjectFinancialSanctions);

        $this->set(compact('projectFinancialSanctions'));
    }

    /**
     * View method
     *
     * @param string|null $id Project Financial Sanction id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectFinancialSanction = $this->ProjectFinancialSanctions->get($id, [
            'contain' => ['ProjectWorks'],
        ]);

        $this->set(compact('projectFinancialSanction'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectFinancialSanction = $this->ProjectFinancialSanctions->newEmptyEntity();
        if ($this->request->is('post')) {
            $projectFinancialSanction = $this->ProjectFinancialSanctions->patchEntity($projectFinancialSanction, $this->request->getData());
            if ($this->ProjectFinancialSanctions->save($projectFinancialSanction)) {
                $this->Flash->success(__('The project financial sanction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project financial sanction could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectFinancialSanctions->ProjectWorks->find('list', ['limit' => 200])->all();
        $this->set(compact('projectFinancialSanction', 'projectWorks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Financial Sanction id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectFinancialSanction = $this->ProjectFinancialSanctions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectFinancialSanction = $this->ProjectFinancialSanctions->patchEntity($projectFinancialSanction, $this->request->getData());
            if ($this->ProjectFinancialSanctions->save($projectFinancialSanction)) {
                $this->Flash->success(__('The project financial sanction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project financial sanction could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectFinancialSanctions->ProjectWorks->find('list', ['limit' => 200])->all();
        $this->set(compact('projectFinancialSanction', 'projectWorks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Financial Sanction id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectFinancialSanction = $this->ProjectFinancialSanctions->get($id);
        if ($this->ProjectFinancialSanctions->delete($projectFinancialSanction)) {
            $this->Flash->success(__('The project financial sanction has been deleted.'));
        } else {
            $this->Flash->error(__('The project financial sanction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
