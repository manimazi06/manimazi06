<?php
declare(strict_types=1);

namespace App\Controller;

class BuildingSubmaterialsController extends AppController
{
    
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        $buildingSubmaterials = $this->BuildingSubmaterials->find('all')->where(['BuildingSubmaterials.is_active' => 1]);
        $this->set(compact('buildingSubmaterials'));
    }

   
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $buildingSubmaterial = $this->BuildingSubmaterials->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('buildingSubmaterial'));
    }


    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $buildingSubmaterial = $this->BuildingSubmaterials->newEmptyEntity();
        if ($this->request->is('post')) {

            $buildingSubmaterial->name                =  $this->request->getData('name');
            $buildingSubmaterial->created_by          =  $user->id;
            $buildingSubmaterial->created_date        =  date('Y-m-d H:i:s');

            if ($this->BuildingSubmaterials->save($buildingSubmaterial)) {
                $this->Flash->success(__('The building submaterial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The building submaterial could not be saved. Please, try again.'));
        }
        $this->set(compact('buildingSubmaterial'));
    }

 
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');

        $buildingSubmaterial = $this->BuildingSubmaterials->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $buildingSubmaterial                      = $this->BuildingSubmaterials->patchEntity($buildingSubmaterial, $this->request->getData());
            $buildingSubmaterial->name                =  $this->request->getData('name');
            $buildingSubmaterial->modified_by          =  $user->id;
            $buildingSubmaterial->modified_date        =  date('Y-m-d H:i:s');


            if ($this->BuildingSubmaterials->save($buildingSubmaterial)) {
                $this->Flash->success(__('The building submaterial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The building submaterial could not be saved. Please, try again.'));
        }
        $this->set(compact('buildingSubmaterial'));
    }

  
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $buildingSubmaterial = $this->BuildingSubmaterials->get($id);
        if ($this->BuildingSubmaterials->delete($buildingSubmaterial)) {
            $this->Flash->success(__('The building submaterial has been deleted.'));
        } else {
            $this->Flash->error(__('The building submaterial could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
