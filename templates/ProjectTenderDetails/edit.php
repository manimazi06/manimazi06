<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectTenderDetail $projectTenderDetail
 * @var string[]|\Cake\Collection\CollectionInterface $projectWorks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $projectTenderDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $projectTenderDetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Project Tender Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectTenderDetails form content">
            <?= $this->Form->create($projectTenderDetail) ?>
            <fieldset>
                <legend><?= __('Edit Project Tender Detail') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks]);
                    echo $this->Form->control('tender_no');
                    echo $this->Form->control('tender_date');
                    echo $this->Form->control('tender_copy');
                    echo $this->Form->control('tender_amount');
                    echo $this->Form->control('contractor_name');
                    echo $this->Form->control('contractor_mobile_no');
                    echo $this->Form->control('agreement_no');
                    echo $this->Form->control('agreement_date');
                    echo $this->Form->control('agreement_copy');
                    echo $this->Form->control('is_active');
                    echo $this->Form->control('created_by');
                    echo $this->Form->control('created_date');
                    echo $this->Form->control('modified_by');
                    echo $this->Form->control('modified_date', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
