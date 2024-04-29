<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class OldProjectWorkDetailsTable extends Table
{
   
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('old_project_work_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('Circles', [
            'foreignKey' => 'circle_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('FinancialYears', [
            'foreignKey' => 'financial_year_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'LEFT',
        ]);
    }    
}