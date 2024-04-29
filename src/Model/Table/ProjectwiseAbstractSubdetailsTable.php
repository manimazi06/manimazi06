<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ProjectwiseAbstractSubdetailsTable extends Table
{
  
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('projectwise_abstract_subdetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectwiseAbstractDetails', [
            'foreignKey' => 'projectwise_abstract_detail_id',
        ]);
		
        $this->belongsTo('BuildingItems', [
            'foreignKey' => 'building_item_id',
        ]);
		
		$this->belongsTo('NewBuildingItems', [
            'foreignKey' => 'new_building_item_id',
        ]);
		
	    $this->belongsTo('Units', [
            'foreignKey' => 'unit_id',
        ]);
    }
   
}