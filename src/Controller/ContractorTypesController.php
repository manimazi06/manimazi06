<?php
declare(strict_types=1);

namespace App\Controller;

class ContractorTypesController extends AppController
{
    
    public function index()
    {
       $this->viewBuilder()->setLayout('layout');
       
        $contractorTypes = $this->ContractorTypes->find('all')->where(['ContractorTypes.is_active' => 1]);
   
        $this->set(compact('contractorTypes'));
    }
   
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $contractorType = $this->ContractorTypes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('contractorType'));
    }
	
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $contractorType = $this->ContractorTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $contractorType = $this->ContractorTypes->patchEntity($contractorType, $this->request->getData());
            $contractorType->name                       = $this->request->getData('name');
            $contractorType->created_by          =  $user->id;
            $contractorType->created_date        =  date('Y-m-d H:i:s');
            if ($this->ContractorTypes->save($contractorType)) {
                $this->Flash->success(__('The contractor type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractor type could not be saved. Please, try again.'));
        }
        $this->set(compact('contractorType'));
    }
  
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');

        $contractorType = $this->ContractorTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contractorType = $this->ContractorTypes->patchEntity($contractorType, $this->request->getData());
            $contractorType->name                       = $this->request->getData('name');
            $contractorType->modified_date        = date('Y-m-d H:i:s');
            $contractorType->modified_by          = $user->id;
            if ($this->ContractorTypes->save($contractorType)) {
                $this->Flash->success(__('The contractor type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractor type could not be saved. Please, try again.'));
        }
        $this->set(compact('contractorType'));
    }
	
	public function delete($id = null)
    {
        $this->ContractorTypes=$this->fetchTable('ContractorTypes');		
		$userTable          = $this->getTableLocator()->get('ContractorTypes');
		$user               = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'ContractorTypes', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'ContractorTypes', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }
 
    // public function delete($id = null)
    // {
        // $this->request->allowMethod(['post', 'delete']);
        // $contractorType = $this->ContractorTypes->get($id);
        // if ($this->ContractorTypes->delete($contractorType)) {
            // $this->Flash->success(__('The contractor type has been deleted.'));
        // } else {
            // $this->Flash->error(__('The contractor type could not be deleted. Please, try again.'));
        // }

        // return $this->redirect(['action' => 'index']);
    // }
}