<?php
declare(strict_types=1);
namespace App\Controller;

class RolesController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        $roles = $this->Roles->find('all')->where(['Roles.is_active' => 1])->toArray();       
        $this->set(compact('roles'));
    }

    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $role = $this->Roles->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('role'));
    }


    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        // print_r($user);exit();
        $role = $this->Roles->newEmptyEntity();
        if ($this->request->is('post')) {
           
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            $name                       = $this->request->getData('name');
            $role->created_date         = date('Y-m-d H:i:s');
            $role->created_by           = $user->id;
            $role->name                 = $name;
            $name_role = $this->Roles->find('all')->where(['Roles.name' => $name,'Roles.is_active' => 1])->count();
            if ($name_role > 0) {
                $this->Flash->error(__('Name is already exits'));
            } else {
                if ($this->Roles->save($role)) {
                    $this->Flash->success(__('The role has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('role'));
    }

    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $role = $this->Roles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            $name                        = $this->request->getData('name');
            $role->modified_date         = date('Y-m-d H:i:s');
            $role->modified_by           = $user->id;
            $role->name                  = $name;           
            $name_role = $this->Roles->find('all')->where(['Roles.name' => $name,'Roles.is_active' => 1, 'Roles.id !=' => $id])->count();
            if ($name_role > 0) {
                $this->Flash->error(__('Name is already exits'));
            } else {
                if ($this->Roles->save($role)) {
                    $this->Flash->success(__('The role has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('role'));
    }
   
    public function delete($id = null)
    {
       $this->Roles=$this->fetchTable('Roles');		
		$userTable          = $this->getTableLocator()->get('Roles');
		$user                = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'Roles', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'Roles', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }
}
