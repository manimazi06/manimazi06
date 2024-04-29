<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectMonitoringPhotosUploads Model
 *
 * @property \App\Model\Table\ProjectMonitoringDetailsTable&\Cake\ORM\Association\BelongsTo $ProjectMonitoringDetails
 *
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload newEmptyEntity()
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectMonitoringPhotosUpload[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectMonitoringPhotosUploadsTable extends Table
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

        $this->setTable('project_monitoring_photos_uploads');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectMonitoringDetails', [
            'foreignKey' => 'project_monitoring_detail_id',
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
            ->integer('project_monitoring_detail_id')
            ->requirePresence('project_monitoring_detail_id', 'create')
            ->notEmptyString('project_monitoring_detail_id');

        $validator
            ->scalar('file_upload')
            ->requirePresence('file_upload', 'create')
            ->notEmptyFile('file_upload');

        $validator
            ->integer('is_active')
            ->notEmptyString('is_active');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->dateTime('created_date')
            ->allowEmptyDateTime('created_date');

        $validator
            ->integer('modified_by')
            ->requirePresence('modified_by', 'create')
            ->notEmptyString('modified_by');

        $validator
            ->dateTime('modified_date')
            ->requirePresence('modified_date', 'create')
            ->notEmptyDateTime('modified_date');

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
        $rules->add($rules->existsIn('project_monitoring_detail_id', 'ProjectMonitoringDetails'), ['errorField' => 'project_monitoring_detail_id']);

        return $rules;
    }
}
