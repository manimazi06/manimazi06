<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ContractorRegisteredDepartmentsTable extends Table
{   
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('contractor_registered_departments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }    
}