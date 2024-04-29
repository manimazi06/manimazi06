<?php

declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Locator\LocatorAwareTrait;


class OpeningBalanceLogsController extends AppController
{
  
    public function index()
    {
       $this->viewBuilder()->setLayout('layout');
       $user = $this->request->getAttribute('identity');
       $div_id  = $user->division_id;
       $role_id = $user->role_id;        
       $user_id = $user->id;    
       $this->OpeningBalanceDetails=$this->fetchTable('OpeningBalanceDetails');	   

        if ($role_id == 6  || $role_id == 8 ||  $role_id == 16) {
		    $openingBalanceDetailcount = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.office_id' => 1])->count();
            $openingbalancecount = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.office_id' => 1,'OpeningBalanceLogs.request_date is NULL'])->count();
            $fundDetailscount = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.office_id' => 1,'OpeningBalanceLogs.request_date is NOT NULL'])->count();
            $fundDetails      = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.office_id' => 1,'OpeningBalanceLogs.request_date is NOT NULL'])->toArray();          
        }elseif($role_id == 4){
            $fundDetailscount = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.division_id' => $div_id,'OpeningBalanceLogs.request_date is NOT NULL'])->count();
            $fundDetails      = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.division_id' => $div_id,'OpeningBalanceLogs.request_date is NOT NULL'])->toArray();
        }

        $this->set(compact('fundDetailscount', 'fundDetails','role_id','user_id','openingbalancecount','openingBalanceDetailcount'));
    }
  
    public function view($id = null)
    {
        $projectFundDetail = $this->ProjectFundDetails->get($id, [
            'contain' => ['ProjectWorks', 'ProjectWorkSubdetails', 'IsAmountReceives', 'OpeningBalanceDetails'],
        ]);

        $this->set(compact('projectFundDetail'));
    }

    public function funddetails()
    {
        $this->OpeningBalanceDetails=$this->fetchTable('OpeningBalanceDetails');
        $this->FundRequestUserDepartmentDetails=$this->fetchTable('FundRequestUserDepartmentDetails');
        $this->FundRequestUserDepartmentSubdetails=$this->fetchTable('FundRequestUserDepartmentSubdetails');
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $div_id = $user->division_id;
        $role_id = $user->role_id;		
		
		$connection = ConnectionManager::get('default');	
        $query      =  "SELECT frd.id as fund_req_id,psd.work_name,dv.name as division_name,fs.go_no as fsgo_no,sum(frd.request_amount) as request_amount,psd.project_work_id,psd.id as work_id
						 from project_fund_request_details as frd 
						 LEFT JOIN project_work_subdetails as psd on psd.id= frd.project_work_subdetail_id 
						 LEFT JOIN project_works as project on project.id = psd.project_work_id
						 LEFT JOIN divisions as dv on dv.id= psd.division_id 
						 LEFT JOIN project_financial_sanctions as fs on fs.project_work_id= project.id 
						 where psd.is_active = 1 and frd.sent_to_user_department = 0 
						 group by frd.id,psd.work_name,dv.name,fs.go_no,psd.project_work_id,psd.id
						 ";										 
 	    $fund_request_projects = $connection->execute($query)->fetchAll('assoc');		
		
        if($role_id == 6 || $role_id == 8 || $role_id == 16){
            $openingBalance = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.office_id' => 1])->count();
            $balanceDetail = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.office_id' => 1])->first();
            $openingBalanceLogcount = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.office_id' => 1])->count();
            $openingBalanceDetail = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.office_id' => 1])->first();
        } /*elseif ($role_id == 4) {
            $openingBalance = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.division_id' => $div_id])->count();
            $balanceDetail = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.division_id' => $div_id])->first();
            $openingBalanceLogcount = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.division_id' => $div_id])->count();
            $openingBalanceDetail = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.division_id' => $div_id])->first();
        }*/
      
        if($role_id == 6 || $role_id == 8 || $role_id == 16){
            $office_id = 1;
        } /*elseif ($role_id == 4) {
            $office_id = 2;
        }*/

        if ($this->request->is('post', 'patch', 'put')) {  //echo "<pre>";  print_r($this->request->getData());  exit();  
			if($this->request->getData('is_amount_receive_id') == 1){	
				$opening   = $this->request->getData('received_amount') + $balanceDetail['opening_balance'];		
			}else{
				$opening   = $balanceDetail['opening_balance'];
			}
			$openingBalanceLog   = $this->OpeningBalanceLogs->newEmptyEntity();
			$openingBalanceLog->division_id           = ($div_id)?$div_id:'';
			$openingBalanceLog->office_id             = $office_id;
			$openingBalanceLog->opening_balance       = $opening;
			$openingBalanceLog->balance_date          = date('Y-m-d');
			$openingBalanceLog->payment_info          = 1;
			$openingBalanceLog->request_date          = date('Y-m-d', strtotime($this->request->getData('request_date')));
			$openingBalanceLog->request_amount        = $this->request->getData('tot_request_amount');
			$openingBalanceLog->is_amount_received    = $this->request->getData('is_amount_receive_id');
			$openingBalanceLog->received_date         = ($this->request->getData('received_date') != '')?date('Y-m-d', strtotime($this->request->getData('received_date'))):NULL;
			$openingBalanceLog->received_amount       = ($this->request->getData('received_amount') != '')?$this->request->getData('received_amount'):'';
			$openingBalanceLog->created_by            = $user->id;
			$openingBalanceLog->created_date          = date('Y-m-d H:i:s');
			if ($this->OpeningBalanceLogs->save($openingBalanceLog)){
				$fund_insertid     = $openingBalanceLog->id;
				$fundRequestUserDepartmentDetail = $this->FundRequestUserDepartmentDetails->newEmptyEntity();  				
				$fundRequestUserDepartmentDetail->request_date           = date('Y-m-d', strtotime($this->request->getData('request_date')));
				$fundRequestUserDepartmentDetail->request_amount         = $this->request->getData('tot_request_amount');
				$fundRequestUserDepartmentDetail->opening_balance_log_id = $fund_insertid;    
				$fundRequestUserDepartmentDetail->is_fund_received       = $this->request->getData('is_amount_receive_id');
				$fundRequestUserDepartmentDetail->received_date          = ($this->request->getData('received_date') != '')?date('Y-m-d', strtotime($this->request->getData('received_date'))):NULL;
				$fundRequestUserDepartmentDetail->received_amount        = ($this->request->getData('received_amount') != '')?$this->request->getData('received_amount'):'';
				$fundRequestUserDepartmentDetail->created_by             = $user->id;
				$fundRequestUserDepartmentDetail->created_date           = date('Y-m-d H:i:s');
                if($this->FundRequestUserDepartmentDetails->save($fundRequestUserDepartmentDetail)){
					$insertid     = $fundRequestUserDepartmentDetail->id;					
				foreach ($this->request->getData('project') as $key => $value) {
				  if($value['project_id'] != ''){	
					  $fundRequestUserDepartmentSubdetail = $this->FundRequestUserDepartmentSubdetails->newEmptyEntity();
					  $fundRequestUserDepartmentSubdetail->fund_request_user_department_detail_id	         = $insertid;
					  $fundRequestUserDepartmentSubdetail->project_work_id            = $value['project_id'];
					  $fundRequestUserDepartmentSubdetail->project_work_subdetail_id  = $value['work_id'];
					  $fundRequestUserDepartmentSubdetail->project_fund_request_detail_id  = $value['fund_request_id'];
					  $fundRequestUserDepartmentSubdetail->request_amount             = $value['request_amount'];
					  $fundRequestUserDepartmentSubdetail->created_by                 = $user->id;
					  $fundRequestUserDepartmentSubdetail->created_date               = date('Y-m-d H:i:s');
					  $this->FundRequestUserDepartmentSubdetails->save($fundRequestUserDepartmentSubdetail);
					  
					$fund_request_table      = $this->getTableLocator()->get('ProjectFundRequestDetails');
					$projectfund                        = $fund_request_table->get($value['fund_request_id']);
					if($this->request->getData('is_amount_receive_id') == 2){
					$projectfund->sent_to_user_department       = 1;
					}else{
					$projectfund->sent_to_user_department       = 2;
					}
					$fund_request_table->save($projectfund);
				  }				  
				 }
				}
	
				if($this->request->getData('is_amount_receive_id') == 1){	
					$opening_bal   = $this->request->getData('received_amount') + $balanceDetail['opening_balance'];
					$OpeningBalanceDetailsTable     = $this->getTableLocator()->get('OpeningBalanceDetails');
					$project                        = $OpeningBalanceDetailsTable->get($balanceDetail['id']);
					$project->opening_balance       = $opening_bal;
					$project->balance_date          =  date('Y-m-d');
					$OpeningBalanceDetailsTable->save($project);
				}
				$this->Flash->success(__('The Opening Balance details and logs has been saved.'));
				return $this->redirect(['action' => 'index']);
			}else{
				$this->Flash->error(__('The Opening Balance details  and logs could not be saved. Please, try again.'));
			}
        }
         $amount_received    = [1=>'Yes',2=>'No'];
        $this->set(compact('openingBalanceDetail', 'openingBalanceLogcount', 'role_id', 'amount_received','fund_request_projects'));
    }
  
    public function funddetailsedit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
		$this->OpeningBalanceDetails=$this->fetchTable('OpeningBalanceDetails');
		$this->FundRequestUserDepartmentDetails=$this->fetchTable('FundRequestUserDepartmentDetails');
        $this->FundRequestUserDepartmentSubdetails=$this->fetchTable('FundRequestUserDepartmentSubdetails');
     
        $openingBalanceLog = $this->OpeningBalanceLogs->get($id, [
            'contain' => [],
        ]);		
		
		     $fund_request_to_user         = $this->FundRequestUserDepartmentDetails->find('all')->where(['FundRequestUserDepartmentDetails.opening_balance_log_id' => $openingBalanceLog['id']])->first();
		     $fund_request_to_user_details = $this->FundRequestUserDepartmentSubdetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['FundRequestUserDepartmentSubdetails.fund_request_user_department_detail_id' => $fund_request_to_user['id']])->toArray();
		  
     		 //$fund_request_to_user_details = $this->FundRequestUserDepartmentSubdetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['FundRequestUserDepartmentSubdetails.fund_request_user_department_detail_id' => $fund_request_to_user['id']])->toArray();

		//echo "<pre>"; print_r($fund_request_to_user_details); exit();
		
        $div_id = $user->division_id;
        $role_id = $user->role_id;

        if($role_id == 6 || $role_id == 8 || $role_id == 16){
            $office_id = 1;
        } 		
		if($role_id == 6 || $role_id == 8 || $role_id == 16){
            $openingBalance = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.office_id' => 1])->count();
            $balanceDetail = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.office_id' => 1])->first();
            $openingBalanceLogcount = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.office_id' => 1])->count();
            $openingBalanceDetail = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.office_id' => 1])->first();
        }

        if ($this->request->is(['patch', 'post', 'put'])) { //echo "<pre>";  print_r($this->request->getData());  exit();  
            $openingBalanceLog->division_id           = ($div_id)?$div_id:'';
            $openingBalanceLog->office_id             = $office_id;
            $openingBalanceLog->balance_date          =  date('Y-m-d');
            $openingBalanceLog->payment_info          = $this->request->getData('is_amount_receive_id') == '1' ? '1' : '2';
            $openingBalanceLog->request_date          = ($this->request->getData('request_date') != '') ? date('Y-m-d', strtotime($this->request->getData('request_date'))) : '';
            $openingBalanceLog->request_amount        = $this->request->getData('request_amount');
            $openingBalanceLog->is_amount_received    = $this->request->getData('is_amount_received');
			$openingBalanceLog->received_date         = ($this->request->getData('received_date') != '') ? date('Y-m-d', strtotime($this->request->getData('received_date'))) : '';
            $openingBalanceLog->received_amount       = ($this->request->getData('received_amount') != '') ? $this->request->getData('received_amount') : '';
            $openingBalanceLog->modified_by           = $user->id;
            $openingBalanceLog->modified_date         = date('Y-m-d H:i:s');
			//echo "<pre>";  print_r($openingBalanceLog);  exit();    
            if ($this->OpeningBalanceLogs->save($openingBalanceLog)) {				
				//$fundRequestUserDepartmentDetail = $this->FundRequestUserDepartmentDetails->newEmptyEntity(); 				
				 $request_amt = $this->FundRequestUserDepartmentDetails->find('all')->where(['FundRequestUserDepartmentDetails.opening_balance_log_id'=>$id])->first();

                 $fundRequestUserDepartmentDetail = $this->FundRequestUserDepartmentDetails->get($request_amt['id'], [
					'contain' => [],
				]);				
				$fundRequestUserDepartmentDetail->request_date          = date('Y-m-d', strtotime($this->request->getData('request_date')));
				$fundRequestUserDepartmentDetail->request_amount        = $this->request->getData('tot_request_amount');
			    $fundRequestUserDepartmentDetail->opening_balance_log_id = $id;    
				$fundRequestUserDepartmentDetail->is_fund_received       = $this->request->getData('is_amount_received');
				$fundRequestUserDepartmentDetail->received_date         = ($this->request->getData('received_date') != '')?date('Y-m-d', strtotime($this->request->getData('received_date'))):NULL;
				$fundRequestUserDepartmentDetail->received_amount       = ($this->request->getData('received_amount') != '')?$this->request->getData('received_amount'):'';
				$fundRequestUserDepartmentDetail->created_by            = $user->id;
				$fundRequestUserDepartmentDetail->created_date          = date('Y-m-d H:i:s');
                if($this->FundRequestUserDepartmentDetails->save($fundRequestUserDepartmentDetail)){
					
					foreach ($this->request->getData('project') as $key => $value) {
					
					$fund_request_table      = $this->getTableLocator()->get('ProjectFundRequestDetails');
					$projectfund                        = $fund_request_table->get($value['fund_request_id']);
					if($this->request->getData('is_amount_received') == 2){
					$projectfund->sent_to_user_department       = 1;
					}else{
					$projectfund->sent_to_user_department       = 2;
					}
					$fund_request_table->save($projectfund);
					}			
				}
                //$this->Flash->success(__('The opening balance log has been saved.'));
				
				if($this->request->getData('is_amount_receive_id') == 1){	
					$opening_bal   = $this->request->getData('received_amount') + $balanceDetail['opening_balance'];
					$OpeningBalanceDetailsTable     = $this->getTableLocator()->get('OpeningBalanceDetails');
					$project                        = $OpeningBalanceDetailsTable->get($balanceDetail['id']);
					$project->opening_balance       = $opening_bal;
					$project->balance_date          =  date('Y-m-d');
					$OpeningBalanceDetailsTable->save($project);
				}
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The opening balance log could not be saved. Please, try again.'));
        }
       // $amount_received    = $this->OpeningBalanceLogs->IsAmountReceives->find('list', ['keyField' => 'id', 'valueField' => 'name'])->all();
	           $amount_received    = [1=>'Yes',2=>'No'];


        $this->set(compact('openingBalanceLog', 'amount_received', 'role_id','fund_request_to_user_details'));
    }

   
   
   public function funddetailsview($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');

        $this->OpeningBalanceDetails=$this->fetchTable('OpeningBalanceDetails');
        $this->FundRequestUserDepartmentDetails=$this->fetchTable('FundRequestUserDepartmentDetails');
        $this->FundRequestUserDepartmentSubdetails=$this->fetchTable('FundRequestUserDepartmentSubdetails');
     
        $openingBalanceLog = $this->OpeningBalanceLogs->get($id, [
            'contain' => [],
        ]);		
		
		     $fund_request_to_user         = $this->FundRequestUserDepartmentDetails->find('all')->where(['FundRequestUserDepartmentDetails.opening_balance_log_id' => $openingBalanceLog['id']])->first();
		     $fund_request_to_user_details = $this->FundRequestUserDepartmentSubdetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['FundRequestUserDepartmentSubdetails.fund_request_user_department_detail_id' => $fund_request_to_user['id']])->toArray();
		  
     		 //$fund_request_to_user_details = $this->FundRequestUserDepartmentSubdetails->find('all')->contain(['ProjectWorks','ProjectWorkSubdetails'])->where(['FundRequestUserDepartmentSubdetails.fund_request_user_department_detail_id' => $fund_request_to_user['id']])->toArray();

		//echo "<pre>"; print_r($fund_request_to_user_details); exit();
		
        $div_id = $user->division_id;
        $role_id = $user->role_id;

        if($role_id == 6 || $role_id == 8 || $role_id == 16){
            $office_id = 1;
        } 		
		if($role_id == 6 || $role_id == 8 || $role_id == 16){
            $openingBalance = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.office_id' => 1])->count();
            $balanceDetail = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.office_id' => 1])->first();
            $openingBalanceLogcount = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.office_id' => 1])->count();
            $openingBalanceDetail = $this->OpeningBalanceLogs->find('all')->where(['OpeningBalanceLogs.office_id' => 1])->first();
        }

      /* if ($this->request->is(['patch', 'post', 'put'])) { //echo "<pre>";  print_r($this->request->getData());  exit();  
            $openingBalanceLog->division_id           = ($div_id)?$div_id:'';
            $openingBalanceLog->office_id             = $office_id;
            $openingBalanceLog->balance_date          =  date('Y-m-d');
            $openingBalanceLog->payment_info          = $this->request->getData('is_amount_receive_id') == '1' ? '1' : '2';
            $openingBalanceLog->request_date          = ($this->request->getData('request_date') != '') ? date('Y-m-d', strtotime($this->request->getData('request_date'))) : '';
            $openingBalanceLog->request_amount        = $this->request->getData('request_amount');
            $openingBalanceLog->is_amount_received    = $this->request->getData('is_amount_received');
			$openingBalanceLog->received_date         = ($this->request->getData('received_date') != '') ? date('Y-m-d', strtotime($this->request->getData('received_date'))) : '';
            $openingBalanceLog->received_amount       = ($this->request->getData('received_amount') != '') ? $this->request->getData('received_amount') : '';
            $openingBalanceLog->modified_by           = $user->id;
            $openingBalanceLog->modified_date         = date('Y-m-d H:i:s');
			//echo "<pre>";  print_r($openingBalanceLog);  exit();    
            if ($this->OpeningBalanceLogs->save($openingBalanceLog)) {				
				//$fundRequestUserDepartmentDetail = $this->FundRequestUserDepartmentDetails->newEmptyEntity(); 				
				 $request_amt = $this->FundRequestUserDepartmentDetails->find('all')->where(['FundRequestUserDepartmentDetails.opening_balance_log_id'=>$id])->first();

                 $fundRequestUserDepartmentDetail = $this->FundRequestUserDepartmentDetails->get($request_amt['id'], [
					'contain' => [],
				]);				
				$fundRequestUserDepartmentDetail->request_date          = date('Y-m-d', strtotime($this->request->getData('request_date')));
				$fundRequestUserDepartmentDetail->request_amount        = $this->request->getData('tot_request_amount');
			    $fundRequestUserDepartmentDetail->opening_balance_log_id = $id;    
				$fundRequestUserDepartmentDetail->is_fund_received       = $this->request->getData('is_amount_received');
				$fundRequestUserDepartmentDetail->received_date         = ($this->request->getData('received_date') != '')?date('Y-m-d', strtotime($this->request->getData('received_date'))):NULL;
				$fundRequestUserDepartmentDetail->received_amount       = ($this->request->getData('received_amount') != '')?$this->request->getData('received_amount'):'';
				$fundRequestUserDepartmentDetail->created_by            = $user->id;
				$fundRequestUserDepartmentDetail->created_date          = date('Y-m-d H:i:s');
                if($this->FundRequestUserDepartmentDetails->save($fundRequestUserDepartmentDetail)){
					
					foreach ($this->request->getData('project') as $key => $value) {
					
					$fund_request_table      = $this->getTableLocator()->get('ProjectFundRequestDetails');
					$projectfund                        = $fund_request_table->get($value['fund_request_id']);
					if($this->request->getData('is_amount_received') == 2){
					$projectfund->sent_to_user_department       = 1;
					}else{
					$projectfund->sent_to_user_department       = 2;
					}
					$fund_request_table->save($projectfund);
					}			
				}
                //$this->Flash->success(__('The opening balance log has been saved.'));
				
				if($this->request->getData('is_amount_receive_id') == 1){	
					$opening_bal   = $this->request->getData('received_amount') + $balanceDetail['opening_balance'];
					$OpeningBalanceDetailsTable     = $this->getTableLocator()->get('OpeningBalanceDetails');
					$project                        = $OpeningBalanceDetailsTable->get($balanceDetail['id']);
					$project->opening_balance       = $opening_bal;
					$project->balance_date          =  date('Y-m-d');
					$OpeningBalanceDetailsTable->save($project);
				}
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The opening balance log could not be saved. Please, try again.'));
        }*/
       // $amount_received    = $this->OpeningBalanceLogs->IsAmountReceives->find('list', ['keyField' => 'id', 'valueField' => 'name'])->all();
	          // $amount_received    = [1=>'Yes',2=>'No'];


        $this->set(compact('openingBalanceLog', 'amount_received', 'role_id','fund_request_to_user_details'));
    }



   public function paymentinfo()
    {
        $this->viewBuilder()->setLayout('layout');
        $this->Divisions=$this->fetchTable('Divisions');

        if ($this->request->is(['post', 'patch', 'put'])) {
            $from_date        = date('Y-m-d', strtotime($this->request->getData('from_date')));
            $to_date          = date('Y-m-d', strtotime($this->request->getData('to_date')));
			$connection       = ConnectionManager::get('default');
            if ($from_date && $to_date) {
                $query                 = "SELECT 
                                logs.opening_balance AS opening,
                                logs.balance_date as date,
                                logs.payment_info  as info,
                                logs.received_amount as received
                                FROM opening_balance_logs as logs
                                where logs.balance_date BETWEEN '$from_date' AND '$to_date' ";
                $projects  = $connection->execute($query)->fetchAll('assoc');
            }
        }

        $info = array('Credit', 'Debit');
        $this->set(compact('payment', 'info', 'projects'));
    }
    public function divisionbasedreports()
    {
        $this->viewBuilder()->setLayout('layout');

        $this->Divisions=$this->fetchTable('Divisions');

        if ($this->request->is(['post', 'patch', 'put'])) {
            $month_date            =  ($this->request->getData('month_date') != '') ? date('m', strtotime($this->request->getData('month_date'))) : '';
            $connection            = ConnectionManager::get('default');
            $division_cond         = ($month_date  != '') ? " AND MONTH(logs.balance_date) = '" . $month_date . "'" : "";
            $divisions             = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
            $divisions_details = array();
            // echo "<pre>";
            // print_r($division_cond);
            // exit();
            foreach ($divisions as $key => $divisionvalue) {
                // echo "<pre>";
                // print_r($key);

                // if ($division) {
                //  echo "<pre>";  print_r($financial); exit();
                $query                 = "SELECT 
                                        logs.division_id as divid,
                                        logs.opening_balance AS opening,
                                        (CASE WHEN logs.payment_info=1 THEN SUM(logs.received_amount) ELSE 0 END)AS credited,
                                        (CASE WHEN logs.payment_info=2 THEN 2 ELSE 0 END)AS debited
                                  
                                        FROM opening_balance_logs as logs
                                        left join divisions as division on division.id=logs.division_id
                                        WHERE logs.is_active=1 and 
                                        logs.division_id= $key $division_cond";

                //MONTH(logs.created_date)='" .  $division . "' ";
                // echo "<pre>";
                // print_r($query);
                // exit();
                $projects  = $connection->execute($query)->fetchAll('assoc');
                $divisions_details[$key]['division_name']  = $divisionvalue;
                $divisions_details[$key]['divid']  = $projects[0]['divid'];
                $divisions_details[$key]['opening']  = $projects[0]['opening'];
                $divisions_details[$key]['credited']  = $projects[0]['credited'] != '' ? $projects[0]['credited'] : "";
                $divisions_details[$key]['debited']  = $projects[0]['debited'] != '' ? $projects[0]['debited'] : "";

                // echo "<pre>";
                // print_r($divisions_details);
                // exit();
                //}
            }

            // echo "<pre>";
            // print_r($key);
            // exit();
        }


        $this->set(compact('month_date', 'projects', 'divisions_details'));
    }

    public function ajaxdivisionwise($val = null, $month_date = null, $divid = null)
    {
        // echo "<pre>";
        // print_r($month_date);
        // exit();

        $division_cond         = ($month_date  != '') ? " AND MONTH(logs.balance_date) = '" . $month_date . "'" : "";

        $connection        = ConnectionManager::get('default');
        if ($val == 1) {

            $sql = "SELECT


                logs.opening_balance as opening,
                (CASE WHEN logs.payment_info=1 THEN (logs.received_amount) ELSE 0 END) AS credited
                FROM opening_balance_logs as logs where logs.payment_info=1 and logs.division_id =  '$divid' $division_cond";


            $projectdetails      = $connection->execute($sql)->fetchAll('assoc');

            // echo "<pre>";
            // print_r($projectdetails);
            // exit();
        } elseif ($val == 2) {

            $sql2 = "SELECT  

            logs.received_amount as amount,
            logs.balance_date as date

            FROM opening_balance_logs as logs where logs.division_id =  '$divid' $division_cond";


            $projectdetails      = $connection->execute($sql2)->fetchAll('assoc');

            // echo "<pre>";
            // print_r($sql2);
            // exit();
        }

        $this->set(compact('projectdetails', 'val'));
    }	
}