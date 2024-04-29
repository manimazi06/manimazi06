<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DetailedEstimateApprovalStages Model
 *
 * @property \App\Model\Table\ProjectWorksTable&\Cake\ORM\Association\BelongsTo $ProjectWorks
 * @property \App\Model\Table\ProjectWorkSubdetailsTable&\Cake\ORM\Association\BelongsTo $ProjectWorkSubdetails
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CurrentRolesTable&\Cake\ORM\Association\BelongsTo $CurrentRoles
 * @property \App\Model\Table\ApprovalStatusesTable&\Cake\ORM\Association\BelongsTo $ApprovalStatuses
 *
 * @method \App\Model\Entity\DetailedEstimateApprovalStage newEmptyEntity()
 * @method \App\Model\Entity\DetailedEstimateApprovalStage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DetailedEstimateApprovalStage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DetailedEstimateApprovalStage get($primaryKey, $options = [])
 * @method \App\Model\Entity\DetailedEstimateApprovalStage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DetailedEstimateApprovalStage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DetailedEstimateApprovalStage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DetailedEstimateApprovalStage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DetailedEstimateApprovalStage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DetailedEstimateApprovalStage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DetailedEstimateApprovalStage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DetailedEstimateApprovalStage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DetailedEstimateApprovalStage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DetailedEstimateApprovalStagesTable extends Table
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

        $this->setTable('detailed_estimate_approval_stages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProjectWorks', [
            'foreignKey' => 'project_work_id',
        ]);
        $this->belongsTo('ProjectWorkSubdetails', [
            'foreignKey' => 'project_work_subdetail_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
       
        $this->belongsTo('ApprovalStatuses', [
            'foreignKey' => 'approval_status_id',
        ]);
    }
    
}