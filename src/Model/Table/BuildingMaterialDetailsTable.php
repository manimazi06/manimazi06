<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BuildingMaterialDetails Model
 *
 * @property \App\Model\Table\BuildingMaterialsTable&\Cake\ORM\Association\BelongsTo $BuildingMaterials
 * @property \App\Model\Table\BuildingSubmaterialsTable&\Cake\ORM\Association\BelongsTo $BuildingSubmaterials
 * @property \App\Model\Table\UnitsTable&\Cake\ORM\Association\BelongsTo $Units
 * @property \App\Model\Table\FinancialyearwiseMaterialCostSubdetailsTable&\Cake\ORM\Association\HasMany $FinancialyearwiseMaterialCostSubdetails
 *
 * @method \App\Model\Entity\BuildingMaterialDetail newEmptyEntity()
 * @method \App\Model\Entity\BuildingMaterialDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BuildingMaterialDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BuildingMaterialDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\BuildingMaterialDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BuildingMaterialDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BuildingMaterialDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BuildingMaterialDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BuildingMaterialDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BuildingMaterialDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BuildingMaterialDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BuildingMaterialDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BuildingMaterialDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BuildingMaterialDetailsTable extends Table
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

        $this->setTable('building_material_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('BuildingMaterials', [
            'foreignKey' => 'building_material_id',
        ]);
        $this->belongsTo('BuildingSubmaterials', [
            'foreignKey' => 'building_submaterial_id',
        ]);
        $this->belongsTo('Units', [
            'foreignKey' => 'unit_id',
        ]);
        $this->hasMany('FinancialyearwiseMaterialCostSubdetails', [
            'foreignKey' => 'building_material_detail_id',
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
            ->integer('building_material_id')
            ->allowEmptyString('building_material_id');

        $validator
            ->integer('building_submaterial_id')
            ->allowEmptyString('building_submaterial_id');

        $validator
            ->numeric('quantity')
            ->allowEmptyString('quantity');

        $validator
            ->integer('unit_id')
            ->allowEmptyString('unit_id');

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
        $rules->add($rules->existsIn('building_material_id', 'BuildingMaterials'), ['errorField' => 'building_material_id']);
        $rules->add($rules->existsIn('building_submaterial_id', 'BuildingSubmaterials'), ['errorField' => 'building_submaterial_id']);
        $rules->add($rules->existsIn('unit_id', 'Units'), ['errorField' => 'unit_id']);

        return $rules;
    }
}
