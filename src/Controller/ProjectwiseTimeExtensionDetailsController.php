<?php

declare(strict_types=1);

namespace App\Controller;

class ProjectwiseTimeExtensionDetailsController extends AppController
{

    public function index()
    {
        $this->viewBuilder()->setLayout('layout');

        $this->paginate = [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails'],
        ];
		
        $projectwiseTimeExtensionDetails = $this->paginate($this->ProjectwiseTimeExtensionDetails);

        $this->set(compact('projectwiseTimeExtensionDetails'));
    }


    public function view($pid = null, $work_id = null,$id = null)
    {
        $this->viewBuilder()->setLayout('layout');
		$this->ProjectwiseTimeExtensionFileUploads=$this->fetchTable('ProjectwiseTimeExtensionFileUploads');

        $projectwiseTimeExtensionDetail = $this->ProjectwiseTimeExtensionDetails->get($id, [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails'],
        ]);
        // $projectwiseTimeExtensionDetail  = $this->ProjectwiseTimeExtensionDetails->find('all')->where(['ProjectwiseTimeExtensionDetails.id' => $id,'ProjectwiseTimeExtensionDetails.project_work_id' => $pid, 'ProjectwiseTimeExtensionDetails.project_work_subdetail_id' => $work_id])->toArray();
          $projectwiseTimeExtensionFilecount       = $this->ProjectwiseTimeExtensionFileUploads->find('all')->where(['ProjectwiseTimeExtensionFileUploads.projectwise_time_extension_detail_id' => $id, 'ProjectwiseTimeExtensionFileUploads.is_active' => 1])->count();
          $projectwiseTimeExtensionFileUploads       = $this->ProjectwiseTimeExtensionFileUploads->find('all')->contain(['ProjectwiseTimeExtensionDetails'])->where(['ProjectwiseTimeExtensionFileUploads.projectwise_time_extension_detail_id' => $id, 'ProjectwiseTimeExtensionFileUploads.is_active' => 1])->toArray();

        $this->set(compact('projectwiseTimeExtensionDetail','projectwiseTimeExtensionFileUploads','projectwiseTimeExtensionFilecount'));
    }


    public function add($pid = null, $work_id = null)  
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		$this->Roles=$this->fetchTable('Roles');
		$this->ProjectwiseTimeExtensionFileUploads=$this->fetchTable('ProjectwiseTimeExtensionFileUploads');
		$this->Notifications=$this->fetchTable('Notifications');
		$this->Users=$this->fetchTable('Users');
		$this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
        $projectwiseTimeExtensionDetailcount = $this->ProjectwiseTimeExtensionDetails->find('all')->where(['ProjectwiseTimeExtensionDetails.project_work_id' => $pid, 'ProjectwiseTimeExtensionDetails.project_work_subdetail_id' => $work_id])->count();
        $projectwiseTimeExtensionDetailists  = $this->ProjectwiseTimeExtensionDetails->find('all')->where(['ProjectwiseTimeExtensionDetails.project_work_id' => $pid, 'ProjectwiseTimeExtensionDetails.project_work_subdetail_id' => $work_id])->toArray();
        $last_Time_extention  = $this->ProjectwiseTimeExtensionDetails->find('all')->where(['ProjectwiseTimeExtensionDetails.project_work_id' => $pid, 'ProjectwiseTimeExtensionDetails.project_work_subdetail_id' => $work_id])->last();
        $projectWorkSubdetail         = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $work_id,'ProjectWorkSubdetails.is_active'=>1])->first();

        //echo "<pre>";  print_r($projectwiseTimeExtensionDetailists);  exit();    
		$projectwiseTimeExtensionDetail = $this->ProjectwiseTimeExtensionDetails->newEmptyEntity();
        if ($this->request->is('post')) { //echo "<pre>";  print_r($this->request->getData());  exit();  
            // echo "<pre>";
            // print_r($_POST);
            // exit();
            if ($this->request->getData('any_notice_issued_by_contractor') == 1) {
                $attachment  =  $this->request->getData('notice_file_upload');
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
                        $newfile                                   = "notice_file_upload_" . $current_time . "." . $fileExt;
                        $tempFile                                  = $tmpName;
                        $targetPath                                = 'uploads/ProjectwiseTimeExtension/';
                        $targetFile                                = $targetPath . $newfile;
                        $projectwiseTimeExtensionDetail->notice_file_upload        =   $newfile;
                        move_uploaded_file($tempFile, $targetFile);
                    }
                }
            }
            $projectwiseTimeExtensionDetail->project_work_id                 = $pid;
            $projectwiseTimeExtensionDetail->project_work_subdetail_id       = $work_id;
            $projectwiseTimeExtensionDetail->extension_date_of_ee            = date('Y-m-d', strtotime($this->request->getData('extension_date_of_ee')));
            $projectwiseTimeExtensionDetail->delay_part_of_contractor        = $this->request->getData('delay_part_of_contractor');
            $projectwiseTimeExtensionDetail->delay_due_to_department         = $this->request->getData('delay_due_to_department');
            $projectwiseTimeExtensionDetail->delay_for_revision_plan         = $this->request->getData('delay_for_revision_plan');
            $projectwiseTimeExtensionDetail->delay_due_to_rain               = $this->request->getData('delay_due_to_rain');
            $projectwiseTimeExtensionDetail->delay_due_to_shortage_sand      = $this->request->getData('delay_due_to_shortage_sand');
            $projectwiseTimeExtensionDetail->any_notice_issued_by_contractor = $this->request->getData('any_notice_issued_by_contractor');
            $projectwiseTimeExtensionDetail->any_fine_imposed_for_delay      = $this->request->getData('any_fine_imposed_for_delay');
            $projectwiseTimeExtensionDetail->contractor_quality_of_work 	 = $this->request->getData('contractor_quality_of_work');
            $projectwiseTimeExtensionDetail->remarks_of_ee              	 = $this->request->getData('remarks_of_ee');
            if($projectwiseTimeExtensionDetailcount == 0){
   		    $projectwiseTimeExtensionDetail->approval_role              	 = 5;
		    }else if($projectwiseTimeExtensionDetailcount == 1){
            $projectwiseTimeExtensionDetail->approval_role              	 = 6;
		    }else if($projectwiseTimeExtensionDetailcount >= 2){
            $projectwiseTimeExtensionDetail->approval_role              	 = 17;
		    } 
			 
			$projectwiseTimeExtensionDetail->created_by                   	 = $user->id;
            $projectwiseTimeExtensionDetail->created_date            		 = date('Y-m-d:h:m:s');
			//echo "<pre>";  print_r($projectwiseTimeExtensionDetail);  exit();  
			if ($this->ProjectwiseTimeExtensionDetails->save($projectwiseTimeExtensionDetail)) {
			 		 $insert_id = $projectwiseTimeExtensionDetail->id;


             foreach ($this->request->getData('monitoring') as $key => $value) {

                $projectwiseTimeExtensionFileUpload = $this->ProjectwiseTimeExtensionFileUploads->newEmptyEntity();
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
                        $targetPath                                =  'uploads/Projectimeetenstionfile/';
                        $targetFile                                =  $targetPath . $newfile;
                        $projectwiseTimeExtensionFileUpload->file_upload   =   $newfile;
                        move_uploaded_file($tempFile, $targetFile);
                    }
                } else {
                    $projectwiseTimeExtensionFileUpload->file_upload =  $value['photo_upload1'];
                }

                $projectwiseTimeExtensionFileUpload->projectwise_time_extension_detail_id  =  $insert_id;  
                $projectwiseTimeExtensionFileUpload->created_by                    = $user->id;
                $projectwiseTimeExtensionFileUpload->created_date                  = date('Y-m-d H:i:s');
                $this->ProjectwiseTimeExtensionFileUploads->save($projectwiseTimeExtensionFileUpload);
            }
				
				$ProjectsubWorksTable            = $this->getTableLocator()->get('ProjectWorkSubdetails');
				$projectsub                      = $ProjectsubWorksTable->get($work_id); 
				   $projectsub->projectwise_time_extension_detail_id     = $insert_id;  

				if($projectwiseTimeExtensionDetailcount == 0){
					$projectsub->eot_count           = 1;  
					$projectsub->eot_approval_role   = 5;
				}else if($projectwiseTimeExtensionDetailcount == 1){
					$projectsub->eot_count           = 2;
					$projectsub->eot_approval_role   = 6;
				}else if($projectwiseTimeExtensionDetailcount >= 2){
					$projectsub->eot_count           = ($projectwiseTimeExtensionDetailcount+1);
					$projectsub->eot_approval_role   = 17;
				} 
				
				$ProjectsubWorksTable->save($projectsub);
				
				if($projectsub->eot_approval_role == 6 || $projectsub->eot_approval_role == 17){
				  $recipient_user = $this->Users->find('all')->where(['Users.role_id'=>$projectsub->eot_approval_role,'Users.is_active'=>1])->first();	
				}else if($projectsub->eot_approval_role == 5){
				  $recipient_user = $this->Users->find('all')->where(['Users.role_id'=>$projectsub->eot_approval_role,'Users.circle_id'=>$projectWorkSubdetail['circle_id'],'Users.is_active'=>1])->first();		
				}
                
				$recipient_user_id = $recipient_user['id'];
				$notification = $this->Notifications->newEmptyEntity();					
				$notification->forwarded_date                    = date('Y-m-d');
				$notification->forward_user_id                   = $user->id;
				$notification->recipient_user_id                 = $recipient_user_id; 
				$notification->notification_type_id              = 12; 
				$notification->project_work_id                   = $pid;
				$notification->project_work_subdetail_id         = $work_id;
				$notification->projectwise_time_extension_detail_id  = $insert_id;
				$notification->created_by                        = $user->id;
				$notification->created_date                      = date('Y-m-d H:i:s');				
				$this->Notifications->save($notification);          
             				
             
                $this->Flash->success(__('The projectwise time extension detail has been saved.'));

                return $this->redirect(['action' => 'add/'.$pid.'/'.$work_id]);
            }
            $this->Flash->error(__('The projectwise time extension detail could not be saved. Please, try again.'));
        }
        $NoticeIssue = [1 => 'Yes', 0 => 'No'];
		$curr_role   = $this->Roles->find('list')->toArray();		

        $this->set(compact(
            'projectwiseTimeExtensionDetail',
            'NoticeIssue',
            'pid',
            'work_id',
            'projectwiseTimeExtensionDetailcount',
            'projectwiseTimeExtensionDetailists','curr_role','last_Time_extention'
        ));
    }
	
	
    public function approval($pid = null, $work_id = null,$id = null)
    {
        $this->viewBuilder()->setLayout('layout');
		$this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
		$this->Notifications=$this->fetchTable('Notifications');
		$this->ProjectwiseTimeExtensionFileUploads=$this->fetchTable('ProjectwiseTimeExtensionFileUploads');

        $user = $this->request->getAttribute('identity'); 		
        $role_id     = $user->role_id;
		$division_id = $user->division_id;
		$circle_id   = $user->circle_id;			
		//$projectwiseTimeExtensionDetailcount = $this->ProjectwiseTimeExtensionDetails->find('all')->where(['ProjectwiseTimeExtensionDetails.project_work_id' => $pid, 'ProjectwiseTimeExtensionDetails.project_work_subdetail_id' => $work_id])->count();
		$projectwiseTimeExtensionDetail = $this->ProjectwiseTimeExtensionDetails->find('all')->where(['ProjectwiseTimeExtensionDetails.project_work_id' => $pid, 'ProjectwiseTimeExtensionDetails.project_work_subdetail_id' => $work_id,'ProjectwiseTimeExtensionDetails.id'=>$id])->first();
        
		   $projectwiseTimeExtensionFilecount       = $this->ProjectwiseTimeExtensionFileUploads->find('all')->where(['ProjectwiseTimeExtensionFileUploads.projectwise_time_extension_detail_id' => $id, 'ProjectwiseTimeExtensionFileUploads.is_active' => 1])->count();
          $projectwiseTimeExtensionFileUploads       = $this->ProjectwiseTimeExtensionFileUploads->find('all')->contain(['ProjectwiseTimeExtensionDetails'])->where(['ProjectwiseTimeExtensionFileUploads.projectwise_time_extension_detail_id' => $id, 'ProjectwiseTimeExtensionFileUploads.is_active' => 1])->toArray();

		
        if ($this->request->is('post')) { //echo "<pre>";  print_r($this->request->getData());  exit();  
			$approved = $this->request->getData('is_approved');			
			$ProjectsubWorksTable         = $this->getTableLocator()->get('ProjectwiseTimeExtensionDetails');
			$projectsub                   = $ProjectsubWorksTable->get($id); 
			$projectsub->is_approved      = $approved;
			if($approved == 1){
			$projectsub->approved_date    = date('Y-m-d');
			}
			$projectsub->approval_remarks = $this->request->getData('remarks');
			$ProjectsubWorksTable->save($projectsub);			
			
			  $ProjectsubWorksTable1             = $this->getTableLocator()->get('ProjectWorkSubdetails');
			  $projectsub1                       = $ProjectsubWorksTable1->get($work_id); 
			  $projectsub1->projectwise_time_extension_detail_id     = null;  
			  $projectsub1->eot_approval_role   = null;
			
			$ProjectsubWorksTable1->save($projectsub1);
			
			    $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$pid,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.projectwise_time_extension_detail_id'=>$id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>12])->count();
				  // echo '<pre>';  print_r($notification_count); exit();
			   if($notification_count == 1){   
					$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$pid,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.projectwise_time_extension_detail_id'=>$id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>12])->first();
					$notificationTable                  = $this->getTableLocator()->get('Notifications');
					$notification1                       = $notificationTable->get($notification_id['id']); 
					$notification1->notification_seen	= 1;  
					$notification1->process_done	        = 1;  
					$notificationTable->save($notification1);
				}
		
			return $this->redirect(['controller'=>'ProjectWorks','action' => 'projectlist/14']);
				

        }
		
        $approval = [1 => 'Approved'];
        $this->set(compact('projectwiseTimeExtensionFilecount','projectwiseTimeExtensionFileUploads','projectwiseTimeExtensionDetail','approval','pid','work_id','projectwiseTimeExtensionDetailcount','projectwiseTimeExtensionDetailists'));
    }

    /*public function edit($pid = null, $work_id = null, $id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');

        $projectwiseTimeExtensionDetail = $this->ProjectwiseTimeExtensionDetails->get($id, [
            'contain' => [],
        ]);
        // echo"<pre>";print_r($projectwiseTimeExtensionDetail);exit();
        if ($this->request->is(['patch', 'post', 'put'])) {
        //   echo"<pre>";print_r($_POST);exit();
            if ($this->request->getData('any_notice_issued_by_contractor') == 1) {

                $attachment  =  $this->request->getData('notice_file_upload');

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
                        $newfile                                   = "notice_file_upload_" . $current_time . "." . $fileExt;
                        $tempFile                                  = $tmpName;
                        $targetPath                                = 'uploads/ProjectwiseTimeExtension/';
                        $targetFile                                = $targetPath . $newfile;
                        $projectwiseTimeExtensionDetail->notice_file_upload        =   $newfile;

                        move_uploaded_file($tempFile, $targetFile);
                    }
                }else {
                    $projectwiseTimeExtensionDetail->notice_file_upload              =  $this->request->getData('notice_file_upload1');
                }
                
            }
            $projectwiseTimeExtensionDetail->project_work_id                 =  $pid;
            $projectwiseTimeExtensionDetail->project_work_subdetail_id       = $work_id;
            $projectwiseTimeExtensionDetail->extension_date_of_ee            =  date('Y-m-d', strtotime($this->request->getData('extension_date_of_ee1')));
            $projectwiseTimeExtensionDetail->delay_part_of_contractor        =  $this->request->getData('delay_part_of_contractor');
            $projectwiseTimeExtensionDetail->delay_due_to_department         =  $this->request->getData('delay_due_to_department');
            $projectwiseTimeExtensionDetail->delay_for_revision_plan         =  $this->request->getData('delay_for_revision_plan');
            $projectwiseTimeExtensionDetail->delay_due_to_rain               =  $this->request->getData('delay_due_to_rain');
            $projectwiseTimeExtensionDetail->delay_due_to_shortage_sand      =  $this->request->getData('delay_due_to_shortage_sand');
            $projectwiseTimeExtensionDetail->any_notice_issued_by_contractor =  $this->request->getData('any_notice_issued_by_contractor');
            $projectwiseTimeExtensionDetail->any_fine_imposed_for_delay =  $this->request->getData('any_fine_imposed_for_delay');
            $projectwiseTimeExtensionDetail->contractor_quality_of_work =  $this->request->getData('contractor_quality_of_work');
            $projectwiseTimeExtensionDetail->remarks_of_ee              =  $this->request->getData('remarks_of_ee');
            $projectwiseTimeExtensionDetail->modified_by              =  $user->id;
            $projectwiseTimeExtensionDetail->modified_date            =  date('Y-m-d:h:m:s');
                    // echo"<pre>";print_r($projectwiseTimeExtensionDetail);exit();

            // $projectwiseTimeExtensionDetail = $this->ProjectwiseTimeExtensionDetails->patchEntity($projectwiseTimeExtensionDetail, $this->request->getData());
            if ($this->ProjectwiseTimeExtensionDetails->save($projectwiseTimeExtensionDetail)) {
				   $this->Flash->success(__('The projectwise time extension detail has been saved.'));
                return $this->redirect(['action' => 'add/'.$pid.'/'.$work_id]);

                // return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projectwise time extension detail could not be saved. Please, try again.'));
        }
        $NoticeIssue = [1 => 'Yes', 0 => 'No'];

        $this->set(compact('projectwiseTimeExtensionDetail','NoticeIssue','pid','work_id'));
    }*/
	
	public function edit($pid = null, $work_id = null, $id = null)
    {
    $this->viewBuilder()->setLayout('layout');
    $user = $this->request->getAttribute('identity');
    $this->ProjectwiseTimeExtensionFileUploads=$this->fetchTable('ProjectwiseTimeExtensionFileUploads');

    $projectwiseTimeExtensionDetail = $this->ProjectwiseTimeExtensionDetails->get($id, [
        'contain' => [],
    ]);

    if ($this->request->is(['patch', 'post', 'put'])) {
          //echo"<pre>";print_r($this->request->getData());exit();
        if ($this->request->getData('any_notice_issued_by_contractor') == 1) {
            $attachment  =  $this->request->getData('notice_file_upload');

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
                    $newfile                                   = "notice_file_upload_" . $current_time . "." . $fileExt;
                    $tempFile                                  = $tmpName;
                    $targetPath                                = 'uploads/ProjectwiseTimeExtension/';
                    $targetFile                                = $targetPath . $newfile;
                    $projectwiseTimeExtensionDetail->notice_file_upload        =   $newfile;

                    move_uploaded_file($tempFile, $targetFile);
                }
            } else {
                $projectwiseTimeExtensionDetail->notice_file_upload              =  $this->request->getData('notice_file_upload1');
            }
        }
        $projectwiseTimeExtensionDetail->project_work_id                 = $pid;
        $projectwiseTimeExtensionDetail->project_work_subdetail_id       = $work_id;
        $projectwiseTimeExtensionDetail->extension_date_of_ee            = date('Y-m-d', strtotime($this->request->getData('extension_date_of_ee1')));
        $projectwiseTimeExtensionDetail->delay_part_of_contractor        = $this->request->getData('delay_part_of_contractor');
        $projectwiseTimeExtensionDetail->delay_due_to_department         = $this->request->getData('delay_due_to_department');
        $projectwiseTimeExtensionDetail->delay_for_revision_plan         = $this->request->getData('delay_for_revision_plan');
        $projectwiseTimeExtensionDetail->delay_due_to_rain               = $this->request->getData('delay_due_to_rain');
        $projectwiseTimeExtensionDetail->delay_due_to_shortage_sand      = $this->request->getData('delay_due_to_shortage_sand');
        $projectwiseTimeExtensionDetail->any_notice_issued_by_contractor = $this->request->getData('any_notice_issued_by_contractor');
        $projectwiseTimeExtensionDetail->any_fine_imposed_for_delay      = $this->request->getData('any_fine_imposed_for_delay');
        $projectwiseTimeExtensionDetail->contractor_quality_of_work      = $this->request->getData('contractor_quality_of_work');
        $projectwiseTimeExtensionDetail->remarks_of_ee                   = $this->request->getData('remarks_of_ee');
        $projectwiseTimeExtensionDetail->modified_by                     = $user->id;
        $projectwiseTimeExtensionDetail->modified_date                   = date('Y-m-d:h:m:s');
        if ($this->ProjectwiseTimeExtensionDetails->save($projectwiseTimeExtensionDetail)) {
            $insert_id = $projectwiseTimeExtensionDetail->id;
            foreach ($this->request->getData('monitoring') as $key => $value) {           
                if ($value['id'] != '') {
                    $projectwiseTimeExtensionFileUpload = $this->ProjectwiseTimeExtensionFileUploads->get($value['id'], [
                        'contain' => [],
                    ]);
                } else {
                    $projectwiseTimeExtensionFileUpload = $this->ProjectwiseTimeExtensionFileUploads->newEmptyEntity();
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
                        $newfile                                   =  "projecttimeextenstion_" . $key . "_" . $current_time . "." . $fileExt;
                        $tempFile                                  =  $tmpName;
                        $targetPath                                =  'uploads/Projectimeetenstionfile/';
                        $targetFile                                =  $targetPath . $newfile;
                        $projectwiseTimeExtensionFileUpload->file_upload   =   $newfile;
                        move_uploaded_file($tempFile, $targetFile);
                    }
                } else {
                    $projectwiseTimeExtensionFileUpload->file_upload =  $value['photo_upload1'];
                }

                $projectwiseTimeExtensionFileUpload->projectwise_time_extension_detail_id  = $projectwiseTimeExtensionDetail->id;
                $projectwiseTimeExtensionFileUpload->modified_by                    = $user->id;
                $projectwiseTimeExtensionFileUpload->modified_date                  = date('Y-m-d H:i:s');
                $this->ProjectwiseTimeExtensionFileUploads->save($projectwiseTimeExtensionFileUpload);
            }
            $this->Flash->success(__('The projectwise time extension detail  has been changed.'));
            return $this->redirect(['action' => 'add/' . $pid . '/' . $work_id]);
        }

        $this->Flash->error(__('The projectwise time extension detail could not be saved. Please, try again.'));
    }

    $NoticeIssue = [1 => 'Yes', 0 => 'No'];
    $projectwiseTimeExtensionFileUploads       = $this->ProjectwiseTimeExtensionFileUploads->find('all')->contain(['ProjectwiseTimeExtensionDetails'])->where(['ProjectwiseTimeExtensionFileUploads.projectwise_time_extension_detail_id' => $id, 'ProjectwiseTimeExtensionFileUploads.is_active' => 1])->toArray();

    $this->set(compact('projectwiseTimeExtensionDetail', 'NoticeIssue', 'pid', 'work_id','projectwiseTimeExtensionFileUploads'));
   }
	
	public function ajaxtime($i = null)
    {
        $this->set(compact('i'));
    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectwiseTimeExtensionDetail = $this->ProjectwiseTimeExtensionDetails->get($id);
        if ($this->ProjectwiseTimeExtensionDetails->delete($projectwiseTimeExtensionDetail)) {
            $this->Flash->success(__('The projectwise time extension detail has been deleted.'));
        } else {
            $this->Flash->error(__('The projectwise time extension detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
