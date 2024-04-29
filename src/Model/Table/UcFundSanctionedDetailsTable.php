<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UcFundSanctionedDetailsTable extends Table
{
 
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('uc_fund_sanctioned_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('UtilizationCertificates', [
            'foreignKey' => 'utilization_certificate_id',
        ]);
        $this->belongsTo('ProjectWorks', [
            'foreignKey' => 'project_work_id',
        ]);
        $this->belongsTo('ProjectWorkSubdetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
    }   
}