<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectMinuteSubdetails Model
 *
 * @property \App\Model\Table\ProjectMinuteDetailsTable&\Cake\ORM\Association\BelongsTo $ProjectMinuteDetails
 *
 * @method \App\Model\Entity\ProjectMinuteSubdetail newEmptyEntity()
 * @method \App\Model\Entity\ProjectMinuteSubdetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectMinuteSubdetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectMinuteSubdetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectMinuteSubdetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectMinuteSubdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectMinuteSubdetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectMinuteSubdetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectMinuteSubdetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectMinuteSubdetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectMinuteSubdetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectMinuteSubdetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectMinuteSubdetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectMinuteSubdetailsTable extends Table
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

        $this->setTable('project_minute_subdetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectMinuteDetails', [
            'foreignKey' => 'project_minute_detail_id',
            'joinType' => 'INNER',
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
            ->integer('project_minute_detail_id')
            ->requirePresence('project_minute_detail_id', 'create')
            ->notEmptyString('project_minute_detail_id');

        $validator
            ->scalar('minutes_points')
            ->allowEmptyString('minutes_points');

        $validator
            ->scalar('action_taken')
            ->allowEmptyString('action_taken');

        $validator
            ->date('action_taken_date')
            ->allowEmptyDate('action_taken_date');

        $validator
            ->integer('is_active')
            ->allowEmptyString('is_active');

        $validator
            ->date('created_date')
            ->allowEmptyDate('created_date');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        $validator
            ->date('modified_date')
            ->allowEmptyDate('modified_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('project_minute_detail_id', 'ProjectMinuteDetails'), ['errorField' => 'project_minute_detail_id']);

        return $rules;
    }
}
