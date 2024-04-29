<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectwiseTimeExtensionDetails Model
 *
 * @property \App\Model\Table\ProjectWorksTable&\Cake\ORM\Association\BelongsTo $ProjectWorks
 * @property \App\Model\Table\ProjectWorkSubdetailsTable&\Cake\ORM\Association\BelongsTo $ProjectWorkSubdetails
 *
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail newEmptyEntity()
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectwiseTimeExtensionDetailsTable extends Table
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

        $this->setTable('projectwise_time_extension_details');
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
            ->date('extension_date_of_ee')
            ->allowEmptyDate('extension_date_of_ee');

        $validator
            ->scalar('delay_part_of_contractor')
            ->allowEmptyString('delay_part_of_contractor');

        $validator
            ->scalar('delay_due_to_department')
            ->allowEmptyString('delay_due_to_department');

        $validator
            ->scalar('delay_for_revision_plan')
            ->allowEmptyString('delay_for_revision_plan');

        $validator
            ->scalar('delay_due_to_rain')
            ->allowEmptyString('delay_due_to_rain');

        $validator
            ->scalar('delay_due_to_shortage_sand')
            ->allowEmptyString('delay_due_to_shortage_sand');

        $validator
            ->integer('any_notice_issued_by_contractor')
            ->allowEmptyString('any_notice_issued_by_contractor');

        $validator
            ->scalar('notice_file_upload')
            ->allowEmptyFile('notice_file_upload');

        $validator
            ->integer('any_fine_imposed_for_delay')
            ->allowEmptyString('any_fine_imposed_for_delay');

        $validator
            ->scalar('contractor_quality_of_work')
            ->allowEmptyString('contractor_quality_of_work');

        $validator
            ->scalar('remarks_of_ee')
            ->allowEmptyString('remarks_of_ee');

        $validator
            ->integer('is_active')
            ->notEmptyString('is_active');

        $validator
            ->dateTime('created_date')
            ->allowEmptyDateTime('created_date');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->dateTime('modified_date')
            ->allowEmptyDateTime('modified_date');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

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

        return $rules;
    }
}
