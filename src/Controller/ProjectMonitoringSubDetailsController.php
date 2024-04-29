<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProjectMonitoringSubDetails Controller
 *
 * @property \App\Model\Table\ProjectMonitoringSubDetailsTable $ProjectMonitoringSubDetails
 * @method \App\Model\Entity\ProjectMonitoringSubDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectMonitoringSubDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['WorkStages'],
        ];
        $projectMonitoringSubDetails = $this->paginate($this->ProjectMonitoringSubDetails);

        $this->set(compact('projectMonitoringSubDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Project Monitoring Sub Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectMonitoringSubDetail = $this->ProjectMonitoringSubDetails->get($id, [
            'contain' => ['WorkStages'],
        ]);

        $this->set(compact('projectMonitoringSubDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectMonitoringSubDetail = $this->ProjectMonitoringSubDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $projectMonitoringSubDetail = $this->ProjectMonitoringSubDetails->patchEntity($projectMonitoringSubDetail, $this->request->getData());
            if ($this->ProjectMonitoringSubDetails->save($projectMonitoringSubDetail)) {
                $this->Flash->success(__('The project monitoring sub detail has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project monitoring sub detail could not be saved. Please, try again.'));
        }
        $workStages = $this->ProjectMonitoringSubDetails->WorkStages->find('list', ['limit' => 200])->all();
        $this->set(compact('projectMonitoringSubDetail', 'workStages'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Monitoring Sub Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectMonitoringSubDetail = $this->ProjectMonitoringSubDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectMonitoringSubDetail = $this->ProjectMonitoringSubDetails->patchEntity($projectMonitoringSubDetail, $this->request->getData());
            if ($this->ProjectMonitoringSubDetails->save($projectMonitoringSubDetail)) {
                $this->Flash->success(__('The project monitoring sub detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project monitoring sub detail could not be saved. Please, try again.'));
        }
        $workStages = $this->ProjectMonitoringSubDetails->WorkStages->find('list', ['limit' => 200])->all();
        $this->set(compact('projectMonitoringSubDetail', 'workStages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Monitoring Sub Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectMonitoringSubDetail = $this->ProjectMonitoringSubDetails->get($id);
        if ($this->ProjectMonitoringSubDetails->delete($projectMonitoringSubDetail)) {
            $this->Flash->success(__('The project monitoring sub detail has been deleted.'));
        } else {
            $this->Flash->error(__('The project monitoring sub detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
