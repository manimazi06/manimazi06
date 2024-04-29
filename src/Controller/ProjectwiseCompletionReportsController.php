<?php

declare(strict_types=1);
namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Locator\LocatorAwareTrait;


class ProjectwiseCompletionReportsController extends AppController
{
    public function projectwisecompletiondetails($id = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->ProjectWorks=$this->fetchTable('ProjectWorks');
        $this->Users=$this->fetchTable('Users');
        $this->ProjectCompletionApprovalStages=$this->fetchTable('ProjectCompletionApprovalStages');
        $this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
        $this->Notifications=$this->fetchTable('Notifications');

        $role_id     = $user->role_id;
        $division_id = $user->division_id;

        //For Financial amount
        $project_subdetails = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id'=>$work_id])->first();
        $project_sub        = $project_subdetails['fs_amount'];
        //$work_id            = $project_subdetails['id'];
		
		//echo "<pre>"; print_r($project_subdetails); exit();

        //for project work
        $completiondetails     = $this->ProjectwiseCompletionReports->find('all')->first();

        if ($this->request->getData('completion_amount') < $project_sub) {
            $status = "Savings-";
			$status_id = 1;
            $savings = $project_sub - $this->request->getData('completion_amount');
        } elseif ($this->request->getData('completion_amount') > $project_sub) {
            $status = "Excess-";
			$status_id = 2;
            $savings = $this->request->getData('completion_amount') - $project_sub;
        } elseif ($this->request->getData('completion_amount') == $project_sub) {
            $status = 'Both Amount are Equal';
			$status_id = 0;
        }
        $projectwiseCompletionReport = $this->ProjectwiseCompletionReports->newEmptyEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectwiseCompletionReport->project_work_id            = $id;
            $projectwiseCompletionReport->project_work_subdetail_id  = $work_id;
            $projectwiseCompletionReport->completed_date             =  date('Y-m-d', strtotime($this->request->getData('completed_date')));
            $projectwiseCompletionReport->remarks                    = $this->request->getData('remarks');
            $projectwiseCompletionReport->completion_amount          = $this->request->getData('completion_amount');
            $projectwiseCompletionReport->completion_status          = $status . $savings;
            $projectwiseCompletionReport->status                     = $status_id;
            $projectwiseCompletionReport->created_by                 =  $user->id;
            $projectwiseCompletionReport->created_date               =  date('Y-m-d H:i:s');

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
                    $targetPath                             =  'uploads/ProjectCompletionDetails/';
                    $targetFile                             =  $targetPath . $newfile;
                    $projectwiseCompletionReport->file_upload   =  $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            }
            // echo '<pre>';
            // print_r($projectwiseCompletionReport);
            // exit();
            if ($this->ProjectwiseCompletionReports->save($projectwiseCompletionReport)) {
                $subdetailTable                 = $this->getTableLocator()->get('ProjectWorkSubdetails');
                $project                        = $subdetailTable->get($work_id);
                $project->project_work_status_id          = 17;
                $project->completion_report_current_role  = 9;

                $subdetailTable->save($project);

                $users  = $this->Users->find('all')->where(['Users.role_id' => 9, 'Users.is_active' => 1])->first();
                $user_id = $users['id'];

                $projectCompletionApprovalStage = $this->ProjectCompletionApprovalStages->newEmptyEntity();
                $projectCompletionApprovalStage->project_work_id           = $id;
                $projectCompletionApprovalStage->project_work_subdetail_id = $work_id;
                $projectCompletionApprovalStage->user_id                   = $user_id;
                $projectCompletionApprovalStage->current_role_id           = 9;
                $projectCompletionApprovalStage->current_status            = 'Forward to HO Planning';
                $projectCompletionApprovalStage->approval_status_id        = 1;
                $projectCompletionApprovalStage->remarks                   = $this->request->getData('remarks');
                $projectCompletionApprovalStage->submit_date               = date('Y-m-d');
                $projectCompletionApprovalStage->created_by                = $user->id;
                $projectCompletionApprovalStage->created_date              = date('Y-m-d H:i:s');
                // echo '<pre>';
                // print_r($projectCompletionApprovalStage);
                // exit();
                if ($this->ProjectCompletionApprovalStages->save($projectCompletionApprovalStage)) {
					
				   $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>14])->count();
				   if($notification_count == 1){   
						$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>14])->first();
						$notificationTable                   = $this->getTableLocator()->get('Notifications');
						$notification1                       = $notificationTable->get($notification_id['id']); 
						$notification1->notification_seen	 = 1;  
						$notification1->process_done	     = 1;  
						$notificationTable->save($notification1);		

						// $recipient_user    = $this->Users->find('all')->where(['Users.role_id'=>13,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
						// $recipient_user_id = $recipient_user['id'];
						$notification      = $this->Notifications->newEmptyEntity();					
						$notification->forwarded_date                    = date('Y-m-d');
						$notification->forward_user_id                   = $user->id;
						$notification->recipient_user_id                 = $user_id; 
						$notification->notification_type_id              = 15; 
						$notification->project_work_id                   = $id;
						$notification->project_work_subdetail_id         = $work_id;
						if($projectWorkSubdetail['work_type'] == 2){
							$notification->work_type                     = 2;								
						}
						$notification->created_by                        = $user->id;
						$notification->created_date                      = date('Y-m-d H:i:s');				
						$this->Notifications->save($notification);   	
				   }					
					
                    $this->Flash->success(__('The projectwiseCompletionReport has been saved.'));
                    return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/10']);
                }
            } else {
                $this->Flash->error(__('The projectwiseCompletionReport could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('project_subdetails', 'projectwiseCompletionReport_count', 'projectWork', 'projectwiseCompletionReports', 'projectwiseCompletionReport', 'handoverdetails_count', 'handoverdetails', 'handoverdetail', 'tender_type', 'projectWork', 'tenders', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'contractor_detail_count', 'contractor_details', 'technicalcount', 'technical', 'project_sub'));
    }

    public function projectwisecompletiondetailsedit($id = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');

        $completion = $this->ProjectwiseCompletionReports->find('all')->where(['ProjectwiseCompletionReports.project_work_id' => $id, 'ProjectwiseCompletionReports.project_work_subdetail_id' => $work_id])->first();
        $com_id = $completion['id'];


        $projectwiseCompletionReport = $this->ProjectwiseCompletionReports->get($com_id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectwiseCompletionReport->project_work_id            = $id;
            $projectwiseCompletionReport->project_work_subdetail_id  = $work_id;
            $projectwiseCompletionReport->completed_date             =  date('Y-m-d', strtotime($this->request->getData('completed_date')));
            $projectwiseCompletionReport->remarks                    = $this->request->getData('remarks');
            $projectwiseCompletionReport->created_by                 =  $user->id;
            $projectwiseCompletionReport->created_date               =  date('Y-m-d H:i:s');
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
                    $targetPath                             =  'uploads/ProjectCompletionDetails/';
                    $targetFile                             =  $targetPath . $newfile;
                    $projectwiseCompletionReport->file_upload       =  $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            } else {
                $projectwiseCompletionReport->file_upload = $this->request->getData('file_upload1');
            }
            if ($this->ProjectwiseCompletionReports->save($projectwiseCompletionReport)) {
                $this->Flash->success(__('The projectwiseCompletionReport has been saved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectlist/10']);
            } else {
                $this->Flash->error(__('The projectwiseCompletionReport could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('projectwiseCompletionReport_count', 'projectWork', 'projectwiseCompletionReports', 'projectwiseCompletionReport', 'handoverdetails_count', 'handoverdetails', 'handoverdetail', 'tender_type', 'projectWork', 'tenders', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'contractor_detail_count', 'contractor_details', 'technicalcount', 'technical'));
    }


    public function projectcompletionapproval($id = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $this->Users=$this->fetchTable('Users');
        $this->ApprovalStatuses=$this->fetchTable('ApprovalStatuses');
        $this->ProjectCompletionApprovalStages=$this->fetchTable('ProjectCompletionApprovalStages');
        $this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
        $this->ProjectwiseCompletionReports=$this->fetchTable('ProjectwiseCompletionReports');
        $this->Notifications=$this->fetchTable('Notifications');

        $user = $this->request->getAttribute('identity');
        $role_id     = $user->role_id;
        $division_id = $user->division_id;

        $projectWorkSubdetail  = $this->ProjectWorkSubdetails->find('all')->contain(['Divisions', 'Circles'])->where(['ProjectWorkSubdetails.id' => $work_id])->first();
        $completioncount       = $this->ProjectwiseCompletionReports->find('all')->where(['ProjectwiseCompletionReports.project_work_id' => $id, 'ProjectwiseCompletionReports.project_work_subdetail_id' => $work_id])->count();
        $completiondetails     = $this->ProjectwiseCompletionReports->find('all')->where(['ProjectwiseCompletionReports.project_work_id' => $id, 'ProjectwiseCompletionReports.project_work_subdetail_id' => $work_id])->first();


        $completion_approval_stages_count  = $this->ProjectCompletionApprovalStages->find('all')->where(['ProjectCompletionApprovalStages.project_work_id' => $id, 'ProjectCompletionApprovalStages.project_work_subdetail_id' => $work_id])->count();
        $completion_approval_stages        = $this->ProjectCompletionApprovalStages->find('all')->contain(['ApprovalStatuses'])->where(['ProjectCompletionApprovalStages.project_work_id' => $id, 'ProjectCompletionApprovalStages.project_work_subdetail_id' => $work_id])->toArray();


        if ($this->request->is(['patch', 'post', 'put'])) {  //echo '<pre>';  print_r($this->request->getData()); exit();
            $approval_status_id =  $this->request->getData('approval_status_id');

           // if ($approval_status_id == 1) {

               /* if ($role_id != 8) {

                    if ($role_id == 6) {
                        $next_role_id    = $role_id + 2;
                    } else {
                        $next_role_id    = $role_id + 1;
                    }
                    //echo '<pre>';  print_r($projectWorkSubdetail['division_id']); exit();
                    /*if($next_role_id == 4){	
					   $status = 'Drawing Branch Forward to EE';
                       $users  = $this->Users->find('all')->where(['Users.role_id'=>$next_role_id,'Users.division_id'=>$projectWorkSubdetail['division_id'],'Users.is_active'=>1])->first();
                       $user_id = $users['id'];	
					  //echo '<pre>';  print_r($user_id); exit(); 
					}else*/
                   /* if ($next_role_id == 5) {
                        $status = 'EE Forward to SE';
                        $users  = $this->Users->find('all')->where(['Users.role_id' => $next_role_id, 'Users.circle_id' => $projectWorkSubdetail['circle_id'], 'Users.is_active' => 1])->first();
                        $user_id = $users['id'];
                    } else if ($next_role_id == 6) {
                        $status = 'SE Forward to CE';
                        $users  = $this->Users->find('all')->where(['Users.role_id' => $next_role_id, 'Users.is_active' => 1])->first();
                        $user_id = $users['id'];
                    } else if ($next_role_id == 8) {
                        $status = 'CE Forward to GM';
                        $users  = $this->Users->find('all')->where(['Users.role_id' => $next_role_id, 'Users.is_active' => 1])->first();
                        $user_id = $users['id'];
                    }*/
                /*} else if ($role_id == 8) {*/
                    $user_id = 0;
                    $next_role_id    = 0;
                    $status = 'Completion Report Approved';
                //}
            //} else if ($approval_status_id == 2) {
                /*if ($role_id == 8) {
                    $next_role_id    = 6;
                } else if ($role_id == 4) {
                    $next_role_id    = 13;
                } else {
                    $next_role_id    = $role_id - 1;
                }
                if ($next_role_id == 6) {
                    $status = 'GM Clarification to CE';
                    $users  = $this->Users->find('all')->where(['Users.role_id' => $next_role_id, 'Users.circle_id' => $projectWorkSubdetail['circle_id'], 'Users.is_active' => 1])->first();
                    $user_id = $users['id'];
                } else if ($next_role_id == 5) {
                    $status = 'CE Clarification to SE';
                    $users  = $this->Users->find('all')->where(['Users.role_id' => $next_role_id, 'Users.circle_id' => $projectWorkSubdetail['circle_id'], 'Users.is_active' => 1])->first();
                    $user_id = $users['id'];
                } else if ($next_role_id == 4) {
                    $status = 'SE Clarification to EE';
                    $users  = $this->Users->find('all')->where(['Users.role_id' => $next_role_id, 'Users.division_id' => $projectWorkSubdetail['division_id'], 'Users.is_active' => 1])->first();
                    $user_id = $users['id'];
                } else if ($next_role_id == 13) {
                    $status = 'EE Clarification to Planning';
                    $users  = $this->Users->find('all')->where(['Users.role_id' => $next_role_id, 'Users.division_id' => $projectWorkSubdetail['division_id'], 'Users.is_active' => 1])->first();
                    $user_id = $users['id'];
                }
            }*/

            $projectCompletionApprovalStage = $this->ProjectCompletionApprovalStages->newEmptyEntity();
            $projectCompletionApprovalStage->project_work_id           = $id;
            $projectCompletionApprovalStage->project_work_subdetail_id = $work_id;
            $projectCompletionApprovalStage->user_id                   = $user_id;
            $projectCompletionApprovalStage->current_role_id           = $next_role_id;
            $projectCompletionApprovalStage->current_status            = $status;
            $projectCompletionApprovalStage->approval_status_id        = $approval_status_id;
            $projectCompletionApprovalStage->remarks                   = $this->request->getData('remarks');
            $projectCompletionApprovalStage->submit_date               = date('Y-m-d');
            $projectCompletionApprovalStage->created_by                = $user->id;
            $projectCompletionApprovalStage->created_date              = date('Y-m-d H:i:s');
            //echo '<pre>'; print_r($detailedEstimateApprovalStage); exit();
            if ($this->ProjectCompletionApprovalStages->save($projectCompletionApprovalStage)) {

                $subdetailTable                   = $this->getTableLocator()->get('ProjectWorkSubdetails');
                $project                          = $subdetailTable->get($projectWorkSubdetail['id']);
                $project->completion_report_current_role  = $next_role_id;
                if ($role_id == 9 && $this->request->getData('approval_status_id') == 1) {
                    //$project->detailed_estimate_approval  = 1;
                    $project->project_work_status_id  = 18;
					 
                }
                $subdetailTable->save($project);
				if($this->request->getData('approval_status_id') == 1){
				$notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>15])->count();
				      if($notification_count == 1){   
						$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>15])->first();
						$notificationTable                   = $this->getTableLocator()->get('Notifications');
						$notification1                       = $notificationTable->get($notification_id['id']); 
						$notification1->notification_seen	 = 1;  
						$notification1->process_done	     = 1;  
						$notificationTable->save($notification1);		

					    $recipient_user    = $this->Users->find('all')->where(['Users.role_id'=>9,'Users.is_active'=>1])->first();
					   $recipient_user_id = $recipient_user['id'];
						$notification      = $this->Notifications->newEmptyEntity();					
						$notification->forwarded_date                    = date('Y-m-d');
						$notification->forward_user_id                   = $user->id;
						$notification->recipient_user_id                 = $recipient_user_id; 
						$notification->notification_type_id              = 16; 
						$notification->project_work_id                   = $id;
						$notification->project_work_subdetail_id         = $work_id;
						if($projectWorkSubdetail['work_type'] == 2){
							$notification->work_type                     = 2;								
						}
						$notification->created_by                        = $user->id;
						$notification->created_date                      = date('Y-m-d H:i:s');				
						$this->Notifications->save($notification);   	
				   }
				}

                $this->Flash->success(__('The Completion Report has been Approved.'));
                return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'approvedlist']);
            }
        }

        $approvalStatuses = $this->ApprovalStatuses->find('list')->where(['ApprovalStatuses.id'=>1])->toArray();

        $this->set(compact('completioncount', 'completiondetails', 'approvalStatuses', 'projectWork', 'completion_approval_stages_count', 'projectWorks', 'detailed_estimates', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'work_id', 'total_estimate', 'completion_approval_stages', 'detailed_approval_stages_count', 'role_id'));
    }
}
