<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseCompletionReport $projectwiseCompletionReport
 * @var \Cake\Collection\CollectionInterface|string[] $projectWorks
 * @var \Cake\Collection\CollectionInterface|string[] $projectWorkSubdetails
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Projectwise Completion Reports'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectwiseCompletionReports form content">
            <?= $this->Form->create($projectwiseCompletionReport) ?>
            <fieldset>
                <legend><?= __('Add Projectwise Completion Report') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks]);
                    echo $this->Form->control('project_work_subdetail_id', ['options' => $projectWorkSubdetails]);
                    echo $this->Form->control('completed_date');
                    echo $this->Form->control('file_upload');
                    echo $this->Form->control('remarks');
                    echo $this->Form->control('is_active');
                    echo $this->Form->control('created_date', ['empty' => true]);
                    echo $this->Form->control('created_by');
                    echo $this->Form->control('modified_date', ['empty' => true]);
                    echo $this->Form->control('modified_by');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
