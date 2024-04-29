<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectWorks Model
 *
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\FinancialYearsTable&\Cake\ORM\Association\BelongsTo $FinancialYears
 * @property \App\Model\Table\BuildingTypesTable&\Cake\ORM\Association\BelongsTo $BuildingTypes
 *
 * @method \App\Model\Entity\ProjectWork newEmptyEntity()
 * @method \App\Model\Entity\ProjectWork newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectWork[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectWork get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectWork findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectWork patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectWork[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectWork|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectWork saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectWork[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectWork[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectWork[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectWork[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectWorksTable extends Table
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

        $this->setTable('project_works');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('FinancialYears', [
            'foreignKey' => 'financial_year_id',
            'joinType' => 'LEFT',
        ]);
		
		 $this->belongsTo('FinancialYears', [
            'foreignKey' => 'financial_year_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('DepartmentwiseWorkTypes', [
            'foreignKey' => 'departmentwise_work_type_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('BuildingTypes', [
            'foreignKey' => 'building_type_id',
            'joinType' => 'LEFT',
        ]);
		
		 $this->belongsTo('ProjectStatuses', [
            'foreignKey' => 'project_status_id',
            'joinType' => 'LEFT',
        ]);
		
        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id',
        ]);
		
        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id',
        ]);
		
		 $this->belongsTo('SchemeTypes', [
            'foreignKey' => 'scheme_type_id',
        ]);
		
        $this->hasMany('ProjectAdministrativeSanctions', [
            'foreignKey' => 'project_work_id',
        ]);
        $this->hasMany('ProjectFinancialSanctions', [
            'foreignKey' => 'project_work_id',
        ]);
        $this->hasMany('ProjectMonitoringDetails', [
            'foreignKey' => 'project_work_id',
        ]);
        $this->hasMany('ProjectTenderDetails', [
            'foreignKey' => 'project_work_id',
        ]);
        $this->hasMany('TechnicalSanctions', [
            'foreignKey' => 'project_work_id',
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
            ->integer('department_id')
            ->requirePresence('department_id', 'create')
            ->notEmptyString('department_id');

        $validator
            ->integer('financial_year_id')
            ->requirePresence('financial_year_id', 'create')
            ->notEmptyString('financial_year_id');

        $validator
            ->integer('building_type_id')
            ->requirePresence('building_type_id', 'create')
            ->notEmptyString('building_type_id');

        $validator
            ->integer('project_status_id')
            ->notEmptyString('project_status_id');

        $validator
            ->scalar('project_code')
            ->maxLength('project_code', 10)
            ->allowEmptyString('project_code')
            ->add('project_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('project_name')
            ->maxLength('project_name', 150)
            ->requirePresence('project_name', 'create')
            ->notEmptyString('project_name');

        $validator
            ->scalar('project_description')
            ->allowEmptyString('project_description');

        $validator
            ->numeric('project_amount')
            ->requirePresence('project_amount', 'create')
            ->notEmptyString('project_amount');

        $validator
            ->scalar('file_upload')
            ->requirePresence('file_upload', 'create')
            ->notEmptyFile('file_upload');

        $validator
            ->integer('coastal_area')
            ->notEmptyString('coastal_area');

        $validator
            ->integer('district_id')
            ->allowEmptyString('district_id');

        $validator
            ->integer('division_id')
            ->allowEmptyString('division_id');

        $validator
            ->numeric('latitude')
            ->allowEmptyString('latitude');

        $validator
            ->numeric('longitude')
            ->allowEmptyString('longitude');

        $validator
            ->boolean('is_active')
            ->allowEmptyString('is_active');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmptyString('created_by');

        $validator
            ->dateTime('created_date')
            ->requirePresence('created_date', 'create')
            ->notEmptyDateTime('created_date');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        $validator
            ->dateTime('modified_date')
            ->allowEmptyDateTime('modified_date');

        $validator
            ->integer('department_type')
            ->allowEmptyString('department_type');

        return $validator;
    }*/

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    /*public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['id']), ['errorField' => 'id']);
        $rules->add($rules->isUnique(['project_code'], ['allowMultipleNulls' => true]), ['errorField' => 'project_code']);
        $rules->add($rules->existsIn('department_id', 'Departments'), ['errorField' => 'department_id']);
        $rules->add($rules->existsIn('financial_year_id', 'FinancialYears'), ['errorField' => 'financial_year_id']);
        $rules->add($rules->existsIn('building_type_id', 'BuildingTypes'), ['errorField' => 'building_type_id']);
        $rules->add($rules->existsIn('project_status_id', 'ProjectStatuses'), ['errorField' => 'project_status_id']);
        $rules->add($rules->existsIn('district_id', 'Districts'), ['errorField' => 'district_id']);
        $rules->add($rules->existsIn('division_id', 'Divisions'), ['errorField' => 'division_id']);

        return $rules;
    }*/
}
