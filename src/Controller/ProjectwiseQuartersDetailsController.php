<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * ProjectwiseQuartersDetails Controller
 *
 * @property \App\Model\Table\ProjectwiseQuartersDetailsTable $ProjectwiseQuartersDetails
 * @method \App\Model\Entity\ProjectwiseQuartersDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectwiseQuartersDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $this->viewBuilder()->setLayout('layout');
        $projectwiseQuartersDetails = $this->ProjectwiseQuartersDetails->find('all')->contain(['ProjectWorks', 'PoliceDesignations'])->where(['ProjectwiseQuartersDetails.is_active' => 1])->toArray();
        // print_r($projectwiseQuartersDetails);
        // exit();
        $this->set(compact('projectwiseQuartersDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Projectwise Quarters Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectwiseQuartersDetail = $this->ProjectwiseQuartersDetails->get($id, [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails', 'PoliceDesignations'],
        ]);

        $this->set(compact('projectwiseQuartersDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectwiseQuartersDetail = $this->ProjectwiseQuartersDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $projectwiseQuartersDetail = $this->ProjectwiseQuartersDetails->patchEntity($projectwiseQuartersDetail, $this->request->getData());
            if ($this->ProjectwiseQuartersDetails->save($projectwiseQuartersDetail)) {
                $this->Flash->success(__('The projectwise quarters detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projectwise quarters detail could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectwiseQuartersDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $projectWorkSubdetails = $this->ProjectwiseQuartersDetails->ProjectWorkSubdetails->find('list', ['limit' => 200])->all();
        $policeDesignations = $this->ProjectwiseQuartersDetails->PoliceDesignations->find('list', ['limit' => 200])->all();
        $this->set(compact('projectwiseQuartersDetail', 'projectWorks', 'projectWorkSubdetails', 'policeDesignations'));
    }

    public function projectwisequarterdetailsadd($id = null,$work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $this->ProjectWorks=$this->fetchTable('ProjectWorks');
        $this->PoliceDesignations=$this->fetchTable('PoliceDesignations');
		
        $projectwiseQuartersDetailcount = $this->ProjectwiseQuartersDetails->find('all')->where(['ProjectwiseQuartersDetails.project_work_id'=>$id,'ProjectwiseQuartersDetails.project_work_subdetail_id'=>$work_id])->count();
        $projectwiseQuartersDetail_lists = $this->ProjectwiseQuartersDetails->find('all')->contain(['ProjectWorks', 'PoliceDesignations'])->where(['ProjectwiseQuartersDetails.project_work_id' =>$id,'ProjectwiseQuartersDetails.project_work_subdetail_id'=>$work_id])->toArray();

          $projectwiseQuartersDetails = $this->ProjectwiseQuartersDetails->find('all')->contain(['ProjectWorks', 'PoliceDesignations'])->toArray();
          if ($this->request->is(['patch', 'post', 'put'])) { //echo "<pre>"; print_r($this->request->getData()); exit();
            foreach ($this->request->getData('quarters') as $key => $value) {         
                $projectwiseQuartersDetail = $this->ProjectwiseQuartersDetails->newEmptyEntity();                
                $projectwiseQuartersDetail->project_work_id           = $id;
                $projectwiseQuartersDetail->project_work_subdetail_id = $work_id;
                $projectwiseQuartersDetail->police_designation_id     = $value['police_designation_id'];
                $projectwiseQuartersDetail->no_of_quarters            = $value['no_of_quarters'];
                $projectwiseQuartersDetail->created_by                = $user->id;
                $projectwiseQuartersDetail->created_date              = date('Y-m-d H:i:s');
                if ($this->ProjectwiseQuartersDetails->save($projectwiseQuartersDetail));
            }
			
			$subdetailTable                     = $this->getTableLocator()->get('ProjectWorkSubdetails');
			$subproject                         = $subdetailTable->get($work_id); 
			$subproject->quarters_flag	        = 1;  
			$subproject->total_units	        = $this->request->getData('total_units');      
			$subdetailTable->save($subproject);
			
            $this->Flash->success(__('The project Quarter Details has been saved.'));
           // return $this->redirect(['action' => 'index']);
		    return $this->redirect(['action' => 'projectwisequarterdetailsadd/'.$id.'/'.$work_id]);
            }
            //$this->Flash->error(__('The project Quarter Details could not be saved. Please, try again.'));
        
        $policeDesignations = $this->ProjectwiseQuartersDetails->PoliceDesignations->find('list', ['limit' => 200])->all();

        $this->set(compact('projectwiseQuartersDetails', 'projectWork', 'projectwiseQuartersDetail', 'policeDesignations','projectwiseQuartersDetailcount','projectwiseQuartersDetail_lists','id','work_id'));
    }

    public function ajaxquarters($i = null)
    {
       $policeDesignations = $this->ProjectwiseQuartersDetails->PoliceDesignations->find('list', ['limit' => 200])->all();
        $this->set(compact('i', 'policeDesignations'));
    }
  
    public function edit($id = null,$work_id = null,$quarters_id = null)
    {
        $projectwiseQuartersDetail = $this->ProjectwiseQuartersDetails->get($quarters_id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectwiseQuartersDetail = $this->ProjectwiseQuartersDetails->patchEntity($projectwiseQuartersDetail, $this->request->getData());
            if ($this->ProjectwiseQuartersDetails->save($projectwiseQuartersDetail)) {
                $this->Flash->success(__('The projectwise quarters detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projectwise quarters detail could not be saved. Please, try again.'));
        }
        $projectWorks = $this->ProjectwiseQuartersDetails->ProjectWorks->find('list', ['limit' => 200])->all();
        $projectWorkSubdetails = $this->ProjectwiseQuartersDetails->ProjectWorkSubdetails->find('list', ['limit' => 200])->all();
        $policeDesignations = $this->ProjectwiseQuartersDetails->PoliceDesignations->find('list', ['limit' => 200])->all();
        $this->set(compact('projectwiseQuartersDetail', 'projectWorks', 'projectWorkSubdetails', 'policeDesignations'));
    }
	
    public function projectwisequarterdetailsedit($id = null,$work_id = null,$quarters_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $projectwiseQuartersDetail = $this->ProjectwiseQuartersDetails->get($quarters_id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // print_r($_POST);
            // exit();
            foreach ($this->request->getData('quarters') as $key => $value) {          

                $projectwiseQuartersDetail = $this->ProjectwiseQuartersDetails->newEmptyEntity();                
                $projectwiseQuartersDetail->project_work_id           = $id;   
                $projectwiseQuartersDetail->project_work_subdetail_id = $work_id;				
                $projectwiseQuartersDetail->police_designation_id  = $value['police_designation_id'];
                $projectwiseQuartersDetail->no_of_quarters         = $value['no_of_quarters'];
                $projectwiseQuartersDetail->modified_by            =  $user->id;
                $projectwiseQuartersDetail->modified_date          =  date('Y-m-d:h:m:s');
                if ($this->ProjectwiseQuartersDetails->save($projectwiseQuartersDetail));
            }
            $this->Flash->success(__('The project Quarter Details has been saved.'));
			return $this->redirect(['action' => 'projectwisequarterdetailsadd/'.$id.'/'.$work_id]);
            //return $this->redirect(['action' => 'index']);
            $this->Flash->error(__('The project Quarter Details could not be saved. Please, try again.'));
        }
        $policeDesignations = $this->ProjectwiseQuartersDetails->PoliceDesignations->find('list', ['limit' => 200])->all();

        $this->set(compact('projectwiseQuartersDetails', 'projectWork', 'projectwiseQuartersDetail', 'policeDesignations'));
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectwiseQuartersDetail = $this->ProjectwiseQuartersDetails->get($id);
        $ProjectWorksTable     = $this->getTableLocator()->get('ProjectwiseQuartersDetails');
        $project               = $ProjectWorksTable->get($projectwiseQuartersDetail['id']);
        $project->is_active      = 0;
        if ($ProjectWorksTable->save($project)) {
            $this->Flash->success(__('The projectwise quarters detail has been deleted.'));
        } else {
            $this->Flash->error(__('The projectwise quarters detail could not be deleted. Please,try again.'));
        }

         //return $this->redirect(['action' => 'projectlist/11']);

    }
}
