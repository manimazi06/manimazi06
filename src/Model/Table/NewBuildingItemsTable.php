<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NewBuildingItems Model
 *
 * @property \App\Model\Table\BuildingItemTypesTable&\Cake\ORM\Association\BelongsTo $BuildingItemTypes
 *
 * @method \App\Model\Entity\NewBuildingItem newEmptyEntity()
 * @method \App\Model\Entity\NewBuildingItem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\NewBuildingItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NewBuildingItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\NewBuildingItem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\NewBuildingItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NewBuildingItem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\NewBuildingItem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NewBuildingItem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NewBuildingItem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\NewBuildingItem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\NewBuildingItem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\NewBuildingItem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class NewBuildingItemsTable extends Table
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

        $this->setTable('new_building_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('BuildingItemTypes', [
            'foreignKey' => 'building_item_type_id',
        ]);
		
		$this->belongsTo('Units', [
            'foreignKey' => 'unit_id',
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
            ->integer('building_item_type_id')
            ->allowEmptyString('building_item_type_id');

        $validator
            ->scalar('item_code')
            ->maxLength('item_code', 255)
            ->requirePresence('item_code', 'create')
            ->notEmptyString('item_code')
            ->add('item_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
            ->dateTime('created_date')
            ->allowEmptyDateTime('created_date');

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
        $rules->add($rules->isUnique(['item_code']), ['errorField' => 'item_code']);
        $rules->add($rules->existsIn('building_item_type_id', 'BuildingItemTypes'), ['errorField' => 'building_item_type_id']);

        return $rules;
    }
}
