<?php
declare(strict_types=1);
namespace App\Controller;

class TenderStatusesController extends AppController
{   
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        $tenderStatuses    = $this->TenderStatuses->find('all')->where(['TenderStatuses.is_active' => 1])->toArray(); 
        $this->set(compact('tenderStatuses'));
    }
   
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $tenderStatus = $this->TenderStatuses->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('tenderStatus'));
    }

    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');	
        $tenderStatus = $this->TenderStatuses->newEmptyEntity();

        if ($this->request->is('post')) {
            $tenderStatus->name             =  $this->request->getData('name');
            $tenderStatus->created_by       = $user->id;
            $tenderStatus->created_date     = date('Y-m-d H:i:s');
            if ($this->TenderStatuses->save($tenderStatus)) {
                $this->Flash->success(__('The tender status has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tender status could not be saved. Please, try again.'));
        }
        $this->set(compact('tenderStatus'));
    }
  
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');	
        $tenderStatus = $this->TenderStatuses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tenderStatus->name             =  $this->request->getData('name');
            $tenderStatus->modified_by       = $user->id;
            $tenderStatus->modified_date     = date('Y-m-d H:i:s');
            if ($this->TenderStatuses->save($tenderStatus)) {
                $this->Flash->success(__('The tender status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tender status could not be saved. Please, try again.'));
        }
        $this->set(compact('tenderStatus'));
    }
	
	 public function delete($id = null)
    {
       $this->TenderStatuses=$this->fetchTable('TenderStatuses');		
		$userTable          = $this->getTableLocator()->get('TenderStatuses');
		$user                = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'TenderStatuses', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'TenderStatuses', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }    
}