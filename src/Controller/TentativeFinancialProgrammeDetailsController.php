<?php

declare(strict_types=1);

namespace App\Controller;


class TentativeFinancialProgrammeDetailsController extends AppController
{

    public function index()
    {
        $this->viewBuilder()->setLayout('layout');
        $tentativeFinancialProgrammeDetails    = $this->TentativeFinancialProgrammeDetails->find('all')->where(['TentativeFinancialProgrammeDetails.is_active' => 1])->contain(['FinancialYears', 'Divisions'])->toArray();
        $this->set(compact('tentativeFinancialProgrammeDetails'));
    }


    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');

        $tentativeFinancialProgrammeDetail = $this->TentativeFinancialProgrammeDetails->get($id, [
            'contain' => ['FinancialYears', 'Divisions'],
        ]);

        $this->set(compact('tentativeFinancialProgrammeDetail'));
    }


    public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $division_id = $user->division_id;
        // echo"<pre>";print_r($user);exit();

        $tentativeFinancialProgrammeDetail = $this->TentativeFinancialProgrammeDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            // echo"<pre>";print_r($_POST);exit();
            // $tentativeFinancialProgrammeDetail = $this->TentativeFinancialProgrammeDetails->patchEntity($tentativeFinancialProgrammeDetail, $this->request->getData());

            $tentativeFinancialProgrammeDetail->financial_year_id        =  $this->request->getData('financial_year_id');
            $tentativeFinancialProgrammeDetail->division_id              =  $user->division_id;
            $tentativeFinancialProgrammeDetail->apr                      =  $this->request->getData('apr');
            $tentativeFinancialProgrammeDetail->may                      =  $this->request->getData('may');
            $tentativeFinancialProgrammeDetail->june                     =  $this->request->getData('june');
            $tentativeFinancialProgrammeDetail->july                     =  $this->request->getData('july');
            $tentativeFinancialProgrammeDetail->aug                      =  $this->request->getData('aug');
            $tentativeFinancialProgrammeDetail->sep                      =  $this->request->getData('sep');
            $tentativeFinancialProgrammeDetail->oct                      =  $this->request->getData('oct');
            $tentativeFinancialProgrammeDetail->nov                      =  $this->request->getData('nov');
            $tentativeFinancialProgrammeDetail->dece                      =  $this->request->getData('dece');
            $tentativeFinancialProgrammeDetail->jan                      =  $this->request->getData('jan');
            $tentativeFinancialProgrammeDetail->feb                      =  $this->request->getData('feb');
            $tentativeFinancialProgrammeDetail->mar                      =  $this->request->getData('mar');
            $tentativeFinancialProgrammeDetail->total_amount            =  $this->request->getData('total_amount');
            $tentativeFinancialProgrammeDetail->created_by              =  $user->id;
            $tentativeFinancialProgrammeDetail->created_date            =  date('Y-m-d:h:m:s');
            // echo"<pre>";print_r($tentativeFinancialProgrammeDetail);exit();
            $financial_year_div_check = $this->TentativeFinancialProgrammeDetails->find('all')->where([
                    'TentativeFinancialProgrammeDetails.financial_year_id' => $this->request->getData('financial_year_id'),
                    'TentativeFinancialProgrammeDetails.division_id' => $division_id
                ])->count();
            // echo"<pre>";print_r($financial_year_div_check );exit();

            if ($financial_year_div_check > 0) {
                $this->Flash->error(__('Financial Year And Division is already exits'));
            } else {
                if ($this->TentativeFinancialProgrammeDetails->save($tentativeFinancialProgrammeDetail)) {
                    $this->Flash->success(__('The tentative financial programme detail has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The tentative financial programme detail could not be saved. Please, try again.'));
            }
        }
        $financialYears = $this->TentativeFinancialProgrammeDetails->FinancialYears->find('list', ['limit' => 200])->all();
        $this->set(compact('tentativeFinancialProgrammeDetail', 'financialYears', 'division_id'));
    }

    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->request->getAttribute('identity');
        $division_id = $user->division_id;

        $tentativeFinancialProgrammeDetail = $this->TentativeFinancialProgrammeDetails->get($id, [
            'contain' => ['FinancialYears', 'Divisions'],
        ]);
    //    echo"<pre>";print_r($tentativeFinancialProgrammeDetail);exit();

        if ($this->request->is(['patch', 'post', 'put'])) {
            // echo"<pre>";print_r($_POST);exit();


            $tentativeFinancialProgrammeDetail->financial_year_id        =  $this->request->getData('financial_year_id');
            $tentativeFinancialProgrammeDetail->division_id              =  $division_id;
            $tentativeFinancialProgrammeDetail->apr                      =  $this->request->getData('apr');
            $tentativeFinancialProgrammeDetail->may                      =  $this->request->getData('may');
            $tentativeFinancialProgrammeDetail->june                     =  $this->request->getData('june');
            $tentativeFinancialProgrammeDetail->july                     =  $this->request->getData('july');
            $tentativeFinancialProgrammeDetail->aug                      =  $this->request->getData('aug');
            $tentativeFinancialProgrammeDetail->sep                      =  $this->request->getData('sep');
            $tentativeFinancialProgrammeDetail->oct                      =  $this->request->getData('oct');
            $tentativeFinancialProgrammeDetail->nov                      =  $this->request->getData('nov');
            $tentativeFinancialProgrammeDetail->dece                     =  $this->request->getData('dece');
            $tentativeFinancialProgrammeDetail->jan                      =  $this->request->getData('jan');
            $tentativeFinancialProgrammeDetail->feb                      =  $this->request->getData('feb');
            $tentativeFinancialProgrammeDetail->mar                      =  $this->request->getData('mar');
            $tentativeFinancialProgrammeDetail->total_amount             =  $this->request->getData('total_amount');
            $tentativeFinancialProgrammeDetail->modifited_by               =  $user->id;
            $tentativeFinancialProgrammeDetail->modifited_date             =  date('Y-m-d:h:m:s');

                if ($this->TentativeFinancialProgrammeDetails->save($tentativeFinancialProgrammeDetail)) {
                    $this->Flash->success(__('The tentative financial programme detail has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The tentative financial programme detail could not be saved. Please, try again.'));
            
        }
        $financialYears = $this->TentativeFinancialProgrammeDetails->FinancialYears->find('list', ['limit' => 200])->all();
        $this->set(compact('tentativeFinancialProgrammeDetail', 'financialYears', 'division_id'));
    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tentativeFinancialProgrammeDetail = $this->TentativeFinancialProgrammeDetails->get($id);
        if ($this->TentativeFinancialProgrammeDetails->delete($tentativeFinancialProgrammeDetail)) {
            $this->Flash->success(__('The tentative financial programme detail has been deleted.'));
        } else {
            $this->Flash->error(__('The tentative financial programme detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function ajaxfinancial($year, $division)
    {

        $this->TentativeFinancialProgrammeDetails=$this->fetchTable('TentativeFinancialProgrammeDetails');
        $financial_year    = $this->TentativeFinancialProgrammeDetails->find('all')->where(['TentativeFinancialProgrammeDetails.financial_year_id' => $year, 'TentativeFinancialProgrammeDetails.division_id' => $division])->count();
        if ($financial_year > 0) {
            echo "1";
            // echo"<span style='color:red'> Email already exists .</span>";
        } else {
            echo "0";
        }
        exit();
        //$this->set(compact('financial_year'));
    }
}
