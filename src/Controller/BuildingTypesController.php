<?php
declare(strict_types=1);
namespace App\Controller;

class BuildingTypesController extends AppController
{   
    public function index()    
    {
        $this->viewBuilder()->setLayout('layout');
	    $buildingType = $this->BuildingTypes->find('all')->where(['BuildingTypes.is_active' => 1])->toArray();
        $this->set(compact('buildingType'));
    }
  
    public function view($id = null)
    {
        $buildingType = $this->BuildingType->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('buildingType'));
    }
   
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $buildingType = $this->BuildingTypes->newEmptyEntity();
        if ($this->request->is('post')) {
        
            $buildingType = $this->BuildingTypes->patchEntity($buildingType, $this->request->getData());
            $name                       = $this->request->getData('name');
            $buildingType->created_date         = date('Y-m-d H:i:s');
            $buildingType->created_by           = $user->id;
            $buildingType->name                 = $name;
            $name_dist = $this->BuildingTypes->find('all')->where(['BuildingTypes.name' => $name])->count();
           
            if ($name_dist > 0) {
                $this->Flash->error(__('Name is already exits'));
            } else {
                if ($this->BuildingTypes->save($buildingType)) {
                    $this->Flash->success(__('The buildingType has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The buildingType could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('buildingType'));
    }

  
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $buildingType = $this->BuildingTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $buildingType = $this->BuildingTypes->patchEntity($buildingType, $this->request->getData());
            $name                        = $this->request->getData('name');
            $buildingType->modified_date         = date('Y-m-d H:i:s');
            $buildingType->modified_by           = $user->id;
            $buildingType->name                  = $name;            
            $name_buildingType = $this->BuildingTypes->find('all')->where(['BuildingTypes.name' => $name, 'BuildingTypes.id !=' => $id])->count();
            if ($name_buildingType > 0) {
                $this->Flash->error(__('Name is already exits'));
            } else {
                if ($this->BuildingTypes->save($buildingType)) {
                    $this->Flash->success(__('The buildingType has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The buildingType could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('buildingType'));
    }
  
	 public function delete($id = null)
    {
       $this->BuildingTypes=$this->fetchTable('BuildingTypes');		
		$userTable          = $this->getTableLocator()->get('BuildingTypes');
		$user                = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'BuildingTypes', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'BuildingTypes', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }		
}