<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ProjectwiseContractorRateDetailsTable extends Table
{
  
    public function initialize(array $config): void
    {
        parent::initialize($config);  

        $this->setTable('projectwise_contractor_rate_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectWorks', [
            'foreignKey' => 'project_work_id',
        ]);
		
		   $this->belongsTo('ProjectWorkSubdetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
		
	      $this->belongsTo('ContractorDetails', [
            'foreignKey' => 'contractor_detail_id',
         ]);
		
        $this->belongsTo('BuildingItems', [
            'foreignKey' => 'building_item_id',
        ]);
		
		    $this->belongsTo('Units', [
            'foreignKey' => 'unit_id',
        ]);
    }
   
}