<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectFinancialSanction $projectFinancialSanction
 * @var \Cake\Collection\CollectionInterface|string[] $projectWorks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Project Financial Sanctions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectFinancialSanctions form content">
            <?= $this->Form->create($projectFinancialSanction) ?>
            <fieldset>
                <legend><?= __('Add Project Financial Sanction') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks]);
                    echo $this->Form->control('fs_ref_no');
                    echo $this->Form->control('sanctioned_file_upload');
                    echo $this->Form->control('sanctioned_amount');
                    echo $this->Form->control('sanctioned_date');
                    echo $this->Form->control('is_active');
                    echo $this->Form->control('created_date');
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
