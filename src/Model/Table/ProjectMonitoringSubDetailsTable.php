<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ProjectMonitoringSubDetailsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('project_monitoring_sub_details');

        $this->belongsTo('WorkStages', [
            'foreignKey' => 'work_stage_id',
            'joinType' => 'INNER',
        ]);
    }

  
    /*public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->requirePresence('id', 'create')
            ->notEmptyString('id');

        $validator
            ->integer('work_stage_id')
            ->requirePresence('work_stage_id', 'create')
            ->notEmptyString('work_stage_id');

        $validator
            ->scalar('file_upload')
            ->requirePresence('file_upload', 'create')
            ->notEmptyFile('file_upload');

        $validator
            ->numeric('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        $validator
            ->integer('is_active')
            ->notEmptyString('is_active');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmptyString('created_by');

        $validator
            ->dateTime('created_date')
            ->requirePresence('created_date', 'create')
            ->notEmptyDateTime('created_date');

        $validator
            ->integer('modified_by')
            ->requirePresence('modified_by', 'create')
            ->notEmptyString('modified_by');

        $validator
            ->dateTime('modified_date')
            ->requirePresence('modified_date', 'create')
            ->notEmptyDateTime('modified_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    /*public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('work_stage_id', 'WorkStages'), ['errorField' => 'work_stage_id']);

        return $rules;
    }*/
}