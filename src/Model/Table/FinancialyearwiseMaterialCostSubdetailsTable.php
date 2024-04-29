<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FinancialyearwiseMaterialCostSubdetails Model
 *
 * @property \App\Model\Table\FinancialyearwiseMaterialCostDetailsTable&\Cake\ORM\Association\BelongsTo $FinancialyearwiseMaterialCostDetails
 * @property \App\Model\Table\BuildingMaterialDetailsTable&\Cake\ORM\Association\BelongsTo $BuildingMaterialDetails
 *
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail newEmptyEntity()
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostSubdetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FinancialyearwiseMaterialCostSubdetailsTable extends Table
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

        $this->setTable('financialyearwise_material_cost_subdetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('FinancialyearwiseMaterialCostDetails', [
            'foreignKey' => 'financialyearwise_material_cost_detail_id',
        ]);
        $this->belongsTo('BuildingMaterialDetails', [
            'foreignKey' => 'building_material_detail_id',
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
            ->integer('financialyearwise_material_cost_detail_id')
            ->allowEmptyString('financialyearwise_material_cost_detail_id');

        $validator
            ->integer('building_material_detail_id')
            ->requirePresence('building_material_detail_id', 'create')
            ->notEmptyString('building_material_detail_id');

        $validator
            ->numeric('rate')
            ->allowEmptyString('rate');

        $validator
            ->numeric('amount')
            ->allowEmptyString('amount');

        $validator
            ->integer('is_active')
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
        $rules->add($rules->existsIn('financialyearwise_material_cost_detail_id', 'FinancialyearwiseMaterialCostDetails'), ['errorField' => 'financialyearwise_material_cost_detail_id']);
        $rules->add($rules->existsIn('building_material_detail_id', 'BuildingMaterialDetails'), ['errorField' => 'building_material_detail_id']);

        return $rules;
    }
}
