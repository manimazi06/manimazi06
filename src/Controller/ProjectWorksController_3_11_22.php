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
    $user = $this->request->getAttribute('identity');
    $role_id     = $user->role_id;
    $division_id = $user->division_id;
    $circle_id   = $user->circle_id;

     if($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14){
		$condition = " and project.division_id = ".$division_id."";

	}else if($role_id == 5 || $role_id == 11 || $role_id == 12){
		$condition = " and project.circle_id = ".$circle_id."";
		
	}else{
		$condition = "";
	}

    $connection = ConnectionManager::get('default');
    $query                  =  "SELECT count(project.id) as pwcount
                                 from project_work_subdetails as project 
                                 where project.is_active=1 $condition";
    $TotalProjectCount      = $connection->execute($query)->fetchAll('assoc');

    $query1                 =  "SELECT count(project.id) as pwcount
                               from project_work_subdetails as project 
                               where project.is_work_completed=0 AND project.is_active=1 $condition";
    $progressCount         = $connection->execute($query1)->fetchAll('assoc');

    $query2                =  "SELECT 
                               count(project.id) as pwcount
                               from project_work_subdetails as project 
                               where project.is_work_completed=1 AND project.is_active=1 $condition";
    $Totalcompletecount    = $connection->execute($query2)->fetchAll('assoc');
	
	 $financialYears = $this->FinancialYears->find('list')->order('id ASC')->toArray();	
	 //echo "<pre>"; print_r($financialYears); exit();  	
    $yearwise_detail = array();
	foreach($financialYears as $key => $year){
	$query_yearwise = "select d.name as depart_name,sum(as_sac.sanctioned_amount) as sanctioned_amount
				from project_administrative_sanctions as as_sac
				LEFT join project_works as p on p.id = as_sac.project_work_id 
				LEFT join project_work_subdetails as project on project.project_work_id = p.id
				RIGHT JOIN departments as d on d.id = p.department_id
				LEFT JOIN financial_years as fs on fs.id = p.financial_year_id
                where fs.id = ".$key." $condition
				GROUP by fs.name,d.name
                order by sanctioned_amount DESC";
				
   $departwise_yearwise_details    = $connection->execute($query_yearwise)->fetchAll('assoc');		
   foreach($departwise_yearwise_details as $key1 => $dept){
		 $yearwise_detail[$key][$key1]["depart"]              = $dept['depart_name'];
		 $yearwise_detail[$key][$key1]["sanctioned_amount"]   = ($dept['sanctioned_amount'])?$dept['sanctioned_amount']/100000:0;		  
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

		$query = "Select count(projectwork.id) as projectcount,
				  sum(CASE WHEN project.is_work_completed = 0 THEN 1 else 0 end) as inprogress,
				  sum(CASE WHEN project.is_work_completed = 1 THEN 1 else 0 end) as completed
				  from project_work_subdetails as project
				  LEFT JOIN project_works as projectwork on  projectwork.id = project.project_work_id
				  where project.is_active=1 $condition and projectwork.department_id =$key ";
		// echo"<pre>";print_r($query);exit();
		$Totalcount      = $connection->execute($query)->fetchAll('assoc');
		$department_details[$key]['department_name'] = $value;
		$department_details[$key]['total_count']     = $Totalcount[0]['projectcount'];
		$department_details[$key]['inprogress']      = ($Totalcount[0]['inprogress'] != '') ? $Totalcount[0]['inprogress'] : 0;
		$department_details[$key]['completed']       = ($Totalcount[0]['completed'] != '') ? $Totalcount[0]['completed'] : 0;
	}	
	
	$divisions         = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
	$divisions_details = array();
	foreach ($divisions as $key => $divistionvalue) {
		$query        = "select count(project.id) as totalcount, 
						 sum(CASE WHEN project.is_work_completed = 0 THEN 1 else 0 end) as Inprogress,
						 sum(CASE WHEN project.is_work_completed = 1 THEN 1 else 0 end) as completed
						 from project_work_subdetails as project 
						 LEFT JOIN project_works as project_work on 
						 project_work.id = project.project_work_id where project.is_active=1 and 
						 project.division_id=$key $condition";
		// echo"<pre>";print_r($query);exit();
		$Totalcount      = $connection->execute($query)->fetchAll('assoc');
		$divisions_details[$key]['division_name']  = $divistionvalue;
		$divisions_details[$key]['total_count']    = $Totalcount[0]['totalcount'];
		$divisions_details[$key]['in_progress']    = ($Totalcount[0]['Inprogress']) ? $Totalcount[0]['Inprogress'] : 0;
		$divisions_details[$key]['completed']      = ($Totalcount[0]['completed']) ? $Totalcount[0]['completed'] : 0;
	}

    $this->set(compact('yearwise_detail','financialYears','departwise_as_details','progressCount', 'Totalcompletecount', 'TotalProjectCount','department_details','divisions_details','role_id','division_id'));
   }

	public function ajaxprojectwise($val=NULL)
    {    
        $user = $this->request->getAttribute('identity');
        $role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;	
		
	 if($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14){
			$rolecondition = " and work_subdetails.division_id = ".$division_id."";

		}else if($role_id == 5 || $role_id == 11 || $role_id == 12){
			$rolecondition = " and work_subdetails.circle_id = ".$circle_id."";
			
		}else{
			$rolecondition = "";
		}
		
        $connection        = ConnectionManager::get('default');       
            // echo"<pre>";print_r($emp_desgn);exit();
		if ($val == 1) {
			$Cond = "";
		} elseif ($val == 2) {
			$Cond = " AND work_subdetails.is_work_completed=0";
		} elseif ($val == 3) {
			$Cond = " AND work_subdetails.is_work_completed=1";
		}

             $sql="SELECT  department.name as dname,
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
        // print_r($sql);exit();
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
			  $dist_cond       = ($this->request->getData('district_id')!= '')?" AND psd.district_id = '".$this->request->getData('district_id')."'":"";

	
			  $query              =  "SELECT project.*,fy.name as financial_year,d.name as department_name
									 from project_works as project 
									 LEFT JOIN departments as d on d.id= project.department_id 
									 LEFT JOIN financial_years as fy on fy.id= project.financial_year_id 
									 LEFT JOIN project_work_subdetails as psd on psd.project_work_id = project.id
									 where project.ce_approved=0 $condition  $fin_year_cond  $dept_cond  $project_cond $dist_cond group by project.id";											 
											 
			  $projectWorks       = $connection->execute($query)->fetchAll('assoc'); 	
           
		}else{
			
		  
				    $query            =  "SELECT project.*,fy.name as financial_year,d.name as department_name
										 from project_works as project 
										 LEFT JOIN departments as d on d.id= project.department_id 
										 LEFT JOIN financial_years as fy on fy.id= project.financial_year_id 
										 LEFT JOIN project_work_subdetails as psd on psd.project_work_id = project.id
										 where project.ce_approved=0 $condition group by project.id";											 
												 
                 $projectWorks            = $connection->execute($query)->fetchAll('assoc');  
		
		}
		
		  $departments    = $this->Departments->find('list')->all();
          $financialYears = $this->FinancialYears->find('list')->order('id Desc')->all();	
          $districts = $this->Districts->find('list')->order('name ASC')->all();	
		
		

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
		
		 if($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14){
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

										 where project.ce_approved=1 group by project.id";									 
												 
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

        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes','DepartmentwiseWorkTypes'],
        ]);
		
		
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
		 $projectTenderDetails        = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
		 $projectTenderDetailscount   = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
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
           
			if ($this->ProjectWorks->save($projectWork)) {
			   $insertid     = $projectWork->id;	           
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
					$projectWorkSubdetail->district_id             =  $value['district_id'];
					$projectWorkSubdetail->division_id             =  $value['division_id'];
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
            //$this->Flash->error(__('The project work could not be saved. Please, try again.'));
        }
       
        $this->loadModel('FinancialYears');
        $this->loadModel('BuildingTypes');
        $this->loadModel('ProjectStatuses');
        $this->loadModel('Districts');
        $this->loadModel('Divisions');
        $this->loadModel('SchemeTypes');
        $departments    = $this->ProjectWorks->Departments->find('list', ['limit' => 200])->all();
        $financialYears = $this->FinancialYears->find('list')->order(['id Desc'])->all();
        $buildingTypes  = $this->BuildingTypes->find('list', ['limit' => 200])->all();
        $schemeTypes    = $this->SchemeTypes->find('list', ['limit' => 200])->all();
        $Statuses       = $this->ProjectStatuses->find('list', ['limit' => 200])->all(); 

	    $this->loadModel('Circles');
	    $districts = $this->Districts->find('list')->toArray();
	    $divisions = $this->Divisions->find('list')->toArray();
	    $circles = $this->Circles->find('list')->toArray();
	    $work_types = $this->DepartmentwiseWorkTypes->find('list')->toArray();
       		

	    $divisions = $this->Divisions->find('list', ['limit' => 200])->all();
        $this->set(compact('work_types','circles','projectWork', 'departments', 'financialYears', 'buildingTypes', 'Statuses', 'districts', 'divisions','role_id','schemeTypes'));
    }
	 public function ajaxdepartmentworktype($id)
    {  
        $this->loadModel('DepartmentwiseWorkTypes');
        $work_types    = $this->DepartmentwiseWorkTypes->find('all')->where(['DepartmentwiseWorkTypes.department_id' => $id])->toArray();    	
		
        //print_r($work_types);  exit();
        $this->set(compact('work_types'));
      }
		  
	public function edit($id = null)
     {
       //$id = base64_decode($id);
		$this->viewBuilder()->setLayout('layout');
		$this->loadModel('ProjectWorkSubdetails');

		$user = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$projectWork = $this->ProjectWorks->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
		    //echo"<pre>"; print_r($this->request->getData());exit();
			//$projectWork = $this->ProjectWorks->patchEntity($projectWork, $this->request->getData());
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
					$projectWorkSubdetail->district_id             = $value['district_id'];
					$projectWorkSubdetail->division_id             = $value['division_id'];
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
		$departments    = $this->ProjectWorks->Departments->find('list', ['limit' => 200])->all();
		$financialYears = $this->FinancialYears->find('list', ['limit' => 200])->all();
		$buildingTypes  = $this->BuildingTypes->find('list', ['limit' => 200])->all();
		$Statuses  = $this->ProjectStatuses->find('list', ['limit' => 200])->all();
		$statusproject    = [0=>'pending',1=>'Approved',2=>'Rejected'];

		
		$divisions    = $this->ProjectWorks->Divisions->find('list')->all();
		$schemeTypes  = $this->SchemeTypes->find('list', ['limit' => 200])->all();
		$districts    = $this->Districts->find('list')->toArray();
		$divisions    = $this->Divisions->find('list')->toArray();
		$circles      = $this->Circles->find('list')->toArray();    		

	
	  $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.is_active'=>1])->toArray();


    $this->set(compact('projectWork', 'departments', 'financialYears', 
    'buildingTypes', 'projectStatuses', 'districts', 'divisions','schemeTypes','statusproject','projectWorkSubdetails','circles')); 
}

   public function projectapprove($id = null)
   {
    $this->viewBuilder()->setLayout('layout');
    $user = $this->request->getAttribute('identity');
	$this->loadModel('ProjectWorkSubdetails');

    $role_id     = $user->role_id;
    $division_id = $user->division_id;
    $projectWork = $this->ProjectWorks->get($id, [
        'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes','DepartmentwiseWorkTypes'],
    ]);
	
    if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>'; print_r($this->request->getData()); exit();
				$remarks         = $this->request->getData('remarks');

				$projectTable                   = $this->getTableLocator()->get('ProjectWorks');
				$project                        = $projectTable->get($id); 
				$project->ce_approved	        = $this->request->getData('ce_approved');
				if($this->request->getData('ce_approved') == 1){
				  $project->approved_date       =  date('Y-m-d');							  
				}else if($this->request->getData('ce_approved') == 2){
				  $project->remarks             =  $remarks;
				}
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
							
				   }
					$this->Flash->success(__('The project Status has been saved.'));
					return $this->redirect(['action' => 'index']);
				}else{
                   $this->Flash->error(__('The project Status could not be saved. Please, try again.'));
				}
    }


     $statusproject    = [1=>'Approved',2=>'Rejected'];
	 $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Districts','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.is_active'=>1])->toArray();
	 $projectWorkSubdetailscount       = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.is_active'=>1])->count();
 
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
		  
		    $approved_project_count = $this->ProjectWorks->find('all')->where(['ProjectWorks.financial_year_id' => $fin_year,'ProjectWorks.department_id'=>$dept_id,'ProjectWorks.ce_approved'=>1])->count();      
		    //$approved_projects      = $this->ProjectWorks->find('all')->contain(['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'])->where(['ProjectWorks.financial_year_id' => $fin_year,'ProjectWorks.department_id'=>$dept_id,'ProjectWorks.ce_approved'=>1,'ProjectWorks.AS_flag !=' =>1])->toArray();      
		    $approved_project_ids      = $this->ProjectWorks->find('list', ['keyField' => 'id','valueField' => 'id'])->where(['ProjectWorks.financial_year_id' => $fin_year,'ProjectWorks.department_id'=>$dept_id,'ProjectWorks.ce_approved'=>1])->toArray();      
		   if($approved_project_count > 0){
			$approved_sub_projects     = $this->ProjectWorkSubdetails->find('all')->contain(['Districts', 'Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id IN' => $approved_project_ids,'ProjectWorkSubdetails.project_work_status_id <'=>3,'ProjectWorkSubdetails.is_active'=>1])->toArray();      
		   }
		}
		
	    $departments    = $this->Departments->find('list', ['limit' => 200])->all();
        $financialYears = $this->FinancialYears->find('list')->order('id DESC')->all();		
		$supervision_charges = $this->SupervisionCharges->find('list')->toArray();
        $fund_sources = $this->FundSources->find('list')->toArray();       
		
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
	
	public function insertadminsanction(){
		$this->loadModel('ProjectAdministrativeSanctions');	
		$user  = $this->request->getAttribute('identity');
		$this->loadModel('ProjectWorks');	
		
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
					$division                  = $this->Divisions->find('all')->where(['Divisions.id' => $value['division_id']])->first();
					$goyear                    = date('Y', strtotime($this->request->getData('go_date')));					
					$divsioncode               = $division['division_code']; 									
					$count =  $key+1;
					$var                       = sprintf('%02d', $count);				   
					$workcode                  = $goyear.$divsioncode.$var; 

                    $ProjectWorkssubdetailTable  = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$projectsubdetail                     = $ProjectWorkssubdetailTable->get($value['id']); 
					$projectsubdetail->work_code          = $project_code.'/'.$workcode;
					$projectsubdetail->sanctioned_amount  = $value['amount'];
					$projectsubdetail->approval_role      = $approval_role;
					$projectsubdetail->project_work_status_id      = 3;
					$ProjectWorkssubdetailTable->save($projectsubdetail);
					
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
				  
		          $approved_project_count = $this->ProjectWorks->find('all')->where(['ProjectWorks.financial_year_id' => $fin_year,'ProjectWorks.department_id'=>$dept_id,'ProjectWorks.FS_flag'=>0])->count();      
		          //$approved_projects      = $this->ProjectWorks->find('all')->contain(['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'])->where(['ProjectWorks.financial_year_id' => $fin_year,'ProjectWorks.department_id'=>$dept_id,'ProjectWorks.ce_approved'=>1,'ProjectWorks.estimate_approval' =>1])->toArray();      
		   	    	// $approved_project_ids      = $this->ProjectWorks->find('list', ['keyField' => 'id','valueField' => 'id'])->where(['ProjectWorks.financial_year_id' => $fin_year,'ProjectWorks.department_id'=>$dept_id,'ProjectWorks.ce_approved'=>1])->toArray();      

			    if($approved_project_count > 0){
					$approved_sub_projects     = $this->ProjectWorkSubdetails->find('all')->contain(['Districts', 'Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $project_id,'ProjectWorkSubdetails.project_work_status_id'=>5,'ProjectWorkSubdetails.is_active'=>1])->toArray();      
				   }
				           $ProjectWorks = $this->ProjectWorks->find('list', ['keyField' => 'id','valueField' => function ($row) {
		return $row['project_code'];
	}])->where(['ProjectWorks.financial_year_id' => $fin_year,'ProjectWorks.department_id'=>$dept_id,'ProjectWorks.FS_flag'=>0])->all();


	         // $ProjectWorks = $this->ProjectWorks->find('list', ['keyField' => 'id','valueField' => function ($row) {
		// return $row['project_code'] . ' - ' . $row['project_name'];
	// }])->where(['ProjectWorks.financial_year_id' => $fin_year,'ProjectWorks.department_id'=>$dept_id,'ProjectWorks.FS_flag'=>0])->all();	

		}		
	    $departments    = $this->Departments->find('list', ['limit' => 200])->all();
        $financialYears = $this->FinancialYears->find('list')->order('id DESC')->all();		
		
	   $this->set(compact('ProjectWorks','departments', 'financialYears','approved_projects','approved_project_count','supervision_charges','fund_sources','approved_sub_projects'));
	
	}
	
	public function ajaxprojectlist($dep_id= null,$fin_id = null)
	{	
	    $project_works = $this->ProjectWorks->find('all')->where(['ProjectWorks.financial_year_id' => $fin_id,'ProjectWorks.department_id'=>$dep_id,'ProjectWorks.FS_flag'=>0])->toArray();      
		
		//print_r($project_works); exit();
		
		$this->set(compact('project_works'));
	}

   public function insertfinancialsanction(){
		$this->loadModel('ProjectFinancialSanctions');	
		$user  = $this->request->getAttribute('identity');
		$this->loadModel('ProjectWorks');	
		
		if ($this->request->is(['patch', 'post', 'put'])) {  // echo '<pre>';  print_r($this->request->getData()); exit();
				 
		    $count      = $this->ProjectFinancialSanctions->find('all')->where(['ProjectFinancialSanctions.project_work_id' =>$this->request->getData('project_work_id')])->count();
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
				
					$projectFinancialSanction->project_work_id         =  $this->request->getData('project_work_id');
					$projectFinancialSanction->go_date                 =  date('Y-m-d', strtotime($this->request->getData('go_date')));
					$projectFinancialSanction->go_no                   =  $this->request->getData('go_no');
					$projectFinancialSanction->sanctioned_amount       =  $this->request->getData('sanctioned_amount');
					$projectFinancialSanction->created_by              =  $user->id;
					$projectFinancialSanction->created_date            =  date('Y-m-d:h:m:s');
					//echo '<pre>'; print_r($projectFinancialSanction);  exit();
				 if($this->ProjectFinancialSanctions->save($projectFinancialSanction)){				 
						$ProjectWorksTable     = $this->getTableLocator()->get('ProjectWorks');
						$project               = $ProjectWorksTable->get($this->request->getData('project_work_id')); 
						$project->FS_flag      = 1;
						$ProjectWorksTable->save($project);	
				  }
                       $projects = $this->request->getData('project');
			  
					   if($projects != ''){
					  
						  foreach($projects as $subproject){
									$ProjectsubWorksTable      = $this->getTableLocator()->get('ProjectWorkSubdetails');
									$projectsub                = $ProjectsubWorksTable->get($subproject['id']); 
									$projectsub->project_work_status_id  = 6;
									$ProjectsubWorksTable->save($projectsub);		  
						  }
					   }
				  
				}   
			 
		  
		 
			  
		     return $this->redirect(['action' => 'approvedlist']);
		  
		}
		exit();
	}

  /*public function insertfinancialsanction(){
		$this->loadModel('ProjectFinancialSanctions');	
		$user  = $this->request->getAttribute('identity');
		$this->loadModel('ProjectWorks');	
		
		if ($this->request->is(['patch', 'post', 'put'])) {   echo '<pre>';  print_r($this->request->getData()); exit();
		
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
				            $ProjectsubWorksTable      = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$projectsub                = $ProjectsubWorksTable->get($subproject['project_subdetail_id']); 
							$projectsub->project_work_status_id  = 6;
							$ProjectsubWorksTable->save($projectsub);		  
				  }
			   }
			  
		     return $this->redirect(['action' => 'approvedlist']);
		  
		}
		exit();
	}*/  	
		
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
		
		//echo '<pre>'; print_r($projectWork);  exit();

       $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->count();      
	  // $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
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
					$division                  = $this->Divisions->find('all')->where(['Divisions.id' => $value['division_id']])->first();
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
         $districts = $this->Districts->find('list')->toArray();
         $divisions = $this->Divisions->find('list')->toArray();
         $circles = $this->Circles->find('list')->toArray();
		 
		 	  $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id])->toArray();

         $this->set(compact('districts','supervision_charges','fund_sources','projectWork', 'administrativesanction','administrativesanctioncount','projectAdministrativeSanction','divisions','circles','projectWorkSubdetails','id','projectWorkSubdetailscount'));
    }
 
    public function ajaxproject($i = null)
    {
		 $this->loadModel('Districts');
		 $this->loadModel('Divisions');
		 $this->loadModel('Circles');
        $districts = $this->Districts->find('list')->toArray();
        $divisions = $this->Divisions->find('list')->toArray();
        $circles   = $this->Circles->find('list')->toArray();
		
		
        $this->set(compact('i','divisions','circles','districts'));
    }
		
    public function ajaxcircles($id)
    {
        $this->loadModel('Districts');	
        $this->loadModel('Divisions');	
		
		  $dists    = $this->Districts->find('all')->contain(['Divisions'])->where(['Districts.id' => $id])->first();
          $divs     = $this->Divisions->find('all')->contain(['Circles'])->where(['Divisions.id' => $dists['division']['id']])->first();
        
		echo  $divs['circle']['id'];

        exit();
        $this->set(compact('circle'));
    }
   
    public function ajaxdivisions($id)
    {
        $this->loadModel('Districts');
        $this->loadModel('Divisions');
        $dists    = $this->Districts->find('all')->contain(['Divisions'])->where(['Districts.id' => $id])->first();    	
		$division_id = $dists['division']['id'];
		
		echo $division_id;
        exit();
        //print_r($division);  exit();
        //$this->set(compact('division'));
      }
	
    public function projectmonitoring($id = null)
    {  
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        //$id   = base64_decode($id);
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
                // echo"<pre>";print_r($projectMonitoringDetail);exit();
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
        // $this->viewBuilder()->layout('');
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
		
		$administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
	    $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	    $projectWorkSubdetails        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id])->toArray();
      

        $financialSanctionscount = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
        $financialSanctions      = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
      
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
                // echo"<pre>";print_r($projectMonitoringDetail);exit();
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
	   $this->loadModel('ProjectwiseDetailedEstimates');
	   $this->loadModel('ProjectAdministrativeSanctions');
	   $this->loadModel('ProjectWorkSubdetails');
	   $this->loadModel('DetailedEstimateApprovalStages');
	   $this->loadModel('Users');

        $user = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
        //$pid = base64_decode($id);
        $this->loadModel('ProjectWorks');
        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
        ]);
		
	    $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
	    $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	    $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
        $detailed_estimates          = $this->ProjectwiseDetailedEstimates->find('all')->contain(['ProjectWorks','Materials','Units'])->where(['ProjectwiseDetailedEstimates.project_work_id' => $id,'ProjectwiseDetailedEstimates.project_work_subdetail_id'=>$work_id])->toArray();
        $detailed_estimates_count    = $this->ProjectwiseDetailedEstimates->find('all')->where(['ProjectwiseDetailedEstimates.project_work_id' => $id,'ProjectwiseDetailedEstimates.project_work_subdetail_id'=>$work_id])->count();
		
        $connection               = ConnectionManager::get('default');
        $query                    =  "SELECT sum(project.total_cost) as total_amount
                                     from projectwise_detailed_estimates as project 
                                     where project.project_work_id = '".$id."' AND project.project_work_subdetail_id = '".$work_id."'";
       $TotalEstimate             = $connection->execute($query)->fetchAll('assoc');
	   
	   $total_estimate =  $TotalEstimate[0]['total_amount'];   
	   
         $projectwiseDetailedEstimates = $this->ProjectwiseDetailedEstimates->newEmptyEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>';  print_r($this->request->getData()); exit();    

          $completed_flag = $this->request->getData('completed_flag');        
		  
		  if($completed_flag == 1){	
		            $users  = $this->Users->find('all')->where(['Users.role_id'=>14,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
                    $user_id = $users['id'];	
                     //print_r($user_id);  exit();	
		  
			        $subdetailTable                   = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                          = $subdetailTable->get($projectWorkSubdetail['id']); 
					$project->detailed_estimate_flag  = 1;  
					$project->detailed_estimate_current_role  = 14;  
					$project->project_work_status_id  = 4;  
					$subdetailTable->save($project); 					
									
					
				$detailedEstimateApprovalStage = $this->DetailedEstimateApprovalStages->newEmptyEntity();	
				$detailedEstimateApprovalStage->project_work_id           = $id;
				$detailedEstimateApprovalStage->project_work_subdetail_id = $work_id;
				$detailedEstimateApprovalStage->user_id	                  = $user_id;
				$detailedEstimateApprovalStage->current_role_id           = 14;
				$detailedEstimateApprovalStage->current_status            = 'AE Forwarded to Drawing Branch';  
				$detailedEstimateApprovalStage->approval_status_id        = 1;
				$detailedEstimateApprovalStage->submit_date               = date('Y-m-d');
				$detailedEstimateApprovalStage->created_by                = $user->id;
                $detailedEstimateApprovalStage->created_date               = date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($detailedEstimateApprovalStage); exit();
			  if ($this->DetailedEstimateApprovalStages->save($detailedEstimateApprovalStage)) {		
		        $this->Flash->success(__('The project Detailed Estimate has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/1']);
			  }
		  }else{
            $projectwiseDetailedEstimates->project_work_id           = $id;
            $projectwiseDetailedEstimates->project_work_subdetail_id = $work_id;
            $projectwiseDetailedEstimates->material_id               = $this->request->getData('material_id');
            $projectwiseDetailedEstimates->quantity                  = $this->request->getData('quantity');
            $projectwiseDetailedEstimates->unit_id                   = $this->request->getData('unit_id');
            $projectwiseDetailedEstimates->approved_estimate         = $this->request->getData('approved_estimate');
            $projectwiseDetailedEstimates->total_cost                = $this->request->getData('total_cost');
            $projectwiseDetailedEstimates->submit_date               = date('Y-m-d');
            $projectwiseDetailedEstimates->created_by                =  $user->id;
            $projectwiseDetailedEstimates->created_date              =  date('Y-m-d H:i:s');
            // echo"<pre>"; print_r($projectwiseDetailedEstimates); exit();
            if ($this->ProjectwiseDetailedEstimates->save($projectwiseDetailedEstimates)) {
                $this->Flash->success(__('The project Detailed Estimate has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectdetailedestimateadd/'.$id.'/'.$work_id]);
            }
           }
			
		}
		
        //$projectWorks = $this->ProjectwiseDetailedEstimates->ProjectWorks->find('list', ['limit' => 200])->all();
		 $entered_id = $this->ProjectwiseDetailedEstimates->find('list', ['keyField' => 'material_id','valueField' => 'material_id'])->where(['ProjectwiseDetailedEstimates.project_work_subdetail_id' => $work_id])->toArray();
   // print_r($entered_id);   exit();
       
     if($detailed_estimates_count > 0){
	   $materials = $this->ProjectwiseDetailedEstimates->Materials->find('list', ['keyField' => 'id','valueField' => 'item_code'])->where(['Materials.id NOT IN'=>$entered_id])->all();
	 }else{ 
	   $materials = $this->ProjectwiseDetailedEstimates->Materials->find('list', ['keyField' => 'id','valueField' => 'item_code'])->all();
	 }
		
		$units = $this->ProjectwiseDetailedEstimates->Units->find('list', ['limit' => 200])->all();
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
		  // $this->set(compact('projectWork','projectwiseDetailedEstimate', 'projectWorks', 'materials', 'units'));

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
          // echo "<pre>"; print_r($this->request->getData()); exit()	;
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
       
	   $financialSanctionscount = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
       $financialSanctions      = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
      
	
       //$fundrequest          = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id])->count();
       $fundrequestcount          = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.is_approved !='=>0])->count();
       $fundrequest               = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.is_approved !='=>0])->first();
       $role   =   $this->Roles->find('list')->toArray();
	    //echo '<pre>'; print_r($administrativesanction); exit();
	
        $this->set(compact('role','projectWork','projectwiseDetailedEstimate', 'projectWorks', 'materials', 'units','detailed_estimates','id','administrativesanctioncount','administrativesanction','projectWorkSubdetails','financialSanctionscount','financialSanctions','role_id','division_id','circle_id','user_id','fundrequestcount','fundrequest'));
	   
   }
     
    public function approval($id=null,$work_id=null)
    {				 
	   $this->loadModel('ProjectWorkSubdetails');

        $this->request->allowMethod(['post', 'delete']);
        $work             = $this->ProjectWorkSubdetails->get($work_id);
        $work->is_approved  = 1;
        $work->project_work_status_id  = 8;
        if ($this->ProjectWorkSubdetails->save($work)) {
			 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/2']);

            $this->Flash->success(__('The Work  has been Approved.'));
        } else {
			 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/2']);

            $this->Flash->error(__('The Work could not be Approved. Please, try again.'));
        }
		
		exit();
        //return $this->redirect(['action' => 'index']);
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

        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions', 'SchemeTypes'],
        ]);


        $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
        $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
        $projectWorkSubdetail       = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
        $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
        $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();

        $technicalcount = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->count();
        $technical      = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();

        $tenders = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks', 'ProjectWorkSubdetails', 'TenderTypes'])->where(['ProjectTenderDetails.project_work_id' => $id, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id])->toArray();

        $contractor_detail_count  = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id])->count();
        $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id])->first(); //tender key

        //echo '<pre>'; print_r($tenders); exit();

        $projectTenderDetail = $this->ProjectTenderDetails->newEmptyEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {// echo '<pre>'; print_r($this->request->getData());  exit();
            $completed_flag = $this->request->getData('completed_flag');

            if ($completed_flag == 1) {
                $subdetailTable                   = $this->getTableLocator()->get('ProjectWorkSubdetails');
                $project                          = $subdetailTable->get($work_id);
                $project->tender_detail_flag      = 1;
                $project->project_work_status_id  = 9;
                $subdetailTable->save($project);

                $this->Flash->success(__('The project Tender has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/3']);
            } else {

                $projectTenderDetail->project_work_id            = $id;
                $projectTenderDetail->project_work_subdetail_id  = $work_id;
                $projectTenderDetail->tender_type_id              = $this->request->getData('tender_type_id');

                if ($this->request->getData('tender_type_id') == 1) {
                    $projectTenderDetail->etenderID  = $this->request->getData('etenderID');
                } else if ($this->request->getData('tender_type_id') == 2) {
                    $projectTenderDetail->tender_no =   $this->request->getData('tender_no');
                }
                // $projectTenderDetail->etenderID              = $this->request->getData('etenderID');

                // $projectTenderDetail->tender_no                  = $this->request->getData('tender_no');
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
             //echo '<pre>'; print_r($projectTenderDetail);  exit();
                if ($this->ProjectTenderDetails->save($projectTenderDetail)) {
                    $this->Flash->success(__('The Tender Details has been saved.'));
                    return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/' . $id . '/' . $work_id]);
                } else {
                    $this->Flash->error(__('The Tender Details could not be saved. Please, try again.'));
                }
            }
        }
           $tender_type = $this->ProjectTenderDetails->TenderTypes->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['TenderTypes.is_active' => 1])->toArray();
        $this->set(compact('projectTenderDetail', 'tender_type', 'projectWork', 'tenders', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'contractor_detail_count', 'contractor_details', 'technicalcount', 'technical'));
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
            // echo "<pre>";
            // print_r($projectTenderDetail);
            // exit();
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

        $user = $this->request->getAttribute('identity');

        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions', 'SchemeTypes'],
        ]);

        $projectTenderDetail = $this->ProjectTenderDetails->get($tender, [
            'contain' => ['TenderTypes'],
        ]);

        $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
        $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
        $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
        $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
        $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
        $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->count();
        $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();


        $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.project_tender_detail_id'=>$tender])->first(); //tender key
        $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.project_tender_detail_id'=>$tender])->count(); //tender key count

        if ($contractor_detail_count == 0) {
            $contractorDetail = $this->ContractorDetails->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
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
            $contractorDetail->agreement_fromdate            =  date('Y-m-d', strtotime($this->request->getData('agreement_fromdate')));
            $contractorDetail->agreement_todate              =  date('Y-m-d', strtotime($this->request->getData('agreement_todate')));
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
                $this->Flash->success(__('The Contractor Details has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/' . $id . '/' . $work_id]);
            }
            $this->Flash->error(__('The Contractor Details could not be saved. Please, try again.'));
        }
        $contractor_type = $this->ContractorDetails->Contractors->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Contractors.is_active' => 1])->toArray();

        // print_r($contractor_type);
        // exit();
        $this->set(compact('contractor_type', 'projectTenderDetail', 'contractor_details', 'contractor_detail_count', 'projectWork', 'contractorDetail', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'technicalcount', 'technical'));
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

       $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
        ]);
		
	   $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
	   $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	   $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles','Districts','ProjectWorkStatuses'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
  	   $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
       $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
      
	   $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
       $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
       $tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id])->toArray(); 
       $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id'=>$id,'ContractorDetails.project_work_subdetail_id'=> $work_id])->count(); 
       $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id])->first(); //tender key
    
     if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>'; print_r($this->request->getData()); exit();
		
		  if($this->request->getData('site_handover_date') != ''){			  
			        $subdetailTable                  = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                         = $subdetailTable->get($work_id); 
					$project->site_handover_flag     = 1;  
					$project->site_handover_date     = date('Y-m-d',strtotime($this->request->getData('site_handover_date')));  
					$project->site_handover_remarks  = $this->request->getData('site_handover_remarks'); 
                    $project->project_work_status_id       = 11;						
					$subdetailTable->save($project); 
					
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

      $projectWork = $this->ProjectWorks->get($id, [
			'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes','DepartmentwiseWorkTypes'],
		]);

       $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
       $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks','FundSources','SupervisionCharges'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();

	   $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
       $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();

	   $projectWorkSubdetailscount        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles','ProjectWorkStatuses'])->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.is_active'=>1])->count();
	   $projectWorkSubdetails        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles','ProjectWorkStatuses','Districts'])->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.is_active'=>1])->toArray();
	   
	  // $detailed_estimates          = $this->ProjectwiseDetailedEstimates->find('all')->contain(['ProjectWorks','Materials','Units'])->where(['ProjectwiseDetailedEstimates.project_work_id' => $id,'ProjectwiseDetailedEstimates.project_work_subdetail_id'=>$work_id])->toArray();
     //  $detailed_estimates_count    = $this->ProjectwiseDetailedEstimates->find('all')->where(['ProjectwiseDetailedEstimates.project_work_id' => $id,'ProjectwiseDetailedEstimates.project_work_subdetail_id'=>$work_id])->count();
       	 $abstractcount = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
		 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
		 if($abstractcount > 0){
		 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['BuildingItems'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id']])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
		  } 
	   
	   $detailed_approval_stages_count  = $this->DetailedEstimateApprovalStages->find('all')->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->count();
       $detailed_approval_stages        = $this->DetailedEstimateApprovalStages->find('all')->contain(['ApprovalStatuses'])->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->toArray();
		   
	   $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
       $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
       $tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails','TenderTypes'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id])->toArray(); 
       $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id'=>$id,'ContractorDetails.project_work_subdetail_id'=> $work_id])->count(); 
       $contractor_details          = $this->ContractorDetails->find('all')->contain(['Contractors'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id])->first(); //tender key
      
	   
	   $planningcount       = $this->PlanningPermissionDetails->find('all')->where(['PlanningPermissionDetails.project_work_id' => $id,'PlanningPermissionDetails.project_work_subdetail_id'=>$work_id])->count();
	   $planningdetail      = $this->PlanningPermissionDetails->find('all')->contain(['ProjectWorks'])->where(['PlanningPermissionDetails.project_work_id' => $id,'PlanningPermissionDetails.project_work_subdetail_id'=>$work_id])->first();
       //echo "<pre>"; print_r($planningcount); exit();

	    $requestcount                = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->count();
        $fundrequests                = $this->ProjectFundRequestDetails->find('all')->contain(['ProjectWorks','ProjectFundRequests'])->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->toArray();
 
   	    $timelineDetailscount        = $this->ProjectTimelineDetails->find('all')->where(['ProjectTimelineDetails.project_work_id' => $id, 'ProjectTimelineDetails.project_work_subdetail_id' => $work_id])->count();
        $timelineDetails             = $this->ProjectTimelineDetails->find('all')->where(['ProjectTimelineDetails.project_work_id' => $id, 'ProjectTimelineDetails.project_work_subdetail_id' => $work_id])->toArray();
		$utilizationCertificatecount = $this->UtilizationCertificates->find('all')->where(['UtilizationCertificates.project_work_id'=>$id,'UtilizationCertificates.project_work_subdetail_id'=>$work_id])->count();
		$utilizationCertificate      = $this->UtilizationCertificates->find('all')->where(['UtilizationCertificates.project_work_id'=>$id,'UtilizationCertificates.project_work_subdetail_id'=>$work_id])->first();

	    $handovercount      = $this->ProjectHandoverDetails->find('all')->where(['ProjectHandoverDetails.project_work_id'=>$id,'ProjectHandoverDetails.project_work_subdetail_id'=>$work_id])->count();
	    $handoverdetails    = $this->ProjectHandoverDetails->find('all')->where(['ProjectHandoverDetails.project_work_id'=>$id,'ProjectHandoverDetails.project_work_subdetail_id'=>$work_id])->first();	
		
		$completioncount    = $this->ProjectwiseCompletionReports->find('all')->where(['ProjectwiseCompletionReports.project_work_id'=>$id,'ProjectwiseCompletionReports.project_work_subdetail_id'=>$work_id])->count();
		$completiondetails  = $this->ProjectwiseCompletionReports->find('all')->where(['ProjectwiseCompletionReports.project_work_id'=>$id,'ProjectwiseCompletionReports.project_work_subdetail_id'=>$work_id])->first();
         
		 
		$placedtoboardcount    = $this->ProjectPlacedToBoardDetails->find('all')->where(['ProjectPlacedToBoardDetails.project_work_id'=>$id,'ProjectPlacedToBoardDetails.project_work_subdetail_id'=>$work_id])->count();
		$placedtoboarddetails  = $this->ProjectPlacedToBoardDetails->find('all')->where(['ProjectPlacedToBoardDetails.project_work_id'=>$id,'ProjectPlacedToBoardDetails.project_work_subdetail_id'=>$work_id])->first();
    
			
        $monitoringDetailscount     = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->count();
        $monitorings                = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->toArray();
        
		$photo_uploads = array();
        foreach ($monitorings as $monitoring) {
            $photo_uploads[$monitoring['id']]     = $this->ProjectMonitoringPhotosUploads->find('all')->where(['ProjectMonitoringPhotosUploads.project_monitoring_detail_id' => $monitoring['id']])->toArray();
        }

 	  $this->set(compact('placedtoboardcount','placedtoboarddetails','abstractcount','abstract_subdetails','completioncount','completiondetails','handovercount','handoverdetails','utilizationCertificatecount','utilizationCertificate','projectWorkSubdetailscount','detailed_approval_stages_count','detailed_approval_stages','projectTenderDetail', 'projectWork', 'tenders', 'id','administrativesanctioncount','administrativesanction','projectWorkSubdetails','financialSanctionscount','financialSanctions','work_id','contractor_detail_count','contractor_details','technicalcount','technical','fundrequests','requestcount','timelineDetailscount','timelineDetails','monitoringDetailscount','monitorings','photo_uploads','detailed_estimates','detailed_estimates_count','planningcount','planningdetail'));
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
       $tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id])->toArray(); 
       $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id'=>$id,'ContractorDetails.project_work_subdetail_id'=> $work_id])->count(); 
       $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id])->first(); //tender key
    
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
     
		
	   // $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
	   // $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
  	  
	   // $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
       // $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
      
	   // $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
       // $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
       // $tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id])->toArray(); 
       // $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id'=>$id,'ContractorDetails.project_work_subdetail_id'=> $work_id])->count(); 
      $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id])->first(); //tender key
     
	  $projectWorkSubdetail  = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.is_active'=>1])->first();
	  $fundrequestcount      = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->count();
      $fund_requests         = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->toArray();
      $currentfundrequest    = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id,'ProjectFundRequestDetails.received_flag'=>0])->first();
      
      //echo '<pre>'; print_r($currentfundrequest); exit();
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
	   //print_r($balance_amt); exit();
	  
	  
	  
	  //$balance_amount        = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id,'ProjectFundRequestDetails.is_approved'=>1])->last();
      //$balance_amt           = $balance_amount['balance_amount'];

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
       $tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id])->toArray(); 
       $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id'=>$id,'ContractorDetails.project_work_subdetail_id'=> $work_id])->count(); 
       $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id])->first(); //tender key

       $requestcount                = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->count();
       $fundrequests                = $this->ProjectFundRequestDetails->find('all')->contain(['ProjectWorks'])->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->toArray();
 

 
  // echo '<pre>'; print_r($requestcount); exit();

 	  $this->set(compact('fundStatuses','requestcount','projectFundRequestDetails','workStages','projectTenderDetail', 'projectWork', 'tenders', 'id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','financialSanctionscount','financialSanctions','work_id','contractor_detail_count','contractor_details','technicalcount','technical','fundrequests','role_id','fundrequeststages','currentuser_id'));

   }

   public function ajaxgetrequeststages($id = null)
   {       
         $this->loadModel('ProjectFundRequestStages');
         	      $fundrequeststages     = $this->ProjectFundRequestStages->find('all')->contain(['FundStatuses'])->where(['ProjectFundRequestStages.project_fund_request_id' => $id])->toArray();

        // echo "<pre>"; print_r($fundrequeststages); exit();
		 
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
	 $user = $this->request->getAttribute('identity');
		 $role_id     = $user->role_id;
		 $division_id = $user->division_id;
		 $circle_id   = $user->circle_id;
		 $user_id     = $user->id;  
   
    $projectWork = $this->ProjectWorks->get($id, [
        'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes','DepartmentwiseWorkTypes'],
    ]);

    $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
   // $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
     $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks','FundSources','SupervisionCharges'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();


      	 $abstractcount = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
		 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
		 if($abstractcount > 0){
		 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['BuildingItems'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id']])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
		  } 
	   
	$financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
    $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
    $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
    $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
    //$projectWorkSubdetailcount   = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id])->count();
    //$projectWorkSubdetails        = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id])->toArray();
     //$projectWorkSubdetailscount  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id])->count();
	 
		$projectWorkSubdetailscount  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id])->count();
		if($role_id == 2 || $role_id == 3 || $role_id == 4 ||  $role_id == 13 || $role_id == 14){
  		   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses'])->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.division_id'=>$division_id])->toArray();
  		}else if($role_id == 5 || $role_id == 11 || $role_id == 12){
  		   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses'])->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.circle_id'=>$circle_id])->toArray();
  		   //print_r($projectWorkSubdetails); exit();
		}else{
		   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses'])->where(['ProjectWorkSubdetails.id' => $work_id])->toArray();
		}
	
	
	$tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails','TenderTypes'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id])->toArray(); 
    $tenderscount                = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id])->count(); 
    $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id'=>$id,'ContractorDetails.project_work_subdetail_id'=> $work_id])->count(); 
    $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks','Contractors'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id])->first(); //tender key
   
     $planningcount       = $this->PlanningPermissionDetails->find('all')->where(['PlanningPermissionDetails.project_work_id' => $id,'PlanningPermissionDetails.project_work_subdetail_id'=>$work_id])->count();
	   $planningdetail      = $this->PlanningPermissionDetails->find('all')->contain(['ProjectWorks'])->where(['PlanningPermissionDetails.project_work_id' => $id,'PlanningPermissionDetails.project_work_subdetail_id'=>$work_id])->first();
    

    $requestcount                = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->count();
    $fundrequests                = $this->ProjectFundRequestDetails->find('all')->contain(['ProjectWorks'])->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->toArray();
     //echo '<pre>'; print_r($projectWorkSubdetailcount); exit();

    $this->set(compact('projectWork',
    'administrativesanctioncount','administrativesanction',
    'financialSanctionscount','financialSanctions','technicalcount','technical',
    '$projectWorkSubdetailcount','projectWorkSubdetails','tenders','tenderscount',
    'contractor_detail_count','contractor_details','requestcount','fundrequests','projectWorkSubdetailscount','planningcount','planningdetail','abstractcount','abstract_subdetails'));

    }
     	
	public function planningpermission($id = null,$work_id=null)
	{
			// echo "<pre>"; print_r($work_id); exit()	;
			$this->viewBuilder()->setLayout('layout');
			$user = $this->request->getAttribute('identity');
			$this->loadModel('ProjectWorks');
			$this->loadModel('PlanningPermissionDetails');

			$projectWork = $this->ProjectWorks->get($id, [
				'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
			]);

			$Planningcount = $this->PlanningPermissionDetails->find('all')->contain(['ProjectWorks'])->where(['PlanningPermissionDetails.project_work_id' => $id,'PlanningPermissionDetails.project_work_subdetail_id'=>$work_id])->count();
			$planingdetail = $this->PlanningPermissionDetails->find('all')->contain(['ProjectWorks'])->where(['PlanningPermissionDetails.project_work_id' => $id,'PlanningPermissionDetails.project_work_subdetail_id'=>$work_id])->first();
			$apporved=[1=>'Yes',2=>'No'];
			if($Planningcount == 0){
				$planningPermissionDetail = $this->PlanningPermissionDetails->newEmptyEntity();
			}
		  
			if ($this->request->is(['patch', 'post', 'put'])) {
				 //echo "<pre>"; print_r($this->request->getData()); exit();

				if ($Planningcount > 0) {
			  
					$planningPermissionDetail = $this->PlanningPermissionDetails->get($this->request->getData('id'), [
					]);             
				}
			   	if($this->request->getData('is_permission_apporved')==1){
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
			   }
				$planningPermissionDetail->project_work_id                     = $id;
				$planningPermissionDetail->project_work_subdetail_id           = $work_id;
				if($this->request->getData('is_permission_apporved')==1){
					$planningPermissionDetail->approved_date                   = date('Y-m-d', strtotime($this->request->getData('approved_date')));

				}elseif($this->request->getData('is_permission_apporved')==2){
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
					$this->Flash->success(__('The planning permission detail has been saved.'));
					
			      if($this->request->getData('is_permission_apporved') == 1){
					  
					        $subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$project                        = $subdetailTable->get($work_id); 
							$project->planning_permission_flag     = 1; 
                            $project->project_work_status_id       = 10;							
							$subdetailTable->save($project);	  
				
				  }	  
					
             	 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/4']);

				}
				$this->Flash->error(__('The planning permission detail could not be saved. Please, try again.'));
			}
			
			$this->set(compact('planningPermissionDetail','Planningcount','planingdetail','apporved','id','work_id'));
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
		 $circle_id = $user->circle_id;
		 $user_id     = $user->id;
		 
		 
		 //echo $role_id ; exit();
		 
		 $projectWorkSubdetailscount  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $id])->count();
		if($role_id == 2 || $role_id == 3 || $role_id == 4 ||  $role_id == 13 || $role_id == 14){
  		   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses'])->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.division_id'=>$division_id])->toArray();
  		}else if($role_id == 5 || $role_id == 11 || $role_id == 12){
  		   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses'])->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.circle_id'=>$circle_id])->toArray();
  		   //print_r($projectWorkSubdetails); exit();
		}else{
		   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles','ProjectWorkStatuses'])->where(['ProjectWorkSubdetails.project_work_id' => $id])->toArray();
		}
		 
		 $role                        =   $this->Roles->find('list')->toArray();
			

        $this->set(compact('id','projectWorkSubdetails','role','projectWorkSubdetailscount','role_id','division_id','circle_id','user_id'));
    }
	
	public function  projectwisedevelopmentwork($id = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $this->loadModel('ProjectwiseDevelopmentWorkDetails');
        $this->loadModel('ProjectwiseDevelopmentWorkSubdetails');
        $user = $this->request->getAttribute('identity');
        $projectwiseDevelopmentWorkDetail = $this->ProjectwiseDevelopmentWorkDetails->newEmptyEntity();
        if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>'; print_r($this->request->getData()); exit();
            $projectwiseDevelopmentWorkDetail->project_work_id           = $id;
            $projectwiseDevelopmentWorkDetail->project_work_subdetail_id = $work_id;
            $projectwiseDevelopmentWorkDetail->development_work_id       = $this->request->getData('development_work_id');
            $projectwiseDevelopmentWorkDetail->created_by                = $user->id;
            $projectwiseDevelopmentWorkDetail->created_date              = date('Y-m-d H:i:s');

            if ($this->ProjectwiseDevelopmentWorkDetails->save($projectwiseDevelopmentWorkDetail)) {
                
               foreach($this->request->getData('workdetail') as $key => $answer){

                $projectwiseDevelopmentWorkSubdetail = $this->ProjectwiseDevelopmentWorkSubdetails->newEmptyEntity();

                $insert_id = $projectwiseDevelopmentWorkDetail->id;

                $projectwiseDevelopmentWorkSubdetail->projectwise_development_work_detail_id  = $insert_id;
                $projectwiseDevelopmentWorkSubdetail->building_item_id    = $answer['building_item_id'];
                $projectwiseDevelopmentWorkSubdetail->item_code           = $answer['item_code'];
                $projectwiseDevelopmentWorkSubdetail->item_description    = $answer['item_description'];
                $projectwiseDevelopmentWorkSubdetail->number_1            =$answer['number_1'];
                $projectwiseDevelopmentWorkSubdetail->number_2            =$answer['number_2'];
                $projectwiseDevelopmentWorkSubdetail->length              =$answer['length'];
                $projectwiseDevelopmentWorkSubdetail->breath              =$answer['breath'];
                $projectwiseDevelopmentWorkSubdetail->depth               =$answer['depth'];
                $projectwiseDevelopmentWorkSubdetail->quantity            =$answer['quantity'];
                $projectwiseDevelopmentWorkSubdetail->created_by          = $user->id;
                $projectwiseDevelopmentWorkSubdetail->created_date        = date('Y-m-d H:i:s');

               $this->ProjectwiseDevelopmentWorkSubdetails->save($projectwiseDevelopmentWorkSubdetail);
               }
             
            }            
                $this->Flash->success(__('The projectwise development work detail has been saved.'));

                return $this->redirect(['action' => 'projectwisedevelopmentwork/'.$id.'/'.$work_id]);
            
            $this->Flash->error(__('The projectwise development work detail could not be saved. Please, try again.'));
        }
        $projectWorks          = $this->ProjectwiseDevelopmentWorkDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $projectWorkSubdetails = $this->ProjectwiseDevelopmentWorkDetails->ProjectWorkSubdetails->find('list', ['limit' => 200])->all();
        $developmentWorks      = $this->ProjectwiseDevelopmentWorkDetails->DevelopmentWorks->find('list', ['limit' => 200])->all();
        $buildingItems         = $this->ProjectwiseDevelopmentWorkSubdetails->BuildingItems->find('list',  ['keyField' => 'id','valueField' => 'item_code'])->all();
        $projectdevelopment    = $this->ProjectwiseDevelopmentWorkDetails->find('all')->contain(['ProjectWorks', 'ProjectWorkSubdetails', 'DevelopmentWorks'])->where(['ProjectwiseDevelopmentWorkDetails.project_work_id' => $id,'ProjectwiseDevelopmentWorkDetails.project_work_subdetail_id'=>$work_id])->toArray();

         $this->set(compact('projectwiseDevelopmentWorkDetail', 'projectWorks', 'projectWorkSubdetails', 'developmentWorks','buildingItems','id','work_id','projectdevelopment'));
    }
	
	public function  projectwisedevelopmentworkview($id = null,$work_id = null,$development_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $this->loadModel('ProjectwiseDevelopmentWorkDetails');
        $this->loadModel('ProjectwiseDevelopmentWorkSubdetails');
        $this->loadModel('Divisions');
        $user = $this->request->getAttribute('identity');
       
         $projectdevelopment             = $this->ProjectwiseDevelopmentWorkDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails','DevelopmentWorks'])->where(['ProjectwiseDevelopmentWorkDetails.project_work_id' => $id,'ProjectwiseDevelopmentWorkDetails.project_work_subdetail_id'=>$work_id,'ProjectwiseDevelopmentWorkDetails.development_work_id'=>$development_id])->first();
         $projectdevelopment_subdetails  = $this->ProjectwiseDevelopmentWorkSubdetails->find('all')->where(['ProjectwiseDevelopmentWorkSubdetails.projectwise_development_work_detail_id' => $projectdevelopment['id']])->toArray();
         $division      = $this->Divisions->find('list')->toArray();
          //echo "<pre>"; print_r($projectdevelopment); exit();		
		 $this->set(compact('id','work_id','projectdevelopment','projectdevelopment_subdetails','division'));
    }

    public function ajaxitemcode($id = null)
    {
        $this->loadModel('BuildingItems');
        $Items = $this->BuildingItems->find('all')->where(['BuildingItems.id' => $id])->first();        
        $description     = $Items['item_description'];
        $item_code       = $Items['item_code'];
        $building_item = array('item_code'=>$item_code,'item_description'=>$description);
         echo  json_encode($building_item);
        exit();
    }

    public function ajaxdevelopmentavailability($id = null,$p_id = null,$w_id = null)
    {        
        $this->loadModel('ProjectwiseDevelopmentWorkDetails');
        $work_count = $this->ProjectwiseDevelopmentWorkDetails->find('all')->where(['ProjectwiseDevelopmentWorkDetails.development_work_id'=>$id,
        'ProjectwiseDevelopmentWorkDetails.project_work_id' => $p_id,
        'ProjectwiseDevelopmentWorkDetails.project_work_subdetail_id'=>$w_id
        ])->count();
       if($work_count > 0){
        echo 1;
       }else{
        echo 0;
       }
       exit();       
    }

    public function ajaxdevelopwork($i = null)
    {
        $this->loadModel('BuildingItems');
        $this->loadModel('ProjectwiseDevelopmentWorkSubdetails');
        $buildingItems = $this->ProjectwiseDevelopmentWorkSubdetails->BuildingItems->find('list',  ['keyField' => 'id','valueField' => 'item_code'])->all();
        $this->set(compact('i','buildingItems'));
    }
	
	public function  projectwisedevelopmentworkedit($id = null, $work_id = null,$dev_id = null)
    {
    $this->viewBuilder()->setLayout('layout');
    $this->loadModel('ProjectwiseDevelopmentWorkDetails');
    $this->loadModel('ProjectwiseDevelopmentWorkSubdetails');
    $user = $this->request->getAttribute('identity');
 
    $DevelopmentWorkDetail    = $this->ProjectwiseDevelopmentWorkDetails->find('all')->contain(['ProjectWorks', 'ProjectWorkSubdetails', 'DevelopmentWorks', 'ProjectwiseDevelopmentWorkSubdetails'])->where(['ProjectwiseDevelopmentWorkDetails.development_work_id' => $dev_id])->first();
	   if(isset($DevelopmentWorkDetail)){
		$DevelopmentWorkSubdetails = $this->ProjectwiseDevelopmentWorkSubdetails->find('all')->contain(['ProjectwiseDevelopmentWorkDetails', 'BuildingItems'])->where(['ProjectwiseDevelopmentWorkSubdetails.projectwise_development_work_detail_id' => $DevelopmentWorkDetail['id']])->toArray();
	   }
   
    if ($this->request->is(['patch', 'post', 'put'])) {  
          //echo"<pre>"; print_r($this->request->getData()); exit();     
            
        foreach($this->request->getData('workdetail') as $key => $answer){                //  echo"<pre>";print_r($answer);exit();

           if($answer['id'] != ''){
            $projectwiseDevelopmentWorkSubdetail = $this->ProjectwiseDevelopmentWorkSubdetails->get($answer['id'], [
                'contain' => [],
            ]);
            }else{

                $projectwiseDevelopmentWorkSubdetail = $this->ProjectwiseDevelopmentWorkSubdetails->newEmptyEntity();
            }

            $projectwiseDevelopmentWorkSubdetail->projectwise_development_work_detail_id  = $this->request->getData('main_id');
            $projectwiseDevelopmentWorkSubdetail->building_item_id    = $answer['building_item_id'];
            $projectwiseDevelopmentWorkSubdetail->item_code           = $answer['item_code'];
            $projectwiseDevelopmentWorkSubdetail->item_description    = $answer['item_description'];
            $projectwiseDevelopmentWorkSubdetail->number_1            = $answer['number_1'];
            $projectwiseDevelopmentWorkSubdetail->number_2            = $answer['number_2'];
            $projectwiseDevelopmentWorkSubdetail->length              = $answer['length'];
            $projectwiseDevelopmentWorkSubdetail->breath              = $answer['breath'];
            $projectwiseDevelopmentWorkSubdetail->depth               = $answer['depth'];
            $projectwiseDevelopmentWorkSubdetail->quantity            = $answer['quantity'];
            $projectwiseDevelopmentWorkSubdetail->modified_by         = $user->id;
            $projectwiseDevelopmentWorkSubdetail->modified_date       = date('Y-m-d H:i:s');

            $this->ProjectwiseDevelopmentWorkSubdetails->save($projectwiseDevelopmentWorkSubdetail);
        }  
      
            $this->Flash->success(__('The projectwise development work detail has been saved.'));
                return $this->redirect(['action' => 'projectwisedevelopmentwork/'.$id.'/'.$work_id]);
        
        $this->Flash->error(__('The projectwise development work detail could not be saved. Please, try again.'));
    }
    $projectWorks = $this->ProjectwiseDevelopmentWorkDetails->ProjectWorks->find('list', ['limit' => 200])->all();
    $projectWorkSubdetails = $this->ProjectwiseDevelopmentWorkDetails->ProjectWorkSubdetails->find('list', ['limit' => 200])->all();
    $developmentWorks = $this->ProjectwiseDevelopmentWorkDetails->DevelopmentWorks->find('list', ['limit' => 200])->all();
    $buildingItems = $this->ProjectwiseDevelopmentWorkSubdetails->BuildingItems->find('list',  ['keyField' => 'id','valueField' => 'item_code'])->all();
    $projectdevelopment       = $this->ProjectwiseDevelopmentWorkDetails->
    find('all')->contain(['ProjectWorks', 'ProjectWorkSubdetails', 'DevelopmentWorks'])->
    where(['ProjectwiseDevelopmentWorkDetails.project_work_id' => $id,
    'ProjectwiseDevelopmentWorkDetails.project_work_subdetail_id'=>$work_id
    ])->toArray();

     $this->set(compact('projectwiseDevelopmentWorkDetail','DevelopmentWorkDetail','DevelopmentWorkSubdetails','projectWorks', 'projectWorkSubdetails', 'developmentWorks','buildingItems','id','work_id','projectdevelopment'));
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
			// echo "<pre>";
			// print_r($this->request->getData());
			// exit();
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
		// $projectMinuteSubdetail = $this->ProjectMinuteSubdetails->get($id, [
			// 'contain' => [],
		// ]);    
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
		
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;
		$user_id     = $user->id;  
		
		if($type == 1){	
           $title = "Abstract Estimate List";		
           $type_cond = " AND psd.detailed_estimate_approval = 0 AND project_work_status_id IN (3,4)";
           $type_cond = "";
		}else if($type == 2){	
           $title = "Tehnical Sanction List";		 
           $type_cond = " AND psd.detailed_estimate_approval = 1 AND psd.project_work_status_id IN (6,7)";
		}else if($type == 3){	
           $title = "Tender Details List";		 
           $type_cond = " AND psd.detailed_estimate_approval = 1 AND psd.project_work_status_id = 8 AND psd.tender_detail_flag = 0";  
		}else if($type == 4){	
           $title = "Planning Permission List";		 
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
		}												
		
		if($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14){
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
	
			  $query              =  "SELECT psd.*,dis.name as district_name,dv.name as division_name,c.name as circle_name,ps.name as work_status
									 from project_work_subdetails as psd 
									 LEFT JOIN project_works as project on project.id = psd.project_work_id
									 LEFT JOIN districts as dis on dis.id= psd.district_id 
									 LEFT JOIN divisions as dv on dv.id= psd.division_id 
									 LEFT JOIN circles as c on c.id= psd.circle_id 
									 LEFT JOIN project_work_statuses as ps on ps.id= psd.project_work_status_id 
									 where project.ce_approved=1 and psd.is_active = 1 $condition  $fin_year_cond  $dept_cond  $project_cond $district_cond  $type_cond";		
											 
		   $projectWorks         = $connection->execute($query)->fetchAll('assoc'); 
	   }       
		
	     $departments     = $this->Departments->find('list')->all();
         $financialYears  = $this->FinancialYears->find('list')->order('id DESC')->all();	
         $districts       = $this->Districts->find('list')->all();	

	   $this->set(compact('title','type','districts','departments','financialYears','projectWorks','adminsanction_count','financial_count','techsanction_count','tender_count','monitoring_count','role_id','subdetail_present','estimate_uploaded','division_id','circle_id','user_id'));
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
			  $query              =  "SELECT psd.*,dis.name as district_name,dv.name as division_name,c.name as circle_name,cd.agreement_amount as agreement_amount,fs.go_no as fsgo_no,psd.sanctioned_amount as sac_amount
									 from project_work_subdetails as psd 
									 LEFT JOIN project_works as project on project.id = psd.project_work_id
									 LEFT JOIN districts as dis on dis.id= psd.district_id 
									 LEFT JOIN divisions as dv on dv.id= psd.division_id 
									 LEFT JOIN circles as c on c.id= psd.circle_id 
									 LEFT JOIN contractor_details as cd on cd.project_work_subdetail_id= psd.id 
									 LEFT JOIN project_financial_sanctions as fs on fs.project_work_id= project.id 
									 where psd.project_work_status_id >= 7 AND psd.fund_request_flag = 0   $condition  $fin_year_cond  $dept_cond ";	
									 
			 $projectworkdetails     = $connection->execute($query)->fetchAll('assoc'); 	
		     $projectworkdetailcount = count($projectworkdetails);
		 }
		
	    $departments    = $this->Departments->find('list', ['limit' => 200])->all();
        $financialYears = $this->FinancialYears->find('list')->order('id DESC')->all();		
			
	   $this->set(compact('departments', 'financialYears','projectworkdetails','role_id','division_id','circle_id','projectworkdetailcount'));	
	}

    public function ajaxfundrequestadd($id = null , $i=null){	
		if($id != ''){
		 $connection = ConnectionManager::get('default');	
         $query      =  "SELECT psd.*,dis.name as district_name,dv.name as division_name,c.name as circle_name,cd.agreement_amount as agreement_amount,fs.go_no as fsgo_no
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
    	   $this->set(compact('projectWorkSubdetail','i'));	
	}

    public function insertfundrequest(){
		$this->loadModel('ProjectFundRequests');	
		$this->loadModel('ProjectFundRequestStages');	
		$this->loadModel('ProjectFundRequestDetails');	
		$this->loadModel('ProjectFundRequestLogs');	
		$this->loadModel('ProjectFundRequestDetailLogs');	
		$this->loadModel('ProjectWorks');	
		$this->loadModel('Users');	
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
								$subproject->fund_approval_user_id = $nextuser_id;  
								$subdetailTable->save($subproject);
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
		
	   if($role_id == 6 || $role_id == 8){	 
		 
		   $projectFundRequests = $this->ProjectFundRequests->find('all')->contain(['FundStatuses', 'Users','Divisions', 'ProjectFundRequestDetails'])->toArray();
 
		}elseif($role_id == 5){
		 $division =  $this->Divisions->find('all')->where(['Divisions.circle_id'=>$circle_id])->first();
		 $division_id = $division['id'];
		 
		 
		   $projectFundRequests = $this->ProjectFundRequests->find('all')->contain(['FundStatuses', 'Users','Divisions', 'ProjectFundRequestDetails'])->where(['ProjectFundRequests.division_id'=>$division_id])->toArray();
 
		}else{
			$division_id = $user->division_id;
		
		   $projectFundRequests = $this->ProjectFundRequests->find('all')->contain(['FundStatuses', 'Users','Divisions', 'ProjectFundRequestDetails'])->where(['ProjectFundRequests.division_id'=>$division_id])->toArray();
	
		}
		 
     $this->set(compact('projectFundRequests','role_id','division_id','circle_id','currentuser_id'));	
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
        $query      =  "SELECT frd.request_amount,frd.balance_amount,psd.*,dis.name as district_name,dv.name as division_name,c.name as circle_name,cd.agreement_amount as agreement_amount,frd.project_work_subdetail_id as work_id,frd.id as request_detail_id,frd.transaction_amount as transaction_amount,frd.final_balance as final_balance,fs.go_no as fsgo_no,frd.id as request_id
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
		$user  = $this->request->getAttribute('identity');
		
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;
		$currentuser_id     = $user->id;
       $projectFundRequest = $this->ProjectFundRequests->find('all')->where(['ProjectFundRequests.id'=>$id])->first();
	  
	   	 $connection = ConnectionManager::get('default');	
         $query      =  "SELECT frd.request_amount,frd.balance_amount,psd.*,dis.name as district_name,dv.name as division_name,c.name as circle_name,cd.agreement_amount as agreement_amount,frd.project_work_subdetail_id as work_id,frd.id as request_detail_id,frd.transaction_amount as transaction_amount,frd.final_balance as final_balance,fs.go_no as fsgo_no,project.id as project_id
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
		
      if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>';  print_r($this->request->getData()); exit();
	           if($this->request->getData('fund_status_id') == 2){
				  //forward to SE
				  $division =  $this->Divisions->find('all')->where(['Divisions.id'=>$division_id])->first();
				  $circle_id = $division['circle_id'];
				 // print_r($circle_id); exit();
				  $users   = $this->Users->find('all')->where(['Users.circle_id'=>$circle_id,'Users.role_id'=>5,'Users.is_active'=>1])->first();	
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
				  $users   = $this->Users->find('all')->where(['Users.division_id'=>$projectFundRequest['division_id'],'Users.role_id'=>4,'Users.is_active'=>1])->first();
                  $user_id = $users['id']; 	
                // print_r($users); exit();				  
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
				 
			 }else if($role_id == 8){				 
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
			 } else if(($role_id == 4) && ($projectFundRequest['is_approved'] != 0)){	 
				 
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
							
							/*if($this->request->getData('fund_status_id') == 7){	
                                $hobalancedetail       = $this->OpeningBalanceDetails->find('all')->contain(['Offices','Divisions'])->where(['OpeningBalanceDetails.office_id' => 1])->first();
                                $divisionbalanceDetail = $this->OpeningBalanceDetails->find('all')->contain(['Offices','Divisions'])->where(['OpeningBalanceDetails.division_id' => $division_id])->first();
                            							  
					           // HO Debit details							   
							   if($hobalancedetail != ''){	
									$hoopening   = $hobalancedetail['opening_balance'] - $projectFundRequest['total_transaction_amount'];		
								}					  
					            $openingBalanceLog   = $this->OpeningBalanceLogs->newEmptyEntity();
								$openingBalanceLog->division_id           = null;
								$openingBalanceLog->office_id             = 1;
								$openingBalanceLog->opening_balance       = $hoopening;
								$openingBalanceLog->balance_date          = date('Y-m-d');
								$openingBalanceLog->payment_info          = 2;
								//$openingBalanceLog->request_date          = date('Y-m-d',strtotime($projectFundRequest['request_date']));
								$openingBalanceLog->transaction_amount    = $projectFundRequest['total_request_amount'];
								$openingBalanceLog->is_amount_received    = 0;
								$openingBalanceLog->received_date         = null;
								$openingBalanceLog->received_amount       = null;
								$openingBalanceLog->created_by            = $user->id;
								$openingBalanceLog->created_date          = date('Y-m-d H:i:s');
								//echo "<pre>"; print_r($openingBalanceLog); exit();
								if ($this->OpeningBalanceLogs->save($openingBalanceLog)) {
									$OpeningBalanceDetailsTable     = $this->getTableLocator()->get('OpeningBalanceDetails');
									$project                        = $OpeningBalanceDetailsTable->get($hobalancedetail['id']);
									$project->opening_balance       = $hoopening;
									$project->balance_date          =  date('Y-m-d');
									$OpeningBalanceDetailsTable->save($project);
								}
								
                              // Division Credit details							   
							   if($divisionbalanceDetail != ''){	
									$divopening   = $divisionbalanceDetail['opening_balance'] + $projectFundRequest['total_transaction_amount'];		
								}					  
					            $openingBalanceLog1   = $this->OpeningBalanceLogs->newEmptyEntity();
								$openingBalanceLog1->division_id           = $division_id;
								$openingBalanceLog1->office_id             = 2;
								$openingBalanceLog1->opening_balance       = $divopening;
								$openingBalanceLog1->balance_date          = date('Y-m-d');
								$openingBalanceLog1->payment_info          = 1;
								$openingBalanceLog1->request_date          = date('Y-m-d',strtotime($this->request->getData('request_date')));
								$openingBalanceLog1->request_amount        = $projectFundRequest['total_request_amount'];
								$openingBalanceLog1->is_amount_received    = 1;
								$openingBalanceLog1->received_date         = date('Y-m-d',strtotime($this->request->getData('amount_received_date')));
								$openingBalanceLog1->received_amount       = $projectFundRequest['total_transaction_amount'];
								$openingBalanceLog1->created_by            = $user->id;
								$openingBalanceLog1->created_date          = date('Y-m-d H:i:s');
								if ($this->OpeningBalanceLogs->save($openingBalanceLog1)) {
									$OpeningBalanceDetailsTable1     = $this->getTableLocator()->get('OpeningBalanceDetails');
									$project1                        = $OpeningBalanceDetailsTable1->get($divisionbalanceDetail['id']);
									$project1->opening_balance       = $divopening;
									$project1->balance_date          =  date('Y-m-d');
									$OpeningBalanceDetailsTable1->save($project1);
								}						
							}*/
							
							$this->Flash->success(__('The Fund request Approval has been saved.'));
                          return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectfundrequestlist']);
                      }else{
                       $this->Flash->error(__('The Fund request Approval could not be saved. Please, try again.'));

					  }						  
			   }  	  
	    }
	  
	  
	    if($role_id == 8){	   
			$fundStatuses = $this->FundStatuses->find('list')->where(['FundStatuses.id IN'=>[5,6]])->all();
		}else if($role_id == 4){	  
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
    $this->loadModel('ProjectWorkSubdetails');
    $user = $this->request->getAttribute('identity');
	$role_id     = $user->role_id;
    $division_id = $user->division_id;

	 $projectWorkSubdetail  = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id'=>$work_id])->first();
	 $abstractcount   = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
	 //print_r($abstractcount); exit();
	 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
	 if($abstractcount != 0){
	 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['BuildingItems'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id']])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
	  }
	  
	 $detailed_approval_stages_count  = $this->DetailedEstimateApprovalStages->find('all')->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->count();
     $detailed_approval_stages        = $this->DetailedEstimateApprovalStages->find('all')->contain(['ApprovalStatuses'])->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->toArray();
	
	
	    $connection               = ConnectionManager::get('default');
        $query                    =  "SELECT sum(projectsub.amount) as total_amount
                                     from projectwise_abstract_subdetails as projectsub
                                     LEFT JOIN projectwise_abstract_details as project on project.id = projectsub.projectwise_abstract_detail_id
                                     where project.project_work_id = '".$id."' AND project.project_work_subdetail_id = '".$work_id."'";
									 
       $Totalamount             = $connection->execute($query)->fetchAll('assoc');
	   
	  // print_r($Totalamount); exit();
	   
	   $tot_amount =  $Totalamount[0]['total_amount'];
	  
    if ($this->request->is(['patch', 'post', 'put'])) {


		//echo "<pre>";  print_r($this->request->getData()); exit();
		$completed_flag = $this->request->getData('completed_flag');
		//echo "<pre>";  print_r($completed_flag); exit();
		
		if($completed_flag == 1){
			   if($projectWorkSubdetail['detailed_estimate_flag'] == 0){
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

			   }				 
				 
			        $users  = $this->Users->find('all')->where(['Users.role_id'=>6,'Users.is_active'=>1])->first();
                    $user_id = $users['id'];	
                     //print_r($user_id);  exit();	
		  
			        $subdetailTable                     = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                            = $subdetailTable->get($projectWorkSubdetail['id']); 
					$project->detailed_estimate_flag    = 1;  
					$project->detailed_estimate_upload  = $newfile;  
					$project->detailed_estimate_current_role  = 6;  
					$project->project_work_status_id  = 4;  
					$subdetailTable->save($project); 					
									
					
				$detailedEstimateApprovalStage = $this->DetailedEstimateApprovalStages->newEmptyEntity();	
				$detailedEstimateApprovalStage->project_work_id           = $id;
				$detailedEstimateApprovalStage->project_work_subdetail_id = $work_id;
				$detailedEstimateApprovalStage->user_id	                  = $user_id;
				$detailedEstimateApprovalStage->current_role_id           = 6;
				$detailedEstimateApprovalStage->current_status            = 'Forwarded to CE';  
				$detailedEstimateApprovalStage->approval_status_id        = 1;
				$detailedEstimateApprovalStage->submit_date               = date('Y-m-d');
				$detailedEstimateApprovalStage->created_by                = $user->id;
                $detailedEstimateApprovalStage->created_date               = date('Y-m-d H:i:s');
			  //echo "<pre>";  print_r($detailedEstimateApprovalStage); exit();
			 if ($this->DetailedEstimateApprovalStages->save($detailedEstimateApprovalStage)) {		
		        $this->Flash->success(__('The project Detailed Estimate has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/1']);
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
                $abstractsubdetail->building_item_id    = ($answer['building_item_id'])?$answer['building_item_id']:0;
                $abstractsubdetail->item_code           = ($answer['item_code'])?$answer['item_code']:0;
				if($this->request->getData('type') == 0){
                $abstractsubdetail->item_description    = $answer['item_description'];
				}else{
                $abstractsubdetail->item_description    = $answer['item_description1'];
				}
                $abstractsubdetail->quantity            = $answer['quantity'];
                $abstractsubdetail->rate                = $answer['rate'];
                $abstractsubdetail->amount              = $answer['amount'];
                $abstractsubdetail->created_by          = $user->id;
                $abstractsubdetail->created_date        = date('Y-m-d H:i:s');
				
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
	 if($abstractcount == 0){
      $buildingItems     = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->all();
     }else if($abstractcount != 0){
	  $entered_id = $this->ProjectwiseAbstractSubdetails->find('list',['keyField' => 'building_item_id','valueField' =>'building_item_id'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.building_item_id !='=>0])->toArray();
      $buildingItems     = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->where(['BuildingItems.id NOT IN'=>$entered_id])->all();
     }
	$this->set(compact('tot_amount','projectDevelopmentWorkDetail', 'projectWorks','buildingItems','projectWorkSubdetails', 'developmentWorks','id','work_id','abstract_subdetails','detailed_approval_stages_count','detailed_approval_stages','abstractcount'));
    }
	
	public function projectabstractedit($id = null,$work_id = null,$abstract_id = null)
    {  
    $this->viewBuilder()->setLayout('layout');
    $this->loadModel('ProjectwiseAbstractDetails');
    $this->loadModel('ProjectwiseAbstractSubdetails');
    $this->loadModel('BuildingItems');
    $user = $this->request->getAttribute('identity');	
	$role_id     = $user->role_id;
		$division_id = $user->division_id;


	 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['BuildingItems'])->where(['ProjectwiseAbstractSubdetails.id'=>$abstract_id])->toArray();
	  $abstract_detail_id = $abstract_subdetails[0]['projectwise_abstract_detail_id'];
    if ($this->request->is(['patch', 'post', 'put'])) { //echo "<pre>";  print_r($this->request->getData()); exit();
   
            foreach ($this->request->getData('workdetail') as $key => $answer) {
                //$abstractsubdetail = $this->ProjectwiseAbstractSubdetails->newEmptyEntity();
				$abstractsubdetail = $this->ProjectwiseAbstractSubdetails->get($abstract_id, [
						'contain' => [],
					]);
		   		
                $abstractsubdetail->projectwise_abstract_detail_id  = $abstract_detail_id;
                $abstractsubdetail->building_item_id    = ($answer['building_item_id'])?$answer['building_item_id']:'0';
                $abstractsubdetail->item_code           = ($answer['item_code'])?$answer['item_code']:'0';
                $abstractsubdetail->item_description    = $answer['item_description'];
                $abstractsubdetail->quantity            = $answer['quantity'];
                $abstractsubdetail->rate                = $answer['rate'];
                $abstractsubdetail->amount              = $answer['amount'];
                $abstractsubdetail->modified_by          = $user->id;
                $abstractsubdetail->modified_date        = date('Y-m-d H:i:s');
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
        //$this->Flash->error(__('The project Abstract detail could not be updated. Please, try again.'));
    //}
	
	
	 // $entered_id = $this->ProjectwiseAbstractSubdetails->find('list',['keyField' => 'building_item_id','valueField' =>'building_item_id'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.building_item_id !='=>0])->toArray();
     // //print_r($entered_id); exit();
	 // if($abstractcount == 0){
     // }else{
      // $buildingItems     = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->where(['BuildingItems.id NOT IN'=>$entered_id])->all();
     // }
      $buildingItems     = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->all();
	$this->set(compact('projectDevelopmentWorkDetail', 'projectWorks','buildingItems','projectWorkSubdetails', 'developmentWorks','id','work_id','abstract_subdetails'));
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
    $user = $this->request->getAttribute('identity');	
	$role_id     = $user->role_id;
	$division_id = $user->division_id;	
	
	 $projectWorkSubdetail            = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id'=>$work_id])->first();

	 $abstractcount = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
	 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$id,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
	 if($abstractcount > 0){
	 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['BuildingItems'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id']])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
	  }  
	  
	  
	 // echo "<pre>"; print_r($abstract_subdetails); exit();
	  
	     $detailed_approval_stages_count  = $this->DetailedEstimateApprovalStages->find('all')->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->count();
        $detailed_approval_stages        = $this->DetailedEstimateApprovalStages->find('all')->contain(['ApprovalStatuses'])->where(['DetailedEstimateApprovalStages.project_work_id' => $id,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->toArray();
	
	   
        if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>';  print_r($this->request->getData()); exit();
                $approval_status_id =  $this->request->getData('approval_status_id');	
				
                if($approval_status_id == 1 || $approval_status_id == 3){					
            
				  if($role_id == 6){
                      $user_id = 0;	
					  $next_role_id    = 0;
					  $status = 'CE Approved';
				  }					  
					
				}else if($approval_status_id == 2){
					if($role_id == 6){
						$next_role_id    = 14;
						 $status = 'CE Clarification to DB';
					}
					
					if($next_role_id == 14){
					  //$status = 'EE Clarification to Drawing Branch';	
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
					}else if($role_id == 6 && $this->request->getData('approval_status_id') == 2){
                      $project->detailed_estimate_flag  = 0;
					}						
					$subdetailTable->save($project); 
					
		        $this->Flash->success(__('The project Detailed Estimate has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'approvedlist']);
			  }				
		}
		
     $approvalStatuses = $this->ApprovalStatuses->find('list', ['limit' => 200])->where(['ApprovalStatuses.is_active'=>1])->all();

	$this->set(compact('abstract_subdetails','approvalStatuses','projectWork','projectwiseDetailedEstimate', 'projectWorks','detailed_estimates','id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','work_id','total_estimate','detailed_approval_stages','detailed_approval_stages_count','role_id'));
	   
   }

   public function ajaxprojectdevelopmentwork($i = null,$type =null)
   {
    $this->loadModel('BuildingItems');
    //$this->loadModel('ProjectwiseDevelopmentWorkSubdetails');
    $buildingItems = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->all();
   
   $this->set(compact('i', 'buildingItems','type'));
  }
 
	
}