<?php
declare(strict_types=1);
namespace App\Controller;

class PdaccountDebitDetailsController extends AppController
{   
    public function index()
    {
        $this->viewBuilder()->setLayout('layout');       
        $pdaccountDebitDetails  = $this->PdaccountDebitDetails->find('all')->toArray();
        $this->set(compact('pdaccountDebitDetails'));
    }
    
    public function view($id = null)
    {
        $pdaccountDebitDetail = $this->PdaccountDebitDetails->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('pdaccountDebitDetail'));
    }
   
    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
		$this->OpeningBalanceLogs=$this->fetchTable('OpeningBalanceLogs');
		$this->OpeningBalanceDetails=$this->fetchTable('OpeningBalanceDetails');

        $user = $this->request->getAttribute('identity');
        $pdaccountDebitDetail = $this->PdaccountDebitDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $pdaccountDebitDetail->fund_debit_date    = date('Y-m-d',strtotime($this->request->getData('fund_debit_date')));
            $pdaccountDebitDetail->fund_debit_amount         = $this->request->getData('fund_debit_amount');
            $pdaccountDebitDetail->remarks         = $this->request->getData('remarks');
            $pdaccountDebitDetail->created_by          = $user->id;
            $pdaccountDebitDetail->created_date        =date('Y-m-d H:i:s');
            if ($this->PdaccountDebitDetails->save($pdaccountDebitDetail)) {
				$insert_id = $pdaccountDebitDetail->id;
				$hobalancedetail       = $this->OpeningBalanceDetails->find('all')->contain(['Offices','Divisions'])->where(['OpeningBalanceDetails.office_id' => 1])->first();

		     // HO Debit details   							   
			   if($hobalancedetail != ''){	
					$hoopening   = $hobalancedetail['opening_balance'] - $this->request->getData('fund_debit_amount');	  	
				}					  
				$openingBalanceLog   = $this->OpeningBalanceLogs->newEmptyEntity();
				$openingBalanceLog->division_id           = null;
				$openingBalanceLog->office_id             = 1;
				$openingBalanceLog->opening_balance       = $hoopening;
				$openingBalanceLog->balance_date          = date('Y-m-d');
				$openingBalanceLog->payment_info          = 2;
				$openingBalanceLog->transaction_amount    = $this->request->getData('fund_debit_amount');
				$openingBalanceLog->pdaccount_debit_detail_id    = $insert_id;
				$openingBalanceLog->uc_received           = 0.00;
				$openingBalanceLog->is_amount_received    = 0;
				$openingBalanceLog->received_date         = null;
				$openingBalanceLog->received_amount       = null;
				$openingBalanceLog->created_by            = $user->id;
				$openingBalanceLog->created_date          = date('Y-m-d H:i:s');
				//echo "<pre>"; print_r($openingBalanceLog); exit();
				if ($this->OpeningBalanceLogs->save($openingBalanceLog)) {
					$OpeningBalanceDetailsTable     = $this->getTableLocator()->get('OpeningBalanceDetails');
					$project                        = $OpeningBalanceDetailsTable->get($hobalancedetail['id']);
					$project->opening_balance       = $hoopening;
					$project->balance_date          = date('Y-m-d');
					$OpeningBalanceDetailsTable->save($project);
				}
                $this->Flash->success(__('The pdaccount debit detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }else{
            $this->Flash->error(__('The pdaccount debit detail could not be saved. Please, try again.'));
			}
        }
        $this->set(compact('pdaccountDebitDetail'));
    }
   
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $pdaccountDebitDetail = $this->PdaccountDebitDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pdaccountDebitDetail = $this->PdaccountDebitDetails->patchEntity($pdaccountDebitDetail, $this->request->getData());            
            $pdaccountDebitDetail->fund_debit_date    = date('Y-m-d',strtotime($this->request->getData('fund_debit_date')));
            $pdaccountDebitDetail->fund_debit_amount         = $this->request->getData('fund_debit_amount');
            $pdaccountDebitDetail->remarks         = $this->request->getData('remarks');
            $pdaccountDebitDetail->modified_by          = $user->id;
            $pdaccountDebitDetail->modified_date        =date('Y-m-d H:i:s');
            if ($this->PdaccountDebitDetails->save($pdaccountDebitDetail)) {
                $this->Flash->success(__('The pdaccount debit detail has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pdaccount debit detail could not be updated. Please, try again.'));
        }
        $this->set(compact('pdaccountDebitDetail'));
    }
   
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pdaccountDebitDetail = $this->PdaccountDebitDetails->get($id);
        if ($this->PdaccountDebitDetails->delete($pdaccountDebitDetail)) {
            $this->Flash->success(__('The pdaccount debit detail has been deleted.'));
        } else {
            $this->Flash->error(__('The pdaccount debit detail could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}