<?php

declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Locator\LocatorAwareTrait;

class ProjectWorksController extends AppController
{   
   public function dashboard()
	{
	$this->viewBuilder()->setLayout('layout');
	$this->loadModel('Departments');
	$this->loadModel('Divisions');
	$this->loadModel('FinancialYears');
	$this->loadModel('Notifications');
	$user = $this->request->getAttribute('identity');
	$role_id = $user->role_id;
	$division_id = $user->division_id;
	$circle_id = $user->circle_id;
	$user_id = $user->id;	
	// print_r($role_id); exit();
	$notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user_id,'Notifications.process_done'=>0])->count(); 
    
	if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
	$condition = " and project.division_id = " . $division_id . "";
	} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
	$condition = " and project.circle_id = " . $circle_id . "";
	} else {
	$condition = "";
	}

	$connection = ConnectionManager::get('default');
	$query = "SELECT count(project.id) AS proposed
	from project_work_subdetails as project
	where project.is_active=1 and project.project_work_status_id>=1 $condition";

			// print_r($query);
			// exit();
			$projectProposedCount      = $connection->execute($query)->fetchAll('assoc');

			$query1                 =  "SELECT count(project.id) AS approved
										from project_work_subdetails as project 
										 where  project.is_active=1 and project.project_work_status_id>=2 $condition";

			// echo "<pre>";
			// print_r($query1);
			// exit();
			$projectApprovedCount         = $connection->execute($query1)->fetchAll('assoc');

			$query2                =  "SELECT 
								   count(project.id)AS sanctioned
									from project_work_subdetails as project 
								   where project.is_active=1 and project.project_work_status_id>=5 $condition";
			// echo "<pre>";
			// print_r($query2);
			// exit();
			$projectSanctionedcount    = $connection->execute($query2)->fetchAll('assoc');

			$query3                =  "SELECT 
									count(project.id)AS progress
									from project_work_subdetails as project 
								   where project.is_active=1 and project.project_work_status_id >=12 $condition";
			// echo "<pre>";
			// print_r($query3);
			// exit();
			$projectProgresscount    = $connection->execute($query3)->fetchAll('assoc');

			$query4                =  "SELECT 
										count(project.id)AS completed
									from project_work_subdetails as project 
								   where project.is_active=1 and project.project_work_status_id=19 $condition";
			$projectCompletedcount    = $connection->execute($query4)->fetchAll('assoc');

			$financialYears = $this->FinancialYears->find('list')->order('id ASC')->toArray();
			//echo "<pre>"; print_r($financialYears); exit();  	
			$yearwise_detail = array();
			foreach ($financialYears as $key => $year) {
				$query_yearwise = "select d.name as depart_name,sum(as_sac.sanctioned_amount) as sanctioned_amount
					from project_administrative_sanctions as as_sac
					LEFT join project_works as p on p.id = as_sac.project_work_id 
					LEFT join project_work_subdetails as project on project.project_work_id = p.id
					RIGHT JOIN departments as d on d.id = p.department_id
					LEFT JOIN financial_years as fs on fs.id = p.financial_year_id
					where fs.id = " . $key . " $condition
					GROUP by fs.name,d.name
					order by sanctioned_amount DESC";

				$departwise_yearwise_details    = $connection->execute($query_yearwise)->fetchAll('assoc');
				foreach ($departwise_yearwise_details as $key1 => $dept) {
					$yearwise_detail[$key][$key1]["depart"]              = $dept['depart_name'];
					$yearwise_detail[$key][$key1]["sanctioned_amount"]   = ($dept['sanctioned_amount']) ? $dept['sanctioned_amount'] / 100000 : 0;
				}
			}

			$query_as = "select d.name as depart_name,sum(as_sac.sanctioned_amount) as sanctioned_amount
					from departments as d
					LEFT join project_works as p on p.department_id = d.id 
					LEFT join project_work_subdetails as project on project.project_work_id = p.id
					LEFT JOIN project_administrative_sanctions as as_sac on as_sac.project_work_id = p.id
					where 1 $condition
					GROUP by d.name";

			$departwise_as_details    = $connection->execute($query_as)->fetchAll('assoc');

			$departmentsname    = $this->Departments->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Departments.is_active' => 1])->toArray();
			$department_details = array();

			foreach ($departmentsname as $key => $value) {

				$query = "Select count(project.id) as projectcount,
				sum(CASE WHEN project.project_work_status_id>=1  THEN 1 ELSE '0' END)AS proposed,
				sum(CASE WHEN project.project_work_status_id>=2  THEN 1 ELSE '0' END)AS approved,
				sum(CASE WHEN project.project_work_status_id>=5 THEN 1 ELSE '0' END)AS sanctioned,
				sum(CASE WHEN project.project_work_status_id>=12 THEN 1 ELSE '0' END)AS progress,
				sum(CASE WHEN project.project_work_status_id=19 THEN 1 ELSE '0' END)AS completed

					  from project_work_subdetails as project
					  LEFT JOIN project_works as projectwork on  projectwork.id = project.project_work_id
					  where project.is_active=1  and projectwork.department_id =$key $condition ";
				// echo "<pre>";
				// print_r($query);
				// exit();
				$Totalcount      = $connection->execute($query)->fetchAll('assoc');
				$department_details[$key]['department_name'] = $value;
				$department_details[$key]['projectcount']    = $Totalcount[0]['projectcount'];
				$department_details[$key]['proposed']        = ($Totalcount[0]['proposed'] != '') ? $Totalcount[0]['proposed'] : 0;
				$department_details[$key]['approved']      = ($Totalcount[0]['approved'] != '') ? $Totalcount[0]['approved'] : 0;
				$department_details[$key]['sanctioned']    = ($Totalcount[0]['sanctioned'] != '') ? $Totalcount[0]['sanctioned'] : 0;
				$department_details[$key]['progress']       = ($Totalcount[0]['progress'] != '') ? $Totalcount[0]['progress'] : 0;
				$department_details[$key]['completed']       = ($Totalcount[0]['completed'] != '') ? $Totalcount[0]['completed'] : 0;
			}
			
			
			if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
			$divisions         = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1,'Divisions.id'=>$division_id])->toArray();

			} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
			$divisions         = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1,'Divisions.circle_id'=>$circle_id])->toArray();

			} else {
			$divisions         = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
			}

			$divisions_details = array();
			foreach ($divisions as $key1 => $divistionvalue) {


				$query = "Select count(project.id) as projectcount,
				sum(CASE WHEN project.project_work_status_id>=1  THEN 1 ELSE '0' END)AS proposed,
				sum(CASE WHEN project.project_work_status_id>=2  THEN 1 ELSE '0' END)AS approved,
				sum(CASE WHEN project.project_work_status_id>=5 THEN 1 ELSE '0' END)AS sanctioned,
				sum(CASE WHEN project.project_work_status_id>=12 THEN 1 ELSE '0' END)AS progress,
				sum(CASE WHEN project.project_work_status_id=19 THEN 1 ELSE '0' END)AS completed
				from project_work_subdetails as project
				where project.is_active=1  and project.division_id=$key1 $condition";

				$Totalcount      = $connection->execute($query)->fetchAll('assoc');

				$divisions_details[$key1]['division_name']  = $divistionvalue;
				$divisions_details[$key1]['projectcount']    = $Totalcount[0]['projectcount'];
				$divisions_details[$key1]['proposed']    = $Totalcount[0]['proposed'];
				$divisions_details[$key1]['approved']    = $Totalcount[0]['approved'];
				$divisions_details[$key1]['sanctioned']    = $Totalcount[0]['sanctioned'];
				$divisions_details[$key1]['progress']    = $Totalcount[0]['progress'];
				$divisions_details[$key1]['completed']    = $Totalcount[0]['completed'];


			}

		$this->set(compact('notification_count','yearwise_detail', 'financialYears', 'departwise_as_details', 'progressCount', 'Totalcompletecount', 'TotalProjectCount', 'department_details', 'divisions_details', 'role_id', 'division_id', 'projectProposedCount', 'projectApprovedCount', 'projectSanctionedcount', 'projectProgresscount', 'projectCompletedcount'));
	}
	public function notificationlist(){
		$this->viewBuilder()->setLayout('layout');
		$user = $this->request->getAttribute('identity');
		$role_id = $user->role_id;
		$division_id = $user->division_id;
		$circle_id = $user->circle_id;
		$user_id = $user->id;

	    $this->loadModel('Notifications');
	    $this->loadModel('Users');
		$notification_list = $this->Notifications->find('all')->contain(['NotificationTypes','ProjectWorks','ProjectWorkSubdetails'])->where(['Notifications.recipient_user_id' => $user_id,'Notifications.process_done'=>0])->toArray();
         //echo "<pre>"; print_r($notification_list); exit();		
		$user = $this->Users->find('list')->toArray();
		$this->set(compact('notification_list','user'));			
	}   
		
	public function ajaxprojectwise($val = NULL)
    {
        $user = $this->request->getAttribute('identity');
        $role_id     = $user->role_id;
        $division_id = $user->division_id;
        $circle_id   = $user->circle_id;

        if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14  || $role_id == 15) {
            $rolecondition = " and work_subdetails.division_id = " . $division_id . "";
        } else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
            $rolecondition = " and work_subdetails.circle_id = " . $circle_id . "";
        } else {
            $rolecondition = "";
        }

        $connection        = ConnectionManager::get('default');
        // echo"<pre>";print_r($emp_desgn);exit();
        if ($val == 1) {
            $Cond = " AND  work_subdetails.project_work_status_id>=1";
        } elseif ($val == 2) {
            $Cond = " AND  work_subdetails.project_work_status_id>=2";
        } elseif ($val == 3) {
            $Cond = " AND  work_subdetails.project_work_status_id>=5";
        } elseif ($val == 4) {
            $Cond = " AND   work_subdetails.project_work_status_id>=12";
        } elseif ($val == 5) {
            $Cond = " AND  work_subdetails.project_work_status_id=19";
        }

        $sql = "SELECT  department.name as dname,
                    financial_year.name as financial_yeartname,
                    building_type.name as building_typename,
                    division.name as division_name,
                    project_work_statuse.name as pws,
                    work_subdetails.work_name as work_name,
                    work_subdetails.sanctioned_amount as amount,
                    work_subdetails.work_code as work_code 
                    FROM project_work_subdetails as work_subdetails
                    LEFT JOIN project_works as project_work on project_work.id = work_subdetails.project_work_id
                    LEFT JOIN departments as department on department.id = project_work.department_id
                    LEFT JOIN financial_years as  financial_year on financial_year.id = project_work.financial_year_id
                    LEFT JOIN building_types as building_type on building_type.id = project_work.building_type_id
                    LEFT JOIN divisions as division on division.id = work_subdetails.division_id
                    LEFT JOIN project_work_statuses as project_work_statuse on project_work_statuse.id = work_subdetails.project_work_status_id
                    where work_subdetails.is_active=1 $Cond $rolecondition";

        $projectdetails      = $connection->execute($sql)->fetchAll('assoc');
        // echo '<pre>';
        // print_r($sql);
        // exit();
        $this->set(compact('projectdetails'));
    }
	public function index()
    {
		$this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		$this->loadModel('ProjectWorkSubdetails');
		$this->loadModel('ProjectWorks');
		$this->loadModel('Departments');
		$this->loadModel('FinancialYears');
		$this->loadModel('Districts');
		
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;
		
		 if($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14){
				$condition = " and psd.division_id = ".$division_id." and psd.work_type = 1";

			}else if($role_id == 5 || $role_id == 11 || $role_id == 12){
				$condition = " and psd.circle_id = ".$circle_id." and psd.work_type = 1";
				
			}else{
				$condition = " and psd.work_type = 1";
			}
			
	    $connection = ConnectionManager::get('default');    
		
		if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>'; print_r($this->request->getData()); exit();		   
	
			  $fin_year_cond      = ($this->request->getData('financial_year_id') != '')?" AND project.financial_year_id = ".$this->request->getData('financial_year_id')."":"";
			  $dept_cond          = ($this->request->getData('department_id') != '')?" AND project.department_id = ".$this->request->getData('department_id')."":""; 				  
			  $project_cond       = ($this->request->getData('project_code')!= '')?" AND project.project_code like '%".$this->request->getData('project_code')."%'":"";
			  $dist_cond          = ($this->request->getData('district_id')!= '')?" AND psd.district_id = '".$this->request->getData('district_id')."'":"";

	
			  $query              =  "SELECT project.*,fy.name as financial_year,d.name as department_name
									 from project_works as project 
									 LEFT JOIN departments as d on d.id= project.department_id 
									 LEFT JOIN financial_years as fy on fy.id= project.financial_year_id 
									 LEFT JOIN project_work_subdetails as psd on psd.project_work_id = project.id
									 where project.ce_approved=0 and psd.old_project_work_detail_id is NULL $condition  $fin_year_cond  $dept_cond  $project_cond $dist_cond group by project.id";											 
											 
			  $projectWorks       = $connection->execute($query)->fetchAll('assoc'); 	
           
		}else{		
		  
				    $query        =  "SELECT project.*,fy.name as financial_year,d.name as department_name
										 from project_works as project 
										 LEFT JOIN departments as d on d.id= project.department_id 
										 LEFT JOIN financial_years as fy on fy.id= project.financial_year_id 
										 LEFT JOIN project_work_subdetails as psd on psd.project_work_id = project.id
										 where project.ce_approved=0 and psd.old_project_work_detail_id is NULL $condition group by project.id";	 										 
												 
                $projectWorks     = $connection->execute($query)->fetchAll('assoc');  
		
		}
		
		  $departments    = $this->Departments->find('list')->where(['Departments.is_active'=>1])->all();
          $financialYears = $this->FinancialYears->find('list')->where(['FinancialYears.is_active'=>1])->order('id Desc')->all();	
          $districts      = $this->Districts->find('list')->where(['Districts.is_active'=>1])->order('name ASC')->all();	

	   $this->set(compact('districts','departments','financialYears','projectWorks','adminsanction_count','financial_count','techsanction_count','tender_count','monitoring_count','role_id','subdetail_present','estimate_uploaded'));
    }
	public function approvedlist()
    {        
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		$this->loadModel('ProjectWorkSubdetails');
		$this->loadModel('ProjectWorks');
		$this->loadModel('Departments');
		$this->loadModel('FinancialYears');
		$this->loadModel('Districts');
		$this->loadModel('ProjectWorkStatuses');
		
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;
		
		if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
		$condition = " and psd.division_id = " . $division_id . "";
		} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
		$condition = " and psd.circle_id = " . $circle_id . "";
		} else {
		$condition = "";
		}
		//print_r($condition); exit();
			

	    $connection = ConnectionManager::get('default');   
	
		if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>'; print_r($this->request->getData()); exit();
		   
	
			  $fin_year_cond      = ($this->request->getData('financial_year_id') != '')?" AND project.financial_year_id = ".$this->request->getData('financial_year_id')."":"";
			  $dept_cond          = ($this->request->getData('department_id') != '')?" AND project.department_id = ".$this->request->getData('department_id')."":""; 				  
			  $project_cond       = ($this->request->getData('project_code')!= '')?" AND project.project_code like '%".$this->request->getData('project_code')."%'":"";
			  $dist_cond          = ($this->request->getData('district_id')!= '')?" AND psd.district_id = '".$this->request->getData('district_id')."'":"";
			  $status_cond          = ($this->request->getData('status_id')!= '')?" AND psd.project_work_status_id >= '".$this->request->getData('status_id')."'":"";

	
			  $query              =  "SELECT project.*,fy.name as financial_year,d.name as department_name,dwt.name as work_type
									 from project_works as project 
									 LEFT JOIN departments as d on d.id= project.department_id 
									 LEFT JOIN financial_years as fy on fy.id= project.financial_year_id 
									 LEFT JOIN project_work_subdetails as psd on psd.project_work_id = project.id
								     LEFT JOIN project_administrative_sanctions as adminsanction on adminsanction.project_work_id = project.id

									 LEFT JOIN 	departmentwise_work_types as dwt on project.departmentwise_work_type_id = dwt.id
									 where project.ce_approved=1 $condition  $fin_year_cond  $dept_cond  $project_cond $dist_cond  $status_cond group by project.id";											 
											 
			  $projectWorks       = $connection->execute($query)->fetchAll('assoc'); 

  // print_r($query);	 exit();		  
           
		}else{				  
				    $query            =  "SELECT project.*,fy.name as financial_year,d.name as department_name,dwt.name as work_type
										 from project_works as project 
										 LEFT JOIN departments as d on d.id= project.department_id 
										 LEFT JOIN financial_years as fy on fy.id= project.financial_year_id 
										 LEFT JOIN project_work_subdetails as psd on psd.project_work_id = project.id
										 LEFT JOIN project_administrative_sanctions as adminsanction on adminsanction.project_work_id = project.id
									     LEFT JOIN 	departmentwise_work_types as dwt on project.departmentwise_work_type_id = dwt.id

										 where project.ce_approved=1 $condition  group by project.id";									 
												 
                 $projectWorks            = $connection->execute($query)->fetchAll('assoc'); 	  
		
		}
		
		  $departments    = $this->Departments->find('list')->all();  
          $financialYears = $this->FinancialYears->find('list')->order('id Desc')->all();	
          $districts = $this->Districts->find('list')->all();		
          $work_statuses = $this->ProjectWorkStatuses->find('list')->all();		

	   $this->set(compact('work_statuses','districts','departments','financialYears','projectWorks','adminsanction_count','financial_count','techsanction_count','tender_count','monitoring_count','role_id','subdetail_present','estimate_uploaded'));
    }
    public function view($id = null)
    {
        //$id = base64_decode($id);
        $this->viewBuilder()->setLayout('layout');
		$this->loadModel('ProjectAdministrativeSanctions');
		$this->loadModel('ProjectMonitoringDetails');
		$this->loadModel('ProjectFinancialSanctions');
		$this->loadModel('TechnicalSanctions');
		$this->loadModel('ProjectTenderDetails');
		$this->loadModel('ProjectWorkSubdetails');		
		
	   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id])->first();
       if($projectWorkSubdetails['work_type'] == 1){
        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes','DepartmentwiseWorkTypes'],
        ]);		
	   }else{
		 $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'ProjectStatuses', 'Districts', 'Divisions','DepartmentwiseWorkTypes'],
        ]);
	   }	
		
		// echo '<pre>';  print_r($projectWork);   exit();
		
		 $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
		 //$administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->first();
		 	   $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks','FundSources','SupervisionCharges'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();

		 $projectWorkSubdetailscount  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.is_active'=>1])->count();
		 $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses'])->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.is_active'=>1])->toArray();
		
//echo '<pre>';  print_r($projectWorkSubdetails);   exit();

		 $financialsanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
		 $financialsanctionscount     = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
		 $technicalSanctions          = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
		 $technicalSanctionscount     = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
		 $projectTenderDetails        = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id,'ProjectTenderDetails.is_active'=>1])->toArray();
		 $projectTenderDetailscount   = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id,'ProjectTenderDetails.is_active'=>1])->count();
         $monitoringDetails           = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks','WorkStages'])->where(['project_work_id' => $id])->toArray();
         $monitoringDetailscount      = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks','WorkStages'])->where(['project_work_id' => $id])->count();

	   $this->set(compact('projectWork','administrativesanction','financialsanctions','monitoringDetails','technicalSanctions','projectTenderDetails','administrativesanctioncount','financialsanctionscount','technicalSanctionscount','projectTenderDetailscount','monitoringDetailscount','projectWorkSubdetails','id','projectWorkSubdetailscount'));
    }
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$this->loadModel('ProjectWorkSubdetails');
		$this->loadModel('DepartmentwiseWorkTypes');
		$this->loadModel('Users');
		$this->loadModel('Notifications');
        
        $projectWork = $this->ProjectWorks->newEmptyEntity();
        if ($this->request->is('post')) {  //echo '<pre>'; print_r($this->request->getData());   exit();   

            $attachment  = $this->request->getData('file_upload');

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
                    $current_time                              =  date('Y_m_d');
                    $newfile                                   =  "Project_" . $current_time . "." . $fileExt;
                    $tempFile                                  =  $tmpName;
                    $targetPath                                =  'uploads/ProjectWorks/';
                    $targetFile                                =  $targetPath . $newfile;
                    $projectWork->file_upload                  =  $newfile;                   

                    move_uploaded_file($tempFile, $targetFile);
                }
            }   
			
            $projectWork->department_id       =  $this->request->getData('department_id');
            $projectWork->financial_year_id   =  $this->request->getData('financial_year_id');
            $projectWork->building_type_id    =  $this->request->getData('building_type_id');
            $projectWork->project_status_id   =  1;
            $projectWork->project_name        =  $this->request->getData('project_name');
            $projectWork->project_description =  $this->request->getData('project_description');
            $projectWork->project_amount      =  $this->request->getData('project_amount');
            $projectWork->scheme_type_id      =  $this->request->getData('scheme_type_id');
            $projectWork->coastal_area        =  $this->request->getData('coastal_area');
            $projectWork->departmentwise_work_type_id        =  $this->request->getData('departmentwise_work_type_id');
            $projectWork->created_by          =  $user->id;
            $projectWork->created_date        =  date('Y-m-d H:i:s');
           
			if($this->ProjectWorks->save($projectWork)) {
			    $insertid     = $projectWork->id;
				
				$recipient_user = $this->Users->find('all')->where(['Users.role_id'=>6,'Users.is_active'=>1])->first();
				$recipient_user_id = $recipient_user['id'];
                $notification = $this->Notifications->newEmptyEntity();					
				$notification->forwarded_date                    = date('Y-m-d');
				$notification->forward_user_id                   = $user->id;
				$notification->recipient_user_id                 = $recipient_user_id; 
				$notification->notification_type_id              = 2; 
				$notification->project_work_id                   = $insertid;
				$notification->created_by                        = $user->id;
				$notification->created_date                      = date('Y-m-d H:i:s');
				$this->Notifications->save($notification);
				
			    $depid        =  $this->request->getData('department_id');
                $yearname     =  $this->request->getData('financial_year_id');
                $this->loadModel('Departments');
                $this->loadModel('FinancialYears');
                $this->loadModel('Districts');
                $dep                       = $this->Departments->find('all')->where(['Departments.id' => $depid])->first();
                $profinancial              = $this->FinancialYears->find('all')->where(['FinancialYears.id' => $yearname])->first();
                $fyear                     = substr($profinancial['name'], -2);
                $depcode                   = strtoupper(substr($dep['name'], 0, 3));
                $var                       = sprintf('%03d', $insertid);
               
                $projectcode               =  $fyear.$depcode.$var;			
			 
                $ProjectWorksTable      = $this->getTableLocator()->get('ProjectWorks');
                $project                = $ProjectWorksTable->get($insertid); 
                $project->project_code  = $projectcode;
                $ProjectWorksTable->save($project);				
				
			    foreach ($this->request->getData('project') as $key => $value) {
                
					if ($value['id'] != '') {
						$projectWorkSubdetail = $this->ProjectWorkSubdetails->get($value['id'], [
							'contain' => [],
						]);
					}else{
					    $projectWorkSubdetail = $this->ProjectWorkSubdetails->newEmptyEntity();
					}
					$projectWorkSubdetail->project_work_id         =  $insertid;
					$projectWorkSubdetail->work_name               =  $value['work_name'];
					$projectWorkSubdetail->place_name              =  $value['place_name'];
					$projectWorkSubdetail->district_id             =  $value['district_id'];
					$projectWorkSubdetail->division_id             =  ($value['division_id'])?$value['division_id']:$value['division_id1'];
					$projectWorkSubdetail->circle_id               =  $value['circle_id'];
					$projectWorkSubdetail->rough_cost              =  $value['rough_cost'];
					$projectWorkSubdetail->submit_date             =  date('Y-m-d');
					$projectWorkSubdetail->created_by              =  $user->id;
					$projectWorkSubdetail->created_date            =  date('Y-m-d:h:m:s');	
			  
					if($this->ProjectWorkSubdetails->save($projectWorkSubdetail)){
						$sub_insert_id = $projectWorkSubdetail->id;
						    $ProjectsubWorksTable      = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$projectsub                = $ProjectsubWorksTable->get($sub_insert_id); 
							$projectsub->project_work_status_id  = 1;
							$ProjectsubWorksTable->save($projectsub);
					}						
                }
                $this->Flash->success(__('The project work has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
        }
       
        $this->loadModel('FinancialYears');
        $this->loadModel('BuildingTypes');
        $this->loadModel('ProjectStatuses');
        $this->loadModel('Districts');
        $this->loadModel('Divisions');
        $this->loadModel('SchemeTypes');
        $departments    = $this->ProjectWorks->Departments->find('list')->where(['Departments.is_active'=>1])->all();
        $financialYears = $this->FinancialYears->find('list')->where(['FinancialYears.is_active'=>1])->order(['id Desc'])->all();
        $buildingTypes  = $this->BuildingTypes->find('list')->where(['BuildingTypes.is_active'=>1])->all();
        $schemeTypes    = $this->SchemeTypes->find('list')->all();
        $Statuses       = $this->ProjectStatuses->find('list')->all(); 

	    $this->loadModel('Circles');
	    $districts  = $this->Districts->find('list')->where(['Districts.is_active'=>1])->toArray();
	    $divisions  = $this->Divisions->find('list')->where(['Divisions.is_active'=>1])->toArray();
	    $circles    = $this->Circles->find('list')->where(['Circles.is_active'=>1])->toArray();
	    $work_types = $this->DepartmentwiseWorkTypes->find('list')->where(['DepartmentwiseWorkTypes.is_active'=>1])->toArray();       		
        $this->set(compact('work_types','circles','projectWork', 'departments', 'financialYears', 'buildingTypes', 'Statuses', 'districts', 'divisions','role_id','schemeTypes'));
    }
	 public function ajaxdepartmentworktype($id)
    {  
        $this->loadModel('DepartmentwiseWorkTypes');
        $work_types    = $this->DepartmentwiseWorkTypes->find('all')->where(['DepartmentwiseWorkTypes.department_id' => $id,'DepartmentwiseWorkTypes.is_active'=>1])->toArray();    	
        $this->set(compact('work_types'));
      }
	  //ajaxchennaidivisions
	 public function ajaxchennaidivisions($id)
    {  
        $this->loadModel('Divisions');		
		if($id == 2){
			$divisions    = $this->Divisions->find('all')->where(['Divisions.id IN' => [1,2],'Divisions.is_active'=>1])->toArray(); 
		}else{		
			$divisions    = $this->Divisions->find('all')->where(['Divisions.is_active'=>1])->toArray();    	
		}
        $this->set(compact('divisions'));
      }
    public function edit($id = null)
     {
		$this->viewBuilder()->setLayout('layout');
		$this->loadModel('ProjectWorkSubdetails');
		$this->loadModel('DepartmentwiseWorkTypes');  

		$user        = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$projectWork = $this->ProjectWorks->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
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
					$current_time                              = date('Y_m_d');
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
		   $project_amount  = $this->request->getData('project_amount');
		   $coastal_area    = $this->request->getData('coastal_area');

			$projectWork->department_id       =  $this->request->getData('department_id');
			$projectWork->financial_year_id   =  $this->request->getData('financial_year_id');
			$projectWork->building_type_id    =  $this->request->getData('building_type_id');
			$projectWork->project_status_id   =  1;
			$projectWork->project_name        =  $this->request->getData('project_name');
			$projectWork->project_description =  $this->request->getData('project_description');
			$projectWork->ce_approved         =  0;
			$projectWork->project_amount      =  $project_amount;
			$projectWork->coastal_area        =  $coastal_area;   
			$projectWork->modified_by         =  $user->id;
			$projectWork->modified_date       =  date('Y-m-d H:i:s');
			//  echo"<pre>";print_r($projectWork);exit();
			if ($this->ProjectWorks->save($projectWork)) {
				 foreach ($this->request->getData('project') as $key => $value) {
					
					if ($value['id'] != '') {
						$projectWorkSubdetail = $this->ProjectWorkSubdetails->get($value['id'], [
							'contain' => [],
						]);
						$projectWorkSubdetail->modified_by          = $user->id;
						$projectWorkSubdetail->modified_date        = date('Y-m-d:h:m:s');	
					}else{
						$projectWorkSubdetail = $this->ProjectWorkSubdetails->newEmptyEntity();
						$projectWorkSubdetail->created_by           = $user->id;
					   $projectWorkSubdetail->created_date          = date('Y-m-d:h:m:s');	
					}
					$projectWorkSubdetail->project_work_id         = $id;
					$projectWorkSubdetail->work_name               = $value['work_name'];
					$projectWorkSubdetail->place_name              = $value['place_name'];
					$projectWorkSubdetail->district_id             = $value['district_id'];
					$projectWorkSubdetail->division_id             = ($value['division_id'])?$value['division_id']:$value['division_id1'];
					$projectWorkSubdetail->circle_id               = $value['circle_id'];
					$projectWorkSubdetail->rough_cost              = $value['rough_cost'];
					$projectWorkSubdetail->is_active               = $value['is_active'];
					$projectWorkSubdetail->project_work_status_id  = 1;
					$projectWorkSubdetail->submit_date             = date('Y-m-d');	
					$this->ProjectWorkSubdetails->save($projectWorkSubdetail);					
				}				
				$this->Flash->success(__('The project work has been saved.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The project work could not be saved. Please, try again.'));
		}

		$this->loadModel('FinancialYears');
		$this->loadModel('BuildingTypes');
		$this->loadModel('ProjectStatuses');
		$this->loadModel('Districts');
		$this->loadModel('Divisions');
		$this->loadModel('SchemeTypes');
		$this->loadModel('Circles');
		$this->loadModel('Departments');
		$departments    = $this->Departments->find('list')->where(['Departments.is_active'=>1])->all();
		$financialYears = $this->FinancialYears->find('list')->where(['FinancialYears.is_active'=>1])->order(['id Desc'])->all();
		$buildingTypes  = $this->BuildingTypes->find('list')->where(['BuildingTypes.is_active'=>1])->all();
		$Statuses  = $this->ProjectStatuses->find('list', ['limit' => 200])->all();
		$statusproject    = [0=>'pending',1=>'Approved',2=>'Rejected'];		
		$schemeTypes  = $this->SchemeTypes->find('list', ['limit' => 200])->all();
		$districts    = $this->Districts->find('list')->where(['Districts.is_active'=>1])->toArray();
		$divisions    = $this->Divisions->find('list')->where(['Divisions.is_active'=>1])->toArray();
		$circles      = $this->Circles->find('list')->where(['Circles.is_active'=>1])->toArray();   
		$work_types   = $this->DepartmentwiseWorkTypes->find('list')->where(['DepartmentwiseWorkTypes.department_id'=>$projectWork['department_id'],'DepartmentwiseWorkTypes.is_active'=>1])->toArray();
	    $projectWorkSubdetails    = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.is_active'=>1])->toArray();

    $this->set(compact('projectWork', 'departments', 'financialYears', 
    'buildingTypes', 'projectStatuses', 'districts', 'divisions','schemeTypes','statusproject','projectWorkSubdetails','circles','work_types')); 
}
    public function projectapprove($id = null)
   {
    $this->viewBuilder()->setLayout('layout');
    $user = $this->request->getAttribute('identity');
	$this->loadModel('ProjectWorkSubdetails');
	$this->loadModel('Notifications');
	$this->loadModel('Users');

    $role_id     = $user->role_id;
    $division_id = $user->division_id;	
	$Subdetails  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id'=>$id])->first();
	$project_subdetail  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id'=>$id,'ProjectWorkSubdetails.work_type'=>2])->first();
	 
      if($Subdetails['work_type'] == 1){
		  $projectWork = $this->ProjectWorks->get($id, [
			'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes','DepartmentwiseWorkTypes'],
		]);	

	  }else{		  
	    $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'ProjectStatuses', 'Districts', 'Divisions','DepartmentwiseWorkTypes'],
        ]);
	  }
	
    if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>'; print_r($this->request->getData()); exit();
		$remarks         = $this->request->getData('remarks');

		$projectTable                   = $this->getTableLocator()->get('ProjectWorks');
		$project                        = $projectTable->get($id); 
		$project->ce_approved	        = $this->request->getData('ce_approved');
		$project->approved_date         =  date('Y-m-d');							  
		$project->remarks               =  $remarks;
		if ($projectTable->save($project)) {				   
		   if($project->ce_approved == 1){					   
			   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles'])->where(['project_work_id' => $id])->toArray();
				foreach($projectWorkSubdetails as $projectsubdetail){
					if($projectsubdetail['project_work_status_id'] != 2){
					$ProjectsubWorksTable      = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$projectsub                = $ProjectsubWorksTable->get($projectsubdetail['id']); 
					$projectsub->project_work_status_id  = 2;
					$ProjectsubWorksTable->save($projectsub);
					}
				}	    	
				
           $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id'=>$user->id,'Notifications.project_work_id'=>$id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>2])->count();
		   if($notification_count == 1){   
				   $notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id'=>$user->id,'Notifications.project_work_id'=>$id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>2])->first();

					$notificationTable                  = $this->getTableLocator()->get('Notifications');
					$notification                       = $notificationTable->get($notification_id['id']); 
					$notification->notification_seen	= 1;  
					$notification->process_done	        = 1;  
					$notificationTable->save($notification);
					if($notification_id['work_type'] == 1){
				    $recipient_user = $this->Users->find('all')->where(['Users.role_id'=>9,'Users.is_active'=>1])->first();
					}else if($notification_id['work_type'] == 2){
				    $recipient_user = $this->Users->find('all')->where(['Users.role_id'=>14,'Users.division_id'=>$project_subdetail['division_id'],'Users.is_active'=>1])->first();
					}
		            $recipient_user_id = $recipient_user['id'];  	
					//echo '<pre>';  print_r($notification_count); exit();
                    $notification = $this->Notifications->newEmptyEntity();					
					$notification->forwarded_date                    = date('Y-m-d');
					$notification->forward_user_id                   = $user->id;
					$notification->recipient_user_id                 = $recipient_user_id; 
					if($notification_id['work_type'] == 1){
					$notification->notification_type_id              = 3; 
					}else if($notification_id['work_type'] == 2){
					$notification->notification_type_id              = 4;
					$notification->work_type                         = 2;
					$notification->project_work_subdetail_id         = $project_subdetail['id'];
					}					
					$notification->project_work_id                   = $id;					
					$notification->created_by                        = $user->id;
					$notification->created_date                      = date('Y-m-d H:i:s');	
				    $this->Notifications->save($notification);					
			  }				
		   }
			$this->Flash->success(__('The project Status has been saved.'));
			return $this->redirect(['action' => 'index']);
		}else{
		   $this->Flash->error(__('The project Status could not be saved. Please, try again.'));
		}
    }

     $statusproject    = [1=>'Approved',2=>'Rejected'];
	 $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Districts','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.is_active'=>1])->toArray();
	 $projectWorkSubdetailscount  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.is_active'=>1])->count();
 
     $this->set(compact('projectWork', 'departments', 'financialYears', 
    'buildingTypes', 'projectStatuses', 'districts', 'divisions','schemeTypes','statusproject','projectWorkSubdetails','projectWorkSubdetailscount')); 
   }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectWork = $this->ProjectWorks->get($id);
        if ($this->ProjectWorks->delete($projectWork)) {
            $this->Flash->success(__('The project work has been deleted.'));
        } else {
            $this->Flash->error(__('The project work could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	public function administrativesanctionadd(){  
		$this->viewBuilder()->setLayout('layout');
        $user  = $this->request->getAttribute('identity');
		$this->loadModel('ProjectAdministrativeSanctions');	
		$this->loadModel('ProjectWorks');	
		$this->loadModel('Departments');	
		$this->loadModel('FinancialYears');	
		$this->loadModel('SupervisionCharges');	
		$this->loadModel('FundSources');	
		$this->loadModel('ProjectWorkSubdetails');	
		
		if ($this->request->is(['patch', 'post', 'put'])) { 
		
		    $fin_year = $this->request->getData('financial_year_id');
		    $dept_id  = $this->request->getData('department_id'); 				  
		  
		   $connection = ConnectionManager::get('default');
			  $query   = "select count(project.id) as pcount
						  from project_works as p
						  LEFT join project_work_subdetails as project on project.project_work_id = p.id
						  where  project.work_type = 1 and p.financial_year_id = ".$fin_year." and p.department_id = ".$dept_id." and p.ce_approved = 1 and project.project_work_status_id < 3
						  ";
			$approved_project_count    = $connection->execute($query)->fetchAll('assoc');
		    $approved_project_ids      = $this->ProjectWorks->find('list', ['keyField' => 'id','valueField' => 'id'])->where(['ProjectWorks.financial_year_id' => $fin_year,'ProjectWorks.department_id'=>$dept_id,'ProjectWorks.ce_approved'=>1])->toArray();      
		   if($approved_project_count > 0){
			$approved_sub_projects  = $this->ProjectWorkSubdetails->find('all')->contain(['Districts', 'Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id IN' => $approved_project_ids,'ProjectWorkSubdetails.project_work_status_id <'=>3,'ProjectWorkSubdetails.is_active'=>1,'ProjectWorkSubdetails.work_type'=>1])->toArray();      
			$approved_sub_count     = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id IN' => $approved_project_ids,'ProjectWorkSubdetails.project_work_status_id <'=>3,'ProjectWorkSubdetails.is_active'=>1,'ProjectWorkSubdetails.work_type'=>1])->count();      
		   }
		}  
		
	    $departments    = $this->Departments->find('list')->where(['Departments.is_active'=>1])->all();
        $financialYears = $this->FinancialYears->find('list')->where(['FinancialYears.is_active'=>1])->order('id DESC')->all();		
		$supervision_charges = $this->SupervisionCharges->find('list')->toArray();
        $fund_sources        = $this->FundSources->find('list')->toArray();       
		
	   $this->set(compact('departments', 'financialYears','approved_projects','approved_project_count','supervision_charges','fund_sources','approved_sub_projects'));
	
	}	
	public function ajaxsubproject($id = null,$i = null)
    {
		$this->loadModel('ProjectWorkSubdetails');		 	
		$this->loadModel('ProjectWorks');		 	
	    $projectWorkSubdetail      = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $id,'ProjectWorkSubdetails.is_active'=>1])->first();
        $project_id = $projectWorkSubdetail['project_work_id'];
		
	    $projectwork      = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $project_id])->first();
	
	   $this->set(compact('i','projectWorkSubdetail','id','projectwork'));
    }  
	public function ajaxsubprojectfs($id = null,$i = null)
    {
		$this->loadModel('ProjectWorkSubdetails');		 	
		$this->loadModel('ProjectWorks');		 	
		$this->loadModel('ProjectAdministrativeSanctions');		 	
	    $projectWorkSubdetail      = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $id,'ProjectWorkSubdetails.is_active'=>1])->first();
        $project_id = $projectWorkSubdetail['project_work_id'];
		
	    $projectwork    = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $project_id])->first();
	    $as_detail      = $this->ProjectAdministrativeSanctions->find('all')->contain(['SupervisionCharges'])->where(['ProjectAdministrativeSanctions.project_work_id' => $project_id])->first();
        //echo "<pre>";  print_r($as_detail); exit();  

	   $this->set(compact('i','projectWorkSubdetail','id','projectwork','as_detail'));
    }
	
	public function insertadminsanction(){
		$this->loadModel('ProjectAdministrativeSanctions');	
		$user  = $this->request->getAttribute('identity');
		$this->loadModel('ProjectWorks');	
		$this->loadModel('Notifications');	
		$this->loadModel('Users');	
		
		if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>';  print_r($this->request->getData()); exit();
		
		 $asprojects = $this->request->getData('as_project');
		 
		 if($asprojects != ''){

 		 foreach($asprojects as $key1 => $value1){		 
			 
		   $count      = $this->ProjectAdministrativeSanctions->find('all')->where(['ProjectAdministrativeSanctions.project_work_id' =>$value1['project_id']])->count();
			if($count == 0){ 
			 
			$projectAdministrativeSanction = $this->ProjectAdministrativeSanctions->newEmptyEntity();			 
			$attachment  = $this->request->getData('go_file_upload');			  
            if ($attachment->getClientFilename() != '') {
                $name    = $attachment->getClientFilename();
                $type    = $attachment->getClientMediaType();
                $size    = $attachment->getSize();
                $tmpName = $attachment->getStream()->getMetadata('uri');
                $error   = $attachment->getError();

                if ($name != '' && $error == 0) {
                    $file                                   =  $name;
                    $array                                  =  explode('.', $file);
                    $fileExt                                =  $array[count($array) - 1];
                    $current_time                           =  date('Y_m_d');
                    $newfile                                =  "administativesanction_" . $value1['project_id'] . "_" . $current_time . "." . $fileExt;
                    $tempFile                               =  $tmpName;
                    $targetPath                             =  'uploads/AdministrativeSanctions/';   
                    $targetFile                             =  $targetPath . $newfile;
                    $projectAdministrativeSanction->go_file_upload    =   $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            }			
            $projectAdministrativeSanction->project_work_id           = $value1['project_id'];
            $projectAdministrativeSanction->go_no                     = $this->request->getData('go_no');
            $projectAdministrativeSanction->go_date                   = date('Y-m-d', strtotime($this->request->getData('go_date')));
            $projectAdministrativeSanction->sanctioned_amount         = $this->request->getData('sanctioned_amount');
            $projectAdministrativeSanction->supervision_charge_id     = $this->request->getData('supervision_charge_id');
            $projectAdministrativeSanction->fund_source_id            = $this->request->getData('fund_source_id');
            $projectAdministrativeSanction->created_by                =  $user->id;
            $projectAdministrativeSanction->created_date              =  date('Y-m-d H:i:s');
		    	//echo '<pre>'; print_r($projectAdministrativeSanction);  exit();
			$this->ProjectAdministrativeSanctions->save($projectAdministrativeSanction);
			
			
				$notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$value1['project_id'],'Notifications.process_done'=>0,'Notifications.notification_type_id'=>3])->count();
			    // echo '<pre>';  print_r($notification_count); exit();
			     if($notification_count == 1){   
					   $notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$value1['project_id'],'Notifications.process_done'=>0,'Notifications.notification_type_id'=>3])->first();
						$notificationTable                  = $this->getTableLocator()->get('Notifications');
						$notification                       = $notificationTable->get($notification_id['id']); 
						$notification->notification_seen	= 1;  
						$notification->process_done	        = 1;  
						$notificationTable->save($notification);
				}
			
			}
		   }
		 }		 
				 $projects = $this->request->getData('project');
		 
				 if($projects != ''){
				 foreach($projects as $key => $value){
				 
					$projectWork = $this->ProjectWorks->get($value['project_id'], [
						'contain' => [],
					]);
						
		            $project_code =  $projectWork['project_code'];				   
				 
				 	if($value['amount'] <= 600000){					
					 $approval_role             =  4;	
					}else if($value['amount'] > 600000 && $value['amount'] <= 3000000){				
					 $approval_role             =  5;
					}else if($value['amount'] > 3000000){					
					 $approval_role             =  6;	
					} 
				 
				    $this->loadModel('Divisions');
					$division                  = $this->Divisions->find('all')->where(['Divisions.id' => $value['division_id'],'Divisions.is_active'=>1])->first();
					$goyear                    = date('Y', strtotime($this->request->getData('go_date')));					
					$divsioncode               = $division['division_code']; 									
					$count =  $value['id'];
					$var                       = sprintf('%02d', $count);				   
					$workcode                  = $goyear.$divsioncode.$var; 

                    $ProjectWorkssubdetailTable  = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$projectsubdetail                     = $ProjectWorkssubdetailTable->get($value['id']); 
					$projectsubdetail->work_code          = $project_code.'/'.$workcode;
					$projectsubdetail->sanctioned_amount  = $value['amount'];
					$projectsubdetail->total_units        = $value['total_units'];  
					$projectsubdetail->approval_role      = $approval_role;
					$projectsubdetail->project_work_status_id      = 3;
					$ProjectWorkssubdetailTable->save($projectsubdetail);
					
					
					   	$recipient_user = $this->Users->find('all')->where(['Users.role_id'=>14,'Users.division_id'=>$value['division_id'],'Users.is_active'=>1])->first();
						$recipient_user_id = $recipient_user['id'];
						if($recipient_user_id != ''){
						$notification = $this->Notifications->newEmptyEntity();					
						$notification->forwarded_date                    = date('Y-m-d');
						$notification->forward_user_id                   = $user->id;
						$notification->recipient_user_id                 = $recipient_user_id; 
						$notification->notification_type_id              = 4; 
						$notification->project_work_id                   = $value['project_id'];
						$notification->project_work_subdetail_id         = $value['id'];
						$notification->created_by                        = $user->id;
						$notification->created_date                      = date('Y-m-d H:i:s');				
						$this->Notifications->save($notification);
						}
					
					if($projectWork['work_flag'] == 0){
					
				    $ProjectWorksTable     = $this->getTableLocator()->get('ProjectWorks');
					$project               = $ProjectWorksTable->get($value['project_id']); 
					$project->AS_flag      = 1;
					$project->work_flag    = 1;
					$ProjectWorksTable->save($project);	
					}
			    }	 
					  
		       return $this->redirect(['action' => 'approvedlist']);
		    }
		
		  //}
		}
		exit();
	} 

   public function financialsanctionadd(){    
		$this->viewBuilder()->setLayout('layout');
        $user  = $this->request->getAttribute('identity');
		$this->loadModel('ProjectWorks');	
		$this->loadModel('Departments');	
		$this->loadModel('FinancialYears');	
		$this->loadModel('ProjectWorkSubdetails');	
		
		if ($this->request->is(['patch', 'post', 'put'])) { 		
			  $fin_year = $this->request->getData('financial_year_id');
			  $dept_id  = $this->request->getData('department_id'); 				  
			  $project_id  = $this->request->getData('project_work_id'); 			  
			  
			  $approved_project_count = $this->ProjectWorks->find('all')->where(['ProjectWorks.financial_year_id' => $fin_year,'ProjectWorks.department_id'=>$dept_id,'ProjectWorks.FS_flag'=>0,'ProjectWorks.AS_flag' =>1])->count();      
			  $approved_project_ids      = $this->ProjectWorks->find('list', ['keyField' => 'id','valueField' => 'id'])->where(['ProjectWorks.financial_year_id' => $fin_year,'ProjectWorks.department_id'=>$dept_id,'ProjectWorks.ce_approved'=>1,'ProjectWorks.AS_flag' =>1])->toArray();      
			 //print_r($approved_project_ids); exit();
			if($approved_project_count > 0){
				$approved_sub_projects_count  = $this->ProjectWorkSubdetails->find('all')->contain(['Districts', 'Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id IN' => $approved_project_ids,'ProjectWorkSubdetails.project_work_status_id'=>4,'ProjectWorkSubdetails.is_active'=>1])->count();      
				$approved_sub_projects        = $this->ProjectWorkSubdetails->find('all')->contain(['Districts', 'Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id IN' => $approved_project_ids,'ProjectWorkSubdetails.project_work_status_id'=>4,'ProjectWorkSubdetails.is_active'=>1])->toArray();      
			}	
		}		
	    $departments    = $this->Departments->find('list')->where(['Departments.is_active'=>1])->all();
        $financialYears = $this->FinancialYears->find('list')->where(['FinancialYears.is_active'=>1])->order('id DESC')->all();		
		
	   $this->set(compact('approved_sub_projects_count','ProjectWorks','departments', 'financialYears','approved_projects','approved_project_count','supervision_charges','fund_sources','approved_sub_projects'));
	
	}
	
	public function ajaxprojectlist($dep_id= null,$fin_id = null)
	{	
	    $project_works = $this->ProjectWorks->find('all')->where(['ProjectWorks.financial_year_id' => $fin_id,'ProjectWorks.department_id'=>$dep_id,'ProjectWorks.FS_flag'=>0])->toArray();      
			
		$this->set(compact('project_works'));
	}

    public function insertfinancialsanction(){
		$this->loadModel('ProjectFinancialSanctions');	
		$user  = $this->request->getAttribute('identity');
		$this->loadModel('ProjectWorks');	
		$this->loadModel('Notifications');	
		$this->loadModel('Users');	
		$this->loadModel('ProjectWorkSubdetails');	
		
		if ($this->request->is(['patch', 'post', 'put'])) {   //echo '<pre>';  print_r($this->request->getData()); exit();
		
		 $fsprojects = $this->request->getData('fs_project');
		 
		 if($fsprojects != ''){
 		 foreach($fsprojects as $key1 => $value1){  
			 
		    $count      = $this->ProjectFinancialSanctions->find('all')->where(['ProjectFinancialSanctions.project_work_id' =>$value1['project_id']])->count();
			if($count == 0){ 		 
				 $projectFinancialSanction = $this->ProjectFinancialSanctions->newEmptyEntity();
				 
				  $attachment  =  $this->request->getData('sanctioned_file_upload');  
			   
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
							$newfile                                   = "financial_sanction_".$current_time.".".$fileExt;
							$tempFile                                  = $tmpName;
							$targetPath                                = 'uploads/financialsanction/';
							$targetFile                                = $targetPath . $newfile;
							$projectFinancialSanction->sanctioned_file_upload                  =   $newfile;

							move_uploaded_file($tempFile, $targetFile);
						} 
					}
				
					$projectFinancialSanction->project_work_id         =  $value1['project_id'];
					$projectFinancialSanction->go_date                 =  date('Y-m-d', strtotime($this->request->getData('go_date')));
					$projectFinancialSanction->go_no                   =  $this->request->getData('go_no');
					$projectFinancialSanction->sanctioned_amount       =  $this->request->getData('sanctioned_amount');
					$projectFinancialSanction->created_by              =  $user->id;
					$projectFinancialSanction->created_date            =  date('Y-m-d:h:m:s');
					//echo '<pre>'; print_r($projectFinancialSanction);  exit();
				 if($this->ProjectFinancialSanctions->save($projectFinancialSanction)){				 
						$ProjectWorksTable     = $this->getTableLocator()->get('ProjectWorks');
						$project               = $ProjectWorksTable->get($value1['project_id']); 
						$project->FS_flag      = 1;
						$ProjectWorksTable->save($project);	
				  }	
				}   
			  } 
		  }
		  
		      $projects = $this->request->getData('project');
			  
			   if($projects != ''){
			  
				  foreach($projects as $subproject){
					   if($subproject['project_id'] != ''){
				            $ProjectsubWorksTable      = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$projectsub                = $ProjectsubWorksTable->get($subproject['project_subdetail_id']); 
							$projectsub->project_work_status_id  = 5;
							$projectsub->fs_amount               = $subproject['fs_amount'];
							$projectsub->supervision_charge      = $subproject['supervision_charge'];
							$projectsub->fs_excluding_sc         = $subproject['fs_excluding_sc'];					
							$ProjectsubWorksTable->save($projectsub);	
					$project_subdetail = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id'=>$subproject['project_subdetail_id']])->first();	
							
					  
				   $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$project_subdetail['project_work_id'],'Notifications.project_work_subdetail_id'=>$subproject['project_subdetail_id'],'Notifications.process_done'=>0,'Notifications.notification_type_id'=>5])->count();
				  // echo '<pre>';  print_r($notification_count); exit();
				   if($notification_count == 1){   
						$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$project_subdetail['project_work_id'],'Notifications.project_work_subdetail_id'=>$subproject['project_subdetail_id'],'Notifications.process_done'=>0,'Notifications.notification_type_id'=>5])->first();

						$notificationTable                  = $this->getTableLocator()->get('Notifications');
						$notification                       = $notificationTable->get($notification_id['id']); 
						$notification->notification_seen	= 1;  
						$notification->process_done	        = 1;  
						$notificationTable->save($notification);
						
						    $recipient_user = $this->Users->find('all')->where(['Users.role_id'=>14,'Users.division_id'=>$project_subdetail['division_id'],'Users.is_active'=>1])->first();
							$recipient_user_id = $recipient_user['id'];
							$notification = $this->Notifications->newEmptyEntity();					
							$notification->forwarded_date                    = date('Y-m-d');
							$notification->forward_user_id                   = $user->id;
							$notification->recipient_user_id                 = $recipient_user_id; 
							$notification->notification_type_id              = 6; 
							$notification->project_work_id                   = $project_subdetail['project_work_id'];
							$notification->project_work_subdetail_id         = $subproject['project_subdetail_id'];
							$notification->created_by                        = $user->id;
							$notification->created_date                      = date('Y-m-d H:i:s');				
							$this->Notifications->save($notification);
				    	}  
					 }							
				  }
			   }
			  
		     return $this->redirect(['action' => 'approvedlist']);
		  
		}
		exit();
	}  	
		
	public function projectworksadd($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user  = $this->request->getAttribute('identity');
		$this->loadModel('ProjectAdministrativeSanctions');	
		$this->loadModel('ProjectWorkSubdetails');	

        //$id    = base64_decode($id);  
        $this->loadModel('ProjectWorks');
        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
        ]);
		
		$project_code =  $projectWork['project_code'];		

       $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->count();      
  	   $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks','FundSources','SupervisionCharges'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	   $projectWorkSubdetailscount  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id])->count();
	   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id])->toArray();
       
        if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>';  print_r($this->request->getData());   exit();			
			   foreach ($this->request->getData('project') as $key => $value) {                
                if ($value['id'] != '') {
                    $projectWorkSubdetail = $this->ProjectWorkSubdetails->get($value['id'], [
                        'contain' => [],
                    ]);
                }else{
                  $projectWorkSubdetail = $this->ProjectWorkSubdetails->newEmptyEntity();
                }
                // print_r($projectFinancialSanction);
                $projectWorkSubdetail->project_work_id         =  $id;
                $projectWorkSubdetail->district_id             =  $value['district_id'];
                $projectWorkSubdetail->division_id             =  $value['division_id'];
                $projectWorkSubdetail->circle_id               =  $value['circle_id'];
                $projectWorkSubdetail->sanctioned_amount       =  $value['amount'];
				$projectWorkSubdetail->submit_date             =  date('Y-m-d');
                $projectWorkSubdetail->created_by              =  $user->id;
                $projectWorkSubdetail->created_date            =  date('Y-m-d:h:m:s');				
				
				if($value['amount'] <= 600000){					
				 $projectWorkSubdetail->approval_role             =  4;	
				}else if($value['amount'] > 600000 && $value['amount'] <= 3000000){				
				 $projectWorkSubdetail->approval_role             =  5;
				}else if($value['amount'] > 3000000){					
				 $projectWorkSubdetail->approval_role             =  6;	
				}            
            
                if($this->ProjectWorkSubdetails->save($projectWorkSubdetail)){
					
					$insertid   = $projectWorkSubdetail->id;			
					$this->loadModel('Divisions');
					$division                  = $this->Divisions->find('all')->where(['Divisions.id' => $value['division_id'],'Divisions.is_active'=>1])->first();
					$goyear                    = date('Y', strtotime($this->request->getData('go_date')));					
					$divsioncode               = $division['division_code']; 									
					$count =  $key+1;
					$var                       = sprintf('%02d', $count);				   
					$workcode                  = $goyear.$divsioncode.$var; 				
					
					$ProjectWorkssubdetailTable  = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                     = $ProjectWorkssubdetailTable->get($insertid); 
					$project->work_code          = $project_code.'/'.$workcode;
					$ProjectWorkssubdetailTable->save($project);

                  if($projectWork['work_flag'] == 0){
                    $ProjectWorksTable         = $this->getTableLocator()->get('ProjectWorks');
					$projectwrk                = $ProjectWorksTable->get($id); 
					$projectwrk->work_flag      = 1;
					$ProjectWorksTable->save($projectwrk);
				  }			
				}
            }
				
			$this->Flash->success(__('The project administrative sanction has been saved.'));
			return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'approvedlist']);          
        }		
		
		 $this->loadModel('Divisions');
		 $this->loadModel('Circles');
		 $this->loadModel('Districts');
         $districts = $this->Districts->find('list')->where(['Districts.is_active'=>1])->toArray();
         $divisions = $this->Divisions->find('list')->where(['Divisions.is_active'=>1])->toArray();
         $circles   = $this->Circles->find('list')->where(['Circles.is_active'=>1])->toArray();		 
		 $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id])->toArray();

         $this->set(compact('districts','supervision_charges','fund_sources','projectWork', 'administrativesanction','administrativesanctioncount','projectAdministrativeSanction','divisions','circles','projectWorkSubdetails','id','projectWorkSubdetailscount'));
    }
 
    public function ajaxproject($i = null)
    {
	    $this->loadModel('Districts');
		$this->loadModel('Divisions');
		$this->loadModel('Circles');
        $districts = $this->Districts->find('list')->where(['Districts.is_active'=>1])->toArray();
        $divisions = $this->Divisions->find('list')->where(['Divisions.is_active'=>1])->toArray();
        $circles   = $this->Circles->find('list')->where(['Circles.is_active'=>1])->toArray();		
        $this->set(compact('i','divisions','circles','districts'));
    }
		
    public function ajaxcircles($id)
    {
        $this->loadModel('Districts');	
        $this->loadModel('Divisions');			
		$dists    = $this->Districts->find('all')->contain(['Divisions'])->where(['Districts.id' => $id,'Districts.is_active'=>1])->first();
        $divs     = $this->Divisions->find('all')->contain(['Circles'])->where(['Divisions.id' => $dists['division']['id'],'Divisions.is_active'=>1])->first();        
		echo  $divs['circle']['id'];
        exit();
        $this->set(compact('circle'));
    }
   
    public function ajaxdivisions($id)
    {
        $this->loadModel('Districts');
        $this->loadModel('Divisions');
        $dists    = $this->Districts->find('all')->contain(['Divisions'])->where(['Districts.id' => $id,'Districts.is_active'=>1])->first();    	
		$division_id = $dists['division']['id'];		
		echo $division_id;
        exit();       
      }
	
    public function projectmonitoring($id = null)
    {  
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->loadModel('ProjectWorks');
        $this->loadModel('ProjectMonitoringDetails');
        $this->loadModel('WorkStages');
		
        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions'],
        ]);

        $monitoringDetailscount = $this->ProjectMonitoringDetails->find('all')->where(['project_work_id' => $id])->count();
        $monitoringDetails      = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
		
         if ($this->request->is(['patch', 'post', 'put'])) {
              foreach ($this->request->getData('monitoring') as $key => $value) {
                
                if ($value['id'] != '') {
                    $projectMonitoringDetail = $this->ProjectMonitoringDetails->get($value['id'], [
                        'contain' => [],
                    ]);
                }else{
                  $projectMonitoringDetail = $this->ProjectMonitoringDetails->newEmptyEntity();
                }
                $projectMonitoringDetail->project_work_id       =  $id;
                $projectMonitoringDetail->monitoring_date       =  date('Y-m-d', strtotime($value['monitoring_date']));
                $projectMonitoringDetail->amount                =  $value['amount'];
                $projectMonitoringDetail->work_stage_id         =  $value['work_stage_id'];
                $projectMonitoringDetail->created_by            =  $user->id;
                $projectMonitoringDetail->created_date          =  date('Y-m-d:h:m:s');
                if ($monitoringDetailscount > 0) {
                    $projectMonitoringDetail->modified_by            =  $user->id;
                    $projectMonitoringDetail->modified_date          =  date('Y-m-d:h:m:s');              

                 }
                $attachment               =  $value['photo_upload'];

                if ($attachment->getClientFilename() != '') {

                    $name    = $attachment->getClientFilename();
                    $type    = $attachment->getClientMediaType();
                    $size    = $attachment->getSize();
                    $tmpName = $attachment->getStream()->getMetadata('uri');
                    $error   = $attachment->getError();

                    if ($name != '' && $error == 0) {

                        $file                                      =     $name;
                        $array                                     =     explode('.', $file);
                        $fileExt                                   =    $array[count($array) - 1];
                        $current_time                              =    date('Y_m_d_H_i_s');
                        $newfile                                   =   "projectmonitoring_" . $value['work_stage_id'] . "_" . $key . "_" . $current_time . "." . $fileExt;
                        $tempFile                                  =     $tmpName;
                        $targetPath                                =     'uploads/Projectmonitoring/';
                        $targetFile                                =    $targetPath . $newfile;
                        $projectMonitoringDetail->photo_upload                  =   $newfile;
                        move_uploaded_file($tempFile, $targetFile);
                    } 
                }else{
                    $projectMonitoringDetail->photo_upload =  $value['photo_upload1'];
                }
                $this->ProjectMonitoringDetails->save($projectMonitoringDetail);
            }
            $this->Flash->success(__('The project monitoring detail has been saved.'));

            return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'index']);


         }
        $workStages = $this->WorkStages->find('list', ['limit' => 200])->all();
        $this->set(compact('projectMonitoringDetail', 'projectWork', 'workStages', 'monitoringDetails','monitoringDetailscount'));
    } 

    public function ajaxmonitor($i = null)
    {
       //$this->viewBuilder()->layout('');
	   $this->loadModel('WorkStages');

        $workStages = $this->WorkStages->find('list')->all();
        $this->set(compact('i', 'workStages'));
    }

    public function ajaxtechnical($i = null)
    {
        $this->set(compact('i'));
    }
      
    public function ajaxprojecttender($i = null)
    {
        $this->set(compact('i'));
    }

    public function projectfinancialsanctions($id = null)
   {
       $this->viewBuilder()->setLayout('layout');
	   $this->loadModel('ProjectFinancialSanctions');
	   $this->loadModel('ProjectAdministrativeSanctions');
	   $this->loadModel('ProjectWorkSubdetails');

        $user = $this->request->getAttribute('identity');
        //$id = base64_decode($id);
        $this->loadModel('ProjectWorks');
        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
        ]);
		
		$administrativesanctioncount  = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
	    $administrativesanction       = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	    $projectWorkSubdetails        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id])->toArray();
        $financialSanctionscount      = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
        $financialSanctions           = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
      
        if ($this->request->is(['patch', 'post', 'put'])) {
          
            foreach ($this->request->getData('financial') as $key => $value) {
                
                if ($value['id'] != '') {
                    $projectFinancialSanction = $this->ProjectFinancialSanctions->get($value['id'], [
                        'contain' => [],
                    ]);
                }else{
                  $projectFinancialSanction = $this->ProjectFinancialSanctions->newEmptyEntity();
                }
                // print_r($projectFinancialSanction);
                $projectFinancialSanction->project_work_id         =  $id;
                $projectFinancialSanction->sanctioned_date         =  date('Y-m-d', strtotime($value['sanctioned_date']));
                $projectFinancialSanction->fs_ref_no               =  $value['fs_ref_no'];
                $projectFinancialSanction->sanctioned_amount       =  $value['sanctioned_amount'];
                $projectFinancialSanction->created_by              =  $user->id;
                $projectFinancialSanction->created_date            =  date('Y-m-d:h:m:s');
                if (count($financialSanctions) > 0) {
                    $projectFinancialSanction->modified_by         =  $user->id;
                    $projectFinancialSanction->modified_date       =  date('Y-m-d:h:m:s');
                }
                $attachment               =  $value['sanctioned_file_upload'];
           
                if ($attachment->getClientFilename() != '') {
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
                        $newfile                                   =  "financial_sanction_".$current_time.".".$fileExt;
                        $tempFile                                  =  $tmpName;
                        $targetPath                                =  'uploads/financialsanction/';
                        $targetFile                                =    $targetPath . $newfile;
                        $projectFinancialSanction->sanctioned_file_upload                  =   $newfile;

                        move_uploaded_file($tempFile, $targetFile);
                    } 
                }else {
                    $projectFinancialSanction->sanctioned_file_upload =  $value['sanctioned_file_upload1'];
                }
                $this->ProjectFinancialSanctions->save($projectFinancialSanction);
            }
            $this->Flash->success(__('The Financial Sanction detail has been saved.'));
            return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'index']);
           
        }
         $this->set(compact('projectFinancialSanction', 'projectWork','financialSanctions','financialSanctionscount','administrativesanction','projectWorkSubdetails','administrativesanctioncount','id'));
    }

    public function ajaxfinancial($i = null)
    {
        $this->set(compact('i'));
    }
 
   public function projectdetailedestimateapproval($id = null,$work_id = null)
   {	   
	   $this->viewBuilder()->setLayout('layout');
	   $this->loadModel('ProjectwiseDetailedEstimates');
	   $this->loadModel('ProjectAdministrativeSanctions');
	   $this->loadModel('ProjectWorkSubdetails');
	   $this->loadModel('DetailedEstimateApprovalStages');
	   $this->loadModel('Users');
	   $this->loadModel('ApprovalStatuses');

        $user = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		
        $this->loadModel('ProjectWorks');
        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
        ]);
		
		$projectWorkSubdetail            = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id'=>$work_id])->first();
	    $detailed_estimates              = $this->ProjectwiseDetailedEstimates->find('all')->contain(['ProjectWorks','Materials','Units'])->where(['ProjectwiseDetailedEstimates.project_work_id' => $id,'ProjectwiseDetailedEstimates.project_work_subdetail_id'=>$work_id])->toArray();
        $detailed_estimates_count        = $this->ProjectwiseDetailedEstimates->find('all')->where(['ProjectwiseDetailedEstimates.project_work_id' => $id,'ProjectwiseDetailedEstimates.project_work_subdetail_id'=>$work_id])->count();
        $detailed_approval_stages_count  = $this->DetailedEstimateApprovalStages->find('all')->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->count();
        $detailed_approval_stages        = $this->DetailedEstimateApprovalStages->find('all')->contain(['ApprovalStatuses'])->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->toArray();
		//echo '<pre>';  print_r($detailed_approval_stages); exit();
		
        $connection               = ConnectionManager::get('default');
        $query                    =  "SELECT sum(project.total_cost) as total_amount
                                     from projectwise_detailed_estimates as project 
                                     where project.project_work_id = '".$id."' AND project.project_work_subdetail_id = '".$work_id."'";
       $TotalEstimate             = $connection->execute($query)->fetchAll('assoc');
	  
	   $total_estimate =  $TotalEstimate[0]['total_amount'];   
	   
        if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>';  print_r($this->request->getData()); exit();
                $approval_status_id =  $this->request->getData('approval_status_id');	
				
                if($approval_status_id == 1 || $approval_status_id == 3){
					
                   if($role_id != 6){			   
				   
				    if($role_id == 14){
						$next_role_id    = 4;
					}else{				   
                        $next_role_id    = $role_id+1;
					}					
					 //echo '<pre>';  print_r($projectWorkSubdetail['division_id']); exit();
					if($next_role_id == 4){						
					   $status = 'Drawing Branch Forward to EE';
                       $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
                       $user_id = $users['id'];	
					  //echo '<pre>';  print_r($user_id); exit(); 
					}else if($next_role_id == 5){
					  $status = 'EE Forward to SE';	
					   $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.circle_id'=>$projectWorkSubdetail['circle_id'],'Users.is_active'=>1])->first();
                       $user_id = $users['id'];	
					}else if($next_role_id == 6){
					  $status = 'SE Forward to CE';	
					  $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.is_active'=>1])->first();
                      $user_id = $users['id'];					  
					}
				  }else if($role_id == 6){
                      $user_id = 0;	
					  $next_role_id    = 0;
					  $status = 'CE Approved';
				  }					  
					
				}else if($approval_status_id == 2){
					if($role_id == 4){
						$next_role_id    = 14;
					}else if($role_id == 14){
						$next_role_id    = 2;
					}else{					
					    $next_role_id    = $role_id-1;
					}
					if($next_role_id == 5){						
					   $status = 'CE Clarification to SE';
                       $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.circle_id'=>$projectWorkSubdetail['circle_id'],'Users.is_active'=>1])->first();
                       $user_id = $users['id'];						  
					}else if($next_role_id == 4){
					  $status = 'SE Clarification to EE';	
					   $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
                       $user_id = $users['id'];	
					}else if($next_role_id == 14){
					  $status = 'EE Clarification to Drawing Branch';	
					  $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
                      $user_id = $users['id'];
					  
					}else if($next_role_id == 2){
					  $status = 'Drawing Branch Clarification to AE';	
					  $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
                      $user_id = $users['id'];
					  
					}					
				}								
					
				$detailedEstimateApprovalStage = $this->DetailedEstimateApprovalStages->newEmptyEntity();	
				$detailedEstimateApprovalStage->project_work_id           = $id;
				$detailedEstimateApprovalStage->project_work_subdetail_id = $work_id;
				$detailedEstimateApprovalStage->user_id	                  = $user_id;
				$detailedEstimateApprovalStage->current_role_id           = $next_role_id;
				$detailedEstimateApprovalStage->current_status            = $status;
				$detailedEstimateApprovalStage->approval_status_id        = $approval_status_id;
				$detailedEstimateApprovalStage->remarks                   = $this->request->getData('remarks');
				$detailedEstimateApprovalStage->submit_date               = date('Y-m-d');
				$detailedEstimateApprovalStage->created_by                = $user->id;
                $detailedEstimateApprovalStage->created_date              = date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($detailedEstimateApprovalStage); exit();
			  if ($this->DetailedEstimateApprovalStages->save($detailedEstimateApprovalStage)) {

                   $subdetailTable                   = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                          = $subdetailTable->get($projectWorkSubdetail['id']); 
					$project->detailed_estimate_current_role  = $next_role_id;
                    if($role_id == 6 && $this->request->getData('approval_status_id') == 1){
					  $project->detailed_estimate_approval  = 1;
					  $project->project_work_status_id  = 5;  					  
					}					
					$subdetailTable->save($project); 
					
		        $this->Flash->success(__('The project Detailed Estimate has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'approvedlist']);
			  }				
		}
		
     $approvalStatuses = $this->ApprovalStatuses->find('list', ['limit' => 200])->all();

	$this->set(compact('approvalStatuses','projectWork','projectwiseDetailedEstimate', 'projectWorks','detailed_estimates','id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','work_id','total_estimate','detailed_approval_stages','detailed_approval_stages_count','role_id'));
	   
   }
        
   public function projectdetailedestimateadd($id = null,$work_id = null)   
   {	   
	   $this->viewBuilder()->setLayout('layout');
	   $this->loadModel('ProjectWorkSubdetails');
	   $this->loadModel('Users');
	   $this->loadModel('Notifications');

        $user = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
        $this->loadModel('ProjectWorks');
			$Subdetail_count  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id'=>$work_id,'ProjectWorkSubdetails.work_type'=>2])->count();
         if($Subdetail_count > 0){
			 	$projectWork = $this->ProjectWorks->get($id, [
				'contain' => ['Departments', 'FinancialYears', 'ProjectStatuses', 'Districts', 'Divisions'],
			]);	 
		 }else{
			$projectWork = $this->ProjectWorks->get($id, [
				'contain' => ['Departments', 'FinancialYears', 'ProjectStatuses', 'Districts', 'Divisions'],
			]);
		 }
		
	     $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();

        if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>';  print_r($this->request->getData()); exit();    

                $attachment  = $this->request->getData('detailed_estimate_upload');
				 if ($attachment->getClientFilename() != '') {
					 $name    = $attachment->getClientFilename();
					 $type    = $attachment->getClientMediaType();
					 $size    = $attachment->getSize();
					 $tmpName = $attachment->getStream()->getMetadata('uri');
					 $error   = $attachment->getError();

					 if ($name != '' && $error == 0) {
						 $file                                     = $name;
						 $array                                    = explode('.', $file);
						 $fileExt                                  = $array[count($array) - 1];
						 $current_time                             = date('Y_m_d_H_i_s');
						 $newfile                                  = "detailed_estimate_" . $current_time . "." . $fileExt;
						 $tempFile                                 = $tmpName;
						 $targetPath                               = 'uploads/DetailedEstimates/';
						 $targetFile                               = $targetPath . $newfile;
						 //echo "<pre>";  print_r($newfile); exit();
						 //$technicalSanction->detailed_estimate_upload        = $newfile;
						 move_uploaded_file($tempFile, $targetFile);
					 }
				 }		   
		   
				$subdetailTable                     = $this->getTableLocator()->get('ProjectWorkSubdetails');
				$project                            = $subdetailTable->get($projectWorkSubdetail['id']); 
				$project->detailed_estimate_flag    = 1;  
				$project->detailed_estimate_upload  = $newfile;  
				$project->detailed_estimate_amount  = $this->request->getData('detailed_estimate_amount');
				$project->project_work_status_id    = 4;  
				$subdetailTable->save($project);
                    $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>4])->count();
				  // echo '<pre>';  print_r($notification_count); exit();
				   if($notification_count == 1){   
						$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>4])->first();

						$notificationTable                  = $this->getTableLocator()->get('Notifications');
						$notification1                       = $notificationTable->get($notification_id['id']); 
						$notification1->notification_seen	= 1;  
						$notification1->process_done	        = 1;  
						$notificationTable->save($notification1);
						
							if($notification_id['work_type'] == 1){						
								$recipient_user = $this->Users->find('all')->where(['Users.role_id'=>9,'Users.is_active'=>1])->first();
							}else if($notification_id['work_type'] == 2){	
								$recipient_user = $this->Users->find('all')->where(['Users.role_id'=>14,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
							}
							$recipient_user_id = $recipient_user['id'];
							$notification = $this->Notifications->newEmptyEntity();					
							$notification->forwarded_date                    = date('Y-m-d');
							$notification->forward_user_id                   = $user->id;
							$notification->recipient_user_id                 = $recipient_user_id;   
							if($notification_id['work_type'] == 1){	
							$notification->notification_type_id              = 5; 
							}else if($notification_id['work_type'] == 2){	
							$notification->notification_type_id              = 6; 
							$notification->work_type                         = 2;
							}
							$notification->project_work_id                   = $id;
							$notification->project_work_subdetail_id         = $work_id;
							$notification->created_by                        = $user->id;
							$notification->created_date                      = date('Y-m-d H:i:s');				
							$this->Notifications->save($notification);
				    	}				
				$this->Flash->success(__('The Detailed Estimate uploaded Successfully.'));
                 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'approvedlist']);			
			
		}
		
       $this->set(compact('projectWork','projectwiseDetailedEstimate', 'projectWorks', 'materials', 'units','detailed_estimates','id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','work_id','total_estimate'));
	   
   }
   
   public function projectdetailedestimateedit($id = null,$work_id = null,$estimate_id = null)
   {   
	    $this->viewBuilder()->setLayout('layout');
	    $this->loadModel('ProjectwiseDetailedEstimates');
        $user = $this->request->getAttribute('identity');
	    $this->loadModel('ProjectWorks');
        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions'],
        ]);

        $detailed_estimate = $this->ProjectwiseDetailedEstimates->find('all')->contain(['ProjectWorks','Materials','Units'])->where(['ProjectwiseDetailedEstimates.id' => $estimate_id])->first();
		
		$projectwiseDetailedEstimates = $this->ProjectwiseDetailedEstimates->get($estimate_id, [
                        'contain' => []
                    ]);   
      
        if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>';  print_r($this->request->getData()); exit();   
      
            $projectwiseDetailedEstimates->project_work_id           = $id;
		    $projectwiseDetailedEstimates->project_work_subdetail_id = $work_id;
            $projectwiseDetailedEstimates->material_id               = $this->request->getData('material_id');
            $projectwiseDetailedEstimates->quantity                  = $this->request->getData('quantity');
            $projectwiseDetailedEstimates->unit_id                   = $this->request->getData('unit_id');
            $projectwiseDetailedEstimates->approved_estimate         = $this->request->getData('approved_estimate');
            $projectwiseDetailedEstimates->total_cost                = $this->request->getData('total_cost');
            $projectwiseDetailedEstimates->submit_date               = date('Y-m-d');
            $projectwiseDetailedEstimates->created_by                = $user->id;
            $projectwiseDetailedEstimates->created_date              = date('Y-m-d H:i:s');
           //  echo"<pre>"; print_r($projectwiseDetailedEstimates);exit();
            if ($this->ProjectwiseDetailedEstimates->save($projectwiseDetailedEstimates)) {
                $this->Flash->success(__('The project Detailed Estimate has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectdetailedestimateadd/'.$id.'/'.$work_id]);
            }			
		}		
        $materials = $this->ProjectwiseDetailedEstimates->Materials->find('list', ['keyField' => 'id','valueField' => 'item_code'])->all();
        $units = $this->ProjectwiseDetailedEstimates->Units->find('list', ['limit' => 200])->all();
        $this->set(compact('projectWork','projectwiseDetailedEstimate', 'projectWorks', 'materials', 'units','detailed_estimate','sid'));
	   
   }
      
    public function ajaxgetdescription($id=null)
	{	   
	   	   $this->loadModel('Materials');		   
	       $materials = $this->Materials->find('all')->where(['Materials.id'=>$id])->first();
		   $description = $materials['item_description']; 		   
		echo $description;   
	   exit(); 
   }	
 
    public function technicalsanction($id = null,$work_id = null)
   {
    $this->viewBuilder()->setLayout('layout');  
    $this->loadModel('TechnicalSanctions');
    $this->loadModel('ProjectAdministrativeSanctions');
    $this->loadModel('ProjectFinancialSanctions');
    $this->loadModel('ProjectWorkSubdetails');

    $user = $this->request->getAttribute('identity');
    $technicalSanction = $this->TechnicalSanctions->newEmptyEntity();
    // $id = base64_decode($id);
    $this->loadModel('ProjectWorks');
    $projectWork = $this->ProjectWorks->get($id, [
        'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
    ]);

    $technicalcount = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
    $technical      = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
    $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
    $administrativesanction    = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
    $financialSanctionscount   = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
    $projectWorkSubdetail      = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();

	$financialSanctions      = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
    // echo "<pre>"; print_r($technicalcount); exit()	;
    if ($technicalcount == 0) {
     $technicalSanction = $this->TechnicalSanctions->newEmptyEntity();
      }

    if($this->request->is((['patch', 'post', 'put']))){
           //echo "<pre>"; print_r($this->request->getData()); exit()	;
		 if ($technicalcount > 0) {
			 //echo "<pre>"; print_r($this->request->getData('id')); exit()	;
			 $technicalSanction = $this->TechnicalSanctions->get($this->request->getData('id'), [
				 'contain' => [],
			 ]);             
		 }

         $attachment  = $this->request->getData('detailed_estimate_upload');
         if ($attachment->getClientFilename() != '') {
             $name    = $attachment->getClientFilename();
             $type    = $attachment->getClientMediaType();
             $size    = $attachment->getSize();
             $tmpName = $attachment->getStream()->getMetadata('uri');
             $error   = $attachment->getError();

             if ($name != '' && $error == 0) {
                 $file                                     = $name;
                 $array                                    = explode('.', $file);
                 $fileExt                                  = $array[count($array) - 1];
                 $current_time                             = date('Y_m_d_H_i_s');
                 $newfile                                  = "Technicalsaction_" . $current_time . "." . $fileExt;
                 $tempFile                                 = $tmpName;
                 $targetPath                               = 'uploads/technicalsanctions/';
                 $targetFile                               = $targetPath . $newfile;
                 $technicalSanction->detailed_estimate_upload        = $newfile;
                 move_uploaded_file($tempFile, $targetFile);

             }
         } else {
             $technicalSanction->detailed_estimate_upload               = $this->request->getData('detailed_estimate_upload1');
         }

             $technicalSanction->project_work_id           = $id;
             $technicalSanction->project_work_subdetail_id = $work_id;
		     $technicalSanction->sanction_no               = $this->request->getData('sanction_no');
             $technicalSanction->sanctioned_date            = date('Y-m-d', strtotime($this->request->getData('sanctioned_date')));
             $technicalSanction->description               = $this->request->getData('description');
             $technicalSanction->amount                    = $this->request->getData('amount');
             $technicalSanction->created_by                = $user->id;
             $technicalSanction->created_date              = date('Y-m-d H:i:s');
             //echo "<pre>" ; print_r($technicalSanction); exit();
            // $this->TechnicalSanctions->save($technicalSanction);
			 
             if($this->TechnicalSanctions->save($technicalSanction)){
				 
				    $subdetailTable               = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                      = $subdetailTable->get($work_id); 
					$project->technical_sanction_flag  = 1;  
					$project->project_work_status_id  = 7;  
					$subdetailTable->save($project); 
				 
				 
                 $this->Flash->success(__('The technical sanction has been saved.'));
                 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/2']);
               }else{
                 $this->Flash->error(__('The technical sanction could not be saved. Please, try again.'));
               }
       
      
    }
    $this->set(compact('technicalSanction', 'projectWork','technical','technicalcount','administrativesanctioncount','administrativesanction','financialSanctionscount','financialSanctions','projectWorkSubdetail','id','work_id'));
}   
   
    public function projectworkdetail($id = null)
   {	   
	    $this->viewBuilder()->setLayout('layout');
	   $this->loadModel('ProjectwiseDetailedEstimates');
	   $this->loadModel('ProjectAdministrativeSanctions');
	   $this->loadModel('ProjectWorkSubdetails');
	   $this->loadModel('ProjectFinancialSanctions');
	   $this->loadModel('ProjectFundRequestDetails');
	   $this->loadModel('Roles');

        $user = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id = $user->circle_id;
		$user_id     = $user->id;
        //$pid = base64_decode($id);
        $this->loadModel('ProjectWorks');
        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
        ]);
		
	   $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->where(['project_work_id' => $id])->count();
	   $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks','FundSources','SupervisionCharges'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id])->toArray();
        $financialSanctionscount    = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
       $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
       $fundrequestcount            = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.is_approved !='=>0])->count();
       $fundrequest                 = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.is_approved !='=>0])->first();
       $role   =   $this->Roles->find('list')->where(['Roles.is_active' => 1])->toArray();	
       $this->set(compact('role','projectWork','projectwiseDetailedEstimate', 'projectWorks', 'materials', 'units','detailed_estimates','id','administrativesanctioncount','administrativesanction','projectWorkSubdetails','financialSanctionscount','financialSanctions','role_id','division_id','circle_id','user_id','fundrequestcount','fundrequest'));
	   
   }
     
    public function approval($id=null,$work_id=null)
    {				 
	    $this->loadModel('ProjectWorkSubdetails');
        $this->request->allowMethod(['post', 'delete']);
        $work                    = $this->ProjectWorkSubdetails->get($work_id);
        $work->is_approved       = 1;
        $work->ts_approved_date  = date('Y-m-d');
        $work->project_work_status_id  = 8;
        if ($this->ProjectWorkSubdetails->save($work)) {
			 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/2']);
            $this->Flash->success(__('The Work  has been Approved.'));
        } else {
			 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/2']);

            $this->Flash->error(__('The Work could not be Approved. Please, try again.'));
        }
		
		exit();
    }
		
	 public function tenderdetails($id = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->loadModel('ProjectWorks');
        $this->loadModel('ProjectAdministrativeSanctions');
        $this->loadModel('ProjectWorkSubdetails');
        $this->loadModel('ProjectFinancialSanctions');
        $this->loadModel('ProjectTenderDetails');
        $this->loadModel('ContractorDetails');
        $this->loadModel('TechnicalSanctions');
        $this->loadModel('TenderTypes');
        $this->loadModel('TenderStatuses');
        $this->loadModel('ProjectTenderStatusDetails');
        $this->loadModel('Notifications');
        $this->loadModel('Users');
		
		$projectWorkSubdetailcount   = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.work_type'=>1])->count();
		if($projectWorkSubdetailcount > 0){
			$projectWork = $this->ProjectWorks->get($id, [
				'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions', 'SchemeTypes'],
			]);
		}else{
				 $projectWork = $this->ProjectWorks->get($id, [
				'contain' => ['Departments', 'FinancialYears', 'ProjectStatuses', 'Districts', 'Divisions'],
			]);
		}		
        $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
        $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
        $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
        $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
        $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();

        $tenders      = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks', 'ProjectWorkSubdetails', 'TenderTypes'])->where(['ProjectTenderDetails.project_work_id' => $id, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id,'ProjectTenderDetails.is_active'=>1])->toArray();
      $contractor_detailscount = array(); 
      foreach($tenders as $tender){
		  
		  $contractor_detailscount[$tender['id']]        = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_tender_detail_id' => $tender['id'],'ContractorDetails.is_active'=>1])->count(); //tender key

	  }

	   $tender_count = $this->ProjectTenderDetails->find('all')->where(['ProjectTenderDetails.project_work_id' => $id, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id,'ProjectTenderDetails.is_active'=>1])->count();
		//echo "<pre>"; print_r($projectWorkSubdetail); exit();
		$technicalcount = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->count();

        if($tender_count == 0){
           $technical      = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();
           $sanctioned_amount = $technical['amount'];
        }else{
			   
			 $technical      = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();
 
			   $connection               = ConnectionManager::get('default');
				$query                    =  "SELECT sum(tender.tender_amount) as tot_tender_amount
											 from project_tender_details as tender 
											 where tender.project_work_id = '".$id."' AND tender.project_work_subdetail_id = '".$work_id."' and tender.is_active = 1";
			   $tender           = $connection->execute($query)->fetchAll('assoc');
			   
			   $tot_tender_amount    =  $tender[0]['tot_tender_amount'];
			   
			   $sanctioned_amount = $technical['amount'] - $tot_tender_amount;	
			
		}
        $contractor_detail_count   = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->count();
        //print_r($contractor_detail_count); exit();
		//$contractor_details        = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->first(); //tender key
        $project_tender_statuses   = $this->ProjectTenderStatusDetails->find('all')->contain(['TenderStatuses'])->where(['ProjectTenderStatusDetails.project_work_id' => $id, 'ProjectTenderStatusDetails.project_work_subdetail_id' => $work_id])->toArray(); //tender key
        $tender_statuses_last      = $this->ProjectTenderStatusDetails->find('all')->contain(['TenderStatuses'])->where(['ProjectTenderStatusDetails.project_work_id' => $id, 'ProjectTenderStatusDetails.project_work_subdetail_id' => $work_id])->last(); //tender key
        $project_tender_statusescount   = $this->ProjectTenderStatusDetails->find('all')->where(['ProjectTenderStatusDetails.project_work_id' => $id, 'ProjectTenderStatusDetails.project_work_subdetail_id' => $work_id])->count(); //tender key

       if($project_tender_statusescount == 0){
		$tenderStatus = $this->TenderStatuses->find('list')->where(['TenderStatuses.is_active'=>1])->toArray();  
       }else if($project_tender_statusescount >  0){
	     $entered_id   = $this->ProjectTenderStatusDetails->find('list',['keyField' => 'tender_status_id','valueField' =>'tender_status_id'])->where(['ProjectTenderStatusDetails.project_work_id'=>$id,'ProjectTenderStatusDetails.project_work_subdetail_id'=>$work_id])->toArray();
         $tenderStatus = $this->TenderStatuses->find('list',  ['keyField' => 'id', 'valueField' => 'name'])->where(['TenderStatuses.id NOT IN'=>$entered_id,'TenderStatuses.is_active'=>1])->all();  
	   }    

        if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>'; print_r($this->request->getData());  exit();
            $completed_flag = $this->request->getData('completed_flag');
            $tender_status  = $this->request->getData('tender_status_id');			
			
			if($tender_status != 4  && $completed_flag == '' &&  $this->request->getData('tender_status_id') != ''){
				  $projectTenderStatusDetail = $this->ProjectTenderStatusDetails->newEmptyEntity();
				  $projectTenderStatusDetail->project_work_id           = $id;
				  $projectTenderStatusDetail->project_work_subdetail_id = $work_id;
				  $projectTenderStatusDetail->tender_status_id          = $this->request->getData('tender_status_id');
				  $projectTenderStatusDetail->remarks                   = $this->request->getData('tender_status_remarks');
				  $projectTenderStatusDetail->submit_date               = date('Y-m-d');
				  $this->ProjectTenderStatusDetails->save($projectTenderStatusDetail);
                 $this->Flash->success(__('The project Tender status has been saved.'));
                 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/'.$id.'/'.$work_id]);				  
			}else{
			

            if ($completed_flag == 1) {				
				$edit_flag =  $this->request->getData('edit_flag');
				
			   if($edit_flag == 1){
					$subdetailTable                   = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                          = $subdetailTable->get($work_id);
					$project->tender_detail_flag      = 1;
					$subdetailTable->save($project);
					
					   $this->Flash->success(__('The project Tender has been updated.'));
                        return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/15']);
					
				 }else{             

			    $subdetailTable                   = $this->getTableLocator()->get('ProjectWorkSubdetails');
                $project                          = $subdetailTable->get($work_id);
                $project->tender_detail_flag      = 1;
                $project->project_work_status_id  = 9;
                $subdetailTable->save($project);
				
				  $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>8])->count();
				  // echo '<pre>';  print_r($notification_count); exit();
				   if($notification_count == 1){   
						$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>8])->first();
						$notificationTable                   = $this->getTableLocator()->get('Notifications');
						$notification1                       = $notificationTable->get($notification_id['id']); 
						$notification1->notification_seen	 = 1;  
						$notification1->process_done	     = 1;  
						$notificationTable->save($notification1);
						
						    $recipient_user = $this->Users->find('all')->where(['Users.role_id'=>13,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
							$recipient_user_id = $recipient_user['id'];
							$notification = $this->Notifications->newEmptyEntity();					
							$notification->forwarded_date                    = date('Y-m-d');
							$notification->forward_user_id                   = $user->id;
							$notification->recipient_user_id                 = $recipient_user_id; 
							$notification->notification_type_id              = 9; 
							$notification->project_work_id                   = $id;
							$notification->project_work_subdetail_id         = $work_id;
							if($notification_id['work_type'] == 2){	
							   $notification->work_type                      = 2;
							}
							$notification->created_by                        = $user->id;
							$notification->created_date                      = date('Y-m-d H:i:s');				
							$this->Notifications->save($notification);
				    	}
						$this->Flash->success(__('The project Tender has been saved.'));
                        return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/3']);
				}
                
            } else {
				 if($this->request->getData('tender_status_id') != ''){
				  $projectTenderStatusDetail = $this->ProjectTenderStatusDetails->newEmptyEntity();
				  $projectTenderStatusDetail->project_work_id           = $id;
				  $projectTenderStatusDetail->project_work_subdetail_id = $work_id;
				  $projectTenderStatusDetail->tender_status_id          = $this->request->getData('tender_status_id');
				  $projectTenderStatusDetail->remarks                   = $this->request->getData('tender_status_remarks');
				  $projectTenderStatusDetail->submit_date               = date('Y-m-d');
				  $this->ProjectTenderStatusDetails->save($projectTenderStatusDetail);
				 } 
				if($this->request->getData('tender_amount') > 0 && $this->request->getData('tender_type_id') != ''){ 
                 $projectTenderDetail = $this->ProjectTenderDetails->newEmptyEntity();
                $projectTenderDetail->project_work_id            = $id;
                $projectTenderDetail->project_work_subdetail_id  = $work_id;
                $projectTenderDetail->tender_type_id              = $this->request->getData('tender_type_id');

                if ($this->request->getData('tender_type_id') == 1) {
                    $projectTenderDetail->etenderID  = $this->request->getData('etenderID');
                } else if ($this->request->getData('tender_type_id') == 2) {
                    $projectTenderDetail->tender_no =   $this->request->getData('tender_no');
                }
                $projectTenderDetail->tender_date                =  date('Y-m-d', strtotime($this->request->getData('tender_date')));
                $projectTenderDetail->tender_amount              = $this->request->getData('tender_amount');
                $projectTenderDetail->created_by                 =  $user->id;
                $projectTenderDetail->created_date               =  date('Y-m-d H:i:s');

                $copy               = $this->request->getData('tender_copy');

                if ($copy->getClientFilename() != '') {

                    $name    = $copy->getClientFilename();
                    $type    = $copy->getClientMediaType();
                    $size    = $copy->getSize();
                    $tmpName = $copy->getStream()->getMetadata('uri');
                    $error   = $copy->getError();

                    if ($name != '' && $error == 0) {
                        $file                                   =  $name;
                        $array                                  =  explode('.', $file);
                        $fileExt                                =  $array[count($array) - 1];
                        $current_time                           =  date('Y_m_d_H_i_s');
                        $newfile                                =  "tender_copy_" . $current_time . "." . $fileExt;
                        $tempFile                               =  $tmpName;
                        $targetPath                             =  'uploads/ProjectTender/';
                        $targetFile                             =  $targetPath . $newfile;
                        $projectTenderDetail->tender_copy       =  $newfile;
                        move_uploaded_file($tempFile, $targetFile);
                    }
                }
                if ($this->ProjectTenderDetails->save($projectTenderDetail)) {
                    $this->Flash->success(__('The Tender Details has been saved.'));
                    return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/' . $id . '/' . $work_id]);
                } else {
                    $this->Flash->error(__('The Tender Details could not be saved. Please, try again.'));  
                }}
              }
            }
         }
         $tender_type = $this->ProjectTenderDetails->TenderTypes->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['TenderTypes.is_active' => 1])->toArray();
        $this->set(compact('contractor_detailscount','tender_statuses_last','sanctioned_amount','tender_count','project_tender_statusescount','project_tender_statuses','tenderStatus','projectTenderDetail', 'tender_type', 'projectWork', 'tenders', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'contractor_detail_count', 'contractor_details', 'technicalcount', 'technical'));
    }

    public function tenderdetailsedit($id = null, $work_id = null, $tender_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');

        $this->loadModel('ProjectWorks');
        $this->loadModel('ProjectAdministrativeSanctions');
        $this->loadModel('ProjectWorkSubdetails');
        $this->loadModel('ProjectFinancialSanctions');
        $this->loadModel('ProjectTenderDetails');
        $this->loadModel('TechnicalSanctions');

        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions', 'SchemeTypes'],
        ]);

        $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
        $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
        $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
        $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
        $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
        $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->count();
        $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();


        $projectTenderDetail = $this->ProjectTenderDetails->get($tender_id, [
            'contain' => ['TenderTypes'],
        ]);
        // echo '<pre>';
        // print_r($projectTenderDetail);
        // exit();
        if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>'; print_r($this->request->getData()); exit();
            $projectTenderDetail->project_work_id            = $id;
            $projectTenderDetail->project_work_subdetail_id  = $work_id;
            $projectTenderDetail->tender_type_id              = $this->request->getData('tender_type_id');

            if ($this->request->getData('tender_type_id') == 1) {
                $projectTenderDetail->etenderID  = $this->request->getData('etenderID');
            } else if ($this->request->getData('tender_type_id') == 2) {
                $projectTenderDetail->tender_no =   $this->request->getData('tender_no');
            }
            $projectTenderDetail->tender_date                =  date('Y-m-d', strtotime($this->request->getData('tender_date')));
            $projectTenderDetail->tender_amount              = $this->request->getData('tender_amount');
            $projectTenderDetail->modified_by                =  $user->id;
            $projectTenderDetail->modified_date              =  date('Y-m-d H:i:s');

            $copy               = $this->request->getData('tender_copy');

            if ($copy->getClientFilename() != '') {

                $name    = $copy->getClientFilename();
                $type    = $copy->getClientMediaType();
                $size    = $copy->getSize();
                $tmpName = $copy->getStream()->getMetadata('uri');
                $error   = $copy->getError();

                if ($name != '' && $error == 0) {

                    $file                                   = $name;
                    $array                                  = explode('.', $file);
                    $fileExt                                = $array[count($array) - 1];
                    $current_time                           = date('Y_m_d');
                    $newfile                                = "tender_copy_" . $current_time . "." . $fileExt;
                    $tempFile                               = $tmpName;
                    $targetPath                             = 'uploads/ProjectTender/';
                    $targetFile                             = $targetPath . $newfile;
                    $projectTenderDetail->tender_copy       = $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            } else {
                $projectTenderDetail->tender_copy              =  $this->request->getData('tender_copy1');
            }
            
            if ($this->ProjectTenderDetails->save($projectTenderDetail)) {
                $this->Flash->success(__('The Tender Details has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/' . $id . '/' . $work_id]);
            }
            $this->Flash->error(__('The Tender Details could not be saved. Please, try again.'));
        }
        $tender_type = $this->ProjectTenderDetails->TenderTypes->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['TenderTypes.is_active' => 1])->toArray();

        $this->set(compact('tender_type', 'projectTenderDetail', 'projectWork', 'tenders', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'technicalcount', 'technical'));
    }

    public function addcontractor($id = null, $work_id = null, $tender = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $this->loadModel('ProjectWorks');
        $this->loadModel('ContractorDetails');
        $this->loadModel('ProjectAdministrativeSanctions');
        $this->loadModel('ProjectWorkSubdetails');
        $this->loadModel('ProjectFinancialSanctions');
        $this->loadModel('ProjectTenderDetails');
        $this->loadModel('TechnicalSanctions');
        $this->loadModel('Contractors');
        $this->loadModel('ProjectwiseAbstractDetails');
        $this->loadModel('ProjectwiseAbstractSubdetails');
        $this->loadModel('ProjectwiseContractorRateDetails');

        $user = $this->request->getAttribute('identity');
		
		$projectWorkSubdetailcount   = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.work_type'=>1])->count();
		if($projectWorkSubdetailcount > 0){
			$projectWork = $this->ProjectWorks->get($id, [
				'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions', 'SchemeTypes'],
			]);
		
		}else{		
			$projectWork = $this->ProjectWorks->get($id, [
               'contain' => ['Departments', 'FinancialYears', 'ProjectStatuses', 'Districts', 'Divisions'],
            ]);		
		} 
        $projectTenderDetail = $this->ProjectTenderDetails->find('all')->contain(['TenderTypes'])->where(['ProjectTenderDetails.id' => $tender,'ProjectTenderDetails.is_active'=>1])->first();
     	$administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
        $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
        $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
        $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
        $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
        $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->count();
        $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();
         
		  $abstractcount = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
	 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
	 if($abstractcount > 0){
	 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['NewBuildingItems','Units'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
	  } 
         
        $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks','Contractors'])->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.project_tender_detail_id'=>$tender,'ContractorDetails.is_active'=>1])->first(); //tender key
        $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.project_tender_detail_id'=>$tender,'ContractorDetails.is_active'=>1])->count(); //tender key count

        if ($contractor_detail_count == 0) {
            $contractorDetail = $this->ContractorDetails->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) { //echo "<pre>"; print_r($this->request->getData()); exit();
                   if ($contractor_detail_count > 0) {
                $contractorDetail = $this->ContractorDetails->get($this->request->getData('id'), [
                    'contain' => [],
                ]);
            }

            $contractorDetail->project_work_id               = $id;
            $contractorDetail->project_work_subdetail_id     = $work_id;
            $contractorDetail->project_tender_detail_id      = $tender;
            $contractorDetail->contractor_id                 = $this->request->getData('contractor_id');
            $contractorDetail->agreement_no                  = $this->request->getData('agreement_no');
            $contractorDetail->agreement_amount              = $this->request->getData('agreement_amount');
            $contractorDetail->work_order_refno              = $this->request->getData('work_order_refno');
            //$contractorDetail->agreement_fromdate            =  date('Y-m-d', strtotime($this->request->getData('agreement_fromdate')));
            //$contractorDetail->agreement_todate              =  date('Y-m-d', strtotime($this->request->getData('agreement_todate')));
            $contractorDetail->agreement_period              =  $this->request->getData('agreement_period');
            $contractorDetail->agreement_date                =  date('Y-m-d', strtotime($this->request->getData('agreement_date')));
            $contractorDetail->perc_deduction                = $this->request->getData('perc_deduction');
            $contractorDetail->created_by                    =  $user->id;
            $contractorDetail->created_date                  =  date('Y-m-d H:i:s');

            $copy               = $this->request->getData('agreement_copy');
            if ($copy->getClientFilename() != '') {
                $name    = $copy->getClientFilename();
                $type    = $copy->getClientMediaType();
                $size    = $copy->getSize();
                $tmpName = $copy->getStream()->getMetadata('uri');
                $error   = $copy->getError();

                if ($name != '' && $error == 0) {

                    $file                                   = $name;
                    $array                                  = explode('.', $file);
                    $fileExt                                = $array[count($array) - 1];
                    $current_time                           = date('Y_m_d');
                    $newfile                                = "agreement_copy_" . $current_time . "." . $fileExt;
                    $tempFile                               = $tmpName;
                    $targetPath                             = 'uploads/ProjectTender/';
                    $targetFile                             = $targetPath . $newfile;
                    $contractorDetail->agreement_copy       = $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            } else {
                $contractorDetail->agreement_copy              =  $this->request->getData('agreement_copy1');
            }

            $copy1               = $this->request->getData('work_order_copy');         
            if ($copy1->getClientFilename() != '') {

                $name    = $copy1->getClientFilename();
                $type    = $copy1->getClientMediaType();
                $size    = $copy1->getSize();
                $tmpName = $copy1->getStream()->getMetadata('uri');
                $error   = $copy1->getError();

                if ($name != '' && $error == 0) {

                    $file                                   = $name;
                    $array                                  = explode('.', $file);
                    $fileExt                                = $array[count($array) - 1];
                    $current_time                           = date('Y_m_d');
                    $newfile                                = "work_order_copy_" . $current_time . "." . $fileExt;
                    $tempFile                               = $tmpName;
                    $targetPath                             = 'uploads/WorkOrders/';
                    $targetFile                             = $targetPath . $newfile;
                    $contractorDetail->work_order_copy       = $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            } else {
                $contractorDetail->work_order_copy              =  $this->request->getData('work_order_copy1');
            }
            //echo '<pre>'; print_r($contractorDetail); exit();
            if ($this->ContractorDetails->save($contractorDetail)) {
				$insert_id = $contractorDetail->id;
					  
				/*foreach ($this->request->getData('workdetail') as $key => $answer) {
					$abstract = $this->ProjectwiseAbstractSubdetails->find('all')->where(['ProjectwiseAbstractSubdetails.id'=>$answer['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->first();

					$contractor_rate = $this->ProjectwiseContractorRateDetails->newEmptyEntity();
					$contractor_rate->project_work_id              = $id;
					$contractor_rate->project_work_subdetail_id    = $work_id;
					$contractor_rate->project_tender_detail_id     = $tender;
					$contractor_rate->contractor_detail_id         = $insert_id;
					$contractor_rate->building_item_id             = ($abstract['building_item_id'])?$abstract['building_item_id']:0;
					$contractor_rate->item_code                    = ($abstract['item_code'])?$abstract['item_code']:0;				
					$contractor_rate->item_description             = $abstract['item_description'];
					$contractor_rate->quantity                     = $abstract['quantity'];
					$contractor_rate->unit_id                      = $abstract['unit_id'];
					$contractor_rate->contractor_rate              = $answer['rate'];
					$contractor_rate->final_amount                 = ($answer['amount'] != 0)?$answer['amount']:'';
					$contractor_rate->created_by                   = $user->id;
					$contractor_rate->created_date                 = date('Y-m-d H:i:s');				
					//echo "<pre>"; print_r($abstractsubdetail); exit();
					if($this->ProjectwiseContractorRateDetails->save($contractor_rate)){
						$ProjectWorksTable          = $this->getTableLocator()->get('ProjectwiseAbstractSubdetails');
						$project                    = $ProjectWorksTable->get($answer['id']); 
						$project->contractor_rate   = $answer['rate'];
						$project->final_amount      = $answer['amount'];
						$ProjectWorksTable->save($project);						
					}
				}*/
					
                $this->Flash->success(__('The Contractor Details has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/' . $id . '/' . $work_id]);
            }
            $this->Flash->error(__('The Contractor Details could not be saved. Please, try again.'));
        }
        $contractor_type = $this->ContractorDetails->Contractors->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Contractors.is_active' => 1])->toArray();

        $this->set(compact('abstractcount','abstract_subdetails','contractor_type', 'projectTenderDetail', 'contractor_details', 'contractor_detail_count', 'projectWork', 'contractorDetail', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'technicalcount', 'technical'));
    }
		
	public function sitehandover($id = null,$work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->loadModel('ProjectWorks');
        $this->loadModel('ProjectAdministrativeSanctions');
        $this->loadModel('ProjectWorkSubdetails');
        $this->loadModel('ProjectFinancialSanctions');
        $this->loadModel('ProjectTenderDetails');
        $this->loadModel('ContractorDetails');
        $this->loadModel('TechnicalSanctions');
        $this->loadModel('Notifications');
		
		$projectWorkSubdetailcount   = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.work_type'=>1])->count();
		if($projectWorkSubdetailcount > 0){

         $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears','BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
         ]);
		
		}else {
			 $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears','ProjectStatuses', 'Districts', 'Divisions'],
        ]);
			
		}		
	   $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
	   $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	   $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles','Districts','ProjectWorkStatuses'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
  	   $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
       $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
       $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
       $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
       $tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id,'ProjectTenderDetails.is_active'=>1])->toArray(); 
       $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id'=>$id,'ContractorDetails.project_work_subdetail_id'=> $work_id,'ContractorDetails.is_active'=>1])->count(); 
       $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->first(); //tender key
  
     if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>'; print_r($this->request->getData()); exit();
		
		  if($this->request->getData('site_handover_date') != ''){			  
				$subdetailTable                  = $this->getTableLocator()->get('ProjectWorkSubdetails');
				$project                         = $subdetailTable->get($work_id); 
				$project->site_handover_flag     = 1;  
				$project->site_handover_date     = date('Y-m-d',strtotime($this->request->getData('site_handover_date')));  
				$project->tentative_completion_date     = date('Y-m-d',strtotime($this->request->getData('tentative_completion_date')));  
				$project->site_handover_remarks  = $this->request->getData('site_handover_remarks'); 
				$project->project_work_status_id       = 11;						
				$subdetailTable->save($project); 
				 $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>10])->count();
			  // echo '<pre>';  print_r($notification_count); exit();
			   if($notification_count == 1){   
					$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>10])->first();
					$notificationTable                  = $this->getTableLocator()->get('Notifications');
					$notification1                       = $notificationTable->get($notification_id['id']); 
					$notification1->notification_seen	= 1;  
					$notification1->process_done	        = 1;  
					$notificationTable->save($notification1);						
				}
				
			   $this->Flash->success(__('The project Site H/O Details has been saved.'));
			  return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/5']);

		    }
        }
    
        $this->set(compact('projectTenderDetail', 'projectWork', 'tenders', 'id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','financialSanctionscount','financialSanctions','work_id','contractor_detail_count','contractor_details','technicalcount','technical'));
    }

    public function workview($id = null,$work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->loadModel('ProjectWorks');
        $this->loadModel('ProjectAdministrativeSanctions');
        $this->loadModel('ProjectWorkSubdetails');
        $this->loadModel('ProjectFinancialSanctions');
        $this->loadModel('ProjectTenderDetails');
        $this->loadModel('ContractorDetails');
        $this->loadModel('TechnicalSanctions');
        $this->loadModel('ProjectFundRequestDetails');
        $this->loadModel('ProjectTimelineDetails');
        $this->loadModel('ProjectMonitoringDetails');
        $this->loadModel('ProjectMonitoringPhotosUploads');
        //$this->loadModel('ProjectwiseDetailedEstimates');
        $this->loadModel('DetailedEstimateApprovalStages');
        $this->loadModel('PlanningPermissionDetails');
        $this->loadModel('UtilizationCertificates');
        $this->loadModel('ProjectHandoverDetails');
        $this->loadModel('ProjectwiseCompletionReports');
        $this->loadModel('ProjectwiseAbstractDetails');
        $this->loadModel('ProjectwiseAbstractSubdetails');
        $this->loadModel('ProjectPlacedToBoardDetails');
        $this->loadModel('ProjectwiseDevelopmentWorks');
        $this->loadModel('ProjectwiseTimeExtensionDetails');  
        $this->loadModel('ProjectTenderStatusDetails');
		
        $projectWorkSubdetailcount  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.work_type'=>1])->count();
		if($projectWorkSubdetailcount > 0){	
			$projectWork = $this->ProjectWorks->get($id, [
				'contain' => ['Departments', 'FinancialYears','BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes','DepartmentwiseWorkTypes'],
			]);  
		}else{
			$projectWork = $this->ProjectWorks->get($id, [
				'contain' => ['Departments', 'FinancialYears','ProjectStatuses','Districts','Divisions','DepartmentwiseWorkTypes'],
			]);
		}		
		$DevelopmentWorkscount  = $this->ProjectwiseDevelopmentWorks->find('all')->where(['ProjectwiseDevelopmentWorks.project_work_id'=>$id,'ProjectwiseDevelopmentWorks.project_work_subdetail_id'=>$work_id])->count();
		$DevelopmentWorkslists  = $this->ProjectwiseDevelopmentWorks->find('all')->where(['ProjectwiseDevelopmentWorks.project_work_id'=>$id,'ProjectwiseDevelopmentWorks.project_work_subdetail_id'=>$work_id])->toArray();

        $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
        $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks','FundSources','SupervisionCharges'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->toArray();

	    $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
         $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();

	    $projectWorkSubdetailscount    = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.is_active'=>1])->count();
	    $projectWorkSubdetails         = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles','ProjectWorkStatuses','Districts','ProjectWorks'])->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.is_active'=>1])->toArray();
	   
	     //$detailed_estimates          = $this->ProjectwiseDetailedEstimates->find('all')->contain(['ProjectWorks','Materials','Units'])->where(['ProjectwiseDetailedEstimates.project_work_id' => $id,'ProjectwiseDetailedEstimates.project_work_subdetail_id'=>$work_id])->toArray();
         //$detailed_estimates_count    = $this->ProjectwiseDetailedEstimates->find('all')->where(['ProjectwiseDetailedEstimates.project_work_id' => $id,'ProjectwiseDetailedEstimates.project_work_subdetail_id'=>$work_id])->count();
       	 $abstractcount = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
		 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
		 if($abstractcount > 0){
		 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['NewBuildingItems','Units'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
		 }   
	   
	    $detailed_approval_stages_count  = $this->DetailedEstimateApprovalStages->find('all')->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->count();
        $detailed_approval_stages        = $this->DetailedEstimateApprovalStages->find('all')->contain(['ApprovalStatuses'])->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->toArray();
		   
	    $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
        $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
       
        $project_tender_statuses        = $this->ProjectTenderStatusDetails->find('all')->contain(['TenderStatuses'])->where(['ProjectTenderStatusDetails.project_work_id' => $id, 'ProjectTenderStatusDetails.project_work_subdetail_id' => $work_id])->toArray(); 
        $project_tender_statusescount   = $this->ProjectTenderStatusDetails->find('all')->where(['ProjectTenderStatusDetails.project_work_id' => $id, 'ProjectTenderStatusDetails.project_work_subdetail_id' => $work_id])->count();

	    $tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails','TenderTypes'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id,'ProjectTenderDetails.is_active'=>1])->toArray(); 
        $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id'=>$id,'ContractorDetails.project_work_subdetail_id'=> $work_id,'ContractorDetails.is_active'=>1])->count(); 
        $contractor_details          = $this->ContractorDetails->find('all')->contain(['Contractors'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->first(); //tender key
	   
	   // print_r($contractor_details);  exit();
	   
	    $planningcount       = $this->PlanningPermissionDetails->find('all')->where(['PlanningPermissionDetails.project_work_id' => $id,'PlanningPermissionDetails.project_work_subdetail_id'=>$work_id])->count();
	    $planningdetail      = $this->PlanningPermissionDetails->find('all')->contain(['ProjectWorks'])->where(['PlanningPermissionDetails.project_work_id' => $id,'PlanningPermissionDetails.project_work_subdetail_id'=>$work_id])->toArray();

	    $requestcount                = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->count();
        $fundrequests                = $this->ProjectFundRequestDetails->find('all')->contain(['ProjectWorks','ProjectFundRequests'])->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->toArray();
 
   	    $timelineDetailscount        = $this->ProjectTimelineDetails->find('all')->where(['ProjectTimelineDetails.project_work_id' => $id, 'ProjectTimelineDetails.project_work_subdetail_id' => $work_id])->count();
        $timelineDetails             = $this->ProjectTimelineDetails->find('all')->where(['ProjectTimelineDetails.project_work_id' => $id, 'ProjectTimelineDetails.project_work_subdetail_id' => $work_id])->toArray();
		$utilizationCertificatecount = $this->UtilizationCertificates->find('all')->where(['UtilizationCertificates.project_work_id'=>$id,'UtilizationCertificates.project_work_subdetail_id'=>$work_id])->count();
		$utilizationCertificate      = $this->UtilizationCertificates->find('all')->where(['UtilizationCertificates.project_work_id'=>$id,'UtilizationCertificates.project_work_subdetail_id'=>$work_id])->toArray();

	    $handovercount      = $this->ProjectHandoverDetails->find('all')->where(['ProjectHandoverDetails.project_work_id'=>$id,'ProjectHandoverDetails.project_work_subdetail_id'=>$work_id])->count();
	    $handoverdetails    = $this->ProjectHandoverDetails->find('all')->where(['ProjectHandoverDetails.project_work_id'=>$id,'ProjectHandoverDetails.project_work_subdetail_id'=>$work_id])->toArray();	
		
		$completioncount    = $this->ProjectwiseCompletionReports->find('all')->where(['ProjectwiseCompletionReports.project_work_id'=>$id,'ProjectwiseCompletionReports.project_work_subdetail_id'=>$work_id])->count();
		$completiondetails  = $this->ProjectwiseCompletionReports->find('all')->where(['ProjectwiseCompletionReports.project_work_id'=>$id,'ProjectwiseCompletionReports.project_work_subdetail_id'=>$work_id])->toArray();
		 
		$placedtoboardcount    = $this->ProjectPlacedToBoardDetails->find('all')->where(['ProjectPlacedToBoardDetails.project_work_id'=>$id,'ProjectPlacedToBoardDetails.project_work_subdetail_id'=>$work_id])->count();
		$placedtoboarddetails  = $this->ProjectPlacedToBoardDetails->find('all')->where(['ProjectPlacedToBoardDetails.project_work_id'=>$id,'ProjectPlacedToBoardDetails.project_work_subdetail_id'=>$work_id])->toArray();
			
        $monitoringDetailscount = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->count();
        $monitorings            = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages','FinancialPercentages'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->toArray();
		$photo_uploads = array();
		foreach($monitorings as $monitoring){
		 $photo_uploads[$monitoring['id']]      = $this->ProjectMonitoringPhotosUploads->find('all')->where(['ProjectMonitoringPhotosUploads.project_monitoring_detail_id' => $monitoring['id']])->toArray();
		}		
		$projectwiseTimeExtensionDetailcount = $this->ProjectwiseTimeExtensionDetails->find('all')->where(['ProjectwiseTimeExtensionDetails.project_work_id' => $id, 'ProjectwiseTimeExtensionDetails.project_work_subdetail_id' => $work_id])->count();
        $projectwiseTimeExtensionDetailists  = $this->ProjectwiseTimeExtensionDetails->find('all')->where(['ProjectwiseTimeExtensionDetails.project_work_id' => $id, 'ProjectwiseTimeExtensionDetails.project_work_subdetail_id' => $work_id])->toArray();

 	  $this->set(compact('project_tender_statusescount','project_tender_statuses','projectwiseTimeExtensionDetailcount','projectwiseTimeExtensionDetailists','DevelopmentWorkscount','DevelopmentWorkslists','placedtoboardcount','placedtoboarddetails','abstractcount','abstract_subdetails','completioncount','completiondetails','handovercount','handoverdetails','utilizationCertificatecount','utilizationCertificate','projectWorkSubdetailscount','detailed_approval_stages_count','detailed_approval_stages','projectTenderDetail', 'projectWork', 'tenders', 'id','administrativesanctioncount','administrativesanction','projectWorkSubdetails','financialSanctionscount','financialSanctions','work_id','contractor_detail_count','contractor_details','technicalcount','technical','fundrequests','requestcount','timelineDetailscount','timelineDetails','monitoringDetailscount','monitorings','photo_uploads','detailed_estimates','detailed_estimates_count','planningcount','planningdetail'));
    }
	
    public function projecttimeline($id=null,$work_id=null)
    {
       $this->viewBuilder()->setLayout('layout');
       $user = $this->request->getAttribute('identity');
       $this->loadModel('ProjectWorks');
       $this->loadModel('ProjectTimelineDetails');
       $this->loadModel('ProjectFinancialSanctions');
	   $this->loadModel('ProjectAdministrativeSanctions');
	   $this->loadModel('ProjectWorkSubdetails');
	   $this->loadModel('TechnicalSanctions');
	   $this->loadModel('ProjectTenderDetails');
	   $this->loadModel('ContractorDetails');
	   $this->loadModel('WorkStages');

       $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
        ]);
		
	   $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
	   $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	   $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
  	   $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
       $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
      
	   $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
       $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
       $tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id,'ProjectTenderDetails.is_active'=>1])->toArray(); 
       $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id'=>$id,'ContractorDetails.project_work_subdetail_id'=> $work_id,'ContractorDetails.is_active'=>1])->count(); 
       $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->first(); //tender key
    
        if ($this->request->is(['patch', 'post', 'put'])) {  //echo"<pre>"; print_r($this->request->getData());   exit();         

            foreach ($this->request->getData('timeline') as $key => $value) {
                
                if ($value['id'] != '') {
                    $projectTimelineDetail = $this->ProjectTimelineDetails->get($value['id'], [
                        'contain' => [],
                    ]);

                }else{
                    $projectTimelineDetail = $this->ProjectTimelineDetails->newEmptyEntity();
                }
                $projectTimelineDetail->project_work_id                   =  $id;
                $projectTimelineDetail->project_work_subdetail_id         =  $work_id;
                $projectTimelineDetail->work_stage_id                     =  $value['work_stage_id'];
                $projectTimelineDetail->tentative_completion_date         =  date('Y-m-d', strtotime($value['tentative_completion_date']));
                $projectTimelineDetail->created_by                        =  $user->id;
                $projectTimelineDetail->created_date                      =  date('Y-m-d:h:m:s');
                if ($ProjectTimelinecount > 0) {
                    $projectTimelineDetail->modified_by                   =  $user->id;
                    $projectTimelineDetail->modified_date                 =  date('Y-m-d:h:m:s');
                }
                $this->ProjectTimelineDetails->save($projectTimelineDetail);
            }

            if ($this->ProjectTimelineDetails->save($projectTimelineDetail)) {
                $this->Flash->success(__('The project timeline detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project timeline detail could not be saved. Please, try again.'));
        }
         $workStages = $this->WorkStages->find('list')->all();
        $this->set(compact('workStages','projectTenderDetail', 'projectWork', 'tenders', 'id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','financialSanctionscount','financialSanctions','work_id','contractor_detail_count','contractor_details','technicalcount','technical'));

    }

    public function ajaxtimeline($i = null)
    {       
         $this->loadModel('WorkStages');
         $workStages = $this->WorkStages->find('list')->all();
         $this->set(compact('i','workStages'));
    }

   public function fundrequest($id = null,$work_id = null)
   {
       $this->viewBuilder()->setLayout('layout');  
       $this->loadModel('ProjectFundRequestDetails');
       $this->loadModel('ProjectTimelineDetails');
       $this->loadModel('ProjectFinancialSanctions');
	   $this->loadModel('ProjectAdministrativeSanctions');
	   $this->loadModel('ProjectWorkSubdetails');
	   $this->loadModel('TechnicalSanctions');
	   $this->loadModel('ProjectTenderDetails');
	   $this->loadModel('ContractorDetails');
	   $this->loadModel('WorkStages');
	   $this->loadModel('Users');
	   $this->loadModel('ProjectFundRequestStages');
	   $this->loadModel('FundStatuses');

       $user = $this->request->getAttribute('identity');
	   $role_id     = $user->role_id;
	   $division_id = $user->division_id;
	   $circle_id   = $user->circle_id;
	   $currentuser_id     = $user->id;
       $this->loadModel('ProjectWorks');
       $projectWork = $this->ProjectWorks->get($id, [
           'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
       ]);      
		
	  $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->first(); //tender key
   	  $projectWorkSubdetail  = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.is_active'=>1])->first();
	  $fundrequestcount      = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->count();
      $fund_requests         = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->toArray();
      $currentfundrequest    = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id,'ProjectFundRequestDetails.received_flag'=>0])->first();
      
      $prerequestcount       = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id,'ProjectFundRequestDetails.is_approved !='=>0])->count();
	  
	  
	   $connection               = ConnectionManager::get('default');
        $query                    =  "SELECT sum(fund_req.transaction_amount) as tot_transaction_amount
                                     from project_fund_request_details as fund_req 
                                     where fund_req.project_work_id = '".$id."' AND fund_req.project_work_subdetail_id = '".$work_id."'";
       $fund           = $connection->execute($query)->fetchAll('assoc');
	   
	   $transaction_amount    =  $fund[0]['tot_transaction_amount'];
	   if($transaction_amount > 0){
	   $balance_amt           =  $contractor_details['agreement_amount'] - $transaction_amount;
	   }
	    $projectFundRequestDetails = $this->ProjectFundRequestDetails->newEmptyEntity();

       if($this->request->is((['patch', 'post', 'put']))){    
                //echo "<pre>";  print_r($this->request->getData());  exit(); 
			 
                if($this->request->getData('fund_status_id') == 1){
				    //forward to EE
				  $users   = $this->Users->find('all')->where(['Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.circle_id'=>$projectWorkSubdetail['circle_id'],'Users.role_id'=>4,'Users.is_active'=>1])->first();	
  				  $user_id = $users['id'];
				  //print_r($user_id); exit();
			   }else if($this->request->getData('fund_status_id') == 2){
				    //forward to SE
				  $users   = $this->Users->find('all')->where(['Users.circle_id'=>$projectWorkSubdetail['circle_id'],'Users.role_id'=>5,'Users.is_active'=>1])->first();	
  				  $user_id = $users['id'];
			   }else if($this->request->getData('fund_status_id') == 3){
				    //forward to CE
				  $users  = $this->Users->find('all')->where(['Users.role_id'=>6,'Users.is_active'=>1])->first();
				  $user_id = $users['id'];				   
			   }else if($this->request->getData('fund_status_id') == 4){
				    //forward to GM
				  $users  = $this->Users->find('all')->where(['Users.role_id'=>8,'Users.is_active'=>1])->first();
                  $user_id = $users['id']; 				   
			   }else if($this->request->getData('fund_status_id') == 5){
				    //forward to EE
				  $users   = $this->Users->find('all')->where(['Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.role_id'=>4,'Users.is_active'=>1])->first();
                  $user_id = $users['id']; 				   
			   }
		
		     if(($role_id == 13) && ($this->request->getData('fund_status_id') == 1)){
                $projectFundRequestDetails->project_work_id           = $id;
                $projectFundRequestDetails->project_work_subdetail_id = $work_id;             
                $projectFundRequestDetails->fund_status_id            = $this->request->getData('fund_status_id');
                $projectFundRequestDetails->fund_amount               = $this->request->getData('fund_amount');
                $projectFundRequestDetails->balance_amount            = $this->request->getData('balance_amount');
                $projectFundRequestDetails->user_id                   = $user_id;
                $projectFundRequestDetails->request_date              = date('Y-m-d', strtotime($this->request->getData('request_date')));
                $projectFundRequestDetails->created_by                = $user->id;
                $projectFundRequestDetails->created_date              = date('Y-m-d H:i:s');
                //echo "<pre>" ; print_r($projectFundRequestDetails); exit();
                if($this->ProjectFundRequestDetails->save($projectFundRequestDetails)){
                    $insertid                = $projectFundRequestDetails->id; 
					$projectFundRequestStage = $this->ProjectFundRequestStages->newEmptyEntity();					
					$projectFundRequestStage->project_fund_request_detail_id    = $insertid;
					$projectFundRequestStage->user_id                           = $user_id;             
					$projectFundRequestStage->fund_status_id                    = $this->request->getData('fund_status_id');
					$projectFundRequestStage->forward_date                      = date('Y-m-d');
					$projectFundRequestStage->remarks                           = $this->request->getData('remarks');
					$projectFundRequestStage->created_by                        = $user->id;
                    $projectFundRequestStage->created_date                      = date('Y-m-d H:i:s');
					 //echo "<pre>" ; print_r($projectFundRequestStage); exit();
					if($this->ProjectFundRequestStages->save($projectFundRequestStage)){						
						    $subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$project                        = $subdetailTable->get($work_id); 
							$project->fund_request_flag     = 1;  
							$project->fund_approval_user_id	= $user_id;  
							$subdetailTable->save($project);						
					}
				
                    $this->Flash->success(__('The Fund request details has been saved.'));
                    return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'approvedlist']);
                  }else{
                    $this->Flash->error(__('The Fund request details could not be saved. Please, try again.'));
                  }
				  
			 }else if(($role_id == 4 || $role_id == 5 || $role_id == 6) && ($currentfundrequest['is_approved'] == 0)){				 
				  	$projectFundRequestStage = $this->ProjectFundRequestStages->newEmptyEntity();					
					$projectFundRequestStage->project_fund_request_detail_id    = $this->request->getData('id');
					$projectFundRequestStage->user_id                           = $user_id;             
					$projectFundRequestStage->fund_status_id                    = $this->request->getData('fund_status_id');
					$projectFundRequestStage->forward_date                      = date('Y-m-d');
					$projectFundRequestStage->remarks                           = $this->request->getData('remarks');
					$projectFundRequestStage->created_by                        = $user->id;
                    $projectFundRequestStage->created_date                      = date('Y-m-d H:i:s');
					 //echo "<pre>" ; print_r($projectFundRequestStage); exit();
					if($this->ProjectFundRequestStages->save($projectFundRequestStage)){
						
						    $subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$project                        = $subdetailTable->get($work_id); 
							$project->fund_approval_user_id	= $user_id;  
							$subdetailTable->save($project);		
				
                    $this->Flash->success(__('The Fund request details has been saved.'));
                    return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'approvedlist']);
                  }else{
                    $this->Flash->error(__('The Fund request details could not be saved. Please, try again.'));
                  }			 
				 
			 }else if($role_id == 8){				 
				  	$projectFundRequestStage = $this->ProjectFundRequestStages->newEmptyEntity();					
					$projectFundRequestStage->project_fund_request_detail_id    = $this->request->getData('id');
					$projectFundRequestStage->user_id                           = ($user_id)?$user_id:0;             
					$projectFundRequestStage->fund_status_id                    = $this->request->getData('fund_status_id');
					$projectFundRequestStage->forward_date                      = date('Y-m-d');
					$projectFundRequestStage->remarks                           = $this->request->getData('remarks');
					$projectFundRequestStage->created_by                        = $user->id;
                    $projectFundRequestStage->created_date                      = date('Y-m-d H:i:s');
					 //echo "<pre>" ; print_r($projectFundRequestStage); exit();
					if($this->ProjectFundRequestStages->save($projectFundRequestStage)){	
						  
							$subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$project                        = $subdetailTable->get($work_id); 
							$project->fund_approval_user_id	= $user_id;  
							$subdetailTable->save($project);

                            $RequestTable                = $this->getTableLocator()->get('ProjectFundRequestDetails');
							$requests                    = $RequestTable->get($currentfundrequest['id']);                          							   
							if($this->request->getData('fund_status_id') == 5){
                               $requests->is_approved	= 1; 
                   			   $requests->transaction_ref_no   = $this->request->getData('transaction_ref_no');
							   $requests->transaction_date     = date('Y-m-d',strtotime($this->request->getData('transaction_date')));  
							   $requests->transaction_amount   = $this->request->getData('transaction_amount');  			   
							   $requests->approval_date	       = date('Y-m-d');  
							}elseif($this->request->getData('fund_status_id') == 6){
                               $requests->is_approved	= 2;  
							}	
							$RequestTable->save($requests);							
				
                    $this->Flash->success(__('The Fund request details has been saved.'));
                    return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'approvedlist']);
                  }else{
                    $this->Flash->error(__('The Fund request details could not be saved. Please, try again.'));
                  }			 
			 } else  if(($role_id == 4) && ($currentfundrequest['is_approved'] == 1)){			 
				 
				   $projectFundRequestStage = $this->ProjectFundRequestStages->newEmptyEntity();
					
					$projectFundRequestStage->project_fund_request_detail_id    = $this->request->getData('id');
					$projectFundRequestStage->user_id                           = 0;             
					$projectFundRequestStage->fund_status_id                    = $this->request->getData('fund_status_id');
					$projectFundRequestStage->forward_date                      = date('Y-m-d');
					if($this->request->getData('fund_status_id') == 7){
					$projectFundRequestStage->remarks                           = $this->request->getData('received_remarks');
					}elseif($this->request->getData('fund_status_id') == 8){
					$projectFundRequestStage->remarks                           = $this->request->getData('notreceived_remarks');
					}
					$projectFundRequestStage->created_by                        = $user->id;
                    $projectFundRequestStage->created_date                      = date('Y-m-d H:i:s');
					// echo "<pre>" ; print_r($projectFundRequestStage); exit();
					if($this->ProjectFundRequestStages->save($projectFundRequestStage)){
				 
				            $RequestTable                = $this->getTableLocator()->get('ProjectFundRequestDetails');
					 		$requests                    = $RequestTable->get($currentfundrequest['id']);                          							   
							if($this->request->getData('fund_status_id') == 7){								
							   $requests->amount_received_date   = date('Y-m-d',strtotime($this->request->getData('amount_received_date')));  
							   $requests->received_flag	         = 1;  
							}elseif($this->request->getData('fund_status_id') == 8){
                              $requests->received_flag	         = 2;  
                              $requests->remarks	         = $this->request->getData('notreceived_remarks');;  
							}	
							$RequestTable->save($requests);

                            $subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$project                        = $subdetailTable->get($work_id);                         						   
							$project->fund_approval_user_id	= 0; 
							$project->fund_request_flag	    = 0;  
							
							$subdetailTable->save($project);
							$this->Flash->success(__('The Fund request details has been saved.'));
                          return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'approvedlist']);
                      }	
			   }         
        }	   
	   
		if($role_id == 8){	   
			$fundStatuses = $this->FundStatuses->find('list')->where(['FundStatuses.id IN'=>[5,6]])->all();
		}else if($role_id == 4){	  
		  $fundStatuses = $this->FundStatuses->find('list')->where(['FundStatuses.id IN'=>[7,8]])->all();
		}
      // $this->set(compact('projectFundRequestDetails', 'projectWork','technical','requestcount','administrativesanctioncount','administrativesanction','financialSanctionscount','financialSanctions'));
       $this->set(compact('fundStatuses','requestcount','projectFundRequestDetails','workStages','projectTenderDetail', 'projectWork', 'tenders', 'id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','financialSanctionscount','financialSanctions','work_id','contractor_detail_count','contractor_details','technicalcount','technical','fundrequest','role_id','currentfundrequest','currentuser_id','prerequestcount','fundrequestcount','fund_requests','balance_amt'));
   }   
   
   public function fundrequestview($id = null,$work_id = null)
   {
       $this->viewBuilder()->setLayout('layout');  
       $this->loadModel('ProjectFundRequestDetails');
       $this->loadModel('ProjectTimelineDetails');
       $this->loadModel('ProjectFinancialSanctions');
	   $this->loadModel('ProjectAdministrativeSanctions');
	   $this->loadModel('ProjectWorkSubdetails');
	   $this->loadModel('TechnicalSanctions');
	   $this->loadModel('ProjectTenderDetails');
	   $this->loadModel('ContractorDetails');
	   $this->loadModel('WorkStages');
	   $this->loadModel('Users');
	   $this->loadModel('ProjectFundRequestStages');
	   $this->loadModel('FundStatuses');

       $user = $this->request->getAttribute('identity');
	   $role_id     = $user->role_id;
	   $division_id = $user->division_id;
	   $circle_id   = $user->circle_id;
	   $currentuser_id     = $user->id;
       $this->loadModel('ProjectWorks');
       $projectWork = $this->ProjectWorks->get($id, [
           'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
       ]); 
		
	   $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
	   $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	   $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
  	   $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
       $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();

	   $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
       $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
       $tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id,'ProjectTenderDetails.is_active'=>1])->toArray(); 
       $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id'=>$id,'ContractorDetails.project_work_subdetail_id'=> $work_id,'ContractorDetails.is_active'=>1])->count(); 
       $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->first(); //tender key
       $requestcount                = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->count();
       $fundrequests                = $this->ProjectFundRequestDetails->find('all')->contain(['ProjectWorks'])->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->toArray();

 	  $this->set(compact('fundStatuses','requestcount','projectFundRequestDetails','workStages','projectTenderDetail', 'projectWork', 'tenders', 'id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','financialSanctionscount','financialSanctions','work_id','contractor_detail_count','contractor_details','technicalcount','technical','fundrequests','role_id','fundrequeststages','currentuser_id'));

   }

   public function ajaxgetrequeststages($id = null)
   {       
         $this->loadModel('ProjectFundRequestStages');
         $fundrequeststages     = $this->ProjectFundRequestStages->find('all')->contain(['FundStatuses'])->where(['ProjectFundRequestStages.project_fund_request_id' => $id])->toArray();
		 $this->set(compact('fundrequeststages'));
    }
   
    public function ajaxprojectfulldetails($id = null,$work_id = null){

    $this->loadModel('ProjectAdministrativeSanctions');
    $this->loadModel('ProjectFinancialSanctions');
    $this->loadModel('TechnicalSanctions');
    $this->loadModel('ProjectWorkSubdetails');
    $this->loadModel('ProjectTenderDetails');
    $this->loadModel('ContractorDetails');
    $this->loadModel('ProjectFundRequestDetails');
    $this->loadModel('ProjectFundRequestStages');
    $this->loadModel('PlanningPermissionDetails');
    $this->loadModel('ProjectwiseAbstractDetails');
    $this->loadModel('ProjectwiseAbstractSubdetails');
    $this->loadModel('ProjectMonitoringDetails');
    $this->loadModel('UtilizationCertificates');
    $this->loadModel('ProjectHandoverDetails');
    $this->loadModel('ProjectwiseCompletionReports');
    $this->loadModel('ProjectPlacedToBoardDetails');
	 $user = $this->request->getAttribute('identity');
	 $role_id     = $user->role_id;
	 $division_id = $user->division_id;
	 $circle_id   = $user->circle_id;
	 $user_id     = $user->id;  
		 
    $projectWorkSubdetailcount   = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.work_type'=>1])->count();
 
   if($projectWorkSubdetailcount > 0){
    $projectWork = $this->ProjectWorks->get($id, [
        'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes','DepartmentwiseWorkTypes'],
    ]);
   }else{	   
	    $projectWork = $this->ProjectWorks->get($id, [
			'contain' => ['Departments', 'FinancialYears', 'ProjectStatuses', 'Districts', 'Divisions','DepartmentwiseWorkTypes'],
		]);  	   
   }

     $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
     $administrativesanction     = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks','FundSources','SupervisionCharges'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	 $abstractcount   = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
	 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
	 if($abstractcount > 0){
	 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['NewBuildingItems','Units'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
	  } 
	   
	$financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
    $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
    $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
    $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
  
		$projectWorkSubdetailscount  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id])->count();
		if($role_id == 2 || $role_id == 3 || $role_id == 4 ||  $role_id == 13 || $role_id == 14){
  		   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses','ProjectWorks'])->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.division_id'=>$division_id])->toArray();
  		}else if($role_id == 5 || $role_id == 11 || $role_id == 12){
  		   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses','ProjectWorks'])->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.circle_id'=>$circle_id])->toArray();
  		   //print_r($projectWorkSubdetails); exit();
		}else{
		   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses','ProjectWorks'])->where(['ProjectWorkSubdetails.id' => $work_id])->toArray();
		}
	
	
	$tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails','TenderTypes'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id,'ProjectTenderDetails.is_active'=>1])->toArray(); 
    $tenderscount                = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id,'ProjectTenderDetails.is_active'=>1])->count(); 
    $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id'=>$id,'ContractorDetails.project_work_subdetail_id'=> $work_id,'ContractorDetails.is_active'=>1])->count(); 
    $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks','Contractors'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->first(); //tender key
    $planningcount               = $this->PlanningPermissionDetails->find('all')->where(['PlanningPermissionDetails.project_work_id' => $id,'PlanningPermissionDetails.project_work_subdetail_id'=>$work_id])->count();
	$planningdetail              = $this->PlanningPermissionDetails->find('all')->contain(['ProjectWorks'])->where(['PlanningPermissionDetails.project_work_id' => $id,'PlanningPermissionDetails.project_work_subdetail_id'=>$work_id])->toArray();
    $requestcount                = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->count();
    $fundrequests                = $this->ProjectFundRequestDetails->find('all')->contain(['ProjectWorks'])->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->toArray();
	$monitoringDetailscount      = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->count();
    $monitorings                 = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages','FinancialPercentages'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->toArray();
	$utilizationCertificatecount = $this->UtilizationCertificates->find('all')->where(['UtilizationCertificates.project_work_id'=>$id,'UtilizationCertificates.project_work_subdetail_id'=>$work_id])->count();
	$utilizationCertificate      = $this->UtilizationCertificates->find('all')->where(['UtilizationCertificates.project_work_id'=>$id,'UtilizationCertificates.project_work_subdetail_id'=>$work_id])->toArray();

    $handovercount      = $this->ProjectHandoverDetails->find('all')->where(['ProjectHandoverDetails.project_work_id'=>$id,'ProjectHandoverDetails.project_work_subdetail_id'=>$work_id])->count();
	$handoverdetails    = $this->ProjectHandoverDetails->find('all')->where(['ProjectHandoverDetails.project_work_id'=>$id,'ProjectHandoverDetails.project_work_subdetail_id'=>$work_id])->toArray();	
	

    $completioncount    = $this->ProjectwiseCompletionReports->find('all')->where(['ProjectwiseCompletionReports.project_work_id'=>$id,'ProjectwiseCompletionReports.project_work_subdetail_id'=>$work_id])->count();
    $completiondetails  = $this->ProjectwiseCompletionReports->find('all')->where(['ProjectwiseCompletionReports.project_work_id'=>$id,'ProjectwiseCompletionReports.project_work_subdetail_id'=>$work_id])->toArray();
       	
	$placedtoboardcount    = $this->ProjectPlacedToBoardDetails->find('all')->where(['ProjectPlacedToBoardDetails.project_work_id'=>$id,'ProjectPlacedToBoardDetails.project_work_subdetail_id'=>$work_id])->count();
	$placedtoboarddetails  = $this->ProjectPlacedToBoardDetails->find('all')->where(['ProjectPlacedToBoardDetails.project_work_id'=>$id,'ProjectPlacedToBoardDetails.project_work_subdetail_id'=>$work_id])->toArray();
   
    $this->set(compact('projectWork','monitoringDetailscount','monitorings','utilizationCertificatecount','utilizationCertificate','handovercount','handoverdetails',
    'administrativesanctioncount','administrativesanction','completioncount','completiondetails','placedtoboardcount','placedtoboarddetails',
    'financialSanctionscount','financialSanctions','technicalcount','technical',
    '$projectWorkSubdetailcount','projectWorkSubdetails','tenders','tenderscount',
    'contractor_detail_count','contractor_details','requestcount','fundrequests','projectWorkSubdetailscount','planningcount','planningdetail','abstractcount','abstract_subdetails'));
   }
		
	public function planningpermission($id = null, $work_id = null)
	{
    $this->viewBuilder()->setLayout('layout');
    $user = $this->request->getAttribute('identity');
    $this->loadModel('ProjectWorks');
    $this->loadModel('PlanningPermissionDetails');
    $this->loadModel('ProjectWorkSubdetails');
    $this->loadModel('ProjectwiseFloorSubdetails');
    $this->loadModel('ProjectwiseFloorDetails');
    $this->loadModel('Notifications');
    $this->loadModel('Users');

	   $projectWorkSubdetailcount   = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.work_type'=>1])->count();

		if($projectWorkSubdetailcount > 0){
			$projectWork = $this->ProjectWorks->get($id, [
				'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
			]);
			//$projectWorkSubdetail   = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id])->first();
		
		}else{	
			$projectWork = $this->ProjectWorks->get($id, [
				'contain' => ['Departments', 'FinancialYears', 'ProjectStatuses', 'Districts', 'Divisions'],
			]);
			//$projectWorkSubdetail   = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id])->first();
	   }	
	        $projectWorkSubdetail  = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id'=>$work_id])->first();


    $Planningcount = $this->PlanningPermissionDetails->find('all')->contain(['ProjectWorks'])->where(['PlanningPermissionDetails.project_work_id' => $id, 'PlanningPermissionDetails.project_work_subdetail_id' => $work_id])->count();
    $planingdetail = $this->PlanningPermissionDetails->find('all')->contain(['ProjectWorks'])->where(['PlanningPermissionDetails.project_work_id' => $id, 'PlanningPermissionDetails.project_work_subdetail_id' => $work_id])->first();
    $totalunits    = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id, 'ProjectWorkSubdetails.id' => $work_id])->first();
    $totalunit     = $totalunits['total_units'];

    $projectwiseFloorDetail = $this->ProjectwiseFloorDetails->find('all')->where(['ProjectwiseFloorDetails.project_work_id' => $id, 'ProjectwiseFloorDetails.project_work_subdetail_id' => $work_id])->first();
    $projectfloorid = $projectwiseFloorDetail['id'];
     //echo"<pre>";print_r($totalunit);exit();
    if($projectfloorid !=''){
        $projectwisefloorSubdetailcount = $this->ProjectwiseFloorSubdetails->find('all')->where(['ProjectwiseFloorSubdetails.projectwise_floor_detail_id' => $projectfloorid])->count();
        $projectwisefloorSubdetail = $this->ProjectwiseFloorSubdetails->find('all')->where(['ProjectwiseFloorSubdetails.projectwise_floor_detail_id' => $projectfloorid])->toArray();
    }

    $projectwisefloorDetailscount = $this->ProjectwiseFloorDetails->find('all')->where(['ProjectwiseFloorDetails.project_work_id' => $id,'ProjectwiseFloorDetails.project_work_subdetail_id'=>$work_id])->count();
    $projectwisefloorDetail       = $this->ProjectwiseFloorDetails->find('all')->where(['ProjectwiseFloorDetails.project_work_id' => $id,'ProjectwiseFloorDetails.project_work_subdetail_id'=>$work_id])->first();


    $apporved = [1 => 'Yes', 2 => 'No'];
    if ($Planningcount == 0) {
        $planningPermissionDetail = $this->PlanningPermissionDetails->newEmptyEntity();
    }

    if ($this->request->is(['patch', 'post', 'put'])) {  //echo"<pre>"; print_r($this->request->getData());  exit();
       // if($insert_id != ''){
            if ($totalunit != '') {
        if(($this->request->getData('floors')!= '')){
                if ($projectwisefloorDetail['id'] != '') {
                    $projectwiseFloorDetail = $this->ProjectwiseFloorDetails->get($projectwisefloorDetail['id'], [
                        'contain' => [],
                    ]);
                } else {
                    $projectwiseFloorDetail = $this->ProjectwiseFloorDetails->newEmptyEntity();
                }
                 $projectwiseFloorDetail->project_work_id                 = $id;
                 $projectwiseFloorDetail->project_work_subdetail_id       = $work_id;
                 $projectwiseFloorDetail->total_units                     = $totalunit;
               
                if ($projectwisefloorDetail['id'] != ''){
                    $projectwiseFloorDetail->modified_by                      = $user->id;
                    $projectwiseFloorDetail->modified_date                    = date('Y-m-d:h:m:s');
                }else{
					 $projectwiseFloorDetail->created_by                      = $user->id;
                     $projectwiseFloorDetail->created_date                    = date('Y-m-d:h:m:s');					
				}
                if ($this->ProjectwiseFloorDetails->save($projectwiseFloorDetail)) {
                    $insert_id = $projectwiseFloorDetail->id;
                    // echo"<pre>";print_r($insert_id);exit();
                    if($insert_id != ''){
                        foreach ($this->request->getData('floors') as $key => $value) {
                            // echo"<pre>";print_r($value);exit();
                            if ($value['id'] != '') {
                                $projectwiseFloorSubdetail = $this->ProjectwiseFloorSubdetails->get($value['id'], [
                                    'contain' => [],
                                ]);
                            } else {
                                $projectwiseFloorSubdetail = $this->ProjectwiseFloorSubdetails->newEmptyEntity();
                            }
                            $projectwiseFloorSubdetail->no_of_floor                  = $value['no_of_floor'];
                            $projectwiseFloorSubdetail->area_in_square_meter         = $value['area_in_square_meter'];
                            $projectwiseFloorSubdetail->projectwise_floor_detail_id  = $insert_id;                            
                            if ($value['id'] != '') {
                                $projectwiseFloorSubdetail->modified_by              = $user->id;
                                $projectwiseFloorSubdetail->modified_date            = date('Y-m-d H:i:s');
                            }else{
								$projectwiseFloorSubdetail->created_by               = $user->id;
                                $projectwiseFloorSubdetail->created_date             = date('Y-m-d H:i:s');
								
							}
                            $this->ProjectwiseFloorSubdetails->save($projectwiseFloorSubdetail);
                        }
                    }
                }
            }
        }

        /*if ($Planningcount > 0) {
            $planningPermissionDetail = $this->PlanningPermissionDetails->get($this->request->getData('id'), []);
        }
        if ($this->request->getData('is_permission_apporved') == 1) {
            $attachment  = $this->request->getData('permission_apporved_copy');
            if ($attachment->getClientFilename() != '') {
                $name    = $attachment->getClientFilename();
                $type    = $attachment->getClientMediaType();
                $size    = $attachment->getSize();
                $tmpName = $attachment->getStream()->getMetadata('uri');
                $error   = $attachment->getError();

                if ($name != '' && $error == 0) {
                    $file                                     = $name;
                    $array                                    = explode('.', $file);
                    $fileExt                                  = $array[count($array) - 1];
                    $current_time                             = date('Y_m_d_H_i_s');
                    $newfile                                  = "PlanningPermission_" . $current_time . "." . $fileExt;
                    $tempFile                                 = $tmpName;
                    $targetPath                               = 'uploads/PlanningPermissions/';
                    $targetFile                               = $targetPath . $newfile;

                    $planningPermissionDetail->permission_apporved_copy        = $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            } else {
                $planningPermissionDetail->permission_apporved_copy        = $this->request->getData('permission_apporved_copy1');
            }

            $attachment1  = $this->request->getData('drawing_copy');
            if ($attachment1->getClientFilename() != '') {
                $name1    = $attachment1->getClientFilename();
                $type1    = $attachment1->getClientMediaType();
                $size1    = $attachment1->getSize();
                $tmpName1 = $attachment1->getStream()->getMetadata('uri');
                $error1   = $attachment1->getError();

                if ($name1 != '' && $error1 == 0) {
                    $file1                                     = $name1;
                    $array1                                    = explode('.', $file1);
                    $fileExt1                                  = $array1[count($array1) - 1];
                    $current_time1                             = date('Y_m_d_H_i_s');
                    $newfile1                                  = "drawing_copy_" . $current_time1 . "." . $fileExt1;
                    $tempFile1                                 = $tmpName1;
                    $targetPath1                               = 'uploads/DrawingCopy/';
                    $targetFile1                               = $targetPath1 . $newfile1;
                    $planningPermissionDetail->drawing_copy        = $newfile1;
                    move_uploaded_file($tempFile1, $targetFile1);
                }
            } else {
                $planningPermissionDetail->drawing_copy        = $this->request->getData('drawing_copy1');
            }
        }
        $planningPermissionDetail->project_work_id                     = $id;
        $planningPermissionDetail->project_work_subdetail_id           = $work_id;
        if ($this->request->getData('is_permission_apporved') == 1) {
            $planningPermissionDetail->approved_date                   = date('Y-m-d', strtotime($this->request->getData('approved_date')));
        } elseif ($this->request->getData('is_permission_apporved') == 2) {
            $planningPermissionDetail->remarks                             = $this->request->getData('remarks');
        }
        $planningPermissionDetail->is_permission_approved              = $this->request->getData('is_permission_apporved');
        $planningPermissionDetail->send_date                           = date('Y-m-d', strtotime($this->request->getData('send_date')));
        $planningPermissionDetail->created_by                          = $user->id;
        $planningPermissionDetail->created_date                        = date('Y-m-d:h:i:s');
        if ($Planningcount > 0) {
            $planningPermissionDetail->modified_by                         =  $user->id;
            $planningPermissionDetail->modified_date                       = date('Y-m-d:h:i:s');
        }
        // echo"<pre>";print_r($planningPermissionDetail);exit();
        if ($this->PlanningPermissionDetails->save($planningPermissionDetail)) {
           //$this->Flash->success(__('The planning permission detail has been saved.'));

            if ($this->request->getData('is_permission_apporved') == 1) {
                $subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
                $project                        = $subdetailTable->get($work_id);
                $project->planning_permission_flag     = 1;
                $project->project_work_status_id       = 10;
                $subdetailTable->save($project);
				   $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>9])->count();
				   if($notification_count == 1){   
						$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>9])->first();

						$notificationTable                   = $this->getTableLocator()->get('Notifications');
						$notification1                       = $notificationTable->get($notification_id['id']); 
						$notification1->notification_seen	 = 1;  
						$notification1->process_done	     = 1;  
						$notificationTable->save($notification1);
						
						    $recipient_user = $this->Users->find('all')->where(['Users.role_id'=>13,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
							$recipient_user_id = $recipient_user['id'];
							$notification = $this->Notifications->newEmptyEntity();					
							$notification->forwarded_date                    = date('Y-m-d');
							$notification->forward_user_id                   = $user->id;
							$notification->recipient_user_id                 = $recipient_user_id; 
							$notification->notification_type_id              = 10; 
							$notification->project_work_id                   = $id;
							$notification->project_work_subdetail_id         = $work_id;
							 if($notification_id['work_type'] == 2){	
							   $notification->work_type                         = 2;
							}
							$notification->created_by                        = $user->id;
							$notification->created_date                      = date('Y-m-d H:i:s');				
							$this->Notifications->save($notification);	    		
				  }
            }

            return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/4']);
        }*/
				$subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                        = $subdetailTable->get($work_id);
					$project->is_planning_approval_send          = $this->request->getData('is_planning_approval_send');
					$project->permission_not_send_remarks        = null;
					$subdetailTable->save($project);
							
					if($this->request->getData('is_planning_approval_send') == 2){
							if($this->request->getData('id') != ''){
							   $entity = $this->PlanningPermissionDetails->get($this->request->getData('id'));
							   $result = $this->PlanningPermissionDetails->delete($entity);
							}
							$subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$project                        = $subdetailTable->get($work_id);
							$project->permission_not_send_remarks        = $this->request->getData('permission_not_send_remarks');
							$subdetailTable->save($project);
                                  return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/4']);

					
					}else if($this->request->getData('is_planning_approval_send') == 1){
					if ($Planningcount > 0) {
						$planningPermissionDetail = $this->PlanningPermissionDetails->get($this->request->getData('id'), []);
					}
					if ($this->request->getData('is_permission_apporved') == 1) {
						$attachment  = $this->request->getData('permission_apporved_copy');
						if ($attachment->getClientFilename() != '') {
							$name    = $attachment->getClientFilename();
							$type    = $attachment->getClientMediaType();
							$size    = $attachment->getSize();
							$tmpName = $attachment->getStream()->getMetadata('uri');
							$error   = $attachment->getError();

							if ($name != '' && $error == 0) {
								$file                                     = $name;
								$array                                    = explode('.', $file);
								$fileExt                                  = $array[count($array) - 1];
								$current_time                             = date('Y_m_d_H_i_s');
								$newfile                                  = "PlanningPermission_" . $current_time . "." . $fileExt;
								$tempFile                                 = $tmpName;
								$targetPath                               = 'uploads/PlanningPermissions/';
								$targetFile                               = $targetPath . $newfile;

								$planningPermissionDetail->permission_apporved_copy        = $newfile;
								move_uploaded_file($tempFile, $targetFile);
							}
						} else {
							$planningPermissionDetail->permission_apporved_copy        = $this->request->getData('permission_apporved_copy1');
						}

						$attachment1  = $this->request->getData('drawing_copy');
						if ($attachment1->getClientFilename() != '') {
							$name1    = $attachment1->getClientFilename();
							$type1    = $attachment1->getClientMediaType();
							$size1    = $attachment1->getSize();
							$tmpName1 = $attachment1->getStream()->getMetadata('uri');
							$error1   = $attachment1->getError();

							if ($name1 != '' && $error1 == 0) {
								$file1                                     = $name1;
								$array1                                    = explode('.', $file1);
								$fileExt1                                  = $array1[count($array1) - 1];
								$current_time1                             = date('Y_m_d_H_i_s');
								$newfile1                                  = "drawing_copy_" . $current_time1 . "." . $fileExt1;
								$tempFile1                                 = $tmpName1;
								$targetPath1                               = 'uploads/DrawingCopy/';
								$targetFile1                               = $targetPath1 . $newfile1;
								$planningPermissionDetail->drawing_copy        = $newfile1;
								move_uploaded_file($tempFile1, $targetFile1);
							}
						} else {
							$planningPermissionDetail->drawing_copy        = $this->request->getData('drawing_copy1');
						}
					}
					$planningPermissionDetail->project_work_id                     = $id;
					$planningPermissionDetail->project_work_subdetail_id           = $work_id;
					if ($this->request->getData('is_permission_apporved') == 1) {
						$planningPermissionDetail->approved_date                   = date('Y-m-d', strtotime($this->request->getData('approved_date')));
						$planningPermissionDetail->remarks                         = null;
					} elseif ($this->request->getData('is_permission_apporved') == 2) {
						$planningPermissionDetail->approved_date                   = null;
						$planningPermissionDetail->permission_apporved_copy        = null;
						$planningPermissionDetail->drawing_copy                    = null;
						$planningPermissionDetail->remarks                         = $this->request->getData('remarks');

					}
					$planningPermissionDetail->send_date                           = date('Y-m-d', strtotime($this->request->getData('send_date')));
					$planningPermissionDetail->is_permission_approved              = $this->request->getData('is_permission_apporved');
					$planningPermissionDetail->created_by                          = $user->id;
					$planningPermissionDetail->created_date                        = date('Y-m-d:h:i:s');
					if ($Planningcount > 0) {
						$planningPermissionDetail->modified_by                         =  $user->id;
						$planningPermissionDetail->modified_date                       = date('Y-m-d:h:i:s');
					}
					// echo"<pre>";print_r($planningPermissionDetail);exit();
					if ($this->PlanningPermissionDetails->save($planningPermissionDetail)) {
					   //$this->Flash->success(__('The planning permission detail has been saved.'));
						if ($this->request->getData('is_permission_apporved') == 1) {
							//if ($Planningcount == 0) {
							$subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$project                        = $subdetailTable->get($work_id);
							$project->planning_permission_flag     = 1;
							$project->project_work_status_id       = 10;
							$subdetailTable->save($project);
							//}
							$notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>9])->count();
							   if($notification_count == 1){   
									$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>9])->first();

									$notificationTable                   = $this->getTableLocator()->get('Notifications');
									$notification1                       = $notificationTable->get($notification_id['id']); 
									$notification1->notification_seen	 = 1;  
									$notification1->process_done	     = 1;  
									$notificationTable->save($notification1);
									
										$recipient_user = $this->Users->find('all')->where(['Users.role_id'=>13,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
										$recipient_user_id = $recipient_user['id'];
										$notification = $this->Notifications->newEmptyEntity();					
										$notification->forwarded_date                    = date('Y-m-d');
										$notification->forward_user_id                   = $user->id;
										$notification->recipient_user_id                 = $recipient_user_id; 
										$notification->notification_type_id              = 10; 
										$notification->project_work_id                   = $id;
										$notification->project_work_subdetail_id         = $work_id;
										 if($notification_id['work_type'] == 2){	
										   $notification->work_type                         = 2;
										}
										$notification->created_by                        = $user->id;
										$notification->created_date                      = date('Y-m-d H:i:s');				
										$this->Notifications->save($notification);	    		
							  }
						}

                           return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/4']);
						 //$this->Flash->error(__('The planning permission detail could not be saved. Please, try again.'));
					  }
					}
					
					
					
					$this->Flash->error(__('The planning permission detail could not be saved. Please, try again.'));
				}

    $this->set(compact('planningPermissionDetail', 'Planningcount',
                       'planingdetail', 'apporved', 'id', 'work_id',
                       'totalunit','projectwisefloorSubdetailcount',
                       'projectwisefloorSubdetail','projectwisefloorDetailscount','projectWorkSubdetail',
                       'projectwisefloorDetail'));
}	
	
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
	
	public function ajaxgetworkdetails($id = null)
    {
		 $this->loadModel('ProjectWorkSubdetails');
		 $this->loadModel('Roles');
		 $user = $this->request->getAttribute('identity');
		 $role_id     = $user->role_id;
		 $division_id = $user->division_id;
		 $circle_id   = $user->circle_id;
		 $user_id     = $user->id;		 
		 
		 $projectWorkSubdetailscount  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id])->count();
		if($role_id == 2 || $role_id == 3 || $role_id == 4 ||  $role_id == 13 || $role_id == 14){
  		   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses','ProjectWorks'])->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.division_id'=>$division_id])->toArray();
  		}else if($role_id == 5 || $role_id == 11 || $role_id == 12){
  		   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses','ProjectWorks'])->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.circle_id'=>$circle_id])->toArray();
		}else{
		   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses','ProjectWorks'])->where(['ProjectWorkSubdetails.project_work_id' => $id])->toArray();
		}
		 
		 $role                        =   $this->Roles->find('list')->where(['Roles.is_active' => 1])->toArray();

        $this->set(compact('id','projectWorkSubdetails','role','projectWorkSubdetailscount','role_id','division_id','circle_id','user_id'));
    }
	   
    public function projectminutedetail($id = null, $work_id = null)
    {
	$this->viewBuilder()->setLayout('layout');
	$this->loadModel('ProjectMinuteDetails');
	$this->loadModel('ProjectMinuteSubdetails');

	$user = $this->request->getAttribute('identity');
	$role_id = $user->role_id;
	$projectminutes = $this->ProjectMinuteDetails->find('all')->where(['ProjectMinuteDetails.project_work_id' => $id, 'ProjectMinuteDetails.project_work_subdetail_id' => $work_id])->count();
	$projectminutedetails = $this->ProjectMinuteDetails->find('all')->where(['ProjectMinuteDetails.project_work_id' => $id, 'ProjectMinuteDetails.project_work_subdetail_id' => $work_id])->toArray();
	$last_minute_detail = $this->ProjectMinuteDetails->find('all')->where(['ProjectMinuteDetails.project_work_id' => $id, 'ProjectMinuteDetails.project_work_subdetail_id' => $work_id])->last();
	
	// $projectsubminutecount = $this->ProjectMinuteSubdetails->find('all')->where(['ProjectMinuteSubdetails.project_minute_detail_id' => $id])->count();
	 if (isset($last_minute_detail)) {
	   $projectsubminutedetails = $this->ProjectMinuteSubdetails->find('all')->where(['ProjectMinuteSubdetails.project_minute_detail_id' => $last_minute_detail['id']])->toArray();
	   $projectsubminutecount = $this->ProjectMinuteSubdetails->find('all')->where(['ProjectMinuteSubdetails.project_minute_detail_id' => $last_minute_detail['id']])->count();
	 }

		 $projectMinuteDetail = $this->ProjectMinuteDetails->newEmptyEntity();

		if ($this->request->is(['patch', 'post', 'put'])) {
			if ($role_id == 4) {
				 foreach ($this->request->getData('meeting') as $key => $value) {

					$projectMinuteSubdetail = $this->ProjectMinuteSubdetails->get($value['id'], [
						'contain' => [],
					]);
					//$ProjectMinuteSubdetail                             = $this->ProjectMinuteSubdetails->newEmptyEntity();
					$projectMinuteSubdetail->project_minute_detail_id     = $this->request->getData('minute_id');
					$projectMinuteSubdetail->action_taken                 = $value['action_taken'];
					$projectMinuteSubdetail->action_taken_date            = ($value['action_taken_date'] != '') ? date('Y-m-d', strtotime($value['action_taken_date'])) : '';
					if ($value['action_taken_date'] != '') {
						$this->ProjectMinuteSubdetails->save($projectMinuteSubdetail);
					}
				 }
			   } else if ($role_id == 6) {

				$projectMinuteDetail->meeting_date                     = date('Y-m-d', strtotime($this->request->getData('meeting_date')));
				$projectMinuteDetail->project_work_id                  = $id;
				$projectMinuteDetail->project_work_subdetail_id        = $work_id;
				$projectMinuteDetail->created_date                     = date('Y-m-d H:i:s');
				$projectMinuteDetail->created_by                       =  $user->id;

				if ($this->ProjectMinuteDetails->save($projectMinuteDetail)) {
					$insert_id               = $projectMinuteDetail->id;

					foreach ($this->request->getData('meeting') as $key => $value) {


						$ProjectMinuteSubdetail                              = $this->ProjectMinuteSubdetails->newEmptyEntity();
						$ProjectMinuteSubdetail->project_minute_detail_id     = $insert_id;
						$ProjectMinuteSubdetail->minutes_points               = $value['minutes_points'];
						$this->ProjectMinuteSubdetails->save($ProjectMinuteSubdetail);
					}
				}
			}
			$this->Flash->success(__('The project minute detail has been saved.'));
			//return $this->redirect(['action' => 'projectworkdetail/' . $id]);
			$this->Flash->error(__('The project minute detail could not be saved. Please, try again.'));
		}
    $this->set(compact('role_id', 'projectMinuteDetail', 'projectminutecount', 'projectminutedetail', 'projectMinuteSubdetail', 'projectsubminutedetails', 'projectsubminutecount','projectminutedetails','last_minute_detail'));
  }
  
    public function projectminutedetailupdate($minute_id = null)
    {
	$this->viewBuilder()->setLayout('layout');
	$this->loadModel('ProjectMinuteDetails');
	$this->loadModel('ProjectMinuteSubdetails');

	$user = $this->request->getAttribute('identity');
	$role_id = $user->role_id;
	$projectminutes     = $this->ProjectMinuteDetails->find('all')->where(['ProjectMinuteDetails.id' => $minute_id])->count();
	$last_minute_detail = $this->ProjectMinuteDetails->find('all')->where(['ProjectMinuteDetails.id'=>$minute_id])->first();
	
	if (isset($last_minute_detail)) {
	   $projectsubminutedetails = $this->ProjectMinuteSubdetails->find('all')->where(['ProjectMinuteSubdetails.project_minute_detail_id' => $minute_id])->toArray();
	   $projectsubminutecount = $this->ProjectMinuteSubdetails->find('all')->where(['ProjectMinuteSubdetails.project_minute_detail_id' => $minute_id])->count();
	}
	if ($this->request->is(['patch', 'post', 'put']))
	{
			foreach ($this->request->getData('meeting') as $key => $value) {
				$projectMinuteSubdetail = $this->ProjectMinuteSubdetails->get($value['id'], [
					'contain' => [],
				]);
				$projectMinuteSubdetail->project_minute_detail_id     = $this->request->getData('minute_id');
				$projectMinuteSubdetail->action_taken                 = $value['action_taken'];
				$projectMinuteSubdetail->action_taken_date            = ($value['action_taken_date'] != '') ? date('Y-m-d', strtotime($value['action_taken_date'])) : '';
				if ($value['action_taken_date'] != '') {
				  $this->ProjectMinuteSubdetails->save($projectMinuteSubdetail);			
				
				}				
			}  
			
			$projectTable                   = $this->getTableLocator()->get('ProjectMinuteDetails');
			$project                        = $projectTable->get($minute_id); 
			$project->reply_flag	        = 1;
			$projectTable->save($project);
			
		$this->Flash->success(__('The project minute detail has been saved.'));
		return $this->redirect(['action' => 'projectminutedetail/'.$last_minute_detail['project_work_id'].'/'.$last_minute_detail['project_work_subdetail_id']]);
		$this->Flash->error(__('The project minute detail could not be saved. Please, try again.'));
	}
    $this->set(compact('role_id', 'projectMinuteDetail', 'projectminutecount', 'projectminutedetail', 'projectMinuteSubdetail', 'projectsubminutedetails', 'projectsubminutecount','projectminutedetails','last_minute_detail'));
  }

	public function projectminuteview($id = null)
	{
		$this->viewBuilder()->setLayout('layout');
		$this->loadModel('ProjectMinuteDetails');
		$this->loadModel('ProjectMinuteSubdetails');		    
		$projectminutedetail     = $this->ProjectMinuteDetails->find('all')->where(['ProjectMinuteDetails.id' => $id])->first();
		$projectsubminutedetails = $this->ProjectMinuteSubdetails->find('all')->where(['ProjectMinuteSubdetails.project_minute_detail_id' => $id])->toArray();
		$this->set(compact('projectMinuteSubdetail', 'projectsubminutedetails','projectminutedetail'));
	}

	public function ajaxprojectmeeting($i = null)
	{
		$this->set(compact('i'));
	}
		
	public function projectlist($type = null)  
    {        
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		$this->loadModel('ProjectWorkSubdetails');
		$this->loadModel('ProjectWorks');
		$this->loadModel('Departments');
		$this->loadModel('FinancialYears');
		$this->loadModel('Districts');
		$this->loadModel('MbookEntryDetails');
		
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;
		$user_id     = $user->id;  
		
		if($type == 0){
			$title = "Detailed Estimate List";	
			$type_cond = " AND psd.detailed_estimate_approval = 0 AND psd.project_work_status_id IN (3) or (psd.project_work_status_id < 4 and psd.work_type = 2)";		
		}else if($type == 1){	
           $title = "Abstract / Tehnical Sanction List";		
           $type_cond = " AND psd.detailed_estimate_approval = 0 AND psd.project_work_status_id IN (5,6,7) or (psd.project_work_status_id IN (4,5,6,7) and psd.work_type = 2)";
           //$type_cond = "";
		}else if($type == 2){	
           $title = "Tehnical Sanction List";		 
           $type_cond = " AND psd.detailed_estimate_approval = 1 AND psd.project_work_status_id IN (6,7,8)";
		}else if($type == 3){	
           $title = "Tender Details List";		 
           $type_cond = " AND psd.detailed_estimate_approval = 1 AND psd.project_work_status_id = 8 AND psd.tender_detail_flag = 0";  
		}else if($type == 4){	
           $title = "Planning Clearance List";		 
           $type_cond = " AND psd.detailed_estimate_approval = 1 AND psd.tender_detail_flag = 1 AND psd.planning_permission_flag = 0";
		}else if($type == 5){	
           $title = "Site HandOver List";		 
           $type_cond = " AND psd.detailed_estimate_approval = 1 AND psd.planning_permission_flag = 1 AND psd.site_handover_flag = 0";
		}else if($type == 6){	
           $title = "project Fund Request";		
		   if($role_id == 13){
           $type_cond = " AND psd.detailed_estimate_approval = 1  AND psd.site_handover_flag = 1";
		   }else{
		   $type_cond = " AND psd.detailed_estimate_approval = 1  AND psd.site_handover_flag = 1 AND psd.fund_request_flag = 1";   
		   }
		}else if($type == 7){	
           $title = "Project Monitoring List";		 
           $type_cond = " AND psd.site_handover_flag = 1";
		}else if($type == 8){	
           $title = "Utilization Certificate list";		 
           $type_cond = " AND psd.site_handover_flag = 1";
		}else if($type == 9){	
           $title = "Project HandOver to User  Department list";		 
           $type_cond = " AND psd.site_handover_flag = 1 AND psd.project_work_status_id >= 12";
		}else if($type == 10){	
           $title = "Project Completion Report list";		 
           $type_cond = " AND psd.site_handover_flag = 1 AND psd.project_work_status_id >= 16";
		}else if($type == 11){	
           $title = "Quarters list";		 
           $type_cond = " AND  psd.project_work_status_id >= 2 AND project.departmentwise_work_type_id = 1";
		}else if($type == 12){	
           $title = "Project Placed To Board list";		 
           $type_cond = " AND psd.site_handover_flag = 1 AND psd.project_work_status_id = 18";
		}else if($type == 13){	
           $title = "Development Works";		 
           $type_cond = " AND psd.site_handover_flag = 1 AND psd.project_work_status_id >= 5 and psd.work_type =1";
		}else if($type == 14){	
           $title = "Extention Of Time";		 
           $type_cond = " and psd.project_work_status_id >= 7 and psd.work_type = 1";
		}else if($type == 15){	
            $title = "Tender Details Cancel / Renew List";		 
           $type_cond = " AND psd.detailed_estimate_approval = 1 AND psd.project_work_status_id >= 8 AND psd.tender_detail_flag = 1";  
		}else if($type == 16){	
            $title = "Drawing upload List";		 
           $type_cond = " AND psd.detailed_estimate_approval = 1 AND psd.project_work_status_id >= 8 AND psd.tender_detail_flag = 1";  
		}else if($type == 17){	
            $title = "M BOOK";		 
           $type_cond = " AND psd.project_work_status_id >= 9";  
		}     												
		
		if($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15){
			$condition = " and psd.division_id = ".$division_id."";
		}else if($role_id == 5 || $role_id == 11 || $role_id == 12){
			$condition = " and psd.circle_id = ".$circle_id."";			
		}else{
			$condition = "";
		}			
			
	    $connection = ConnectionManager::get('default');       

		if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>'; print_r($this->request->getData()); exit();		   
	
			  $fin_year_cond      = ($this->request->getData('financial_year_id') != '')?" AND project.financial_year_id = ".$this->request->getData('financial_year_id')."":"";
			  $dept_cond          = ($this->request->getData('department_id') != '')?" AND project.department_id = ".$this->request->getData('department_id')."":""; 				  
			  $project_cond       = ($this->request->getData('project_code')!= '')?" AND project.project_code like '%".$this->request->getData('project_code')."%'":"";
			  $district_cond      = ($this->request->getData('district_id') != '')?" AND psd.district_id = ".$this->request->getData('district_id')."":""; 				  
	
			  $query              =  "SELECT psd.*,dis.name as district_name,dv.name as division_name,c.name as circle_name,ps.name as work_status,project.project_code as project_code
									 from project_work_subdetails as psd 
									 LEFT JOIN project_works as project on project.id = psd.project_work_id
									 LEFT JOIN districts as dis on dis.id= psd.district_id 
									 LEFT JOIN divisions as dv on dv.id= psd.division_id 
									 LEFT JOIN circles as c on c.id= psd.circle_id 
									 LEFT JOIN project_work_statuses as ps on ps.id= psd.project_work_status_id 
									 where project.ce_approved=1 and psd.is_active = 1 $condition  $fin_year_cond  $dept_cond  $project_cond $district_cond  $type_cond";		
											 
		   $projectWorks         = $connection->execute($query)->fetchAll('assoc'); 
		   
		   $mbook_entry_clarification_flag = array();
		   $mbook_entry_clarification_count = array();
		   foreach($projectWorks as $project){
			   	   $mbook_entry_clarification_flag[$project['id']]   = $this->MbookEntryDetails->find('all')->where(['MbookEntryDetails.project_work_id'=>$project['project_work_id'],'MbookEntryDetails.project_work_subdetail_id'=>$project['id'],'MbookEntryDetails.is_active'=>1,'MbookEntryDetails.submit_flag' => 1])->first();
			   	   $mbook_entry_clarification_count[$project['id']]  = $this->MbookEntryDetails->find('all')->where(['MbookEntryDetails.project_work_id'=>$project['project_work_id'],'MbookEntryDetails.project_work_subdetail_id'=>$project['id'],'MbookEntryDetails.is_active'=>1,'MbookEntryDetails.submit_flag' => 1])->count();
		   }
	  } 	   
		
	     $departments     = $this->Departments->find('list')->all();
         $financialYears  = $this->FinancialYears->find('list')->order('id DESC')->all();	
         $districts       = $this->Districts->find('list')->all();	

	   $this->set(compact('mbook_entry_clarification_count','mbook_entry_clarification_flag','title','type','districts','departments','financialYears','projectWorks','adminsanction_count','financial_count','techsanction_count','tender_count','monitoring_count','role_id','subdetail_present','estimate_uploaded','division_id','circle_id','user_id'));
    }
	
	public function projectfundrequestadd(){  
		$this->viewBuilder()->setLayout('layout');
        $user  = $this->request->getAttribute('identity');
		$this->loadModel('Departments');	
		$this->loadModel('FinancialYears');

        $role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;
		$user_id     = $user->id;  	
        $condition   = " AND psd.division_id = ".$division_id."";

	    $connection = ConnectionManager::get('default');
		
		if ($this->request->is(['patch', 'post', 'put'])) { 
		
		      $fin_year_cond      = ($this->request->getData('financial_year_id') != '')?" AND project.financial_year_id = ".$this->request->getData('financial_year_id')."":"";
			  $dept_cond          = ($this->request->getData('department_id') != '')?" AND project.department_id = ".$this->request->getData('department_id')."":""; 				  
			  $query              =  "SELECT psd.*,dis.name as district_name,dv.name as division_name,c.name as circle_name,cd.agreement_amount as agreement_amount,fs.go_no as fsgo_no,psd.fs_amount as fs_amount,psd.fs_excluding_sc as fs_excluding_sc
									 from project_work_subdetails as psd 
									 LEFT JOIN project_works as project on project.id = psd.project_work_id
									 LEFT JOIN districts as dis on dis.id= psd.district_id 
									 LEFT JOIN divisions as dv on dv.id= psd.division_id 
									 LEFT JOIN circles as c on c.id= psd.circle_id 
									 LEFT JOIN contractor_details as cd on cd.project_work_subdetail_id= psd.id 
									 LEFT JOIN project_financial_sanctions as fs on fs.project_work_id= project.id 
									 where psd.project_work_status_id >= 7 AND psd.fund_request_flag = 0 and psd.work_type = 1 and cd.projectwise_development_work_id is null  $condition  $fin_year_cond  $dept_cond  ";	
									 
			 $projectworkdetails     = $connection->execute($query)->fetchAll('assoc');		 
			 
			// print_r($query); exit();
		     $projectworkdetailcount = count($projectworkdetails);
		 }else{
			 
			   $query              =  "SELECT psd.*,dis.name as district_name,dv.name as division_name,c.name as circle_name,cd.agreement_amount as agreement_amount,fs.go_no as fsgo_no,psd.fs_amount as fs_amount,psd.fs_excluding_sc as fs_excluding_sc
									 from project_work_subdetails as psd 
									 LEFT JOIN project_works as project on project.id = psd.project_work_id
									 LEFT JOIN districts as dis on dis.id= psd.district_id 
									 LEFT JOIN divisions as dv on dv.id= psd.division_id 
									 LEFT JOIN circles as c on c.id= psd.circle_id 
									 LEFT JOIN contractor_details as cd on cd.project_work_subdetail_id= psd.id 
									 LEFT JOIN project_financial_sanctions as fs on fs.project_work_id= project.id 
									 where psd.project_work_status_id >= 7 AND psd.fund_request_flag = 0 and psd.work_type = 1 and cd.projectwise_development_work_id is null  $condition  ";	
									 
			 $projectworkdetails     = $connection->execute($query)->fetchAll('assoc');	
			 
			 
		 }
		
	    $departments    = $this->Departments->find('list')->where(['Departments.is_active'=>1])->all();
        $financialYears = $this->FinancialYears->find('list')->where(['FinancialYears.is_active'=>1])->order('id DESC')->all();		
			
	   $this->set(compact('departments', 'financialYears','projectworkdetails','role_id','division_id','circle_id','projectworkdetailcount'));	
	}

    public function ajaxfundrequestadd($id = null , $i=null){	
		if($id != ''){
		 $connection = ConnectionManager::get('default');	
         $query      =  "SELECT psd.*,dis.name as district_name,dv.name as division_name,c.name as circle_name,cd.agreement_amount as agreement_amount,fs.go_no as fsgo_no,psd.fs_amount as fs_amount,psd.fs_excluding_sc as fs_excluding_sc
						 from project_work_subdetails as psd 
						 LEFT JOIN project_works as project on project.id = psd.project_work_id
						 LEFT JOIN districts as dis on dis.id= psd.district_id 
						 LEFT JOIN divisions as dv on dv.id= psd.division_id 
						 LEFT JOIN circles as c on c.id= psd.circle_id 
						 LEFT JOIN contractor_details as cd on cd.project_work_subdetail_id= psd.id 
						 LEFT JOIN project_financial_sanctions as fs on fs.project_work_id= project.id 

						 where psd.project_work_status_id >= 7  AND psd.id = ".$id."";	
									 
 		   $projectWorkSubdetail  = $connection->execute($query)->fetchAll('assoc'); 
		}		
    	   $this->set(compact('projectWorkSubdetail','i','id'));	
	}

    public function insertfundrequest(){
		$this->loadModel('ProjectFundRequests');	
		$this->loadModel('ProjectFundRequestStages');	
		$this->loadModel('ProjectFundRequestDetails');	
		$this->loadModel('ProjectFundRequestLogs');	
		$this->loadModel('ProjectFundRequestDetailLogs');	
		$this->loadModel('ProjectWorks');	
		$this->loadModel('Users');	
		$this->loadModel('ProjectwiseExpenditureDetails');	
		$this->loadModel('Notifications');	
		$user  = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;
		$user_id     = $user->id;  	
		
		if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>';  print_r($this->request->getData()); exit();
		  //forward to EE
		  $users   = $this->Users->find('all')->where(['Users.division_id'=>$division_id,'Users.role_id'=>4,'Users.is_active'=>1])->first();	
  		  $nextuser_id = $users['id'];	
		  
		   $projectFundRequest = $this->ProjectFundRequests->newEmptyEntity();		   
		   $projectFundRequest->fund_status_id            =  1;
		   $projectFundRequest->user_id                   =  $nextuser_id;
		   $projectFundRequest->request_month             =  date('Y-m');
		   $projectFundRequest->division_id               =  $division_id;
		   $projectFundRequest->request_date              =  date('Y-m-d', strtotime($this->request->getData('request_date')));
		   $projectFundRequest->total_request_amount      =  $this->request->getData('total_request_amount');
		   $projectFundRequest->created_by                =  $user->id;
		   $projectFundRequest->created_date              =  date('Y-m-d:h:m:s');		   
		    if ($this->ProjectFundRequests->save($projectFundRequest)) {
                    $insertid                = $projectFundRequest->id; 
					$projectFundRequestStage = $this->ProjectFundRequestStages->newEmptyEntity();					
					$projectFundRequestStage->project_fund_request_id           = $insertid;
					$projectFundRequestStage->user_id                           = $nextuser_id;             
					$projectFundRequestStage->fund_status_id                    = 1;
					$projectFundRequestStage->request_amount                    = $this->request->getData('total_request_amount');
					$projectFundRequestStage->forward_date                      = date('Y-m-d');
					$projectFundRequestStage->remarks                           = $this->request->getData('remarks');
					$projectFundRequestStage->created_by                        = $user->id;
                    $projectFundRequestStage->created_date                      = date('Y-m-d H:i:s');
					$this->ProjectFundRequestStages->save($projectFundRequestStage);
					
					
					$notification = $this->Notifications->newEmptyEntity();					
					$notification->forwarded_date                    = date('Y-m-d');
					$notification->forward_user_id                   = $user->id;
					$notification->recipient_user_id                 = $nextuser_id; 
					$notification->notification_type_id              = 1; 
					$notification->project_fund_request_id           = $insertid;
					$notification->created_by                        = $user->id;
                    $notification->created_date                      = date('Y-m-d H:i:s');
					$this->Notifications->save($notification);
					
					 $project = $this->request->getData('project');	
					  if(isset($project)){						 
						  foreach($project as $key1 => $value1){
                            $projectFundRequestDetails = $this->ProjectFundRequestDetails->newEmptyEntity();
							$projectFundRequestDetails->project_fund_request_id   = $insertid;
							$projectFundRequestDetails->project_work_id           = $value1['project_id'];
							$projectFundRequestDetails->project_work_subdetail_id = $value1['id'];             
							$projectFundRequestDetails->fund_status_id            = 1;
							$projectFundRequestDetails->request_amount            = $value1['request_amount'];
							$projectFundRequestDetails->balance_amount            = $value1['balance_amount'];
							$projectFundRequestDetails->created_by                = $user->id;
							$projectFundRequestDetails->created_date              = date('Y-m-d H:i:s');							  

							  if($this->ProjectFundRequestDetails->save($projectFundRequestDetails)){
								$subdetailTable                    = $this->getTableLocator()->get('ProjectWorkSubdetails');
								$subproject                        = $subdetailTable->get($value1['id']); 
								$subproject->fund_request_flag     = 1;  
								$subproject->expenditure_incurred  = $value1['expenditure_incurred'];     
								$subproject->fund_approval_user_id = $nextuser_id;  
								$subdetailTable->save($subproject);
								
								$projectwiseExpenditureDetail = $this->ProjectwiseExpenditureDetails->newEmptyEntity();
								$projectwiseExpenditureDetail->project_work_id           = $value1['project_id'];
								$projectwiseExpenditureDetail->project_work_subdetail_id = $value1['id'];
								$projectwiseExpenditureDetail->month                     =  date('Y-m');            
								$projectwiseExpenditureDetail->expenditure               = $value1['expenditure_incurred'];
								$projectwiseExpenditureDetail->created_by                = $user->id;
								$projectwiseExpenditureDetail->created_date              = date('Y-m-d H:i:s');							  
                                $this->ProjectwiseExpenditureDetails->save($projectwiseExpenditureDetail);
							  }
						  }
					  }
					   //logs
					   $projectFundRequestlog = $this->ProjectFundRequestLogs->newEmptyEntity();		   
					   $projectFundRequestlog->fund_status_id            =  1;
					   $projectFundRequestlog->user_id                   =  $nextuser_id;
					   $projectFundRequestlog->division_id               =  $division_id;
					   $projectFundRequestlog->request_date              =  date('Y-m-d', strtotime($this->request->getData('request_date')));
					   $projectFundRequestlog->total_request_amount      =  $this->request->getData('total_request_amount');
					   $projectFundRequestlog->created_by                =  $user->id;
					   $projectFundRequestlog->created_date              =  date('Y-m-d:h:m:s');
	   
					if ($this->ProjectFundRequestLogs->save($projectFundRequestlog)) {
						$insertid2                = $projectFundRequestlog->id;					
						$project1 = $this->request->getData('project');	
						if(isset($project1)){						 
						   foreach($project1 as $key2 => $value2){
								$projectFundRequestDetaillog = $this->ProjectFundRequestDetailLogs->newEmptyEntity();
								$projectFundRequestDetaillog->project_fund_request_log_id   = $insertid2;
								$projectFundRequestDetaillog->project_work_id           = $value2['project_id'];
								$projectFundRequestDetaillog->project_work_subdetail_id = $value2['id'];             
								$projectFundRequestDetaillog->fund_status_id            = 1;
								$projectFundRequestDetaillog->request_amount            = $value2['request_amount'];
								$projectFundRequestDetaillog->balance_amount            = $value2['balance_amount'];
								$projectFundRequestDetaillog->created_by                = $user->id;
								$projectFundRequestDetaillog->created_date              = date('Y-m-d H:i:s');							  
								$this->ProjectFundRequestDetailLogs->save($projectFundRequestDetaillog);					
							}
					   }						  
					} 					  
			    return $this->redirect(['action' => 'projectfundrequestlist']);
 			   }	   
		}
		exit();
	}

    public function projectfundrequestlist(){
		$this->viewBuilder()->setLayout('layout');
		$this->loadModel('ProjectFundRequests');	
		$this->loadModel('ProjectFundRequestStages');	
		$this->loadModel('ProjectFundRequestDetails');	
		$this->loadModel('ProjectWorks');	
		$this->loadModel('Users');	
		$this->loadModel('Divisions');	
		$user  = $this->request->getAttribute('identity');
		
		$role_id     = $user->role_id;
		$circle_id   = $user->circle_id;
		$currentuser_id     = $user->id;
		
		//print_r($role_id); exit();
		
		  if ($this->request->is(['patch', 'post', 'put'])) {			  
			  $request_month = $this->request->getData('request_month');	  
			  
			   if($role_id == 6 || $role_id == 8 || $role_id == 16){	
                    $division_id1   = $this->request->getData('division_id');			   
				    if($division_id1 != ''){
					 $projectFundRequests = $this->ProjectFundRequests->find('all')->contain(['FundStatuses', 'Users','Divisions', 'ProjectFundRequestDetails'])->where(['ProjectFundRequests.request_month' =>$request_month,'ProjectFundRequests.division_id'=>$division_id1])->toArray();
					}else{     				
					$projectFundRequests = $this->ProjectFundRequests->find('all')->contain(['FundStatuses', 'Users','Divisions', 'ProjectFundRequestDetails'])->where(['ProjectFundRequests.request_month' =>$request_month])->toArray();
				    }
				}elseif($role_id == 5){			
				 $division =  $this->Divisions->find('list',['keyField' => 'id', 'valueField' => 'id'])->where(['Divisions.circle_id'=>$circle_id,'Divisions.is_active'=>1])->toArray();
				 $projectFundRequests = $this->ProjectFundRequests->find('all')->contain(['FundStatuses', 'Users','Divisions', 'ProjectFundRequestDetails'])->where(['ProjectFundRequests.division_id IN'=>$division,'ProjectFundRequests.request_month' =>$request_month])->toArray();
				}else{
					$division_id = $user->division_id;
				    $projectFundRequests = $this->ProjectFundRequests->find('all')->contain(['FundStatuses', 'Users','Divisions', 'ProjectFundRequestDetails'])->where(['ProjectFundRequests.division_id'=>$division_id,'ProjectFundRequests.request_month' =>$request_month])->toArray();
				} 
		  
		  }else{
		
			   if($role_id == 6 || $role_id == 8 || $role_id == 16){		 
				   $projectFundRequests = $this->ProjectFundRequests->find('all')->contain(['FundStatuses', 'Users','Divisions', 'ProjectFundRequestDetails'])->toArray();
				}elseif($role_id == 5){
				 $division =  $this->Divisions->find('list',['keyField' => 'id', 'valueField' => 'id'])->where(['Divisions.circle_id'=>$circle_id,'Divisions.is_active'=>1])->toArray();
				 $projectFundRequests = $this->ProjectFundRequests->find('all')->contain(['FundStatuses', 'Users','Divisions', 'ProjectFundRequestDetails'])->where(['ProjectFundRequests.division_id IN'=>$division])->toArray();
				}else{
					$division_id = $user->division_id;
				   $projectFundRequests = $this->ProjectFundRequests->find('all')->contain(['FundStatuses', 'Users','Divisions', 'ProjectFundRequestDetails'])->where(['ProjectFundRequests.division_id'=>$division_id])->toArray();
				}
		  }		  
		 
		
		if($role_id == 15){
			
		 $requestcount = $this->ProjectFundRequests->find('all')->where(['ProjectFundRequests.division_id'=>$division_id,'ProjectFundRequests.request_month'=>date('Y-m')])->count();

		 // print_r($requestcount); exit();	 
			 
		}

 		$divisions = $this->Divisions->find('list')->where(['Divisions.is_active'=>1])->toArray();

		 
     $this->set(compact('projectFundRequests','role_id','division_id','circle_id','currentuser_id','divisions','requestcount'));	
	}
	
	public function projectfundrequestview($id = null){
		$this->viewBuilder()->setLayout('layout');
		$this->loadModel('ProjectFundRequests');	
		$this->loadModel('ProjectFundRequestStages');	
		$this->loadModel('ProjectFundRequestDetails');	
		$this->loadModel('ProjectWorks');	
		$user  = $this->request->getAttribute('identity');
		
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;
		$currentuser_id     = $user->id;
		
		$projectFundRequest = $this->ProjectFundRequests->find('all')->contain(['FundStatuses', 'Users','Divisions', 'ProjectFundRequestDetails'])->where(['ProjectFundRequests.id'=>$id])->first();
	   	$connection = ConnectionManager::get('default');	
        $query      =  "SELECT frd.request_amount,frd.balance_amount,psd.*,dis.name as district_name,dv.name as division_name,c.name as circle_name,cd.agreement_amount as agreement_amount,frd.project_work_subdetail_id as work_id,frd.id as request_detail_id,frd.transaction_amount as transaction_amount,frd.final_balance as final_balance,fs.go_no as fsgo_no,frd.id as request_id,psd.fs_amount as fs_amount,psd.fs_excluding_sc as fs_excluding_sc
						 from project_fund_request_details as frd 
						 LEFT JOIN project_work_subdetails as psd on psd.id= frd.project_work_subdetail_id 
						 LEFT JOIN project_works as project on project.id = psd.project_work_id
						 LEFT JOIN districts as dis on dis.id= psd.district_id 
						 LEFT JOIN divisions as dv on dv.id= psd.division_id 
						 LEFT JOIN circles as c on c.id= psd.circle_id 
						 LEFT JOIN contractor_details as cd on cd.project_work_subdetail_id= psd.id 
						 LEFT JOIN project_financial_sanctions as fs on fs.project_work_id= project.id 
						 where psd.project_work_status_id >= 7  AND frd.project_fund_request_id = ".$id."";	
									 
 	  $projectFundRequestdetails = $connection->execute($query)->fetchAll('assoc');    
	  $projectFundRequeststages  = $this->ProjectFundRequestStages->find('all')->contain(['FundStatuses'])->where(['ProjectFundRequestStages.project_fund_request_id'=>$id])->toArray();
	
	  $this->set(compact('fundStatuses','projectFundRequest','projectFundRequestdetails','projectFundRequeststages','role_id','division_id','circle_id','currentuser_id'));	
	}
    
	public function projectfundrequestapproval($id = null){
		$this->viewBuilder()->setLayout('layout');
		$this->loadModel('ProjectFundRequests');	
		$this->loadModel('ProjectFundRequestStages');	
		$this->loadModel('ProjectFundRequestDetails');	
		$this->loadModel('ProjectWorks');	
		$this->loadModel('Users');	
		$this->loadModel('Divisions');	
		$this->loadModel('FundStatuses');	
		$this->loadModel('OpeningBalanceDetails');	
		$this->loadModel('OpeningBalanceLogs');	
		$this->loadModel('ProjectFundRequestLogs');	
		$this->loadModel('ProjectFundRequestDetailLogs');	
		$this->loadModel('Notifications');	
		$user  = $this->request->getAttribute('identity');
		
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;
		$currentuser_id     = $user->id;
        $projectFundRequest = $this->ProjectFundRequests->find('all')->where(['ProjectFundRequests.id'=>$id])->first();
	  
	   	 $connection = ConnectionManager::get('default');	
         $query      =  "SELECT frd.request_amount,frd.balance_amount,psd.*,dis.name as district_name,dv.name as division_name,c.name as circle_name,cd.agreement_amount as agreement_amount,frd.project_work_subdetail_id as work_id,frd.id as request_detail_id,frd.transaction_amount as transaction_amount,frd.final_balance as final_balance,fs.go_no as fsgo_no,project.id as project_id,psd.fs_amount as fs_amount,psd.fs_excluding_sc as fs_excluding_sc
						 from project_fund_request_details as frd  
						 LEFT JOIN project_work_subdetails as psd on psd.id= frd.project_work_subdetail_id 
						 LEFT JOIN project_works as project on project.id = psd.project_work_id
						 LEFT JOIN districts as dis on dis.id= psd.district_id 
						 LEFT JOIN divisions as dv on dv.id= psd.division_id 
						 LEFT JOIN circles as c on c.id= psd.circle_id 
						 LEFT JOIN contractor_details as cd on cd.project_work_subdetail_id= psd.id 
						 LEFT JOIN project_financial_sanctions as fs on fs.project_work_id= project.id 
						 where psd.project_work_status_id >= 7  AND frd.project_fund_request_id = ".$id."";	
									 
 	  $projectFundRequestdetails = $connection->execute($query)->fetchAll('assoc');   
	  $projectFundRequeststages  = $this->ProjectFundRequestStages->find('all')->contain(['FundStatuses'])->where(['ProjectFundRequestStages.project_fund_request_id'=>$id])->toArray();
		
      if ($this->request->is(['patch', 'post', 'put'])) { 
	  
	  	          $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $currentuser_id,'Notifications.project_fund_request_id'=>$id,'Notifications.process_done'=>0])->count();
	              // echo '<pre>';  print_r($notification_count); exit();
				   if($notification_count == 1){   
	  	                   $notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $currentuser_id,'Notifications.project_fund_request_id'=>$id,'Notifications.process_done'=>0])->first();

    						$notificationTable                  = $this->getTableLocator()->get('Notifications');
							$notification                       = $notificationTable->get($notification_id['id']); 
							$notification->notification_seen	= 1;  
							$notification->process_done	        = 1;  
							$notificationTable->save($notification);
				 	}
	     
	           if($this->request->getData('fund_status_id') == 2){
				  //forward to SE
				  $division =  $this->Divisions->find('all')->where(['Divisions.id'=>$division_id,'Divisions.is_active'=>1])->first();
				  $circle_id = $division['circle_id'];
				 // print_r($circle_id); exit();
				  $users   = $this->Users->find('all')->where(['Users.circle_id'=>$circle_id,'Users.role_id'=>5,'Users.is_active'=>1])->first();	
  				  $user_id = $users['id'];
			   }else if($this->request->getData('fund_status_id') == 3){
				    //forward to CE
				  $users  = $this->Users->find('all')->where(['Users.role_id'=>6,'Users.is_active'=>1])->first();
				  $user_id = $users['id'];				   
			   }else if($this->request->getData('fund_status_id') == 4){
				    //forward to HO Accounts
				  $users  = $this->Users->find('all')->where(['Users.role_id'=>16,'Users.is_active'=>1])->first();
                  $user_id = $users['id']; 				   
			   }/*else if($this->request->getData('fund_status_id') == 4){
				    //forward to GM
				  $users  = $this->Users->find('all')->where(['Users.role_id'=>8,'Users.is_active'=>1])->first();
                  $user_id = $users['id']; 				   
			   }*/else if($this->request->getData('fund_status_id') == 5){
				    //forward to Division Accounts
				  $users   = $this->Users->find('all')->where(['Users.division_id'=>$projectFundRequest['division_id'],'Users.role_id'=>15,'Users.is_active'=>1])->first();
                  $user_id = $users['id']; 	
                // print_r($users); exit();				  
			   }	

                 if($role_id == 16 || $projectFundRequest['is_approved'] == 0){	
					$notification = $this->Notifications->newEmptyEntity();					
					$notification->forwarded_date                    = date('Y-m-d');
					$notification->forward_user_id                   = $currentuser_id;
					$notification->recipient_user_id                 = $user_id; 
					$notification->notification_type_id              = 1; 
					$notification->project_fund_request_id           = $id;
					$notification->created_by                        = $user->id;
                    $notification->created_date                      = date('Y-m-d H:i:s');
					$this->Notifications->save($notification);	
				 }					
			   
			   if(($role_id == 4 || $role_id == 5 || $role_id == 6) && ($projectFundRequest['is_approved'] == 0)){				 
				  	$projectFundRequestStage = $this->ProjectFundRequestStages->newEmptyEntity();					
					$projectFundRequestStage->project_fund_request_id           = $this->request->getData('request_id');
					$projectFundRequestStage->user_id                           = $user_id;             
					$projectFundRequestStage->fund_status_id                    = $this->request->getData('fund_status_id');
					$projectFundRequestStage->request_amount                    = $this->request->getData('total_request_amount');
					$projectFundRequestStage->forward_date                      = date('Y-m-d');
					$projectFundRequestStage->remarks                           = $this->request->getData('remarks');
					$projectFundRequestStage->created_by                        = $user->id;
                    $projectFundRequestStage->created_date                      = date('Y-m-d H:i:s');
					// echo "<pre>" ; print_r($projectFundRequestStage); exit();
					if($this->ProjectFundRequestStages->save($projectFundRequestStage)){						
					 $project = $this->request->getData('project');	
					  if(isset($project)){						 
						  foreach($project as $key1 => $value1){						
						    $subdetailTable                     = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$subproject                         = $subdetailTable->get($value1['id']); 
							$subproject->fund_approval_user_id	= $user_id;  
							$subdetailTable->save($subproject);						
							
							$reqsubdetailTable                        = $this->getTableLocator()->get('ProjectFundRequestDetails');
							$reqsubproject                            = $reqsubdetailTable->get($value1['subrequest_id']); 
							$reqsubproject->request_amount            = $value1['request_amount'];
							$reqsubproject->balance_amount            = $value1['balance_amount'];  
							$reqsubdetailTable->save($reqsubproject);
						  }  
					  }    
                          //logs
                        if($this->request->getData('total_request_amount') != $projectFundRequest['total_request_amount']){
							   $projectFundRequestlog = $this->ProjectFundRequestLogs->newEmptyEntity();		   
							   $projectFundRequestlog->fund_status_id            =  $this->request->getData('fund_status_id');
							   $projectFundRequestlog->user_id                   =  $user_id;
							   $projectFundRequestlog->division_id               =  $projectFundRequest['division_id'];
							   $projectFundRequestlog->request_date              =  $projectFundRequest['request_date'];
							   $projectFundRequestlog->total_request_amount      =  $this->request->getData('total_request_amount');
							   $projectFundRequestlog->created_by                =  $user->id;
							   $projectFundRequestlog->created_date              =  date('Y-m-d:h:m:s');
			   
							if ($this->ProjectFundRequestLogs->save($projectFundRequestlog)) {
								$insertid2                = $projectFundRequestlog->id;					
								//$project1 = $this->request->getData('project');	
								if(isset($project)){						 
								   foreach($project as $key2 => $value2){
										$projectFundRequestDetaillog = $this->ProjectFundRequestDetailLogs->newEmptyEntity();
										$projectFundRequestDetaillog->project_fund_request_log_id   = $insertid2;
										$projectFundRequestDetaillog->project_work_id           = $value2['project_id'];
										$projectFundRequestDetaillog->project_work_subdetail_id = $value2['id'];             
										$projectFundRequestDetaillog->fund_status_id            = $this->request->getData('fund_status_id');
										$projectFundRequestDetaillog->request_amount            = $value2['request_amount'];
										$projectFundRequestDetaillog->balance_amount            = $value2['balance_amount'];
										$projectFundRequestDetaillog->created_by                = $user->id;
										$projectFundRequestDetaillog->created_date              = date('Y-m-d H:i:s');							  
										$this->ProjectFundRequestDetailLogs->save($projectFundRequestDetaillog);					
									}
							   }						  
							}
						 }

						$Table                             = $this->getTableLocator()->get('ProjectFundRequests');
						$reqproject                        = $Table->get($this->request->getData('request_id')); 
						$reqproject->user_id	           = $user_id;  
						$reqproject->total_request_amount  = $this->request->getData('total_request_amount'); 
						$reqproject->fund_status_id        = $this->request->getData('fund_status_id');
						$Table->save($reqproject);						 

                    $this->Flash->success(__('The Fund request Approval has been saved.'));
                    return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectfundrequestlist']);
                  }else{
                    $this->Flash->error(__('The Fund request Approval could not be saved. Please, try again.'));
                  }			 
				 
			 }else if($role_id == 16){				 
				  	$projectFundRequestStage = $this->ProjectFundRequestStages->newEmptyEntity();					
					$projectFundRequestStage->project_fund_request_id           = $this->request->getData('request_id');
					$projectFundRequestStage->user_id                           = ($user_id)?$user_id:0;             
					$projectFundRequestStage->fund_status_id                    = $this->request->getData('fund_status_id');
				    $projectFundRequestStage->request_amount                    = $this->request->getData('transaction_amount');
					$projectFundRequestStage->forward_date                      = date('Y-m-d');
					$projectFundRequestStage->remarks                           = $this->request->getData('remarks');
					$projectFundRequestStage->created_by                        = $user->id;
                    $projectFundRequestStage->created_date                      = date('Y-m-d H:i:s');
					 //echo "<pre>" ; print_r($projectFundRequestStage); exit();
					if($this->ProjectFundRequestStages->save($projectFundRequestStage)){						  
					 $project = $this->request->getData('project1');	
							if(isset($project)){						 
							  foreach($project as $key1 => $value1){							
								$subdetailTable                     = $this->getTableLocator()->get('ProjectWorkSubdetails');
								$subproject                         = $subdetailTable->get($value1['id']); 
								$subproject->fund_approval_user_id	= $user_id;  
								$subproject->balance_payment	    = $value1['final_balance'];  
								$subdetailTable->save($subproject);							
								
								$requestdetailTable                 = $this->getTableLocator()->get('ProjectFundRequestDetails');
								$resdetail                          = $requestdetailTable->get($value1['request_detail_id']); 
								$resdetail->transaction_amount	    = $value1['transaction_amount'];  
								$resdetail->final_balance	        = $value1['final_balance'];  
								$requestdetailTable->save($resdetail);
							  }
							}	  
					    
                            $RequestTable                = $this->getTableLocator()->get('ProjectFundRequests');
							$requests                    = $RequestTable->get($id);                          							   
							if($this->request->getData('fund_status_id') == 5){
                               $requests->is_approved	= 1; 
							   $requests->user_id	           = $user_id;
                   			   $requests->transaction_ref_no   = $this->request->getData('transaction_ref_no');
							   $requests->transaction_date     = date('Y-m-d',strtotime($this->request->getData('transaction_date')));  
							   $requests->total_transaction_amount   = $this->request->getData('transaction_amount');  			   
							   $requests->approval_date	       = date('Y-m-d');  
							}elseif($this->request->getData('fund_status_id') == 6){
                               $requests->is_approved	= 2;  
							}	
							  $requests->fund_status_id        = $this->request->getData('fund_status_id');

							$RequestTable->save($requests);							
				
                    $this->Flash->success(__('The Fund request Approval has been saved.'));
                    return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectfundrequestlist']);
                  }else{
                    $this->Flash->error(__('The Fund request Approval could not be saved. Please, try again.'));
                  }			 
			 } else if(($role_id == 15) && ($projectFundRequest['is_approved'] != 0)){	 
				 
				   $projectFundRequestStage = $this->ProjectFundRequestStages->newEmptyEntity();
					
					$projectFundRequestStage->project_fund_request_id           = $this->request->getData('request_id');
					$projectFundRequestStage->user_id                           = null;             
					$projectFundRequestStage->fund_status_id                    = $this->request->getData('fund_status_id');
					$projectFundRequestStage->forward_date                      = date('Y-m-d');
					if($this->request->getData('fund_status_id') == 7){
					$projectFundRequestStage->remarks                           = $this->request->getData('received_remarks');
					}elseif($this->request->getData('fund_status_id') == 8){
					$projectFundRequestStage->remarks                           = $this->request->getData('notreceived_remarks');
					}
					$projectFundRequestStage->created_by                        = $user->id;
                    $projectFundRequestStage->created_date                      = date('Y-m-d H:i:s');
					// echo "<pre>" ; print_r($projectFundRequestStage); exit();
					if($this->ProjectFundRequestStages->save($projectFundRequestStage)){				 
				            $RequestTable                = $this->getTableLocator()->get('ProjectFundRequests');
					 		$requests                    = $RequestTable->get($id); 
						    $requests->fund_status_id        = $this->request->getData('fund_status_id');
						    if($this->request->getData('fund_status_id') == 7){								
							   $requests->amount_received_date   = date('Y-m-d',strtotime($this->request->getData('amount_received_date')));  
							   $requests->received_flag	         = 1;  
							   $requests->user_id	             = null;  
							   $requests->remarks	             = $this->request->getData('received_remarks'); 

							}elseif($this->request->getData('fund_status_id') == 8){
                              $requests->received_flag	         = 2;  
                              $requests->remarks	         = $this->request->getData('notreceived_remarks'); 
							}	
							$RequestTable->save($requests);
							
							$project = $this->request->getData('project');	
							if(isset($project)){						 
								foreach($project as $key1 => $value1){
								
								$subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
								$project                        = $subdetailTable->get($value1['id']);                         						   
								$project->fund_approval_user_id	= 0; 
								$project->fund_request_flag	    = 0;  								
								$subdetailTable->save($project);
								}
							}
						
							$this->Flash->success(__('The Fund request Approval has been saved.'));
                          return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectfundrequestlist']);
                      }else{
                       $this->Flash->error(__('The Fund request Approval could not be saved. Please, try again.'));

					  }						  
			   }  	  
	    }
	  
	  
	    if($role_id == 16){	   
			$fundStatuses = $this->FundStatuses->find('list')->where(['FundStatuses.id IN'=>[5,6]])->all();
		}else if($role_id == 15){	  
		  $fundStatuses   = $this->FundStatuses->find('list')->where(['FundStatuses.id IN'=>[7,8]])->all();
		}  
	  
       $this->set(compact('fundStatuses','projectFundRequest','projectFundRequestdetails','projectFundRequeststages','role_id','division_id','circle_id','currentuser_id'));	
    }
		
	public function projectabstractadd($id = null,$work_id = null)  
    {  
    $this->viewBuilder()->setLayout('layout');
    $this->loadModel('ProjectwiseAbstractDetails');
    $this->loadModel('ProjectwiseAbstractSubdetails');
    $this->loadModel('DetailedEstimateApprovalStages');
    $this->loadModel('Users');
    $this->loadModel('BuildingItems');
    $this->loadModel('NewBuildingItems');
    $this->loadModel('ProjectWorkSubdetails');
    $this->loadModel('Units');
    $this->loadModel('TechnicalSanctions');
    $this->loadModel('Notifications');
    $user = $this->request->getAttribute('identity');
	$role_id     = $user->role_id;
    $division_id = $user->division_id;

	 $projectWorkSubdetail  = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id'=>$work_id])->first();
	 $abstractcount   = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
	 //print_r($abstractcount); exit();
	 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
	 if($abstractcount != 0){
	 
	   $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['NewBuildingItems','Units'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
	   $subabstractcount = $this->ProjectwiseAbstractSubdetails->find('all')->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->count();
	  }
	  
	 $detailed_approval_stages_count  = $this->DetailedEstimateApprovalStages->find('all')->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->count();
     $detailed_approval_stages        = $this->DetailedEstimateApprovalStages->find('all')->contain(['ApprovalStatuses'])->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->toArray();
	
	
	    $connection               = ConnectionManager::get('default');
        $query                    =  "SELECT sum(projectsub.amount) as total_amount
                                     from projectwise_abstract_subdetails as projectsub
                                     LEFT JOIN projectwise_abstract_details as project on project.id = projectsub.projectwise_abstract_detail_id
                                     where project.project_work_id = '".$id."' AND project.project_work_subdetail_id = '".$work_id."' and projectsub.is_active = 1";
									 
       $Totalamount             = $connection->execute($query)->fetchAll('assoc');
	   
	  // print_r($Totalamount); exit();
	   
	   $tot_amount =  $Totalamount[0]['total_amount'];
	  
    if ($this->request->is(['patch', 'post', 'put'])) {
		// echo "<pre>";  print_r($this->request->getData()); exit();
		$completed_flag = $this->request->getData('completed_flag');
		
		if($completed_flag == 1){	
		   $technicalSanction = $this->TechnicalSanctions->newEmptyEntity();		     
			$attachment  = $this->request->getData('detailed_estimate_upload');
			 if ($attachment->getClientFilename() != '') {
				 $name    = $attachment->getClientFilename();
				 $type    = $attachment->getClientMediaType();
				 $size    = $attachment->getSize();
				 $tmpName = $attachment->getStream()->getMetadata('uri');
				 $error   = $attachment->getError();

				 if ($name != '' && $error == 0) {
					 $file                                     = $name;
					 $array                                    = explode('.', $file);
					 $fileExt                                  = $array[count($array) - 1];
					 $current_time                             = date('Y_m_d_H_i_s');
					 $newfile                                  = "Technicalsaction_" . $current_time . "." . $fileExt;
					 $tempFile                                 = $tmpName;
					 $targetPath                               = 'uploads/technicalsanctions/';
					 $targetFile                               = $targetPath . $newfile;
					 $technicalSanction->detailed_estimate_upload        = $newfile;
					 move_uploaded_file($tempFile, $targetFile);

				 }
			 } 

             $technicalSanction->project_work_id           = $id;
             $technicalSanction->project_work_subdetail_id = $work_id;
		     $technicalSanction->sanction_no               = $this->request->getData('sanction_no');
             $technicalSanction->sanctioned_date            = date('Y-m-d', strtotime($this->request->getData('sanctioned_date')));
             $technicalSanction->description               = $this->request->getData('description');
             $technicalSanction->amount                    = $this->request->getData('amount');
             $technicalSanction->created_by                = $user->id;
             $technicalSanction->created_date              = date('Y-m-d H:i:s');
         
             if($this->TechnicalSanctions->save($technicalSanction)){
				 
	  
			        $subdetailTable                           = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                                  = $subdetailTable->get($projectWorkSubdetail['id']); 
					$project->detailed_estimate_current_role  = $projectWorkSubdetail['approval_role']; 
					if($projectWorkSubdetail['work_type'] == 2){
					$project->fs_amount                       = $this->request->getData('amount');	
					$project->sanctioned_amount               = $this->request->getData('amount');	
						
					}
					$project->abstract_amount                 =  $this->request->getData('abstract_amount');
					if($this->request->getData('amount') <= 600000){
						$project->approval_role                 =  4;
					}else if($this->request->getData('amount') > 600000 && $this->request->getData('amount') <= 3000000){
						$project->approval_role                 =  5;			
					}else if($this->request->getData('amount') > 3000000){
						$project->approval_role                 =  6;  					
					}					
					$project->project_work_status_id          =  7;  
					$subdetailTable->save($project);
						
				$users  = $this->Users->find('all')->where(['Users.role_id'=>$project->approval_role,'Users.is_active'=>1])->first();
				$user_id = $users['id'];
					
				$detailedEstimateApprovalStage = $this->DetailedEstimateApprovalStages->newEmptyEntity();	
				$detailedEstimateApprovalStage->project_work_id           = $id;
				$detailedEstimateApprovalStage->project_work_subdetail_id = $work_id;
				$detailedEstimateApprovalStage->user_id	                  = $user_id;
				$detailedEstimateApprovalStage->current_role_id           = $projectWorkSubdetail['approval_role'];				
				
				if($this->request->getData('amount') <= 600000){
					$detailedEstimateApprovalStage->current_status            = 'Forwarded to EE';
				}else if($this->request->getData('amount') > 600000 && $this->request->getData('amount') <= 3000000){
					$detailedEstimateApprovalStage->current_status            = 'Forwarded to SE'; 				
				}else if($this->request->getData('amount') > 3000000){
					$detailedEstimateApprovalStage->current_status            = 'Forwarded to CE';  					
				}
				
				$detailedEstimateApprovalStage->approval_status_id        = 1;
				$detailedEstimateApprovalStage->submit_date               = date('Y-m-d');
				$detailedEstimateApprovalStage->created_by                = $user->id;
                $detailedEstimateApprovalStage->created_date               = date('Y-m-d H:i:s');
			   //echo "<pre>";  print_r($detailedEstimateApprovalStage); exit();
			 if ($this->DetailedEstimateApprovalStages->save($detailedEstimateApprovalStage)) {	

                    $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>6])->count();
				  // echo '<pre>';  print_r($notification_count); exit();
				   if($notification_count == 1){   
						$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>6])->first();

						$notificationTable                  = $this->getTableLocator()->get('Notifications');
						$notification                       = $notificationTable->get($notification_id['id']); 
						$notification->notification_seen	= 1;  
						$notification->process_done	        = 1;  
						$notificationTable->save($notification);
							if($project->approval_role == 4){
								$recipient_user = $this->Users->find('all')->where(['Users.role_id'=>$project->approval_role,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
							}else if($project->approval_role == 5){
								$recipient_user = $this->Users->find('all')->where(['Users.role_id'=>$project->approval_role,'Users.circle_id'=>$projectWorkSubdetail['circle_id'],'Users.is_active'=>1])->first();
							}else if($project->approval_role == 6){
								$recipient_user = $this->Users->find('all')->where(['Users.role_id'=>$project->approval_role,'Users.is_active'=>1])->first();
							}
							$recipient_user_id = $recipient_user['id'];
							$notification = $this->Notifications->newEmptyEntity();					
							$notification->forwarded_date                    = date('Y-m-d');
							$notification->forward_user_id                   = $user->id;
							$notification->recipient_user_id                 = $recipient_user_id; 
							$notification->notification_type_id              = 7; 
							$notification->project_work_id                   = $id;
							$notification->project_work_subdetail_id         = $work_id;
							 if($notification_id['work_type'] == 2){	
							   $notification->work_type                         = 2;
							}
							$notification->created_by                        = $user->id;
							$notification->created_date                      = date('Y-m-d H:i:s');				
							$this->Notifications->save($notification);
				    	}			 
		        $this->Flash->success(__('The project Abstract Estimate /Technical Sanction has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/1']);
			  }
			}
			
		}else{
		
        if($abstractcount == 0){
        $abstractdetail = $this->ProjectwiseAbstractDetails->newEmptyEntity();
		}else{
		$abstractdetail = $this->ProjectwiseAbstractDetails->get($abstract_detail['id'], [
						'contain' => [],
					]);
		}			
        $abstractdetail->project_work_id           = $id;
        $abstractdetail->project_work_subdetail_id = $work_id;
        $abstractdetail->development_work_id       = 0;
		if($abstractcount == 0){
          $abstractdetail->created_by                = $user->id;
          $abstractdetail->created_date              = date('Y-m-d H:i:s');
		}else{
		  $abstractdetail->modified_by                = $user->id;
          $abstractdetail->modified_date              = date('Y-m-d H:i:s');
		}
         
		//echo "<pre>"; print_r($abstractdetail); exit();

        if ($this->ProjectwiseAbstractDetails->save($abstractdetail)) { 
			   if($abstractcount == 0){		
				 $insert_id = $abstractdetail->id;		
				}else{
				 $insert_id = $abstract_detail['id'];		
				}			 
			 
            foreach ($this->request->getData('workdetail') as $key => $answer) {
                $abstractsubdetail = $this->ProjectwiseAbstractSubdetails->newEmptyEntity();
                $abstractsubdetail->projectwise_abstract_detail_id  = $insert_id;
                // $abstractsubdetail->building_item_id    = ($answer['building_item_id'])?$answer['building_item_id']:0;
                // $abstractsubdetail->item_code           = ($answer['item_code'])?$answer['item_code']:0;
				// if($this->request->getData('type') == 0){
                // $abstractsubdetail->item_description    = $answer['item_description'];
				// }else{
                // $abstractsubdetail->item_description    = $answer['item_description1'];
				// }
				$abstractsubdetail->new_building_item_id   = ($answer['building_item_id'])?$answer['building_item_id']:0;
				$abstractsubdetail->new_item_code          = ($answer['item_code'])?$answer['item_code']:0;				
				$abstractsubdetail->new_item_description   = $answer['item_description'];
				$abstractsubdetail->quantity               = $answer['quantity'];
                $abstractsubdetail->unit_id                = $answer['unit_id'];
                $abstractsubdetail->rate                   = $answer['rate'];
                $abstractsubdetail->amount                 = ($answer['amount'] != 0)?$answer['amount']:'';
                $abstractsubdetail->created_by             = $user->id;
                $abstractsubdetail->created_date           = date('Y-m-d H:i:s');				
				//echo "<pre>"; print_r($abstractsubdetail); exit();
                $this->ProjectwiseAbstractSubdetails->save($abstractsubdetail);  
            }

               $this->Flash->success(__('The project Abstract detail has been saved.'));
              return $this->redirect(['action' => 'projectabstractadd/'.$id.'/'.$work_id]);

        }
        $this->Flash->error(__('The project Abstract detail could not be saved. Please, try again.'));
		
		}
    }
	
     //print_r($entered_id); exit();
	 /*if($abstractcount == 0 || $subabstractcount == 0){
      $buildingItems     = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->all();
     }else if($abstractcount != 0 && $subabstractcount > 0){
	  $entered_id     = $this->ProjectwiseAbstractSubdetails->find('list',['keyField' => 'building_item_id','valueField' =>'building_item_id'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1,'ProjectwiseAbstractSubdetails.building_item_id !='=>0])->toArray();
      $buildingItems  = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->where(['BuildingItems.id NOT IN'=>$entered_id])->all();
     }*/
	 
	     $buildingItems     = $this->NewBuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->order(['NewBuildingItems.building_item_type_id ASC'])->toArray();
	 
	 
	  $units = $this->Units->find('list', ['limit' => 200])->all();

	$this->set(compact('subabstractcount','tot_amount','units','projectDevelopmentWorkDetail', 'projectWorks','buildingItems','projectWorkSubdetails', 'developmentWorks','id','work_id','abstract_subdetails','detailed_approval_stages_count','detailed_approval_stages','abstractcount','projectWorkSubdetail'));
    }
	
	public function projectabstractedit($id = null,$work_id = null,$abstract_id = null)
    {  
    $this->viewBuilder()->setLayout('layout');
    $this->loadModel('ProjectwiseAbstractDetails');
    $this->loadModel('ProjectwiseAbstractSubdetails');
    $this->loadModel('BuildingItems');
    $this->loadModel('NewBuildingItems');
    $this->loadModel('Units');
    $user = $this->request->getAttribute('identity');	
	$role_id     = $user->role_id;
		$division_id = $user->division_id;


	 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['NewBuildingItems'])->where(['ProjectwiseAbstractSubdetails.id'=>$abstract_id,'ProjectwiseAbstractSubdetails.is_active'=>1])->toArray();
	  $abstract_detail_id = $abstract_subdetails[0]['projectwise_abstract_detail_id'];
    if ($this->request->is(['patch', 'post', 'put'])) { //echo "<pre>";  print_r($this->request->getData()); exit();
   
            foreach ($this->request->getData('workdetail') as $key => $answer) {
                //$abstractsubdetail = $this->ProjectwiseAbstractSubdetails->newEmptyEntity();
				$abstractsubdetail = $this->ProjectwiseAbstractSubdetails->get($abstract_id, [
						'contain' => [],
					]);
		   		
                $abstractsubdetail->projectwise_abstract_detail_id  = $abstract_detail_id;
                // $abstractsubdetail->building_item_id    = ($answer['building_item_id'])?$answer['building_item_id']:'0';
                // $abstractsubdetail->item_code           = ($answer['item_code'])?$answer['item_code']:'0';
                // $abstractsubdetail->item_description    = $answer['item_description'];
				$abstractsubdetail->new_building_item_id    = ($answer['building_item_id'])?$answer['building_item_id']:'0';
                $abstractsubdetail->new_item_code           = ($answer['item_code'])?$answer['item_code']:'0';
                $abstractsubdetail->new_item_description    = $answer['item_description'];
                $abstractsubdetail->quantity                = $answer['quantity'];
				$abstractsubdetail->unit_id                 = $answer['unit_id'];
                $abstractsubdetail->rate                    = $answer['rate'];
                $abstractsubdetail->amount                  = $answer['amount'];
                $abstractsubdetail->modified_by             = $user->id;
                $abstractsubdetail->modified_date           = date('Y-m-d H:i:s');
				//echo "<pre>";  print_r($abstractsubdetail); exit();
                $this->ProjectwiseAbstractSubdetails->save($abstractsubdetail);
                }				
           // }

            $this->Flash->success(__('The project Abstract detail has been updated.'));
			
			if($role_id == 6){
			 return $this->redirect(['action' => 'projectabstractapproval/'.$id.'/'.$work_id]);
			}else{
              return $this->redirect(['action' => 'projectabstractadd/'.$id.'/'.$work_id]);
			}
           
        }
    
     // $buildingItems     = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->all();
	  $buildingItems     = $this->NewBuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->order(['NewBuildingItems.building_item_type_id ASC'])->toArray();
	  	         $units = $this->Units->find('list', ['limit' => 200])->all();

	$this->set(compact('units','projectDevelopmentWorkDetail', 'projectWorks','buildingItems','projectWorkSubdetails', 'developmentWorks','id','work_id','abstract_subdetails'));
    }
		
   public function projectabstractapproval($id = null,$work_id = null)
   {	   
	$this->viewBuilder()->setLayout('layout');
    $this->loadModel('ProjectwiseAbstractDetails');
    $this->loadModel('ProjectwiseAbstractSubdetails');
    $this->loadModel('DetailedEstimateApprovalStages');
    $this->loadModel('Users');
    $this->loadModel('BuildingItems');
    $this->loadModel('ProjectWorkSubdetails');
    $this->loadModel('ApprovalStatuses');
    $this->loadModel('TechnicalSanctions');
    $this->loadModel('Notifications');
    $user = $this->request->getAttribute('identity');	
	$role_id     = $user->role_id;
	$division_id = $user->division_id;	
	
	 $projectWorkSubdetail            = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id'=>$work_id])->first();
	 $abstractcount   = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
	 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
	 if($abstractcount > 0){
	    $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['NewBuildingItems'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
	 } 

     $technicalcount                  = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
     $technical                       = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
     $detailed_approval_stages_count  = $this->DetailedEstimateApprovalStages->find('all')->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->count();
     $detailed_approval_stages        = $this->DetailedEstimateApprovalStages->find('all')->contain(['ApprovalStatuses'])->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->toArray();
	
	   
        if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>';  print_r($this->request->getData()); exit();
                $approval_status_id =  $this->request->getData('approval_status_id');	
				
                if($approval_status_id == 1 || $approval_status_id == 3){					
                      $user_id = 0;	
					  $next_role_id    = 0;
					  if($role_id == 4){
					  $status = 'EE Approved';
					  }else if($role_id == 5){
					  $status = 'SE Approved';
					   }else if($role_id == 6){
					   $status = 'CE Approved';
					   }							  
					
				}			
					
				$detailedEstimateApprovalStage = $this->DetailedEstimateApprovalStages->newEmptyEntity();	
				$detailedEstimateApprovalStage->project_work_id           = $id;
				$detailedEstimateApprovalStage->project_work_subdetail_id = $work_id;
				$detailedEstimateApprovalStage->user_id	                  = $user_id;
				$detailedEstimateApprovalStage->current_role_id           = $next_role_id;
				$detailedEstimateApprovalStage->current_status            = $status;
				$detailedEstimateApprovalStage->approval_status_id        = $approval_status_id;
				$detailedEstimateApprovalStage->remarks                   = $this->request->getData('remarks');
				$detailedEstimateApprovalStage->submit_date               = date('Y-m-d');
				$detailedEstimateApprovalStage->created_by                = $user->id;
                $detailedEstimateApprovalStage->created_date              = date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($detailedEstimateApprovalStage); exit();
			  if ($this->DetailedEstimateApprovalStages->save($detailedEstimateApprovalStage)) {
                   $subdetailTable                   = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                          = $subdetailTable->get($projectWorkSubdetail['id']); 
					$project->detailed_estimate_current_role  = $next_role_id;
                    if($this->request->getData('approval_status_id') == 1){
					  $project->detailed_estimate_approval = 1;
				 	  $project->project_work_status_id     = 8; 
				      $project->is_approved                = 1;
					  $project->ts_approved_date           = date('Y-m-d');
					}else if($this->request->getData('approval_status_id') == 2){
                      $project->detailed_estimate_flag  = 0;
					}						
					$subdetailTable->save($project); 
					
					
					  $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>7])->count();
				  // echo '<pre>';  print_r($notification_count); exit();
				   if($notification_count == 1){   
						$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>7])->first();

						$notificationTable                  = $this->getTableLocator()->get('Notifications');
						$notification                       = $notificationTable->get($notification_id['id']); 
						$notification->notification_seen	= 1;  
						$notification->process_done	        = 1;  
						$notificationTable->save($notification);
						   if($projectWorkSubdetail['approval_role'] == 5 || $projectWorkSubdetail['approval_role'] == 6){
						    $recipient_user = $this->Users->find('all')->where(['Users.role_id'=>12,'Users.circle_id'=>$projectWorkSubdetail['circle_id'],'Users.is_active'=>1])->first();
						   }else if($projectWorkSubdetail['approval_role'] == 4){
							 $recipient_user = $this->Users->find('all')->where(['Users.role_id'=>14,'Users.circle_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
   					   
						   }
							
							$recipient_user_id = $recipient_user['id'];
							$notification = $this->Notifications->newEmptyEntity();					
							$notification->forwarded_date                    = date('Y-m-d');
							$notification->forward_user_id                   = $user->id;
							$notification->recipient_user_id                 = $recipient_user_id; 
							$notification->notification_type_id              = 8; 
							$notification->project_work_id                   = $id;
							$notification->project_work_subdetail_id         = $work_id;
							if($notification_id['work_type'] == 2){	
							   $notification->work_type                         = 2;
							}
							$notification->created_by                        = $user->id;
							$notification->created_date                      = date('Y-m-d H:i:s');				
							$this->Notifications->save($notification);
				    	}
					
		        $this->Flash->success(__('The project Abstract Estimate / Technical Sanction has been Approved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'approvedlist']);
			  }				
		}
		
    $approvalStatuses = $this->ApprovalStatuses->find('list', ['limit' => 200])->where(['ApprovalStatuses.is_active'=>1])->all();
	$this->set(compact('technicalcount','technical','abstract_subdetails','approvalStatuses','projectWork','projectwiseDetailedEstimate', 'projectWorks','detailed_estimates','id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','work_id','total_estimate','detailed_approval_stages','detailed_approval_stages_count','role_id'));	   
   }

   public function ajaxprojectdevelopmentwork($i = null,$type = null)
   {
    $this->loadModel('NewBuildingItems');
    $this->loadModel('Units');
    //$buildingItems = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->all();
    $buildingItems = $this->NewBuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->order(['NewBuildingItems.building_item_type_id ASC'])->all();
    $units         = $this->Units->find('list')->toArray();
   
   $this->set(compact('i', 'buildingItems','type','units'));
  }
   
   public function ajaxcontractordetails($id = null)
    {
        $this->loadModel('Contractors');
        $contractor = $this->Contractors->find('all')->where(['Contractors.id' => $id])->first();        
        $mobile_no      = $contractor['mobile_no'];
        $email          = $contractor['email'];
        $gst_no         = $contractor['gst_no'];
        $address         = $contractor['address'];
        $contractor_details = array('mobile_no'=>$mobile_no,'email'=>$email,'gst_no'=>$gst_no,'address'=>$address);
         echo  json_encode($contractor_details);
        exit();
    }
		
	public function projectabstractdelete($id=null,$work_id=null,$abstract_id = null)
    {				 
	   $this->loadModel('ProjectwiseAbstractSubdetails');

		
		$abstractTable          = $this->getTableLocator()->get('ProjectwiseAbstractSubdetails');
		$abstract                = $abstractTable->get($abstract_id); 
		$abstract->is_active  = 0;
        if ($abstractTable->save($abstract)) {
			 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectabstractadd/'.$id.'/'.$work_id]);
        } else {
			 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectabstractadd/'.$id.'/'.$work_id]);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }
	
   public function projecttendercancel($id=null,$work_id=null,$tender_id = null)
    {				 
	    $this->loadModel('ProjectTenderDetails');		
	    $this->loadModel('ContractorDetails');		
	    $this->loadModel('ProjectwiseAbstractDetails');		
	    $this->loadModel('ProjectwiseAbstractSubdetails');		
		$TenderTable           = $this->getTableLocator()->get('ProjectTenderDetails');
		$tender                = $TenderTable->get($tender_id); 
		$tender->is_active  = 0;
        if($TenderTable->save($tender)){			 
			 $contractor_detail_count  = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.project_tender_detail_id'=>$tender_id,'ContractorDetails.is_active'=>1])->count(); 
			 $contractor_detail        = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.project_tender_detail_id'=>$tender_id,'ContractorDetails.is_active'=>1])->first(); 
             
			 if($contractor_detail_count > 0){
				  $contractorTable       = $this->getTableLocator()->get('ContractorDetails');
				  $contractor            = $contractorTable->get($contractor_detail['id']); 
				  $contractor->is_active = 0;
				  $contractorTable->save($contractor);

                  $subdetailTable       = $this->getTableLocator()->get('ProjectWorkSubdetails');
				  $subdetail            = $subdetailTable->get($work_id); 
				  $subdetail->tender_detail_flag = 0;
				  $subdetailTable->save($subdetail);					  
				  
				  $abstract        = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id' => $id,'ProjectwiseAbstractDetails.project_work_subdetail_id' => $work_id,'ProjectwiseAbstractDetails.is_active'=>1])->first(); 

				  if($abstract['id'] != ''){
				     $this->ProjectwiseAbstractSubdetails->updateAll(['contractor_rate' =>0.00,'final_amount'=>0.00],['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract['id']]);
				  }			  
			 }			
			 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/'.$id.'/'.$work_id]);
        }else{
			 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/'.$id.'/'.$work_id]);
            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }
		
   public function projectdrawingupload($id = null,$work_id = null)   
   {	   
	   $this->viewBuilder()->setLayout('layout');
	   $this->loadModel('ProjectWorkSubdetails');
	   $this->loadModel('Users');
	   $this->loadModel('Notifications');
       $user = $this->request->getAttribute('identity');
	   $role_id     = $user->role_id;
	   $division_id = $user->division_id; 
		
	    $projectWorkSubdetail     = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>';  print_r($this->request->getData()); exit();    

                $attachment  = $this->request->getData('architect_drawing_upload');
				//echo '<pre>';  print_r($attachment); exit();
				 if ($attachment->getClientFilename() != '') {  
					 $name    = $attachment->getClientFilename();
					 $type    = $attachment->getClientMediaType();
					 $size    = $attachment->getSize();
					 $tmpName = $attachment->getStream()->getMetadata('uri');
					 $error   = $attachment->getError();

					 if ($name != '' && $error == 0) {
						 $file                                     = $name;
						 $array                                    = explode('.', $file);
						 $fileExt                                  = $array[count($array) - 1];
						 $current_time                             = date('Y_m_d_H_i_s');
						 $newfile                                  = "drawing_" . $current_time . "." . $fileExt;
						 $tempFile                                 = $tmpName;
						 $targetPath                               = 'uploads/ArchitectDrawings/';
						 $targetFile                               = $targetPath . $newfile;
						 //echo "<pre>";  print_r($newfile); exit();
						 move_uploaded_file($tempFile, $targetFile);
					 }
				 }else{
                    $newfile = $this->request->getData('architect_drawing_upload1'); 
				 }					 
		   
				$subdetailTable                     = $this->getTableLocator()->get('ProjectWorkSubdetails');
				$project                            = $subdetailTable->get($projectWorkSubdetail['id']); 
				$project->architect_drawing_flag    = 1;  
				$project->architect_drawing_upload  = $newfile;  
				//$project->project_work_status_id    = 4;  
				$subdetailTable->save($project);
                   
				 $this->Flash->success(__('The Detailed Estimate uploaded Successfully.'));
                 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/16']);
		}		
       $this->set(compact('projectWork','projectwiseDetailedEstimate', 'projectWorks', 'materials', 'units','detailed_estimates','id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','work_id','total_estimate'));
	}
	
	public function contractorratedetails($pid = null, $work_id = null,$tender_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $this->loadModel('ProjectWorks');
        $this->loadModel('ContractorDetails');
        $this->loadModel('ProjectAdministrativeSanctions');
        $this->loadModel('ProjectWorkSubdetails');
        $this->loadModel('ProjectFinancialSanctions');
        $this->loadModel('ProjectTenderDetails');
        $this->loadModel('TechnicalSanctions');
        $this->loadModel('Contractors');
        $this->loadModel('ProjectwiseAbstractDetails');
        $this->loadModel('ProjectwiseAbstractSubdetails');
        $this->loadModel('ProjectwiseContractorRateDetails');

        $user   = $this->request->getAttribute('identity');		
	   $project = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $pid])->first();
	   $projectWorkSubdetail = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id])->first();

        // $tender = $this->ProjectTenderDetails->find('all')->where(['ProjectTenderDetails.project_work_id' => $pid, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id])->first();
        // // echo "<pre>"; print_r($tender); exit();
        // $tender_amount = $tender['tender_amount'];
        // $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $pid])->first();

        //$technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->count();
        //$technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();

        $contractor_details          = $this->ContractorDetails->find('all')->contain(['Contractors'])->where(['ContractorDetails.project_work_id' => $pid, 'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->first(); //tender key
        $contractor_detailcount      = $this->ContractorDetails->find('all')->contain(['Contractors'])->where(['ContractorDetails.project_work_id' => $pid, 'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->count(); 

     $abstractcount = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$pid,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
	 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$pid,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
	 if($abstractcount > 0){
	 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['NewBuildingItems','Units'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
	   $contractoratedetails = array();
	   $contractorcount = array();
	    foreach($abstract_subdetails as $subdetail){
    	  $contractorcount[$subdetail['id']] = $this->ProjectwiseContractorRateDetails->find('all')->where(['ProjectwiseContractorRateDetails.projectwise_abstract_subdetail_id'=>$subdetail['id']])->count();
    	   if($contractorcount[$subdetail['id']] != 0){
 		     $contractoratedetails[$subdetail['id']] = $this->ProjectwiseContractorRateDetails->find('all')->where(['ProjectwiseContractorRateDetails.projectwise_abstract_subdetail_id'=>$subdetail['id']])->first();
		   }	  
	    }	  
	  } 

        if ($this->request->is(['patch', 'post', 'put'])) { // echo"<pre>"; print_r($this->request->getData());  exit();
				 	  
			  if($this->request->getData('type') == 1){
				 foreach ($this->request->getData('workdetail') as $key => $answer) {
					
					$abstract = $this->ProjectwiseAbstractSubdetails->find('all')->where(['ProjectwiseAbstractSubdetails.id'=>$answer['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->first();

                   if($answer['rate'] != ''){	
                      // echo "<pre>"; print_r($answer); exit();				   
					if($answer['contractor_rate_id'] != ''){
					  $contractor_rate = $this->ProjectwiseContractorRateDetails->get($answer['contractor_rate_id'], [
							'contain' => [],
						]);
					}else{
					 $contractor_rate = $this->ProjectwiseContractorRateDetails->newEmptyEntity();						
					}
					
					$contractor_rate->project_work_id              = $pid;
					$contractor_rate->project_work_subdetail_id    = $work_id;
					$contractor_rate->project_tender_detail_id     = $tender_id;
					$contractor_rate->contractor_detail_id         = $contractor_details['id'];
					$contractor_rate->projectwise_abstract_subdetail_id         = $answer['id'];
					// $contractor_rate->building_item_id             = ($abstract['building_item_id'])?$abstract['building_item_id']:0;
					// $contractor_rate->item_code                    = ($abstract['item_code'])?$abstract['item_code']:0;				
					// $contractor_rate->item_description             = $abstract['item_description'];
					$contractor_rate->new_building_item_id         = ($abstract['building_item_id'])?$abstract['building_item_id']:0;
					$contractor_rate->new_item_code                = ($abstract['item_code'])?$abstract['item_code']:0;				
					$contractor_rate->new_item_description         = $abstract['item_description'];
					$contractor_rate->quantity                     = $abstract['quantity'];
					$contractor_rate->unit_id                      = $abstract['unit_id'];
					$contractor_rate->contractor_rate              = $answer['rate'];
					$contractor_rate->final_amount                 = ($answer['amount'] != 0)?$answer['amount']:'';
					$contractor_rate->created_by                   = $user->id;
					$contractor_rate->created_date                 = date('Y-m-d H:i:s');				
					//echo "<pre>"; print_r($contractor_rate); 
					 if($this->ProjectwiseContractorRateDetails->save($contractor_rate)){
						 $ProjectWorksTable          = $this->getTableLocator()->get('ProjectwiseAbstractSubdetails');
						 $project                    = $ProjectWorksTable->get($answer['id']); 
						 $project->contractor_rate   = $answer['rate'];
						 $project->final_amount      = $answer['amount'];
						 $ProjectWorksTable->save($project);						
					 }
				    }		
				 
 				   }
				   return $this->redirect(['action' => 'contractorratedetails/'. $pid . '/' . $work_id. '/' . $tender_id]);
				  
				}else{
					 $this->Flash->success(__('The Contractor Rate has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/' . $pid . '/' . $work_id]);
				
					
				}               
           
	   }  
        $contractor_type = $this->ContractorDetails->Contractors->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Contractors.is_active' => 1])->toArray();

        $this->set(compact(
            'abstractcount',
            'abstract_subdetails',
            'contractor_type',
            'projectTenderDetail',
            'contractor_details',
            'contractor_detail_count',
            'projectWork',
            'contractorDetail',
            'id',
            'administrativesanctioncount',
            'administrativesanction',
            'projectWorkSubdetail',
            'financialSanctionscount',
            'financialSanctions',
            'work_id',
            'technicalcount',
            'technical',
            'pid','tender_id',
            'tender_amount','work_type','contractor_detailcount','contractoratedetails','contractorcount','project'
        ));
    }
	
	public function contractorfinalsubmit()
    {
		if ($this->request->is(['patch', 'post', 'put'])) { //echo"<pre>"; print_r($this->request->getData());  exit(); 
		   if($this->request->getData('type1') == 2){
			   $subdetailTable                  = $this->getTableLocator()->get('ProjectWorkSubdetails');
				$project                        = $subdetailTable->get($this->request->getData('work_id'));
				$project->contractor_final_submit      = 1;
				$subdetailTable->save($project);
				$this->Flash->success(__('The Contractor Rate has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/' . $this->request->getData('pid') . '/' . $this->request->getData('work_id')]);
			}		
		}		
	}

    public function mbookstatusapproval($id = null,$work_id = null){
	  $this->viewBuilder()->setLayout('layout');
	  $this->loadModel('MbookApprovalStatuses');
	  $this->loadModel('MbookApprovalStages');
	  $this->loadModel('ProjectWorkSubdetails');
	  $this->loadModel('Users');
	  $this->loadModel('Notifications');
	   $user = $this->request->getAttribute('identity');
	   $role_id     = $user->role_id;
	   $division_id = $user->division_id;
	   $circle_id   = $user->circle_id;
	  //$mbook_status    = $this->MbookApprovalStatuses->find('list')->where(['MbookApprovalStatuses.is_active'=>1])->toArray();
	    $projectWorkSubdetail  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.work_type'=>1])->first();
	    $MbookApprovalStages  = $this->MbookApprovalStages->find('all')->contain(['MbookApprovalStatuses'])->where(['MbookApprovalStages.project_work_subdetail_id' => $work_id])->toArray();
	    $MbookApprovalStagescount  = $this->MbookApprovalStages->find('all')->where(['MbookApprovalStages.project_work_subdetail_id' => $work_id])->count();
		
        if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>';  print_r($this->request->getData()); exit();  
           $mbook_approval_status_id =  $this->request->getData('mbook_approval_status_id');	
		   
				if($mbook_approval_status_id == 1){
					if($role_id == 2){
					   $next_role_id    = 3;
					   $status = 'AE Forward to AEE';
					   $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
					   $user_id = $users['id'];	
					}				
				}
				
				if($role_id == 3){				
					 if($mbook_approval_status_id == 2){
						  $next_role_id    = 4;
						  $status = 'AEE Forward to EE';
						  $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
						  $user_id = $users['id'];	
						 
					 }else if($mbook_approval_status_id == 3){	
						  $next_role_id    = 2;
						  $status = 'AEE Rejects MBook Request';
						  $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
						  $user_id = $users['id'];							 
					 }			
				}
				
				if($role_id == 4){				
					 if($mbook_approval_status_id == 2){
						  $next_role_id    = 0;
						  $status = 'EE Approved MBook';
						 // $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
						  $user_id = 0;	
						 
					 }else if($mbook_approval_status_id == 3){	
						  $next_role_id    = 2;
						  $status = 'EE Rejects MBook Request';
						  $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
						  $user_id = $users['id'];						 
					 }			
				}								
					
				$mbookApprovalStages = $this->MbookApprovalStages->newEmptyEntity();	
				$mbookApprovalStages->project_work_id           = $id;
				$mbookApprovalStages->project_work_subdetail_id = $work_id;
				$mbookApprovalStages->user_id	                = $user_id;
				$mbookApprovalStages->current_role_id           = $next_role_id;
				$mbookApprovalStages->current_status            = $status;
				$mbookApprovalStages->mbook_approval_status_id  = $mbook_approval_status_id;
				$mbookApprovalStages->remarks                   = $this->request->getData('remarks');
				$mbookApprovalStages->submit_date               = date('Y-m-d');
				$mbookApprovalStages->created_by                = $user->id;
                $mbookApprovalStages->created_date              = date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($mbookApprovalStages); exit();
			  if ($this->MbookApprovalStages->save($mbookApprovalStages)) {					
				    $subdetailTable                     = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                            = $subdetailTable->get($projectWorkSubdetail['id']); 
					$project->mbook_approval_role       = $next_role_id;
					$project->mbook_approval_status_id  = $mbook_approval_status_id; 
					if($role_id == 4 && $mbook_approval_status_id == 2){
					$project->mbook_approved           = 1; 
					}
					$subdetailTable->save($project); 
					
					if($mbook_approval_status_id == 1){
					       //$recipient_user_id = $recipient_user['id'];
							$notification = $this->Notifications->newEmptyEntity();					
							$notification->forwarded_date                    = date('Y-m-d');
							$notification->forward_user_id                   = $user->id;
							$notification->recipient_user_id                 = $user_id; 
							$notification->notification_type_id              = 17; 
							$notification->project_work_id                   = $id;
							$notification->project_work_subdetail_id         = $work_id;							
							$notification->created_by                        = $user->id;
							$notification->created_date                      = date('Y-m-d H:i:s');				
							$this->Notifications->save($notification);
					}else if($mbook_approval_status_id == 2 || $mbook_approval_status_id == 3){
						
						
					  $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>17])->count();
				  // echo '<pre>';  print_r($notification_count); exit();
					   if($notification_count == 1){   
							$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>17])->first();

							$notificationTable                  = $this->getTableLocator()->get('Notifications');
							$notification                       = $notificationTable->get($notification_id['id']); 
							$notification->notification_seen	= 1;  
							$notification->process_done	        = 1;  
							$notificationTable->save($notification);
							
								if($role_id == 3 || ($role_id == 4 && $mbook_approval_status_id == 3)){
								$notification = $this->Notifications->newEmptyEntity();					
								$notification->forwarded_date                    = date('Y-m-d');
								$notification->forward_user_id                   = $user->id;
								$notification->recipient_user_id                 = $user_id; 
								$notification->notification_type_id              = 17; 
								$notification->project_work_id                   = $id;
								$notification->project_work_subdetail_id         = $work_id;
								if($notification_id['work_type'] == 2){	
								   $notification->work_type                         = 2;
								}
								$notification->created_by                        = $user->id;
								$notification->created_date                      = date('Y-m-d H:i:s');				
								$this->Notifications->save($notification);
								}
							}						
					}
		        $this->Flash->success(__('The M book Approval stages has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/17']);
			  }

		}
		
		if($role_id == 2){
	     $mbook_status    = $this->MbookApprovalStatuses->find('list')->where(['MbookApprovalStatuses.is_active'=>1,'MbookApprovalStatuses.id'=>1])->toArray();
		}else if($role_id == 3 || $role_id == 4){
		 $mbook_status    = $this->MbookApprovalStatuses->find('list')->where(['MbookApprovalStatuses.is_active'=>1,'MbookApprovalStatuses.id IN'=>[2,3]])->toArray();
        }
       $this->set(compact('id','work_id', 'mbook_status','role_id','MbookApprovalStages','MbookApprovalStagescount'));
	}

  public function ajaxitemcode($id = null)
    {
        //$this->loadModel('BuildingItems');
        $this->loadModel('NewBuildingItems');
       // $Items = $this->BuildingItems->find('all')->where(['BuildingItems.id' => $id])->first();        
        $Items = $this->NewBuildingItems->find('all')->where(['NewBuildingItems.id' => $id])->first();        
        $description     = $Items['item_description'];
        $item_code       = $Items['item_code'];
        $building_item = array('item_code'=>$item_code,'item_description'=>$description);
         echo  json_encode($building_item);
        exit();
    }	
}