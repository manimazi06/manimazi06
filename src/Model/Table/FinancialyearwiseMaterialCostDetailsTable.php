<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FinancialyearwiseMaterialCostDetails Model
 *
 * @property \App\Model\Table\FinancialYearsTable&\Cake\ORM\Association\BelongsTo $FinancialYears
 * @property \App\Model\Table\FinancialyearwiseMaterialCostSubdetailsTable&\Cake\ORM\Association\HasMany $FinancialyearwiseMaterialCostSubdetails
 *
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail newEmptyEntity()
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FinancialyearwiseMaterialCostDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FinancialyearwiseMaterialCostDetailsTable extends Table
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

        $this->setTable('financialyearwise_material_cost_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('FinancialYears', [
            'foreignKey' => 'financial_year_id',
        ]);
		$this->belongsTo('BuildingMaterials', [
            'foreignKey' => 'building_material_id',
        ]);
        $this->hasMany('FinancialyearwiseMaterialCostSubdetails', [
            'foreignKey' => 'financialyearwise_material_cost_detail_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    /*public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('financial_year_id')
            ->allowEmptyString('financial_year_id');

        $validator
            ->date('submit_date')
            ->requirePresence('submit_date', 'create')
            ->notEmptyDate('submit_date');

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
    }*/

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    // public function buildRules(RulesChecker $rules): RulesChecker
    // {
        // $rules->add($rules->isUnique(['id']), ['errorField' => 'id']);
        // $rules->add($rules->existsIn('financial_year_id', 'FinancialYears'), ['errorField' => 'financial_year_id']);

        // return $rules;
    // }
}