<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;


class BuildingMaterialDetailsController extends AppController
{
  
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        $connection            = ConnectionManager::get('default');
         $query         = "SELECT building.building_material_id as material_id,bm.name as material_name
                            FROM building_material_details as building
                            LEFT JOIN building_materials as bm on bm.id = building.building_material_id
                            group by material_id";

        $projects  = $connection->execute($query)->fetchAll('assoc');
        $this->set(compact('projects'));
    }

    
    /*public function view($id = null)
    {
        $buildingMaterialDetails = $this->BuildingMaterialDetails->get($id, [
            'contain' => ['BuildingMaterials', 'BuildingSubmaterials', 'Units'],
        ]);

        $this->set(compact('buildingMaterialDetails'));
    }*/
	
	public function view($material_id = null)
    {
        $this->viewBuilder()->setLayout('layout');

        // $buildingMaterialDetails = $this->BuildingMaterialDetails->get($material_id, [
            // 'contain' => ['BuildingMaterials', 'BuildingSubmaterials', 'Units'],
        // ]);


        $buildingdetails         = $this->BuildingMaterialDetails->find('all')->contain(['BuildingMaterials', 'BuildingSubmaterials', 'Units'])->where(['BuildingMaterialDetails.building_material_id' => $material_id])->toArray();

       //echo "<pre>";  print_r($buildingdetails); exit();
        $this->set(compact('buildingMaterialDetails', 'buildingdetails'));
    }


    public function buildingmaterial()

    {
        $this->viewBuilder()->setLayout('layout');


        $user = $this->request->getAttribute('identity');

         $buildingMaterialcount    = $this->BuildingMaterialDetails->find('all')->count();
        
        if ($this->request->is(['patch', 'post', 'put'])) {
         
            foreach ($this->request->getData('building') as $key => $value) {
                $buildingMaterialDetail = $this->BuildingMaterialDetails->newEmptyEntity();             
                $buildingMaterialDetail->building_material_id        = ($this->request->getData('building_material_id') != '') ?  $this->request->getData('building_material_id') : '';
                $buildingMaterialDetail->building_submaterial_id     = $value['building_submaterial_id'];
                $buildingMaterialDetail->unit_id                     = $value['unit_id'];
                $buildingMaterialDetail->quantity                    = $value['quantity'];
                $buildingMaterialDetail->created_by                  =  $user->id;
                $buildingMaterialDetail->created_date                =  date('Y-m-d:h:m:s');  
                $this->BuildingMaterialDetails->save($buildingMaterialDetail); 
			}


            $this->Flash->success(__('The Building Material detail has been saved.'));
            return $this->redirect(['action' => 'index']);
            $this->Flash->error(__('The Building Material detail could not be saved. Please, try again.'));
        }

        // print_r($financial_year);
        $buildingMaterials = $this->BuildingMaterialDetails->BuildingMaterials->find('list', ['limit' => 200])->all();
        $buildingSubmaterials = $this->BuildingMaterialDetails->BuildingSubmaterials->find('list', ['limit' => 200])->all();
        $units = $this->BuildingMaterialDetails->Units->find('list', ['keyField' => 'id','valueField' => 'name_code'])->all();

        $this->set(compact('building', 'buildingMaterialcount', 'buildingdetails', 'buildingMaterialDetail', 'buildingMaterials', 'buildingSubmaterials', 'units'));
    }

   

    public function buildingmaterialedit($material_id = null)
    {
        $this->viewBuilder()->setLayout('layout');

        $user = $this->request->getAttribute('identity');
        $buildingMaterialcount    = $this->BuildingMaterialDetails->find('all')->where(['BuildingMaterialDetails.building_material_id' => $material_id])->count();
        $buildingdetails         = $this->BuildingMaterialDetails->find('all')->where(['BuildingMaterialDetails.building_material_id' => $material_id])->toArray();
       
        $building                = $this->BuildingMaterialDetails->find('all')->contain(['BuildingMaterials'])->where(['BuildingMaterialDetails.building_material_id' => $material_id])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
             foreach ($this->request->getData('building') as $key => $value) {
                if ($value['id'] != '') {
                    $buildingMaterialDetail = $this->BuildingMaterialDetails->get($value['id'], [
                        'contain' => ['BuildingMaterials', 'BuildingSubmaterials', 'Units'],
                    ]);
					$buildingMaterialDetail->modified_by                =  $user->id;
                    $buildingMaterialDetail->modified_date              =  date('Y-m-d:h:m:s');
                 } else {
                    $buildingMaterialDetail = $this->BuildingMaterialDetails->newEmptyEntity();
					$buildingMaterialDetail->created_by                  =  $user->id;
                    $buildingMaterialDetail->created_date                =  date('Y-m-d:h:m:s'); 
                }
                $buildingMaterialDetail->building_material_id       = $value['building_material_id'];
                $buildingMaterialDetail->building_submaterial_id    = $value['building_submaterial_id'];
                $buildingMaterialDetail->unit_id                    = $value['unit_id'];
                $buildingMaterialDetail->quantity                   = $value['quantity'];
                
             
                $this->BuildingMaterialDetails->save($buildingMaterialDetail);
            }


            $this->Flash->success(__('The Building Material detail has been saved.'));
            return $this->redirect(['action' => 'index']);
            $this->Flash->error(__('The Building Material detail could not be saved. Please, try again.'));
        }
        $buildingMaterials = $this->BuildingMaterialDetails->BuildingMaterials->find('list', ['limit' => 200])->all();
        $buildingSubmaterials = $this->BuildingMaterialDetails->BuildingSubmaterials->find('list', ['limit' => 200])->all();
        $units = $this->BuildingMaterialDetails->Units->find('list', ['limit' => 200])->all();
        $this->set(compact('buildingMaterialcount', 'buildingdetails', 'building', 'buildingMaterialDetail', 'buildingMaterials', 'buildingSubmaterials', 'units'));
    }
   

    public function ajaxbuildingdetails($i = null)
    {

        $buildingMaterials = $this->BuildingMaterialDetails->BuildingMaterials->find('list', ['limit' => 200])->all();
        $buildingSubmaterials = $this->BuildingMaterialDetails->BuildingSubmaterials->find('list', ['limit' => 200])->all();
        $units = $this->BuildingMaterialDetails->Units->find('list', ['limit' => 200])->all();
        $this->set(compact('i', 'buildingMaterials', 'buildingSubmaterials', 'units'));
    }

    public function ajaxcalling($id = null)
    {
        $buildingMaterialcount    = $this->BuildingMaterialDetails->find('all')->where(['BuildingMaterialDetails.building_material_id' => $id])->count();
        if ($buildingMaterialcount > 0) {
            echo 1;
        } else {
            echo 0;
        }
        exit();
    }
}
