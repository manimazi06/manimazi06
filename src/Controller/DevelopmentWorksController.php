<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * DevelopmentWorks Controller
 *
 * @property \App\Model\Table\DevelopmentWorksTable $DevelopmentWorks
 * @method \App\Model\Entity\DevelopmentWork[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DevelopmentWorksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $this->viewBuilder()->setLayout('layout');
        $developmentWorks = $this->DevelopmentWorks->find('all')->where(['DevelopmentWorks.is_active' => 1]);
        $this->set(compact('developmentWorks'));
    }

    /**
     * View method
     *
     * @param string|null $id Development Work id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $developmentWork = $this->DevelopmentWorks->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('developmentWork'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');

        $developmentWork = $this->DevelopmentWorks->newEmptyEntity();
        if ($this->request->is('post')) {
            //  echo"<pre>";print_r($_POST);exit();
            $developmentWork->name                =  $this->request->getData('name');
            $developmentWork->division_id         =  $this->request->getData('division_id');
            $developmentWork->created_by          =  $user->id;
            $developmentWork->created_date        =  date('Y-m-d H:i:s');


            if ($this->DevelopmentWorks->save($developmentWork)) {

                $this->Flash->success(__('The DevelopmentWorks has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The DevelopmentWorks could not be saved. Please, try again.'));
        }

        $this->set(compact('developmentWork'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Development Work id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');

        $user = $this->request->getAttribute('identity');
        $developmentWork = $this->DevelopmentWorks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $developmentWork = $this->DevelopmentWorks->patchEntity($developmentWork, $this->request->getData());
            $name            = $this->request->getData('name');
            $developmentWork->modified_date        = date('Y-m-d H:i:s');
            $developmentWork->modified_by          = $user->id;
            $developmentWork->name                 = $name;
            $name_role = $this->DevelopmentWorks->find('all')->where(['DevelopmentWorks.name' => $name, 'DevelopmentWorks.name !=' => $name])->count();
            if ($name_role > 0) {
                $this->Flash->error(__('Name is already exits'));
                // return $this->redirect(['action' => 'index']);
            } else {
                if ($this->DevelopmentWorks->save($developmentWork)) {
                    $this->Flash->success(__('The developmentWork has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The developmentWork could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('developmentWork'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Development Work id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $developmentWork = $this->DevelopmentWorks->get($id);
        if ($this->DevelopmentWorks->delete($developmentWork)) {
            $this->Flash->success(__('The development work has been deleted.'));
        } else {
            $this->Flash->error(__('The development work could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
