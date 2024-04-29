<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OpeningBalanceDetails Model
 *
 * @property \App\Model\Table\OfficesTable&\Cake\ORM\Association\BelongsTo $Offices
 * @property \App\Model\Table\DivisionsTable&\Cake\ORM\Association\BelongsTo $Divisions
 *
 * @method \App\Model\Entity\OpeningBalanceDetail newEmptyEntity()
 * @method \App\Model\Entity\OpeningBalanceDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\OpeningBalanceDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OpeningBalanceDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\OpeningBalanceDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\OpeningBalanceDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OpeningBalanceDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OpeningBalanceDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OpeningBalanceDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OpeningBalanceDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OpeningBalanceDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\OpeningBalanceDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OpeningBalanceDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OpeningBalanceDetailsTable extends Table
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

        $this->setTable('opening_balance_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id',
        ]);
    }

   
}
