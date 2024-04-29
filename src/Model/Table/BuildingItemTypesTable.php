<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BuildingItemTypes Model
 *
 * @property \App\Model\Table\NewBuildingItemsTable&\Cake\ORM\Association\HasMany $NewBuildingItems
 *
 * @method \App\Model\Entity\BuildingItemType newEmptyEntity()
 * @method \App\Model\Entity\BuildingItemType newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BuildingItemType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BuildingItemType get($primaryKey, $options = [])
 * @method \App\Model\Entity\BuildingItemType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BuildingItemType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BuildingItemType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BuildingItemType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BuildingItemType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BuildingItemType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BuildingItemType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BuildingItemType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BuildingItemType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BuildingItemTypesTable extends Table
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

        $this->setTable('building_item_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('NewBuildingItems', [
            'foreignKey' => 'building_item_type_id',
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
            ->allowEmptyString('name');

        $validator
            ->integer('order_flag')
            ->allowEmptyString('order_flag');

        $validator
            ->integer('is_active')
            ->notEmptyString('is_active');

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
}
