<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProjectwiseExpenditureDetails Controller
 *
 * @property \App\Model\Table\ProjectwiseExpenditureDetailsTable $ProjectwiseExpenditureDetails
 * @method \App\Model\Entity\ProjectwiseExpenditureDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectwiseExpenditureDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails'],
        ];
        $projectwiseExpenditureDetails = $this->paginate($this->ProjectwiseExpenditureDetails);

        $this->set(compact('projectwiseExpenditureDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Projectwise Expenditure Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectwiseExpenditureDetail = $this->ProjectwiseExpenditureDetails->get($id, [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails'],
        ]);

        $this->set(compact('projectwiseExpenditureDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectwiseExpenditureDetail = $this->ProjectwiseExpenditureDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $projectwiseExpenditureDetail = $this->ProjectwiseExpenditureDetails->patchEntity($projectwiseExpenditureDetail, $this->request->getData());
            if ($this->ProjectwiseExpenditureDetails->save($projectwiseExpenditureDetail)) {
                $this->Flash->success(__('The projectwise expenditure detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projectwise expenditure detail could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectwiseExpenditureDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $projectWorkSubdetails = $this->ProjectwiseExpenditureDetails->ProjectWorkSubdetails->find('list', ['limit' => 200])->all();
        $this->set(compact('projectwiseExpenditureDetail', 'projectWorks', 'projectWorkSubdetails'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Projectwise Expenditure Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectwiseExpenditureDetail = $this->ProjectwiseExpenditureDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectwiseExpenditureDetail = $this->ProjectwiseExpenditureDetails->patchEntity($projectwiseExpenditureDetail, $this->request->getData());
            if ($this->ProjectwiseExpenditureDetails->save($projectwiseExpenditureDetail)) {
                $this->Flash->success(__('The projectwise expenditure detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projectwise expenditure detail could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectwiseExpenditureDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $projectWorkSubdetails = $this->ProjectwiseExpenditureDetails->ProjectWorkSubdetails->find('list', ['limit' => 200])->all();
        $this->set(compact('projectwiseExpenditureDetail', 'projectWorks', 'projectWorkSubdetails'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Projectwise Expenditure Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectwiseExpenditureDetail = $this->ProjectwiseExpenditureDetails->get($id);
        if ($this->ProjectwiseExpenditureDetails->delete($projectwiseExpenditureDetail)) {
            $this->Flash->success(__('The projectwise expenditure detail has been deleted.'));
        } else {
            $this->Flash->error(__('The projectwise expenditure detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
