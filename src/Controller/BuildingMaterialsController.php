<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * BuildingMaterials Controller
 *
 * @property \App\Model\Table\BuildingMaterialsTable $BuildingMaterials
 * @method \App\Model\Entity\BuildingMaterial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BuildingMaterialsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {


        $this->viewBuilder()->setLayout('layout');
        $buildingMaterials = $this->BuildingMaterials->find('all')->where(['BuildingMaterials.is_active' => 1]);
        $this->set(compact('buildingMaterials'));
    }

    /**
     * View method
     *
     * @param string|null $id Building Material id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $buildingMaterial = $this->BuildingMaterials->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('buildingMaterial'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()

    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');

        $buildingMaterial = $this->BuildingMaterials->newEmptyEntity();
        if ($this->request->is('post')) {
            //  echo"<pre>";print_r($_POST);exit();
            $buildingMaterial->name                =  $this->request->getData('name');
            $buildingMaterial->division_id         =  $this->request->getData('division_id');
            $buildingMaterial->created_by          =  $user->id;
            $buildingMaterial->created_date        =  date('Y-m-d H:i:s');


            if ($this->BuildingMaterials->save($buildingMaterial)) {

                $this->Flash->success(__('The BuildingMaterials has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The BuildingMaterials could not be saved. Please, try again.'));
        }

        $this->set(compact('buildingMaterial'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Building Material id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)

    {
        $this->viewBuilder()->setLayout('layout');

        $user = $this->request->getAttribute('identity');
        $buildingMaterial = $this->BuildingMaterials->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $buildingMaterial = $this->BuildingMaterials->patchEntity($buildingMaterial, $this->request->getData());
            $name                           = $this->request->getData('name');
            $buildingMaterial->modified_date        = date('Y-m-d H:i:s');
            $buildingMaterial->modified_by          = $user->id;
            $buildingMaterial->name                 = $name;
            $name_role = $this->BuildingMaterials->find('all')->where(['BuildingMaterials.name' => $name, 'BuildingMaterials.name !=' => $name])->count();
            if ($name_role > 0) {
                $this->Flash->error(__('Name is already exits'));
                // return $this->redirect(['action' => 'index']);
            } else {
                if ($this->BuildingMaterials->save($buildingMaterial)) {
                    $this->Flash->success(__('The buildingMaterial has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The buildingMaterial could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('buildingMaterial'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Building Material id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $buildingMaterial = $this->BuildingMaterials->get($id);
        if ($this->BuildingMaterials->delete($buildingMaterial)) {
            $this->Flash->success(__('The building material has been deleted.'));
        } else {
            $this->Flash->error(__('The building material could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
