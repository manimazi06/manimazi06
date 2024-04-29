<?php
declare(strict_types=1);

namespace App\Controller;


class DivisionsController extends AppController
{   
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
		$divisions = $this->Divisions->find('all')->where(['Divisions.is_active' => 1])->toArray();
        $this->set(compact('divisions'));
    }
 
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $division = $this->Divisions->get($id, [
            'contain' => ['Districts', 'Users'],
        ]);

        $this->set(compact('division'));
    }
  
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $division = $this->Divisions->newEmptyEntity();
        if ($this->request->is('post')) {
            $division = $this->Divisions->patchEntity($division, $this->request->getData());
            if ($this->Divisions->save($division)) {
                $this->Flash->success(__('The division has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The division could not be saved. Please, try again.'));
        }
        $this->set(compact('division'));
    }

    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        //$id = base64_decode($id);
        $division = $this->Divisions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $division = $this->Divisions->patchEntity($division, $this->request->getData());
            if ($this->Divisions->save($division)) {
                $this->Flash->success(__('The division has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The division could not be saved. Please, try again.'));
        }
        $this->set(compact('division'));
    }   
	
	public function delete($id = null)
    {
       //$this->loadModel('Divisions');
       $this->Divisions=$this->fetchTable('Divisions');		
		$userTable          = $this->getTableLocator()->get('Divisions');
		$user                = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'Divisions', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'Divisions', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }
}
