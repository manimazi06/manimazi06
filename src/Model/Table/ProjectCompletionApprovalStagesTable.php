<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectCompletionApprovalStages Model
 *
 * @property \App\Model\Table\ProjectWorksTable&\Cake\ORM\Association\BelongsTo $ProjectWorks
 * @property \App\Model\Table\ProjectWorkSubdetailsTable&\Cake\ORM\Association\BelongsTo $ProjectWorkSubdetails
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CurrentRolesTable&\Cake\ORM\Association\BelongsTo $CurrentRoles
 * @property \App\Model\Table\ApprovalStatusesTable&\Cake\ORM\Association\BelongsTo $ApprovalStatuses
 *
 * @method \App\Model\Entity\ProjectCompletionApprovalStage newEmptyEntity()
 * @method \App\Model\Entity\ProjectCompletionApprovalStage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectCompletionApprovalStage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectCompletionApprovalStage get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectCompletionApprovalStage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectCompletionApprovalStage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectCompletionApprovalStage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectCompletionApprovalStage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectCompletionApprovalStage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectCompletionApprovalStage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectCompletionApprovalStage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectCompletionApprovalStage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectCompletionApprovalStage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectCompletionApprovalStagesTable extends Table
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

        $this->setTable('project_completion_approval_stages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectWorks', [
            'foreignKey' => 'project_work_id',
        ]);
        $this->belongsTo('ProjectWorkSubdetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        // $this->belongsTo('CurrentRoles', [
            // 'foreignKey' => 'current_role_id',
        // ]);
        $this->belongsTo('ApprovalStatuses', [
            'foreignKey' => 'approval_status_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
   /* public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('project_work_id')
            ->allowEmptyString('project_work_id');

        $validator
            ->integer('project_work_subdetail_id')
            ->allowEmptyString('project_work_subdetail_id');

        $validator
            ->integer('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->integer('current_role_id')
            ->allowEmptyString('current_role_id');

        $validator
            ->scalar('current_status')
            ->maxLength('current_status', 100)
            ->allowEmptyString('current_status');

        $validator
            ->integer('approval_status_id')
            ->allowEmptyString('approval_status_id');

        $validator
            ->date('submit_date')
            ->allowEmptyDate('submit_date');

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
    }*/

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
   
}
