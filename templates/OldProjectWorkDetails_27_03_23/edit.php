<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OldProjectWorkDetail $oldProjectWorkDetail
 * @var string[]|\Cake\Collection\CollectionInterface $districts
 * @var string[]|\Cake\Collection\CollectionInterface $divisions
 * @var string[]|\Cake\Collection\CollectionInterface $circles
 * @var string[]|\Cake\Collection\CollectionInterface $financialYears
 * @var string[]|\Cake\Collection\CollectionInterface $departments
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $oldProjectWorkDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $oldProjectWorkDetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Old Project Work Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="oldProjectWorkDetails form content">
            <?= $this->Form->create($oldProjectWorkDetail) ?>
            <fieldset>
                <legend><?= __('Edit Old Project Work Detail') ?></legend>
                <?php
                    echo $this->Form->control('district_id', ['options' => $districts]);
                    echo $this->Form->control('division_id', ['options' => $divisions]);
                    echo $this->Form->control('circle_id', ['options' => $circles]);
                    echo $this->Form->control('work_stage');
                    echo $this->Form->control('work_completed');
                    echo $this->Form->control('financial_year_id', ['options' => $financialYears]);
                    echo $this->Form->control('department_id', ['options' => $departments]);
                    echo $this->Form->control('project_name');
                    echo $this->Form->control('ref_no');
                    echo $this->Form->control('is_active');
                    echo $this->Form->control('created_by');
                    echo $this->Form->control('created_date');
                    echo $this->Form->control('modified_by');
                    echo $this->Form->control('modified_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
