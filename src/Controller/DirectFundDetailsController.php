<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;


class DirectFundDetailsController extends AppController
{
   
    public function index()
    {

        $this->viewBuilder()->setLayout('layout');
        //$directFundDetails = $this->paginate($this->DirectFundDetails);
      //  $directFundDetails  = $this->DirectFundDetails->find('all')->toArray();
        // echo '<pre>';
        // print_r($directFundDetails);
		$connection  = ConnectionManager::get('default');			

		 $sql       = "SELECT 
						project.work_name as work_name,
						d.id as id,
						d.fund_received_date as fund_received_date,
						d.cheque_no as cheque_no,
						d.amount as amount,
						dv.name as division_name
						FROM direct_fund_details as d
						LEFT JOIN project_work_subdetails as project on project.id=d.project_work_subdetail_id	
						LEFT JOIN divisions as dv on dv.id = project.division_id
						order by dv.id,d.id ASC
						";								

      	   $directFundDetails   = $connection->execute($sql)->fetchAll('assoc');	
        // exit();


        $this->set(compact('directFundDetails'));
    }

   
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $directFundDetail = $this->DirectFundDetails->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('directFundDetail'));
    }

   
    public function add()
    {

        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $directFundDetail = $this->DirectFundDetails->newEmptyEntity();
        if ($this->request->is('post')) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();
           // $directFundDetail = $this->DirectFundDetails->patchEntity($directFundDetail, $this->request->getData());

           $directFundDetail->fund_received_date    = date('Y-m-d',strtotime($this->request->getData('fund_received_date')));
           $directFundDetail->project_work_subdetail_id         = $this->request->getData('project_work_subdetail_id');
           $directFundDetail->amount         = $this->request->getData('amount');
           $directFundDetail->cheque_no         = $this->request->getData('cheque_no');
          $directFundDetail->created_by          = $user->id;
           $directFundDetail->created_date        =date('Y-m-d H:i:s');
        //    echo '<pre>';
        //    print_r($directFundDetail);
        //    exit();
            if ($this->DirectFundDetails->save($directFundDetail)) {
                $this->Flash->success(__('The direct fund detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The direct fund detail could not be saved. Please, try again.'));
        }
			$connection  = ConnectionManager::get('default');			

	    	$sql         = "SELECT 
							ps.id as project_id,
							ps.work_name as work_name
							FROM project_work_subdetails as ps
							LEFT JOIN project_works as project on project.id=ps.project_work_id	
							LEFT JOIN project_administrative_sanctions as san on san.project_work_id = ps.project_work_id
							WHERE ps.is_active = 1 and san.fund_source_id =2
							order by ps.work_name ASC,ps.work_type
							";								

      	   $projects   = $connection->execute($sql)->fetchAll('assoc');		
		
		$project_list = array();
		foreach($projects as $project){
		   $project_list[$project['project_id']] = 	$project['work_name']; 
			
		}
		
		
        $this->set(compact('directFundDetail','project_list'));
    }

  
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $directFundDetail = $this->DirectFundDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $directFundDetail = $this->DirectFundDetails->patchEntity($directFundDetail, $this->request->getData());

            $directFundDetail->fund_received_date    = date('Y-m-d',strtotime($this->request->getData('fund_received_date')));
            $directFundDetail->amount         = $this->request->getData('amount');
            $directFundDetail->cheque_no         = $this->request->getData('cheque_no');
			$directFundDetail->project_work_subdetail_id         = $this->request->getData('project_work_subdetail_id');

          $directFundDetail->modified_by          = $user->id;
            $directFundDetail->modified_date        =date('Y-m-d H:i:s');
            if ($this->DirectFundDetails->save($directFundDetail)) {
                $this->Flash->success(__('The direct fund detail has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The direct fund detail could not be updated. Please, try again.'));
        }
					$connection  = ConnectionManager::get('default');			

			$sql         = "SELECT 
			             
							ps.id as project_id,
							ps.work_name as work_name
							FROM project_work_subdetails as ps
							LEFT JOIN project_works as project on project.id=ps.project_work_id							
							WHERE ps.is_active = 1 and project.department_id =5
							order by ps.work_name ASC
							";								

      	   $projects   = $connection->execute($sql)->fetchAll('assoc');		
		
		$project_list = array();
		foreach($projects as $project){
		   $project_list[$project['project_id']] = 	$project['work_name']; 
			
		}
        $this->set(compact('directFundDetail','project_list'));
    }

    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $directFundDetail = $this->DirectFundDetails->get($id);
        if ($this->DirectFundDetails->delete($directFundDetail)) {
            $this->Flash->success(__('The direct fund detail has been deleted.'));
        } else {
            $this->Flash->error(__('The direct fund detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
