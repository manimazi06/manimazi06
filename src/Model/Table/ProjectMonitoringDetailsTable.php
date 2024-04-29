<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ProjectMonitoringDetailsTable extends Table
{
   
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('project_monitoring_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectWorks', [
            'foreignKey' => 'project_work_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ProjectWorkSubdetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->belongsTo('WorkStages', [
            'foreignKey' => 'work_stage_id',
        ]);
        $this->belongsTo('WorkPercentages', [
            'foreignKey' => 'work_percentage_id',
        ]);
		 $this->belongsTo('FinancialPercentages', [
            'foreignKey' => 'financial_percentage_id',
        ]);
        $this->hasMany('ProjectMonitoringPhotosUploads', [
            'foreignKey' => 'project_monitoring_detail_id',
        ]);
    }  
    
}