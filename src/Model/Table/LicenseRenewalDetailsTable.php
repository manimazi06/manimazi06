<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LicenseRenewalDetails Model
 *
 * @property \App\Model\Table\ContractorsTable&\Cake\ORM\Association\BelongsTo $Contractors
 *
 * @method \App\Model\Entity\LicenseRenewalDetail newEmptyEntity()
 * @method \App\Model\Entity\LicenseRenewalDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LicenseRenewalDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LicenseRenewalDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\LicenseRenewalDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LicenseRenewalDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LicenseRenewalDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LicenseRenewalDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LicenseRenewalDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LicenseRenewalDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LicenseRenewalDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LicenseRenewalDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LicenseRenewalDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LicenseRenewalDetailsTable extends Table
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

        $this->setTable('license_renewal_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Contractors', [
            'foreignKey' => 'contractor_id',
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
            ->integer('contractor_id')
            ->requirePresence('contractor_id', 'create')
            ->notEmptyString('contractor_id');

        $validator
            ->date('license_renewal_date')
            ->allowEmptyDate('license_renewal_date');

        $validator
            ->date('license_validity_upto')
            ->requirePresence('license_validity_upto', 'create')
            ->notEmptyDate('license_validity_upto');

        $validator
            ->scalar('license_file_upload')
            ->allowEmptyFile('license_file_upload');

        $validator
            ->boolean('is_active')
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
        $rules->add($rules->existsIn('contractor_id', 'Contractors'), ['errorField' => 'contractor_id']);

        return $rules;
    }
}
