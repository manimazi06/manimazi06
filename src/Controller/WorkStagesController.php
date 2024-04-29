<?php

declare(strict_types=1);

namespace App\Controller;


class WorkStagesController extends AppController
{

    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        $workStages = $this->WorkStages->find('all')->where(['WorkStages.is_active' => 1]);
        $this->set(compact('workStages'));
    }


    public function view($id = null)
    {
        $workStage = $this->WorkStages->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('workStage'));
    }


    public function add()
    {

        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $workStage = $this->WorkStages->newEmptyEntity();
        if ($this->request->is('post')) {
             // print_r($_POST);
             // exit();
           // $workStage                       = $this->WorkStages->patchEntity($workStage, $this->request->getData());
            $name                             = $this->request->getData('name');
            $workStage->created_date         = date('Y-m-d H:i:s');
            $workStage->created_by           = $user->id;
            $workStage->name                 = $name;
            $name_role = $this->WorkStages->find('all')->where(['WorkStages.name' => $name])->count();
            if ($name_role > 0) {
                $this->Flash->error(__('Name is already exits'));
            } else {
                if ($this->WorkStages->save($workStage)) {
                    $this->Flash->success(__('The workStage has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The workStage could not be saved. Please, try again.'));
            }
        }
        

        // print_r($work);
        // exit();
        $this->set(compact('workStage'));
    }


    
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $id = base64_decode($id);
        // print_r($id);
        // exit();
        $workStage = $this->WorkStages->get($id, [
            'contain' => [],
        ]);
        // print_r($workStage);
        // exit();
        if ($this->request->is(['patch', 'post', 'put'])) {
            // print_r($_POST);
            // exit();
            $workStage = $this->WorkStages->patchEntity($workStage, $this->request->getData());
            // print_r($workStage);
            // exit();
            $name                             = $this->request->getData('name');

            $workStage->modified_date         = date('Y-m-d H:i:s');
            $workStage->modified_by           = $user->id;
            $workStage->name                 = $name;

            $name_role = $this->WorkStages->find('all')->where(['WorkStages.name' => $name,'WorkStages.id !='=>$id])->count();
            //$code = $this->WorkStages->find('all')->where(['WorkStages.dept_code !=' => $dept_code])->count();
            //  print_r($name_role);
            //  exit();
            if ($name_role > 0) {
                $this->Flash->error(__('Name is already exits'));

                // print_r($name_role);
                // exit();
                // if ($code > 0) {
                //     $this->Flash->error(__('code is already exits'));} 
            } else {
                if ($this->WorkStages->save($workStage)) {
                    $this->Flash->success(__('The workStage has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The workStage could not be saved. Please, try again.'));
            }
            // print_r($this->Flash);
            // exit();
        }
        $work = $this->WorkStages->find('list', ['limit' => 200])->all();
        $this->set(compact('workStage'));
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $workStage = $this->WorkStages->get($id);
        if ($this->WorkStages->delete($workStage)) {
            $this->Flash->success(__('The work stage has been deleted.'));
        } else {
            $this->Flash->error(__('The work stage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
