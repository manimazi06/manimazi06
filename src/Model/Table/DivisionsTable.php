<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Divisions Model
 *
 * @property \App\Model\Table\ProjectWorksTable&\Cake\ORM\Association\HasMany $ProjectWorks
 *
 * @method \App\Model\Entity\Division newEmptyEntity()
 * @method \App\Model\Entity\Division newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Division[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Division get($primaryKey, $options = [])
 * @method \App\Model\Entity\Division findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Division patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Division[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Division|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Division saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Division[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Division[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Division[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Division[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DivisionsTable extends Table
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

        $this->setTable('divisions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ProjectWorks', [
            'foreignKey' => 'division_id',
        ]);
		  $this->belongsTo('Circles', [
            'foreignKey' => 'circle_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
   /* public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->boolean('is_active')
            ->notEmptyString('is_active');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('order_flag')
            ->allowEmptyString('order_flag');

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
    }*/

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
   /* public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['name']), ['errorField' => 'name']);
        $rules->add($rules->isUnique(['id']), ['errorField' => 'id']);

        return $rules;
    }*/
}