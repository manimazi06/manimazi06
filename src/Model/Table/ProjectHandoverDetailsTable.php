<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectHandoverDetails Model
 *
 * @property \App\Model\Table\ProjectWorksTable&\Cake\ORM\Association\BelongsTo $ProjectWorks
 * @property \App\Model\Table\ProjectWorkSubdetailsTable&\Cake\ORM\Association\BelongsTo $ProjectWorkSubdetails
 *
 * @method \App\Model\Entity\ProjectHandoverDetail newEmptyEntity()
 * @method \App\Model\Entity\ProjectHandoverDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectHandoverDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectHandoverDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectHandoverDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectHandoverDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectHandoverDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectHandoverDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectHandoverDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectHandoverDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectHandoverDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectHandoverDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectHandoverDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectHandoverDetailsTable extends Table
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

        $this->setTable('project_handover_details');
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
            ->date('handover_date')
            ->requirePresence('handover_date', 'create')
            ->notEmptyDate('handover_date');

        $validator
            ->scalar('file_upload')
            ->requirePresence('file_upload', 'create')
            ->notEmptyFile('file_upload');

        $validator
            ->scalar('remarks')
            ->maxLength('remarks', 255)
            ->requirePresence('remarks', 'create')
            ->notEmptyString('remarks');

        $validator
            ->boolean('is_active')
            ->allowEmptyString('is_active');

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
        $rules->add($rules->existsIn('project_work_id', 'ProjectWorks'), ['errorField' => 'project_work_id']);
        $rules->add($rules->existsIn('project_work_subdetail_id', 'ProjectWorkSubdetails'), ['errorField' => 'project_work_subdetail_id']);

        return $rules;
    }
}
