<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class NotificationsTable extends Table
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

        $this->setTable('notifications');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

  
		   $this->belongsTo('NotificationTypes', [
            'foreignKey' => 'notification_type_id',
        ]);
		
		 $this->belongsTo('ProjectWorks', [
            'foreignKey' => 'project_work_id',
        ]);
		 $this->belongsTo('ProjectWorkSubdetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
    }    
}
