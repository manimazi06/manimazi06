<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Locator\LocatorAwareTrait;



/**
 * ProjectFundDetails Controller
 *
 * @property \App\Model\Table\ProjectFundDetailsTable $ProjectFundDetails
 * @method \App\Model\Entity\ProjectFundDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectFundDetailsController extends AppController
{
	
	public function funddetails($id = null, $work_id = null)
   {
		$this->viewBuilder()->setLayout('layout');
		$user = $this->request->getAttribute('identity');

		$this->loadModel('ProjectWorks');
		$this->loadModel('ProjectAdministrativeSanctions');
		$this->loadModel('ProjectWorkSubdetails');
		$this->loadModel('ProjectFinancialSanctions');
		$this->loadModel('ProjectTenderDetails');
		$this->loadModel('TechnicalSanctions');
		//$this->loadModel('IsAmountReceives');
		$this->loadModel('ProjectFundDetails');

		$projectWork = $this->ProjectWorks->get($id, [
		'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions'],
		]);

		$projectfundcount = $this->ProjectFundDetails->find('all')->where(['ProjectFundDetails.project_work_id' => $id, 'ProjectFundDetails.project_work_subdetail_id' => $work_id])->count();
		$projectfunds     = $this->ProjectFundDetails->find('all')->contain(['ProjectWorks'])->where(['ProjectFundDetails.project_work_id' => $id, 'ProjectFundDetails.project_work_subdetail_id' => $work_id])->toArray();

		   if ($this->request->is(['patch', 'post', 'put'])) { //echo "<pre>"; print_r($this->request->getData()); exit();

				foreach ($this->request->getData('fund') as $key => $value) {
					if ($value['id'] != '') {
						$projectFundDetail = $this->ProjectFundDetails->get($value['id'], []);
					} else {
						$projectFundDetail = $this->ProjectFundDetails->newEmptyEntity();
					}
					$projectFundDetail->project_work_id           = $id;
					$projectFundDetail->project_work_subdetail_id = $work_id;
					$projectFundDetail->request_date              = date('Y-m-d', strtotime($value['request_date']));
					$projectFundDetail->request_amount            = $value['request_amount'];
					$projectFundDetail->is_amount_received        = $value['is_amount_receive_id'];
					$projectFundDetail->received_amount           = ($value['received_amount'] != '')?$value['received_amount']:'';
					$projectFundDetail->received_date             = ($value['received_date'] != '')?date('Y-m-d', strtotime($value['received_date'])):'';
					$projectFundDetail->created_by                = $user->id;
					$projectFundDetail->created_date              = date('Y-m-d:h:m:s');
					if ($projectfundcount > 0) {	
					$projectFundDetail->modified_by               = $user->id;
					$projectFundDetail->modified_date         = date('Y-m-d:h:m:s');
					}
				  $this->ProjectFundDetails->save($projectFundDetail);
				}
				// print_r($projectFundDetail);
				// exit();
				$this->Flash->success(__('The projectFundDetail has been saved.'));
				return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectworkdetail/' . $id]);
				$this->Flash->error(__('The projectFundDetail could not be saved. Please, try again.'));
			}
    $amount_received = [1=>'Yes',2=>'No'];

    $this->set(compact('id','work_id','amount_received', 'technicalcount', 'technical', 'projectfundcount', 'projectfunds', 'projectWorkSubdetail', 'projectFundDetail', 'projectWork', 'financialSanctions', 'financialSanctionscount', 'administrativesanctioncount', 'administrativesanction',));
  }
	
	public function ajaxfunddetails($i = null)
	{
		$amount_received = [1=>'Yes',2=>'No'];
		$this->set(compact('i', 'amount_received'));
	}
	
	
	public function fundrequestlist()
    {        
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		$this->loadModel('ProjectWorks');
		$this->loadModel('FinancialYears');
		$this->loadModel('Departments');
		
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;
       $connection = ConnectionManager::get('default');    
		
		if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>'; print_r($this->request->getData()); exit();
		
		          $fin_year_cond      = ($this->request->getData('financial_year_id') != '')?" AND project.financial_year_id = ".$this->request->getData('financial_year_id')."":"";
		          $dept_cond          = ($this->request->getData('department_id') != '')?" AND project.department_id = ".$this->request->getData('department_id')."":""; 				  
		          $project_cond       = ($this->request->getData('project_code')!= '')?" AND project.project_code like '%".$this->request->getData('project_code')."%'":"";

        
                 $query               =  "SELECT project.*,fy.name as financial_year,d.name as department_name
										 from project_works as project 
										 LEFT JOIN departments as d on d.id= project.department_id 
										 LEFT JOIN financial_years as fy on fy.id= project.financial_year_id 
										 INNER JOIN project_work_subdetails as psd on psd.project_work_id = project.id
										 where project.ce_approved=1 and psd.is_approved = 1 $fin_year_cond  $dept_cond  $project_cond";											 
												 
                $projectWorks            = $connection->execute($query)->fetchAll('assoc'); 	
           
		}else{
		
				if($role_id == 1 || $role_id == 6 || $role_id == 8){	
                 // $query1     = "SELECT count(project_work_id) as pcount GROUP_CONCAT(project_work_id) as project_id from  `project_work_subdetails` WHERE is_approved = 1;";

                 // $projectWork_ids        = $connection->execute($query1)->fetchAll('assoc'); 	
				 // echo "<pre>"; print_r($projectWork_ids); exit();
				 
				 // if($projectWork_ids[0]['pcount'] > 0){
				 
				 // $projectWork_id_cond    =  " AND project.id IN [".$projectWork_ids[0]['project_id']."]";
				 // }
				 

                $query                =  "SELECT project.*,fy.name as financial_year,d.name as department_name
										 from project_works as project 
										 LEFT JOIN departments as d on d.id= project.department_id 
										 LEFT JOIN financial_years as fy on fy.id= project.financial_year_id 
										 INNER JOIN project_work_subdetails as psd on psd.project_work_id = project.id
										 where project.ce_approved=1 and psd.is_approved = 1 group by project.id";											 
												 
                $projectWorks            = $connection->execute($query)->fetchAll('assoc'); 			   
			   }
		}
		
        $departments    = $this->Departments->find('list')->all();
        $financialYears = $this->FinancialYears->find('list')->all();	
			
	
	   $this->set(compact('projectWorks','role_id','departments','financialYears'));
    }
	
	
	 public function ajaxgetworkdetails($id = null)
    {
		 $this->loadModel('ProjectWorkSubdetails');
		 $this->loadModel('Roles');
		 $projectWorkSubdetailscount  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id])->count();
		 $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id])->toArray();
                 $role   =   $this->Roles->find('list')->toArray();

        $this->set(compact('id','projectWorkSubdetails','role','projectWorkSubdetailscount'));
    }
    
}