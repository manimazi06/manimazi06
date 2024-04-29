<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProjectwiseAbstractDetails Controller
 *
 * @property \App\Model\Table\ProjectwiseAbstractDetailsTable $ProjectwiseAbstractDetails
 * @method \App\Model\Entity\ProjectwiseAbstractDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectwiseAbstractDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails', 'DevelopmentWorks'],
        ];
        $projectwiseAbstractDetails = $this->paginate($this->ProjectwiseAbstractDetails);

        $this->set(compact('projectwiseAbstractDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Projectwise Abstract Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectwiseAbstractDetail = $this->ProjectwiseAbstractDetails->get($id, [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails', 'DevelopmentWorks', 'ProjectwiseAbstractSubdetails'],
        ]);

        $this->set(compact('projectwiseAbstractDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectwiseAbstractDetail = $this->ProjectwiseAbstractDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $projectwiseAbstractDetail = $this->ProjectwiseAbstractDetails->patchEntity($projectwiseAbstractDetail, $this->request->getData());
            if ($this->ProjectwiseAbstractDetails->save($projectwiseAbstractDetail)) {
                $this->Flash->success(__('The projectwise abstract detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projectwise abstract detail could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectwiseAbstractDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $projectWorkSubdetails = $this->ProjectwiseAbstractDetails->ProjectWorkSubdetails->find('list', ['limit' => 200])->all();
        $developmentWorks = $this->ProjectwiseAbstractDetails->DevelopmentWorks->find('list', ['limit' => 200])->all();
        $this->set(compact('projectwiseAbstractDetail', 'projectWorks', 'projectWorkSubdetails', 'developmentWorks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Projectwise Abstract Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectwiseAbstractDetail = $this->ProjectwiseAbstractDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectwiseAbstractDetail = $this->ProjectwiseAbstractDetails->patchEntity($projectwiseAbstractDetail, $this->request->getData());
            if ($this->ProjectwiseAbstractDetails->save($projectwiseAbstractDetail)) {
                $this->Flash->success(__('The projectwise abstract detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projectwise abstract detail could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectwiseAbstractDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $projectWorkSubdetails = $this->ProjectwiseAbstractDetails->ProjectWorkSubdetails->find('list', ['limit' => 200])->all();
        $developmentWorks = $this->ProjectwiseAbstractDetails->DevelopmentWorks->find('list', ['limit' => 200])->all();
        $this->set(compact('projectwiseAbstractDetail', 'projectWorks', 'projectWorkSubdetails', 'developmentWorks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Projectwise Abstract Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectwiseAbstractDetail = $this->ProjectwiseAbstractDetails->get($id);
        if ($this->ProjectwiseAbstractDetails->delete($projectwiseAbstractDetail)) {
            $this->Flash->success(__('The projectwise abstract detail has been deleted.'));
        } else {
            $this->Flash->error(__('The projectwise abstract detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
