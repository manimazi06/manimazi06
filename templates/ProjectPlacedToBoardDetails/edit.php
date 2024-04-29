<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectPlacedToBoardDetail $projectPlacedToBoardDetail
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
                ['action' => 'delete', $projectPlacedToBoardDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $projectPlacedToBoardDetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Project Placed To Board Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectPlacedToBoardDetails form content">
            <?= $this->Form->create($projectPlacedToBoardDetail) ?>
            <fieldset>
                <legend><?= __('Edit Project Placed To Board Detail') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks, 'empty' => true]);
                    echo $this->Form->control('project_work_subdetail_id', ['options' => $projectWorkSubdetails, 'empty' => true]);
                    echo $this->Form->control('placed_date', ['empty' => true]);
                    echo $this->Form->control('file_upload');
                    echo $this->Form->control('remarks');
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
