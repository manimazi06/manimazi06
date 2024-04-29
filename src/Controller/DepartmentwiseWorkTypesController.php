<?php
declare(strict_types=1);
namespace App\Controller;

class DepartmentwiseWorkTypesController extends AppController
{   
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        $this->Departments=$this->fetchTable('Departments');	
        $departmentwiseWorkTypes = $this->DepartmentwiseWorkTypes->find('all')->contain(['Departments'])->where(['DepartmentwiseWorkTypes.is_active' => 1]);
        $this->set(compact('departmentwiseWorkTypes'));
    }
    
    public function view($id = null)
    {
        $departmentwiseWorkTypes = $this->DepartmentwiseWorkTypes->get($id, [
            'contain' => ['Departments'],
        ]);
        $this->set(compact('departmentwiseWorkTypes'));
    }
    
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->Departments=$this->fetchTable('Departments');	

        $departmentwiseWorkType = $this->DepartmentwiseWorkTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $departmentwiseWorkType->department_id                =  $this->request->getData('department_id');
            $departmentwiseWorkType->name         =  $this->request->getData('name');
            $departmentwiseWorkType->created_by          =  $user->id;
            $departmentwiseWorkType->created_date        =  date('Y-m-d H:i:s');


            if ($this->DepartmentwiseWorkTypes->save($departmentwiseWorkType)) {

                $this->Flash->success(__('The DepartmentwiseWorkTypes has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The DepartmentwiseWorkTypes could not be saved. Please, try again.'));
        }

        $departments = $this->DepartmentwiseWorkTypes->Departments->find('list', ['limit' => 200])->all();
        $this->set(compact('departmentwiseWorkType', 'departments'));
    }
    
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $departmentwiseWorkType = $this->DepartmentwiseWorkTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $departmentwiseWorkType = $this->DepartmentwiseWorkTypes->patchEntity($departmentwiseWorkType, $this->request->getData());
            if ($this->DepartmentwiseWorkTypes->save($departmentwiseWorkType)) {
                $this->Flash->success(__('The departmentwise work type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The departmentwise work type could not be saved. Please, try again.'));
        }
        $departments = $this->DepartmentwiseWorkTypes->Departments->find('list', ['limit' => 200])->all();
        $this->set(compact('departmentwiseWorkType', 'departments'));
    }
   
    public function delete($id = null)
    {
       	
       $this->DepartmentwiseWorkTypes=$this->fetchTable('DepartmentwiseWorkTypes');	
		$userTable          = $this->getTableLocator()->get('DepartmentwiseWorkTypes');
		$user                = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'DepartmentwiseWorkTypes', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'DepartmentwiseWorkTypes', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }	
}