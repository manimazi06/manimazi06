<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectFundRequestDetails Model
 *
 * @property \App\Model\Table\ProjectWorksTable&\Cake\ORM\Association\BelongsTo $ProjectWorks
 * @property \App\Model\Table\ProjectWorkSubdetailsTable&\Cake\ORM\Association\BelongsTo $ProjectWorkSubdetails
 * @property \App\Model\Table\FundStatusesTable&\Cake\ORM\Association\BelongsTo $FundStatuses
 *
 * @method \App\Model\Entity\ProjectFundRequestDetail newEmptyEntity()
 * @method \App\Model\Entity\ProjectFundRequestDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectFundRequestDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectFundRequestDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectFundRequestDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectFundRequestDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectFundRequestDetailsTable extends Table
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

        $this->setTable('project_fund_request_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectFundRequests', [
            'foreignKey' => 'project_fund_request_id',
        ]);
        $this->belongsTo('ProjectWorks', [
            'foreignKey' => 'project_work_id',
        ]);
        $this->belongsTo('ProjectWorkSubdetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->belongsTo('FundStatuses', [
            'foreignKey' => 'fund_status_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('project_fund_request_id')
            ->allowEmptyString('project_fund_request_id');

        $validator
            ->integer('project_work_id')
            ->allowEmptyString('project_work_id');

        $validator
            ->integer('project_work_subdetail_id')
            ->allowEmptyString('project_work_subdetail_id');

        $validator
            ->integer('fund_status_id')
            ->allowEmptyString('fund_status_id');

        $validator
            ->numeric('request_amount')
            ->allowEmptyString('request_amount');

        $validator
            ->numeric('balance_amount')
            ->allowEmptyString('balance_amount');

        $validator
            ->numeric('transaction_amount')
            ->allowEmptyString('transaction_amount');

        $validator
            ->numeric('final_balance')
            ->allowEmptyString('final_balance');

        $validator
            ->integer('received_flag')
            ->allowEmptyString('received_flag');

        $validator
            ->integer('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->scalar('remarks')
            ->allowEmptyString('remarks');

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
        $rules->add($rules->existsIn('project_fund_request_id', 'ProjectFundRequests'), ['errorField' => 'project_fund_request_id']);
        $rules->add($rules->existsIn('project_work_id', 'ProjectWorks'), ['errorField' => 'project_work_id']);
        $rules->add($rules->existsIn('project_work_subdetail_id', 'ProjectWorkSubdetails'), ['errorField' => 'project_work_subdetail_id']);
        $rules->add($rules->existsIn('fund_status_id', 'FundStatuses'), ['errorField' => 'fund_status_id']);
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
