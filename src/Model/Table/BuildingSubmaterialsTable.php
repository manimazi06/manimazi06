<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BuildingSubmaterials Model
 *
 * @method \App\Model\Entity\BuildingSubmaterial newEmptyEntity()
 * @method \App\Model\Entity\BuildingSubmaterial newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BuildingSubmaterial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BuildingSubmaterial get($primaryKey, $options = [])
 * @method \App\Model\Entity\BuildingSubmaterial findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BuildingSubmaterial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BuildingSubmaterial[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BuildingSubmaterial|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BuildingSubmaterial saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BuildingSubmaterial[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BuildingSubmaterial[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BuildingSubmaterial[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BuildingSubmaterial[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BuildingSubmaterialsTable extends Table
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

        $this->setTable('building_submaterials');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmptyString('is_active');

        $validator
            ->date('created_date')
            ->allowEmptyDate('created_date');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->date('modified_date')
            ->allowEmptyDate('modified_date');

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
        $rules->add($rules->isUnique(['name']), ['errorField' => 'name']);

        return $rules;
    }
}
