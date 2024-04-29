<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProjectFundRequestDetails Controller
 *
 * @property \App\Model\Table\ProjectFundRequestDetailsTable $ProjectFundRequestDetails
 * @method \App\Model\Entity\ProjectFundRequestDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectFundRequestDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails', 'FundStatuses'],
        ];
        $projectFundRequestDetails = $this->paginate($this->ProjectFundRequestDetails);

        $this->set(compact('projectFundRequestDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Project Fund Request Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectFundRequestDetail = $this->ProjectFundRequestDetails->get($id, [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails', 'FundStatuses', 'ProjectFundRequestStages'],
        ]);

        $this->set(compact('projectFundRequestDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectFundRequestDetail = $this->ProjectFundRequestDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $projectFundRequestDetail = $this->ProjectFundRequestDetails->patchEntity($projectFundRequestDetail, $this->request->getData());
            if ($this->ProjectFundRequestDetails->save($projectFundRequestDetail)) {
                $this->Flash->success(__('The project fund request detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project fund request detail could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectFundRequestDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $projectWorkSubdetails = $this->ProjectFundRequestDetails->ProjectWorkSubdetails->find('list', ['limit' => 200])->all();
        $fundStatuses = $this->ProjectFundRequestDetails->FundStatuses->find('list', ['limit' => 200])->all();
        $this->set(compact('projectFundRequestDetail', 'projectWorks', 'projectWorkSubdetails', 'fundStatuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Fund Request Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectFundRequestDetail = $this->ProjectFundRequestDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectFundRequestDetail = $this->ProjectFundRequestDetails->patchEntity($projectFundRequestDetail, $this->request->getData());
            if ($this->ProjectFundRequestDetails->save($projectFundRequestDetail)) {
                $this->Flash->success(__('The project fund request detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project fund request detail could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectFundRequestDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $projectWorkSubdetails = $this->ProjectFundRequestDetails->ProjectWorkSubdetails->find('list', ['limit' => 200])->all();
        $fundStatuses = $this->ProjectFundRequestDetails->FundStatuses->find('list', ['limit' => 200])->all();
        $this->set(compact('projectFundRequestDetail', 'projectWorks', 'projectWorkSubdetails', 'fundStatuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Fund Request Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectFundRequestDetail = $this->ProjectFundRequestDetails->get($id);
        if ($this->ProjectFundRequestDetails->delete($projectFundRequestDetail)) {
            $this->Flash->success(__('The project fund request detail has been deleted.'));
        } else {
            $this->Flash->error(__('The project fund request detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
