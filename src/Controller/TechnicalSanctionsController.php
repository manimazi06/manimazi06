<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TechnicalSanctions Controller
 *
 * @property \App\Model\Table\TechnicalSanctionsTable $TechnicalSanctions
 * @method \App\Model\Entity\TechnicalSanction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TechnicalSanctionsController extends AppController
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
        $technicalSanctions = $this->paginate($this->TechnicalSanctions);

        $this->set(compact('technicalSanctions'));
    }

    /**
     * View method
     *
     * @param string|null $id Technical Sanction id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $technicalSanction = $this->TechnicalSanctions->get($id, [
            'contain' => ['ProjectWorks'],
        ]);

        $this->set(compact('technicalSanction'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $technicalSanction = $this->TechnicalSanctions->newEmptyEntity();
        if ($this->request->is('post')) {
            $technicalSanction = $this->TechnicalSanctions->patchEntity($technicalSanction, $this->request->getData());
            if ($this->TechnicalSanctions->save($technicalSanction)) {
                $this->Flash->success(__('The technical sanction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The technical sanction could not be saved. Please, try again.'));
        }
        $projectWorks = $this->TechnicalSanctions->ProjectWorks->find('list', ['limit' => 200])->all();
        $this->set(compact('technicalSanction', 'projectWorks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Technical Sanction id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $technicalSanction = $this->TechnicalSanctions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $technicalSanction = $this->TechnicalSanctions->patchEntity($technicalSanction, $this->request->getData());
            if ($this->TechnicalSanctions->save($technicalSanction)) {
                $this->Flash->success(__('The technical sanction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The technical sanction could not be saved. Please, try again.'));
        }
        $projectWorks = $this->TechnicalSanctions->ProjectWorks->find('list', ['limit' => 200])->all();
        $this->set(compact('technicalSanction', 'projectWorks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Technical Sanction id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $technicalSanction = $this->TechnicalSanctions->get($id);
        if ($this->TechnicalSanctions->delete($technicalSanction)) {
            $this->Flash->success(__('The technical sanction has been deleted.'));
        } else {
            $this->Flash->error(__('The technical sanction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
