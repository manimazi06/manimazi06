<?php
declare(strict_types=1);

namespace App\Controller;

class ProjectPlacedToBoardDetailsController extends AppController
{
    
    public function projectplacedboard()
    {
        $this->viewBuilder()->setLayout('layout');
        $this->paginate = [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails'],
        ];
        $projectPlacedToBoardDetails = $this->paginate($this->ProjectPlacedToBoardDetails);
        $this->set(compact('projectPlacedToBoardDetails'));
    }

    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $projectPlacedToBoardDetail = $this->ProjectPlacedToBoardDetails->get($id, [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails'],
        ]);
        $this->set(compact('projectPlacedToBoardDetail'));
    }

    
    public function projectplacedtoboard($id = null ,$work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		 $this->Notifications=$this->fetchTable('Notifications');
		 $this->Users=$this->fetchTable('Users');
        $projectPlacedToBoardDetail = $this->ProjectPlacedToBoardDetails->newEmptyEntity();
       
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $attachment  = $this->request->getData('file_upload');

            if ($attachment->getClientFilename() != '') {
                $name    = $attachment->getClientFilename();
                $type    = $attachment->getClientMediaType();
                $size    = $attachment->getSize();
                $tmpName = $attachment->getStream()->getMetadata('uri');
                $error   = $attachment->getError();

                if ($name != '' && $error == 0) {
                    $file                                           = $name;
                    $array                                          = explode('.', $file);
                    $fileExt                                        = $array[count($array) - 1];
                    $current_time                                   = date('Y_m_d_H_i_s');
                    $newfile                                        = "projectplacedtoboard_" . $current_time . "." . $fileExt;
                    $tempFile                                       = $tmpName;
                    $targetPath                                     = 'uploads/projectplacedtoboard/';
                    $targetFile                                     = $targetPath . $newfile;
                    $projectPlacedToBoardDetail->file_upload        = $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            } else {
                $projectPlacedToBoardDetail->file_upload               = $this->request->getData('file_upload');
            }

            $projectPlacedToBoardDetail->project_work_id               = $id;
            $projectPlacedToBoardDetail->project_work_subdetail_id     = $work_id;
            $projectPlacedToBoardDetail->placed_date                   = date('Y-m-d', strtotime($this->request->getData('placed_date')));
            $projectPlacedToBoardDetail->remarks                       = $this->request->getData('remarks');
            $projectPlacedToBoardDetail->created_by                    =  $user->id;
            $projectPlacedToBoardDetail->created_date                  =  date('Y-m-d H:i:s');

            if ($this->ProjectPlacedToBoardDetails->save($projectPlacedToBoardDetail)) {
                   $subdetailTable                   = $this->getTableLocator()->get('ProjectWorkSubdetails');
					$project                          = $subdetailTable->get($work_id); 
					$project->project_work_status_id  = 19;                   						
					$subdetailTable->save($project);
					
				    $notification_count = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' => $user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>16])->count();
				      if($notification_count == 1){   
						$notification_id = $this->Notifications->find('all')->where(['Notifications.recipient_user_id' =>$user->id,'Notifications.project_work_id'=>$id,'Notifications.project_work_subdetail_id'=>$work_id,'Notifications.process_done'=>0,'Notifications.notification_type_id'=>16])->first();
						$notificationTable                   = $this->getTableLocator()->get('Notifications');
						$notification1                       = $notificationTable->get($notification_id['id']); 
						$notification1->notification_seen	 = 1;  
						$notification1->process_done	     = 1;  
						$notificationTable->save($notification1);
					  }
                  return $this->redirect(['controller'=>'ProjectWorks','action' => 'approvedlist']);
                  $this->Flash->success(__('The project placed to board detail has been saved.'));
            }

            $this->Flash->error(__('The project placed to board detail could not be saved. Please, try again.'));
        }
        $this->set(compact('projectPlacedToBoardDetail','id','work_id'));
    }

    
    public function projectplacedtoboardedit($id = null,$pid = null ,$work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $projectPlacedToBoardDetail = $this->ProjectPlacedToBoardDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
        //    echo"<pre>"; print_r($_POST);exit();
            $projectPlacedToBoardDetail = $this->ProjectPlacedToBoardDetails->patchEntity($projectPlacedToBoardDetail, $this->request->getData());
             
            $attachment  = $this->request->getData('file_upload');

            if ($attachment->getClientFilename() != '') {
                $name    = $attachment->getClientFilename();
                $type    = $attachment->getClientMediaType();
                $size    = $attachment->getSize();
                $tmpName = $attachment->getStream()->getMetadata('uri');
                $error   = $attachment->getError();

                if ($name != '' && $error == 0) {
                    $file                                           = $name;
                    $array                                          = explode('.', $file);
                    $fileExt                                        = $array[count($array) - 1];
                    $current_time                                   = date('Y_m_d_H_i_s');
                    $newfile                                        = "projectplacedtoboard_" . $current_time . "." . $fileExt;
                    $tempFile                                       = $tmpName;
                    $targetPath                                     = 'uploads/projectplacedtoboard/';
                    $targetFile                                     = $targetPath . $newfile;
                    $projectPlacedToBoardDetail->file_upload        = $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            } else {
                $projectPlacedToBoardDetail->file_upload               = $this->request->getData('file_upload1');
            }

            $projectPlacedToBoardDetail->project_work_id               = $pid;
            $projectPlacedToBoardDetail->project_work_subdetail_id     = $work_id;
            $projectPlacedToBoardDetail->placed_date                   = date('Y-m-d', strtotime($this->request->getData('placed_date')));
            $projectPlacedToBoardDetail->remarks                       = $this->request->getData('remarks');
            $projectPlacedToBoardDetail->modified_by                =  $user->id;
            $projectPlacedToBoardDetail->modified_date              =  date('Y-m-d H:i:s');

            // echo"<pre>"; print_r($projectPlacedToBoardDetail);exit();

            if ($this->ProjectPlacedToBoardDetails->save($projectPlacedToBoardDetail)) {

                $this->Flash->success(__('The project placed to board detail has been saved.'));
                return $this->redirect(['action' => 'projectplacedboard']);

            }
            $this->Flash->error(__('The project placed to board detail could not be saved. Please, try again.'));
        }
        $this->set(compact('projectPlacedToBoardDetail'));
    }

   
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectPlacedToBoardDetail = $this->ProjectPlacedToBoardDetails->get($id);
        if ($this->ProjectPlacedToBoardDetails->delete($projectPlacedToBoardDetail)) {
            $this->Flash->success(__('The project placed to board detail has been deleted.'));
        } else {
            $this->Flash->error(__('The project placed to board detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
