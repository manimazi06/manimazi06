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
		$user = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		
		if($role_id == 1 || $role_id == 5){			
		  $condition = "";
		}else{			
		  $condition = " AND project.division_id = '".$division_id."'";			
		}

        $connection = ConnectionManager::get('default');
       
       
        
        $query                   =  "SELECT count(project.id) as pwcount
                                     from project_works as project 
                                     where project.is_active=1 $condition";
       $TotalProjectCount        = $connection->execute($query)->fetchAll('assoc');


        $query1                 =  "SELECT count(project.id) as pwcount
                                   from project_works as project 
                                   where project.project_status_id=1 AND project.is_active=1 $condition";
        $progressCount         = $connection->execute($query1)->fetchAll('assoc');

        //  $tot_progress_count = $progressCount[0]['pwcount'];


        $query2                 =  "SELECT 
                                   count(project.id) as pwcount
                                   from project_works as project 
                                   where project.project_status_id=2 AND project.is_active=1 $condition";
        $Totalcompletecount      = $connection->execute($query2)->fetchAll('assoc');

         // print_r($tot_progress_count);exit();  

        $this->set(compact('progressCount','Totalcompletecount','TotalProjectCount'));
    }
	
	
     public function ajaxprojectwise($val=NULL)
    {
    
        // $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $role_id     = $user->role_id;
		$division_id = $user->division_id;
		
		if($role_id == 1 || $role_id == 5){			
		  $rolecondition = "";
		}else{			
		  $rolecondition = " AND work.division_id = '".$division_id."'";			
		}
		
        $connection        = ConnectionManager::get('default');
       
            // echo"<pre>";print_r($emp_desgn);exit();
            if($val==1){
               $Cond = "";
            }elseif($val==2){
               
                $Cond= " AND work.project_status_id=1";
            }elseif($val==3){
                $Cond= " AND work.project_status_id=2";
            }
            $sql = "SELECT  
                        department.name as departmentname,
                        work.project_amount as amount,
                        financial_year.name as financial_year, 
                        building_type.name as building_type,
                        project_statuse.name as project_status, 
                        work.project_name as project_name, 
                        work.project_code as project_code, 
                        division.name as divisionname FROM project_works as work 
                        LEFT JOIN departments as department on department.id = work.department_id 
                        LEFT JOIN financial_years as financial_year on financial_year.id = work.financial_year_id
                        LEFT JOIN building_types as building_type on building_type.id = work.building_type_id
                        LEFT JOIN project_statuses as project_statuse on project_statuse.id = work.project_status_id 
                        LEFT JOIN divisions as division on division.id = work.division_id  where work.is_active=1 $Cond $rolecondition";				
						
						
             $projectdetails      = $connection->execute($sql)->fetchAll('assoc');
        // print_r($sql);exit();
        $this->set(compact('projectdetails'));
    }

    public function index()
    {        
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		$this->loadModel('ProjectAdministrativeSanctions');
		$this->loadModel('ProjectFinancialSanctions');
		$this->loadModel('TechnicalSanctions');
		$this->loadModel('ProjectMonitoringDetails');
		$this->loadModel('ProjectTenderDetails');
		$this->loadModel('ProjectWorkSubdetails');
		
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;
		
		if($role_id == 1 || $role_id == 6 || $role_id == 8){		
	      $projectWorks = $this->ProjectWorks->find('all')->contain(['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions'])->toArray();	
        }else if($role_id == 2){	
		 
		     $projectWork_ids      = $this->ProjectWorkSubdetails->find('list', ['keyField' => 'project_work_id','valueField' => 'project_work_id'])->where(['ProjectWorkSubdetails.division_id' => $division_id])->group('ProjectWorkSubdetails.project_work_id')->toArray();

			 if($projectWork_ids != ''){
				$projectWorks = $this->ProjectWorks->find('all')->contain(['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions'])->where(['ProjectWorks.id IN'=>$projectWork_ids])->toArray();	
			 }	 
		}else if($role_id == 4 || $role_id == 5){	
		   
		   if($role_id == 5){
		     $projectWork_ids      = $this->ProjectWorkSubdetails->find('list', ['keyField' => 'project_work_id','valueField' => 'project_work_id'])->where(['ProjectWorkSubdetails.circle_id' => $circle_id])->group('ProjectWorkSubdetails.project_work_id')->toArray();
		   }else if($role_id == 4){  
 			 $projectWork_ids      = $this->ProjectWorkSubdetails->find('list', ['keyField' => 'project_work_id','valueField' => 'project_work_id'])->where(['ProjectWorkSubdetails.circle_id' => $circle_id,'ProjectWorkSubdetails.division_id' => $division_id])->group('ProjectWorkSubdetails.project_work_id')->toArray();
		   }
		   
		   //print_r($projectWork_ids);  exit();
		   
			 if($projectWork_ids != ''){
				$projectWorks = $this->ProjectWorks->find('all')->contain(['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions'])->where(['ProjectWorks.id IN'=>$projectWork_ids])->toArray();	
			 }	 
		}			
		
		$adminsanction_count = array(); 
		$financial_count     = array(); 
		$techsanction_count  = array(); 
		$tender_count        = array(); 
		$monitoring_count    = array(); 
		
		foreach($projectWorks as $project){	
		
			$adminsanction_count[$project['id']] = $this->ProjectAdministrativeSanctions->find('all')->where(['ProjectAdministrativeSanctions.project_work_id' => $project['id']])->count();
			$financial_count[$project['id']]     = $this->ProjectFinancialSanctions->find('all')->where(['ProjectFinancialSanctions.project_work_id' => $project['id']])->count();
			$techsanction_count[$project['id']]  = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $project['id']])->count();
			$tender_count[$project['id']]        = $this->ProjectTenderDetails->find('all')->where(['ProjectTenderDetails.project_work_id' => $project['id']])->count();
			$monitoring_count[$project['id']]    = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_id' => $project['id']])->count();
			
			
			$subdetail_present[$project['id']]    = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $project['id']])->count();
			$estimate_uploaded[$project['id']]    = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.project_work_id' => $project['id'],'ProjectWorkSubdetails.detailed_estimate_flag'=>1])->count();
		
		}	
		

	   $this->set(compact('projectWorks','adminsanction_count','financial_count','techsanction_count','tender_count','monitoring_count','role_id','subdetail_present','estimate_uploaded'));
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
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
        ]);
		
		
		 //echo '<pre>';  print_r($projectWork);   exit();
		
		 $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->first();
		 $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
		 $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['project_work_id' => $id])->toArray();
		
//echo '<pre>';  print_r($projectWorkSubdetails);   exit();

		 $financialsanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
		 $financialsanctionscount     = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
		 $technicalSanctions          = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
		 $technicalSanctionscount     = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
		 $projectTenderDetails        = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
		 $projectTenderDetailscount   = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
         $monitoringDetails           = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks','WorkStages'])->where(['project_work_id' => $id])->toArray();
         $monitoringDetailscount      = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks','WorkStages'])->where(['project_work_id' => $id])->count();

	   $this->set(compact('projectWork','administrativesanction','financialsanctions','monitoringDetails','technicalSanctions','projectTenderDetails','administrativesanctioncount','financialsanctionscount','technicalSanctionscount','projectTenderDetailscount','monitoringDetailscount','projectWorkSubdetails','id'));
    }


    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
        
        $projectWork = $this->ProjectWorks->newEmptyEntity();
        if ($this->request->is('post')) { //echo '<pre>'; print_r($this->request->getData());   exit();

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
           // $projectWork->district_id         =  $this->request->getData('district_id');
			//if($role_id == 1){		
            //$projectWork->division_id         =  $this->request->getData('division_id');
			//}else{
	        //$projectWork->division_id         =  $division_id;
			//}
           // $projectWork->latitude            =  $this->request->getData('latitude');
            //$projectWork->longitude           =  $this->request->getData('longitude');
            $projectWork->created_by          =  $user->id;
            $projectWork->created_date        =  date('Y-m-d H:i:s');
              // echo"<pre>";   print_r($projectWork);
                            // exit();        
        
			if ($this->ProjectWorks->save($projectWork)) {
			   $insertid   = $projectWork->id;
			           

			   $depid        =  $this->request->getData('department_id');
               $yearname     =  $this->request->getData('financial_year_id');
               //$disid        =  $this->request->getData('district_id');
         

                $this->loadModel('Departments');
                $this->loadModel('FinancialYears');
                $this->loadModel('Districts');
                $dep                       = $this->Departments->find('all')->where(['Departments.id' => $depid])->first();
                $profinancial              = $this->FinancialYears->find('all')->where(['FinancialYears.id' => $yearname])->first();
                //$dis                       = $this->Districts->find('all')->where(['Districts.id' => $disid])->first();
                $fyear                     = substr($profinancial['name'], -2);
                //$disname                   = substr($dis['name'], 0, 3);
                $depcode                   = strtoupper(substr($dep['name'], 0, 3));
                $var                       = sprintf('%03d', $insertid);
               
                $projectcode               =  $fyear.$depcode.$var;
				
				
			    // echo"<pre>";   print_r($projectcode);
                  // exit();
          
                $ProjectWorksTable      = $this->getTableLocator()->get('ProjectWorks');
                $project                = $ProjectWorksTable->get($insertid); 
                $project->project_code  = $projectcode;
                $ProjectWorksTable->save($project);

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
        $financialYears = $this->FinancialYears->find('list', ['limit' => 200])->all();
        $buildingTypes  = $this->BuildingTypes->find('list', ['limit' => 200])->all();
        $schemeTypes  = $this->SchemeTypes->find('list', ['limit' => 200])->all();
        $Statuses  = $this->ProjectStatuses->find('list', ['limit' => 200])->all();
      
      	if($role_id == 1){
  	      $districts = $this->Districts->find('list')->all();
		}else{
  	      $districts = $this->Districts->find('list')->where(['Districts.division_id'=>$division_id])->all();
		}      

	    $divisions = $this->Divisions->find('list', ['limit' => 200])->all();
        $this->set(compact('projectWork', 'departments', 'financialYears', 'buildingTypes', 'Statuses', 'districts', 'divisions','role_id','schemeTypes'));
    }

    public function edit($id = null)
    {
        //$id = base64_decode($id);
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //print_r($_POST);exit();
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

            $projectWork->department_id       =  $this->request->getData('department_id');
            $projectWork->financial_year_id   =  $this->request->getData('financial_year_id');
            $projectWork->building_type_id    =  $this->request->getData('building_type_id');
            $projectWork->project_status_id   =  1;
            //$projectWork->project_code        =  $this->request->getData('project_code');
            $projectWork->project_name        =  $this->request->getData('project_name');
            $projectWork->project_description =  $this->request->getData('project_description');
            $projectWork->project_amount      =  $this->request->getData('project_amount');
            $projectWork->coastal_area        =  $this->request->getData('coastal_area');
            // $projectWork->district_id         =  $this->request->getData('district_id');
            // if($role_id == 1){		
            // $projectWork->division_id         =  $this->request->getData('division_id');
			// }else{
	        // $projectWork->division_id         =  $division_id;
			// }
            // $projectWork->latitude            =  $this->request->getData('latitude');
            // $projectWork->longitude           =  $this->request->getData('longitude');
            $projectWork->modified_by         =  $user->id;
            $projectWork->modified_date       =  date('Y-m-d H:i:s');

            if ($this->ProjectWorks->save($projectWork)) {
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
        $departments    = $this->ProjectWorks->Departments->find('list', ['limit' => 200])->all();
        $financialYears = $this->FinancialYears->find('list', ['limit' => 200])->all();
        $buildingTypes  = $this->BuildingTypes->find('list', ['limit' => 200])->all();
        $Statuses  = $this->ProjectStatuses->find('list', ['limit' => 200])->all();
	   
      	if($role_id == 1){
  	      $districts  = $this->Districts->find('list')->all();
		}else{
  	      $districts  = $this->Districts->find('list')->where(['Districts.division_id'=>$division_id])->all();
		}
        $divisions    = $this->ProjectWorks->Divisions->find('list')->all();
		$schemeTypes  = $this->SchemeTypes->find('list', ['limit' => 200])->all();

        $this->set(compact('projectWork', 'departments', 'financialYears', 'buildingTypes', 'projectStatuses', 'districts', 'divisions','schemeTypes')); 
    }

    public function ajaxdivisions($id)
    {
        $this->loadModel('Districts');
        $dists = $this->Districts->find('all')->contain(['Divisions'])->where(['Districts.id' => $id])->first();

        $division = array(
            'division_id' => $dists['division']['id'],
            'division_name' => $dists['division']['name']
        );

        //print_r($division);  exit();
        $this->set(compact('division'));
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
	
	public function administrativesanction($id = null)
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
		
		//print_r($project_code);  exit();

       $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->count();      
	   $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	   $projectWorkSubdetails      = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id])->toArray();
        if ($administrativesanctioncount == 0) {
            $projectAdministrativeSanction = $this->ProjectAdministrativeSanctions->newEmptyEntity();
        }
        

        if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>';  print_r($this->request->getData());   exit();
            if ($administrativesanctioncount > 0) {
                $projectAdministrativeSanction = $this->ProjectAdministrativeSanctions->get($this->request->getData('id'), [
                    'contain' => [],
                ]);
            }

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
                    $newfile                                =  "administativesanction_" . $id . "_" . $current_time . "." . $fileExt;
                    $tempFile                               =  $tmpName;
                    $targetPath                             =  'uploads/AdministrativeSanctions/';   
                    $targetFile                             =  $targetPath . $newfile;
                    $projectAdministrativeSanction->go_file_upload    =   $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            } else {

                $projectAdministrativeSanction->go_file_upload                    = $this->request->getData('go_file_upload1');
            }

            $projectAdministrativeSanction->project_work_id           = $id;
            $projectAdministrativeSanction->go_no                     = $this->request->getData('go_no');
            $projectAdministrativeSanction->go_date                   = date('Y-m-d', strtotime($this->request->getData('go_date')));
            $projectAdministrativeSanction->sanctioned_amount         = $this->request->getData('sanctioned_amount');
           
            $projectAdministrativeSanction->created_by                =  $user->id;
            $projectAdministrativeSanction->created_date              =  date('Y-m-d H:i:s');
            // echo"<pre>"; print_r($projectAdministrativeSanction);exit();
            if ($this->ProjectAdministrativeSanctions->save($projectAdministrativeSanction)) {
				
				$count = 0;
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
					
					$divsioncode               = strtoupper(substr($division['name'], 0, 3));
					
					
					$count =  $key+1;
					$var                       = sprintf('%02d', $count);				   
					$workcode                  = $goyear.$divsioncode.$var; 				
					
					$ProjectWorkssubdetailTable  = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                     = $ProjectWorkssubdetailTable->get($insertid); 
					$project->work_code          = $project_code.'/'.$workcode;
					$ProjectWorkssubdetailTable->save($project);	
					
				}
            }			
				
                $this->Flash->success(__('The project administrative sanction has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'index']);
            }
            $this->Flash->error(__('The project administrative sanction could not be saved. Please, try again.'));
        }
		
		
		 $this->loadModel('Divisions');
		 $this->loadModel('Circles');
        $divisions = $this->Divisions->find('list')->toArray();
        $circles = $this->Circles->find('list')->toArray();
          $this->set(compact('projectWork', 'administrativesanction','administrativesanctioncount','projectAdministrativeSanction','divisions','circles','projectWorkSubdetails','id'));
    }
	
	
   public function ajaxproject($i = null)
    {
		 $this->loadModel('Divisions');
		 $this->loadModel('Circles');
        $divisions = $this->Divisions->find('list')->toArray();
        $circles = $this->Circles->find('list')->toArray();
		
		
        $this->set(compact('i','divisions','circles'));
    }
		
   public function ajaxcircles($id)
    {
        $this->loadModel('Divisions');	
		
		$divs     = $this->Divisions->find('all')->contain(['Circles'])->where(['Divisions.id' => $id])->first();
        
        // $circle = array(
            // 'circle_id'   => $divs['circle']['id'],
            // 'circle_name' => $divs['circle']['name']
        // );
		
		echo  $divs['circle']['id'];

        exit();
        $this->set(compact('circle'));
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

    public function projectdetailedestimate($id = null)
   {
	   
	    $this->viewBuilder()->setLayout('layout');
	   $this->loadModel('ProjectwiseDetailedEstimates');
	   $this->loadModel('ProjectAdministrativeSanctions');
	   $this->loadModel('ProjectWorkSubdetails');

        $user = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;
        //$pid = base64_decode($id);
        $this->loadModel('ProjectWorks');
        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions'],
        ]);
		
	    $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
	
	   $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id,'ProjectWorkSubdetails.division_id'=> $division_id])->toArray();
     
		
		

        $detailed_estimates = $this->ProjectwiseDetailedEstimates->find('all')->contain(['ProjectWorks','Materials','Units'])->where(['ProjectwiseDetailedEstimates.project_work_id' => $id])->toArray();
		
		// echo "<pre>"; print_r($detailed_estimates);  exit();
      
        //$administrativesanction = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->first();
        /* $projectwiseDetailedEstimates = $this->ProjectwiseDetailedEstimates->newEmptyEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>';  print_r($this->request->getData()); exit();       
          

            $projectwiseDetailedEstimates->project_work_id           = $id;
            $projectwiseDetailedEstimates->material_id               = $this->request->getData('material_id');
            $projectwiseDetailedEstimates->quantity                  = $this->request->getData('quantity');
            $projectwiseDetailedEstimates->unit_id                   = $this->request->getData('unit_id');
            $projectwiseDetailedEstimates->approved_estimate         = $this->request->getData('approved_estimate');
            $projectwiseDetailedEstimates->total_cost                = $this->request->getData('total_cost');
            $projectwiseDetailedEstimates->submit_date               = date('Y-m-d');
            $projectwiseDetailedEstimates->created_by                =  $user->id;
            $projectwiseDetailedEstimates->created_date              =  date('Y-m-d H:i:s');
           //  echo"<pre>"; print_r($projectwiseDetailedEstimates);exit();
            if ($this->ProjectwiseDetailedEstimates->save($projectwiseDetailedEstimates)) {
                $this->Flash->success(__('The project Detailed Estimate has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectdetailedestimate/'.$id]);
            }
			
		}
		
        //$projectWorks = $this->ProjectwiseDetailedEstimates->ProjectWorks->find('list', ['limit' => 200])->all();
        $materials = $this->ProjectwiseDetailedEstimates->Materials->find('list', ['keyField' => 'id','valueField' => 'item_code'])->all();
        $units = $this->ProjectwiseDetailedEstimates->Units->find('list', ['limit' => 200])->all();*/
        $this->set(compact('projectWork','projectwiseDetailedEstimate', 'projectWorks', 'materials', 'units','detailed_estimates','id','administrativesanctioncount','administrativesanction','projectWorkSubdetails'));
	   
   }
     
   public function projectdetailedestimateadd($id = null,$work_id = null)
   {	   
	   $this->viewBuilder()->setLayout('layout');
	   $this->loadModel('ProjectwiseDetailedEstimates');
	   $this->loadModel('ProjectAdministrativeSanctions');
	   $this->loadModel('ProjectWorkSubdetails');

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
		  
			        $subdetailTable                   = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                          = $subdetailTable->get($work_id); 
					$project->detailed_estimate_flag  = 1;  
					$subdetailTable->save($project); 
					
		        $this->Flash->success(__('The project Detailed Estimate has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'index']);
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
      
   public function ajaxgetdescription($id=null){
	   
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
					$subdetailTable->save($project); 
				 
				 
                 $this->Flash->success(__('The technical sanction has been saved.'));
                 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectworkdetail/'.$id]);
               }else{
                 $this->Flash->error(__('The technical sanction could not be saved. Please, try again.'));
               }
       
      
    }
    $this->set(compact('technicalSanction', 'projectWork','technical','technicalcount','administrativesanctioncount','administrativesanction','financialSanctionscount','financialSanctions','projectWorkSubdetail'));
}   
    public function projectworkdetail($id = null)
   {	   
	    $this->viewBuilder()->setLayout('layout');
	   $this->loadModel('ProjectwiseDetailedEstimates');
	   $this->loadModel('ProjectAdministrativeSanctions');
	   $this->loadModel('ProjectWorkSubdetails');
	   $this->loadModel('ProjectFinancialSanctions');
	   $this->loadModel('ProjectFundRequestDetails');

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
		
	   $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
	
	   $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	   $projectWorkSubdetails       = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.project_work_id' => $id])->toArray();
       
	   $financialSanctionscount = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
       $financialSanctions      = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
      
	
       //$fundrequest          = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id])->count();
       $fundrequestcount          = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.is_approved !='=>0])->count();
       $fundrequest               = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.is_approved !='=>0])->first();

	
        $this->set(compact('projectWork','projectwiseDetailedEstimate', 'projectWorks', 'materials', 'units','detailed_estimates','id','administrativesanctioncount','administrativesanction','projectWorkSubdetails','financialSanctionscount','financialSanctions','role_id','division_id','circle_id','user_id','fundrequestcount','fundrequest'));
	   
   }
     
    public function approval($id=null,$work_id=null)
    {				 
	   $this->loadModel('ProjectWorkSubdetails');

        $this->request->allowMethod(['post', 'delete']);
        $work             = $this->ProjectWorkSubdetails->get($work_id);
        $work->is_approved  = 1;
        if ($this->ProjectWorkSubdetails->save($work)) {
			 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectworkdetail/'.$id]);

            $this->Flash->success(__('The Work  has been Approved.'));
        } else {
			 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectworkdetail/'.$id]);

            $this->Flash->error(__('The Work could not be Approved. Please, try again.'));
        }
		
		exit();
        //return $this->redirect(['action' => 'index']);
    }
		
	 public function tenderdetails($id = null,$work_id = null)
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
	   $projectWorkSubdetail       = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
  	   $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
       $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
      
        $technicalcount = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
        $technical      = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
   
	   $tenders = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id,'ProjectTenderDetails.project_work_subdetail_id'=>$work_id])->toArray(); 
       
	   $contractor_detail_count  = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id'=>$id,'ContractorDetails.project_work_subdetail_id'=> $work_id])->count(); 
       $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id])->first(); //tender key

        //echo '<pre>'; print_r($tenders); exit();

	   $projectTenderDetail = $this->ProjectTenderDetails->newEmptyEntity();      

        if ($this->request->is(['patch', 'post', 'put'])) {  // echo '<pre>'; print_r($this->request->getData()); exit();
		
		
		$completed_flag = $this->request->getData('completed_flag');        
		  
		  if($completed_flag == 1){			  
			        $subdetailTable               = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                      = $subdetailTable->get($work_id); 
					$project->tender_detail_flag  = 1;  
					$subdetailTable->save($project); 
					
		        $this->Flash->success(__('The project Tender has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'index']);
		  }else{

            $projectTenderDetail->project_work_id            = $id;
            $projectTenderDetail->project_work_subdetail_id  = $work_id;
            $projectTenderDetail->tender_no                  = $this->request->getData('tender_no');
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
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/'.$id.'/'.$work_id]);
            }else{
            $this->Flash->error(__('The Tender Details could not be saved. Please, try again.'));
			}
          }
        }
    
        $this->set(compact('projectTenderDetail', 'projectWork', 'tenders', 'id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','financialSanctionscount','financialSanctions','work_id','contractor_detail_count','contractor_details','technicalcount','technical'));
    }
		
    public function tenderdetailsedit($id = null,$work_id = null,$tender_id = null)
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
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
        ]);
		
	   $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
	   $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	   $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
  	   $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
       $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
       $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
       $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
   
       
        $projectTenderDetail = $this->ProjectTenderDetails->get($tender_id, [
            'contain' => [],
        ]);		
		
        if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>'; print_r($this->request->getData()); exit();
            $projectTenderDetail->project_work_id            = $id;
            $projectTenderDetail->project_work_subdetail_id  = $work_id;
            $projectTenderDetail->tender_no                  = $this->request->getData('tender_no');
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
            }else{
				   $projectTenderDetail->tender_copy              =  $this->request->getData('tender_copy1');
		
			}

            if ($this->ProjectTenderDetails->save($projectTenderDetail)) {
                $this->Flash->success(__('The Tender Details has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/'.$id.'/'.$work_id]);

            }
            $this->Flash->error(__('The Tender Details could not be saved. Please, try again.'));
        }
		
		$this->set(compact('projectTenderDetail', 'projectWork', 'tenders', 'id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','financialSanctionscount','financialSanctions','work_id','technicalcount','technical'));

    }	
	
	public function addcontractor($id = null,$work_id = null,$tender = null)
    {
       $this->viewBuilder()->setLayout('layout');
       $this->loadModel('ProjectWorks');
       $this->loadModel('ContractorDetails');
       $this->loadModel('ProjectAdministrativeSanctions');
       $this->loadModel('ProjectWorkSubdetails');
       $this->loadModel('ProjectFinancialSanctions');
       $this->loadModel('ProjectTenderDetails');
       $this->loadModel('TechnicalSanctions');

        $user = $this->request->getAttribute('identity');

        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions','SchemeTypes'],
        ]);

         $projectTenderDetail = $this->ProjectTenderDetails->get($tender, [
            // 'contain' => ['ContractorDetails', 'ProjectWorks'],
         ]);		
			
	   $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
	   $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
	   $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
  	   $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
       $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();
       $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->count();
       $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id,'TechnicalSanctions.project_work_subdetail_id'=>$work_id])->first();
   

       $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id])->first(); //tender key
       $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id' => $id,'ContractorDetails.project_work_subdetail_id' => $work_id])->count(); //tender key count
 
	   if($contractor_detail_count==0)
        {
        $contractorDetail = $this->ContractorDetails->newEmptyEntity();
        }      
    
        if ($this->request->is(['patch', 'post', 'put'])) { //echo '<pre>'; print_r($this->request->getData()); exit();

           if($contractor_detail_count > 0){
            $contractorDetail = $this->ContractorDetails->get($this->request->getData('id'), [
                'contain' => [],
            ]);
           }

            $contractorDetail->project_work_id               = $id;
            $contractorDetail->project_work_subdetail_id     = $work_id;
            $contractorDetail->project_tender_detail_id      = $tender;
            $contractorDetail->contractor_name               = $this->request->getData('contractor_name');
            $contractorDetail->contractor_mobile_no          = $this->request->getData('contractor_mobile_no');
            $contractorDetail->agreement_no                  = $this->request->getData('agreement_no');
            $contractorDetail->agreement_amount              = $this->request->getData('agreement_amount');
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
            }else{
				   $contractorDetail->agreement_copy              =  $this->request->getData('agreement_copy1');
		
			}
            //echo '<pre>'; print_r($contractorDetail); exit();
            if ($this->ContractorDetails->save($contractorDetail)) {
                $this->Flash->success(__('The Contractor Details has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'tenderdetails/'.$id.'/'.$work_id]);
            }
            $this->Flash->error(__('The Contractor Details could not be saved. Please, try again.'));
        }

        $this->set(compact('projectTenderDetail', 'contractor_details','contractor_detail_count', 'projectWork', 'contractorDetail', 'id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','financialSanctionscount','financialSanctions','work_id','technicalcount','technical'));
      
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
	   $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
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
					$subdetailTable->save($project); 
					
		        $this->Flash->success(__('The project Site H/O Details has been saved.'));
                 return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectworkdetail/'.$id]);

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
 
        $timelineDetailscount       = $this->ProjectTimelineDetails->find('all')->where(['ProjectTimelineDetails.project_work_id' => $id, 'ProjectTimelineDetails.project_work_subdetail_id' => $work_id])->count();
        $timelineDetails            = $this->ProjectTimelineDetails->find('all')->where(['ProjectTimelineDetails.project_work_id' => $id, 'ProjectTimelineDetails.project_work_subdetail_id' => $work_id])->toArray();
        $monitoringDetailscount     = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->count();
        $monitorings                = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->toArray();
        
		$photo_uploads = array();
        foreach ($monitorings as $monitoring) {
            $photo_uploads[$monitoring['id']]     = $this->ProjectMonitoringPhotosUploads->find('all')->where(['ProjectMonitoringPhotosUploads.project_monitoring_detail_id' => $monitoring['id']])->toArray();
        }

 	 $this->set(compact('projectTenderDetail', 'projectWork', 'tenders', 'id','administrativesanctioncount','administrativesanction','projectWorkSubdetail','financialSanctionscount','financialSanctions','work_id','contractor_detail_count','contractor_details','technicalcount','technical','fundrequests','requestcount','timelineDetailscount','timelineDetails','monitoringDetailscount','monitorings','photo_uploads'));
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
        $fundrequestcount      = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->count();

       $fund_requests     = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id])->toArray();
       $currentfundrequest     = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id,'ProjectFundRequestDetails.received_flag'=>0])->first();
       
      $prerequestcount      = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id,'ProjectFundRequestDetails.is_approved !='=>0])->count();
	  $balance_amount       = $this->ProjectFundRequestDetails->find('all')->where(['ProjectFundRequestDetails.project_work_id' => $id,'ProjectFundRequestDetails.project_work_subdetail_id'=>$work_id,'ProjectFundRequestDetails.is_approved'=>1])->last();
      $balance_amt = $balance_amount['balance_amount'];

        $projectFundRequestDetails = $this->ProjectFundRequestDetails->newEmptyEntity();

       if($this->request->is((['patch', 'post', 'put']))){    
         // echo "<pre>" ; print_r($this->request->getData()); exit();  	     
		       if($this->request->getData('fund_status_id') == 2){
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
				  $users  = $this->Users->find('all')->where(['Users.role_id'=>4,'Users.is_active'=>1])->first();
                  $user_id = $users['id']; 				   
			   }
		
		     if(($role_id == 4) && ($this->request->getData('fund_status_id') == 2)){
                $projectFundRequestDetails->project_work_id           = $id;
                $projectFundRequestDetails->project_work_subdetail_id = $work_id;             
                $projectFundRequestDetails->fund_status_id            = $this->request->getData('fund_status_id');
                $projectFundRequestDetails->fund_amount               = $this->request->getData('fund_amount');
                $projectFundRequestDetails->balance_amount            = $this->request->getData('balance_amount');
                $projectFundRequestDetails->user_id                   = $user_id;
                $projectFundRequestDetails->request_date              = date('Y-m-d', strtotime($this->request->getData('request_date')));
                $projectFundRequestDetails->created_by                = $user->id;
                $projectFundRequestDetails->created_date              = date('Y-m-d H:i:s');
              //  echo "<pre>" ; print_r($projectFundRequestDetails); exit();
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
                    return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectworkdetail/'.$id]);
                  }else{
                    $this->Flash->error(__('The Fund request details could not be saved. Please, try again.'));
                  }
				  
			 }else if($role_id == 5 || $role_id == 6){
				 
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
                    return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectworkdetail/'.$id]);
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
							   $requests->approval_date	= date('Y-m-d');  
							}elseif($this->request->getData('fund_status_id') == 6){
                               $requests->is_approved	= 2;  
							}	
							$RequestTable->save($requests);							
				
                    $this->Flash->success(__('The Fund request details has been saved.'));
                    return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectworkdetail/'.$id]);
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
								
                               $requests->transaction_ref_no	 = $this->request->getData('transaction_ref_no');
							   $requests->amount_received_date   = date('Y-m-d',strtotime($this->request->getData('amount_received_date')));  
							   $requests->transaction_amount	 = $this->request->getData('transaction_amount');  
							   $requests->received_flag	         = 1;  
							}elseif($this->request->getData('fund_status_id') == 8){
                              $requests->received_flag	         = 2;  
							}	
							$RequestTable->save($requests);


                       $subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
							$project                        = $subdetailTable->get($work_id);                         						   
							$project->fund_approval_user_id	= 0; 
							$project->fund_request_flag	    = 0;  
							
							$subdetailTable->save($project);
							$this->Flash->success(__('The Fund request details has been saved.'));
                          return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectworkdetail/'.$id]);
                    }							
				 
			 } 
         
       }
	   
	   
	 if($role_id == 8){	   
	    $fundStatuses = $this->FundStatuses->find('list')->where(['FundStatuses.id IN'=>[5,6]])->all();
    } else  if($role_id == 4){	  
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
         	      $fundrequeststages     = $this->ProjectFundRequestStages->find('all')->contain(['FundStatuses'])->where(['ProjectFundRequestStages.project_fund_request_detail_id' => $id])->toArray();

        // echo "<pre>"; print_r($fundrequeststages); exit();
		 
		 $this->set(compact('fundrequeststages'));
    }
   /*public function projectmonitoring($id = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->loadModel('ProjectWorks');
        $this->loadModel('ProjectMonitoringDetails');
        $this->loadModel('WorkStages');
        $this->loadModel('ProjectAdministrativeSanctions');
        $this->loadModel('ProjectFinancialSanctions');
        $this->loadModel('WorkPercentages');

        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions'],
        ]);

        $monitoringDetailscount = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->count();
        $monitoring      = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->first();
        $monitorings      = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->toArray();
        $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
        $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
        $financialSanctionscount = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
        $financialSanctions      = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();

        if ($monitoringDetailscount == 0) {
            $projectMonitoringDetail = $this->ProjectMonitoringDetails->newEmptyEntity();
        }

        if ($this->request->is((['patch', 'post', 'put']))) {
            // echo "<pre>";		// print_r($this->request->getData());      // exit();
            if ($monitoringDetailscount > 0) {
                $projectMonitoringDetail = $this->ProjectMonitoringDetails->get($this->request->getData('id'), [
                    'contain' => [],
                ]);
            }

            $projectMonitoringDetail->project_work_id           = $id;
            $projectMonitoringDetail->project_work_subdetail_id = $work_id;

            $projectMonitoringDetail->monitoring_date              = date('Y-m-d', strtotime($this->request->getData('monitoring_date')));

            $projectMonitoringDetail->work_stage_id               = $this->request->getData('work_stage_id');
            $projectMonitoringDetail->work_percentage_id            = $this->request->getData('work_percentage_id');
            $projectMonitoringDetail->created_by                = $user->id;
            $projectMonitoringDetail->created_date              = date('Y-m-d H:i:s');
            if ($this->ProjectMonitoringDetails->save($projectMonitoringDetail)) {

                $insertid                              = $projectMonitoringDetail->id;

                foreach ($this->request->getData('monitoring') as $key => $value) {
                    $projectMonitoringPhotosUpload = $this->ProjectMonitoringPhotosUploads->newEmptyEntity();
                    $attachment               =  $value['photo_upload'];

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
                            $newfile                                   =  "projectmonitoring_" . $value['work_stage_id'] . "_" . $key . "_" . $current_time . "." . $fileExt;
                            $tempFile                                  =  $tmpName;
                            $targetPath                                =  'uploads/Projectmonitoring/';
                            $targetFile                                =  $targetPath . $newfile;
                            $projectMonitoringPhotosUpload->file_upload   =   $newfile;
                            move_uploaded_file($tempFile, $targetFile);
                        }
                    } else {
                        $projectMonitoringPhotosUpload->file_upload =  $value['photo_upload1'];
                    }

                    $projectMonitoringPhotosUpload->project_monitoring_detail_id  = $insertid;
                    $projectMonitoringPhotosUpload->created_by                = $user->id;
                    $projectMonitoringPhotosUpload->created_date              = date('Y-m-d H:i:s');
                    $this->ProjectMonitoringPhotosUploads->save($projectMonitoringPhotosUpload);
                }
            }
           
            $this->Flash->success(__('The project monitoring detail has been saved.'));

            return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectworkdetail/' . $id]);
        }
        $workStages = $this->WorkStages->find('list', ['limit' => 200])->all();
        $percentage = $this->WorkPercentages->find('list', ['limit' => 200])->all();
        $this->set(compact('projectMonitoringDetail', 'projectWork', 'monitorings', 'workStages', 'monitoring', 'monitoringDetailscount', 'administrativesanctioncount', 'administrativesanction', 'financialSanctionscount', 'financialSanctions', 'percentage', 'id'));
    } */  
	

}