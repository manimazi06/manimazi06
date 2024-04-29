<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseQuartersDetail $projectwiseQuartersDetail
 * @var string[]|\Cake\Collection\CollectionInterface $projectWorks
 * @var string[]|\Cake\Collection\CollectionInterface $projectWorkSubdetails
 * @var string[]|\Cake\Collection\CollectionInterface $policeDesignations
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $projectwiseQuartersDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseQuartersDetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Projectwise Quarters Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectwiseQuartersDetails form content">
            <?= $this->Form->create($projectwiseQuartersDetail) ?>
            <fieldset>
                <legend><?= __('Edit Projectwise Quarters Detail') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks, 'empty' => true]);
                    echo $this->Form->control('project_work_subdetail_id', ['options' => $projectWorkSubdetails, 'empty' => true]);
                    echo $this->Form->control('police_designation_id', ['options' => $policeDesignations, 'empty' => true]);
                    echo $this->Form->control('no_of_quarters');
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
