<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Contractors Controller
 *
 * @property \App\Model\Table\ContractorsTable $Contractors
 * @method \App\Model\Entity\Contractor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContractorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $this->viewBuilder()->setLayout('layout');

        $contractors = $this->Contractors->find('all')->where(['Contractors.is_active' => 1])->toArray();
        // echo '<pre>';
        // print_r($contractors);
        // exit();

        $this->set(compact('contractors'));
    }

    /**
     * View method
     *
     * @param string|null $id Contractor id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contractor = $this->Contractors->get($id, [
            'contain' => ['ContractorClasses'],
        ]);

        $this->set(compact('contractor'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $this->ContractorClasses=$this->fetchTable('ContractorClasses');
        $this->LicenseRenewalDetails=$this->fetchTable('LicenseRenewalDetails');
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $contractor = $this->Contractors->newEmptyEntity();
        if ($this->request->is(['post', 'patch', 'put'])) {
            // print_r($_POST);
            // exit();
            // $contractor                       = $this->contractor->patchEntity($contractor, $this->request->getData());
            $contractor->name                             = $this->request->getData('name');
            $contractor->contractor_class_id              = $this->request->getData('contractor_class_id');
            $contractor->mobile_no                        = $this->request->getData('mobile_no');
            $contractor->email                            = $this->request->getData('email');
            $contractor->address                          = $this->request->getData('address');
            $contractor->gst_no                           = $this->request->getData('gst_no');
            $contractor->reg_no                           = $this->request->getData('reg_no');
            $contractor->register_date         = date('Y-m-d', strtotime($this->request->getData('register_date')));
            $contractor->validity_upto         = date('Y-m-d', strtotime($this->request->getData('validity_upto')));

            $contractor->created_date         = date('Y-m-d H:i:s');
            $contractor->created_by           = $user->id;

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
            // echo '<pre>';
            // print_r($contractor);
            // exit();
            if ($this->Contractors->save($contractor)) {
                $insert_id               = $contractor->id;
                // echo "<pre>";
                // print_r($contractor);
                // exit();

                $licenseRenewalDetail                                = $this->LicenseRenewalDetails->newEmptyEntity();

                $licenseRenewalDetail->contractor_id          = $insert_id;
                $licenseRenewalDetail->license_validity_upto = $contractor['validity_upto'];
                $licenseRenewalDetail->created_by            = $user->id;
                $licenseRenewalDetail->created_date          = date('Y-m-d H:i:s');
                // echo "<pre>";
                // print_r($licenseRenewalDetail);
                // exit();
                $this->LicenseRenewalDetails->save($licenseRenewalDetail);
                $this->Flash->success(__('The Contractor Details has been saved.'));
                return $this->redirect(['action' => 'index']);

                $this->Flash->error(__('The Contractor Details could not be saved. Please, try again.'));
            }
            $this->Flash->error(__('The Contractorcould not be saved. Please, try again.'));
        }




        $contractorClass = $this->Contractors->ContractorClasses->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['ContractorClasses.is_active' => 1])->toArray();

        $this->set(compact('contractor', 'contractorClass'));
    }



    /**
     * Edit method
     *
     * @param string|null $id Contractor id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $this->LicenseRenewalDetails=$this->fetchTable('LicenseRenewalDetails');
        $user = $this->request->getAttribute('identity');
        $contractor = $this->Contractors->get($id, [
            'contain' => [],
        ]);
		 $contractor_detail = $this->Contractors->find('all')->where(['Contractors.id'=>$id])->first();
		 
		// echo "<pre>"; print_r($contractor_detail);
            // exit();

        if ($this->request->is(['post', 'patch', 'put'])) {
            // print_r($_POST);
            // exit();
            // $contractor                       = $this->contractor->patchEntity($contractor, $this->request->getData());
            $contractor->name                             = $this->request->getData('name');
            $contractor->contractor_class_id              = $this->request->getData('contractor_class_id');
            $contractor->mobile_no                        = $this->request->getData('mobile_no');
            $contractor->email                            = $this->request->getData('email');
            $contractor->address                          = $this->request->getData('address');
            $contractor->gst_no                           = $this->request->getData('gst_no');
            $contractor->reg_no                           = $this->request->getData('reg_no');
            $contractor->register_date         =  date('Y-m-d', strtotime($this->request->getData('register_date1')));
            $contractor->validity_upto         = date('Y-m-d', strtotime($this->request->getData('validity_upto1')));

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
            // echo '<pre>';
            // print_r($contractor);
            // exit();
            if ($this->Contractors->save($contractor)) {
                $insert_id               = $contractor->id;
                // echo "<pre>";
                // print_r($contractor);
                // exit();


                $licenseRenewalDetail                                = $this->LicenseRenewalDetails->newEmptyEntity();
                $licenseRenewalDetail->contractor_id                = $insert_id;
                $licenseRenewalDetail->license_validity_upto         = $contractor['validity_upto'];
                $licenseRenewalDetail->created_by            = $user->id;
                $licenseRenewalDetail->created_date          = date('Y-m-d H:i:s');
                // echo "<pre>";
                // print_r($licenseRenewalDetail);
                // exit();
                $this->LicenseRenewalDetails->save($licenseRenewalDetail);
                $this->Flash->success(__('The Contractor Details has been saved.'));
                return $this->redirect(['action' => 'index']);

                $this->Flash->error(__('The Contractor Details could not be saved. Please, try again.'));
            }
        }
        $contractorClasses = $this->Contractors->ContractorClasses->find('list', ['limit' => 200])->all();
        $this->set(compact('contractor', 'contractorClasses','contractor_detail'));
    }


    public function licenserenewal($id = null)
    {
        $this->LicenseRenewalDetails=$this->fetchTable('LicenseRenewalDetails');
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');

        /*$contractor = $this->Contractors->get($id, [
            'contain' => [],
        ]);*/


        $contractor_detail = $this->Contractors->find('all')->where(['Contractors.id' => $id])->first();
        // echo "<pre>";
        // print_r($contractor_detail);
        // exit();

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
            // echo '<pre>';
            // print_r($licenseRenewalDetail);
            // exit();
            if ($this->LicenseRenewalDetails->save($licenseRenewalDetail)) {


                $ContractorsTable     = $this->getTableLocator()->get('Contractors');
                $project                        = $ContractorsTable->get($contractor_detail['id']);
                $project->validity_upto       = $licenseRenewalDetail['license_validity_upto'];

                // echo '<pre>';
                // print_r($project);
                // exit();
                $ContractorsTable->save($project);

                $this->Flash->success(__('The Contractor details and logs has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Contractor details  and logs could not be saved. Please, try again.'));
            }
        }


        $this->set(compact('licenseRenewalDetail'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Contractor id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contractor = $this->Contractors->get($id);
        if ($this->Contractors->delete($contractor)) {
            $this->Flash->success(__('The contractor has been deleted.'));
        } else {
            $this->Flash->error(__('The contractor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
