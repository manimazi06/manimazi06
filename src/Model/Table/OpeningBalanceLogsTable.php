<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

 
class OpeningBalanceLogsTable extends Table
{
   
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('opening_balance_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id',
        ]);
       
    }    
}