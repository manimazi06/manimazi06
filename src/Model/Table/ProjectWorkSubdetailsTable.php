<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProjectWorkSubdetailsTable extends Table
{
   
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('project_work_subdetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectWorks', [
            'foreignKey' => 'project_work_id',
        ]);
        $this->belongsTo('Circles', [
            'foreignKey' => 'circle_id',
        ]);
        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id',
        ]);
        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id',
        ]);		
		       
        $this->belongsTo('ProjectWorkStatuses', [
            'foreignKey' => 'project_work_status_id',
        ]);
        /*$this->hasMany('ContractorDetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->hasMany('DetailedEstimateApprovalStages', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->hasMany('PlanningPermissionDetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->hasMany('ProjectFundDetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->hasMany('ProjectFundRequestDetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->hasMany('ProjectMinuteDetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->hasMany('ProjectMonitoringDetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->hasMany('ProjectTenderDetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->hasMany('ProjectTimelineDetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->hasMany('ProjectwiseDetailedEstimates', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->hasMany('ProjectwiseDevelopmentWorkDetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->hasMany('TechnicalSanctions', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);*/
    }    
}