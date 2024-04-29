<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectWorkStatuses Model
 *
 * @property \App\Model\Table\ProjectWorkSubdetailsTable&\Cake\ORM\Association\HasMany $ProjectWorkSubdetails
 *
 * @method \App\Model\Entity\ProjectWorkStatus newEmptyEntity()
 * @method \App\Model\Entity\ProjectWorkStatus newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectWorkStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectWorkStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectWorkStatus findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProjectWorkStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectWorkStatus[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectWorkStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectWorkStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectWorkStatus[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectWorkStatus[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectWorkStatus[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProjectWorkStatus[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProjectWorkStatusesTable extends Table
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

        $this->setTable('project_work_statuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ProjectWorkSubdetails', [
            'foreignKey' => 'project_work_status_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('is_active')
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
}
