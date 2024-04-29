<?php
declare(strict_types=1);
namespace App\Controller;

class UnitsController extends AppController
{ 
    public function index()
    {
		$this->viewBuilder()->setLayout('layout');
		$units = $this->Units->find('all')->where(['Units.is_active' => 1])->toArray();
        $this->set(compact('units'));
    }

    public function view($id = null)
    {
		$this->viewBuilder()->setLayout('layout');
        $unit = $this->Units->get($id, [
            'contain' => ['ProjectwiseDetailedEstimates'],
        ]);
        $this->set(compact('unit'));
    }

    public function add()
    {
		$this->viewBuilder()->setLayout('layout');
        $unit = $this->Units->newEmptyEntity();
        if ($this->request->is('post')) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $this->Flash->success(__('The unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The unit could not be saved. Please, try again.'));
        }
        $this->set(compact('unit'));
    }
 
    public function edit($id = null)
    {
		$this->viewBuilder()->setLayout('layout');
        $unit = $this->Units->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $this->Flash->success(__('The unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The unit could not be saved. Please, try again.'));
        }
        $this->set(compact('unit'));
    }
	
	 public function delete($id = null)
    {
       $this->Units=$this->fetchTable('Units');		
		$userTable          = $this->getTableLocator()->get('Units');
		$user                = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'Units', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'Units', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }  
}