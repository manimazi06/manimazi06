<?php

declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Locator\LocatorAwareTrait;


class ProjectwiseDevelopmentWorksController extends AppController
{

    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        $this->paginate = [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails'],
        ];
        $projectwiseDevelopmentWorks = $this->paginate($this->ProjectwiseDevelopmentWorks);

        $this->set(compact('projectwiseDevelopmentWorks'));
    }


    public function view($pid = null ,$work_id = null,$id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $projectwiseDevelopmentWork = $this->ProjectwiseDevelopmentWorks->get($id, [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails'],
        ]);

        $this->set(compact('projectwiseDevelopmentWork'));
    }


    public function add($pid,$work_id)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $ProjectwiseDevelopmentWorkscount = $this->ProjectwiseDevelopmentWorks->find('all')->where(['ProjectwiseDevelopmentWorks.project_work_id'=>$pid,'ProjectwiseDevelopmentWorks.project_work_subdetail_id'=>$work_id])->count();
		$ProjectwiseDevelopmentWorkslists = $this->ProjectwiseDevelopmentWorks->find('all')->where(['ProjectwiseDevelopmentWorks.project_work_id'=>$pid,'ProjectwiseDevelopmentWorks.project_work_subdetail_id'=>$work_id])->toArray();
// echo"<pre>";print_r( $ProjectwiseDevelopmentWorkscount);exit();
        $projectwiseDevelopmentWork = $this->ProjectwiseDevelopmentWorks->newEmptyEntity();
        if ($this->request->is('post')) {
// echo"<pre>";print_r($_POST);exit();

            $attachment  =  $this->request->getData('file_upload');

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
                    $newfile                                   = "file_upload_" . $current_time . "." . $fileExt;
                    $tempFile                                  = $tmpName;
                    $targetPath                                = 'uploads/ProjectwiseDevelopmentWork/';
                    $targetFile                                = $targetPath . $newfile;
                    $projectwiseDevelopmentWork->file_upload   =   $newfile;

                    move_uploaded_file($tempFile, $targetFile);
                }
            }
            $projectwiseDevelopmentWork->project_work_id              =  $pid;
            $projectwiseDevelopmentWork->project_work_subdetail_id    =  $work_id;
            $projectwiseDevelopmentWork->work_name                    =  $this->request->getData('work_name');
            $projectwiseDevelopmentWork->work_description             =  $this->request->getData('work_description');
            $projectwiseDevelopmentWork->estimated_cost               =  $this->request->getData('estimated_cost');
            $projectwiseDevelopmentWork->created_by                   =  $user->id;
            $projectwiseDevelopmentWork->created_date                 =  date('Y-m-d:h:m:s');

            if ($this->ProjectwiseDevelopmentWorks->save($projectwiseDevelopmentWork)) {
                $this->Flash->success(__('The projectwise development work has been saved.'));
                return $this->redirect(['action' => 'add/'.$pid.'/'.$work_id]);
                // return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The projectwise development work could not be saved. Please, try again.'));
        }
        $this->set(compact('projectwiseDevelopmentWork','ProjectwiseDevelopmentWorkscount','ProjectwiseDevelopmentWorkslists','pid','work_id'));
    }


    public function edit($pid = null ,$work_id = null,$id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $projectwiseDevelopmentWork = $this->ProjectwiseDevelopmentWorks->get($id, [
            'contain' => [],
        ]);
        // echo"<pre>";print_r($projectwiseDevelopmentWork);exit();

        if ($this->request->is(['patch', 'post', 'put'])) {
            // echo"<pre>";print_r($_POST);exit();

            // $projectwiseDevelopmentWork = $this->ProjectwiseDevelopmentWorks->patchEntity($projectwiseDevelopmentWork, $this->request->getData());

            $attachment  =  $this->request->getData('file_upload');

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
                    $newfile                                   = "file_upload_" . $current_time . "." . $fileExt;
                    $tempFile                                  = $tmpName;
                    $targetPath                                = 'uploads/ProjectwiseDevelopmentWork/';
                    $targetFile                                = $targetPath . $newfile;
                    $projectwiseDevelopmentWork->file_upload   =   $newfile;

                    move_uploaded_file($tempFile, $targetFile);
                }
            }else{
                $projectwiseDevelopmentWork->file_upload        = $this->request->getData('file_upload1');
            }

            $projectwiseDevelopmentWork->project_work_id             =  $pid;
            $projectwiseDevelopmentWork->project_work_subdetail_id   =  $work_id;
            $projectwiseDevelopmentWork->work_name                   =  $this->request->getData('work_name');
            $projectwiseDevelopmentWork->work_description            =  $this->request->getData('work_description');
            $projectwiseDevelopmentWork->estimated_cost              =  $this->request->getData('estimated_cost');
            $projectwiseDevelopmentWork->modified_by                 =  $user->id;
            $projectwiseDevelopmentWork->modified_date               =  date('Y-m-d:h:m:s');
        // echo"<pre>";print_r($projectwiseDevelopmentWork);exit();

            if ($this->ProjectwiseDevelopmentWorks->save($projectwiseDevelopmentWork)) {

                $this->Flash->success(__('The projectwise development work has been saved.'));

                return $this->redirect(['action' => 'add/'.$pid.'/'.$work_id]);
            }
            $this->Flash->error(__('The projectwise development work could not be saved. Please, try again.'));
        }
        $this->set(compact('projectwiseDevelopmentWork'));
    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectwiseDevelopmentWork = $this->ProjectwiseDevelopmentWorks->get($id);
        if ($this->ProjectwiseDevelopmentWorks->delete($projectwiseDevelopmentWork)) {
            $this->Flash->success(__('The projectwise development work has been deleted.'));
        } else {
            $this->Flash->error(__('The projectwise development work could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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
	    $projectwiseDevelopmentWork        = $this->ProjectwiseDevelopmentWorks->find('all')->where(['ProjectwiseDevelopmentWorks.id' => $id])->first();
        $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();


        if ($this->request->is(['patch', 'post', 'put'])) {
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
                $newfile                                  = "dev_detailed_estimate_" . $current_time . "." . $fileExt;
                $tempFile                                 = $tmpName;
                $targetPath                               = 'uploads/DetailedEstimates/';
                $targetFile                               = $targetPath . $newfile;
                move_uploaded_file($tempFile, $targetFile);
            } else {
                $newfile = $this->request->getData('detailed_estimate_upload1');
            }

            $subdetailTable                     = $this->getTableLocator()->get('ProjectwiseDevelopmentWorks');
            $project                            = $subdetailTable->get($id);         
			//$project->detailed_estimate_flag    = 1;
            $project->detailed_estimate_upload  = $newfile;
            $project->detailed_estimate_amount  = $this->request->getData('detailed_estimate_amount');
			

            $subdetailTable->save($project);
            $this->Flash->success(__('The Detailed Estimate uploaded Successfully.'));			
   		    return $this->redirect(['action' => 'technicalsanction/' . $id . '/' . $pid . '/' . $work_id]);
			 
        }

        $this->set(compact(
            'projectWork',
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
            'projectWorkSubdetail','projectwiseDevelopmentWork'
        ));
    }  

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
    $this->loadModel('TechnicalSanctions');
    $user = $this->request->getAttribute('identity');
	$role_id     = $user->role_id;
    $division_id = $user->division_id;
	
     $projectwiseDevelopmentWork        = $this->ProjectwiseDevelopmentWorks->find('all')->where(['ProjectwiseDevelopmentWorks.id' => $id])->first();

	 $projectWorkSubdetail  = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id'=>$work_id])->first();
	 $abstractcount   = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$pid,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id,'ProjectwiseAbstractDetails.projectwise_development_work_id'=>$id])->count();
	 //print_r($abstractcount); exit();
	 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$pid,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id,'ProjectwiseAbstractDetails.projectwise_development_work_id'=>$id])->first();
	 if($abstractcount != 0){
	 
	   $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['BuildingItems','Units'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
	   $subabstractcount = $this->ProjectwiseAbstractSubdetails->find('all')->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->count();
	  }
	  
	
	    $connection               = ConnectionManager::get('default');
        $query                    =  "SELECT sum(projectsub.amount) as total_amount
                                     from projectwise_abstract_subdetails as projectsub
                                     LEFT JOIN projectwise_abstract_details as project on project.id = projectsub.projectwise_abstract_detail_id
                                     where project.project_work_id = '".$pid."' AND project.project_work_subdetail_id = '".$work_id."' and project.projectwise_development_work_id = '".$id."'  and projectsub.is_active = 1";
									 
       $Totalamount             = $connection->execute($query)->fetchAll('assoc');
	   
	  // print_r($Totalamount); exit();
	   
	   $tot_amount =  $Totalamount[0]['total_amount'];
	       $technical       = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id, 'TechnicalSanctions.projectwise_development_work_id' => $id])->first();

	  
    if ($this->request->is(['patch', 'post', 'put'])) {
		 //echo "<pre>";  print_r($this->request->getData()); exit();
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
					 $newfile                                  = "dev_Technicalsaction_" . $current_time . "." . $fileExt;
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
             $technicalSanction->projectwise_development_work_id = $id;
		     $technicalSanction->sanction_no               = $this->request->getData('sanction_no');
             $technicalSanction->sanctioned_date            = date('Y-m-d', strtotime($this->request->getData('sanctioned_date')));
             $technicalSanction->description               = $this->request->getData('description');
             $technicalSanction->amount                    = $this->request->getData('amount');
             $technicalSanction->created_by                = $user->id;
             $technicalSanction->created_date              = date('Y-m-d H:i:s');
         
             if($this->TechnicalSanctions->save($technicalSanction)){				 
	  
			        $subdetailTable                           = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                                  = $subdetailTable->get($projectWorkSubdetail['id']); 
					$project->sanctioned_amount               = $this->request->getData('amount');					
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
        $abstractdetail->projectwise_development_work_id       = $id;
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
                $abstractsubdetail->item_description    = ($answer['item_description'] != '')?$answer['item_description']:$answer['item_description1'];
                $abstractsubdetail->quantity            = $answer['quantity'];
                $abstractsubdetail->unit_id             = $answer['unit_id'];
                $abstractsubdetail->rate                = $answer['rate'];
                $abstractsubdetail->amount              = ($answer['amount'] != 0)?$answer['amount']:'';
                $abstractsubdetail->created_by          = $user->id;
                $abstractsubdetail->created_date        = date('Y-m-d H:i:s');				
                $this->ProjectwiseAbstractSubdetails->save($abstractsubdetail);  
            }

               $this->Flash->success(__('The project Abstract detail has been saved.'));
            return $this->redirect(['action' => 'technicalsanction/' . $id . '/' . $pid . '/' . $work_id]);

        }
        $this->Flash->error(__('The project Abstract detail could not be saved. Please, try again.'));
		
		}
		 }
	
     //print_r($entered_id); exit();
	 if($abstractcount == 0 || $subabstractcount == 0){
      $buildingItems     = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->all();
     }else if($abstractcount != 0 && $subabstractcount > 0){
	  $entered_id     = $this->ProjectwiseAbstractSubdetails->find('list',['keyField' => 'building_item_id','valueField' =>'building_item_id'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1,'ProjectwiseAbstractSubdetails.building_item_id !='=>0])->toArray();
      if(count($entered_id) != 0){
	  $buildingItems  = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->where(['BuildingItems.id NOT IN'=>$entered_id])->all();
	  }else{
		        $buildingItems     = $this->BuildingItems->find('list',  ['keyField' => 'id', 'valueField' => 'item_code'])->all();

		  
	     }  
	  }
	  $units = $this->Units->find('list', ['limit' => 200])->all();

	$this->set(compact('technical','projectwiseDevelopmentWork','subabstractcount','tot_amount','units','projectDevelopmentWorkDetail', 'projectWorks','buildingItems','projectWorkSubdetails', 'developmentWorks','id','pid','work_id','abstract_subdetails','detailed_approval_stages_count','detailed_approval_stages','abstractcount','projectWorkSubdetail'));
    
	  
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
    $projectwiseDevelopmentWork        = $this->ProjectwiseDevelopmentWorks->find('all')->where(['ProjectwiseDevelopmentWorks.id' => $id])->first();
		
    $technical       = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id, 'TechnicalSanctions.projectwise_development_work_id' => $id])->first();

    $tenders = $this->ProjectTenderDetails->find('all')->where(['ProjectTenderDetails.project_work_id' => $pid, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id, 'ProjectTenderDetails.projectwise_development_work_id' => $id])->first();

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
                $newfile                                =  "dev_tender_copy_" . $current_time . "." . $fileExt;
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
        $projectTenderDetail->projectwise_development_work_id  = $id;
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
			// if ($tenders['id'] == '') {
			// $subdetailTable                     = $this->getTableLocator()->get('ProjectWorkSubdetails');
            // $project                            = $subdetailTable->get($work_id);
            // $project->project_work_status_id    = 9;
            // $project->tender_detail_flag        = 1;
			// $subdetailTable->save($project);
			// }
            $this->Flash->success(__('The Tender Details has been saved.'));
            return $this->redirect(['action' => 'contractors/' . $id . '/' . $pid . '/' . $work_id]);
        }
    }

    $tender_type = $this->ProjectTenderDetails->TenderTypes->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['TenderTypes.is_active' => 1])->toArray();
    $this->set(compact(
        'projectTenderDetail',
        'tender_type',
        'projectWork',
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
        'work_id','projectwiseDevelopmentWork'
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
       $projectwiseDevelopmentWork        = $this->ProjectwiseDevelopmentWorks->find('all')->where(['ProjectwiseDevelopmentWorks.id' => $id])->first();


        $tender = $this->ProjectTenderDetails->find('all')->where(['ProjectTenderDetails.project_work_id' => $pid, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id, 'ProjectTenderDetails.projectwise_development_work_id' => $id])->first();
        // echo "<pre>"; print_r($tender); exit();
        $tender_amount = $tender['tender_amount'];

        $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id, 'TechnicalSanctions.projectwise_development_work_id' => $id])->count();
        $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id, 'TechnicalSanctions.projectwise_development_work_id' => $id])->first();

        $contractor_details          = $this->ContractorDetails->find('all')->contain(['Contractors'])->where(['ContractorDetails.project_work_id' => $pid, 'ContractorDetails.project_work_subdetail_id' => $work_id, 'ContractorDetails.projectwise_development_work_id' => $id,'ContractorDetails.is_active'=>1])->first(); //tender key

  

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
            $contractorDetail->projectwise_development_work_id     = $id;
            $contractorDetail->project_tender_detail_id      = $tender['id'];
            $contractorDetail->contractor_id                 = $this->request->getData('contractor_id');
            $contractorDetail->agreement_no                  = $this->request->getData('agreement_no');
            $contractorDetail->agreement_amount              = $this->request->getData('agreement_amount');
            $contractorDetail->work_order_refno              = $this->request->getData('work_order_refno');
            $contractorDetail->agreement_date            =  date('Y-m-d', strtotime($this->request->getData('agreement_date')));
            // $contractorDetail->agreement_todate              =  date('Y-m-d', strtotime($this->request->getData('agreement_todate')));
            $contractorDetail->agreement_period              =  $this->request->getData('agreement_period');
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
                    $newfile                                = "dev_agreement_copy_" . $current_time . "." . $fileExt;
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
                    $newfile                                = "dev_work_order_copy_" . $current_time . "." . $fileExt;
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
                return $this->redirect(['action' => 'sitehandover/' . $id . '/' . $pid . '/' . $work_id]);
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
            'tender_amount','projectwiseDevelopmentWork'
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
		// $oldProjectWorkDetail        = $this->OldProjectWorkDetails->find('all')->where(['OldProjectWorkDetails.id' => $id])->first();
  	    // $work_type = $oldProjectWorkDetail['work_type'];
		
	   $projectwiseDevelopmentWork        = $this->ProjectwiseDevelopmentWorks->find('all')->where(['ProjectwiseDevelopmentWorks.id' => $id])->first();

		
	   $projectWorkSubdetail  = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions','Circles'])->where(['ProjectWorkSubdetails.id'=>$work_id])->first();

        $tender = $this->ProjectTenderDetails->find('all')->where(['ProjectTenderDetails.project_work_id' => $pid, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id, 'ProjectTenderDetails.projectwise_development_work_id' => $id])->first();
        // echo "<pre>"; print_r($tender); exit();
        $tender_amount = $tender['tender_amount'];
        //$administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $pid])->first();

        $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id, 'TechnicalSanctions.projectwise_development_work_id' => $id])->count();
        $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $pid, 'TechnicalSanctions.project_work_subdetail_id' => $work_id, 'TechnicalSanctions.projectwise_development_work_id' => $id])->first();

        $contractor_details          = $this->ContractorDetails->find('all')->contain(['Contractors'])->where(['ContractorDetails.project_work_id' => $pid, 'ContractorDetails.project_work_subdetail_id' => $work_id, 'ContractorDetails.projectwise_development_work_id' => $id,'ContractorDetails.is_active'=>1])->first(); //tender key
        $contractor_detailcount      = $this->ContractorDetails->find('all')->contain(['Contractors'])->where(['ContractorDetails.project_work_id' => $pid, 'ContractorDetails.project_work_subdetail_id' => $work_id, 'ContractorDetails.projectwise_development_work_id' => $id,'ContractorDetails.is_active'=>1])->count(); 

     $abstractcount = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$pid,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id, 'ProjectwiseAbstractDetails.projectwise_development_work_id' => $id])->count();
	 $abstract_detail = $this->ProjectwiseAbstractDetails->find('all')->where(['ProjectwiseAbstractDetails.project_work_id'=>$pid,'ProjectwiseAbstractDetails.project_work_subdetail_id'=>$work_id, 'ProjectwiseAbstractDetails.projectwise_development_work_id' => $id])->first();
	 if($abstractcount > 0){
	 $abstract_subdetails = $this->ProjectwiseAbstractSubdetails->find('all')->contain(['BuildingItems','Units'])->where(['ProjectwiseAbstractSubdetails.projectwise_abstract_detail_id'=>$abstract_detail['id'],'ProjectwiseAbstractSubdetails.is_active'=>1])->order('ProjectwiseAbstractSubdetails.id ASC')->toArray();
	   $contractoratedetails = array();
	   $contractorcount = array();
	    foreach($abstract_subdetails as $subdetail){
    	$contractorcount[$subdetail['id']] = $this->ProjectwiseContractorRateDetails->find('all')->where(['ProjectwiseContractorRateDetails.projectwise_abstract_subdetail_id'=>$subdetail['id'], 'ProjectwiseContractorRateDetails.projectwise_development_work_id' => $id])->count();
    	if($contractorcount[$subdetail['id']] != 0){
 		$contractoratedetails[$subdetail['id']] = $this->ProjectwiseContractorRateDetails->find('all')->where(['ProjectwiseContractorRateDetails.projectwise_abstract_subdetail_id'=>$subdetail['id'], 'ProjectwiseContractorRateDetails.projectwise_development_work_id' => $id])->first();
		 }	  
	   } 	  
	  } 
        if ($this->request->is(['patch', 'post', 'put'])) { //echo"<pre>"; print_r($this->request->getData());  exit();
				 	  
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
					$contractor_rate->projectwise_development_work_id    = $id;
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
					 return $this->redirect(['action' => 'add/' . $pid . '/' . $work_id]);		
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
            'tender_amount','projectwiseDevelopmentWork','contractor_detailcount','contractoratedetails','contractorcount'
        ));
    }
	
	public function contractorfinalsubmit()
    {
		if ($this->request->is(['patch', 'post', 'put'])) { //echo"<pre>"; print_r($this->request->getData());  exit();  
		    $pid     = $this->request->getData('pid');
		    $work_id = $this->request->getData('work_id');
		    $id      = $this->request->getData('id');
			
			$subdetailTable                 = $this->getTableLocator()->get('ProjectwiseDevelopmentWorks');
			$project                        = $subdetailTable->get($id);
			$project->contractor_final_submit      = 1;
			$subdetailTable->save($project);		
		   if($this->request->getData('type1') == 2){
				$this->Flash->success(__('The Contractor Rate has been saved.'));
				 return $this->redirect(['action' => 'add/' . $pid . '/' . $work_id]);
			}		
		}
	}
	

    public function sitehandover($id = null,  $pid = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->loadModel('ProjectWorks');
        $this->loadModel('ProjectwiseDevelopmentWorks');
     	
	  $projectwiseDevelopmentWork        = $this->ProjectwiseDevelopmentWorks->find('all')->where(['ProjectwiseDevelopmentWorks.id' => $id])->first();
		
		  if ($this->request->is(['patch', 'post', 'put'])){		
	

            if ($this->request->getData('site_handover_date') != '') {
                $subdetailTable                  = $this->getTableLocator()->get('ProjectwiseDevelopmentWorks');
                $project                         = $subdetailTable->get($id);
                $project->site_handover_flag     = 1;
                $project->site_handover_date          = date('Y-m-d', strtotime($this->request->getData('site_handover_date')));
                $project->tentative_completion_date   = date('Y-m-d', strtotime($this->request->getData('tentative_completion_date')));
                $project->site_handover_remarks  = $this->request->getData('site_handover_remarks');
				
                $subdetailTable->save($project);

                $this->Flash->success(__('The project Site H/O Details has been saved.'));
				//if($work_type == 1){
				   return $this->redirect(['action' => 'add/' . $pid . '/' . $work_id]);

				// }else{
                // return $this->redirect(['action' => 'specialrepairlist']);
				// }
            }
        }

        $this->set(compact(
            'projectTenderDetail',
            'projectWork',
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
            'technical','projectwiseDevelopmentWork'
        ));
    }	
	

}
