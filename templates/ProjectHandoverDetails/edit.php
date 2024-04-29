<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectHandoverDetail $projectHandoverDetail
 * @var string[]|\Cake\Collection\CollectionInterface $projectWorks
 * @var string[]|\Cake\Collection\CollectionInterface $projectWorkSubdetails
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $projectHandoverDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $projectHandoverDetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Project Handover Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectHandoverDetails form content">
            <?= $this->Form->create($projectHandoverDetail) ?>
            <fieldset>
                <legend><?= __('Edit Project Handover Detail') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks]);
                    echo $this->Form->control('project_work_subdetail_id', ['options' => $projectWorkSubdetails]);
                    echo $this->Form->control('handover_date');
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
