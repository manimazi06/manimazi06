<?php

declare(strict_types=1);
namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Locator\LocatorAwareTrait;

class OldProjectWorkDetailsController extends AppController  
{
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
		$this->loadModel('ProjectWorkSubdetails');
		
		$user = $this->request->getAttribute('identity');  
		$role_id = $user->role_id;
		$division_id = $user->division_id;
		$circle_id = $user->circle_id;
		$user_id = $user->id;	
		
		if($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15){
			$condition = " and old.division_id = " . $division_id . "";
		}else if($role_id == 5 || $role_id == 11 || $role_id == 12){
			$condition = " and old.circle_id = " . $circle_id . "";
		}else{
			$condition = "";
		}

        $connection = ConnectionManager::get('default');		
		if ($this->request->is('post')) {
			
			  $fin_year_cond      = ($this->request->getData('financial_year_id') != '')?" AND old.financial_year_id = ".$this->request->getData('financial_year_id')."":"";
			  $dept_cond          = ($this->request->getData('department_id') != '')?" AND old.department_id = ".$this->request->getData('department_id')."":""; 				  
			  $go_cond            = ($this->request->getData('go_no')!= '')?" AND old.go_no like '%".$this->request->getData('go_no')."%'":"";
			  $div_cond           = ($this->request->getData('division_id')!= '')?" AND old.division_id = '".$this->request->getData('division_id')."'":"";
			 
		
			$query = "SELECT old.project_name as projectname,old.id as id,
                    old.go_no as go_no,
                    dis.name as dname,
                    divi.name as diname,
                    c.name as cname,
					old.place_name as place_name,
					old.fs_value as fs_value,
					fy.name as fy_name,
					d.name as deptname,old.skip_fs_flag as skip_fs_flag
                    FROM `old_project_work_details` as old
                    LEFT JOIN districts as dis on dis.id = old.district_id
                    LEFT JOIN divisions divi on divi.id = old.division_id 
                    LEFT JOIN circles c on c.id = old.circle_id 
                    LEFT JOIN financial_years fy on fy.id = old.financial_year_id 
                    LEFT JOIN departments d on d.id = old.department_id 
					where old.is_active=1 and old.work_completed = 0 and old.work_type = 1 $condition $fin_year_cond $dept_cond $go_cond $div_cond  order by fy.id DESC";
			
		}else{

        $query = "SELECT  old.project_name as projectname,old.id as id,
                    old.go_no as go_no,
                    dis.name as dname,
                    divi.name as diname,
                    c.name as cname,
					old.place_name as place_name,
					old.fs_value as fs_value,
					fy.name as fy_name,
					d.name as deptname,old.skip_fs_flag as skip_fs_flag
                    FROM `old_project_work_details` as old
                    LEFT JOIN districts as dis on dis.id = old.district_id
                    LEFT JOIN divisions divi on divi.id = old.division_id 
                    LEFT JOIN circles c on c.id = old.circle_id 
                    LEFT JOIN financial_years fy on fy.id = old.financial_year_id 
					LEFT JOIN departments d on d.id = old.department_id 
					where old.is_active=1 and old.work_completed = 0 and old.work_type = 1 $condition order by fy.id DESC";
		}


        $oldProjectWorkDetails      = $connection->execute($query)->fetchAll('assoc');
		$project_count = array();
		$project = array();
		foreach($oldProjectWorkDetails as $old_project){
			        $project_count[$old_project['id']]  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.old_project_work_detail_id' => $old_project['id']])->count();
			        $project[$old_project['id']]        = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.old_project_work_detail_id' => $old_project['id']])->first();
		
		}
		
		 $this->loadModel('Departments');
		 $this->loadModel('FinancialYears');
		 $this->loadModel('Divisions');
		
		  $departments    = $this->Departments->find('list')->all();  
          $financialYears = $this->FinancialYears->find('list')->order('id Desc')->all();	
          $divisions      = $this->Divisions->find('list')->all();		
        
        $this->set(compact('oldProjectWorkDetails','departments','financialYears','divisions','project_count','project','role_id'));
    }
		
	public function specialrepairlist()
    {
        $this->viewBuilder()->setLayout('layout');
		$this->loadModel('ProjectWorkSubdetails');
		
		$user = $this->request->getAttribute('identity');  
		$role_id = $user->role_id;
		$division_id = $user->division_id;
		$circle_id = $user->circle_id;
		$user_id = $user->id;	
		//print_r($role_id); exit();
		
		if($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15){
			$condition = " and old.division_id = " . $division_id . "";
		}else if($role_id == 5 || $role_id == 11 || $role_id == 12){
			$condition = " and old.circle_id = " . $circle_id . "";
		}else{
			$condition = "";
		}

        $connection = ConnectionManager::get('default');		
		if ($this->request->is('post')) {
			
			  $fin_year_cond      = ($this->request->getData('financial_year_id') != '')?" AND old.financial_year_id = ".$this->request->getData('financial_year_id')."":"";
			  $dist_cond          = ($this->request->getData('district_id') != '')?" AND old.district_id = ".$this->request->getData('district_id')."":""; 				  
			  $ref_no_cond            = ($this->request->getData('ref_no')!= '')?" AND old.ref_no like '%".$this->request->getData('ref_no')."%'":"";
			  $div_cond           = ($this->request->getData('division_id')!= '')?" AND old.division_id = '".$this->request->getData('division_id')."'":"";
			 
		
			$query = "SELECT old.project_name as projectname,old.id as id,
                    old.ref_no as ref_no,
                    dis.name as dname,
                    divi.name as diname,
                    c.name as cname,
					old.place_name as place_name,
					fy.name as fy_name					
                    FROM `old_project_work_details` as old
                    LEFT JOIN districts as dis on dis.id = old.district_id
                    LEFT JOIN divisions divi on divi.id = old.division_id 
                    LEFT JOIN circles c on c.id = old.circle_id 
                    LEFT JOIN financial_years fy on fy.id = old.financial_year_id 
					where old.is_active=1 and old.work_completed = 0 and old.work_type = 2 $condition $fin_year_cond $dist_cond $ref_no_cond $div_cond  order by fy.id DESC";
			
		}else{

        $query = "SELECT  old.project_name as projectname,old.id as id,
                    old.ref_no as ref_no,
                    dis.name as dname,
                    divi.name as diname,
                    c.name as cname,
					old.place_name as place_name,
					fy.name as fy_name
                    FROM `old_project_work_details` as old
                    LEFT JOIN districts as dis on dis.id = old.district_id
                    LEFT JOIN divisions divi on divi.id = old.division_id 
                    LEFT JOIN circles c on c.id = old.circle_id 
                    LEFT JOIN financial_years fy on fy.id = old.financial_year_id 
					where old.is_active=1 and old.work_completed = 0 and old.work_type = 2 $condition order by fy.id DESC";
		}

        $oldProjectWorkDetails      = $connection->execute($query)->fetchAll('assoc');
		$project_count = array();
		$project = array();
		foreach($oldProjectWorkDetails as $old_project){
			        $project_count[$old_project['id']]  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.old_project_work_detail_id' => $old_project['id']])->count();
			        $project[$old_project['id']]        = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.old_project_work_detail_id' => $old_project['id']])->first();
		
		}
		
		 $this->loadModel('Districts');
		 $this->loadModel('FinancialYears');
		 $this->loadModel('Divisions');
		 if($role_id == 14){
		  $districts    = $this->Districts->find('list')->where(['Districts.division_id'=>$division_id])->toArray(); 
		 }else{		  
		  $districts    = $this->Districts->find('list')->toArray();  
		 }        
		  
		  $financialYears = $this->FinancialYears->find('list')->order('id Desc')->all();	
          $divisions      = $this->Divisions->find('list')->all();		
        
        $this->set(compact('oldProjectWorkDetails','districts','financialYears','divisions','project_count','project','role_id'));
    }

   	public function ajaxchennaidivisions($id)
    {
        $this->loadModel('Divisions');
        if ($id == 2) {
            $divisions    = $this->Divisions->find('all')->where(['Divisions.id IN' => [1, 2]])->toArray();
        } else {
            $divisions    = $this->Divisions->find('all')->toArray();
        }
        //print_r($work_types);  exit();
        $this->set(compact('divisions'));
    }

    public function basicdetail($id = null, $pid = null, $work_id = null)
    {
   //        echo"<pre>";print_r($id,$pid,$work_id);exit();
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $role_id     = $user->role_id;
        $division_id = $user->division_id;
        $this->loadModel('ProjectWorkSubdetails');
        $this->loadModel('ProjectWorks');
        $this->loadModel('DepartmentwiseWorkTypes');
        $this->loadModel('Districts');
        $this->loadModel('Divisions');
	    $this->loadModel('Circles');
		$this->loadModel('Departments');
        $this->loadModel('FinancialYears');       
        $this->loadModel('SchemeTypes');

       $oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->contain(['Districts', 'Divisions', 'Circles', 'FinancialYears', 'Departments'])->where(['OldProjectWorkDetails.id' => $id])->first();
       $work_type = $oldProjectWorkDetail['work_type'];

	//print_r(date('Y', strtotime($oldProjectWorkDetail['go_date']))); exit();
        if ($pid != '') {
            $projectWork = $this->ProjectWorks->get($pid, [
                'contain' => [],
            ]);
            $work_types    = $this->DepartmentwiseWorkTypes->find('list')->where(['DepartmentwiseWorkTypes.department_id' => $projectWork['department_id']])->toArray();
        }else  if ($pid == '') {
            $projectWork = $this->ProjectWorks->newEmptyEntity();
        } 	
		

        if ($work_id != '') {

            $projectWorkSubdetail = $this->ProjectWorkSubdetails->get($work_id, [
                //  'contain' => [],
            ]);

            $districts = $this->Districts->find('list')->toArray();
            $circles   = $this->Circles->find('list')->toArray();
            $divisions = $this->Divisions->find('list')->where(['Divisions.circle_id' => $projectWorkSubdetail['circle_id']])->toArray();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $attachment  = $this->request->getData('file_upload');

            if ($attachment->getClientFilename() != '') {
                $name    = $attachment->getClientFilename();
                $type    = $attachment->getClientMediaType();
                $size    = $attachment->getSize();
                $tmpName = $attachment->getStream()->getMetadata('uri');
                $error   = $attachment->getError();

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
            } else {
                $projectWork->file_upload                  =  $this->request->getData('file_upload1');
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
            $projectWork->departmentwise_work_type_id      =  $this->request->getData('departmentwise_work_type_id');
            $projectWork->created_by          =  $user->id;
            $projectWork->created_date        =  date('Y-m-d H:i:s');

            if ($this->ProjectWorks->save($projectWork)) {
				
				 if ($work_id == '') {
                    $projectWorkSubdetail = $this->ProjectWorkSubdetails->newEmptyEntity();
                    $insertid     = $projectWork->id;
                } else {

                    $insertid     = $pid;
                }
				
				$depid         =  $this->request->getData('department_id');
                $yearname      =  $this->request->getData('financial_year_id');
                $dep           = $this->Departments->find('all')->where(['Departments.id' => $depid])->first();
                $profinancial  = $this->FinancialYears->find('all')->where(['FinancialYears.id' => $yearname])->first();
                $fyear         = substr($profinancial['name'], -2);
                $depcode       = strtoupper(substr($dep['name'], 0, 3));
                $var           = sprintf('%03d', $insertid);
               
                $projectcode               =  'WIP'.$fyear.$depcode.$var;			
			 
                $ProjectWorksTable      = $this->getTableLocator()->get('ProjectWorks');
                $project                = $ProjectWorksTable->get($insertid); 
                $project->project_code  = $projectcode;
                $ProjectWorksTable->save($project);				
		              
                $projectWorkSubdetail->project_work_id         = $insertid;
                $projectWorkSubdetail->work_name               = $this->request->getData('work_name');
			    $projectWorkSubdetail->work_code               = $projectcode;
                $projectWorkSubdetail->place_name              =  $this->request->getData('place_name');
                $projectWorkSubdetail->district_id             =  $this->request->getData('district_id');
                $projectWorkSubdetail->division_id             =  $this->request->getData('division_id');
                $projectWorkSubdetail->circle_id               =  $this->request->getData('circle_id');
                $projectWorkSubdetail->rough_cost              =  $this->request->getData('project_amount');
                $projectWorkSubdetail->old_project_flag        =  1;
                $projectWorkSubdetail->old_project_work_detail_id   = $id;
				$projectWorkSubdetail->is_approved             =  1;
                $projectWorkSubdetail->submit_date             =  date('Y-m-d');
                $projectWorkSubdetail->created_by              =  $user->id;
                $projectWorkSubdetail->created_date            =  date('Y-m-d:h:m:s');
               // echo"<pre>";print_r($projectWorkSubdetail);exit();
                if ($this->ProjectWorkSubdetails->save($projectWorkSubdetail)) {

                    $sub_insert_id = $projectWorkSubdetail->id;
					$division                  = $this->Divisions->find('all')->where(['Divisions.id' => $this->request->getData('division_id')])->first();
					if($oldProjectWorkDetail['go_date'] != ''){
					$goyear                    = date('Y', strtotime($oldProjectWorkDetail['go_date']));	
					}else{
                    $goyear                    = date('Y');
					}						
					$divsioncode               = $division['division_code']; 									
					$count =  $sub_insert_id;
					$var                       = sprintf('%02d', $count);				   
					$workcode                  = $goyear.$divsioncode.$var; 
					
					
                    $ProjectsubWorksTable      = $this->getTableLocator()->get('ProjectWorkSubdetails');
                    $projectsub                = $ProjectsubWorksTable->get($sub_insert_id);
					if ($pid == '') {
                    $projectsub->project_work_status_id  = 1;
					}
                    $projectsub->work_code               = $projectcode.'/'.$workcode;
                    $ProjectsubWorksTable->save($projectsub);
                }

                $this->Flash->success(__('The project work has been saved.'));
                return $this->redirect(['action' => 'administrativesanction/' . $id . '/' . $insertid . '/' . $sub_insert_id]);
            }
        }
        $this->loadModel('FinancialYears');
        $this->loadModel('BuildingTypes');
        $this->loadModel('ProjectStatuses');
        $this->loadModel('SchemeTypes');
        $departments    = $this->ProjectWorks->Departments->find('list', ['limit' => 200])->all();
        $financialYears = $this->FinancialYears->find('list')->order(['id Desc'])->all();
        $buildingTypes  = $this->BuildingTypes->find('list', ['limit' => 200])->all();
        $schemeTypes    = $this->SchemeTypes->find('list', ['limit' => 200])->all();
        $Statuses       = $this->ProjectStatuses->find('list', ['limit' => 200])->all();
        $divisions = $this->Divisions->find('list', ['limit' => 200])->all();
       
 	   if($projectWork['department_id'] != ''){       
	    $work_types = $this->DepartmentwiseWorkTypes->find('list')->where(['DepartmentwiseWorkTypes.department_id'=>$projectWork['department_id']])->toArray();
        }else if($oldProjectWorkDetail['department_id'] != ''){
		$work_types = $this->DepartmentwiseWorkTypes->find('list')->where(['DepartmentwiseWorkTypes.department_id'=>$oldProjectWorkDetail['department_id']])->toArray();
        }else {       
	    $work_types = $this->DepartmentwiseWorkTypes->find('list')->toArray();
        }
		$districts = $this->OldProjectWorkDetails->Districts->find('list', ['limit' => 200])->all();
        $circles = $this->OldProjectWorkDetails->Circles->find('list', ['limit' => 200])->all();

        $this->set(compact(
            'id','work_types','projectWorkSubdetail',
            'circles',
            'projectWork',
            'departments',
            'financialYears',
            'buildingTypes',
            'Statuses',
            'districts',
            'divisions',
            'role_id',
            'schemeTypes',
            'work_id',
            'oldProjectWorkDetail',
        ));
    }
	
	public function repairbasicdetail($id = null, $pid = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $role_id     = $user->role_id;
        $division_id = $user->division_id;
        $this->loadModel('ProjectWorkSubdetails');
        $this->loadModel('ProjectWorks');
        $this->loadModel('DepartmentwiseWorkTypes');
        $this->loadModel('Districts');
        $this->loadModel('Divisions');
	    $this->loadModel('Circles');
		$this->loadModel('Departments');
        $this->loadModel('FinancialYears');       
        $this->loadModel('SchemeTypes');
        $oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->contain(['Districts', 'Divisions', 'Circles', 'FinancialYears', 'Departments'])->where(['OldProjectWorkDetails.id' => $id])->first();
        $work_type = $oldProjectWorkDetail['work_type'];

        if ($pid != '') {
            $projectWork = $this->ProjectWorks->get($pid, [
                'contain' => [],
            ]);
           // $work_types    = $this->DepartmentwiseWorkTypes->find('list')->where(['DepartmentwiseWorkTypes.department_id' => $projectWork['department_id']])->toArray();
        }else  if ($pid == '') {
            $projectWork = $this->ProjectWorks->newEmptyEntity();
        } 			

        if ($work_id != '') {

            $projectWorkSubdetail = $this->ProjectWorkSubdetails->get($work_id, [
                //  'contain' => [],
            ]);

            $districts = $this->Districts->find('list')->toArray();
            $circles   = $this->Circles->find('list')->toArray();
            $divisions = $this->Divisions->find('list')->where(['Divisions.circle_id' => $projectWorkSubdetail['circle_id']])->toArray();
        }

        if ($this->request->is(['patch', 'post', 'put'])) { //echo "<pre>";  print_r($this->request->getData());  exit();

            $attachment  = $this->request->getData('work_file_upload');

            if ($attachment->getClientFilename() != '') {
                $name    = $attachment->getClientFilename();
                $type    = $attachment->getClientMediaType();
                $size    = $attachment->getSize();
                $tmpName = $attachment->getStream()->getMetadata('uri');
                $error   = $attachment->getError();

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
            } else {
                $projectWork->file_upload                  =  $this->request->getData('file_upload1');
            }
			
            $projectWork->department_id      	       = $this->request->getData('department_id');
            $projectWork->financial_year_id   		   = $this->request->getData('financial_year_id');
            $projectWork->building_type_id             = 0;
            $projectWork->project_status_id            = 1;
            $projectWork->project_name                 = $this->request->getData('work_name');
            $projectWork->project_description          = null;
            $projectWork->project_amount               = $this->request->getData('estimated_cost');
            $projectWork->scheme_type_id               = 0;
            $projectWork->coastal_area        		   = 0;
			$projectWork->ce_approved	               = 1;
            $projectWork->ref_no        		       = $this->request->getData('ref_no');
            $projectWork->departmentwise_work_type_id  = $this->request->getData('departmentwise_work_type_id');
            $projectWork->created_by                   = $user->id;
            $projectWork->created_date                 = date('Y-m-d H:i:s');
            if ($this->ProjectWorks->save($projectWork)) {
				
				 if ($work_id == '') {
                    $projectWorkSubdetail = $this->ProjectWorkSubdetails->newEmptyEntity();
                    $insertid     = $projectWork->id;
                } else {

                    $insertid     = $pid;
                }
				
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
               
				$projectcode               =  'R'.$fyear.$depcode.$var;				 
				$ProjectWorksTable      = $this->getTableLocator()->get('ProjectWorks');
				$project                = $ProjectWorksTable->get($insertid); 
				$project->project_code  = $projectcode;
				$ProjectWorksTable->save($project);		
					
				//$projectWorkSubdetail = $this->ProjectWorkSubdetails->newEmptyEntity();					
				$projectWorkSubdetail->project_work_id         = $insertid;
				$projectWorkSubdetail->work_code               = $projectcode;
				$projectWorkSubdetail->work_name               = $this->request->getData('work_name');
				$projectWorkSubdetail->place_name              = $this->request->getData('place_of_work');
				$projectWorkSubdetail->district_id             = $this->request->getData('district_id');
				$projectWorkSubdetail->division_id             = $this->request->getData('division_id');
				$projectWorkSubdetail->circle_id               = $this->request->getData('project_circle_id1');
				$projectWorkSubdetail->rough_cost              = $this->request->getData('estimated_cost');
				$projectWorkSubdetail->work_type               = 2;
				$projectWorkSubdetail->project_work_status_id  = 1;
			    $projectWorkSubdetail->old_project_flag        = 1;
                $projectWorkSubdetail->old_project_work_detail_id = $id;
				$projectWorkSubdetail->is_approved             = 1;
                $projectWorkSubdetail->submit_date             = date('Y-m-d');
                $projectWorkSubdetail->created_by              = $user->id;
                $projectWorkSubdetail->created_date            = date('Y-m-d:h:m:s');
               // echo"<pre>";print_r($projectWorkSubdetail);exit();
                if ($this->ProjectWorkSubdetails->save($projectWorkSubdetail)) {
                    $sub_insert_id = $projectWorkSubdetail->id;
					$this->Flash->success(__('The project work has been saved.'));
                    return $this->redirect(['action' => 'projectdetailedestimate/' . $id . '/' . $insertid . '/' . $sub_insert_id]);					
                }                
            }
        }
        $this->loadModel('FinancialYears');
        $this->loadModel('BuildingTypes');
        $this->loadModel('ProjectStatuses');
        $this->loadModel('SchemeTypes');
        $departments    = $this->ProjectWorks->Departments->find('list', ['limit' => 200])->all();
        $financialYears = $this->FinancialYears->find('list')->order(['id Desc'])->all();
        $buildingTypes  = $this->BuildingTypes->find('list', ['limit' => 200])->all();
        $schemeTypes    = $this->SchemeTypes->find('list', ['limit' => 200])->all();
        $Statuses       = $this->ProjectStatuses->find('list', ['limit' => 200])->all();
        $divisions = $this->Divisions->find('list', ['limit' => 200])->all();
    

	   if($projectWork['department_id'] != ''){       
	     $work_types = $this->DepartmentwiseWorkTypes->find('list')->where(['DepartmentwiseWorkTypes.department_id'=>$projectWork['department_id']])->toArray();
        }else if($oldProjectWorkDetail['department_id'] != ''){
		 $work_types = $this->DepartmentwiseWorkTypes->find('list')->where(['DepartmentwiseWorkTypes.department_id'=>$oldProjectWorkDetail['department_id']])->toArray();
         }else {       
	     $work_types = $this->DepartmentwiseWorkTypes->find('list')->toArray();
         }
		// $work_types = $this->DepartmentwiseWorkTypes->find('list')->toArray();
		$districts = $this->OldProjectWorkDetails->Districts->find('list', ['limit' => 200])->all();
        $circles = $this->OldProjectWorkDetails->Circles->find('list', ['limit' => 200])->all();

        $this->set(compact(
            'id','work_types','projectWorkSubdetail',
            'circles',
            'projectWork',
            'departments',
            'financialYears',
            'buildingTypes',
            'Statuses',
            'districts',
            'divisions',
            'role_id',
            'schemeTypes',
            'work_id',
            'oldProjectWorkDetail',
        ));
    }   
   
    public function administrativesanction($id, $pid, $work_id)
    {
        $this->viewBuilder()->setLayout('layout');
        $user  = $this->request->getAttribute('identity');
        $this->loadModel('ProjectAdministrativeSanctions');
        $this->loadModel('ProjectWorks');
        $this->loadModel('Departments');
        $this->loadModel('FinancialYears');
        $this->loadModel('SupervisionCharges');
        $this->loadModel('FundSources');
        $this->loadModel('ProjectWorkSubdetails');
		  				$projectwork        = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $pid])->first();

		
		 $oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->contain(['Districts', 'Divisions', 'Circles', 'FinancialYears', 'Departments'])->where(['OldProjectWorkDetails.id' => $id])->first();
         //echo"<pre>";  print_r($oldProjectWorkDetail);  exit();

        $administrativeSanction       = $this->ProjectAdministrativeSanctions->find('all')->where(['ProjectAdministrativeSanctions.project_work_id' => $pid])->first();

        if ($administrativeSanction['id'] == '') {
            $projectAdministrativeSanction = $this->ProjectAdministrativeSanctions->newEmptyEntity();
        } else if ($administrativeSanction['id'] != '') {

            $projectAdministrativeSanction = $this->ProjectAdministrativeSanctions->get($administrativeSanction['id'], []);
        }    

        $apwid = $administrativeSanction['project_work_id'];
        $projectworksubdetails  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $pid, 'ProjectWorkSubdetails.is_active' => 1])->first();

        $totalunit = $projectworksubdetails['total_units'];
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            // echo"<pre>";print_r($this->request->getData());exit();
            $attachment  = $this->request->getData('go_file_upload');

            if ($attachment->getClientFilename() != '') {
                $name    = $attachment->getClientFilename();
                $type    = $attachment->getClientMediaType();
                $size    = $attachment->getSize();
                $tmpName = $attachment->getStream()->getMetadata('uri');
                $error   = $attachment->getError();

                $file                                      =  $name;
                $array                                     =  explode('.', $file);
                $fileExt                                   =  $array[count($array) - 1];
                $current_time                              =  date('Y_m_d_H_i_s');
                $newfile                                   =  $pid."administativesanction_" . $current_time . "." . $fileExt;    
                $tempFile                                  =  $tmpName;
                $targetPath                                =  'uploads/AdministrativeSanctions/';
                $targetFile                                =  $targetPath . $newfile;
                $projectAdministrativeSanction->go_file_upload   =  $newfile;

                move_uploaded_file($tempFile, $targetFile);
            } else {
                $projectAdministrativeSanction->go_file_upload    =  $this->request->getData('go_file_upload1');
            }

            $projectAdministrativeSanction->project_work_id         =  $pid;
            $projectAdministrativeSanction->go_no                   =  $this->request->getData('go_no');
            $projectAdministrativeSanction->go_date                 =  date('Y-m-d', strtotime($this->request->getData('go_date')));
            $projectAdministrativeSanction->sanctioned_amount       =  $this->request->getData('sanctioned_amount');
            $projectAdministrativeSanction->supervision_charge_id   =  $this->request->getData('supervision_charge_id');
            $projectAdministrativeSanction->fund_source_id          =  $this->request->getData('fund_source_id');
            $projectAdministrativeSanction->created_by              =  $user->id;
            $projectAdministrativeSanction->created_date            =  date('Y-m-d:h:m:s');
           if ($administrativeSanction['id'] != '') {
                $projectAdministrativeSanction->modified_by              =  $user->id;
                $projectAdministrativeSanction->modified_date            =  date('Y-m-d:h:m:s');
            }
            // echo"<pre>";print_r($projectAdministrativeSanction);exit();

            if ($this->ProjectAdministrativeSanctions->save($projectAdministrativeSanction)) {
				
				$projectTable                   = $this->getTableLocator()->get('ProjectWorks');
				$project                        = $projectTable->get($pid); 
				$project->ce_approved	        = 1;
				$projectTable->save($project);

                $ProjectsubWorksTable      = $this->getTableLocator()->get('ProjectWorkSubdetails');
                $projectsub                = $ProjectsubWorksTable->get($work_id);
                $projectsub->sanctioned_amount   = $this->request->getData('sanctioned_amount');
                $projectsub->total_units   = $this->request->getData('total_units');
				if ($administrativeSanction['id'] == '') {
				$projectsub->project_work_status_id  = 3;
				}  
                $ProjectsubWorksTable->save($projectsub);
            }
            $this->Flash->success(__('The project administrative sanction has been saved.'));
            return $this->redirect(['action' => 'projectdetailedestimate/' . $id . '/' . $pid . '/' . $work_id]);

        }

        $departments    = $this->Departments->find('list', ['limit' => 200])->all();
        $financialYears = $this->FinancialYears->find('list')->order('id DESC')->all();
        $supervision_charges = $this->SupervisionCharges->find('list')->toArray();
        $fund_sources = $this->FundSources->find('list')->toArray();

        $this->set(compact(
            'departments',
            'financialYears',
			'oldProjectWorkDetail',
            'approved_projects',
            'approved_project_count',
            'supervision_charges',
            'fund_sources',
            'approved_sub_projects',
            'id',
            'pid',
            'work_id',
            'projectAdministrativeSanction',
            'totalunit','projectwork'
        ));
    }

    public function projectdetailedestimate($id = null, $pid = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $this->loadModel('ProjectWorkSubdetails');
        $this->loadModel('ProjectWorks');
        $this->loadModel('Users');
        $this->loadModel('OldProjectWorkDetails');

        $user = $this->request->getAttribute('identity');
        $role_id     = $user->role_id;
        $division_id = $user->division_id;
        //$pid = base64_decode($id);
		  				$projectwork        = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $pid])->first();
	    $oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->contain(['Districts', 'Divisions', 'Circles', 'FinancialYears', 'Departments'])->where(['OldProjectWorkDetails.id' => $id])->first();
  	    $work_type = $oldProjectWorkDetail['work_type'];
        $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();


        if ($this->request->is(['patch', 'post', 'put'])) {

            // echo '<pre>';  print_r($this->request->getData()); exit();

            $attachment  = $this->request->getData('detailed_estimate_upload');

            if ($attachment->getClientFilename() != '') {
                $name    = $attachment->getClientFilename();
                $type    = $attachment->getClientMediaType();
                $size    = $attachment->getSize();
                $tmpName = $attachment->getStream()->getMetadata('uri');
                $error   = $attachment->getError();

                $file                                     = $name;
                $array                                    = explode('.', $file);
                $fileExt                                  = $array[count($array) - 1];
                $current_time                             = date('Y_m_d_H_i_s');
                $newfile                                  = "detailed_estimate_" . $current_time . "." . $fileExt;
                $tempFile                                 = $tmpName;
                $targetPath                               = 'uploads/DetailedEstimates/';
                $targetFile                               = $targetPath . $newfile;
                move_uploaded_file($tempFile, $targetFile);
            } else {
                $newfile = $this->request->getData('detailed_estimate_upload1');
            }

            $subdetailTable                     = $this->getTableLocator()->get('ProjectWorkSubdetails');
            $project                            = $subdetailTable->get($projectWorkSubdetail['id']);
           if($projectWorkSubdetail['detailed_estimate_flag'] ==0){
            $project->project_work_status_id    = 4;
			}
			 $project->detailed_estimate_flag    = 1;
            $project->detailed_estimate_upload  = $newfile;
            $project->detailed_estimate_amount  = $this->request->getData('detailed_estimate_amount');
			

            $subdetailTable->save($project);
            $this->Flash->success(__('The Detailed Estimate uploaded Successfully.'));
			if($work_type == 1){
		      if($oldProjectWorkDetail['skip_fs_flag'] == 0){ 
				return $this->redirect(['action' => 'projectfinancialsanctions/' . $id . '/' . $pid . '/' . $work_id]);
			  }else{
				return $this->redirect(['action' => 'technicalsanction/' . $id . '/' . $pid . '/' . $work_id]);
			  }
            }else{
   		    return $this->redirect(['action' => 'technicalsanction/' . $id . '/' . $pid . '/' . $work_id]);
			}  
        }

        $this->set(compact(
            'projectwork',
            'projectwiseDetailedEstimate',
            'projectWorks',
            'materials',
            'units',
            'detailed_estimates',
            'administrativesanctioncount',
            'administrativesanction',
            'id',
            'work_id',
            'pid',
            'total_estimate',
            'projectWorkSubdetail','work_type','oldProjectWorkDetail'
        ));
    }

    public function projectfinancialsanctions($id = null, $pid = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $this->loadModel('ProjectFinancialSanctions');
        $this->loadModel('ProjectAdministrativeSanctions');
        $this->loadModel('ProjectWorkSubdetails');
		$this->loadModel('ProjectWorks');      

		
		$user = $this->request->getAttribute('identity');  
		$role_id = $user->role_id;
		$projectwork        = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $pid])->first();

		
	    $oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->contain(['Districts', 'Divisions', 'Circles', 'FinancialYears', 'Departments'])->where(['OldProjectWorkDetails.id' => $id])->first();
        $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();

	     $as_detail      = $this->ProjectAdministrativeSanctions->find('all')->contain(['SupervisionCharges'])->where(['ProjectAdministrativeSanctions.project_work_id' => $pid])->first();

        $user = $this->request->getAttribute('identity');
        //$id = base64_decode($id);
        $financialSanction       = $this->ProjectFinancialSanctions->find('all')->where(['ProjectFinancialSanctions.project_work_id' => $pid])->first();
		
        if ($financialSanction['id'] != '') {
            $projectFinancialSanction = $this->ProjectFinancialSanctions->get($financialSanction['id'], [
                'contain' => [],
            ]);
        } else {
            $projectFinancialSanction = $this->ProjectFinancialSanctions->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) { //echo "<pre>"; print_r($this->request->getData()); exit();
			       
  				   $projects = $this->request->getData('project');
				    if($projects != ''){
			         foreach($projects as $key => $subproject){
				            $ProjectsubWorksTable      = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$projectsub                = $ProjectsubWorksTable->get($work_id); 
							$projectsub->fs_amount               = $subproject['fs_amount'];
							$projectsub->supervision_charge      = $subproject['supervision_charge'];
							$projectsub->fs_excluding_sc         = $subproject['fs_excluding_sc'];	
							$ProjectsubWorksTable->save($projectsub);							
					   }
					}

            // print_r($projectFinancialSanction);
            $projectFinancialSanction->project_work_id         =  $pid;
            $projectFinancialSanction->go_date                 =  date('Y-m-d', strtotime($this->request->getData('go_date')));
            $projectFinancialSanction->go_no                   =  $this->request->getData('go_no');
            $projectFinancialSanction->sanctioned_amount       =  $this->request->getData('sanctioned_amount');
            $projectFinancialSanction->created_by              =  $user->id;
            $projectFinancialSanction->created_date            =  date('Y-m-d:h:m:s');

            $attachment               =   $this->request->getData('sanctioned_file_upload');

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
                    $newfile                                   =  "financial_sanction_" . $current_time . "." . $fileExt;
                    $tempFile                                  =  $tmpName;
                    $targetPath                                =  'uploads/financialsanction/';
                    $targetFile                                =    $targetPath . $newfile;
                    $projectFinancialSanction->sanctioned_file_upload                  =   $newfile;

                    move_uploaded_file($tempFile, $targetFile);
                }
            } else {
                $projectFinancialSanction->sanctioned_file_upload = $this->request->getData('sanctioned_file_upload1');
            }
            // echo"<pre>";print_r($projectFinancialSanction);exit();
            if($this->ProjectFinancialSanctions->save($projectFinancialSanction)){
			if ($financialSanction['id'] == '') {
			$subdetailTable                     = $this->getTableLocator()->get('ProjectWorkSubdetails');
            $project                            = $subdetailTable->get($work_id);
            $project->project_work_status_id    = 5;
			$subdetailTable->save($project);
			}
			$this->Flash->success(__('The Financial Sanction detail has been saved.'));

            return $this->redirect(['action' => 'technicalsanction/' . $id . '/' . $pid . '/' . $work_id]);
			}

            
        }
        $this->set(compact(
            'projectFinancialSanction',
            'projectwork',
            'financialSanctions',
            'financialSanctionscount',
            'administrativesanction',
            'projectWorkSubdetails',
            'administrativesanctioncount',
            'id',
            'work_id',
            'pid','oldProjectWorkDetail','projectWorkSubdetail','as_detail','role_id'
        ));
    }
	
	/*public function technicalsanction($id = null,  $pid = null, $work_id = null)
    {

    $this->viewBuilder()->setLayout('layout');
    $this->loadModel('TechnicalSanctions');
    $this->loadModel('ProjectAdministrativeSanctions');
    $this->loadModel('ProjectFinancialSanctions');
    $this->loadModel('ProjectWorkSubdetails');

    $user = $this->request->getAttribute('identity');
	
    $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();

	
	 $oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->contain(['Districts', 'Divisions', 'Circles', 'FinancialYears', 'Departments'])->where(['OldProjectWorkDetails.id' => $id])->first();
  	 $work_type = $oldProjectWorkDetail['work_type'];

    $technical       = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();
    // echo "<pre>" ; print_r($technical); exit();

    if ($technical['id'] != '') {
        $technicalSanction = $this->TechnicalSanctions->get($technical['id'], [
            'contain' => [],
        ]);
    } else {
        $technicalSanction = $this->TechnicalSanctions->newEmptyEntity();
    }

    if ($this->request->is((['patch', 'post', 'put']))) {

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

        $technicalSanction->project_work_id           = $pid;
        $technicalSanction->project_work_subdetail_id = $work_id;
        $technicalSanction->sanction_no               = $this->request->getData('sanction_no');
        $technicalSanction->sanctioned_date            = date('Y-m-d', strtotime($this->request->getData('sanctioned_date')));
        $technicalSanction->description               = $this->request->getData('description');
        $technicalSanction->amount                    = $this->request->getData('amount');
        $technicalSanction->created_by                = $user->id;
        $technicalSanction->created_date              = date('Y-m-d H:i:s');
        //echo "<pre>" ; print_r($technicalSanction); exit();
        // $this->TechnicalSanctions->save($technicalSanction);

        if ($this->TechnicalSanctions->save($technicalSanction)) {
             if ($technical['id'] == '') {
            $subdetailTable               = $this->getTableLocator()->get('ProjectWorkSubdetails');
            $project                      = $subdetailTable->get($work_id);
            $project->technical_sanction_flag  = 1;
			
            $project->project_work_status_id  = 7;
            $subdetailTable->save($project);
			 }


            $this->Flash->success(__('The technical sanction has been saved.'));
            return $this->redirect(['action' => 'tenderdetails/'.$id.'/'.$pid.'/'.$work_id]);
        }
    }
    $this->set(compact(
        'technicalsanction',
        'projectWork',
        'technical',
        'technicalcount',
        'administrativesanctioncount',
        'administrativesanction',
        'financialSanctionscount',
        'financialSanctions',
        'projectWorkSubdetail',
        'id',
        'work_id',
        'pid','work_type'
    ));
}*/


  public function technicalsanction($id = null,  $pid = null, $work_id = null)  
  {
	  $this->viewBuilder()->setLayout('layout');
    $this->loadModel('ProjectwiseAbstractDetails');
    $this->loadModel('ProjectwiseAbstractSubdetails');
    $this->loadModel('DetailedEstimateApprovalStages');
    $this->loadModel('Users');
    $this->loadModel('BuildingItems');
    $this->loadModel('ProjectWorkSubdetails');
    $this->loadModel('Units');
    $this->loadModel('ProjectWorks');
    $this->loadModel('TechnicalSanctions');
   // $this->loadModel('Notifications');
    $this->loadModel('OldProjectWorkDetails');
    $user = $this->request->getAttribute('identity');
	$role_id     = $user->role_id;
    $division_id = $user->division_id;
	
	
	 $oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->contain(['Districts', 'Divisions', 'Circles', 'FinancialYears', 'Departments'])->where(['OldProjectWorkDetails.id' => $id])->first();
  	 $work_type = $oldProjectWorkDetail['work_type'];
  	 $projectwork        = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $pid])->first();


	 $projectWorkSubdetail  = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id'=>$work_id])->first();
	 $abstractcount   = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$pid,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
	 //print_r($abstractcount); exit();
	 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$pid,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
	 if($abstractcount != 0){
	 
	   $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['BuildingItems','Units'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
	   $subabstractcount = $this->ProjectwiseAbstractSubdetails->find('all')->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->count();
	  }
	  
	 $detailed_approval_stages_count  = $this->DetailedEstimateApprovalStages->find('all')->where(['DetailedEstimateApprovalStages.project_work_id' => $pid,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->count();
     $detailed_approval_stages        = $this->DetailedEstimateApprovalStages->find('all')->contain(['ApprovalStatuses'])->where(['DetailedEstimateApprovalStages.project_work_id' => $pid,'DetailedEstimateApprovalStages.project_work_subdetail_id'=>$work_id])->toArray();
	
	
	    $connection               = ConnectionManager::get('default');
        $query                    =  "SELECT sum(projectsub.amount) as total_amount
                                     from projectwise_abstract_subdetails as projectsub
                                     LEFT JOIN projectwise_abstract_details as project on project.id = projectsub.projectwise_abstract_detail_id
                                     where project.project_work_id = '".$pid."' AND project.project_work_subdetail_id = '".$work_id."' and projectsub.is_active = 1";
									 
       $Totalamount             = $connection->execute($query)->fetchAll('assoc');
	   
	  // print_r($Totalamount); exit();
	   
	   $tot_amount =  $Totalamount[0]['total_amount'];
	   $technical       = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();

	  
    if ($this->request->is(['patch', 'post', 'put'])) {
		// echo "<pre>";  print_r($this->request->getData()); exit();
		$completed_flag = $this->request->getData('completed_flag');
		
		if($completed_flag == 1){	
		  
			if ($technical['id'] != '') {
				$technicalSanction = $this->TechnicalSanctions->get($technical['id'], [
					'contain' => [],
				]);
			} else {
				$technicalSanction = $this->TechnicalSanctions->newEmptyEntity();
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
			 }else {
               $technicalSanction->detailed_estimate_upload               = $this->request->getData('detailed_estimate_upload1');
            }

             $technicalSanction->project_work_id           = $pid;
             $technicalSanction->project_work_subdetail_id = $work_id;
		     $technicalSanction->sanction_no               = $this->request->getData('sanction_no');
             $technicalSanction->sanctioned_date            = date('Y-m-d', strtotime($this->request->getData('sanctioned_date')));
             $technicalSanction->description               = $this->request->getData('description');
             $technicalSanction->amount                    = $this->request->getData('amount');
			 $technicalSanction->gst                       = ($this->request->getData('gst'))?$this->request->getData('gst'):0;  
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
					
					
              $this->Flash->success(__('The technical sanction has been saved.'));
              return $this->redirect(['action' => 'tenderdetails/'.$id.'/'.$pid.'/'.$work_id]);		
			}
			
		}else{
		
        if($abstractcount == 0){
        $abstractdetail = $this->ProjectwiseAbstractDetails->newEmptyEntity();
		}else{
		$abstractdetail = $this->ProjectwiseAbstractDetails->get($abstract_detail['id'], [
						'contain' => [],
					]);
		}			
        $abstractdetail->project_work_id           = $pid;
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
				// if($this->request->getData('type') == 0){
                // $abstractsubdetail->item_description    = $answer['item_description'];
				// }else{
                // $abstractsubdetail->item_description    = $answer['item_description1'];
				// }
				$abstractsubdetail->item_description    = ($answer['item_description'] != '')?$answer['item_description']:$answer['item_description1'];

                $abstractsubdetail->quantity            = $answer['quantity'];
                $abstractsubdetail->unit_id             = $answer['unit_id'];
                $abstractsubdetail->rate                = $answer['rate'];
                $abstractsubdetail->amount              = ($answer['amount'] != 0)?$answer['amount']:'';
                $abstractsubdetail->created_by          = $user->id;
                $abstractsubdetail->created_date        = date('Y-m-d H:i:s');				
				//echo "<pre>"; print_r($abstractsubdetail); exit();
				if($abstractsubdetail->item_description != ''){
                $this->ProjectwiseAbstractSubdetails->save($abstractsubdetail);      
				}
            }

               $this->Flash->success(__('The project Abstract detail has been saved.'));
            return $this->redirect(['action' => 'technicalsanction/' . $id . '/' . $pid . '/' . $work_id]);

        }
        $this->Flash->error(__('The project Abstract detail could not be saved. Please, try again.'));
		
		}
		 }
	
     //print_r($entered_id); exit();
	 if($abstractcount == 0 || $subabstractcount == 0){
      $buildingItems     = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->order(['BuildingItems.item_code ASC'])->toArray();
     }else if($abstractcount != 0 && $subabstractcount > 0){
	  $entered_id     = $this->ProjectwiseAbstractSubdetails->find('list',['keyField' => 'building_item_id','valueField' =>'building_item_id'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1,'ProjectwiseAbstractSubdetails.building_item_id !='=>0])->toArray();
      if(count($entered_id) != 0){
	  $buildingItems  = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->where(['BuildingItems.id NOT IN'=>$entered_id])->order(['BuildingItems.item_code ASC'])->toArray();
	  }else{
		  $buildingItems     = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->order(['BuildingItems.item_code ASC'])->toArray();

		  
	     }  
	  }
	  
	 //echo "<pre>"; print_r($buildingItems); exit();
	  $units = $this->Units->find('list', ['limit' => 200])->all();

	$this->set(compact('oldProjectWorkDetail','projectwork','technical','work_type','subabstractcount','tot_amount','units','projectDevelopmentWorkDetail', 'projectWorks','buildingItems','projectWorkSubdetails', 'developmentWorks','id','pid','work_id','abstract_subdetails','detailed_approval_stages_count','detailed_approval_stages','abstractcount','projectWorkSubdetail'));
    
	  
  }

	public function tenderdetails($id = null,  $pid = null, $work_id = null)
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
    $oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->where(['OldProjectWorkDetails.id' => $id])->first();

  	$work_type = $oldProjectWorkDetail['work_type'];
	$projectwork  = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $pid])->first();		
    $technical    = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();
	$total_amount = $technical['amount']+$technical['gst'];
    $tenders = $this->ProjectTenderDetails->find('all')->where(['ProjectTenderDetails.project_work_id' => $pid, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id])->first();

    if ($tenders['id'] != '') {
        $projectTenderDetail = $this->ProjectTenderDetails->get($tenders['id'], [
            'contain' => [],
        ]);
    } else {
        $projectTenderDetail = $this->ProjectTenderDetails->newEmptyEntity();
    }

    if ($this->request->is(['patch', 'post', 'put'])) {
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
        }else{
            $projectTenderDetail->tender_copy       =  $this->request->getData('tender_copy1');

        }

        $projectTenderDetail->project_work_id            = $pid;
        $projectTenderDetail->project_work_subdetail_id  = $work_id;
        $projectTenderDetail->tender_type_id              = $this->request->getData('tender_type_id');

        if ($this->request->getData('tender_type_id') == 1) {
            $projectTenderDetail->etenderID  = $this->request->getData('etenderID');
        } else if ($this->request->getData('tender_type_id') == 2) {
            $projectTenderDetail->tender_no =   $this->request->getData('tender_no');
        }
        $projectTenderDetail->tender_date                = date('Y-m-d', strtotime($this->request->getData('tender_date')));
        $projectTenderDetail->tender_amount              = $this->request->getData('tender_amount');
        $projectTenderDetail->created_by                 = $user->id;
        $projectTenderDetail->created_date               = date('Y-m-d H:i:s');
        if ($tenders['id'] != '') {
            $projectTenderDetail->modified_by                 =  $user->id;
            $projectTenderDetail->modified_date	               =  date('Y-m-d H:i:s');

        }
        if ($this->ProjectTenderDetails->save($projectTenderDetail)) {
			if ($tenders['id'] == '') {
			$subdetailTable                     = $this->getTableLocator()->get('ProjectWorkSubdetails');
            $project                            = $subdetailTable->get($work_id);
            $project->project_work_status_id    = 9;
            $project->tender_detail_flag        = 1;
			$subdetailTable->save($project);
			}
            $this->Flash->success(__('The Tender Details has been saved.'));
            return $this->redirect(['action' => 'contractors/' . $id . '/' . $pid . '/' . $work_id]);
        }
    }

    $tender_type = $this->ProjectTenderDetails->TenderTypes->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['TenderTypes.is_active' => 1])->toArray();
    $this->set(compact(
        'projectTenderDetail',
        'tender_type',
        'projectwork',
        'tenders',
        'id',
        'administrativesanctioncount',
        'administrativesanction',
        'projectWorkSubdetail',
        'financialSanctionscount',
        'financialSanctions',
        'work_id',
        'contractor_detail_count',
        'contractor_details',
        'technicalcount',
        'technical',
        'pid',
        'work_id','work_type','oldProjectWorkDetail','total_amount'
    ));
   }   
   
	public function contractors($id = null, $pid = null, $work_id = null)
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
					$projectwork        = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $pid])->first();

		$oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->where(['OldProjectWorkDetails.id' => $id])->first();
  	    $work_type = $oldProjectWorkDetail['work_type'];



        $tender = $this->ProjectTenderDetails->find('all')->where(['ProjectTenderDetails.project_work_id' => $pid, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id])->first();
        // echo "<pre>"; print_r($tender); exit();
        $tender_amount = $tender['tender_amount'];
        $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $pid])->first();

        $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->count();
        $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();

        $contractor_details          = $this->ContractorDetails->find('all')->contain(['Contractors'])->where(['ContractorDetails.project_work_id' => $pid, 'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->first(); //tender key

     $abstractcount = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$pid,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
	 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$pid,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
	 if($abstractcount > 0){
	 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['BuildingItems','Units'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
	  } 


        if ($contractor_details['id'] != '') {
            $contractorDetail = $this->ContractorDetails->get($contractor_details['id'], [
                'contain' => [],
            ]);
        } else {
            $contractorDetail = $this->ContractorDetails->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            // echo"<pre>";print_r($this->request->getData());exit();

            $contractorDetail->project_work_id               = $pid;
            $contractorDetail->project_work_subdetail_id     = $work_id;
            $contractorDetail->project_tender_detail_id      = $tender['id'];
            $contractorDetail->contractor_id                 = $this->request->getData('contractor_id');
            $contractorDetail->agreement_no                  = $this->request->getData('agreement_no');
            $contractorDetail->agreement_amount              = $this->request->getData('agreement_amount');
            $contractorDetail->work_order_refno              = $this->request->getData('work_order_refno');
            $contractorDetail->agreement_date            =  date('Y-m-d', strtotime($this->request->getData('agreement_date')));
            // $contractorDetail->agreement_todate              =  date('Y-m-d', strtotime($this->request->getData('agreement_todate')));
            $contractorDetail->agreement_period              =  $this->request->getData('agreement_period');
            $contractorDetail->agreement_date                =  date('Y-m-d', strtotime($this->request->getData('agreement_date')));
            $contractorDetail->perc_deduction                = $this->request->getData('perc_deduction');
            $contractorDetail->created_by                    =  $user->id;
            $contractorDetail->created_date                  =  date('Y-m-d H:i:s');
            if($contractor_details['id'] != ''){
                $contractorDetail->modified_by                    =  $user->id;
                $contractorDetail->modified_date                  =  date('Y-m-d H:i:s');
            }


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
                /* if ($contractor_details['id'] != '') {
				    $insert_id = $contractor_details['id'];
				 }else{
			  	  	$insert_id = $contractorDetail->id;
		      	 }
				 	  
				foreach ($this->request->getData('workdetail') as $key => $answer) {
					$abstract = $this->ProjectwiseAbstractSubdetails->find('all')->where(['ProjectwiseAbstractSubdetails.id'=>$answer['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->first();

					$contractor_rate = $this->ProjectwiseContractorRateDetails->newEmptyEntity();
					$contractor_rate->project_work_id              = $pid;
					$contractor_rate->project_work_subdetail_id    = $work_id;
					$contractor_rate->project_tender_detail_id     = $tender['id'];
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
				if($work_type == 1){
                return $this->redirect(['action' => 'planningclearance/' . $id . '/' . $pid . '/' . $work_id]);
				}else{
                return $this->redirect(['action' => 'sitehandover/' . $id . '/' . $pid . '/' . $work_id]);
				}
            }
            $this->Flash->error(__('The Contractor Details could not be saved. Please, try again.'));
        }
        $contractor_type = $this->ContractorDetails->Contractors->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Contractors.is_active' => 1])->toArray();

        $this->set(compact(
            'abstractcount',
            'abstract_subdetails',
            'contractor_type',
            'projectTenderDetail',
            'contractor_details',
            'contractor_detail_count',
            'projectwork',
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
            'pid',
            'tender_amount','work_type','oldProjectWorkDetail'
        ));
    }
	
	public function contractorratedetails($id = null, $pid = null, $work_id = null)
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
		$oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->where(['OldProjectWorkDetails.id' => $id])->first();
  	    $work_type = $oldProjectWorkDetail['work_type'];
				$project        = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $pid])->first();




        $tender = $this->ProjectTenderDetails->find('all')->where(['ProjectTenderDetails.project_work_id' => $pid, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id])->first();
        // echo "<pre>"; print_r($tender); exit();
        $tender_amount = $tender['tender_amount'];
        $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $pid])->first();

        $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->count();
        $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();

        $contractor_details          = $this->ContractorDetails->find('all')->contain(['Contractors'])->where(['ContractorDetails.project_work_id' => $pid, 'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->first(); //tender key
        $contractor_detailcount      = $this->ContractorDetails->find('all')->contain(['Contractors'])->where(['ContractorDetails.project_work_id' => $pid, 'ContractorDetails.project_work_subdetail_id' => $work_id,'ContractorDetails.is_active'=>1])->count(); 

     $abstractcount = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$pid,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->count();
	 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$pid,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id])->first();
	 if($abstractcount > 0){
	 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['BuildingItems','Units'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
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
					$contractor_rate->project_tender_detail_id     = $tender['id'];
					$contractor_rate->contractor_detail_id         = $contractor_details['id'];
					$contractor_rate->projectwise_abstract_subdetail_id         = $answer['id'];
					$contractor_rate->building_item_id             = ($abstract['building_item_id'])?$abstract['building_item_id']:0;
					$contractor_rate->item_code                    = ($abstract['item_code'])?$abstract['item_code']:0;				
					$contractor_rate->item_description             = $abstract['item_description'];
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
				   return $this->redirect(['action' => 'contractorratedetails/' . $id . '/' . $pid . '/' . $work_id]);
				  
				}else{
					 $this->Flash->success(__('The Contractor Rate has been saved.'));
						if($work_type == 1){
						return $this->redirect(['action' => 'index']);
						}else{
						return $this->redirect(['action' => 'specialrepairlist']);
						}					
					
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
            'pid',
            'tender_amount','work_type','contractor_detailcount','contractoratedetails','contractorcount','project'
        ));
    }
	
	public function contractorfinalsubmit()
    {
		if ($this->request->is(['patch', 'post', 'put'])) { //echo"<pre>"; print_r($this->request->getData());  exit(); 			
			
			$oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->where(['OldProjectWorkDetails.id' => $this->request->getData('id')])->first();
  	        $work_type = $oldProjectWorkDetail['work_type'];
		
		   if($this->request->getData('type1') == 2){
			   $subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
				$project                        = $subdetailTable->get($this->request->getData('work_id'));
				$project->contractor_final_submit      = 1;
				$subdetailTable->save($project);
				$this->Flash->success(__('The Contractor Rate has been saved.'));
				if($work_type == 1){
				return $this->redirect(['action' => 'index']);
				}else{
				return $this->redirect(['action' => 'specialrepairlist']);
				}		
			}		
		}		
	}  
	/*public function planningclearance($id = null,  $pid = null, $work_id = null)
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
	$oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->where(['OldProjectWorkDetails.id' => $id])->first();
  	    $work_type = $oldProjectWorkDetail['work_type'];

	
	
    $Planningcount = $this->PlanningPermissionDetails->find('all')->contain(['ProjectWorks'])->where(['PlanningPermissionDetails.project_work_id' => $pid, 'PlanningPermissionDetails.project_work_subdetail_id' => $work_id])->count();
    $planingdetail = $this->PlanningPermissionDetails->find('all')->contain(['ProjectWorks'])->where(['PlanningPermissionDetails.project_work_id' => $pid, 'PlanningPermissionDetails.project_work_subdetail_id' => $work_id])->first();
    $totalunits    = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $pid, 'ProjectWorkSubdetails.id' => $work_id])->first();
    $totalunit     = $totalunits['total_units'];

    $projectwiseFloorDetail = $this->ProjectwiseFloorDetails->find('all')->where(['ProjectwiseFloorDetails.project_work_id' => $pid, 'ProjectwiseFloorDetails.project_work_subdetail_id' => $work_id])->first();
    $projectfloorid = $projectwiseFloorDetail['id'];
     //echo"<pre>";print_r($totalunit);exit();
    if($projectfloorid !=''){
        $projectwisefloorSubdetailcount = $this->ProjectwiseFloorSubdetails->find('all')->where(['ProjectwiseFloorSubdetails.projectwise_floor_detail_id' => $projectfloorid])->count();
        $projectwisefloorSubdetail = $this->ProjectwiseFloorSubdetails->find('all')->where(['ProjectwiseFloorSubdetails.projectwise_floor_detail_id' => $projectfloorid])->toArray();
    }

    $projectwisefloorDetailscount = $this->ProjectwiseFloorDetails->find('all')->where(['ProjectwiseFloorDetails.project_work_id' => $pid,'ProjectwiseFloorDetails.project_work_subdetail_id'=>$work_id])->count();
    $projectwisefloorDetail       = $this->ProjectwiseFloorDetails->find('all')->where(['ProjectwiseFloorDetails.project_work_id' => $pid,'ProjectwiseFloorDetails.project_work_subdetail_id'=>$work_id])->first();


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
                 $projectwiseFloorDetail->project_work_id                 = $pid;
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
        $planningPermissionDetail->project_work_id                     = $pid;
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
				if ($Planningcount == 0) {
                $subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
                $project                        = $subdetailTable->get($work_id);
                $project->planning_permission_flag     = 1;
                $project->project_work_status_id       = 10;
                $subdetailTable->save($project);
				}
            }

                return $this->redirect(['action' => 'sitehandover/' . $id . '/' . $pid . '/' . $work_id]);
        $this->Flash->error(__('The planning permission detail could not be saved. Please, try again.'));
        }
    }

    $this->set(compact('planningPermissionDetail', 'Planningcount',
                       'planingdetail', 'apporved', 'id', 'work_id','pid',
                       'totalunit','projectwisefloorSubdetailcount',
                       'projectwisefloorSubdetail','projectwisefloorDetailscount','work_type',
                       'projectwisefloorDetail'));
   }*/
public function planningclearance($id = null,  $pid = null, $work_id = null)
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
	
						$projectwork        = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $pid])->first();

	
   $projectWorkSubdetail  = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id'=>$work_id])->first();
	
    $Planningcount = $this->PlanningPermissionDetails->find('all')->contain(['ProjectWorks'])->where(['PlanningPermissionDetails.project_work_id' => $pid, 'PlanningPermissionDetails.project_work_subdetail_id' => $work_id])->count();
    $planingdetail = $this->PlanningPermissionDetails->find('all')->contain(['ProjectWorks'])->where(['PlanningPermissionDetails.project_work_id' => $pid, 'PlanningPermissionDetails.project_work_subdetail_id' => $work_id])->first();
    $totalunits    = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $pid, 'ProjectWorkSubdetails.id' => $work_id])->first();
    $totalunit     = $totalunits['total_units'];
	
	$oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->contain(['Districts', 'Divisions', 'Circles', 'FinancialYears', 'Departments'])->where(['OldProjectWorkDetails.id' => $id])->first();
  	 $work_type = $oldProjectWorkDetail['work_type'];


    $projectwiseFloorDetail = $this->ProjectwiseFloorDetails->find('all')->where(['ProjectwiseFloorDetails.project_work_id' => $pid, 'ProjectwiseFloorDetails.project_work_subdetail_id' => $work_id])->first();
    $projectfloorid = $projectwiseFloorDetail['id'];
     //echo"<pre>";print_r($totalunit);exit();
    if($projectfloorid !=''){
        $projectwisefloorSubdetailcount = $this->ProjectwiseFloorSubdetails->find('all')->where(['ProjectwiseFloorSubdetails.projectwise_floor_detail_id' => $projectfloorid])->count();
        $projectwisefloorSubdetail = $this->ProjectwiseFloorSubdetails->find('all')->where(['ProjectwiseFloorSubdetails.projectwise_floor_detail_id' => $projectfloorid])->toArray();
    }

    $projectwisefloorDetailscount = $this->ProjectwiseFloorDetails->find('all')->where(['ProjectwiseFloorDetails.project_work_id' => $pid,'ProjectwiseFloorDetails.project_work_subdetail_id'=>$work_id])->count();
    $projectwisefloorDetail       = $this->ProjectwiseFloorDetails->find('all')->where(['ProjectwiseFloorDetails.project_work_id' => $pid,'ProjectwiseFloorDetails.project_work_subdetail_id'=>$work_id])->first();


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
                 $projectwiseFloorDetail->project_work_id                 = $pid;
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
			 return $this->redirect(['action' => 'sitehandover/' . $id . '/' . $pid . '/' . $work_id]);

		
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
        $planningPermissionDetail->project_work_id                     = $pid;
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
				if ($Planningcount == 0) {
                $subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
                $project                        = $subdetailTable->get($work_id);
                $project->planning_permission_flag     = 1;
                $project->project_work_status_id       = 10;
                $subdetailTable->save($project);
				}
            }

                return $this->redirect(['action' => 'sitehandover/' . $id . '/' . $pid . '/' . $work_id]);
             //$this->Flash->error(__('The planning permission detail could not be saved. Please, try again.'));
          }
		}
    }

    $this->set(compact('planningPermissionDetail', 'Planningcount',
                       'planingdetail', 'apporved', 'id', 'work_id','pid','projectwork',
                       'totalunit','projectwisefloorSubdetailcount',
                       'projectwisefloorSubdetail','projectwisefloorDetailscount','work_type','oldProjectWorkDetail',
                       'projectwisefloorDetail','projectWorkSubdetail'));
   }   

    public function sitehandover($id = null,  $pid = null, $work_id = null)
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
		  	 $projectwork        = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $pid])->first();

		
		$oldProjectWorkDetail = $this->OldProjectWorkDetails->find('all')->where(['OldProjectWorkDetails.id' => $id])->first();
  	    $work_type            = $oldProjectWorkDetail['work_type'];		
	    $projectWorkSubdetail = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles', 'Districts', 'ProjectWorkStatuses'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();

        if ($this->request->is(['patch', 'post', 'put'])){
			
			if($work_type == 1){
			    $attachment  = $this->request->getData('architect_drawing_upload');
				//echo '<pre>';  print_r($attachment); exit();
				 if ($attachment != '') {  
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
						 //$technicalSanction->detailed_estimate_upload        = $newfile;
						 move_uploaded_file($tempFile, $targetFile);
					 }
				 }else{
                    $newfile = $this->request->getData('architect_drawing_upload1'); 
				 }					 
		   
				$subdetailTable                     = $this->getTableLocator()->get('ProjectWorkSubdetails');
				$project                            = $subdetailTable->get($projectWorkSubdetail['id']); 
				$project->architect_drawing_flag    = 1;  
				$project->architect_drawing_upload  = $newfile;  
				$subdetailTable->save($project);
				}
			}

            if ($this->request->getData('site_handover_date') != '') {
                $subdetailTable                  = $this->getTableLocator()->get('ProjectWorkSubdetails');
                $project                         = $subdetailTable->get($work_id);
                $project->site_handover_flag     = 1;
                $project->site_handover_date     = date('Y-m-d', strtotime($this->request->getData('site_handover_date')));
                $project->tentative_completion_date     = date('Y-m-d', strtotime($this->request->getData('tentative_completion_date')));
                $project->site_handover_remarks  = $this->request->getData('site_handover_remarks');
				if($projectWorkSubdetail['site_handover_flag'] == 0){  
                $project->project_work_status_id       = 11;
				}
                $subdetailTable->save($project);

                $this->Flash->success(__('The project Site H/O Details has been saved.'));
				if($work_type == 1){
                return $this->redirect(['action' => 'index']);
				}else{
                return $this->redirect(['action' => 'specialrepairlist']);
				}
            }
        }

        $this->set(compact(
            'projectTenderDetail',
            'projectwork',
            'tenders',
            'id',
            'pid',
            'administrativesanctioncount',
            'administrativesanction',
            'projectWorkSubdetail',
            'financialSanctionscount',
            'financialSanctions',
            'work_id',
            'contractor_detail_count',
            'contractor_details',
            'technicalcount',
            'technical','work_type','oldProjectWorkDetail'
        ));
    }	
	
	public function complitedlist()
    {
        $this->viewBuilder()->setLayout('layout');

        $connection = ConnectionManager::get('default');

        if ($this->request->is('post')) {
            $fin_year_cond      = ($this->request->getData('financial_year_id') != '') ? " AND old.financial_year_id = " . $this->request->getData('financial_year_id') . "" : "";
            $go_cond            = ($this->request->getData('go_no') != '') ? " AND old.go_no like '%".$this->request->getData('go_no')."%'" : "";
            $div_cond           = ($this->request->getData('division_id') != '') ? " AND old.division_id = '".$this->request->getData('division_id')."'" :"";

            $query = "SELECT  old.project_name as projectname,old.id as id,
                    old.go_no as go_no,
                    dis.name as dname,
                    divi.name as diname,
                    c.name as cname,
					old.place_name as place_name,
					fy.name as fy_name,
					d.name as deptname,
                    old.work_type as work_type
                    FROM `old_project_work_details` as old
                    LEFT JOIN districts as dis on dis.id = old.district_id
                    LEFT JOIN divisions divi on divi.id = old.division_id
                    LEFT JOIN circles c on c.id = old.circle_id
                    LEFT JOIN financial_years fy on fy.id = old.financial_year_id
                    LEFT JOIN departments d on d.id = old.department_id
					where old.is_active= 1 and old.work_completed = 1 $fin_year_cond
                    $go_cond $div_cond and old.work_type = 1 order by fy.id DESC";
                    // echo"<pre>";print_r($query);exit();

        } else {

            $query = "SELECT  old.project_name as projectname,old.id as id,
                    old.go_no as go_no,
                    dis.name as dname,
                    divi.name as diname,
                    c.name as cname,
					old.place_name as place_name,
					fy.name as fy_name,
					d.name as deptname
                    FROM `old_project_work_details` as old
                    LEFT JOIN districts as dis on dis.id = old.district_id
                    LEFT JOIN divisions divi on divi.id = old.division_id
                    LEFT JOIN circles c on c.id = old.circle_id
                    LEFT JOIN financial_years fy on fy.id = old.financial_year_id
					LEFT JOIN departments d on d.id = old.department_id
					where old.is_active=1 and old.work_completed = 1 and old.work_type = 1 order by fy.id DESC";

        }


        $oldProjectWorkDetails      = $connection->execute($query)->fetchAll('assoc');
        //   echo"<pre>";
        //  print_r($oldProjectWorkDetails);
        // exit();

        $this->loadModel('Departments');
        $this->loadModel('FinancialYears');
        $this->loadModel('Divisions');

        $departments    = $this->Departments->find('list')->all();
        $financialYears = $this->FinancialYears->find('list')->order('id Desc')->all();
        $divisions      = $this->Divisions->find('list')->all();

        $this->set(compact('oldProjectWorkDetails', 'departments', 'financialYears', 'divisions'));
    }

   public function repairworklist()
   {
        $this->viewBuilder()->setLayout('layout');

        $connection = ConnectionManager::get('default');

        if ($this->request->is('post')) {

            // echo"<pre>";print_r($_POST);exit();

            $fin_year_cond      = ($this->request->getData('financial_year_id') != '') ? " AND old.financial_year_id = " . $this->request->getData('financial_year_id') . "" : "";
            $go_cond            = ($this->request->getData('ref_no') != '') ? " AND old.ref_no like '%" . $this->request->getData('ref_no') . "%'" : "";
            $div_cond           = ($this->request->getData('division_id') != '') ? " AND old.division_id = '" . $this->request->getData('division_id') . "'" : "";



            $query = "SELECT  old.project_name as projectname,old.id as id,
                    old.go_no as go_no,
                    dis.name as dname,
                    divi.name as diname,
                    c.name as cname,
					old.place_name as place_name,
					fy.name as fy_name,
					d.name as deptname,
                    old.ref_no as ref_no,
                    old.work_type as work_type
                    FROM `old_project_work_details` as old
                    LEFT JOIN districts as dis on dis.id = old.district_id
                    LEFT JOIN divisions divi on divi.id = old.division_id
                    LEFT JOIN circles c on c.id = old.circle_id
                    LEFT JOIN financial_years fy on fy.id = old.financial_year_id
                    LEFT JOIN departments d on d.id = old.department_id
					where old.is_active= 1 and old.work_completed = 1 $fin_year_cond
                    $go_cond $div_cond and old.work_type = 2 order by fy.id ASC";
                    // echo"<pre>";print_r($query);exit();

        } else {

            $query = "SELECT  old.project_name as projectname,old.id as id,
                    old.go_no as go_no,
                    dis.name as dname,
                    old.ref_no as ref_no,
                    divi.name as diname,
                    c.name as cname,
					old.place_name as place_name,
					fy.name as fy_name,
					d.name as deptname
                    FROM `old_project_work_details` as old
                    LEFT JOIN districts as dis on dis.id = old.district_id
                    LEFT JOIN divisions divi on divi.id = old.division_id
                    LEFT JOIN circles c on c.id = old.circle_id
                    LEFT JOIN financial_years fy on fy.id = old.financial_year_id
					LEFT JOIN departments d on d.id = old.department_id
					where old.is_active=1 and old.work_completed = 1 and old.work_type = 2 order by fy.id DESC";

        }


        $oldProjectWorkDetails      = $connection->execute($query)->fetchAll('assoc');
        //   echo"<pre>";
        //  print_r($oldProjectWorkDetails);
        // exit();

        $this->loadModel('Departments');
        $this->loadModel('FinancialYears');
        $this->loadModel('Divisions');

        $departments    = $this->Departments->find('list')->all();
        $financialYears = $this->FinancialYears->find('list')->order('id Desc')->all();
        $divisions      = $this->Divisions->find('list')->all();

        $this->set(compact('oldProjectWorkDetails', 'departments', 'financialYears', 'divisions'));
    }
	
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');

        $oldProjectWorkDetail = $this->OldProjectWorkDetails->get($id, [
            'contain' => ['Districts', 'Divisions', 'Circles', 'FinancialYears', 'Departments'],
        ]);

        // echo"<pre>";print_r($oldProjectWorkDetail);exit();
        $this->set(compact('oldProjectWorkDetail'));
    }
		
	public function projectabstractdelete($id = null,$pid=null,$work_id=null,$abstract_id = null)
    {				 
	   $this->loadModel('ProjectwiseAbstractSubdetails');

		
		$abstractTable          = $this->getTableLocator()->get('ProjectwiseAbstractSubdetails');
		$abstract                = $abstractTable->get($abstract_id); 
		$abstract->is_active  = 0;
        if ($abstractTable->save($abstract)) {
            return $this->redirect(['action' => 'technicalsanction/' . $id . '/' . $pid . '/' . $work_id]);
        } else {
            return $this->redirect(['action' => 'technicalsanction/' . $id . '/' . $pid . '/' . $work_id]);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }
	
	public function projectabstractedit($id = null,$pid=null,$work_id = null,$abstract_id = null)
    {  
    $this->viewBuilder()->setLayout('layout');
    $this->loadModel('ProjectwiseAbstractDetails');
    $this->loadModel('ProjectwiseAbstractSubdetails');
    $this->loadModel('BuildingItems');
    $this->loadModel('Units');
    $user = $this->request->getAttribute('identity');	
	$role_id     = $user->role_id;
		$division_id = $user->division_id;


	 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['BuildingItems'])->where(['ProjectwiseAbstractSubdetails.id'=>$abstract_id,'ProjectwiseAbstractSubdetails.is_active'=>1])->toArray();
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
				$abstractsubdetail->unit_id             = $answer['unit_id'];
                $abstractsubdetail->rate                = $answer['rate'];
                $abstractsubdetail->amount              = $answer['amount'];
                $abstractsubdetail->modified_by          = $user->id;
                $abstractsubdetail->modified_date        = date('Y-m-d H:i:s');
				//echo "<pre>";  print_r($abstractsubdetail); exit();
                $this->ProjectwiseAbstractSubdetails->save($abstractsubdetail);
                }				
           // }

            $this->Flash->success(__('The project Abstract detail has been updated.'));			
			
            return $this->redirect(['action' => 'technicalsanction/' . $id . '/' . $pid . '/' . $work_id]);
			           
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
	  	         $units = $this->Units->find('list', ['limit' => 200])->all();

	$this->set(compact('units','projectDevelopmentWorkDetail', 'projectWorks','buildingItems','projectWorkSubdetails', 'developmentWorks','id','work_id','abstract_subdetails'));
    }
		
	public function add()
    {
        $this->viewBuilder()->setLayout('layout');

        $oldProjectWorkDetail = $this->OldProjectWorkDetails->newEmptyEntity();
        if ($this->request->is('post')) { //echo "<pre>"; print_r($this->request->getData()); exit();
            $oldProjectWorkDetail = $this->OldProjectWorkDetails->patchEntity($oldProjectWorkDetail, $this->request->getData());
           
                $oldProjectWorkDetail->project_name    		= $this->request->getData('project_name');
                $oldProjectWorkDetail->place_name      		= $this->request->getData('place_name');
                $oldProjectWorkDetail->district_id     		= $this->request->getData('district_id');
                $oldProjectWorkDetail->division_id     		= $this->request->getData('division_id');
                $oldProjectWorkDetail->circle_id       		= $this->request->getData('circle_id');
                $oldProjectWorkDetail->fs_value       		= $this->request->getData('fs_value');
                $oldProjectWorkDetail->work_type       		= 1;
                $oldProjectWorkDetail->department_id   		= ($this->request->getData('department_id'))?$this->request->getData('department_id'):'';
                $oldProjectWorkDetail->financial_year_id    = ($this->request->getData('financial_year_id'))?$this->request->getData('financial_year_id'):'';
                $oldProjectWorkDetail->go_no          		= $this->request->getData('go_no');
                $oldProjectWorkDetail->go_date          	= date('Y-m-d', strtotime($this->request->getData('go_date')));
           // echo "<pre>"; print_r($oldProjectWorkDetail); exit();
		   if ($this->OldProjectWorkDetails->save($oldProjectWorkDetail)) {        
					$this->Flash->success(__('The old project work detail has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The old project work detail could not be saved. Please, try again.'));
        }
        $districts = $this->OldProjectWorkDetails->Districts->find('list')->where(['Districts.is_active' => 1])->all();
        $divisions = $this->OldProjectWorkDetails->Divisions->find('list')->where(['Divisions.is_active' => 1])->all();
        $circles = $this->OldProjectWorkDetails->Circles->find('list')->where(['Circles.is_active' => 1])->all();
        $financialYears = $this->OldProjectWorkDetails->FinancialYears->find('list')->where(['FinancialYears.is_active' => 1])->order(['FinancialYears.id DESC'])->all();
        $departments = $this->OldProjectWorkDetails->Departments->find('list')->where(['Departments.is_active' => 1])->all();
        $this->set(compact('oldProjectWorkDetail', 'districts', 'divisions', 'circles', 'financialYears', 'departments'));
    }
	
	 public function edit($id = null)
    {
		  $this->viewBuilder()->setLayout('layout');

        $oldProjectWorkDetail = $this->OldProjectWorkDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $oldProjectWorkDetail = $this->OldProjectWorkDetails->patchEntity($oldProjectWorkDetail, $this->request->getData());
			    $oldProjectWorkDetail->project_name    		= $this->request->getData('project_name');
                $oldProjectWorkDetail->place_name      		= $this->request->getData('place_name');
                $oldProjectWorkDetail->district_id     		= $this->request->getData('district_id');
                $oldProjectWorkDetail->division_id     		= $this->request->getData('division_id');
                $oldProjectWorkDetail->circle_id       		= $this->request->getData('circle_id');
                $oldProjectWorkDetail->fs_value       		= $this->request->getData('fs_value');
                $oldProjectWorkDetail->work_type       		= 1;
                $oldProjectWorkDetail->department_id   		= ($this->request->getData('department_id'))?$this->request->getData('department_id'):'';
                $oldProjectWorkDetail->financial_year_id    = ($this->request->getData('financial_year_id'))?$this->request->getData('financial_year_id'):'';
                $oldProjectWorkDetail->go_no          		= $this->request->getData('go_no');
                $oldProjectWorkDetail->go_date          	= date('Y-m-d', strtotime($this->request->getData('go_date')));
            
			if ($this->OldProjectWorkDetails->save($oldProjectWorkDetail)) {
                $this->Flash->success(__('The old project work detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The old project work detail could not be saved. Please, try again.'));
        }
         $districts = $this->OldProjectWorkDetails->Districts->find('list')->where(['Districts.is_active' => 1])->all();
        $divisions = $this->OldProjectWorkDetails->Divisions->find('list')->where(['Divisions.is_active' => 1])->all();
        $circles = $this->OldProjectWorkDetails->Circles->find('list')->where(['Circles.is_active' => 1])->all();
        $financialYears = $this->OldProjectWorkDetails->FinancialYears->find('list')->where(['FinancialYears.is_active' => 1])->order(['FinancialYears.id DESC'])->all();
        $departments = $this->OldProjectWorkDetails->Departments->find('list')->where(['Departments.is_active' => 1])->all();
        $this->set(compact('oldProjectWorkDetail', 'districts', 'divisions', 'circles', 'financialYears', 'departments'));
    }
	
	public function sradd()
    {
        $this->viewBuilder()->setLayout('layout');

        $oldProjectWorkDetail = $this->OldProjectWorkDetails->newEmptyEntity();
        if ($this->request->is('post')) { //echo "<pre>"; print_r($this->request->getData()); exit();
            $oldProjectWorkDetail = $this->OldProjectWorkDetails->patchEntity($oldProjectWorkDetail, $this->request->getData());
           
                $oldProjectWorkDetail->project_name    		= $this->request->getData('project_name');
                $oldProjectWorkDetail->place_name      		= $this->request->getData('place_name');
                $oldProjectWorkDetail->district_id     		= $this->request->getData('district_id');
                $oldProjectWorkDetail->division_id     		= $this->request->getData('division_id');
                $oldProjectWorkDetail->circle_id       		= $this->request->getData('circle_id');
                $oldProjectWorkDetail->fs_value       		= $this->request->getData('fs_value');
                $oldProjectWorkDetail->work_type       		= 2;
                $oldProjectWorkDetail->department_id   		= ($this->request->getData('department_id'))?$this->request->getData('department_id'):'';
                $oldProjectWorkDetail->financial_year_id    = ($this->request->getData('financial_year_id'))?$this->request->getData('financial_year_id'):'';
                $oldProjectWorkDetail->ref_no          		= $this->request->getData('ref_no');
                //$oldProjectWorkDetail->go_date          	= date('Y-m-d', strtotime($this->request->getData('go_date')));
           // echo "<pre>"; print_r($oldProjectWorkDetail); exit();
		   if ($this->OldProjectWorkDetails->save($oldProjectWorkDetail)) {        
					$this->Flash->success(__('The old project work detail has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The old project work detail could not be saved. Please, try again.'));
        }
        $districts = $this->OldProjectWorkDetails->Districts->find('list')->where(['Districts.is_active' => 1])->all();
        $divisions = $this->OldProjectWorkDetails->Divisions->find('list')->where(['Divisions.is_active' => 1])->all();
        $circles = $this->OldProjectWorkDetails->Circles->find('list')->where(['Circles.is_active' => 1])->all();
        $financialYears = $this->OldProjectWorkDetails->FinancialYears->find('list')->where(['FinancialYears.is_active' => 1])->order(['FinancialYears.id DESC'])->all();
        $departments = $this->OldProjectWorkDetails->Departments->find('list')->where(['Departments.is_active' => 1])->all();
        $this->set(compact('oldProjectWorkDetail', 'districts', 'divisions', 'circles', 'financialYears', 'departments'));
    }
	
	 public function sredit($id = null)
    {
		  $this->viewBuilder()->setLayout('layout');

        $oldProjectWorkDetail = $this->OldProjectWorkDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $oldProjectWorkDetail = $this->OldProjectWorkDetails->patchEntity($oldProjectWorkDetail, $this->request->getData());
			    $oldProjectWorkDetail->project_name    		= $this->request->getData('project_name');
                $oldProjectWorkDetail->place_name      		= $this->request->getData('place_name');
                $oldProjectWorkDetail->district_id     		= $this->request->getData('district_id');
                $oldProjectWorkDetail->division_id     		= $this->request->getData('division_id');
                $oldProjectWorkDetail->circle_id       		= $this->request->getData('circle_id');
                $oldProjectWorkDetail->fs_value       		= $this->request->getData('fs_value');
                $oldProjectWorkDetail->work_type       		= 2;
                $oldProjectWorkDetail->department_id   		= ($this->request->getData('department_id'))?$this->request->getData('department_id'):'';
                $oldProjectWorkDetail->financial_year_id    = ($this->request->getData('financial_year_id'))?$this->request->getData('financial_year_id'):'';
                $oldProjectWorkDetail->ref_no          		= $this->request->getData('ref_no');
                //$oldProjectWorkDetail->go_date          	= date('Y-m-d', strtotime($this->request->getData('go_date')));
            
			if ($this->OldProjectWorkDetails->save($oldProjectWorkDetail)) {
                $this->Flash->success(__('The old project work detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The old project work detail could not be saved. Please, try again.'));
        }
         $districts = $this->OldProjectWorkDetails->Districts->find('list')->where(['Districts.is_active' => 1])->all();
        $divisions = $this->OldProjectWorkDetails->Divisions->find('list')->where(['Divisions.is_active' => 1])->all();
        $circles = $this->OldProjectWorkDetails->Circles->find('list')->where(['Circles.is_active' => 1])->all();
        $financialYears = $this->OldProjectWorkDetails->FinancialYears->find('list')->where(['FinancialYears.is_active' => 1])->order(['FinancialYears.id DESC'])->all();
        $departments = $this->OldProjectWorkDetails->Departments->find('list')->where(['Departments.is_active' => 1])->all();
        $this->set(compact('oldProjectWorkDetail', 'districts', 'divisions', 'circles', 'financialYears', 'departments'));
    }
	
	 public function delete($id = null)
    {
       $this->loadModel('OldProjectWorkDetails');		
		$userTable          = $this->getTableLocator()->get('OldProjectWorkDetails');
		$user                = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'OldProjectWorkDetails', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'OldProjectWorkDetails', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }  
	
	public function skipfs($id = null)
    {
       $this->loadModel('OldProjectWorkDetails');		
		$userTable           = $this->getTableLocator()->get('OldProjectWorkDetails');
		$user                = $userTable->get($id); 
		$user->skip_fs_flag  = 1;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'OldProjectWorkDetails', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'OldProjectWorkDetails', 'action' => 'index']);

            $this->Flash->error(__('Unable to skip FS. Please, try again.'));  
        }		
		exit();
    }  
	
}