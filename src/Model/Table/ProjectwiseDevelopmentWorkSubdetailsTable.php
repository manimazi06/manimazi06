<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectwiseDevelopmentWorkSubdetails Model
 *
 * @property \App\Model\Table\ProjectwiseDevelopmentWorkDetailsTable&\Cake\ORM\Association\BelongsTo $ProjectwiseDevelopmentWorkDetails
 * @property \App\Model\Table\BuildingItemsTable&\Cake\ORM\Association\BelongsTo $BuildingItems
 *
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail newEmptyEntity()
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectwiseDevelopmentWorkSubdetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectwiseDevelopmentWorkSubdetailsTable extends Table
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

        $this->setTable('projectwise_development_work_subdetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectwiseDevelopmentWorkDetails', [
            'foreignKey' => 'projectwise_development_work_detail_id',
        ]);
        $this->belongsTo('BuildingItems', [
            'foreignKey' => 'building_item_id',
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
            ->integer('projectwise_development_work_detail_id')
            ->allowEmptyString('projectwise_development_work_detail_id');

        $validator
            ->integer('building_item_id')
            ->allowEmptyString('building_item_id');

        $validator
            ->scalar('item_code')
            ->maxLength('item_code', 150)
            ->allowEmptyString('item_code');

        $validator
            ->scalar('item_description')
            ->allowEmptyString('item_description');

        $validator
            ->scalar('number_1')
            ->maxLength('number_1', 150)
            ->allowEmptyString('number_1');

        $validator
            ->scalar('number_2')
            ->maxLength('number_2', 150)
            ->allowEmptyString('number_2');

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
        $rules->add($rules->existsIn('projectwise_development_work_detail_id', 'ProjectwiseDevelopmentWorkDetails'), ['errorField' => 'projectwise_development_work_detail_id']);
        $rules->add($rules->existsIn('building_item_id', 'BuildingItems'), ['errorField' => 'building_item_id']);

        return $rules;
    }
}
