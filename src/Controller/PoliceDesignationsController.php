<?php
declare(strict_types=1);
namespace App\Controller;

class PoliceDesignationsController extends AppController
{    
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        $policeDesignations = $this->PoliceDesignations->find('all')->where(['PoliceDesignations.is_active' => 1]);
        $this->set(compact('policeDesignations'));
    }
   
    public function view($id = null)
    {
        $policeDesignation = $this->PoliceDesignations->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('policeDesignation'));
    }
   
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->Departments=$this->fetchTable('Departments');

        $policeDesignation = $this->PoliceDesignations->newEmptyEntity();
        if ($this->request->is('post')) {
            $policeDesignation->name         =  $this->request->getData('name');
            $policeDesignation->created_by          =  $user->id;
            $policeDesignation->created_date        =  date('Y-m-d H:i:s');


            if ($this->PoliceDesignations->save($policeDesignation)) {

                $this->Flash->success(__('The PoliceDesignations has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The PoliceDesignations could not be saved. Please, try again.'));
        }

        $this->set(compact('policeDesignation'));
    }
    
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $policeDesignation = $this->PoliceDesignations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $policeDesignation = $this->PoliceDesignations->patchEntity($policeDesignation, $this->request->getData());
            if ($this->PoliceDesignations->save($policeDesignation)) {
                $this->Flash->success(__('The police designation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The police designation could not be saved. Please, try again.'));
        }
        $this->set(compact('policeDesignation'));
    }
  
   public function delete($id = null)
    {
       $this->PoliceDesignations=$this->fetchTable('PoliceDesignations');		
		$userTable          = $this->getTableLocator()->get('PoliceDesignations');
		$user                = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'PoliceDesignations', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'PoliceDesignations', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }	
}