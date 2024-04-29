<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RepairworkDetails Model
 *
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\FinancialYearsTable&\Cake\ORM\Association\BelongsTo $FinancialYears
 * @property \App\Model\Table\DistrictsTable&\Cake\ORM\Association\BelongsTo $Districts
 * @property \App\Model\Table\DivisionsTable&\Cake\ORM\Association\BelongsTo $Divisions
 * @property \App\Model\Table\CirclesTable&\Cake\ORM\Association\BelongsTo $Circles
 * @property \App\Model\Table\DepartmentwiseWorkTypesTable&\Cake\ORM\Association\BelongsTo $DepartmentwiseWorkTypes
 *
 * @method \App\Model\Entity\RepairworkDetail newEmptyEntity()
 * @method \App\Model\Entity\RepairworkDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RepairworkDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RepairworkDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\RepairworkDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RepairworkDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RepairworkDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RepairworkDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RepairworkDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RepairworkDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RepairworkDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RepairworkDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RepairworkDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RepairworkDetailsTable extends Table
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

        $this->setTable('repairwork_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
        ]);
        $this->belongsTo('FinancialYears', [
            'foreignKey' => 'financial_year_id',
        ]);
        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id',
        ]);
        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id',
        ]);
        $this->belongsTo('Circles', [
            'foreignKey' => 'circle_id',
        ]);
        $this->belongsTo('DepartmentwiseWorkTypes', [
            'foreignKey' => 'departmentwise_work_type_id',
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
            ->scalar('work_name')
            ->maxLength('work_name', 255)
            ->allowEmptyString('work_name');

        $validator
            ->integer('department_id')
            ->allowEmptyString('department_id');

        $validator
            ->integer('financial_year_id')
            ->allowEmptyString('financial_year_id');

        $validator
            ->integer('district_id')
            ->allowEmptyString('district_id');

        $validator
            ->integer('division_id')
            ->allowEmptyString('division_id');

        $validator
            ->integer('circle_id')
            ->allowEmptyString('circle_id');

        $validator
            ->scalar('place_of_work')
            ->allowEmptyString('place_of_work');

        $validator
            ->numeric('estimated_cost')
            ->allowEmptyString('estimated_cost');

        $validator
            ->scalar('work_file_upload')
            ->allowEmptyFile('work_file_upload');

        $validator
            ->integer('departmentwise_work_type_id')
            ->allowEmptyString('departmentwise_work_type_id');

        $validator
            ->integer('is_active')
            ->allowEmptyString('is_active');

        $validator
            ->dateTime('created_date')
            ->allowEmptyDateTime('created_date');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

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
        $rules->add($rules->existsIn('department_id', 'Departments'), ['errorField' => 'department_id']);
        $rules->add($rules->existsIn('financial_year_id', 'FinancialYears'), ['errorField' => 'financial_year_id']);
        $rules->add($rules->existsIn('district_id', 'Districts'), ['errorField' => 'district_id']);
        $rules->add($rules->existsIn('division_id', 'Divisions'), ['errorField' => 'division_id']);
        $rules->add($rules->existsIn('circle_id', 'Circles'), ['errorField' => 'circle_id']);
        $rules->add($rules->existsIn('departmentwise_work_type_id', 'DepartmentwiseWorkTypes'), ['errorField' => 'departmentwise_work_type_id']);

        return $rules;
    }
}
