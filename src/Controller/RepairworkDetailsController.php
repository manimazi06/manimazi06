<?php

declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;


class RepairworkDetailsController extends AppController
{	
	public function index()
    {
		$this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		$this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
		$this->ProjectWorks=$this->fetchTable('ProjectWorks');
		$this->Departments=$this->fetchTable('Departments');
		$this->FinancialYears=$this->fetchTable('FinancialYears');
		$this->Districts=$this->fetchTable('Districts');
		
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;
		
		 if($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14){
				$condition = " and psd.division_id = ".$division_id." and psd.work_type = 2";

			}else if($role_id == 5 || $role_id == 11 || $role_id == 12){
				$condition = " and psd.circle_id = ".$circle_id." and psd.work_type = 2";
				
			}else{
				$condition = " and psd.work_type = 2";
			}
	    $connection = ConnectionManager::get('default');        
		
		
		if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>'; print_r($this->request->getData()); exit();
		   
	
			  $fin_year_cond      = ($this->request->getData('financial_year_id') != '')?" AND project.financial_year_id = ".$this->request->getData('financial_year_id')."":"";
			  $dept_cond          = ($this->request->getData('department_id') != '')?" AND project.department_id = ".$this->request->getData('department_id')."":""; 				  
			  $project_cond       = ($this->request->getData('project_code')!= '')?" AND project.project_code like '%".$this->request->getData('project_code')."%'":"";
			  $dist_cond       = ($this->request->getData('district_id')!= '')?" AND psd.district_id = '".$this->request->getData('district_id')."'":"";

			  $query              =  "SELECT project.*,fy.name as financial_year,d.name as department_name
									 from project_works as project 
									 LEFT JOIN departments as d on d.id= project.department_id 
									 LEFT JOIN financial_years as fy on fy.id= project.financial_year_id 
									 LEFT JOIN project_work_subdetails as psd on psd.project_work_id = project.id
									 where project.ce_approved=0 and psd.is_active=1  $condition  $fin_year_cond  $dept_cond  $project_cond $dist_cond group by project.id";											 
											 
			  $projectWorks       = $connection->execute($query)->fetchAll('assoc'); 	
           
		}else{
			
			    $query            =  "SELECT project.*,fy.name as financial_year,d.name as department_name
										 from project_works as project 
										 LEFT JOIN departments as d on d.id= project.department_id 
										 LEFT JOIN financial_years as fy on fy.id= project.financial_year_id 
										 LEFT JOIN project_work_subdetails as psd on psd.project_work_id = project.id
										 where project.ce_approved=0 and psd.is_active=1 $condition group by project.id";											 
												 
                 $projectWorks            = $connection->execute($query)->fetchAll('assoc');  
		
		}
		
		  $departments    = $this->Departments->find('list')->all();
          $financialYears = $this->FinancialYears->find('list')->order('id Desc')->all();	
          $districts = $this->Districts->find('list')->order('name ASC')->all();	
		
		

	   $this->set(compact('districts','departments','financialYears','projectWorks','adminsanction_count','financial_count','techsanction_count','tender_count','monitoring_count','role_id','subdetail_present','estimate_uploaded'));
    }
	
    public function view($id = null)
    {
		$this->viewBuilder()->setLayout('layout');
        $repairworkDetail = $this->RepairworkDetails->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'Districts', 'Divisions', 'Circles', 'DepartmentwiseWorkTypes'],
        ]);

        $this->set(compact('repairworkDetail'));
    }

    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user  = $this->request->getAttribute('identity');
		$this->ProjectWorks=$this->fetchTable('ProjectWorks');
		$this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
		$this->DepartmentwiseWorkTypes=$this->fetchTable('DepartmentwiseWorkTypes');
		$this->Notifications=$this->fetchTable('Notifications');
		$this->Users=$this->fetchTable('Users');  
        $repairworkDetail = $this->RepairworkDetails->newEmptyEntity();
        if ($this->request->is('post')) {
			
		    $attachment  = $this->request->getData('work_file_upload');
            if ($attachment != '') {
                $name    = $attachment->getClientFilename();
                $type    = $attachment->getClientMediaType();
                $size    = $attachment->getSize();
                $tmpName = $attachment->getStream()->getMetadata('uri');
                $error   = $attachment->getError();

                if ($name != '' && $error == 0) {
                    $file                                      =  $name;
                    $array                                     =  explode('.', $file);
                    $fileExt                                   =  $array[count($array) - 1];
                    $current_time                              =  date('Y_m_d_H_i_s');
                    $newfile                                   =  "Project_" . $current_time . "." . $fileExt;
                    $tempFile                                  =  $tmpName;
                    $targetPath                                =  'uploads/ProjectWorks/';
                    $targetFile                                =  $targetPath . $newfile;
                    //$projectWork->file_upload                  =  $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            }			
            $repairworkDetail->work_name             =  $this->request->getData('work_name');
            $repairworkDetail->department_id         =  $this->request->getData('department_id');
            $repairworkDetail->financial_year_id     =  $this->request->getData('financial_year_id');
            $repairworkDetail->district_id           =  $this->request->getData('district_id');
            $repairworkDetail->division_id           =  $this->request->getData('division_id');
            $repairworkDetail->circle_id             =  $this->request->getData('project_circle_id1');
            $repairworkDetail->place_of_work         =  $this->request->getData('place_of_work');
            $repairworkDetail->estimated_cost        =  $this->request->getData('estimated_cost');
          //  $repairworkDetail->ref_no                =  $this->request->getData('ref_no');
            $repairworkDetail->departmentwise_work_type_id   =  $this->request->getData('departmentwise_work_type_id');
			$repairworkDetail->work_file_upload        = $newfile;
            $repairworkDetail->created_by              =  $user->id;
            $repairworkDetail->created_date            =  date('Y-m-d:h:m:s');         
            if ($this->RepairworkDetails->save($repairworkDetail)) {				
		
			$projectWork = $this->ProjectWorks->newEmptyEntity();			
            $projectWork->department_id      	    =  $this->request->getData('department_id');
            $projectWork->financial_year_id   		=  $this->request->getData('financial_year_id');
            $projectWork->building_type_id          =  0;
            $projectWork->project_status_id         =  1;
            $projectWork->project_name              =  $this->request->getData('work_name');
            $projectWork->project_description       =  null;
            $projectWork->project_amount            =  $this->request->getData('estimated_cost');
            $projectWork->scheme_type_id            =  0;
            $projectWork->coastal_area        		   =  0;
            $projectWork->departmentwise_work_type_id  =  $this->request->getData('departmentwise_work_type_id');
            $projectWork->ref_no               =  $this->request->getData('ref_no');
			$projectWork->file_upload                  = $newfile;
            $projectWork->created_by          =  $user->id;
            $projectWork->created_date        =  date('Y-m-d H:i:s'); 
             //echo "<pre>";  print_r($projectWork);  exit();	    		
			if ($this->ProjectWorks->save($projectWork)) {
			    $insertid     = $projectWork->id;

                $recipient_user = $this->Users->find('all')->where(['Users.role_id'=>6,'Users.is_active'=>1])->first();
				$recipient_user_id = $recipient_user['id'];
                $notification = $this->Notifications->newEmptyEntity();					
				$notification->forwarded_date                    = date('Y-m-d');
				$notification->forward_user_id                   = $user->id;
				$notification->recipient_user_id                 = $recipient_user_id; 
				$notification->notification_type_id              = 2; 
				$notification->project_work_id                   = $insertid;
				$notification->work_type                         = 2;
				$notification->created_by                        = $user->id;
				$notification->created_date                      = date('Y-m-d H:i:s');
				$this->Notifications->save($notification);				
 
				
			    $depid        =  $this->request->getData('department_id');
                $yearname     =  $this->request->getData('financial_year_id');
                $this->Departments=$this->fetchTable('Departments');
                $this->FinancialYears=$this->fetchTable('FinancialYears');
                $this->Districts=$this->fetchTable('Districts');
                $dep                       = $this->Departments->find('all')->where(['Departments.id' => $depid])->first();
                $profinancial              = $this->FinancialYears->find('all')->where(['FinancialYears.id' => $yearname])->first();
                $fyear                     = substr($profinancial['name'], -2);
                $depcode                   = strtoupper(substr($dep['name'], 0, 3));
                $var                       = sprintf('%03d', $insertid);
               
				$projectcode               =  'R'.$fyear.$depcode.$var;				 
				$ProjectWorksTable      = $this->getTableLocator()->get('ProjectWorks');
				$project                = $ProjectWorksTable->get($insertid); 
				$project->project_code  = $projectcode;
				$ProjectWorksTable->save($project);		
					
				$projectWorkSubdetail = $this->ProjectWorkSubdetails->newEmptyEntity();					
				$projectWorkSubdetail->project_work_id         =  $insertid;
				$projectWorkSubdetail->work_code               =  $projectcode;
				$projectWorkSubdetail->work_name               =  $this->request->getData('work_name');
				$projectWorkSubdetail->place_name              =  $this->request->getData('place_of_work');
				$projectWorkSubdetail->district_id             =  $this->request->getData('district_id');
				$projectWorkSubdetail->division_id             =  $this->request->getData('division_id');
				$projectWorkSubdetail->circle_id               =  $this->request->getData('project_circle_id1');
				$projectWorkSubdetail->rough_cost              =  $this->request->getData('estimated_cost');
				$projectWorkSubdetail->work_type               =  2;
				$projectWorkSubdetail->project_work_status_id  =  1;
				$projectWorkSubdetail->submit_date             =  date('Y-m-d');
				$projectWorkSubdetail->created_by              =  $user->id;
				$projectWorkSubdetail->created_date            =  date('Y-m-d:h:m:s');		  
				if($this->ProjectWorkSubdetails->save($projectWorkSubdetail)){
				
				}
			  }					
			
                $this->Flash->success(__('The repairwork detail has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The repairwork detail could not be saved. Please, try again.'));
        }
        $departments = $this->RepairworkDetails->Departments->find('list', ['limit' => 200])->all();
        $financialYears = $this->RepairworkDetails->FinancialYears->find('list', ['limit' => 200])->all();
        $districts = $this->RepairworkDetails->Districts->find('list', ['limit' => 200])->all();
        $divisions = $this->RepairworkDetails->Divisions->find('list', ['limit' => 200])->all();
        $circles = $this->RepairworkDetails->Circles->find('list', ['limit' => 200])->all();
        $departmentwiseWorkTypes = $this->RepairworkDetails->DepartmentwiseWorkTypes->find('list', ['limit' => 200])->all();
        $this->set(compact('repairworkDetail', 'departments', 'financialYears', 'districts', 'divisions', 'circles', 'departmentwiseWorkTypes'));
    }
	
	public function edit($id = null)
    {  
	 $this->viewBuilder()->setLayout('layout');
		$this->ProjectWorks=$this->fetchTable('ProjectWorks');
		$this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');

		$user        = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$projectWork = $this->ProjectWorks->get($id, [
			'contain' => [],
		]);
		   $projectsubdetail = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id'=>$id])->first();

		if ($this->request->is(['patch', 'post', 'put'])) { //echo "<pre>"; print_r($this->request->getData()); exit();
			 $attachment  = $this->request->getData('file_upload');
			if ($attachment->getClientFilename() != '') {

				$name    = $attachment->getClientFilename();
				$type    = $attachment->getClientMediaType();
				$size    = $attachment->getSize();
				$tmpName = $attachment->getStream()->getMetadata('uri');
				$error   = $attachment->getError();

				if ($name != '' && $error == 0) {
					$file                                      = $name;
					$array                                     = explode('.', $file);
					$fileExt                                   = $array[count($array) - 1];
					$current_time                              = date('Y_m_d_H_i_s');
					$newfile                                   = "Project_" . $current_time . "." . $fileExt;
					$tempFile                                  = $tmpName;
					$targetPath                                = 'uploads/ProjectWorks/';
					$targetFile                                = $targetPath . $newfile;
					$projectWork->file_upload                  = $newfile;
				 
					move_uploaded_file($tempFile, $targetFile);
				}
			}else{
					$projectWork->file_upload        = $this->request->getData('file_upload1');
				}
			$projectWork->department_id      	    =  $this->request->getData('department_id');
            $projectWork->financial_year_id   		=  $this->request->getData('financial_year_id');
            $projectWork->building_type_id          =  0;
            $projectWork->project_status_id         =  1;
            $projectWork->project_name              =  $this->request->getData('work_name');
            $projectWork->project_description       =  null;
            $projectWork->project_amount            =  $this->request->getData('estimated_cost');
            $projectWork->scheme_type_id            =  0;
            $projectWork->coastal_area        		   =  0;
            $projectWork->departmentwise_work_type_id  =  $this->request->getData('departmentwise_work_type_id');
            $projectWork->ref_no  =  $this->request->getData('ref_no');
			//$projectWork->file_upload                  = $newfile;
            $projectWork->modified_by          =  $user->id;
            $projectWork->modified_date        =  date('Y-m-d H:i:s'); 
             //echo "<pre>";  print_r($projectWork);  exit();	    		
			if ($this->ProjectWorks->save($projectWork)) {
			    //$insertid     = $projectWork->id;		
					
				  if ($projectsubdetail['id'] != '') {
						$projectWorkSubdetail = $this->ProjectWorkSubdetails->get($projectsubdetail['id'], [
							'contain' => [],
						]);
						$projectWorkSubdetail->modified_by          = $user->id;
						$projectWorkSubdetail->modified_date        = date('Y-m-d:h:m:s');	
					}			
				$projectWorkSubdetail->project_work_id         =  $id;
				$projectWorkSubdetail->work_name               =  $this->request->getData('work_name');
				$projectWorkSubdetail->place_name              =  $this->request->getData('place_of_work');
				$projectWorkSubdetail->district_id             =  $this->request->getData('district_id');
				$projectWorkSubdetail->division_id             =  $this->request->getData('project_division_id1');
				$projectWorkSubdetail->circle_id               =  $this->request->getData('project_circle_id1');
				$projectWorkSubdetail->rough_cost              =  $this->request->getData('estimated_cost');
				$projectWorkSubdetail->work_type               =  2;
				$projectWorkSubdetail->project_work_status_id  =  1;						  
				if($this->ProjectWorkSubdetails->save($projectWorkSubdetail)){
					$this->Flash->success(__('The repairwork detail has been saved.'));
                    return $this->redirect(['action' => 'index']);
				
				}
			}				
		 }
       $departments = $this->RepairworkDetails->Departments->find('list', ['limit' => 200])->all();
        $financialYears = $this->RepairworkDetails->FinancialYears->find('list', ['limit' => 200])->all();
        $districts = $this->RepairworkDetails->Districts->find('list', ['limit' => 200])->all();
        $divisions = $this->RepairworkDetails->Divisions->find('list', ['limit' => 200])->all();
        $circles = $this->RepairworkDetails->Circles->find('list', ['limit' => 200])->all();
        $departmentwiseWorkTypes = $this->RepairworkDetails->DepartmentwiseWorkTypes->find('list', ['limit' => 200])->all();
        $this->set(compact('repairworkDetail', 'departments', 'financialYears', 'districts', 'divisions', 'circles', 'departmentwiseWorkTypes','projectWork','projectsubdetail'));		 
	}

    public function deleterepairwork($id = null)
    {
       $this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
	   $projectsubdetail = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id'=>$id])->first();
	   
		$userTable          = $this->getTableLocator()->get('ProjectWorkSubdetails');
		$user                = $userTable->get($projectsubdetail['id']); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			$this->Flash->success(__('The repairwork detail has been Deleted.'));

			 return $this->redirect(['action' => 'index']);
        } else {
			 return $this->redirect(['action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }	
}