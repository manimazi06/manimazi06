<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;


class FinancialyearwiseMaterialCostSubdetailsController extends AppController
{
   
    public function index()
    {

        $this->viewBuilder()->setLayout('layout');
        // $this->paginate = [
        //     'contain' => ['FinancialyearwiseMaterialCostDetails', 'BuildingMaterials', 'Units'],
        // ];
        // $financialyearwiseMaterialCostSubdetails = $this->FinancialyearwiseMaterialCostSubdetails->find('all')->contain(['FinancialyearwiseMaterialCostDetails'])->where(['FinancialyearwiseMaterialCostSubdetails.is_active' => 1]);
        $this->FinancialYears=$this->fetchTable('FinancialYears');
        if ($this->request->is(['post', 'patch', 'put'])) {

            $financial          = $this->request->getData('financial_year_id');

            $connection            = ConnectionManager::get('default');
            // print_r($connection);
            // exit();
            if ($financial) {
                //  echo "<pre>";  print_r($financial); exit();
                $query                 = "SELECT materialcost.id as main_id,
                                          financialyears.name AS fyear,
                                          building.name as bname                                 
										  FROM financialyearwise_material_cost_details as materialcost
										  LEFT JOIN financial_years as financialyears on financialyears.id = materialcost.financial_year_id
										  LEFT JOIN building_materials as building on building.id = materialcost.id
										  where materialcost.financial_year_id= $financial
										  order by materialcost.created_date DESC";

                $projects  = $connection->execute($query)->fetchAll('assoc');
                // echo "<pre>";
                // print_r($projects);
                // exit();
                // print_r($query);
                // exit();
            }
        }
        $financial_year = $this->FinancialYears->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['FinancialYears.is_active' => 1])->toArray();

        $this->set(compact('financial', 'projects', 'financial_year'));
    }

    /**
     * View method
     *
     * @param string|null $id Financialyearwise Material Cost Subdetail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->setLayout('layout');
        $this->FinancialyearwiseMaterialCostDetails=$this->fetchTable('FinancialyearwiseMaterialCostDetails');
        $this->FinancialyearwiseMaterialCostSubdetails=$this->fetchTable('FinancialyearwiseMaterialCostSubdetails');
        $user = $this->request->getAttribute('identity');
		
		   $MaterialCostDetail     = $this->FinancialyearwiseMaterialCostDetails->find('all')->contain(['BuildingMaterials','FinancialYears'])->where(['FinancialyearwiseMaterialCostDetails.id'=>$id])->first();
           
	       $material_Detail_count  = $this->FinancialyearwiseMaterialCostSubdetails->find('all')->where(['FinancialyearwiseMaterialCostSubdetails.financialyearwise_material_cost_detail_id' => $id])->count();

            $connection            = ConnectionManager::get('default');

            $query                 =  "SELECT sub_detail.*,bsm.name as subtype,bmd.quantity as quantity,u.name_code as name_code
										 from financialyearwise_material_cost_subdetails as sub_detail 
										 LEFT JOIN building_material_details as bmd on bmd.id= sub_detail.building_material_detail_id 
										 LEFT JOIN building_submaterials as bsm on bsm.id= bmd.building_submaterial_id 
										 LEFT JOIN units as u on u.id= bmd.unit_id 
										 where sub_detail.financialyearwise_material_cost_detail_id = ".$id."";											 
											 
			  $material_Details  = $connection->execute($query)->fetchAll('assoc'); 


              $query         =  "SELECT sum(sub_detail.amount) as tot_amount
							 from financialyearwise_material_cost_subdetails as sub_detail 
							 where sub_detail.financialyearwise_material_cost_detail_id =  ".$id."";											 
											 
			  $amount        = $connection->execute($query)->fetchAll('assoc'); 
			  if($amount[0]['tot_amount'] != ''){
                $tot_amount    = $amount[0]['tot_amount'];
			  }else{
                 $tot_amount    = 0;
			  }	
			  
	   $this->set(compact('tot_amount','material_Details','material_Detail_count','MaterialCostDetail', 'MaterialCostsubDetail', 'financialyearwiseMaterialCostDetailscount', 'financialyearwiseMaterialCostDetails', 'financialyearwiseMaterialCostSubdetail', 'financialyearwiseMaterialCostSubdetailcount', 'financialyearwiseMaterialCostSubdetails', 'financialyearwiseMaterialCostDetails', 'financial_year', 'building_materials', 'units'));
	  
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)

    {
        $this->viewBuilder()->setLayout('layout');
        $this->FinancialyearwiseMaterialCostDetails=$this->fetchTable('FinancialyearwiseMaterialCostDetails');
        $this->FinancialYears=$this->fetchTable('FinancialYears');
        $this->BuildingMaterials=$this->fetchTable('BuildingMaterials');
        $this->Units=$this->fetchTable('Units');

        $user = $this->request->getAttribute('identity');


        $financialyearwiseMaterialCostDetails       = $this->FinancialyearwiseMaterialCostDetails->newEmptyEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>'; print_r($this->request->getData()); exit();
           
            $financialyearwiseMaterialCostDetails->financial_year_id     = $this->request->getData('financial_year_id');
            $financialyearwiseMaterialCostDetails->building_material_id  = $this->request->getData('building_material_id');
            $financialyearwiseMaterialCostDetails->submit_date           = date('Y-m-d');
            $financialyearwiseMaterialCostDetails->created_date          = date('Y-m-d H:i:s');
            $financialyearwiseMaterialCostDetails->created_by            = $user->id;

            if ($this->FinancialyearwiseMaterialCostDetails->save($financialyearwiseMaterialCostDetails)) {
                $insert_id               = $financialyearwiseMaterialCostDetails->id;
                // echo "<pre>";
                // print_r($financialyearwiseMaterialCostDetails);
                // exit();
                foreach ($this->request->getData('material') as $key => $value) {
                    
				$financialyearwiseMaterialCostSubdetail                                               = $this->FinancialyearwiseMaterialCostSubdetails->newEmptyEntity();
				$financialyearwiseMaterialCostSubdetail->financialyearwise_material_cost_detail_id    = $insert_id;
				$financialyearwiseMaterialCostSubdetail->building_material_detail_id                  = $value['building_material_detail_id'];
				$financialyearwiseMaterialCostSubdetail->rate                                         = ($value['rate'] != 0)?$value['rate']:'0.00';
				$financialyearwiseMaterialCostSubdetail->amount                                       = ($value['amount'])?$value['amount']:'0.00';
				$financialyearwiseMaterialCostSubdetail->created_by                                   =  $user->id;
				$financialyearwiseMaterialCostSubdetail->created_date                                 =  date('Y-m-d:h:m:s');
				$this->FinancialyearwiseMaterialCostSubdetails->save($financialyearwiseMaterialCostSubdetail);
                }


                $this->Flash->success(__('The FinancialyearwiseMaterialCost detail has been saved.'));
                return $this->redirect(['action' => 'index']);
                $this->Flash->error(__('The FinancialyearwiseMaterialCost detail could not be saved. Please, try again.'));
            }
        }
        // print_r($financial_year);
        // exit();
        $financial_year     = $this->FinancialYears->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['FinancialYears.is_active' => 1])->toArray();
        $building_materials = $this->BuildingMaterials->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['BuildingMaterials.is_active' => 1])->toArray();

        $this->set(compact('MaterialCostDetail', 'MaterialCostsubDetail', 'financialyearwiseMaterialCostDetailscount', 'financialyearwiseMaterialCostDetails', 'financialyearwiseMaterialCostSubdetail', 'financialyearwiseMaterialCostSubdetailcount', 'financialyearwiseMaterialCostSubdetails', 'financialyearwiseMaterialCostDetails', 'financial_year', 'building_materials', 'units'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Financialyearwise Material Cost Subdetail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function edit($id = null)
    {  
        $this->viewBuilder()->setLayout('layout');
        $this->FinancialyearwiseMaterialCostDetails=$this->fetchTable('FinancialyearwiseMaterialCostDetails');
        $this->FinancialyearwiseMaterialCostSubdetails=$this->fetchTable('FinancialyearwiseMaterialCostSubdetails');
        $this->FinancialYears=$this->fetchTable('FinancialYears');
        $this->BuildingMaterials=$this->fetchTable('BuildingMaterials');
        $user = $this->request->getAttribute('identity');
		
		   $MaterialCostDetail    = $this->FinancialyearwiseMaterialCostDetails->find('all')->contain(['BuildingMaterials','FinancialYears'])->where(['FinancialyearwiseMaterialCostDetails.id'=>$id])->first();
           
		   //$material_Details       = $this->FinancialyearwiseMaterialCostSubdetails->find('all')->contain(['BuildingMaterialDetails'])->where(['FinancialyearwiseMaterialCostSubdetails.financialyearwise_material_cost_detail_id' => $id])->toArray();
	       $material_Detail_count = $this->FinancialyearwiseMaterialCostSubdetails->find('all')->where(['FinancialyearwiseMaterialCostSubdetails.financialyearwise_material_cost_detail_id' => $id])->count();

            $connection          = ConnectionManager::get('default');

            $query               =  "SELECT sub_detail.*,bsm.name as subtype,bmd.quantity as quantity,u.name_code as name_code
									 from financialyearwise_material_cost_subdetails as sub_detail 
									 LEFT JOIN building_material_details as bmd on bmd.id= sub_detail.building_material_detail_id 
									 LEFT JOIN building_submaterials as bsm on bsm.id= bmd.building_submaterial_id 
									 LEFT JOIN units as u on u.id= bmd.unit_id 
									 where sub_detail.financialyearwise_material_cost_detail_id = ".$id."";											 
											 
			  $material_Details  = $connection->execute($query)->fetchAll('assoc'); 


              $query         =  "SELECT sum(sub_detail.amount) as tot_amount
							 from financialyearwise_material_cost_subdetails as sub_detail 
							 where sub_detail.financialyearwise_material_cost_detail_id =  ".$id."";											 
											 
			  $amount        = $connection->execute($query)->fetchAll('assoc'); 
			  if($amount[0]['tot_amount'] != ''){
                $tot_amount    = $amount[0]['tot_amount'];
			  }else{
                 $tot_amount    = 0;
			  }				  
			
			//echo '<pre>'; print_r($tot_amount); exit();


          if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>'; print_r($this->request->getData()); exit();
                     
               foreach ($this->request->getData('material') as $key => $value) {
				
				if($value['id'] != ''){
					  $financialyearwiseMaterialCostSubdetail  = $this->FinancialyearwiseMaterialCostSubdetails->get($value['id'], [
						'contain' => [],]);
				 }		 
           		$financialyearwiseMaterialCostSubdetail->financialyearwise_material_cost_detail_id    = $id;
				$financialyearwiseMaterialCostSubdetail->building_material_detail_id                  = $value['building_material_detail_id'];
				$financialyearwiseMaterialCostSubdetail->rate                                         = ($value['rate'] != 0)?$value['rate']:'0.00';
				$financialyearwiseMaterialCostSubdetail->amount                                       = ($value['amount'])?$value['amount']:'0.00';
				$financialyearwiseMaterialCostSubdetail->created_by                                   =  $user->id;
				$financialyearwiseMaterialCostSubdetail->created_date                                 =  date('Y-m-d:h:m:s');
				$this->FinancialyearwiseMaterialCostSubdetails->save($financialyearwiseMaterialCostSubdetail);
                }
                $this->Flash->success(__('The FinancialyearwiseMaterialCost detail has been saved.'));
                return $this->redirect(['action' => 'index']);
                $this->Flash->error(__('The FinancialyearwiseMaterialCost detail could not be saved. Please, try again.'));
           }

        $financial_year     = $this->FinancialYears->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['FinancialYears.is_active' => 1])->toArray();
        $building_materials = $this->BuildingMaterials->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['BuildingMaterials.is_active' => 1])->toArray();

        $this->set(compact('tot_amount','material_Details','material_Detail_count','MaterialCostDetail', 'MaterialCostsubDetail', 'financialyearwiseMaterialCostDetailscount', 'financialyearwiseMaterialCostDetails', 'financialyearwiseMaterialCostSubdetail', 'financialyearwiseMaterialCostSubdetailcount', 'financialyearwiseMaterialCostSubdetails', 'financialyearwiseMaterialCostDetails', 'financial_year', 'building_materials', 'units'));
    }
   
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $financialyearwiseMaterialCostSubdetail = $this->FinancialyearwiseMaterialCostSubdetails->get($id);
        if ($this->FinancialyearwiseMaterialCostSubdetails->delete($financialyearwiseMaterialCostSubdetail)) {
            $this->Flash->success(__('The financialyearwise material cost subdetail has been deleted.'));
        } else {
            $this->Flash->error(__('The financialyearwise material cost subdetail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function ajaxfinancialcost($i = null)
    {
        $this->FinancialYears=$this->fetchTable('FinancialYears');
        $this->BuildingMaterials=$this->fetchTable('BuildingMaterials');
        $this->Units=$this->fetchTable('Units');
        $financial_year = $this->FinancialYears->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['FinancialYears.is_active' => 1])->toArray();
        $building = $this->BuildingMaterials->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['BuildingMaterials.is_active' => 1])->toArray();
        $units = $this->Units->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Units.is_active' => 1])->toArray();

        $this->set(compact('i', 'financial_year', 'building', 'units'));
    }
	
	
	
	public function ajaxloadmaterialdetails($id = null)
    {
        $this->BuildingMaterialDetails=$this->fetchTable('BuildingMaterialDetails');      

	   $material_Details     = $this->BuildingMaterialDetails->find('all')->contain(['BuildingMaterials', 'BuildingSubmaterials', 'Units', 'FinancialyearwiseMaterialCostSubdetails'])->where(['BuildingMaterialDetails.building_material_id' => $id,'BuildingMaterialDetails.is_active' => 1])->toArray();
	   $material_Detail_count = $this->BuildingMaterialDetails->find('all')->where(['BuildingMaterialDetails.building_material_id' => $id,'BuildingMaterialDetails.is_active' => 1])->count();

       // echo '<pre>'; print_r($material_Detatils); exit();
        $this->set(compact('id', 'material_Details','material_Detail_count'));
    }
	
	
	public function checkentrycount($financial_year_id = null,$building_material_id = null)  
    {
        $this->FinancialyearwiseMaterialCostDetails=$this->fetchTable('FinancialyearwiseMaterialCostDetails');      

	   $material_count = $this->FinancialyearwiseMaterialCostDetails->find('all')->where(['FinancialyearwiseMaterialCostDetails.financial_year_id' => $financial_year_id,'FinancialyearwiseMaterialCostDetails.building_material_id' => $building_material_id])->count();
	   
	   // print_r($material_count); exit();
	 

	 if($material_count > 0){
		   
		   echo 1;
	   }else{
		   echo 0;
	   }
	   
	   exit();
	   //$material_Detatilcount = $this->BuildingMaterialDetails->find('all')->where(['BuildingMaterialDetails.building_material_id' => $id,'BuildingMaterialDetails.is_active' => 1])->count();

       // echo '<pre>'; print_r($material_Detatils); exit();
       // $this->set(compact('id', 'material_Detatils','material_Detatilcount'));
    }
	
	
}