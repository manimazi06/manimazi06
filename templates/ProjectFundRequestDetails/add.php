<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectFundRequestDetail $projectFundRequestDetail
 * @var \Cake\Collection\CollectionInterface|string[] $projectWorks
 * @var \Cake\Collection\CollectionInterface|string[] $projectWorkSubdetails
 * @var \Cake\Collection\CollectionInterface|string[] $fundStatuses
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Project Fund Request Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectFundRequestDetails form content">
            <?= $this->Form->create($projectFundRequestDetail) ?>
            <fieldset>
                <legend><?= __('Add Project Fund Request Detail') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks, 'empty' => true]);
                    echo $this->Form->control('project_work_subdetail_id', ['options' => $projectWorkSubdetails, 'empty' => true]);
                    echo $this->Form->control('fund_status_id', ['options' => $fundStatuses, 'empty' => true]);
                    echo $this->Form->control('fund_amount');
                    echo $this->Form->control('balance_amount');
                    echo $this->Form->control('request_date', ['empty' => true]);
                    echo $this->Form->control('approval_date', ['empty' => true]);
                    echo $this->Form->control('remarks');
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
