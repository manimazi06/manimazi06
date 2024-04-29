<?php
declare(strict_types=1);
namespace App\Controller;

class ContractorClassesController extends AppController
{
  
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        //$user = $this->request->getAttribute('identity');
        //$contractorClasses = $this->paginate($this->ContractorClasses);
        $contractorClasses = $this->ContractorClasses->find('all')->where(['ContractorClasses.is_active' => 1]);

        $this->set(compact('contractorClasses'));
    }

  
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $contractorClass = $this->ContractorClasses->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('contractorClass'));
    }

  
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $contractorClass = $this->ContractorClasses->newEmptyEntity();
        if ($this->request->is('post')) {
            $contractorClass = $this->ContractorClasses->patchEntity($contractorClass, $this->request->getData());
            $contractorClass->name                       = $this->request->getData('name');
            $contractorClass->monetary_value                       = $this->request->getData('monetary_value');
            $contractorClass->created_by          =  $user->id;
            if ($this->ContractorClasses->save($contractorClass)) {
                $this->Flash->success(__('The contractor class has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractor class could not be saved. Please, try again.'));
        }
        $this->set(compact('contractorClass'));
    }

 
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $contractorClass = $this->ContractorClasses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contractorClass = $this->ContractorClasses->patchEntity($contractorClass, $this->request->getData());
            $contractorClass->name                       = $this->request->getData('name');
            $contractorClass->monetary_value                       = $this->request->getData('monetary_value');
            $contractorClass->modified_date        = date('Y-m-d H:i:s');
            $contractorClass->modified_by          = $user->id;
            if ($this->ContractorClasses->save($contractorClass)) {
                $this->Flash->success(__('The contractor class has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractor class could not be saved. Please, try again.'));
        }
        $this->set(compact('contractorClass'));
    }
	
   public function delete($id = null)
    {
        $this->ContractorClasses=$this->fetchTable('ContractorClasses');		
		$userTable          = $this->getTableLocator()->get('ContractorClasses');
		$user               = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'ContractorClasses', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'ContractorClasses', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }

    
    // public function delete($id = null)
    // {
        // $this->request->allowMethod(['post', 'delete']);
        // // $contractorClass = $this->ContractorClasses->get($id);
        // $contractorClassTable           = $this->getTableLocator()->get('Categories');
		// $contractorClass                = $contractorClassTable->get($id); 
		// $contractorClass->is_active        = 0;
		// $contractorClass->modified_date = date('Y-m-d H:i:s'); 
        // if ($this->ContractorClasses->save($contractorClass)) {
            // $this->Flash->success(__('The contractor class has been deleted.'));
        // } else {
            // $this->Flash->error(__('The contractor class could not be deleted. Please, try again.'));
        // }

        // return $this->redirect(['action' => 'index']);
    // }
}