<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ProjectAdministrativeSanctionsTable extends Table
{
    
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('project_administrative_sanctions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectWorks', [
            'foreignKey' => 'project_work_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('SupervisionCharges', [
            'foreignKey' => 'supervision_charge_id',
        ]);
        $this->belongsTo('FundSources', [
            'foreignKey' => 'fund_source_id',
        ]);
    }

   
}