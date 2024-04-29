<?php
declare(strict_types=1);

namespace App\Controller;

class DepartmentsController extends AppController
{  
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
	    $departments = $this->Departments->find('all')->where(['Departments.is_active' => 1])->toArray();
        $this->set(compact('departments'));
    }

    public function view($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('department'));
    }
  
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $department = $this->Departments->newEmptyEntity();
        if ($this->request->is('post')) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());         
            $name                       = $this->request->getData('name');
            $department->created_date         = date('Y-m-d H:i:s');
            $department->created_by           = $user->id;
            $department->name                 = $name;     
            $department->department_code      = $this->request->getData('department_code');     
            $name_dist = $this->Departments->find('all')->where(['Departments.name' => $name])->count();            
            if ($name_dist > 0) {
         
                $this->Flash->error(__('Name is already exits'));
            } else {
                if ($this->Departments->save($department)) {
                    $this->Flash->success(__('The department has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The department could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('department'));
    }
 
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $department = $this->Departments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            $name                              = $this->request->getData('name');
            $department->modified_date         = date('Y-m-d H:i:s');
            $department->modified_by           = $user->id;
            $department->name                  = $name;    
            $department->department_code      = $this->request->getData('department_code');    
			
            $name_department = $this->Departments->find('all')->where(['Departments.name' => $name, 'Departments.id !=' => $id])->count();
            if ($name_department > 0) {
                $this->Flash->error(__('Name is already exits'));
            } else {
                if ($this->Departments->save($department)) {
                    $this->Flash->success(__('The department has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The department could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('department'));
    }

   public function delete($id = null)
    {
       $this->Departments=$this->fetchTable('Departments');		
		$userTable          = $this->getTableLocator()->get('Departments');
		$user                = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'Departments', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'Departments', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }
}