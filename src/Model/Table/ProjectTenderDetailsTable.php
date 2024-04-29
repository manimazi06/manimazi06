<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectTenderDetails Model
 *
 * @property \App\Model\Table\ProjectWorksTable&\Cake\ORM\Association\BelongsTo $ProjectWorks
 * @property \App\Model\Table\ProjectWorkSubdetailsTable&\Cake\ORM\Association\BelongsTo $ProjectWorkSubdetails
 * @property \App\Model\Table\ContractorDetailsTable&\Cake\ORM\Association\BelongsTo $ContractorDetails
 *
 * @method \App\Model\Entity\ProjectTenderDetail newEmptyEntity()
 * @method \App\Model\Entity\ProjectTenderDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectTenderDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectTenderDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectTenderDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectTenderDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectTenderDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectTenderDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectTenderDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectTenderDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectTenderDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectTenderDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectTenderDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectTenderDetailsTable extends Table
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

        $this->setTable('project_tender_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectWorks', [
            'foreignKey' => 'project_work_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ProjectWorkSubdetails', [
            'foreignKey' => 'project_work_subdetail_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('TenderTypes', [
            'foreignKey' => 'tender_type_id',
        ]);
        $this->belongsTo('ContractorDetails', [
            'foreignKey' => 'contractor_detail_id',
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
            ->integer('project_work_id')
            ->requirePresence('project_work_id', 'create')
            ->notEmptyString('project_work_id');

        $validator
            ->integer('project_work_subdetail_id')
            ->requirePresence('project_work_subdetail_id', 'create')
            ->notEmptyString('project_work_subdetail_id');

        $validator
            ->integer('tender_type_id')
            ->allowEmptyString('tender_type_id');

        $validator
            ->scalar('etenderID')
            ->maxLength('etenderID', 100)
            ->allowEmptyString('etenderID');

        $validator
            ->integer('contractor_detail_id')
            ->requirePresence('contractor_detail_id', 'create')
            ->notEmptyString('contractor_detail_id');

        $validator
            ->scalar('tender_no')
            ->maxLength('tender_no', 10)
            ->requirePresence('tender_no', 'create')
            ->notEmptyString('tender_no');

        $validator
            ->date('tender_date')
            ->allowEmptyDate('tender_date');

        $validator
            ->scalar('tender_copy')
            ->requirePresence('tender_copy', 'create')
            ->notEmptyString('tender_copy');

        $validator
            ->numeric('tender_amount')
            ->allowEmptyString('tender_amount');

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmptyString('is_active');

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
        $rules->add($rules->existsIn('project_work_id', 'ProjectWorks'), ['errorField' => 'project_work_id']);
        $rules->add($rules->existsIn('project_work_subdetail_id', 'ProjectWorkSubdetails'), ['errorField' => 'project_work_subdetail_id']);
        $rules->add($rules->existsIn('tender_type_id', 'TenderTypes'), ['errorField' => 'tender_type_id']);
        $rules->add($rules->existsIn('contractor_detail_id', 'ContractorDetails'), ['errorField' => 'contractor_detail_id']);

        return $rules;
    }
}
