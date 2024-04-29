<?php

declare(strict_types=1);

namespace App\Controller;


class OpeningBalanceDetailsController extends AppController
{
   
    public function index()
    {
        $this->set(compact('openingBalanceDetails'));

        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $div_id = $user->division_id;
        $role_id = $user->role_id;
        $user_id = $user->id;
  
        if ($role_id == 6 || $role_id == 8  || $role_id == 16) {
            $openingBalanceDetailcount = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.office_id' => 1])->count();
            $openingBalanceDetails = $this->OpeningBalanceDetails->find('all')->contain(['Offices'])->where(['OpeningBalanceDetails.office_id' => 1])->toArray();
            //$openingBalanceDetail = $this->OpeningBalanceDetails->find('all')->count();

        } elseif ($role_id == 4) {
            $openingBalanceDetailcount = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.division_id' => $div_id])->count();
            $openingBalanceDetails = $this->OpeningBalanceDetails->find('all')->contain(['Offices','Divisions'])->where(['OpeningBalanceDetails.division_id' => $div_id])->toArray();
            // $openingBalanceDetail = $this->OpeningBalanceDetails->find('all')->count();
        }
		
		//echo "<pre>"; print_r($openingBalanceDetails); exit();

        $this->set(compact('openingBalanceDetailcount', 'openingBalanceDetails','role_id','user_id'));
    }

   
    public function view($id = null)
    {
        $openingBalanceDetail = $this->OpeningBalanceDetails->get($id, [
            'contain' => ['Offices', 'Divisions'],
        ]);

        $this->set(compact('openingBalanceDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function openingbalance($id = null)
    {

        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $div_id = $user->division_id;
        // $office_id = $user->role_id;
        $this->OpeningBalanceLogs=$this->fetchTable('OpeningBalanceLogs');
        $role_id = $user->role_id;



        if($role_id == 6 || $role_id == 8  || $role_id == 16){

            $openingBalanceDetails = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.office_id' => 1])->count();
            $balanceDetail = $this->OpeningBalanceDetails->find('all')->contain(['Offices','Divisions'])->where(['OpeningBalanceDetails.office_id' => 1])->first();
        }elseif($role_id == 4){
            $openingBalanceDetails = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.division_id' => $div_id])->count();
            $balanceDetail = $this->OpeningBalanceDetails->find('all')->contain(['Offices','Divisions'])->where(['OpeningBalanceDetails.division_id' => $div_id])->first();
        }


        if ($role_id == 6 || $role_id == 8 || $role_id == 16) {
            $office_id = 1;
        } elseif ($role_id == 4) {
            $office_id = 2;
        }

        if ($this->request->is('post', 'patch', 'put')) {// echo "<pre>"; print_r($this->request->getData()); exit();

            $openingBalanceDetail = $this->OpeningBalanceDetails->newEmptyEntity();
            $openingBalanceDetail->opening_balance    =  $this->request->getData('opening_balance');
            $openingBalanceDetail->office_id          =  $office_id;
            $openingBalanceDetail->balance_date       =  date('Y-m-d');
            $openingBalanceDetail->division_id        =  ($div_id)?$div_id:null;
            $openingBalanceDetail->created_by         =  $user->id;
            $openingBalanceDetail->created_date       =  date('Y-m-d H:i:s'); 
			//echo "<pre>"; print_r($openingBalanceDetail); exit();
            if ($this->OpeningBalanceDetails->save($openingBalanceDetail)) {

                $openingBalanceLog    = $this->OpeningBalanceLogs->newEmptyEntity();
                $openingBalanceLog->office_id            = $office_id;
                $openingBalanceLog->division_id          = ($div_id)?$div_id:'';
                $openingBalanceLog->opening_balance      = $openingBalanceDetail['opening_balance'];
		        $openingBalanceLog->balance_date         = date('Y-m-d');
                $openingBalanceLog->payment_info         = 1;
                $openingBalanceLog->created_by           = $user->id;
                $openingBalanceLog->created_date         = date('Y-m-d H:i:s');

               if ($this->OpeningBalanceLogs->save($openingBalanceLog)) {

                    $this->Flash->success(__('The Opening Balance details and logs has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The Opening Balance details  and logs could not be saved. Please, try again.'));
                }
            }
        }

        $this->set(compact('balanceDetail', 'openingbal', 'openingbals', 'openingBalanceDetail', 'role_id', 'openingBalanceDetails','openingBalanceLog'));
    }

    public function edit($id = null)
    {

        $this->OpeningBalanceLogs=$this->fetchTable('OpeningBalanceLogs');
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $div_id = $user->division_id;

        $openingbal           = $this->OpeningBalanceDetails->find('all')->count();
        $openingbals          = $this->OpeningBalanceDetails->find('all')->where(['OpeningBalanceDetails.is_active' => 1])->toArray();
        // echo "<pre>";
        // print_r($openingbal);
        // exit();
        $openingBalanceDetail = $this->OpeningBalanceDetails->newEmptyEntity();

        if ($this->request->is('post', 'patch', 'put')) {
            // echo "<pre>";
            // print_r($this->request->getData());
            // exit();
            $openingBalanceDetail->opening_balance      =  $this->request->getData('opening_balance') + $opening;
            $openingBalanceDetail->division_id          =  $div_id;
            //$openingBalanceDetail->office_id          =  $office_id;
            $openingBalanceDetail->created_by           =  $user->id;

            $openingBalanceDetail->created_date         =  date('Y-m-d H:i:s');


            // echo "<pre>";
            // print_r($openingBalanceDetail);
            // exit();
            if ($this->OpeningBalanceDetails->save($openingBalanceDetail)) {

                if ($openingbal['id'] > 0) {
                    $openingBalanceDetail = $this->OpeningBalanceDetails->get($id, [
                        'contain' => [],
                    ]);
                }
                // echo "<pre>";
                // print_r($openinglogs);
                // exit();
                else {

                    $openingBalanceLog                    = $this->OpeningBalanceLogs->newEmptyEntity();
                }

                $openingBalanceLog->opening_balance     = $openingBalanceDetail['opening_balance'];

                $openingBalanceLog->division_id         = $div_id;
                // $openingBalanceLog->office_id        = $office_id;
                $openingBalanceLog->created_by          = $user->id;
                $openingBalanceLog->created_date        = date('Y-m-d H:i:s');
                // echo "<pre>";
                // print_r($openingBalanceLog);
                // exit();

                if ($this->OpeningBalanceLogs->save($openingBalanceLog)) {

                    $this->Flash->success(__('The Opening Balance details and logs has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The Opening Balance details  and logs could not be saved. Please, try again.'));
                }
            }
        }
        $this->set(compact('openingbal', 'openingbals', 'openingBalanceDetail'));
    }

    
}
