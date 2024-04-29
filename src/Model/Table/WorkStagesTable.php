<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WorkStages Model
 *
 * @property \App\Model\Table\ProjectMonitoringDetailsTable&\Cake\ORM\Association\HasMany $ProjectMonitoringDetails
 * @property \App\Model\Table\ProjectMonitoringSubDetailsTable&\Cake\ORM\Association\HasMany $ProjectMonitoringSubDetails
 *
 * @method \App\Model\Entity\WorkStage newEmptyEntity()
 * @method \App\Model\Entity\WorkStage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\WorkStage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WorkStage get($primaryKey, $options = [])
 * @method \App\Model\Entity\WorkStage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\WorkStage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WorkStage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\WorkStage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WorkStage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WorkStage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\WorkStage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\WorkStage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\WorkStage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class WorkStagesTable extends Table
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

        $this->setTable('work_stages');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ProjectMonitoringDetails', [
            'foreignKey' => 'work_stage_id',
        ]);
        $this->hasMany('ProjectMonitoringSubDetails', [
            'foreignKey' => 'work_stage_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
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
            ->integer('modified_on')
            ->requirePresence('modified_on', 'create')
            ->notEmptyString('modified_on');

        $validator
            ->dateTime('modified_date')
            ->requirePresence('modified_date', 'create')
            ->notEmptyDateTime('modified_date');

        return $validator;
    }
}
