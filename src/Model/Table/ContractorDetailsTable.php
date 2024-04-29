<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContractorDetails Model
 *
 * @property \App\Model\Table\ProjectWorksTable&\Cake\ORM\Association\BelongsTo $ProjectWorks
 * @property \App\Model\Table\ProjectWorkSubdetailsTable&\Cake\ORM\Association\BelongsTo $ProjectWorkSubdetails
 * @property \App\Model\Table\ProjectTenderDetailsTable&\Cake\ORM\Association\HasMany $ProjectTenderDetails
 *
 * @method \App\Model\Entity\ContractorDetail newEmptyEntity()
 * @method \App\Model\Entity\ContractorDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ContractorDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContractorDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ContractorDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ContractorDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ContractorDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContractorDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContractorDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContractorDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ContractorDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ContractorDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ContractorDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ContractorDetailsTable extends Table
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

        $this->setTable('contractor_details');
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
        $this->belongsTo('Contractors', [
            'foreignKey' => 'contractor_id',
        ]);
        $this->hasMany('ProjectTenderDetails', [
            'foreignKey' => 'contractor_detail_id',
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
            ->integer('contractor_id')
            ->allowEmptyString('contractor_id');

        $validator
            ->scalar('contractor_name')
            ->maxLength('contractor_name', 255)
            ->requirePresence('contractor_name', 'create')
            ->notEmptyString('contractor_name');

        $validator
            ->scalar('contractor_mobile_no')
            ->maxLength('contractor_mobile_no', 255)
            ->requirePresence('contractor_mobile_no', 'create')
            ->notEmptyString('contractor_mobile_no');

        $validator
            ->scalar('agreement_no')
            ->maxLength('agreement_no', 255)
            ->requirePresence('agreement_no', 'create')
            ->notEmptyString('agreement_no');

        $validator
            ->date('agreement_fromdate')
            ->allowEmptyDate('agreement_fromdate');

        $validator
            ->date('agreement_todate')
            ->requirePresence('agreement_todate', 'create')
            ->notEmptyDate('agreement_todate');

        $validator
            ->date('agreement_date')
            ->allowEmptyDate('agreement_date');

        $validator
            ->scalar('agreement_amount')
            ->maxLength('agreement_amount', 255)
            ->allowEmptyString('agreement_amount');

        $validator
            ->scalar('work_order_refno')
            ->maxLength('work_order_refno', 100)
            ->allowEmptyString('work_order_refno');

        $validator
            ->scalar('work_order_copy')
            ->allowEmptyString('work_order_copy');

        $validator
            ->scalar('perc_deduction')
            ->maxLength('perc_deduction', 255)
            ->requirePresence('perc_deduction', 'create')
            ->notEmptyString('perc_deduction');

        $validator
            ->scalar('agreement_copy')
            ->allowEmptyString('agreement_copy');

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
        $rules->add($rules->existsIn('project_work_id', 'ProjectWorks'), ['errorField' => 'project_work_id']);
        $rules->add($rules->existsIn('project_work_subdetail_id', 'ProjectWorkSubdetails'), ['errorField' => 'project_work_subdetail_id']);
        $rules->add($rules->existsIn('contractor_id', 'Contractors'), ['errorField' => 'contractor_id']);

        return $rules;
    }
}
