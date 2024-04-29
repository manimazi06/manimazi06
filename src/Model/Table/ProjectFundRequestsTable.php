<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ProjectFundRequestsTable extends Table
{
    
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('project_fund_requests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('FundStatuses', [
            'foreignKey' => 'fund_status_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
		$this->belongsTo('Divisions', [
            'foreignKey' => 'division_id',
        ]);
        $this->hasMany('ProjectFundRequestDetails', [
            'foreignKey' => 'project_fund_request_id',
        ]);
    }    
}