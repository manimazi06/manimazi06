<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectFundRequestStages Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\FundStatusesTable&\Cake\ORM\Association\BelongsTo $FundStatuses
 *
 * @method \App\Model\Entity\ProjectFundRequestStage newEmptyEntity()
 * @method \App\Model\Entity\ProjectFundRequestStage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectFundRequestStage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectFundRequestStage get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestStage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestStage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectFundRequestStage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectFundRequestStage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestStage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestStage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestStage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestStage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectFundRequestStage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectFundRequestStagesTable extends Table
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

        $this->setTable('project_fund_request_stages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectFundRequests', [
            'foreignKey' => 'project_fund_request_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('FundStatuses', [
            'foreignKey' => 'fund_status_id',
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
            ->integer('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->integer('fund_status_id')
            ->allowEmptyString('fund_status_id');

        $validator
            ->date('forward_date')
            ->allowEmptyDate('forward_date');

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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('fund_status_id', 'FundStatuses'), ['errorField' => 'fund_status_id']);

        return $rules;
    }
}
