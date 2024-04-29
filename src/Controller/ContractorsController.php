<?php
declare(strict_types=1);
namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Locator\LocatorAwareTrait;

class ContractorsController extends AppController
{

    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
		$user = $this->request->getAttribute('identity');  
		$role_id = $user->role_id;  
        $contractors = $this->Contractors->find('all')->contain(['ContractorClasses','ContractorTypes','ContractorClassLevels','ContractorRegisteredDepartments'])->where(['Contractors.is_active' => 1])->toArray();
        $this->set(compact('contractors','role_id'));
    }

    public function view($id = null)
    {
	    $this->viewBuilder()->setLayout('layout');
        $contractor_details = $this->Contractors->get($id, [
            'contain' => ['ContractorClasses','ContractorTypes','ContractorClassLevels','ContractorRegisteredDepartments'],
        ]);
		
		//echo "<pre>"; print_r($contractor_details); exit();

        $this->set(compact('contractor_details'));
    }

    public function ajaxgst($gst,$id)
    {
        $this->Contractors=$this->fetchTable('Contractors');
        if($id != ''){
            $gst    = $this->Contractors->find('all')->where(['Contractors.gst_no' => $gst,'Contractors.id !=' => $id])->count();
        }else{
            $gst    = $this->Contractors->find('all')->where(['Contractors.gst_no' => $gst])->count();
        }
        if($gst > 0){
            echo 1;
        }else{
            echo 0;
        }
        exit();
    }

    public function add()
    {        
        $this->viewBuilder()->setLayout('layout');
        $this->ContractorClasses=$this->fetchTable('ContractorClasses');
        $this->LicenseRenewalDetails=$this->fetchTable('LicenseRenewalDetails');
        $this->ContractorTypes=$this->fetchTable('ContractorTypes');
        $this->ContractorClassLevels=$this->fetchTable('ContractorClassLevels');
        $this->ContractorRegisteredDepartments=$this->fetchTable('ContractorRegisteredDepartments');
        $user = $this->request->getAttribute('identity');
		$contractor_detail      = $this->Contractors->find('all')->count();
        $contractorcount        =  $contractor_detail +1;
        $contractor = $this->Contractors->newEmptyEntity();
        if ($this->request->is(['post', 'patch', 'put'])) {
            
            $contractor->name                             = $this->request->getData('name');
            $contractor->contractor_class_id              = $this->request->getData('contractor_class_id');
            $contractor->mobile_no                        = $this->request->getData('mobile_no');
            $contractor->mobile_no2                       = $this->request->getData('mobile_no2');
            $contractor->email                            = $this->request->getData('email');
            $contractor->address                          = $this->request->getData('address');
            $contractor->gst_no                           = $this->request->getData('gst_no');
            $contractor->file_no                          = $this->request->getData('file_no');
            $contractor->reg_no                           = $contractorcount;	   
			$contractor->register_date                    = date('Y-m-d', strtotime($this->request->getData('register_date')));
            $contractor->validity_upto                    = date('Y-m-d', strtotime($this->request->getData('validity_upto')));
			$contractor->contractor_class_level_id          = $this->request->getData('contractor_class_level_id');
            $contractor->contractor_type_id                 = $this->request->getData('contractor_type_id');
            $contractor->contractor_registered_department_id = $this->request->getData('contractor_registered_department_id');
            $contractor->renewal_date                       =  date('Y-m-d', strtotime($this->request->getData('renewal_date')));
            $contractor->registration_no                    = $this->request->getData('registration_no');
            $contractor->remarks                            = $this->request->getData('remarks');    
            $contractor->created_date                     = date('Y-m-d H:i:s');
            $contractor->created_by                       = $user->id;

            $copy               = $this->request->getData('certificate_upload');

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
                    $newfile                                =  "certificate_upload_" . $current_time . "." . $fileExt;
                    $tempFile                               =  $tmpName;
                    $targetPath                             =  'uploads/ContractorCertificate/';
                    $targetFile                             =  $targetPath . $newfile;
                    $contractor->certificate_upload       =  $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            }
        
            if ($this->Contractors->save($contractor)) {
                $insert_id               = $contractor->id;               
                $licenseRenewalDetail                                = $this->LicenseRenewalDetails->newEmptyEntity();
                $licenseRenewalDetail->contractor_id          = $insert_id;
                $licenseRenewalDetail->license_validity_upto = $contractor['validity_upto'];
                $licenseRenewalDetail->created_by            = $user->id;
                $licenseRenewalDetail->created_date          = date('Y-m-d H:i:s');
                
                $this->LicenseRenewalDetails->save($licenseRenewalDetail);
                $this->Flash->success(__('The Contractor Details has been saved.'));
                return $this->redirect(['action' => 'index']);

                $this->Flash->error(__('The Contractor Details could not be saved. Please, try again.'));
            }
            $this->Flash->error(__('The Contractorcould not be saved. Please, try again.'));
        }
        $contractorClass       = $this->Contractors->ContractorClasses->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['ContractorClasses.is_active' => 1])->toArray();
        $contractor_types      = $this->ContractorTypes->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['ContractorTypes.is_active' => 1])->toArray();
        $contractor_levels     = $this->ContractorClassLevels->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['ContractorClassLevels.is_active' => 1])->toArray();
        $contractor_reg_depart = $this->ContractorRegisteredDepartments->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['ContractorRegisteredDepartments.is_active' => 1])->toArray();

        $this->set(compact('contractor', 'contractorClass','contractorcount','contractor_types','contractor_levels','contractor_reg_depart'));
    }


    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $this->LicenseRenewalDetails=$this->fetchTable('LicenseRenewalDetails');
		 $this->ContractorTypes=$this->fetchTable('ContractorTypes');
        $this->ContractorClassLevels=$this->fetchTable('ContractorClassLevels');
        $this->ContractorRegisteredDepartments=$this->fetchTable('ContractorRegisteredDepartments');
        $user = $this->request->getAttribute('identity');
        $contractor = $this->Contractors->get($id, [
            'contain' => [],
        ]);
		 $contractor_detail = $this->Contractors->find('all')->where(['Contractors.id'=>$id])->first();	

        if ($this->request->is(['post', 'patch', 'put'])) {
           
            $contractor->name                             = $this->request->getData('name');
            $contractor->contractor_class_id              = $this->request->getData('contractor_class_id');
            $contractor->mobile_no                        = $this->request->getData('mobile_no');
            $contractor->mobile_no2                       = $this->request->getData('mobile_no2');
            $contractor->email                            = $this->request->getData('email');
            $contractor->address                          = $this->request->getData('address');
            $contractor->gst_no                           = $this->request->getData('gst_no');
            $contractor->reg_no                           = $contractor_detail['reg_no'];
            $contractor->file_no                          = $this->request->getData('file_no');
            $contractor->register_date                    = date('Y-m-d', strtotime($this->request->getData('register_date1')));
            $contractor->validity_upto                    = date('Y-m-d', strtotime($this->request->getData('validity_upto1')));
			
			$contractor->contractor_class_level_id          = $this->request->getData('contractor_class_level_id');
            $contractor->contractor_type_id                 = $this->request->getData('contractor_type_id');
            $contractor->contractor_registered_department_id = $this->request->getData('contractor_registered_department_id');
            $contractor->renewal_date                       =  date('Y-m-d', strtotime($this->request->getData('renewal_date1')));
            $contractor->registration_no                    = $this->request->getData('registration_no');
            $contractor->remarks                            = $this->request->getData('remarks');    
            $contractor->modified_date         = date('Y-m-d H:i:s');
            $contractor->modified_by           = $user->id;

            $copy               = $this->request->getData('certificate_upload');

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
                    $newfile                                =  "certificate_upload_" . $current_time . "." . $fileExt;
                    $tempFile                               =  $tmpName;
                    $targetPath                             =  'uploads/ContractorCertificate/';
                    $targetFile                             =  $targetPath . $newfile;
                    $contractor->certificate_upload       =  $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            } else {
                $copy               = $this->request->getData('certificate_upload1');
            }

            if ($this->Contractors->save($contractor)) {
                $insert_id               = $contractor->id;     

                $licenseRenewalDetail                                = $this->LicenseRenewalDetails->newEmptyEntity();
                $licenseRenewalDetail->contractor_id                = $insert_id;
                $licenseRenewalDetail->license_validity_upto         = $contractor['validity_upto'];
                $licenseRenewalDetail->created_by            = $user->id;
                $licenseRenewalDetail->created_date          = date('Y-m-d H:i:s');
             
                $this->LicenseRenewalDetails->save($licenseRenewalDetail);
                $this->Flash->success(__('The Contractor Details has been saved.'));
                return $this->redirect(['action' => 'index']);

                $this->Flash->error(__('The Contractor Details could not be saved. Please, try again.'));
            }
        }
        $contractorClasses = $this->Contractors->ContractorClasses->find('list', ['limit' => 200])->all();
		$contractor_types      = $this->ContractorTypes->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['ContractorTypes.is_active' => 1])->toArray();
        $contractor_levels     = $this->ContractorClassLevels->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['ContractorClassLevels.is_active' => 1])->toArray();
        $contractor_reg_depart = $this->ContractorRegisteredDepartments->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['ContractorRegisteredDepartments.is_active' => 1])->toArray();

        $this->set(compact('contractor', 'contractorClasses','contractor_detail','id','contractor_types','contractor_levels','contractor_reg_depart'));
    }

    public function licenserenewal($id = null)
    {
        $this->LicenseRenewalDetails=$this->fetchTable('LicenseRenewalDetails');
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');  
        $contractor_detail = $this->Contractors->find('all')->where(['Contractors.id' => $id])->first();       

        $licenseRenewalDetail = $this->LicenseRenewalDetails->newEmptyEntity();
        if ($this->request->is('post', 'patch', 'put')) {
            $licenseRenewalDetail->contractor_id    = $contractor_detail['id'];
            $licenseRenewalDetail->license_renewal_date          = date('Y-m-d', strtotime($this->request->getData('license_renewal_date')));
            $licenseRenewalDetail->license_validity_upto         = date('Y-m-d', strtotime($this->request->getData('license_validity_upto')));
            $licenseRenewalDetail->created_by            = $user->id;
            $licenseRenewalDetail->created_date          = date('Y-m-d H:i:s');
            $copy               = $this->request->getData('license_file_upload');

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
                    $newfile                                =  "renewal_file_upload_" . $current_time . "." . $fileExt;
                    $tempFile                               =  $tmpName;
                    $targetPath                             =  'uploads/RenewalLicenseCertificate/';
                    $targetFile                             =  $targetPath . $newfile;
                    $licenseRenewalDetail->license_file_upload       =  $newfile;
                    move_uploaded_file($tempFile, $targetFile);
                }
            }
           
            if ($this->LicenseRenewalDetails->save($licenseRenewalDetail)) {
                $ContractorsTable     = $this->getTableLocator()->get('Contractors');
                $project                        = $ContractorsTable->get($contractor_detail['id']);
                $project->validity_upto       = $licenseRenewalDetail['license_validity_upto'];
                
                $ContractorsTable->save($project);

                $this->Flash->success(__('The Contractor details and logs has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Contractor details  and logs could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('licenseRenewalDetail'));
    }
	
	
	public function ajaxcontractorprojects($id = NULL)
    {
		
		  $contractor_detail = $this->Contractors->find('all')->where(['Contractors.id' => $id,'Contractors.is_active'=>1])->first();       

		  $contractor_name = $contractor_detail['name'];
            $connection   = ConnectionManager::get('default'); 			
			$sql          = "SELECT department.name as dname,
							division.name as division_name,
							project_work_statuse.name as pws,
							work_subdetails.work_name as work_name,
							work_subdetails.work_code as work_code,
							work_subdetails.fs_amount as fs_amount,
							cd.agreement_amount as agreement_amount,
							work_subdetails.expenditure_incurred as expenditure_incurred,
							work_subdetails.id as work_id,work_subdetails.project_work_id as project_id
							FROM project_work_subdetails as work_subdetails
							LEFT JOIN project_works as project_work on project_work.id = work_subdetails.project_work_id
							LEFT JOIN contractor_details as cd on cd.project_work_subdetail_id=work_subdetails.id
							LEFT JOIN divisions as division on division.id = work_subdetails.division_id
							LEFT JOIN departments as department on department.id = project_work.department_id
							LEFT JOIN project_work_statuses as project_work_statuse on project_work_statuse.id = work_subdetails.project_work_status_id
							where cd.contractor_id = ".$id."
							order by work_subdetails.id
							";
						
        $projectdetails             = $connection->execute($sql)->fetchAll('assoc');
        $this->set(compact('projectdetails','contractor_name'));
     }


    public function delete($id = null)
    {
       $this->Contractors=$this->fetchTable('Contractors');		
		$userTable          = $this->getTableLocator()->get('Contractors');
		$user                = $userTable->get($id); 
		$user->is_active  = 0;
        if ($userTable->save($user)) {
			 return $this->redirect(['controller' => 'Contractors', 'action' => 'index']);
        } else {
			 return $this->redirect(['controller' => 'Contractors', 'action' => 'index']);

            $this->Flash->error(__('Unable to Delete. Please, try again.'));  
        }		
		exit();
    }	
}