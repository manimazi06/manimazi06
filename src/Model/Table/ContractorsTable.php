<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ContractorsTable extends Table
{
  
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('contractors');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ContractorClasses', [
            'foreignKey' => 'contractor_class_id',
            'joinType' => 'LEFT',
        ]);
		
		 $this->belongsTo('ContractorTypes', [
            'foreignKey' => 'contractor_type_id',
            'joinType' => 'LEFT',
        ]);
		
		 $this->belongsTo('ContractorClassLevels', [
            'foreignKey' => 'contractor_class_level_id',
            'joinType' => 'LEFT',
        ]);
		
		 $this->belongsTo('ContractorRegisteredDepartments', [
            'foreignKey' => 'contractor_registered_department_id',
            'joinType' => 'LEFT',
        ]);
        $this->hasMany('ContractorDetails', [
            'foreignKey' => 'contractor_id',
        ]);
        $this->hasMany('LicenseRenewalDetails', [
            'foreignKey' => 'contractor_id',
        ]);
    }   
}