<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectFundDetail $projectFundDetail
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
                ['action' => 'delete', $projectFundDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $projectFundDetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Project Fund Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectFundDetails form content">
            <?= $this->Form->create($projectFundDetail) ?>
            <fieldset>
                <legend><?= __('Edit Project Fund Detail') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks]);
                    echo $this->Form->control('project_work_subdetail_id', ['options' => $projectWorkSubdetails]);
                    echo $this->Form->control('request_date');
                    echo $this->Form->control('request_amount');
                    echo $this->Form->control('status');
                    echo $this->Form->control('is_amount_received');
                    echo $this->Form->control('received_amount');
                    echo $this->Form->control('received_date', ['empty' => true]);
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
