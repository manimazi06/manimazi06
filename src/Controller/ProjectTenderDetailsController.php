<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProjectTenderDetails Controller
 *
 * @property \App\Model\Table\ProjectTenderDetailsTable $ProjectTenderDetails
 * @method \App\Model\Entity\ProjectTenderDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectTenderDetailsController extends AppController
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
        $projectTenderDetails = $this->paginate($this->ProjectTenderDetails);

        $this->set(compact('projectTenderDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Project Tender Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectTenderDetail = $this->ProjectTenderDetails->get($id, [
            'contain' => ['ProjectWorks'],
        ]);

        $this->set(compact('projectTenderDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectTenderDetail = $this->ProjectTenderDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $projectTenderDetail = $this->ProjectTenderDetails->patchEntity($projectTenderDetail, $this->request->getData());
            if ($this->ProjectTenderDetails->save($projectTenderDetail)) {
                $this->Flash->success(__('The project tender detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project tender detail could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectTenderDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $this->set(compact('projectTenderDetail', 'projectWorks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Tender Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectTenderDetail = $this->ProjectTenderDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectTenderDetail = $this->ProjectTenderDetails->patchEntity($projectTenderDetail, $this->request->getData());
            if ($this->ProjectTenderDetails->save($projectTenderDetail)) {
                $this->Flash->success(__('The project tender detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project tender detail could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectTenderDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $this->set(compact('projectTenderDetail', 'projectWorks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Tender Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectTenderDetail = $this->ProjectTenderDetails->get($id);
        if ($this->ProjectTenderDetails->delete($projectTenderDetail)) {
            $this->Flash->success(__('The project tender detail has been deleted.'));
        } else {
            $this->Flash->error(__('The project tender detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
