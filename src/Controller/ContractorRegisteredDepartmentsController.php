<?php
declare(strict_types=1);
namespace App\Controller;

class ContractorRegisteredDepartmentsController extends AppController
{  
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        $contractorRegisteredDepartments = $this->ContractorRegisteredDepartments->find('all')->where(['ContractorRegisteredDepartments.is_active' => 1]);
        $this->set(compact('contractorRegisteredDepartments'));
    }

    public function view($id = null)
    {
        $contractorRegisteredDepartment = $this->ContractorRegisteredDepartments->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('contractorRegisteredDepartment'));
    }
    
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $contractorRegisteredDepartment = $this->ContractorRegisteredDepartments->newEmptyEntity();
        if ($this->request->is('post')) {
            $contractorRegisteredDepartment = $this->ContractorRegisteredDepartments->patchEntity($contractorRegisteredDepartment, $this->request->getData());
            $contractorRegisteredDepartment->name                       = $this->request->getData('name');
            $contractorRegisteredDepartment->created_by          =  $user->id;
            $contractorRegisteredDepartment->created_date        =  date('Y-m-d H:i:s');
            if ($this->ContractorRegisteredDepartments->save($contractorRegisteredDepartment)) {
                $this->Flash->success(__('The contractor registered department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractor registered department could not be saved. Please, try again.'));
        }
        $this->set(compact('contractorRegisteredDepartment'));
    }
    
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $contractorRegisteredDepartment = $this->ContractorRegisteredDepartments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contractorRegisteredDepartment = $this->ContractorRegisteredDepartments->patchEntity($contractorRegisteredDepartment, $this->request->getData());
            $contractorRegisteredDepartment->name                       = $this->request->getData('name');
            $contractorRegisteredDepartment->modified_date        = date('Y-m-d H:i:s');
            $contractorRegisteredDepartment->modified_by          = $user->id;
            if ($this->ContractorRegisteredDepartments->save($contractorRegisteredDepartment)) {
                $this->Flash->success(__('The contractor registered department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractor registered department could not be saved. Please, try again.'));
        }
        $this->set(compact('contractorRegisteredDepartment'));
    }
	
	public function delete($id = null)
    {
        // $this->loadModel('ContractorRegisteredDepartments');
        $this->ContractorRegisteredDepartments=$this->fetchTable('ContractorRegisteredDepartments');		
		$userTable          = $this->getTableLocator()->get('ContractorRegisteredDepartments');
		$user               = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'ContractorRegisteredDepartments', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'ContractorRegisteredDepartments', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }
    
    // public function delete($id = null)
    // {
        // $this->request->allowMethod(['post', 'delete']);
        // $contractorRegisteredDepartment = $this->ContractorRegisteredDepartments->get($id);
        // if ($this->ContractorRegisteredDepartments->delete($contractorRegisteredDepartment)) {
            // $this->Flash->success(__('The contractor registered department has been deleted.'));
        // } else {
            // $this->Flash->error(__('The contractor registered department could not be deleted. Please, try again.'));
        // }

        // return $this->redirect(['action' => 'index']);
    // }
}