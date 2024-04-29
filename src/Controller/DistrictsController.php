<?php

declare(strict_types=1);

namespace App\Controller;


class DistrictsController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        $districts = $this->Districts->find('all')->contain(['Divisions'])->where(['Districts.is_active' => 1])->toArray();
        $this->set(compact('districts'));
    }

    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $district = $this->Districts->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('district'));
    }

    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        
        $district = $this->Districts->newEmptyEntity();
        if ($this->request->is('post')) {            
            $district->name       =  $this->request->getData('name');
            $district->division_id       =  $this->request->getData('division_id');
          
            $district->created_by          =  $user->id;
            $district->created_date        =  date('Y-m-d H:i:s');         
           
            if ($this->Districts->save($district)) {
           
                $this->Flash->success(__('The project work has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project work could not be saved. Please, try again.'));
        }
       
   
        $dist    = $this->Districts->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->all();
         $this->set(compact('district','dist'));
    }

    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        //$id = base64_decode($id);
        $user = $this->request->getAttribute('identity');
        $district = $this->Districts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $district = $this->Districts->patchEntity($district, $this->request->getData());
            $name                           = $this->request->getData('name');
            $district->modified_date	    = date('Y-m-d H:i:s');
            $district->modified_by          = $user->id;
            $district->name                 = $name;
            $name_role = $this->Districts->find('all')->where(['Districts.name' => $name,'Districts.name !=' => $name])->count();
            if ($name_role > 0) {
                $this->Flash->error(__('Name is already exits'));
                // return $this->redirect(['action' => 'index']);
            }else{
                if ($this->Districts->save($district)) {
                    $this->Flash->success(__('The district has been saved.'));
    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The district could not be saved. Please, try again.'));
            }
            
        }
        $dist    = $this->Districts->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->all();
        $this->set(compact('district','dist'));
    }

	
	public function delete($id = null)
    {
      	
       $this->Districts=$this->fetchTable('Districts');	
		$userTable          = $this->getTableLocator()->get('Districts');
		$user                = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'Districts', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'Districts', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }
}