<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BuildingTypes Controller
 *
 * @property \App\Model\Table\BuildingTypesTable $BuildingTypes
 * @method \App\Model\Entity\BuildingType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BuildingTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $buildingTypes = $this->paginate($this->BuildingTypes);

        $this->set(compact('buildingTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Building Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $buildingType = $this->BuildingTypes->get($id, [
            'contain' => ['ProjectWorks'],
        ]);

        $this->set(compact('buildingType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $buildingType = $this->BuildingTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $buildingType = $this->BuildingTypes->patchEntity($buildingType, $this->request->getData());
            if ($this->BuildingTypes->save($buildingType)) {
                $this->Flash->success(__('The building type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The building type could not be saved. Please, try again.'));
        }
        $this->set(compact('buildingType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Building Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $buildingType = $this->BuildingTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $buildingType = $this->BuildingTypes->patchEntity($buildingType, $this->request->getData());
            if ($this->BuildingTypes->save($buildingType)) {
                $this->Flash->success(__('The building type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The building type could not be saved. Please, try again.'));
        }
        $this->set(compact('buildingType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Building Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $buildingType = $this->BuildingTypes->get($id);
        if ($this->BuildingTypes->delete($buildingType)) {
            $this->Flash->success(__('The building type has been deleted.'));
        } else {
            $this->Flash->error(__('The building type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
