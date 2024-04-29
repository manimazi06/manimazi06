<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TentativeFinancialProgrammeDetails Model
 *
 * @property \App\Model\Table\FinancialYearsTable&\Cake\ORM\Association\BelongsTo $FinancialYears
 * @property \App\Model\Table\DivisionsTable&\Cake\ORM\Association\BelongsTo $Divisions
 *
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail newEmptyEntity()
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TentativeFinancialProgrammeDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TentativeFinancialProgrammeDetailsTable extends Table
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

        $this->setTable('tentative_financial_programme_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('FinancialYears', [
            'foreignKey' => 'financial_year_id',
        ]);
        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id',
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
            ->integer('financial_year_id')
            ->allowEmptyString('financial_year_id');

        $validator
            ->integer('division_id')
            ->allowEmptyString('division_id');

        $validator
            ->numeric('apr')
            ->allowEmptyString('apr');

        $validator
            ->numeric('may')
            ->allowEmptyString('may');

        $validator
            ->numeric('june')
            ->allowEmptyString('june');

        $validator
            ->numeric('july')
            ->allowEmptyString('july');

        $validator
            ->numeric('aug')
            ->allowEmptyString('aug');

        $validator
            ->numeric('sep')
            ->allowEmptyString('sep');

        $validator
            ->numeric('oct')
            ->allowEmptyString('oct');

        $validator
            ->numeric('nov')
            ->allowEmptyString('nov');

        $validator
            ->numeric('dece')
            ->allowEmptyString('dece');

        $validator
            ->numeric('jan')
            ->allowEmptyString('jan');

        $validator
            ->numeric('feb')
            ->allowEmptyString('feb');

        $validator
            ->numeric('mar')
            ->allowEmptyString('mar');

        $validator
            ->numeric('total_amount')
            ->allowEmptyString('total_amount');

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
        $rules->add($rules->existsIn('financial_year_id', 'FinancialYears'), ['errorField' => 'financial_year_id']);
        $rules->add($rules->existsIn('division_id', 'Divisions'), ['errorField' => 'division_id']);

        return $rules;
    }
}
