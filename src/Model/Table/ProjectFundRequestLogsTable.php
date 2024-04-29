<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectFundRequestLogs Model
 *
 * @property \App\Model\Table\FundStatusesTable&\Cake\ORM\Association\BelongsTo $FundStatuses
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\DivisionsTable&\Cake\ORM\Association\BelongsTo $Divisions
 *
 * @method \App\Model\Entity\ProjectFundRequestLog newEmptyEntity()
 * @method \App\Model\Entity\ProjectFundRequestLog newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectFundRequestLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectFundRequestLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestLog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectFundRequestLog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectFundRequestLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestLog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestLog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestLog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestLog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectFundRequestLogsTable extends Table
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

        $this->setTable('project_fund_request_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('FundStatuses', [
            'foreignKey' => 'fund_status_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id',
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
            ->integer('fund_status_id')
            ->allowEmptyString('fund_status_id');

        $validator
            ->integer('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->integer('division_id')
            ->allowEmptyString('division_id');

        $validator
            ->date('request_date')
            ->allowEmptyDate('request_date');

        $validator
            ->numeric('total_request_amount')
            ->allowEmptyString('total_request_amount');

        $validator
            ->integer('is_approved')
            ->allowEmptyString('is_approved');

        $validator
            ->date('approval_date')
            ->allowEmptyDate('approval_date');

        $validator
            ->scalar('transaction_ref_no')
            ->maxLength('transaction_ref_no', 50)
            ->allowEmptyString('transaction_ref_no');

        $validator
            ->date('transaction_date')
            ->allowEmptyDate('transaction_date');

        $validator
            ->date('amount_received_date')
            ->allowEmptyDate('amount_received_date');

        $validator
            ->numeric('total_transaction_amount')
            ->allowEmptyString('total_transaction_amount');

        $validator
            ->integer('received_flag')
            ->allowEmptyString('received_flag');

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
        $rules->add($rules->existsIn('fund_status_id', 'FundStatuses'), ['errorField' => 'fund_status_id']);
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('division_id', 'Divisions'), ['errorField' => 'division_id']);

        return $rules;
    }
}
