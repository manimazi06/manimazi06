<?php

declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Locator\LocatorAwareTrait;


class ProjectHandoverDetailsController extends AppController
{
   
   /* public function index()
    {

        $this->viewBuilder()->setLayout('layout');


        $handoverdetails_count  = $this->ProjectHandoverDetails->find('all')->count();

        $projectHandoverDetails = $this->ProjectHandoverDetails->find('all')->where(['ProjectHandoverDetails.is_active' => 1])->toArray();
        $this->set(compact('projectHandoverDetails', 'projectWork', 'projectWorkSubdetail'));
    }*/
  
    public function view($id = null)
    {
        $projectHandoverDetail = $this->ProjectHandoverDetails->get($id, [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails'],
        ]);

        $this->set(compact('projectHandoverDetail'));
    }  
   
   /* public function projecthandoverdetails($id = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->=$this->fetchTable('ProjectWorks');
        $this->=$this->fetchTable('ProjectAdministrativeSanctions');
        $this->=$this->fetchTable('ProjectWorkSubdetails');
        $this->=$this->fetchTable('ProjectFinancialSanctions');
        $this->=$this->fetchTable('ProjectTenderDetails');
        $this->=$this->fetchTable('ProjectHandoverDetails');
        $this->=$this->fetchTable('TechnicalSanctions');
        // $this->=$this->fetchTable('TenderTypes');

        $projectWork = $this->ProjectWorks->get($id, [
            'contain' => ['Departments', 'FinancialYears', 'BuildingTypes', 'ProjectStatuses', 'Districts', 'Divisions', 'SchemeTypes'],
        ]);

        $projectHandoverDetail = $this->ProjectHandoverDetails->newEmptyEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            // echo '<pre>';
            // print_r($this->request->getData());
            // exit();
            $projectHandoverDetail->project_work_id            = $id;
            $projectHandoverDetail->project_work_subdetail_id  = $work_id;
            $projectHandoverDetail->handover_date              = date('Y-m-d', strtotime($this->request->getData('handover_date')));
            $projectHandoverDetail->remarks                    = $this->request->getData('remarks');
            $projectHandoverDetail->created_by                 = $user->id;
            $projectHandoverDetail->created_date               = date('Y-m-d H:i:s');


            $copy               = $this->request->getData('file_upload');

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
                    $newfile                                =  "file_upload_" . $current_time . "." . $fileExt;
                    $tempFile                               =  $tmpName;
                    $targetPath                             =  'uploads/ProjectHandover/';
                    $targetFile                             =  $targetPath . $newfile;
                    $projectHandoverDetail->file_upload       =  $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            }
            // echo '<pre>';
            // print_r($projectHandoverDetail);
            // exit();
            if ($this->ProjectHandoverDetails->save($projectHandoverDetail)) {
                $this->Flash->success(__('The projectHandoverDetail has been saved.'));
				$subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
				$project                        = $subdetailTable->get($work_id); 
				$project->project_work_status_id       = 16;							
				$subdetailTable->save($project);	  
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/9']);
            } else {
                $this->Flash->error(__('The projectHandoverDetail could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('projectWork', 'projectHandoverDetail', 'handoverdetails_count', 'handoverdetails', 'handoverdetail', 'tender_type', 'projectWork', 'tenders', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'contractor_detail_count', 'contractor_details', 'technicalcount', 'technical'));
    }   
  
    public function projecthandoverdetailsedit($id = null,$work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		
		$handover = $this->ProjectHandoverDetails->find('all')->where(['ProjectHandoverDetails.project_work_id'=>$id,'ProjectHandoverDetails.project_work_subdetail_id'=>$work_id])->first();
        $handover_id = $handover['id'];
       

		
        $projectHandoverDetail = $this->ProjectHandoverDetails->get($handover_id, [
            'contain' => [],
        ]);



        if ($this->request->is(['patch', 'post', 'put'])) {

            $projectHandoverDetail->project_work_id            = $id;
            $projectHandoverDetail->project_work_subdetail_id  = $work_id;      
            $projectHandoverDetail->handover_date              =  date('Y-m-d', strtotime($this->request->getData('handover_date')));
            $projectHandoverDetail->remarks                    =  $this->request->getData('remarks');
            $projectHandoverDetail->modified_by                 =  $user->id;
            $projectHandoverDetail->modified_date               =  date('Y-m-d H:i:s');
            $copy               = $this->request->getData('file_upload');

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
                    $newfile                                =  "file_upload_" . $current_time . "." . $fileExt;
                    $tempFile                               =  $tmpName;
                    $targetPath                             =  'uploads/ProjectHandover/';
                    $targetFile                             =  $targetPath . $newfile;
                    $projectHandoverDetail->file_upload       =  $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            } else {
                $projectHandoverDetail->file_upload = $this->request->getData('file_upload1');
            }
             if ($this->ProjectHandoverDetails->save($projectHandoverDetail)) {
                $this->Flash->success(__('The projectHandoverDetail has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks','action' => 'projectlist/9']);
            } else {
                $this->Flash->error(__('The projectHandoverDetail could not be saved. Please, try again.'));
            }
        }
        $projectWorks = $this->ProjectHandoverDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $projectWorkSubdetails = $this->ProjectHandoverDetails->ProjectWorkSubdetails->find('list', ['limit' => 200])->all();
        $this->set(compact('projectHandoverDetail', 'projectWorks', 'projectWorkSubdetails'));
    } */


       public function projecthandoverdetails($id = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->ProjectWorks=$this->fetchTable('ProjectWorks');
        $this->ProjectAdministrativeSanctions=$this->fetchTable('ProjectAdministrativeSanctions');
        $this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
        $this->ProjectFinancialSanctions=$this->fetchTable('ProjectFinancialSanctions');
        $this->ProjectTenderDetails=$this->fetchTable('ProjectTenderDetails');
        $this->ProjectHandoverDetails=$this->fetchTable('ProjectHandoverDetails');
        $this->TechnicalSanctions=$this->fetchTable('TechnicalSanctions');
        $this->Notifications=$this->fetchTable('Notifications');
        $this->Users=$this->fetchTable('Users');
        // $this->=$this->fetchTable('TenderTypes');
		
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
	    $projectWorkSubdetail  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id])->first();


        $projectHandoverDetail = $this->ProjectHandoverDetails->newEmptyEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectHandoverDetail->project_work_id            = $id;
            $projectHandoverDetail->project_work_subdetail_id  = $work_id;
            $projectHandoverDetail->handover_date              = date('Y-m-d', strtotime($this->request->getData('handover_date')));
            $projectHandoverDetail->inauguration_date          = date('Y-m-d', strtotime($this->request->getData('inauguration_date')));
            $projectHandoverDetail->remarks                    = $this->request->getData('remarks');
            $projectHandoverDetail->created_by                 = $user->id;
            $projectHandoverDetail->created_date               = date('Y-m-d H:i:s');
            $copy                   = $this->request->getData('photo_upload');
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
                    $newfile                                =  "photo_upload_" . $current_time . "." . $fileExt;
                    $tempFile                               =  $tmpName;
                    $targetPath                             =  'uploads/ProjectHandover/';
                    $targetFile                             =  $targetPath . $newfile;
                    $projectHandoverDetail->photo_upload       =  $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            }
                    
            $drawing_file           = $this->request->getData('execution_drawing_file');

            if ($drawing_file->getClientFilename() != '') {

                $name    = $drawing_file->getClientFilename();
                $type    = $drawing_file->getClientMediaType();
                $size    = $drawing_file->getSize();
                $tmpName = $drawing_file->getStream()->getMetadata('uri');
                $error   = $drawing_file->getError();

                if ($name != '' && $error == 0) {
                    $file                                   =  $name;
                    $array                                  =  explode('.', $file);
                    $fileExt                                =  $array[count($array) - 1];
                    $current_time                           =  date('Y_m_d_H_i_s');
                    $newfile                                =  "drawing_file_" . $current_time . "." . $fileExt;
                    $tempFile                               =  $tmpName;
                    $targetPath                             =  'uploads/DrawingFile/';
                    $targetFile                             =  $targetPath . $newfile;
                    $projectHandoverDetail->execution_drawing_file       =  $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            }

            if ($this->ProjectHandoverDetails->save($projectHandoverDetail)) {
                $this->Flash->success(__('The projectHandoverDetail has been saved.'));
				$subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
				$project                        = $subdetailTable->get($work_id); 
				$project->project_work_status_id       = 16;							
				$subdetailTable->save($project);

                $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>13])->count();
			   if($notification_count == 1){   
					$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>13])->first();
					$notificationTable                   = $this->getTableLocator()->get('Notifications');
					$notification1                       = $notificationTable->get($notification_id['id']); 
					$notification1->notification_seen	 = 1;  
					$notification1->process_done	     = 1;  
					$notificationTable->save($notification1);		

					$recipient_user    = $this->Users->find('all')->where(['Users.role_id'=>13,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
					$recipient_user_id = $recipient_user['id'];
					$notification      = $this->Notifications->newEmptyEntity();					
					$notification->forwarded_date                    = date('Y-m-d');
					$notification->forward_user_id                   = $user->id;
					$notification->recipient_user_id                 = $recipient_user_id; 
					$notification->notification_type_id              = 14; 
					$notification->project_work_id                   = $id;
					$notification->project_work_subdetail_id         = $work_id;
					if($projectWorkSubdetail['work_type'] == 2){
						$notification->work_type                     = 2;								
					}
					$notification->created_by                        = $user->id;
					$notification->created_date                      = date('Y-m-d H:i:s');				
					$this->Notifications->save($notification);   	
			   }
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/9']);
            } else {
                $this->Flash->error(__('The projectHandoverDetail could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('projectWork', 'projectHandoverDetail', 'handoverdetails_count', 'handoverdetails', 'handoverdetail', 'tender_type', 'projectWork', 'tenders', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'contractor_detail_count', 'contractor_details', 'technicalcount', 'technical'));
    }   
  


    public function projecthandoverdetailsedit($id = null,$work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		
		$handover = $this->ProjectHandoverDetails->find('all')->where(['ProjectHandoverDetails.project_work_id'=>$id,'ProjectHandoverDetails.project_work_subdetail_id'=>$work_id])->first();
        $handover_id = $handover['id'];
       

		
        $projectHandoverDetail = $this->ProjectHandoverDetails->get($handover_id, [
            'contain' => [],
        ]);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
        //    echo"<pre>";print_r($_POST);exit();
            $projectHandoverDetail->project_work_id            = $id;
            $projectHandoverDetail->project_work_subdetail_id  = $work_id;      
            $projectHandoverDetail->handover_date              = date('Y-m-d', strtotime($this->request->getData('handover_date')));
            $projectHandoverDetail->inauguration_date          = date('Y-m-d', strtotime($this->request->getData('inauguration_date')));
            $projectHandoverDetail->remarks                    = $this->request->getData('remarks');
            $projectHandoverDetail->modified_by                = $user->id;
            $projectHandoverDetail->modified_date              = date('Y-m-d H:i:s');

            $copy               = $this->request->getData('photo_upload');
            $drawing_file       = $this->request->getData('execution_drawing_file');

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
                    $newfile                                =  "photo_upload_" . $current_time . "." . $fileExt;
                    $tempFile                               =  $tmpName;
                    $targetPath                             =  'uploads/ProjectHandover/';
                    $targetFile                             =  $targetPath . $newfile;
                    $projectHandoverDetail->photo_upload    =  $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
              } else {
                $projectHandoverDetail->photo_upload = $this->request->getData('photo_upload1');
              }

            if ($drawing_file->getClientFilename() != '') {

                $name    = $drawing_file->getClientFilename();
                $type    = $drawing_file->getClientMediaType();
                $size    = $drawing_file->getSize();
                $tmpName = $drawing_file->getStream()->getMetadata('uri');
                $error   = $drawing_file->getError();

                if ($name != '' && $error == 0) {
                    $file                                   =  $name;
                    $array                                  =  explode('.', $file);
                    $fileExt                                =  $array[count($array) - 1];
                    $current_time                           =  date('Y_m_d_H_i_s');
                    $newfile                                =  "drawing_file_" . $current_time . "." . $fileExt;
                    $tempFile                               =  $tmpName;
                    $targetPath                             =  'uploads/DrawingFile/';
                    $targetFile                             =  $targetPath . $newfile;
                    $projectHandoverDetail->execution_drawing_file     =  $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
              } else {
                $projectHandoverDetail->execution_drawing_file = $this->request->getData('execution_drawing_file1');
              }
   
             if ($this->ProjectHandoverDetails->save($projectHandoverDetail)) {
                $this->Flash->success(__('The projectHandoverDetail has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks','action' => 'projectlist/9']);
            } else {
                $this->Flash->error(__('The projectHandoverDetail could not be saved. Please, try again.'));
            }
        }
        $projectWorks = $this->ProjectHandoverDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $projectWorkSubdetails = $this->ProjectHandoverDetails->ProjectWorkSubdetails->find('list', ['limit' => 200])->all();
        $this->set(compact('projectHandoverDetail', 'projectWorks', 'projectWorkSubdetails'));
    }   


	
}