<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectwiseTimeExtensionFileUploads Model
 *
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload newEmptyEntity()
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectwiseTimeExtensionFileUpload[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectwiseTimeExtensionFileUploadsTable extends Table
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

        $this->setTable('projectwise_time_extension_file_uploads');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectwiseTimeExtensionDetails', [
            'foreignKey' => 'projectwise_time_extension_detail_id',
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
            ->scalar('file_upload')
            ->requirePresence('file_upload', 'create')
            ->notEmptyFile('file_upload');

        $validator
            ->integer('is_active')
            ->notEmptyString('is_active');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmptyString('created_by');

        $validator
            ->date('created_date')
            ->requirePresence('created_date', 'create')
            ->notEmptyDate('created_date');

        $validator
            ->integer('modified_by')
            ->requirePresence('modified_by', 'create')
            ->notEmptyString('modified_by');

        $validator
            ->date('modified_date')
            ->requirePresence('modified_date', 'create')
            ->notEmptyDate('modified_date');

        $validator
            ->integer('projectwise_time_extension_detail_id')
            ->requirePresence('projectwise_time_extension_detail_id', 'create')
            ->notEmptyString('projectwise_time_extension_detail_id');

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
        $rules->add($rules->existsIn('projectwise_time_extension_detail_id', 'ProjectwiseTimeExtensionDetails'), ['errorField' => 'projectwise_time_extension_detail_id']);

        return $rules;
    }
}
