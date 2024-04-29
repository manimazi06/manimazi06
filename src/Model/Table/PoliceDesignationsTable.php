<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PoliceDesignations Model
 *
 * @property \App\Model\Table\ProjectwiseQuartersDetailsTable&\Cake\ORM\Association\HasMany $ProjectwiseQuartersDetails
 *
 * @method \App\Model\Entity\PoliceDesignation newEmptyEntity()
 * @method \App\Model\Entity\PoliceDesignation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PoliceDesignation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PoliceDesignation get($primaryKey, $options = [])
 * @method \App\Model\Entity\PoliceDesignation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PoliceDesignation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PoliceDesignation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PoliceDesignation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PoliceDesignation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PoliceDesignation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PoliceDesignation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PoliceDesignation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PoliceDesignation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PoliceDesignationsTable extends Table
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

        $this->setTable('police_designations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ProjectwiseQuartersDetails', [
            'foreignKey' => 'police_designation_id',
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
            ->allowEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('is_active')
            ->allowEmptyString('is_active');

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
        $rules->add($rules->isUnique(['name'], ['allowMultipleNulls' => true]), ['errorField' => 'name']);

        return $rules;
    }
}
