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
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ContractorDetails', [
            'foreignKey' => 'contractor_id',
        ]);
        $this->hasMany('LicenseRenewalDetails', [
            'foreignKey' => 'contractor_id',
        ]);
    }   
}