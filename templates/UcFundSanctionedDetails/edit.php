<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UcFundSanctionedDetail $ucFundSanctionedDetail
 * @var string[]|\Cake\Collection\CollectionInterface $utilizationCertificates
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
                ['action' => 'delete', $ucFundSanctionedDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ucFundSanctionedDetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Uc Fund Sanctioned Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ucFundSanctionedDetails form content">
            <?= $this->Form->create($ucFundSanctionedDetail) ?>
            <fieldset>
                <legend><?= __('Edit Uc Fund Sanctioned Detail') ?></legend>
                <?php
                    echo $this->Form->control('utilization_certificate_id', ['options' => $utilizationCertificates, 'empty' => true]);
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks, 'empty' => true]);
                    echo $this->Form->control('project_work_subdetail_id', ['options' => $projectWorkSubdetails, 'empty' => true]);
                    echo $this->Form->control('go_no');
                    echo $this->Form->control('sanctioned_date', ['empty' => true]);
                    echo $this->Form->control('amount');
                    echo $this->Form->control('submit_date', ['empty' => true]);
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
