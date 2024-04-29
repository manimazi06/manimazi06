<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class FundRequestUserDepartmentSubdetailsTable extends Table
{
   
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('fund_request_user_department_subdetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('FundRequestUserDepartmentDetails', [
            'foreignKey' => 'fund_request_user_department_detail_id',
        ]);
        $this->belongsTo('ProjectWorks', [
            'foreignKey' => 'project_work_id',
			'joinType' => 'INNER',
        ]);
        $this->belongsTo('ProjectWorkSubdetails', [
            'foreignKey' => 'project_work_subdetail_id',
			'joinType' => 'INNER',
        ]);
    }    
}