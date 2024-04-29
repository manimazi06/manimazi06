<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BuildingItems Model
 *
 * @method \App\Model\Entity\BuildingItem newEmptyEntity()
 * @method \App\Model\Entity\BuildingItem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BuildingItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BuildingItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\BuildingItem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BuildingItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BuildingItem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BuildingItem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BuildingItem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BuildingItem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BuildingItem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BuildingItem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BuildingItem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BuildingItemsTable extends Table
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

        $this->setTable('building_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('item_code')
            ->maxLength('item_code', 255)
            ->requirePresence('item_code', 'create')
            ->notEmptyString('item_code');

        $validator
            ->scalar('item_description')
            ->requirePresence('item_description', 'create')
            ->notEmptyString('item_description');

        $validator
            ->allowEmptyString('is_active');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->date('created_date')
            ->allowEmptyDate('created_date');

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
        $rules->add($rules->isUnique(['id']), ['errorField' => 'id']);
        $rules->add($rules->isUnique(['item_code', 'item_description']), ['errorField' => 'item_code']);

        return $rules;
    }
}
