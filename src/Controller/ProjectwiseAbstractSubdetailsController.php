<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProjectwiseAbstractSubdetails Controller
 *
 * @property \App\Model\Table\ProjectwiseAbstractSubdetailsTable $ProjectwiseAbstractSubdetails
 * @method \App\Model\Entity\ProjectwiseAbstractSubdetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectwiseAbstractSubdetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ProjectwiseAbstractDetails', 'BuildingItems'],
        ];
        $projectwiseAbstractSubdetails = $this->paginate($this->ProjectwiseAbstractSubdetails);

        $this->set(compact('projectwiseAbstractSubdetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Projectwise Abstract Subdetail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectwiseAbstractSubdetail = $this->ProjectwiseAbstractSubdetails->get($id, [
            'contain' => ['ProjectwiseAbstractDetails', 'BuildingItems'],
        ]);

        $this->set(compact('projectwiseAbstractSubdetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectwiseAbstractSubdetail = $this->ProjectwiseAbstractSubdetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $projectwiseAbstractSubdetail = $this->ProjectwiseAbstractSubdetails->patchEntity($projectwiseAbstractSubdetail, $this->request->getData());
            if ($this->ProjectwiseAbstractSubdetails->save($projectwiseAbstractSubdetail)) {
                $this->Flash->success(__('The projectwise abstract subdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projectwise abstract subdetail could not be saved. Please, try again.'));
        }
        $projectwiseAbstractDetails = $this->ProjectwiseAbstractSubdetails->ProjectwiseAbstractDetails->find('list', ['limit' => 200])->all();
        $buildingItems = $this->ProjectwiseAbstractSubdetails->BuildingItems->find('list', ['limit' => 200])->all();
        $this->set(compact('projectwiseAbstractSubdetail', 'projectwiseAbstractDetails', 'buildingItems'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Projectwise Abstract Subdetail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectwiseAbstractSubdetail = $this->ProjectwiseAbstractSubdetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectwiseAbstractSubdetail = $this->ProjectwiseAbstractSubdetails->patchEntity($projectwiseAbstractSubdetail, $this->request->getData());
            if ($this->ProjectwiseAbstractSubdetails->save($projectwiseAbstractSubdetail)) {
                $this->Flash->success(__('The projectwise abstract subdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projectwise abstract subdetail could not be saved. Please, try again.'));
        }
        $projectwiseAbstractDetails = $this->ProjectwiseAbstractSubdetails->ProjectwiseAbstractDetails->find('list', ['limit' => 200])->all();
        $buildingItems = $this->ProjectwiseAbstractSubdetails->BuildingItems->find('list', ['limit' => 200])->all();
        $this->set(compact('projectwiseAbstractSubdetail', 'projectwiseAbstractDetails', 'buildingItems'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Projectwise Abstract Subdetail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectwiseAbstractSubdetail = $this->ProjectwiseAbstractSubdetails->get($id);
        if ($this->ProjectwiseAbstractSubdetails->delete($projectwiseAbstractSubdetail)) {
            $this->Flash->success(__('The projectwise abstract subdetail has been deleted.'));
        } else {
            $this->Flash->error(__('The projectwise abstract subdetail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
