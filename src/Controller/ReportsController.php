<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Locator\LocatorAwareTrait;

class ReportsController extends AppController
{
    
   public function dashboard()
  {
    $this->viewBuilder()->setLayout('layout');
    $user = $this->request->getAttribute('identity');
    $role_id     = $user->role_id;
    $division_id = $user->division_id;

    if ($role_id == 1 || $role_id == 5) {
        $condition = "";
    } else {
        $condition = " AND project.division_id = '" . $division_id . "'";
    }

    $connection = ConnectionManager::get('default');
    $query                  =  "SELECT count(project.id) as pwcount
                                 from project_work_subdetails as project 
                                 where project.is_active=1 $condition";
    $TotalProjectCount      = $connection->execute($query)->fetchAll('assoc');

    $query1                 =  "SELECT count(project.id) as pwcount
                               from project_work_subdetails as project 
                               where project.is_work_completed=0 AND project.is_active=1 $condition";
    $progressCount          = $connection->execute($query1)->fetchAll('assoc');

    $query2                 =  "SELECT 
                               count(project.id) as pwcount
                               from project_work_subdetails as project 
                               where project.is_work_completed=1 AND project.is_active=1 $condition";
    $Totalcompletecount      = $connection->execute($query2)->fetchAll('assoc');

    // print_r($tot_progress_count);exit();  

    $this->set(compact('progressCount', 'Totalcompletecount', 'TotalProjectCount'));
  }

  public function ajaxprojectwise($val = NULL)
  {

		$user = $this->request->getAttribute('identity');
		$role_id     = $user->role_id;
		$division_id = $user->division_id;

		if ($role_id == 1 || $role_id == 5) {
			$rolecondition = "";
		} else {
			$rolecondition = " AND work.division_id = '" . $division_id . "'";
		}

		$connection        = ConnectionManager::get('default');

		// echo"<pre>";print_r($emp_desgn);exit();
		if ($val == 1) {
			$Cond = "";
		} elseif ($val == 2) {

			$Cond = " AND work_subdetails.is_work_completed=0";
		} elseif ($val == 3) {
			$Cond = " AND work_subdetails.is_work_completed=1";
		}

						$sql="SELECT  department.name as dname,
						financial_year.name as financial_yeartname,
						building_type.name as building_typename,
						division.name as division_name,
						project_work_statuse.name as pws,
						project_work.project_name as project_name,
						project_work.project_amount as amount,
						project_work.project_code as project_code 
						FROM project_work_subdetails as work_subdetails
						LEFT JOIN project_works as project_work on project_work.id = work_subdetails.project_work_id
						LEFT JOIN departments as department on department.id = project_work.department_id
						LEFT JOIN financial_years as  financial_year on financial_year.id = project_work.financial_year_id
						LEFT JOIN building_types as building_type on building_type.id = project_work.building_type_id
						LEFT JOIN divisions as division on division.id = work_subdetails.division_id
						LEFT JOIN project_work_statuses as project_work_statuse on project_work_statuse.id = work_subdetails.project_work_status_id
						where work_subdetails.is_active=1 $Cond $rolecondition";


		$projectdetails      = $connection->execute($sql)->fetchAll('assoc');
		// print_r($sql);exit();
		$this->set(compact('projectdetails'));
	}

  /*public function projectwiseestimates($id = null, $work_id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $this->loadModel('BuildingItems');
        $this->loadModel('ProjectwiseEstimatesDetails');
        $this->loadModel('ProjectwiseEstimatesSubdetails');
        $user = $this->request->getAttribute('identity');
        $ProjectwiseEstimatesDetail = $this->ProjectwiseEstimatesDetails->newEmptyEntity();

        if ($this->request->is('post')) {
            $attachment  = $this->request->getData('file_upload');
            if ($attachment->getClientFilename() != '') {
                $name    = $attachment->getClientFilename();
                $type    = $attachment->getClientMediaType();
                $size    = $attachment->getSize();
                $tmpName = $attachment->getStream()->getMetadata('uri');
                $error   = $attachment->getError();
                if ($name != '' && $error == 0) {
                    $file                                   =  $name;
                    $tempFile                               =  $tmpName;
                    $targetPath                             =  'uploads/projectwiseestimates/';
                    $targetFile                             =  $targetPath . $file;
                    //echo"<pre>"; print_r($targetFile);exit();
                    move_uploaded_file($tempFile, $targetFile);
                    // $storagename    = 'projectdevelopmentfiles/'.$name;
                    $uploadedStatus = 1;
                    $inputFileName  = $targetFile;
                    $objPHPExcel    = PHPExcel_IOFactory::load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true);
                    // echo "<pre>";
                    // print_r($allDataInSheet);
                    // exit();
                    $arrayCount     = count($allDataInSheet);
                    // $j = 1;
                    // $k = 0;
                    for ($i = 2; $i <= $arrayCount; $i++) {
                        $item_code   = $allDataInSheet[$i]["A"];
                        // $item_code_string = sprintf('%d', $item_code);
                        // echo "<pre>";
                        // print_r($item_code);
                        // exit();
                        $itemcount   = $this->BuildingItems->find('all')->where(['BuildingItems.item_code' => $item_code])->count();
                     
                        $entrycount   = $this->ProjectwiseEstimatesDetails->find('all')->where(['ProjectwiseEstimatesDetails.item_code' => $item_code])->count();
                        if($entrycount > 0){
                        $estimatedetail  = $this->ProjectwiseEstimatesDetails->find('all')->where(['ProjectwiseEstimatesDetails.item_code' => $item_code])->first();
                        //    echo "<pre>";  print_r($estimatedetail); exit();
                         }
                        if ($itemcount != 0) {
                            if($entrycount == 0){
                            $ProjectwiseEstimatesDetail = $this->ProjectwiseEstimatesDetails->newEmptyEntity();
                            }else{
                            $ProjectwiseEstimatesDetail = $this->ProjectwiseEstimatesDetails->get($estimatedetail['id'], [
                                'contain' => [],
                            ]);
                            }

                            $ProjectwiseEstimatesDetail->project_work_id           = $id;
                            $ProjectwiseEstimatesDetail->project_work_subdetail_id = $work_id;
                            $ProjectwiseEstimatesDetail->item_code                 = $item_code;
                            $ProjectwiseEstimatesDetail->created_by                = $user->id;
                            $ProjectwiseEstimatesDetail->created_date              = date('Y-m-d H:i:s');
                            //    echo "<pre>"; print_r($ProjectwiseEstimatesDetail);exit();

                            if ($this->ProjectwiseEstimatesDetails->save($ProjectwiseEstimatesDetail)) {
                                if($entrycount == 0){
                                    $insert_id = $ProjectwiseEstimatesDetail->id;
                                }else{
                                    $insert_id = $estimatedetail['id'];
                                }
                                   if($allDataInSheet[$i]["C"] != ''){
                                    $projectwiseEstimatesSubdetail = $this->ProjectwiseEstimatesSubdetails->newEmptyEntity();
                                    $projectwiseEstimatesSubdetail->projectwise_estimates_detail_id  = $insert_id;
                                    $projectwiseEstimatesSubdetail->item_code           =$allDataInSheet[$i]["A"];
                                    $projectwiseEstimatesSubdetail->description         =$allDataInSheet[$i]["B"];
                                    $projectwiseEstimatesSubdetail->number1             =$allDataInSheet[$i]["C"];
                                    $projectwiseEstimatesSubdetail->number2             =$allDataInSheet[$i]["D"];
                                    $projectwiseEstimatesSubdetail->length              =$allDataInSheet[$i]["E"];
                                    $projectwiseEstimatesSubdetail->breath              =$allDataInSheet[$i]["F"];
                                    $projectwiseEstimatesSubdetail->depth               =$allDataInSheet[$i]["G"];
                                    $projectwiseEstimatesSubdetail->quantity            =$allDataInSheet[$i]["H"];
                                    $projectwiseEstimatesSubdetail->created_by          = $user->id;
                                    $projectwiseEstimatesSubdetail->created_date        = date('Y-m-d H:i:s');
                                    // echo "<pre>";
                                    // print_r($projectwiseEstimatesSubdetail);
                                    // exit();
                                    $this->ProjectwiseEstimatesSubdetails->save($projectwiseEstimatesSubdetail);
                                   }
                                  if($allDataInSheet[$i]["B"] == '' &&$allDataInSheet[$i]["G"] == 'say'){

                                    $subdetailTable                 = $this->getTableLocator()->get('ProjectwiseEstimatesDetails');
                                    $project                        = $subdetailTable->get($estimatedetail['id']);
                                    $project->total_quantity        = $allDataInSheet[$i]["H"];
                                    $project->unit                  = $allDataInSheet[$i]["I"];
                                    $subdetailTable->save($project);

                                  }
                            }
                        }
                    }
                }
            }
        }
    }*/

  /*public function ajaxdepartment($key = null, $type = null)
  {
    //    echo"<pre>";print_r($type);exit();
        $user = $this->request->getAttribute('identity');
        $userid =  $user->id;
        $connection        = ConnectionManager::get('default');

        if ($type == 1) {
            $Cond = "";
        } elseif ($type == 2) {
            $Cond = "AND work_subdetails.is_work_completed=0";
        } elseif ($type == 3) {
            $Cond = "AND work_subdetails.is_work_completed=1 ";
        }
        $sql = "SELECT  department.name as dname,
        financial_year.name as financial_yeartname,
        building_type.name as building_typename,
        division.name as division_name,
        project_work_statuse.name as pws,
		work_subdetails.work_name as work_name,
		work_subdetails.work_code as work_code,
		work_subdetails.sanctioned_amount as sanctioned_amount,
                      
        project_work.project_name as project_name,work_subdetails.id as work_id,work_subdetails.project_work_id as project_id
        FROM project_work_subdetails as work_subdetails
        LEFT JOIN project_works as project_work on project_work.id = work_subdetails.project_work_id
        LEFT JOIN departments as department on department.id = project_work.department_id
        LEFT JOIN financial_years as  financial_year on financial_year.id = project_work.financial_year_id
        LEFT JOIN building_types as building_type on building_type.id = project_work.building_type_id
        LEFT JOIN divisions as division on division.id = work_subdetails.division_id
        LEFT JOIN project_work_statuses as project_work_statuse on project_work_statuse.id = work_subdetails.project_work_status_id
        where project_work.department_id=$key  $Cond";
        $prjectdetails             = $connection->execute($sql)->fetchAll('assoc');
        // echo"<pre>"; print_r($sql);exit();
        $this->set(compact('prjectdetails'));
    }*/

  /*public function ajaxdivisiontwisereport($id = NULL, $type = NULL)
  {
        //   echo"<pre>";print_r($type);exit();
        $user = $this->request->getAttribute('identity');
        $userid =  $user->id;
        $connection        = ConnectionManager::get('default');
        if ($type == 1) {
            $Cond = "";
        } elseif ($type == 2) {
            $Cond = "AND work_subdetails.is_work_completed=0";
                    //   echo"<pre>";print_r($Cond);exit();

        } elseif ($type == 3) {
            $Cond = "AND work_subdetails.is_work_completed=1";
        }
        $sql          = "SELECT  department.name as dname,
                        financial_year.name as financial_yeartname,
                        building_type.name as building_typename,
                        division.name as division_name,
                        project_work_statuse.name as pws,
						work_subdetails.work_name as work_name,
						work_subdetails.work_code as work_code,
						work_subdetails.sanctioned_amount as sanctioned_amount,
                        project_work.project_name as project_name,work_subdetails.id as work_id,work_subdetails.project_work_id as project_id
                        FROM project_work_subdetails as work_subdetails
                        LEFT JOIN project_works as project_work on project_work.id = work_subdetails.project_work_id
                        LEFT JOIN departments as department on department.id = project_work.department_id
                        LEFT JOIN financial_years as  financial_year on financial_year.id = project_work.financial_year_id
                        LEFT JOIN building_types as building_type on building_type.id = project_work.building_type_id
                        LEFT JOIN divisions as division on division.id = work_subdetails.division_id
                        LEFT JOIN project_work_statuses as project_work_statuse on project_work_statuse.id = work_subdetails.project_work_status_id
                        where work_subdetails.division_id=$id $Cond";
        //   echo"<pre>";print_r($sql);exit();

        $prjectdetails             = $connection->execute($sql)->fetchAll('assoc');
        $this->set(compact('prjectdetails'));
    }*/	
	
  public function ajaxdepartment($key = null, $type = null, $work_type = NULL,$fin_year =NULL)
  {  

	$this->ProjectMonitoringDetails=$this->fetchTable('ProjectMonitoringDetails');

   $user = $this->request->getAttribute('identity');
    $userid =  $user->id;
    $role_id =  $user->role_id;
	$division_id = $user->division_id;
	$circle_id = $user->circle_id;
	if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
	$condition = " and work_subdetails.division_id = " . $division_id . "";
	} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
	$condition = " and work_subdetails.circle_id = " . $circle_id . "";
	} else {
	$condition = "";
	}
	if($fin_year !=  ''){
	$financial_year_cond     = ($fin_year  != '0') ? " AND project_work.financial_year_id = '" . $fin_year . "'" : "";
	}
    $connection        = ConnectionManager::get('default');

    if ($type == 1) {
        $Cond = "";
    } elseif ($type == 2) {
        $Cond = "AND work_subdetails.project_work_status_id>=1";
        //   echo"<pre>";print_r($Cond);exit();

    } elseif ($type == 3) {
        $Cond = "AND work_subdetails.project_work_status_id>=3";
    } elseif ($type == 4) {
        $Cond = "AND work_subdetails.project_work_status_id>=5";
    } elseif ($type == 5) {
        $Cond = " AND work_subdetails.project_work_status_id>=11";
        // echo "<pre>";
        // print_r($Cond);
        // exit();
    } elseif ($type == 6) {
        $Cond = "AND  work_subdetails.project_work_status_id=19";
    }
	if($work_type != ''){
		$work_type_con = " and work_subdetails.work_type = " . $work_type . "";
		
	}
    $sql = "SELECT  department.name as dname,
    financial_year.name as financial_yeartname,
    building_type.name as building_typename,
    division.name as division_name,
    project_work_statuse.name as pws,
    work_subdetails.work_name as work_name,
    work_subdetails.work_code as work_code,
	work_subdetails.work_type as work_type,
    work_subdetails.fs_amount as sanctioned_amount,
	work_subdetails.tentative_completion_date as tentative_completion_date,
	work_subdetails.id as sub_detail_id,
    san.go_no as go_no,              
    project_work.ref_no as ref_no,               
    project_work.project_name as project_name,work_subdetails.id as work_id,work_subdetails.project_work_id as project_id
    FROM project_work_subdetails as work_subdetails
    LEFT JOIN project_works as project_work on project_work.id = work_subdetails.project_work_id
	LEFT JOIN project_administrative_sanctions as san on san.project_work_id = project_work.id
    LEFT JOIN departments as department on department.id = project_work.department_id
    LEFT JOIN financial_years as  financial_year on financial_year.id = project_work.financial_year_id
    LEFT JOIN building_types as building_type on building_type.id = project_work.building_type_id
    LEFT JOIN divisions as division on division.id = work_subdetails.division_id
    LEFT JOIN project_work_statuses as project_work_statuse on project_work_statuse.id = work_subdetails.project_work_status_id
    where project_work.department_id=$key and work_subdetails.is_active = 1  $Cond $condition $work_type_con $financial_year_cond ";
    $prjectdetails             = $connection->execute($sql)->fetchAll('assoc');
	
	$monitoringcount = array();
	$monitoring = array();
	$physicallly_completed = array();
	foreach($prjectdetails as $project){
		
	  $monitoringcount[$project['sub_detail_id']] = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_subdetail_id' => $project['sub_detail_id']])->count();
      
	 if($monitoringcount[$project['sub_detail_id']] > 0){
	 $monitoring[$project['sub_detail_id']]    = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages', 'FinancialPercentages'])->where(['ProjectMonitoringDetails.project_work_subdetail_id' =>$project['sub_detail_id']])->order(['ProjectMonitoringDetails.id'=>'DESC'])->first();
     $physicallly_completed[$project['sub_detail_id']] = $monitoring[$project['sub_detail_id']]['work_percentage']['name'];
 	 }
	
   }
	
	
    // echo"<pre>"; print_r($sql);exit();
    $this->set(compact('prjectdetails','physicallly_completed','monitoringcount'));
}

  public function ajaxdivisiontwisereport($id = NULL, $type = NULL, $work_type = NULL,$fin_year =NULL)
  { 
  	$this->ProjectMonitoringDetails = $this->fetchTable('ProjectMonitoringDetails');
    
   
    $user = $this->request->getAttribute('identity');
    $userid =  $user->id;
    $role_id =  $user->role_id;
	$division_id = $user->division_id;
	$circle_id = $user->circle_id;
	if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
	$condition = " and work_subdetails.division_id = " . $division_id . "";
	} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
	$condition = " and work_subdetails.circle_id = " . $circle_id . "";
	} else {
	$condition = "";
	}
	if($fin_year !=  ''){
	 $financial_year_cond     = ($fin_year  != '0') ? " AND project_work.financial_year_id = '" . $fin_year . "'" : "";
	}
	if($work_type != ''){
		$work_type_con = " and work_subdetails.work_type = " . $work_type . "";
		
	}
	
    $connection        = ConnectionManager::get('default');
    if ($type == 1) {
        $Cond = "";
    } elseif ($type == 2) {
        $Cond = "AND work_subdetails.project_work_status_id>=1";
        //   echo"<pre>";print_r($Cond);exit();

    } elseif ($type == 3) {
        $Cond = "AND work_subdetails.project_work_status_id>=3";
    } elseif ($type == 4) {
        $Cond = "AND work_subdetails.project_work_status_id>=5";
    } elseif ($type == 5) {
        $Cond = " AND work_subdetails.project_work_status_id>=11";
        //   echo"<pre>";print_r($Cond);exit();

    } elseif ($type == 6) {
        $Cond = "AND  work_subdetails.project_work_status_id=19";
    }
    $sql          = "SELECT  department.name as dname,
                    financial_year.name as financial_yeartname,
                    building_type.name as building_typename,
                    division.name as division_name,
                    project_work_statuse.name as pws,
                    work_subdetails.work_name as work_name,
                    work_subdetails.work_code as work_code,
                    work_subdetails.work_type as work_type,
                    work_subdetails.tentative_completion_date as tentative_completion_date,
                    work_subdetails.id as sub_detail_id,
                    san.go_no as go_no,
                    project_work.ref_no as ref_no,
                    san.sanctioned_amount as sanctioned_amount,
                    project_work.project_name as project_name,work_subdetails.id as work_id,work_subdetails.project_work_id as project_id
                    FROM project_work_subdetails as work_subdetails
                    LEFT JOIN project_works as project_work on project_work.id = work_subdetails.project_work_id
                    LEFT JOIN project_administrative_sanctions as san on san.project_work_id = project_work.id
                    LEFT JOIN departments as department on department.id = project_work.department_id
                    LEFT JOIN financial_years as  financial_year on financial_year.id = project_work.financial_year_id
                    LEFT JOIN building_types as building_type on building_type.id = project_work.building_type_id
                    LEFT JOIN divisions as division on division.id = work_subdetails.division_id
                    LEFT JOIN project_work_statuses as project_work_statuse on project_work_statuse.id = work_subdetails.project_work_status_id
                    where work_subdetails.division_id=$id and work_subdetails.is_active =1 $Cond $condition $work_type_con $financial_year_cond ";
						//echo"<pre>";print_r($sql);exit();

    // echo "<pre>";
    // print_r($sql);
    // exit();

    $prjectdetails             = $connection->execute($sql)->fetchAll('assoc');
	$monitoringcount = array();
	$monitoring = array();
	$physicallly_completed = array();
	foreach($prjectdetails as $project){
		
	  $monitoringcount[$project['sub_detail_id']] = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_subdetail_id' => $project['sub_detail_id']])->count();
      
	 if($monitoringcount[$project['sub_detail_id']] > 0){
	 $monitoring[$project['sub_detail_id']]    = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages', 'FinancialPercentages'])->where(['ProjectMonitoringDetails.project_work_subdetail_id' =>$project['sub_detail_id']])->order(['ProjectMonitoringDetails.id' => 'DESC'])->first();

     $physicallly_completed[$project['sub_detail_id']] = $monitoring[$project['sub_detail_id']]['work_percentage']['name'];
 	 }

  
	
   }
    $this->set(compact('prjectdetails','physicallly_completed','monitoringcount'));
}

  public function ajaxfinancedetails($type = NULL)
  {

    $user = $this->request->getAttribute('identity');
    $userid =  $user->id;
    $role_id =  $user->role_id;
	$division_id = $user->division_id;
	$circle_id = $user->circle_id;
	if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
	$condition = " and p.division_id = " . $division_id . "";
	} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
	$condition = " and p.circle_id = " . $circle_id . "";
	} else {
	$condition = "";
	}	
	
    $connection        = ConnectionManager::get('default');    

if($type == 1){	
    $sql          = "SELECT 
uc.certificated_date as date,uc.amount,uc.remarks,p.work_name,san.go_no,project_work.ref_no,p.work_type
from utilization_certificates as uc 
LEFT join project_work_subdetails as p on p.id=uc.project_work_subdetail_id
 LEFT JOIN project_works as project_work on project_work.id = p.project_work_id
 LEFT JOIN project_administrative_sanctions as san on san.project_work_id = project_work.id
where uc.is_active=1 $condition";
						//echo"<pre>";print_r($sql);exit();
}else if($type == 2){	
    $sql          = "SELECT 
uc.sanctioned_date as date,uc.amount,uc.remarks,p.work_name,san.go_no,project_work.ref_no,p.work_type
from uc_fund_sanctioned_details as uc 
LEFT join project_work_subdetails as p on p.id=uc.project_work_subdetail_id
 LEFT JOIN project_works as project_work on project_work.id = p.project_work_id
 LEFT JOIN project_administrative_sanctions as san on san.project_work_id = project_work.id
where 1 $condition";
						//echo"<pre>";print_r($sql);exit();
}else if($type == 3){	
    $sql          = "SELECT 
op.balance_date as date,op.opening_balance,op.transaction_amount,op.payment_info
from opening_balance_logs as op 
";
						//echo"<pre>";print_r($sql);exit();
}
    // echo "<pre>";
    // print_r($sql);
    // exit();

    $prjectdetails             = $connection->execute($sql)->fetchAll('assoc');
    $this->set(compact('prjectdetails','type'));
}

  public function departmentreport()
  {
	  
        $this->viewBuilder()->setLayout('layout');
        $this->Departments=$this->fetchTable('Departments');
        $this->FinancialYears=$this->fetchTable('FinancialYears');
        $this->ProjectWorks=$this->fetchTable('ProjectWorks');
        $connection = ConnectionManager::get('default');
		
		$user = $this->request->getAttribute('identity');
		$userid =  $user->id;
		$role_id =  $user->role_id;
		$division_id = $user->division_id;
		$circle_id = $user->circle_id;
		if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
		$condition = " and projectsub.division_id = " . $division_id . "";
		} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
		$condition = " and projectsub.circle_id = " . $circle_id . "";
		} else {
		$condition = "";
		}
      
        if ($this->request->is(['patch', 'post', 'put'])) {
            // echo"<pre>";print_r( $this->request->getData());exit();
            $financial_year_id       =  $this->request->getData('financial_year_id');
			if($financial_year_id != ''){ 
			$financial  = $this->FinancialYears->find('all')->where(['FinancialYears.id' => $financial_year_id])->order(['FinancialYears.id' => 'DESC'])->first();
			$financial_year = $financial['name'];
			}
            $financial_year_cond     = ($financial_year_id  != '') ? " AND projectwork.financial_year_id = '" . $financial_year_id . "'" : "";
            $departmentsname         = $this->Departments->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Departments.is_active' => 1])->toArray();
            $department_details = array();

            foreach ($departmentsname as $key => $value) {

                $query = "Select count(projectwork.id) as projectcount,
                          sum(CASE WHEN projectsub.project_work_status_id >= 3 and projectsub.work_type = 1 THEN 1 else 0 end) as projectcount_con,
                          sum(CASE WHEN projectsub.project_work_status_id >= 3 and projectsub.work_type = 2 THEN 1 else 0 end) and as projectcount_rep,
                          sum(CASE WHEN projectsub.project_work_status_id >= 11 and  projectsub.work_type = 1 THEN 1 else 0 end) as inprogress_con,
                          sum(CASE WHEN projectsub.project_work_status_id >= 11 and  projectsub.work_type = 2 THEN 1 else 0 end) as inprogress_rep,
                          sum(CASE WHEN projectsub.project_work_status_id >= 19 and  projectsub.work_type = 1 THEN 1 else 0 end) as completed_con,
                          sum(CASE WHEN projectsub.project_work_status_id >= 19 and  projectsub.work_type = 2 THEN 1 else 0 end) as completed_rep
                          from project_work_subdetails as projectsub LEFT JOIN project_works as projectwork on 
                          projectwork.id = projectsub.project_work_id
                          where projectsub.is_active=1 and projectwork.department_id =$key $financial_year_cond $condition";
                // echo"<pre>";print_r($query);exit();
                $Totalcount      = $connection->execute($query)->fetchAll('assoc');
                $department_details[$key]['department_name']     = $value;
                $department_details[$key]['total_count_con']     = $Totalcount[0]['projectcount_con'];
                $department_details[$key]['total_count_rep']     = $Totalcount[0]['projectcount_rep'];
                $department_details[$key]['inprogress_con']      = ($Totalcount[0]['inprogress_con'] != '') ? $Totalcount[0]['inprogress_con'] : 0;
                $department_details[$key]['inprogress_rep']      = ($Totalcount[0]['inprogress_rep'] != '') ? $Totalcount[0]['inprogress_rep'] : 0;
                $department_details[$key]['completed_con']       = ($Totalcount[0]['completed_con'] != '') ? $Totalcount[0]['completed_con'] : 0;
                $department_details[$key]['completed_rep']       = ($Totalcount[0]['completed_rep'] != '') ? $Totalcount[0]['completed_rep'] : 0;

            }
         
        }else{
			 $departmentsname         = $this->Departments->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Departments.is_active' => 1])->toArray();
            $department_details = array();

            foreach ($departmentsname as $key => $value) {
                 $query = "Select count(projectwork.id) as projectcount,
                          sum(CASE WHEN projectsub.project_work_status_id >= 3 and projectsub.work_type = 1 THEN 1 else 0 end) as projectcount_con,
                          sum(CASE WHEN projectsub.project_work_status_id >= 3 and projectsub.work_type = 2 THEN 1 else 0 end) as projectcount_rep,
                          sum(CASE WHEN projectsub.project_work_status_id >= 11 and  projectsub.work_type = 1 THEN 1 else 0 end) as inprogress_con,
                          sum(CASE WHEN projectsub.project_work_status_id >= 11 and  projectsub.work_type = 2 THEN 1 else 0 end) as inprogress_rep,
                          sum(CASE WHEN projectsub.project_work_status_id >= 19 and  projectsub.work_type = 1 THEN 1 else 0 end) as completed_con,
                          sum(CASE WHEN projectsub.project_work_status_id >= 19 and  projectsub.work_type = 2 THEN 1 else 0 end) as completed_rep
                          from project_work_subdetails as projectsub LEFT JOIN project_works as projectwork on 
                          projectwork.id = projectsub.project_work_id
                          where projectsub.is_active=1 and projectwork.department_id =$key $financial_year_cond $condition";
                // echo"<pre>";print_r($query);exit();
                $Totalcount      = $connection->execute($query)->fetchAll('assoc');
                $department_details[$key]['department_name']     = $value;
                $department_details[$key]['total_count_con']     = $Totalcount[0]['projectcount_con'];
                $department_details[$key]['total_count_rep']     = $Totalcount[0]['projectcount_rep'];
                $department_details[$key]['inprogress_con']      = ($Totalcount[0]['inprogress_con'] != '') ? $Totalcount[0]['inprogress_con'] : 0;
                $department_details[$key]['inprogress_rep']      = ($Totalcount[0]['inprogress_rep'] != '') ? $Totalcount[0]['inprogress_rep'] : 0;
                $department_details[$key]['completed_con']       = ($Totalcount[0]['completed_con'] != '') ? $Totalcount[0]['completed_con'] : 0;
                $department_details[$key]['completed_rep']       = ($Totalcount[0]['completed_rep'] != '') ? $Totalcount[0]['completed_rep'] : 0;
            }
			
		}
        $finacial_year     = $this->FinancialYears->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['FinancialYears.is_active' => 1])->toArray();
        $department        = $this->Departments->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Departments.is_active' => 1])->toArray();
        $this->set(compact('financial_year','divisions', 'department_details', 'finacial_year', 'department','financial_year_id'));
    }
    
  public function divisionwise()
  {	  
        $this->viewBuilder()->setLayout('layout');


         $this->Divisions=$this->fetchTable('Divisions');
         $this->FinancialYears=$this->fetchTable('FinancialYears');
         $this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');

        $connection = ConnectionManager::get('default');
		$user = $this->request->getAttribute('identity');
		$userid =  $user->id;
		$role_id =  $user->role_id;
		$division_id = $user->division_id;
		$circle_id = $user->circle_id;
		if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
		$condition = " and project.division_id = " . $division_id . "";
		} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
		$condition = " and project.circle_id = " . $circle_id . "";
		} else {
		$condition = "";
		}
        if ($this->request->is(['patch', 'post', 'put'])) {

            $financial_year_id       =  $this->request->getData('financial_year_id');
			if($financial_year_id != ''){
			$financial  = $this->FinancialYears->find('all')->where(['FinancialYears.id' => $financial_year_id])->first();
			$financial_year = $financial['name'];
			}
            $financial_year_cond     = ($financial_year_id  != '') ? " AND project_work.financial_year_id = '" . $financial_year_id . "'" : "";
			if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
               $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1,'Divisions.id'=>$division_id])->toArray();
            }else{
			   $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
            }
			$divisions_details = array();
            foreach ($divisions as $key => $divistionvalue) {
                $query        = "select count(project.id) as totalcount, 
                                  sum(CASE WHEN project.project_work_status_id >= 3 and project.work_type = 1 THEN 1 else 0 end) as projectcount_con,
                                  sum(CASE WHEN project.project_work_status_id >= 3 and project.work_type = 2 THEN 1 else 0 end) as projectcount_rep,
                                  sum(CASE WHEN project.project_work_status_id >= 11 and  project.work_type = 1 THEN 1 else 0 end) as inprogress_con,
								  sum(CASE WHEN project.project_work_status_id >= 11 and  project.work_type = 2 THEN 1 else 0 end) as inprogress_rep,
                                  sum(CASE WHEN project.project_work_status_id >= 19 and  project.work_type = 1 THEN 1 else 0 end) as completed_con,
                                  sum(CASE WHEN project.project_work_status_id >= 19 and  project.work_type = 2 THEN 1 else 0 end) as completed_rep
                                 from project_work_subdetails as project 
                                 LEFT JOIN project_works as project_work on 
                                 project_work.id = project.project_work_id where project.is_active=1 and 
                                 project.division_id=$key $financial_year_cond $condition";
                // echo"<pre>";print_r($query);exit();
                $Totalcount      = $connection->execute($query)->fetchAll('assoc');
                $divisions_details[$key]['division_name']  = $divistionvalue;
               	$divisions_details[$key]['total_count_con']     = $Totalcount[0]['projectcount_con'];
                $divisions_details[$key]['total_count_rep']     = $Totalcount[0]['projectcount_rep'];
                $divisions_details[$key]['inprogress_con']      = ($Totalcount[0]['inprogress_con'] != '') ? $Totalcount[0]['inprogress_con'] : 0;
                $divisions_details[$key]['inprogress_rep']      = ($Totalcount[0]['inprogress_rep'] != '') ? $Totalcount[0]['inprogress_rep'] : 0;
                $divisions_details[$key]['completed_con']       = ($Totalcount[0]['completed_con'] != '') ? $Totalcount[0]['completed_con'] : 0;
                $divisions_details[$key]['completed_rep']       = ($Totalcount[0]['completed_rep'] != '') ? $Totalcount[0]['completed_rep'] : 0;
           
         }
		}else{
			
			if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
               $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1,'Divisions.id'=>$division_id])->toArray();
            }else{
			   $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
            }            $divisions_details = array();
            foreach ($divisions as $key => $divistionvalue) {
                $query        = "select count(project.id) as totalcount, 
                                  sum(CASE WHEN project.project_work_status_id >= 3 and project.work_type = 1 THEN 1 else 0 end) as projectcount_con,
                                  sum(CASE WHEN project.project_work_status_id >= 3 and project.work_type = 2 THEN 1 else 0 end) as projectcount_rep,
                                  sum(CASE WHEN project.project_work_status_id >= 11 and  project.work_type = 1 THEN 1 else 0 end) as inprogress_con,
								  sum(CASE WHEN project.project_work_status_id >= 11 and  project.work_type = 2 THEN 1 else 0 end) as inprogress_rep,
                                  sum(CASE WHEN project.project_work_status_id >= 19 and  project.work_type = 1 THEN 1 else 0 end) as completed_con,
                                  sum(CASE WHEN project.project_work_status_id >= 19 and  project.work_type = 2 THEN 1 else 0 end) as completed_rep
                                 from project_work_subdetails as project 
                                 LEFT JOIN project_works as project_work on 
                                 project_work.id = project.project_work_id where project.is_active=1 and 
                                 project.division_id=$key $condition";
                // echo"<pre>";print_r($query);exit();
                $Totalcount      = $connection->execute($query)->fetchAll('assoc');
                $divisions_details[$key]['division_name']  = $divistionvalue;
               	$divisions_details[$key]['total_count_con']     = $Totalcount[0]['projectcount_con'];
                $divisions_details[$key]['total_count_rep']     = $Totalcount[0]['projectcount_rep'];
                $divisions_details[$key]['inprogress_con']      = ($Totalcount[0]['inprogress_con'] != '') ? $Totalcount[0]['inprogress_con'] : 0;
                $divisions_details[$key]['inprogress_rep']      = ($Totalcount[0]['inprogress_rep'] != '') ? $Totalcount[0]['inprogress_rep'] : 0;
                $divisions_details[$key]['completed_con']       = ($Totalcount[0]['completed_con'] != '') ? $Totalcount[0]['completed_con'] : 0;
                $divisions_details[$key]['completed_rep']       = ($Totalcount[0]['completed_rep'] != '') ? $Totalcount[0]['completed_rep'] : 0;
            }
		}

        $finacial_year = $this->FinancialYears->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['FinancialYears.is_active' => 1])->toArray();
        $this->set(compact('financial_year','divisions', 'divisions_details', 'finacial_year','financial_year_id'));
    }

  public function sanctionedreport()
  {
	$this->viewBuilder()->setLayout('layout');


       $this->Districts=$this->fetchTable('Districts');
    $this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
    $this->DepartmentwiseWorkTypes=$this->fetchTable('DepartmentwiseWorkTypes');
    $this->ProjectWorks=$this->fetchTable('ProjectWorks');

	if ($this->request->is(['post', 'patch', 'put'])) {
			$from_month = date('Y-m', strtotime($this->request->getData('from_month')));
			$to_month   = date('Y-m', strtotime($this->request->getData('to_month')));
			//$month_year             = date('M-Y', strtotime($this->request->getData('month_date')));
			//$month_date            =  ($this->request->getData('month_date') != '') ? date('m', strtotime($this->request->getData('month_date'))) : '';
			//$month  = $this->ProjectWorkSubdetails->find('all')->where(['ProjectWorkSubdetails.id' => $month_date])->first();
			//$month_wise = $month['submit_date'];
			//development work type
			$development_work = $this->request->getData('development_work');
			$development  = $this->DepartmentwiseWorkTypes->find('all')->where(['DepartmentwiseWorkTypes.id' => $development_work])->first();
			$development_work_type = $development['name'];		
			$development_works         = ($development_work  != '') ? " AND (project.departmentwise_work_type_id) = '" . $development_work . "'" : "";

			//status
			$status_work = $this->request->getData('status');		
			$connection            = ConnectionManager::get('default');

			if ($status_work == 1) {
				$title = "Sanctioned";
				$type_cond = " AND project_subdetail.project_work_status_id >=3";
			}
			if ($status_work == 2) {
				$title = "To be Commenced";
				$type_cond = " AND project_subdetail.project_work_status_id <= 11";  
			}
			if ($status_work == 3) {
				$title = "In Progress";
				$type_cond = " AND project_subdetail.project_work_status_id between 11 and 16";
			}
			if ($status_work == 4) {

				$title = "Completed";
				$type_cond = " AND project_subdetail.project_work_status_id =19";
			}

			/*$sql   = "SELECT 
				project_subdetail.work_name as name,
				project_subdetail.place_name as place_name,
				district.name as dname,
				division.name as divname,
				c.name as cirname,
				financial_sanction.sanctioned_amount as amount
				FROM project_work_subdetails as project_subdetail
				left join districts as district on district.id=project_subdetail.district_id
				left join divisions as division on division.id=project_subdetail.division_id
				left join circles as c on c.id=project_subdetail.circle_id
				left join project_financial_sanctions as financial_sanction on financial_sanction.project_work_id=project_subdetail.project_work_id
				left join project_works as project on project.id=project_subdetail.project_work_id
				left join departmentwise_work_types as department on department.id=project_subdetail.project_work_id			 
				WHERE MONTH(project_subdetail.submit_date) = $month_date $development_works $type_cond";*/
				
				$sql   = "SELECT 
				project_subdetail.work_name as name,
				project_subdetail.place_name as place_name,
				district.name as dname,
				division.name as divname,
				c.name as cirname,
				financial_sanction.sanctioned_amount as amount
				FROM project_work_subdetails as project_subdetail
				left join districts as district on district.id=project_subdetail.district_id
				left join divisions as division on division.id=project_subdetail.division_id
				left join circles as c on c.id=project_subdetail.circle_id
				left join project_financial_sanctions as financial_sanction on financial_sanction.project_work_id=project_subdetail.project_work_id
				left join project_works as project on project.id=project_subdetail.project_work_id
				left join departmentwise_work_types as department on department.id=project_subdetail.project_work_id			 
				WHERE DATE_FORMAT(project_subdetail.submit_date,'%Y-%m') >= '".$from_month."' and DATE_FORMAT(project_subdetail.submit_date,'%Y-%m') <= '".$to_month."' and project_subdetail.is_active = 1   $development_works $type_cond order by project_subdetail.work_type ASC";
			//print_r($sql); exit();  	
				
			$projects  = $connection->execute($sql)->fetchAll('assoc');
		}
		$status = array(1 => 'Sanctioned', 2 => 'To be Commenced', 3 => 'Under Progress', 4 => 'Completed');

		$development_work     = $this->DepartmentwiseWorkTypes->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['DepartmentwiseWorkTypes.is_active' => 1])->toArray();
		// echo "<pre>";
		// print_r($status);
		// exit();

    $this->set(compact('status', 'month_date', 'projects', 'development_work', 'development_work_type', 'month_wise', 'month','title','month_year','from_month','to_month'));
 }   

  /*public function expenditurereport()
  {
	$this->viewBuilder()->setLayout('layout');
	$this->Divisions=$this->fetchTable('Divisions');
	$this->loadModel('ProjectWorks');

	    if ($this->request->is(['post', 'patch', 'put'])) { //echo "<pre>";   print_r($this->request->getData());   exit();
			$division_id  = $this->request->getData('division_id');	
			//echo "<pre>";   print_r($division_id);   exit();
			$connection  = ConnectionManager::get('default');				
		    $sql         = "SELECT 
							financial_sanction.project_work_id as project_id,
							financial_sanction.go_no as fsgo_no,
							financial_sanction.sanctioned_amount as amount,
							sum(ps.expenditure_incurred) as expenditure_incurred
							FROM project_financial_sanctions as financial_sanction
							LEFT JOIN project_works as project on project.id=financial_sanction.project_work_id
							LEFT JOIN project_work_subdetails as ps on ps.project_work_id=project.id 
							WHERE ps.division_id = $division_id
							group by financial_sanction.project_work_id,financial_sanction.go_no,financial_sanction.sanctioned_amount";

      	   $projects   = $connection->execute($sql)->fetchAll('assoc');		
		}
		$divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();	

      $this->set(compact('divisions', 'month_date', 'projects','division_id'));
  }  */
  
  public function expenditurereport()
  {
	$this->viewBuilder()->setLayout('layout');
	
    $this->Divisions=$this->fetchTable('Divisions');
    $this->FundSources=$this->fetchTable('FundSources');
    $this->ProjectWorks=$this->fetchTable('ProjectWorks');

	    if ($this->request->is(['post', 'patch', 'put'])) { //echo "<pre>";   print_r($this->request->getData());   exit();
			//$division_id  = $this->request->getData('division_id');	
			$division_con  = ($this->request->getData('division_id') != '')?" and ps.division_id = ".$this->request->getData('division_id')."":"";	
			$work_type  = $this->request->getData('work_type');	
			//print_r($work_type); exit();
			$fund_source_id  = $this->request->getData('fund_source_id');	
			
			if($work_type == 1){
				$con = " and ps.project_work_status_id >= 3";
			}else{
				$con = " and ps.project_work_status_id >= 3";
			}
			
			
			$fund_source = ($fund_source_id != '')?" AND san.fund_source_id = ".$fund_source_id."":"";
			
			//echo "<pre>";   print_r($division_id);   exit();
			$connection  = ConnectionManager::get('default');				
		    /*$sql         = "SELECT 
							financial_sanction.project_work_id as project_id,
							financial_sanction.go_no as fsgo_no,
							financial_sanction.sanctioned_amount as amount,
							sum(ps.expenditure_incurred) as expenditure_incurred
							FROM project_financial_sanctions as financial_sanction
							LEFT JOIN project_works as project on project.id=financial_sanction.project_work_id
							LEFT JOIN project_work_subdetails as ps on ps.project_work_id=project.id 
							WHERE ps.division_id = $division_id
							group by financial_sanction.project_work_id,financial_sanction.go_no,financial_sanction.sanctioned_amount";*/
		if($fund_source_id == 1){				
			$sql         = "SELECT 
							ps.id as project_id,
							san.go_no as go_no,
							ps.work_name as work_name,
							ps.sanctioned_amount as san_amount,
							uc.amount as uc_amount,
							uc_san.amount as uc_received,
							project.ref_no as ref_no,
							d.name as dname,
							ps.expenditure_incurred as expenditure_incurred
							FROM project_work_subdetails as ps
							LEFT JOIN project_works as project on project.id=ps.project_work_id
							LEFT JOIN project_administrative_sanctions as san on san.project_work_id=project.id
							LEFT JOIN utilization_certificates as uc on uc.project_work_subdetail_id=ps.id
							LEFT JOIN uc_fund_sanctioned_details as uc_san on uc_san.project_work_subdetail_id=ps.id
							LEFT JOIN divisions as d on d.id=ps.division_id
							WHERE   ps.work_type = $work_type and ps.is_active = 1 $division_con $con $fund_source
							order by d.name ASC
							";	

		}else{

      $sql         = "SELECT 
					ps.id as project_id,
					san.go_no as go_no,
					ps.work_name as work_name,
					ps.sanctioned_amount as san_amount,
					project.ref_no as ref_no,
					d.name as dname,
					ps.expenditure_incurred as expenditure_incurred
					FROM project_work_subdetails as ps
					LEFT JOIN project_works as project on project.id=ps.project_work_id
					LEFT JOIN project_administrative_sanctions as san on san.project_work_id=project.id
					LEFT JOIN divisions as d on d.id=ps.division_id
					WHERE   ps.work_type = $work_type and ps.is_active = 1 $division_con $con $fund_source
					order by d.name ASC
					";			
	
		}					
							
			//print_r($sql); exit();				

      	   $projects   = $connection->execute($sql)->fetchAll('assoc');	
		if($fund_source_id == 2){		
		   
		   $direct_fund = array();
		   foreach($projects as $project){
			   
			   $sql1     = "SELECT 
							sum(d.amount) as amount
							FROM direct_fund_details as d
							where d.project_work_subdetail_id =".$project['project_id']."
							group by d.project_work_subdetail_id
							";								

      	     $directFundDetails   = $connection->execute($sql1)->fetchAll('assoc');			 
			 $direct_fund[$project['project_id']] =  ($directFundDetails[0]['amount'])?$directFundDetails[0]['amount']:'0';			 
		   }
		} 
		   
		   
		   
		}
		$divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();	
		$fund_sources     = $this->FundSources->find('list', ['keyField' => 'id', 'valueField' => 'name'])->order(['id ASC'])->toArray();	

      $this->set(compact('divisions', 'month_date', 'projects','division_id','fund_sources','fund_source_id','direct_fund'));
  } 
  
  public function ajaxdirectfunddetail($id = null){
	  			$connection  = ConnectionManager::get('default');				

	   $sql       = "SELECT 
						d.fund_received_date as fund_received_date,
						d.cheque_no as cheque_no,
						d.amount as amount
						FROM direct_fund_details as d
						where d.project_work_subdetail_id =  ".$id."
						order by d.fund_received_date ASC  
						";								

       $projectdetails   = $connection->execute($sql)->fetchAll('assoc');	
	   $this->set(compact('projectdetails'));
	  
  }
    
  public function directfundreport()
  {
	$this->viewBuilder()->setLayout('layout');

    $this->Divisions=$this->fetchTable('Divisions');
    $this->FinancialYears=$this->fetchTable('FinancialYears');
    $this->FundSources=$this->fetchTable('FundSources');

	    if ($this->request->is(['post', 'patch', 'put'])) { //echo "<pre>";   print_r($this->request->getData());   exit();
			//$division_id  = $this->request->getData('division_id');	
			$division_con  = ($this->request->getData('division_id') != '')?" and ps.division_id = ".$this->request->getData('division_id')."":"";	
			//$work_type  = $this->request->getData('work_type');	
			//print_r($work_type); exit();
			//$fund_source_id  = $this->request->getData('fund_source_id');	
			
			//if($work_type == 1){
				$con = " and ps.project_work_status_id >= 3";
			//}else{
				$con = " and ps.project_work_status_id >= 3";
			//}
			
			
			//$fund_source = ($fund_source_id != '')?" AND san.fund_source_id = ".$fund_source_id."":"";
			
			//echo "<pre>";   print_r($division_id);   exit();
			$connection  = ConnectionManager::get('default');			


      $sql         = "SELECT 
					ps.id as project_id,
					san.go_no as go_no,
					ps.work_name as work_name,
					ps.sanctioned_amount as san_amount,
					project.ref_no as ref_no,
					d.name as dname,
					ps.expenditure_incurred as expenditure_incurred
					FROM project_work_subdetails as ps
					LEFT JOIN project_works as project on project.id=ps.project_work_id
					LEFT JOIN project_administrative_sanctions as san on san.project_work_id=project.id
					LEFT JOIN divisions as d on d.id=ps.division_id
					WHERE  1 and ps.is_active = 1 $division_con  
					order by d.name ASC
					";			
	
							
			//print_r($sql); exit();				

      	   $projects   = $connection->execute($sql)->fetchAll('assoc');	
		   
		   $direct_fund = array();
		   foreach($projects as $project){
			   
			   $sql1     = "SELECT 
			                count(d.id) as fund_count,
							sum(d.amount) as amount
							FROM direct_fund_details as d
							where d.project_work_subdetail_id =".$project['project_id']."
							group by d.project_work_subdetail_id
							";								

      	     $directFundDetails   = $connection->execute($sql1)->fetchAll('assoc');			 
			 $direct_fund[$project['project_id']]['fund_count'] =  ($directFundDetails[0]['fund_count'])?$directFundDetails[0]['fund_count']:'0';			 
			 $direct_fund[$project['project_id']]['amount'] =  ($directFundDetails[0]['amount'])?$directFundDetails[0]['amount']:'0';			 
		   }
		   
		  // echo "<pre>"; print_r($direct_fund); exit();
		   
		}  
		
		   
		$divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();	
		$fund_sources     = $this->FundSources->find('list', ['keyField' => 'id', 'valueField' => 'name'])->order(['id ASC'])->toArray();	

      $this->set(compact('divisions', 'month_date', 'projects','division_id','fund_sources','fund_source_id','direct_fund'));
  } 
  
  public function timelinereport()
  {
	$this->viewBuilder()->setLayout('layout');
	$this->Divisions=$this->fetchTable('Divisions');
	$this->ProjectWorks=$this->fetchTable('ProjectWorks');
	$this->FundSources=$this->fetchTable('FundSources');

	    if ($this->request->is(['post', 'patch', 'put'])) { //echo "<pre>";   print_r($this->request->getData());   exit();
			//$division_id  = $this->request->getData('division_id');	
			$division_con  = ($this->request->getData('division_id') != '')?" and ps.division_id = ".$this->request->getData('division_id')."":"";	
			$work_type  = $this->request->getData('work_type');	
			$fund_source_id  = $this->request->getData('fund_source_id');	
			
			if($work_type == 1){
				$con = " and ps.project_work_status_id >= 3";
			}else{
				$con = " and ps.project_work_status_id >= 3";
			}
			
			
			//$fund_source = ($fund_source_id != '')?" AND san.fund_source_id = ".$fund_source_id."":"";
			
			//echo "<pre>";   print_r($division_id);   exit();
			$connection  = ConnectionManager::get('default');				
		    /*$sql         = "SELECT 
							financial_sanction.project_work_id as project_id,
							financial_sanction.go_no as fsgo_no,
							financial_sanction.sanctioned_amount as amount,
							sum(ps.expenditure_incurred) as expenditure_incurred
							FROM project_financial_sanctions as financial_sanction
							LEFT JOIN project_works as project on project.id=financial_sanction.project_work_id
							LEFT JOIN project_work_subdetails as ps on ps.project_work_id=project.id 
							WHERE ps.division_id = $division_id
							group by financial_sanction.project_work_id,financial_sanction.go_no,financial_sanction.sanctioned_amount";*/
							
			$sql         = "SELECT 
							ps.id as project_id,
							d.name as dname,
							ps.work_name as work_name,
							san.go_date as as_date,
							fs.go_date as fs_date,
							ts.sanctioned_date as technical_date,
							t.tender_date as tender_date,
							ps.site_handover_date as site_handover_date,
							ps.tentative_completion_date as target_date,
							pp.send_date as pp_send_date,
							pp.approved_date as pp_approved_date,
							ho.handover_date as handover_date,
							c.completed_date as completed_date,
							c.created_date as br_submitted_date
							FROM project_work_subdetails as ps
							LEFT JOIN project_works as project on project.id=ps.project_work_id
							LEFT JOIN project_administrative_sanctions as san on san.project_work_id=project.id
							LEFT JOIN project_financial_sanctions as fs on fs.project_work_id=project.id
							LEFT JOIN technical_sanctions as ts on ts.project_work_subdetail_id=ps.id
							LEFT JOIN project_tender_details as t on t.project_work_subdetail_id=ps.id
							LEFT JOIN projectwise_completion_reports as c on c.project_work_subdetail_id=ps.id
							LEFT JOIN planning_permission_details as pp on pp.project_work_subdetail_id=ps.id
							LEFT JOIN project_handover_details as ho on ho.project_work_subdetail_id=ps.id
							LEFT JOIN divisions as d on d.id=ps.division_id
							WHERE   ps.work_type = $work_type and ps.is_active = 1 $division_con $con 
							order by d.name ASC
							";				
							
							
			//print_r($sql); exit();				

      	   $projects   = $connection->execute($sql)->fetchAll('assoc');		
		}
		$divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();	
		//$fund_sources     = $this->FundSources->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();	

      $this->set(compact('divisions', 'month_date', 'projects','division_id','fund_sources'));
  }

  public function ajaxexpenditurereport($id = NULL, $type = NULL,$division_id = null)
  {
        $connection   = ConnectionManager::get('default');     
        $sql          = "SELECT department.name as dname,
                        financial_year.name as financial_yeartname,
                        division.name as division_name,
                        project_work_statuse.name as pws,
						work_subdetails.work_name as work_name,
						work_subdetails.work_code as work_code,
						work_subdetails.fs_amount as fs_amount,
                        project_work.project_name as project_name,work_subdetails.id as work_id,work_subdetails.project_work_id as project_id
                        FROM project_work_subdetails as work_subdetails
                        LEFT JOIN project_works as project_work on project_work.id = work_subdetails.project_work_id
                        LEFT JOIN departments as department on department.id = project_work.department_id
                        LEFT JOIN financial_years as  financial_year on financial_year.id = project_work.financial_year_id
                        LEFT JOIN divisions as division on division.id = work_subdetails.division_id
                        LEFT JOIN project_work_statuses as project_work_statuse on project_work_statuse.id = work_subdetails.project_work_status_id
                        where work_subdetails.project_work_id = $id AND work_subdetails.division_id = $division_id";
						
        $projectdetails             = $connection->execute($sql)->fetchAll('assoc');
        $this->set(compact('projectdetails'));
    }  
   
  public function contractorreport()
  {
	$this->viewBuilder()->setLayout('layout');
	$this->Divisions=$this->fetchTable('Divisions');
	$this->ProjectWorks=$this->fetchTable('ProjectWorks');

	    if ($this->request->is(['post', 'patch', 'put'])) { //echo "<pre>";   print_r($this->request->getData());   exit();
			$division_id  = $this->request->getData('division_id');	
			//echo "<pre>";   print_r($division_id);   exit();
			$connection  = ConnectionManager::get('default');				
		    $sql         = "SELECT 
							cd.contractor_id as cont_id,
							c.name as cont_name,
							sum(cd.agreement_amount) as tot_agreement_amount,
							sum(ps.expenditure_incurred) as tot_expenditure_incurred							
							FROM project_work_subdetails as ps
							LEFT JOIN project_works as project on project.id=ps.project_work_id
							LEFT JOIN contractor_details as cd on cd.project_work_subdetail_id=ps.id							
							LEFT JOIN contractors as c on c.id=cd.contractor_id							
							WHERE ps.division_id = $division_id
							group by cd.contractor_id,c.name";

      	   $projects   = $connection->execute($sql)->fetchAll('assoc');		
		}
		$divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();	

      $this->set(compact('divisions', 'month_date', 'projects','division_id'));
    }	 
  
  public function ajaxcontractorreport($id = NULL, $type = NULL,$division_id = null)
  {
        $connection   = ConnectionManager::get('default');   
	   if($type == 1){
		   
			$sql          = "SELECT c.*,cc.name as contract_class
							FROM contractors as c
							LEFT JOIN contractor_classes as cc on cc.id = c.contractor_class_id
							where c.id = $id";
		   
	   }else if($type == 2 || $type == 3){
			
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
							where work_subdetails.division_id = $division_id AND cd.contractor_id = $id";
	   }
						
        $projectdetails             = $connection->execute($sql)->fetchAll('assoc');
        $this->set(compact('projectdetails','type'));
    }

 /*public function progressreport()
{
$this->viewBuilder()->setLayout('layout');
$this->loadModel('Districts');
$this->loadModel('ProjectWorkSubdetails');
$this->loadModel('DepartmentwiseWorkTypes');
$this->loadModel('ProjectWorks');
$this->Divisions=$this->fetchTable('Divisions');
$this->loadModel('ProjectwiseQuartersDetails');
$this->loadModel('ContractorDetails');
$this->loadModel('ProjectWorkStatuses');

if ($this->request->is(['post', 'patch', 'put'])) {

$division = $this->request->getData('division');

$connection = ConnectionManager::get('default');

if ($division) {

            $sql   = "SELECT 
            project_subdetail.work_name as name,
            district.name as dname,
            (CASE WHEN quarter_details.	police_designation_id=1 THEN (no_of_quarters) ELSE 0 END)AS ig,
            (CASE WHEN quarter_details.	police_designation_id=2 THEN (no_of_quarters) ELSE 0 END)AS dsp,
            (CASE WHEN quarter_details.	police_designation_id=3 THEN (no_of_quarters) ELSE 0 END)AS insp,
            (CASE WHEN quarter_details.	police_designation_id=4 THEN (no_of_quarters) ELSE 0 END)AS sub_insp,
            (CASE WHEN quarter_details.	police_designation_id=5 THEN (no_of_quarters) ELSE 0 END)AS constable,
            financial_sanction.sanctioned_amount as amount,
            project_subdetail.site_handover_date as sdate,
            contractor.agreement_fromdate as adate,
            work.name work,
            fin.name AS financial,

            (CASE WHEN project_subdetail.project_work_status_id between 1 and 6 THEN ('sanctioned') ELSE '' END)AS sanctioned,
            (CASE WHEN project_subdetail.project_work_status_id between 17 and 19 THEN ('To be Commenced') ELSE '' END)AS commenced,
            (CASE WHEN project_subdetail.project_work_status_id between 12 and 16 THEN ('Progress') ELSE '' END)AS progress,
            (CASE WHEN project_subdetail.project_work_status_id between 7 and 11 THEN ('Completed') ELSE '' END)AS completed
            FROM project_work_subdetails as project_subdetail
            left join districts as district on district.id=project_subdetail.district_id
            left join project_financial_sanctions as financial_sanction on financial_sanction.project_work_id=project_subdetail.project_work_id
            left join project_works as project on project.id=project_subdetail.project_work_id
            left join departmentwise_work_types as department on department.id=project_subdetail.project_work_id
            left join projectwise_quarters_details as quarter_details on quarter_details.project_work_id=project_subdetail.project_work_id
            left join contractor_details as contractor on contractor.project_work_id=project_subdetail.project_work_id
            left join project_monitoring_details as monitoring on monitoring.project_work_id=project_subdetail.project_work_id
            left join work_percentages as work on work.id=project_subdetail.project_work_id
            left join financial_percentages as fin on fin.id=project_subdetail.project_work_id
         
            WHERE (project_subdetail.division_id) = $division";

            $projects  = $connection->execute($sql)->fetchAll('assoc');
            // echo "<pre>";
            // print_r($projects);
            // exit();
        }
    }

    $division_table     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();

    // echo "<pre>";
    // print_r($division_table);
    // exit();
    $this->set(compact('division', 'division_table', 'projects'));
}*/

  /*public function progressreport()
  {
		$this->viewBuilder()->setLayout('layout');
		$this->loadModel('Districts');
		$this->loadModel('ProjectWorkSubdetails');
		$this->loadModel('DepartmentwiseWorkTypes');
		$this->loadModel('ProjectWorks');
		$this->Divisions=$this->fetchTable('Divisions');
		$this->loadModel('ProjectwiseQuartersDetails');
		$this->loadModel('ContractorDetails');
		$this->loadModel('ProjectWorkStatuses');
		$this->loadModel('FinancialYears');
		$this->loadModel('ProjectFinancialSanctions');

		if ($this->request->is(['post', 'patch', 'put'])){
			//Division
			$div           = $this->request->getData('division');
			$division      = $this->Divisions->find('all')->where(['Divisions.id' => $div])->first();
			$division_wise = $division['name'];

			//Financial
			$finance      = $this->request->getData('financial');
			$financial    = $this->FinancialYears->find('all')->where(['FinancialYears.id' => $finance])->first();
			$finance_wise = $financial['name'];

			$financial_works       = ($finance  != '') ? " AND (financial_year.id) = '" . $finance . "'" : "";
			$connection            = ConnectionManager::get('default');
			if ($division && $finance) {
				//  echo "<pre>";  print_r($financial); exit();
				$sql   = "SELECT 
				project_subdetail.work_name as name,
				project_subdetail.work_code as wcode,
				district.name as dname,
				(CASE WHEN quarter_details.	police_designation_id=1 THEN (no_of_quarters) ELSE 0 END)AS ig,
				(CASE WHEN quarter_details.	police_designation_id=2 THEN (no_of_quarters) ELSE 0 END)AS dsp,
				(CASE WHEN quarter_details.	police_designation_id=3 THEN (no_of_quarters) ELSE 0 END)AS insp,
				(CASE WHEN quarter_details.	police_designation_id=4 THEN (no_of_quarters) ELSE 0 END)AS sub_insp,
				(CASE WHEN quarter_details.	police_designation_id=5 THEN (no_of_quarters) ELSE 0 END)AS constable,
				financial_sanction.sanctioned_amount as amount,
				project_subdetail.site_handover_date as sdate,
				contractor.agreement_fromdate as adate,
				work.name as wname,
				financial.name AS fname,
				project_status.name as sname
				FROM project_work_subdetails as project_subdetail
				left join districts as district on district.id=project_subdetail.district_id
				left join project_financial_sanctions as financial_sanction on financial_sanction.project_work_id=project_subdetail.project_work_id
				left join project_works as project on project.id=project_subdetail.project_work_id
				left join departmentwise_work_types as department on department.id=project_subdetail.project_work_id
				left join projectwise_quarters_details as quarter_details on quarter_details.project_work_id=project_subdetail.project_work_id
				left join contractor_details as contractor on contractor.project_work_subdetail_id =project_subdetail.id
				left join project_monitoring_details as monitoring on monitoring.project_work_id=project_subdetail.project_work_id
				left join work_percentages as work on work.id=project_subdetail.project_work_id
				left join financial_percentages as financial on financial.id=project_subdetail.project_work_id
				left join financial_years as financial_year on financial_year.id=project_subdetail.project_work_id
				left join project_work_statuses as project_status on project_status.id=project_subdetail.project_work_status_id				 
				WHERE (project_subdetail.division_id) = $div $financial_works				
				";	
				$projects  = $connection->execute($sql)->fetchAll('assoc');
			}
		}
	    $division_table = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
	    $financial      = $this->FinancialYears->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['FinancialYears.is_active' => 1])->toArray();
		$this->set(compact('division', 'division_table', 'projects', 'financial', 'division_wise', 'finance_wise', 'finance', 'div'));
	}*/		
	
	public function ajaxprogress($val = null, $div = NULL, $finance = null)
    {
        $this->ProjectFinancialSanctions=$this->fetchTable('ProjectFinancialSanctions');
        $this->FinancialYears=$this->fetchTable('FinancialYears');
        $this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
        $connection        = ConnectionManager::get('default');
        $financial_works   = ($finance  != '') ? " AND (financial_year.id) = '" . $finance . "'" : "";
		
        if ($val == 1) {
            $sql = "SELECT  financial_sanction.go_no as refno,
					financial_sanction.sanctioned_amount as samount,
					financial_sanction.go_date as sdate,
					financial_sanction.sanctioned_file_upload as sfile
					FROM project_work_subdetails as project_subdetail
					left join project_financial_sanctions as financial_sanction on financial_sanction.project_work_id=project_subdetail.project_work_id
					left join financial_years as financial_year on financial_year.id=project_subdetail.project_work_id
					WHERE (project_subdetail.division_id) = $div $financial_works";
         $projectdetails     = $connection->execute($sql)->fetchAll('assoc');
        }
        $this->set(compact('projectdetails'));
    }	
	
	public function planningandpermissiondetails()
	{
		$this->viewBuilder()->setLayout('layout');
		$connection = ConnectionManager::get('default');
		$this->Divisions=$this->fetchTable('Divisions');
		$user    = $this->request->getAttribute('identity');
		$userid  = $user->id;
		$role_id = $user->role_id;
		$division_id = $user->division_id;
		$circle_id = $user->circle_id;
		
		if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14) {
			$condition = " and project.division_id = " . $division_id . "";
		} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
			$condition = " and project.circle_id = " . $circle_id . "";
		} else {
			$condition = "";
		}	
		
		if ($this->request->is(['post', 'patch', 'put'])) {
		        $divid = $this->request->getData('division_wise');
				$connection = ConnectionManager::get('default');
				$query      = "Select 
							  division.name as dname,
							  sum(CASE WHEN project.project_work_status_id>=3 THEN 1 ELSE '0' END) AS total,
							  sum(CASE WHEN project.is_planning_approval_send = 1 THEN 1 ELSE '0' END) AS planning_sent,
							  sum(CASE WHEN project.project_work_status_id>=10 and project.planning_permission_flag = 1 THEN 1 ELSE '0' END) AS planning_obtained,
							  sum(CASE WHEN project.is_planning_approval_send = 1 and project.planning_permission_flag = 0 THEN 1 ELSE '0' END) AS planning_sent_not_obtained,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.is_planning_approval_send = 3 THEN 1 ELSE '0' END) AS not_applicable,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.is_planning_approval_send IN (0,2) THEN 1 ELSE '0' END) AS not_send
							  from project_work_subdetails as project
							  LEFT JOIN divisions as division on division.id=project.division_id
							  where project.is_active=1 and project.work_type=1 and project.division_id=$divid $condition";
			$projects = $connection->execute($query)->fetchAll('assoc');
		}else{
			
			if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
               $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1,'Divisions.id'=>$division_id])->toArray();
            }else{
			   $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
            } 
			$projects = array();
            foreach ($divisions as $key => $divistionvalue) {
				$connection = ConnectionManager::get('default');
				$query      = "Select
							  division.name as dname,
							  sum(CASE WHEN project.project_work_status_id>=3 THEN 1 ELSE '0' END) AS total,
							  sum(CASE WHEN project.is_planning_approval_send = 1 THEN 1 ELSE '0' END) AS planning_sent,
							  sum(CASE WHEN project.project_work_status_id>=10 and project.planning_permission_flag = 1 THEN 1 ELSE '0' END) AS planning_obtained,
							  sum(CASE WHEN project.is_planning_approval_send = 1 and project.planning_permission_flag = 0 THEN 1 ELSE '0' END) AS planning_sent_not_obtained,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.is_planning_approval_send = 3 THEN 1 ELSE '0' END) AS not_applicable,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.is_planning_approval_send IN (0,2) THEN 1 ELSE '0' END) AS not_send
							  from project_work_subdetails as project
							  LEFT JOIN divisions as division on division.id=project.division_id
							  where project.is_active=1 and project.work_type=1 and  project.division_id=$key $condition";
			    $Totalcount = $connection->execute($query)->fetchAll('assoc');			  
			    $projects[$key]['dname']                      = $divistionvalue;
               	$projects[$key]['total']                      = $Totalcount[0]['total'];
                $projects[$key]['planning_sent']              = $Totalcount[0]['planning_sent'];
                $projects[$key]['planning_obtained']          = $Totalcount[0]['planning_obtained'];
                $projects[$key]['planning_sent_not_obtained'] = $Totalcount[0]['planning_sent_not_obtained'];
                $projects[$key]['not_applicable']             = $Totalcount[0]['not_applicable'];
                $projects[$key]['not_send']                   = $Totalcount[0]['not_send'];
			}			
		}
		
		if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
               $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1,'Divisions.id'=>$division_id])->toArray();
            }else{
			   $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
            } 
			$this->set(compact('division_wise', 'projects', 'divisions','division_id'));
	}
	
	public function projectasfsreport()
	{
		$this->viewBuilder()->setLayout('layout');
		$connection = ConnectionManager::get('default');
		$this->Divisions=$this->fetchTable('Divisions');
		$user    = $this->request->getAttribute('identity');
		$userid  = $user->id;
		$role_id = $user->role_id;
		$division_id = $user->division_id;
		$circle_id = $user->circle_id;
		
		if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14) {
			$condition = " and project.division_id = " . $division_id . "";
		} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
			$condition = " and project.circle_id = " . $circle_id . "";
		} else {
			$condition = "";
		}	
		
		if ($this->request->is(['post', 'patch', 'put'])) {
		        $divid = $this->request->getData('division_wise');
		       // $work_type = $this->request->getData('division_wise');
				$connection = ConnectionManager::get('default');
				$query      = "Select 
							  division.name as dname,
							  sum(CASE WHEN project.project_work_status_id>=1 and project.work_type=1 THEN 1 ELSE '0' END) AS total_con,
							  sum(CASE WHEN project.project_work_status_id>=1 and project.work_type=2 THEN 1 ELSE '0' END) AS total_rep,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.work_type=1 THEN 1 ELSE '0' END) AS AS_san_con,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.work_type=2 THEN 1 ELSE '0' END) AS AS_san_rep,
							  sum(CASE WHEN project.project_work_status_id>=1 and project.project_work_status_id<3 and project.work_type=1 THEN 1 ELSE '0' END) AS AS_not_San_con,
							  sum(CASE WHEN project.project_work_status_id>=1 and project.project_work_status_id<3 and project.work_type=2 THEN 1 ELSE '0' END) AS AS_not_San_rep,
							  sum(CASE WHEN project.project_work_status_id>=5 and project.work_type=1 THEN 1 ELSE '0' END) AS FS_san,
							  sum(CASE WHEN project.project_work_status_id<5 and project.work_type=1 THEN 1 ELSE '0' END) AS FS_not_san,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.project_work_status_id<5 and project.work_type=1 THEN 1 ELSE '0' END) AS AS_san_FS_not
							  from project_work_subdetails as project
							  LEFT JOIN divisions as division on division.id=project.division_id
							  where project.is_active=1 and project.work_type=1 and project.division_id=$divid $condition";
			$projects = $connection->execute($query)->fetchAll('assoc');
		}else{			
			if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
               $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1,'Divisions.id'=>$division_id])->toArray();
            }else{
			   $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
            } 
			$projects = array();
            foreach ($divisions as $key => $divistionvalue) {
				$connection = ConnectionManager::get('default');
				$query      = "Select
							  division.name as dname,
							  sum(CASE WHEN project.project_work_status_id>=1 and project.work_type=1 THEN 1 ELSE '0' END) AS total_con,
							  sum(CASE WHEN project.project_work_status_id>=1 and project.work_type=2 THEN 1 ELSE '0' END) AS total_rep,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.work_type=1 THEN 1 ELSE '0' END) AS AS_san_con,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.work_type=2 THEN 1 ELSE '0' END) AS AS_san_rep,
							  sum(CASE WHEN project.project_work_status_id>=1 and project.project_work_status_id<3 and project.work_type=1 THEN 1 ELSE '0' END) AS AS_not_San_con,
							  sum(CASE WHEN project.project_work_status_id>=1 and project.project_work_status_id<3 and project.work_type=2 THEN 1 ELSE '0' END) AS AS_not_San_rep,
							  sum(CASE WHEN project.project_work_status_id>=5 and project.work_type=1 THEN 1 ELSE '0' END) AS FS_san,
							  sum(CASE WHEN project.project_work_status_id<5 and project.work_type=1 THEN 1 ELSE '0' END) AS FS_not_san,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.project_work_status_id<5 and project.work_type=1 THEN 1 ELSE '0' END) AS AS_san_FS_not
							  from project_work_subdetails as project
							  LEFT JOIN divisions as division on division.id=project.division_id
							  where project.is_active=1  and  project.division_id=$key $condition";
			    $Totalcount = $connection->execute($query)->fetchAll('assoc');			  
			    $projects[$key]['dname']          = $divistionvalue;
               	$projects[$key]['total_con']      = $Totalcount[0]['total_con'];
               	$projects[$key]['total_rep']      = $Totalcount[0]['total_rep'];
                $projects[$key]['AS_san_con']     = $Totalcount[0]['AS_san_con'];
                $projects[$key]['AS_san_rep']     = $Totalcount[0]['AS_san_rep'];
                $projects[$key]['AS_not_San_con'] = $Totalcount[0]['AS_not_San_con'];
                $projects[$key]['AS_not_San_rep'] = $Totalcount[0]['AS_not_San_rep'];
                $projects[$key]['FS_san']         = $Totalcount[0]['FS_san'];
                $projects[$key]['FS_not_san']     = $Totalcount[0]['FS_not_san'];
                $projects[$key]['AS_san_FS_not']  = $Totalcount[0]['AS_san_FS_not'];
			}			
		}
		
		if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
		   $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1,'Divisions.id'=>$division_id])->toArray();
		}else{
		   $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
		} 
		$this->set(compact('division_wise', 'projects', 'divisions','division_id'));
   }
   
   public function projectfundtypereport(){
	   
	   $this->viewBuilder()->setLayout('layout');
		$connection = ConnectionManager::get('default');
		$this->Divisions=$this->fetchTable('Divisions');
		$user    = $this->request->getAttribute('identity');
		$userid  = $user->id;
		$role_id = $user->role_id;
		$division_id = $user->division_id;
		$circle_id = $user->circle_id;
		
		if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14) {
			$condition = " and project.division_id = " . $division_id . "";
		} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
			$condition = " and project.circle_id = " . $circle_id . "";
		} else {
			$condition = "";
		}	
		
		if ($this->request->is(['post', 'patch', 'put'])) {
		        $divid = $this->request->getData('division_wise');
		       // $work_type = $this->request->getData('division_wise');
				$connection = ConnectionManager::get('default');
				$query      = "Select 
							  division.name as dname,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.work_type = 1 THEN 1 ELSE '0' END) AS tot_con,
							  sum(CASE WHEN project.project_work_status_id>=3 and a.fund_source_id = 1 and project.work_type=1 THEN 1 ELSE '0' END) AS con_pd,
							  sum(CASE WHEN project.project_work_status_id>=3 and a.fund_source_id = 2 and project.work_type=1 THEN 1 ELSE '0' END) AS con_direct,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.work_type = 2 THEN 1 ELSE '0' END) AS tot_rep,
							  sum(CASE WHEN project.project_work_status_id>=1 and a.fund_source_id = 1 and project.work_type=2 THEN 1 ELSE '0' END) AS rep_pd,
							  sum(CASE WHEN project.project_work_status_id>=1 and a.fund_source_id = 2 and project.work_type=2 THEN 1 ELSE '0' END) AS rep_direct
							  from project_work_subdetails as project
							  LEFT JOIN project_administrative_sanctions as a on a.project_work_id = project.project_work_id
							  LEFT JOIN divisions as division on division.id=project.division_id
							  where project.is_active=1 and project.division_id=$divid $condition";
			$projects = $connection->execute($query)->fetchAll('assoc');
		}else{			
			if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
               $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1,'Divisions.id'=>$division_id])->toArray();
            }else{
			   $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
            } 
			$projects = array();
            foreach ($divisions as $key => $divistionvalue) {
				$connection = ConnectionManager::get('default');
				$query      = "Select
							  division.name as dname,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.work_type=1 THEN 1 ELSE '0' END) AS tot_con,
							  sum(CASE WHEN project.project_work_status_id>=3 and a.fund_source_id = 1 and project.work_type=1 THEN 1 ELSE '0' END) AS con_pd,
							  sum(CASE WHEN project.project_work_status_id>=3 and a.fund_source_id = 2 and project.work_type=1 THEN 1 ELSE '0' END) AS con_direct,
							  sum(CASE WHEN project.project_work_status_id>=3 and project.work_type=2 THEN 1 ELSE '0' END) AS tot_rep,
							  sum(CASE WHEN project.project_work_status_id>=1 and a.fund_source_id = 1 and project.work_type=2 THEN 1 ELSE '0' END) AS rep_pd,
							  sum(CASE WHEN project.project_work_status_id>=1 and a.fund_source_id = 2 and project.work_type=2 THEN 1 ELSE '0' END) AS rep_direct
							  from project_work_subdetails as project
							  LEFT JOIN project_administrative_sanctions as a on a.project_work_id = project.project_work_id
							  LEFT JOIN divisions as division on division.id=project.division_id
							  where project.is_active=1  and  project.division_id=$key $condition";
			    $Totalcount = $connection->execute($query)->fetchAll('assoc');			  
			    $projects[$key]['dname']       = $divistionvalue;
               	$projects[$key]['tot_con']     = $Totalcount[0]['tot_con'];
               	$projects[$key]['con_pd']      = $Totalcount[0]['con_pd'];
               	$projects[$key]['con_direct']  = $Totalcount[0]['con_direct'];
               	$projects[$key]['tot_rep']     = $Totalcount[0]['tot_rep'];
               	$projects[$key]['rep_pd']      = $Totalcount[0]['rep_pd'];
               	$projects[$key]['rep_direct']  = $Totalcount[0]['rep_direct'];

			}			
		}
		
		if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
		   $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1,'Divisions.id'=>$division_id])->toArray();
		}else{
		   $divisions     = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
		} 
		$this->set(compact('division_wise', 'projects', 'divisions','division_id'));   
	   
   }
   
  public function ajaxdivisionreport($type=NULL,$div_id=NULL,$work_type=NULL)
  { 
  	$this->ProjectMonitoringDetails=$this->fetchTable('ProjectMonitoringDetails');

    $user = $this->request->getAttribute('identity');
    $userid =  $user->id;
    $role_id =  $user->role_id;
	$division_id = $user->division_id;
	$circle_id = $user->circle_id;
	if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
	$condition = " and work_subdetails.division_id = " . $division_id . "";
	} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
	$condition = " and work_subdetails.circle_id = " . $circle_id . "";
	} else {
	$condition = "";
	}
	
	if($work_type != ''){
		$work_type_con = " and work_subdetails.work_type = " . $work_type . "";
	}
	
    $connection        = ConnectionManager::get('default');
    if ($type == 1) {
       $Cond = "AND work_subdetails.project_work_status_id>=1";
    } elseif ($type == 2) {
       $Cond = "AND work_subdetails.project_work_status_id>=3";
    } elseif ($type == 3) {
       $Cond = " AND work_subdetails.project_work_status_id>=1 and work_subdetails.project_work_status_id<3";
    } elseif ($type == 4) {
       $Cond = " AND work_subdetails.project_work_status_id>=5";
    } elseif ($type == 5) {
       $Cond = " AND work_subdetails.project_work_status_id<5";
    } elseif ($type == 6) {
       $Cond = "AND work_subdetails.project_work_status_id>=3 and work_subdetails.project_work_status_id<5";
    }
    $sql          = "SELECT  department.name as dname,
                    financial_year.name as financial_yeartname,
                    building_type.name as building_typename,
                    division.name as division_name,
                    project_work_statuse.name as pws,
                    work_subdetails.work_name as work_name,
                    work_subdetails.work_code as work_code,
                    work_subdetails.work_type as work_type,
                    work_subdetails.tentative_completion_date as tentative_completion_date,
                    work_subdetails.id as sub_detail_id,
                    san.go_no as go_no,
                    project_work.ref_no as ref_no,
                    san.sanctioned_amount as sanctioned_amount,
                    project_work.project_name as project_name,work_subdetails.id as work_id,work_subdetails.project_work_id as project_id
                    FROM project_work_subdetails as work_subdetails
                    LEFT JOIN project_works as project_work on project_work.id = work_subdetails.project_work_id
                    LEFT JOIN project_administrative_sanctions as san on san.project_work_id = project_work.id
                    LEFT JOIN departments as department on department.id = project_work.department_id
                    LEFT JOIN financial_years as  financial_year on financial_year.id = project_work.financial_year_id
                    LEFT JOIN building_types as building_type on building_type.id = project_work.building_type_id
                    LEFT JOIN divisions as division on division.id = work_subdetails.division_id
                    LEFT JOIN project_work_statuses as project_work_statuse on project_work_statuse.id = work_subdetails.project_work_status_id
                    where work_subdetails.division_id=$div_id and work_subdetails.is_active =1 $Cond $condition $work_type_con $financial_year_cond ";
						//echo"<pre>";print_r($sql);exit();

    // echo "<pre>";
    // print_r($sql);
    // exit();

    $prjectdetails             = $connection->execute($sql)->fetchAll('assoc');
	$monitoringcount = array();
	$monitoring = array();
	$physicallly_completed = array();
	foreach($prjectdetails as $project){
		
	  $monitoringcount[$project['sub_detail_id']] = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_subdetail_id' => $project['sub_detail_id']])->count();
      
	 if($monitoringcount[$project['sub_detail_id']] > 0){
	 $monitoring[$project['sub_detail_id']]    = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages', 'FinancialPercentages'])->where(['ProjectMonitoringDetails.project_work_subdetail_id' =>$project['sub_detail_id']])->order(['ProjectMonitoringDetails.id'=>'DESC'])->first();
     $physicallly_completed[$project['sub_detail_id']] = $monitoring[$project['sub_detail_id']]['work_percentage']['name'];
 	 }
	
   }
    $this->set(compact('prjectdetails','physicallly_completed','monitoringcount'));
}

   public function ajaxdivisionfundtypereport($work_type=NULL,$div_id=NULL,$type=NULL)
  { 
  	$this->ProjectMonitoringDetails=$this->fetchTable('ProjectMonitoringDetails');

    $user = $this->request->getAttribute('identity');
    $userid =  $user->id;
    $role_id =  $user->role_id;
	$division_id = $user->division_id;
	$circle_id = $user->circle_id;
	if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
	$condition = " and work_subdetails.division_id = " . $division_id . "";
	} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
	$condition = " and work_subdetails.circle_id = " . $circle_id . "";
	} else {
	$condition = "";
	}
	
	if($work_type != ''){
		$work_type_con = " and work_subdetails.work_type = " . $work_type . "";
	}
	
    $connection        = ConnectionManager::get('default');
    if ($type == 1) {
       $Cond = "AND work_subdetails.project_work_status_id>=3 and san.fund_source_id =1";
    } elseif ($type == 2) {
       $Cond = "AND work_subdetails.project_work_status_id>=3 and san.fund_source_id =2";
    }else{
	    $Cond = "AND work_subdetails.project_work_status_id>=3";
	
		
	}
    $sql          = "SELECT  department.name as dname,
                    financial_year.name as financial_yeartname,
                    building_type.name as building_typename,
                    division.name as division_name,
                    project_work_statuse.name as pws,
                    work_subdetails.work_name as work_name,
                    work_subdetails.work_code as work_code,
                    work_subdetails.work_type as work_type,
                    work_subdetails.tentative_completion_date as tentative_completion_date,
                    work_subdetails.id as sub_detail_id,
                    san.go_no as go_no,
                    project_work.ref_no as ref_no,
                    san.sanctioned_amount as sanctioned_amount,
                    project_work.project_name as project_name,work_subdetails.id as work_id,work_subdetails.project_work_id as project_id
                    FROM project_work_subdetails as work_subdetails
                    LEFT JOIN project_works as project_work on project_work.id = work_subdetails.project_work_id
                    LEFT JOIN project_administrative_sanctions as san on san.project_work_id = project_work.id
                    LEFT JOIN departments as department on department.id = project_work.department_id
                    LEFT JOIN financial_years as  financial_year on financial_year.id = project_work.financial_year_id
                    LEFT JOIN building_types as building_type on building_type.id = project_work.building_type_id
                    LEFT JOIN divisions as division on division.id = work_subdetails.division_id
                    LEFT JOIN project_work_statuses as project_work_statuse on project_work_statuse.id = work_subdetails.project_work_status_id
                    where work_subdetails.division_id=$div_id and work_subdetails.is_active =1 $Cond $condition $work_type_con $financial_year_cond ";
						//echo"<pre>";print_r($sql);exit();

    // echo "<pre>";
    // print_r($sql);
    // exit();

    $prjectdetails             = $connection->execute($sql)->fetchAll('assoc');
	$monitoringcount = array();
	$monitoring = array();
	$physicallly_completed = array();
	foreach($prjectdetails as $project){
		
	  $monitoringcount[$project['sub_detail_id']] = $this->ProjectMonitoringDetails->find('all')->where(['ProjectMonitoringDetails.project_work_subdetail_id' => $project['sub_detail_id']])->count();
      
	 if($monitoringcount[$project['sub_detail_id']] > 0){
	 $monitoring[$project['sub_detail_id']]    = $this->ProjectMonitoringDetails->find('all')->contain(['ProjectWorks', 'WorkStages', 'WorkPercentages', 'FinancialPercentages'])->where(['ProjectMonitoringDetails.project_work_subdetail_id' =>$project['sub_detail_id']])->order(['ProjectMonitoringDetails.id'=>'DESC'])->first();
     $physicallly_completed[$project['sub_detail_id']] = $monitoring[$project['sub_detail_id']]['work_percentage']['name'];
 	 }
	
   }
    $this->set(compact('prjectdetails','physicallly_completed','monitoringcount'));
}
	
   public function ajaxplanningandpermissiondetails($val = null, $division_id = null)
   {
		$connection = ConnectionManager::get('default'); 
		if ($val == 1) {
			$Cond = " AND project.project_work_status_id>=3";
		} elseif ($val == 2) {
			$Cond = " AND project.is_planning_approval_send = 1";
		} elseif ($val == 3) {
			$Cond = " AND project.project_work_status_id>=10 and project.planning_permission_flag = 1";
		} elseif ($val == 4) {
			$Cond = " AND project.is_planning_approval_send = 1 and project.planning_permission_flag = 0";
		} elseif ($val == 5) {
			$Cond = " AND project.project_work_status_id>=3 and project.is_planning_approval_send = 3";
		} elseif ($val == 6) {
			$Cond = " AND project.project_work_status_id>=3 and project.is_planning_approval_send IN (0,2)";
		}
		
		$sql = "SELECT division.name as dname,
				financial_year.name as financial_yeartname,
				project_work_statuse.name as pws,
				project.work_name as work_name,
				project.work_code as work_code,
				planning.send_date as pdate,
				planning.approved_date as papprov  
				FROM project_work_subdetails as project
				LEFT JOIN project_works as project_work on project_work.id = project.project_work_id
				LEFT JOIN divisions as division on division.id = project.division_id
				LEFT JOIN financial_years as  financial_year on financial_year.id = project_work.financial_year_id
				LEFT JOIN project_work_statuses as project_work_statuse on project_work_statuse.id = project.project_work_status_id
				LEFT JOIN planning_permission_details as planning on planning.project_work_subdetail_id=project.id
				where project.is_active=1 and project.work_type=1 and project.division_id=$division_id  $Cond";

		$projectdetails   = $connection->execute($sql)->fetchAll('assoc');
		
	   $this->set(compact('projectdetails','val'));
	}	
	
   public function progressreport()
  {
		$this->viewBuilder()->setLayout('layout');
		$this->Districts=$this->fetchTable('Districts');
		$this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
		$this->DepartmentwiseWorkTypes=$this->fetchTable('DepartmentwiseWorkTypes');
		$this->ProjectWorks=$this->fetchTable('ProjectWorks');
		$this->Divisions=$this->fetchTable('Divisions');
		$this->ProjectwiseQuartersDetails=$this->fetchTable('ProjectwiseQuartersDetails');
		$this->ContractorDetails=$this->fetchTable('ContractorDetails');
		$this->ProjectWorkStatuses=$this->fetchTable('ProjectWorkStatuses');
		$this->FinancialYears=$this->fetchTable('FinancialYears');
		$this->ProjectFinancialSanctions=$this->fetchTable('ProjectFinancialSanctions');
		$this->ProjectMonitoringDetails=$this->fetchTable('ProjectMonitoringDetails');
		$this->ProjectwiseExpenditureDetails=$this->fetchTable('ProjectwiseExpenditureDetails');
		$this->ProjectwiseTimeExtensionDetails=$this->fetchTable('ProjectwiseTimeExtensionDetails');
		
		$user = $this->request->getAttribute('identity');
		$userid =  $user->id;
		$role_id =  $user->role_id;
		$division_id = $user->division_id;
		$circle_id = $user->circle_id;
		if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {
		$condition = " and project_subdetail.division_id = " . $division_id . "";
		} else if ($role_id == 5 || $role_id == 11 || $role_id == 12) {
		$condition = " and project_subdetail.circle_id = " . $circle_id . "";
		} else {
		$condition = "";
		}      
		
		if ($this->request->is(['post', 'patch', 'put'])) {
		//Division
		$div = $this->request->getData('division');
		$division = $this->Divisions->find('all')->where(['Divisions.id' => $div])->first();
		$division_wise = $division['name'];

		//Financial
		$finance = $this->request->getData('financial');
		if($finance != ''){
		$financial = $this->FinancialYears->find('all')->where(['FinancialYears.id' => $finance])->first();
		$finance_wise = $financial['name'];
		$finan_month     = ($finance != '') ? "AND month(expen.month)='" . ($finance_wise) . "'":"";
		}

		$financial_works = ($finance != '') ? " AND (financial_year.id) = '" . $finance . "'" : "";

        $connection            = ConnectionManager::get('default');
        if ($division) {
            //  echo "<pre>";  print_r($financial); exit();
              $sql   = "SELECT project_subdetail.id as sub_id,
						project_subdetail.work_name as name,
						project_subdetail.work_code as wcode,
						project_work.project_code as pcode,
						district.name as dname,
						project_subdetail.fs_amount as amount,
						project_subdetail.site_handover_date as sdate,
						project_subdetail.tentative_completion_date as adate,           
						project_work_statuse.name as sname
						FROM project_work_subdetails as project_subdetail
						LEFT JOIN project_works as project_work on project_work.id = project_subdetail.project_work_id
						LEFT JOIN financial_years as  financial_year on financial_year.id = project_work.financial_year_id
						left join districts as district on district.id=project_subdetail.district_id
						left join project_financial_sanctions as financial_sanction on financial_sanction.project_work_id=project_subdetail.project_work_id
						left join contractor_details as contractor on contractor.project_work_subdetail_id =project_subdetail.id
						LEFT JOIN project_work_statuses as project_work_statuse on project_work_statuse.id = project_subdetail.project_work_status_id
						WHERE project_subdetail.is_active = 1 and project_subdetail.project_work_status_id >=11 and (project_subdetail.division_id) = $div $financial_works $condition
						order by project_subdetail.work_type ASC";
        
            $projects  = $connection->execute($sql)->fetchAll('assoc');

            $monitoring_details  = array();
            $quarter_details     = array();
            $expenditure_details = array();
            $eot_time = array();
            //Monitoring details and quarter details and Expenditure details

            foreach ($projects as $project) {

                $monitoring_details[$project['sub_id']]  = $this->ProjectMonitoringDetails->find('all')->contain(['WorkPercentages', 'FinancialPercentages'])->where(['ProjectMonitoringDetails.project_work_subdetail_id' => $project['sub_id']])->order(['ProjectMonitoringDetails.id'=>'DESC'])->first();
                $quarter_sql = "SELECT 
							sum(CASE WHEN quarter_details.police_designation_id=1 OR quarter_details.police_designation_id=2 OR quarter_details.police_designation_id=3 OR  quarter_details.police_designation_id=4 THEN (quarter_details.no_of_quarters) ELSE 0 END)AS ig,
							sum(CASE WHEN quarter_details.police_designation_id=5 OR  quarter_details.police_designation_id=6 OR  quarter_details.police_designation_id=7 THEN (quarter_details.no_of_quarters) ELSE 0 END)AS dsp,
							sum(CASE WHEN quarter_details.police_designation_id=8 THEN (quarter_details.no_of_quarters) ELSE 0 END)AS insp,
							sum(CASE WHEN quarter_details.police_designation_id=9 THEN (quarter_details.no_of_quarters) ELSE 0 END)AS sub_insp,
							sum(CASE WHEN quarter_details.police_designation_id=10 OR quarter_details.police_designation_id=11 THEN (quarter_details.no_of_quarters) ELSE 0 END)AS constable
                            FROM projectwise_quarters_details as quarter_details
                            WHERE quarter_details.project_work_subdetail_id=" . $project['sub_id'] . "";

                $quarter_details[$project['sub_id']]  = $connection->execute($quarter_sql)->fetchAll('assoc');

                // $expenditure_details[$project['sub_id']]  = $this->ProjectwiseExpenditureDetails->find('all')->where(['ProjectwiseExpenditureDetails.project_work_subdetail_id' => $project['sub_id']])->first();
                $expenditure_sql1 = "SELECT	 expen.	expenditure as last_month
									 FROM projectwise_expenditure_details AS expen
									 where expen.project_work_subdetail_id=" . $project['sub_id'] . " and expen.month <'" . date("Y-m") . "'   
									 order by expen.id DESC
									 LIMIT 1                 
									 ";

                $expenditure_details1  = $connection->execute($expenditure_sql1)->fetchAll('assoc');

                $expenditure_sql2 = "SELECT expen.	expenditure as this_month
									 FROM projectwise_expenditure_details AS expen
									 where expen.project_work_subdetail_id=" . $project['sub_id'] . " and expen.month ='" . date("Y-m") . "' 
									 order by expen.id DESC
									 LIMIT 1
									 ";

                $expenditure_details2  = $connection->execute($expenditure_sql2)->fetchAll('assoc');

                $expenditure_details[$project['sub_id']]['last_month'] = $expenditure_details1[0]['last_month'];
                $expenditure_details[$project['sub_id']]['this_month'] = $expenditure_details2[0]['this_month'];
				
               $eot  = $this->ProjectwiseTimeExtensionDetails->find('all')->where(['ProjectwiseTimeExtensionDetails.project_work_subdetail_id' => $project['sub_id']])->order(['ProjectwiseTimeExtensionDetails.id'=>'DESC'])->first();
               $eot_time[$project['sub_id']]['eot'] = $eot['extension_date_of_ee'];
				
            }
        }
    }

  if ($role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 13 || $role_id == 14 || $role_id == 15) {

    $division_table = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1,'Divisions.id'=>$division_id])->toArray();
  }else{   
   $division_table = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
  } 

   $financial      = $this->FinancialYears->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['FinancialYears.is_active' => 1])->toArray();
    $this->set(compact('eot_time','expenditure_details', 'project1', 'quarter_details', 'monitoring_details', 'division', 'division_table', 'projects', 'financial', 'division_wise', 'finance_wise', 'finance', 'div'));
   }
   
    public function ajaxphoto($sub_id = NULL)
    {
        $connection    = ConnectionManager::get('default');
        $this->FinancialYears=$this->fetchTable('FinancialYears');
        $this->ProjectMonitoringDetails=$this->fetchTable('ProjectMonitoringDetails');
        $this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
        $this->ProjectFinancialSanctions=$this->fetchTable('ProjectFinancialSanctions');
        $this->ProjectWorks=$this->fetchTable('ProjectWorks');		
        $this->ProjectMonitoringPhotosUploads=$this->fetchTable('ProjectMonitoringPhotosUploads');		
        
		//echo "<pre>"; print_r($projectworksubdetails); exit();
        $projectworksubdetails = $this->ProjectWorkSubdetails->find('all')->contain(['Districts','Divisions','Circles'])->where(['ProjectWorkSubdetails.id' => $sub_id])->first();
		$projectwork           = $this->ProjectWorks->find('all')->where(['ProjectWorks.id' => $projectworksubdetails['project_work_id']])->first();
        $financial          = $this->FinancialYears->find('all')->where(['FinancialYears.id' => $projectwork['financial_year_id']])->first();
        $name               = $financial['name'];
        $monitoringDetails  = $this->ProjectMonitoringDetails->find('all')->contain(['WorkPercentages','FinancialPercentages'])->where(['ProjectMonitoringDetails.project_work_subdetail_id' => $sub_id])->order(['ProjectMonitoringDetails.id Desc'])->limit(2)->toArray();
        $financialsanction  = $this->ProjectFinancialSanctions->find('all')->contain(['ProjectWorks'])->where(['ProjectFinancialSanctions.project_work_id' => $projectworksubdetails['project_work_id']])->first();
   
	   foreach($monitoringDetails as $key => $value){
 	    $description[$key] = $value['description'];
       // $photo[$key]       = $value['photo_upload'];
        $photo[$key]       =  $this->ProjectMonitoringPhotosUploads->find('all')->where(['ProjectMonitoringPhotosUploads.project_monitoring_detail_id' => $value['id']])->toArray();
	   }
	  //echo "<pre>"; print_r($monitoringDetails); exit();  

        $this->set(compact('i','photo','description','name','projectworksubdetails','monitoringDetails','financialsanction'));
    }
	
	public function tentativefinancialreport(){
    $this->viewBuilder()->setLayout('layout');
    $user = $this->request->getAttribute('identity');
    $this->Divisions=$this->fetchTable('Divisions');
    $this->FinancialYears=$this->fetchTable('FinancialYears');
    $this->ProjectWorks=$this->fetchTable('ProjectWorks');
    $connection = ConnectionManager::get('default');
    if ($this->request->is(['patch', 'post', 'put'])) {

        $financial_year_id       = $this->request->getData('financial_year_id');
        $financial               = $this->FinancialYears->find('all')->where(['FinancialYears.id' => $financial_year_id])->first();
        $financial_year_name     = $financial['name'];
        $financial_year_cond     = ($financial_year_id  != '') ? " AND tentative.financial_year_id = '" . $financial_year_id . "'" : "";
        $divisionsname           = $this->Divisions->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Divisions.is_active' => 1])->toArray();
        // echo"<pre>";print_r ($financial_year_name);exit();
        $division_details = array();
        foreach ($divisionsname as $key => $divistionvalue) {
            $query        = "select division.name as dname,financial_year.name as yname,
                            tentative.apr as apr,
                            tentative.may as may,
                            tentative.june as june,
                            tentative.july as july,
                            tentative.aug as aug,
                            tentative.sep as sep,
                            tentative.oct as oct,
                            tentative.nov as nov,
                            tentative.dece as dece,
                            tentative.jan as jan,
                            tentative.feb as feb,
                            tentative.mar as mar,
                            tentative.total_amount as total_amount from tentative_financial_programme_details as tentative   
                            LEFT JOIN divisions as division on division.id = tentative.division_id        
                            LEFT JOIN financial_years as financial_year on financial_year.id = tentative.financial_year_id        
                            where tentative.division_id =".$key." and tentative.financial_year_id=$financial_year_id";   
                            // echo"<pre>";print_r($query);exit();
            $Totalcount      = $connection->execute($query)->fetchAll('assoc');
            $division_details[$key]['division_name']  = $divistionvalue;
            $division_details[$key]['Apr']            = $Totalcount[0]['apr'] ? $Totalcount[0]['apr'] : 0;
            $division_details[$key]['May']            = $Totalcount[0]['may'] ? $Totalcount[0]['may'] : 0;
            $division_details[$key]['June']           = $Totalcount[0]['june'] ? $Totalcount[0]['june'] : 0 ;
            $division_details[$key]['July']           = $Totalcount[0]['july'] ? $Totalcount[0]['july'] : 0;
            $division_details[$key]['Aug']            = $Totalcount[0]['aug'] ? $Totalcount[0]['aug'] : 0;
            $division_details[$key]['Sep']            = $Totalcount[0]['sep'] ? $Totalcount[0]['sep'] : 0;
            $division_details[$key]['Oct']            = $Totalcount[0]['oct'] ? $Totalcount[0]['oct'] : 0;
            $division_details[$key]['Nov']            = $Totalcount[0]['nov'] ? $Totalcount[0]['nov'] : 0;
            $division_details[$key]['Dece']           = $Totalcount[0]['dece'] ? $Totalcount[0]['dece'] : 0;
            $division_details[$key]['Jan']            = $Totalcount[0]['jan'] ? $Totalcount[0]['jan'] : 0;
            $division_details[$key]['Feb']            = $Totalcount[0]['feb'] ? $Totalcount[0]['feb'] : 0;
            $division_details[$key]['Mar']            = $Totalcount[0]['mar'] ? $Totalcount[0]['mar'] : 0;
            $division_details[$key]['totalamount']    = $Totalcount[0]['total_amount'] ? $Totalcount[0]['total_amount'] : 0;
            // $year   =  $division_details[$key]['Yearname']       =$Totalcount[0]['yname'] ;

        //    echo"<pre>";print_r($division_details);exit();
        }
    }
    $finacial_year     = $this->FinancialYears->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['FinancialYears.is_active' => 1])->toArray();
    // echo"<pre>";print_r($finacial_year);exit();
    $this->set(compact('divisionsname','division_details','Totalcount','finacial_year','financial_year_name'));
  }
  
  /*public function utilisationcertificate()
{

  $this->viewBuilder()->setLayout('layout');
  $this->loadModel('ProjectWorkSubdetails');	
  $this->loadModel('ProjectFinancialSanctions');	
  $this->loadModel('UtilizationCertificates');	
  $this->loadModel('ProjectFundRequestDetails');
  $this->loadModel('FinancialYears');
  $this->loadModel('Departments');

  $connection = ConnectionManager::get('default');
  if ($this->request->is(['patch', 'post', 'put'])) {

      // echo"<pre>";print_r($_POST);exit();
      $financial_year_id       =  $this->request->getData('financial_year_id');
      $department              =  $this->request->getData('department_id');

     $sql = "SELECT 
          project_work_subdetail.work_name as work_name,
          project_financial_sanction.go_no as go_no,
          project_financial_sanction.id as pfsid,
          project_financial_sanction.go_date as go_date,
          project_work_subdetail.expenditure_incurred as expenditure_incurred,
          utilization_certificate.amount as ucamount1,
          utilization_certificate.id as uid,
          project_fund_request_detail.request_amount as request_amount,
          project_financial_sanction.sanctioned_amount as sanctioned_amount1,
          project_financial_sanction.sanctioned_amount - utilization_certificate.amount as totalsubtraction
          FROM project_work_subdetails as project_work_subdetail 
          LEFT JOIN project_works as project_work on project_work.id = project_work_subdetail.project_work_id
          LEFT JOIN project_financial_sanctions as project_financial_sanction on project_financial_sanction.project_work_id = project_work.id 
          LEFT JOIN utilization_certificates as utilization_certificate on utilization_certificate.project_work_id = project_work.id
          LEFT JOIN project_fund_request_details as project_fund_request_detail on project_fund_request_detail.project_work_id = project_work.id
          where project_work_subdetail.is_active =1  and  project_work.financial_year_id = $financial_year_id and department_id = $department"; 

                  // echo"<pre>";print_r($sql);exit();


         $utilisationcertificatedetails  = $connection->execute($sql)->fetchAll('assoc');
                          //    echo"<pre>";print_r($utilisationcertificatedetails);exit();


  }
  
  $finacial_year     = $this->FinancialYears->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['FinancialYears.is_active' => 1])->toArray();
  $department        = $this->Departments->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Departments.is_active' => 1])->toArray();
  $this->set(compact('utilisationcertificatedetails','finacial_year','department'));
}


public function ajaxutilisationreport($id){

                  // echo"<pre>";print_r($id);exit();

  $connection    = ConnectionManager::get('default');
  $this->loadModel('UtilizationCertificates');
  $sql  ="SELECT 
          utilization_certificate.certificated_date as certificated_date,
          utilization_certificate.amount as amount,
          utilization_certificate.uc_sanctioned as uc_sanctioned,
          utilization_certificate.remarks as remarks,
          project_work.project_name as project_name,
          project_work_subdetail.work_name as work_name,
          utilization_certificate.certificate_upload as certificate_upload
          FROM utilization_certificates as utilization_certificate 
          LEFT JOIN project_works as project_work on project_work.id = utilization_certificate.project_work_id
          LEFT JOIN project_work_subdetails as project_work_subdetail on project_work_subdetail.id = utilization_certificate.project_work_subdetail_id
          where utilization_certificate.id = $id";	
  $utilisationcertificate  = $connection->execute($sql)->fetchAll('assoc');

  // echo"<pre>";print_r($sql);exit();
  // echo"<pre>";print_r($utilisationcertificate);exit();

  $this->set(compact('utilisationcertificate'));
}

public function ajaxfinancialsanctions($id){

  // echo"<pre>";print_r($id);exit();

  $connection    = ConnectionManager::get('default');
  $this->loadModel('ProjectFinancialSanctions');

   $sql="SELECT 
        project_financial_sanction.go_no as go_no,
        project_financial_sanction.sanctioned_amount as sanctioned_amount,
        project_financial_sanction.go_date as go_date,
        project_financial_sanction.sanctioned_file_upload as sanctioned_file_upload
        FROM project_financial_sanctions as project_financial_sanction where project_financial_sanction.id = $id";

  $ProjectFinancialSanction  = $connection->execute($sql)->fetchAll('assoc');


  // echo"<pre>";print_r($ProjectFinancialSanction);exit();

  $this->set(compact('ProjectFinancialSanction'));

}*/


  // public function utilisationcertificate()
  // {

  // $this->viewBuilder()->setLayout('layout');
  // $this->loadModel('ProjectWorkSubdetails');	
  // $this->loadModel('ProjectFinancialSanctions');	
  // $this->loadModel('UtilizationCertificates');	
  // $this->loadModel('ProjectFundRequestDetails');
  // $this->loadModel('FinancialYears');
  // $this->loadModel('Departments');
  // $this->ProjectMonitoringDetails=$this->fetchTable('ProjectMonitoringDetails');

  // $connection = ConnectionManager::get('default');
  // if ($this->request->is(['patch', 'post', 'put'])) {

      // // echo"<pre>";print_r($_POST);exit();
      // $financial_year_id       =  $this->request->getData('financial_year_id');
      // $department              =  $this->request->getData('department_id');

     // $sql = "SELECT 
          // project_work.id as pid,
          // project_work_subdetail.id as pwid,
          // project_work_subdetail.work_name as work_name,
          // project_financial_sanction.go_no as go_no,
          // project_financial_sanction.id as pfsid,
          // project_financial_sanction.go_date as go_date,
          // project_work_subdetail.expenditure_incurred as expenditure_incurred,
          // project_work_subdetail.fs_amount as fs_amount,
          // project_fund_request_detail.request_amount as request_amount,
          // project_financial_sanction.sanctioned_amount as sanctioned_amount1
          // FROM project_work_subdetails as project_work_subdetail 
          // LEFT JOIN project_works as project_work on project_work.id = project_work_subdetail.project_work_id
          // LEFT JOIN project_financial_sanctions as project_financial_sanction on project_financial_sanction.project_work_id = project_work.id 
          // LEFT JOIN project_fund_request_details as project_fund_request_detail on project_fund_request_detail.project_work_id = project_work.id
          // where project_work_subdetail.is_active =1 and  project_work.financial_year_id = $financial_year_id and department_id = $department"; 
          // // echo"<pre>";print_r($sql);exit();
         // $utilisationcertificatedetails  = $connection->execute($sql)->fetchAll('assoc');

         // $uc_amount_detail =array();

         // foreach($utilisationcertificatedetails as $uc){
          // $sql1 = "SELECT 
          // sum(uc.amount) as tot_amount
          // FROM utilization_certificates as uc 
          // where uc.project_work_subdetail_id = '".$uc['pwid']."'
          // group by uc.project_work_subdetail_id"; 
          // $uc_detail  = $connection->execute($sql1)->fetchAll('assoc');
          // $uc_amount_detail[$uc['pwid']]  = $uc_detail[0]['tot_amount'];

          // $projectmonitoring      = $this->ProjectMonitoringDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['ProjectMonitoringDetails.project_work_subdetail_id' => $uc['pwid']])->last();
          // $monitoring[$uc['pwid']] =  $projectmonitoring;
          // // echo"<pre>";print_r( $monitoring[$uc['pwid']]);exit();

         // }      
  // }
  
  // $finacial_year     = $this->FinancialYears->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['FinancialYears.is_active' => 1])->toArray();
  // $department        = $this->Departments->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Departments.is_active' => 1])->toArray();
  // $this->set(compact('utilisationcertificatedetails','finacial_year','department','uc_amount_detail','monitoring'));  
// }

  // public function ajaxutilisationreport($pwid,$pid){
  // $connection    = ConnectionManager::get('default');
  // $this->loadModel('UtilizationCertificates');
  // $sql  ="SELECT 
          // utilization_certificate.certificated_date as certificated_date,
          // utilization_certificate.amount as amount,
          // utilization_certificate.uc_sanctioned as uc_sanctioned,
          // utilization_certificate.remarks as remarks,
          // project_work.project_name as project_name,
          // project_work_subdetail.work_name as work_name,
          // utilization_certificate.certificate_upload as certificate_upload
          // FROM utilization_certificates as utilization_certificate 
          // LEFT JOIN project_works as project_work on project_work.id = utilization_certificate.project_work_id
          // LEFT JOIN project_work_subdetails as project_work_subdetail on project_work_subdetail.id = utilization_certificate.project_work_subdetail_id
          // where utilization_certificate.project_work_subdetail_id	 = $pwid and utilization_certificate.project_work_id = $pid ";	
    // $utilisationcertificate  = $connection->execute($sql)->fetchAll('assoc');


  // $this->set(compact('utilisationcertificate'));
 // }
 
     public function utilisationcertificate()
    {
        $this->viewBuilder()->setLayout('layout');
        $this->ProjectWorkSubdetails=$this->fetchTable('ProjectWorkSubdetails');
        $this->ProjectFinancialSanctions=$this->fetchTable('ProjectFinancialSanctions');
        $this->UtilizationCertificates=$this->fetchTable('UtilizationCertificates');
        $this->ProjectFundRequestDetails=$this->fetchTable('ProjectFundRequestDetails');
        $this->FinancialYears=$this->fetchTable('FinancialYears');
        $this->Departments=$this->fetchTable('Departments');
        $this->ProjectMonitoringDetails=$this->fetchTable('ProjectMonitoringDetails');

        $connection = ConnectionManager::get('default');
        if ($this->request->is(['patch', 'post', 'put'])) {

            // echo"<pre>";print_r($_POST);exit();
            $financial_year_id       =  $this->request->getData('financial_year_id')?$this->request->getData('financial_year_id'):'';
            $department              =  $this->request->getData('department_id')?$this->request->getData('department_id'):'';

            $sql = "SELECT
				  project_work.id as pid,
				  project_work_subdetail.id as pwid,
				  project_work_subdetail.work_name as work_name,
				  project_financial_sanction.go_no as go_no,
				  project_financial_sanction.id as pfsid,
				  project_financial_sanction.go_date as go_date,
				  project_work_subdetail.expenditure_incurred as expenditure_incurred,
				  project_work_subdetail.fs_amount as fs_amount,
				  project_fund_request_detail.request_amount as request_amount,
				  project_financial_sanction.sanctioned_amount as sanctioned_amount1
				  FROM project_work_subdetails as project_work_subdetail
				  LEFT JOIN project_works as project_work on project_work.id = project_work_subdetail.project_work_id
				  LEFT JOIN project_financial_sanctions as project_financial_sanction on project_financial_sanction.project_work_id = project_work.id
				  LEFT JOIN project_fund_request_details as project_fund_request_detail on project_fund_request_detail.project_work_id = project_work.id
				  where project_work_subdetail.is_active =1 and  project_work.financial_year_id = $financial_year_id and project_work.department_id = $department
				  ";
            // echo"<pre>";print_r($sql);exit();
            $utilisationcertificatedetails  = $connection->execute($sql)->fetchAll('assoc');

            $uc_amount_detail = array();

            foreach ($utilisationcertificatedetails as $uc) {
                $sql1 = "SELECT
          sum(uc.amount) as tot_amount
          FROM utilization_certificates as uc
          where uc.project_work_subdetail_id = '" . $uc['pwid'] . "'
          group by uc.project_work_subdetail_id";
                $uc_detail  = $connection->execute($sql1)->fetchAll('assoc');
                $uc_amount_detail[$uc['pwid']]  = $uc_detail[0]['tot_amount'];

                $projectmonitoring      = $this->ProjectMonitoringDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['ProjectMonitoringDetails.project_work_subdetail_id' => $uc['pwid']])->order(['ProjectMonitoringDetails.id'=>'DESC'])->first();
                $monitoring[$uc['pwid']] =  $projectmonitoring;
                // echo"<pre>";print_r( $monitoring[$uc['pwid']]);exit();

            }
        }

        $finacial_year     = $this->FinancialYears->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['FinancialYears.is_active' => 1])->toArray();
        $department        = $this->Departments->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Departments.is_active' => 1])->toArray();
        $this->set(compact('utilisationcertificatedetails', 'finacial_year', 'department', 'uc_amount_detail', 'monitoring'));
    }

    public function ajaxutilisationreport($pwid, $pid)
    {
        $connection    = ConnectionManager::get('default');
        $this->UtilizationCertificates=$this->fetchTable('UtilizationCertificates');
        $sql  = "SELECT
          utilization_certificate.certificated_date as certificated_date,
          utilization_certificate.amount as amount,
          utilization_certificate.uc_sanctioned as uc_sanctioned,
          utilization_certificate.remarks as remarks,
          project_work.project_name as project_name,
          project_work_subdetail.work_name as work_name,
          utilization_certificate.certificate_upload as certificate_upload
          FROM utilization_certificates as utilization_certificate
          LEFT JOIN project_works as project_work on project_work.id = utilization_certificate.project_work_id
          LEFT JOIN project_work_subdetails as project_work_subdetail on project_work_subdetail.id = utilization_certificate.project_work_subdetail_id
          where utilization_certificate.project_work_subdetail_id    = $pwid and utilization_certificate.project_work_id = $pid ";
        $utilisationcertificate  = $connection->execute($sql)->fetchAll('assoc');


        $this->set(compact('utilisationcertificate'));
    }

  public function ajaxfinancialsanctions($id){
	  $connection    = ConnectionManager::get('default');
	  $this->ProjectFinancialSanctions=$this->fetchTable('ProjectFinancialSanctions');
	   $sql="SELECT 
			project_financial_sanction.go_no as go_no,
			project_financial_sanction.sanctioned_amount as sanctioned_amount,
			project_financial_sanction.go_date as go_date,
			project_financial_sanction.sanctioned_file_upload as sanctioned_file_upload
			FROM project_financial_sanctions as project_financial_sanction where project_financial_sanction.id = $id";

	  $ProjectFinancialSanction  = $connection->execute($sql)->fetchAll('assoc');
	  $this->set(compact('ProjectFinancialSanction'));
	}
}