<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectMonitoringDetail $projectMonitoringDetail
 * @var \Cake\Collection\CollectionInterface|string[] $projectWorks
 * @var \Cake\Collection\CollectionInterface|string[] $workStages
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Project Monitoring Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectMonitoringDetails form content">
            <?= $this->Form->create($projectMonitoringDetail) ?>
            <fieldset>
                <legend><?= __('Add Project Monitoring Detail') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks]);
                    echo $this->Form->control('project_work_subdetail_id');
                    echo $this->Form->control('work_stage_id', ['options' => $workStages, 'empty' => true]);
                    echo $this->Form->control('monitoring_date', ['empty' => true]);
                    echo $this->Form->control('work_percentage_id');
                    echo $this->Form->control('photo_upload');
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
