<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseAbstractDetail $projectwiseAbstractDetail
 * @var \Cake\Collection\CollectionInterface|string[] $projectWorks
 * @var \Cake\Collection\CollectionInterface|string[] $projectWorkSubdetails
 * @var \Cake\Collection\CollectionInterface|string[] $developmentWorks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Projectwise Abstract Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectwiseAbstractDetails form content">
            <?= $this->Form->create($projectwiseAbstractDetail) ?>
            <fieldset>
                <legend><?= __('Add Projectwise Abstract Detail') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks, 'empty' => true]);
                    echo $this->Form->control('project_work_subdetail_id', ['options' => $projectWorkSubdetails, 'empty' => true]);
                    echo $this->Form->control('development_work_id', ['options' => $developmentWorks, 'empty' => true]);
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
