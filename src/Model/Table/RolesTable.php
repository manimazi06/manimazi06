<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class RolesTable extends Table
{
   
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('roles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Users', [
            'foreignKey' => 'role_id',
        ]);
        $this->hasMany('UsersBackup', [
            'foreignKey' => 'role_id',
        ]);
    }

    
    // public function validationDefault(Validator $validator): Validator
    // {
    //     $validator
    //         ->scalar('name')
    //         ->maxLength('name', 255)
    //         ->requirePresence('name', 'create')
    //         ->notEmptyString('name');

    //     $validator
    //         ->integer('is_active')
    //         ->notEmptyString('is_active');

    //     $validator
    //         ->integer('created_by')
    //         ->requirePresence('created_by', 'create')
    //         ->notEmptyString('created_by');

    //     $validator
    //         ->dateTime('created_date')
    //         ->requirePresence('created_date', 'create')
    //         ->notEmptyDateTime('created_date');

    //     $validator
    //         ->integer('modified_by')
    //         ->requirePresence('modified_by', 'create')
    //         ->notEmptyString('modified_by');

    //     $validator
    //         ->dateTime('modified_date')
    //         ->requirePresence('modified_date', 'create')
    //         ->notEmptyDateTime('modified_date');

    //     return $validator;
    // }
}
