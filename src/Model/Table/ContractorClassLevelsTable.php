<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ContractorClassLevelsTable extends Table
{   
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('contractor_class_levels');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }    
}