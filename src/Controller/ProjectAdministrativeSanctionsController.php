<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProjectAdministrativeSanctions Controller
 *
 * @property \App\Model\Table\ProjectAdministrativeSanctionsTable $ProjectAdministrativeSanctions
 * @method \App\Model\Entity\ProjectAdministrativeSanction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectAdministrativeSanctionsController extends AppController
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
        $projectAdministrativeSanctions = $this->paginate($this->ProjectAdministrativeSanctions);

        $this->set(compact('projectAdministrativeSanctions'));
    }

    /**
     * View method
     *
     * @param string|null $id Project Administrative Sanction id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectAdministrativeSanction = $this->ProjectAdministrativeSanctions->get($id, [
            'contain' => ['ProjectWorks'],
        ]);

        $this->set(compact('projectAdministrativeSanction'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectAdministrativeSanction = $this->ProjectAdministrativeSanctions->newEmptyEntity();
        if ($this->request->is('post')) {
            $projectAdministrativeSanction = $this->ProjectAdministrativeSanctions->patchEntity($projectAdministrativeSanction, $this->request->getData());
            if ($this->ProjectAdministrativeSanctions->save($projectAdministrativeSanction)) {
                $this->Flash->success(__('The project administrative sanction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project administrative sanction could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectAdministrativeSanctions->ProjectWorks->find('list', ['limit' => 200])->all();
        $this->set(compact('projectAdministrativeSanction', 'projectWorks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Administrative Sanction id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectAdministrativeSanction = $this->ProjectAdministrativeSanctions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectAdministrativeSanction = $this->ProjectAdministrativeSanctions->patchEntity($projectAdministrativeSanction, $this->request->getData());
            if ($this->ProjectAdministrativeSanctions->save($projectAdministrativeSanction)) {
                $this->Flash->success(__('The project administrative sanction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project administrative sanction could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectAdministrativeSanctions->ProjectWorks->find('list', ['limit' => 200])->all();
        $this->set(compact('projectAdministrativeSanction', 'projectWorks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Administrative Sanction id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectAdministrativeSanction = $this->ProjectAdministrativeSanctions->get($id);
        if ($this->ProjectAdministrativeSanctions->delete($projectAdministrativeSanction)) {
            $this->Flash->success(__('The project administrative sanction has been deleted.'));
        } else {
            $this->Flash->error(__('The project administrative sanction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
