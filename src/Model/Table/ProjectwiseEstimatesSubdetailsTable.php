<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectwiseEstimatesSubdetails Model
 *
 * @property \App\Model\Table\ProjectwiseEstimatesDetailsTable&\Cake\ORM\Association\BelongsTo $ProjectwiseEstimatesDetails
 *
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail newEmptyEntity()
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectwiseEstimatesSubdetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectwiseEstimatesSubdetailsTable extends Table
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

        $this->setTable('projectwise_estimates_subdetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectwiseEstimatesDetails', [
            'foreignKey' => 'projectwise_estimates_detail_id',
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
            ->integer('projectwise_estimates_detail_id')
            ->allowEmptyString('projectwise_estimates_detail_id');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('number1')
            ->maxLength('number1', 150)
            ->allowEmptyString('number1');

        $validator
            ->scalar('number2')
            ->maxLength('number2', 150)
            ->allowEmptyString('number2');

        $validator
            ->scalar('length')
            ->maxLength('length', 150)
            ->allowEmptyString('length');

        $validator
            ->scalar('breath')
            ->maxLength('breath', 150)
            ->allowEmptyString('breath');

        $validator
            ->scalar('depth')
            ->maxLength('depth', 150)
            ->allowEmptyString('depth');

        $validator
            ->scalar('quantity')
            ->maxLength('quantity', 150)
            ->allowEmptyString('quantity');

        $validator
            ->integer('is_active')
            ->allowEmptyString('is_active');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->dateTime('created_date')
            ->allowEmptyDateTime('created_date');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        $validator
            ->dateTime('modified_date')
            ->allowEmptyDateTime('modified_date');

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
        $rules->add($rules->isUnique(['id']), ['errorField' => 'id']);
        $rules->add($rules->existsIn('projectwise_estimates_detail_id', 'ProjectwiseEstimatesDetails'), ['errorField' => 'projectwise_estimates_detail_id']);

        return $rules;
    }
}
