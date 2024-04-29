<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ProjectFundRequestDetailLogsTable extends Table
{
  
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('project_fund_request_detail_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // $this->belongsTo('ProjectFundRequestLogs', [
            // 'foreignKey' => 'project_fund_request_log_id',
        // ]);
        $this->belongsTo('ProjectWorks', [
            'foreignKey' => 'project_work_id',
        ]);
        $this->belongsTo('ProjectWorkSubdetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->belongsTo('FundStatuses', [
            'foreignKey' => 'fund_status_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
    }  
}