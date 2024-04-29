<?php
declare(strict_types=1);
namespace App\Controller;

class NewBuildingItemsController extends AppController
{
    
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
		$this->BuildingItemTypes=$this->fetchTable('BuildingItemTypes');
		$user = $this->request->getAttribute('identity');
		$role_id = $user->role_id;
		if ($this->request->is('post')) {
		  $building_item_type_id = $this->request->getData('building_item_type_id');
		  
		  $newbuildingItems = $this->NewBuildingItems->find('all')->contain(['BuildingItemTypes','Units'])->where(['NewBuildingItems.is_active' => 1,'NewBuildingItems.building_item_type_id'=>$building_item_type_id])->order(['NewBuildingItems.building_item_type_id ASC']);
		  
		}else{
           $newbuildingItems = $this->NewBuildingItems->find('all')->contain(['BuildingItemTypes','Units'])->where(['NewBuildingItems.is_active' => 1])->order(['NewBuildingItems.building_item_type_id ASC']);
		}  
	  
	  $buildingItemtypes    = $this->BuildingItemTypes->find('list',  ['keyField' => 'id', 'valueField' => 'name'])->order(['BuildingItemTypes.id ASC'])->toArray();

        $this->set(compact('newbuildingItems','buildingItemtypes','role_id'));
    }
	
	 public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $newBuildingItem = $this->NewBuildingItems->get($id, [
            'contain' => ['BuildingItemTypes','Units'],
        ]);
       
        $this->set(compact('newBuildingItem'));
    }
    
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
		$this->Units=$this->fetchTable('Units');
        $user = $this->request->getAttribute('identity');
        $newBuildingItem = $this->NewBuildingItems->newEmptyEntity();
        if ($this->request->is('post')) {
            // echo '<pre>';
            // print_r($this->request->is('post'));
            // exit();
            $newBuildingItem = $this->NewBuildingItems->patchEntity($newBuildingItem, $this->request->getData());
            $building_type                       = $this->request->getData('building_item_type_id');
            $item_code                       = $this->request->getData('item_code');
            $item_description                       = $this->request->getData('item_description');
            $unit_id                         = $this->request->getData('unit_id');
            $newBuildingItem->created_date           = date('Y-m-d H:i:s');
            $newBuildingItem->created_by             = $user->id;
            $newBuildingItem->item_code              = $item_code;
            $newBuildingItem->item_description       = $item_description;
            $newBuildingItem->unit_id                = $unit_id;
            $newBuildingItem->building_item_type_id  = $building_type;

            if ($this->NewBuildingItems->save($newBuildingItem)) {
                $this->Flash->success(__('The new building item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The new building item could not be saved. Please, try again.'));
        }
        $buildingItemTypes = $this->NewBuildingItems->BuildingItemTypes->find('list', ['limit' => 200])->all();
        $units = $this->Units->find('list', ['limit' => 200])->all();
        $this->set(compact('newBuildingItem', 'buildingItemTypes','units'));
    }

   
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
		$this->Units=$this->fetchTable('Units');
        $user = $this->request->getAttribute('identity');
        $newBuildingItem = $this->NewBuildingItems->get($id, [
            'contain' => [],
        ]);
      
        if ($this->request->is(['patch', 'post', 'put'])) {
            $newBuildingItem = $this->NewBuildingItems->patchEntity($newBuildingItem, $this->request->getData());
            $id =  $id;
            $building_type                           = $this->request->getData('building_item_type_id');
            $item_code                               = $this->request->getData('item_code');
            $item_description                        = $this->request->getData('item_description');
			$unit_id                                 = $this->request->getData('unit_id');

            $newBuildingItem->modified_date          = date('Y-m-d H:i:s');
            $newBuildingItem->modified_by            = $user->id;
            $newBuildingItem->item_code              = $item_code;
            $newBuildingItem->item_description       = $item_description;
            $newBuildingItem->unit_id                = $unit_id;
            $newBuildingItem->building_item_type_id  = $building_type;

            if ($this->NewBuildingItems->save($newBuildingItem)) {
                $this->Flash->success(__('The new building item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The new building item could not be saved. Please, try again.'));
        }
        $buildingItemTypes = $this->NewBuildingItems->BuildingItemTypes->find('list', ['limit' => 200])->all();
		 $units = $this->Units->find('list', ['limit' => 200])->all();

        $this->set(compact('newBuildingItem', 'buildingItemTypes','units'));
    }
	
	 public function delete($id = null)
    {
       $this->NewBuildingItems=$this->fetchTable('NewBuildingItems');	
       $this->ProjectwiseAbstractSubdetails=$this->fetchTable('ProjectwiseAbstractSubdetails');	
   
        $abstract_count = $this->ProjectwiseAbstractSubdetails->find('all')->where(['ProjectwiseAbstractSubdetails.new_building_item_id'=>$id])->count();		

	   if($abstract_count == 0){
		$userTable          = $this->getTableLocator()->get('NewBuildingItems');
		$user                = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			  $this->Flash->success(__('The building item has been Deleted Successfully.'));
			 return $this->redirect(['controller' => 'NewBuildingItems', 'action' => 'index']);

        } else {

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
			 return $this->redirect(['controller' => 'NewBuildingItems', 'action' => 'index']);
        }	
	   }else{

            $this->Flash->error(__('Unable to Delete. Please, contact Admin.'));  
		   return $this->redirect(['controller' => 'NewBuildingItems', 'action' => 'index']);

	   }		   
		exit();
    }
    
    // public function delete($id = null)
    // {
        // $this->request->allowMethod(['post', 'delete']);
        // $newBuildingItem = $this->NewBuildingItems->get($id);
        // if ($this->NewBuildingItems->delete($newBuildingItem)) {
            // $this->Flash->success(__('The new building item has been deleted.'));
        // } else {
            // $this->Flash->error(__('The new building item could not be deleted. Please, try again.'));
        // }

        // return $this->redirect(['action' => 'index']);
    // }

    public function ajaxbuildingitems($id = null)
    {
        $newBuildingItem    = $this->NewBuildingItems->find('all')->where(['NewBuildingItems.item_code' => $id])->count();
        if ($newBuildingItem > 0) {
            echo 1;
        } else {
            echo 0;
        }
        exit();
    }

    /*public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $buildingItem = $this->NewBuildingItems->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('buildingItem'));
    }
   
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');

        $buildingItem = $this->NewBuildingItems->newEmptyEntity();
        if ($this->request->is('post')) {
            //  echo"<pre>";print_r($_POST);exit();
            $buildingItem->item_code                =  $this->request->getData('item_code');
            $buildingItem->item_description         =  $this->request->getData('item_description');
            $buildingItem->created_by          =  $user->id;
            $buildingItem->created_date        =  date('Y-m-d H:i:s');


            if ($this->NewBuildingItems->save($buildingItem)) {

                $this->Flash->success(__('The BuildingItems has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The BuildingItems could not be saved. Please, try again.'));
        }

        $this->set(compact('buildingItem'));
    }
   
    public function edit($id = null)

    {
        $this->viewBuilder()->setLayout('layout');

        $user = $this->request->getAttribute('identity');
        $buildingItem = $this->NewBuildingItems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $buildingItem = $this->NewBuildingItems->patchEntity($buildingItem, $this->request->getData());
            $item_code                           = $this->request->getData('item_code');
            $item_description                = $this->request->getData('item_description');
            $buildingItem->modified_date        = date('Y-m-d H:i:s');
            $buildingItem->modified_by          = $user->id;
            $buildingItem->item_code                 = $item_code;
            $item_code_role = $this->NewBuildingItems->find('all')->where(['BuildingItems.item_code' => $item_code, 'BuildingItems.item_code !=' => $item_code])->count();
            if ($item_code_role > 0) {
                $this->Flash->error(__('item code is already exits'));
                // return $this->redirect(['action' => 'index']);
            } else {
                if ($this->NewBuildingItems->save($buildingItem)) {
                    $this->Flash->success(__('The buildingItem has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The buildingItem could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('buildingItem','id'));
    }  
   
	public function ajaxcode($code = null,$id = null)
    {
        if ($code != '' && $id==0) {
            $item_code= $this->NewBuildingItems->find('all')->where(['BuildingItems.item_code' => $code])->count();

            if ($item_code > 0) {
                echo "1";
            } else {
                echo "0";
            }
        }else if($code != '' && $id !=0){
            $item_code = $this->NewBuildingItems->find('all')->where(['BuildingItems.item_code' => $code, 'BuildingItems.id !=' => $id])->count();

            if ($item_code > 0) {
                echo "1";
            } else {
                echo "0";
            }
        }
		exit();
    }*/
}