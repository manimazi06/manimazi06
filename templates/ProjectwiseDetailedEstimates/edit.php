<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseDetailedEstimate $projectwiseDetailedEstimate
 * @var string[]|\Cake\Collection\CollectionInterface $projectWorks
 * @var string[]|\Cake\Collection\CollectionInterface $materials
 * @var string[]|\Cake\Collection\CollectionInterface $units
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $projectwiseDetailedEstimate->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseDetailedEstimate->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Projectwise Detailed Estimates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectwiseDetailedEstimates form content">
            <?= $this->Form->create($projectwiseDetailedEstimate) ?>
            <fieldset>
                <legend><?= __('Edit Projectwise Detailed Estimate') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks, 'empty' => true]);
                    echo $this->Form->control('material_id', ['options' => $materials, 'empty' => true]);
                    echo $this->Form->control('quantity');
                    echo $this->Form->control('unit_id', ['options' => $units, 'empty' => true]);
                    echo $this->Form->control('approved_estimate');
                    echo $this->Form->control('total_cost');
                    echo $this->Form->control('submit_date', ['empty' => true]);
                    echo $this->Form->control('is_active');
                    echo $this->Form->control('created_by');
                    echo $this->Form->control('created_date', ['empty' => true]);
                    echo $this->Form->control('modified_by');
                    echo $this->Form->control('modified_date', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
