<?php
declare(strict_types=1);
namespace App\Controller;


class ProjectMonitoringDetailsController extends AppController
{		
	public function projectmonitoring($id = null, $work_id = null)
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
        $monitorings      = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->toArray();

        //if ($monitorings as $monitoring) {
        foreach ($monitorings as $monitoring) {
            $photo_uploads[$monitoring['id']]     = $this->ProjectMonitoringPhotosUploads->find('all')->where(['ProjectMonitoringPhotosUploads.project_monitoring_detail_id' => $monitoring['id']])->toArray();
        }
        //}


        // if ($monitoringDetailscount == 0) {
        $projectMonitoringDetail = $this->ProjectMonitoringDetails->newEmptyEntity();
        // }

        if ($this->request->is((['patch', 'post', 'put']))) {
          
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

            return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectworkdetail/' . $id]);
        }
        $workStages = $this->WorkStages->find('list', ['limit' => 200])->all();
        $percentage = $this->WorkPercentages->find('list')->all();

        $this->set(compact('percentage', 'projectMonitoringDetail', 'workStages', 'projectTenderDetail', 'projectWork', 'tenders', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'contractor_detail_count', 'contractor_details', 'technicalcount', 'technical', 'monitoring', 'monitoringDetailscount', 'photo_uploads', 'monitorings'));
    }
    public function projectmonitoringedit($id = null, $work_id = null, $monitoring_id)
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
        $monitorings      = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages'])->where(['ProjectMonitoringDetails.project_work_id' => $id, 'ProjectMonitoringDetails.project_work_subdetail_id' => $work_id])->toArray();

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

            return $this->redirect(['controller' => 'ProjectWorks', 'action' => 'projectworkdetail/' . $id]);
        }
        $workStages = $this->WorkStages->find('list', ['limit' => 200])->all();
        $percentage = $this->WorkPercentages->find('list')->all();

        $this->set(compact('percentage', 'projectMonitoringDetail', 'workStages', 'projectTenderDetail', 'projectWork', 'tenders', 'id', 'administrativesanctioncount', 'administrativesanction', 'projectWorkSubdetail', 'financialSanctionscount', 'financialSanctions', 'work_id', 'contractor_detail_count', 'contractor_details', 'technicalcount', 'technical', 'monitoring', 'monitoringDetailscount', 'photo_uploads', 'monitorings'));
    }
	
    public function ajaxmonitor($i = null)
    {
        $this->loadModel('WorkStages');
        $this->loadModel('WorkPercentages');
        $workStages = $this->WorkStages->find('list')->all();
        $percentage = $this->WorkPercentages->find('list')->all();
        $this->set(compact('i', 'workStages', 'percentage'));
    }
	
    public function ajaxphotoupload($id = null)
    {
        $this->loadModel('ProjectMonitoringPhotosUploads');
        $photo_uploads      = $this->ProjectMonitoringPhotosUploads->find('all')->where(['ProjectMonitoringPhotosUploads.project_monitoring_detail_id' => $id])->toArray();
        $this->set(compact('id', 'photo_uploads'));
    } 
   
}