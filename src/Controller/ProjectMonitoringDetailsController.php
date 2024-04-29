<?php
declare(strict_types=1);
namespace App\Controller;


class ProjectMonitoringDetailsController extends AppController
{		
	/*public function projectmonitoring($id = null, $work_id = null)
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
        $this->loadModel('WorkPercentages');
        $this->loadModel('ProjectMonitoringPhotosUploads');
        $this->loadModel('ProjectMonitoringDetails');
        $this->loadModel('FinancialPercentages');
		
		$projectWorkSubdetailcount   = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.work_type'=>1])->count();
		if($projectWorkSubdetailcount > 0){

        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions', 'SchemeTypes'],
        ]);
		}else {
			 $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears','ProjectStatuses', 'Districts', 'Divisions'],
        ]);
			
		}

        $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
        $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
        $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
        $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
        $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();

        $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->count();
        $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();
        $tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks', 'ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id])->toArray();
        $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id])->count();
        $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id])->first(); //tender key

        $monitoringDetailscount = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->count();
        $monitorings            = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages','FinancialPercentages'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->toArray();
        
		
		//echo "<pre>"; print_r($monitorings);  exit();
        //if ($monitorings as $monitoring) {
        // foreach ($monitorings as $monitoring) {
            // $photo_uploads[$monitoring['id']]     = $this->ProjectMonitoringPhotosUploads->find('all')->where(['ProjectMonitoringPhotosUploads.project_monitoring_detail_id' => $monitoring['id']])->toArray();
        // }
        //}


        // if ($monitoringDetailscount == 0) {
        $projectMonitoringDetail = $this->ProjectMonitoringDetails->newEmptyEntity();
        // }

        if ($this->request->is((['patch', 'post', 'put']))) { //echo "<pre>"; print_r($this->request->getData()); exit();
			$moni_date = date('Y_m_d', strtotime($this->request->getData('monitoring_date')));
			 //echo "<pre>"; print_r($moni_date); exit();
			$attachment               =  $this->request->getData('photo_upload');
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
					$newfile                                   =  "projectmonitoring_".$moni_date."_" .$current_time.".". $fileExt;
					$tempFile                                  =  $tmpName;
					$targetPath                                =  'uploads/Projectmonitoring/';
					$targetFile                                =  $targetPath . $newfile;
					$projectMonitoringDetail->photo_upload   =   $newfile;
					move_uploaded_file($tempFile, $targetFile);
				}
			}
          
            $projectMonitoringDetail->project_work_id           = $id;
            $projectMonitoringDetail->project_work_subdetail_id = $work_id;
            $projectMonitoringDetail->monitoring_date             = date('Y-m-d', strtotime($this->request->getData('monitoring_date')));
           // $projectMonitoringDetail->work_stage_id               = $this->request->getData('work_stage_id');
            $projectMonitoringDetail->description                 = $this->request->getData('description');
            $projectMonitoringDetail->work_percentage_id          = $this->request->getData('work_percentage_id');
            $projectMonitoringDetail->financial_percentage_id     = $this->request->getData('financial_percentage_id');  
            $projectMonitoringDetail->created_by                  = $user->id;
            $projectMonitoringDetail->created_date                = date('Y-m-d H:i:s');
            //echo "<pre>"; print_r($projectMonitoringDetail); exit();
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
                            $newfile                                   =  "projectmonitoring_" . $key . "_" . $current_time . "." . $fileExt;
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
                    $projectMonitoringPhotosUpload->created_by                    = $user->id;
                    $projectMonitoringPhotosUpload->created_date                  = date('Y-m-d H:i:s');
                    $this->ProjectMonitoringPhotosUploads->save($projectMonitoringPhotosUpload);					
				                    
                }
				    $ProjectWorkssubdetailTable  = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$projectsubdetail            = $ProjectWorkssubdetailTable->get($work_id); 
					if(($this->request->getData('work_percentage_id') != 20) && ($this->request->getData('financial_percentage_id') != 20)){ 					 
					  $projectsubdetail->project_work_status_id      = 12;					
					}else if(($this->request->getData('work_percentage_id') == 20) && ($this->request->getData('financial_percentage_id') != 20)){
					  $projectsubdetail->project_work_status_id      = 13;						
					}else if(($this->request->getData('work_percentage_id') != 20) && ($this->request->getData('financial_percentage_id') == 20)){
					  $projectsubdetail->project_work_status_id      = 14;						
					}else if(($this->request->getData('work_percentage_id') == 20) && ($this->request->getData('financial_percentage_id') == 20)){
					  $projectsubdetail->project_work_status_id      = 15;	   					
					}
					
					$ProjectWorkssubdetailTable->save($projectsubdetail);
            }

            $this->Flash->success(__('The project monitoring detail has been saved.'));

            return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/7']);
        }
        $workStages = $this->WorkStages->find('list', ['limit' => 200])->all();
        
		
		if($monitoringDetailscount == 0){
		   $percentage          = $this->WorkPercentages->find('list')->all();  
		   $financialpercentage = $this->FinancialPercentages->find('list')->all();
		}else if($monitoringDetailscount > 0){		
			$entered_work_id    = $this->ProjectMonitoringDetails->find('list',['keyField' =>'work_percentage_id','valueField' =>'work_percentage_id'])->where(['ProjectMonitoringDetails.project_work_id'=>$id,'ProjectMonitoringDetails.project_work_subdetail_id'=>$work_id])->toArray();
			$entered_finance_id = $this->ProjectMonitoringDetails->find('list',['keyField' =>'financial_percentage_id','valueField' =>'financial_percentage_id'])->where(['ProjectMonitoringDetails.project_work_id'=>$id,'ProjectMonitoringDetails.project_work_subdetail_id'=>$work_id])->toArray();
           
		     if($entered_work_id){
		     $percentage          = $this->WorkPercentages->find('list')->where(['WorkPercentages.id NOT IN' =>$entered_work_id])->all();	
			 }
			 
		    if($entered_finance_id){			 
		     $financialpercentage = $this->FinancialPercentages->find('list')->where(['FinancialPercentages.id NOT IN' =>$entered_finance_id])->all();
			}
		}

        $this->set(compact('financialpercentage','percentage', 'projectMonitoringDetail', 'workStages', 'projectTenderDetail', 'projectWork', 'tenders', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'contractor_detail_count', 'contractor_details', 'technicalcount', 'technical', 'monitoring', 'monitoringDetailscount', 'photo_uploads', 'monitorings'));
    }*/
	
	public function projectmonitoring($id = null, $work_id = null)
	{

    $this->viewBuilder()->setLayout('layout');
    $user = $this->request->getAttribute('identity');
    $this->ProjectWorks=$this->fetchTable('ProjectWorks');
    $this->ProjectTimelineDetails=$this->fetchTable('ProjectTimelineDetails');
    $this->ProjectFinancialSanctions=$this->fetchTable('ProjectFinancialSanctions');
    $this->ProjectAdministrativeSanctions=$this->fetchTable('ProjectAdministrativeSanctions');
    $this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
    $this->TechnicalSanctions=$this->fetchTable('TechnicalSanctions');
    $this->ProjectTenderDetails=$this->fetchTable('ProjectTenderDetails');
    $this->ContractorDetails=$this->fetchTable('ContractorDetails');
    $this->WorkStages=$this->fetchTable('WorkStages');
    $this->WorkPercentages=$this->fetchTable('WorkPercentages');
    $this->ProjectMonitoringPhotosUploads=$this->fetchTable('ProjectMonitoringPhotosUploads');
    $this->ProjectMonitoringDetails=$this->fetchTable('ProjectMonitoringDetails');
    $this->FinancialPercentages=$this->fetchTable('FinancialPercentages');
    $this->Users=$this->fetchTable('Users');
    $this->Notifications=$this->fetchTable('Notifications');
	
	      $projectWork = $this->ProjectWorks->get($id, [
             'contain' => ['Departments', 'FinancialYears','ProjectStatuses', 'Districts', 'Divisions'],
            ]);	

         // $projectWorkSubdetailcount   = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.work_type'=>1])->count();
		// if($projectWorkSubdetailcount > 0){
			// $projectWork = $this->ProjectWorks->get($id, [
				// 'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions', 'SchemeTypes'],
			// ]);
		// }else{
					
		//}

    $administrativesanctioncount = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->count();
    $administrativesanction      = $this->ProjectAdministrativeSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectAdministrativeSanctions.project_work_id' => $id])->first();
    $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
    $financialSanctionscount     = $this->ProjectFinancialSanctions->find('all')->where(['project_work_id' => $id])->count();
    $financialSanctions          = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['project_work_id' => $id])->toArray();

    $technicalcount              = $this->TechnicalSanctions->find('all')->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->count();
    $technical                   = $this->TechnicalSanctions->find('all')->contain(['ProjectWorks'])->where(['TechnicalSanctions.project_work_id' => $id, 'TechnicalSanctions.project_work_subdetail_id' => $work_id])->first();
    $tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks', 'ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id])->toArray();
    $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id])->count();
    $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id])->first(); //tender key

    $monitoringDetailscount = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->count();
    $monitorings            = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages', 'FinancialPercentages'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->toArray();
    $photo_uploads = array();
	foreach($monitorings as $monitoring){
	 $photo_uploads[$monitoring['id']]      = $this->ProjectMonitoringPhotosUploads->find('all')->where(['ProjectMonitoringPhotosUploads.project_monitoring_detail_id' => $monitoring['id']])->toArray();

	}
    $projectMonitoringDetail = $this->ProjectMonitoringDetails->newEmptyEntity();
    if ($this->request->is((['patch', 'post', 'put']))) {
      // echo"<pre>";print_r($this->request->getData());exit();
        $moni_date = date('Y_m_d', strtotime($this->request->getData('monitoring_date')));
        $projectMonitoringDetail->project_work_id             = $id;
        $projectMonitoringDetail->project_work_subdetail_id   = $work_id;
        $projectMonitoringDetail->monitoring_date             = date('Y-m-d', strtotime($this->request->getData('monitoring_date')));
        $projectMonitoringDetail->description                 = $this->request->getData('description');
        $projectMonitoringDetail->work_percentage_id          = $this->request->getData('work_percentage_id');
        $projectMonitoringDetail->financial_percentage_id     = $this->request->getData('financial_percentage_id');
        $projectMonitoringDetail->file_type_id                = $this->request->getData('file_type_id');
        $projectMonitoringDetail->created_by                  = $user->id;
        $projectMonitoringDetail->created_date                = date('Y-m-d H:i:s');

        // echo"<pre>";print_r($projectMonitoringDetail);exit();

        if ($this->ProjectMonitoringDetails->save($projectMonitoringDetail)) {

            $insertid                              = $projectMonitoringDetail->id;
            if ($projectMonitoringDetail->file_type_id == 1) {
                $projectMonitoringPhotosUpload = $this->ProjectMonitoringPhotosUploads->newEmptyEntity();
                $attachment               =  $this->request->getData('photo_upload');
                if ($attachment->getClientFilename() != '') {

                    $name    = $attachment->getClientFilename();
                    $type    = $attachment->getClientMediaType();
                    $size    = $attachment->getSize();
                    $tmpName = $attachment->getStream()->getMetadata('uri');
                    $error   = $attachment->getError();

                    if ($name != '' && $error == 0) {
                        $file                                          =  $name;
                        $array                                         =  explode('.', $file);
                        $fileExt                                       =  $array[count($array) - 1];
                        $current_time                                  =  date('Y_m_d_H_i_s');
                        $newfile                                       =  "projectmonitoring_" . $moni_date . "_" . $current_time . "." . $fileExt;
                        $tempFile                                      =  $tmpName;
                        $targetPath                                    =  'uploads/Projectmonitoring/';
                        $targetFile                                    =  $targetPath . $newfile;
                        $projectMonitoringPhotosUpload->file_upload    =   $newfile;
                        move_uploaded_file($tempFile, $targetFile);
                        $projectMonitoringPhotosUpload->created_by      = $user->id;
                        $projectMonitoringPhotosUpload->created_date    = date('Y-m-d H:i:s');
                        $projectMonitoringPhotosUpload->project_monitoring_detail_id    = $insertid;

                        if ($this->ProjectMonitoringPhotosUploads->save($projectMonitoringPhotosUpload)) {
                        // echo"<pre>";print_r($projectMonitoringPhotosUpload);exit();

                            $this->Flash->success(__('The ProjectMonitoringPhotosUpload has been saved.'));
                            return $this->redirect(['controller' => 'project-works', 'action' => 'projectlist/7']);

                        } else {
                            $this->Flash->error(__('The projectMonitoringPhotosUpload could not be saved. Please, try again.'));
                        }
                    }
                }
            } else {
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
                            $newfile                                   =  "projectmonitoring_" . $key . "_" . $current_time . "." . $fileExt;
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
                    $projectMonitoringPhotosUpload->created_by                    = $user->id;
                    $projectMonitoringPhotosUpload->created_date                  = date('Y-m-d H:i:s');
                    $this->ProjectMonitoringPhotosUploads->save($projectMonitoringPhotosUpload);
                }
            }
            $ProjectWorkssubdetailTable  = $this->getTableLocator()->get('ProjectWorkSubdetails');
            $projectsubdetail            = $ProjectWorkssubdetailTable->get($work_id);
            if (($this->request->getData('work_percentage_id') != 20) && ($this->request->getData('financial_percentage_id') != 20)) {  
                $projectsubdetail->project_work_status_id      = 12;
            } else if (($this->request->getData('work_percentage_id') == 20) && ($this->request->getData('financial_percentage_id') != 20)) {
                $projectsubdetail->project_work_status_id      = 13;
            } else if (($this->request->getData('work_percentage_id') != 20) && ($this->request->getData('financial_percentage_id') == 20)) {
                $projectsubdetail->project_work_status_id      = 14;
            } else if (($this->request->getData('work_percentage_id') == 20) && ($this->request->getData('financial_percentage_id') == 20)) {
                $projectsubdetail->project_work_status_id      = 15;
				          
						  
						  /*$recipient_user    = $this->Users->find('all')->where(['Users.role_id'=>13,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
							$recipient_user_id = $recipient_user['id'];
							$notification      = $this->Notifications->newEmptyEntity();					
							$notification->forwarded_date                    = date('Y-m-d');
							$notification->forward_user_id                   = $user->id;
							$notification->recipient_user_id                 = $recipient_user_id; 
							$notification->notification_type_id              = 13; 
							$notification->project_work_id                   = $id;
							$notification->project_work_subdetail_id         = $work_id;
							if($projectWorkSubdetail['work_type'] == 2){
								$notification->wort_type                     = 2;								
							}
							$notification->created_by                        = $user->id;
							$notification->created_date                      = date('Y-m-d H:i:s');				
							$this->Notifications->save($notification); */ 
            }
            $ProjectWorkssubdetailTable->save($projectsubdetail);
        }

        $this->Flash->success(__('The project monitoring detail has been saved.'));
        return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/7']);
    }
    $workStages = $this->WorkStages->find('list', ['limit' => 200])->all();


    if ($monitoringDetailscount == 0) {
        $percentage          = $this->WorkPercentages->find('list')->all();
        $financialpercentage = $this->FinancialPercentages->find('list')->order(['order_flag ASC'])->toArray();
    } else if ($monitoringDetailscount > 0) {
        $entered_work_id    = $this->ProjectMonitoringDetails->find('list', ['keyField' => 'work_percentage_id', 'valueField' => 'work_percentage_id'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->toArray();
        $entered_finance_id = $this->ProjectMonitoringDetails->find('list', ['keyField' => 'financial_percentage_id', 'valueField' => 'financial_percentage_id'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->toArray();

        if ($entered_work_id) {
            $percentage          = $this->WorkPercentages->find('list')->where(['WorkPercentages.id NOT IN' => $entered_work_id])->all();
        }

        if ($entered_finance_id) {
            $financialpercentage = $this->FinancialPercentages->find('list')->where(['FinancialPercentages.id NOT IN' => $entered_finance_id])->order(['order_flag ASC'])->toArray();
        }
    }

    $file_type           = [1 => "Single Photo Upload", 2 => "Mutiple Photos Upload"];
    // echo"<pre>";print_r( $file_type );exit();
    $this->set(compact('financialpercentage', 'percentage', 'projectMonitoringDetail', 'workStages', 'projectTenderDetail', 'projectWork', 'tenders', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'contractor_detail_count', 'contractor_details', 'technicalcount', 'technical', 'monitoring', 'monitoringDetailscount', 'photo_uploads', 'monitorings', 'file_type'));
	}
	
   public function projectvideoupload($id = null, $work_id = null)
	{
    $this->viewBuilder()->setLayout('layout');
    $user = $this->request->getAttribute('identity');
    $this->ProjectWorks=$this->fetchTable('ProjectWorks');
    $this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
    $this->Users=$this->fetchTable('Users');
	
    $projectWork = $this->ProjectWorks->get($id, [
	 'contain' => ['Departments', 'FinancialYears','ProjectStatuses', 'Districts', 'Divisions'],
	]); 

     $projectWorkSubdetail        = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
    
    if ($this->request->is((['patch', 'post', 'put']))) { //echo "<pre>"; print_r($this->request->getData()); exit();		
		$attachment               =  $this->request->getData('video_upload');
		if ($attachment->getClientFilename() != '') {
			$name    = $attachment->getClientFilename();
			$type    = $attachment->getClientMediaType();
			$size    = $attachment->getSize();
			$tmpName = $attachment->getStream()->getMetadata('uri');
			$error   = $attachment->getError();

			if ($name != '' && $error == 0) {
				$file                                          = $name;
				$array                                         = explode('.', $file);
				$fileExt                                       = $array[count($array) - 1];
				$current_time                                  = date('Y_m_d_H_i_s');
				$newfile                                       = "projectvideo_" . $work_id . "_" . $current_time . "." . $fileExt;
				$tempFile                                      = $tmpName;
				$targetPath                                    = 'uploads/projectvideo/';
				$targetFile                                    = $targetPath . $newfile;
				//$projectMonitoringPhotosUpload->file_upload    = $newfile;
				move_uploaded_file($tempFile, $targetFile);
				$ProjectWorkssubdetailTable  = $this->getTableLocator()->get('ProjectWorkSubdetails');
                $projectsubdetail            = $ProjectWorkssubdetailTable->get($work_id);
                $projectsubdetail->video_flag                  = 1;
                $projectsubdetail->video_filepath              = $newfile;
                $projectsubdetail->video_date                  = date('Y-m-d');
				if ($ProjectWorkssubdetailTable->save($projectsubdetail)) {					
					 $this->Flash->success(__('The Video uploaded successfully.'));      
   
				} else {
					$this->Flash->error(__('The projectMonitoringPhotosUpload could not be saved. Please, try again.'));
				}
				
				return $this->redirect(['action' => 'projectvideoupload',$id,$work_id]);
			}
		}
    }
    $this->set(compact('projectWorkSubdetail', 'projectWork','id','work_id'));
	}
	
    public function projectmonitoringedit($id = null, $work_id = null, $monitoring_id)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->ProjectWorks=$this->fetchTable('ProjectWorks');
        $this->ProjectTimelineDetails=$this->fetchTable('ProjectTimelineDetails');
        $this->ProjectFinancialSanctions=$this->fetchTable('ProjectFinancialSanctions');
        $this->ProjectAdministrativeSanctions=$this->fetchTable('ProjectAdministrativeSanctions');
        $this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
        $this->TechnicalSanctions=$this->fetchTable('TechnicalSanctions');
        $this->ProjectTenderDetails=$this->fetchTable('ProjectTenderDetails');
        $this->ContractorDetails=$this->fetchTable('ContractorDetails');
        $this->WorkStages=$this->fetchTable('WorkStages');
        $this->WorkPercentages=$this->fetchTable('WorkPercentages');
        $this->ProjectMonitoringPhotosUploads=$this->fetchTable('ProjectMonitoringPhotosUploads');
        $this->ProjectMonitoringDetails=$this->fetchTable('ProjectMonitoringDetails');
        $this->FinancialPercentages=$this->fetchTable('FinancialPercentages');

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
        $tenders                     = $this->ProjectTenderDetails->find('all')->contain(['ProjectWorks', 'ProjectWorkSubdetails'])->where(['ProjectTenderDetails.project_work_id' => $id, 'ProjectTenderDetails.project_work_subdetail_id' => $work_id])->toArray();
        $contractor_detail_count     = $this->ContractorDetails->find('all')->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id])->count();
        $contractor_details          = $this->ContractorDetails->find('all')->contain(['ProjectWorks'])->where(['ContractorDetails.project_work_id' => $id, 'ContractorDetails.project_work_subdetail_id' => $work_id])->first(); //tender key


        $monitoringDetailscount = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->count();
        $monitoring      = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->first();
        $monitorings      = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages','FinancialPercentages'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->toArray();

        if (isset($monitoring)) {
            $photo_uploads      = $this->ProjectMonitoringPhotosUploads->find('all')->where(['ProjectMonitoringPhotosUploads.project_monitoring_detail_id' => $monitoring['id']])->toArray();
        }

        if ($this->request->is((['patch', 'post', 'put']))) {
        
            $projectMonitoringDetail = $this->ProjectMonitoringDetails->get($monitoring_id, [
                'contain' => [],
            ]);

            $projectMonitoringDetail->project_work_id           = $id;
            $projectMonitoringDetail->project_work_subdetail_id = $work_id;

            $projectMonitoringDetail->monitoring_date              = date('Y-m-d', strtotime($this->request->getData('monitoring_date')));

            $projectMonitoringDetail->work_stage_id               = $this->request->getData('work_stage_id');
            $projectMonitoringDetail->work_percentage_id            = $this->request->getData('work_percentage_id');
			$projectMonitoringDetail->financial_percentage_id     = $this->request->getData('financial_percentage_id');  
            $projectMonitoringDetail->created_by                = $user->id;
            $projectMonitoringDetail->created_date              = date('Y-m-d H:i:s');
            if ($this->ProjectMonitoringDetails->save($projectMonitoringDetail)) {
                $insertid                              = $projectMonitoringDetail->id;

                foreach ($this->request->getData('monitoring') as $key => $value) {
                    if ($value['id'] == '') {
                        $projectMonitoringPhotosUpload = $this->ProjectMonitoringPhotosUploads->newEmptyEntity();
                    } else if ($value['id'] != '') {

                        $projectMonitoringPhotosUpload = $this->ProjectMonitoringPhotosUploads->get($value['id'], []);
                    }

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
                            $newfile                                   =  "projectmonitoring_" . $key . "_" . $current_time . "." . $fileExt;
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

            return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/7']);
        }
        $workStages          = $this->WorkStages->find('list', ['limit' => 200])->all();
        $percentage          = $this->WorkPercentages->find('list')->all();
	    $financialpercentage = $this->FinancialPercentages->find('list')->all();   
		
        $this->set(compact('financialpercentage','percentage', 'projectMonitoringDetail', 'workStages', 'projectTenderDetail', 'projectWork', 'tenders', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'contractor_detail_count', 'contractor_details', 'technicalcount', 'technical', 'monitoring', 'monitoringDetailscount', 'photo_uploads', 'monitorings'));
    }  
	
    public function ajaxmonitor($i = null)
    {
        // $this->loadModel('WorkStages');
        // $this->loadModel('WorkPercentages');
        // $workStages = $this->WorkStages->find('list')->all();
        // $percentage = $this->WorkPercentages->find('list')->all();
        $this->set(compact('i'));
    }
	
	 public function ajaxphotoupload($id = null)
    {
        // echo"<pre>";print_r($id);exit();

        $this->ProjectMonitoringPhotosUploads=$this->fetchTable('ProjectMonitoringPhotosUploads');

        $photo_uploads      = $this->ProjectMonitoringPhotosUploads->find('all')->where(['ProjectMonitoringPhotosUploads.project_monitoring_detail_id' => $id])->toArray();

        // echo"<pre>";print_r($photo_uploads);exit();

        $this->set(compact('id', 'photo_uploads'));
    }
	
    // public function ajaxphotoupload($id = null)
    // {
        // $this->loadModel('ProjectMonitoringDetails');
        // $photo_uploads      = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.id' => $id])->toArray();
        // $this->set(compact('id', 'photo_uploads'));
    // } 
   
}