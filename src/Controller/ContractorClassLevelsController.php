<?php
declare(strict_types=1);

namespace App\Controller;


class ContractorClassLevelsController extends AppController
{
   
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        $contractorClassLevels = $this->ContractorClassLevels->find('all')->where(['ContractorClassLevels.is_active' => 1]);

        $this->set(compact('contractorClassLevels'));
    }
    
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $contractorClassLevel = $this->ContractorClassLevels->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('contractorClassLevel'));
    }
    
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $contractorClassLevel = $this->ContractorClassLevels->newEmptyEntity();
        if ($this->request->is('post')) {
            $contractorClassLevel = $this->ContractorClassLevels->patchEntity($contractorClassLevel, $this->request->getData());
            $contractorClassLevel->name                       = $this->request->getData('name');
            $contractorClassLevel->created_by          =  $user->id;
            $contractorClassLevel->created_date        =  date('Y-m-d H:i:s');
            if ($this->ContractorClassLevels->save($contractorClassLevel)) {
                $this->Flash->success(__('The contractor class level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractor class level could not be saved. Please, try again.'));
        }
        $this->set(compact('contractorClassLevel'));
    }
  
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $contractorClassLevel = $this->ContractorClassLevels->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contractorClassLevel = $this->ContractorClassLevels->patchEntity($contractorClassLevel, $this->request->getData());
            $contractorClassLevel->name                       = $this->request->getData('name');
            $contractorClassLevel->modified_date        = date('Y-m-d H:i:s');
            $contractorClassLevel->modified_by          = $user->id;
            if ($this->ContractorClassLevels->save($contractorClassLevel)) {
                $this->Flash->success(__('The contractor class level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractor class level could not be saved. Please, try again.'));
        }
        $this->set(compact('contractorClassLevel'));
    }
	
	
	public function delete($id = null)
    {
 
        $this->ContractorClassLevels=$this->fetchTable('ContractorClassLevels');		
		$userTable          = $this->getTableLocator()->get('ContractorClassLevels');
		$user               = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'ContractorClassLevels', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'ContractorClassLevels', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }	
    
    // public function delete($id = null)
    // {
        // $this->request->allowMethod(['post', 'delete']);
        // $contractorClassLevel = $this->ContractorClassLevels->get($id);
        // if ($this->ContractorClassLevels->delete($contractorClassLevel)) {
            // $this->Flash->success(__('The contractor class level has been deleted.'));
        // } else {
            // $this->Flash->error(__('The contractor class level could not be deleted. Please, try again.'));
        // }

        // return $this->redirect(['action' => 'index']);
    // }
}